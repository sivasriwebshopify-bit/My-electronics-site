<?php include "config.php"; ?>

<?php
$name = $_GET['name'];

$res=$conn->query("SELECT * FROM products WHERE name='$name'");
$product=$res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $name; ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

<div class="row">

<div class="col-md-6">
<img src="<?php echo $product['image']; ?>" style="width:100%;">
</div>

<div class="col-md-6">
<h3><?php echo $product['name']; ?></h3>
<h4>$<?php echo $product['price']; ?></h4>

<!-- ⭐ rating -->
<div>
<span onclick="rate('<?php echo $name; ?>',1)">⭐</span>
<span onclick="rate('<?php echo $name; ?>',2)">⭐</span>
<span onclick="rate('<?php echo $name; ?>',3)">⭐</span>
<span onclick="rate('<?php echo $name; ?>',4)">⭐</span>
<span onclick="rate('<?php echo $name; ?>',5)">⭐</span>
</div>

<!-- 📝 REVIEW FORM -->
<form onsubmit="submitReview(event,'<?php echo $name; ?>')">

<input type="text" id="user" placeholder="Your Name" class="form-control mb-2" required>

<textarea id="comment" placeholder="Write review" class="form-control mb-2" required></textarea>

<select id="rating" class="form-control mb-2">
<option value="5">⭐⭐⭐⭐⭐</option>
<option value="4">⭐⭐⭐⭐</option>
<option value="3">⭐⭐⭐</option>
<option value="2">⭐⭐</option>
<option value="1">⭐</option>
</select>

<button class="btn btn-primary">Submit Review</button>
</form>

<hr>

<h5>Reviews:</h5>

<?php
$rev=$conn->query("SELECT * FROM reviews WHERE product_name='$name' ORDER BY id DESC");

while($r=$rev->fetch_assoc()){
?>

<div style="background:#eee;padding:10px;margin-bottom:10px;">
<b><?php echo $r['user_name']; ?></b> ⭐ <?php echo $r['rating']; ?><br>
<?php echo $r['comment']; ?>
</div>

<?php } ?>

</div>

</div>

</div>

<script>
function rate(name,stars){
fetch("save_rating.php",{
method:"POST",
headers:{"Content-Type":"application/x-www-form-urlencoded"},
body:`name=${name}&rating=${stars}`
})
.then(()=>location.reload());
}

function submitReview(e,name){
e.preventDefault();

let user=document.getElementById("user").value;
let comment=document.getElementById("comment").value;
let rating=document.getElementById("rating").value;

fetch("save_review.php",{
method:"POST",
headers:{"Content-Type":"application/x-www-form-urlencoded"},
body:`name=${name}&user=${user}&rating=${rating}&comment=${comment}`
})
.then(()=>{
alert("Review Added ✅");
location.reload();
});
}
</script>

</body>
</html>