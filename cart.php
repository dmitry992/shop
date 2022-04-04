<?php
session_start();

$_SESSION['lng'] = 'lv';

?>
<!DOCTYPE html>
<html lang="lv">

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

	<div class="modal modal__warning" id="modal_notice">
		<div class="modal__wrapper">
			<div class="modal__body">
				<p class="modal__body-text">
					You have successfully placed an order
				</p>
				<a class="modal__body-btn" href="index.php">
					Ok
				</a>
			</div>
		</div>
	</div>

	<div class="modal modal__warning" id="modal_warning_reg">
        <div class="modal__wrapper">
            <div class="modal__body">
                <p class="modal__body-text">
                    The user with this phone number  was previously created
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


	<?php if (isset($_SESSION['cart'])) : ?>
		<div class="header__fixed">
			<div class="header__fixed-nav">
				<a class="header__fixed-back">
				</a>
				<h3 class="header__fixed-title">
					Cart
				</h3>
				<p class="cart__edit">
					Edit
				</p>
			</div>
		</div>
		<div class="cart__content">
			<div class="container">
				<!-- <h3 class="cart__content-title">
						Delivery
					</h3> -->
				<ul class="cart__content-list">
					<?php
						include "server/product.php";
						cart();
					?>
				</ul>
				<input class="cart__content-comments" placeholder="Leave a comment" id="comments_inp">
				<div class="cart__content-price">
					<div class="cart__price-delivery cart__price-item">
						<p class="cart__delivery-text">
							Delivery fee
						</p>
						<p class="cart__delivery-price">0,00 €</p>
					</div>
					<!-- <div class="cart__price-discount cart__price-item">
							<p class="cart__discount-text">
								Delivery discount
							</p>
							<p class="cart__discount-price">-1,00 €</p>
						</div> -->
					<div class="cart__price-total cart__price-item">
						<p class="cart__total-text">
							Total
						</p>
						<?php if (isset($_SESSION['cart'])) : ?>
							<p class="cart__total-price"><?php echo str_replace('.', ',', number_format($_SESSION['total_cart'], 2)) ?> €</p>
						<?php endif; ?>
					</div>
				</div>
				<div class="cart__content-delivery">
					<h3 class="cart__delivery-title title">Delivery details</h3>
					<!-- <div class="cart__delivery-time">
							<div class="cart__time-icon"></div>
							<p class="cart__time-text">20-25 min</p>
						</div> -->
					<div class="cart__delivery-address">
						<!-- <div class="cart__address-icon"></div> -->
						<input class="cart__address-input" placeholder="Delivery address" id="delivery_address" value="<?php echo $_COOKIE['address']; ?>">
					</div>
					<!-- <div class="cart__delivery-map">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2587.4268715511525!2d24.061544917065596!3d56.95294765458453!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46eecfb0e5073ded%3A0x400cfcd68f2fe30!2z0KDQuNCz0LAsINCb0LDRgtCy0LjRjw!5e0!3m2!1sru!2sru!4v1638602302782!5m2!1sru!2sru" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
						</div> -->
				</div>
				<!-- <label class="cart__content-agreement">
						<input class="cart__agreement-checkbox" type="checkbox">
						<span class="cart__agreement-style"></span>
						<p class="cart__agreement-text">
							Lorem ipsum dolor sit amet consectetur adipisicing elit.
							Debitis dolores pariatur officiis quisquam distinctio veritatis cumque labore suscipit earum deleniti dolor mollitia ad.
						</p>
					</label> -->
				<div class="cart__content-order">
					<div class="cart__order-btn button" id="save_order_btn">
						Order <span id="order"><?php echo str_replace('.', ',', number_format($_SESSION['total_cart'], 2)) ?> €</span>
					</div>
				</div>
			</div>
		</div>

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
						<span id='add_product_text'>Update</span>
						<span id="price_product">0</span>
					</div>
				</div>
			</div>
		</div>






		<div class="cart">

			<div class="cart__empty">
				<h2 class="cart__empty-title title">
					Empty basket
				</h2>
				<p class="cart__empty-text">
					You don't have any items in your basket
				</p>
				<div class="cart__link-cart link__cart">
					<a class="link__cart-btn button link__cart-btn--search" href="index.php">Continue searching</a>
				</div>
			</div>

		<?php else : ?>

			<div class="header__fixed">
				<div class="header__fixed-nav">
					<a class="header__fixed-back">
					</a>
					<h3 class="header__fixed-title">
						Cart
					</h3>
					<p class="cart__edit">

					</p>
				</div>
			</div>

			<div class="cart__empty" style="transform:translateY(0%)">
				<h2 class="cart__empty-title title">
					Empty basket
				</h2>
				<p class="cart__empty-text">
					You don't have any items in your basket
				</p>
				<div class="cart__link-cart link__cart">
					<a class="link__cart-btn button link__cart-btn--search" href="index.php">Continue searching</a>
				</div>
			</div>

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
							<span id='add_product_text'>Update</span>
							<span id="price_product">0</span>
						</div>
					</div>
				</div>
			</div>

		<?php endif ?>


		<!-- Modal window for auth -->
		<div class="modal" id="modal_auth">
			<div class="modal__block modal__block-auth">
				<span class="modal__block-cls" id="close_modal_auth">
				</span>
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




		<script src="js/cart.js"></script>
		<script src="lib/js_lib/big.js-master/big.js"></script>
		<script src="js/login.js?1"></script>
		<script src="js/registration.js"></script>



</body>

</html>