<?php
$conn = new mysqli("localhost","sivasri_sivasri","Test@123.2005","sivasri_shop_db");

$email = $_GET['email'];

if(isset($_POST['otp'])){
    $otp = $_POST['otp'];

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND otp='$otp'");

    if(mysqli_num_rows($check) > 0){
        mysqli_query($conn, "UPDATE users SET otp_verified=1 WHERE email='$email'");

        echo "<script>
        alert('OTP Verified');
        window.location.href='reset_password.php?email=$email';
        </script>";
    } else {
        echo "<script>alert('Invalid OTP');</script>";
    }
}
?>

<form method="POST">
<h2>Enter OTP</h2>
<input type="text" name="otp" placeholder="Enter OTP" required>
<button type="submit">Verify</button>
</form>