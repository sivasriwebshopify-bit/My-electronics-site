<?php
include "config.php";

$name = $_POST['name'];
$price = $_POST['price'];

$check = $conn->query("SELECT * FROM cart WHERE product_name='$name'");

if($check->num_rows > 0){
    $conn->query("DELETE FROM cart WHERE product_name='$name'");
    echo "removed";
}else{
    $conn->query("INSERT INTO cart (product_name,price) VALUES ('$name','$price')");
    echo "added";
}
?>