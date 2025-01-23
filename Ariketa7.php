<html>
<h1>Produktua Ezabatu</h1>

<!-- GET metodoa erabiliz id bat sartzeko formularioa -->
<form method="get" action="">
    <label for="bilaketa">Sartu id-a</label> <!-- Produktuaren id-a sartzeko etiketa -->
    <input type="number" name="bilaketa" id="bilaketa" /> <!-- Zenbakizko sarrera, id-a sartzeko -->
    <button>Ezabatu</button> <!-- Ezabatzeko botoia -->
</form>

<?php
// Datubasera konektatzeko parametroak
$zerbitzaria = "localhost";
$erabiltzailea = "root";
$pasahitza = "1MG2024";
$datubasea = "entrega4";

$bilaketa = ""; 

// Formularioan id-a  bidali den konprobatu
if (isset($_GET["bilaketa"]) && !empty($_GET["bilaketa"])) {
    $bilaketa = $_GET["bilaketa"];

    // Datubasera konektatzeko konexio berria sortzen da
    $conn = new mysqli($zerbitzaria, $erabiltzailea, $pasahitza, $datubasea);

    // Konexioak huts egin duen konprobatu
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error); 
    }

    // Produktua ezabatzeko SQL kontsulta
    $sql = "DELETE FROM entrega4.produktuak WHERE id='$bilaketa'";

    // Kontsulta exekutatu eta emaitza konprobatu
    if ($conn->query($sql) === TRUE) {
        echo "<br>";
        echo "Erregistroa ongi ezabatu da";
    } else {
        echo "Error: " . $conn->error; //SQL kontsultan arazo bat egon dela bistaratzen du
    }

    // Datubase konexioa ixten da
    $conn->close();
}
?>
<br>
<!-- Produktuen taula ikusteko lotura -->
<a href="TablaErakutsi.php">Aldaketak ikusi taulan</a>
</html>
