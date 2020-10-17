<?php
include 'connect_to_database.php';

$iduser = $_GET['idstres'];

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Output</title>
    <link href="css/w3.css" rel="stylesheet" type="text/css" />
    <style media="screen">
    .w3-metro-light-green
{color:#fff;background-color:#99b433}
.w3-metro-green
{color:#fff;background-color:#00a300}
.w3-metro-dark-green
{color:#fff;background-color:#1e7145}
.w3-metro-magenta
{color:#fff;background-color:#ff0097}
.w3-metro-light-purple
{color:#fff;background-color:#9f00a7}
.w3-metro-purple
{color:#fff;background-color:#7e3878}
.w3-metro-dark-purple
{color:#fff;background-color:#603cba}
.w3-metro-darken
{color:#fff;background-color:#1d1d1d}
.w3-metro-teal
{color:#fff;background-color:#00aba9}
.w3-metro-light-blue
{color:#000;background-color:#eff4ff}
.w3-metro-blue
{color:#fff;background-color:#2d89ef}
.w3-metro-dark-blue
{color:#fff;background-color:#2b5797}
.w3-metro-yellow
{color:#fff;background-color:#ffc40d}
.w3-metro-orange
{color:#fff;background-color:#e3a21a}
.w3-metro-dark-orange
{color:#fff;background-color:#da532c}
.w3-metro-red
{color:#fff;background-color:#ee1111}
.w3-metro-dark-red
{color:#fff;background-color:#b91d47}
    </style>
  </head>
  <body>
    <div class="w3-container">
      <h1>Hasil Pengukuran</h1>
      <div class="w3-panel w3-metro-light-green">


        <?php
          $querynya = mysqli_query($connect,"SELECT * FROM cekstres WHERE idstres='$iduser'")or die(mysql_error());
          while($data2 = mysqli_fetch_array($querynya)){
            $persenaja = 0;
            $persenaja = ((int)$data2['skor']*100)/250;
            echo "<h2>Stres Anda ".$persenaja."%</h2>";
            echo "<p>".$data2['isi2']."</p>";
            echo "Lalu <br>";
            echo "<p>".$data2['isi1']."</p>";
          }
         ?>
         <p><a href="home.php">Kembali ke Menu Utama</a></p>
      </div>
    </div>
  </body>
</html>
