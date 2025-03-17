<?php
include_once "../includes/Database.php";

class User
{
    private $db;

    public function __construct() {
        $this->db = new Database(); // Creer Database object in user class constructer
        session_start(); //Start session in __construct voor elk niew user
    }

    // Registreer user 
    public function register($naam, $woonplaats, $adres, $email, $wachtwoord) {
        try {
            $db = new Database();
            $pdo = $db->pdo;
    
            $sql = "INSERT INTO users (naam, woonplaats, adres, email, wachtwoord) VALUES (:naam, :woonplaats, :adres, :email, :wachtwoord)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':naam', $naam);
            $stmt->bindParam(':woonplaats', $woonplaats);
            $stmt->bindParam(':adres', $adres);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':wachtwoord', password_hash($wachtwoord, PASSWORD_DEFAULT));
    
            if ($stmt->execute()) {
                echo "Registratie gelukt!";
            } else {
                echo "Registratie mislukt!";
            }
        } catch (PDOException $e) {
            echo "Database fout: " . $e->getMessage();
        }
    }

    public function getUserByName($naam) {
        $sql = "SELECT naam FROM users WHERE naam = :naam";
        $params = [':naam' => $naam];
        return $this->db->run($sql, $params)->fetch();
    }

    public function login($email, $wachtwoord)
    {
        $userDB = $this->db->run("SELECT * FROM users WHERE email = :email", [
            ':email' => $email])->fetch(); // haal info van de  PDOstatement object
        

        if ($userDB && password_verify($wachtwoord, $userDB['wachtwoord'])) {
            // Store user data in session  
            $_SESSION["email"] = $userDB["email"];
            return true;
        } else {
            return false;
        }
    }

    public function medewerkerlogin($email, $wachtwoord)
    {
        $medewerkerDB = $this->db->run("SELECT * FROM medewerkers WHERE email = :email", [
            ':email' => $email])->fetch(); // haal info van de  PDOstatement object
        

        if ($medewerkerDB && password_verify($wachtwoord, $medewerkerDB['wachtwoord'])) {
            // Store user data in session  
            $_SESSION["email"] = $medewerkerDB["email"];
            return true;
        } else {
            return false;
        }
    }
  
  
    public function logout()
    {
        // log uit
        session_unset();
        session_destroy();
    }

    // check of een  session aan het  runnen is (true/false)
    public function isLoggedIn()
    {
        return isset($_SESSION['email']);
    }

    
}