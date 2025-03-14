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
  <link rel="stylesheet" href="../CSS/home3.css">
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
          <li><a href="../HomePage/about.html">About</a></li>
          <li><a href="">Contact</a></li>
          <li><a href="../user/login-user.php">Account</a></li>
        </ul>
      </nav>
      <a href="../cart/cart.php"><img src="../images/shopping-bag.png" width="30px" height="30px" alt="shopping bag"></a>
    </div>



<div class="small-container">
  <h2 class="title">All Products</h2>
  <div class="row">
    <?php foreach ($producten as $product): ?>
      <div class="col-4">
    <a href="productDetail.php?id=<?= urlencode($product['productID']); ?>">
        <img src="<?= htmlspecialchars($product['foto']); ?>" alt="<?= htmlspecialchars($product['productNaam']); ?>">
    </a>
    <h4><?= htmlspecialchars($product['productNaam']); ?></h4>
    <p>€<?= number_format($product['prijsPerStuk'], 2); ?></p>
</div>
    <?php endforeach; ?>
  </div>
</div>



<!-- Footer -->
<footer class="footer">
     <div class="container">
      <div class="row">
       <!-- Bedrijfsinformatie -->
       <div class="footer-col">
        <h4>Want More</h4>
        <ul>
          <li><a href="../HomePage/home.php">Home</a></li>
          <li><a href="../HomePage/about.html">Over Ons</a></li>
          <li><a href="../Contact/contact.php">Contact</a></li>
          <li><a href="../user/login-user.php">Account</a></li>
        </ul>
      </div>

      <!-- Klantenservice -->
      <div class="footer-col">
        <h4>Klantenservice</h4>
        <ul>
          <li><a href="#">Verzending & Retour</a></li>
          <li><a href="#">Veelgestelde vragen</a></li>
          <li><a href="#">Privacybeleid</a></li>
          <li><a href="#">Algemene voorwaarden</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="footer-col">
        <h4>Contact</h4>
        <ul>
          <li><i class="fas fa-phone"></i> +31 6 84597079</li>
          <li><i class="fas fa-envelope"></i> shev.dogia@gmail.com</li>
          <li><i class="fas fa-map-marker-alt"></i> Amsterdam, Nederland</li>
        </ul>
      </div>

      <!-- Social Media -->
      <div class="footer-col">
        <h4>Volg ons</h4>
        <div class="social-links">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
  </div>

  <!-- Copyright -->
  <div class="footer-bottom">
    <p>&copy; 2025 Want More. Alle rechten voorbehouden.</p>
  </div>
</footer>


<!-- Footer -->
</body>
</html>