<?php

$selectedAid = $_POST["Produkteloeschen"];

/* DB Verbindung herstellen */
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "kapauebersicht_db");

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die(mysql_error());

 //Mitglieder löschen
 $query1 ="DELETE FROM produkte_tbl WHERE P_ID LIKE '$selectedPid' ";

$result = mysqli_query($db, $query1);

if($result)
{
     # Weiterleitung auf die Mitglied löschen Seite;
    header('location: produkte loeschen.php');
    exit(1);

}
else{
    echo("Löschen fehlgeschlagen.");
}

?>