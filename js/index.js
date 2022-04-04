// Reload page if user left page
document.addEventListener("visibilitychange", function() {
    window.location.reload ();
});

// Variables for fixed top menu 
let wrapper_top = document.querySelector('.wrapper__top');
// let menu_fix = document.querySelector('.wrapper__top-fix');

// Variables for content page
let product_wrapper = document.querySelector('.wrapper__content-items');
let lunch_block = document.querySelector('.wrapper__content-lunch');
let lunch_block_cls = document.querySelectorAll('.wrapper__content-close');

// Variables for timer
let timer_hours;
let timer_minutes;
let timer_seconds;
let today;
let day_week;
let next_day;
let id_timer = null;




for(let i = 0; i < lunch_block_cls.length; i++){
    lunch_block_cls[i].addEventListener('click', function(){
        lunch_block.style.transform = "translateX(200%)";
        document.body.style.overflow = 'auto';
    });
}



// Add/remove fixed top menu
// window.addEventListener('scroll', function(){

//     if(menu_fix.style.display !== "none"){
//         if(window.pageYOffset > wrapper_top.scrollHeight){
//             menu_fix.classList.add('wrapper__top-fix--active');
//         }else{
//             menu_fix.classList.remove('wrapper__top-fix--active'); 
//         }
//     }
    
// });






//
//
//
//
//
// Timer for products
// start
//
//
//
//
//
let update_counter = function(){

    
    for(let i = 0; i < timer_hours.length; i++){

        let hours_left = Math.floor(parseInt(timer_hours[i].innerText) - 0);
        let minutes_left = Math.floor(parseInt(timer_minutes[i].innerText) - 0);
        let seconds_left = Math.floor(parseInt(timer_seconds[i].innerText) - 0);

        if(hours_left < 10){
            timer_hours[i].innerText = '0' + hours_left + ' :';
        }else{
            timer_hours[i].innerText = hours_left + ' :';
        }
        if(minutes_left < 10){
            timer_minutes[i].innerText = '0' + minutes_left + ' :';
        }else{
            timer_minutes[i].innerText = minutes_left + ' :';
        }

        timer_seconds[i].innerText = seconds_left;

        if(hours_left <= 0 && minutes_left <= 0 && seconds_left <= 0){

            
            if(next_day !== null){
                next_day.classList.add('product__item-active');
            }

            timer_hours[i].innerText = '23' + ' :';
            timer_minutes[i].innerText = '59' + ' :';
            timer_seconds[i].innerText = '59';

            today.classList.remove('product__item-active');
            today.classList.remove('product__item');
            today.classList.add('wrapper__slider-item--no_access');
            
            if(!today.querySelector('.no_access')){
                today.insertAdjacentHTML("beforeend",`
                    <div class="no_access"></div>`
                );
            }
            
        }else{
            if(seconds_left <= 10){

                timer_seconds[i].innerText = seconds_left - 1;
                timer_seconds[i].innerText = '0' + timer_seconds[i].innerText;
    
                if(seconds_left <= 0){
    
                    timer_seconds[i].innerText = seconds_left + 59;
                    minutes_left = minutes_left - 1;
    
                    if(minutes_left < 10){

                        timer_minutes[i].innerText = '0' + Math.floor(parseInt(timer_minutes[i].innerText) - 1) + ' :';
    
                        if(minutes_left < 0){
    
                            if(hours_left >= 1){
    
                                timer_minutes[i].innerText = minutes_left + 60 + ' :';
                                hours_left = hours_left - 1;
                                if(hours_left < 10){
                                    timer_hours[i].innerText = '0' + Math.floor(parseInt(timer_hours[i].innerText) - 1) + ' :';
                                }else{
                                    timer_hours[i].innerText = Math.floor(parseInt(timer_hours[i].innerText) - 1) + ' :';
                                }
    
                            }
                            
                        }
    
                    }else{

                        timer_minutes[i].innerText = Math.floor(parseInt(timer_minutes[i].innerText) - 1) + ' :';

                    }
                    
                }

            }else{

                timer_seconds[i].innerText = seconds_left - 1;

            }

        }

    }

}
//
//
//
//
//
// Timer for products
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
// Getting all categories
// start
//
//
//
//
//
let get_categories = function () {
    
    if(lng == 'lv'){
        path = "server/product.php";
    }else{
        path = "../server/product.php";
    }
    
    const uri = path;
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();


    xmlhttp.open('POST', uri, true);

    xmlhttp.onreadystatechange = function () {

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            
            product_wrapper.innerHTML += xmlhttp.responseText;

            let link_all = document.querySelectorAll('.wrapper__content-all');

            // Setting for lunch menu
            // start
            timer_hours = document.querySelectorAll("#timer_hours");
            timer_minutes = document.querySelectorAll("#timer_minutes");
            timer_seconds = document.querySelectorAll("#timer_seconds");
            today = document.querySelector('.product__item-active');
            
            if(today){
                day_week = today.getAttribute('data-day');
            }

            if(day_week < 5){
                next_day = document.querySelector('[data-day="'+(parseInt(day_week) + 1)+'"]');
            }else{
                next_day = null;
            }

            if(parseInt(timer_hours[0].innerText) < 11){
                
                for(let i = 0; i < timer_hours.length; i++){
                    
                    timer_hours[i].innerText = Math.floor(11 - (parseInt(timer_hours[i].innerText) + 1));
                    timer_minutes[i].innerText = Math.floor(60 - (parseInt(timer_minutes[i].innerText) + 1));
                    timer_seconds[i].innerText = Math.floor(60 - parseInt(timer_seconds[i].innerText));
                    
                }

            }else{

                for(let i = 0; i < timer_hours.length; i++){
                    
                    timer_hours[i].innerText = Math.floor(35 - (parseInt(timer_hours[i].innerText) + 1));
                    timer_minutes[i].innerText = Math.floor(60 - (parseInt(timer_minutes[i].innerText) + 1));
                    timer_seconds[i].innerText = Math.floor(60 - parseInt(timer_seconds[i].innerText));
                    
                }

            }


            update_counter();
            id_timer = setInterval(update_counter,1000);
            // Setting for lunch menu
            // finish

            check_cart();  
        
            let product_items = document.querySelectorAll('.product__item');

            for(let i = 0; i < product_items.length; i++){
                product_items[i].addEventListener('click', open_product, false);
            }

            for(let i = 0; i < link_all.length; i++){
                link_all[i].addEventListener('click', send_category, false);
            }


            // Library for slider
            new Swiper('.swiper-container',{
                slidesPerView: "auto",
                spaceBetween: 15,

            });

        }
        
    };

    fd.append('get_categories', 1);

    xmlhttp.send(fd);
}
get_categories();
//
//
//
//
//
// Getting all categories
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
// Getting all products 
// start
//
//
//
//
//
let get_products = function (categories){

    if(lng == 'lv'){
        path = "server/product.php";
    }else{
        path = "../server/product.php";
    }

    const uri = path;
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    xmlhttp.open('POST', uri, true);

    let ids_string = '';
   
    for(let i = 0; i < categories.length; i++){

        let id = categories[i].getAttribute('data-category');

        if(id.length > 0){
            ids_string += id+'|||';
        }   
    
    }
    
    xmlhttp.onreadystatechange = function () {

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

            let response = JSON.parse(xmlhttp.responseText);
            
            for(let i = 0; i < response.length; i++){

                let index = response[i].product_index;
                   
                for(let j = 0; j < categories.length;j++){    

                    if(categories[j].getAttribute('data-category') == index){
                        categories[j].innerHTML += response[i].products;
                    }

                }
                
            }

            // let product_items = document.querySelectorAll('.product__item');
            // for(let i = 0; i < product_items.length; i++){
            //     product_items[i].addEventListener('click', open_product, false);
            // }
            // check_cart();  
        }
    
    };

    fd.append('get_products', 1);
    fd.append('ids', ids_string);
    
    xmlhttp.send(fd);
    
}
//
//
//
//
//
// Getting all products 
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
// Category record for which products will be received for "all_products.php"
// start
//
//
//
//
//
let send_category = function () {
    
    if(lng == 'lv'){
        path = "server/product.php";
    }else{
        path = "../server/product.php";
    }

    const uri = path;
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    let categoty = this.getAttribute('data-category');

    xmlhttp.open('POST', uri, true);

    xmlhttp.onreadystatechange = function () {

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            // location.href = 'http://shop/all_products.php';
            location.href = 'https://piegade247.eu/all_products.php';
        }
        
    };

    fd.append('send_category', categoty);

    xmlhttp.send(fd);
}
//
//
//
//
//
// Category record for which products will be received for "all_products.php"
// finish
//
//
//
//
//

