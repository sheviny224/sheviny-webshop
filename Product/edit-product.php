<?php
require_once '../product/Product.php';

// Haal het productID op uit de URL
if (!isset($_GET['productID']) || empty($_GET['productID'])) {
    die("Geen geldig product ID gevonden. Ga terug en probeer opnieuw.");
}

$productID = $_GET['productID'];

$product = new Product();
$currentProduct = $product->getProductById($productID);

if (!$currentProduct) {
    die("Product niet gevonden in de database. Controleer het product ID.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productNaam = $_POST['productNaam'];
    $omschrijving = $_POST['omschrijving'];
    $prijsPerStuk = $_POST['prijsPerStuk'];
    $categorie = $_POST['categorie'];
    $foto = $_FILES['foto'];

    // Verwerk foto indien geüpload
    if ( empty($foto['name']) == false) {
        // Delete de oude foto (url) uit je uploads-map
        if (file_exists($currentProduct["foto"])) {
            unlink($currentProduct["foto"]);
        }
        // Bewaar de nieuwe foto in uploads-map
        $fotoPad = '../uploads/' . basename($foto['name']);
        move_uploaded_file($foto['tmp_name'], $fotoPad);
    } else {
        // Zet de orginele foto terug (dus is niet ge-update)
        $fotoPad = $currentProduct['foto'];
    }

    // Update product in de MySQL-database
    $success = $product->updateProduct($productID, $productNaam, $omschrijving, $prijsPerStuk, $fotoPad, $categorie);

    if ($success == true) {
        header("Location: ../product/view-product.php");
    } else {
        echo "Er is iets misgegaan bij het bijwerken van het product.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Product Bewerken</title>

    <style>
        .uitloggen {
    background-color: red;
}
    </style>
</head>
<link rel="stylesheet" href="../CSS/medewerker.css">


<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>Medewerker</h2>
    <img src="../images/shevinycv-foto2.jpeg" alt="" srcset="" width="50px" >
    <ul>
        <li><a href="../medewerkers/dashboard-medewerker.php">Home</a></li>
        <li><a href="../Product/insert-product.php">Producten Toevoegen</a></li>
        <li><a href="../Product/view-product.php">Producten Wijzigen</a></li>
        <li><a href="../medewerkers/orders_bekijken.php">Orders Bekijken/Wijzigen</a></li>
        <li ><a class="uitloggen"   href="../user/logout.php">Uitloggen</a></li >
    </ul>
</div>

<div class="content">
<h1>Product Bewerken</h1>
    <form action=" " method="POST" enctype="multipart/form-data">
        <label for="productNaam">Productnaam:</label>
        <input type="text" name="productNaam" value="<?php echo htmlspecialchars($currentProduct['productNaam']); ?>" required><br>

        <label for="omschrijving">Omschrijving:</label>
        <input type="text" name="omschrijving" value="<?php echo htmlspecialchars($currentProduct['omschrijving']); ?>" required><br>

        <label for="prijsPerStuk">Prijs Per Stuk:</label>
        <input type="number" name="prijsPerStuk" step="0.01" value="<?php echo htmlspecialchars($currentProduct['prijsPerStuk']); ?>" required><br>

        <label for="foto">Foto:</label>
        <input type="file" name="foto" accept="image/*"><br>
        <img src="<?php echo htmlspecialchars($currentProduct['foto']); ?>" alt="Huidige Foto" width="100"><br>

       
        <label for="categorie">categorie</label>
        <input type="text" id="categorie" name="categorie" value="<?php echo htmlspecialchars($currentProduct['categorie']); ?>" required>

        <button type="submit">Product Bijwerkennn</button>
    </form>

</div>
    
</body>

</html>
