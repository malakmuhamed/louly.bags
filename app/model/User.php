<?php
require_once(__ROOT__ . "model/Model.php");
?>

<?php
class User extends Model
{
    private $id;
    private $name;
    private $password;
    private $age;
    private $phone;

    function __construct($id, $UserName = "", $password = "", $Email = "", $Confirmpass = "")
    {
        $this->id = $id;
        $this->db = $this->connect();

        if ("" === $UserName) {
            $this->readUser($id);
        } else {
            $this->UserName = $UserName;
            $this->password = $password;
            $this->Email = $Email;
            $this->Confirmpass = $Confirmpass;
        }
    }

    function getName()
    {
        return $this->UserName;
    }
    function setName($UserName)
    {
        return $this->UserName = $UserName;
    }

    function getPassword()
    {
        return $this->password;
    }
    function setPassword($password)
    {
        return $this->password = $password;
    }

    function getAge()
    {
        return $this->Email;
    }
    function setEmail($Email)
    {
        return $this->age = $Email;
    }



    function getID()
    {
        return $this->id;
    }

    function readUser($id)
    {
        $sql = "SELECT * FROM user where ID=" . $id;
        $db = $this->connect();
        $result = $db->query($sql);
        if ($result->num_rows == 1) {
            $row = $db->fetchRow();
            $this->UserName = $row["UserName"];
            $_SESSION["UserName"] = $row["UserName"];
            $this->password = $row["Password"];
            $this->Email = $row["Email"];

        } else {
            $this->UserName = "";
            $this->password = "";
            $this->Email = "";

        }
    }

    function editUser($UserName, $password, $Email)
    {
        $sql = "update users set UserName='$UserName',password='$password', Email='$Email' where id=$this->id;";
        if ($this->db->query($sql) === true) {
            echo "updated successfully.";
            $this->readUser($this->id);
        } else {
            echo "ERROR: Could not able to execute $sql. " . $conn->error;
        }

    }

    function deleteUser()
    {
        $sql = "delete from user where id=$this->id;";
        if ($this->db->query($sql) === true) {
            echo "deletet successfully.";
        } else {
            echo "ERROR: Could not able to execute $sql. " . $conn->error;
        }
    }

}