<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/checkoutareej.css">
</head>
<body>


<div class="container">

    <div class="checkoutLayout">
    <?php
  require_once(__ROOT__ . "model/Product.php");
  require_once(__ROOT__ . "Controller/ProductController.php");
    if(isset($_SESSION[ 'cart' ])&&!empty($_SESSION[ 'cart' ]))
     {
    $cart = $_SESSION['cart'];
    $totalQuantity = 0;
    $totalPrice = 0;}
    ?>
<form action="" method="POST">
        <div class="returnCart">
            <a href="/">keep shopping</a>
            <h1>List Product in Cart</h1>
            <div class="list">
                            <?php foreach ($cart as $productId => $productDetails): ?>
                                <?php foreach ($productDetails as $id => $q): ?>
                                    <?php
                                        $p = new Products($id);
                                        $product=$p->getproductbyid($id);	
                                    ?>
                                    
                                    <div class="item">
                                        <img src="<?php echo $product->getImage() ?>">
                                        <div class="info">
                                            <div class="name"><?php echo $product->getName() ?></div>
                                            
                                            <input type="hidden" name="id" value="<?php $p->id; ?>">
                                            <!-- Display other product information -->
                                        </div>
                                        <div class="quantity"><?php echo $q.'x' ?></div>
                                        <input type="hidden" name="qty" value="<?php $q; ?>">
                                        <div class="returnPrice"><?php echo $product->getPrice()  ?></div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </div>
        </div>
    
        
                                
       
        
       
        
    

    

        


        <div class="right">
            <h1>Checkout</h1>
<form action="checkoutareej.php"  method="POST">
            <div class="form">
                <div class="group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" required>
                </div>
    
                <div class="group">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone" required>
                </div>
    
                <div class="group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" required>
                </div>
    
                <div class="group">
                    <label for="country">Country</label>
                    <input type="text" name="country" id="country" required name="country">
                        
                    
                </div>
    
                <div class="group">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" required name="city">
                     
                </div>
            </div>
            <div class="return">
            <?php
    $totalQuantity = 0;
    $totalPrice = 0;
    foreach ($cart as $productId => $productDetails) {
        foreach ($productDetails as $id => $q) {
            $p = new Products($id);
            $product=$p->getproductbyid($id);	
            // Accumulate total quantity and total price for all items in the cart
            $totalQuantity += $q;
            $totalPrice += $product->getPrice() * $q;
        }
        
    }
    ?>
                <div class="row">
                    <div>Total Quantity</div>
                    <div class="totalQuantity"><?php echo $totalQuantity ?></div>
                </div>
                <div class="row">
                    <div>Total Price</div>
                    <div class="totalPrice"><?php echo $totalPrice ?></div>
                    <input type="hidden" name="total_price" value="<?php echo $totalPrice; ?>">
                </div>
            </div>
           
            <button type ="submit" class="buttonCheckout" name="placeorder">CHECKOUT</button>
            </div>
</form>
    </div>
</div>
</form>



</body>
</html>