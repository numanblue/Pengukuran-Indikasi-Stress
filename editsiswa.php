<?php
include 'koneksi.php'; //connect the connection page

if(empty($_SESSION)) // if the session not yet started
   session_start();

if(!isset($_SESSION['username'])) { //if not yet logged in
   header("Location: index.php");// send to login page
   exit;
}
$idsis = $_GET['id'];
$q1 = mysqli_query($connect,"SELECT * FROM siswa WHERE idsiswa='$idsis'");
$tamsis = mysqli_fetch_assoc($q1);
$idaj = $tamsis['ajaran'];
$q2 = mysqli_query($connect,"SELECT guru FROM ajaran WHERE idajaran='$idaj'");
$tamgur =mysqli_fetch_assoc($q2);
if($tamgur['guru']!=$_SESSION['id']){
header("location: dataajaran.php");
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rapot Online</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>



    <div id="wrapper">
         <?php include "header.php" ?>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center user-image-back">
                        <img src="assets/img/find_user.png" class="img-responsive" />

                    </li>
                    <?php include "menu.php" ?>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Tambah Siswa</h2>
                    </div>
                </div>
                 <!-- /. ROW  -->
                  <hr />
                  <div class="row">
                    <div class="col-md-12">
                      <form action="" method="post" enctype="multipart/form-data">
                        <?php

                          if(isset($_POST['submit'])){ //check if form was submitted
                            $nama = $_POST['nama'];
                            $namapanggilan = $_POST['namapanggilan'];
                            $nis = $_POST['nis'];
                            $nisn = $_POST['nisn'];
                            $tempatlahir = $_POST['tempatlahir'];
                            $tgllahir = $_POST['tgllahir'];
                            $jeniskelamin = $_POST['jeniskelamin'];
                            $agama = $_POST['agama'];
                            $alamat = htmlspecialchars($_POST['alamat']);
                            $namaayah = $_POST['namaayah'];
                            $pekerjaanayah = $_POST['pekerjaanayah'];
                            $namaibu = $_POST['namaibu'];
                            $pekerjaanibu = $_POST['pekerjaanibu'];
                            $namawali = $_POST['namawali'];
                            $alamatwali = htmlspecialchars($_POST['alamatwali']);
                            $notelponwali = $_POST['notelponwali'];
                            $pekerjaanwali = $_POST['pekerjaanwali'];
                            $ajaran = $_POST['ajaran'];

                            $namafoto = $_SESSION['username'].date("Y-m-d")." ".date("h:i:sa");

                            $target_dir = "fotosiswa/";
                            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                            $uploadOk = 1;
                            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                          if($_FILES['fileToUpload']['name'] != "") {
                            if($check !== false) {
                              $uploadOk = 1;
                            } else {
                              echo "<script>alert('File bukan gambar');window.location = 'dataajaran.php';</script>";
                              $uploadOk = 0;
                            }
                            if ($_FILES["fileToUpload"]["size"] > 500000) {
                              echo "<script>alert('File gambar lebih dari 5 MB');window.location = 'dataajaran.php';</script>";
                              $uploadOk = 0;
                            }
                            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                            && $imageFileType != "gif" ) {
                              echo "<script>alert('Hanya file gambar jpg, jpeg, png, dan gif yang diperbolehkan');window.location = 'dataajaran.php';</script>";
                              $uploadOk = 0;
                            }
                            if ($uploadOk == 0) {
                              echo "<script>alert('Error');window.location = 'dataajaran.php';</script>";
                            } else {
                              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.md5($namafoto).'.'.$imageFileType)) {
                                $okeycip = $tamsis['foto'];
                                unlink($okeycip);
                                $hasilfoto = $target_dir.md5($namafoto).'.'.$imageFileType;
                                mysqli_query($connect,"UPDATE siswa SET namasiswa='$nama', nis='$nis', nisn='$nisn',tempatlahir='$tempatlahir',tgllahir='$tgllahir',jeniskelamin='$jeniskelamin',agama='$agama',alamat='$alamat',foto='$hasilfoto',namaayah='$namaayah',pekerjaanayah='$pekerjaanayah',namaibu='$namaibu',pekerjaanibu='$pekerjaanibu',namawali='$namawali',alamatwali='$alamatwali',notelponwali='$notelponwali',pekerjaanwali='$pekerjaanwali' WHERE idsiswa='$idsis'");
                                header("location: dataajaran.php");
                              } else {
                                echo "<script>alert('Error upload');window.location = 'dataajaran.php';</script>";
                              }
                            }
                          }else {
                            mysqli_query($connect,"UPDATE siswa SET namasiswa='$nama', namapanggilan='$namapanggilan', nis='$nis', nisn='$nisn',tempatlahir='$tempatlahir',tgllahir='$tgllahir',jeniskelamin='$jeniskelamin',agama='$agama',alamat='$alamat',namaayah='$namaayah',pekerjaanayah='$pekerjaanayah',namaibu='$namaibu',pekerjaanibu='$pekerjaanibu',namawali='$namawali',alamatwali='$alamatwali',notelponwali='$notelponwali',pekerjaanwali='$pekerjaanwali' WHERE idsiswa='$idsis'");
                            header("location: dataajaran.php");
                          }
                          }
                        ?>

                          <label>Nama Siswa</label>
                              <input class="form-control" type="text" name="nama" value="<?php echo $tamsis['namasiswa'] ?>" required/>
                              <p class="help-block">Masukkan Nama Siswa.</p>

                          <label>Nama Panggilan Siswa</label>
                              <input class="form-control" type="text" name="nama" value="<?php echo $tamsis['namapanggilan'] ?>" required/>
                              <p class="help-block">Masukkan Nama Panggilan Siswa.</p>

                          <label>NIS Siswa</label>
                              <input class="form-control" type="text" name="nis" value="<?php echo $tamsis['nis'] ?>" required/>
                              <p class="help-block">Masukkan NIS Siswa.</p>

                          <label>NISN Siswa</label>
                              <input class="form-control" type="text" name="nisn" value="<?php echo $tamsis['nisn'] ?>" required/>
                              <p class="help-block">Masukkan NISN Siswa.</p>

                          <label>Tempat Lahir</label>
                              <input class="form-control" type="text" name="tempatlahir" value="<?php echo $tamsis['tempatlahir'] ?>" required/>
                              <p class="help-block">Masukkan Tempat Lahir Siswa.</p>

                          <label>Tanggal Lahir</label>
                              <input class="form-control" type="date" name="tgllahir" value="<?php echo $tamsis['tgllahir'] ?>" required/>
                              <p class="help-block">Masukkan Tanggal Lahir Siswa.</p>

                          <label>Jenis Kelamin</label>
                            <select name="jeniskelamin" class="form-control" value="<?php echo $tamsis['jeniskelamin'] ?>" required>
                              <option value="Laki-laki">Laki-laki</option>
                              <option value="Perempuan">Perempuan</option>
                            </select>
                            <p class="help-block">Masukkan Jenis Kelamin Siswa.</p>

                          <label>Agama</label>
                            <select name="agama" class="form-control" value="<?php echo $tamsis['agama'] ?>" required>
                              <option value="Islam">Islam</option>
                              <option value="Protestan">Protestan</option>
                              <option value="Katholik">Katholik</option>
                              <option value="Hindu">Hindu</option>
                              <option value="Budha">Budha</option>
                              <option value="Konghucu">Konghucu</option>
                            </select>
                            <p class="help-block">Masukkan Agama Siswa.</p>

                          <label>Alamat</label>
                            <textarea id="contact_list" name="alamat" class="form-control" required><?php echo $tamsis['alamat'] ?></textarea>
                            <p class="help-block">Masukkan Alamat Siswa.</p>

                          <label>Foto Siswa</label> <br>
                            <img src="<?php echo $tamsis['foto'] ?>" width="20%" height="20%"> <br>
                            <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" >
                            <p class="help-block">Masukkan Foto Siswa (Max 500 KB).</p>

                          <label>Nama Ayah</label>
                            <input class="form-control" type="text" name="namaayah" value="<?php echo $tamsis['namaayah'] ?>" required/>
                            <p class="help-block">Masukkan Nama Ayah Siswa.</p>

                          <label>Pekerjaan Ayah</label>
                            <input class="form-control" type="text" name="pekerjaanayah" value="<?php echo $tamsis['pekerjaanayah'] ?>" required/>
                            <p class="help-block">Masukkan Pekerjaan Ayah Siswa.</p>

                          <label>Nama Ibu</label>
                            <input class="form-control" type="text" name="namaibu" value="<?php echo $tamsis['namaibu'] ?>" required/>
                            <p class="help-block">Masukkan Nama Ibu Siswa.</p>

                          <label>Pekerjaan Ibu</label>
                            <input class="form-control" type="text" name="pekerjaanibu" value="<?php echo $tamsis['pekerjaanibu'] ?>" required/>
                            <p class="help-block">Masukkan Pekerjaan Ibu Siswa.</p>

                          <label>Nama Wali</label>
                              <input class="form-control" type="text" name="namawali" value="<?php echo $tamsis['namawali'] ?>" required/>
                              <p class="help-block">Masukkan Nama Wali Siswa.</p>

                          <label>Alamat Wali</label>
                              <textarea id="contact_list" name="alamatwali" class="form-control" required><?php echo $tamsis['alamatwali'] ?></textarea>
                              <p class="help-block">Masukkan Alamat Wali Siswa.</p>

                          <label>No. Telepon Wali</label>
                              <input class="form-control" type="text" name="notelponwali" value="<?php echo $tamsis['notelponwali'] ?>" required/>
                              <p class="help-block">Masukkan Nomor Telpon Wali Siswa.</p>

                          <label>Pekerjaan Wali</label>
                              <input class="form-control" type="text" name="pekerjaanwali" value="<?php echo $tamsis['pekerjaanwali'] ?>" required/>
                              <p class="help-block">Masukkan Pekerjaan Wali Siswa.</p>

                          <button type="submit" name="submit" class="btn btn-success">Ganti</button>
                      </form>
                    </div>
                </div>

                 <!-- /. ROW  -->
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
