<h1>Produktua eguneratu</h1> <!--Produktua eguneratzeko-->


<!-- Produktua aldatzeko izena, mota eta prezioa sartu ahal izateko kontsulta-->
<!--Jakiteko zein produktu aldatu nahi den id-a ere sartzea eskatuko du.-->
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

//Mysql-ko datu basearekin konexioa egin ahal izateko.
$zerbitzaria = "localhost";
$erabiltzailea = "root";
$pasahitza = "1MG2024";
$datubasea = "entrega4";

// Bariableak inizializatu
$izena = "";
$mota = "";
$prezioa = ""; 
$bilaketa = "";

// Formularioa bidali den konprobatu eta ikusi ea datu guztiak bete diren
if (isset($_GET["izena"]) && !empty($_GET["izena"])) {
    $izena = $_GET["izena"];
}

if (isset($_GET["mota"]) && !empty($_GET["mota"])) {
    $mota = $_GET["mota"];
}

if (isset($_GET["prezioa"]) && !empty($_GET["prezioa"])) {
    $prezioa = $_GET["prezioa"];
}

if (isset($_GET["bilaketa"]) && !empty($_GET["bilaketa"])) {
    $bilaketa = $_GET["bilaketa"];
}

// Formularioaren datu guztiak bete diren konprobatu
if (!empty($izena) && !empty($mota) && !empty($prezioa) && !empty($bilaketa)) {

    // Base datuarekin konexioa sortu
    $conn = new mysqli($zerbitzaria, $erabiltzailea, $pasahitza, $datubasea);
    
    // Konprobatu ea konexioa egokia izan den 
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Produktua eguneratzeko kontsulta prestatu
    $sql = "UPDATE entrega4.produktuak SET izena='$izena', mota='$mota', prezioa='$prezioa' WHERE id='$bilaketa'";

    // Kontsulta exekutatu eta ikusi ea eguneraketa egokia izan den
    if ($conn->query($sql) === TRUE) {
        echo"<br>";
        echo "Erregistroa ongi eguneratu da"; 
        echo "Error: " . $conn->error; 
    }

    // Konexioa itxi
    $conn->close();
}
?>
<br>
<!--lehenengo ariketara bueltatzen du taula ikusteko-->
<a href="1.Ariketa.php">Aldaketak ikusi taulan</a>