<?php
include 'connect_to_database.php';
$username = $_POST['username'];
$namalengkap = $_POST['namalengkap'];
$email = $_POST['email'];
$password = $_POST['password'];
$nomorhp = $_POST['nomorhp'];

mysqli_query($connect,"INSERT INTO users VALUES('','$username','$password','$nomorhp','$email','$namalengkap','0','','','5')");

echo "<script>alert('Pendaftaran akun nama atas nama ".$namalengkap." berhasil');window.location = 'index.php';</script>";
?>
