<?php
session_start();
include_once "../includes/Database.php";
include_once "../user/User.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        $user = new User(); //Creat User-object

        if (isset($_POST["inloggen"])) {
            $loginCorrect = $user->login($_POST["email"], $_POST["wachtwoord"]);

            if ($loginCorrect) {
                header("Location: ../user/dashboard-user.php"); //stuur naar dashboard
            } else {
                header("Location: ../user/login-user.php"); 
            }
            exit();
        }
    } catch (Exception $error) {
        echo "Error login-user:" . $error;
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Formulier</title>
  <link rel="stylesheet" href="../CSS/login.css">
  
</head>
<body>

  
  <h1>Eenvoudig inloggen!</h1>

  <div class="form-container">
    <form action="" method="post">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" placeholder="Voer je email in" required>
      
      <label for="wachtwoord">Wachtwoord:</label>
      <input type="password" id="wachtwoord" name="wachtwoord" placeholder="Voer je wachtwoord in" required>
      
      <button type="submit" name="inloggen">Inloggen</button>
      <a href="../user/register-user.php">Nog geen account?</a>
    </form>
  </div>
</body>
</html>

