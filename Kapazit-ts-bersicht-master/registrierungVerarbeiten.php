<?php
require 'C:\xampp\htdocs\Kapazit-ts-bersicht\EmailValidator.php';


$vorname = $_POST['vorname'];
$nachname = $_POST['name'];
$fachbereich = $_POST['fachbereich'];
$position = $_POST['position'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_encrypt = password_hash($password, PASSWORD_DEFAULT);

/* DB Verbindung herstellen */
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "kapauebersicht_db");

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die(mysql_error());

// Überpruefen ob der Mitarbeiter bereits vorhanden ist
 $query1 = "SELECT EMail FROM mitarbeiter_tbl
            WHERE EMail LIKE '$email'"; 
                //    OR mid LIKE '$maid' AND vorname LIKE '$vorname' AND name LIKE '$nachname'"; 
 $check = mysqli_query($db, $query1); //Query ausführen und ergebnis speichern
 $result = mysqli_num_rows($check); //Prüfen ob Eintrag bereits vorhanden

//  // EmailValidator
// $emailValidate = new EmailValidator();
// $checkEmail = $emailValidate->is_validate($email);
// if($checkEmail){

 if ($result) {
     # Mitarbeiter bereits vorhanden
   // @ToDo Ausgabe, dass Mitarbeiter bereits vorhanden ist.
    echo "Email bereits vorhanden";
    exit();
} else {

     # Mitarbeiter hinzufügen
    $query3="INSERT INTO mitarbeiter_tbl
             SET 
             Nachname='$nachname',
             Vorname='$vorname',
             Position='$position',
             EMail= '$email',
             Fachbereich='$fachbereich',
             Passwort='$password_encrypt';";
    $eintragen = mysqli_query($db, $query3);

    if($eintragen)
    {

         # weiterleitung auf die seite nach erfolgreichem login
        #header('location: Anmeldung kaue.html');
        header('location: anmeldung kaue.html');
        exit(1);
    }
    else
    {
         # weiterleitung auf die Registrierungsseite ...
       header('location: registrierung kaue.php');
        exit();
    }
 } 
// } else{
//     echo "E-Mail nicht gültig!";
// }
?>
