<?php
if (!defined('__ROOT__')) {
    define('__ROOT__', "../app/");
}
require_once(__ROOT__ . "model/Model.php");
require_once(__ROOT__ . "model/User.php");
require_once(__ROOT__ . "db/config.php");
require_once(__ROOT__ . "db/DBh.php");

class Products extends Model {
    public $id;
    public $name;
    public $image;
    public $price;
    public $description;
    public $offers;
    public $options;
    public $quantity;
    public function __construct($id=NULL, $name=NULL, $image=NULL, $price=NULL, $description=NULL, $offers=NULL,$quantity=NULL) {
        if ($id !== null && $name !== null && $image !== null && $price !== null && $description !== null && $offers !== null) {
            $this->id = $id;
            $this->name = $name;
            $this->image = $image;
            $this->price = $price;
            $this->description = $description;
            $this->offers = $offers;
            $this->quantity = $quantity;
        }
    }
    function getproductbyid($id) {
        $con = mysqli_connect("localhost", "root", "", "loulyss");
        $sql = "SELECT * FROM product WHERE id = " . $id;
        $result = mysqli_query($con, $sql);
    
        if (!$result || mysqli_num_rows($result) == 0) {
            // Handle query error or empty result set
            echo "Product not found or query error.";
            return null; // Return null to indicate failure or empty result
        }
    
        $productData = mysqli_fetch_assoc($result); // Fetch product data into an associative array
    
        $product = new Products(
            $productData['id'],
            $productData['name'],
            $productData['image'],
            $productData['Price'],
            $productData['description'],
            $productData['offers'],
            $productData['qty']
        );
    
        $optionsQuery = "SELECT options.Name, product_s_o_v.Value 
                        FROM options 
                        INNER JOIN product_type_s_o ON options.ID = product_type_s_o.Options
                        INNER JOIN product_s_o_v ON product_type_s_o.ID = product_s_o_v.Product_Type_S_O
                        WHERE product_s_o_v.Product_ID = $id";
    
        $optionsResult = mysqli_query($con, $optionsQuery);
    
        if ($optionsResult && mysqli_num_rows($optionsResult) > 0) {
            while ($row = mysqli_fetch_assoc($optionsResult)) {
                $product->options[$row['Name']] = $row['Value'];
            }
        }
    
        mysqli_close($con); 
    
        return $product; 
    }
    
    public function getName() {
        return $this->name;
    }

    public function getImage() {
        return $this->image;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getOffers() {
        return $this->offers;
    }
    public function getquantity() {
        return $this->quantity;
    }
    function addproduct($name, $price,$image, $description, $offers, $product_type, $options, $options_values,$qty) {
        $con = mysqli_connect("localhost", "root", "", "loulyss");
        
        // move_uploaded_file($product_image_tmp_name, $product_image_folder);
     
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            return;
        }

        // Validate form fields
        if (empty($name)) {
            return 1;
        }

        if (empty($image)) {
            return 2;
        }

        if (empty($price)) {
            return 3;
        }

        if (empty($description)) {
            return 4;
        }
        
        if (empty($product_type)) {
            return 5;
        }

        if (empty($options)) {
            return 6;
        }
        if (empty($qty)) {
            return 6;
        }


        // Prepare the SQL query for checking existing product name in the database
        $stmt = mysqli_prepare($con, "SELECT COUNT(*) FROM product WHERE name = ?");
        mysqli_stmt_bind_param($stmt, 's', $name);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $product_count);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        if ($product_count > 0) {
            return 8; // Product name already exists
        }

        // Prepare the SQL query for inserting into the product table
      // Prepare the SQL query for inserting into the product table
$stmt = mysqli_prepare($con, "INSERT INTO product (name, image, Price, description, offers, Product_Type, qty) VALUES (?, ?, ?, ?, ?, ?, ?)");

// Bind parameters to statement
mysqli_stmt_bind_param($stmt, 'ssdsssi', $name, $image, $price, $description, $offers, $product_type, $qty);


        // Execute the prepared statement
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Get the ID of the newly inserted product
            $product_id = mysqli_insert_id($con);

            if (!empty($options)) {
                foreach ($options as $option) {
                    // Prepare the SQL query for inserting into the product_type_s_o table
                    $sql = "INSERT INTO product_type_s_o (Product_Type, Options) 
                            VALUES ('$product_type', '$option')";
                    $result = mysqli_query($con, $sql);
                    if (!$result) {
                        // Error occurred while inserting product_type_s_o value
                        echo "Error: " . mysqli_error($con);
                        return 9;
                    } else {
                        // Get the ID of the inserted product_type_s_o entry
                        $product_type_s_o_id = mysqli_insert_id($con);
                        // Use the $product_type_s_o_id as needed
                    }
                }
            }
    
            // Insert the product option values into the product_s_o_v table
            if (!empty($options_values)) {
                foreach ($options_values as $index => $option_value) {
                    $sql = "INSERT INTO product_s_o_v (Product_ID, Product_Type_S_O, Value) 
                            VALUES ('$product_id', '$product_type_s_o_id', '$option_value')";
                    $result = mysqli_query($con, $sql);
                    if (!$result) {
                        // Error occurred while inserting option value
                        echo "Error: " . mysqli_error($con);
                        return 10;
                    }
                }
            }
    
            return 11;
        }

        // Close the statement
        mysqli_stmt_close($stmt);

        // Close the connection
        mysqli_close($con);

        return 11; // Success: Product added successfully
    }
    function deleteproduct($productId){
      
            // Validate and sanitize input
          
            $con = mysqli_connect("localhost", "root", "", "loulyss");
            // Create a new DB instance
            
        
            // Check if the product exists before proceeding
            $sql_check_product = "SELECT id FROM product WHERE id = $productId";
            $result_check_product = mysqli_query($con, $sql_check_product);
        
            if (mysqli_num_rows($result_check_product) > 0) {
                // Fetch Product_Type_S_O from product_s_o_v
                $ss = "SELECT product_s_o_v.Product_Type_S_O
                       FROM product_s_o_v
                       JOIN product_type_s_o ON product_s_o_v.Product_Type_S_O = product_type_s_o.ID 
                       WHERE product_s_o_v.Product_ID = $productId";
        
                $result = mysqli_query($con, $ss);
        
                if (!$result) {
                   return 1;
                }
        
                // Delete records from product_s_o_v
                $sql_delete_s_o_v = "DELETE FROM product_s_o_v WHERE Product_ID = $productId";
                $result_delete_s_o_v = mysqli_query($con, $sql_delete_s_o_v);
        
                if (!$result_delete_s_o_v) {
                    return 2;
                }
        
                // Delete records from product_type_s_o
                while ($row = mysqli_fetch_assoc($result)) {
                    $productTypeSOTodelete = $row['Product_Type_S_O'];
                    $sql_delete_type_s_o = "DELETE FROM product_type_s_o WHERE ID = $productTypeSOTodelete";
                    $result_delete_type_s_o = mysqli_query($con, $sql_delete_type_s_o);
        
                    if (!$result_delete_type_s_o) {
                       return 3;
                    }
                }
        
                // Delete record from product
                $sql_delete_product = "DELETE FROM product WHERE id = $productId";
                $result_delete_product = mysqli_query($con, $sql_delete_product);
        
                if (!$result_delete_product) {
                  return 4;

                }
        
              return 5;
            } else {
               return 6;
            }
        }
        public function getId() {
            return $this->id; // Return the ID of the product
        }
        public static function getAllProductsbycategory($producttype){
            $con = mysqli_connect("localhost", "root", "", "loulyss");
        
            $sql = "SELECT * FROM product where Product_Type=$producttype";
            
            $result = mysqli_query($con, $sql);
            $products = array();
    
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $product = new Products(
                        $row['id'],
                        $row['name'],
                        $row['image'],
                        $row['Price'],
                        $row['description'],
                        $row['offers'],
                        $row['qty'] 

                    );
                    $products[] = $product;
                }
            }
    
            return $products;
        }
        public static function getAllProducts() {
            $con = mysqli_connect("localhost", "root", "", "loulyss");
        
            $sql = "SELECT * FROM product";
            
            $result = mysqli_query($con, $sql);
            $products = array();
    
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $product = new Products(
                        $row['id'],
                        $row['name'],
                        $row['image'],
                        $row['Price'],
                        $row['description'],
                        $row['offers'],
                        $row['qty'] 

                    );
                    $products[] = $product;
                }
            }
    
            return $products;

    }
         function editproduct($id,$price,$description,$offers,$Product_Type,$qty){
            

                $db_handles = new DBh();
                $db_handle=$db_handles ->connect();
                $check_type_query = "SELECT ID FROM product_type WHERE ID = '$Product_Type'";
                $result = mysqli_query($db_handle, $check_type_query);
                
                if (mysqli_num_rows($result) > 0) {
                    $sql_update = "UPDATE `product` SET 
                                    `price` = '$price',
                                    `description`='$description',
                                    `offers`='$offers',
                                    `Product_Type`='$Product_Type',
                                    `qty`='$qty'
                                    WHERE id = $id";
                
                    $update_result = mysqli_query($db_handle, $sql_update);
                
                    if ($update_result) {
                        // Update successful, now fetch data from product_s_o_v table
                        $sql_select_SO = "SELECT product_type_s_o FROM product_s_o_v WHERE Product_ID = $id";
                        $result_select_SO = mysqli_query($db_handle, $sql_select_SO);
                
                        if ($result_select_SO && mysqli_num_rows($result_select_SO) > 0) {
                            while ($row = mysqli_fetch_assoc($result_select_SO)) {
                                $product_type_s_o_value = $row['product_type_s_o'];
                                
                                // Display each row or specific column(s) from the fetched data
                                echo $product_type_s_o_value . "<br>";
                                
                                // Update the `product_type_s_o` table with the retrieved value
                                $sql_update_SO = "UPDATE `product_type_s_o` SET 
                                                    `Product_Type` = '$Product_Type'
                                                    WHERE Id = $product_type_s_o_value";
                                
                                $update_result_SO = mysqli_query($db_handle, $sql_update_SO);
                                
                                if ($update_result_SO) {
                                    echo "Update successful for product_type_s_o table.";
                                } else {
                                    echo "Error updating product_type_s_o table: " . mysqli_error($db_handle);
                                }
                            }
                        } else {
                            echo "No rows found in product_s_o_v for Product_ID = $id";
                        }}}}
                    
                    
                    function viewallproducts($search){
                        $sql = "SELECT * FROM product WHERE name LIKE '%$search%'";
                        $result = mysqli_query($conn, $sql);
                        return $result;
                    }
                    
                    
                    }        


?>
 