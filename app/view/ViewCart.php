<?php

require_once(__ROOT__ . "view/View.php");
?>
<body>

    <div class="split">
        <div class="centeredd">
            <div class="headerr1">
                <span class="innerdetails">
                    YOUR BAG &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </span>
                <span class="innerdetails2">
                    items &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </span>
               
            </div>
            <div class="headerr2">
                <p>WELCOME&nbsp;BACK&nbsp;!</p>
            </div>
            <div class="gift">
                <p class="p2">Add EGP‌ 1,100.00 to your cart to qualify<br> for a FREE gift!</p>
                <button class="btn3">ADD YOUR GIFT</button>
            </div>
            <div class="bag">
                    
                    <?php

                    if (count($cart->productsQuantity) > 0) {
                        $item_total = 0;
                        ?>
                                                    <table cellpadding="10" cellspacing="1">
                                                        <tr>
                                                            <th><strong>Name</strong></th>
                                                            <th><strong>Quantity</strong></th>
                                                            <th><strong>Price</strong></th>
                                                            <th><strong>image</strong></th>
                                                            <th><strong>add one</strong></th>
                                                            <th><strong>remove one</strong></th>
                                                            <th><strong>remove product</strong></th>

                          
                                                        </tr>	
                                                        <?php

                                                        foreach ($cart->productsQuantity as $product_id => $quantity) {

                                                            $products = new Products();
                                                            $product = $products->getproductbyid($product_id);
                                                            ?>
                                                                                            <tr>
                                                                                                <td><strong><?php echo $product->name; ?></strong></td>
                                                                                                <td><?php echo $quantity; ?></td>
                                
                                                                                                <td><?php echo "$" . ($product->price - ($product->price * $product->offers / 100)); ?></td>
            
                                
                                                                                                <td>    <img src="./uploads/<?php echo $product->getImage(); ?>" alt=""height="100" alt=""> </td>
                                                                
                                                        
                                                                                     <form method="post" action="addtocart.php?action=add&id=<?php echo $product->id; ?>">
                                                                                     <td> 
                                                                                       <label for="quantity">ADD:</label>
                                                                                       <input type="number" name="quantity" value="1" min="1">
                                                                                       <input type="submit" value="Add" name="add"  class="buttons">
                                                                                       <input type='hidden' name='cart' value='<?php echo (json_encode($cart->productsQuantity)); ?>' />
                                                                                       </td> </form>
                                                                                     <form method="post" action="addtocart.php?action=decrease&id=<?php echo $product->id; ?>"> <td> 
                                                                                <label for="quantity"> Remove:</label>
                                                                                <input type="number" name="quantity" value="1" min="1">
                                                                                <input type="submit" value="Remove One" class="buttons">
                                                                                <input type='hidden' name='cart' value='<?php echo (json_encode($cart->productsQuantity)); ?>' /></td>
                                                                            </form>
                                                                            <form method="post" action="addtocart.php?action=remove&id=<?php echo $product->id; ?>"><td>
                                                                                        <input type="hidden" name="id" value="<?php echo $product->id; ?>">
                                                                                      <input type="submit" value="Remove Item"  class="buttons"/>
                                                                                      <input type='hidden' name='cart' value='<?php echo (json_encode($cart->productsQuantity)); ?>' /></td>
                                                                                     </form>
            
            
                                                                                                </td>
                                                                                            </tr>
                         
                                                                                            <?php

                                                                                            $item_total += (($product->price - ($product->price * $product->offers / 100)) * $quantity);

                                                        }
                                                        ?>
                                                        <tr>
                                                            <td colspan="4"><strong>Total:</strong> 
                                                            <?php
                                                            echo "$" . $item_total; ?></td>
                                                        </tr>
                                                    </table>
                                                    <form method="post" action="addtocart.php?action=empty">
                                                <input class="btn1" type="submit" value="Empty Cart">
                                                <input type='hidden' name='cart' value='<?php echo (json_encode($cart->productsQuantity)); ?>' />
                                            </form>
            
                                                    <?php
                    } ?>        
                                <!-- <button class="btn1"> <a href="checkout.php">CHECKOUT</a></button>
                                <br>
                                <br> -->
                                <form method="POST" action="checkout.php">
                                <button class="btn1" name="submitcheckout"> CHECKOUT </button>
                                <br>
                                <br>
            </form>
                                 <!-- <button class="btn2"> SHOP FENTY SKIN</button> -->
                        </div>
                    </div>
            
            
            
            
            




    </div> 
</body>