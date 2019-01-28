<?php
// Übergabe der Variable aus werk loeschen.php
$selectedWid = $_POST["Werkloeschen"];

/* DB Verbindung herstellen */
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "kapauebersicht_db");

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die(mysql_error());

 //Werk löschen
$query1 ="DELETE FROM werk_tbl WHERE W_ID LIKE '$selectedWid' ";

$result = mysqli_query($db, $query1);

if($result)
{
     # Weiterleitung auf die Werke löschen Seite;
    header('location: werk loeschen.php');
    exit(1);
}
else{
    echo("Löschen fehlgeschlagen.");
}

?>