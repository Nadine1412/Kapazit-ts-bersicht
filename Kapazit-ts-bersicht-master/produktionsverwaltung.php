<!-- Ist die Produktionsverwaltung! -->

<?php
    /* DB Verbindung herstellen */
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASSWORD", "");
    define("DB_DATABASE", "kapauebersicht_db");

    $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die(mysql_error());

?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
<link rel="Stylesheet" type="text/css" href="bootstrap.css">
<link rel="Stylesheet" type="text/css" href="style.css">

<head>
    <title>Kapazitätsübersicht Weltweit</title>
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
                    <li><a href="KapaKuchendiagramm.php">Produktionsübersicht</a></li>
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

    <section id="charts" class="charts">
        
        <br><br><br><br><br><br>
        <div class="container">
         <div class="row">
         <div class="col-md-6">
      
          <h2>Produktionsverwaltung</h2>
            
            <p>Hier können Sie ein Produkt einem Werk zuweisen.</p>
        </div>
        <div class="col-md-6">
         
         <form name="Produktionszuweisung" method="post" action="produktionsverwaltungVerarbeiten.php">
             <div class="row">
                 <div class="col-md-7">
                    Produkt-ID:
                    
                    <select name="produktID" class="form-control">
                        <?php

                             // Auslesen aller vorhandenen Produkt-ID aus der Datenbank
                             $query2 = "SELECT P_ID FROM produkt_tbl"; 

                             $result = mysqli_query($db, $query2); //Query ausführen und ergebnis speichern
 
                             while($produkt_db = $result->fetch_assoc())
                             {
                                 $p_id =  $produkt_db["P_ID"];
                                 // Ausgabe jeder einzelnen Rolle für Dropdownliste (select)
                                 echo "<option value=$p_id> $p_id </option>";
                             }
                        ?>
                    </select>

                     Werk-ID:
                     <select name="werkID" class="form-control">
                        <?php

                            // Auslesen aller vorhandenen Werk-ID aus der Datenbank
                            $query1 = "SELECT W_ID FROM werk_tbl"; 

                            $result = mysqli_query($db, $query1); //Query ausführen und ergebnis speichern

                            while($werk_db = $result->fetch_assoc())
                            {
                                $w_id =  $werk_db["W_ID"];
                                // Ausgabe jeder einzelnen Rolle für Dropdownliste (select)
                                echo "<option value=$w_id> $w_id </option>";
                            }
                        ?>
                    </select>
                </div>
                        </div>
            <div class="row">        
                <div class="col-md-7">
                    Anzahl-Produkte:
                    <input type="text" name = "pAnzahl" class="form-control" required>
                    Zuweisungsdatum:
                    <input type="date" name = "planungsdatum" class="form-control" required>
                    Quartal:
                    <select name="quartal" class="form-control">
                         <option value="01/19">01/19</option>
                         <option value="02/19">02/19</option>
                         <option value="03/19">03/19</option>
                         <option value="04/19">04/19</option>
                    </select>
                        
                  </div>
             </div>
             
                 <p></p>
             <button type="submit">Produkte zuweisen</button>
             </form>
                        </div> 
         </div>
     </div>
        <br><br>
    </section>


</body>

</html>
