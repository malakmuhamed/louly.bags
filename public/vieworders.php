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
    <link rel="stylesheet" href="css/Dashboard.css">
    <link rel="stylesheet" href="css/admin_editproduct.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />

    <title>View Orders</title>
</head>
<body>

<div class="container">
<aside>
<div class="top">
                <div class="logo">
                   <img src="imgs/loulylogo.png" class="logo">
                    <!-- <h2><span class="danger">Jamila</span></h2>  -->
                </div>
                <div class="close" id="close-button">
                    <span class="material-icons-sharp">close</span>
                </div>
            </div>
            <div class="sidebar">
               <a href="admindashboard.php" class="active">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Dashboard</h3>
               </a> 
               <a href="search.php">
                <span class="material-icons-sharp">person</span>
                <h3>Users Accounts</h3>
               </a> 
               <a href="#">
                <span class="material-icons-sharp">person</span>
                <h3>Admin Accounts</h3>
               </a> 
               <a href="admin_addproduct.php">
                <span class="material-icons-sharp">receipt_long</span>
                <h3>Add product</h3>
               </a> 
               <a href="edits.php">
                <span class="material-icons-sharp">insights</span>
                <h3>Edit Product</h3>
               </a> 
               <a href="deleteproduct.php">
                <span class="material-icons-sharp">mail_outline</span>
                <h3>Delete product</h3>
                <span class="message-count">26</span>
               </a>  
               
               <a href="#">
                <span class="material-icons-sharp">report_gmailerrorred</span>
                <h3>Orders</h3>
               </a> 
               <a href="Account.php">
                <span class="material-icons-sharp">logout</span>
                <h3>Log out</h3>
               </a> 
               
            </div>
           
        </aside>
        <div class="vieworders">
                <?php
            // Fetch orders from the database
            $sql = "SELECT * FROM orders";
            $result = $dbh->query($sql);

            if ($result->num_rows > 0) {
                echo "<table class='orders-table'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Name</th>";
                echo "<th>Phone Number</th>";
                echo "<th>Address</th>";
                echo "<th>Country</th>";
                echo "<th>City</th>";
                echo "<th>Total Price</th>";
                echo "<th>Action</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                while ($row = $dbh->fetchRow($result)) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['phone_number']}</td>";
                    echo "<td>{$row['Address']}</td>";
                    echo "<td>{$row['country']}</td>";
                    echo "<td>{$row['city']}</td>";
                    echo "<td>{$row['totalprice']}</td>";
                    echo "<td ><a href='edit_order.php?id={$row['id']}'class='editlink'>Edit</a></td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            } else {
                echo "No orders found.";
            }
            ?>
        </div>
    
</div>

</body>
</html>
