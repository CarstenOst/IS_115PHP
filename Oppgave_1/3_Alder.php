<?php
$navn = "Carsten";
$alder = 23;
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <title>Navn og Alder</title>
    <style>
        .center {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .left-align {
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="center">
        <table>
          <tr class="left-align"><!-- tabell -->
            <th>Navn</th>
            <th>Alder</th>
          </tr>
          <tr class="left-align">
            <td><?php echo $navn; ?></td>
            <td><?php echo $alder; ?></td>
          </tr>
        </table>

        <ol class="left-align"><!-- nummerert liste -->
            <li>Navn: <?php echo $navn; ?></li>
            <li>Alder: <?php echo $alder; ?></li>
        </ol>

        <ul class="left-align"> <!-- punktmerket liste (unordered list) -->
            <li>Navn: <?php echo $navn; ?></li>
            <li>Alder: <?php echo $alder; ?></li>
        </ul>

        <p>
            <?php echo $navn; ?> er <?php echo $alder; ?> år gammel.
        </p>
    </div>
</body>
</html>