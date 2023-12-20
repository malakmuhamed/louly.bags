<?php
define('_ROOT_', "../app/");
include "html/addtocart.html";
require_once(_ROOT_ . "db/config.php");
require_once(_ROOT_ . "db/DBh.php");
require_once(_ROOT_ . "model/Product.php");
require_once(_ROOT_ . "model/cart.php");
require_once(_ROOT_ . "Controller/ProductController.php");
require_once(_ROOT_ . "Controller/cartcontroller.php");
include "html/makeup.html";

$db = new Dbh();
$producti=new Products();
$products = $producti->getAllProductsbycategory(2);

// Initialize the cart
// $cart = new Cart();
if (isset($_SESSION['cart']) && $_SESSION['cart'] instanceof Cart) {
    $cart = $_SESSION['cart'];
    $cart->productsQuantity = $_SESSION['cart'];

} else {
    $cart = new Cart();
}



// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])) {
    switch ($_POST["action"]) {
        case "add":
            if (isset($_POST["id"])) {
                $product_id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
                $quantity = filter_var($_POST["quantity"], FILTER_SANITIZE_NUMBER_INT);
                $cart->addProduct($product_id, $quantity);
            }
            break;
        
    }

    // Update session data after modifying the cart
    $_SESSION['cart'] = $cart->productsQuantity;
}
?>

<div class="box-container">
    <?php foreach ($products as $product) { ?>
        <form method="post" action="addtocart.php?action=add&id=<?php echo $product->id; ?>">
            <div class="box">
                <div class="container">
                    <div class="img">
                    <img src="uploads/<?php echo $product->image; ?>" height="100" alt="">
<a href="productdetail.php?id=<?php echo $product->id; ?>">
                    </div>
                </div>
                <div class="content">
                    <h3><?php echo $product->name; ?></h3>
                    <div style="margin:10px ;padding:10px" class="main">
                        <i class="fa fa-star checked" id="one"></i>
                        <i class="fa fa-star unchecked" id="two"></i>
                        <i class="fa fa-star unchecked" id="three"></i>
                        <i class="fa fa-star unchecked" id="four"></i>
                        <i class="fa fa-star unchecked" id="five"></i>
                    </div>
                    
                    
                    <div class="btn1-group">
                   <button type="submit" class="btnAddAction" style="color: black;">Add to Bag <?php echo $product->price; ?>$</button>
                    </div>
                    <!-- Other HTML elements... -->
                    <input type="hidden" name="id" value="<?php echo $product->id; ?>">
                    <!-- <input type="number" name="quantity" value="1"> -->
                  
                </div>
                <input type="number" name="quantity" value="1">
                <input type="hidden" name="action" value="add">
            </div>
           
        </form>
    <?php } ?>
</div>