<?php
require_once "../product/Product.php";
$product = new Product();
$producten = $product->getAllProducts();
?>





<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Products</title>
  <link rel="stylesheet" href="../CSS/home2.css">
</head>
<body>
  
<div class="navbar">
      <div class="logo">
        <a href="../HomePage/home.php">
          <img src="../Logo/WantMore..png" alt="logo" width="125px">
        </a>
      </div>
      <nav>
        <ul>
          <li><a href="../HomePage/home.php">Home</a></li>
          <li><a href="../Product/">Producten</a></li>
          <li><a href="">About</a></li>
          <li><a href="">Contact</a></li>
          <li><a href="">Account</a></li>
        </ul>
      </nav>
      <img src="../images/shopping-bag.png" width="30px" height="30px" alt="shopping bag">
    </div>



<div class="small-container">
  <h2 class="title">All Products</h2>
  <div class="row">
    <?php foreach ($producten as $product): ?>
      <div class="col-4">
        <img src="<?= htmlspecialchars($product['foto']); ?>" alt="<?= htmlspecialchars($product['productNaam']); ?>">
        <h4><?= htmlspecialchars($product['productNaam']); ?></h4>
        <p>€<?= number_format($product['prijsPerStuk'], 2); ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</div>

</body>
</html>