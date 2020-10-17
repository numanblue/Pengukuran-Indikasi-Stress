<?php
include 'koneksi.php'; //connect the connection page

if(empty($_SESSION)) // if the session not yet started
   session_start();

if(!isset($_SESSION['username'])) { //if not yet logged in
   header("Location: index.php");// send to login page
   exit;
}

$idajaran = $_POST['ajaran'];
$tglawal = $_POST['tglawal'];
$tglakhir = $_POST['tglakhir'];
$cekus=$_SESSION['id'];
$idus= "";
$idscoli="";
$jenisscoli="";
$jenengkelas="";
$query1 = mysqli_query($connect,"SELECT namakelas,guru,semester FROM ajaran WHERE idajaran='$idajaran'");
$datat = mysqli_fetch_assoc($query1);
  $idus=$datat['guru'];
  $jenengkelas=$datat['namakelas'];
  if($idus!=$cekus){
    header("Location: rekapmingguan.php");// send to login page
  }else{
    $query2 = mysqli_query($connect,"SELECT sekolah FROM users WHERE id='$idus'");
    $datatot = mysqli_fetch_assoc($query2);
    $idscoli=$datatot['sekolah'];
    $query3 = mysqli_query($connect,"SELECT jenis FROM sekolah WHERE idsekolah='$idscoli'");
    $datatott = mysqli_fetch_assoc($query3);
    $jenisscoli=$datatott['jenis'];
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
                     <h2>Rekap Nilai Mingguan</h2>
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
                      $q1 = mysqli_query($connect,"SELECT namakelas,guru FROM ajaran WHERE idajaran='$idajaran'");
                      while ($d1 = mysqli_fetch_assoc($q1)) {
                        $gg=$d1['guru'];
                        $q2 = mysqli_query($connect,"SELECT namaguru FROM users WHERE id='$gg'");
                        while ($d2 = mysqli_fetch_assoc($q2)) {
                          ?>
                            <h5>Informasi Data Rekap Dari Kelas <u><?php echo $d1['namakelas'] ?></u> Oleh <u><?php echo $d2['namaguru'] ?></u> Pada Tanggal <u><?php echo $tglawal ?></u> Sampai <u><?php echo $tglakhir ?></u></h5>

                            <b>Catatan :</b> <br>
                            <p>CHECKLIST = CL, HASIL KARYA = HK, CATATAN ANEKDOT = CA, N = Nilai Utama</p>
                          <?php
                        }
                       ?>
                      <?php
                      }
                       ?>
                      <?php
                      if($jenisscoli=="Umum"){
                        ?>
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
                               <td colspan="4">
                                 <?php
                                 $tampilkd = mysqli_query($connect,"SELECT kd1nam FROM harianumum WHERE ajaran='$idajaran' AND tglharianumum BETWEEN '$tglawal' AND '$tglakhir' GROUP BY kd1nam HAVING COUNT(*) >= 1");
                                 while($tampilkds = mysqli_fetch_array($tampilkd)){
                                   $kd1=$tampilkds['kd1nam'];
                                   $tampilkd1 = mysqli_query($connect,"SELECT inisial,kd FROM kd WHERE idkd='$kd1'");
                                   $tampilkds1 = mysqli_fetch_assoc($tampilkd1);

                                   echo $tampilkds1['inisial']." ".$tampilkds1['kd']."<br>";
                                   $kddes1[]=$tampilkds1['inisial'];
                                 }
                                ?>
                               </td>
                               <td colspan="4">
                                 <?php
                                 $tampilkd2 = mysqli_query($connect,"SELECT kd2fismot FROM harianumum WHERE ajaran='$idajaran' AND tglharianumum BETWEEN '$tglawal' AND '$tglakhir' GROUP BY kd2fismot HAVING COUNT(*) >= 1");
                                 while($tampilkds2 = mysqli_fetch_array($tampilkd2)){
                                   $kd2=$tampilkds2['kd2fismot'];
                                   $tampilkdd2 = mysqli_query($connect,"SELECT inisial,kd FROM kd WHERE idkd='$kd2'");
                                   $tampilkdss2 = mysqli_fetch_assoc($tampilkdd2);

                                   echo $tampilkdss2['inisial']." ".$tampilkdss2['kd']."<br>";
                                   $kddes2[]=$tampilkdss2['inisial'];
                                 }
                                ?>
                               </td>
                               <td colspan="4">
                                 <?php
                                 $tampilkd3 = mysqli_query($connect,"SELECT kd3kog FROM harianumum WHERE ajaran='$idajaran' AND tglharianumum BETWEEN '$tglawal' AND '$tglakhir' GROUP BY kd3kog HAVING COUNT(*) >= 1");
                                 while($tampilkds3 = mysqli_fetch_array($tampilkd3)){
                                   $kd3=$tampilkds3['kd3kog'];
                                   $tampilkdd3 = mysqli_query($connect,"SELECT inisial,kd FROM kd WHERE idkd='$kd3'");
                                   $tampilkdss3 = mysqli_fetch_assoc($tampilkdd3);

                                   echo $tampilkdss3['inisial']." ".$tampilkdss3['kd']."<br>";
                                   $kddes3[]=$tampilkdss3['inisial'];
                                 }
                                ?>
                               </td>
                            </tr>
                            <tr>
                              <td colspan="12"><center><b>Indikator</b></center></td>
                            </tr>
                            <tr>
                              <td colspan="4">
                                <?php
                                $tampilindikator1 = mysqli_query($connect,"SELECT indikator1 FROM harianumum WHERE ajaran='$idajaran' AND tglharianumum BETWEEN '$tglawal' AND '$tglakhir' GROUP BY indikator1 HAVING COUNT(*) >= 1");
                                $eqew1 = 1;
                                while($tampilindikators1 = mysqli_fetch_array($tampilindikator1)){
                                  $cok1=$tampilindikators1['indikator1'];
                                  $tetew1=mysqli_query($connect,"SELECT * FROM indikator WHERE idindi='$cok1'");
                                  while ($totok = mysqli_fetch_array($tetew1)) {
                                      echo $eqew1.". ".$totok['indik']."<br>";
                                      $kekew1[]=$totok['indik'];

                                  }
                                  $eqew1=$eqew1+1;
                                }
                               ?>
                              </td>
                              <td colspan="4">
                                <?php
                                $tampilindikator2 = mysqli_query($connect,"SELECT indikator2 FROM harianumum WHERE ajaran='$idajaran' AND tglharianumum BETWEEN '$tglawal' AND '$tglakhir' GROUP BY indikator2 HAVING COUNT(*) >= 1");
                                $eqew2 = 1;
                                while($tampilindikators2 = mysqli_fetch_array($tampilindikator2)){
                                  $cok2 = $tampilindikators2['indikator2'];
                                  $tetew2=mysqli_query($connect,"SELECT * FROM indikator WHERE idindi='$cok2'");
                                  while ($totok2 = mysqli_fetch_array($tetew2)) {
                                      echo $eqew2++.". ".$totok2['indik']."<br>";
                                      $kekew2[]=$totok2['indik'];
                                  }
                                }
                               ?>
                              </td>
                              <td colspan="4">
                                <?php
                                $tampilindikator3 = mysqli_query($connect,"SELECT indikator3 FROM harianumum WHERE ajaran='$idajaran' AND tglharianumum BETWEEN '$tglawal' AND '$tglakhir' GROUP BY indikator3 HAVING COUNT(*) >= 1");
                                $eqew3=1;
                                while($tampilindikators3 = mysqli_fetch_array($tampilindikator3)){
                                  $cok3 = $tampilindikators3['indikator3'];
                                  $tetew3 = mysqli_query($connect,"SELECT * FROM indikator WHERE idindi='$cok3'");
                                  while ($totok3 = mysqli_fetch_array($tetew3)) {
                                      echo $eqew3++.". ".$totok3['indik']."<br>";
                                      $kekew3[]=$totok3['indik'];
                                  }
                                }
                               ?>
                              </td>
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
                            $noo=1;
                            $qw = mysqli_query($connect,"SELECT siswa,MAX(nilainam1) AS nam1,MAX(nilainam2) AS nam2,MAX(nilainam3) AS nam3,MAX(nilainam4) AS nam4,MAX(nilaifismot1) AS fismot1,MAX(nilaifismot2) AS fismot2,MAX(nilaifismot3) AS fismot3,MAX(nilaifismot4) AS fismot4,MAX(nilaikog1) AS kog1,MAX(nilaikog2) AS kog2,MAX(nilaikog3) AS kog3,MAX(nilaikog4) AS kog4,MAX(nilaisosem1) AS sosem1,MAX(nilaisosem2) AS sosem2,MAX(nilaisosem3) AS sosem3,MAX(nilaisosem4) AS sosem4,MAX(nilaibhs1) AS bhs1,MAX(nilaibhs2) AS bhs2,MAX(nilaibhs3) AS bhs3,MAX(nilaibhs4) AS bhs4,MAX(nilaiseni1) AS seni1,MAX(nilaiseni2) AS seni2,MAX(nilaiseni3) AS seni3,MAX(nilaiseni4) AS seni4 FROM harianumum WHERE ajaran='$idajaran' AND tglharianumum BETWEEN '$tglawal' AND '$tglakhir' GROUP BY siswa HAVING COUNT(*) >= 1");

                            while($tampi = mysqli_fetch_array($qw)){
                              $itil = $tampi['siswa'];
                              $qw2 = mysqli_query($connect,"SELECT namapanggilan FROM siswa WHERE idsiswa='$itil'");
                              $tampiljeneng = mysqli_fetch_assoc($qw2);
                              ?>
                              <tr>
                                <td><?php echo $noo++ ?></td>
                                <td><?php echo $tampiljeneng['namapanggilan'] ?></td>
                                <td><?php echo $tampi['nam1'] ?></td>
                                <td><?php echo $tampi['nam2'] ?></td>
                                <td><?php echo $tampi['nam3'] ?></td>
                                <td><b><?php echo $tampi['nam4'] ?></b></td>

                                <td><?php echo $tampi['fismot1'] ?></td>
                                <td><?php echo $tampi['fismot2'] ?></td>
                                <td><?php echo $tampi['fismot3'] ?></td>
                                <td><b><?php echo $tampi['fismot4'] ?></b></td>

                                <td><?php echo $tampi['kog1'] ?></td>
                                <td><?php echo $tampi['kog2'] ?></td>
                                <td><?php echo $tampi['kog3'] ?></td>
                                <td><b><?php echo $tampi['kog4'] ?></b></td>

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
                               <td colspan="4">
                                 <?php
                                 $tampilkd4 = mysqli_query($connect,"SELECT kd4sosem FROM harianumum WHERE ajaran='$idajaran' AND tglharianumum BETWEEN '$tglawal' AND '$tglakhir' GROUP BY kd4sosem HAVING COUNT(*) >= 1");
                                 while($tampilkds4 = mysqli_fetch_array($tampilkd4)){
                                   $kd4=$tampilkds4['kd4sosem'];
                                   $tampilkdd4 = mysqli_query($connect,"SELECT inisial,kd FROM kd WHERE idkd='$kd4'");
                                   $tampilkdss4 = mysqli_fetch_assoc($tampilkdd4);

                                   echo $tampilkdss4['inisial']." ".$tampilkdss4['kd']."<br>";
                                   $kddes4[]=$tampilkdss4['inisial'];
                                 }
                                ?>
                               </td>
                               <td colspan="4">
                                 <?php
                                 $tampilkd5 = mysqli_query($connect,"SELECT kd5bhs FROM harianumum WHERE ajaran='$idajaran' AND tglharianumum BETWEEN '$tglawal' AND '$tglakhir' GROUP BY kd5bhs HAVING COUNT(*) >= 1");
                                 while($tampilkds5 = mysqli_fetch_array($tampilkd5)){
                                   $kd5=$tampilkds5['kd5bhs'];
                                   $tampilkdd5 = mysqli_query($connect,"SELECT inisial,kd FROM kd WHERE idkd='$kd5'");
                                   $tampilkdss5 = mysqli_fetch_assoc($tampilkdd5);

                                   echo $tampilkdss5['inisial']." ".$tampilkdss5['kd']."<br>";
                                   $kddes5[]=$tampilkdss5['inisial'];
                                 }
                                ?>
                               </td>
                               <td colspan="4">
                                 <?php
                                 $tampilkd6 = mysqli_query($connect,"SELECT kd6seni FROM harianumum WHERE ajaran='$idajaran' AND tglharianumum BETWEEN '$tglawal' AND '$tglakhir' GROUP BY kd6seni HAVING COUNT(*) >= 1");
                                 while($tampilkds6 = mysqli_fetch_array($tampilkd6)){
                                   $kd6=$tampilkds6['kd6seni'];
                                   $tampilkdd6 = mysqli_query($connect,"SELECT inisial,kd FROM kd WHERE idkd='$kd6'");
                                   $tampilkdss6 = mysqli_fetch_assoc($tampilkdd6);

                                   echo $tampilkdss6['inisial']." ".$tampilkdss6['kd']."<br>";
                                   $kddes6[]=$tampilkdss6['inisial'];
                                 }
                                ?>
                               </td>
                            </tr>
                            <tr>
                              <td colspan="12"><center><b>Indikator</b></center></td>
                            </tr>
                            <tr>
                              <td colspan="4">
                                <?php
                                $tampilindikator4 = mysqli_query($connect,"SELECT indikator4 FROM harianumum WHERE ajaran='$idajaran' AND tglharianumum BETWEEN '$tglawal' AND '$tglakhir' GROUP BY indikator4 HAVING COUNT(*) >= 1");
                                $eqew4=1;
                                while($tampilindikators4 = mysqli_fetch_array($tampilindikator4)){
                                  $cok4 = $tampilindikators4['indikator4'];
                                  $tetew4=mysqli_query($connect,"SELECT * FROM indikator WHERE idindi='$cok4'");
                                  while ($totok4 = mysqli_fetch_array($tetew4)) {
                                      echo $eqew4++.". ".$totok4['indik']."<br>";
                                      $kekew4[]=$totok4['indik'];
                                  }
                                }
                               ?>
                              </td>
                              <td colspan="4">
                                <?php
                                $tampilindikator5 = mysqli_query($connect,"SELECT indikator5 FROM harianumum WHERE ajaran='$idajaran' AND tglharianumum BETWEEN '$tglawal' AND '$tglakhir' GROUP BY indikator5 HAVING COUNT(*) >= 1");
                                $eqew5=1;
                                while($tampilindikators5 = mysqli_fetch_array($tampilindikator5)){
                                  $cok5 = $tampilindikators5['indikator5'];
                                  $tetew5=mysqli_query($connect,"SELECT * FROM indikator WHERE idindi='$cok5'");
                                  while ($totok5 = mysqli_fetch_array($tetew5)) {
                                      echo $eqew5++.". ".$totok5['indik']."<br>";
                                      $kekew5[]=$totok5['indik'];
                                  }
                                }
                               ?>
                              </td>
                              <td colspan="4">
                                <?php
                                $tampilindikator6 = mysqli_query($connect,"SELECT indikator6 FROM harianumum WHERE ajaran='$idajaran' AND tglharianumum BETWEEN '$tglawal' AND '$tglakhir' GROUP BY indikator6 HAVING COUNT(*) >= 1");
                                $eqew6=1;
                                while($tampilindikators6 = mysqli_fetch_array($tampilindikator6)){
                                  $cok6 = $tampilindikators6['indikator6'];
                                  $tetew6=mysqli_query($connect,"SELECT * FROM indikator WHERE idindi='$cok6'");
                                  while ($totok6 = mysqli_fetch_array($tetew6)) {
                                      echo $eqew6++.". ".$totok6['indik']."<br>";
                                      $kekew6[]=$totok6['indik'];
                                  }
                                }
                               ?>
                              </td>
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
                            $noo=1;
                            $qw = mysqli_query($connect,"SELECT siswa,MAX(nilainam1) AS nam1,MAX(nilainam2) AS nam2,MAX(nilainam3) AS nam3,MAX(nilainam4) AS nam4,MAX(nilaifismot1) AS fismot1,MAX(nilaifismot2) AS fismot2,MAX(nilaifismot3) AS fismot3,MAX(nilaifismot4) AS fismot4,MAX(nilaikog1) AS kog1,MAX(nilaikog2) AS kog2,MAX(nilaikog3) AS kog3,MAX(nilaikog4) AS kog4,MAX(nilaisosem1) AS sosem1,MAX(nilaisosem2) AS sosem2,MAX(nilaisosem3) AS sosem3,MAX(nilaisosem4) AS sosem4,MAX(nilaibhs1) AS bhs1,MAX(nilaibhs2) AS bhs2,MAX(nilaibhs3) AS bhs3,MAX(nilaibhs4) AS bhs4,MAX(nilaiseni1) AS seni1,MAX(nilaiseni2) AS seni2,MAX(nilaiseni3) AS seni3,MAX(nilaiseni4) AS seni4 FROM harianumum WHERE ajaran='$idajaran' AND tglharianumum BETWEEN '$tglawal' AND '$tglakhir' GROUP BY siswa HAVING COUNT(*) >= 1");

                            while($tampi = mysqli_fetch_array($qw)){
                              $itil = $tampi['siswa'];
                              $qw2 = mysqli_query($connect,"SELECT namapanggilan FROM siswa WHERE idsiswa='$itil'");
                              $tampiljeneng = mysqli_fetch_assoc($qw2);
                              ?>
                              <tr>
                                <td><?php echo $noo++ ?></td>
                                <td><?php echo $tampiljeneng['namapanggilan'] ?></td>

                                <td><?php echo $tampi['sosem1'] ?></td>
                                <td><?php echo $tampi['sosem2'] ?></td>
                                <td><?php echo $tampi['sosem3'] ?></td>
                                <td><b><?php echo $tampi['sosem4'] ?></b></td>

                                <td><?php echo $tampi['bhs1'] ?></td>
                                <td><?php echo $tampi['bhs2'] ?></td>
                                <td><?php echo $tampi['bhs3'] ?></td>
                                <td><b><?php echo $tampi['bhs4'] ?></b></td>

                                <td><?php echo $tampi['seni1'] ?></td>
                                <td><?php echo $tampi['seni2'] ?></td>
                                <td><?php echo $tampi['seni3'] ?></td>
                                <td><b><?php echo $tampi['seni4'] ?></b></td>
                              </tr>
                              <?php
                            }
                             ?>
                          </tbody>
                        </table>
                      <?php
                      }
                       ?>
                    </div>
                    <div class="col-md-12">
                      Hore, proses belajar mengajar pada minggu ini telah mencapai beberapa kriteria indikator yang meliputi : <br>
                      <?php
                      if($jenisscoli=="Umum"){
                       ?>
                      <?php
                      for($dess1=0;$dess1<count($kddes1);$dess1++){
                          echo $kddes1[$dess1].", ";
                      }
                      echo " | ";
                      for($jan=0;$jan<count($kekew1);$jan++){
                          echo $kekew1[$jan].", ";
                      }
                       ?>
                       (ASPEK PENGEMBANGAN NILAI AGAMA DAN MORAL)
                       <br>
                       <?php
                       for($dess2=0;$dess2<count($kddes2);$dess2++){
                           echo $kddes2[$dess2].", ";
                       }
                       echo " | ";
                       for($jan2=0;$jan2<count($kekew2);$jan2++){
                           echo $kekew2[$jan2].", ";
                       }
                        ?>
                        (ASPEK PERKEMBANGAN FISIK DAN MOTORIK)
                        <br>
                        <?php
                        for($dess3=0;$dess3<count($kddes3);$dess3++){
                            echo $kddes3[$dess3].", ";
                        }
                        echo " | ";
                        for($jan3=0;$jan3<count($kekew3);$jan3++){
                            echo $kekew3[$jan3].", ";
                        }
                         ?>
                         (ASPEK PERKEMBANGAN KOGNITIF)
                         <br>
                         <?php
                         for($dess4=0;$dess4<count($kddes4);$dess4++){
                             echo $kddes4[$dess4].", ";
                         }
                         echo " | ";
                         for($jan4=0;$jan4<count($kekew4);$jan4++){
                             echo $kekew4[$jan4].", ";
                         }
                          ?>
                          (ASPEK SOSIAL EMOSIONAL)
                          <br>
                          <?php
                          for($dess5=0;$dess5<count($kddes5);$dess5++){
                              echo $kddes5[$dess5].", ";
                          }
                          echo " | ";
                          for($jan5=0;$jan5<count($kekew5);$jan5++){
                              echo $kekew5[$jan5].", ";
                          }
                           ?>
                           (ASPEK PERKEMBANGAN BAHASA)
                           <br>
                           <?php
                           for($dess6=0;$dess6<count($kddes6);$dess6++){
                               echo $kddes6[$dess6].", ";
                           }
                           echo " | ";
                           for($jan6=0;$jan6<count($kekew6);$jan6++){
                               echo $kekew6[$jan6].", ";
                           }
                            ?>
                            (ASPEK PENGEMBANGAN SENI)
                            <br>
                     <?php } ?>
                     <br> <br>
                     <center> <br> <br>
                     <table width="75%">
                       <tr>
                         <td rowspan="2"></td>
                         <td>Semester : <?php echo $datat['semester'] ?></td>
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
    <script type="text/javascript">
    function printDiv(divName) {
   var printContents = document.getElementById(divName).innerHTML;
   var originalContents = document.body.innerHTML;

   document.body.innerHTML = printContents;

   window.print();

   document.body.innerHTML = originalContents;
}
    </script>
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
