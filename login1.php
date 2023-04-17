<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $phoneno = mysqli_real_escape_string($conn, $_POST['phoneno']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE phoneno = '$phoneno' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:home.php');
   }else{
      $message[] = 'incorrect phone no or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="login1style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>login now</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="number" name="phoneno" placeholder="enter phone no." class="box" required>
      <input type="password" name="password" placeholder="enter password" class="box" required>
      <input type="submit" name="submit" value="login now" class="btn">
   </form>
</div>
<a href="custemplogin.html"><button class="btn">Go Back</button></a>

</body>
</html>