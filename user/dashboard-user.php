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
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Fout bij ophalen gebruiker: " . $e->getMessage());
}

// Controleer of de gebruiker bestaat
if (!$user) {
    die("Gebruiker niet gevonden.");
}

// Update gebruikersgegevens als het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'];
    $woonplaats = $_POST['woonplaats'];
    $adres = $_POST['adres'];

    try {
        $sql = "UPDATE users SET naam = :naam, woonplaats = :woonplaats, adres = :adres WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':naam', $naam);
        $stmt->bindParam(':woonplaats', $woonplaats);
        $stmt->bindParam(':adres', $adres);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        // Redirect na succesvol bijwerken
        header("Location: dashboard-user.php");
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
    <title>Gebruikersgegevens Wijzigen</title>
</head>
<body>
    <h1>Welkom terug, <?php echo htmlspecialchars($user['email']); ?>!</h1>
    <a href=""></a>

    <a href="../HomePage/home.php"><h2>Ben u klaar om (weer)te shoppen klik dan op mij!</h2></a>
    
    <h2>Dit zijn jouw gegevens, klopt dat?</h2>

    <form action="" method="post">
        <label for="naam">Naam:</label>
        <input type="text" name="naam" id="naam" value="<?php echo htmlspecialchars($user['naam']); ?>" required>
        <br>

        <label for="woonplaats">Woonplaats:</label>
        <input type="text" name="woonplaats" id="woonplaats" value="<?php echo htmlspecialchars($user['woonplaats']); ?>" required>
        <br>

        <label for="adres">Adres:</label>
        <input type="text" name="adres" id="adres" value="<?php echo htmlspecialchars($user['adres']); ?>" required>
        <br>

        <button type="submit">Opslaan</button>
    </form>
</body>
</html>
