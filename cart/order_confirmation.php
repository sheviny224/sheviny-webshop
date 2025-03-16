<?php
if (!isset($_GET['order_id'])) {
    die("Geen bestelling gevonden!");
}
$order_id = htmlspecialchars($_GET['order_id']);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestelling geplaatst!</title>
</head>
<body>
    <h1>Bedankt voor je bestelling!</h1>
    <p>Je ordernummer is: <strong><?= $order_id; ?></strong></p>
    <a href="../HomePage/home.php">Terug naar de homepagina</a>
</body>
</html>
