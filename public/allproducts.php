<?php
// Your previous code for including files and creating instances...
define('__ROOT__', "../app/");
require_once(__ROOT__ . "model/Users.php");
require_once(__ROOT__ . "Controller/UserController.php");
require_once(__ROOT__ . "view/ViewUsers.php");
require_once(__ROOT__ . "model/Product.php");
require_once(__ROOT__ . "Controller/ProductController.php");
require_once(__ROOT__ . "view/ViewProduct.php");
require_once(__ROOT__ . "db/config.php");
require_once(__ROOT__ . "db/DBh.php");
include "html/makeup.html";

$model = new Products();
$controller = new ProductControllers($model);
$views = new ViewProduct($controller, $model);


$products = $model->getAllProducts();





$dbs=new DBh();
$db = $dbs->connect();










?>

<?php if ($products) { ?>
    <div class="box-container">
        <?php foreach ($products as $product) { ?>
            <div class="box">
                <div class="container">
                    <div class="img">
                  
                    <a href="productdetail.php?id=<?php echo $product->getId(); ?>">
            <div class="img">
                <img src="./uploads/<?php echo $product->getImage(); ?>" height="100" alt="">
            </div>
        </a>
                        
                    </div>
                </div>
                <div class="content">
                    <h3><?php echo $product->getName(); ?></h3>
                    <?php if ($product->getQuantity() > 0) { ?>
                        <div style="margin:10px; padding:10px" class="main">
                            <!-- Your star icons here -->
                        </div>
                        <div class="btn1-group">
                            <form method="post" action="addtocart.php?action=add&id=<?php echo $product->getId(); ?>">
                                <button type="submit" class="btnAddAction" style="color: black;">
                                    Add to Bag <?php echo $product->getPrice(); ?>$
                                </button>
                                <input type="hidden" name="id" value="<?php echo $product->getId(); ?>">
                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="action" value="add">
                            </form>
                        </div>
                    <?php } else { ?>
                        <p>Sold Out</p>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>
