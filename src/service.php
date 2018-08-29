<?php

    function logout() {
        unset($_COOKIE['csrf_session_cookie']);
        setcookie('csrf_session_cookie', null, -1, '/');
        unset($_SESSION);
        header("location: ./../../_/login.php");
    }

    if(isset($_POST['logout'])){
        logout();
    } else if (isset($_POST['csrf_request'])){
        
        if($_POST['csrf_request'] == $_COOKIE['csrf_session_cookie']){
            echo "Somethings here";
        }else {
            echo "Something went wrong";
        }
    }
?>