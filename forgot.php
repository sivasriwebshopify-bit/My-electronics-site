<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$conn = new mysqli("localhost","sivasri_sivasri","Test@123.2005","sivasri_shop_db");

if(isset($_POST['email'])){
   $email = trim($_POST['email']);

$check = mysqli_query($conn, "SELECT * FROM users WHERE LOWER(email)=LOWER('$email')");

    if(mysqli_num_rows($check) > 0){

        $otp = rand(100000,999999);

        mysqli_query($conn, "UPDATE users SET otp='$otp' WHERE email='$email'");

        $mail = new PHPMailer(true);

        try {
           $mail->Host = 'mail.vani.sivasrit.in';  // IMPORTANT CHANGE
$mail->Username = 'sivasri@vani.sivasrit.in';
$mail->Password = 'VEERA.SRI@2005';     // cPanel la create panna password
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
            $mail->setFrom('sivasri@vani.sivasrit.in', 'Sivaniki Shop');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Reset Password OTP';
            $mail->Body = "Your OTP is: <b>$otp</b>";

            $mail->send();

             echo "<script>
alert('OTP Sent Successfully');
window.location.href='verify.php?email=$email';
</script>";

        } catch (Exception $e) {
            echo "Mail Failed: " . $mail->ErrorInfo;
        }

    } else {
        echo "<script>alert('Email not found');</script>";
    }
}
?>

<form method="POST">
<input type="email" name="email" placeholder="Enter Email" required>
<button type="submit">Send OTP</button>
</form>