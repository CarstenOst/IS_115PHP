<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="script.js"></script>
    <title>Number Input</title>
</head>
<body>
<div class="center">
    <nav id="navbar" style="align-items: center" >
        <button id="LastName" onclick="location.href='LastNameFormatting.php'">1. Ressurser</button>
        <!-- Note that there is an ugly bug where if settings is pressed the navbar jumps a little, I'll buy you pizza if you manage to fix it.
             It must be something with the phpinfo() altering css of some sorts, but css is not my strong suit -->
        <button id="settings" onclick="loadContent('2_Instillinger.php')">2. Settings</button>
        <button id="alder" onclick="loadContent('3_Alder.php')">3. Alder</button>
        <button id="kalkulator" onclick="location='4_Kalkulator.php'">4. Kalkulator</button>
        <button id="hilsen" onclick="loadContent('5_Hilsen.php')">5. Hilsen</button>
    </nav>
    <div id="content" class="center">
        <!-- Content will be loaded here -->

        <!-- Normal form with a post method (to send data to the server) -->
        <form id="form" action="" method="POST">
            <label for="numbers">Enter numbers (separated by commas):</label><br>

            <!-- Values typed into the super global variable $_POST is available to the php script
                The "??" accepts the left value ($_COOKIE) if there is anything in it, else it goes right to $_POST and checks again for a value.
                Lastly it will (if null) insert an empty string in the input field -->
            <input type="text" name="numbers" id="numbers" required>
            <!-- A warning that is displayed if the user enters anything other than numbers and commas
                 Use of <br> to get some space. It's kinda ugly but it works
             -->
            <small id="warning" style="color: red; display: none;">Please enter numbers and commas only.</small><br><br>
            <input type="submit" value="Calculate Sum and Average">
        </form>
    </div>
</div>
</body>
</html>