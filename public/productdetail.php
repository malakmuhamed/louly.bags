<?php
define('ROOT', "../app/");
include "html/addtocart.html";
require_once(ROOT . "db/config.php");
require_once(ROOT . "db/DBh.php");
require_once(ROOT . "model/Product.php");
require_once(ROOT . "model/cart.php");
require_once(ROOT . "Controller/ProductController.php");
require_once(ROOT . "Controller/cartcontroller.php");

$db = new Dbh();
$conn=$db->connect();
$model=new Products();
$products = $model->getAllProducts();
// Initialize the cart
if (isset($_SESSION['cart']) && $_SESSION['cart'] instanceof Cart) {
    $cart = $_SESSION['cart'];
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
    $_SESSION['cart'] = $cart; // Update the entire cart object
}
else if(isset($_POST['reviews'])){
	$user_id=$_SESSION['ID'];
	
	$controller->addreviews($user_id);
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/productDetail.css">

    <title>cross bag</title>
   
</head>

<body>
<?php

if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection or other attacks
    $productId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Now $productId contains the product ID sent through the URL
    // echo "Product ID: " . $productId;
}
    

$selectedProductId = $productId;// Replace 123 with the actual product ID

// Find the selected product in the $products array
$selectedProduct = null;
foreach ($products as $product) {
    if ($product->id == $selectedProductId) {
        $selectedProduct = $product;
        break;
    }
}

// Check if the product is found
if ($selectedProduct) {
?>
    <div class="left-split">
        <!-- Your existing HTML code for images and container -->

        <!-- Add product ID to the image elements -->
       
        </div>
    </div>
    <form method="post" action="addtocart.php?action=add&id=<?php echo $selectedProduct->id; ?>">
    <div class="container">
        <div class="box">
            <div class="images">
            <img class="demo cursor" src="uploads/<?php echo $selectedProduct->image; ?>" style="width:100%">
        <!-- Repeat for other images -->

       
            </div>
            <div class="basic-info">
                <h1><?php echo $selectedProduct->name; ?></h1>
                <h1><?php echo "Product ID: " . $productId; ?></h1>
                
                <span><?php echo $selectedProduct->price . "$"; ?></span>

                <span><?php echo $selectedProduct->description;?></span>
                <div class="options">
                    
                    <button class="addtocart">
                        
                            <a href>
                            <div type="submit" value="Add to cart" class="btnAddAction">ADD TO CART</div>
                 
                        
                        <input type="hidden" name="id" value="product_id"> <!-- Replace "123" with the actual product ID -->
                     
                        <input type='hidden' name='cart' value='<?php echo (json_encode($cart->productsQuantity)); ?>' />
</a>
                    </button>
                 
                 <a href="addreviews.php"> ADD REVIEW</a>
                </div>
            </div>
            <div class="description">
            <?php
    $con = mysqli_connect("localhost", "root", "", "loulyss");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $productId = mysqli_real_escape_string($con, $selectedProduct->id);
    
    $sql = "SELECT review FROM reviews WHERE product_id  = '$productId'";
    $result = mysqli_query($con, $sql);
    
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "Reviews: " . $row['review']; // Output the 'review' column value
            }
        } else {
            echo "No reviews found for this product ID: $productId";
        }
    } else {
        echo "Error in query: " . mysqli_error($con);
    }
    
    mysqli_close($con);
    ?>
                
                ?>

                
                <ul class="social">
                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <?php } ?>
            </div>
     

        <script>
          
            function count(meen) {
                let minus = document.getElementById("minus");
                let val = document.getElementById("value");
                let add = document.getElementById("add");
                let countNum = parseInt(val.innerHTML);

                if (meen == 'minus') {
                    if (countNum > 1) {
                        let valuee = countNum - 1;
                        val.innerHTML = valuee;
                    }
                }
                if (meen == 'add') {
                    let valuee = countNum + 1;
                    val.innerHTML = valuee;
                }
            }

            // Update image click event to set the selected product ID
            const images = document.querySelectorAll(".demo");
            images.forEach(img => {
                img.addEventListener('click', () => {
                    const productId = img.getAttribute(productIdAttribute);
                    if (productId) {
                        // Update the selected product ID when an image is clicked
                        selectedProductId = parseInt(productId);
                    }
                });
            });
        </script> 

</body>
</html>