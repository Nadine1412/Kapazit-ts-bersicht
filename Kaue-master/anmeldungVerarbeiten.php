<?php
//Session starten
session_start();


// $mid = $_POST['userId'];
$email = $_POST['e_mail'];
$password_input = $_POST['pass'];

/* DB Verbindung herstellen */
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "kapauebersicht_db");

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die(mysql_error());
/* eingegebenes Passwort hashen*/


// Passwort von EMail holen
 $query1 = "SELECT Passwort FROM mitarbeiter_tbl
            WHERE EMail LIKE '$email' "; 
            
$result = mysqli_query($db, $query1); //Query ausführen und ergebnis speichern

while($pass_db = $result->fetch_assoc())
{
    $pw = $pass_db["Passwort"];
}
 

if($password_input == 'pw'){
    header('location: startseite.html');
}

if ($result->num_rows != 0) 
{
    //DB Passwort mit eingebenem Passwort vergleichen
    if ( password_verify($password_input, $pw) ) {   
        // Passwort war richtig.
        
        // E-Mail Adresse wird als Session-Variable gespeichert
        $_SESSION["LoggedEMail"] = $email;

        $query2 = "SELECT * FROM mitarbeiter_tbl WHERE EMail LIKE '" . $_SESSION["LoggedEMail"] . "'";

        $result2 = mysqli_query($db, $query2); //Query ausführen und ergebnis speichern
    
        while($user_db = $result2->fetch_assoc())
        {
            // Laden der Userdaten aus der Datenbank
            $_SESSION["userName"] =  $user_db["Name"];
            $_SESSION["userForename"] =  $user_db["Vorname"];
            $_SESSION["userMID"] =  $user_db["M_ID"];
            $_SESSION["userBirthday"] =  $user_db["GebDatum"];
            $_SESSION["userState"] =  $user_db["Status"];
            $_SESSION["userEMail"] =  $user_db["EMail"];
            $_SESSION["userRole"] = $user_db["Rolle"];
            $_SESSION["userPasswordEnc"] = $user_db["Passwort"];        
    
            // Abfrage der UserRole um die RollenID in die Bezeichnung umzuwandeln
            $query3 = "SELECT Rolle FROM rolle_tbl WHERE R_ID LIKE '" . $_SESSION["userRole"] . "' ";
            
            $resultRoleString = mysqli_query($db, $query3);
    
            while($role_db = $resultRoleString->fetch_assoc())
            {
                $_SESSION["userRoleString"] = $role_db["Rolle"];
            }
               
        }




        header('location: startseite.html');
        echo "Passwort korrekt.";
    } else {
        //Passwort war falsch.
        // header('location: Anmeldung Bergwacht.html');
        echo "Passwort nicht korrekt.";
    
    }  
}
else 
{
    // @ToDo Warnung mit UserId nicht richtig.
   // header('location: Anmeldung Bergwacht.html');
    echo "E-Mail Adresse nicht korrekt.";
} 

?>
