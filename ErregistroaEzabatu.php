<html> <!-- HTML irekiera eta itxiera etiketak gehitu ditut HTML erabiltzen baitda baina  -->
<h1>Produktua Ezabatu</h1> <!-- Orriaren izenburua, produktua ezabatzeko funtzionalitateari dagokiona -->

<!-- GET metodoa erabiliz id bat sartzeko formularioa -->
<form method="get" action="">
    <label for="bilaketa">Sartu id-a</label> <!-- Produktuaren id-a sartzeko etiketa -->
    <input type="number" name="bilaketa" id="bilaketa" /> <!-- Zenbakizko sarrera, id-a sartzeko -->
    <button>Ezabatu</button> <!-- Ezabatzeko botoia -->
</form>

<?php
// Datubasera konektatzeko parametroak
$zerbitzaria = "localhost"; // Zerbitzariaren helbidea
$erabiltzailea = "root"; // Datubase erabiltzaile izena
$pasahitza = "1MG2024"; // Pasahitza
$datubasea = "entrega4"; // Datubasearen izena

$bilaketa = ""; // Bilaketa aldagaia hasieran hutsik

// Formularioan id-a (bilaketa) bidali den eta hutsa ez den konprobatu
if (isset($_GET["bilaketa"]) && !empty($_GET["bilaketa"])) {
    $bilaketa = $_GET["bilaketa"]; // Bilaketa aldagaia formularioaren balioarekin eguneratzen da

    // Datubasera konektatzeko konexio berria sortzen da
    $conn = new mysqli($zerbitzaria, $erabiltzailea, $pasahitza, $datubasea);

    // Konexioak huts egin duen konprobatu
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error); // Errore mezua bistaratzen da eta exekuzioa gelditu
    }

    // Produktua ezabatzeko SQL kontsulta prestatzen da
    $sql = "DELETE FROM entrega4.produktuak WHERE id='$bilaketa'";

    // Kontsulta exekutatu eta emaitza konprobatu
    if ($conn->query($sql) === TRUE) {
        echo "<br>"; // Lerro hautsi bat gehitu pantailan
        echo "Erregistroa ongi ezabatu da"; // Mezua: erregistroa behar bezala ezabatu da
    } else {
        echo "Error: " . $conn->error; // Errore mezua bistaratzen da, SQL arazo bat egon bada
    }

    // Datubase konexioa ixten da
    $conn->close();
}
?>
<br>
<!-- Produktuen taula ikusteko lotura -->
<a href="TablaErakutsi.php">Aldaketak ikusi taulan</a>
</html>
