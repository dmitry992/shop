<?php
session_start();
$con = mysqli_connect('localhost', 'root', 'root', 'sweet_shop'); // Connection to database local
// $con = mysqli_connect('localhost', 'noval115_sweet-shop', '1HZ9TdsVF', 'noval115_sweet-shop'); // Connection to database server
mysqli_set_charset($con, "utf8mb4");
if( mysqli_connect_errno() ){ //If error occurs, returns an error code
    echo 'Database connection error: '.mysqli_connect_error();
}
