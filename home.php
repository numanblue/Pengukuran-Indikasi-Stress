<?php
include 'connect_to_database.php'; //connect the connection page

if(empty($_SESSION)) // if the session not yet started
   session_start();

if(!isset($_SESSION['username'])) { //if not yet logged in
   header("Location: index.php");// send to login page
   exit;
}
if($_SESSION['posisi'] == 1 ) { //if not yet logged in
   header("Location: dokter/index.php");// send to login page
   exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>StresP</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content=""
	/>
	<script type="application/x-javascript">
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>

	<meta charset utf="8">
	<!--font-awsome-css-->

	<link rel="stylesheet" href="data/css/font-awesome.min.css">
	<!--bootstrap-->
	<link href="data/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<!--custom css-->
	<link href="data/css/style.css" rel="stylesheet" type="text/css" />
  <link href="css/w3.css" rel="stylesheet" type="text/css" />
	<!--component-css-->

	<!-- web-fonts -->
	<link href="//fonts.googleapis.com/css?family=Quattrocento+Sans:400,400i,700,700i" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Inconsolata:400,700" rel="stylesheet">
	<!-- //web-fonts -->
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
</style>
</head>

<body>
	<div class="body-back">
		<div class="masthead pdng-stn1">
			<div id="menu" class="panel" role="navigation">
				<div class="wrap-content">
					<!-- /menu -->
					<div class="profile-menu text-center">
						<h3>Menu</h3>
						<div class="pro-menu">
							<ul>
								<li><a class="active" href="home.php">Beranda</a></li>
								<!--<li><a href="services.html">Cek Indikasi Stres</a></li>-->
							</ul>
						</div>
					</div>
					<!-- //menu -->
				</div>
			</div>
			<div class="phone-box wrap push" id="home">
				<div class="menu-notify">
					<div class="profile-left">
						<a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
					</div>
					<div class="Profile-mid">
						<h5 class="pro-link"><a href="home.php">StresP</a></h5>
					</div>
					<div class="Profile-right">
						<a href="#small-dialog" class="sign-in popup-top-anim"><i class="fa fa-user"></i></a>
						<!-- modal -->
						<div id="small-dialog" class="mfp-hide">
							<div class="login-modal">
								<div class="booking-info">
									<h3><a href="home.php">StresP</a></h3>

								</div>
								<div class="login-form_agile">

									<p>Yakin mau log out? <a href="logout.php"><button>Keluar</button></a></p>

								</div>
							</div>
						</div>
						<!-- //modal -->
						<!-- modal-two -->

						<!-- //modal-two -->

					</div>
					<div class="clearfix"></div>
				</div>
				<!-- banner -->
				<div class="banner_info_agile_w3ls">
					<div class="banner_info_agile_w3ls_inner">
						<img src="data/images/pic.jpg" alt=" " class="img-responsive">
						<h2>Selamat Datang <?php echo $_SESSION['namalengkap']; ?></h2>
            <?php
            $ngelulur=$_SESSION['id'];
            $embolur = mysqli_query($connect,"SELECT * FROM users WHERE id='$ngelulur'")or die(mysql_error());

            while($yaya = mysqli_fetch_array($embolur)){
             ?>
						<span>Point Anda Tersisa <?php echo $yaya['point']; ?></span>
            <?php
            }
             ?>
					</div>
				</div>

				<table border="1" width="100%"><tr><td>
				<div class="about">

					<div class="wrap_view_agileits">
						<h3 class="head">Cek Indikasi Stres</h3>
            <?php
              $tglsaiki = date("Y-m-d");
              $pengenal2=$_SESSION['id'];
              $query_mysql2 = mysqli_query($connect,"SELECT * FROM cekstres WHERE iduser='$pengenal2' AND tgl2='0000-00-00'")or die(mysql_error());

              if (mysqli_num_rows($query_mysql2) !=0){
                while($data2 = mysqli_fetch_array($query_mysql2)){
                  if($data2['tgl1'] == $tglsaiki){
             ?>
                <center><a href="cekstres3.php?idstres=<?php echo $data2['idstres'] ?> "><button class="button button1">Lanjutkan Pengecekan Kedua</button></a></center>
              <?php
            }else{
              ?>
                <center><a href="cekstres3.php?idstres=<?php echo $data2['idstres'] ?> "><button class="button button1">Lanjutkan Pengecekan Kedua Sekarang</button></a></center>
              <?php
            }
                }
              }else{
                ?>

             <center>  <a href="cekstres.php"><button class="button button1">Mulai Pengecekan</button></a></center>
                <?php
              }
               ?>
               <br>
            <table class="w3-table-all w3-card-4">
              <tr>
                <th colspan="3">Riwayat Pengukuran</th>
              </tr>
              <tr>
                <th>No.</th>
                <th>Tanggal Pengecekan</th>
                <th>Aksi</th>
              </tr>
              <?php
              $nomer = 1;
              $tglsaiki = date("Y-m-d");

              $pengenal=$_SESSION['id'];
              $query_mysql = mysqli_query($connect,"SELECT * FROM cekstres WHERE iduser='$pengenal'")or die(mysql_error());

              if (mysqli_num_rows($query_mysql) !=0){
              while($data = mysqli_fetch_array($query_mysql)){
                if($data['tgl1']!='0000-00-00' && $data['tgl2'] !='0000-00-00'){

                ?>
                <tr>
                  <td><?php echo $nomer++ ?></td>
                  <td><?php echo $data['tgl1'] ?></td>
                  <td><a href="lihatstres.php?idstres=<?php echo $data['idstres'] ?> ">Lihat</a></td>
                </tr>
                <?php

                  }
                }
              }else{
                ?>
                <tr>
                  <td colspan="5"><center>Tidak ada data. Mulai Cek Indikasi <a href="cekstres.php">Disini</a></center></td>
                </tr>
              <?php
              }
               ?>
            </table>
					</div>
					<br>
					<br>
					<br>
					<br>
				</div>
				</td></tr>
				</table>

				<div class="progress_skills">
					<h3 class="head two">Konsultasi Psikolog Gratis</h3>
					<center><p>Konsultasikan masalah Anda dengan dokter psikolog kami.</p><br>
						<a href="chat/"><button class="button button1">Klik Disini</button></a></center>
				</div>


				<div class="footer">
					<div class="footer_pos_w3_agile">
						<p>© 2020 StresP. All Rights Reserved | Design by <a href="#">StresP</a></p>
					</div>
				</div>
				<!--//footer-->

			</div>
		</div>
	</div>
	<script src="data/js/jquery-2.1.4.min.js"></script>
	<script src="data/js/bootstrap.min.js"></script>
	<!--script-->
	<script src="data/js/modernizr.custom.js"></script>
	<script src="data/js/bigSlide.js"></script>
	<script>
		$(document).ready(function () {
			$('.menu-link').bigSlide();
		});
	</script>
	<!-- pop-up-box -->
	<script src="data/js/jquery.magnific-popup.js" type="text/javascript"></script>
	<script>
		$(document).ready(function () {
			$('.popup-top-anim').magnificPopup({
				type: 'inline',
				fixedContentPos: false,
				fixedBgPos: true,
				overflowY: 'auto',
				closeBtnInside: true,
				preloader: false,
				midClick: true,
				removalDelay: 300,
				mainClass: 'my-mfp-zoom-in'
			});
		});
	</script>
	<!--//pop-up-box -->
	<script src="data/js/jquery.nicescroll.js"></script>
	<script src="data/js/scripts.js"></script>
</body>

</html>
