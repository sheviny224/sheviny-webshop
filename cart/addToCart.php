<?php
session_start();
require_once "../Product/Product.php";

if (!isset($_GET['id'])) {
    die("Product niet gevonden!");
}

$product = new Product();
$cartItem = $product->getProductById($_GET['id']);

if (!$cartItem) {
    die("Product niet gevonden!");
}

// Zorg dat de winkelwagen (session) bestaat
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Controleer of het product al in de winkelwagen zit
$productID = $cartItem['productID'];
if (isset($_SESSION['cart'][$productID])) {
    $_SESSION['cart'][$productID]['aantal'] += 1; // Verhoog het aantal
} else {
    $_SESSION['cart'][$productID] = [
        'productID' => $cartItem['productID'],
        'naam' => $cartItem['productNaam'],
        'prijs' => $cartItem['prijsPerStuk'],
        'foto' => $cartItem['foto'],
        'aantal' => 1
    ];
}

// Stuur de gebruiker terug naar de productpagina of winkelwagen
header("Location: ../cart/cart.php");
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>add to cart!</title>
  <link rel="stylesheet" href="../CSS/navbar.css">
  
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
          <li><a href="../Product/product-view-user.php">Producten</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="../Contact/contact.php">Contact</a></li>
          <li><a href="../user/login-user.php">Account</a></li>
        </ul>
      </nav>
       <a href="../cart/addToCart.php"><img src="../images/shopping-bag.png" width="30px" height="30px" alt="shopping bag"></a>
    </div>
    </div>




<div class="small-container">
  <div class="row">
    <div class="col-2">
      <img src="<?= htmlspecialchars($cart['foto']); ?>" alt="<?= htmlspecialchars($cart['productNaam']); ?>" width="7%">
    </div>
    <div class="col-2">
      <h1><?= htmlspecialchars($cart['productNaam']); ?></h1>
      <h4>€<?= number_format($cart['prijsPerStuk'], 2); ?></h4>
      <input type="number" name="aantal" id="aantal">
       <a href=""><img src="../images/bin.png" alt="vuilnisbak" srcset="" width="1.5%"></a>
      <p><?= nl2br(htmlspecialchars($cart['omschrijving'])); ?></p>

      <a href="../cart/addToCart.php?id=<?= $cart['productID']; ?>" class="btn">Add to cart!</a>

      
    </div>
  </div>
</div>
</body>
</html>