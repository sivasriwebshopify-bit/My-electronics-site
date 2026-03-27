<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sivaniki Electronics</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
background:url("img/background image.jpg") no-repeat center center fixed;
background-size:cover;
transition:0.3s;
}

.dark-mode{background:#121212!important;color:white;}
.dark-mode .product{background:#1e1e1e;color:white;}

.navbar{background:#2874f0;color:white;}
.search-box{width:40%;}

.carousel img{
width:100%;
height:350px;
object-fit:contain;
background:white;
border-radius:10px;
}

.product{
background:white;
padding:15px;
border-radius:10px;
margin-bottom:20px;
text-align:center;
transition:0.3s;
}
.product:hover{transform:scale(1.05);}

.row{min-height:300px;}
.product-card{min-height:300px;}

.wishlist-icon{
position:absolute;
top:10px;
right:10px;
cursor:pointer;
color:#ccc;
}
.wishlist-icon.active{color:red;}

#wishlistBox,#cartBox,#offerBox{
position:fixed;
top:80px;
width:260px;
background:white;
padding:10px;
border-radius:10px;
display:none;
z-index:9999;
box-shadow:0 5px 20px rgba(0,0,0,0.3);
}

#offerBox{right:10px;}
#cartBox{right:280px;}
#wishlistBox{right:550px;}

.amazon-add{background:#ffd814;width:100%;}
.amazon-buy{background:#ff9900;color:white;width:100%;}

.star{cursor:pointer;font-size:18px;}
</style>
</head>

<body>

<nav class="navbar p-2">
<div class="container">
<h5>Sivaniki Electronics</h5>

<input class="form-control search-box" placeholder="Search..." onkeyup="applyFilter()">

<button class="btn btn-danger" onclick="toggleWishlist()">❤️</button>
<button class="btn btn-warning" onclick="toggleCart()">🛒</button>
<button class="btn btn-success" onclick="toggleOffer()">🔥</button>
<button class="btn btn-dark" onclick="toggleDark()">🌙</button>
<a href="orders.php" class="btn btn-primary">📦 Orders</a>
</div>
</nav>

<!-- CATEGORY -->
<div class="container mt-3 text-center">
<button class="btn btn-outline-primary m-1" onclick="setCategory('all')">All</button>
<button class="btn btn-outline-primary m-1" onclick="setCategory('mobile')">Mobiles</button>
<button class="btn btn-outline-primary m-1" onclick="setCategory('laptop')">Laptops</button>
<button class="btn btn-outline-primary m-1" onclick="setCategory('watch')">Watches</button>
<button class="btn btn-outline-primary m-1" onclick="setCategory('electronics')">Electronics</button>
<button class="btn btn-outline-primary m-1" onclick="setCategory('home')">Home</button>
<button class="btn btn-outline-primary m-1" onclick="setCategory('toy')">Toy</button>
</div>

<!-- SLIDER -->
<div class="container mt-3">
<div id="slider" class="carousel slide" data-bs-ride="carousel">
<div class="carousel-inner">
<div class="carousel-item active"><img src="img/banner1.webp"></div>
<div class="carousel-item"><img src="img/banner2.jpg"></div>
<div class="carousel-item"><img src="img/banner3.jpg"></div>
</div>
</div>
</div>

<!-- BOXES -->
<div id="wishlistBox"><h6>❤️ Wishlist</h6><ul id="wishlistList"></ul></div>
<div id="cartBox"><h6>🛒 Cart</h6><ul id="cartList"></ul></div>
<div id="offerBox">
<h6>🔥 Offers</h6>
<ul>
<li>Mobile - 20% OFF</li>
<li>Laptop - 15% OFF</li>
<li>Watch - 30% OFF</li>
</ul>
</div>

<!-- PRODUCTS -->
<div class="container mt-4">
<div class="row">

<?php
$result=$conn->query("SELECT * FROM products");

while($row=$result->fetch_assoc()){
$name=$row['name'];
$category=strtolower(trim($row['category']));

$res=$conn->query("SELECT AVG(rating) as avg_rating FROM ratings WHERE product_name='$name'");
$data=$res->fetch_assoc();
$avg=round($data['avg_rating'],1);
?>

<div class="col-md-4 product-card" data-category="<?php echo $category; ?>">
<div class="product">

<span class="wishlist-icon" onclick="addWishlist('<?php echo $row['name']; ?>',this)">❤</span>

<img src="<?php echo $row['image']; ?>" style="width:150px;height:150px;">

<a href="product.php?name=<?php echo urlencode($row['name']); ?>">
<h5><?php echo $row['name']; ?></h5>
</a>

<p>$<?php echo $row['price']; ?></p>

<p>⭐ <?php echo $avg ? $avg : "0"; ?> / 5</p>


<div>
<span class="star" onclick="rate('<?php echo $row['name']; ?>',1)">⭐</span>
<span class="star" onclick="rate('<?php echo $row['name']; ?>',2)">⭐</span>
<span class="star" onclick="rate('<?php echo $row['name']; ?>',3)">⭐</span>
<span class="star" onclick="rate('<?php echo $row['name']; ?>',4)">⭐</span>
<span class="star" onclick="rate('<?php echo $row['name']; ?>',5)">⭐</span>
</div>

<button onclick="addCart('<?php echo $row['name']; ?>',<?php echo $row['price']; ?>)" class="amazon-add">Add</button>
<button onclick="openCheckout('<?php echo $row['name']; ?>',<?php echo $row['price']; ?>,'<?php echo $row['image']; ?>')" class="amazon-buy">Buy Now</button>

</div>
</div>

<?php } ?>

</div>
</div>

<script>
let selectedCategory="all";

function setCategory(cat){
selectedCategory=cat;
applyFilter();
}

function applyFilter(){
let search=document.querySelector(".search-box").value.toLowerCase();

document.querySelectorAll(".product-card").forEach(card=>{
let text=card.innerText.toLowerCase();
let category=card.getAttribute("data-category");

if((selectedCategory==="all" || category===selectedCategory) && text.includes(search)){
card.style.display="block";
}else{
card.style.display="none";
}
});
}

// STORAGE
let cart = JSON.parse(localStorage.getItem("cart")) || [];
let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];

function loadCart(){
cartList.innerHTML="";
cart.forEach(i=>cartList.innerHTML += `<li>${i.name} ($${i.price})</li>`);
}

function loadWishlist(){
wishlistList.innerHTML="";
wishlist.forEach(i=>wishlistList.innerHTML += `<li>${i}</li>`);
}

window.onload=function(){
loadCart();
loadWishlist();
};

// TOGGLE
function toggleWishlist(){wishlistBox.style.display = wishlistBox.style.display==="block"?"none":"block";}
function toggleCart(){cartBox.style.display = cartBox.style.display==="block"?"none":"block";}
function toggleOffer(){offerBox.style.display = offerBox.style.display==="block"?"none":"block";}
function toggleDark(){document.body.classList.toggle("dark-mode");}

// CART
function addCart(name,price){
cart.push({name,price});
localStorage.setItem("cart",JSON.stringify(cart));
loadCart();
cartBox.style.display="block";
}

// WISHLIST
function addWishlist(name,el){
if(!wishlist.includes(name)){
wishlist.push(name);
localStorage.setItem("wishlist",JSON.stringify(wishlist));
el.classList.add("active");
loadWishlist();
}
}

// RATING
function rate(name,stars){
fetch("save_rating.php",{
method:"POST",
headers:{"Content-Type":"application/x-www-form-urlencoded"},
body:`name=${name}&rating=${stars}`
}).then(()=>location.reload());
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>