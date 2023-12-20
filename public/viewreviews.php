<script src="script/reviews.js"></script>
<?php
define('_ROOT_', "../app/");
require_once(_ROOT_ . "model/Users.php");
require_once(_ROOT_ . "Controller/UserController.php");

require_once(_ROOT_ . "db/config.php");
require_once(_ROOT_ . "db/DBh.php");


$model = new Users();
$controller = new UsersController($model);

$conn = new DBH();
$con = $conn->connect();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $deleteUserId = $_POST['delete'];

        // Delete the record from the database
        $sql = "DELETE FROM reviews WHERE ID = $deleteUserId"; // Adjust 'your_table_name' with your actual table name

        // Execute the SQL query to delete the record
        if ($con->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $con->error;
        }
    }
if(isset($_POST['confirm'])){
    $userId = $_POST['user_id'];
    $product_id = $_POST['product_id']; 
    $sql = "INSERT INTO reviewsconfirmation (user_id, product_id, confirmation_status) VALUES ($userId, $product_id, 1)";
    
    if ($con->query($sql) === TRUE) {
        echo "Confirmation added successfully";
    } else {
        echo "Error adding confirmation: " . $con->error;
    }

   
}
   
   


        
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search users</title>
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/Dashboard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"/>


</head>
<body>
    <!-- comment -->
    <div class="container">
    <aside>
            <div class="top">
                <div class="logo">
                   <img src="imgs/loulylogo.png">
                </div>
                <div class="close" id="close-button">
                    <span class="material-icons-sharp">close</span>
                </div>
            </div>
            <div class="sidebar">
               <a href="#" class="active">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Dashboard</h3>
               </a> 
               <a href="viewallusers.php">
                <span class="material-icons-sharp">person</span>
                <h3>Users Accounts</h3>
               </a> 
               <a href="viewalladmins.php">
                <span class="material-icons-sharp">person</span>
                <h3>Admin Accounts</h3>
               </a> 
               <a href="admin_addproduct.php">
                <span class="material-icons-sharp">receipt_long</span>
                <h3>Add product</h3>
               </a> 
               <a href="editprod.php">
                <span class="material-icons-sharp">insights</span>
                <h3>Edit Product</h3>
               </a> 
               <a href="deleteproduct.php">
                <span class="material-icons-sharp">mail_outline</span>
                <h3>Delete product</h3>
                <span class="message-count">26</span>
               </a> 
               
               <a href="vieworders.php">
                <span class="material-icons-sharp">report_gmailerrorred</span>
                <h3>Orders</h3>
               </a> 
               <a href="viewreviews.php">
                <span class="material-icons-sharp">report_gmailerrorred</span>
                <h3>reviews</h3>
               </a> 
               <a href="Account.php">
                <span class="material-icons-sharp">logout</span>
                <h3>Log out</h3>
               </a> 
               
            </div>
           
        </aside>
    <div class="container">
        <!-- ... (your sidebar content) ... -->
        <main>
           
            <div class="container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product ID</th>
                            <th>User ID</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Review Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Assuming $controller->getreviews() returns review data
                        $result = $controller->getreviews();

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr id="row_' . $row['ID'] . '">
                                        <td>' . $row['ID'] . '</td>
                                        <td>' . $row['product_id'] . '</td>
                                        <td>' . $row['user_id'] . '</td>
                                        <td>' . $row['rating'] . '</td>
                                        <td>' . $row['review'] . '</td>
                                        <td>' . $row['review_date'] . '</td>
                                        <td>
                                            <form method="post" action="">
                                                <input type="hidden" name="user_id" value="' . $row['ID'] . '">
                                                <input type="hidden" name="user_id" value=" '.$row['user_id'].' ">
                                                <input type="hidden" name="product_id" value=" '.$row['product_id'].' ">
                                                <button type="submit" name="confirm" value="confirm">Confirm</button>
                                                <button type="submit" name="delete" value="' . $row['ID'] . '">Delete</button>
                                            </form>
                                        </td>
                                    </tr>';
                            }
                        } else {
                            echo '<tr><td colspan="7"><h2>No Users Found</h2></td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    
      
    </body>
    
    </html>