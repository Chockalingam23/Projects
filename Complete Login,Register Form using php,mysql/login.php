<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Login</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
require('db.php');
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['username'])){
        // removes backslashes
 $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
 $username = mysqli_real_escape_string($con,$username);
 $password = stripslashes($_REQUEST['password']);
 $password = mysqli_real_escape_string($con,$password);
 //Checking is user existing in the database or not
        $query = "SELECT * FROM `users` WHERE username='$username'
and password='".md5($password)."'";
 $result = mysqli_query($con,$query) or die(mysql_error());
 $rows = mysqli_num_rows($result);
        if($rows==1){
     $_SESSION['username'] = $username;
            // Redirect user to index.php
     header("Location: index.php");
         }else{
 echo "<div class='form'>
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
 }
    }else{
?>
<div class="login-form-wrap">
    <div class="left-section">
        <div class="title">
<h1>Hello!</h1>
<p>Please Login to continue</p>
        </div>
        <div class="form">
        <form class="" action="" method="post" name="login">
<input type="text" name="username" placeholder="Username" required />
<input type="password" name="password" placeholder="Password" required />
<input name="submit" type="submit" value="Login" />
</form>
<div class="create-account">
Not registered yet? <a href='registration.php'>Register Here</a>
</div>
</div>
 </div>
<div class="right-section">
   <div class="welcome-text">
       <h1>Welcome Back</h1>
       <p>.......</p>
   </div>
</div>
 </div>
<?php } ?>
</body>
</html>