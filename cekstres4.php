<?php
include 'connect_to_database.php';

$tglku = $_POST['tglsaiki'];
$data4 = $_POST['data4'];
$iduser = $_POST['iduser'];

$grup1 = $_POST['grup1'];
$grup2 = $_POST['grup2'];
$grup3 = $_POST['grup3'];
$grup4 = $_POST['grup4'];
$grup5 = $_POST['grup5'];
$grup6 = $_POST['grup6'];
$grup7 = $_POST['grup7'];
$grup8 = $_POST['grup8'];
$grup9 = $_POST['grup9'];
$grup10 = $_POST['grup10'];
$grup11 = $_POST['grup11'];
$grup12 = $_POST['grup12'];
$grup13 = $_POST['grup13'];
$grup14 = $_POST['grup14'];
$grup15 = $_POST['grup15'];
$grup16 = $_POST['grup16'];
$grup17 = $_POST['grup17'];
$grup18 = $_POST['grup18'];
$grup19 = $_POST['grup19'];
$grup20 = $_POST['grup20'];
$grup21 = $_POST['grup21'];
$grup22 = $_POST['grup22'];
$grup23 = $_POST['grup23'];
$grup24 = $_POST['grup24'];
$grup25 = $_POST['grup25'];
$grup26 = $_POST['grup26'];
$grup27 = $_POST['grup27'];
$grup28 = $_POST['grup28'];
$grup29 = $_POST['grup29'];
$grup30 = $_POST['grup30'];
$grup31 = $_POST['grup31'];
$grup32 = $_POST['grup32'];
$grup33 = $_POST['grup33'];
$grup34 = $_POST['grup34'];
$grup35 = $_POST['grup35'];
$grup36 = $_POST['grup36'];
$grup37 = $_POST['grup37'];
$grup38 = $_POST['grup38'];
$grup39 = $_POST['grup39'];
$grup40 = $_POST['grup40'];
$grup41 = $_POST['grup41'];
$grup42 = $_POST['grup42'];
$grup43 = $_POST['grup43'];
$grup44 = $_POST['grup44'];
$grup45 = $_POST['grup45'];
$grup46 = $_POST['grup46'];
$grup47 = $_POST['grup47'];
$grup48 = $_POST['grup48'];
$grup49 = $_POST['grup49'];
$grup50 = $_POST['grup50'];

$gruppertama = (int)$grup1 + (int)$grup2 + (int)$grup3 + (int)$grup4 + (int)$grup5 + (int)$grup6 + (int)$grup7 + (int)$grup8 + (int)$grup9 + (int)$grup10;
$grupkedua = (int)$grup11 + (int)$grup12 + (int)$grup13 + (int)$grup14 + (int)$grup15 + (int)$grup16 + (int)$grup17 + (int)$grup18 + (int)$grup19 + (int)$grup20;
$grupketiga = (int)$grup21 + (int)$grup22 + (int)$grup23 + (int)$grup24 + (int)$grup25 + (int)$grup26 + (int)$grup27 + (int)$grup28 + (int)$grup29 + (int)$grup30;
$grupkeempat = (int)$grup31 + (int)$grup32 + (int)$grup33 + (int)$grup34 + (int)$grup35 + (int)$grup36 + (int)$grup37 + (int)$grup38 + (int)$grup39 + (int)$grup40;
$grupkelima = (int)$grup41 + (int)$grup42 + (int)$grup43 + (int)$grup44 + (int)$grup45 + (int)$grup46 + (int)$grup47 + (int)$grup48 + (int)$grup49 + (int)$grup50;

$hasil = (int)$gruppertama + (int)$grupkedua + (int)$grupketiga + (int)$grupkeempat + (int)$grupkelima;
$data="";

if($hasil <= 125){
  $data = "Sepertinya Anda sedang tidak mengalami stres, Pertahankan kondisi ini";
}elseif($hasil <= 157){
  $data = "Sepertinya Anda mengalami stres normal<br>Untuk mengatasi hal ini segera selesaikan masalah yang sedang Anda hadapi, lakukan olahraga secara teratur, makan 3x dalam sehari secara rutin";
}elseif($hasil <= 189){
  $data = "Sepertinya Anda mengalami stres cukup parah<br>Solusi untuk kondisi Anda saat ini yang utama adalah Anda sebaiknya menceritakan masalah yang sedang Anda hadapi kepada orang yang mungkin Anda percaya<br>dan jangan lupa untuk melakukan olahraga secara rutin, serta makan 3x sehari secara teratur";
}elseif($hasil <= 221){
  $data = "Stres yang Anda alami saat ini tergolong parah, segera hubungi psikolog terdekat";
}elseif($hasil <= 250){
  $data = "Stres yang Anda alami saat ini tergolong sangat parah, segera hubungi psikolog terdekat";
}

$tglsaiki = date("Y-m-d");
mysqli_query($connect,"INSERT INTO cekstres VALUES('','$tglku','$tglsaiki','$data4','$data','$hasil','$iduser')");

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
        <h2>Stres Anda
          <?php
          $persenaja = 0;

          $persenaja = ($hasil*100)/250;
          echo $persenaja;
         ?> %</h2>
        <p> <?php echo $data ?>.</p>
        Lalu <br>
        <?php
          $querynya = mysqli_query($connect,"SELECT * FROM cekstres WHERE idstres='$iduser'")or die(mysql_error());
          while($data2 = mysqli_fetch_array($querynya)){
            echo "<p>".$data2['isi1']."</p>";
          }
         ?>
         <p> <a href="home.php">Kembali ke Menu Utama</a></p>
      </div>
    </div>
  </body>
</html>
