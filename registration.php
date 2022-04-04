<?php 

session_start();

if(isset($_SESSION['user'])){
    header('Location:/');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" wrapper="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>


    <div class="modal modal__warning" id="modal_warning_reg">
        <div class="modal__wrapper">
            <div class="modal__body">
                <p class="modal__body-text">
                    The user with this phone number  was previously created
                </p>
                <button class="modal__body-btn" id="close_modal_warning_reg">
                    Ok
                </button>
            </div>
        </div>
    </div>



    <div class="auth">
        <div class="auth__wrapper">
            <h1 class="auth__title">
                Registration
            </h1>
            <form class="auth__form">
                <!-- <lable class="auth__form-label">
                    Email
                    <input class="auth__form-input" type="email" id="input_email">
                    <p class="auth__form-warning">
                        Invalid email address
                    </p>
                </lable> -->
                <lable class="auth__form-label">
                    Phone number
                    <input class="auth__form-input" type="phone" id="input_number">
                    <p class="auth__form-warning">
                        Invalid phone number
                    </p>
                </lable>
                <lable class="auth__form-label">
                    Name
                    <input class="auth__form-input" type="text" id="input_name">
                    <p class="auth__form-warning">
                        Invalid name
                    </p>
                </lable>
                <lable class="auth__form-label">
                    Password
                    <input class="auth__form-input" type="password" id="input_password_reg">
                    <p class="auth__form-warning">
                        Empty field with password
                    </p>
                </lable>
                <lable class="auth__form-label">
                    Confirm password
                    <input class="auth__form-input" type="password" id="input_password_confrim">
                    <p class="auth__form-warning">
                        Password mismatch
                    </p>
                </lable>
                <button class="auth__form-btn" id="reg_btn">
                    Registration
                </button>
            </form>
            <div class="auth__bottom">
                <p class="auth__text">
                    Or
                </p>
                <a class="auth__link" href="login.php">
                    Login
                </a>
            </div>
        </div>
    </div>

    <script src="js/registration.js"></script>

</body>

</html>