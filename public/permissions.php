<!-- permissions.php -->
<?php

define('__ROOT__', "../app/");
require_once(__ROOT__ . "model/Admin.php");
require_once(__ROOT__ . "Controller/AdminController.php");
require_once(__ROOT__ . "view/ViewAdmin.php");

// Initialize the model
$model = new Admin();

// Initialize the controller
$controller = new AdminController($model);

// Process the request
$controller->ManageUserRoles();

// Initialize the view
$view = new ViewAdmin($controller, $model);

// Output the view
$view->output();
?>
