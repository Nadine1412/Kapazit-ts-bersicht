<?php
//Session starten
                session_start();
?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>

<link rel="Stylesheet" type="text/css" href="bootstrap.css">

<head>
    <title>Mitarbeiter Kaue löschen</title>
    <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }
            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }
            
            tr:nth-child(even) {
                background-color: #dddddd;
            }
            .navbar{
            width: 100%;
            background-color:#717374;
            z-index: 10;

        }

        .Startseite{
            color: white;
            margin-top: 250px;
        }

        ul{
            text-align: left;
            display: inline;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        ul li{
            font: bold 12px/18px sans-serif;
            display: inline-block;
            position:relative;
            padding: 25px 20px;
            background: #555758;

        }
        ul li a{
            text-decoration: none;
            padding: 25px 20px;
            color:white;
            font-size: 18px;
        }          
        ul li:hover{
            background: #afb2b3;
            color:white;
        }
        ul li ul{
            padding: 0;
            position: absolute;
            top: 70px;
            left:0;
            width:250px;
            display:none;
            visibility:hidden;
        }

        ul li ul li{
            background: #9fa1a1;
            display: block;
        }
        ul li ul li:hover{
            background: #c4cbcc;

        }
        ul li:hover ul{
            display: block;
            opacity: 1;
            visibility: visible;
        }
        ul ul ul li{
            display: none;
        }
        ul ul li:hover li{
            display: block;
        }
        ul ul ul{
            left:100;
        }
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }
            
            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }
            
            tr:nth-child(even) {
                background-color: #dddddd;
            }

            body{
                color: rgba(255, 255, 255, 0.16);
                position: relative;
                background: url("landscape-615429_1920.jpg") ;
                background-size:cover;     
            }
            .container{
                color: rgb(255, 255, 255);
                z-index: 1;
            }  
    </style>
</head>
<body>
        <div class="navbar">
                <ul>
                    <li><a class="active" href="startseite.html">Home</a></li>
                    <li><a href="Profil anzeigen.php">Profil</a>
                        <ul>
                            <li><a href="Profil anzeigen.php">Profil anzeigen</a></li>
                            <li><a href="Profil ändern.php">Profil ändern</a></li>
                        </ul>
                    </li>
                    <li><a href="Produktionsdaten.php">Produktionsdaten</a>
                        <ul>
                            <li><a href="entscheidung1.html">Produktionsübersicht</a></li>
                            <li><a href="entscheidung2.html">Produktionsverwaltung</a></li>
                        </ul>
                    </li>
                    <li><a href="Produkte anzeigen.php">Produkte</a>
                        <ul>
                            <li><a href="Produkte anlegen.php">Produkte pflegen</a></li>
                            <li><a href="Produkte loeschen.php">Produkte löschen</a></li>
                        </ul>
                    </li>
                    <li><a href="Mitarbeiter kaue.php">Mitarbeiter</a></li>
                    <ul>
                        <li><a href="Mitarbeiter loeschen.php">Mitarbeiter löschen</a></li>
                    </ul>
                </ul>
                <input type="button" value="Logout" onClick="window.location.href='Anmeldung kaue.html'">
            </div>     
            <section id="container" class="container">
            <br><br><br><br><br><br>

            <center><h2>Mitarbeiter</h2></center>
            <p></p>
            <form name="mitarbeiterloeschenFormular" method="post" action="mitarbeiter loeschen verarbeiten.php">
            <div style="width:60%;" id="Mitarbeiterloeschentbl"class="container">
                    
                            <body>
                                                        
                            <table>
                              <tr>
                                <th>M_ID</th>
                                <th>Name</th>
                                <th>Vorname</th>
                                <th>GebDatum</th>
                                <th>EMail</th>
                                <th>Rolle</th>
                                <th>Status</th>
                                <th>Daten löschen</th>
                              </tr>
                                     <?php
                                        /* DB Verbindung herstellen */
                                        define("DB_HOST", "localhost");
                                        define("DB_USER", "root");
                                        define("DB_PASSWORD", "");
                                        define("DB_DATABASE", "kapauebersicht_db");

                                        $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die(mysql_error());

                                        $query1 = "SELECT * FROM mitarbeiter_tbl";

                                        $result = mysqli_query($db, $query1); //Query ausführen und ergebnis speichern

                                        while($user_db = $result->fetch_assoc())
                                        {
                                            // Laden der Mitarbeiter Daten aus der Datenbank
                                            $mID =  $user_db["M_ID"];
                                            $name =  $user_db["Name"];
                                            $forename =  $user_db["Vorname"];
                                            $birthday =  $user_db["GebDatum"];
                                            $state =  $user_db["Status"];
                                            $eMail =  $user_db["EMail"];
                                            $role = $user_db["Rolle"];

                                            // Abfrage der UserRole um die RollenID in die Bezeichnung umzuwandeln
                                            $query2 = "SELECT Rolle FROM tbl_rolle WHERE R_ID LIKE '$role' ";
                                            
                                            $resultRoleString = mysqli_query($db, $query2);

                                            while($role_db = $resultRoleString->fetch_assoc())
                                            {
                                                $roleString = $role_db["Rolle"];
                                            }   
                                            echo( 
                                            "
                                            <tr> 
                                                <td>$mID</td> 
                                                <td>$name</td>
                                                <td>$forename</td>
                                                <td>$birthday</td>
                                                <td>$eMail</td>
                                                <td>$roleString</td>
                                                <td>$state</td>
                                                <td><button type='submit' name='Mitarbeiterloeschenbtn' value='$mID'>Löschen</button></td>
                                            </tr>");
                                        }
                                        
                                    ?>

                            </table>
                </div>
                </form>
            <div style="width:60%;" id="KeinAdmin"class="container">
                Sie haben keine Admin-Rechte und können keine Mitglieder löschen.
            </div>
        <script type="text/javascript">
           var rolle = "<?php echo($_SESSION['userRoleString']);?>";
           var table = document.getElementById("Mitarbeiterloeschentbl");
           var unauthorised = document.getElementById("KeinAdmin");

           if(rolle == "Anwaerter" || rolle == "Ausbilder") //Abteilungsleiter //Sachbearbeiter
           {
                table.hidden=false;
                unauthorised.hidden=true;
           }
           else
           {
                table.hidden=true;
                unauthorised.hidden=false;
           }
        </script>
                <br><br>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                </section>
    </body>
</html>