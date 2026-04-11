<?php
$conn = new mysqli("localhost","sivasri_sivasri","Test@123.2005","sivasri_shop_db");

$email = $_GET['email'];

if(isset($_POST['password'])){
    $new_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    mysqli_query($conn, "UPDATE users SET password='$new_pass', otp=NULL WHERE email='$email'");

    echo "<script>
    alert('Password Updated Successfully');
    window.location.href='login.php';
    </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Reset Password</title>
<style>
body{display:flex;justify-content:center;align-items:center;height:100vh;background:#f0f2f5;}
.box{background:white;padding:30px;border-radius:10px;text-align:center;}
input,button{padding:10px;margin:10px;width:200px;}
</style>
</head>
<body>

<div class="box">
<h2>🔒 Reset Password</h2>

<form method="POST">
<input type="password" name="password" placeholder="New Password" required>
<button type="submit">Update Password</button>
</form>

</div>

</body>
</html>