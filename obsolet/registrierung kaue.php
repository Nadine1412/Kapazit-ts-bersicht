<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<link rel="Stylesheet" type="text/css" href="bootstrap.css">
<link rel="Stylesheet" type="text/css" href="style.css">
<head>
        <title>Registrierung</title>
    </head>
        <body>
            <section id="contact" class="contact">
            <br><br><br><br><br><br>
            <div class="container">
            <div class="row">
            <div class="col-md-6">
                <h2>Registrierung</h2>
               
                <p>Für die Nutzung der Kapazitätsübersicht ist eine Registrierung erforderlich, geben Sie hierfür Ihre Daten im nebenstehenden Formular ein.</p>
            </div>
            <div class="col-md-6">
                <form name="registrierungFormular" method="post" action="registrierungVerarbeiten.php">
                <legend>Daten eingeben</legend>
                <label>Name :*</label>
                <div class="row">
                    <div class="col-md-7">
                        <input type="text" name = "name" class="form-control" required>
                    </div>
                </div>
                <label>Vorname :*</label>
                <div class="row">
                    <div class="col-md-7">
                        <input type="text" name = "vorname" class="form-control" required>
                    </div>
                </div>
                <label>Geburtsdatum :*</label>
                <div class="row">
                    <div class="col-md-7">
                        <input type="date" name = "birthday" class="form-control">
                    </div>
                </div>
                <label>E-Mail :*</label>
                <div class="row">
                    <div class="col-md-7">
                        <input type="email" name = "email" class="form-control">
                    </div>
                </div>
                <label>Rolle :*</label>
                <div class="row">
                    <div class="col-md-7">
                        <select name="roles" class="form-control">
                            <?php
                                /* DB Verbindung herstellen */
                                define("DB_HOST", "localhost");
                                define("DB_USER", "root");
                                define("DB_PASSWORD", "");
                                define("DB_DATABASE", "bergwacht_db");

                                $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die(mysql_error());

                                // Auslesen aller vorhandenen Rollen aus der Datenbank
                                $query1 = "SELECT Rolle FROM tbl_rolle"; 

                                $result = mysqli_query($db, $query1); //Query ausführen und ergebnis speichern

                                while($roles_db = $result->fetch_assoc())
                                {
                                    $role =  $roles_db["Rolle"];
                                    // Ausgabe jeder einzelnen Rolle für Dropdownliste (select)
                                    echo "<option value=$role> $role </option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <label>Status :*</label>
                <div class="row">
                    <div class="col-md-7">
                    <select name="state" class="form-control">
                        <option value="aktiv">aktiv</option>
                        <option value="passiv">passiv</option>
                        </select>
                    </div>
                </div>
                <label>Passwort :*</label>
                <div class="row">
                    <div class="col-md-7">
                        <input type="password" name = "password" class="form-control" required>
                    </div>
                </div>
                <p></p>
                    <button type="submit">Registrieren</button>
                    <p></p>
                </form>
            </div>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br>
        </section>
        </body>
</html>
