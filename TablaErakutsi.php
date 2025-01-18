<html>
    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    </head>
<?php
// Datubasera konektatzeko informazioa definitzen da
$datubasea = "localhost"; // Datubase zerbitzariaren helbidea
$erabiltzailea = "root"; // Erabiltzaile izena
$pasahitza = "1MG2024"; // Pasahitza
$bilaketa = ""; // Bilaketa balio lehenetsia hutsik uzten da

// Bilaketa parametroa GET bidez bidali bada eta hutsa ez bada, aldagaia eguneratzen da
if (isset($_GET["bilaketa"]) && !empty($_GET["bilaketa"])) {
    $bilaketa = $_GET["bilaketa"]; // Bilaketa aldagaia formularioaren balioarekin betetzen da
}

// Datubase konexioa sortzen da mysqli erabiliz
$conn = new mysqli($datubasea, $erabiltzailea, $pasahitza);

// Konexioa huts egin badu, errore mezua erakutsi eta exekuzioa gelditu
if ($conn->connect_error) {
    die("Konexioak huts egin du: " . $conn->connect_error); // Errore mezua eta arrazoi teknikoa bistaratzen da
}

// Produktuen taula izenburua pantailaratzen da
echo "<h1>Produktuen taula</h1>";
?>
<!-- GET metodoa erabiliz bilaketa formularioa sortzen da -->
<form method="get" action="">
    <label for="bilaketa">Filtratu</label> <!-- Bilaketa eremuarentzako etiketa -->
    <input type="text" name="bilaketa" id="bilaketa"/> <!-- Testu sarrera bilaketarako -->
    <button>Bilatu</button> <!-- Bilaketa bidaltzeko botoia -->
</form>
<?php
// Produktuen datuak eskuratzeko SQL kontsulta prestatzen da
$kontsulta = "SELECT id, izena, mota, prezioa FROM entrega4.produktuak"; 
$emaitza = $conn->query($kontsulta); // SQL kontsulta exekutatu eta emaitzak lortu

// Emaitzak badira, taula bat sortzen da
if ($emaitza->num_rows > 0) {
    // HTML taularen hasiera sortzen da
    echo "<table border='1' cellspacing='0' cellpadding='10'>"; // Taula formateatzeko atributuak
    echo "<thead>";
    echo "<tr>"; // Taularen goiburuko errenkada
    echo "<th>Id</th>"; // Id zutabea
    echo "<th>Izena</th>"; // Izena zutabea
    echo "<th>Mota</th>"; // Mota zutabea
    echo "<th>Prezioa</th>"; // Prezioa zutabea
    echo "<th>Aukerak</th>"; // Aukera batzuk egiteko zutabea
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>"; // Taularen gorputza

    // Taulako errenkada bakoitza iteratzen da
    while ($row = $emaitza->fetch_assoc()) {
        // Bilaketaren balioarekin bat datozen errenkadak soilik erakutsi
        if (str_contains($row["izena"], $bilaketa) || str_contains($row["mota"], $bilaketa)) {
            echo "<tr>"; // Errenkada berria
            echo "<td>" . htmlspecialchars($row['id']) . "</td>"; // Id balioa erakutsi
            echo "<td>" . htmlspecialchars($row['izena']) . "</td>"; // Izena balioa erakutsi
            echo "<td>" . htmlspecialchars($row['mota']) . "</td>"; // Mota balioa erakutsi
            echo "<td>" . htmlspecialchars(number_format($row['prezioa'], 2)) . " €</td>"; // Prezioa formateatu eta erakutsi
            echo "<td><a href='ErregistroaEzabatu.php' class='add-action'><i class='fas fa-trash'></i>Ezabatu</a> <br> <a href='ErregistroaEguneratu.php' class='add-action'><i class='fas fa-pencil'></i>Eguneratu</a></td>"; // Ezabatu eta eguneratu loturak
            echo "</tr>";
        }
    }

    echo "</tbody>"; // Taularen gorputza itxi
    echo "</table>"; // Taula amaiera

    // Produktu berria gehitzeko lotura gehitu
    echo "<div style='margin-top: 20px;'>";
    echo "<a href='ErregistroaGehitu.php' class='add-action'><i class='fas fa-plus'></i>Produktua Gehitu</a>";
    echo "</div>";
} else {
    // Ez badago emaitzarik, mezu bat bistaratzen da
    echo "Ez dago daturik";
}

// Datubase konexioa ixten da
$conn->close();
?>
<br>
</html>
