<?php
include 'connect_to_database.php'; //connect the connection page

if(empty($_SESSION)) // if the session not yet started
   session_start();

if(!isset($_SESSION['username'])) { //if not yet logged in
   header("Location: index.php");// send to login page
   exit;
}
?>
<html>
<head>
<title>Cek Stres</title>
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

<h1 align="center">Cek Indikasi Stres</h1>
<form action="cekstres3.php" method="POST">
<input type="hidden" name="iduser" value=" <?php echo $_SESSION['id'] ?> ">
<table align="center" id="customers">
<tr><th>No.</td>
	<th>Pertanyaan</td>
	<th>Jawaban</td>
</tr>
<?php
$nomerku = 1;
$embolur = mysqli_query($connect,"SELECT * FROM soal WHERE kategori='1'")or die(mysql_error());
while($yaya = mysqli_fetch_array($embolur)){
 ?>
 <tr><td><?php echo $nomerku ?>.</td>
 	<td><?php echo $yaya['soal']; ?></td>
 	<td><label class="container">Ya
 		<input type="radio" name="grupp<?php echo $nomerku ?>" value="1" required>
 		<span class="checkmark"></span>
 		</label>
 		<label class="container">Tidak
 		<input type="radio" name="grupp<?php echo $nomerku ?>" value="0">
 		<span class="checkmark"></span>
 		</label>
 	</td>
 </tr>
<?php
$nomerku++;
}
?>
</table>
<center><button class="button button1" type="submit">Ok</button>
</center>
</form>
<center><a href="home.php"><button class="button button1">Kembali</button></a></center>
</body>
</html>
