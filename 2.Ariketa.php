<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <!--Ikonoen estiloak edukitzeko link-a-->
    <title>2.Ariketa</title>
</head>

<body>

</body>

</html>


<?php
//Mysql-ko eskeman sartu ahal izateko hurrengo aldagaiak sartu dira.
$datubasea = "localhost";
$erabiltzailea = "root";
$pasahitza = "1MG2024";
$bilaketa = "";

// Konexioa sortu
$conn = new mysqli($datubasea, $erabiltzailea, $pasahitza);

// Konexioaren konprobaketa, ez badu konexioak ondo funtzionatzen hurrengoa esango du.
if ($conn->connect_error) {
    die("Konexioak huts egin du: " . $conn->connect_error);
}

echo "<h1>Bilatu Izena</h1>";
?>

<!-- Bilaketa egiteko label-a  bilaketa izena eta id-a jasotzen duena, ondoren PHP zatian bilaketa egin ahal izateko.-->
<!-- Botoia ere orrialdea errekargatzeko.-->
<!-- Hemen Izenagatik bilatzeko aukera izango dugu-->
<form method="get" action="2.Ariketa.php">
    <label for="bilaketa">Izena bilatu</label>
    <input type="text" name="bilaketa" id="bilaketa" />
    <button>Bilatu</button>
    <br>
    <h5>Enter Taula agertzeko</h5>
</form>

<?php
//if honek begiratzen du $bilaketa array-ean zerbait jarri den.
if (isset($_GET["bilaketa"])) {

    //hemen bilaketan sartutakoa jasotzen du ondoren kontsulta egiteko.
    //real_scape_string-ek laguntzen du karaktere arrarorik sartu ez dezan kontsulta horretara, beraz horrela ondo exekutatu dezan.
    $bilaketa = $conn->real_escape_string($_GET["bilaketa"]);

    //hemen $kontsula-n Mysql-ko eskaera idazten da kasu honetan izenaren arabera bilatzeko
    $kontsulta = "SELECT id, izena, mota, prezioa FROM markatze.produktuak WHERE izena LIKE '%$bilaketa%'";

    // $emaitza-n konexioa egiten du Mysql-ko esquemarekin eta $kontsulta-n dagoen linea exekutatzen du.
    $emaitza = $conn->query($kontsulta);

    //if honek egiten duena da begiratzea bilatutako informazioaren arabera datu baseetan linearik badagoen informazio horrekin, horrela ondoren taula osatzeko.
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
        echo "<tbody>";

        // Base datuarekin erlazionatuta dagoen taula egin
        while ($row = $emaitza->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['izena']) . "</td>";
            echo "<td>" . htmlspecialchars($row['mota']) . "</td>";

            //Prezioa datuan agertzen den zenbakiak 2 dezimaletako formatua izan dezan egiten du.
            echo "<td>" . htmlspecialchars(number_format($row['prezioa'], 2)) . " €</td>";

            //Hemen ezabatu eta eguneratu url-ak agertzen dira, baina ez ditu logoak egoki kargatzen, agian goiko link-a aldatu egin behar da.
            echo "<td>
                <a href='ErregistroaEzabatu.php'><i class='fas fa-trash'></i>Ezabatu</a>
                <br>
                <a href='ErregistroaEguneratu.php'><i class='fas fa-pencil'></i>Eguneratu</a>
            </td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";

        //Ez badu taularik edota daturik aurkitzen hurrengo mezua agertzen du.
    } else {
        echo "Ez dago daturik.";
    }
}
// Konexioa ixten du
$conn->close();
?>