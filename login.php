<?php
  session_start();
  error_reporting(E_ERROR | E_PARSE);
  $db=mysqli_connect("localhost","avantika","avantika","db1");
  $email=mysqli_real_escape_string($db,$_POST['email']);
  $password=mysqli_real_escape_string($db,$_POST['password']);

  //query the db for user email and passwords
  if(isset($_POST['login'])){
    $result=mysqli_query($db,"select * from user where email='$email' and password='$password'")
            or die("failed to query database");
    $row=mysqli_fetch_array($result);
    if(($row['email']==$email)&& ($row['password']==$password)){
      //echo "login successful! welcome,",$row['first_name'];
      $_SESSION['first_name']=$row['first_name'];
      $_SESSION['u_id']=$row['u_id'];
      $_SESSION['success']="you've been logged in!";
      header('location:user_homepage.php'); //redirecting to user home page NOT WORKING
      //echo "<script> window.location.assign('user_homepage.php'); </script>"; //REDIRECTION WORKING
      exit();
    }else{
    echo "failed to login";
    }

  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
	<link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
  </head>
  <body>

    <form class="" action="login.php" method="post">

      <div class="wrap">
		<div class="avatar">
      <img src="http://cdn.ialireza.me/avatar.png">
		</div>
		
		<input type="text" name="email" placeholder="email" value="" required>
		<div class="bar">
			<i></i>
		</div>
		
		<input type="password" name="password" placeholder="password" value="" required><br>
			  <button type="submit" name="login">Login</button>
    <center><a href="homepage.php">Go Back</a></center>

	</div>

  <script src="js/index.js"></script>
      
    </form>
  </body>
</html>
