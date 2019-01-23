<?php
$p_id = $_POST['produktID'];
$w_id = $_POST['werkID'];
$pAnzahl = $_POST['pAnzahl'];
$planungsdatum = $_POST['planungsdatum'];
$quartal = $_POST['quartal'];

/* DB Verbindung herstellen */
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "kapauebersicht_db");

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die(mysql_error());

     
     $query2 = "SELECT auftrag_tbl.P_ID FROM auftrag_tbl JOIN produkt_tbl ON produkt_tbl.P_ID = auftrag_tbl.P_ID WHERE auftrag.P_ID = $p_id"; 

     $result = mysqli_query($db, $query2); 

# Auftrag hinzufügen
    $query1="INSERT INTO auftrag_tbl
             SET 
             P_ID = '$result',
             Anzahl_zugewiesen='$pAnzahl',
             Planungsdatum= '$planungsdatum',
             Quartal='$quartal'";

    $zuweisen = mysqli_query($db, $query1);

    if($zuweisen)
    {

         # weiterleitung auf die seite nach erfolgreichem login;
        header('location: produktionsverwaltung.php');
        exit(1);
    }
    else
    {
        
       header('location: produktionsverwaltung.php');
        exit();
    }

?>