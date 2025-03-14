<?php
session_start();

if (!isset($_GET['id'])) {
    die("Geen product ID meegegeven!");
}

$productID = $_GET['id'];

// Check of het product in de sessie-winkelwagen zit
if (isset($_SESSION['cart'][$productID])) {
    unset($_SESSION['cart'][$productID]);
}

// Stuur gebruiker terug naar de winkelwagen
header("Location: cart.php");
exit();
?>
