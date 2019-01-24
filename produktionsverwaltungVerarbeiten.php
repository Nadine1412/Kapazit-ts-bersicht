<?php
session_start();

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

     

# Auftrag hinzufügen
    $query1="INSERT INTO auftrag_tbl
             SET 
             P_ID = (SELECT P_ID FROM produkt_tbl WHERE P_ID = '$p_id'),
             W_ID = (SELECT W_ID FROM werk_tbl WHERE W_ID = '$w_id'),
             Anzahl_zugewiesen='$pAnzahl',
             Planungsdatum= '$planungsdatum',
             Quartal='$quartal'";


    $zuweisen = mysqli_query($db, $query1);


    if($zuweisen)
    {
        $query2="SELECT Kapazitaet_aktuell FROM werk_tbl WHERE W_ID LIKE '$w_id'";

        $kapa_result = mysqli_query($db, $query2);
        $werk_db = $kapa_result->fetch_assoc();
        $kapazitaet_aktuell_alt = $werk_db["Kapazitaet_aktuell"];

        $_SESSION["w_id"] = $w_id;

        $neue_Kapazitaet_aktuell = $kapazitaet_aktuell_alt - $pAnzahl;

        // Update von Kapazitaet_aktuell von werk_tbl  
        $query3="UPDATE werk_tbl
        SET 
        Kapazitaet_aktuell = '$neue_Kapazitaet_aktuell' WHERE W_ID LIKE '$w_id' ";


         $updateWerk = mysqli_query($db, $query3);

         # weiterleitung auf die seite nach erfolgreichem login;

        header('location: KapaKuchenDiagrammVerarbeiten.php');
        exit(1);
    }
    else
    {
        
       header('location: produktionsverwaltung.php');
        exit();
    }

?>