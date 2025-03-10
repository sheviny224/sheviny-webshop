<?php
require_once "../product/Product.php";

if (!isset($_GET['id'])) {
    die("Product niet gevonden!");
}

$product = new Product();
$productDetail = $product->getProductById($_GET['id']);

if (!$productDetail) {
    die("Product niet gevonden!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($productDetail['productNaam']); ?></title>
  <link rel="stylesheet" href="../CSS/home3.css">
</head>
<body>


<div class="header">
  <div class="container">
    <div class="navbar">
      <div class="logo">
        <a href="../HomePage/home.php">
          <img src="../Logo/WantMore..png" alt="logo" width="125px">
        </a>
      </div>
      <nav>
        <ul>
          <li><a href="../HomePage/home.php">Home</a></li>
          <li><a href="../Product/product-view-user.php">Producten</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="../Contact/contact.php">Contact</a></li>
          <li><a href="../user/login-user.php">Account</a></li>
        </ul>
      </nav>
       <a href="../Product/addToCart.php"><img src="../images/shopping-bag.png" width="30px" height="30px" alt="shopping bag"></a>
    </div>
    
<div class="small-container">
  <div class="row">
    <div class="col-2">
      <img src="<?= htmlspecialchars($productDetail['foto']); ?>" alt="<?= htmlspecialchars($productDetail['productNaam']); ?>" width="70%">
    </div>
    <div class="col-2">
      <h1><?= htmlspecialchars($productDetail['productNaam']); ?></h1>
      <h4>€<?= number_format($productDetail['prijsPerStuk'], 2); ?></h4>
      <p><?= nl2br(htmlspecialchars($productDetail['omschrijving'])); ?></p>
      <a href="addToCart.php?id=<?= urlencode($productDetail['productID']); ?>" class="btn">Toevoegen aan winkelwagen</a>
    </div>
  </div>
</div>

</body>
</html>
