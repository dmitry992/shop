<?php
include "db.php";

if (isset($_POST['get_categories'])) {
    get_categories();
}
// if (isset($_POST['get_products'])) {
//     get_products();
// }
if (isset($_POST['check_cart'])) {
    check_cart();
}
if (isset($_POST['get_cart_info'])) {
    get_cart_info();
}
if (isset($_POST['cart'])) {
    cart();
}
if(isset($_POST['send_category'])) {
    send_category();
}
if(isset($_POST['check_user_fn'])) {
    if(isset($_SESSION['user_id'])){
        echo 1;
    }else{
        echo 2;
    }
}
if(isset($_POST['get_time'])) {
    date_default_timezone_set('Europe/Riga');
    echo date("H");
}








//
//
//
//
//
// Getting all categories
// start
//
//
//
//
//
// function get_categories(){
    
//     global $con;

//     date_default_timezone_set('Europe/Riga');

//     $category = $_SESSION['category'];

//     if($_POST['get_categories'] == '1'){
//         $query = "SELECT * FROM categories";
//     }else if($_POST['get_categories'] == '2'){
//         $query = "SELECT subcategories.subcategory_id, subcategories.subcategory_name, subcategories.main_category , categories.category_name
//         FROM subcategories
//         INNER JOIN categories ON subcategories.main_category = categories.category_id 
//         WHERE main_category = ".$category."";
        
//     }

//     $result = mysqli_query($con, $query);

//     $html = '';
    
//     $count = 1;
    
//     if($result){
        
//         $response = array();

//         while($row = mysqli_fetch_assoc($result)){
            
//             if($_POST['get_categories'] == '1'){
//                 if($count == 1){
//                     if(date("H") < 11){
//                         $html .= '<div class="wrapper__content-item" style="display:block;">
//                                     <div class="wrapper__slider swiper-container swiper-container--lunch">

//                                         <div class="wrapper__content-top wrapper__content-top--lunch">
//                                             <h3 class="wrapper__content-title title">
//                                                 '.$row['category_name'].'
//                                             </h3>
//                                             <a class="wrapper__menu-lunch" data-category="'.$row['category_id'].'">
//                                                 View weeks menu
//                                             </a>
//                                         </div>
                                        

//                                         <div class="wrapper__slider-content swiper-wrapper wrapper__slider-content--lunch" data-category="'.$row['category_id'].'">
                                        
//                                         </div>
//                                     </div>
//                                 </div>';
//                     }else{
//                         $html .= '<div class="wrapper__content-item" style="display:block;">
//                                     <div class="wrapper__slider swiper-container swiper-container--lunch">

//                                         <div class="wrapper__content-top wrapper__content-top--lunch">
//                                             <h3 class="wrapper__content-title title">
//                                                 '.$row['category_name'].'
//                                             </h3>
//                                             <a class="wrapper__menu-lunch" data-category="'.$row['category_id'].'">
//                                                 View weeks menu
//                                             </a>
//                                         </div>

//                                         <p class="wrapper__content-text" id="timer_text">
//                                             You can order for tomorrow
//                                         </p>
                                        
//                                         <p class="wrapper__content-timer">
//                                             <span id="timer_hours" style="display:none">'.date("H").' :</span>
//                                             <span id="timer_minutes" style="display:none">'.date("i").' :</span>
//                                             <span id="timer_seconds" style="display:none">'.date("s").'</span>
//                                         </p>

//                                         <div class="wrapper__slider-content swiper-wrapper wrapper__slider-content--lunch" data-category="'.$row['category_id'].'">
                                        
//                                         </div>
//                                     </div>
//                                 </div>';
//                     }

//                 }else{
                    
//                     $html .= '<div class="wrapper__content-item">
//                                 <div class="wrapper__slider swiper-container">

//                                     <div class="wrapper__content-top">
//                                         <h3 class="wrapper__content-title title">
//                                             '.$row['category_name'].'
//                                         </h3>
//                                         <a class="wrapper__content-all" data-category="'.$row['category_id'].'">
//                                             View all
//                                         </a>
//                                     </div>

//                                     <div class="wrapper__slider-content swiper-wrapper" data-category="'.$row['category_id'].'">
                                        
//                                     </div>
//                                 </div>
//                             </div>';
//                 }

//                 ++$count; 
                
//             }else if($_POST['get_categories'] == '2'){
//                 $response[] = [
//                     "wrapper_category" => '<div class="all-product__category" id="subcategory'.$count.'">
//                                             <h2 class="all-product__category-title title">'.$row['subcategory_name'].'</h2>
//                                             <div class="all-product__category-inner" data-subcategory="'.$row['subcategory_id'].'"></div>
//                                         </div>',
//                     "subcategories" =>  $row['subcategory_name'],   
//                     "category" =>  $row['category_name'],              
//                     ];
//                     ++$count;
//             }
            
            
//         }

//         $response = json_encode($response);

//         if($_POST['get_categories'] == '1'){
//             echo $html;
//         }else if($_POST['get_categories'] == '2'){
//             echo $response;
//         }
        
        
//     }else{
//         echo mysqli_error($con);
//     }

// };
//
//
//
//
//
// Getting all categories
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
// Getting all categories
// start
//
//
//
//
//
function get_categories(){
    
    global $con;

    date_default_timezone_set('Europe/Riga');

    $date_obj = date('H:i:sP');


    $lng = $_SESSION['lng'];
    $path_img = '';

    if($lng == 'lv'){
        $query = "SELECT * FROM lunch_menu
        INNER JOIN products_images ON lunch_menu.lunch_image = products_images.image_id";
        $path_img = '';
    }else if($lng == 'ru'){
        $query = "SELECT * FROM lunch_menu_ru
        INNER JOIN products_images ON lunch_menu_ru.lunch_image = products_images.image_id";
        $path_img = '../';
    }else{
        $query = "SELECT * FROM lunch_menu_en
        INNER JOIN products_images ON lunch_menu_en.lunch_image = products_images.image_id";
        $path_img = '../';
    }

    // This need translate
    $days_week_lv = ['Monday' => 'Pirmdiena','Tuesday' => 'Otrdiena','Wednesday' => 'Trešdiena','Thursday' => 'Ceturtdiena','Friday' => 'Piektdiena'];
    $days_week_ru = ['Monday' => 'Понедельник','Tuesday' => 'Вторник','Wednesday' => 'Среда','Thursday' => 'Четверг','Friday' => 'Пятница'];
    $days_week_en = ['Monday' => 'Monday','Tuesday' => 'Tuesday','Wednesday' => 'Wednesday','Thursday' => 'Thursday','Friday' => 'Friday'];

    $day_trns = '';
    $lunch = '';
    $lunch_word = '';
    $count = 1;

    $result = mysqli_query($con, $query);

    if($result){

        while($row = mysqli_fetch_assoc($result)){

            if($lng == 'lv'){
                foreach ($days_week_lv as $key => $value) {
                    if ($key == $row['day_week']) {
                        $day_trns = $value;
                    }
                }
                // This need translate
                $lunch_word = 'Lunch';

            }else if($lng == 'ru'){
                foreach ($days_week_ru as $key => $value) {
                    if ($key == $row['day_week']) {
                        $day_trns = $value;
                    }
                }
                
                $lunch_word = 'Обед';

            }else{
                foreach ($days_week_en as $key => $value) {
                    if ($key == $row['day_week']) {
                        $day_trns = $value;
                    }
                }

                $lunch_word = 'Lunch';
                
            }

            if($row['lunch_unavailable'] == 1){
                $lunch .= 
                    '<div class="wrapper__slider-item swiper-slide wrapper__slider-item--no_access product__item--lunch" data-id="'.$row['lunch_id'].'" data-day="'.$count.'">
                        <div class="no_access"></div>
                        <p class="wrapper__content-timer">
                            <span id="timer_hours">'.date("H").' :</span>
                            <span id="timer_minutes">'.date("i").' :</span>
                            <span id="timer_seconds">'.date("s").'</span>
                        </p>
                        <div class="wrapper__slider-img">
                            <img class="product_img" src="'.$path_img.'uploaded_images/'.$row['unique_name'].'">
                        </div>
                        <h6 class="wrapper__slider-price price__items">
                            ' . str_replace('.', ',', $row['lunch_price']).' €
                        </h6>
                        <h6 class="wrapper__slider-title product__title">
                            '.$row['lunch_title'].'
                        </h6>
                        <div class="product_desc">'.$row['lunch_desc'].'</div>
                        <span class="product__item-quantity"></span>
                        <div class="product__item-day">
                            '.$day_trns.'
                        </div>
                    </div>';
            }else{

                if(date('N') > $count){
                
                    $lunch .= 
                    '<div class="wrapper__slider-item swiper-slide wrapper__slider-item--no_access product__item--lunch" data-id="'.$row['lunch_id'].'" data-day="'.$count.'">
                        <div class="no_access"></div>
                        <p class="wrapper__content-timer">
                            <span id="timer_hours">'.date("H").' :</span>
                            <span id="timer_minutes">'.date("i").' :</span>
                            <span id="timer_seconds">'.date("s").'</span>
                        </p>
                        <div class="wrapper__slider-img">
                            <img class="product_img" src="'.$path_img.'uploaded_images/'.$row['unique_name'].'">
                        </div>
                        <h6 class="wrapper__slider-price price__items">
                            ' . str_replace('.', ',', $row['lunch_price']).' €
                        </h6>
                        <h6 class="wrapper__slider-title product__title">
                            '.$row['lunch_title'].'
                        </h6>
                        <div class="product_desc">'.$row['lunch_desc'].'</div>
                        <span class="product__item-quantity"></span>
                        <div class="product__item-day">
                            '.$day_trns.'
                        </div>
                    </div>';
                
            }else{

                if(date('H') < 11){

                    if(date('N') == $count){

                            $lunch .= 
                                '<div class="wrapper__slider-item swiper-slide product__item product__item--lunch product__item-active" data-id="'.$row['lunch_id'].'" data-day="'.$count.'">
                                    <p class="wrapper__content-timer">
                                        <span id="timer_hours">'.date("H").' :</span>
                                        <span id="timer_minutes">'.date("i").' :</span>
                                        <span id="timer_seconds">'.date("s").'</span>
                                    </p>
                                    <div class="wrapper__slider-img">
                                        <img class="product_img" src="'.$path_img.'uploaded_images/'.$row['unique_name'].'">
                                    </div>
                                    <h6 class="wrapper__slider-price price__items">
                                        ' . str_replace('.', ',', $row['lunch_price']).' €
                                    </h6>
                                    <h6 class="wrapper__slider-title product__title">
                                        '.$row['lunch_title'].'
                                    </h6>
                                    <div class="product_desc">'.$row['lunch_desc'].'</div>
                                    <span class="product__item-quantity"></span>
                                    <div class="product__item-day">
                                        '.$day_trns.'
                                    </div>
                                </div>';
                        }else{
                            $lunch .= 
                            '<div class="wrapper__slider-item swiper-slide product__item product__item--lunch" data-id="'.$row['lunch_id'].'" data-day="'.$count.'">
                                <p class="wrapper__content-timer">
                                    <span id="timer_hours">'.date("H").' :</span>
                                    <span id="timer_minutes">'.date("i").' :</span>
                                    <span id="timer_seconds">'.date("s").'</span>
                                </p>
                                <div class="wrapper__slider-img">
                                    <img class="product_img" src="'.$path_img.'uploaded_images/'.$row['unique_name'].'">
                                </div>
                                <h6 class="wrapper__slider-price price__items">
                                    ' . str_replace('.', ',', $row['lunch_price']).' €
                                </h6>
                                <h6 class="wrapper__slider-title product__title">
                                    '.$row['lunch_title'].'
                                </h6>
                                <div class="product_desc">'.$row['lunch_desc'].'</div>
                                <span class="product__item-quantity"></span>
                                <div class="product__item-day">
                                    '.$day_trns.'
                                </div>
                            </div>';
                        }

                }else{
                    if(date('N', strtotime('+1 days')) == $count){

                        $lunch .= 
                                    '<div class="wrapper__slider-item swiper-slide product__item product__item--lunch product__item-active" data-id="'.$row['lunch_id'].'" data-day="'.$count.'">
                                        <p class="wrapper__content-timer">
                                            <span id="timer_hours">'.date("H").' :</span>
                                            <span id="timer_minutes">'.date("i").' :</span>
                                            <span id="timer_seconds">'.date("s").'</span>
                                        </p>
                                        <div class="wrapper__slider-img">
                                            <img class="product_img" src="'.$path_img.'uploaded_images/'.$row['unique_name'].'">
                                        </div>
                                        <h6 class="wrapper__slider-price price__items">
                                            ' . str_replace('.', ',', $row['lunch_price']).' €
                                        </h6>
                                        <h6 class="wrapper__slider-title product__title">
                                            '.$row['lunch_title'].'
                                        </h6>
                                        <div class="product_desc">'.$row['lunch_desc'].'</div>
                                        <span class="product__item-quantity"></span>
                                        <div class="product__item-day">
                                            '.$day_trns.'
                                        </div>
                                    </div>';
                    }else if(date('N') == $count){
                        $lunch .= 
                            '<div class="wrapper__slider-item swiper-slide wrapper__slider-item--no_access product__item--lunch" data-id="'.$row['lunch_id'].'" data-day="'.$count.'">
                                <div class="no_access"></div>
                                <p class="wrapper__content-timer">
                                    <span id="timer_hours">'.date("H").' :</span>
                                    <span id="timer_minutes">'.date("i").' :</span>
                                    <span id="timer_seconds">'.date("s").'</span>
                                </p>
                                <div class="wrapper__slider-img">
                                    <img class="product_img" src="'.$path_img.'uploaded_images/'.$row['unique_name'].'">
                                </div>
                                <h6 class="wrapper__slider-price price__items">
                                    ' . str_replace('.', ',', $row['lunch_price']).' €
                                </h6>
                                <h6 class="wrapper__slider-title product__title">
                                    '.$row['lunch_title'].'
                                </h6>
                                <div class="product_desc">'.$row['lunch_desc'].'</div>
                                <span class="product__item-quantity"></span>
                                <div class="product__item-day">
                                    '.$day_trns.'
                                </div>
                            </div>';
                        }else{
                            $lunch .= 
                            '<div class="wrapper__slider-item swiper-slide product__item product__item--lunch" data-id="'.$row['lunch_id'].'" data-day="'.$count.'">
                                <p class="wrapper__content-timer">
                                    <span id="timer_hours">'.date("H").' :</span>
                                    <span id="timer_minutes">'.date("i").' :</span>
                                    <span id="timer_seconds">'.date("s").'</span>
                                </p>
                                <div class="wrapper__slider-img">
                                    <img class="product_img" src="'.$path_img.'uploaded_images/'.$row['unique_name'].'">
                                </div>
                                <h6 class="wrapper__slider-price price__items">
                                    ' . str_replace('.', ',', $row['lunch_price']).' €
                                </h6>
                                <h6 class="wrapper__slider-title product__title">
                                    '.$row['lunch_title'].'
                                </h6>
                                <div class="product_desc">'.$row['lunch_desc'].'</div>
                                <span class="product__item-quantity"></span>
                                <div class="product__item-day">
                                    '.$day_trns.'
                                </div>
                            </div>';
                        }

                    }

                }
            }

            $count++;         
                        
        };

    }else{
        echo mysqli_error($con);
    }

    $html = '<div class="wrapper__content-item" style="display:block;">

                <div class="wrapper__slider swiper-container swiper-container--lunch">

                <div class="wrapper__content-top wrapper__content-top--lunch">
                    <h3 class="wrapper__content-title title">
                        '.$lunch_word.'
                    </h3>
                </div>



                <div class="swiper-wrapper wrapper__slider-content--lunch">
                    '.$lunch.'
                </div>

            </div>

        </div>';

    // $category = $_SESSION['category'];

    // if($_POST['get_categories'] == '1'){
    //     $query = "SELECT * FROM categories";
    // }else if($_POST['get_categories'] == '2'){
    //     $query = "SELECT subcategories.subcategory_id, subcategories.subcategory_name, subcategories.main_category , categories.category_name
    //     FROM subcategories
    //     INNER JOIN categories ON subcategories.main_category = categories.category_id 
    //     WHERE main_category = ".$category."";
        
    // }

    // $result = mysqli_query($con, $query);
    
    // $count = 1;
    
    // if($result){
        
        $response = array();

    //     while($row = mysqli_fetch_assoc($result)){
            
    //         if($_POST['get_categories'] == '1'){
    //             if($count == 1){
    //                 if(date("H") < 11){
    //                     $html .= '<div class="wrapper__content-item" style="display:block;">
    //                                 <div class="wrapper__slider swiper-container swiper-container--lunch">

    //                                     <div class="wrapper__content-top wrapper__content-top--lunch">
    //                                         <h3 class="wrapper__content-title title">
    //                                             '.$row['category_name'].'
    //                                         </h3>
    //                                         <a class="wrapper__menu-lunch" data-category="'.$row['category_id'].'">
    //                                             View weeks menu
    //                                         </a>
    //                                     </div>
                                        
                                        


    //                                     <div class="wrapper__slider-content swiper-wrapper wrapper__slider-content--lunch" data-category="'.$row['category_id'].'">
                                        
    //                                     </div>
    //                                 </div>
    //                             </div>';
    //                 }else{
    //                     $html .= '<div class="wrapper__content-item" style="display:block;">
    //                                 <div class="wrapper__slider swiper-container swiper-container--lunch">

    //                                     <div class="wrapper__content-top wrapper__content-top--lunch">
    //                                         <h3 class="wrapper__content-title title">
    //                                             '.$row['category_name'].'
    //                                         </h3>
    //                                         <a class="wrapper__menu-lunch" data-category="'.$row['category_id'].'">
    //                                             View weeks menu
    //                                         </a>
    //                                     </div>

    //                                     <p class="wrapper__content-text" id="timer_text">
    //                                         You can order for tomorrow
    //                                     </p>
                                        
    //                                     <p class="wrapper__content-timer">
    //                                         <span id="timer_hours" style="display:none">'.date("H").' :</span>
    //                                         <span id="timer_minutes" style="display:none">'.date("i").' :</span>
    //                                         <span id="timer_seconds" style="display:none">'.date("s").'</span>
    //                                     </p>

    //                                     <div class="wrapper__slider-content swiper-wrapper wrapper__slider-content--lunch" data-category="'.$row['category_id'].'">
                                        
    //                                     </div>
    //                                 </div>
    //                             </div>';
    //                 }

    //             }else{
                    
    //                 $html .= '<div class="wrapper__content-item" style="display:block;">
    //                             <div class="wrapper__slider swiper-container">

    //                                 <div class="wrapper__content-top">
    //                                     <h3 class="wrapper__content-title title">
    //                                         '.$row['category_name'].'
    //                                     </h3>
    //                                     <a class="wrapper__content-all" data-category="'.$row['category_id'].'">
    //                                         View all
    //                                     </a>
    //                                 </div>

    //                                 <div class="wrapper__slider-content swiper-wrapper" data-category="'.$row['category_id'].'">
                                        
    //                                 </div>
    //                             </div>
    //                         </div>';
    //             }

    //             ++$count; 
                
    //         }else if($_POST['get_categories'] == '2'){
    //             $response[] = [
    //                 "wrapper_category" => '<div class="all-product__category" id="subcategory'.$count.'">
    //                                         <h2 class="all-product__category-title title">'.$row['subcategory_name'].'</h2>
    //                                         <div class="all-product__category-inner" data-subcategory="'.$row['subcategory_id'].'"></div>
    //                                     </div>',
    //                 "subcategories" =>  $row['subcategory_name'],   
    //                 "category" =>  $row['category_name'],              
    //                 ];
    //                 ++$count;
    //         }
            
            
    //     }

        $response = json_encode($response);

        if($_POST['get_categories'] == '1'){
            echo $html;
        }else if($_POST['get_categories'] == '2'){
            echo $response;
        }
        
        
    

};
//
//
//
//
//
// Getting all categories
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
// Getting all products 
// start
//
//
//
//
//
// function get_products(){

//     global $con;

//     $ids_string = $_POST['ids'];

//     $ids_array = explode("|||", $ids_string);

//     if($_POST['get_products'] == 1){

//         $query = "SELECT *, products_images.unique_name 
//         FROM products 
//         INNER JOIN products_images ON products.product_image = products_images.image_id WHERE ";

//         for($i = 0; $i < count($ids_array) - 1; $i++){
          
//             $id_value = $ids_array[$i]; 
            
//             if($i == 0){
//                 $query .= "(product_category = '$id_value' OR ";
//             }else{
//                 if(count($ids_array) - 1 == $i + 1){
//                     $query .= "product_category = '$id_value') AND (product_show = 1) ORDER BY products.product_id ASC";
//                 }else{
//                     $query .= "product_category = '$id_value' OR ";
//                 }
//             }
                
            
            
            
//         }
       
//     }else if($_POST['get_products'] == 2){
       
//         $query = "SELECT *, products_images.unique_name 
//         FROM products 
//         INNER JOIN products_images ON products.product_image = products_images.image_id WHERE ";

//         for($i = 0; $i < count($ids_array) - 1; $i++){
    
//             $id_value = $ids_array[$i]; 

//             if($i == 0){
//                 $query .= "(product_subcategory = '$id_value' OR ";
//             }else{
//                 if(count($ids_array) - 1 == $i + 1){
//                     $query .= "product_subcategory = '$id_value') AND (product_show = 1)";
//                 }else{
//                     $query .= "product_subcategory = '$id_value' OR ";
//                 }
//             }
            
            
//         }
//     }

//     $count = 0;
//     $array_days = ['Monday','Tuesday','Wednesday','Thursday','Friday'];

//     $result = mysqli_query($con, $query);

//     if($result){

//         $response = array();

//         while($row = mysqli_fetch_assoc($result)){
   
//             for($i = 0; $i < count($row); $i++){

//                 if($_POST['get_products'] == 1){

//                     if($row['product_category'] == $ids_array[$i]){

//                         if($row['product_category'] == 1){

//                             if(date('l') == $array_days[$count]){
                                
//                                 array_push($response, 
//                                 array(
//                                     "product_index" => $ids_array[$i],
//                                     "products" => ' <div class="wrapper__slider-item swiper-slide product__item product__item-active" data-id="'.$row['product_id'].'" data-category="'.$row['product_category'].'">
//                                                         <div class="wrapper__slider-img">
//                                                             <img class="product_img" src="uploaded_images/'.$row['unique_name'].'">
//                                                         </div>
//                                                         <h6 class="wrapper__slider-price price__items">
//                                                             ' . str_replace('.', ',', $row['product_price']).' €
//                                                         </h6>
//                                                         <h6 class="wrapper__slider-title product__title">
//                                                             '.$row['product_title'].'
//                                                         </h6>
//                                                         <div class="product_desc">'.$row['product_desc'].'</div>
//                                                         <span class="product__item-quantity"></span>
//                                                         <div class="product__item-day">
//                                                             '.$array_days[$count].'
//                                                         </div>
//                                                     </div>',
//                                     )
//                                 );      

//                             }else{
                                
//                                 $day_number = date('N') - 1;
                                
//                                 if($day_number > $count){
//                                         array_push($response, 
//                                         array(
//                                             "product_index" => $ids_array[$i],
//                                             "products" => ' <div class="wrapper__slider-item swiper-slide wrapper__slider-item--no_access" data-id="'.$row['product_id'].'" data-category="'.$row['product_category'].'">
//                                                             <div class="no_access"></div>    
//                                                             <div class="wrapper__slider-img">
//                                                                     <img class="product_img" src="uploaded_images/'.$row['unique_name'].'">
//                                                                 </div>
//                                                                 <h6 class="wrapper__slider-price price__items">
//                                                                     ' . str_replace('.', ',', $row['product_price']).' €
//                                                                 </h6>
//                                                                 <h6 class="wrapper__slider-title product__title">
//                                                                     '.$row['product_title'].'
//                                                                 </h6>
//                                                                 <div class="product_desc">'.$row['product_desc'].'</div>
//                                                                 <span class="product__item-quantity"></span>
//                                                                 <div class="product__item-day">
//                                                                     '.$array_days[$count].'
//                                                                 </div>
//                                                             </div>',
//                                             )
//                                         );
//                                 }else{
//                                     array_push($response, 
//                                     array(
//                                         "product_index" => $ids_array[$i],
//                                         "products" => '<div class="wrapper__slider-item swiper-slide product__item" data-id="'.$row['product_id'].'" data-category="'.$row['product_category'].'">
//                                                             <div class="wrapper__slider-img">
//                                                                 <img class="product_img" src="uploaded_images/'.$row['unique_name'].'">
//                                                             </div>
//                                                             <h6 class="wrapper__slider-price price__items">
//                                                                 ' . str_replace('.', ',', $row['product_price']).' €
//                                                             </h6>
//                                                             <h6 class="wrapper__slider-title product__title">
//                                                                 '.$row['product_title'].'
//                                                             </h6>
//                                                             <div class="product_desc">'.$row['product_desc'].'</div>
//                                                             <span class="product__item-quantity"></span>
//                                                             <div class="product__item-day">
//                                                                 '.$array_days[$count].'
//                                                             </div>
//                                                         </div>',
//                                         )
//                                     );
//                                 }

//                             }
//                             $count++;
//                         }else{
//                                 array_push($response, 
//                                 array(
//                                     "product_index" => $ids_array[$i],
//                                     "products" => ' <div class="wrapper__slider-item swiper-slide product__item" data-id="'.$row['product_id'].'" data-category="'.$row['product_category'].'">
//                                                         <div class="wrapper__slider-img">
//                                                             <img class="product_img" src="uploaded_images/'.$row['unique_name'].'">
//                                                         </div>
//                                                         <h6 class="wrapper__slider-price price__items">
//                                                             ' . str_replace('.', ',', $row['product_price']).' €
//                                                         </h6>
//                                                         <h6 class="wrapper__slider-title product__title">
//                                                             '.$row['product_title'].'
//                                                         </h6>
//                                                         <div class="product_desc">'.$row['product_desc'].'</div>
//                                                         <span class="product__item-quantity"></span>
//                                                         </div>',
//                                     )
//                                 );

//                         }
                        

//                     }
                    
                    
//                 }
//                 else if($_POST['get_products'] == 2){
//                     if($row['product_subcategory'] == $ids_array[$i]){
//                         array_push($response, 
//                             array(
//                                 "product_index" => $ids_array[$i],
//                                 "products" => '<div class="all-product__category-item product__item" data-id="'.$row['product_id'].'">
//                                                     <div class="all-product__category-img">
//                                                         <img class="product_img" src="uploaded_images/'.$row['unique_name'].'">
//                                                     </div>
//                                                     <h6 class="price__items">
//                                                     ' . str_replace('.', ',', $row['product_price']).' €
//                                                     </h6>
//                                                     <p class="all-product__item-title product__title">
//                                                         '.$row['product_title'].'
//                                                     </p>
//                                                     <div class="product_desc">'.$row['product_desc'].'</div>
//                                                     <span class="product__item-quantity"></span>
// 							                    </div>',
//                             )
//                         );
//                     }
//                 }

                
//             }

//         }
        
        
//         $response = json_encode($response);
//         echo $response;
//     }else{
//         echo mysqli_error($con);
//     }
// }
//
//
//
//
//
// Getting all products 
// finish
//
//
//
//
//









// Session start check
function check_cart(){

    if (isset($_SESSION['total_cart'])) {
        echo 1;
    }
}









//
//
//
//
//
// Category record for which products will be received for "all_products.php"
// start
//
//
//
//
//
function send_category(){

    if (!isset($_SESSION['category'])) {
        $_SESSION['category'];
    }
    $_SESSION['category'] = $_POST['send_category'];

}
//
//
//
//
//
// Category record for which products will be received for "all_products.php"
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
// Adding product item in cart list
// start
//
//
//
//
//
function cart(){

    global $con;

    $id = $_POST['cart'];
    $count = $_POST['quantity'];
    $price = $_POST['price'];
    $total = 0;
    $lng = $_SESSION['lng'];
    $today = '';
    $tomorrow = '';
    $path_img = '';
    

    // This need translate
    $days_week_lv = ['Monday' => 'Pirmdiena','Tuesday' => 'Otrdiena','Wednesday' => 'Trešdiena','Thursday' => 'Ceturtdiena','Friday' => 'Piektdiena'];
    $days_week_ru = ['Monday' => 'Понедельник','Tuesday' => 'Вторник','Wednesday' => 'Среда','Thursday' => 'Четверг','Friday' => 'Пятница'];
    $days_week_en = ['Monday' => 'Monday','Tuesday' => 'Tuesday','Wednesday' => 'Wednesday','Thursday' => 'Thursday','Friday' => 'Friday'];

    // Start sessions
    if ($id !== null) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['total_cart'];
            $_SESSION['cart'][$id] = [];
        }
    }

    // Adding a product to the session array
    if ($id !== null) {

         if (isset($_SESSION['cart'])) {
            $_SESSION['cart'][$id] = array('quantity' => $count,'price' => $price);
        }
        
        ksort($_SESSION['cart']);

    }

    foreach ($_SESSION['cart'] as $key => $value) {

        if ($_POST['check_session'] == 1) {
            $total = $total + $value['price'];
        }
    
    }

    if ($_POST['check_session'] == 1) {
        echo $_SESSION['total_cart'] = number_format($total, 2);
    }
    
    // Loading from the database the name and price of the product by id in product db
    // if ($id !== null) {
    //     $query = "SELECT *, products_images.unique_name 
    //     FROM products 
    //     INNER JOIN products_images ON products.product_image = products_images.image_id WHERE product_id = $id";

    //     $result = mysqli_query($con, $query);

    //     $title = '';

    //     if ($result) {
    //         $row = mysqli_fetch_assoc($result);
    //         $title = $row['product_title'];
    //         $product_price = str_replace(',', '.', $row['product_price']);
    //         $product_img = $row['unique_name'];
    //         $product_desc = $row['product_desc'];
    //     } else {
    //         echo mysqli_error($con);
    //     }
    // }

    // Loading from the database the name and price of the product by id in product db
    
    if ($id == null) {

        $end = end(array_keys($_SESSION['cart']));
        
        if($lng == 'lv'){
            $query = "SELECT *
            FROM lunch_menu 
            INNER JOIN products_images ON lunch_menu.lunch_image = products_images.image_id WHERE lunch_id IN (";

            foreach ($_SESSION['cart'] as $key => $value) {

                if($end == $key){
                    $query .= "$key);";
                }else{
                    $query .= "$key,";
                }

            }

            // This need translate
            $today = 'Šodien';
            $tomorrow = 'Rīt';

            $path_img = '';

        }else if($lng == 'ru'){
            $query = "SELECT *
            FROM lunch_menu_ru 
            INNER JOIN products_images ON lunch_menu_ru.lunch_image = products_images.image_id WHERE lunch_id IN (";

            foreach ($_SESSION['cart'] as $key => $value) {

                if($end == $key){
                    $query .= "$key);";
                }else{
                    $query .= "$key,";
                }

            }
            
            $today = 'Сегодня';
            $tomorrow = 'Завтра';

            $path_img = '../';

        }else{
            $query = "SELECT *
            FROM lunch_menu_en 
            INNER JOIN products_images ON lunch_menu_en.lunch_image = products_images.image_id WHERE lunch_id IN (";

            foreach ($_SESSION['cart'] as $key => $value) {

                if($end == $key){
                    $query .= "$key);";
                }else{
                    $query .= "$key,";
                }

            }

            $today = 'Today';
            $tomorrow = 'Tomorrow';

            $path_img = '../';

        }
        
        $result = mysqli_query($con, $query);

        if ($result) {

            while($row = mysqli_fetch_assoc($result)){

                $id = $row['lunch_id'];
                $price_product = $row['lunch_price'];
                $title = $row['lunch_title'];
                $product_img = $row['unique_name'];
                $product_desc = $row['lunch_desc'];
                $day = $row['day_week'];
                $quantity = $_SESSION['cart'][$id]['quantity'];
                $price = $_SESSION['cart'][$id]['price'];
                $day_trns = '';

                if($day == 'Monday'){
                    $time = strtotime('this week Monday');
                    $date = date('d.m.Y', $time);
                }else if($day == 'Tuesday'){
                    $time = strtotime('this week Tuesday');
                    $date = date('d.m.Y', $time);
                }else if($day == 'Wednesday'){
                    $time = strtotime('this week Wednesday');
                    $date = date('d.m.Y', $time);
                }else if($day == 'Thursday'){
                    $time = strtotime('this week Thursday');
                    $date = date('d.m.Y', $time);
                }else if($day == 'Friday'){
                    $time = strtotime('this week Friday');
                    $date = date('d.m.Y', $time);
                }

                if($lng == 'lv'){
                    foreach ($days_week_lv as $key => $value) {
                        if ($key == $day) {
                            $day_trns = $value;
                        }
                    }
                }else if($lng == 'ru'){
                    foreach ($days_week_ru as $key => $value) {
                        if ($key == $day) {
                            $day_trns = $value;
                        }
                    }
                }else{
                    foreach ($days_week_en as $key => $value) {
                        if ($key == $day) {
                            $day_trns = $value;
                        }
                    }
                }

                echo
                    '<li class="cart__content-item">
                        <div class="cart__item-wrapper" data-id="' . $id . '" data-price="' . $price_product . '" data-img="'.$path_img.'uploaded_images/'.$product_img.'" data-desc="'.$product_desc.'" data-date="'.$date.'"> 
                            <p class="cart__item-quantity"><span id="cart_quantity">' . $quantity . '</span>x</p>
                            <h6 class="cart__item-name">
                                ' . $title . '
                            </h6>
                            <p class="cart__item-price price__items"><span id="cart_price">' . str_replace('.', ',', $price) . '</span> €</p>';
                            if(date('l') ==  $day){
                                echo '<p class="cart__item-day">
                                        <span id="cart_day">'.$today.'</span>
                                      </p>';
                            }else if(date('l', strtotime('+1 days')) ==  $day){
                                echo '<p class="cart__item-day">
                                        <span id="cart_day">'.$tomorrow.'</span>
                                    </p>';
                            }else{
                                echo '<p class="cart__item-day">
                                        <span id="cart_day">'.$day_trns.'</span>
                                    </p>';
                            }
                        echo '    
                        </div>
                        <span class="cart__item-edit"><img src="'.$path_img.'images/pencil.png"></span>                   
                        <span class="cart__item-delete"><img src="'.$path_img.'images/delete.png"></span>   
                    </li>';
            }

        } else {
            echo mysqli_error($con);
        }
        
    }

//     if ($id == null) {
//         if (isset($_SESSION['cart'])) {
//            $_SESSION['cart'][$id] = array('title' => $title, 'product_price' => $product_price, 'product_img' => $product_img, 'product_desc' => $product_desc, 'product_day' => $day, 'product_date' => $date);
//        }
//        ksort($_SESSION['cart']);
//    }
   



    // Building a list of the basket and the total amount in product db
    // if (isset($_SESSION['cart'])) {
    //     if (count($_SESSION['cart']) !== 0) {
    //         foreach ($_SESSION['cart'] as $key => $value) {
    //             if ($_POST['check_session'] == 1) {
    //                 $total = $total + $value['price'];
    //             }else {
    //                 echo
    //                 '<li class="cart__content-item">
    //                     <div class="cart__item-wrapper" data-id="' . $key . '" data-price="' . $value['product_price'] . '" data-img="uploaded_images/'.$value['product_img'].'" data-desc="'.$value['product_desc'].'"> 
    //                         <p class="cart__item-quantity"><span id="cart_quantity">' . $value['quantity'] . '</span>x</p>
    //                         <h6 class="cart__item-name">
    //                             ' . $value['title'] . '
    //                         </h6>
    //                         <p class="cart__item-price price__items"><span id="cart_price">' . str_replace('.', ',', $value['price']) . '</span> €</p>';
    //                         if(date('l') ==  $value['product_day']){
    //                             echo '<p class="cart__item-day">
    //                                     <span id="cart_day">Today</span>
    //                                   </p>';
    //                         }else if(date('l', strtotime("+1 days"))==  $value['product_day']){
    //                             echo '<p class="cart__item-day">
    //                                     <span id="cart_day">Tomorrow</span>
    //                                 </p>';
    //                         }else{
    //                             echo '<p class="cart__item-day">
    //                                     <span id="cart_day">'.$value['product_day'].'</span>
    //                                 </p>';
    //                         }
    //                     echo '    
    //                     </div>
    //                     <span class="cart__item-edit"><img src="images/pencil.png"></span>                   
    //                     <span class="cart__item-delete"><img src="images/delete.png"></span>   
    //                 </li>';
    //             }
    //         }
    //         if ($_POST['check_session'] == 1) {
    //             echo $_SESSION['total_cart'] = number_format($total, 2);
    //         }
    //     }
    // }

    // Building a list of the basket and the total amount in lunch_menu db

    // if (isset($_SESSION['cart'])) {
    //     if (count($_SESSION['cart']) !== 0) {
    //         foreach ($_SESSION['cart'] as $key => $value) {
    //       else {
    //                 echo
    //                 '<li class="cart__content-item">
    //                     <div class="cart__item-wrapper" data-id="' . $key . '" data-price="' . $value['product_price'] . '" data-img="uploaded_images/'.$value['product_img'].'" data-desc="'.$value['product_desc'].'" data-date="'.$value['product_date'].'"> 
    //                         <p class="cart__item-quantity"><span id="cart_quantity">' . $value['quantity'] . '</span>x</p>
    //                         <h6 class="cart__item-name">
    //                             ' . $value['title'] . '
    //                         </h6>
    //                         <p class="cart__item-price price__items"><span id="cart_price">' . str_replace('.', ',', $value['price']) . '</span> €</p>';
    //                         if(date('l') ==  $value['product_day']){
    //                             echo '<p class="cart__item-day">
    //                                     <span id="cart_day">Today</span>
    //                                   </p>';
    //                         }else if(date('l', strtotime('+1 days'))==  $value['product_day']){
    //                             echo '<p class="cart__item-day">
    //                                     <span id="cart_day">Tomorrow</span>
    //                                 </p>';
    //                         }else{
    //                             echo '<p class="cart__item-day">
    //                                     <span id="cart_day">'.$value['product_day'].'</span>
    //                                 </p>';
    //                         }
    //                     echo '    
    //                     </div>
    //                     <span class="cart__item-edit"><img src="images/pencil.png"></span>                   
    //                     <span class="cart__item-delete"><img src="images/delete.png"></span>   
    //                 </li>';
    //             }
    //         }


    //     }

    // }

}
//
//
//
//
//
// Adding product item in cart list
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
// Getting quantity of each product
// start
//
//
//
//
//
function get_cart_info(){

    $response = array();
    $ids_string = $_POST['get_cart_info'];
   
    $ids_array = explode("|||", $ids_string);

    // Comparison of all current product IDs on the page with the IDs in the running "maps" session that store the current state of the basket 
    // and the formation of an associative array with the quantity in the basket by ID
    foreach ($_SESSION['cart'] as $key => $value) {

        for($i = 0; $i < count($ids_array) - 1; $i++){
    
            $id_value = $ids_array[$i];

            if($id_value == $key){
                
                array_push($response,
                array(
                    "product_id" => $key,
                    "product_quantity" => $value['quantity'],
                    )
                );
                
            }
    
        }

        if(in_array($key, $ids_array)){

        }else{
            unset($_SESSION['cart'][$key]);
        }
        
    }

    $response = json_encode($response);

    echo $response;
}
//
//
//
//
//
// Getting quantity of each product
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
// Set unavailable status for lunch menu after 11 o'clock on Friday
// start
//
//
//
//
//
function check_day(){

    global $con;

    date_default_timezone_set('Europe/Riga');

    if(date('l') == 'Friday' && date('H') >= 11){

        $query = "UPDATE lunch_menu SET lunch_unavailable = 1;
				  UPDATE lunch_menu_ru SET lunch_unavailable = 1;
				  UPDATE lunch_menu_en SET lunch_unavailable = 1;";

        $result = mysqli_multi_query($con, $query);

    }

}

check_day();
//
//
//
//
//
// Set unavailable status for lunch menu after 11 o'clock on Friday
// finish
//
//
//
//
//