<html>
<h1>Produktua eguneratu</h1>

<!-- Datu berriak sartzeko formularioa -->
<form method="get" action="">
    <label for="izena">Sartu izen berria</label>
    <input type="text" name="izena" id="izena" placeholder="Sartu izena" /> <br>
    
    <label for="mota">Sartu mota berria</label>
    <input type="text" name="mota" id="mota" /> <br>
    
    <label for="prezioa">Sartu prezio berria</label>
    <input type="text" name="prezioa" id="prezioa" placeholder="Sartu prezioa" /> <br>
    
    <label for="bilaketa">Sartu id-a</label>
    <input type="number" name="bilaketa" id="bilaketa" placeholder="Sartu id-a" /> <br>
    
    <button type="submit">Eguneratu</button>
</form>

<?php
// Datubasera konektatzeko datuak
$zerbitzaria = "localhost";
$erabiltzailea = "root";
$pasahitza = "1MG2024";
$datubasea = "entrega4"; 

$izena = ""; 
$mota = "";
$prezioa = "";
$bilaketa = ""; 

// Formularioaren izena atala bete den konprobatu
if (isset($_GET["izena"]) && !empty($_GET["izena"])) {
    $izena = $_GET["izena"]; 
}

// Formularioaren mota atala beteta dagoen konprobatzen du
if (isset($_GET["mota"]) && !empty($_GET["mota"])) {
    $mota = $_GET["mota"];
}

// Formularioaren prezioa atala bete den konprobatu
if (isset($_GET["prezioa"]) && !empty($_GET["prezioa"])) {
    $prezioa = $_GET["prezioa"]; 
}

// Formularioaren bilaketa atala bete den konprobatu
if (isset($_GET["bilaketa"]) && !empty($_GET["bilaketa"])) {
    $bilaketa = $_GET["bilaketa"]; 
}

// Atal guztiak bete diren konprobatu
if (!empty($izena) && !empty($mota) && !empty($prezioa) && !empty($bilaketa)) {
    // Datubasera konektatzeko konexio berria sortzen da
    $conn = new mysqli($zerbitzaria, $erabiltzailea, $pasahitza, $datubasea);
    
    // Konexioa arazoa dagoen konprobatzen du
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error); // Errore mezua
    }

    // Update SQL kontsulta
    $sql = "UPDATE entrega4.produktuak SET izena='$izena', mota='$mota', prezioa='$prezioa' WHERE id='$bilaketa'";

    // Kontsulta exekutatu eta haren emaitza konprobatu
    if ($conn->query($sql) === TRUE) {
        echo "<br>";
        echo "Erregistroa ongi eguneratu da";
    } else {
        echo "Error: " . $conn->error; // Akatsa badago bistaratzen da
    }

    // Datubase konexioa ixten da
    $conn->close();
}
?>
<br>
<!-- Produktuen taula ikusteko lotura -->
<a href="TablaErakutsi.php">Aldaketak ikusi taulan</a>
</html>

