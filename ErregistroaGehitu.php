<html> <!-- HTML irekiera eta itxiera etiketak gehitu ditut HTML erabiltzen baitda baina  -->
<h1>Produktua Gehitu</h1> <!-- Orriaren izenburua bistaratzen da -->

<!-- Formulario bat sortzen da GET metodoarekin, datuak bidaltzeko -->
<form method="get" action="">
    <label for="izena">Izena</label> <!-- Produktuaren izena sartzeko etiketa -->
    <input type="text" name="izena" id="izena" placeholder="Sartu izena" /> <br> <!-- Testu eremua izena sartzeko -->
    
    <label for="mota">Mota</label> <!-- Produktuaren mota sartzeko etiketa -->
    <input type="text" name="mota" id="mota" placeholder="Sartu mota" /> <br> <!-- Testu eremua mota sartzeko -->
    
    <label for="prezioa">Prezioa</label> <!-- Produktuaren prezioa sartzeko etiketa -->
    <input type="text" name="prezioa" id="prezioa" placeholder="Sartu prezioa" /> <br> <!-- Testu eremua prezioa sartzeko -->
    
    <button type="submit">Gehitu</button> <!-- Formularioa bidaltzeko botoia -->
</form>

<?php 
// Datubasera konektatzeko beharrezko parametroak definitzen dira
$zerbitzaria = "localhost"; // Zerbitzariaren helbidea
$erabiltzailea = "root"; // Datubase erabiltzaile izena
$pasahitza = "1MG2024"; // Pasahitza
$datubasea = "entrega4"; // Datubasearen izena

// Bariableak inicializatzen dira
$izena = "";  // Izena aldagaia hasieran hutsik
$mota = "";   // Mota aldagaia hasieran hutsik
$prezioa = ""; // Prezioa aldagaia hasieran hutsik

// Formularioan izena eremua bete den konprobatu
if (isset($_GET["izena"]) && !empty($_GET["izena"])) {
    $izena = $_GET["izena"]; // Izena aldagaia betetzen da formularioaren balioarekin
}

// Formularioan mota eremua bete den konprobatu
if (isset($_GET["mota"]) && !empty($_GET["mota"])) {
    $mota = $_GET["mota"]; // Mota aldagaia betetzen da formularioaren balioarekin
}

// Formularioan prezioa eremua bete den konprobatu
if (isset($_GET["prezioa"]) && !empty($_GET["prezioa"])) {
    $prezioa = $_GET["prezioa"]; // Prezioa aldagaia betetzen da formularioaren balioarekin
}

// Eremu guztiak bete diren konprobatu
if (!empty($izena) && !empty($mota) && !empty($prezioa)) {
    // Datubasera konektatzeko konexio berria sortzen da
    $conn = new mysqli($zerbitzaria, $erabiltzailea, $pasahitza, $datubasea);
    
    // Konexioa huts egin badu, errore mezua erakutsi eta exekuzioa gelditu
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Produktu berria sartzeko SQL kontsulta prestatzen da
    $sql = "INSERT INTO entrega4.produktuak (izena, mota, prezioa) VALUES ('$izena', '$mota', '$prezioa')";

    // Kontsulta exekutatu eta emaitza konprobatu
    if ($conn->query($sql) === TRUE) {
        echo"<br>"; // Lerro hautsi bat gehitu pantailan
        echo "Erregistroa ongi sortu da."; // Mezua: erregistroa behar bezala gorde da
    } else {
        echo "Error: " . $conn->error;  // Errore mezua bistaratzen da, SQL arazo bat egon bada
    }

    // Datubase konexioa ixten da
    $conn->close();
}
?>
<br>
<!-- Produktuen taula ikusteko lotura -->
<a href="TablaErakutsi.php">Aldaketak ikusi taulan</a>
</html>
