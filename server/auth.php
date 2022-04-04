<?php
include "db.php";


if( isset($_POST['registration']) ){
    registration();
}
if( isset($_POST['login']) ){
    login();
}
if( isset($_POST['logout']) ){
    logout();
}







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
function registration(){

    global $con;

    // $email = $_POST['registration'];
    $number = $_POST['registration'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    $chk = "SELECT * FROM users WHERE user_phone = '$number'";

    $res = mysqli_query($con, $chk);
    $num = mysqli_num_rows($res);

    if($num == 0){

        $query = "INSERT INTO users (user_name,user_password,user_phone,user_group) VALUES ('$name' , '$password','$number','buyer')";

        $result = mysqli_query($con,$query);

        if($result){
            
            echo 1;
            $_SESSION['user'] = $name;
            $_SESSION['user_id'] = mysqli_insert_id($con);
            $_SESSION['number'] = $number;
            

        }else{
            echo mysqli_error($con);
        }

    }else{
        echo "The user with this phone number  was previously created";
    }





    
}
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
function login(){

    global $con;

    $phone = $_POST['login'];
    $password = $_POST['password'];
    
    $query = "SELECT * FROM users WHERE user_phone = '$phone' AND user_password = '$password'";

    $result = mysqli_query($con,$query);

    $num = mysqli_num_rows($result);
    
    if($num !== 0){

        if($result){
            $row = mysqli_fetch_assoc($result);

            $_SESSION['user'] = $row['user_name'];
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['number'] = $row['user_phone'];
            $_SESSION['user_group'] = $row['user_group'];
                
            if($_SESSION['user_group'] == 'admin'){
                echo 3;
            }else{
                echo 1;
            }
            

        }else{
            echo mysqli_error($con);
        }

    }else{
        echo 'Password or login incorrect';
    }




    
}
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













//
//
//
//
//
// User logout
// start
//
//
//
//
//
function logout(){
    
    session_destroy();
    echo 1;
    
}
//
//
//
//
//
// User logout
// finish
//
//
//
//
//