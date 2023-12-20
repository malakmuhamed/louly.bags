<?php
// access_controlled_page.php

session_start(); // Ensure session is started

// Include the necessary files and classes
define('__ROOT__', "../app/");
require_once(__ROOT__ . "model/Admin.php");
class PageAccessChecker {
    public function checkPageAccess($userTypeId, $requestedPageId) {
        // Query the database to get the allowed pages for the user type
        $model = new Admin(); // Adjust this based on your actual model
        $allowedPages = $model->Pages($userTypeId);

        // Check if the requested page is in the list of allowed pages
        if (!in_array($requestedPageId, $allowedPages)) {
            // Redirect to an error page or another appropriate action
            header("Location: error_page.php");
            exit();
        }

        // Redirect to the requested page
        header("Location: requested_page.php?page_id=" . $requestedPageId);
        exit();
    }
}

// Assume $userTypeId and $requestedPageId are obtained based on your logic
$userTypeId = $_SESSION['user_type'];
$requestedPageId = $_GET['page_id'] ?? null;

// Instantiate the PageAccessChecker and check page access
$pageAccessChecker = new PageAccessChecker();
$pageAccessChecker->checkPageAccess($userTypeId, $requestedPageId);
?>