<html>
    <head>
        <!-- Font Awesome ikonoak gehitzeko esteka -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    </head>
</html>
<?php
// Datu-basearen konexiorako parametroak definitu
datubasea = "localhost";
erabiltzailea = "root";
pasahitza = "1MG2024";
bilaketa="";

// Formularioan datuak bete diren konprobatu
if(isset($_GET["bilaketa"]) && !empty($_GET["bilaketa"])) {
    $bilaketa = $_GET["bilaketa"];
}   

// Datu-basearekin konexioa sortu
$conn = new mysqli($datubasea, $erabiltzailea, $pasahitza);

// Konexioa ondo ez badabil, errorea inprimatu
if ($conn->connect_error) {
    die("Konexioak huts egin du: " . $conn->connect_error);
}

// Taularen izenburua erakutsi
echo "<h1>Produktuen taula</h1>";
?>

<?php

// Produktuen informazioa ateratzeko kontsulta sortu
$kontsulta = "SELECT id, izena, mota, prezioa FROM entrega4.produktuak";
// Kontsulta exekutatu eta emaitzak lortu
$emaitza = $conn->query($kontsulta);

// Emaitzak badaude, taula sortu
if ($emaitza->num_rows > 0) {
    // Taularen hasiera definitu
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

    // Taularen amaiera definitu
    echo "</tbody>";
    echo "</table>";

} else {
    // Datuak ez badaude, mezua erakutsi
    echo "Ez dago daturik";
}

// Konexioa itxi
$conn->close();
?>