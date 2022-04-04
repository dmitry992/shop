<?php
include "db.php";

if(isset($_POST['product_list'])){
    product_list();
};
if(isset($_POST['add_product'])){
    add_product();
};
if(isset($_POST['get_categories'])){
    get_categories();
}
if(isset($_POST['change_get_categories'])){
    get_categories();
}
if(isset($_POST['get_subcategories'])){
    get_subcategories();
}
if(isset($_POST['change_get_subcategories'])){
    get_subcategories();
}
if(isset($_POST['change_product'])){
    change_product();
}
if(isset($_POST['change_image'])){
    change_image();
}
if(isset($_POST['change_status'])){
    change_status();
}
if(isset($_POST['lunch_menu'])){
    lunch_menu();
}
if(isset($_POST['change_lunch'])){
    change_lunch();
}
if(isset($_POST['lunch_menu_ru'])){
    lunch_menu_ru();
}
if(isset($_POST['lunch_menu_en'])){
    lunch_menu_en();
}






//
//
//
//
//
// Receiving all products
// start
//
//
//
//
//
function product_list(){
    
    global $con;

    $query = "SELECT products.product_id , products.product_show , products.product_title,products.product_desc,products.product_price,products.product_category,
    products.product_subcategory,categories.category_name,subcategories.subcategory_name , products_images.original_name,products_images.unique_name, products_images.image_id, products.product_image, categories.category_id,
    subcategories.subcategory_id
    FROM products 
    INNER JOIN categories ON products.product_category = categories.category_id 
    LEFT JOIN subcategories ON products.product_subcategory = subcategories.subcategory_id 
    INNER JOIN products_images ON products.product_image = products_images.image_id 
    ORDER BY products.product_id ASC";

    $result = mysqli_query($con, $query);

    if($result){

        $html = '';

        while($row = mysqli_fetch_assoc($result)){

            $html .= '<ul class="add-product__row" data-id="'.$row['product_id'].'">
                        <li class="table__row-item--id" data-status="'.$row['product_show'].'" data-name="'.$row['product_title'].'">
                            '.$row['product_id'].'
                            <span class="table__row-item-change"></span>
                        </li>
                        <li class="table__row-item" data-id="'.$row['product_id'].'" data-type="input" data-name="Title">'.$row['product_title'].'</li>
                        <li class="table__row-item" data-id="'.$row['product_id'].'" data-type="textarea" data-name="Description">'.$row['product_desc'].'</li>
                        <li class="table__row-item" data-id="'.$row['product_id'].'" data-type="input" data-name="Price"><span class="row_price">'.str_replace(".", ",", $row["product_price"]).'</span> €</li>
                        <li class="table__row-item" data-id="'.$row['product_id'].'" data-type="select" data-category="main" data-category-id="'.$row['category_id'].'" data-subctg-id="'.$row['subcategory_id'].'">'.$row['category_name'].'</li>
                        <li class="table__row-item" data-id="'.$row['product_id'].'" data-type="select" data-category="sub" data-category-id="'.$row['category_id'].'" data-subctg-id="'.$row['subcategory_id'].'">'.$row['subcategory_name'].'</li>
                        <li class="table__row-item table__row-item--image" data-id="'.$row['image_id'].'" data-type="image" data-img="'.$row['unique_name'].'">'.$row['original_name'].'</li>
                    </ul>';

        }

    }

    echo $html;

}
//
//
//
//
//
// Receiving all products
// finish
//
//
//
//
//









//
//
//
//
//
// Receiving all categories into a category selector to add a product
// start
//
//
//
//
//
function get_categories(){
    
    global $con;

    $query = "SELECT * FROM categories";

    $result = mysqli_query($con, $query);

    if($result){

        $html = '';

        while($row = mysqli_fetch_assoc($result)){

            $html .= '<li class="add-product__select-item add-product__select-ctg" data-id="'.$row['category_id'].'">'.$row['category_name'].'</li>';

        }

    }

    echo $html;

}
//
//
//
//
//
// Receiving all categories into a category selector to add a product
// finish
//
//
//
//
//












//
//
//
//
//
// Retrieving all subcategories by category
// start
//
//
//
//
//
function get_subcategories(){

    global $con;

    if($_POST['get_subcategories']){
        $id = $_POST['get_subcategories'];
    }else{
        $id = $_POST['change_get_subcategories'];
    }
    

    $query = "SELECT * FROM subcategories WHERE main_category = '$id'";

    $result = mysqli_query($con, $query);

    if($result){

        $html = '';

        while($row = mysqli_fetch_assoc($result)){

            $html .= '<li class="add-product__select-item add-product__select-subctg" data-id="'.$row['subcategory_id'].'">'.$row['subcategory_name'].'</li>';

        }

    }

    echo $html;
}
//
//
//
//
//
// Retrieving all subcategories by category
// finish
//
//
//
//
//









//
//
//
//
//
// Adding product
// satrt
//
//
//
//
//
function add_product(){
    
    global $con;

    // Adding image in db
    $file_name = addslashes($_FILES['image']['name']);
    $file_tmp_name = $_FILES['image']['tmp_name'];
    $file_error = $_FILES['image']['error'];

  
    $file_ext = explode('.', $file_name);
    $file_actual_ext = strtolower(end($file_ext));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');
    
    if(in_array($file_actual_ext, $allowed)){

        if($file_error === 0){

            $file_name_new = uniqid('', true).".".$file_actual_ext;

            $file_destination = '../uploaded_images/'.$file_name_new;

            move_uploaded_file($file_tmp_name, $file_destination);

            $query = "INSERT INTO products_images (unique_name,original_name) VALUES ('$file_name_new','$file_name')";

            $result = mysqli_query($con, $query);

            if($result){
               
            }else{
                mysqli_error($con);
            }

        }
    }

    // Adding product in db
    $id_image = mysqli_insert_id($con);
    $title = addslashes($_POST['add_product']);
    $desc = addslashes($_POST['desc']);
    $price = $_POST['price'];
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory']; 

    $query = "INSERT INTO products (product_title,product_desc,product_price,product_category,product_subcategory,product_image,product_show) 
    VALUES ('$title','$desc','$price','$category','$subcategory','$id_image', '1')";

    $result = mysqli_query($con, $query);

    if($result){
        echo 1;
    }else{
        echo mysqli_error($con);
    }
}
//
//
//
//
//
// Adding product
// finish
//
//
//
//
//









//
//
//
//
//
// Remove or return a product
// start
//
//
//
//
//
function change_status(){

    global $con;

    $change_status = $_POST['change_status'];
    $change_status_id = $_POST['change_id'];

    $query = "UPDATE products SET  product_show = '$change_status' WHERE product_id = '$change_status_id'";

    $result = mysqli_query($con, $query);

    if($result){
        echo 1;
    }else{
        mysqli_error($con);
    }
} 
//
//
//
//
//
// Remove or return a product
// finish
//
//
//
//
//









//
//
//
//
//
// Product change
// start
//
//
//
//
//
function change_product(){
    
    global $con;

    $change_product = addslashes($_POST['change_product']);
    $id = $_POST['id'] ;
    $change_column = $_POST['change_column'];
    $query_check = $_POST['query_check'];
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];


    if($query_check == 1){
        $query = "UPDATE products SET $change_column = '$change_product' WHERE product_id = $id";
    }else if($query_check == 2){
        $query = "UPDATE products SET product_category = '$category',product_subcategory = '$subcategory'  WHERE product_id = $id";
    }
    
    $result = mysqli_query($con, $query);

    if($result){
        echo 1;
    }else{
        mysqli_error($con);
    }

}
//
//
//
//
//
// Product change
// finish
//
//
//
//
//









//
//
//
//
//
// Change lunch menu
// start
//
//
//
//
//
function change_lunch(){
    
    global $con;

    $change_product = addslashes($_POST['change_lunch']);
    $id = $_POST['id'] ;
    $change_column = $_POST['change_column'];
    $lng = $_POST['change_lunch_lng'];
    
    if($lng == 'lv'){
        $query = "UPDATE lunch_menu SET $change_column = '$change_product' WHERE lunch_id = $id";
    }else if($lng == 'ru'){
        $query = "UPDATE lunch_menu_ru SET $change_column = '$change_product' WHERE lunch_id = $id";
    }else{
        $query = "UPDATE lunch_menu_en SET $change_column = '$change_product' WHERE lunch_id = $id";
    }


    
    $result = mysqli_query($con, $query);

    if($result){
        echo 1;
    }else{
        echo mysqli_error($con);
    }

}
//
//
//
//
//
// Change lunch menu
// finish
//
//
//
//
//








//
//
//
//
//
// Change product image
// satrt
//
//
//
//
//
function change_image(){
    
    global $con;

    $id = $_POST['id'];

    

    if(!$_POST['change_image'] == 0){

        $past_img = $_POST['past_img'];
        unlink($past_img);

        $file_name = addslashes($_FILES['image']['name']);
        $file_tmp_name = $_FILES['image']['tmp_name'];
        $file_error = $_FILES['image']['error'];
        
        $file_ext = explode('.', $file_name);
        $file_actual_ext = strtolower(end($file_ext));

        $allowed = array('jpg', 'jpeg', 'png', 'pdf');
        
        if(in_array($file_actual_ext, $allowed)){

            if($file_error === 0){

                $file_name_new = uniqid('', true).".".$file_actual_ext;

                $file_destination = '../uploaded_images/'.$file_name_new;

                move_uploaded_file($file_tmp_name, $file_destination);

                

                $query = "UPDATE products_images SET original_name = '$file_name',unique_name = '$file_name_new' WHERE image_id = $id";

                $result = mysqli_query($con, $query);

                if($result){

                }else{
                    echo mysqli_error($con);
                }
                
                
            }
        }

        $result = mysqli_query($con, $query);

        if($result){
            echo 1;
        }else{
            echo mysqli_error($con);
        }
    }else{
        echo 1;
    }

    
}
//
//
//
//
//
// Change product image
// finish
//
//
//
//
//















//
//
//
//
//
// Receiving lunch menu
// start
//
//
//
//
//
function lunch_menu(){
    
    global $con;

    $query = "SELECT * FROM lunch_menu 
    INNER JOIN products_images ON lunch_menu.lunch_image = products_images.image_id";

    // This need translate
    $days_week= ['Monday' => 'Pirmdiena','Tuesday' => 'Otrdiena','Wednesday' => 'Trešdiena','Thursday' => 'Ceturtdiena','Friday' => 'Piektdiena'];
    $day_trns = '';

    $result = mysqli_query($con, $query);

    if($result){

        $html = '';

        while($row = mysqli_fetch_assoc($result)){

            foreach ($days_week as $day => $trns) {
                if ($day == $row['day_week']) {
                    $day_trns = $trns;
                }
            }

            $html .= '<ul class="lunch-menu__row" data-id="'.$row['lunch_id'].'">
                        <li class="lunch__row-item" data-id="'.$row['lunch_id'].'">'.$day_trns.'</li>
                        <li class="lunch__row-item lunch__row-item--change" data-id="'.$row['lunch_id'].'" data-type="input" data-name="Title"  data-language="lv">'.$row['lunch_title'].'</li>
                        <li class="lunch__row-item lunch__row-item--change" data-id="'.$row['lunch_id'].'" data-type="textarea" data-name="Description"  data-language="lv">'.$row['lunch_desc'].'</li>
                        <li class="lunch__row-item lunch__row-item--change" data-id="'.$row['lunch_id'].'" data-type="input" data-name="Price"  data-language="lv"><span class="row_price">'.str_replace(".", ",", $row["lunch_price"]).'</span> €</li>
                        <li class="lunch__row-item lunch__row-item--change" data-id="'.$row['image_id'].'" data-type="image" data-img="'.$row['unique_name'].'"  data-language="lv">'.$row['original_name'].'</li>
                    </ul>';

        }

    }

    echo $html;

}
//
//
//
//
//
// Receiving lunch menu
// finish
//
//
//
//
//









//
//
//
//
//
// Receiving lunch menu ru
// start
//
//
//
//
//
function lunch_menu_ru(){
    
    global $con;

    $query = "SELECT * FROM lunch_menu_ru 
    INNER JOIN products_images ON lunch_menu_ru.lunch_image = products_images.image_id";

    // This need translate
    $days_week= ['Monday' => 'Pirmdiena','Tuesday' => 'Otrdiena','Wednesday' => 'Trešdiena','Thursday' => 'Ceturtdiena','Friday' => 'Piektdiena'];
    $day_trns = '';

    $result = mysqli_query($con, $query);

    if($result){

        $html = '';

        while($row = mysqli_fetch_assoc($result)){

            foreach ($days_week as $day => $trns) {
                if ($day == $row['day_week']) {
                    $day_trns = $trns;
                }
            }

            $html .= '<ul class="lunch-menu__row" data-id="'.$row['lunch_id'].'">
                        <li class="lunch__row-item" data-id="'.$row['lunch_id'].'">'.$day_trns.'</li>
                        <li class="lunch__row-item lunch__row-item--change" data-id="'.$row['lunch_id'].'" data-type="input" data-name="Title" data-language="ru">'.$row['lunch_title'].'</li>
                        <li class="lunch__row-item lunch__row-item--change" data-id="'.$row['lunch_id'].'" data-type="textarea" data-name="Description" data-language="ru">'.$row['lunch_desc'].'</li>
                        <li class="lunch__row-item lunch__row-item--change" data-id="'.$row['lunch_id'].'" data-type="input" data-name="Price" data-language="ru"><span class="row_price">'.str_replace(".", ",", $row["lunch_price"]).'</span> €</li>
                        <li class="lunch__row-item lunch__row-item--change" data-id="'.$row['image_id'].'" data-type="image" data-img="'.$row['unique_name'].'" data-language="ru">'.$row['original_name'].'</li>
                    </ul>';

        }

    }

    echo $html;

}
//
//
//
//
//
// Receiving lunch menu ru
// finish
//
//
//
//
//











//
//
//
//
//
// Receiving lunch menu en
// start
//
//
//
//
//
function lunch_menu_en(){
    
    global $con;

    $query = "SELECT * FROM lunch_menu_en 
    INNER JOIN products_images ON lunch_menu_en.lunch_image = products_images.image_id";

    // This need translate
    $days_week= ['Monday' => 'Pirmdiena','Tuesday' => 'Otrdiena','Wednesday' => 'Trešdiena','Thursday' => 'Ceturtdiena','Friday' => 'Piektdiena'];
    $day_trns = '';

    $result = mysqli_query($con, $query);

    if($result){

        $html = '';

        while($row = mysqli_fetch_assoc($result)){

            foreach ($days_week as $day => $trns) {
                if ($day == $row['day_week']) {
                    $day_trns = $trns;
                }
            }

            $html .= '<ul class="lunch-menu__row" data-id="'.$row['lunch_id'].'">
                        <li class="lunch__row-item" data-id="'.$row['lunch_id'].'">'.$day_trns.'</li>
                        <li class="lunch__row-item lunch__row-item--change" data-id="'.$row['lunch_id'].'" data-type="input" data-name="Title" data-language="en">'.$row['lunch_title'].'</li>
                        <li class="lunch__row-item lunch__row-item--change" data-id="'.$row['lunch_id'].'" data-type="textarea" data-name="Description" data-language="en">'.$row['lunch_desc'].'</li>
                        <li class="lunch__row-item lunch__row-item--change" data-id="'.$row['lunch_id'].'" data-type="input" data-name="Price" data-language="en"><span class="row_price">'.str_replace(".", ",", $row["lunch_price"]).'</span> €</li>
                        <li class="lunch__row-item lunch__row-item--change" data-id="'.$row['image_id'].'" data-type="image" data-img="'.$row['unique_name'].'" data-language="en">'.$row['original_name'].'</li>
                    </ul>';

        }

    }

    echo $html;

}
//
//
//
//
//
// Receiving lunch menu en
// finish
//
//
//
//
//