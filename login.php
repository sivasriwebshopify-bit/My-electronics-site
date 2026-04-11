<?php
session_start();
include "config.php";

if(isset($_POST['login'])){
  $email=$_POST['email'];
  $pass=$_POST['password'];

  $res=$conn->query("SELECT * FROM users WHERE email='$email'");
  $user=$res->fetch_assoc();

  if($user && password_verify($pass,$user['password'])){
    $_SESSION['user']=$user['name'];
    $_SESSION['user_id']=$user['id'];
    header("Location:index.php");
    exit();
  }else{
    echo "<script>alert('Invalid Login');</script>";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">
<div class="card p-4 shadow" style="width:350px;">
<h4 class="text-center">Login</h4>

<form method="POST">
<input name="email" class="form-control my-2" placeholder="Email" required>
<input name="password" type="password" class="form-control my-2" placeholder="Password" required>

<button name="login" class="btn btn-primary w-100">Login</button>
</form>

<p class="text-center mt-2">
New user? <a href="register.php">Register</a>
<a href="forgot.php"> $Forgot Password?</a>
</p>

</div>
</div>

</body>
</html>