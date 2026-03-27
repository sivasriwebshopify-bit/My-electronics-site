<?php include "config.php"; ?>
<!DOCTYPE html>
<html>
<head>
<title>My Orders</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">

<h3>📦 My Orders</h3>

<table class="table table-bordered text-center">
<tr>
<th>Product</th>
<th>Price</th>
<th>Status</th>
<th>Date</th>
</tr>

<?php
$result=$conn->query("SELECT * FROM orders ORDER BY id DESC");

while($row=$result->fetch_assoc()){
?>

<tr>
<td><?php echo $row['product_name']; ?></td>
<td>$<?php echo $row['price']; ?></td>
<td>
<a href="track.php?id=<?php echo $row['id']; ?>" class="btn btn-info">
Track
</a>
</td>
<td><?php echo $row['order_date']; ?></td>
</tr>

<?php } ?>

</table>

</body>
</html>