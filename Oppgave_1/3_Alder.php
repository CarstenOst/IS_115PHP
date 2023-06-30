<?php
$navn = "Carsten";
$alder = 23;
?>

<style>.left-align { text-align: left;}</style>
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

<p> <!-- Utskrift av navn och alder -->
    <?php echo $navn; ?> er <?php echo $alder; ?> år gammel.
</p>
