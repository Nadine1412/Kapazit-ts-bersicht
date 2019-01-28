<?php
// Übergabe der Variablen aus werk anlegen.php
$bezeichnung = $_POST['bezeichnung'];
$kapazität = $_POST['kapazitaetfix'];


/* DB Verbindung herstellen */
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "kapauebersicht_db");

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die(mysql_error());

// Werk hinzufügen
 $query1 = "INSERT INTO werk_tbl
            SET 
            W_ID = '$bezeichnung',
            Kapazitaet_fix = '$kapazität',
            Kapazitaet_aktuell = '$kapazität'";

//Query ausführen und ergebnis speichern
 $check = mysqli_query($db, $query1); 

    if($check)
    {
        # Weiterleitung auf die Werk anzeigen Seite;
        header('location: werke anzeigen.php');
        exit(1);

    }
    else
    {
        echo "Das Werk konnte nicht gelöscht werden.";
        header('location: werke anlegen.php');
        exit();
    }
 
?>
