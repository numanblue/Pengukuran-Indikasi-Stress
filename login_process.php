<html>
<body>
<style>
body {
    background-color: lightgreen;
    font-family:arial;
    font-size:20px;
}
</style>
<?php
error_reporting(0);
include 'connect_to_database.php'; //connect the connection page

  $username = $_POST['username'];
  $password = $_POST['password'];
if(empty($_SESSION)) // if the session not yet started
   session_start();

  $query = "SELECT * FROM users WHERE username='$username'
and password='$password'";
	$result = mysqli_query($connect,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
        if($rows==1){

            $row2  = mysqli_fetch_array($result);
            if($row2['posisi'] == '1'){
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['id'] = $row2['id'];
    				$_SESSION['namalengkap'] = $row2['namalengkap'];
    				$_SESSION['nomorhp'] = $row2['nomorhp'];
    				$_SESSION['email'] = $row2['email'];
            $_SESSION['posisi'] = $row2['posisi'];
            $_SESSION['point'] = $row2['point'];
            $sub_query = "
            INSERT INTO login_details
              (id)
              VALUES ('".$row2['id']."')
            ";
            $statement = $connect->prepare($sub_query);
    				$statement->execute();

                     header("Location: dokter/index.php");
          }else{


            $_SESSION['username'] = $_POST['username'];
            $_SESSION['id'] = $row2['id'];
    				$_SESSION['namalengkap'] = $row2['namalengkap'];
    				$_SESSION['nomorhp'] = $row2['nomorhp'];
    				$_SESSION['email'] = $row2['email'];
            $_SESSION['posisi'] = $row2['posisi'];
            $_SESSION['point'] = $row2['point'];
            $sub_query = "
            INSERT INTO login_details
              (id)
              VALUES ('".$row2['id']."')
            ";
            $statement = $connect->prepare($sub_query);
    				$statement->execute();

                     header("Location: home.php");
          }
        } else{ // if not a valid user
            echo "<br>";
            echo "<h2> Invalid Password !!! Try Again </h2>";
            echo "<br>";
            echo "<font name='arial'> <font size='5'>";
            echo "<a href='logout.php'>Return To Login Page</a> " ;
            echo "</font></font>";
        }


?>

</body>
</html>
