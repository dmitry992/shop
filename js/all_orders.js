// Settings for calendar
const calendar = flatpickr("#select_date", {
    altInput: true,
    dateFormat: "d.m.Y",
    altFormat: "d.m.Y",
    defaultDate: "today",
    static: true,
    disableMobile: "true"
});

// Variables for calendar
let calendar_value = document.getElementById('select_date');
let calendar_block = document.querySelector('.flatpickr-days');

// Variables for dynamic loading of orders
let wrapper_items = document.querySelector('.orders__items');
let change_status_btn = document.getElementById('change_status_btn');
let completed_orders_btn = document.getElementById('completed_orders_btn');
let orders_check = null;
let finish_btn;

// Variables for modal window
let modal_ok = document.getElementById('modal_ok');
let close_modal_ok = document.getElementById('close_modal_ok');



















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
let check_order = function(){

    const uri = "../server/all_orders.php";
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    xmlhttp.open("POST", uri, true);

    xmlhttp.onreadystatechange = function () {

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

            wrapper_items.innerHTML = xmlhttp.responseText;
            finish_btn = document.querySelectorAll('.orders__finish-btn');

            for(let i = 0; i < finish_btn.length; i++){
                finish_btn[i].addEventListener('click', finish_order, false);
            }
        }

    }

    fd.append('check_order', calendar_value.value);
    
    xmlhttp.send(fd);

}

check_order();

// Function every 20 seconds checks the relevance of orders
orders_check = setInterval(check_order,20000);

calendar_block.addEventListener('click', check_order, false);

calendar_block.addEventListener('click', function(){

    // If interval off start again
    if(orders_check == null){
        orders_check = setInterval(check_order,20000);
    }

});
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
// Finish active order
// start
//
//
//
//
let finish_order = function(){

    const uri = "../server/all_orders.php";
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    xmlhttp.open("POST", uri, true);

    xmlhttp.onreadystatechange = function () {

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){


            if(xmlhttp.responseText == 1){

                check_order();
                modal_ok.querySelector('.modal__body-text').innerText = "Order has been finished";
                modal_ok.style.display = 'flex';

            }
            
        }

    }

    let main_order = this.getAttribute('data-id');
    let product_id = this.getAttribute('data-product-id');


    fd.append('finish_order', main_order);
    fd.append('product_id', product_id);
    
    xmlhttp.send(fd);

}

close_modal_ok.addEventListener('click', function(){
    modal_ok.style.display = 'none';
});
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
let change_status = function(){

    const uri = "../server/all_orders.php";
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    xmlhttp.open("POST", uri, true);

    xmlhttp.onreadystatechange = function () {

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){


            if(xmlhttp.responseText == 1){

                check_order();
                modal_ok.querySelector('.modal__body-text').innerText = "Lunch status has been changed";
                modal_ok.style.display = 'flex';

            }
            
        }

    }



    fd.append('change_status', 1);
    
    xmlhttp.send(fd);
}

change_status_btn.addEventListener('click', change_status, false);
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
let completed_orders = function(){

    const uri = "../server/all_orders.php";
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    clearInterval(orders_check);
    orders_check = null;

    xmlhttp.open("POST", uri, true);

    xmlhttp.onreadystatechange = function () {

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

            wrapper_items.innerHTML = xmlhttp.responseText;

        }

    }

    fd.append('completed_orders', 1);
    
    xmlhttp.send(fd);
}

completed_orders_btn.addEventListener('click', completed_orders, false);
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