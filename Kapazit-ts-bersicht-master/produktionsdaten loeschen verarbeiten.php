<?php
    // Übergabe der Variable aus produktionsdaten loeschen.php
    $selectedAuftrag = $_POST["auftragLoeschen"];

    /* DB Verbindung herstellen */
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASSWORD", "");
    define("DB_DATABASE", "kapauebersicht_db");

    $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die(mysql_error());

    // Werks-id und Anzahl_zugewiesen holen
    $query1 ="SELECT W_ID, Anzahl_zugewiesen FROM auftrag_tbl  WHERE A_ID LIKE '$selectedAuftrag' ";
    $resultAuftrag = mysqli_query($db, $query1);
    $auftrag_db = $resultAuftrag->fetch_assoc();
    $w_id = $auftrag_db["W_ID"];
    $pAnzahl = $auftrag_db["Anzahl_zugewiesen"];
  
    //Auftrag löschen
    $query2 ="DELETE FROM auftrag_tbl WHERE A_ID LIKE '$selectedAuftrag' ";
    $result = mysqli_query($db, $query2);

    if($result)
    {
        // Aktuelle Kapazität holen
        $query3="SELECT Kapazitaet_aktuell FROM werk_tbl WHERE W_ID LIKE '$w_id'";

        $kapa_result = mysqli_query($db, $query3);
        $werk_db = $kapa_result->fetch_assoc();
        $kapazitaet_aktuell_alt = $werk_db["Kapazitaet_aktuell"];

        // neue aktuelle Kapazität berechnen
        $kapazitaet_aktuell_neu = $kapazitaet_aktuell_alt + $pAnzahl;

        // Update von Kapazitaet_aktuell von werk_tbl  
        $query4="UPDATE werk_tbl
        SET 
        Kapazitaet_aktuell = '$kapazitaet_aktuell_neu' WHERE W_ID LIKE '$w_id' ";

        $updateWerk = mysqli_query($db, $query4);

        // Weiterleitung zu Produktionsdaten löschen
        header('location: produktionsdaten loeschen.php');
        exit(1);

    }
    else{
        echo("Löschen fehlgeschlagen.");
    }
?>