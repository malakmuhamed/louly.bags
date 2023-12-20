<?php


define('__ROOT__', "../app/");
include "html/addtocart.html";
require_once(__ROOT__ . "model/cart.php");
require_once(__ROOT__ . "Controller/cartcontroller.php");
require_once(__ROOT__ . "model/Product.php");
require_once(__ROOT__ . "Controller/ProductController.php");
require_once(__ROOT__ . "view/ViewProduct.php");
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];

    // Accessing the product IDs from the 'productsQuantity' array
    $productIds = $cart->productsQuantity;

    $model=new Cart();
    $controller=new cartControllers($model);
    if(isset($_POST['placeorder'])&isset($_SESSION['ID'])) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $totalprice = $_POST['total_price'];
        $qty=$_POST['qty'];
        $user_id = $_SESSION['ID'];
        // $db_handle = new Dbh();
        if($name=="" || $phone=="" || $address=="" || $country=="" || $city==""){
            header('Location:checkoutareej.php');
            exit;
        }
    $controller->placeorder($name,$phone,$address,$country,$city,$totalprice,$qty,$productIds,$user_id);

    }
                  
}
include(__ROOT__ . "View/ViewCheckout.php");
?>



