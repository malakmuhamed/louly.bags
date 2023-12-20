<?php
define('__ROOT__', "../app/");
require_once(__ROOT__ . "model/Product.php");
require_once(__ROOT__ . "Controller/ProductController.php");
$model=new Products();
$controller=new ProductControllers($model);


// Ensure the POST request is sent
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the posted data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $image = $_POST['image'];
    $price = $_POST['Price'];
    $description = $_POST['description'];
    $offers = $_POST['offers'];
    $product_type = $_POST['Product_type'];
   $qty=$_POST['qty'];
    // Handle other POST data...

    // Assuming you have instantiated $model and $controller earlier
    // Call the controller function to handle the editing process
    $controller->edit($id, $name, $image, $price, $description, $offers,$product_type,$qty);
    // Handle other function parameters accordingly based on your controller implementation
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funda of Web IT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card mt-5">
                <div class="card-header text-center">
                    <h4>Edit Product</h4>
                </div>
                <div class="card-body">

                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" name="prod_name" value="<?php echo isset($_GET['prod_name']) ? $_GET['prod_name'] : ''; ?>" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <?php 
                            $conn = mysqli_connect("localhost", "root", "", "loulyss");

                            if(isset($_GET['prod_name'])) {
                                $prod_name = $_GET['prod_name'];

                                $query = "SELECT p.id AS Product_ID, p.name, p.image, p.Price, p.description, p.offers,p.qty, o.Name AS Option_Name
                                            FROM product p
                                            JOIN product_s_o_v psov ON p.id = psov.Product_ID
                                            JOIN product_type_s_o ptso ON psov.Product_Type_S_O = ptso.ID
                                            JOIN options o ON ptso.Options = o.ID 
                                            WHERE p.name = '$prod_name'";
                                
                                $query_run = mysqli_query($conn, $query);

                                if (!$query_run) {
                                    die("Error in query: " . mysqli_error($conn));
                                }

                                if(mysqli_num_rows($query_run) > 0) {
                                    $row = mysqli_fetch_assoc($query_run);
                                    

                        ?>

                        <form action="" method="POST">
                        <div class="form-group mb-3">
                                    <label for="">Name</label>
                                    <input type="text" value="<?= $row['name']; ?>" class="form-control" name="name">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Image</label>
                                    <input type="text" value="<?= $row['image']; ?>" class="form-control" name="image">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Price</label>
                                    <input type="text" value="<?= $row['Price']; ?>" class="form-control" name="Price">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Product Description</label>
                                    <input type="text" placeholder="Product Description" name="description" value="<?= $row['description']; ?>" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Product Offers</label>
                                    <input type="text" placeholder="Product Offers" name="offers" value="<?= $row['offers']; ?>" class="form-control">
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="">Product Quantity</label>
                                    <input type="text" placeholder="Product quantity" name="qty" value="<?= $row['qty']; ?>" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                <label for="Product_type">Product Type</label>
    <select id="Product_type" name="Product_type" class="box" required>
                                        <option value="1" name="Product_type">Cross Bags</option>
                                        <option value="2" name="Product_type">Hand Bags</option>
                                    </select>
                                </div>
     

                                <input type="checkbox" value="1" name="options" <?= ($row['Option_Name'] === 'strap') ? 'checked' : ''; ?>>
                                <label for="strap">Strap</label>
                                  <br>
                                 <input type="checkbox" value="2" name="options" <?= ($row['Option_Name'] === 'glossy') ? 'checked' : ''; ?>>
                                 <label for="glossy">Glossy</label>

                                <div class="row">
                                    <input type="hidden" value="<?= $row['Product_ID']; ?>" class="form-control" name="id">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary" name="edit_product" value="edit products" action="" ?>>Edit</button>
                                    </div>
                                </div>
                        </form>

                        <?php
                                } else {
                                    echo "The product is not in the database";
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>