<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<link rel="Stylesheet" type="text/css" href="bootstrap.css">
<head>
    <title>Produkte löschen</title>
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
                            <li><a href="produktionsverwaltung.php">Produktionsverwaltung</a></li>
                        </ul>
                    </li>
                    <li><a href="Produkte anzeigen.php">Produkte</a>
                        <ul>
                            <li><a href="Produkte anlegen.php">Produkte pflegen</a></li>
                            <li><a href="Produkte loeschen.php">Produkte löschen</a></li>
                        </ul>
                    </li>
                    <li><a href="Werke anzeigen.php">Werk</a>
                        <ul>
                            <li><a href="Werk anlegen.php">Werk pflegen</a></li>
                            <li><a href="Werk loeschen.php">Werk löschen</a></li>
                        </ul>
                    </li>
                    <li><a href="Mitarbeiter kaue.php">Mitarbeiter</a>
                        <ul>
                            <li><a href="Mitarbeiter loeschen.php">Mitarbeiter löschen</a></li>
                        </ul>
                    </li>
                </ul>
                <input type="button" value="Logout" onClick="window.location.href='Anmeldung kaue.html'">
            </div>        
        <section id="container" class="container">
            <br><br><br><br><br><br>
              <center>  <h2>Werk löschen</h2></center> 
               
              <center>  <p>Hier können Sie Werke aus der Datenbank löschen.</p> </center> 
              <form name="werkeloeschenFormular" method="post" action="werke loeschen verarbeiten.php">

              <div style="width:60%;" id="Werkloeschentbl" class="container">

                 <table>
                              <tr>
                                <th>Werk-ID:</th>
                                <th>Löschen:</th>
                              </tr>
                              <?php
                                    /* DB Verbindung herstellen */
                                    define("DB_HOST", "localhost");
                                    define("DB_USER", "root");
                                    define("DB_PASSWORD", "");
                                    define("DB_DATABASE", "kapauebersicht_db");

                                    $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die(mysql_error());

                                    $query1 = "SELECT * FROM werk_tbl";

                                    $result = mysqli_query($db, $query1); //Query ausführen und ergebnis speichern

                                    while($user_db = $result->fetch_assoc())
                                    {
                                        // Laden der Werkdaten aus der Datenbank
                                        $W_id =  $user_db["W_ID"];
                                        echo("
                                        <tr>
                                            <td>$W_id </td>
                                            <td><button type='submit' name='Werkloeschen' value='$W_id'>Löschen</button></td>
                                            </tr>
                                        ");       
                                    }
                                ?>  
                         </table>
                         <p></p>
                         </form>
        </section>

        
</body>
</html>