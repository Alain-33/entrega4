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


          // Taulako zutabe bakoitza betetzen da
          if ($row = $emaitza->fetch_assoc()) {
            if (str_contains($row["izena"], $bilaketa) || str_contains($row["mota"], $bilaketa)) {
                echo "<tr>"; // Errenkada berria
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['izena']) . "</td>";
                echo "<td>" . htmlspecialchars($row['mota']) . "</td>";
                echo "<td>" . htmlspecialchars(number_format($row['prezioa'], 2)) . " €</td>";
                echo "<td><a href='ErregistroaEzabatu.php' class='add-action'><i class='fas fa-trash'></i>Ezabatu</a> <br> <a href='ErregistroaEguneratu.php' class='add-action'><i class='fas fa-pencil'></i>Eguneratu</a></td>"; // Ezabatu eta eguneratu loturak
                echo "</tr>";
            }
        }
    