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
$zerbitzaria = "localhost";
$erabiltzailea = "root";
$pasahitza = "1MG2024";
$datubasea = "entrega4";

// Bariableak inizializatu
$izena = "";  
$mota = "";  
$prezioa = "";

// Formularioa bidali den konprobatu eta datuak bete diren ikusi
if (isset($_GET["izena"]) && !empty($_GET["izena"])) {
    $izena = $_GET["izena"];
}

if (isset($_GET["mota"]) && !empty($_GET["mota"])) {
    $mota = $_GET["mota"];
}

if (isset($_GET["prezioa"]) && !empty($_GET["prezioa"])) {
    $prezioa = $_GET["prezioa"];
}

// Comprobar si todos los campos están completos
if (!empty($izena) && !empty($mota) && !empty($prezioa)) {
    // Crear la conexión a la base de datos
    $conn = new mysqli($zerbitzaria, $erabiltzailea, $pasahitza, $datubasea);
    
    // Konexioa egokia izan den konprobatu
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Produktu berria sartzeko kontsulta prestatu
    $sql = "INSERT INTO entrega4.produktuak (izena, mota, prezioa) VALUES ('$izena', '$mota', '$prezioa')";

    // Kontsulta exekutatu eta konprobatu ea egokia izan den 
    if ($conn->query($sql) === TRUE) {
        echo"<br>";
        echo "Erregistroa ongi sortu da.";
    } else {
        echo "Error: " . $conn->error; 
    }

    

    // Konexioa itxi
    $conn->close();
}
?>
<br>
<a href="TablaErakutsi.php">Aldaketak ikusi taulan</a>