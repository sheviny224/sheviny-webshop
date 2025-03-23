<?php
require_once '../includes/Database.php';
require_once '../Orders/Orders.php';
session_start();

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['email'])) {
    die("Je bent niet ingelogd! <a href='login-user.php'>Login hier</a>");
}


if (!isset($_POST['order_id'])) {
    die("Ongeldige aanvraag.");
}


$order = new Order();
$order_id = $_POST['order_id'];
$success = $order->updateOrders($order_id, "Geannuleerd");

if ($success) {
    echo "✅ Order geannuleerd! <a href='../User/user-orders.php'>Terug naar bestellingen</a>";
} else {
    echo "❌ Fout bij annuleren van order. <a href='../User/user-orders.php'>Probeer opnieuw</a>";
}
?>
