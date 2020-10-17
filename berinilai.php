<?php
include 'koneksi.php'; //connect the connection page

if(empty($_SESSION)) // if the session not yet started
   session_start();

if(!isset($_SESSION['username'])) { //if not yet logged in
   header("Location: index.php");// send to login page
   exit;
}
$idajaran = $_GET['id'];
$cekus=$_SESSION['id'];
$idus= "";
$idscoli="";
$jenisscoli="";
$jenengkelas="";
$query1 = mysqli_query($connect,"SELECT namakelas,guru FROM ajaran WHERE idajaran='$idajaran'");
while ($datat = mysqli_fetch_array($query1)) {
  $idus=$datat['guru'];
  $jenengkelas=$datat['namakelas'];
  if($idus!=$cekus){
    header("Location: dataajaran.php");// send to login page
  }else{
    $query2 = mysqli_query($connect,"SELECT sekolah FROM users WHERE id='$idus'");
    while ($datatot = mysqli_fetch_array($query2)) {
      $idscoli=$datatot['sekolah'];
      $query3 = mysqli_query($connect,"SELECT jenis FROM sekolah WHERE idsekolah='$idscoli'");
      while ($datatott = mysqli_fetch_array($query3)) {
        $jenisscoli=$datatott['jenis'];
      }
    }
  }
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
                     <h2>Beri Nilai Harian</h2>
                    </div>
                </div>
                 <!-- /. ROW  -->
                  <hr />
                  <div class="row">
                    <div class="col-md-12" style="overflow-x: auto;white-space: nowrap;">
                        <h5><?php echo $jenengkelas ?> | <?php echo $jenisscoli ?></h5>
                        <form class="" action="" method="post">
                          <?php
                          if(isset($_POST['submit'])){
                            $tglharian = $_POST['tglharian'];
                            if ($jenisscoli == "Umum") {
                              $ajarantol = $_POST['ajaran'];
                              $guru = $_SESSION['id'];
                              $kd1nam = $_POST['kd1nam'];
                              $kd2fismot = $_POST['kd2fismot'];
                              $kd3kog = $_POST['kd3kog'];
                              $kd4sosem = $_POST['kd4sosem'];
                              $kd5bhs = $_POST['kd5bhs'];
                              $kd6seni = $_POST['kd6seni'];

                              $indikator1 = htmlspecialchars($_POST['indikator1']);
                              $indikator2 = htmlspecialchars($_POST['indikator2']);
                              $indikator3 = htmlspecialchars($_POST['indikator3']);
                              $indikator4 = htmlspecialchars($_POST['indikator4']);
                              $indikator5 = htmlspecialchars($_POST['indikator5']);
                              $indikator6 = htmlspecialchars($_POST['indikator6']);
                              for($i=0;$i<$_POST['jumlah'];$i++){
                                $idsiswa = $_POST['idsiswa'.$i];
                                $nilai1nam = $_POST['nilai1nam'.$i];
                                $nilai2nam = $_POST['nilai2nam'.$i];
                                $nilai3nam = $_POST['nilai3nam'.$i];
                                $nilai4nam = max((int)$nilai1nam,(int)$nilai2nam,(int)$nilai3nam);

                                $nilai1fismot = $_POST['nilai1fismot'.$i];
                                $nilai2fismot = $_POST['nilai2fismot'.$i];
                                $nilai3fismot = $_POST['nilai3fismot'.$i];
                                $nilai4fismot = max((int)$nilai1fismot,(int)$nilai2fismot,(int)$nilai3fismot);

                                $nilai1kog = $_POST['nilai1kog'.$i];
                                $nilai2kog = $_POST['nilai2kog'.$i];
                                $nilai3kog = $_POST['nilai3kog'.$i];
                                $nilai4kog = max((int)$nilai1kog,(int)$nilai2kog,(int)$nilai3kog);

                                $nilai1sosem = $_POST['nilai1sosem'.$i];
                                $nilai2sosem = $_POST['nilai2sosem'.$i];
                                $nilai3sosem = $_POST['nilai3sosem'.$i];
                                $nilai4sosem = max((int)$nilai1sosem,(int)$nilai2sosem,(int)$nilai3sosem);

                                $nilai1bhs = $_POST['nilai1bhs'.$i];
                                $nilai2bhs = $_POST['nilai2bhs'.$i];
                                $nilai3bhs = $_POST['nilai3bhs'.$i];
                                $nilai4bhs = max((int)$nilai1bhs,(int)$nilai2bhs,(int)$nilai3bhs);

                                $nilai1seni = $_POST['nilai1seni'.$i];
                                $nilai2seni = $_POST['nilai2seni'.$i];
                                $nilai3seni = $_POST['nilai3seni'.$i];
                                $nilai4seni = max((int)$nilai1seni,(int)$nilai2seni,(int)$nilai3seni);

                                $cekq = mysqli_query($connect,"SELECT tglharianumum,siswa FROM harianumum WHERE tglharianumum='$tglharian' AND siswa='$idsiswa'");
                                $cekqs= mysqli_fetch_assoc($cekq);
                                if($cekqs['tglharianumum'] == $tglharian && $cekqs['siswa'] == $idsiswa){
                                  echo "<script>alert('Tanggal Dan kelas ini sudah pernah diberi nilai');window.location = 'dataajaran.php';</script>";
                                }else{
                                  mysqli_query($connect,"INSERT INTO harianumum VALUES('','$tglharian','$idsiswa','$ajarantol','$guru',
                                    '$kd1nam','$indikator1','$nilai1nam','$nilai2nam','$nilai3nam','$nilai4nam',
                                    '$kd2fismot','$indikator2','$nilai1fismot','$nilai2fismot','$nilai3fismot','$nilai4fismot',
                                    '$kd3kog','$indikator3','$nilai1kog','$nilai2kog','$nilai3kog','$nilai4kog',
                                    '$kd4sosem','$indikator4','$nilai1sosem','$nilai2sosem','$nilai3sosem','$nilai4sosem',
                                    '$kd5bhs','$indikator5','$nilai1bhs','$nilai2bhs','$nilai3bhs','$nilai4bhs',
                                    '$kd6seni','$indikator6','$nilai1seni','$nilai2seni','$nilai3seni','$nilai4seni')");
                                  header("location: dataajaran.php");
                                }
                              }
                            }
                          }
                           ?>
                          <label>Tanggal</label>
                          <input type="date" name="tglharian" class="form-control" value="<?php echo date('Y-m-d') ?>" required/> <br>
                          <b>Catatan :</b> <br>
                          <p>CHECKLIST = CL, HASIL KARYA = HK, CATATAN ANEKDOT = CA</p>
                          <?php
                          if ($jenisscoli == "Umum") {
                          ?>
                            <table class="table table-striped table-bordered table-hover">
                              <tr>
                                <td rowspan="8">Nama Siswa</td>
                                <td colspan="18"><center>Aspek</center></td>
                              </tr>
                              <tr>
                                <?php
                                $tampilaspek = mysqli_query($connect,"SELECT aspek FROM aspek WHERE jenis='$jenisscoli'");
                                while ($outputaspek = mysqli_fetch_array($tampilaspek)) {
                                 ?>
                                <td colspan="3"><?php echo $outputaspek['aspek'] ?></td>
                                <?php
                                }
                                 ?>
                              </tr>
                              <tr>
                                <td colspan="18"><center>KD</center></td>
                              </tr>
                              <tr>
                                <td colspan="3">
                                  <select name="kd1nam" class="form-control" required>
                                  <?php
                                  $querykd1 = mysqli_query($connect,"SELECT * FROM kd WHERE aspek='1'")or die(mysql_error());
                                  while($tampilkd1 = mysqli_fetch_array($querykd1)){
                                  ?>
                                  <option value="<?php echo $tampilkd1['idkd'] ?>"><?php echo $tampilkd1['inisial'] ?> | <?php echo $tampilkd1['kd'] ?></option>
                                  <?php
                                  }?>
                                  </select>
                                </td>
                                <td colspan="3">
                                  <select name="kd2fismot" class="form-control" required>
                                  <?php
                                  $querykd2 = mysqli_query($connect,"SELECT * FROM kd WHERE aspek='2'")or die(mysql_error());
                                  while($tampilkd2 = mysqli_fetch_array($querykd2)){
                                  ?>
                                  <option value="<?php echo $tampilkd2['idkd'] ?>"><?php echo $tampilkd2['inisial'] ?> | <?php echo $tampilkd2['kd'] ?></option>
                                  <?php
                                  }?>
                                  </select>
                                </td>
                                <td colspan="3">
                                  <select name="kd3kog" class="form-control" required>
                                  <?php
                                  $querykd3 = mysqli_query($connect,"SELECT * FROM kd WHERE aspek='3'")or die(mysql_error());
                                  while($tampilkd3 = mysqli_fetch_array($querykd3)){
                                  ?>
                                  <option value="<?php echo $tampilkd3['idkd'] ?>"><?php echo $tampilkd3['inisial'] ?> | <?php echo $tampilkd3['kd'] ?></option>
                                  <?php
                                  }?>
                                  </select>
                                </td>
                                <td colspan="3">
                                  <select name="kd4sosem" class="form-control" required>
                                  <?php
                                  $querykd4 = mysqli_query($connect,"SELECT * FROM kd WHERE aspek='4'")or die(mysql_error());
                                  while($tampilkd4 = mysqli_fetch_array($querykd4)){
                                  ?>
                                  <option value="<?php echo $tampilkd4['idkd'] ?>"><?php echo $tampilkd4['inisial'] ?> | <?php echo $tampilkd4['kd'] ?></option>
                                  <?php
                                  }?>
                                  </select>
                                </td>
                                <td colspan="3">
                                  <select name="kd5bhs" class="form-control" required>
                                  <?php
                                  $querykd5 = mysqli_query($connect,"SELECT * FROM kd WHERE aspek='5'")or die(mysql_error());
                                  while($tampilkd5 = mysqli_fetch_array($querykd5)){
                                  ?>
                                  <option value="<?php echo $tampilkd5['idkd'] ?>"><?php echo $tampilkd5['inisial'] ?> | <?php echo $tampilkd5['kd'] ?></option>
                                  <?php
                                  }?>
                                  </select>
                                </td>
                                <td colspan="3">
                                  <select name="kd6seni" class="form-control" required>
                                  <?php
                                  $querykd6 = mysqli_query($connect,"SELECT * FROM kd WHERE aspek='6'")or die(mysql_error());
                                  while($tampilkd6 = mysqli_fetch_array($querykd6)){
                                  ?>
                                  <option value="<?php echo $tampilkd6['idkd'] ?>"><?php echo $tampilkd6['inisial'] ?> | <?php echo $tampilkd6['kd'] ?></option>
                                  <?php
                                  }?>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="18"><center>Indikator</center></td>
                              </tr>
                              <tr>
                                <td colspan="3">
                                  <select name="indikator1" class="form-control">
                                  <?php
                                    $qqq1 = mysqli_query($connect,"SELECT * FROM indikator WHERE guru='$cekus' AND aspek='1'");
                                    while($tammm1 = mysqli_fetch_array($qqq1)){
                                  ?>
                                      <option value="<?php echo $tammm1['idindi'] ?>"><?php echo $tammm1['indik'] ?></option>
                                  <?php
                                    }
                                  ?>
                                  </select>
                                </td>
                                <td colspan="3">
                                  <select name="indikator2" class="form-control">
                                  <?php
                                    $qqq2 = mysqli_query($connect,"SELECT * FROM indikator WHERE guru='$cekus' AND aspek='2'");
                                    while($tammm2 = mysqli_fetch_array($qqq2)){
                                  ?>
                                      <option value="<?php echo $tammm2['idindi'] ?>"><?php echo $tammm2['indik'] ?></option>
                                  <?php
                                    }
                                  ?>
                                  </select>
                                </td>
                                <td colspan="3">
                                  <select name="indikator3" class="form-control">
                                  <?php
                                    $qqq3 = mysqli_query($connect,"SELECT * FROM indikator WHERE guru='$cekus' AND aspek='3'");
                                    while($tammm3 = mysqli_fetch_array($qqq3)){
                                  ?>
                                      <option value="<?php echo $tammm3['idindi'] ?>"><?php echo $tammm3['indik'] ?></option>
                                  <?php
                                    }
                                  ?>
                                  </select>
                                </td>
                                <td colspan="3">
                                  <select name="indikator4" class="form-control">
                                  <?php
                                    $qqq4 = mysqli_query($connect,"SELECT * FROM indikator WHERE guru='$cekus' AND aspek='4'");
                                    while($tammm4 = mysqli_fetch_array($qqq4)){
                                  ?>
                                      <option value="<?php echo $tammm4['idindi'] ?>"><?php echo $tammm4['indik'] ?></option>
                                  <?php
                                    }
                                  ?>
                                  </select>
                                </td>
                                <td colspan="3">
                                  <select name="indikator5" class="form-control">
                                  <?php
                                    $qqq5 = mysqli_query($connect,"SELECT * FROM indikator WHERE guru='$cekus' AND aspek='5'");
                                    while($tammm5 = mysqli_fetch_array($qqq5)){
                                  ?>
                                      <option value="<?php echo $tammm5['idindi'] ?>"><?php echo $tammm5['indik'] ?></option>
                                  <?php
                                    }
                                  ?>
                                  </select>
                                </td>
                                <td colspan="3">
                                  <select name="indikator6" class="form-control">
                                  <?php
                                    $qqq6 = mysqli_query($connect,"SELECT * FROM indikator WHERE guru='$cekus' AND aspek='6'");
                                    while($tammm6 = mysqli_fetch_array($qqq6)){
                                  ?>
                                      <option value="<?php echo $tammm6['idindi'] ?>"><?php echo $tammm6['indik'] ?></option>
                                  <?php
                                    }
                                  ?>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="18"><center>Alat Penilaian</center></td>
                              </tr>
                              <tr>
                                <?php
                                for($ap=1;$ap<=6;$ap++){
                                  ?>
                                  <td>CL</td>
                                  <td>HK</td>
                                  <td>CA</td>
                                  <?php
                                  }
                                  ?>

                              </tr>
                              <?php
                                  $querysiswa = mysqli_query($connect,"SELECT * FROM siswa WHERE ajaran='$idajaran'");
                                  $totalsiswa = mysqli_num_rows($querysiswa);
                                  $nambah=0;
                                  while($tampilindong = mysqli_fetch_array($querysiswa)){

                              ?>
                              <tr>
                                <td><input type="hidden" name="ajaran" value="<?php echo $idajaran ?>"> <input type="hidden" name="idsiswa<?php echo $nambah?>" value="<?php echo $tampilindong['idsiswa'] ?>" /><?php echo $tampilindong['namasiswa'] ?></td>
                                <td><input type="number" min="1" max="4" class="form-control" name="nilai1nam<?php echo $nambah?>" required></td>
                                <td><input type="number" min="1" max="4" class="form-control" name="nilai2nam<?php echo $nambah?>" required></td>
                                <td><input type="number" min="1" max="4" class="form-control" name="nilai3nam<?php echo $nambah?>" required></td>

                                <td><input type="number" min="1" max="4" class="form-control" name="nilai1fismot<?php echo $nambah?>" required></td>
                                <td><input type="number" min="1" max="4" class="form-control" name="nilai2fismot<?php echo $nambah?>" required></td>
                                <td><input type="number" min="1" max="4" class="form-control" name="nilai3fismot<?php echo $nambah?>" required></td>

                                <td><input type="number" min="1" max="4" class="form-control" name="nilai1kog<?php echo $nambah?>" required></td>
                                <td><input type="number" min="1" max="4" class="form-control" name="nilai2kog<?php echo $nambah?>" required></td>
                                <td><input type="number" min="1" max="4" class="form-control" name="nilai3kog<?php echo $nambah?>" required></td>

                                <td><input type="number" min="1" max="4" class="form-control" name="nilai1sosem<?php echo $nambah?>" required></td>
                                <td><input type="number" min="1" max="4" class="form-control" name="nilai2sosem<?php echo $nambah?>" required></td>
                                <td><input type="number" min="1" max="4" class="form-control" name="nilai3sosem<?php echo $nambah?>" required></td>

                                <td><input type="number" min="1" max="4" class="form-control" name="nilai1bhs<?php echo $nambah?>" required></td>
                                <td><input type="number" min="1" max="4" class="form-control" name="nilai2bhs<?php echo $nambah?>" required></td>
                                <td><input type="number" min="1" max="4" class="form-control" name="nilai3bhs<?php echo $nambah?>" required></td>

                                <td><input type="number" min="1" max="4" class="form-control" name="nilai1seni<?php echo $nambah?>" required></td>
                                <td><input type="number" min="1" max="4" class="form-control" name="nilai2seni<?php echo $nambah?>" required></td>
                                <td><input type="number" min="1" max="4" class="form-control" name="nilai3seni<?php echo $nambah?>" required></td>

                              </tr>
                              <?php
                                  $nambah=$nambah+1;
                                  }
                              ?>
                              <input type="hidden" name="jumlah" value="<?php echo $nambah; ?>">
                            </table>
                          <?php
                          }
                           ?>
                           <button type="submit" name="submit" class="btn btn-success">Oke</button>
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
