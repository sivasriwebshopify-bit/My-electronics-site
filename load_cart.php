<?php
include "config.php";

$res = $conn->query("SELECT * FROM cart");

while($row=$res->fetch_assoc()){
echo "<li>".$row['product_name']." ($".$row['price'].")</li>";
}
?>