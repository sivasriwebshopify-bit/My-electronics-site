<?php
include "config.php";

if(isset($_POST['register'])){
  $name=$_POST['name'];
  $email=$_POST['email'];
  $pass=password_hash($_POST['password'], PASSWORD_DEFAULT);

  // Check duplicate
  $check=$conn->query("SELECT * FROM users WHERE email='$email'");
  if($check->num_rows>0){
    echo "<script>alert('Email already registered');</script>";
  }else{
    $conn->query("INSERT INTO users (name,email,password) VALUES ('$name','$email','$pass')");
    echo "<script>alert('Registered Successfully');window.location='login.php';</script>";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">
<div class="card p-4 shadow" style="width:350px;">
<h4 class="text-center">Create Account</h4>

<form method="POST">
<input name="name" class="form-control my-2" placeholder="Full Name" required>
<input name="email" class="form-control my-2" placeholder="Email" required>
<input name="password" type="password" class="form-control my-2" placeholder="Password" required>

<button name="register" class="btn btn-success w-100">Register</button>
</form>

<p class="text-center mt-2">
Already have account? <a href="login.php">Login</a>
</p>

</div>
</div>

</body>
</html>