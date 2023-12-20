<?php
define('_ROOT_', "../app/");
require_once(_ROOT_ . "model/Users.php");
require_once(_ROOT_ . "Controller/UserController.php");
require_once(_ROOT_ . "view/ViewUsers.php");

$model = new Users();
$controller = new UsersController($model);
$view = new ViewUser($controller, $model);

 if (isset($_POST['signup'])) {
   
    $controller->insert();
    $_SESSION["ID"] = $row["ID"];
	$_SESSION["UserName"] = $row["UserName"];
}
?>




<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/signups.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass+Mono:wght@300&amp;family=Space+Grotesk:wght@300&amp;display=swap"
        rel="stylesheet">
    <title>Register</title>
</head>

<body>
    <script src="Validation.js"></script>
    <div class="createAndBenefits">
        <div class="regForm">
            <?php
             echo $view->signup();
            
            ?>
        </div>
        <div class="benefits">
            <h2>Account Benefits</h2>
            <p>
            </p>
            <h4>GET YOUR FAVES FASTER</h4>
            Save your order information to
            make checkout a breeze.
            <p></p>
            <p>
            </p>
            <h4>EXCLUSIVE OFFERS + INFO</h4>
            Sign up to stay posted on hyper-
            limited offers, online-only
            product drops, in-store events.
            <p></p>
            <p>
            </p>
            <h4>ORDER DETAILS</h4>
            Receive important updates about
            your order, and track it every
            step of the way.
            <p></p>
        </div>
    </div>

</body>

</html>