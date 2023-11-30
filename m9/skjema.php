<?php
//echo $_SERVER['DOCUMENT_ROOT']; exit();
//phpinfo(); exit();
if (!0) {
    echo ' Im zero';
}
// Skjema sendt?
if (isset($_REQUEST['last-opp-send'])) {
    echo "<pre>";
    echo "Dette script: " . $_SERVER['SCRIPT_FILENAME'] . "<br>";
    echo "Filnavn: " . $_FILES['last-opp-fil']['name'] . "<br>";
    echo "Midlertidig lokasjon/navn: " . $_FILES['last-opp-fil']['tmp_name'] . "<br>";
    echo "Mime-type: " . $_FILES['last-opp-fil']['type'] . "<br>";
    echo "Filstr.: " . $_FILES['last-opp-fil']['size'] . " byte (" . round($_FILES['last-opp-fil']['size'] / 1048576, 2) . " MB) <br><br>";
    echo "</pre>";

    // Definer matrise for meldinger
    $meldinger = array();

    // Filopplasting
    if (is_uploaded_file($_FILES['last-opp-fil']['tmp_name'])) {
        // Henter informasjon om fil
        $filtype = $_FILES['last-opp-fil']['type'];
        $filstr = $_FILES['last-opp-fil']['size'];

        /* Konfigurasjoner
           Vanlige mime-typer: https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Common_types
         */
        $aks_filtyper = array("jpg" => "image/jpeg",
            "gif" => "image/gif",
            "png" => "image/png"
        );
        $max_filstr = 1530000; // i byte

        $mappe = "/is115/m9/filer/";
        $filsystem_mappe = $_SERVER['DOCUMENT_ROOT'] . $mappe;
        $web_mappe = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . $mappe;

        // Ingen mappe ved det navnet?
        if (!file_exists($filsystem_mappe)) {
            if (!mkdir($filsystem_mappe, 0777, true))
                die("Kan ikke opprette mappe... " . $filsystem_mappe);
        }

        // Konstruerer filnavn
        $suffix = array_search($_FILES['last-opp-fil']['type'], $aks_filtyper);

        // Hvis filnavnet eksisterer allerede av en eller annen grunn
        do {
            $filnavn = substr(md5(date('YmdHisu')), 0, 5) . '.' . $suffix;
        } while (file_exists($filsystem_mappe . $filnavn));

        // Feil?
        if (!in_array($filtype, $aks_filtyper)) {
            $typer = implode(", ", array_keys($aks_filtyper));
            $meldinger['error'][] = "Ugyldig filtype (kun <em>" . $typer . "</em> er akseptert)";
        }
        if ($filstr > $max_filstr)
            $meldinger['error'][] = "Filstørrelsen (" . round($filstr / 1048576, 2) . " MB) overgår maksimal filstørrelse (" . round($max_filstr / 1048576, 2) . " MB)"; // Bin. konvertering

        // Om alt er fint
        if (empty($meldinger)) {
            // Flytter filen din den skal være
            $filsti = $filsystem_mappe . $filnavn;
            $opplastet_fil = move_uploaded_file($_FILES['last-opp-fil']['tmp_name'], $filsti);

            if (!$opplastet_fil)
                $meldinger['error'][] = "Filen kunne ikke bli lastet opp.";
            else
                $meldinger['success'][] = "Filen ble lastet opp og finnes her: <strong>" .
                    $filsti .
                    "</strong> (filsystemref.) eller her <strong>" .
                    '<a href="' . $web_mappe . $filnavn . '">' . $web_mappe . $filnavn . "</a>
                    </strong> (URL)";
        }

    } else {
        $meldinger['error'][] = "Ingen fil er valgt.";
    }
}
?>
<!doctype html>
<html lang="no">
<head>
    <meta charset="utf-8">
    <title>M9 - filopplasting</title>
</head>

<body>
<?php
// Skriv ut beskjeder til bruker
if (isset($meldinger) && !empty($meldinger)) {
    echo "<strong>Melding" . (sizeof($meldinger, COUNT_RECURSIVE) - 1 > 1 ? "s:<br>" : ":<br>") . "</strong>";
    foreach ($meldinger as $mld_type => $type_meldinger) {
        if ($mld_type == 'error')
            foreach ($type_meldinger as $melding) {
                echo '<span style="color:red">- ' . $melding . '</span><br>';
            }
        elseif ($mld_type == 'success')
            foreach ($type_meldinger as $melding) {
                echo '<span style="color:green">- ' . $melding . '</span><br>';
            }
    }
} else {
    echo "<strong>Vennligst velg fil til opplasting</strong>";
}
?>

<form method="POST" action="" enctype="multipart/form-data">
    <p>
        <label for="last-opp-fil">Velg fil</label>
        <input name="last-opp-fil" type="file">
    </p>
    <p>
        <button type="submit" name="last-opp-send">Last opp fil</button>
    </p>
</form>
</body>
</html>
