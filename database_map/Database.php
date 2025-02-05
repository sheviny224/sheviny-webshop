<?php 
class Database {
    public $pdo;

    // Constructor voor het maken van een databaseverbinding
    
    public function __construct($db = "sheviny_webshop", $user = "root", $pwd = "", $host = "127.0.0.1:3308") {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected to database $db";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
  }
  $db = new Database();
?>