<?php

session_start();

if (!isset($_SESSION['user_id'])) {
	header("Location:/login.php");
	exit;
} else {
	if ($_SESSION['user_group'] !== 'admin') {
		header("Location:/login.php");
		exit;
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" wrapper="ie=edge">
	<title>Document</title>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/style.css">
</head>

<body>



	<div class="add-product">

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
		

		<div class="add-product__wrapper">

			<!-- Table "lunch menu" -->
			<div class="add-product__lunch">

				<h1 class="add-product__title">
					Lunch
				</h1>

				<div class="lunch-menu__table">
					<ul class="add-product__table-top">
						<li class="table__top-item">Day week</li>
						<li class="table__top-item">Title</li>
						<li class="table__top-item">Description</li>
						<li class="table__top-item">Price</li>
						<li class="table__top-item">Image</li>
					</ul>
					<div class="add-product__table-content" id="table_lunch">
					</div>
				</div>

			</div>
			<!-- /Table "lunch menu" -->

			<!-- Table "lunch menu ru" -->
			<div class="add-product__lunch">

				<h1 class="add-product__title">
					Lunch RU
				</h1>

				<div class="lunch-menu__table">
					<ul class="add-product__table-top">
						<li class="table__top-item">Day week</li>
						<li class="table__top-item">Title</li>
						<li class="table__top-item">Description</li>
						<li class="table__top-item">Price</li>
						<li class="table__top-item">Image</li>
					</ul>
					<div class="add-product__table-content" id="table_lunch_ru">
					</div>
				</div>

			</div>
			<!-- /Table "lunch menu ru" -->

			<!-- Table "lunch menu en" -->
			<div class="add-product__lunch">

				<h1 class="add-product__title">
					Lunch EN
				</h1>

				<div class="lunch-menu__table">
					<ul class="add-product__table-top">
						<li class="table__top-item">Day week</li>
						<li class="table__top-item">Title</li>
						<li class="table__top-item">Description</li>
						<li class="table__top-item">Price</li>
						<li class="table__top-item">Image</li>
					</ul>
					<div class="add-product__table-content" id="table_lunch_en">
					</div>
				</div>

			</div>
			<!-- /Table "lunch menu en" -->

			<!-- Table "products" -->
			<div class="add-product__products">

				<h1 class="add-product__title">
					Products
				</h1>

				<div class="add-product__table">

					<ul class="add-product__table-top">
						<li class="table__top-item table__top-item--id">Id</li>
						<li class="table__top-item">Title</li>
						<li class="table__top-item">Description</li>
						<li class="table__top-item">Price</li>
						<li class="table__top-item">Category</li>
						<li class="table__top-item">Subcategory</li>
						<li class="table__top-item">Image</li>
					</ul>
					<div class="add-product__table-content" id="table">
					</div>

				</div>

			</div>
			<!-- /Table "products" -->


			<!-- Modal window for adding product -->
			<div class="add-product__products">
				<div class="add-product__button add-product__btn" id="open_modal">
					Add product
				</div>

				<div class="add-product__modal" id="add_product_modal">
					<div class="add-product__modal-block">
						<div class="add-product__modal-item">
							<label class="add-product__modal-text">Title:</label>
							<input class="add-product__modal-input" type="text" id="product_title">
						</div>
						<div class="add-product__modal-item">
							<label class="add-product__modal-text">Description:</label>
							<textarea class="add-product__modal-input add-product__modal-textarea" type="text" id="product_desc"></textarea>
						</div>
						<div class="add-product__modal-item">
							<label class="add-product__modal-text">Price:</label>
							<input class="add-product__modal-input" type="text" id="product_price">
						</div>
						<div class="add-product__modal-item add-product__modal-item--select" id="select_ctg_btn">
							<label class="add-product__modal-text">Category:</label>
							<span class="add-product__modal-selected" id="category_selected"></span>
							<ul class="add-product__modal-select" id="category_list">

							</ul>
						</div>
						<div class="add-product__modal-item add-product__modal-item--select" id="select_subctg_btn">
							<label class="add-product__modal-text">Subcategory:</label>
							<span class="add-product__modal-selected" id="subcategory_selected"></span>
							<ul class="add-product__modal-select" id="subcategory_list">
							</ul>
						</div>
						<input style="display: none;" type="file" capture id="select_image">
						<div class="add-product__modal-upload">
							<a class="add-product__upload-btn add-product__btn" id="upload_image">Upload image</a>
						</div>
						<div class="add-product__modal-image">
							<img src="" id="img">
						</div>
						<div class="add-product__modal-add">
							<a class="add-product__add-btn add-product__btn" id="add_product_btn">
								Add product
							</a>
						</div>
					</div>
					<span class="add-product__modal-cls" id="cls_modal_add"></span>
				</div>
			</div>
			<!-- /Modal window for adding product -->



			<!-- Modal window for changing product -->
			<div class="add-product__modal" id="change_product_modal">
				<div class="add-product__modal-block">
					<div class="add-product__modal-item" id="change_input">
						<label class="add-product__modal-text" id="change_text">Title:</label>
						<input class="add-product__modal-input" type="text" id="change_value_input">
					</div>
					<div class="add-product__modal-item" id="change_textarea">
						<label class="add-product__modal-text" id="change_text">Description:</label>
						<textarea class="add-product__modal-input add-product__modal-textarea" type="text" id="change_value_textarea"></textarea>
					</div>
					<div class="add-product__modal-selectors">
						<div class="add-product__modal-item add-product__modal-item--select" id="change_ctg_btn">
							<label class="add-product__modal-text">Category:</label>
							<span class="add-product__modal-selected" id="change_category_selected"></span>
							<ul class="add-product__modal-select" id="change_category_list">

							</ul>
						</div>
						<div class="add-product__modal-item add-product__modal-item--select" id="change_subctg_btn">
							<label class="add-product__modal-text">Subcategory:</label>
							<span class="add-product__modal-selected" id="change_subcategory_selected"></span>
							<ul class="add-product__modal-select" id="change_subcategory_list">
							</ul>
						</div>
					</div>
					<div class="modal__change-image">
						<input style="display: none;" type="file" capture id="change_select_image">
						<div class="add-product__modal-image add-product__modal-image--change">
							<img src="" id="change_img">
						</div>
						<div class="add-product__modal-upload">
							<a class="add-product__upload-btn add-product__btn" id="change_upload_image">Change image</a>
						</div>
					</div>
					<div class="add-product__modal-add add-product__modal-change">
						<a class="add-product__add-btn add-product__btn" id="change_product_btn">
							Apply changes
						</a>
						<a class="add-product__add-btn add-product__btn" id="change_image_btn">
							Apply changes
						</a>
					</div>
				</div>
				<span class="add-product__modal-cls" id="cls_modal_change"></span>
			</div>
			<!-- /Modal window for changing product -->


			<!-- Modal window for changing lunch menu -->
			<div class="add-product__modal" id="change_lunch_modal">
				<div class="add-product__modal-block">
					<div class="add-product__modal-item" id="change_input_lunch" style="display:none">
						<label class="add-product__modal-text" id="change_lunch_text">Title:</label>
						<input class="add-product__modal-input" type="text" id="change_value_input_lunch">
					</div>
					<div class="add-product__modal-item" id="change_textarea_lunch" style="display:none">
						<label class="add-product__modal-text" id="change_lunch_text">Description:</label>
						<textarea class="add-product__modal-input add-product__modal-textarea" type="text" id="change_value_textarea_lunch"></textarea>
					</div>
					<div class="modal__change-image modal__change-image--lunch" style="display:none">
						<input style="display: none;" type="file" capture id="change_select_lunch_image">
						<div class="add-product__modal-image add-product__modal-image--change">
							<img src="" id="change_lunch_img">
						</div>
						<div class="add-product__modal-upload">
							<a class="add-product__upload-btn add-product__btn" id="change_upload_lunch_image">Change image</a>
						</div>
					</div>
					<div class="add-product__modal-add add-product__modal-change">
						<a class="add-product__add-btn add-product__btn" id="change_lunch_btn" style="display:none">
							Apply changes
						</a>
						<a class="add-product__add-btn add-product__btn" id="change_image_lunch_btn" style="display:none">
							Apply changes
						</a>
					</div>
				</div>
				<span class="add-product__modal-cls" id="cls_lunch_change"></span>
			</div>
			<!-- /Modal window for changing lunch menu -->


			<!-- Modal window for errors -->
			<div class="add-product__message" id="attention_modal">
				<div class="add-product__message-body">
					<span class="add-product__message-close" id="attention_cls"></span>
					<h2 class="add-product__message-title">
						Please correct the following errors :
					</h2>
					<div class="add-product__message-list" id="attention_list">

					</div>
				</div>
			</div>
			<!-- /Modal window for errors -->


			<!-- Modal window for message -->
			<div class="add-product__message" id="message_modal">
				<div class="add-product__message-body">
					<h2 class="add-product__message-title" id="message_title">

					</h2>
					<div class="add-product__message-button">
						<a class="add-product__message-btn add-product__btn" id="message_btn">
							Ok
						</a>
					</div>
				</div>
			</div>
			<!-- /Modal window for message -->


			<!-- Modal window to confirm the action -->
			<div class="add-product__message" id="confirm_modal">

				<div class="add-product__message-body">
					<h2 class="add-product__message-title">
						Are you sure you want to change the status of <br>
						<span id="status_title"></span>?
					</h2>
					<div class="add-product__message-button">
						<a class="add-product__message-btn add-product__btn" id="confirm_yes">
							Yes
						</a>
						<a class="add-product__message-btn add-product__btn" id="confirm_no">
							No
						</a>
					</div>
				</div>

			</div>
			<!-- /Modal window to confirm the action -->

		</div>

	</div>










	<script src="../js/add_product.js"></script>
	<script src="../js/logout.js"></script>



</body>

</html>