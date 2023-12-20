<head>
<link rel="stylesheet" href="./css/review.css">
</head>

<?php

define('__ROOT__', "../app/");
require_once(__ROOT__ . "model/Users.php");
require_once(__ROOT__ . "Controller/UserController.php");
require_once(__ROOT__ . "view/ViewUsers.php");
require_once(__ROOT__ . "model/Product.php");
require_once(__ROOT__ . "Controller/ProductController.php");
require_once(__ROOT__ . "view/ViewProduct.php");

$model = new Users();
$controller = new UsersController($model);
$views = new ViewUser($controller, $model);
$modell=new Products();
$controllers=new ProductControllers($modell);
$view=new ViewProduct($controllers,$modell);


if(isset($_POST['reviews'])){
	$user_id=$_SESSION['ID'];
    $controller->addreviews($user_id);
}
?>
<body>
<form method="post" action="">
        Product ID: <input type="text" name="productid"><br><br>
        Rating: <input type="text" name="rating"><br><br>
        Comment: <textarea name="review"></textarea><br><br>
        Date: <textarea name="reviewdate"></textarea><br><br>
        <input type="submit" name="reviews">
    </form>

</body>