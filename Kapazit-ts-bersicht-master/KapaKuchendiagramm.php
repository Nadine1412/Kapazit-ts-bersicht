<?php
    // Session starten
    session_start();

    /* DB Verbindung herstellen */
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASSWORD", "");
    define("DB_DATABASE", "kapauebersicht_db");

    $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die(mysql_error());
?>

<!-- Funktion, die durch Auswahl in der Dropdown-Liste aufgerufen wird -->
<script>
    function changeWerk() {
        // Button klick wird ausgeführt
        var subButton =  document.getElementById("button1");
        subButton.click();
    }
</script>


<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
<link rel="Stylesheet" type="text/css" href="bootstrap.css">
<link rel="Stylesheet" type="text/css" href="style.css">

<head>
    <title>Kapazitätsübersicht</title>
</head>
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
        <center>
            <h1>Bedarfs- und Kapazitätsabgleich</h1>
            <div style="margin-top:60px">Bitte wählen Sie ein Werk aus:</div>
        </center>
        <p></p>
    
        <p></p>
        <form name="kapaKuchenVerarbeitenFormular" method="post" action="KapaKuchenDiagrammVerarbeiten.php">

            <div style="width:20%;" class="container">
                <select name="werkID" class="form-control" onchange="changeWerk();">
                            <?php

                                // Auslesen aller vorhandenen Werk-ID aus der Datenbank
                                $query1 = "SELECT W_ID FROM werk_tbl"; 

                                //Query ausführen und ergebnis speichern
                                $result = mysqli_query($db, $query1); 

                                while($werk_db = $result->fetch_assoc())
                                {
                                    $w_id =  $werk_db["W_ID"];

                                    // Ausgabe jeder einzelnen Werks ID für Dropdownliste (select)
                                    if($w_id == $_SESSION["w_id"])
                                    {
                                        echo "<option value=$w_id selected> $w_id </option>";
                                    }
                                    else
                                    {
                                        echo "<option value=$w_id> $w_id </option>";
                                    }
                                }
                            ?>
                </select>
            </div>
            
            <!-- unsichtbarer Button, der durch Dropdown-Auswahl im Script (changeWerk()) gedrückt wird -->
            <input  style="visibility:hidden" type="submit" class="button"  name="selectedWID" id="button1" />
        </form>
        <div style="width:60%;" class="container">
            <canvas id="myChart" width="450" height="200"></canvas>
            <script>
                var ctx = document.getElementById("myChart");
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                    
                    labels: ["Kapazitaet","Auslastung"],
                        datasets: [{
                            label: "Kapazitaet",
                            data: [<?php echo( $_SESSION["kapazitaet"]) ?>, <?php echo( $_SESSION["kapadiv"]) ?>],

                            backgroundColor: [
                                'rgba(102, 255, 132, 0.6)',
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(255, 206, 86, 0.6)',
                                'rgba(75, 192, 192, 0.6)',
                                'rgba(153, 102, 255, 0.6)',
                                'rgba(255, 159, 64, 0.6)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,2)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ]
                        }]
                    },ons: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });

                </script>

        <br><br>
        
        <br><br><br><br><br><br><br><br>
    </section>
</body>

</html>
