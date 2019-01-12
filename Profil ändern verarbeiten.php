<?php

//Session starten
session_start();

$vorname = $_POST['vorname'];
$nachname = $_POST['name'];
$birthday = $_POST['birthday'];
$email = $_POST['email'];
$selectedRole = $_POST['roles'];
$state = $_POST['state'];

$_SESSION["userForename"] = $vorname;
$_SESSION["userName"] = $nachname;
$_SESSION["userBirthday"] = $birthday;
$_SESSION["userEMail"] = $email;
$_SESSION["userRoleString"] = $selectedRole;
$_SESSION["userState"] = $state;



$password = $_POST['newpassword'];

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
define("DB_DATABASE", "bergwacht_db");

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die(mysql_error());


// Aus der Datenbank wird zur zugehörigen Rolle die passende Rollen ID herausgesucht, um es später dem Mitarbeiter zuweisen zu können
$query1 = "SELECT R_ID FROM tbl_rolle
WHERE Rolle LIKE '$selectedRole'";

$r_id_result = mysqli_query($db, $query1);

while($r_id_db = $r_id_result->fetch_assoc())
{
$selectedRoleID = $r_id_db["R_ID"];
}

 # Geänderte Daten der Datenbank hinzufügen
$query2="UPDATE tbl_mitglied
         SET 
         Name='$nachname',
         Vorname='$vorname',
         GebDatum='$birthday',
         EMail= '$email',
         Rolle='$selectedRoleID',
         Status= '$state',
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