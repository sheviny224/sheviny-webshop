<?php
require_once '../includes/Database.php';
session_start();

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['email'])) {
    die("Je bent niet ingelogd! <a href='login-user.php'>Login hier</a>Je moet ingelogd zijn om deze pagina te bekijken.");
}

// Maak een database object aan
$db = new Database();
$pdo = $db->pdo;

// Haal de gebruikersgegevens op uit de database
$email = $_SESSION['email'];
try {
    $sql = "SELECT * FROM medewerkers WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Fout bij ophalen medewerker: " . $e->getMessage());
}

// Controleer of de gebruiker bestaat
if (!$user) {
    die("Gebruiker niet gevonden.");
}

// Update gebruikersgegevens als het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'];
   

    try {
        $sql = "UPDATE medewerkers SET naam = :naam, WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':naam', $naam);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        // Redirect na succesvol bijwerken
        header("Location: dashboard-medewerker.php");
        exit;
    } catch (PDOException $e) {
        echo "Fout bij bijwerken gebruiker: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medewerker Gegevens Wijzigen</title>
    <link rel="stylesheet" href="../CSS/medewerker.css">
</head>
<body>

<!-- Sidebar -->
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

<!-- Content -->
<div class="content">
    <h1>Welkom terug, <?php echo htmlspecialchars($user['email']); ?>!</h1>
    

    <div class="drie">
        <div class="weekly-sales">
            <h3>Weekly Sales</h3>

            <h2><strong>$30,0000</strong></h2>
            <p>increased by 60%</p>

        </div>

        <div class="weekly-orders">
        <h3>Weekly Orders</h3>

        <h2><strong>45,6334</strong></h2>
        <p>decreased by 10%</p>

        </div>

        <div class="visitors-online">
        <h3>Visitors Online</h3>

        <h2><strong>95,5741</strong></h2>
        <p>increased by 5%</p>

        </div>
    </div>
    <h2>Sales van het afgelopen jaar.</h2>
    <img src="../images/sales_charts.png" alt="">
</div>

</body>
</html>