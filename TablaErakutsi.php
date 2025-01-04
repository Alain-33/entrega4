<html>
    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    </head>
</html>
<?php
$datubasea = "localhost";
$erabiltzailea = "root";
$pasahitza = "1MG2024";
$bilaketa="";
// Formularioan datuak bete diren konprobatu
if(isset($_GET["bilaketa"]) && !empty($_GET["bilaketa"])) {
    $bilaketa = $_GET["bilaketa"];
}   


// Konexioa sortu
$conn = new mysqli($datubasea, $erabiltzailea, $pasahitza);

// Konexioaren konprobaketa
if ($conn->connect_error) {
    die("Konexioak huts egin du: " . $conn->connect_error);
}
echo "<h1>Produktuen taula</h1>";
?>
<form method="get" action="">
    <label for="bilaketa">Filtratu</label>
    <input type="text" name="bilaketa" id="bilaketa"/>
    <button>Bilatu</button>

</form>
<?php

$kontsulta = "SELECT id, izena, mota, prezioa FROM entrega4.produktuak";
$emaitza = $conn->query($kontsulta);

if ($emaitza->num_rows > 0) {
    // Linea bakoitzeko datuak inprimatu
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
    echo "<tbody>";;
    
    
    // Base datuarekin erlazionatuta dagoen taula egin
    while ($row = $emaitza->fetch_assoc()) {
        if (str_contains($row["izena"], $bilaketa) || str_contains($row["mota"], $bilaketa)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['izena']) . "</td>";
            echo "<td>" . htmlspecialchars($row['mota']) . "</td>";
            echo "<td>" . htmlspecialchars(number_format($row['prezioa'],2)) . " €</td>";
            echo "<td><a href='ErregistroaEzabatu.php' class='add-action'><i class='fas fa-trash'></i>Ezabatu</a> <br> <a href='ErregistroaEguneratu.php' class='add-action'><i class='fas fa-pencil'></i>Eguneratu</a></td>";
            echo "</tr>";
            
        }
           
        
    }
    echo "</tbody>";
    echo "</table>";

    echo "<div style='margin-top: 20px;'>";
    echo "<a href='ErregistroaGehitu.php' class='add-action'><i class='fas fa-plus'></i>Produktua Gehitu</a>";
    echo "</div>";

    

} else {
    echo "Ez dago daturik";
}
// Konexioa itxi
$conn->close();
?>
<br>
