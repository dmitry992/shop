// Variables for fixed top menu
let top_fixed = document.querySelector('.header__fixed'); 
let menu_fixed = document.getElementById('menu_fixed');
let category_top = document.getElementById('category_top'); 
let nav_items = document.querySelector('.all-product__nav-items');
// let modal_block_categories = document.querySelector('.modal__block-categories');
let category_title = document.querySelector('.header__fixed-title');

// Variables for additional menu with categories
let menu_modal = document.getElementById('menu_modal');
let menu_block = document.getElementById('menu_block'); 
let close_menu = document.getElementById('close_menu');
let burger_menu = document.getElementById('burger_menu');
let product_wrapper = document.querySelector('.all-product__content');







//
//
//
//
//
// Getting all subcategories
// start
//
//
//
//
//
let get_categories = function () {

    const uri = "server/product.php";
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();


    xmlhttp.open('POST', uri, true);

    xmlhttp.onreadystatechange = function () {

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            
            let response = JSON.parse(xmlhttp.responseText);
            let count = 0;
            for(let i = 0; i < response.length; i++){
                count++;
                product_wrapper.innerHTML += response[i].wrapper_category;
                category_top.innerHTML += '<a class="all-product__categories-item"  href="#subcategory'+ count +'">' + response[i].subcategories + '</a>';
                nav_items.innerHTML += '<a class="all-product__nav-item" href="#subcategory'+ count +'">' + response[i].subcategories + '</a>';
                // modal_block_categories.innerHTML += '<a class="modal__block-category" href="#subcategory'+ count +'">'+ response[i].subcategories +'</a>';
                category_title.innerText = response[i].category;
            }
           
            
            let subcategories = document.querySelectorAll('.all-product__category-inner');
            get_products(subcategories);
        }
        
    };

    fd.append('get_categories', 2);

    xmlhttp.send(fd);
}
get_categories();
//
//
//
//
//
// Getting all subcategories
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
let get_products = function (subcategories){

    const uri = "server/product.php";
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    xmlhttp.open('POST', uri, true);

    let ids_string = '';
   
    for(let i = 0; i < subcategories.length; i++){

        let id = subcategories[i].getAttribute('data-subcategory');

        if(id.length > 0){
            ids_string += id+'|||';
        }   
    
    }

    xmlhttp.onreadystatechange = function () {

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            
            let response = JSON.parse(xmlhttp.responseText);
            
            for(let i = 0; i < response.length; i++){

                let index = response[i].product_index;
                   
                for(let j = 0; j < subcategories.length;j++){    

                    if(subcategories[j].getAttribute('data-subcategory') == index){
                        subcategories[j].innerHTML += response[i].products;
                    }

                }
                
            }

            let product_items = document.querySelectorAll('.product__item');

            for(let i = 0; i < product_items.length; i++){
                product_items[i].addEventListener('click', open_product, false);
            }
            check_cart();  
        }
    
    };

    
    fd.append('get_products', 2);
    fd.append('ids', ids_string);

    xmlhttp.send(fd);
    
}
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

    setTimeout(function() {
        if(window.pageYOffset > category_top.offsetHeight){
            menu_fixed.style.display = "flex";
        }else{
            menu_fixed.style.display = "none";
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
// Show/hide additional menu with categories
// start
//
//
//
//
//
burger_menu.addEventListener('click', function(){
    menu_modal.style.display = "block";
    setTimeout(function() {
    menu_block.style.transform = 'translateY(0%)';
    },200);
    document.body.style.overflow = "hidden";
});

close_menu.addEventListener('click', function(){
    menu_block.style.transform = 'translateY(200%)';
    setTimeout(function() {
        menu_modal.style.display = 'none';
    },200);
    document.body.style.overflow = "auto";
});
//
//
//
//
//
// Show/hide additional menu with categories
// start
//
//
//
//
//
















let  links = document.querySelectorAll('a[href^="#category"]');

for(let i = 0; i < links.length; i++){

    function scrollTo() {
        let id = this.getAttribute('href');
        
        let offset = 0;
        let speed = 20;
        let to = document.querySelector(id).getBoundingClientRect().top + window.pageYOffset;
        console.log(to);
        let dy = to - window.pageYOffset + offset;
        
        let moreZero = (dy >= 0)? 1 : -1;
        let dist = dy * moreZero;
        let step = speed * moreZero;
        console.log(step);
        window.requestAnimationFrame((scroll = function() {
            
            if(window.pageYOffset > to){
                window.scrollBy(0, 50);
                console.log(step);
                window.requestAnimationFrame(scroll);
            }
        }));
    }
    links[i].addEventListener('click',scrollTo, false);
        
}
links.forEach(item => item.addEventListener('click',
 function(e) {
	e.preventDefault();
	const id = item.getAttribute('href').slice(1);

	document.getElementById(id).scrollIntoView({
		behavior: 'smooth',
		block: 'start'
	});
}));

   