<?php
class BookingAPI
{
    private PDO $pdo;

    public function __construct()
    {
        $host = "localhost";
        $port = 3306;
        $dbName = "mod10";
        $user = "root";
        $pass = "123";
        try {
            $this->pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbName", $user, $pass);
            // Set PDO to throw exceptions on errors
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getBookingById($id): false|array
    {
        $query = "SELECT * FROM Booking WHERE bookingId = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBookingsByTutor($tutorId): array|false
    {
        $query = "SELECT * FROM Booking WHERE tutorId = :tutorId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':tutorId', $tutorId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBookingsByStudent($studentId): array|false
    {
        $query = "SELECT * FROM Booking WHERE studentId = :studentId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBookingsByMonth($month): array|false
    {
        $query = "SELECT * FROM Booking WHERE MONTH(bookingTime) = :month";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':month', $month, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

// Usage Example
$bookingSystem = new BookingAPI();
if (isset($_GET["action"])) {
    $action = $_GET["action"];
    $output = "Invalid action";

    switch ($action) {
        case "getBookingById":
            if (isset($_GET["id"])) {
                $bookingId = $_GET["id"];
                $output = $bookingSystem->getBookingById($bookingId);
            }
            break;
        case "getBookingsByTutor":
            if (isset($_GET["tutor_id"])) {
                $tutorId = $_GET["tutor_id"];
                $output = $bookingSystem->getBookingsByTutor($tutorId);
            }
            break;
        case "getBookingsByStudent":
            if (isset($_GET["student_id"])) {
                $studentId = $_GET["student_id"];
                $output = $bookingSystem->getBookingsByStudent($studentId);
            }
            break;
        case "getBookingsByMonth":
            if (isset($_GET["month"])) {
                $month = $_GET["month"];
                $output = $bookingSystem->getBookingsByMonth($month);
            }
            break;
    }
    // Uncomment for demo but remember to remove the top include statement
    header("Content-Type: application/json");
    echo json_encode($output);
} else {
    echo "No action specified.";
}