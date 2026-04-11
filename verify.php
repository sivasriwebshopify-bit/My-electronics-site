<?php
$conn = new mysqli("localhost","sivasri_sivasri","Test@123.2005","sivasri_shop_db");

$email = $_GET['email'];

if(isset($_POST['otp'])){
    $otp = $_POST['otp'];

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND otp='$otp'");

    if(mysqli_num_rows($check) > 0){

        echo "<script>
        alert('OTP Verified');
        window.location.href='reset.php?email=$email';
        </script>";

    } else {
        echo "<script>alert('Invalid OTP');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Verify OTP</title>
<style>
body{display:flex;justify-content:center;align-items:center;height:100vh;background:#f0f2f5;}
.box{background:white;padding:30px;border-radius:10px;text-align:center;}
input,button{padding:10px;margin:10px;width:200px;}
</style>
</head>
<body>

<div class="box">
<h2>🔢 Enter OTP</h2>

<form method="POST">
<input type="text" name="otp" placeholder="Enter OTP" required>
<button type="submit">Verify</button>
</form>

</div>

</body>
</html>