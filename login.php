<?php 

session_start();

if(isset($_SESSION['user'])){
    header('Location:/');
    exit;
}
    /**
     * Function to bypass cache. It generates prefix therefore browser thinks,
     * that it is a new file.
     * 
     *  Given a file, i.e. /css/base.css, replaces it with a string containing the
     *  file's mtime, i.e. /css/base.1221534296.css.
     *
     *  @param $file  The file to be loaded.  Must be an absolute path (i.e.
     *                starting with slash).
     */
    
    function auto_version($file) {
        if(strpos($file, '/') !== 0 || !file_exists($_SERVER['DOCUMENT_ROOT'] . $file))
            return $file;

        $mtime = filemtime($_SERVER['DOCUMENT_ROOT'] . $file);
        return preg_replace('{\\.([^./]+)$}', ".\$1?$mtime", $file);
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


    <div class="modal modal__warning" id="modal_warning_login">

        <div class="modal__wrapper">
            <div class="modal__body">
                <p class="modal__body-text">
                    Password or login incorrect
                </p>
                <button class="modal__body-btn" id="close_modal_warning_login">
                    Ok
                </button>
            </div>
        </div>
    </div>

    <div class="auth login">
        <div class="auth__wrapper">
            <h1 class="auth__title">
                Login
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
                    <input class="auth__form-input" type="phone" id="input_phone">
                    <p class="auth__form-warning">
                        Invalid phone number
                    </p>
                </lable>
                <lable class="auth__form-label">
                    Password
                    <input class="auth__form-input" type="password" id="input_password">
                    <p class="auth__form-warning">
                        Empty field with password
                    </p>
                </lable>
                <button class="auth__form-btn" id="login_btn">
                    Login
                </button>
            </form>
            <div class="auth__bottom">
                <p class="auth__text">
                    Or
                </p>
                <a class="auth__link" href="registration.php">
                    Quick registration
                </a>
            </div>
        </div>
    </div>

    <script src="js/login.js?1"></script>

</body>

</html>