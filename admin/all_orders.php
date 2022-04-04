<?php
session_start();

include "../server/db.php";

	if (!isset($_SESSION['user_id'])) {
		header("Location:/login.php");
		exit;
	}else{
		if($_SESSION['user_group'] !== 'admin'){
			header("Location:/login.php");
			exit;
		}
	}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" wrapper="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<title>Document</title>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>

	<div class="orders">

		<!-- Top header admin menu -->	
		<div class="admin__menu">

			<div class="admin__menu-btn" id="change_status_btn">Change status lunch</div>
			<div class="admin__menu-right">
				<ul class="admin__menu-nav">
					<li class="admin__menu-item">
						<a class="admin__menu-link" href="all_orders.php">Orders</a>
					</li>
					<li class="admin__menu-item">
						<a class="admin__menu-link" href="add_product.php">Products</a>
					</li>
				</ul>
				<a class="admin__menu-logout" id="logout_button" data-user="admin">
					<img src="../images/logout.png">
				</a>
			</div>

		</div>
		<!-- /Top header admin menu -->


		<!-- Modal window for message -->
		<div class="modal modal__warning" id="modal_ok">
			<div class="modal__wrapper">
				<div class="modal__body">
					<p class="modal__body-text">
						Order has been finished
					</p>
					<button class="modal__body-btn" id="close_modal_ok">
						Ok
					</button>
				</div>
			</div>
    	</div>
		<!-- /Modal window for message -->



		<!-- Content orders -->
		<div class="orders__content orders__content--admin">

			<div class="container">
				<div class="orders__content-top">
					<div class="orders__content-calendar">
						<p class="orders__calendar-text">Orders date:</p>
						<input class="flatpickr-input orders__calendar-input" id="select_date">
					</div>
					<div class="orders__content-completed">
						<button class="orders__completed-btn" id="completed_orders_btn">
							Completed orders
						</button>
					</div>
				</div>

				<div class="orders__items">

				</div>

			</div>

		</div>
		<!-- /Content orders -->



	</div>


	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="../js/logout.js"></script>					
	<script src="../js/all_orders.js"></script>	



</body>

</html>