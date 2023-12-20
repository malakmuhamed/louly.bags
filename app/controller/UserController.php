<?php
session_start();
require_once(__ROOT__ . "controller/Controller.php");

class UsersController extends Controller {
    public function insert() {
        if (isset($_POST['signup'])) {
            $result = $this->model->insertUser($_POST["UserName"], $_POST["password"], $_POST["Email"], $_POST["Confirmpass"],1);

            if ($result == 1) {
                echo "UserName already taken";
            }
             else if ($result == 2) {
                header("Location: login.php");
            }
             else if ($result == 4) {
                echo "passwords don't match";
            }
            else if ($result == 5) {
                echo "passwords length";
            } 
            else {
                echo "error inserting";
            }
        }
    }

    public function edit() {
        $UserName = $_REQUEST['UserName'];
        $Email = $_REQUEST['Email'];
        $password = $_REQUEST['password'];
    
        $this->model->editUser($UserName, $password, $Email);
    }
    
    public function delete() {
        $this->model->deleteUser();
    }

    public function login() {
        if (isset($_POST['login'])) {
            $result = $this->model->loginuser($_POST["UserName"], $_POST["password"]);
            $_SESSION["ID"] = $result;
            
            if ($result) {
                
                header("Location: home.php");
            } 
            else if ($result == 2) {

                echo "password is incorrect";

            } 
            else {
                echo "user is not found";
            }
        }
    
    }
    public function addreviews($user_id){
        // $user_id=$_SESSION["ID"];
        if(isset($_POST['reviews'])){
            $result = $this->model->addreviews($user_id,$_POST['productid'],$_POST['rating'],$_POST['review'],$_POST['reviewdate'] );
            echo $result;
        }
    }

    public function getreviews(){
        return $this->model->getReviews();
        
       }
}
?>
