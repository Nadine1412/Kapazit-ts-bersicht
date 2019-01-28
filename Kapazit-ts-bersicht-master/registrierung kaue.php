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
                <label>E-Mail :*</label>
                <div class="row">
                    <div class="col-md-7">
                        <input type="email" name = "email" class="form-control">
                    </div>
                </div>
                <label>Position :*</label>
                <div class="row">
                    <div class="col-md-7">
                        <input type="text" name = "position" class="form-control" required>
                    </div>
                </div>                 
                <label>Fachbereich :*</label>
                <div class="row">
                    <div class="col-md-7">
                        <input type="text" name = "fachbereich" class="form-control" required>
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
