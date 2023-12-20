<?php
require_once("../app/db/Dbh.php");
$dbh = new DBh();

// Check if the $dbh object exists and is an instance of the DBh class
if (!isset($dbh) || !($dbh instanceof DBh)) {
    echo "Error: Database connection not established.";
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/orders.css">
    <title>Edit Order</title>
</head>
<body>

<div class="container">
    
// edit_order.php

<?php
require_once("../app/db/Dbh.php");
$dbh = new DBh();

if (!isset($dbh) || !($dbh instanceof DBh)) {
    echo "Error: Database connection not established.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    $orderId = $_GET['id'];

    // Fetch order details based on $orderId using your DBh class
    $sql = "SELECT * FROM orders WHERE id = $orderId";
    $result = $dbh->query($sql);
    $orderDetails = $dbh->fetchRow($result);

    // Display the form for editing
    echo "<form action='edit_order.php' method='post'>";
    echo "<label for='state_of_order'>State of Order:</label>";  // Updated column name
    echo "<select name='state_of_order'>";  // Updated column name
    $orderStates = ["pending", "shipped", "delivered"]; // Define your order states
    foreach ($orderStates as $state) {
        $selected = ($orderDetails['state_of_order'] == $state) ? 'selected' : '';
        echo "<option value='$state' $selected>$state</option>";
    }
    echo "</select>";
    echo "<input type='hidden' name='order_id' value='$orderId'>";
    echo "<input type='submit' value='Update Order'>";
    echo "</form>";
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle the form submission and update the order state in the database
    $newOrderState = $_POST["state_of_order"];  // Updated column name
    $orderId = $_POST["order_id"];

    // Update order state in the database using your DBh class
    $updateSql = "UPDATE orders SET state_of_order='$newOrderState' WHERE id=$orderId";

    if ($dbh->query($updateSql)) {
        // Notify observers after the order state is updated
        $dbh->notifyObservers($orderId, $newOrderState);

        echo "Order updated successfully";
    } else {
        echo "Error updating order: " . $dbh->getConn()->error;
    }
} else {
    echo "Invalid request";
}
?>

</div>

</body>
</html>
