
<?php


define('__ROOT__', "../app/");
require_once(__ROOT__ . "model/Users.php");
require_once(__ROOT__ . "Controller/UserController.php");
require_once(__ROOT__ . "view/ViewUsers.php");
require_once(__ROOT__ . "model/Product.php");
require_once(__ROOT__ . "Controller/ProductController.php");
require_once(__ROOT__ . "view/ViewProduct.php");

$model = new Users();
$controller = new UsersController($model);
$views = new ViewUser($controller, $model);
$modell = new Products();
$controllers = new ProductControllers($modell);
$view = new ViewProduct($controllers, $modell);
if (isset($_POST['addproduct'])) {
    $controllers->add();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin add-Product</title>
   
    <link rel="stylesheet" href="css/admin_addproduct.css">
    <link rel="stylesheet" href="css/Dashboard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />
</head>

<body>
<div class="container">
<aside>
<div class="top">
                <div class="logo">
                   <img src="imgs/loulylogo.png">
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
               <a href="login.php">
                <span class="material-icons-sharp">logout</span>
                <h3>Log out</h3>
               </a> 
               
            </div>
           
        </aside>
       
        <!------------- End Of Sidebar ------------->
        <main>
 
        <div class="containers">
    <div class="admin-product-form-container">
    <?php

    echo $view->deleteprofuctform();

    ?>

</div>
</div>                
        </main>




      

</html>