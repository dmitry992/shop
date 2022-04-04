<?php

session_start();
date_default_timezone_set('Europe/Riga');

include "../server/db.php";

if(!isset($_SESSION['user_id'])){
	header('Location:/');
}

$_SESSION['lng'] = 'en';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <title>Document</title>
</head>
<body>
	<div class="header__fixed">
			<div class="header__fixed-nav">
				<a class="header__fixed-back">
				</a>
				<h3 class="header__fixed-title">
					Ongoing orders
				</h3>
			</div>
		</div>

	<div class="orders__content orders__content--user">
			<div class="container">

				<div class="orders__items">

					<?php

					 	global $con;

						$query = "SELECT * FROM orders_en WHERE user_id = ".$_SESSION['user_id']." AND order_finish = '0' ORDER BY order_id ASC";

						$days_week= ['Monday' => 'Monday','Tuesday' => 'Tuesday','Wednesday' => 'Wednesday','Thursday' => 'Thursday','Friday' => 'Friday'];
						$day_trns = '';

						
						$result = mysqli_query($con, $query);

						$sort = array();

						if($result){

							while($row = mysqli_fetch_assoc($result)){

								$array_products = json_decode($row['product_list'], true);

								foreach ($array_products as $key => $value) {

									foreach ($days_week as $day => $trns) {
										if ($day == $value['product_day']) {
											$day_trns = $trns;
										}
									}

									$sort[] = array('product_id' => $value['product_id'], 'product_quantity' => $value['product_quantity'], 
									'product_name' => $value['product_name'], 'product_price' => $value['product_price'], 'product_date' => $value['product_date'], 
									'product_day' => $day_trns, 'product_finish' => $value['product_finish'], 
									'delivery_address' => $row['delivery_address'], 'order_finish' => $value['order_finish'], 'comments' => $row['comments']);
								}
								
								
							}

							$dateArray = [];

							foreach($sort as $key=>$arr){
								$dateArray[$key]=$arr['product_date'];
							}

							array_multisort($dateArray, SORT_STRING, $sort);

							foreach ($sort as $key => $value) {
									if($value['product_finish'] == 0){
										echo '<div class="orders__item">
											<h2 class="orders__content-title orders__content-title--user">Delivery date</h2>
											<h3 class="orders__content-title orders__content-title--user" style="color:#36d286;">';
												if($value['product_date'] == date('d.m.Y')){
													echo 'Today';
												}else if($value['product_date'] == date('d.m.Y', strtotime('+1 days'))){
													echo 'Tommorow';
												}else{
													echo $value['product_day'];
												}
											echo'</h3>
											<ul class="orders__content-list">';
												echo '<li class="orders__content-item">
														<div class="orders__item-wrapper"> 
															<p class="orders__item-quantity">'.$value['product_quantity'].'x</p>
																<h6 class="orders__item-name orders__item-name--user">
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
												<input class="orders__address-input orders__address-input--user" id="delivery_address" value="'.$value['delivery_address'].'" readonly>
											</div>
										</div>';
											if($value['comments'] !== ''){
												echo '<input class="cart__content-comments" value="'.$value['comments'].'" readonly>';
											};
								echo '</div>
								</div>';
								
								
								}
								
							}
							
						}else{
							echo mysqli_error($con);
						}
						
					?>
				</div>

			</div>
		</div>

    <script src="../js/ongoing_orders.js"></script>
</body>
</html>