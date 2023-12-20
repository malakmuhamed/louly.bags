<?php
require_once(__ROOT__ . "controller/Controller.php");
require_once(__ROOT__ . "model/cart.php");
require_once(__ROOT__ . "db/config.php");
require_once(__ROOT__ . "db/DBh.php");
class cartControllers extends Controller {

    function __construct($model) {
        parent::__construct($model); // If there's any constructor in the parent Controller class

        if (!isset($_SESSION)) {
            session_start();
        }

        if (isset($_SESSION['cart']) && $_SESSION['cart'] instanceof Cart) {
            $cart = $_SESSION['cart'];
        } else {
            $cart = new Cart();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST['cart'])) {
                $cart->productsQuantity = json_decode($_POST['cart'], true);
            }

            // Handle other actions if needed
            if (!empty($_GET["action"])) {
                switch ($_GET["action"]) {
                    case "add":
                        if (!empty($_POST["quantity"])) {
                            $cart->addProduct($_GET["id"], $_POST["quantity"]);
                        }
                        break;
                    case "remove":
                        $cart->removeProduct($_GET["id"]);
                        break;
                    case "empty":
                        $cart->emptyCart();
                        break;
                    case "decrease":
                        if (!empty($_POST["quantity"])) {
                            $cart->decreaseProductQuantity($_GET["id"], $_POST["quantity"]);
                        }
                        break;
                }
            }
            
            $_SESSION['cart'] = $cart;
        }
        
    }
    function placeorder($name,$phone,$address,$country,$city,$totalprice,$qty,$productIds,$user_id){

                 $model=new Cart();
                 $areej=$model->placeorder($name,$phone,$address,$country,$city,$totalprice,$productIds,$user_id);
               if($areej==1){
                echo "success";
               }
    
            
    }
   

}
?>