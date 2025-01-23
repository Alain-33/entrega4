<html>
    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    </head>
<?php
// Datubasera konektatzeko beharreko datuak sartzen dira
$datubasea = "localhost";
$erabiltzailea = "root";
$pasahitza = "1MG2024";
$bilaketa = "";


if (isset($_GET["bilaketa"]) && !empty($_GET["bilaketa"])) {
    $bilaketa = $_GET["bilaketa"]; // Bilaketa existituz gero balorea datu horrekin beteko du.
}

// Goian sartutako parametroekin datu basera konektatzen da
$conn = new mysqli($datubasea, $erabiltzailea, $pasahitza);

if ($conn->connect_error) {
    die("Konexioak huts egin du: " . $conn->connect_error); // Konexioa gaizki joanez gero aterako den errore mezua
}

echo "<h1>Produktuen taula</h1>";
?>
<!-- GET metodoa erabiliz bilaketa formularioa sortzen da -->
<form method="get" action="">
    <label for="bilaketa">Filtratu</label>
    <input type="text" name="bilaketa" id="bilaketa"/>
    <button>Bilatu</button>
</form>
<?php

// SQL select kontsulta
$kontsulta = "SELECT id, izena, mota, prezioa FROM entrega4.produktuak"; 
$emaitza = $conn->query($kontsulta);

// Taula bat sortzen da
if ($emaitza->num_rows > 0) {
    echo "<table border='1' cellspacing='0' cellpadding='10'>";
    echo "<thead>";
    echo "<tr>"; 
    echo "<th>Id</th>"; 
    echo "<th>Izena</th>";
    echo "<th>Mota</th>"; 
    echo "<th>Prezioa</th>";
    echo "<th>Aukerak</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
}