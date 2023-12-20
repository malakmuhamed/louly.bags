<?php
require_once(__ROOT__ . "model/Model.php");
require_once(__ROOT__ . "model/User.php");
require_once(__ROOT__ . "db/config.php");
require_once(__ROOT__ . "db/DBh.php");

class Users extends Model {
    protected $db;
    
    function __construct() {
        $this->db = $this->connect();
    }

    public function insertUser($UserName, $password, $Email, $Confirmpass,$UserType) {
        if (empty($UserName)) {
            return 5;
        }
    
        if (empty($password)) {
            return 6;
        }
    
        if (empty($Email)) {
            return 7;
        }
    
        if (empty($Confirmpass)) {
            return 8;
        }
    
      
        // Check for valid email format
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            return 9;
        }
    
        $sql = "SELECT * FROM users WHERE UserName='$UserName'";
        $result = $this->db->query($sql);
        
        if ($result->num_rows > 0) {
            return 1; // Username already exists
        } 
        else {
            if ($password === $Confirmpass) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $insertQuery = "INSERT INTO users (UserName, Password, Email,UserType_id) VALUES ('$UserName', '$hashed_password', '$Email','$UserType')";
                if ($this->db->query($insertQuery) === true) {
                    return 2; // User successfully inserted
                } else {
                    return 3; // Error inserting user
                }
            } 
            else {
                return 4; // Passwords do not match
            }
        }
    }


    public function loginuser($UserName, $password) {
        $sql = "SELECT * FROM users WHERE UserName='$UserName'";
        $result = $this->db->query($sql);
    
        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $hashed_password = $row['Password']; 
    
                if (password_verify($password, $hashed_password)) {
                    $_SESSION["ID"] = $row["ID"];
                    $_SESSION["UserName"] = $row["UserName"];
                    return   $_SESSION["ID"] = $row["ID"]; 
                    
                } 
                else {
                    return 2; 
                }
            } else {
                return 3; 
            }
        } else {
          
            return 4;
        }
    }
    public function addreviews($user_id,$productid,$rating,$review,$reviewdate){
    
        $insertQuery = "INSERT INTO reviews (product_id, user_id, rating, review, review_date) VALUES ('$productid','$user_id','$rating','$review', '$reviewdate')";
              if ($this->db->query($insertQuery) === true) {
            return 2;
        } else {
            return 3; 
        }
}


public function getReviews() {
   
    $conn = new DBH();
    $con = $conn->connect();

    $sql = "SELECT * FROM reviews";
    $result = mysqli_query($con, $sql);

    return $result;
    
}

}
?>
