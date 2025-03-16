<?php
session_start();
include_once "../includes/Database.php";
include_once "../user/User.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
      $user = new User(); // Creëer User-object

      if (isset($_POST["inloggen"])) {
          $role = $_POST["role"]; // Haal de gekozen rol op

          if ($role === "medewerker") {
              $loginCorrect = $user->medewerkerlogin($_POST["email"], $_POST["wachtwoord"]);

              if ($loginCorrect) {
                  header("Location: ../medewerkers/dashboard-medewerker.php"); // Stuur naar medewerker dashboard
                  exit();
              }
          } else {
              $loginCorrect = $user->login($_POST["email"], $_POST["wachtwoord"]);

              if ($loginCorrect) {
                  header("Location: ../user/dashboard-user.php"); // Stuur naar gebruiker dashboard
                  exit();
              }
          }
          
          // Indien fout, terugsturen naar login
          header("Location: ../user/login-user.php");
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
  <link rel="stylesheet" href="../CSS/login3.css">
  
</head>
<body>

  

<div class="form-container">
    <div class="form-content">
      <div class="sundown">
        <img src="../images/sundown.jpg" alt="sundown">
      </div> 

      <form action="" method="post">
        <div class="form-groep">
          <h1>Welkom terug!</h1>

          <div class="form-groep">
         <label for="role">Inloggen als:</label>
         <select id="role" name="role">
         <option value="user">Gebruiker</option>
         <option value="medewerker">Medewerker</option>
          </select>
           </div>


          <label for="email">Email:</label>
          <input type="email" id="email" name="email" placeholder="Voer je email in" required>
        </div>

        <div class="form-groep">
          <label for="wachtwoord">Wachtwoord:</label>
          <input type="password" id="wachtwoord" name="wachtwoord" placeholder="Voer je wachtwoord in" required>
        </div>

        <button type="submit" name="inloggen">Inloggen</button>

        <a href="../user/register-user.php">Nog geen account?</a>
      </form>
    </div>
  </div>
</body>
</html>

