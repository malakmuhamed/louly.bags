<?php
//search.php

define('__ROOT__', "../app/");
require_once(__ROOT__ . "model/Users.php");
require_once(__ROOT__ . "Controller/UserController.php");
require_once(__ROOT__ . "view/ViewUsers.php");
require_once(__ROOT__ . "model/Admin.php");
require_once(__ROOT__ . "Controller/AdminController.php");

$model = new Admin();
$controller = new AdminController($model);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search users</title>
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/Dashboard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"/>


</head>
<body>
    <!-- comment -->
    <div class="container">
    <aside>
            <div class="top">
                <div class="logo">
                   <img src="imgs/loulylogo.png">
                </div>
                <div class="close" id="close-button">
                    <span class="material-icons-sharp">close</span>
                </div>
            </div>
            <div class="sidebar">
               <a href="#" class="active">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Dashboard</h3>
               </a> 
               <a href="search.php">
                <span class="material-icons-sharp">person</span>
                <h3>Users Accounts</h3>
               </a> 
               <a href="#">
                <span class="material-icons-sharp">person</span>
                <h3>Admin Accounts</h3>
               </a> 
               <a href="admin_addproduct.php">
                <span class="material-icons-sharp">receipt_long</span>
                <h3>Add product</h3>
               </a> 
               <a href="edits.php">
                <span class="material-icons-sharp">insights</span>
                <h3>Edit Product</h3>
               </a> 
               <a href="edits.php">
                <span class="material-icons-sharp">mail_outline</span>
                <h3>Delete product</h3>
                <span class="message-count">26</span>
               </a> 
               
               <a href="#">
                <span class="material-icons-sharp">report_gmailerrorred</span>
                <h3>Orders</h3>
               </a> 
               <a href="Account.php">
                <span class="material-icons-sharp">logout</span>
                <h3>Log out</h3>
               </a> 
               
            </div>
           
        </aside>
        <main>
            <form method="post">
                <input type="text" placeholder="Search Users" name="search">
                <button class="sbtn" name="submit">Search</button>
            </form>
            <div class="container">
                <table>
                    <?php

                    // Display and search for UserType=admin only
                   
                    $condition = "UserType_id='1'";

                    if (isset($_POST['submit'])) {
                        $search = $_POST['search'];
                        $condition .= " AND FirstName='$search'";
                    }
                $result= $controller->getallusers($condition);

                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<thead>
                                    <tr>
                                        <th>id</th>
                                        <th>UserName</th>
                                        <th>Email</th>
                                        <th>MakeAdmin</th>
                                    </tr>
                                </thead>';

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tbody>
                                        <tr>
                                            <td>' . $row['ID'] . '</td>
                                            <td>' . $row['UserName'] . '</td>
                                            <td>' . $row['Email'] . '</td>
                                            <td>
                                                <form method="post" action="updateusertype.php">
                                                    <input type="hidden" name="user_id" value="' . $row['ID'] . '">
                                                    <button type="submit" name="make_admin">Make Admin</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>';
                            }
                        } 
                        else {
                            echo '<h2>No Users Found</h2>';
                        }
                    }

                    ?>
                </table>
            </div>
        </main>
    </div>
</body>

</html>