<?php
session_start();

if (!isset($_SESSION['user_id'])) {
	header("Location:/");
	exit;
}

include "server/db.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" wrapper="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<title>Document</title>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

	<div class="orders">

		<div class="header__fixed">
			<div class="header__fixed-nav">
				<a class="header__fixed-back">
				</a>
				<h3 class="header__fixed-title">
					History orders
				</h3>
			</div>
		</div>
		
		<div class="orders__content orders__content--user">
			<div class="container">

				<div class="orders__items">
					<?php
					 	global $con;

						$query = "SELECT * FROM orders WHERE user_id = ".$_SESSION['user_id']." AND order_finish = '1' ORDER BY order_id DESC";
						
						$result = mysqli_query($con, $query);

						
						if($result){

							while($row = mysqli_fetch_assoc($result)){
								
								$array_products = json_decode($row['product_list'], true);
								
									echo '<div class="orders__item">
											<h2 class="orders__content-title orders__content-title--user">Delivery date</h2>
											<h3 class="orders__content-title orders__content-title--user">'.$row['delivery_date'].'</h3>
											<ul class="orders__content-list">
												<li class="orders__content-item">
														<div class="orders__item-wrapper orders__item-wrapper--info">';
															if($row['order_created_date'] == date("d.m.Y")){
																echo '<div class="orders__item-date orders__item-date--user">
																		<p class="orders__date-text">Order created</p>
																		<p class="orders__date-title orders__item-date--today">Today</p>
																		<p class="orders__item-time">'.$row['order_created_time'].'</p>
																	</div>';
															}else{
																echo '<div class="orders__item-date orders__item-date--user">
																			<p class="orders__date-text">Order created</p>
																			<p class="orders__date-title orders__item-date--today">'.$row['order_created_date'].'</p>
																			<p class="orders__item-time">'.$row['order_created_time'].'</p>
																	  </div>';
															}
														echo'</div>
												</li>';	
									foreach ($array_products as $key => $value) {
										echo 
										'<li class="orders__content-item">
											<div class="orders__item-wrapper"> 
												<p class="orders__item-quantity">'.$value['product_quantity'].'x</p>
													<h6 class="orders__item-name orders__item-name--user">
														'.$value['product_name'].'
													</h6>
												<p class="orders__item-price price__items">'.$value['product_price'].'</p>
											</div>  
										</li>';
									}
									echo 
										'</ul>';
										if($row['comments'] !== ''){
											echo '<input class="orders__content-comments" value="'.$row['comments'].'" readonly>';
										};
									
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
													<input class="orders__address-input orders__address-input--user" id="delivery_address" value="'.$row['delivery_address'].'" readonly>
												</div>
											</div>
											<div class="orders__price-total orders__price-item orders__price-total--user">
												<p class="orders__total-text">
													Total
												</p>
												<p class="orders__total-price">'.$row['total'].' €</p>
											</div>
										</div>
									</div>';
							}

						}else{
							echo mysqli_error($con);
						}
						
					?>
				</div>

			</div>
		</div>

	</div>	



	<script src="js/history_orders.js"></script>
	<script src="lib/js_lib/big.js-master/big.js"></script>




</body>

</html>