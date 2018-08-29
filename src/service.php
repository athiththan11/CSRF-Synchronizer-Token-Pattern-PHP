<?php

    session_start();

    /**
     * logout function
     *
     * @return void
     */
    function logout() {

        // unset all cookies and sessions belongs to that user
        unset($_COOKIE['csrf_session_cookie']);
        setcookie('csrf_session_cookie', null, -1, '/');
        unset($_SESSION);

        // redirect to login page
        header("location: ./../../_/login.php");
    }

    /**
     * csrf token generation
     *
     * @return void
     */
    function generateCSRFToken($session, $length = 10) {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);

        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $randomString .= $session[rand(0, strlen($session) - 5)];
        
        // store the generated csrf token string in a session variable
        $_SESSION['csrf_token_string'] = $randomString;
        return $randomString;
    }

    if(isset($_POST['logout'])){

        logout();

    } elseif (isset($_POST['csrf_request'])){

        if($_POST['csrf_request'] == $_COOKIE['csrf_session_cookie']){
            echo generateCSRFToken($_COOKIE['csrf_session_cookie']);
        }else {
            echo "Something went wrong";
        }

    } else if (isset($_POST['verify'])){

        if($_POST['csrf_token'] == $_SESSION['csrf_token_string']){
            header("location: ./../../_/success.php");
        }else {
            header("location: ./../../_/error.php");
        }
    }
?>