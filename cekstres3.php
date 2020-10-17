<?php
include 'connect_to_database.php'; //connect the connection page

if(empty($_SESSION)) // if the session not yet started
   session_start();

if(!isset($_SESSION['username'])) { //if not yet logged in
   header("Location: index.php");// send to login page
   exit;
}
?>
<?php

$iduser = $_POST['iduser'];

$grupp1 = $_POST['grupp1'];
$grupp2 = $_POST['grupp2'];
$grupp3 = $_POST['grupp3'];
$grupp4 = $_POST['grupp4'];
$grupp5 = $_POST['grupp5'];
$grupp6 = $_POST['grupp6'];
$grupp7 = $_POST['grupp7'];
$grupp8 = $_POST['grupp8'];
$grupp9 = $_POST['grupp9'];
$grupp10 = $_POST['grupp10'];
$grupp11 = $_POST['grupp11'];
$grupp12 = $_POST['grupp12'];
$grupp13 = $_POST['grupp13'];
$grupp14 = $_POST['grupp14'];
$grupp15 = $_POST['grupp15'];
$grupp16 = $_POST['grupp16'];
$grupp17 = $_POST['grupp17'];
$grupp18 = $_POST['grupp18'];
$grupp19 = $_POST['grupp19'];
$grupp20 = $_POST['grupp20'];
$grupp22 = $_POST['grupp22'];
$grupp23 = $_POST['grupp23'];
$grupp24 = $_POST['grupp24'];
$grupp25 = $_POST['grupp25'];
$grupp26 = $_POST['grupp26'];
$grupp27 = $_POST['grupp27'];
$grupp28 = $_POST['grupp28'];


$grupppertama = (int)$grupp1 + (int)$grupp2 + (int)$grupp3 + (int)$grupp4 + (int)$grupp5 + (int)$grupp6 + (int)$grupp7 + (int)$grupp8 + (int)$grupp9 + (int)$grupp10 + (int)$grupp11 + (int)$grupp12;
$grupppertama2 = (int)$grupp13 + (int)$grupp14 + (int)$grupp15 + (int)$grupp16 + (int)$grupp17 + (int)$grupp18 + (int)$grupp19 + (int)$grupp20;
$gruppgabungan = (int)$grupppertama + (int)$grupppertama2;

$gruppkedua = (int)$grupp22 + (int)$grupp23 + (int)$grupp24;

$gruppketiga = (int)$grupp25 + (int)$grupp26 + (int)$grupp27 + (int)$grupp28;

$data1="";
$data2="";
$data3="";

if($gruppgabungan<=4){
  $data1 = "Kondisi psikolog dasar Anda baik-baik saja.";

  //echo $data1;
}else{
  $data1 = "Sepertinya Anda mengalami masalah psikologis yang cukup serius seperti kondisi cemas dan depresi.";
	//echo $data1;
}

if($gruppkedua>=1){
  $data2 =" Lalu sepertinya Anda mengalami gejala psikotik yakni gangguan dalam penilaian realitas.";
	//echo $data2;
}

  $data3=" Kemudian sepertinya Anda mengalami gejala Post Traumatic Stress Disorder atau yang disebut gangguan stres setelah trauma.";
  if($gruppketiga>=1){
	//echo $data3;
}

$data4 = $data1.$data2.$data3;

$tglsaiki = date("Y-m-d");
?>
<html>
<head>
<title>Cek Stres Tahap 2</title>
<style>
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}

.button1 {
  background-color: white;
  color: black;
  border: 2px solid #4CAF50;
}

.button1:hover {
  background-color: #4CAF50;
  color: white;
}
/* The container */
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.container .checkmark:after {
 	top: 9px;
	left: 9px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background: white;
}
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
</head>
<body>

<h1 align="center">Cek Indikasi Stres Tahap 2</h1>
<form action="cekstres4.php" method="POST">

<input type="hidden" name="tglsaiki" value="<?php echo $tglsaiki ?>">
<input type="hidden" name="data4" value="<?php echo $data4 ?>">
<input type="hidden" name="iduser" value="<?php echo $iduser ?>">

<table align="center" id="customers">
<tr><th>No.</td>
	<th>Pertanyaan</td>
	<th>Jawaban</td>
</tr>
<?php
$nomerku = 1;
$embolur = mysqli_query($connect,"SELECT * FROM soal WHERE kategori='2'")or die(mysql_error());
while($yaya = mysqli_fetch_array($embolur)){
  ?>
  <tr><td><?php echo $nomerku ?></td>
          <td><?php echo $yaya['soal'] ?></td>
  <?php
  if($yaya['jenis'] == 0){
    if($yaya['idsoal']==31){
      if($grupp2=1) {
        ?>
        <td><label class="container">Sangat Setuju
   		         <input type="radio" name="grup<?php echo $nomerku ?>" value="5" required>
   		          <span class="checkmark"></span></label>
   		           <label class="container">Setuju
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="4">
   		<span class="checkmark"></span>
   		</label>
       <label class="container">Ragu
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="3">
   		<span class="checkmark"></span>
   		</label>
       <label class="container">Tidak Setuju
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="2" disabled>
   		<span class="checkmark"></span>
   		</label>
       <label class="container">Sangat Tidak Setuju
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="1" disabled>
   		<span class="checkmark"></span>
   		</label>
   	</td>
        <?php
      }else{
        ?>
        <td><label class="container">Sangat Setuju
   		         <input type="radio" name="grup<?php echo $nomerku ?>" value="5" required disabled>
   		          <span class="checkmark"></span></label>
   		           <label class="container">Setuju
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="4" disabled>
   		<span class="checkmark"></span>
   		</label>
       <label class="container">Ragu
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="3">
   		<span class="checkmark"></span>
   		</label>
       <label class="container">Tidak Setuju
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="2">
   		<span class="checkmark"></span>
   		</label>
       <label class="container">Sangat Tidak Setuju
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="1">
   		<span class="checkmark"></span>
   		</label>
   	</td>
        <?php
      }
    }elseif($yaya['idsoal']==30 || $yaya['idsoal']==37 || $yaya['idsoal']==66){
      if($grupp3=1) {
        ?>
        <td><label class="container">Sangat Setuju
   		         <input type="radio" name="grup<?php echo $nomerku ?>" value="5" required>
   		          <span class="checkmark"></span></label>
   		           <label class="container">Setuju
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="4">
   		<span class="checkmark"></span>
   		</label>
       <label class="container">Ragu
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="3">
   		<span class="checkmark"></span>
   		</label>
       <label class="container">Tidak Setuju
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="2" disabled>
   		<span class="checkmark"></span>
   		</label>
       <label class="container">Sangat Tidak Setuju
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="1" disabled>
   		<span class="checkmark"></span>
   		</label>
   	</td>
        <?php
      }else{
        ?>
        <td><label class="container">Sangat Setuju
   		         <input type="radio" name="grup<?php echo $nomerku ?>" value="5" required disabled>
   		          <span class="checkmark"></span></label>
   		           <label class="container">Setuju
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="4" disabled>
   		<span class="checkmark"></span>
   		</label>
       <label class="container">Ragu
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="3">
   		<span class="checkmark"></span>
   		</label>
       <label class="container">Tidak Setuju
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="2">
   		<span class="checkmark"></span>
   		</label>
       <label class="container">Sangat Tidak Setuju
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="1">
   		<span class="checkmark"></span>
   		</label>
   	</td>
        <?php
      }
    }elseif($yaya['idsoal']==74){
      if($grupp4=1) {
        ?>
        <td><label class="container">Sangat Setuju
             <input type="radio" name="grup<?php echo $nomerku ?>" value="5" required>
              <span class="checkmark"></span></label>
               <label class="container">Setuju
    <input type="radio" name="grup<?php echo $nomerku ?>" value="4">
    <span class="checkmark"></span>
    </label>
     <label class="container">Ragu
    <input type="radio" name="grup<?php echo $nomerku ?>" value="3">
    <span class="checkmark"></span>
    </label>
     <label class="container">Tidak Setuju
    <input type="radio" name="grup<?php echo $nomerku ?>" value="2" disabled>
    <span class="checkmark"></span>
    </label>
     <label class="container">Sangat Tidak Setuju
    <input type="radio" name="grup<?php echo $nomerku ?>" value="1" disabled>
    <span class="checkmark"></span>
    </label>
  </td>
        <?php
      }else{
        ?>
        <td><label class="container">Sangat Setuju
   		         <input type="radio" name="grup<?php echo $nomerku ?>" value="5" required disabled>
   		          <span class="checkmark"></span></label>
   		           <label class="container">Setuju
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="4" disabled>
   		<span class="checkmark"></span>
   		</label>
       <label class="container">Ragu
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="3">
   		<span class="checkmark"></span>
   		</label>
       <label class="container">Tidak Setuju
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="2">
   		<span class="checkmark"></span>
   		</label>
       <label class="container">Sangat Tidak Setuju
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="1">
   		<span class="checkmark"></span>
   		</label>
   	</td>
        <?php
      }
    }else{
    ?>
    <td><label class="container">Sangat Setuju
   		         <input type="radio" name="grup<?php echo $nomerku ?>" value="5" required>
   		          <span class="checkmark"></span></label>
   		           <label class="container">Setuju
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="4">
   		<span class="checkmark"></span>
   		</label>
       <label class="container">Ragu
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="3">
   		<span class="checkmark"></span>
   		</label>
       <label class="container">Tidak Setuju
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="2">
   		<span class="checkmark"></span>
   		</label>
       <label class="container">Sangat Tidak Setuju
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="1">
   		<span class="checkmark"></span>
   		</label>
   	</td>
    <?php
    }
  }else{
    ?>
    <td><label class="container">Sangat Setuju
   		         <input type="radio" name="grup<?php echo $nomerku ?>" value="1" required>
   		          <span class="checkmark"></span></label>
   		           <label class="container">Setuju
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="2">
   		<span class="checkmark"></span>
   		</label>
       <label class="container">Ragu
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="3">
   		<span class="checkmark"></span>
   		</label>
       <label class="container">Tidak Setuju
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="4">
   		<span class="checkmark"></span>
   		</label>
       <label class="container">Sangat Tidak Setuju
   		<input type="radio" name="grup<?php echo $nomerku ?>" value="5">
   		<span class="checkmark"></span>
   		</label>
   	</td>
    <?php
  }
  $nomerku++;
  echo "</tr>";
}
 ?>
</table>
<center><button class="button button1" type="submit">Ok</button>
</center>
</form>
<center><a href="home.php"><button class="button button1">Kembali</button></a></center>
</body>
</html>
