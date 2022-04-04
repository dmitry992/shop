// Variables for login
// let input_email = document.getElementById('input_email');
let input_phone = document.getElementById('input_phone');
let input_password = document.getElementById('input_password');
let login_btn = document.getElementById('login_btn');
let modal_auth_login = document.getElementById('modal_auth');
let modal_warning_login = document.getElementById('modal_warning_login');
let modal_login_text = modal_warning_login.querySelector('.modal__body-text');
let close_modal_warning_login = document.getElementById('close_modal_warning_login');





//
//
//
//
//
// Checking the correctness of the field before logging in
// start
//
//
//
//
//
let check_login = function(){

    let flag = 0;

    // if(input_email.value.length < 1){
    //     input_email.parentElement.classList.add('warning');
    //     flag = 1;
    // }else{
    //     input_email.parentElement.classList.remove('warning');
    // }

    if(input_phone.value.length < 3){
        input_phone.parentElement.classList.add('warning');
        flag = 1;
    }else{
        input_phone.parentElement.classList.remove('warning');
    }

    if(input_password.value.length < 1){
        input_password.parentElement.classList.add('warning');
        flag = 1;
    }else{
        input_password.parentElement.classList.remove('warning');
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
// Checking the correctness of the field before logging in
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
// Login in system
// start
//
//
//
//
//
let login = function(e){

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
    
    if(check_login()){
        return;
    }
   
    const uri = path;
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    xmlhttp.open("POST", uri, true);


    xmlhttp.onreadystatechange = function () {

        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            // Check if auth going from another page or login page
            if(document.getElementById('login_block')){

                if(xmlhttp.responseText == 1 || xmlhttp.responseText == 3){

                    // If page not login then open modal window
                    if(document.getElementById('login_block')){

                        if(check_auth == 0){

                            modal_auth_login.querySelector('.modal__block-auth').style.transform = 'translateY(200%)';
                            setTimeout(function () {
                                document.body.style.overflow = 'auto';
                                modal_auth_login.style.display = "none";
                                reg_block.style.display = 'none';
                                login_block.style.display = 'none';
                                modal_auth_login.querySelector('.modal__auth-check').style.display = 'none';
                            }, 200);
    
                            if(document.getElementById('save_order_btn')){
                                save_order();
                            }

                        }else{
                            window.location.reload();
                        }   
                            
                    }
                    
                }else{
                    modal_warning_login.style.display = 'flex';
                }

            }else{

                if(xmlhttp.responseText == 1){
                    location.href = "https://piegade247.eu/";
                }else if(xmlhttp.responseText == 3){
                    location.href = "https://piegade247.eu/admin/all_orders.php";
                }else{
                    modal_warning_login.style.display = 'flex';
                }

            }

        }

    }

    
    fd.append('login', input_phone.value);
    fd.append('password', input_password.value);

    xmlhttp.send(fd);

};
login_btn.addEventListener('click', login, false);



close_modal_warning_login.addEventListener('click', function(){
    modal_warning_login.style.display = "none";
});
//
//
//
//
//
// Login in system
// finish
//
//
//
//
//







