<html> <!-- HTML irekiera eta itxiera etiketak gehitu ditut HTML erabiltzen baitda baina  -->
<h1>Produktua eguneratu</h1> <!-- Orriaren izenburua, produktua eguneratzeko funtzionalitatea adierazten du -->

<!-- GET metodoa erabiliz datu berriak sartzeko formularioa -->
<form method="get" action="">
    <label for="izena">Sartu izen berria</label> <!-- Izen berria sartzeko etiketa -->
    <input type="text" name="izena" id="izena" placeholder="Sartu izena" /> <br> <!-- Testu eremua izen berria sartzeko -->
    
    <label for="mota">Sartu mota berria</label> <!-- Mota berria sartzeko etiketa -->
    <input type="text" name="mota" id="mota" /> <br> <!-- Testu eremua mota berria sartzeko -->
    
    <label for="prezioa">Sartu prezio berria</label> <!-- Prezio berria sartzeko etiketa -->
    <input type="text" name="prezioa" id="prezioa" placeholder="Sartu prezioa" /> <br> <!-- Testu eremua prezioa sartzeko -->
    
    <label for="bilaketa">Sartu id-a</label> <!-- Eguneratu nahi den produktuaren IDa sartzeko etiketa -->
    <input type="number" name="bilaketa" id="bilaketa" placeholder="Sartu id-a" /> <br> <!-- Zenbakizko eremua IDa sartzeko -->
    
    <button type="submit">Eguneratu</button> <!-- Eguneratzeko botoia -->
</form>

<?php
// Datubasera konektatzeko parametroak
$zerbitzaria = "localhost"; // Zerbitzariaren helbidea
$erabiltzailea = "root"; // Datubase erabiltzaile izena
$pasahitza = "1MG2024"; // Pasahitza
$datubasea = "entrega4"; // Datubasearen izena

// Aldagaiak inicializatzen dira
$izena = ""; // Izen aldagaia hutsik hasieran
$mota = ""; // Mota aldagaia hutsik hasieran
$prezioa = ""; // Prezioa aldagaia hutsik hasieran
$bilaketa = ""; // Bilaketa (ID) aldagaia hutsik hasieran

// Formularioaren izena eremua bete den konprobatu
if (isset($_GET["izena"]) && !empty($_GET["izena"])) {
    $izena = $_GET["izena"]; // Izena aldagaia eguneratzen da formularioaren datuekin
}

// Formularioaren mota eremua bete den konprobatu
if (isset($_GET["mota"]) && !empty($_GET["mota"])) {
    $mota = $_GET["mota"]; // Mota aldagaia eguneratzen da formularioaren datuekin
}

// Formularioaren prezioa eremua bete den konprobatu
if (isset($_GET["prezioa"]) && !empty($_GET["prezioa"])) {
    $prezioa = $_GET["prezioa"]; // Prezioa aldagaia eguneratzen da formularioaren datuekin
}

// Formularioaren bilaketa (ID) eremua bete den konprobatu
if (isset($_GET["bilaketa"]) && !empty($_GET["bilaketa"])) {
    $bilaketa = $_GET["bilaketa"]; // Bilaketa aldagaia (ID) eguneratzen da formularioaren datuekin
}

// Eremu guztiak bete diren konprobatu
if (!empty($izena) && !empty($mota) && !empty($prezioa) && !empty($bilaketa)) {
    // Datubasera konektatzeko konexio berria sortzen da
    $conn = new mysqli($zerbitzaria, $erabiltzailea, $pasahitza, $datubasea);
    
    // Konexioa huts egin duen konprobatu
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error); // Errore mezua bistaratzen da eta exekuzioa gelditu
    }

    // Produktua eguneratzeko SQL kontsulta prestatzen da
    $sql = "UPDATE entrega4.produktuak SET izena='$izena', mota='$mota', prezioa='$prezioa' WHERE id='$bilaketa'";

    // Kontsulta exekutatu eta emaitza konprobatu
    if ($conn->query($sql) === TRUE) {
        echo "<br>"; // Lerro hautsi bat gehitu pantailan
        echo "Erregistroa ongi eguneratu da"; // Mezua: erregistroa behar bezala eguneratu da
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

