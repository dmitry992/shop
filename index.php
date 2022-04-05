<?php

session_start();
date_default_timezone_set('Europe/Riga');

include "server/db.php";

$_SESSION['lng'] = 'lv';

?>
<!DOCTYPE html>
<html lang="lv">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, viewport-fit=cover">
	<meta http-equiv="X-UA-Compatible" wrapper="ie=edge">
	<title>Document</title>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>


	<div class="modal modal__warning" id="modal_warning_reg">
		<div class="modal__wrapper">
			<div class="modal__body">
				<p class="modal__body-text">
					The user with this phone number was previously created
				</p>
				<button class="modal__body-btn" id="close_modal_warning_reg" data-chk='1'>
					Ok
				</button>
			</div>
		</div>
	</div>

	<div class="modal modal__warning" id="modal_warning_login">
		<div class="modal__wrapper">
			<div class="modal__body">
				<p class="modal__body-text">
					Password or login incorrect
				</p>
				<button class="modal__body-btn" id="close_modal_warning_login">
					Ok
				</button>
			</div>
		</div>
	</div>


	<div class="wrapper" style="padding-bottom:50px">

		<!-- Top block with info about active orders -->
		<?php
			
		if (isset($_SESSION['user_id'])) {
			global $con;

			$query = "SELECT * FROM orders WHERE user_id = " . $_SESSION['user_id'] . " AND order_finish = '0'";

			$result = mysqli_query($con, $query);

			$num = mysqli_num_rows($result);

			if ($num !== 0) {
				echo '<a class="wrapper__panel" href="ongoing_orders.php">
							<div class="wrapper__panel-img">
								<img src="images/wrapper__panel-img.png">
							</div>
							<div class="wrapper__panel-body">
								<h6 class="wrapper__panel-title">
									Ongoing order
								</h6>
								<p class="wrapper__panel-text">
									View actual orders
								</p>
							</div>
						</a>';
			}
		}
		
		?>
		<!-- /Top block with info about active orders -->

		<div class="modal modal__warning" id="user_modal_warning">
			<div class="modal__wrapper">
				<div class="modal__body">
					<p class="modal__body-text">
						These options will become available later
					</p>
					<a class="modal__body-btn" id="user_cls_modal_warning">
						Ok
					</a>
				</div>
			</div>
		</div>

		<div class="user__block">
			<?php if(isset($_SESSION['user_id'])) : ?>
				<div class="user__menu" id="user_menu_btn" style="top: 100px">
					<div class="user__menu-burger">
						<span class="user__burger-item">

						</span>
					</div>
				</div>
			<?php else : ?>
				<div class="user__menu" id="user_menu_btn">
					<div class="user__menu-burger">
						<span class="user__burger-item">

						</span>
					</div>
				</div>
			<?php endif  ?>	
			<span class="user__block-close close" id="user_menu_close"></span>
			<div class="user__block-body">
				<div class="user__block-body__top">
					<h3 class="user__block-body__name">
						<?php echo $_SESSION['user'] ?>
					</h3>
					<p class="user__block-body__phone">
						<?php echo $_SESSION['number'] ?>
					</p>
					<div class="user__block-lng">
						<a class="modal__lng-item" href="index.php">
							LV		
						</a>
						<a class="modal__lng-item" href="ru/">
							RU	
						</a>
						<a class="modal__lng-item" href="en/">
							EN
						</a>
					</div>
				</div>
				<!-- Settings in user menu -->
				<ul class="user__block-body__content">
					<li class="user__block-content__item user__block-content__item--orders">
						View orders
					</li>
					<li class="user__block-content__item">
						Payment
					</li>
					<li class="user__block-content__item">
						Promo codes
					</li>
					<li class="user__block-content__item">
						Setting
					</li>
					<li class="user__block-content__item">
						About
					</li>
					<li class="user__block-content__item">
						Help
					</li>
				</ul>
				<!-- /Settings in user menu -->
				<div class="user__block-body__logout button" id="logout_button" data-user="buyer">
					<a class="user__block-logout__btn">
						Logout
					</a>
				</div>
			</div>
		</div>

		<div class="wrapper__top">
			<!-- <div class="wrapper__top-img">
				<img src="https://via.placeholder.com/470x255">
			</div> -->
			<div class="container">

				<!-- Translate no all block -->
				<h1 class="wrapper__top-title">
					Lorem ipsum dolor
				</h1>
				<h4 class="wrapper__top-subtitle">
					Delivery <span class="wrapper__top-price">1,00 &#8364;</span>
				</h4>
				<div class="wrapper__top-items">
					<div class="wrapper__top-item wrapper__top-item--info">
						<div class="wrapper__top-icon">i</div>
						<p class="wrapper__top-text">
							Allergies and contact details
						</p>
					</div>
					<div class="wrapper__top-item">
						<div class="wrapper__top-icon wrapper__top-icon--chat">
							<div class="wrapper__top-dots">
								. . .
							</div>
						</div>
						<!-- Translate only this -->
						<p class="wrapper__top-text">
							Delivery is free!
						</p>
						<!-- /Translate only this -->
					</div>
				</div>
				<div class="wrapper__top-filter">
					<div class="wrapper__top-img">
						<img src="images/search.png">
					</div>
					<div class="wrapper__top-category">
						All categories
					</div>
				</div>
				<!-- /Translate no all block -->

			</div>
		</div>

		<div class="wrapper__content">

			<!-- <div class="wrapper__slider swiper-container"> -->

			<div class="wrapper__content-items">

			</div>

			<!-- </div>  -->

			<!-- Bottom button "cart" -->
			<div class="link__cart">
				<a class="link__cart-btn button" href="cart.php">

					<p>
						View carttttttttt
						<?php if ($_SESSION['total_cart']) : ?>
							<span id="total_price" style="display:inline-block">
								<?php
									$total = 0;

									foreach ($_SESSION['cart'] as $key => $value) {
										$total = $total + $value['price'];
									}
									$_SESSION['total_cart'] = number_format($total, 2);

									echo str_replace('.', ',', number_format($_SESSION['total_cart'], 2)) . ' €';
								?>
							</span>
						<?php else : ?>
							<span id="total_price" style="display:none">
								<?php echo str_replace('.', ',', number_format($_SESSION['total_cart'], 2)) . ' €' ?>
							</span>
						<?php endif; ?>
					</p>

				</a>
			</div>
			<!-- /Bottom button "cart" -->

			<!-- Modal window for product -->
			<div class="modal" id="wrapper_product">
				<div class="modal__block" id="product_block">
					<span class="modal__block-cls" id="close_product">
					</span>
					<div class="modal__block-img">
						<img src="" id="modal_img">
					</div>
					<h2 class="modal__block-title">
					</h2>
					<p class="modal__block-desc">
					</p>
					<!-- <p class="modal__block-dop">
						Lorem ipsum dolor sit amet consectetur adipisicing elit.
					</p>
					<p class="modal__block-subtitle">
						Leave a note for the kitchen
					</p> -->
					<div class="modal__block-bottom">
						<div class="modal__block-item modal__block-item--quantity">
							<p class="modal__block-remove">
								<span></span>
							</p>
							<span class="modal__block-number">1</span>
							<p class="modal__block-add">
								<span></span>
							</p>
						</div>

						<div class="modal__block-item modal__block-item--price button" id='add_product'>
							<span class="modal__item-price__delete" id="price_product_delete">Delete</span>
							<span id='add_product_text'>Add</span>
							<span id="price_product">0</span>
						</div>

					</div>
				</div>
			</div>
			<!-- /Modal window for product -->

			<!-- Modal window for auth -->
			<div class="modal" id="modal_auth">
				<div class="modal__block modal__block-auth">

					<span class="modal__block-cls" id="close_modal_auth">
					</span>
					<div class="modal__auth-lng">
						<a class="modal__lng-item" href="index.php">
							LV		
						</a>
						<a class="modal__lng-item" href="ru/">
							RU	
						</a>
						<a class="modal__lng-item" href="en/">
							EN
						</a>
					</div>
					<div class="modal__auth-check">
						<p class="modal__auth-text">
							Do you have an account?
						</p>
						<div class="modal__auth-buttons">
							<button class="modal__auth-button button" id="auth_no">No</button>
							<button class="modal__auth-button button" id="auth_yes">Yes</button>
						</div>
					</div>

					<div class="auth__wrapper" style="display: none;" id="login_block">
						<h1 class="auth__title">
							Login
						</h1>
						<form class="auth__form">
							<!-- <lable class="auth__form-label">
									Email
									<input class="auth__form-input" type="email" id="input_email">
									<p class="auth__form-warning">
										Invalid email address
									</p>
							</lable> -->
							<lable class="auth__form-label">
								Phone number
								<input class="auth__form-input" type="phone" id="input_phone">
								<p class="auth__form-warning">
									Invalid phone number
								</p>
							</lable>
							<lable class="auth__form-label">
								Password
								<input class="auth__form-input" type="password" id="input_password">
								<p class="auth__form-warning">
									Empty field with password
								</p>
							</lable>
							<button class="auth__form-btn" id="login_btn">
								Login
							</button>
						</form>
						<div class="auth__bottom">
							<p class="auth__text">
								Or
							</p>
							<a class="auth__link" id="auth_no">
								Quick registration
							</a>
						</div>
					</div>

					<div class="auth__wrapper" style="display: none;" id="reg_block">

						<h1 class="auth__title">
							Registration
						</h1>
						<form class="auth__form">
							<!-- <lable class="auth__form-label">
								Email
								<input class="auth__form-input" type="email" id="input_email">
								<p class="auth__form-warning">
									Invalid email address
								</p>
							</lable> -->
							<lable class="auth__form-label">
								Phone number
								<input class="auth__form-input" type="phone" id="input_number">
								<p class="auth__form-warning">
									Invalid phone number
								</p>
							</lable>
							<lable class="auth__form-label">
								Name
								<input class="auth__form-input" type="text" id="input_name">
								<p class="auth__form-warning">
									Invalid name
								</p>
							</lable>
							<lable class="auth__form-label">
								Password
								<input class="auth__form-input" type="password" id="input_password_reg">
								<p class="auth__form-warning">
									Empty field with password
								</p>
							</lable>
							<lable class="auth__form-label">
								Confirm password
								<input class="auth__form-input" type="password" id="input_password_confrim">
								<p class="auth__form-warning">
									Password mismatch
								</p>
							</lable>
							<button class="auth__form-btn" id="reg_btn">
								Registration
							</button>
						</form>
						<div class="auth__bottom">
							<p class="auth__text">
								Or
							</p>
							<a class="auth__link" id="auth_yes">
								Login
							</a>
						</div>

					</div>

				</div>
			</div>
			<!-- /Modal window for auth -->

		</div>

	</div>

	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
	<script src="js/general.js"></script>
	<script src="js/index.js"></script>
	<script src="lib/js_lib/big.js-master/big.js"></script>
	<script src="js/login.js?1"></script>
	<script src="js/registration.js"></script>
	<script src="js/logout.js"></script>




</body>

</html>