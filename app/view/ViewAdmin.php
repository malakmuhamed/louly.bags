
<!-- viewAdmin.php -->
<?php

require_once(__ROOT__ . "view/View.php");
require_once(__ROOT__ . "model/Admin.php");
require_once(__ROOT__ . "db/config.php");
require_once(__ROOT__ . "db/DBh.php");
class ViewAdmin extends View{
  
    
    public function output() {
        echo $this->ManageUsers();
    }
    public function ManageUsers()
    {
        $str = '<link rel="stylesheet" type="text/css" href="../public/css/permissions.css">';
        $str .= '<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
            <script type="text/javascript">
                $(document).ready(function(){            
                    $("#btnLeft").click(function () {
                        var selectedItem = $("#rightValues option:selected");
                        $("#leftValues").append(selectedItem);
                    });
                    $("#btnRight").click(function () {
                        var selectedItem = $("#leftValues option:selected");
                        $("#rightValues").append(selectedItem);
                    });
                });
            </script>';
    
        $str .= '<form action="" method="post">
            <table class="permission-table">
                <tr>
                    <td>All Pages</td>
                    <td></td>
                    <td>Chosen Pages</td>
                </tr>
                <tr>
                    <td>
                        <select id="leftValues" name="all-pages[]" class="select-box" size="5" multiple>';
    
        $obj = $this->model->SelectAllPagesInDB();
        for ($i = 0; $i < count($obj); $i++) {
            $str .= '<option value="' . $obj[$i]['ID'] . '">' . $obj[$i]['FriendlyName'] . '</option>';
        }
    
        $str .= '</select>
                    </td>
                    <td class="button-column">
                        <input type="button" id="btnLeft" value="<<" class="action-button" />
                        <input type="button" id="btnRight" value=">>" class="action-button" />
                    </td>
                    <td>
                        <select id="rightValues" name="choosen-pages[]" class="select-box" size="5" multiple>';
    
        // Assuming you want to pre-populate the chosen pages if this is an edit form
        $chosenPages = []; // Replace this with logic to fetch chosen pages from the database
        foreach ($chosenPages as $page) {
            $str .= '<option value="' . $page['ID'] . '">' . $page['FriendlyName'] . '</option>';
        }
    
        $str .= '</select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Choose User Type:
                    </td>
                    <td>
                        <select name="UserType" class="select-box">';
    
        $userTypes = $this->model->SelectAllUserTypesInDB();
        foreach ($userTypes as $userType) {
            $str .= '<option value="' . $userType['ID'] . '">' . $userType['UserTypeName'] . '</option>';
        }
        $str .= '</select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit" class="submit-button">
                    </td>
                </tr>
            </table>
        </form>';
    
        return $str;
    }
    

////////////////////////////////////////////////////////////////////////////
public function editEmployeeProfileForm()
{
    // Check if 'Email' is set in the $_SESSION array
    $emailValue = isset($_SESSION['Email']) ? $_SESSION['Email'] : '';

    $str = '<form action="editemployee.php?action=editEmployeeProfile" method="post">
        Email:<br>
        <input type="text" value="' . $emailValue . '" name="Email"><br>

        Old Password:<br>
        <input type="password" name="OldPassword"><br>

        New Password:<br>
        <input type="password" name="Password"><br>

        <input type="submit" value="Submit" name="Submit">
    </form>';

    return $str;
}

//////////////////////////////////////////////////////////////////////////////////////////////////
public function updateUserTypeForm()
{
    $str = '<form action="editemployee.php?action=updateUserType" method="post">
        <input type="hidden" name="user_id" value="' . $_SESSION['ID'] . '">
        
        <label for="make_admin">Make Admin:</label>
        <input type="radio" id="make_admin" name="user_type" value="2">

        <label for="make_user">Make User:</label>
        <input type="radio" id="make_user" name="user_type" value="1">

        <input type="submit" value="Update User Type" name="update_user_type">
    </form>';

    return $str;
}
//////////////////////////////////////////////////////////////////////////////////////////////////
}
