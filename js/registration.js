// Variables for registration
// let input_email = document.getElementById('input_email');
let input_name = document.getElementById('input_name');
let input_password_reg = document.getElementById('input_password_reg');
let input_password_confrim = document.getElementById('input_password_confrim');
let reg_btn = document.getElementById('reg_btn');
let modal_auth_reg = document.getElementById('modal_auth');
let modal_warning_reg = document.getElementById('modal_warning_reg');
let modal_reg_text = modal_warning_reg.querySelector('.modal__body-text');
let close_modal_warning_reg = document.getElementById('close_modal_warning_reg');
let input_number = document.getElementById('input_number');

// This need translate (Moved to general.js)



//
//
//
//
//
// Checking for correctly filling field before registration
// start
//
//
//
//
//
let check_reg = function(){

    let flag = 0;

    // if(input_email.value.length < 1){
    //     input_email.parentElement.classList.add('warning');
    //     flag = 1;
    // }else{
    //     input_email.parentElement.classList.remove('warning');
    // }

    if(input_number.value.length < 3){
        input_number.parentElement.classList.add('warning');
        flag = 1;
    }else{
        input_number.parentElement.classList.remove('warning');
    }

    if(input_name.value.length < 1){
        input_name.parentElement.classList.add('warning');
        flag = 1;
    }else{
        input_name.parentElement.classList.remove('warning');
    }

    if(input_password_reg.value.length < 1){
        input_password_reg.parentElement.classList.add('warning');
        flag = 1;
    }else{
        input_password_reg.parentElement.classList.remove('warning');
    }

    if(input_password_confrim.value.length < 1){
        input_password_confrim.parentElement.classList.add('warning');
        flag = 1;
    }else{
        if(input_password_confrim.value !== input_password_reg.value){
            input_password_confrim.parentElement.classList.add('warning');
            flag = 1;
        }else{
            input_password_confrim.parentElement.classList.remove('warning');
        }
    }



    if(flag == 1){
        return true;
    }else{
        return false;
    }

}
//
//
//
//
//
// Checking for correctly filling field before registration
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
// Registration
// start
//
//
//
//
//
let registration = function(e){


    e.preventDefault();

    if(window.path !== void 0){
        if(lng == 'lv'){
            path = "server/auth.php";
            
        }else{
            path = "../server/auth.php";
        }
    }else{
        var path = "server/auth.php";
    }

    if(check_reg()){
        return;
    }

    
    const uri = path;
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    this.style.pointerEvents = 'none';

    xmlhttp.open("POST", uri, true);


    xmlhttp.onreadystatechange = function () {

        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            // Check if auth going from another page or registration page
            if(document.getElementById('reg_block')){
                
                
                if(xmlhttp.responseText == 1){

                    close_modal_warning_reg.setAttribute('data-chk', 1);
                    modal_warning_reg.style.display = 'flex';
                    modal_reg_text.innerText = changing_text.modal_message[lng];
                    
                }else{
                    modal_warning_reg.style.display = 'flex';
                    close_modal_warning_reg.setAttribute('data-chk', 0);
                }


            }else{
                if(xmlhttp.responseText == 1){
                    location.href = "https://piegade247.eu/";
                }else{
                    modal_warning_reg.style.display = 'flex';
                }
            }


        }
        

    }

    
    // fd.append('registration', input_email.value);
    fd.append('registration', input_number.value);
    fd.append('name', input_name.value);
    fd.append('password', input_password_reg.value);

    xmlhttp.send(fd);
};

reg_btn.addEventListener('click', registration, false);

close_modal_warning_reg.addEventListener('click', function(){

    modal_warning_reg.style.display = "none";
    
    modal_reg_text.innerText = changing_text.modal_warning[lng];
    
    reg_btn.style.pointerEvents = 'auto';

    if(document.getElementById('reg_block')){

        if(check_auth == 0){

            if(close_modal_warning_reg.getAttribute('data-chk') == 1){
                
                modal_auth_reg.querySelector('.modal__block-auth').style.transform = 'translateY(200%)';
                setTimeout(function () {
                    document.body.style.overflow = 'auto';
                    modal_auth_reg.style.display = "none";
                    reg_block.style.display = 'none';
                    login_block.style.display = 'none';
                    modal_auth_reg.querySelector('.modal__auth-check').style.display = 'none';
                }, 200);
    
                if(document.getElementById('save_order_btn')){
                    save_order();
                }
                
            }

        }else{
            if(close_modal_warning_reg.getAttribute('data-chk') == 1){
                window.location.reload();
            }

        }

    }



});
//
//
//
//
//
// Registration
// finish
//
//
//
//
//
