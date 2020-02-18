<DOCTYPE html>

<?php
session_start();
require_once('class/connectdb.php');
require_once('class/functions.php'); 

?>
<html>

 <head>

   <title>Login</title>
   <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 </head>

 <style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif;}
.w3-sidebar {
  z-index: 3;
  width: 250px;
  top: 43px;
  bottom: 0;
  height: inherit;
}
</style>

   <body>

  

   <div class="w3-main" style="margin-left:800px">

<div class="w3-row w3-padding-64">
  <div class="w3-twothird w3-container">
  <form action = "server.php" method = "post">
  <h1> HELLO THERE </h1>
   <h2> Login </h2>
   <?php
      if(isset($_SESSION['fail']))
      {
        echo '<h1>Account not found</h1>';
        unset($_SESSION['fail']);
      }

      ?>
<label for = "username"> Username: </label>
<input type ="text" name= "username" ><br>

<label for="password"> Password </label>
<input type ="password" name= "password_1" ><br>

<button type = "submit" name = "login_User"> Submit </button>

<a class="w3-bar-item w3-button w3-hover-black" href="register.php">register here</a>

</form>
   
  </div>
 
</div>

  
</html>