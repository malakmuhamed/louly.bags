<?php

require_once(__ROOT__ . "model/Product.php");
require_once(__ROOT__ . "Controller/ProductController.php");
require_once(__ROOT__ . "db/config.php");
require_once(__ROOT__ . "db/DBh.php");



class Cart {
    public $productsQuantity;

    function __construct() {
        $this->productsQuantity = array();
    }
    function getquantity() {
        $this->productsQuantity ;
    }

    function addProduct($product_id, $q) {
        // Ensure $this->productsQuantity is always treated as an array
        if (!is_array($this->productsQuantity)) {
            $this->productsQuantity = array();
        }
    
        // Explicitly set the quantity to the provided value when adding a new product
        //lw already item gwa hnzwd mno wahed lw msh w
        if (array_key_exists((string)$product_id, $this->productsQuantity)) {
            $this->productsQuantity[(string)$product_id] += (int)$q;
        } else {
            $this->productsQuantity[(string)$product_id] = (int)$q;
        }
    }

    function removeProduct($product_id) {
        unset($this->productsQuantity[(string)$product_id]);
    }

    function emptyCart() {
        $this->productsQuantity = array();
    }
    function decreaseProductQuantity($product_id, $q) {
        // Ensure $this->productsQuantity is always treated as an array
        if (!is_array($this->productsQuantity)) {
            $this->productsQuantity = array();
        }

        // Explicitly set the quantity to the provided value when decreasing the product quantity
        if (array_key_exists((string)$product_id, $this->productsQuantity)) {
            // Decrease the quantity but not below zero
            $this->productsQuantity[(string)$product_id] = max(0, $this->productsQuantity[(string)$product_id] - (int)$q);
        }
    }

    function placeorder($name, $phone, $address, $country, $city, $totalprice, $productIds, $user_id) {
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            $db_handles = new Dbh();
            $db_handle = $db_handles->connect();
            $sql = "INSERT INTO orders (name, phone_number, Address, country, city, totalprice, order_state, user_id) VALUES ('$name','$phone','$address','$country','$city','$totalprice','placed','$user_id')";
            $result = mysqli_query($db_handle, $sql);
    
            if ($result) {
                // Get the last inserted order_id
                $last_order_id = mysqli_insert_id($db_handle);
    
                foreach ($productIds as $productId => $quantity) {
                    // Fetch product details based on the product ID
                    $query = "SELECT id, name, Price FROM product WHERE id='$productId'";
                    $query_run = mysqli_query($db_handle, $query);
    
                    if ($query_run) {
                        $cartitem = mysqli_fetch_assoc($query_run);
                        $prodid = $cartitem['id'];
                        $prodprice = $cartitem['Price'];
    
                        // Insert product details into 'order_items' table with the correct 'order_id'
                        $insert_orderitems_query = "INSERT INTO `order_items` (`order_id`,`prod_id`,`qty`,`order_price`) VALUES ('$last_order_id','$prodid','$quantity','$prodprice')";
                        $insert_orderitems_query_run = mysqli_query($db_handle, $insert_orderitems_query);
    
                        // After executing the query, check for errors
                        if (!$insert_orderitems_query_run) {
                            echo "Error inserting order items: " . mysqli_error($db_handle);
                            // Handle the error appropriately, e.g., log it or throw an exception
                        }
                    } else {
                        echo "Error fetching product details: " . mysqli_error($db_handle);
                        // Handle the error appropriately, e.g., log it or throw an exception
                    }
                }
            } else {
                echo "Failed to insert order: " . mysqli_error($db_handle);
                // Handle the error appropriately, e.g., log it or throw an exception
            }
        } else {
            echo "Cart is empty!";
            // Handle empty cart scenario appropriately
        }
    
        return 1; // Or return something meaningful after order placement
    }
    
    
}

// Start the session
if (!isset($_SESSION)) {
    session_start();
}

// Check if the cart data exists in the session
if (isset($_SESSION['cart']) && $_SESSION['cart'] instanceof Cart) {
    $cart = $_SESSION['cart'];
} else {
    $cart = new Cart();
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if "id" and "quantity" keys exist in $_GET
    $product_id = isset($_GET["id"]) ? filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT) : null;
    $quantity = isset($_GET["quantity"]) ? filter_var($_GET["quantity"], FILTER_SANITIZE_NUMBER_INT) : 0;

    // Check if both product_id and quantity are valid before modifying the cart
    if ($product_id !== null) {
        // Add the product to the cart
        $cart->addProduct($product_id, $quantity);

        // Update session data after modifying the cart
        $_SESSION['cart'] = $cart;
    }

 
    // Redirect or perform other actions

    ///place order function to check out

}
?>
