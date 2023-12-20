<?php 
define('__ROOT__', "../app/");
require_once("../app/db/Dbh.php");
require("../app/db/UserNotification.php");
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/profile.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"/>

    <!-- Add this line to include the new CSS for the notification sidebar -->
    <link rel="stylesheet" href="./css/notification.css">

    <title>User Profile</title>
</head>
<body>

  <header>
    <div class="header-content">
      <div class="icon-container">
        <img src="imgs/notification.png" alt="Notification Icon" class="notification" id="notificationIcon">
      </div>
    </div>
  </header>

  <section class="profile-container">
    <div class="profile-picture">
      <!-- Add user profile picture here -->
      <img src="imgs/usericon.jpg" alt="User Profile Picture">
    </div>

    <div class="profile-details">
      <?php
  

  // Check if the user is logged in (adjust the condition based on your authentication mechanism)
  if (isset($_SESSION['user_id'])) {
      $userId = $_SESSION['user_id'];

      // Fetch user details based on the user ID using your DBh class
      $sql = "SELECT * FROM users WHERE ID = $userId";
      
      // Execute the query and fetch the result
      $result = $dbh->query($sql);
      
      // Check if the query was successful
      if ($result->num_rows > 0) {
          $userDetails = $dbh->fetchRow($result);

          // Display user details in the profile section
          echo "<div class='profile-details'>";
          echo "<h2>{$userDetails['UserName']}</h2>";
          echo "<p>Email: {$userDetails['Email']}</p>";
          echo "<p>User Type: {$userDetails['UserType_id']}</p>";
          echo "</div>";
      } else {
          echo "User not found.";
      }
  } else {
      // Redirect or display a message for users who are not logged in
      echo "User not logged in.";
  }
  ?>

    </div>
  </section>

  <!-- Add a container for the notification sidebar -->
  <!-- Notification sidebar container -->
  <div id="notificationSidebar" class="notification-sidebar">
        <span class="close-button" id="closeButton">&times;</span>
        <h2>Notifications</h2>
        <!-- Notification content... -->
        <?php
        // Display the notification if it exists in the session
        if (isset($_SESSION['notification'])) {
            echo "<p>{$_SESSION['notification']}</p>";
            // Clear the session variable after displaying the notification
            unset($_SESSION['notification']);
        } else {
            echo "<p>No new notifications</p>";
        }
        ?>
    </div>

  <footer>
    <p>&copy; 2023 User Profile Page</p>
  </footer>

  <script src="./script/notification.js"></script>


</body>
</html>
