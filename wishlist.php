<?php
include "config.php";

$name = $_POST['name'];

$check = $conn->query("SELECT * FROM wishlist WHERE product_name='$name'");

if($check->num_rows > 0){
    $conn->query("DELETE FROM wishlist WHERE product_name='$name'");
    echo "removed";
}else{
    $conn->query("INSERT INTO wishlist (product_name) VALUES ('$name')");
    echo "added";
}
?>