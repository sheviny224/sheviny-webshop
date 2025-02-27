<?php
require_once "../product/Product.php";

$productClass = new Product();
// $producten = $productClass->getAllProducts();
$featuredProducts = $productClass->getFeaturedProducts();
$latestProducts = $productClass->getLatestProducts();

?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Want More</title>
  <link rel="stylesheet" href="../CSS/home.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

  <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">

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
          <li><a href="">Contact</a></li>
          <li><a href="../user/login-user.php">Account</a></li>
        </ul>
      </nav>
      <img src="../images/shopping-bag.png" width="30px" height="30px" alt="shopping bag">
    </div>
    
    <div class="row">
      <div class="col-2">
        <h1>Give Yourself <br>A New Style!</h1>
        <p>And make sure <br> you are always the best version of yourself.</p>
        <a href="" class="btn">Explore Now &#8594;</a>
      </div>
      <div class="col-2">
        <img src="../images/voorpaginafoto_meisje.png" alt="">
      </div>
    </div>
  </div>
</div>

  <!-- featured categories -->
  <div class="categories">
    <div class="small-container">
    <div class="row">
      <div class="col-3">
        <img src="../images/jurkfoto1A.webp" alt="jurk">

      </div>

      <div class="col-3">
        <img src="../images/broekfoto1A.webp" alt="">
        
      </div>

      <div class="col-3">
        <img src="../images/schoen1A.webp" alt="">
        
      </div>
    </div>
    </div>
   </div>


<!-- Featured Products Dynamisch Laden -->
<div class="small-container">
  <h2 class="title">Featured Products</h2>
  <div class="row">
    <?php foreach ($featuredProducts as $product): ?>
      <div class="col-4">
        <img src="<?= htmlspecialchars($product['foto']); ?>" alt="<?= htmlspecialchars($product['productNaam']); ?>">
        <h4><?= htmlspecialchars($product['productNaam']); ?></h4>
        <p>€<?= number_format($product['prijsPerStuk'], 2); ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Latest Products Dynamisch Laden -->
<div class="small-container">
  <h2 class="title">Latest Products</h2>
  <div class="row">
    <?php foreach ($latestProducts as $product): ?>
      <div class="col-4">
        <img src="<?= htmlspecialchars($product['foto']); ?>" alt="<?= htmlspecialchars($product['productNaam']); ?>">
        <h4><?= htmlspecialchars($product['productNaam']); ?></h4>
        <p>€<?= number_format($product['prijsPerStuk'], 2); ?></p>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="row">
    
    
  </div>
</div>

 <!-- offer -->
 <div class="offer">
      <div class="small-container">
        <div class="row">
          <div class="col-2">
            <img src="../images/jurkfoto4C.webp" class="offer-img">

          </div>
          <div class="col-2">
            <p>Exclusivly Available on WantMore</p>
            <h1>Alora Sequin Maxi Gown - Black</h1>
            <small>De Alora Sequin Maxi Gown is alleen beschikbaar bij ons!</small>
            <a href=""  class="btn">Buy Now&#8594;</a>
          </div>

          

        

            
           

           
</body>
</html>
