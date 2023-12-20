<body>
    <div class="container">
        <h2>Delete Product</h2>
        <form action="deletep.php" method="POST">
            <div class="form-group">
                <label for="id">Product ID:</label>
                <input type="text" id="id" name="id" required>
            </div>
            <div class="form-group">
                <input type="submit" name="delete" value="Delete Product">
            </div>
        </form>
    </div>
</body>

</html>

<?php

if (!defined('_ROOT_')) {
    define('_ROOT_', "../app/");
}
require_once(_ROOT_ . "db/config.php");
require_once(_ROOT_ . "db/DBh.php");
require_once(ROOT . "model/Product.php");
require_once(ROOT . "model/cart.php");
require_once(ROOT . "Controller/ProductController.php");
session_start();
$db_handles = new Dbh();
$db_handle=$db_handles->connect();
$sql = "SELECT * FROM product  ";

$model=new Products();
$controller=new ProductControllers($model);

// Use $conn to execute the query
$result = $db_handle->query($sql);

?>

<!doctype html>
<html lang="en">

  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>product company</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"  >
    <link rel="stylesheet" href="css/showall.css">
    <link rel="stylesheet" href="css/Dashboard.css">
  </head>
  <body>
    
 
    <div class="container">
    <form method="post" class="search-form">
        <input type="text" placeholder="Search by name for Product" name="search" class="search-input">
        <button class="sbtn" name="submitsearch">Search</button>
      </form>
        <table class="table table-striped table-borderrer">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>price</th>
                
                <th>description</th>
                <th>offers</th>
                <th>prodtype</th>
                <!-- <th>Actions</th> -->
               

</tr>
<?php
if (isset($_POST['submitsearch'])) {

$controller->viewallproducts();

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['image'] . "</td>";
                echo "<td>" . $row['Price'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['offers'] . "</td>";
                echo "<td>" . $row['Product_Type'] . "</td>";
                echo "<td><img src='uploads/" . $row['image'] . "' alt='Selected Image' id='productImageId' width='100' height='100'></td>";
                echo "<td>";
                echo "<div class='btn-group'>";
                // echo "    <a  class='btn-secondary' name='edit_product' href=' ./editaction.php?id= " . $row['id'] . "'>Edit</a>";
                // echo "   <a  class='btn-danger' name='delete' href='./deletep.php?id= " . $row['id'] . "'>Delete</a> ";
                // echo "   <a  class='btn-danger' name='delete' href='deletep.php id= " . $row['id'] . "'>Delete</a> ";
                echo "  </div>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo '<h2>Product Not Found</h2>';
        }
    }
}
?>
</table>
    </div>
</body>
</html>
<table>
                
            </table>