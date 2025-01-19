<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" /><!--Ikonoen estiloak edukitzeko link-a-->
    
    <title>4.Ariketa</title>
</head>

<body>

</body>

</html>
<?php
//Mysql-ko eskeman sartu ahal izateko hurrengo aldagaiak sartu dira.
$datubasea = "localhost";
$erabiltzailea = "root";
$pasahitza = "1MG2024";
$bilaketa="";

// Formularioan datuak bete diren konprobatu
if(isset($_GET["bilaketa"]) && !empty($_GET["bilaketa"])) {
    $bilaketa = $_GET["bilaketa"];
}   


// Konexioa sortu
$conn = new mysqli($datubasea, $erabiltzailea, $pasahitza);

// Konexioaren konprobaketa
if ($conn->connect_error) {
    die("Konexioak huts egin du: " . $conn->connect_error);
}


echo "<h1>Produktuen taula</h1>";
?>

<!-- Bilaketa egiteko label-a  bilaketa izena eta id-a jasotzen duena, ondoren PHP zatian bilaketa egin ahal izateko.-->
<!-- Botoia ere orrialdea errekargatzeko.-->
<!-- Hemen bai motagatik baita izenagatik bilatzeko aukera izango dugu-->
<form method="get" action="">
    <label for="bilaketa">Filtratu</label>
    <input type="text" name="bilaketa" id="bilaketa"/>
    <button>Bilatu</button>

</form>
<?php

// Hemen $kontsula-n Mysql-ko eskaera idazten da.
$kontsulta = "SELECT id, izena, mota, prezioa FROM markatze.produktuak";

// $emaitza-n konexioa egiten du Mysql-ko esquemarekin eta $kontsulta-n dagoen linea exekutatzen du.
$emaitza = $conn->query($kontsulta);


//if honek begiratzen du $bilaketa array-ean zerbait jarri den.
if ($emaitza->num_rows > 0) {

    // Linea bakoitzeko datuak inprimatu
    echo "<table border='1' cellspacing='0' cellpadding='10'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Id</th>";
    echo "<th>Izena</th>";
    echo "<th>Mota</th>";
    echo "<th>Prezioa</th>";
    echo "<th>Aukerak</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";;
    
    
    // Base datuarekin erlazionatuta dagoen taula egin
    while ($row = $emaitza->fetch_assoc()) {

        //motagatik eta izenagatik bilatu ahal izateko konprobatzen du $bilaketa-n dagoena bietako batekin koinziditzen duen
        if (str_contains($row["izena"], $bilaketa) || str_contains($row["mota"], $bilaketa)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['izena']) . "</td>";
            echo "<td>" . htmlspecialchars($row['mota']) . "</td>";
            
            //Prezioa datuan agertzen den zenbakiak 2 dezimaletako formatua izan dezan egiten du.
            echo "<td>" . htmlspecialchars(number_format($row['prezioa'],2)) . " €</td>";

            //Hemen ezabatu eta eguneratu url-ak agertzen dira, baina ez ditu logoak egoki kargatzen, agian goiko link-a aldatu egin behar da.
            echo "<td><a href='ErregistroaEzabatu.php' class='add-action'><i class='fas fa-trash'></i>Ezabatu</a> <br> <a href='ErregistroaEguneratu.php' class='add-action'><i class='fas fa-pencil'></i>Eguneratu</a></td>";
            echo "</tr>";
            
        }
           
        
    }
    echo "</tbody>";
    echo "</table>";
    echo "<div style='margin-top: 20px;'>";

    //hemen goran gertatzen den link-en arazo berdina gertatzen da.
    echo "<a href='ErregistroaGehitu.php' class='add-action'><i class='fas fa-plus'></i>Produktua Gehitu</a>";
    echo "</div>";

    
//ez baditu datuak aurkitzen hurrengo mezua idazten du
} else {
    echo "Ez dago daturik";
}
// Konexioa itxi
$conn->close();
?>
<br>