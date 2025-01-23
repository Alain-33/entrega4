<h1>Produktua Ezabatu</h1>

<!-- Formularioa erabiltzaileari id bat sartzeko eskaintzen du -->
<form method="get" action="">
    <label for="bilaketa">Sartu id-a</label> <!-- Erabiltzaileari id bat sartzeko eskatzen du -->
    <input type="number" name="bilaketa" id="bilaketa" /> <!-- Id-a sartzeko sarrera -->
    <button>Ezabatu</button> <!-- Botoia, formularioa bidaltzeko -->
</form>

<?php
// Datu basearekin konektatzeko informazioa
$zerbitzaria = "localhost"; // Zerbitzariaren helbidea
$erabiltzailea = "root"; // Datu basearen erabiltzailea
$pasahitza = "1MG2024"; // Datu basearen pasahitza
$datubasea = "entrega4"; // Datu basearen izena

$bilaketa = ""; // Bilaketa egiteko id-a gordetzeko aldagai bat

// Formularioa bidali dela eta id-a sartu dela egiaztatzen da
if (isset($_GET["bilaketa"]) && !empty($_GET["bilaketa"])) {
    // Erabiltzaileak sartutako id-a jasotzen da
    $bilaketa = (int)$_GET["bilaketa"]; // Id-a zenbakizkoa behar da

    // Datu basearekin konektatu
    $conn = new mysqli($zerbitzaria, $erabiltzailea, $pasahitza, $datubasea);

    // Konexioa egokia izan den ala ez egiaztatzen da
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error); // Konexioa ez badago, errore mezu bat erakutsi eta script-a gelditu
    }

    // SQL kontsulta prestatzen da: produktu bat ezabatzeko
    $bilaketa = $conn->real_escape_string($bilaketa); // SQL injezioaren aurkako babes

    // SQL kontsulta exekutatzen da eta emaitzaren arabera mezu bat erakusten da
    $sql = "DELETE FROM entrega4.produktuak WHERE id='$bilaketa'"; // Id-a duen produktua ezabatzeko SQL kontsulta

    // SQL kontsulta exekutatzen da
    if ($conn->query($sql) === TRUE) {
        echo "<br>";
        echo "Erregistroa ongi ezabatu da"; // Produktua ongi ezabatuta izan bada
    } else {
        echo "Error: " . $conn->error; // Kontsulta exekutatzean errore bat gertatuz gero, errore mezua erakutsi
    }

    // Datu basearekin egindako konexioa itxi
    $conn->close();
}
?>
<br>
<!-- Esteka bat sortzen da aldaketak ikusi ahal izateko -->
<a href="TablaErakutsi7.php">Aldaketak ikusi taulan</a>

