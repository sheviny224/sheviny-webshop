<?php
include_once "../user/User.php";



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        $user = new User(); //Creat User-object

        if (isset($_POST["registreer"])) {
            $user->register( $_POST["naam"], $_POST["woonplaats"], $_POST["adres"], $_POST["email"], $_POST["wachtwoord"]);
            header("Location: ../user/login-user.php");
            exit();
        }
    } catch (Exception $error) {
        echo "Error register-user:" . $error;
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
    <form action="register-user.php" method="post">

    <div class="form-groep">
    <h1>Eenvoudig registreren!</h1>
      <label for="naam">Naam: </label>
      <input type="text" id="naam" name="naam" placeholder="Voer je naam in" required>
    </div>
   

    <div class="form-groep">
    <label for="woonplaats">Woonplaats: </label>
    <input type="text" id="woonplaats" name="woonplaats" placeholder="Voer je woonplaats in" required>
    </div>

    <div class="form-groep">
    <label for="adres">Adres</label>
    <input type="text" id="adres" name="adres" placeholder="Voer je adres is" required>
    </div>

    <div class="form-groep">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="Voer je email in" required>

    </div>

    <div class="form-groep">
    <label for="wachtwoord">Wachtwoord:</label>
    <input type="password" id="wachtwoord" name="wachtwoord" placeholder="Voer je wachtwoord in" required>

    </div>
     
      <button type="submit" name="registreer">registreer</button>
      
    </form>
  </div>
</body>
</html>

