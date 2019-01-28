<?php

//Session starten
session_start();

// Übergabe der Variablen aus Profil ändern.php
$vorname = $_POST['vorname'];
$nachname = $_POST['name'];
$position = $_POST['position'];
$email = $_POST['email'];
$fachbereich = $_POST['fachbereich'];

// Speichern in Sessionvariablen
$_SESSION["userForename"] = $vorname;
$_SESSION["userName"] = $nachname;
$_SESSION["userEMail"] = $email;
$_SESSION["userFachbereich"] = $fachbereich;
$_SESSION["userPosition"] = $position;

$password = $_POST['newpassword'];

// Passwort wird nur geändert, wenn kein leeres Passwort übergeben wurde
if(empty($password))
{
    $password_encrypt = $_SESSION["userPasswordEnc"];
}
else
{
    $password_encrypt = password_hash($password, PASSWORD_DEFAULT);
}


/* DB Verbindung herstellen */
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "kapauebersicht_db");

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die(mysql_error());


 # Geänderte Daten der Datenbank hinzufügen
$query2="UPDATE mitarbeiter_tbl
         SET 
         Nachname='$nachname',
         Vorname='$vorname',
         EMail= '$email',
         Position='$position',
         Fachbereich= '$fachbereich',
         Passwort='$password_encrypt'
         WHERE M_ID LIKE '" . $_SESSION["userMID"] . "'";
$eintragen = mysqli_query($db, $query2);

if($eintragen)
{
     # Weiterleitung auf die Profil anzeigen Seite;
    header('location: Profil anzeigen.php');
    exit(1);

}
else
{
     # Weiterleitung auf die Profil ändern Seite
   header('location: Profil ändern.php');
    exit();
}

?>