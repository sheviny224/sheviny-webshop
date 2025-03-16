<?php
session_start();
require_once "../includes/Database.php"; // Zorg ervoor dat dit correct naar je database class verwijst

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("Je winkelwagen is leeg!");
}

// Simuleer een ingelogde gebruiker (vervang dit met echte login-data)
$user_id = 1; // Hier moet de echte gebruiker ID komen na een login-systeem

$db = new Database();
$totaalPrijs = 0;

// Bereken totale prijs
foreach ($_SESSION['cart'] as $item) {
    $totaalPrijs += $item['prijs'] * $item['aantal'];
}

// Stap 1: Plaats bestelling in 'orders' tabel
$orderQuery = "INSERT INTO orders (user_id, totaalprijs, status, created_at) VALUES (:user_id, :totaalprijs, 'in behandeling', NOW())";
$db->run($orderQuery, [
    'user_id' => $user_id,
    'totaalprijs' => $totaalPrijs
]);

// Haal het laatst ingevoegde order_id op
$order_id = $db->pdo->lastInsertId();

// Stap 2: Voeg order_items toe aan database
foreach ($_SESSION['cart'] as $item) {
    $orderItemQuery = "INSERT INTO order_items (order_id, product_id, aantal) VALUES (:order_id, :product_id, :aantal)";
    $db->run($orderItemQuery, [
        'order_id' => $order_id,
        'product_id' => $item['productID'],
        'aantal' => $item['aantal']
    ]);
}

// Stap 3: Leeg winkelwagen
unset($_SESSION['cart']);

// Stap 4: Stuur gebruiker naar een bevestigingspagina
header("Location: order_confirmation.php?order_id=" . $order_id);
exit();
?>


<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afrekenen</title>
</head>
<body>
    <h2>Afrekenen</h2>
    <form method="post">
        <p><strong>Totaal te betalen: €<?= number_format($totaalPrijs, 2); ?></strong></p>
        <button type="submit">Bestelling plaatsen</button>
    </form>
    <a href="cart.php">Terug naar winkelwagen</a>
</body>
</html>
