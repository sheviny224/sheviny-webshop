<?php 
require_once "../includes/Database.php";

class Order {

  private $db;

  public function __construct()
  {
      $this->db = new Database();
  }

  public function getAllOrders() {
    $sql = "SELECT * FROM orders";
    return $this->db->run($sql)->fetchAll();
  }

  public function updateOrders($order_id, $status) {
    $sql = "UPDATE orders SET status = :status WHERE order_id = :order_id";
    $params = [
        ':status' => $status,
        ':order_id' => $order_id
    ];

    try {
        $stmt = $this->db->run($sql, $params);
        
        echo "<pre>";
        echo "SQL Query: $sql\n";
        echo "Params: " . print_r($params, true);
        echo "Row count: " . ($stmt ? $stmt->rowCount() : "Geen resultaat") . "\n";
        echo "</pre>";

        if ($stmt && $stmt->rowCount() > 0) {
            return true;
        } else {
            return false; // Geen rijen gewijzigd
        }
    } catch (PDOException $e) {
        echo "❌ SQL Fout: " . $e->getMessage();
        return false;
    }
}
}


?>