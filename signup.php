<?php
  session_start();
  error_reporting(E_ERROR | E_PARSE);
  $db=mysqli_connect("localhost","avantika","avantika","db1"); #port number
  if(!$db){
    printf("not connected to server");
  }
  if(isset($_POST['register'])){
    $first_name=mysqli_real_escape_string($db,$_POST['first_name']);
    $last_name=mysqli_real_escape_string($db,$_POST['last_name']);
    $email=mysqli_real_escape_string($db,$_POST['email']);
    $age=mysqli_real_escape_string($db,$_POST['age']);
    $gender=mysqli_real_escape_string($db,$_POST['gender']);
    $password=mysqli_real_escape_string($db,$_POST['password']);
    $retype_password=mysqli_real_escape_string($db,$_POST['retype_password']);

    //save to database
    if($password == $retype_password){
      #$password=md5($password);//encrypting the password
      $sql="INSERT INTO user (first_name,last_name,email,gender,age,password) VALUES('$first_name','$last_name','$email','$gender','$age','$password')";
      if(mysqli_query($db, $sql)){
        $row=mysqli_query($db,"SELECT * from user where first_name='$first_name' and last_name='$last_name'
              and gender='$gender' and age='$age' and email='$email'");
        if($row1=mysqli_fetch_assoc($row)){
          $_SESSION['first_name']=$first_name;
          $_SESSION['u_id']=$row1['u_id'];
          $_SESSION['success']="your account has been created!";
          header('location:user_homepage.php');
        }
         //redirecting to user home page
        //echo "<script> window.location.assign('user_homepage.php'); </script>";
    } else{
        printf("ERROR: Could not able to execute $sql. " . mysqli_error($db));
    }
    }
    else{
      $_SESSION['message']="the passwords do not match";
    }
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <title>SignUp</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">

<style type="text/css">
html,
body {
    height: 100%;
}
html {
    display: table;
    margin: auto;
}
body {
    display: table-cell;
    vertical-align: middle;
}
.margin {
  margin: 0 !important;
}
</style>
  </head>
  <body class="blue">
    Register Here!

    <form class="" action="signup.php" method="POST">
      
  <div id="login-page" class="row">
    <div class="col s12 z-depth-6 card-panel">
      <form class="login-form">
        <div class="row">
          <div class="input-field col s12 center">
            
            <p class="center login-form-text">REGISTER HERE</p>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input type="text" name="first_name" value="" required/ class="validate">
            <label for="first_name" class="center-align">First name</label>
          </div>
        </div>
		 <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input type="text" name="last_name" value="" required/ class="validate" required>
            <label for="last_name" class="center-align">Last name</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-communication-email prefix"></i>
            <input id="email" type="email" name="email" value="" class="validate" required>
            <label for="email" class="center-align">Email</label>
          </div>
        </div>
		<div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="age" type="text" name="age" value="" class="validate" required>
            <label for="age" class="center-align">Age</label>
          </div>
        </div>
		<div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="gender" type="text" name="gender" class="validate"   required>
            <label for="gender" class="center-align">Gender</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" type="password" class="validate" required>
            <label for="password">Password</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password-again" type="password">
            <label for="password-again">Re-type password</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <button type="submit" name="register" id="register" class="btn waves-effect waves-light col s12">Register</button>
          </div>
          <div class="input-field col s12">
            <p class="margin center medium-small sign-up">Already have an account? <a href="login.php">Login</a></p>
          </div>
        </div>
      </form>
    </div>
  </div>
    </form>
    <center><a href="homepage.php">go back</a></center>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- jQuery Library -->
 <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <!--materialize js-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>

<center>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Post Page - Responsive -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:250px"
     data-ad-client="ca-pub-5104998679826243"
     data-ad-slot="3470684978"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</center>

  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-27820211-3', 'auto');
  ga('send', 'pageview');

</script><script src="//load.sumome.com/" data-sumo-site-id="1cf2c3d548b156a57050bff06ee37284c67d0884b086bebd8e957ca1c34e99a1" async="async"></script>


   <footer class="page-footer">
          <div class="footer-copyright">
            <div class="container">
            © 2018 ISE 5 'A'
            <a class="grey-text text-lighten-4 right" href="#">Anjali,Avantika</a>
            </div>
          </div>
  </footer>
</body>
</html>
