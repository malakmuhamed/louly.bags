<?php
define('_ROOT_', "../app/");
include "html/addtocart.html";
require_once(_ROOT_ . "db/config.php");
require_once(_ROOT_ . "db/DBh.php");
require_once(_ROOT_ . "model/Product.php");
require_once(_ROOT_ . "model/cart.php");
require_once(_ROOT_ . "Controller/ProductController.php");
require_once(_ROOT_ . "Controller/cartcontroller.php");
// Start the session
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['cart']) && $_SESSION['cart'] instanceof Cart) {
    $cart = $_SESSION['cart'];
} else {
  
    $cart = new Cart();
}
$db = new DBH();
$products=new Products();
$products = $products->getAllProducts();
$cartmodel=new cart();
$cartcontroller=new cartControllers($cartmodel);
include(__ROOT__ . "View/ViewCart.php");
?>
</head>

</html>