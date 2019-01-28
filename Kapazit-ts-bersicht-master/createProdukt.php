<?php

// Übergabe der Variablen aus produkt anlegen.php
$bezeichnung = $_POST['bezeichnung'];
$anzahl = $_POST['anzahl'];


/* DB Verbindung herstellen */
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "kapauebersicht_db");

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die(mysql_error());

// Produkt hinzufügen
 $query1 = "INSERT INTO produkt_tbl
            SET 
            Produktbez = '$bezeichnung',
            Anzahl = '$anzahl';";

//Query ausführen und ergebnis speichern
 $check = mysqli_query($db, $query1); 

    if($check)
    {
        # Weiterleitung auf die Produkt anzeigen Seite;
        header('location: produkte anzeigen.php');
        exit(1);

    }
    else
    {
        echo "Das Produkt konnte nicht gelöscht werden.";
        header('location: produkte anlegen.php');
        exit();
    }
 
?>
