<h1>Produktua Gehitu</h1>

<form method="get" action="">
    <label for="izena">Izena</label>
    <input type="text" name="izena" id="izena" placeholder="Sartu izena" /> <br>
    
    <label for="mota">Mota</label>
    <input type="text" name="mota" id="mota" placeholder="Sartu mota" /> <br>
    
    <label for="prezioa">Prezioa</label>
    <input type="text" name="prezioa" id="prezioa" placeholder="Sartu prezioa" /> <br>
    
    <button type="submit">Gehitu</button>
</form>

<?php
$zerbitzaria = "localhost"; // Zerbitzariaren helbidea definitu
$erabiltzailea = "root"; // Datu-baseko erabiltzaile izena
$pasahitza = "1MG2024"; // Datu-baseko pasahitza
$datubasea = "entrega4"; // Datu-basearen izena

// Bariableak inizializatu, formularioaren balioak gordetzeko
$izena = "";  
$mota = "";  
$prezioa = "";

// Formularioa bidali den konprobatu eta izena balioa hartu
if (isset($_GET["izena"]) && !empty($_GET["izena"])) {
    $izena = htmlspecialchars($_GET["izena"]);
}

// Formularioa bidali den konprobatu eta mota balioa hartu
if (isset($_GET["mota"]) && !empty($_GET["mota"])) {
    $mota = htmlspecialchars($_GET["mota"]);
}

// Formularioa bidali den konprobatu eta prezioa balioa hartu
if (isset($_GET["prezioa"]) && !empty($_GET["prezioa"])) {
    $prezioa = htmlspecialchars($_GET["prezioa"]);
}

// Ziurtatu formularioaren hiru balioak beteta daudela
if (!empty($izena) && !empty($mota) && !empty($prezioa)) {
    // Datu-basearekin konexioa sortu
    $conn = new mysqli($zerbitzaria, $erabiltzailea, $pasahitza, $datubasea);
    
    // Konexioa egokia izan den konprobatu
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error); // Akatsa badago, errorea erakutsi eta exekuzioa gelditu
    }

    // Produktu berria sartzeko SQL kontsulta sortu
    $sql = $conn->prepare("INSERT INTO entrega4.produktuak (izena, mota, prezioa) VALUES (?, ?, ?)");
    $sql->bind_param("ssd", $izena, $mota, $prezioa);

    // SQL kontsulta exekutatu eta emaitza konprobatu
    if ($sql->execute() === TRUE) {
        echo "<br>"; // Lerro huts bat gehitu
        echo "Erregistroa ongi sortu da."; // Mezua erakutsi erregistroa ongi sortu bada
    } else {
        echo "Error: " . $sql->error; // Akatsa gertatzen bada, errore mezua erakutsi
    }

    // Konexioa itxi
    $sql->close();
    $conn->close();
}
?>

<br>
<a href="TablaErakutsi7.php">Aldaketak ikusi taulan</a>
