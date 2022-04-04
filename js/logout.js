let logout_button = document.getElementById('logout_button');


//
//
//
//
//
// Sign Out in system
// start
//
//
//
//
//
let logout = function(){


    if(this.getAttribute('data-user') == 'admin'){
        logout2();
        return;
    }

    if(window.path !== void 0){
        if(lng == 'lv'){
            path = "server/auth.php";
            
        }else{
            path = "../server/auth.php";
        }
    }else{
        var path = "server/auth.php";
    }

    const uri = path;
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    xmlhttp.open('POST', uri, true);

    xmlhttp.onreadystatechange = function(){
        
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

            if(xmlhttp.responseText == 1){

                if(lng == 'lv'){
                    location.href = "https://piegade247.eu/";
                }else if(lng == 'ru'){
                    location.href = "https://piegade247.eu/ru/";
                }else if(lng == 'en'){
                    location.href = "https://piegade247.eu/en/";
                }

                
            }
            
        }

    }

    fd.append('logout', 1);

    xmlhttp.send(fd);
};

logout_button.addEventListener('click', logout, false);
//
//
//
//
//
// Sign Out in system
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
// Log out administrator
// start
//
//
//
//
//
let logout2 = function(){



    const uri = "../server/auth.php";
    const xmlhttp = new XMLHttpRequest();
    const fd = new FormData();

    xmlhttp.open('POST', uri, true);

    xmlhttp.onreadystatechange = function(){
        
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

            if(xmlhttp.responseText == 1){

                location.href = "https://piegade247.eu/login.php";

            }
            
        }

    }

    fd.append('logout', 1);

    xmlhttp.send(fd);
};
//
//
//
//
//
// Log out administrator
// finish
//
//
//
//
//