<?php
include "config.php";

$name=$_POST['name'];
$price=$_POST['price'];
$address=$_POST['address'];
$phone=$_POST['phone'];
$pincode=$_POST['pincode'];

$conn->query("INSERT INTO orders(product_name,price,address,phone,pincode)
VALUES('$name','$price','$address','$phone','$pincode')");

echo "success";
?>