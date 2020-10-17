<?php
include 'koneksi.php'; //connect the connection page

if(empty($_SESSION)) // if the session not yet started
   session_start();

if(!isset($_SESSION['username'])) { //if not yet logged in
   header("Location: index.php");// send to login page
   exit;
}
$ajaran = $_GET['id'];
$tanggal = $_GET['id2'];
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
   <style type="text/css" media="print">
   @media print {
  a[href]:after {
    content: none !important;
  }
   .header, .hide { visibility: hidden }
}
</style>

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
                     <h2>Rekap Harian</h2>
                     <button type="button" onclick="printDiv('printableArea')" class="btn btn-warning" align="right">Cetak</button>
                    </div>
                </div>
                 <!-- /. ROW  -->
                  <hr />
                  <div class="row">
                    <div id="printableArea">
                    <div class="col-md-12">
                        <?php
                        $gg="";
                        $sem="";
                        $q1 = mysqli_query($connect,"SELECT semester,namakelas,guru FROM ajaran WHERE idajaran='$ajaran'");
                        while ($d1 = mysqli_fetch_assoc($q1)) {
                          $gg=$d1['guru'];
                          $sem=$d1['semester'];
                          $q2 = mysqli_query($connect,"SELECT namaguru FROM users WHERE id='$gg'");
                          while ($d2 = mysqli_fetch_assoc($q2)) {
                            ?>
                              <h5>Informasi Data Rekap Dari Kelas <?php echo $d1['namakelas'] ?> Oleh <?php echo $d2['namaguru'] ?> Pada Tanggal <?php echo $tanggal ?></h5>
                            <?php
                          }
                         ?>
                        <?php
                        }
                         ?>
                         <b>Catatan :</b> <br>
                         <p>CHECKLIST = CL, HASIL KARYA = HK, CATATAN ANEKDOT = CA, N = Nilai Utama</p>
                        <table class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th rowspan="8">No</th>
                              <th rowspan="8">Nama</th>
                              <th colspan="12"><center>Aspek</center></th>
                            </tr>
                            <tr>
                              <td colspan="4">ASPEK PENGEMBANGAN NILAI<br>AGAMA DAN MORAL</td>
                              <td colspan="4">ASPEK PERKEMBANGAN FISIK<br>DAN MOTORIK</td>
                              <td colspan="4">ASPEK PERKEMBANGAN KOGNITIF</td>
                            </tr>
                            <tr>
                              <td colspan="12"><center><b>KD</b></center></td>
                            </tr>
                            <tr>
                              <?php
                              $tampilkd = mysqli_query($connect,"SELECT kd1nam,kd2fismot,kd3kog,kd4sosem,kd5bhs,kd6seni FROM harianumum WHERE tglharianumum='$tanggal' AND ajaran='$ajaran'");
                              $tampilkds = mysqli_fetch_assoc($tampilkd);
                              $kd1=$tampilkds['kd1nam'];
                              $kd2=$tampilkds['kd2fismot'];
                              $kd3=$tampilkds['kd3kog'];

                              $tampilkd1 = mysqli_query($connect,"SELECT inisial,kd FROM kd WHERE idkd='$kd1'");
                              $tampilkds1 = mysqli_fetch_assoc($tampilkd1);

                              $tampilkd2 = mysqli_query($connect,"SELECT inisial,kd FROM kd WHERE idkd='$kd2'");
                              $tampilkds2 = mysqli_fetch_assoc($tampilkd2);

                              $tampilkd3 = mysqli_query($connect,"SELECT inisial,kd FROM kd WHERE idkd='$kd3'");
                              $tampilkds3 = mysqli_fetch_assoc($tampilkd3);
                               ?>
                               <td colspan="4"><?php echo $tampilkds1['inisial']." ". $tampilkds1['kd']; ?></td>
                               <td colspan="4"><?php echo $tampilkds2['inisial']." ". $tampilkds2['kd']; ?></td>
                               <td colspan="4"><?php echo $tampilkds3['inisial']." ". $tampilkds3['kd']; ?></td>
                            </tr>
                            <tr>
                              <td colspan="12"><center><b>Indikator</b></center></td>
                            </tr>
                            <tr>
                              <?php
                              $tampilindikator = mysqli_query($connect,"SELECT indikator1,indikator2,indikator3,indikator4,indikator5,indikator6 FROM harianumum WHERE tglharianumum='$tanggal' AND ajaran='$ajaran'");
                              $tampilindikators = mysqli_fetch_assoc($tampilindikator);
                              $ind1=$tampilindikators['indikator1'];
                              $ind2=$tampilindikators['indikator2'];
                              $ind3=$tampilindikators['indikator3'];

                              $tampolindik1 = mysqli_query($connect,"SELECT indik FROM indikator WHERE idindi='$ind1'");
                              $tampilindiks1 = mysqli_fetch_assoc($tampolindik1);
                              $tampolindik2 = mysqli_query($connect,"SELECT indik FROM indikator WHERE idindi='$ind2'");
                              $tampilindiks2 = mysqli_fetch_assoc($tampolindik2);
                              $tampolindik3 = mysqli_query($connect,"SELECT indik FROM indikator WHERE idindi='$ind3'");
                              $tampilindiks3 = mysqli_fetch_assoc($tampolindik3);

                               ?>
                               <td colspan="4"><?php echo $tampilindiks1['indik'] ?></td>
                               <td colspan="4"><?php echo $tampilindiks2['indik'] ?></td>
                               <td colspan="4"><?php echo $tampilindiks3['indik'] ?></td>
                            </tr>
                            <tr>
                              <td colspan="12"><center><b>Alat Penilaian</b></center></td>
                            </tr>
                            <tr>
                              <?php
                              for($ap=1;$ap<=3;$ap++){
                                ?>
                                <td>CL</td>
                                <td>HK</td>
                                <td>CA</td>
                                <td>N</td>
                                <?php
                                }
                                ?>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $notcok=1;
                            $querysiswa = mysqli_query($connect,"SELECT idharianumum,siswa,nilainam1,nilainam2,nilainam3,nilainam4,nilaifismot1,nilaifismot2,nilaifismot3,nilaifismot4,nilaikog1,nilaikog2,nilaikog3,nilaikog4 FROM harianumum WHERE tglharianumum='$tanggal' AND ajaran='$ajaran'");
                            while ($outputsiswa = mysqli_fetch_array($querysiswa)) {
                              ?>
                              <tr>
                                <td><?php echo $notcok++ ?></td>
                                <?php
                                $cartok = $outputsiswa['siswa'];
                                $tampilmurid = mysqli_query($connect,"SELECT namapanggilan FROM siswa WHERE idsiswa='$cartok'");
                                $tampilmurids = mysqli_fetch_assoc($tampilmurid);
                                 ?>
                                <td><a href="rekapharianumumdetail.php?id=<?php echo $outputsiswa['idharianumum'] ?>"><?php echo $tampilmurids['namapanggilan'] ?></a></td>
                                <td><?php echo $outputsiswa['nilainam1'] ?></td>
                                <td><?php echo $outputsiswa['nilainam2'] ?></td>
                                <td><?php echo $outputsiswa['nilainam3'] ?></td>
                                <td><?php echo $outputsiswa['nilainam4'] ?></td>

                                <td><?php echo $outputsiswa['nilaifismot1'] ?></td>
                                <td><?php echo $outputsiswa['nilaifismot2'] ?></td>
                                <td><?php echo $outputsiswa['nilaifismot3'] ?></td>
                                <td><?php echo $outputsiswa['nilaifismot4'] ?></td>

                                <td><?php echo $outputsiswa['nilaikog1'] ?></td>
                                <td><?php echo $outputsiswa['nilaikog2'] ?></td>
                                <td><?php echo $outputsiswa['nilaikog3'] ?></td>
                                <td><?php echo $outputsiswa['nilaikog4'] ?></td>

                              </tr>
                            <?php
                              }
                             ?>

                          </tbody>
                        </table>

                        <table class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th rowspan="8">No</th>
                              <th rowspan="8">Nama</th>
                              <th colspan="12"><center>Aspek</center></th>
                            </tr>
                            <tr>
                              <td colspan="4">ASPEK SOSIAL EMOSIONAL</td>
                              <td colspan="4">ASPEK PERKEMBANGAN BAHASA</td>
                              <td colspan="4">ASPEK PENGEMBANGAN SENI</td>
                            </tr>
                            <tr>
                              <td colspan="12"><center><b>KD</b></center></td>
                            </tr>
                            <tr>
                              <?php

                              $kd4=$tampilkds['kd4sosem'];
                              $kd5=$tampilkds['kd5bhs'];
                              $kd6=$tampilkds['kd6seni'];

                              $tampilkd4 = mysqli_query($connect,"SELECT inisial,kd FROM kd WHERE idkd='$kd4'");
                              $tampilkds4 = mysqli_fetch_assoc($tampilkd4);

                              $tampilkd5 = mysqli_query($connect,"SELECT inisial,kd FROM kd WHERE idkd='$kd5'");
                              $tampilkds5 = mysqli_fetch_assoc($tampilkd5);

                              $tampilkd6 = mysqli_query($connect,"SELECT inisial,kd FROM kd WHERE idkd='$kd6'");
                              $tampilkds6 = mysqli_fetch_assoc($tampilkd6);
                               ?>
                               <td colspan="4"><?php echo $tampilkds4['inisial']." ". $tampilkds4['kd']; ?></td>
                               <td colspan="4"><?php echo $tampilkds5['inisial']." ". $tampilkds5['kd']; ?></td>
                               <td colspan="4"><?php echo $tampilkds6['inisial']." ". $tampilkds6['kd']; ?></td>
                            </tr>
                            <tr>
                              <td colspan="12"><center><b>Indikator</b></center></td>
                            </tr>
                            <tr>
                              <?php

                              $ind4=$tampilindikators['indikator4'];
                              $ind5=$tampilindikators['indikator5'];
                              $ind6=$tampilindikators['indikator6'];

                              $tampolindik4 = mysqli_query($connect,"SELECT indik FROM indikator WHERE idindi='$ind4'");
                              $tampilindiks4 = mysqli_fetch_assoc($tampolindik4);
                              $tampolindik5 = mysqli_query($connect,"SELECT indik FROM indikator WHERE idindi='$ind5'");
                              $tampilindiks5 = mysqli_fetch_assoc($tampolindik5);
                              $tampolindik6 = mysqli_query($connect,"SELECT indik FROM indikator WHERE idindi='$ind6'");
                              $tampilindiks6 = mysqli_fetch_assoc($tampolindik6);
                               ?>

                               <td colspan="4"><?php echo $tampilindiks4['indik'] ?></td>
                               <td colspan="4"><?php echo $tampilindiks5['indik'] ?></td>
                               <td colspan="4"><?php echo $tampilindiks6['indik'] ?></td>
                            </tr>
                            <tr>
                              <td colspan="12"><center><b>Alat Penilaian</b></center></td>
                            </tr>
                            <tr>
                              <?php
                              for($ap=1;$ap<=3;$ap++){
                                ?>
                                <td>CL</td>
                                <td>HK</td>
                                <td>CA</td>
                                <td>N</td>
                                <?php
                                }
                                ?>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $notcok1=1;
                            $querysiswa1 = mysqli_query($connect,"SELECT idharianumum,siswa,nilaisosem1,nilaisosem2,nilaisosem3,nilaisosem4,nilaibhs1,nilaibhs2,nilaibhs3,nilaibhs4,nilaiseni1,nilaiseni2,nilaiseni3,nilaiseni4 FROM harianumum WHERE tglharianumum='$tanggal' AND ajaran='$ajaran'");
                            while ($outputsiswa1 = mysqli_fetch_array($querysiswa1)) {
                              ?>
                              <tr>
                                <td><?php echo $notcok1++ ?></td>
                                <?php
                                $cartok1 = $outputsiswa1['siswa'];
                                $tampilmurid1 = mysqli_query($connect,"SELECT namapanggilan FROM siswa WHERE idsiswa='$cartok1'");
                                $tampilmurids1 = mysqli_fetch_assoc($tampilmurid1);
                                 ?>
                                <td><a href="rekapharianumumdetail.php?id=<?php echo $outputsiswa1['idharianumum'] ?>"><?php echo $tampilmurids1['namapanggilan'] ?></a></td>
                                <td><?php echo $outputsiswa1['nilaisosem1'] ?></td>
                                <td><?php echo $outputsiswa1['nilaisosem2'] ?></td>
                                <td><?php echo $outputsiswa1['nilaisosem3'] ?></td>
                                <td><?php echo $outputsiswa1['nilaisosem4'] ?></td>

                                <td><?php echo $outputsiswa1['nilaibhs1'] ?></td>
                                <td><?php echo $outputsiswa1['nilaibhs2'] ?></td>
                                <td><?php echo $outputsiswa1['nilaibhs3'] ?></td>
                                <td><?php echo $outputsiswa1['nilaibhs4'] ?></td>

                                <td><?php echo $outputsiswa1['nilaiseni1'] ?></td>
                                <td><?php echo $outputsiswa1['nilaiseni2'] ?></td>
                                <td><?php echo $outputsiswa1['nilaiseni3'] ?></td>
                                <td><?php echo $outputsiswa1['nilaiseni4'] ?></td>

                              </tr>
                            <?php
                              }
                             ?>

                          </tbody>
                        </table>
                    </div> <br> <br>
                    <div class="col-md-12">
                      <label>Report :</label>
                      <p>Hore, proses belajar mengajar pada hari ini telah mencapai beberapa kriteria indikator yang meliputi
                        <br><?php echo $tampilkds1['inisial']?> <?php echo $tampilindiks1['indik'] ?> (ASPEK PENGEMBANGAN NILAI AGAMA DAN MORAL)
                        <br><?php echo $tampilkds2['inisial']?> <?php echo $tampilindiks2['indik'] ?> (ASPEK PERKEMBANGAN FISIK DAN MOTORIK)
                        <br><?php echo $tampilkds3['inisial']?> <?php echo $tampilindiks3['indik'] ?> (ASPEK PERKEMBANGAN KOGNITIF)
                        <br><?php echo $tampilkds4['inisial']?> <?php echo $tampilindiks4['indik'] ?> (ASPEK SOSIAL EMOSIONAL)
                        <br><?php echo $tampilkds5['inisial']?> <?php echo $tampilindiks5['indik'] ?> (ASPEK PERKEMBANGAN BAHASA)
                        <br><?php echo $tampilkds6['inisial']?> <?php echo $tampilindiks6['indik'] ?> (ASPEK PENGEMBANGAN SENI)
                      </p>
                      <center> <br> <br>
                      <table width="75%">
                        <tr>
                          <td rowspan="2"></td>
                          <td>Semester : <?php echo $sem ?></td>
                        </tr>
                        <tr>
                          <?php
                          $ty = $_SESSION['sekolah'];
                          $oks = mysqli_query($connect,"SELECT * FROM sekolah WHERE idsekolah='$ty'");
                          $okis = mysqli_fetch_assoc($oks);
                           ?>
                          <td><?php echo $okis['kabupaten'] ?>, <?php echo date('d M Y') ?></td>
                        </tr>
                        <tr>
                          <td>TK <?php echo $okis['namasekolah'] ?></td>
                        </tr>
                        <tr>
                          <td>Kepala Sekolah</td>
                          <td>Guru</td>
                        </tr>
                        <tr>
                          <td> <br> </td>
                        </tr>
                        <tr>
                          <td> <br> </td>
                        </tr>
                        <tr>
                          <td> <br> </td>
                        </tr>
                        <tr>
                          <td><b><u><?php echo $okis['kepalasekolah'] ?></u></b></td>
                          <td><b><u><?php echo $_SESSION['namaguru'] ?></u></b></td>
                        </tr>
                        <tr>
                          <td>NIP : -</td>
                          <td>NIP : -</td>
                        </tr>
                      </table>
                    </center>
                    </div>
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
    <script type="text/javascript">
    function printDiv(divName) {
   var printContents = document.getElementById(divName).innerHTML;
   var originalContents = document.body.innerHTML;

   document.body.innerHTML = printContents;

   window.print();

   document.body.innerHTML = originalContents;
}
    </script>
</body>
</html>
