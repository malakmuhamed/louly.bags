<?php
require_once(__ROOT__ . "controller/Controller.php");

class CheckoutControllers extends Controller {

function placeorder(){


if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];

    // Accessing the product IDs from the 'productsQuantity' array
    $productIds = $cart->productsQuantity;

    if(isset($_POST['placeorder'])) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $totalprice = $_POST['total_price'];
        $qty=$_POST['qty'];
        $db_handle = new DB();
        
    }
}
$model->placeorder();
}}


?>