
<!-- AdminController.php -->
<?php
require_once(__ROOT__ . "controller/Controller.php");
require_once(__ROOT__ . "controller/Controller.php");

class AdminController extends Controller {
    public function ManageUserRoles()
    {
        if (isset($_POST['submit'])) {
            // Initialize the model
            $model = new Admin();

            // Get user type and chosen pages from the form
            $userTypeId = $_POST["UserType"];
            $selectedPages = $_POST["choosen-pages"];
            
            // Use the model to delete existing roles
            $model->deleteUserRoles($userTypeId);
            
            // Use the model to add new roles
            $model->addUserRoles($userTypeId, $selectedPages);
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////
    public function editEmployeeProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $userID = $_SESSION["ID"];
            $email = htmlspecialchars($_POST["Email"]);
            $oldPassword = htmlspecialchars($_POST["OldPassword"]);
            $newPassword = htmlspecialchars($_POST["Password"]);

            $result = $this->model->editEmployeeProfile($userID, $email, $oldPassword, $newPassword);

            if ($result !== null) {
                header("Location: editemployee.php?error=" . urlencode($result));
                exit();
            }

            header("Location: allproducts.php");
            exit();
        }
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////
public function updateUserType()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update_user_type'])) {
            $userID = $_POST['user_id'];
            $userType = $_POST['user_type']; // Retrieve user type from the form

            $result = $this->model->updateUserType($userID, $userType);

            if ($result) {
                echo "User updated successfully.";
            } else {
                echo "Error updating user.";
            }
        }
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////

public function getallusers($condition){
    
    return $this->model->getallusers($condition );
  
     
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function getalladmins($condition)
  {
      return $this->model->getalladmins($condition );
  }

}
?>

        
  
