<?php
include 'koneksi.php'; //connect the connection page

if(empty($_SESSION)) // if the session not yet started
   session_start();

if(!isset($_SESSION['username'])) { //if not yet logged in
   header("Location: index.php");// send to login page
   exit;
}

$idajaran = $_GET['id2'];
$idsus = $_GET['id'];
$cekus=$_SESSION['id'];
$idus= "";
$idscoli="";
$jenisscoli="";
$jenengkelas="";
$query1 = mysqli_query($connect,"SELECT * FROM ajaran WHERE idajaran='$idajaran'");
$datat = mysqli_fetch_assoc($query1);
  $idus=$datat['guru'];
  $jenengkelas=$datat['namakelas'];
  if($idus!=$cekus){
    header("Location: cetakrapotkelas.php");// send to login page
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
   <style type="text/css" media="print">
   @media print {
   .footer,
   #non-printable {
       display: none !important;
   }
   #printable {
       display: block;
   }
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
                     <h2>Cetak Rapot</h2>
                     <button type="button" onclick="printDiv('printableArea')" class="btn btn-warning" align="right">Cetak</button>
                    </div>
                </div>
                 <!-- /. ROW  -->
                  <hr />
                  <div class="row">
                    <div id="printableArea">
                    <div class="col-md-12">
                      <?php

                      $q2 = mysqli_query($connect,"SELECT namaguru FROM users WHERE id='$cekus'");
                      $d2 = mysqli_fetch_assoc($q2);
                      $siswa = mysqli_query($connect,"SELECT namasiswa,namapanggilan FROM siswa WHERE idsiswa='$idsus'");
                      $sisswa = mysqli_fetch_assoc($siswa);

                      $qw = mysqli_query($connect,"SELECT siswa,MAX(nilainam1) AS nam1,MAX(nilainam2) AS nam2,MAX(nilainam3) AS nam3,MAX(nilainam4) AS nam4,MAX(nilaifismot1) AS fismot1,MAX(nilaifismot2) AS fismot2,MAX(nilaifismot3) AS fismot3,MAX(nilaifismot4) AS fismot4,MAX(nilaikog1) AS kog1,MAX(nilaikog2) AS kog2,MAX(nilaikog3) AS kog3,MAX(nilaikog4) AS kog4,MAX(nilaisosem1) AS sosem1,MAX(nilaisosem2) AS sosem2,MAX(nilaisosem3) AS sosem3,MAX(nilaisosem4) AS sosem4,MAX(nilaibhs1) AS bhs1,MAX(nilaibhs2) AS bhs2,MAX(nilaibhs3) AS bhs3,MAX(nilaibhs4) AS bhs4,MAX(nilaiseni1) AS seni1,MAX(nilaiseni2) AS seni2,MAX(nilaiseni3) AS seni3,MAX(nilaiseni4) AS seni4 FROM harianumum WHERE ajaran='$idajaran' AND siswa = '$idsus' GROUP BY siswa HAVING COUNT(*) >= 1");

                      $tampi = mysqli_fetch_array($qw);

                          ?>
                            <h5>PENILAIAN PERKEMBANGAN ANAK DIDI OLEH <u><?php echo $d2['namaguru'] ?></u></h5>
                            <b>Nama Anak Didik : </b> <?php echo $sisswa['namasiswa'] ?> <br>
                            <b>Tingkat         : </b> <?php echo $datat['kelas'] ?><br>
                            <b>Nama Kelas      : </b> <?php echo $datat['namakelas'] ?><br>
                            <b>Tahun Ajaran    : </b> <?php echo $datat['tahunajaran'] ?><br>
                            <b>Semester        : </b> <?php echo $datat['semester'] ?> <br> <br>
                      <?php
                      if($jenisscoli=="Umum"){
                        ?>
                            <?php
                            $tampilnarasiumum = mysqli_query($connect,"SELECT * FROM narasiumum WHERE siswa='$idsus'");
                            $tamnar = mysqli_fetch_assoc($tampilnarasiumum);
                             ?>
                            <table class="table table-striped table-bordered table-hover">
                              <tr>
                                <td colspan="3"><center><u><b>ASPEK PENGEMBANGAN NILAI AGAMA DAN MORAL</b></u></center></td>
                              </tr>
                              <tr>
                                <td colspan="3">
                                  <center><b>Ananda <?php echo $sisswa['namapanggilan'] ?>
                                    <?php
                                    if($tampi['nam4']=='1'){
                                        echo "Belum Berkembang";
                                    }elseif($tampi['nam4']=='2'){
                                        echo "Masih Berkembang";
                                    }elseif($tampi['nam4']=='3'){
                                        echo "Berkembang Sesuai Harapan";
                                    }elseif($tampi['nam4']=='4'){
                                        echo "Berkembang Sangat Baik";
                                    }

                                    ?>
                                  </b></center>
                                </td>
                              </tr>
                              <tr>
                                <td><center>KD</center></td>
                                <td><center>Indikator</center></td>
                                <td><center>Narasi</center></td>
                              </tr>
                              <tr>
                                <td>
                                  <?php
                                $tampilkd = mysqli_query($connect,"SELECT kd1nam FROM harianumum WHERE ajaran='$idajaran' AND siswa = '$idsus' GROUP BY kd1nam HAVING COUNT(*) >= 1");
                                while($tampilkds = mysqli_fetch_array($tampilkd)){
                                  $kd1=$tampilkds['kd1nam'];
                                  $tampilkd1 = mysqli_query($connect,"SELECT inisial,kd FROM kd WHERE idkd='$kd1'");
                                  $tampilkds1 = mysqli_fetch_assoc($tampilkd1);

                                  echo $tampilkds1['inisial']." ".$tampilkds1['kd']."<br>";
                                  $kddes1[]=$tampilkds1['inisial'];
                                }
                               ?>
                                </td>
                                <td>
                                  <?php
                                  $tampilindikator1 = mysqli_query($connect,"SELECT indikator1 FROM harianumum WHERE ajaran='$idajaran' AND siswa = '$idsus' GROUP BY indikator1 HAVING COUNT(*) >= 1");
                                  $eqew1 = 1;
                                  while($tampilindikators1 = mysqli_fetch_array($tampilindikator1)){
                                    $cok1=$tampilindikators1['indikator1'];
                                    $tetew1=mysqli_query($connect,"SELECT * FROM indikator WHERE idindi='$cok1'");
                                    while ($totok = mysqli_fetch_array($tetew1)) {
                                        echo $eqew1++.". ".$totok['indik']."<br>";
                                        $kekew1[]=$totok['indik'];
                                    }
                                  }
                                 ?>
                                </td>
                                <td><?php echo $tamnar['n1'] ?></td>
                              </tr>
                            </table>

                            <table class="table table-striped table-bordered table-hover">
                              <tr>
                                <td colspan="3"><center><u><b>ASPEK PERKEMBANGAN FISIK DAN MOTORIK</b></u></center></td>
                              </tr>
                              <tr>
                                <td colspan="3">
                                  <center><b>Ananda <?php echo $sisswa['namapanggilan'] ?>
                                    <?php
                                    if($tampi['fismot4']=='1'){
                                        echo "Belum Berkembang";
                                    }elseif($tampi['fismot4']=='2'){
                                        echo "Masih Berkembang";
                                    }elseif($tampi['fismot4']=='3'){
                                        echo "Berkembang Sesuai Harapan";
                                    }elseif($tampi['fismot4']=='4'){
                                        echo "Berkembang Sangat Baik";
                                    }

                                    ?>
                                  </b></center>
                                </td>
                              </tr>
                              <tr>
                                <td><center>KD</center></td>
                                <td><center>Indikator</center></td>
                                <td><center>Narasi</center></td>
                              </tr>
                              <tr>
                                <td>
                                  <?php
                                  $ttt2= mysqli_query($connect,"SELECT kd2fismot FROM harianumum WHERE ajaran='$idajaran' AND siswa = '$idsus' GROUP BY kd2fismot HAVING COUNT(*) >= 1");
                                  while($tampilkds2 = mysqli_fetch_array($ttt2)){
                                    $kd2=$tampilkds2['kd2fismot'];
                                    $tampilkdd2 = mysqli_query($connect,"SELECT inisial,kd FROM kd WHERE idkd='$kd2'");
                                    $tampilkdds2 = mysqli_fetch_assoc($tampilkdd2);

                                    echo $tampilkdds2['inisial']." ".$tampilkdds2['kd']."<br>";
                                    $kddes2[]=$tampilkdds2['inisial'];
                                  }
                                 ?>
                                </td>
                                <td>
                                  <?php
                                  $tampilindikator2 = mysqli_query($connect,"SELECT indikator2 FROM harianumum WHERE ajaran='$idajaran' AND siswa = '$idsus' GROUP BY indikator2 HAVING COUNT(*) >= 1");
                                  $eqew2 = 1;
                                  while($tampilindikators2 = mysqli_fetch_array($tampilindikator2)){
                                    $cok2=$tampilindikators2['indikator2'];
                                    $tetew2=mysqli_query($connect,"SELECT * FROM indikator WHERE idindi='$cok2'");
                                    while ($totok2 = mysqli_fetch_array($tetew2)) {
                                        echo $eqew2++.". ".$totok2['indik']."<br>";
                                        $kekew2[]=$totok2['indik'];
                                    }
                                  }
                                 ?>
                                </td>
                                <td><?php echo $tamnar['n2'] ?></td>
                              </tr>
                            </table>

                            <table class="table table-striped table-bordered table-hover">
                              <tr>
                                <td colspan="3"><center><u><b>ASPEK PERKEMBANGAN KOGNITIF</b></u></center></td>
                              </tr>
                              <tr>
                                <td colspan="3">
                                  <center><b>Ananda <?php echo $sisswa['namapanggilan'] ?>
                                    <?php
                                    if($tampi['kog4']=='1'){
                                        echo "Belum Berkembang";
                                    }elseif($tampi['kog4']=='2'){
                                        echo "Masih Berkembang";
                                    }elseif($tampi['kog4']=='3'){
                                        echo "Berkembang Sesuai Harapan";
                                    }elseif($tampi['kog4']=='4'){
                                        echo "Berkembang Sangat Baik";
                                    }
                                    ?>
                                  </b></center>
                                </td>
                              </tr>
                              <tr>
                                <td><center>KD</center></td>
                                <td><center>Indikator</center></td>
                                <td><center>Narasi</center></td>
                              </tr>
                              <tr>
                                <td>
                                  <?php
                                  $ttt3= mysqli_query($connect,"SELECT kd3kog FROM harianumum WHERE ajaran='$idajaran' AND siswa = '$idsus' GROUP BY kd3kog HAVING COUNT(*) >= 1");
                                  while($tampilkds3 = mysqli_fetch_array($ttt3)){
                                    $kd3=$tampilkds3['kd3kog'];
                                    $tampilkdd3 = mysqli_query($connect,"SELECT inisial,kd FROM kd WHERE idkd='$kd3'");
                                    $tampilkdds3 = mysqli_fetch_assoc($tampilkdd3);

                                    echo $tampilkdds3['inisial']." ".$tampilkdds3['kd']."<br>";
                                    $kddes3[]=$tampilkdds3['inisial'];
                                  }
                                 ?>
                                </td>
                                <td>
                                  <?php
                                  $tampilindikator3 = mysqli_query($connect,"SELECT indikator3 FROM harianumum WHERE ajaran='$idajaran' AND siswa = '$idsus' GROUP BY indikator3 HAVING COUNT(*) >= 1");
                                  $eqew3 = 1;
                                  while($tampilindikators3 = mysqli_fetch_array($tampilindikator3)){
                                    $cok3=$tampilindikators3['indikator3'];
                                    $tetew3=mysqli_query($connect,"SELECT * FROM indikator WHERE idindi='$cok3'");
                                    while ($totok3 = mysqli_fetch_array($tetew3)) {
                                        echo $eqew3++.". ".$totok3['indik']."<br>";
                                        $kekew3[]=$totok3['indik'];
                                    }
                                  }
                                 ?>
                                </td>
                                <td><?php echo $tamnar['n3'] ?></td>
                              </tr>
                            </table>

                            <table class="table table-striped table-bordered table-hover">
                              <tr>
                                <td colspan="3"><center><u><b>ASPEK SOSIAL EMOSIONAL</b></u></center></td>
                              </tr>
                              <tr>
                                <td colspan="3">
                                  <center><b>Ananda <?php echo $sisswa['namapanggilan'] ?>
                                    <?php
                                    if($tampi['sosem4']=='1'){
                                        echo "Belum Berkembang";
                                    }elseif($tampi['sosem4']=='2'){
                                        echo "Masih Berkembang";
                                    }elseif($tampi['sosem4']=='3'){
                                        echo "Berkembang Sesuai Harapan";
                                    }elseif($tampi['sosem4']=='4'){
                                        echo "Berkembang Sangat Baik";
                                    }
                                    ?>
                                  </b></center>
                                </td>
                              </tr>
                              <tr>
                                <td><center>KD</center></td>
                                <td><center>Indikator</center></td>
                                <td><center>Narasi</center></td>
                              </tr>
                              <tr>
                                <td>
                                  <?php
                                  $ttt4= mysqli_query($connect,"SELECT kd4sosem FROM harianumum WHERE ajaran='$idajaran' AND siswa = '$idsus' GROUP BY kd4sosem HAVING COUNT(*) >= 1");
                                  while($tampilkds4 = mysqli_fetch_array($ttt4)){
                                    $kd4=$tampilkds4['kd4sosem'];
                                    $tampilkdd4 = mysqli_query($connect,"SELECT inisial,kd FROM kd WHERE idkd='$kd4'");
                                    $tampilkdds4 = mysqli_fetch_assoc($tampilkdd4);

                                    echo $tampilkdds4['inisial']." ".$tampilkdds4['kd']."<br>";
                                    $kddes4[]=$tampilkdds4['inisial'];
                                  }
                                 ?>
                                </td>
                                <td>
                                  <?php
                                  $tampilindikator4 = mysqli_query($connect,"SELECT indikator4 FROM harianumum WHERE ajaran='$idajaran' AND siswa = '$idsus' GROUP BY indikator4 HAVING COUNT(*) >= 1");
                                  $eqew4 = 1;
                                  while($tampilindikators4 = mysqli_fetch_array($tampilindikator4)){
                                    $cok4 = $tampilindikators4['indikator4'];
                                    $tetew4 = mysqli_query($connect,"SELECT * FROM indikator WHERE idindi='$cok4'");
                                    while ($totok4 = mysqli_fetch_array($tetew4)) {
                                        echo $eqew4++.". ".$totok4['indik']."<br>";
                                        $kekew4[]=$totok4['indik'];
                                    }
                                  }
                                 ?>
                                </td>
                                <td><?php echo $tamnar['n4'] ?></td>
                              </tr>
                            </table>

                            <table class="table table-striped table-bordered table-hover">
                              <tr>
                                <td colspan="3"><center><u><b>ASPEK PERKEMBANGAN BAHASA</b></u></center></td>
                              </tr>
                              <tr>
                                <td colspan="3">
                                  <center><b>Ananda <?php echo $sisswa['namapanggilan'] ?>
                                    <?php
                                    if($tampi['bhs4']=='1'){
                                        echo "Belum Berkembang";
                                    }elseif($tampi['bhs4']=='2'){
                                        echo "Masih Berkembang";
                                    }elseif($tampi['bhs4']=='3'){
                                        echo "Berkembang Sesuai Harapan";
                                    }elseif($tampi['bhs4']=='4'){
                                        echo "Berkembang Sangat Baik";
                                    }
                                    ?>
                                  </b></center>
                                </td>
                              </tr>
                              <tr>
                                <td><center>KD</center></td>
                                <td><center>Indikator</center></td>
                                <td><center>Narasi</center></td>
                              </tr>
                              <tr>
                                <td>
                                  <?php
                                  $ttt5= mysqli_query($connect,"SELECT kd5bhs FROM harianumum WHERE ajaran='$idajaran' AND siswa = '$idsus' GROUP BY kd5bhs HAVING COUNT(*) >= 1");
                                  while($tampilkds5 = mysqli_fetch_array($ttt5)){
                                    $kd5=$tampilkds5['kd5bhs'];
                                    $tampilkdd5 = mysqli_query($connect,"SELECT inisial,kd FROM kd WHERE idkd='$kd5'");
                                    $tampilkdds5 = mysqli_fetch_assoc($tampilkdd5);

                                    echo $tampilkdds5['inisial']." ".$tampilkdds5['kd']."<br>";
                                    $kddes5[]=$tampilkdds5['inisial'];
                                  }
                                 ?>
                                </td>
                                <td>
                                  <?php
                                  $tampilindikator5 = mysqli_query($connect,"SELECT indikator5 FROM harianumum WHERE ajaran='$idajaran' AND siswa = '$idsus' GROUP BY indikator5 HAVING COUNT(*) >= 1");
                                  $eqew5 = 1;
                                  while($tampilindikators5 = mysqli_fetch_array($tampilindikator5)){
                                    $cok5 = $tampilindikators5['indikator5'];
                                    $tetew5 = mysqli_query($connect,"SELECT * FROM indikator WHERE idindi='$cok5'");
                                    while ($totok5 = mysqli_fetch_array($tetew5)) {
                                        echo $eqew5++.". ".$totok5['indik']."<br>";
                                        $kekew5[]= $totok5['indik'];
                                    }
                                  }
                                 ?>
                                </td>
                                <td><?php echo $tamnar['n5'] ?></td>
                              </tr>
                            </table>

                            <table class="table table-striped table-bordered table-hover">
                              <tr>
                                <td colspan="3"><center><u><b>ASPEK PENGEMBANGAN SENI</b></u></center></td>
                              </tr>
                              <tr>
                                <td colspan="3">
                                  <center><b>Ananda <?php echo $sisswa['namapanggilan'] ?>
                                    <?php
                                    if($tampi['seni4']=='1'){
                                        echo "BB = Belum Berkembang";
                                    }elseif($tampi['seni4']=='2'){
                                        echo "MB = Masih Berkembang";
                                    }elseif($tampi['seni4']=='3'){
                                        echo "BSH = Berkembang Sesuai Harapan";
                                    }elseif($tampi['seni4']=='4'){
                                        echo "BSB = Berkembang Sangat Baik";
                                    }
                                    ?>
                                  </b></center>
                                </td>
                              </tr>
                              <tr>
                                <td><center>KD</center></td>
                                <td><center>Indikator</center></td>
                                <td><center>Narasi</center></td>
                              </tr>
                              <tr>
                                <td>
                                  <?php
                                  $ttt6 = mysqli_query($connect,"SELECT kd6seni FROM harianumum WHERE ajaran='$idajaran' AND siswa = '$idsus' GROUP BY kd6seni HAVING COUNT(*) >= 1");
                                  while($tampilkds6 = mysqli_fetch_array($ttt6)){
                                    $kd6=$tampilkds6['kd6seni'];
                                    $tampilkd6 = mysqli_query($connect,"SELECT inisial,kd FROM kd WHERE idkd='$kd6'");
                                    $tampilkdss6 = mysqli_fetch_assoc($tampilkd6);

                                    echo $tampilkdss6['inisial']." ".$tampilkdss6['kd']."<br>";
                                    $kddes6[]=$tampilkdss6['inisial'];
                                  }
                                 ?>
                                </td>
                                <td>
                                  <?php
                                  $tampilindikator6 = mysqli_query($connect,"SELECT indikator6 FROM harianumum WHERE ajaran='$idajaran' AND siswa = '$idsus' GROUP BY indikator6 HAVING COUNT(*) >= 1");
                                  $eqew6 = 1;
                                  while($tampilindikators6 = mysqli_fetch_array($tampilindikator6)){
                                    $cok6 = $tampilindikators6['indikator6'];
                                    $tetew6 = mysqli_query($connect,"SELECT * FROM indikator WHERE idindi='$cok6'");
                                    while ($totok6 = mysqli_fetch_array($tetew6)) {
                                        echo $eqew6++.". ".$totok6['indik']."<br>";
                                        $kekew6[]=$totok6['indik'];
                                    }
                                  }
                                 ?>
                                </td>
                                <td><?php echo $tamnar['n6'] ?></td>
                              </tr>
                            </table>
                      <?php
                      }
                       ?>
                    </div>
                    <div class="col-md-12">
                      Hore, proses belajar mengajar pada semester ini telah mencapai beberapa kriteria indikator yang meliputi : <br>
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
