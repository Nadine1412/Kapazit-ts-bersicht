<?php
// Session wird gestartet
    session_start();
    
    if(isset($_POST["werkID"]))
    {
        $w_id = $_POST["werkID"];
    }
    else{
        $w_id = $_SESSION["w_id"];
    }
    
    /* DB Verbindung herstellen */
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASSWORD", "");
    define("DB_DATABASE", "kapauebersicht_db");

    $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die(mysql_error());

    // Kapazitäten aus Werksdatenbank auslesen
    $query1 = "SELECT * FROM werk_tbl WHERE W_ID = '$w_id'";

     //Query ausführen und ergebnis speichern
        $result = mysqli_query($db, $query1);

        while($werk_db = $result->fetch_assoc())
        {
            // Laden der Werke aus der Datenbank
            $_SESSION["w_id"] =  $werk_db["W_ID"];
            $kapafix =  $werk_db["Kapazitaet_fix"];
            $_SESSION["kapazitaet"] =  $werk_db["Kapazitaet_aktuell"]; 
            $_SESSION["kapadiv"] = $kapafix - $_SESSION["kapazitaet"];
        }       
                
    if($result)
    {
            # Weiterleitung auf die KapaKuchendiagramm Seite;
        header('location: KapaKuchendiagramm.php');
        exit(1);
    
    }
    else{
        echo("Auswahl fehlgeschlagen.");
    }
?>
