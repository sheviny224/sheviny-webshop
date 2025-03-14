<?php

session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<h2>Je winkelwagen is leeg!</h2>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkelwagen</title>
    
</head>
<body>

<h2>Je winkelwagen</h2>

<table border="1">
    <tr>
        <th>Afbeelding</th>
        <th>Productnaam</th>
        <th>Prijs</th>
        <th>Aantal</th>
        <th>Totaal</th>
        <th>Actie</th>
    </tr>
    
    <?php 
    $totaalPrijs = 0;
    foreach ($_SESSION['cart'] as $item): 
        $totaal = $item['prijs'] * $item['aantal'];
        $totaalPrijs += $totaal;
    ?>
    <tr>
        <td><img src="<?= htmlspecialchars($item['foto']); ?>" width="50"></td>
        <td><?= htmlspecialchars($item['naam']); ?></td>
        <td>€<?= number_format($item['prijs'], 2); ?></td>
        <td><?= $item['aantal']; ?></td>
        <td>€<?= number_format($totaal, 2); ?></td>
        <td><a href="../cart/removeFromCart.php?id=<?= $item['productID']; ?>" class="btn">Verwijderen</a>
        </td>
    </tr>
    <?php endforeach; ?>
    
    <tr>
        <td colspan="4"><strong>Totaal</strong></td>
        <td><strong>€<?= number_format($totaalPrijs, 2); ?></strong></td>
        <td></td>
    </tr>
</table>

<!-- <a href="../Checkout/checkout.php" class="btn">Afrekenen</a> -->

</body>
</html>


