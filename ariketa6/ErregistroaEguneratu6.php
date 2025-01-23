<h1>Produktua eguneratu</h1>

<!-- Formularioa erabiltzaileari produktuaren informazioa eguneratzeko aukera ematen dio -->
<form method="get" action="">
    <!-- Izena sartu ahal izateko sarrera -->
    <label for="izena">Sartu izen berria</label>
    <input type="text" name="izena" id="izena" placeholder="Sartu izena" /> <br>
    
    <!-- Mota sartu ahal izateko sarrera -->
    <label for="mota">Sartu mota berria</label>
    <input type="text" name="mota" id="mota" /> <br>
    
    <!-- Prezioa sartu ahal izateko sarrera -->
    <label for="prezioa">Sartu prezio berria</label>
    <input type="text" name="prezioa" id="prezioa" placeholder="Sartu prezioa" /> <br>
    
    <!-- ID-a sartu ahal izateko sarrera -->
    <label for="bilaketa">Sartu id-a</label>
    <input type="number" name="bilaketa" id="bilaketa" placeholder="Sartu id-a" /> <br>
    
    <!-- Eguneratu botoia -->
    <button type="submit">Eguneratu</button>
</form>

<?php
// Datu basearekin konektatzeko informazioa
$zerbitzaria = "localhost"; // Zerbitzariaren helbidea
$erabiltzailea = "root"; // Datu basearen erabiltzailea
$pasahitza = "1MG2024"; // Datu basearen pasahitza
$datubasea = "entrega4"; // Datu basearen izena

// Bariableak hasieratu (balio hutsik)
$izena = ""; 
$mota = "";
$prezioa = ""; 
$bilaketa = "";

// Formularioa bidali dela eta datuak bete diren egiaztatu
if (isset($_GET["izena"]) && !empty($_GET["izena"])) {
    $izena = $_GET["izena"]; // Izena jasotzen da
}

if (isset($_GET["mota"]) && !empty($_GET["mota"])) {
    $mota = $_GET["mota"]; // Mota jasotzen da
}

if (isset($_GET["prezioa"]) && !empty($_GET["prezioa"])) {
    $prezioa = $_GET["prezioa"]; // Prezioa jasotzen da
}

if (isset($_GET["bilaketa"]) && !empty($_GET["bilaketa"])) {
    $bilaketa = $_GET["bilaketa"]; // ID-a jasotzen da
}

// Formularioaren datu guztiak bete direla egiaztatzen da
if (!empty($izena) && !empty($mota) && !empty($prezioa) && !empty($bilaketa)) {
    // Datu basearekin konexioa sortzen da
    $conn = new mysqli($zerbitzaria, $erabiltzailea, $pasahitza, $datubasea);
    
    // Konexioa egokia izan den ala ez egiaztatzen da
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error); // Konexioa okerrekoa bada, errore mezua eta script-a gelditu
    }

    // SQL kontsulta prestatu: Produktuaren izena, mota eta prezioa eguneratzen dira IDaren arabera
    $sql = "UPDATE entrega4.produktuak SET izena='$izena', mota='$mota', prezioa='$prezioa' WHERE id='$bilaketa'";

    // SQL kontsulta exekutatu eta emaitza egiaztatu
    if ($conn->query($sql) === TRUE) {
        echo"<br>";
        echo "Erregistroa ongi eguneratu da"; // Eguneraketa arrakastatsua bada
        echo "Error: " . $conn->error; // Hala ere, errore bat gertatuz gero, mezua erakutsi
    }

    // Konexioa itxi
    $conn->close(); // Konexioa itxita uzten da segurtasun eta optimizazioaren aldetik
}
?>
<br>
<!-- Aldaketak ikusteko esteka bat sortzen da -->
<a href="TablaErakutsi6.php">Aldaketak ikusi taulan</a>
