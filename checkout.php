<?php
session_start();
include "config.php";

$name = $_GET['name'];
$price = $_GET['price'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light p-4">

<div class="container">
<h3>Checkout</h3>

<div class="card p-4">

<h5><?php echo $name; ?></h5>
<p>Price: $<?php echo $price; ?></p>

<form action="place_order.php" method="POST">

<input type="hidden" name="name" value="<?php echo $name; ?>">
<input type="hidden" name="price" value="<?php echo $price; ?>">

<input name="address" class="form-control my-2" placeholder="Enter Address" required>
<input name="phone" class="form-control my-2" placeholder="Enter Mobile Number" required>
<input name="pincode" class="form-control my-2" placeholder="Enter Pincode" required>

<button class="btn btn-success w-100">Place Order</button>

</form>

</div>
</div>

</body>
</html>