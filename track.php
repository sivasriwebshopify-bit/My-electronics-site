<?php include "config.php"; ?>

<?php
$id=$_GET['id'];
$result=$conn->query("SELECT * FROM orders WHERE id=$id");
$row=$result->fetch_assoc();

/* 🔥 AUTO STATUS */
$date = strtotime($row['order_date']);
$now = time();
$days = floor(($now - $date) / (60*60*24));

if($days >= 3){
$status = "Delivered";
}
elseif($days == 2){
$status = "Out";
}
elseif($days == 1){
$status = "Shipped";
}
else{
$status = "Ordered";
}

/* 📅 DELIVERY DATE */
$delivery = date("d M Y", strtotime($row['order_date']." +3 days"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Track Order</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">

<h3>📦 Track Order</h3>

<h5><?php echo $row['product_name']; ?></h5>

<!-- 🔥 PROGRESS BAR -->
<div class="progress mt-4">
<div class="progress-bar bg-success" style="width:
<?php
if($status=="Ordered") echo "25%";
elseif($status=="Shipped") echo "50%";
elseif($status=="Out") echo "75%";
elseif($status=="Delivered") echo "100%";
?>
">
<?php echo $status; ?>
</div>
</div>

<!-- 📅 DELIVERY -->
<p class="mt-3">📅 Delivery by: <b><?php echo $delivery; ?></b></p>

</body>
</html>