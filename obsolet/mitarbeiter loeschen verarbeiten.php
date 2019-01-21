<?php

$selectedMid = $_POST["Mitarbeiterloeschenbtn"];

/* DB Verbindung herstellen */
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "kapauebersicht_db");

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die(mysql_error());

 //Mitglieder löschen
 $query1 ="DELETE FROM mitarbeiter_tbl WHERE M_ID LIKE '$selectedMid' ";

$result = mysqli_query($db, $query1);

if($result)
{
     # Weiterleitung auf die Mitglied löschen Seite;
    header('location: mitarbeiter loeschen.php');
    exit(1);

}
else{
    echo("Löschen fehlgeschlagen.");
}

?>