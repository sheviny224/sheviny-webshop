<?php
require_once '../includes/Database.php';
require_once '../Orders/Orders.php';
session_start();


if (!isset($_SESSION['email'])) {
    die("Je bent niet ingelogd! <a href='login-user.php'>Login hier</a>");
}


$order = new Order();
$email = $_SESSION['email'];
$userOrders = $order->getUserOrders($email);

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn Bestellingen</title>
    <link rel="stylesheet" href="../CSS/user.css">
</head>
<body>

<h1>Mijn Bestellingen</h1>
<a href="dashboard-user.php">Terug naar dashboard</a> | 
<a href="logout.php">Uitloggen</a>

<table border="1">
    <tr>
        <th>Order ID</th>
        <th>Product</th>
        <th>Prijs</th>
        <th>Status</th>
        
    </tr>
    <?php foreach ($userOrders as $order): ?>
    <tr>
        <td><?php echo htmlspecialchars($order['order_id']); ?></td>
        
        <td>€<?php echo htmlspecialchars($order['totaalprijs']); ?></td>
        <td><?php echo htmlspecialchars($order['status']); ?></td>
        <td>
            <?php if ($order['status'] === 'In behandeling'): ?>
                <form action="../Orders/cancel-order.php" method="post">
                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                    <button type="submit" onclick="return confirm('Weet je zeker dat je deze order wilt annuleren?');">Annuleren</button>
                </form>
            <?php else: ?>
                <em>Kan niet annuleren</em>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
