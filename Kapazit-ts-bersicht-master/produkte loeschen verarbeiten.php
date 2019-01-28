<?php
    // Übergabe der Variable aus produkte loeschen
$selectedPid = $_POST["Produktloeschen"];

/* DB Verbindung herstellen */
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "kapauebersicht_db");

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die(mysql_error());

 //Produkte löschen
 $query1 ="DELETE FROM produkt_tbl WHERE P_ID LIKE '$selectedPid' ";

$result = mysqli_query($db, $query1);

if($result)
{
     # Weiterleitung auf die Produkte löschen Seite;
    header('location: produkte loeschen.php');
    exit(1);

}
else{
    echo("Löschen fehlgeschlagen.");
}

?>
