<?php
include '../sharedViewTop.php';

// Because I have a bunch of extra divs in the sharedViewTop.php I have to make this iframe absolute.
echo "<iframe 
        src=\"Modul%205%20Oppgave%201.pdf\" 
        style=\"position: absolute; top: 50px; left: 0; width: 100%; height: calc(100% - 50px); border: none;\">
        </iframe>";
// Code is partly stolen from here:
// https://stackoverflow.com/questions/18040386/how-to-display-pdf-in-php


include '../sharedViewBottom.php';
