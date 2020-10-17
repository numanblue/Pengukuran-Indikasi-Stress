<?php
include 'koneksi.php'; //connect the connection page

if(empty($_SESSION)) // if the session not yet started
   session_start();

if(!isset($_SESSION['username'])) { //if not yet logged in
   header("Location: index.php");// send to login page
   exit;
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
                            if($_FILES['fileToUpload']['name'] == "") {
                              mysqli_query($connect,"INSERT INTO siswa VALUES('','$nama','$namapanggilan','$nis','$nisn','$tempatlahir','$tgllahir','$jeniskelamin','$agama','$alamat','','$namaayah','$pekerjaanayah','$namaibu','$pekerjaanibu','$namawali','$alamatwali','$notelponwali','$pekerjaanwali','$ajaran')");
                              header("location: dataajaran.php");
                            }else{
                              if($check !== false) {
                                $uploadOk = 1;
                              } else {
                                echo "<script>alert('File bukan gambar');window.location = 'tambahsiswa.php';</script>";
                                $uploadOk = 0;
                              }
                              if ($_FILES["fileToUpload"]["size"] > 500000) {
                                echo "<script>alert('File gambar lebih dari 500 KB');window.location = 'tambahsiswa.php';</script>";
                                $uploadOk = 0;
                              }
                              if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                              && $imageFileType != "gif" ) {
                                echo "<script>alert('Hanya file gambar jpg, jpeg, png, dan gif yang diperbolehkan');window.location = 'tambahsiswa.php';</script>";
                                $uploadOk = 0;
                              }
                              if ($uploadOk == 0) {
                                echo "<script>alert('Error');window.location = 'tambahsiswa.php';</script>";
                              } else {
                                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.md5($namafoto).'.'.$imageFileType)) {
                                  $hasilfoto = $target_dir.md5($namafoto).'.'.$imageFileType;
                                  mysqli_query($connect,"INSERT INTO siswa VALUES('','$nama','$nis','$nisn','$tempatlahir','$tgllahir','$jeniskelamin','$agama','$alamat','$hasilfoto','$namaayah','$pekerjaanayah','$namaibu','$pekerjaanibu','$namawali','$alamatwali','$notelponwali','$pekerjaanwali','$ajaran')");
                                  header("location: dataajaran.php");
                                } else {
                                  echo "<script>alert('Error upload');window.location = 'tambahsiswa.php';</script>";
                                }
                              }
                            }

                          }
                        ?>
                        <label>Pilih Ajaran</label>
                            <?php
                            $idnya = $_SESSION['id'];
                            $query_mysql2 = mysqli_query($connect,"SELECT * FROM ajaran WHERE guru='$idnya'")or die(mysql_error());
                            if (mysqli_num_rows($query_mysql2) !=0){
                              ?>
                              <select name="ajaran" class="form-control" required>
                              <?php
                            while($data2 = mysqli_fetch_array($query_mysql2)){
                             ?>
                             <option value="<?php echo $data2['idajaran'] ?>"><?php echo $data2['kelas'] ?> | <?php echo $data2['namakelas'] ?> | <?php echo $data2['semester'] ?> | <?php echo $data2['tahunajaran'] ?></option>
                          <?php
                            }?>
                              </select>
                        <?php
                        }else{
                        ?>
                          <select name="ajaran" class="form-control" disabled required>
                            <option value="">Tak ada Data Ajaran</option>
                          </select>
                        <?php
                        }   ?>

                          <p class="help-block">Pilih Periode Ajaran.</p>

                          <label>Nama Siswa</label>
                              <input class="form-control" type="text" name="nama" required/>
                              <p class="help-block">Masukkan Nama Siswa.</p>

                          <label>Nama Panggilan Siswa</label>
                              <input class="form-control" type="text" name="namapanggilan" required/>
                              <p class="help-block">Masukkan Nama Panggilan Siswa.</p>

                          <label>NIS Siswa</label>
                              <input class="form-control" type="text" name="nis" required/>
                              <p class="help-block">Masukkan NIS Siswa.</p>

                          <label>NISN Siswa</label>
                              <input class="form-control" type="text" name="nisn" value="" />
                              <p class="help-block">Masukkan NISN Siswa.</p>

                          <label>Tempat Lahir</label>
                              <input class="form-control" type="text" name="tempatlahir" required/>
                              <p class="help-block">Masukkan Tempat Lahir Siswa.</p>

                          <label>Tanggal Lahir</label>
                              <input class="form-control" type="date" name="tgllahir" required/>
                              <p class="help-block">Masukkan Tanggal Lahir Siswa.</p>

                          <label>Jenis Kelamin</label>
                            <select name="jeniskelamin" class="form-control" required>
                              <option value="Laki-laki">Laki-laki</option>
                              <option value="Perempuan">Perempuan</option>
                            </select>
                            <p class="help-block">Masukkan Jenis Kelamin Siswa.</p>

                          <label>Agama</label>
                            <select name="agama" class="form-control" required>
                              <option value="Islam">Islam</option>
                              <option value="Protestan">Protestan</option>
                              <option value="Katholik">Katholik</option>
                              <option value="Hindu">Hindu</option>
                              <option value="Budha">Budha</option>
                              <option value="Konghucu">Konghucu</option>
                            </select>
                            <p class="help-block">Masukkan Agama Siswa.</p>

                          <label>Alamat</label>
                            <textarea id="contact_list" name="alamat" class="form-control" required></textarea>
                            <p class="help-block">Masukkan Alamat Siswa.</p>

                          <label>Foto Siswa</label>
                            <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                            <p class="help-block">Masukkan Foto Siswa (Max 500 KB).</p>

                          <label>Nama Ayah</label>
                            <input class="form-control" type="text" name="namaayah" required/>
                            <p class="help-block">Masukkan Nama Ayah Siswa.</p>

                          <label>Pekerjaan Ayah</label>
                            <input class="form-control" type="text" name="pekerjaanayah" required/>
                            <p class="help-block">Masukkan Pekerjaan Ayah Siswa.</p>

                          <label>Nama Ibu</label>
                            <input class="form-control" type="text" name="namaibu" required/>
                            <p class="help-block">Masukkan Nama Ibu Siswa.</p>

                          <label>Pekerjaan Ibu</label>
                            <input class="form-control" type="text" name="pekerjaanibu" required/>
                            <p class="help-block">Masukkan Pekerjaan Ibu Siswa.</p>

                          <label>Nama Wali</label>
                              <input class="form-control" type="text" name="namawali" required/>
                              <p class="help-block">Masukkan Nama Wali Siswa.</p>

                          <label>Alamat Wali</label>
                              <textarea id="contact_list" name="alamatwali" class="form-control" required></textarea>
                              <p class="help-block">Masukkan Alamat Wali Siswa.</p>

                          <label>No. Telepon Wali</label>
                              <input class="form-control" type="text" name="notelponwali" required/>
                              <p class="help-block">Masukkan Nomor Telpon Wali Siswa.</p>

                          <label>Pekerjaan Wali</label>
                              <input class="form-control" type="text" name="pekerjaanwali" required/>
                              <p class="help-block">Masukkan Pekerjaan Wali Siswa.</p>

                          <button type="submit" name="submit" class="btn btn-success">Tambah</button>
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
