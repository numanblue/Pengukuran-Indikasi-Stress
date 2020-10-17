<?php
include 'connect_to_database.php'; //connect the connection page
if(empty($_SESSION)) // if the session not yet started
   session_start();


if(isset($_SESSION['username'])) { // if already login
   header("location: home.php"); // send to home page
   exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>StresP</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Roboto:100,300,400,500,700|Philosopher:400,400i,700,700i" rel="stylesheet">

  <!-- Bootstrap css -->
  <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.theme.default.min.css" rel="stylesheet">
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/modal-video/css/modal-video.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">
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

  <header id="header" class="header header-hide">
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><a href="#body" class="scrollto"><span>Stres</span>P</a></h1>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#hero">Home</a></li>
          <li><a href="#login">Login</a></li>
          <li><a href="#register">Daftar</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--==========================
    Hero Section
  ============================-->
  <section id="hero" class="wow fadeIn">
    <div class="hero-container">

      <h1>Selamat Datang Di Web Sehat StresP</h1>
      <h2>Gratis pengukuran indikasi stres dan konsultasi psikologi</h2>
      <img src="img/utama2.png" alt="Hero Imgs">
      <a href="#register" class="btn-get-started scrollto">Daftar</a>

    </div>
  </section><!-- #hero -->

  <section id="register" class="padd-section wow fadeInUp">

    <div class="container">
      <div class="section-title text-center">
        <h2>Daftar</h2>
        <p class="separator">Isikan data Anda Untuk bisa menikmati fasilitas website ini</p>
      </div>
    </div>

    <div class="container">
      <div class="row justify-content-center">



        <div class="col-lg-5 col-md-8">
          <div class="form">
            <form action="register.php" method="post" role="form" class="contactForm">
              <div class="form-group">
                <input type="text" name="namalengkap" class="form-control" id="namalengkap" placeholder="Nama Anda" data-rule="minlen:4" data-msg="Tolong isi nama Anda dengan benar" required/>
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email Anda" data-rule="email" data-msg="Please enter a valid email" required/>
                <div class="validation"></div>
              </div>
			  <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username Anda" required/>
                <div class="validation"></div>
              </div>
			  <div class="form-group">
                <input type="password" class="form-control" name="password" id="email" placeholder="Password Anda" required/>
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="nomorhp" id="nomorhp" placeholder="Nomor HP Anda" required/>
                <div class="validation"></div>
              </div>
              <div class="text-center"><button class="button button1" type="submit">Daftar</button></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="login" class="padd-section wow fadeInUp">

    <div class="container">
      <div class="section-title text-center">
        <h2>Login</h2>
        <p class="separator">Login terlebih dahulu untuk dapat mengakses fitur yang ditawarkan oleh website ini</p>
      </div>
    </div>

    <div class="container">
      <div class="row justify-content-center">


        <div class="col-lg-5 col-md-8">
          <div class="form">

            <form action="login_process.php" method="POST" role="form" class="contactForm">
              <div class="form-group">
                <input type="text" class="form-control" name="username" id="username" placeholder="Username Anda" required/>
                <div class="validation"></div>
              </div>
			  <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password Anda" required/>
                <div class="validation"></div>
              </div>
              <div class="text-center"><button class="button button1" type="submit">Login</button></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section><!-- #contact -->
  <!--==========================
    Footer
  ============================-->
  <footer class="footer">
    <div class="container">
      <div class="row">

        <div class="col-md-12 col-lg-4">
          <div class="footer-logo">

            <a class="navbar-brand" href="#">StresP</a>
            <p>Ingin bergabung dengan kami menjadi psikolog kami? klik daftar dibawah ini.</p>
            <a href="registerdokter.php"><button class="button button1" type="submit">Daftar</button></a> 
          </div>
        </div>

        <div class="col-sm-6 col-md-3 col-lg-2">
          <div class="list-menu">
			<img src="img/child.png"
          </div>
        </div>

      </div>
    </div>

    <div class="copyrights">
      <div class="container">
        <p>&copy; Copyrights StresP. All rights reserved.</p>
        <div class="credits">
          <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=eStartup
          -->
          Designed by <a href="#">StresP</a>
        </div>
      </div>
    </div>

  </footer>



  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/modal-video/js/modal-video.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>

</body>
</html>
