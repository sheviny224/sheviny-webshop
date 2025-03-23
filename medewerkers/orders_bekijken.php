<?php
require_once '../includes/Database.php';
require_once '../Orders/Orders.php';
require_once '../user/User.php';

$orderObj = new Order();
$orders = $orderObj->getAllOrders();

// Status bijwerken
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateStatus'])) {
    $order_id = $_POST['order_id'];
    $newStatus = $_POST['status'];

    echo "Order ID: " . htmlspecialchars($order_id) . " | Nieuwe Status: " . htmlspecialchars($newStatus) . "<br>";
    
    if ($orderObj->updateOrders($order_id, $newStatus )) {
        echo "<script>alert('Status succesvol bijgewerkt!'); window.location.href='orders_bekijken.php';</script>";
    } else {
        echo "<script>alert('Fout bij bijwerken van status.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Orders Bekijken</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 20px;
            padding: 20px;
        }
        h1 { text-align: center; color: #333; }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th { background-color: #e0e0e0; }
        tr:hover { background-color: #f0f0f0; }
        select, button {
            padding: 5px;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover { opacity: 0.8; }

        .sidebar {
  width: 250px;
  height: 100vh;
  position: fixed;
  left: 0;
  top: 0;
  background-color: #333;
  color: white;
  padding-top: 20px;
}
.sidebar img {
 margin: 50px;
 border-radius: 25px;
}
.sidebar h2 {
  text-align: center;
  margin-bottom: 20px;
}

.sidebar ul {
  list-style-type: none;
  padding: 0;
}

.sidebar ul li {
  padding: 15px;
  text-align: center;
}

.sidebar ul li a {
  color: white;
  text-decoration: none;
  display: block;
  transition: background 0.3s;
}

.sidebar ul li a:hover {
  background-color: #575757;
}
.content {
  margin-left: 250px; /* Zelfde breedte als de sidebar */
  padding: 20px;
}
.uitloggen {
    background-color: red;
}
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Medewerker</h2>
    <img src="../images/shevinycv-foto2.jpeg" alt="" srcset="" width="50px" >
    <ul>
        <li><a href="../medewerkers/dashboard-medewerker.php">Home</a></li>
        <li><a href="../Product/insert-product.php">Producten Toevoegen</a></li>
        <li><a href="../Product/view-product.php">Producten Wijzigen</a></li>
        <li><a href="../medewerkers/orders_bekijken.php">Orders Bekijken/Wijzigen</a></li>
        <li ><a class="uitloggen"   href="../user/logout.php">Uitloggen</a></li >
    </ul>
</div>


<div class="content">
<h1>Order Overzicht</h1>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Email</th>
                <th>user id</th>
                <th>Totaalprijs</th>
                <th>Status</th>
                <th>Actie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= htmlspecialchars($order['order_id']); ?></td>
                    
                    <td><?= htmlspecialchars($order['email']); ?></td>
                    <td><?= htmlspecialchars($order['user_id']); ?></td>
                    <td>€<?= number_format($order['totaalprijs'], 2); ?></td>
                    <td>
                    <form method="post">
    <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['order_id']); ?>">
    <select name="status">
        <option value="In Behandeling" <?= ($order['status'] == 'In Behandeling') ? 'selected' : ''; ?>>In Behandeling</option>
        <option value="Verzonden" <?= ($order['status'] == 'Verzonden') ? 'selected' : ''; ?>>Verzonden</option>
        <option value="Geannuleerd" <?= ($order['status'] == 'Geannuleerd') ? 'selected' : ''; ?>>Geannuleerd</option>
    </select>
    <button type="submit" name="updateStatus">Opslaan</button>
</form>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
    
</body>
</html>
