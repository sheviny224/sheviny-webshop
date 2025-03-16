<?php
require_once '../product/Product.php';
//Maakt een object van product
$product = new Product();
$producten = $product->getAllProducts();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Producten Overzicht</title>
    <style>
        /* Algemene stijlen */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 20px;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        /* Tabel styling */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #e0e0e0;
        }

        tr:hover {
            background-color: #f0f0f0;
        }

        /* Knoppen styling */
        a {
            text-decoration: none;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
        }

        a[href*="edit-product"] {
            background-color:rgb(170, 199, 219);
        }

        a[href*="delete-product"] {
            background-color:rgb(245, 127, 114);
        }

        a:hover {
            opacity: 0.8;
        }


        .content {
  margin-left: 250px; /* Zelfde breedte als de sidebar */
  padding: 20px;
}


        .sidebar {
  width: 250px;
  height: 100vh;
  position: fixed;
  left: 0;
  top: 0;
  background-color: #333;
  color: white;
  padding-top: 20px;
}

.sidebar h2 {
  text-align: center;
  margin-bottom: 20px;
}

.sidebar ul {
  list-style-type: none;
  padding: 0;
}

.sidebar ul li {
  padding: 15px;
  text-align: center;
}

.sidebar ul li a {
  color: white;
  text-decoration: none;
  display: block;
  transition: background 0.3s;
}

.sidebar ul li a:hover {
  background-color: #575757;
}
.sidebar img {
 margin: 50px;
 border-radius: 25px;
}

    </style>
</head>

<body>

<div class="sidebar">
    <h2>Medewerker</h2>
    <img src="../images/shevinycv-foto2.jpeg" alt="" srcset="" width="50px" >
    <ul>
        <li><a href="../medewerkers/dashboard-medewerker.php">Home</a></li>
        <li><a href="../Product/insert-product.php">Producten Toevoegen</a></li>
        <li><a href="../Product/view-product.php">Producten Wijzigen</a></li>
        <li><a href="#">Orders Bekijken/Wijzigen</a></li>
    </ul>
</div>

<div class="content">
<h1>Producten Overzicht</h1>
    <table>
        <thead>
            <tr>
                <th>ProductNaam</th>
                <th>Omschrijving</th>
                <th>Prijs Per Stuk</th>
                <th>Foto</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop -->
            <?php foreach ($producten as $product): ?>
            <tr>
                <td><?php echo htmlspecialchars($product['productNaam']); ?></td>
                <td><?php echo htmlspecialchars($product['omschrijving']); ?></td>
                <td>€<?php echo number_format($product['prijsPerStuk'], 2); ?></td>
                <td>
                    <img src="<?php echo htmlspecialchars($product['foto']); ?>" alt="Foto" width="50" height="50">
                </td>
                <td>
                    <a href="edit-product.php?productID=<?php echo $product['productID']; ?>">Bewerken</a>
                    <a href="delete-product.php?productID=<?php echo $product['productID']; ?>"
                        onclick="return confirm('Weet u zeker dat u dit product wilt verwijderen?')">Verwijderen</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
    
</body>

</html>