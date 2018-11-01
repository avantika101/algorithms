<?php
error_reporting(E_ALL);
ob_start();
include('user_homepage.php');
include('login.php');
include('signup.php');
ob_end_clean();

  error_reporting(E_ALL);
  $db=mysqli_connect("localhost","avantika","avantika","db1"); #port number

  if(isset($_POST['search'])){
    $from=$_POST['from'];
    $to=$_POST['to'];
    $type=$_POST['type'];

    $sql1="SELECT T.t_no,T.start_t,S.arrival_time as arrival_time from train T,station S
          WHERE T.start_station='$from' and (T.end_station='$to' or S.s_name='$to') and T.t_no=S.t_no";
    $result1=mysqli_query($db,$sql1); //=$db->query($sql); gives an object

    if(!$result1 || mysqli_num_rows($result1)==0){
      //output data of each row
        echo "0 results";
      }else{
        while($row=mysqli_fetch_assoc($result1)){
          //$i=$i+1;
          $train=$row['t_no'];
          $sql2=""; $fare="";
          if($type=='AC_fare'){
            $sql2=mysqli_query($db,"SELECT AC_fare from train_status where t_no='$train'");
            $row1=mysqli_fetch_assoc($sql2);
            $fare=$row1['AC_fare'];
          }else {
            $sql2=mysqli_query($db,"SELECT g_fare from train_status where t_no='$train'");
            $row1=mysqli_fetch_assoc($sql2);
            $fare=$row1['g_fare'];
          }
          echo "<br><span>train_no:".$row['t_no']." start time:".$row['start_t']." end time:".$row['arrival_time']." ";
          echo "fare:".$fare."</span><br>";
          //echo "<input type='button' onclick='book('"."$i".".');' value='book ticket'/>";
      }
    }
    }
    if(isset($_POST['indirect_search'])){
      $from=$_POST['from'];
      $to=$_POST['to'];
      $type=$_POST['type'];

      $sql1="SELECT S.t_no,S.arrival_time from station S
            where t_no=(select T.t_no from station T where T.s_name='$from') and S.s_name='$to'";
      $result1=mysqli_query($db,$sql1); //=$db->query($sql); gives an object

      if(!$result1 || mysqli_num_rows($result1)==0){
        //output data of each row
          echo "0 results";
        }else{
          while($row=mysqli_fetch_assoc($result1)){
            //$i=$i+1;
            $train[$i]=$row['t_no'];
            $sql2=""; $fare="";
            if($type=='AC_fare'){
              $sql2=mysqli_query($db,"SELECT AC_fare from train_status where t_no='$train'");
              $row1=mysqli_fetch_assoc($sql2);
              $fare=$row1['AC_fare'];
            }else {
              $sql2=mysqli_query($db,"SELECT g_fare from train_status where t_no='$train'");
              $row1=mysqli_fetch_assoc($sql2);
              $fare=$row1['g_fare'];
            }

            echo "<br>train_no:".$row['t_no']." start time:".$row['start_t']." end time:".$row['arrival_time']." ";
            echo "fare:".$fare."<br>";
            //echo "<input type='button' onclick='book(\"$i\")'; value='book'/>";
        }
      }
    }

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Search for trains</title>
  <!-- CORE CSS-->
  
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
  
  <div id="login-page" class="row">
    <div class="col s12 z-depth-6 card-panel">
	PLAN YOUR JOURNEY <br>
        <div class="row">
          <div class="input-field col s12 center">
            <p class="center login-form-text">Search for trains</p>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class=""></i>
   
    <form class="" action="search_for_train.php" method="post" id="search_for_train">
      <div class="">
          <div class="input-field col s12">
            <i class=""></i>
        <tr>
          <td>from:</td>
          <td><select class="" name="from" id="from" required>
            <option value="Kanpur(KNP)">Kanpur(KNP)</option>
            <option value="Patna(PTA)">Patna(PTA)</option>
            <option value="Bengaluru(BNG)">Bengaluru(BNG)</option>
            <option value="Bhopal(BHO)">Bhopal(BHO)</option>
          </select></td>
        </tr>
        <tr>
		</div>
		</div>
		<div class="row margin">
          <div class="input-field col s12">
            <i class=""></i>
          <td>to:</td>
          <td><select class="" name="to" id="to" required>
            <option value="Kanpur(KNP)">Kanpur(KNP)</option>
            <option value="Patna(PTA)">Patna(PTA)</option>
            <option value="Bengaluru(BNG)">Bengaluru(BNG)</option>
            <option value="Bhopal(BHO)">Bhopal(BHO)</option>
          </select></td>
        </tr>
		</div>
        </div>
	   <div class="row margin">
          <div class="input-field col s12">
            <i class=""></i>
        <tr>
          <td>category:</td>
          <td><select class="" name="type" id="type" required>
            <option value="AC_fare">AC_fare</option>
            <option value="g_fare">g_fare</option>
          </select></td>
        </tr>
		</div>
		</div>
     
      <button type="submit" name="search">direct search</button>
      <button type="submit" name="indirect_search">indirect search</button>
    </form>
    <a href="book.php">want to book?</a><br>
    <a href="#">clear fields</a><br>
    <a href="user_homepage.php">go back</a><br>
    <a href="#">logout</a><br>

  </body>
</html>
