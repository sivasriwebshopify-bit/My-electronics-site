<?php
include "config.php";

$res = $conn->query("SELECT * FROM wishlist");

while($row=$res->fetch_assoc()){
echo "<li>".$row['product_name']."</li>";
}
?>