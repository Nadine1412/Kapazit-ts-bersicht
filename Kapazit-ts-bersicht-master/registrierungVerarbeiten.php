<?php
// Unit-Test zur Validierung der Email
require 'C:\xampp\htdocs\Kapazit-ts-bersicht\EmailValidator.php';

// Übergabe der Variablen aus registrierung kaue.php
$vorname = $_POST['vorname'];
$nachname = $_POST['name'];
$fachbereich = $_POST['fachbereich'];
$position = $_POST['position'];
$email = $_POST['email'];
$password = $_POST['password'];

// Hashen des Passworts
$password_encrypt = password_hash($password, PASSWORD_DEFAULT);

/* DB Verbindung herstellen */
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "kapauebersicht_db");

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die(mysql_error());

// Überpruefen, ob der Mitarbeiter bereits vorhanden ist anhand der Email
 $query1 = "SELECT EMail FROM mitarbeiter_tbl
            WHERE EMail LIKE '$email'"; 

//Query ausführen und ergebnis speichern
 $check = mysqli_query($db, $query1); 

//Prüfen ob Eintrag bereits vorhanden
 $result = mysqli_num_rows($check); 

//  // EmailValidator
// $emailValidate = new EmailValidator();
// $checkEmail = $emailValidate->is_validate($email);
// if($checkEmail){

 if ($result) {
     # Mitarbeiter bereits vorhanden
   // Ausgabe, dass Mitarbeiter bereits vorhanden ist.
    echo "Email bereits vorhanden";
    exit();
} else {

     # Mitarbeiter hinzufügen
    $query2="INSERT INTO mitarbeiter_tbl
             SET 
             Nachname='$nachname',
             Vorname='$vorname',
             Position='$position',
             EMail= '$email',
             Fachbereich='$fachbereich',
             Passwort='$password_encrypt';";
    $eintragen = mysqli_query($db, $query2);

    if($eintragen)
    {

         # Weiterleitung auf die Seite nach erfolgreichem Login
        header('location: anmeldung kaue.html');
        exit(1);
    }
    else
    {
         # Weiterleitung auf die Registrierungsseite ...
       header('location: registrierung kaue.php');
        exit();
    }
 } 
?>
