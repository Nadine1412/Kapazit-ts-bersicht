<?php
/* DB Verbindung herstellen */
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "kapauebersicht_db");

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die(mysql_error());

//Abfrage
$query = "SELECT Kapazität FROM Werk_tbl";

//das Ergebnis von der Abfrage ablegen 
$result = $conn->query($query);

//Array initialisiern um die verarbeiteten Daten abzulegen
$jsonArray = array();

//Überprüfen ob Daten von der Sql Abfrag zurückgeworfen wurden
if ($result->num_rows > 0) {
  //Ergebnisse in associatives array umwandeln
  while($row = $result->fetch_assoc()) {
    $jsonArrayItem = array();
    $jsonArrayItem['label'] = $row['Kapazität'];
    $jsonArrayItem['value'] = $row['Kapazität'];
    //Anhängen der oben erzeugten Objekte in den main array.
    array_push($jsonArray, $jsonArrayItem);
  }
}

//DB Verbindung schließen
$conn->close();

//Rückagabe als JSON definieren
header('Content-type: application/json');
//Output vom return value als json encode mit der "echo" Funktion. 
echo json_encode($jsonArray);
?>
