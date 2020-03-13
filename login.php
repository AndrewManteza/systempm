<DOCTYPE html>

<?php

require_once('class/connectdb.php');
require_once('class/functions.php'); 

?>

<html>

 <head>

   <title>Login</title>

 </head>

   <body>

   <h2> Login </h2>

   <form action = "server.php" method = "post">

     <h1>Login</h1>
     <label for = "username"> Username: </label>
     <input type ="text" name= "username" required><br>

     <label for="password"> Password </label>
     <input type ="password" name= "password_1" required><br>

     <button type = "submit" name = "login_User"> Submit </button>

     </form>
</html>