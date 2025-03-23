<?php
session_start();
require_once "../includes/Database.php"; // Zorg ervoor dat dit correct naar je database class verwijst

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("Je winkelwagen is leeg!");
}

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['email'])) {
    die("Je moet ingelogd zijn om te bestellen.");
}

// Maak database object aan
$db = new Database();
$email = $_SESSION['email'];

$userQuery = "SELECT user_id FROM users WHERE email = :email";
$stmt = $db->run($userQuery, ['email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Fout: Geen gebruiker gevonden met dit e-mailadres!");
}

$user_id = $user['user_id']; 

$totaalPrijs = 0;


foreach ($_SESSION['cart'] as $item) {
    $totaalPrijs += $item['prijs'] * $item['aantal'];
}

$orderQuery = "INSERT INTO orders (user_id, totaalprijs, status, created_at, email) 
               VALUES (:user_id, :totaalprijs, 'in behandeling', NOW(), :email)";

$db->run($orderQuery, [
    'user_id' => $user_id,
    'totaalprijs' => $totaalPrijs,
    'email' => $email
]);


$order_id = $db->pdo->lastInsertId();
if (!$order_id) {
    die("Fout: lastInsertId() retourneert 0!");
}


foreach ($_SESSION['cart'] as $item) {
    $orderItemQuery = "INSERT INTO order_items (order_id, product_id, aantal) 
                       VALUES (:order_id, :product_id, :aantal)";

    $db->run($orderItemQuery, [
        'order_id' => $order_id,
        'product_id' => $item['productID'],
        'aantal' => $item['aantal']
    ]);
}


unset($_SESSION['cart']);


header("Location: order_confirmation.php?order_id=" . $order_id);
exit();
?>
