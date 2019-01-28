<?php
// Session starten
session_start();

// Übergabe der Variablen aus anmeldung kaue.html
$email = $_POST['e_mail'];
$password_input = $_POST['pass'];

/* DB Verbindung herstellen */
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "kapauebersicht_db");

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die(mysql_error());

// Gehashtes Passwort von email holen
$query1 = "SELECT Passwort FROM mitarbeiter_tbl
            WHERE EMail LIKE '$email' "; 
            
// Query ausführen und Ergebnis speichern
$result = mysqli_query($db, $query1); 

while($pass_db = $result->fetch_assoc())
{
    $pw = $pass_db["Passwort"];
}
 

if ($result->num_rows != 0) 
{
    //DB Passwort mit eingegebenem Passwort vergleichen
    if ( password_verify($password_input, $pw) ) {   
        // Passwort war richtig.
        
        // E-Mail Adresse wird als Session-Variable gespeichert
        $_SESSION["LoggedEMail"] = $email;

        // Mitarbeiterinformationen von eingeloggter Email holen
        $query2 = "SELECT * FROM mitarbeiter_tbl WHERE EMail LIKE '" . $_SESSION["LoggedEMail"] . "'";

        $resultUser = mysqli_query($db, $query2); //Query ausführen und ergebnis speichern
    
        while($user_db = $resultUser->fetch_assoc())
        {
            // Laden der Userdaten aus der Datenbank und speichern in Session Variablen
            $_SESSION["userName"] =  $user_db["Nachname"];
            $_SESSION["userForename"] =  $user_db["Vorname"];
            $_SESSION["userMID"] =  $user_db["M_ID"];
            $_SESSION["userPosition"] =  $user_db["Position"];
            $_SESSION["userFachbereich"] =  $user_db["Fachbereich"];
            $_SESSION["userEMail"] =  $user_db["EMail"];
            $_SESSION["userPasswordEnc"] = $user_db["Passwort"];               
        }

        // Weiterleitung zur Startseite
        header('location: startseite.html');
    } else {
        //Passwort war falsch.
        // header('location: Anmeldung kaue.html');
        echo "Passwort nicht korrekt.";
    
    }  
}
else 
{
    // Warnung wenn Email nicht richtig.
   // header('location: Anmeldung kaue.html');
    echo "E-Mail Adresse nicht korrekt.";
} 

?>
