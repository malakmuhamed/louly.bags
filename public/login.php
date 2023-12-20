
<?php



define('__ROOT__', "../app/");
require_once(__ROOT__ . "model/Users.php");
require_once(__ROOT__ . "Controller/UserController.php");
require_once(__ROOT__ . "view/ViewUsers.php");

$model = new Users();
$controller = new UsersController($model);
$view = new ViewUser($controller, $model);

if (isset($_POST['login'])) {

    $controller->login();
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="css/Nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <title> Account</title>

</head>

<body>

    <br>
    <div class="small-header">
        Home /
        <span class="section">
            Account
        </span>
    </div>
    <div class="big-sectionName">
        ACCOUNT
    </div>
    <div class="All3squares">
        <div class="square1">
            <h2 class="h3-title-bold-uppercase">
                RETURNING
                CUSTOMER, TROUBLE LOGGING IN?
                <p class="sq1-small-writing">We updated our shopping experience.
                    If you haven’t logged in recently and are having trouble,
                    please reset your password to login.</p>
            </h2>
            <a href="Edit.php"> <button class="acc-buttons"> RESET PASSWORD</button></a>
            <br>
            <br>
            <a href="Delete.php"> <button class="acc-buttons"> Delete Account</button></a>
        </div>
     
      <?php
      
       echo $view->login();
      
      ?>
    
        <div class="square3">
            <h2 class="h3-title-bold-uppercase">
                CREATE ACCOUNT
                <h3 class="subtitle">
                    GET YOUR FAVES FASTER

                    <p class="sq1-small-writing">

                        Save your order information to make checkout a breeze.
                    </p>

                </h3>
                <h3 class="subtitle">
                    EXCLUSIVE OFFERS + INFO

                    <p class="sq1-small-writing">

                        Sign up to stay posted on hyper-limited offers,
                        online-only product drops, in-store events,
                        and—as true Fenty and Rhode ,
                        personal beauty tips from Rihanna herself.
                    </p>

                </h3>

            </h2>
            <br>
            <a href="signup.php"> <button class="acc-buttons"> CREATE ACCOUNT</button></a>
        </div>
    </div>
    <div class="square4">
        <h2 class="h3-title-bold-uppercase">
            CHECK YOUR ORDER STATUS
            <p class="sq1-small-writing">
                To check your order status, you may
                SIGN IN, CREATE ACCOUNT, or click
                the links found in your order confirmation
                or shipping notification emails.</p>
        </h2>
    </div>

</body>

</html>