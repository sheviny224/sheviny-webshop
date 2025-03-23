<?php
require_once "../product/Product.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $productNaam = $_POST['productNaam'] ?? null;
    $omschrijving = $_POST['omschrijving'] ?? null;
    $prijsPerStuk = $_POST['prijsPerStuk'] ?? null;

    $foto = $_FILES['foto'] ?? null;

    $categorie = $_POST['categorie'] ?? null;

    if (!$productNaam || !$omschrijving || !$prijsPerStuk || !$foto || !$categorie) {
        echo "Alle velden moeten worden ingevuld.";
        exit;
    }

    // Handle file upload
    if ($foto['error'] === UPLOAD_ERR_OK) {
        $fotoPath = "../uploads/" . basename($foto['name']); // Set upload path
        $fotoSaved = move_uploaded_file($foto['tmp_name'], $fotoPath); // Save file

        if ($fotoSaved) {
            // Insert product
            $product = new Product();
            $success = $product->insertProduct($productNaam, $omschrijving, $prijsPerStuk, $fotoPath, $categorie);

            if ($success) {
                echo "Product succesvol toegevoegd!";
            } else {
                echo "Er is iets misgegaan bij het toevoegen van het product.";
            }
        } else {
            echo "Upload van foto mislukt. Controleer de maprechten.";
        }
    } else {
        echo "Fout bij het uploaden van de foto: " . $foto['error'];
    }
}
?><!DOCTYPE html>
<html>

<head>
    <title>Nieuw Product Toevoegen</title>

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

<div class="content-2">

    <!-- enctype is nodig voor uploaden van bestanden/files -->
    <form action="insert-product.php" method="POST" enctype="multipart/form-data">
    <h1>Nieuw Product Toevoegen</h1>
        <label for="productNaam">Productnaam:</label>
        <input type="text" name="productNaam" required><br>

        <label for="omschrijving">Omschrijving:</label>
        <input type="text" name="omschrijving" required><br>

        <label for="prijsPerStuk">Prijs Per Stuk:</label>
        <input type="number" name="prijsPerStuk" required><br>

        <label for="categorie">Categorie</label>
        <input type="text" name="categorie" required>

        <label for="foto">Foto:</label>
        <input type="file" name="foto" required><br>

        <button type="submit">Product Toevoegen</button>
    </form>

</div>
    
</body>

</html>