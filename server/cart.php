<?php
include "db.php";


if( isset($_POST['delete_product']) ){
    delete_product();
}
if( isset($_POST['save_order']) ){
    save_order();
}








//
//
//
//
//
// Delete product from cart list
// start
//
//
//
//
//
function delete_product(){

    $total = 0;
    $delete_id =  $_POST['delete_product'];

    foreach( $_SESSION['cart'] as $key => $value ){
        if($key == $delete_id){
            unset($_SESSION['cart'][$key]);
        }
    }

    foreach( $_SESSION['cart'] as $key => $value ){
        $total = $total + $value['price'];
    }

    if(count($_SESSION['cart']) == 0){
        echo 'empty';
        unset($_SESSION['cart']);
        unset($_SESSION['total_cart']);
    }else{
        echo  $_SESSION['total_cart'] = number_format($total, 2);
    }
      
}
//
//
//
//
//
// Delete product from cart list
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
// Save order
// start
//
//
//
//
//
function save_order(){

    global $con;

    date_default_timezone_set('Europe/Riga');

    $user_id = $_SESSION['user_id'];
    $delivery_address = $_POST['save_order'];
    $total = $_POST['total'];
    $date = date("d.m.Y");
    $time = date("H:i:s");
    $ids_array = explode("|||", $_POST['ids_cart']);
    $ordered_json = $_POST['ordered_products'];
    $check = '';

    if(date("H") >= 11){
        $delivery_date = date("d.m.Y", strtotime("+1 days"));
    }else{
        $delivery_date = date("d.m.Y");
    }

    $comments = $_POST['comments'];


    setcookie("address", $delivery_address, time() + 60 * 60 * 24 * 365, '/');


    


    // Save orders in Russian
    $query = "SELECT * FROM lunch_menu_ru WHERE lunch_id IN (";

    for($i = 0; $i < count($ids_array) - 1; $i++){

        $id_value = $ids_array[$i];

        if(count($ids_array) - 1 == $i + 1){
            $query .= "$id_value)";
        }else{
            $query .= "$id_value,";
        }
    
    }

    $products_array = json_decode($ordered_json, true);

    $result = mysqli_query($con, $query);
    
    if($result){
        
        while($row = mysqli_fetch_assoc($result)){

            foreach ($products_array as $key => $value) {

               if($value['product_id'] == $row['lunch_id']){
                    $products_array[$key]['product_name'] =  $row['lunch_title'];
                    $products_array[$key]['product_day'] =  $row['day_week'];
               }

            }
            
        }

    }else{
        echo mysqli_error($con);
    }

    $products_array = json_encode($products_array, JSON_UNESCAPED_UNICODE);
    $ordered_products =  addslashes($products_array);

    $query = "INSERT INTO orders_ru (user_id,delivery_address,total,order_created_date,order_created_time,delivery_date,product_list,comments,order_finish) 
    VALUES('$user_id','$delivery_address','$total','$date','$time','$delivery_date','$ordered_products','$comments', '0')";

    $result = mysqli_query($con, $query);

    if($result){
        $check = 1;
    }else{
        $check = 0;
        echo mysqli_error($con);
    }



    // Save orders in Latvian
    $query = "SELECT * FROM lunch_menu WHERE lunch_id IN (";

    for($i = 0; $i < count($ids_array) - 1; $i++){

        $id_value = $ids_array[$i];

        if(count($ids_array) - 1 == $i + 1){
            $query .= "$id_value)";
        }else{
            $query .= "$id_value,";
        }
    
    }

    $products_array = json_decode($ordered_json, true);


    $result = mysqli_query($con, $query);
    
    if($result){
        
        while($row = mysqli_fetch_assoc($result)){

            foreach ($products_array as $key => $value) {

               if($value['product_id'] == $row['lunch_id']){
                    $products_array[$key]['product_name'] =  $row['lunch_title'];
                    $products_array[$key]['product_day'] =  $row['day_week'];
               }

            }
            
        }

    }else{
        echo mysqli_error($con);
    }
    
    $products_array = json_encode($products_array, JSON_UNESCAPED_UNICODE);
    $ordered_products =  addslashes($products_array);

    $query = "INSERT INTO orders (user_id,delivery_address,total,order_created_date,order_created_time,delivery_date,product_list,comments,order_finish) 
    VALUES('$user_id','$delivery_address','$total','$date','$time','$delivery_date','$ordered_products','$comments', '0')";

    $result = mysqli_query($con, $query);

    if($result){
        $check = 1;
    }else{
        $check = 0;
        echo mysqli_error($con);
    }





    // Save orders in English
    $query = "SELECT * FROM lunch_menu_en WHERE lunch_id IN (";

    for($i = 0; $i < count($ids_array) - 1; $i++){

        $id_value = $ids_array[$i];

        if(count($ids_array) - 1 == $i + 1){
            $query .= "$id_value)";
        }else{
            $query .= "$id_value,";
        }

    }

    $products_array = json_decode($ordered_json, true);
    $result = mysqli_query($con, $query);

    if($result){
        
        while($row = mysqli_fetch_assoc($result)){

            foreach ($products_array as $key => $value) {

                if($value['product_id'] == $row['lunch_id']){
                    $products_array[$key]['product_name'] =  $row['lunch_title'];
                    $products_array[$key]['product_day'] =  $row['day_week'];
                }

            }
            
        }

    }else{
        echo mysqli_error($con);
    }

    $products_array = json_encode($products_array, JSON_UNESCAPED_UNICODE);
    $ordered_products =  addslashes($products_array);
    
    $query = "INSERT INTO orders_en (user_id,delivery_address,total,order_created_date,order_created_time,delivery_date,product_list,comments,order_finish) 
    VALUES('$user_id','$delivery_address','$total','$date','$time','$delivery_date','$ordered_products','$comments', '0')";

    $result = mysqli_query($con, $query);

    if($result){
        $check = 1;
    }else{
        $check = 0;
        echo mysqli_error($con);
    }

    if($check == 1){
        echo 1;
        unset($_SESSION['cart']);
        unset($_SESSION['total_cart']);
    }

}
//
//
//
//
//
// Save order
// finish
//
//
//
//
//