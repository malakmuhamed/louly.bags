
<!-- Admin.php -->
<?php
require_once(__ROOT__ . "model/Model.php");
require_once(__ROOT__ . "model/User.php");
require_once(__ROOT__ . "db/config.php");
require_once(__ROOT__ . "db/DBh.php");

class Admin extends Model {
    public function updateUsertypePages($userTypeId, $chosenPages)
    {
        // Delete existing roles for the user type
        $deleteResult = $this->deleteUserRoles($userTypeId);

        // If deletion is successful, add new roles
        if ($deleteResult) {
            $addResult = $this->addUserRoles($userTypeId, $chosenPages);

            // Return the result of adding new roles
            return $addResult;
        } else {
            // Return false if deletion fails
            return false;
        }
    }

    public function deleteUserRoles($userTypeId)
    {
        $db = $this->connect();
        $sql = "DELETE FROM usertype_pages WHERE usertypeid = $userTypeId";
        $result = $db->query($sql);

        return $result;
    }

    public function addUserRoles($userTypeId, $pages)
    {
        $db = $this->connect();
        $result = true;  // Initialize $result
    
        foreach ($pages as $page) {
            // Check if $page is not empty before attempting to insert
            if (!empty($page)) {
                $sql = "INSERT INTO usertype_pages (usertypeid, pageid) VALUES ($userTypeId, $page)";
                $result = $db->query($sql);
    
                // Break the loop if insertion fails
                if (!$result) {
                    break;
                }
            }
        }
    
        return $result;
    }
    


    public function getAllPages()
    {
        // Implement logic to fetch all pages from the database
        $db = $this->connect();
        $sql = "SELECT * FROM pages";
        $result = $db->query($sql);

        return $result->fetchAll(); // Adjust based on your implementation
    }

    public function getAllUserTypes()
    {
        // Implement logic to fetch all user types from the database
        $db = $this->connect();
        $sql = "SELECT * FROM usertypes";
        $result = $db->query($sql);

        return $result->fetchAll(); // Adjust based on your implementation
    }
    function UserType($id) {
        $db = new DBh();
        $sql = "SELECT * FROM usertypes WHERE ID = $id";
        $result = $db->query($sql);
        $userType = null;
    
        if ($row = $db->fetchRow($result)) {
            $userType = [
                'ID' => $row["ID"],
                'UserTypeName' => $row["Name"],
                'ArrayOfPages' => $this->Pages($row["ID"]),
            ];
        }
    
        return $userType;
    }
    
    function SelectAllUserTypesInDB() {
        $db = new DBh();
        $sql = "SELECT * FROM usertypes";
        $result = $db->query($sql);
        $userTypes = [];
    
        while ($row = $db->fetchRow($result)) {
            $userTypes[] = $this->UserType($row["ID"]);
        }
    
        return $userTypes;
    }
    
    function Pages($id) {
        $db = new DBh();
        $sql = "SELECT PageID FROM UserType_Pages WHERE UserTypeID = $id";
        $result = $db->query($sql);
        $pages = [];
    
        while ($row = $db->fetchRow($result)) {
            // Check if $row is not empty before trying to access its elements
            if (!empty($row) && isset($row[0])) {
                $pages[] = $this->Page($row[0]);
            }
        }
    
        return $pages;
    }
    
    
    
    function SelectAllPagesInDB() {
        $db = new DBh();
        $sql = "SELECT * FROM pages";
        $result = $db->query($sql);
        $allPages = [];
    
        while ($row = $db->fetchRow($result)) {
            $allPages[] = $this->Page($row["ID"]);
        }
    
        return $allPages;
    }
    
    function Page($id) {
        $db = new DBh();
        $sql = "SELECT * FROM pages WHERE ID = $id";
        $result = $db->query($sql);
        $page = null;
    
        if ($row = $db->fetchRow($result)) {
            $page = [
                'ID' => $row["ID"],
                'FriendlyName' => $row["FriendlyName"],
                'Linkaddress' => $row["Linkaddress"],
            ];
        }
    
        return $page;
    }
    
/////////////////////////////////////////////////////////////////////////////////////////

public function editEmployeeProfile($userID, $email, $oldPassword, $newPassword)
    {
        $userData = $this->getUserData($userID);

        if (empty($oldPassword) || password_verify($oldPassword, $userData['Password'])) {
            return "Invalid old password.";
        }

        if (!empty($newPassword) && strlen($newPassword) < 8) {
            return "New password should be at least 8 characters long.";
        }

        $this->updateEmployeeProfileInDB($userID, $email, $newPassword);

        return null; // Indicates success
    }

    private function getUserData($userID)
    {
        $db = $this->connect();
        $sql = "SELECT * FROM users WHERE ID = $userID";
        $result = $db->query($sql);
    
        return ($result && $result->num_rows > 0) ? $result->fetch_assoc() : null;
    }
    

    private function updateEmployeeProfileInDB($userID, $email, $newPassword)
    {
        $db = $this->connect();
        $updatePasswordSql = !empty($newPassword) ? ", Password = '$newPassword'" : "";
        $sql = "UPDATE users SET Email = '$email' $updatePasswordSql WHERE ID = $userID";
        $db->query($sql);
    }
////////////////////////////////////////////////////////////////////////////////////////////

public function updateUserType($userID, $userType)
    {
        $sql = "UPDATE users SET UserType_id = '$userType' WHERE ID = '$userID'";
        $result = $this->connect()->query($sql);

        return $result;
    }
    ////////////////////////////////////////////////////////////////////////////////////////
    public function getallusers($condition){
        $conn=new DBH();
        $con=$conn->connect();
         $sql = "SELECT * FROM users where $condition";
       
        $result = mysqli_query($con, $sql);
        return $result;
    }

     ////////////////////////////////////////////////////////////////////////////////////////
    public function getalladmins($condition){
        $conn=new DBH();
        $con=$conn->connect();
         $sql = "SELECT * FROM users where $condition";
       
        $result = mysqli_query($con, $sql);
        return $result;
    }
}



?>
