<h1>Produktua Ezabatu</h1> <!--Produktua ezabatu-->


<!--Erabiltzaileari id-a eskatzen dio horrela jakiteko zein dan ezabatu nahi den produktua-->
<form method="get" action="">
    <label for="bilaketa">Sartu id-a</label>
    <input type="number" name="bilaketa" id="bilaketa" />
    <button>Ezabatu</button>
</form>


<?php
//Mysql-ko datu basearekin konexioa egin ahal izateko.
$zerbitzaria = "localhost";
$erabiltzailea = "root";
$pasahitza = "1MG2024";
$datubasea = "entrega4";
$bilaketa = "";

// Formularioa bidali dela konprobatu eta id-aren datuak sartu diren edo ez
if (isset($_GET["bilaketa"]) && !empty($_GET["bilaketa"])) {
    $bilaketa = $_GET["bilaketa"];

    // Base datuarekin konexioa
    $conn = new mysqli($zerbitzaria, $erabiltzailea, $pasahitza, $datubasea);

    // Konexioa egokia izan den konprobatu
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Produktua ezabatzeko kontsulta prestatu
    $sql = "DELETE FROM entrega4.produktuak WHERE id='$bilaketa'";

    // Kontsulta ejekutatu y eta ezabaketa ongi egin den konprobatu
    if ($conn->query($sql) === TRUE) {
        echo"<br>";
        echo "Erregistroa ongi ezabatu da"; 
    } else {
        echo "Error: " . $conn->error; 
    }

    // Konexioa itxi
    $conn->close();
}
?>
<br>
<!--lehenengo ariketara bueltatzen du taula ikusteko-->
<a href="1.Ariketa.php">Aldaketak ikusi taulan</a>