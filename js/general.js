// Variables for modal window product
let wrapper_product = document.getElementById('wrapper_product');
let product_block = document.getElementById('product_block');
let close_product = document.getElementById('close_product');
let modal_img = document.getElementById('modal_img');
let modal_title = document.querySelector('.modal__block-title');
let modal_desc = document.querySelector('.modal__block-desc');
let add_product_text = document.getElementById('add_product_text');
let price_product_delete = document.getElementById('price_product_delete');
let product_quantity;

// Variables for adding product in cart
let add_product = document.getElementById('add_product');
let price_product = document.getElementById('price_product');
let price_product_number;
let remove_item = document.querySelector('.modal__block-remove');
var add_item = document.querySelector('.modal__block-add');
let quantity = document.querySelector('.modal__block-number');

// Variables for total price
let block_cart = document.querySelector('.link__cart');
let total_price = document.getElementById('total_price');
let total_price_number = 0;
let check_session = 0;

// Variables for user menu
let user_menu = document.querySelector('.user__block');
let user_menu_btn = document.getElementById('user_menu_btn');
let check_user;
let user_menu_close = document.getElementById('user_menu_close');
let user_menu_items = document.querySelectorAll('.user__block-content__item');
let user_modal_warning = document.getElementById('user_modal_warning');
let user_cls_modal_warning = document.getElementById('user_cls_modal_warning');

// Variables for authorization
// let view_orders_btn = document.getElementById('view_orders');
let modal_auth_common = document.getElementById('modal_auth');
let close_modal_auth = document.getElementById('close_modal_auth');
let auth_no = document.querySelectorAll('#auth_no');
let auth_yes = document.querySelectorAll('#auth_yes');
let reg_block = document.getElementById('reg_block');
let login_block = document.getElementById('login_block');
var check_auth = 1;

var lng = document.documentElement.lang;
var path;


// This need translate
let changing_text = {
    "add": {
        "lv": "Pievienot",
        "ru": "Добавить",
        "en": "Add"
    },
    "update": {
        "lv": "Update",
        "ru": "Обновить",
        "en": "Update"
    },
    "modal_warning": {
        "lv": "The user with this phone number  was previously created",
        "ru": "Пользователь с таким номером телефона уже существует",
        "en": "The user with this phone number  was previously created"
    },
    "modal_message": {
        "lv": "Registration completed successfully",
        "ru": "Регистрация успешно завершена",
        "en": "Registration completed successfully"
    }
}





//
//
//
//
//
// Checking user authorization on page load
// start
//
//
//
//
//
let check_user_fn = function () {

    if (lng == 'lv') {
        path = "server/product.php";
    } else {
        path = "../server/product.php";
    }

    const uri = path;
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    xmlhttp.open("POST", uri, true);


    xmlhttp.onreadystatechange = function () {

        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            if (xmlhttp.responseText == 1) {
                check_user = 1;
            } else {
                check_user = 0;
            }

        }

    };

    fd.append("check_user_fn", 1);

    xmlhttp.send(fd);

};
check_user_fn();
//
//
//
//
//
// Checking user authorization on page load
// finish
//
//
//
//
//

let example = 0;


let get_message = function(){
    console.log('hello');
}
get_message();



// Check before opening the user menu for user authorization
user_menu_btn.addEventListener('click', function () {

    // If yes, then open the menu, otherwise ask to enter the account
    if (check_user == 1) {
        user_menu.style.height = "100%";
        user_menu.style.transform = 'translateX(0%)';
        document.body.style.overflow = 'hidden';
    } else if (check_user == 0) {
        document.body.style.overflow = 'hidden';
        modal_auth_common.style.display = "block";
        modal_auth_common.querySelector('.modal__auth-check').style.display = 'block';
        setTimeout(function () {
            modal_auth_common.querySelector('.modal__block-auth').style.transform = 'unset';
        }, 100);
    }

});


// Close user menu
user_menu_close.addEventListener('click', function () {
    user_menu.style.transform = 'translateX(100%)';
    user_menu.style.height = "100vh";
    document.body.style.overflow = 'auto';
});

// Warning for features that will become available later
for (let i = 0; i < user_menu_items.length; i++) {
    user_menu_items[i].addEventListener('click', function () {
        user_modal_warning.style.display = 'flex';
    });
}
user_cls_modal_warning.addEventListener('click', function () {
    user_modal_warning.style.display = 'none';
});












//
//
//
//
//
// Checking if the session "total_cart" is running to load the data of the current state of the cart
// start
//
//
//
//
//
var check_cart = function () {

    if (lng == 'lv') {
        path = "server/product.php";
    } else {
        path = "../server/product.php";
    }

    const uri = path;
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    xmlhttp.open("POST", uri, true);

    xmlhttp.onreadystatechange = function () {

        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            if (xmlhttp.responseText == 1) {

                get_cart_info();

            }

        }

    };

    fd.append("check_cart", 1);

    xmlhttp.send(fd);

};
//
//
//
//
//
// Checking if the session "total_cart" is running to load the data of the current state of the cart
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
let get_cart_info = function () {

    if (lng == 'lv') {
        path = "server/product.php";
    } else {
        path = "../server/product.php";
    }

    const uri = path;
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    let ids_string = '';
    let product_items = document.querySelectorAll('.product__item');

    // Collection of all relevant product ids on the page
    for (let i = 0; i < product_items.length; i++) {

        let id = product_items[i].getAttribute('data-id');

        if (id.length > 0) {
            ids_string += id + '|||';
        }

    }

    xmlhttp.open("POST", uri, true);

    xmlhttp.onreadystatechange = function () {

        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {


            let response = JSON.parse(xmlhttp.responseText);
            let actual_quantity = document.querySelectorAll('.product__item-quantity');

            // Assigning a quantity of a product by id
            for (let i = 0; i < response.length; i++) {

                actual_quantity = document.querySelector('[data-id="' + response[i].product_id + '"]').querySelector('.product__item-quantity');
                actual_quantity.style.opacity = '1';
                actual_quantity.innerText = response[i].product_quantity;

            }

        }

    };

    fd.append("get_cart_info", ids_string);

    xmlhttp.send(fd);

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
// Function for modal window product
// start
//
//
//
//
//

// Open modal window
var open_product = function () {

    if (this.classList.contains('product__item')) {

        if (modal_img.src = this.querySelector('.product_img').src) {
            wrapper_product.style.display = 'block';
            product_block.scrollTo(0, 0);
            setTimeout(function () {
                product_block.style.transform = 'unset';
            }, 100);
            document.body.style.overflow = "hidden";
        }

        remove_item.style.opacity = "0.2";

        modal_title.innerText = this.querySelector('.product__title').innerText;
        modal_desc.innerText = this.querySelector('.product_desc').innerText;

        let id = this.getAttribute('data-id');
        product_quantity = this.querySelector('.product__item-quantity').innerText;
        price_product_number = parseFloat(this.querySelector('.price__items').innerText.replace(',', '.')).toFixed(2);

        // Dynamically setting values for the selected product
        remove_item.setAttribute('data-price', price_product_number);
        add_item.setAttribute('data-price', price_product_number);

        if (product_quantity !== '') {

            add_product_text.innerText = changing_text.update[lng];
            remove_item.style.opacity = '1';

            quantity.innerText = product_quantity;
            price_product_number = Big(parseInt(product_quantity)).times(price_product_number).toFixed(2);

            if (product_quantity > 1) {
                remove_item.style.opacity = '1';
            }

        } else {
            add_product_text.innerText = changing_text.add[lng];
        }




        price_product_delete.style.opacity = 0;
        add_product.style.background = "#36d286";
        price_product.style.opacity = 1;
        add_product_text.style.opacity = 1;

        add_product.setAttribute('data-id', id);
        add_product.setAttribute('data-quantity', quantity.innerText);
        price_product.innerText = price_product_number.replace('.', ',') + ' €';

    }

}


// Close modal window
let close_modal = function () {

    product_block.style.transform = 'translateY(200%)';
    document.body.style.overflow = "auto";
    setTimeout(function () {
        wrapper_product.style.display = 'none';
        modal_img.src = "";
        price_product.innerText = price_product_number;
    }, 200);
    remove_item.style.opacity = '.2';
    quantity.innerText = 1;

};
close_product.addEventListener('click', close_modal, false);
//
//
//
//
//
// Function for modal window product
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
// Calculating the quantity and total price of a product
// start
//
//
//
//
//

// Reducing the quantity and price of the product
remove_item.addEventListener('click', function () {

    let price_actual = parseFloat(price_product.innerText.replace(',', '.')).toFixed(2);
    let quantity_number = parseInt(quantity.innerText);
    let this_price = this.getAttribute('data-price');

    if (product_quantity !== '') {

        if (quantity_number !== 0) {

            quantity_number = --quantity_number;
            quantity.innerText = quantity_number;

            price_actual = Big(price_actual).minus(this_price).toFixed(2) + " €";
            price_product.innerText = price_actual.replace('.', ',');

            if (quantity_number < 1) {
                this.style.opacity = '.2';
                price_product.style.opacity = 0;
                add_product_text.style.opacity = 0;
                price_product_delete.style.opacity = 1;
                add_product.style.background = "#ec4555";
            }
        }

    } else {
        if (quantity_number !== 1) {

            quantity_number = --quantity_number;
            quantity.innerText = quantity_number;

            price_actual = Big(price_actual).minus(this_price).toFixed(2) + " €";
            price_product.innerText = price_actual.replace('.', ',');

            if (quantity_number < 2) {
                this.style.opacity = '.2';
            }

        }
    }



    add_product.setAttribute('data-quantity', quantity.innerText);

});

// Adding the quantity and price of the product
add_item.addEventListener('click', function () {

    let price_actual = parseFloat(price_product.innerText.replace(',', '.')).toFixed(2);
    let quantity_number = parseInt(quantity.innerText);
    let this_price = this.getAttribute('data-price');

    if (quantity_number == 0) {
        price_product_delete.style.opacity = 0;
        add_product.style.background = "#36d286";
        price_product.style.opacity = 1;
        add_product_text.style.opacity = 1;
    }

    price_actual = Big(price_actual).add(this_price).toFixed(2) + " €";
    price_product.innerText = price_actual.replace('.', ',');


    quantity_number = ++quantity_number;
    quantity.innerText = quantity_number;

    remove_item.style.opacity = '1';


    add_product.setAttribute('data-quantity', quantity.innerText);

});
//
//
//
//
//
// Calculating the quantity and total price of a product
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
// Adding item product in cart list
// start
//
//
//
//
//
let cart = function () {

    let id = this.getAttribute('data-id');
    let current_quantity = document.querySelector('[data-id="' + id + '"]').querySelector('.product__item-quantity');
    let quantity = this.getAttribute('data-quantity');
    let price = parseFloat(price_product.innerText.replace(',', '.')).toFixed(2);
    let check_session = 1;

    if (price == '0.00') {
        delete_product();
        return;
    }

    if (lng == 'lv') {
        path = "server/product.php";
    } else {
        path = "../server/product.php";
    }

    const uri = path;
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    current_quantity.style.opacity = '1';
    current_quantity.innerText = quantity;

    xmlhttp.open("POST", uri, true);

    xmlhttp.onreadystatechange = function () {

        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            total_price.innerText = xmlhttp.responseText.replace('.', ',') + ' €';
            total_price.style.display = 'inline-block';

            document.querySelector('.wrapper').style.paddingBottom = '70px';

            block_cart.style.display = 'flex';
            setTimeout(function () {
                block_cart.style.transform = 'translateY(0%)';
            }, 50);
            block_cart.style.pointerEvents = 'auto';
            block_cart.style.opacity = '1';

        }

    };

    fd.append("cart", id);
    fd.append("price", price);
    fd.append("quantity", quantity);
    fd.append("check_session", check_session);

    xmlhttp.send(fd);

    close_modal();

};
add_product.addEventListener('click', cart, false);
//
//
//
//
//
// Adding item product in cart list
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
// Remove item from cart from modal window
// start
//
//
//
//
//
let delete_product = function (e) {


    if (lng == 'lv') {
        path = "server/cart.php";
    } else {
        path = "../server/cart.php";
    }

    const uri = path;
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    xmlhttp.open("POST", uri, true);

    let item_id = add_product.getAttribute('data-id');
    let current_quantity = document.querySelector('[data-id="' + item_id + '"]').querySelector('.product__item-quantity');
    current_quantity.innerText = '';
    current_quantity.style.opacity = 0;


    xmlhttp.onreadystatechange = function () {

        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {


            document.querySelector('.wrapper').style.paddingBottom = '70px';
            block_cart.style.display = 'flex';

            if (xmlhttp.responseText !== 'empty') {
                total_price.innerText = xmlhttp.responseText.replace('.', ',') + ' €';
                block_cart.style.transform = 'translateY(0%)';
            } else {
                total_price.style.display = 'none';
            }

        }


    }

    fd.append('delete_product', item_id);

    close_modal();

    xmlhttp.send(fd);

}
//
//
//
//
//
// Remove item from cart from modal window
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
// Functions for auth modal window
// start
//
//
//
//
//
for (let i = 0; i < auth_no.length; i++) {
    auth_no[i].addEventListener('click', function () {
        modal_auth_common.querySelector('.modal__auth-check').style.display = 'none';
        login_block.style.display = 'none';
        reg_block.style.display = 'block';
    });
}
for (let i = 0; i < auth_yes.length; i++) {
    auth_yes[i].addEventListener('click', function () {
        modal_auth_common.querySelector('.modal__auth-check').style.display = 'none';
        reg_block.style.display = 'none';
        login_block.style.display = 'block';
    });
}

close_modal_auth.addEventListener('click', function () {

    modal_auth_common.querySelector('.modal__block-auth').style.transform = 'translateY(200%)';

    setTimeout(function () {
        modal_auth_common.style.display = "none";
        document.body.style.overflow = 'auto';
        reg_block.style.display = 'none';
        login_block.style.display = 'none';
        modal_auth_common.querySelector('.modal__auth-check').style.display = 'none';
    }, 200);

});
//
//
//
//
//
// Functions for auth modal window
// finish
//
//
//
//
//