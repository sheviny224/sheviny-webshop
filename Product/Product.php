<?php
require_once "../includes/Database.php";

class Product
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insertProduct($productNaam, $omschrijving, $prijsPerStuk, $fotoPad, $categorie)
    {
        $sql = "INSERT INTO products (productNaam, omschrijving, prijsPerStuk, foto, categorie) 
                VALUES (:productNaam, :omschrijving, :prijsPerStuk, :foto, :categorie)";
        $params = [
            ':productNaam' => $productNaam,
            ':omschrijving' => $omschrijving,
            ':prijsPerStuk' => $prijsPerStuk,
            ':foto' => $fotoPad,
            ':categorie' => $categorie
        ];

        return $this->db->run($sql, $params);
    }

    // Selecteert alle producten uit de tabel products
    public function getAllProducts() {
        $sql = "SELECT * FROM products";
        return $this->db->run($sql)->fetchAll(); // haalt alle rijen op uit de sql- atabase
    }

    // haal een specifieke product op
    public function getProductById($productID) {
        $sql = "SELECT * FROM products WHERE productID = :productID";
        $params = ["productID" => $productID];
    
        $stmt = $this->db->run($sql, $params);
        
        // Als er geen product wordt gevonden, retourneer dan false of null
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
    
    

    // Update gegevens van een product
    public function updateProduct($productID, $productNaam, $omschrijving, $prijsPerStuk, $fotoPad, $categorie) {
        $sql = "UPDATE products 
                SET productNaam = :productNaam, omschrijving = :omschrijving, prijsPerStuk = :prijsPerStuk, foto = :foto, categorie = :categorie
                WHERE productID = :productID";
        
        $params = [
            ':productNaam' => $productNaam,
            ':omschrijving' => $omschrijving,
            ':prijsPerStuk' => $prijsPerStuk,
            ':foto' => $fotoPad,
            ':categorie' => $categorie,
            ':productID' => $productID
        ];

        // Geeft een true of false terug
        return $this->db->run($sql, $params) ? true : false;
    }

    public function getFeaturedProducts() {
        $sql = "SELECT * FROM products LIMIT 4";  // De eerste 4 producten (pas de query aan zoals gewenst)
        return $this->db->run($sql)->fetchAll(); 
    }
    
    public function getLatestProducts() {
        $sql = "SELECT * FROM products ORDER BY productID DESC LIMIT 8";  // De laatste 4 producten
        return $this->db->run($sql)->fetchAll(); 
    }

 

}