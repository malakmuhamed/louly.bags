<?php

require_once(__ROOT__ . "controller/Controller.php");

class ProductControllers extends Controller
{

    function add()
    {
        $name = $_POST['name'];
        $image = $_FILES['image']['name'];
        $product_image_tmp_name = $_FILES['image']['tmp_name'];
        $product_image_folder = 'uploaded_images/' . $image;
        $price = $_POST['Price'];
        $description = $_POST['description'];
        $offers = $_POST['offers'];
        $product_type = $_POST['product_type'];
        $options = $_POST['options'];
        $options_values = $_POST['options_values'];
        $qty = $_POST['qty'];
        // move_uploaded_file($product_image_tmp_name, $product_image_folder);
        // echo $image;

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
            $targetDir = "uploads/";
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $targetFile = $targetDir . $image;



            move_uploaded_file($product_image_tmp_name, $targetFile);


        }

        $result = $this->model->addproduct($name, $price, $image, $description, $offers, $product_type, $options, $options_values, $qty);
        if ($result == 1) {
            echo "please insert name";
        } else if ($result == 2) {
            echo "please insert image";
        } else if ($result == 3) {
            echo "please insert price";
        } else if ($result == 4) {
            echo "please insert desription";
        } else if ($result == 5) {
            echo "please insert product_type";
        } else if ($result == 6) {
            echo "please insert option";
        } else if ($result == 7) {
            echo "please insert quantity";
        } else if ($result == 8) {
            echo "name already exist";
        } else if ($result == 11) {
            echo "success";
        } else {
            echo "error while inserting";
        }

    }
    function delete()
    {
        $productId = isset($_POST['id']) ? intval($_POST['id']) : 0;

        if ($productId <= 0) {
            echo "Invalid Product ID.";
            exit;
        }
        $result = $this->model->deleteproduct($productId);
        echo $result;
    }

    function edit($id, $name, $image, $price, $description, $offers, $Product_Type, $qty)
    {
        if (isset($_POST['edit_product'])) {



            $result = $this->model->editproduct($id, $price, $description, $offers, $Product_Type, $qty);
            echo $result;
        }
        function viewallproducts()
        {
            if (isset($_POST['submitsearch'])) {
                $search = $_POST['search'];
                $result = $this->model->viewallproducts($search);
                return $result;

            }
        }

    }
}
?>

        
  
