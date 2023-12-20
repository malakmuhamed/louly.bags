<?php

require_once(__ROOT__ . "view/View.php");

class ViewProduct extends View{
    function addproductform(){
        $str = '<form action="" method="post" enctype="multipart/form-data">
        <input type="text" placeholder="enter product name" name="name" class="box">
        <br />
        <input type="file" accept="image/png, image/jpeg, image/jpg" name="image" class="box" multiple>
        <br />
        <input type="number" placeholder="enter product price" name="Price" class="box">     
        <br />
        <input type="text" placeholder="enter product description" name="description" class="box">
        <br />
        <input type="text" placeholder="offers" name="offers" class="box">   
        <input type="text" placeholder="qty" name="qty" class="box">   
        <label for="product_type">Product Type</label>
        <select id="product_type" name="product_type" class="box" required>
            <option value="1">Cross Bags</option>
            <option value="2">Hand Bags</option>
        </select>
        <br />  

        </select>
        <input type="checkbox" value="1" name="options[]">
        <label for="strap">Strap</label>
        <input type="text" value="" name="options_values[]">
        <br>
        <input type="checkbox" value="2" name="options[]">
        <label for="glossy">Glossy</label>
        <input type="text" value="" name="options_values[]">
        <!-- Your other form fields -->
        <input type="submit" class="btn" name="addproduct" value="Add Product"></form>'; // Added a closing </form> tag and a semicolon here

        return $str;
    }
    function deleteprofuctform(){
        $str = '<form action="" method="POST">
        <div class="form-group">
            <label for="id">Product ID:</label>
            <input type="text" id="id" name="id" required>
        </div>
        <div class="form-group">
            <input type="submit" name="delete" value="Delete Product">
        </div>
    </form>'; // Added a closing </form> tag and a semicolon here

        return $str;
    }
    
    public function output() {
        
        echo $this->addproductform();
    }
    public function getall(){
    
    }
}
