// Variables for product modal window
let product_items = document.querySelectorAll('.cart__item-wrapper');
let wrapper_product = document.getElementById('wrapper_product');
let product_block = document.getElementById('product_block');
let modal_img = document.getElementById('modal_img');
let modal_title = document.querySelector('.modal__block-title');
let modal_desc = document.querySelector('.modal__block-desc');
let close_product = document.getElementById('close_product');
let add_product = document.getElementById('add_product');
let remove_item = document.querySelector('.modal__block-remove');
let add_item = document.querySelector('.modal__block-add');
let quantity_product = document.querySelector('.modal__block-number');
let price_product = document.getElementById('price_product');
let price_product_delete = document.getElementById('price_product_delete');

// Variables for fixed top menu
let top_fixed = document.querySelector('.header__fixed');
let back_page = document.querySelector('.header__fixed-back');

// Variables for edit cart list
let cart_edit_btn = document.querySelector('.cart__edit');
let cart_item_wrapper = document.querySelectorAll('.cart__content-item');
let edit_item = document.querySelectorAll('.cart__item-edit');
let delete_product_button = document.querySelectorAll('.cart__item-delete');
let total_price = document.querySelector('.cart__total-price');
let order_price = document.getElementById('order');
let cart_empty = document.querySelector('.cart__empty');
let check_empty = 0;

// Variables for save order
let save_order_btn = document.getElementById('save_order_btn');
let delivery_address_inp = document.getElementById('delivery_address');
let comments_inp = document.getElementById('comments_inp');
let modal_notice = document.getElementById('modal_notice');


// Variables for authorization
let modal_auth_cart = document.getElementById('modal_auth');
let close_modal_auth = document.getElementById('close_modal_auth');
let auth_no = document.querySelectorAll('#auth_no');
let auth_yes = document.querySelectorAll('#auth_yes');
let reg_block = document.getElementById('reg_block');
let login_block = document.getElementById('login_block');
var check_auth = 0;

var lng = document.documentElement.lang;
var path;

back_page.addEventListener('click' ,function(){
    history.back();
});







//
//
//
//
//
// Show/hide top fixed menu
// start
//
//
//
//
//  
window.addEventListener('scroll', function(){

    setTimeout(function() {
    if(window.pageYOffset > 1){
        top_fixed.style.boxShadow = `0px 2.8px 6.4px rgba(0, 0, 0, 0.02),
        0px 6.7px 15.3px rgba(0, 0, 0, 0.028),
        0px 12.5px 28.8px rgba(0, 0, 0, 0.035),
        0px 22.3px 51.4px rgba(0, 0, 0, 0.042),
        0px 41.8px 96.1px rgba(0, 0, 0, 0.05),
        0px 100px 230px rgba(0, 0, 0, 0.07)`;
    }else{
        top_fixed.style.boxShadow = "unset";
    }},200);
});
//
//
//
//
//
// Show/hide top fixed menu
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
// Make changes to the cart list
// start
//
//
//
//
//
let check_edit = 0;

let cart_edit = function() {
    
    if(check_edit == 0){
        cart_edit_btn.innerText = 'Done';
        check_edit = 1;
    }else if(check_edit == 1){
        cart_edit_btn.innerText = 'Edit';
        check_edit = 0;
    }

    for(let i = 0; i < product_items.length; i++){
        product_items[i].classList.toggle('cart__item-wrapper--delete');
        delete_product_button[i].classList.toggle('cart__item-delete--active');
        edit_item[i].classList.toggle('cart__item-edit--active');
    }

}

for(let i = 0; i < cart_item_wrapper.length; i++){
    cart_item_wrapper[i].addEventListener('click', function () {
        if(check_edit == 1){
            cart_edit();
        }
    })
}  

cart_edit_btn.addEventListener('click', cart_edit, false);
//
//
//
//
//
// Make changes to the cart list
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
// Functions for modal window product
// start
//
//
//
//
//

// Open modal window
let open_product = function () {
 
    // Setting the values of the current product for the modal window
    modal_img.src = this.getAttribute('data-img');
    modal_title.innerText = this.querySelector('.cart__item-name').innerText;
    modal_desc.innerText = this.getAttribute('data-desc');

    // Visual setting
    wrapper_product.style.display = 'block';
    product_block.scrollTo(0, 0);
    setTimeout(function () {
        product_block.style.transform = 'unset';
    }, 100);
    document.body.style.overflow = "hidden";

    // Taking the current data of this product
    let id = this.getAttribute('data-id');
    let product_quantity = this.querySelector('#cart_quantity').innerText;
    price_product_number = parseFloat(this.getAttribute('data-price')).toFixed(2);

    // Visual setting for button "Update"
    price_product_delete.style.opacity = 0;
    add_product.style.background = "#36d286";
    price_product.style.opacity = 1;
    add_product_text.style.opacity = 1;
    
    // Dynamically setting values for the selected product
    add_product.setAttribute('data-id', id);
    add_product.setAttribute('data-quantity', quantity_product.innerText);
    remove_item.setAttribute('data-price', price_product_number);
    add_item.setAttribute('data-price', price_product_number);
    quantity_product.innerText = product_quantity;
    price_product_number = Big(parseInt(product_quantity)).times(price_product_number).toFixed(2)
    remove_item.style.opacity = '1';
    price_product.innerText = price_product_number.replace('.', ',') + ' €';

}
for (let i = 0; i < product_items.length; i++) {
    product_items[i].addEventListener('click', open_product, false);
}

// Close modal window
let close_modal = function () {

    product_block.style.transform = 'translateY(200%)';
    document.body.style.overflow = "auto";
    setTimeout(function () {
        wrapper_product.style.display = 'none';
        modal_img.src = "";
    }, 200);
    
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
    let quantity_number = parseInt(quantity_product.innerText);
    let this_price = this.getAttribute('data-price');

    if (quantity_number !== 0) {

        quantity_number = --quantity_number;
        quantity_product.innerText = quantity_number;

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

    add_product.setAttribute('data-quantity', quantity_product.innerText);
});

// Adding the quantity and price of the product
add_item.addEventListener('click', function () {

    let price_actual = parseFloat(price_product.innerText.replace(',', '.')).toFixed(2);
    let quantity_number = parseInt(quantity_product.innerText);
    let this_price = this.getAttribute('data-price');

    if(quantity_number == 0){
        price_product_delete.style.opacity = 0;
        add_product.style.background = "#36d286";
        price_product.style.opacity = 1;
        add_product_text.style.opacity = 1;
    }

    price_actual = Big(price_actual).add(this_price).toFixed(2) + " €";
    price_product.innerText = price_actual.replace('.', ',');

    quantity_number = ++quantity_number;
    quantity_product.innerText = quantity_number;

    remove_item.style.opacity = '1';

    add_product.setAttribute('data-quantity', quantity_product.innerText);
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
// Update item product in cart list
// start
//
//
//
//
//
let cart = function () {

    let path;

    if(lng == 'lv'){
        path = "server/product.php";
    }else{
        path = "../server/product.php";
    }
    const uri = path;
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    let id = this.getAttribute('data-id');
    let current_quantity = document.querySelector('[data-id="'+id+'"]').querySelector('#cart_quantity');
    let current_price = document.querySelector('[data-id="'+id+'"]').querySelector('#cart_price');
    let quantity = quantity_product.innerText;
    let price = parseFloat(price_product.innerText.replace(',', '.')).toFixed(2);
    let check_session = 1;

    if(price == 0.00){
        delete_product_2();
        return;
    }

    current_quantity.innerText = quantity;
    current_price.innerText = price.replace('.', ',');

    xmlhttp.open("POST", uri, true);

    

    xmlhttp.onreadystatechange = function () {

        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            console.log(xmlhttp.responseText);
            order_price.innerText = xmlhttp.responseText.replace('.', ',') + ' €';
            total_price.innerText = xmlhttp.responseText.replace('.', ',') + ' €';
            
        }

    };
    console.log(path);
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
// Update item product in cart list
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
// Delete item product
// start
//
//
//
//
//
let delete_product = function(e){

    e.stopPropagation();

    if(lng == 'lv'){
        path = "server/cart.php";
    }else{
        path = "../server/cart.php";
    }

    const uri = path;
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    xmlhttp.open("POST", uri, true);

    let parent = this.parentElement;
    let item_id = parent.querySelector('.cart__item-wrapper').getAttribute('data-id');

    parent.style.transform = 'translateX(-120%)';
    parent.style.opacity = '0';
    
    setTimeout(function () {
        parent.remove();
    }, 500);

    check_empty++;

    // Checking empty cart or not
    if(product_items.length == check_empty){
        document.body.style.overflow = "hidden";
        cart_edit_btn.style.display = 'none';
        cart_empty.style.transform = 'translateY(0)';
    }

    xmlhttp.onreadystatechange = function () {

        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            // Update total price
            if(xmlhttp.responseText !== 'empty'){
                order_price.innerText = xmlhttp.responseText.replace('.', ',') + ' €';
                total_price.innerText = xmlhttp.responseText.replace('.', ',') + ' €';
            }
            
        }

    }
    
    fd.append('delete_product', item_id);

    xmlhttp.send(fd);

}
for(let i = 0; i < delete_product_button.length; i++){

    edit_item[i].addEventListener('click', function (e) {
        e.stopPropagation();
        product_items[i].dispatchEvent(new Event("click"));
    });

    delete_product_button[i].addEventListener('click', delete_product, false);
}
//
//
//
//
//
// Delete item product
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
// Delete item product from modal window
// start
//
//
//
//
//
let delete_product_2 = function(e){

    if(lng == 'lv'){
        path = "server/cart.php";
    }else{
        path = "../server/cart.php";
    }

    const uri = path;
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    xmlhttp.open("POST", uri, true);

    let id = add_product.getAttribute('data-id');
    let product_item = document.querySelector('[data-id="'+id+'"]').parentElement;
    
    check_empty++;


    product_item.style.transform = 'translateX(-120%)';
    product_item.style.opacity = '0';
    setTimeout(function () {
        product_item.style.display = 'none';
    }, 500);

    // Checking empty cart or not
    if(product_items.length == check_empty){
        document.body.style.overflow = "hidden";
        cart_edit_btn.style.display = 'none';
        cart_empty.style.transform = 'translateY(0)';
    }
    
    xmlhttp.onreadystatechange = function () {

        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            // Update total price
            if(xmlhttp.responseText !== 'empty'){
                order_price.innerText = xmlhttp.responseText.replace('.', ',') + ' €';
                total_price.innerText = xmlhttp.responseText.replace('.', ',') + ' €';
            }

        }

    }

    close_modal();
    
    fd.append('delete_product', id);

    xmlhttp.send(fd);

}
//
//
//
//
//
// Delete item product from modal window
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
// Generation json from ordered products
// start
//
//
//
//
//
let generate_json = function(e){


    let product_items_json = document.querySelectorAll('.cart__item-wrapper');


    let products_object = [];

    for(let i = 0; i < product_items_json.length; i++){

        let item = {
            
            "product_id" : product_items_json[i].getAttribute('data-id'),
            "product_quantity" : product_items_json[i].querySelector('#cart_quantity').innerText,
            "product_name" : product_items_json[i].querySelector('.cart__item-name').innerText,
            "product_price" : product_items_json[i].querySelector('.cart__item-price').innerText,
            "product_date" : product_items_json[i].getAttribute('data-date'),
            "product_day" : product_items_json[i].querySelector('#cart_day').innerText,
            "product_finish" : "0",

        }
        products_object.push(item);
    }
    
    
    return JSON.stringify(products_object);



};
//
//
//
//
//
// Generation json from ordered products
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
var save_order = function(){


    // Checking if the address line is full
    if(delivery_address_inp.value.length < 3){
        delivery_address_inp.classList.add('warning');
        return;
    }

    if(generate_json() == '[]'){
        return;
    }

    save_order_btn.style.pointerEvents = 'none';

    let ids_string = '';
    let product_items = document.querySelectorAll('.cart__item-wrapper');

    for(let i = 0; i < product_items.length; i++){

        let id = product_items[i].getAttribute('data-id');

        if(id.length > 0){
            ids_string += id + '|||';
        }   
    
    }

    if(lng == 'lv'){
        path = "server/cart.php";
    }else{
        path = "../server/cart.php";
    }

    const uri = path;
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    xmlhttp.open('POST', uri, true);

    xmlhttp.onreadystatechange = function(){

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

            // Checking auth user 
            if(xmlhttp.responseText == 1){
                modal_notice.style.display = 'flex';
            }else{

                modal_auth_cart.style.display = "block";
                modal_auth_cart.querySelector('.modal__auth-check').style.display = 'block';
                setTimeout(function () {
                    modal_auth_cart.querySelector('.modal__block-auth').style.transform = 'unset';
                }, 100);
                save_order_btn.style.pointerEvents = 'auto';
                document.body.style.overflow = 'hidden';

            }

        }

    }

    let ordered_products = generate_json();
    let delivery_address = delivery_address_inp.value;
    let order_price_value = order_price.innerText.replace(',','.').slice(0, -1);
    let comments = comments_inp.value;

    fd.append('save_order', delivery_address);
    fd.append('ids_cart', ids_string);
    fd.append('total', order_price_value);
    fd.append('comments', comments);
    fd.append('ordered_products', ordered_products);

    xmlhttp.send(fd);    

};
if(save_order_btn){
    save_order_btn.addEventListener('click', save_order, false);
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
for(let i = 0; i < auth_no.length; i++){
    auth_no[i].addEventListener('click', function(){
        modal_auth_cart.querySelector('.modal__auth-check').style.display = 'none';
        login_block.style.display = 'none';
        reg_block.style.display = 'block';
    });
}
for(let i = 0; i < auth_yes.length; i++){
    auth_yes[i].addEventListener('click', function(){
        modal_auth_cart.querySelector('.modal__auth-check').style.display = 'none';
        reg_block.style.display = 'none';
        login_block.style.display = 'block';
    });
}

close_modal_auth.addEventListener('click', function() {

    modal_auth_cart.querySelector('.modal__block-auth').style.transform = 'translateY(200%)';

    document.body.style.overflow = 'auto';

    setTimeout(function () {
        modal_auth_cart.style.display = "none";
        reg_block.style.display = 'none';
        login_block.style.display = 'none';
        modal_auth_cart.querySelector('.modal__auth-check').style.display = 'none';
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