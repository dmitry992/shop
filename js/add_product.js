// Variables for list product/lunch
let table = document.getElementById('table');
let table_lunch = document.getElementById('table_lunch');
let table_lunch_ru = document.getElementById('table_lunch_ru');
let table_lunch_en = document.getElementById('table_lunch_en');
let change_status_btn = document.getElementById('change_status_btn');
let change_lunch_lng;

// Variables for add product modal window
let open_modal = document.getElementById('open_modal');
let add_product_modal = document.getElementById('add_product_modal');
let product_title = document.getElementById('product_title');
let product_desc = document.getElementById('product_desc');
let product_price = document.getElementById('product_price');
let category_selected = document.getElementById('category_selected');
let select_ctg_btn = document.getElementById('select_ctg_btn');
let subcategory_selected = document.getElementById('subcategory_selected');
let category_list = document.getElementById('category_list');
let select_subctg_btn = document.getElementById('select_subctg_btn');
let subcategory_list = document.getElementById('subcategory_list');
let upload_image = document.getElementById('upload_image');
let img = document.getElementById("img");
let select_image = document.getElementById('select_image');
let add_product_btn = document.getElementById('add_product_btn');
let cls_modal_btn = document.getElementById('cls_modal_add');
let check_ctg;
let check_subctg;
let check_image = 0;

// Variables for change product modal window
let change_product_modal = document.getElementById('change_product_modal');
let cls_modal_change = document.getElementById('cls_modal_change');
let change_input = document.getElementById('change_input');
let change_textarea = document.getElementById('change_textarea');
let change_value_input = document.getElementById('change_value_input');
let change_value_textarea = document.getElementById('change_value_textarea');
let change_selectors = document.querySelector('.add-product__modal-selectors');
let change_ctg_btn = document.getElementById('change_ctg_btn');
let change_category_selected = document.getElementById('change_category_selected');
let change_category_list = document.getElementById('change_category_list');
let change_subctg_btn = document.getElementById('change_subctg_btn');
let change_subcategory_selected = document.getElementById('change_subcategory_selected');
let change_subcategory_list = document.getElementById('change_subcategory_list');
let change_text = document.querySelectorAll('#change_text');
let change_block_image = document.querySelector('.modal__change-image');
let change_img = document.getElementById('change_img');
let change_select_image = document.getElementById('change_select_image');
let change_upload_image = document.getElementById('change_upload_image');
let change_product_btn = document.getElementById('change_product_btn');
let change_image_btn = document.getElementById('change_image_btn');
let past_img;
let change_column;
let change_value;
let change_id;
let query_check;
let ctg_active;
let current_status;
let change_check_ctg = 0;

// Variables for change lunch modal window
let change_lunch_modal = document.getElementById('change_lunch_modal');
let change_lunch_btn = document.getElementById('change_lunch_btn');
let change_input_lunch = document.getElementById('change_input_lunch');
let change_textarea_lunch = document.getElementById('change_textarea_lunch');
let change_lunch_text = document.querySelectorAll('#change_lunch_text');
let change_value_input_lunch = document.getElementById('change_value_input_lunch');
let change_value_textarea_lunch = document.getElementById('change_value_textarea_lunch');
let cls_lunch_change = document.getElementById('cls_lunch_change');
let change_image_lunch_btn = document.getElementById('change_image_lunch_btn');
let change_select_lunch_image = document.getElementById('change_select_lunch_image');
let change_upload_lunch_image = document.getElementById('change_upload_lunch_image');
let change_lunch_img = document.getElementById('change_lunch_img');
let change_block_image_lunch = document.querySelector('.modal__change-image--lunch');
let change_lunch_column;
let change_lunch_id;

// Variables for error modal windows
let attention_modal = document.getElementById('attention_modal');
let attention_list = document.getElementById('attention_list');
let attention_cls = document.getElementById('attention_cls');

// Variables for message modal windows
let message_modal = document.getElementById('message_modal');
let message_cls = document.getElementById('message_cls');
let message_title = document.getElementById('message_title');
let message_btn = document.getElementById('message_btn');

// Variables for confirm action modal windows
let confirm_modal = document.getElementById('confirm_modal');
let confirm_yes = document.getElementById('confirm_yes');
let confirm_no = document.getElementById('confirm_no');
let status_title = document.getElementById('status_title');









//
//
//
//
//
// Getting list products
// start
//
//
//
//
//
let product_list = function(){

    const uri = "../server/add_product.php";
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    xmlhttp.open('POST', uri, true);

    xmlhttp.onreadystatechange = function(){

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

            table.innerHTML = xmlhttp.responseText;

            get_categories();

            let product_items = document.querySelectorAll('.add-product__row');
            let product_value = document.querySelectorAll('.table__row-item');
            let product_status = document.querySelectorAll('.table__row-item--id');

            
            for(let i = 0; i < product_items.length; i++){

                product_items[i].addEventListener('mouseover', function(){
                    this.querySelector('.table__row-item-change').style.opacity = '1';
                });
                product_items[i].addEventListener('mouseout', function(){
                    this.querySelector('.table__row-item-change').style.opacity = '0';
                });
                
                product_items[i].addEventListener('click', function(){

                    for(let j = 0; j < product_items.length; j++){
                        
                        if(product_items[j].style.background == "rgb(230, 230, 230)"){
                            product_items[j].style.background = "none";
                        }
                        this.style.background = "rgb(230, 230, 230)";
                    }

                });

            }
            
            for(let i = 0; i < product_value.length; i++){
                product_value[i].addEventListener('click', open_change_modal, false);
            }

            // Changing status product
            for(let i = 0; i < product_status.length; i++){

                if(product_status[i].getAttribute('data-status') == 0){

                    product_status[i].classList.add('table__row-item--hide');
                    product_status[i].querySelector('.table__row-item-change').classList.add('table__row-item-change--return');

                }

                product_status[i].addEventListener('click', function(){

                    confirm_modal.style.display = 'flex';
                    confirm_yes.style.pointerEvents = "auto";
                    status_title.innerText = this.getAttribute('data-name');
                    change_id = this.parentElement.getAttribute('data-id');
                    current_status = this.getAttribute('data-status');

                });

            }

        }

    }

    fd.append('product_list', 1);

    xmlhttp.send(fd);


};
product_list();
//
//
//
//
//
// Getting list products
// finish
//
//
//
//
//







// Functions for clearing old values and show/hide add product modal window
let clear_value = function(){
    product_title.value = '';
    product_desc.value = '';
    product_price.value = '';
    category_selected.innerText = '';
    subcategory_selected.innerText = '';
    img.src = "";
    select_image.value = "";
    upload_image.innerText = "Upload image";
    check_image = 0;
    add_product_btn.style.pointerEvents = 'auto';
}
let close_modal = function(){
    document.body.style.overflow = 'auto';
    add_product_modal.style.display = 'none';
    clear_value();
};
open_modal.addEventListener('click', function(){
    clear_value();
    add_product_modal.style.display = 'block';
    document.body.style.overflow = 'hidden';
});
cls_modal_btn.addEventListener('click', close_modal, false);









// Functions for select categories/subcategories
select_ctg_btn.addEventListener('click', function(e){
    e.stopPropagation();
    subcategory_list.classList.remove('no-hide');
    category_list.classList.toggle('no-hide');
});

select_subctg_btn.addEventListener('click', function(e){
    e.stopPropagation();
    category_list.classList.remove('no-hide');
    subcategory_list.classList.toggle('no-hide');
});

document.addEventListener('click', function () {
    category_list.classList.remove('no-hide');
    subcategory_list.classList.remove('no-hide');
});









//
//
//
//
//
// Receiving all categories into a category selector to add a product
// start
//
//
//
//
//
let get_categories = function(){
    
    const uri = "../server/add_product.php";
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    
    xmlhttp.open("POST", uri, true);

    xmlhttp.onreadystatechange = function(){

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

            category_list.innerHTML = xmlhttp.responseText;

            let ctg_items = document.querySelectorAll('.add-product__select-ctg');

            for(let i = 0; i < ctg_items.length; i++){

                ctg_items[i].addEventListener('click', get_subcategories, false);

            }

        }

    }

    fd.append('get_categories', 1);

    xmlhttp.send(fd);
}
//
//
//
//
//
// Receiving all categories into a category selector to add a product
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
// Retrieving all subcategories by category
// start
//
//
//
//
//
let get_subcategories = function(){
    
    const uri = "../server/add_product.php";
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    let id = this.getAttribute('data-id');
    select_subctg_btn.style.pointerEvents = 'auto';
    select_subctg_btn.style.opacity = '1';
    category_selected.innerText = this.innerText;
    category_selected.setAttribute('data-id', this.getAttribute('data-id'));
    check_ctg = 1;

    xmlhttp.open("POST", uri, true);

    xmlhttp.onreadystatechange = function(){

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

            subcategory_list.innerHTML = xmlhttp.responseText;

            let subctg_items = document.querySelectorAll('.add-product__select-subctg');

            for(let i = 0; i < subctg_items.length; i++){

                subctg_items[i].addEventListener('click', function(){
                    
                    subcategory_selected.innerText = this.innerText;
                    subcategory_selected.setAttribute('data-id', this.getAttribute('data-id'));
                    check_subctg = 1;

                });

            }

        }
        
    }

    fd.append('get_subcategories', id);

    xmlhttp.send(fd);
}
//
//
//
//
//
// Retrieving all subcategories by category
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
// Functions for upload image in product modal window
// start
//
//
//
//
//
upload_image.addEventListener("click", function () {
    select_image.click();
});
select_image.addEventListener("change", function () {
    
    if (select_image.files[0].type.indexOf("image/") > -1) {
        check_image = 1;
        img.src = window.URL.createObjectURL(select_image.files[0]);
        upload_image.innerText = "Cancel";
    }
});
//
//
//
//
//
// Functions for upload image in product modal window
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
// Checking for completed fields before adding a product
// satrt
//
//
//
//
//
let check_add_product = function(){

    let flag = 0;


    if(product_title.value.length < 5){
        attention_list.insertAdjacentHTML("beforeend",`
            <p class="attention-modal__list-text">
                Enter a product name
            </p>`
        );
        flag = 1;
    }

    if(product_desc.value.length < 5){
        attention_list.insertAdjacentHTML("beforeend",`
            <p class="attention-modal__list-text">
                Enter description for this product
            </p>`
        );
        flag = 1;
    }
    if(product_price.value.length < 2){
        attention_list.insertAdjacentHTML("beforeend",`
            <p class="attention-modal__list-text">
                Enter price for this product
            </p>`
        );
        flag = 1;
    }

    if(check_ctg !== 1){
        attention_list.insertAdjacentHTML("beforeend",`
            <p class="attention-modal__list-text">
                Select category for this product
            </p>`
        );
        flag = 1;
    }

    if(check_subctg !== 1){
        attention_list.insertAdjacentHTML("beforeend",`
            <p class="attention-modal__list-text">
                Select subcategory for this product
            </p>`
        );
        flag = 1;
    }

    if(check_image == 0){
        attention_list.insertAdjacentHTML("beforeend",`
            <p class="attention-modal__list-text">
                Select an image
            </p>`
        );
        flag = 1;
    }

    if(flag == 1){
        attention_modal.style.display = "flex";
        return true;
    }else{
        return false;
    }

};

attention_cls.addEventListener('click', function(){
    let attention_items = document.querySelectorAll('.attention-modal__list-text');
    for(let i = 0; i < attention_items.length; i++){
        attention_items[i].remove();
    }
    attention_modal.style.display = "none";
}); 
//
//
//
//
//
// Checking for completed fields before adding a product
// satrt
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
// Adding product
// satrt
//
//
//
//
//
let add_product  = function(){
    

    if(check_add_product()){
        return;
    }

    const uri = "../server/add_product.php";
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    let title =  product_title.value;
    let desc =  product_desc.value;
    let price =  product_price.value;
    let category =  category_selected.getAttribute('data-id');
    let subcategory =  subcategory_selected.getAttribute('data-id');
    let files = select_image.files;
    let file = files[0];
    
    
    
    this.style.pointerEvents = 'none';

    xmlhttp.open("POST", uri, true);

    xmlhttp.onreadystatechange = function(){

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            
            if(xmlhttp.responseText == 1){
                
                // Close product modal window and getting actual list products
                close_modal();
                product_list();

                
            }

        }

    }

    fd.append('add_product', title);
    fd.append('desc', desc);
    fd.append('price', price);
    fd.append('category', category);
    fd.append('subcategory', subcategory);
    fd.append('image', file);

    xmlhttp.send(fd);
}

add_product_btn.addEventListener('click', add_product, false);
//
//
//
//
//
// Adding product
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
// Remove or return a product
// start
//
//
//
//
//
let change_status_fnc = function(){

    const uri = "../server/add_product.php";
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    let change_status;
    confirm_yes.style.pointerEvents = 'none';

    if(current_status == 1){
        change_status = 0;
    }else if(current_status == 0){
        change_status = 1;
    }
    
    xmlhttp.open("POST", uri, true);

    xmlhttp.onreadystatechange = function(){

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

            if(xmlhttp.responseText == 1){
                product_list();
                confirm_modal.style.display = 'none';
                message_modal.style.display = 'flex';
                message_title.innerText = 'Changes have been successfully applied'
            }

        }

    }
    
    
    fd.append('change_status', change_status);
    fd.append('change_id', change_id);

    xmlhttp.send(fd);
};

confirm_no.addEventListener('click', function(){
    confirm_modal.style.display = 'none';
});

confirm_yes.addEventListener('click', change_status_fnc, false);
//
//
//
//
//
// Remove or return a product
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
// Open modal window to change product
// start
//
//
//
//
//
let open_change_modal = function(){


    change_product_modal.style.display = "flex";
    document.body.style.overflow = "hidden";
    change_product_btn.style.pointerEvents = 'auto';

    if(this.getAttribute('data-type') == 'input'){

        change_input.style.display = 'block';
        change_id = this.getAttribute('data-id');
        query_check = 1;
        change_product_btn.style.display = 'inline-block';

        for(let i = 0; i < change_text.length; i++){
            change_text[i].innerText = this.getAttribute('data-name') + ' :';
        }

        if(this.getAttribute('data-name') == 'Title'){
            change_column = 'product_title';
            change_value_input.value = this.innerText; 
        }else if(this.getAttribute('data-name') == 'Price'){
            change_column = 'product_price';
            change_value_input.value = this.querySelector('.row_price').innerText; 
        }

    }else if(this.getAttribute('data-type') == 'textarea'){

        change_value_textarea.value = this.innerText;
        change_textarea.style.display = 'block';
        change_product_btn.style.display = 'inline-block';
        change_column = 'product_desc';
        change_id = this.getAttribute('data-id');
        query_check = 1;
        

        for(let i = 0; i < change_text.length; i++){
            change_text[i].innerText = this.getAttribute('data-name') + ' :';
        }

    }else if(this.getAttribute('data-type') == 'select'){

        let categories = document.querySelectorAll('[data-type = select]');
        change_id = this.getAttribute('data-id');
        query_check = 2;
        ctg_active = 0;
        change_selectors.style.display = 'block';
        change_product_btn.style.display = 'inline-block';

        for(let i = 0; i < categories.length; i++){

            if(this.getAttribute('data-id') == categories[i].getAttribute('data-id')){

                change_get_subcategories();

                change_category_selected.setAttribute('data-id', this.getAttribute('data-category-id'));
                change_subcategory_selected.setAttribute('data-id', this.getAttribute('data-subctg-id'));

                if(categories[i].getAttribute('data-category') == "main"){
                    change_category_selected.innerText = categories[i].innerText;
                }else if(categories[i].getAttribute('data-category') == "sub"){
                    change_subcategory_selected.innerText = categories[i].innerText;
                }
                
            }
        }

    }else if(this.getAttribute('data-type') == 'image'){
        change_image_btn.style.pointerEvents = 'auto';
        change_block_image.style.display = 'block';
        change_img.src = '../uploaded_images/' + this.getAttribute('data-img');
        past_img = '../uploaded_images/' + this.getAttribute('data-img');
        change_image_btn.style.display = 'inline-block';
        change_id = this.getAttribute('data-id');

    }

}

let change_value_clear = function() {
    change_product_modal.style.display = "none";
    change_input.style.display = 'none';
    document.body.style.overflow = "auto";
    change_selectors.style.display = 'none';
    change_textarea.style.display = 'none';
    change_block_image.style.display = 'none';
    change_img.src = '';
    change_image_btn.style.display = 'none';
    change_product_btn.style.display = 'none';
    change_check_ctg = 0;
    change_upload_image.innerText = 'Change image';

    change_lunch_btn.style.display = 'none';
    change_input_lunch.style.display = 'none';
    change_textarea_lunch.style.display = 'none';
}

cls_modal_change.addEventListener('click', change_value_clear, false);
//
//
//
//
//
// Open modal window to change product
// finish
//
//
//
//
//








// Functions for select for change categories/subcategories
change_ctg_btn.addEventListener('click', function(e){
    e.stopPropagation();
    change_subcategory_list.classList.remove('no-hide');
    change_category_list.classList.toggle('no-hide');
});

change_subctg_btn.addEventListener('click', function(e){
    e.stopPropagation();
    change_category_list.classList.remove('no-hide');
    change_subcategory_list.classList.toggle('no-hide');
});

document.addEventListener('click', function () {
    change_category_list.classList.remove('no-hide');
    change_subcategory_list.classList.remove('no-hide');
});









//
//
//
//
//
// Getting a list of categories to change the current category
// start
//
//
//
//
//
let change_get_categories = function(){

    const uri = "../server/add_product.php";
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();


    xmlhttp.open("POST", uri, true);

    xmlhttp.onreadystatechange = function(){

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

            change_category_list.innerHTML = xmlhttp.responseText;

            let change_ctg_items = document.querySelectorAll('.add-product__select-ctg');

            for(let i = 0; i < change_ctg_items.length; i++){
                ctg_active = 1;
                change_ctg_items[i].addEventListener('click', change_get_subcategories, false);
            }

        }

    }

    fd.append('change_get_categories', 1);

    xmlhttp.send(fd);
}

change_ctg_btn.addEventListener('click', change_get_categories, false);
//
//
//
//
//
// Getting a list of categories to change the current category
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
// Retrieving all subcategories by category to change the current
// start
//
//
//
//
//
let change_get_subcategories = function(){
    
    const uri = "../server/add_product.php";
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();



    if(ctg_active == 1){

        change_category_selected.innerText = this.innerText;
        change_category_selected.setAttribute('data-id', this.getAttribute('data-id'));
        change_check_ctg = 1;

    }

    let id = change_category_selected.getAttribute('data-id');
    change_subcategory_selected.innerText = '';

    xmlhttp.open("POST", uri, true);

    xmlhttp.onreadystatechange = function(){

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

            change_subcategory_list.innerHTML = xmlhttp.responseText;

            let change_subctg_items = document.querySelectorAll('.add-product__select-subctg');

            for(let i = 0; i < change_subctg_items.length; i++){

                change_subctg_items[i].addEventListener('click', function(){

                    change_subcategory_selected.innerText = this.innerText;
                    change_check_ctg = 0;
                    change_subcategory_selected.setAttribute('data-id', this.getAttribute('data-id'));

                });

            }

        }

    }

    fd.append('change_get_subcategories', id);

    xmlhttp.send(fd);
}
//
//
//
//
//
// Retrieving all subcategories by category to change the current
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
// Functions for change upload image
// start
//
//
//
//
//
change_upload_image.addEventListener("click", function () {
    change_select_image.click();
});
change_select_image.addEventListener("change", function () {
    
    if (change_select_image.files[0].type.indexOf("image/") > -1) {
        change_img.src = window.URL.createObjectURL(change_select_image.files[0]);
        check_image = 1;
        change_upload_image.innerText = "Cancel";
    }

});
//
//
//
//
//
// Functions for change upload image
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
// Checking before changing aproduct
// start
//
//
//
//
//
let check_change_product = function(){

    let flag = 0;
    if(change_input.style.display == "block"){
        if(change_value_input.value.length < 3){
            attention_list.insertAdjacentHTML("beforeend",`
                <p class="attention-modal__list-text">
                   Fill in the field
                </p>`
            );
            flag = 1;
        }
    }
    
    if(change_textarea.style.display == "block"){
        if(change_value_textarea.value.length < 3){
            attention_list.insertAdjacentHTML("beforeend",`
                <p class="attention-modal__list-text">
                    Fill in the field
                </p>`
            );
            flag = 1;
        }
    }
    if(change_check_ctg == 1){
        attention_list.insertAdjacentHTML("beforeend",`
            <p class="attention-modal__list-text">
                Select subcategory for this product
            </p>`
        );
        flag = 1;
    }
    
    if(flag == 1){
        attention_modal.style.display = "flex";
        return true;
    }else{
        return false;
    }
    
};
//
//
//
//
//
// Checking before changing aproduct
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
// Product change
// start
//
//
//
//
//
let change_product = function(){
    
    if(check_change_product()){
        return;
    }
    
    const uri = '../server/add_product.php';
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    
    let category = change_category_selected.getAttribute('data-id');
    let subcategory = change_subcategory_selected.getAttribute('data-id');

    change_product_btn.style.pointerEvents = 'none';

    // Checking which parameter needs to be changed for the product
    if(change_column == 'product_title' || change_column == 'product_price'){
        change_value = change_value_input.value;
    }else if(change_column == 'product_desc'){
        change_value = change_value_textarea.value;
    }
    
    
    xmlhttp.open('POST', uri, true);

    xmlhttp.onreadystatechange = function(){

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            
            if(xmlhttp.responseText == 1){

                // Getting actual product list
                product_list();

                change_product_modal.style.display = 'none';
                message_modal.style.display = 'flex';
                message_title.innerText = 'Changes have been successfully applied';

            }

        }

    }
    
    fd.append('change_product', change_value);
    fd.append('id', change_id);
    fd.append('change_column', change_column);
    fd.append('query_check', query_check);
    fd.append('category', category);
    fd.append('subcategory', subcategory);

    xmlhttp.send(fd);


};

change_product_btn.addEventListener('click', change_product, false);

message_btn.addEventListener('click', function(){
    message_modal.style.display = 'none';
    change_value_clear();
});
//
//
//
//
//
// Product change
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
// Change product image
// start
//
//
//
//
//
let change_image = function(){

    const uri = '../server/add_product.php';
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    let files = change_select_image.files;
    let file = files[0];

    change_image_btn.style.pointerEvents = 'none';

    xmlhttp.open('POST', uri, true);

    xmlhttp.onreadystatechange = function(){

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

            if(xmlhttp.responseText == 1){

                // Getting actual product list
                product_list();

                change_product_modal.style.display = 'none';
                message_modal.style.display = 'flex';
                message_title.innerText = 'Changes have been successfully applied';

            }

        }

    }

    fd.append('change_image', check_image);
    fd.append('image', file);
    fd.append('past_img', past_img);
    fd.append('id', change_id);

    xmlhttp.send(fd);
}

change_image_btn.addEventListener('click', change_image, false);
//
//
//
//
//
// Change product image
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
// Getting lunch menu
// start
//
//
//
//
//
let lunch_menu = function(){

    const uri = "../server/add_product.php";
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    xmlhttp.open('POST', uri, true);

    xmlhttp.onreadystatechange = function(){

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

            table_lunch.innerHTML = xmlhttp.responseText;

            let product_value = document.querySelectorAll('.lunch__row-item--change');

            for(let i = 0; i < product_value.length; i++){

                product_value[i].addEventListener('click', open_change_modal_2, false);

            }
            
        }

    }

    fd.append('lunch_menu', 1);

    xmlhttp.send(fd);

};

lunch_menu();
//
//
//
//
//
// Getting lunch menu
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
// Getting lunch menu ru
// start
//
//
//
//
//
let lunch_menu_ru = function(){

    const uri = "../server/add_product.php";
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    xmlhttp.open('POST', uri, true);

    xmlhttp.onreadystatechange = function(){

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

            table_lunch_ru.innerHTML = xmlhttp.responseText;

            let product_value = document.querySelectorAll('.lunch__row-item--change');

            for(let i = 0; i < product_value.length; i++){

                product_value[i].addEventListener('click', open_change_modal_2, false);

            }
            
        }

    }

    fd.append('lunch_menu_ru', 1);

    xmlhttp.send(fd);

};

lunch_menu_ru();
//
//
//
//
//
// Getting lunch menu ru
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
// Getting lunch menu en
// start
//
//
//
//
//
let lunch_menu_en = function(){

    const uri = "../server/add_product.php";
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    xmlhttp.open('POST', uri, true);

    xmlhttp.onreadystatechange = function(){

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

            table_lunch_en.innerHTML = xmlhttp.responseText;

            let product_value = document.querySelectorAll('.lunch__row-item--change');

            for(let i = 0; i < product_value.length; i++){

                product_value[i].addEventListener('click', open_change_modal_2, false);

            }
            
        }

    }

    fd.append('lunch_menu_en', 1);

    xmlhttp.send(fd);

};

lunch_menu_en();
//
//
//
//
//
// Getting lunch menu en
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
// Open modal window to change lunch menu
// start
//
//
//
//
//
let open_change_modal_2 = function(){

    change_lunch_modal.style.display = "flex";
    document.body.style.overflow = "hidden";
    change_lunch_btn.style.pointerEvents = 'auto';

    if(this.getAttribute('data-type') == 'input'){
   
        change_input_lunch.style.display = 'block';
        change_lunch_id = this.getAttribute('data-id');
        change_lunch_btn.style.display = 'inline-block';

        for(let i = 0; i < change_lunch_text.length; i++){
            change_lunch_text[i].innerText = this.getAttribute('data-name') + ' :';
        }

        if(this.getAttribute('data-name') == 'Title'){
            change_lunch_column = 'lunch_title';
            change_value_input_lunch.value = this.innerText; 
        }else if(this.getAttribute('data-name') == 'Price'){
            change_lunch_column = 'lunch_price';
            change_value_input_lunch.value = this.querySelector('.row_price').innerText; 
        }

    }else if(this.getAttribute('data-type') == 'textarea'){

        change_value_textarea_lunch.value = this.innerText;
        change_textarea_lunch.style.display = 'block';
        change_lunch_btn.style.display = 'inline-block';
        change_lunch_column = 'lunch_desc';
        change_lunch_id = this.getAttribute('data-id');
        
        for(let i = 0; i < change_lunch_text.length; i++){
            change_lunch_text[i].innerText = this.getAttribute('data-name') + ' :';
        }

    }else if(this.getAttribute('data-type') == 'image'){

        change_image_lunch_btn.style.pointerEvents = 'auto';
        change_block_image_lunch.style.display = 'block';
        change_lunch_img.src = '../uploaded_images/' + this.getAttribute('data-img');
        past_img = '../uploaded_images/' + this.getAttribute('data-img');
        change_image_lunch_btn.style.display = 'inline-block';
        change_lunch_id = this.getAttribute('data-id');

    }

    change_lunch_lng = this.getAttribute('data-language');

}

let change_value_clear_2 = function() {
    change_lunch_modal.style.display = "none";
    change_input_lunch.style.display = 'none';
    document.body.style.overflow = "auto";
    change_textarea_lunch.style.display = 'none';
    change_block_image_lunch.style.display = 'none';
    change_lunch_img.src = '';
    change_image_lunch_btn.style.display = 'none';
    change_lunch_btn.style.display = 'none';
    change_upload_lunch_image.innerText = 'Change image'
}

cls_lunch_change.addEventListener('click', change_value_clear_2, false);
//
//
//
//
//
// Open modal window to change lunch menu
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
// Functions for change lunch menu upload image
// start
//
//
//
//
//
change_upload_lunch_image.addEventListener("click", function () {
    change_select_lunch_image.click();
});
change_select_lunch_image.addEventListener("change", function () {
    
    if (change_select_lunch_image.files[0].type.indexOf("image/") > -1) {
        change_lunch_img.src = window.URL.createObjectURL(change_select_lunch_image.files[0]);
        check_image = 1;
        change_upload_lunch_image.innerText = "Cancel";
    }

});
//
//
//
//
//
// Functions for change lunch menu upload image
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
// Checking before changing lunch menu
// start
//
//
//
//
//
let check_change_lunch = function(){
    
    let flag = 0;

    if(change_input_lunch.style.display == "block"){
        
        if(change_value_input_lunch.value.length < 3){
            
            attention_list.insertAdjacentHTML("beforeend",`
                <p class="attention-modal__list-text">
                   Fill in the field
                </p>`
            );
            flag = 1;
           
        }
    }
    
    if(change_textarea_lunch.style.display == "block"){
        if(change_value_textarea_lunch.value.length < 3){
            attention_list.insertAdjacentHTML("beforeend",`
                <p class="attention-modal__list-text">
                    Fill in the field
                </p>`
            );
            flag = 1;
        }
    }

    
    if(flag == 1){
        attention_modal.style.display = "flex";
        return true;
    }else{
        return false;
    }
    
};
//
//
//
//
//
// Checking before changing lunch menu
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
// Changing lunch menu
// start
//
//
//
//
//
let change_lunch = function(){
    
    if(check_change_lunch()){
        return;
    }
    
    const uri = '../server/add_product.php';
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    change_lunch_btn.style.pointerEvents = 'none';

    // Checking which parameter needs to be changed for the product
    if(change_lunch_column == 'lunch_title' || change_lunch_column == 'lunch_price'){
        change_value = change_value_input_lunch.value;
    }else if(change_lunch_column == 'lunch_desc'){
        change_value = change_value_textarea_lunch.value;
    }
    
    xmlhttp.open('POST', uri, true);

    xmlhttp.onreadystatechange = function(){

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            
            if(xmlhttp.responseText == 1){

                // Getting the actual lunch menu after changing
                lunch_menu();
                lunch_menu_ru();
                lunch_menu_en();

                change_lunch_modal.style.display = 'none';
                message_modal.style.display = 'flex';
                message_title.innerText = 'Changes have been successfully applied';

            }

        }

    }
    
    fd.append('change_lunch', change_value);
    fd.append('id', change_lunch_id);
    fd.append('change_column', change_lunch_column);
    fd.append('change_lunch_lng', change_lunch_lng);

    xmlhttp.send(fd);

};

change_lunch_btn.addEventListener('click', change_lunch, false);
//
//
//
//
//
// Changing lunch menu
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
// Change image lunch menu
// start
//
//
//
//
//
let change_image_lunch = function(){

    const uri = '../server/add_product.php';
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    let files = change_select_lunch_image.files;
    let file = files[0];

    change_image_lunch_btn.style.pointerEvents = 'none';

    xmlhttp.open('POST', uri, true);

    xmlhttp.onreadystatechange = function(){

        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            
            if(xmlhttp.responseText == 1){

                lunch_menu();

                change_lunch_modal.style.display = 'none';
                message_modal.style.display = 'flex';
                message_title.innerText = 'Changes have been successfully applied';

            }

        }

    }

    fd.append('change_image', check_image);
    fd.append('image', file);
    fd.append('past_img', past_img);
    fd.append('id', change_lunch_id);

    xmlhttp.send(fd);
}

change_image_lunch_btn.addEventListener('click', change_image_lunch, false);
//
//
//
//
//
// Change image lunch menu
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

                modal_ok.querySelector('.modal__body-text').innerText = "Lunch status has been changed";
                modal_ok.style.display = 'flex';

            }
            
        }

    }



    fd.append('change_status', 1);
    
    xmlhttp.send(fd);
}

change_status_btn.addEventListener('click', change_status, false);

close_modal_ok.addEventListener('click', function(){
    modal_ok.style.display = 'none';
});
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