<?php
include "db.php";


if( isset($_POST['check_order']) ){
    check_order();
}
if( isset($_POST['finish_order']) ){
    finish_order();
}
if( isset($_POST['change_status']) ){
    change_status();
}
if( isset($_POST['completed_orders']) ){
    completed_orders();
}





//
//
//
//
//
// Get all orders by a specific date
// start
//
//
//
//
function check_order(){
	
	global $con;

	$date = $_POST['check_order'];

	$query = "SELECT * FROM orders INNER JOIN users ON orders.user_id = users.user_id  WHERE order_finish = 0 ORDER BY order_id ASC";
	
	$result = mysqli_query($con, $query);

	$sort = array();

	if($result){

		while($row = mysqli_fetch_assoc($result)){

			$array_products = json_decode($row['product_list'], true);
			
			// Collect all data in an associative array for sorting by date
			foreach ($array_products as $key => $value) {
				
				$sort[] = array('product_id' => $value['product_id'], 'product_quantity' => $value['product_quantity'], 
				'product_name' => $value['product_name'], 'product_price' => $value['product_price'], 'product_date' => $value['product_date'], 
				'product_day' => $value['product_day'], 'product_finish' => $value['product_finish'], 'delivery_address' => $row['delivery_address'], 
				'order_finish' => $value['order_finish'], 'user_name' => $row['user_name'], 'user_phone' => $row['user_phone'], 'main_order' => $row['order_id']);

			}

		}
		
		// Sorting array
		$dateArray = [];
		foreach($sort as $key=>$arr){
			$dateArray[$key]=$arr['product_date'];
		}
		array_multisort($dateArray, SORT_STRING, $sort);


		// Order formation according to data
		foreach ($sort as $key => $value) {
			
			// Checking the date of products that matches the one specified by the user
			if($value['product_date'] == $date){

					//Filtering for only pending orders
					if($value['product_finish'] == 0){

						echo '<div class="orders__item">
								<h2 class="orders__content-title">Delivery date</h2>
								<h3 class="orders__content-title" style="color:#36d286;">';
									// Date check if today/tomorrow then output as a word
									if($value['product_date'] == date('d.m.Y')){
										echo 'Today';
									}else if($value['product_date'] == date('d.m.Y', strtotime('+1 days'))){
										echo 'Tommorow';
									}else{
										echo $value['product_day'];
									}
								echo'</h3>
								<ul class="orders__content-list">';
									echo'<li class="orders__content-item">
											<div class="orders__item-wrapper orders__item-wrapper--info">
												<div class="orders__item-user__info">
													<h6 class="orders__item-user__name">'.$value['user_name'].'</p>
													<h6 class="orders__item-user__phone">'.$value['user_phone'].'</p>
												</div>	
											</div>
										</li>';
									echo '<li class="orders__content-item">
											<div class="orders__item-wrapper"> 
												<p class="orders__item-quantity">'.$value['product_quantity'].'x</p>
													<h6 class="orders__item-name">
														'.$value['product_name'].'
													</h6>
												<p class="orders__item-price price__items">'.$value['product_price'].'</p>
											</div>  
										</li>';
								'</ul>';
				
							echo '
								<div class="orders__content-price">
									<div class="orders__price-item">
										<p class="orders__delivery-text">
											Delivery fee
										</p>
										<p class="orders__delivery-price">0,00 €</p>
									</div>
									<div class="orders__content-delivery">
										<div class="orders__delivery-address">
											<input class="orders__address-input" id="delivery_address" value="'.$value['delivery_address'].'" readonly>
										</div>
									</div>
								</div>

								<div class="orders__item-finish">
									<button class="orders__finish-btn" data-id="'.$value['main_order'].'" data-product-id="'.$value['product_id'].'">
										Complete order
									</button>
								</div>

							</div>';

					}

			}
			
		}
		
	}else{
		echo mysqli_error($con);
	}
      
}
//
//
//
//
//
// Get all orders by a specific date
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
// Get all completed orders
// start
//
//
//
//
function completed_orders(){
	
	global $con;

	$query = "SELECT * FROM orders INNER JOIN users ON orders.user_id = users.user_id  ORDER BY order_id ASC";
	
	$result = mysqli_query($con, $query);

	$sort = array();

	if($result){

		while($row = mysqli_fetch_assoc($result)){

			$array_products = json_decode($row['product_list'], true);
			
			// Collect all data in an associative array for sorting by date
			foreach ($array_products as $key => $value) {
				
				$sort[] = array('product_id' => $value['product_id'], 'product_quantity' => $value['product_quantity'], 
				'product_name' => $value['product_name'], 'product_price' => $value['product_price'], 'product_date' => $value['product_date'], 
				'product_day' => $value['product_day'], 'product_finish' => $value['product_finish'], 'delivery_address' => $row['delivery_address'], 
				'order_finish' => $value['order_finish'], 'user_name' => $row['user_name'], 'user_phone' => $row['user_phone'], 'main_order' => $row['order_id']);

			}

		}
		// Sorting array
		$dateArray = [];
		foreach($sort as $key=>$arr){
			$dateArray[$key]=$arr['product_date'];
		}
		array_multisort($dateArray, SORT_DESC, $sort);

		// Order formation according to data
		foreach ($sort as $key => $value) {
			
			// Filtering for completed orders only
			if($value['product_finish'] == 1){

				echo '<div class="orders__item">
						<h2 class="orders__content-title">Delivery date</h2>
						<h3 class="orders__content-title" style="color:#36d286;">';
							// Date check if today/yesterday then output as a word
							if($value['product_date'] == date('d.m.Y')){
								echo 'Today';
							}else if($value['product_date'] == date('d.m.Y', strtotime('-1 days'))){
								echo 'Yesterday';
							}else{
								echo $value['product_date'];
							}
						echo'</h3>
						<ul class="orders__content-list">';
							echo'<li class="orders__content-item">
									<div class="orders__item-wrapper orders__item-wrapper--info">
										<div class="orders__item-user__info">
											<h6 class="orders__item-user__name">'.$value['user_name'].'</p>
											<h6 class="orders__item-user__phone">'.$value['user_phone'].'</p>
										</div>	
									</div>
								</li>';
							echo '<li class="orders__content-item">
									<div class="orders__item-wrapper"> 
										<p class="orders__item-quantity">'.$value['product_quantity'].'x</p>
											<h6 class="orders__item-name">
												'.$value['product_name'].'
											</h6>
										<p class="orders__item-price price__items">'.$value['product_price'].'</p>
									</div>  
								</li>';
						'</ul>';
						echo '
							<div class="orders__content-price">
								<div class="orders__price-item">
									<p class="orders__delivery-text">
										Delivery fee
									</p>
									<p class="orders__delivery-price">0,00 €</p>
								</div>
								<div class="orders__content-delivery">
									<div class="orders__delivery-address">
										<input class="orders__address-input" id="delivery_address" value="'.$value['delivery_address'].'" readonly>
									</div>
								</div>
							</div>
						</div>';
			}
					
		}
			
	}else{
		echo mysqli_error($con);
	}
      
}
//
//
//
//
//
// Get all completed orders
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
// Finish active order
// start
//
//
//
//
function finish_order(){
	
	global $con;

	$main_order = $_POST['finish_order'];
	$product_id = $_POST['product_id'];

	$query = "SELECT * FROM orders WHERE order_id = '$main_order'";

	$result = mysqli_query($con, $query);

	$sort = array();
	$new_list = '';
	$finish_product = 0;


	if($result){

		while($row = mysqli_fetch_assoc($result)){

			$array_products = json_decode($row['product_list'], true);

			// Finding in the array of the order to be completed by id
			foreach ($array_products as $key => $value) {
				
				if($value['product_id'] == $product_id){
					$value['product_finish'] = "1";
				}
				
				$sort[] = array('product_id' => $value['product_id'], 'product_quantity' => $value['product_quantity'], 
				'product_name' => $value['product_name'], 'product_price' => $value['product_price'], 
				'product_date' => $value['product_date'], 'product_day' => $value['product_day'], 'product_finish' => $value['product_finish'] );

				// Counting completed orders
				if($value['product_finish'] == "0"){
					$finish_product++;
				}
				
			}
			

		}
		
		$new_list = json_encode($sort,JSON_UNESCAPED_UNICODE);

	}else{
		echo mysqli_error($con);
	}

	// Checking if there are no completed orders left, then close the order completely
	if($finish_product == 0){
		$query = "UPDATE orders SET order_finish = '1' WHERE order_id = '$main_order';
				  UPDATE orders_ru SET order_finish = '1' WHERE order_id = '$main_order';
				  UPDATE orders_en SET order_finish = '1' WHERE order_id = '$main_order';";
	}else{
		$query = "UPDATE orders SET product_list = '$new_list' WHERE order_id = '$main_order';
				  UPDATE orders_ru SET product_list = '$new_list' WHERE order_id = '$main_order';
				  UPDATE orders_en SET product_list = '$new_list' WHERE order_id = '$main_order';";
	}


	$result = mysqli_multi_query($con, $query);

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
// Finish active order
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
// Make lunch order available/unavailable
// start
//
//
//
//
//
function change_status(){
	
	global $con;

	$query = "SELECT * FROM lunch_menu";

	$result = mysqli_query($con, $query);

	$check = 0;

	if($result){

		while($row = mysqli_fetch_assoc($result)){

			if($row['lunch_unavailable'] == 0){
				$check = 0;
			}else if($row['lunch_unavailable'] == 1){
				$check = 1;
			}

		}

	}else{
		echo mysqli_error($con);
	}

	if($check == 0){
		$query = "UPDATE lunch_menu SET lunch_unavailable = 1;
				  UPDATE lunch_menu_ru SET lunch_unavailable = 1;
				  UPDATE lunch_menu_en SET lunch_unavailable = 1;";
	}else if($check == 1){
		$query = "UPDATE lunch_menu SET lunch_unavailable = 0;
				  UPDATE lunch_menu_ru SET lunch_unavailable = 0;
				  UPDATE lunch_menu_en SET lunch_unavailable = 0;";
	}

	
	$result = mysqli_multi_query($con, $query);

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
// Make lunch order available/unavailable
// finish
//
//
//
//
//