<?php

    session_start();

    if(isset($_POST['login'])){

        $username = $_POST['username'];
        $password = $_POST['password'];

        if(($username == "csrf") && ($password == "token")){
            $_SESSION['csrf_session'] = "CSRF STP Sample PHP";

            setcookie("csrf_session_cookie", session_id(), (time() + (56400)), "/");
            header("location: ./../../index.php");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - CSRF STP</title>

    <?php include (realpath(__DIR__)."/addons/header.php") ?>    

</head>
<body>
    
    <div class="container">
        <form action="login.php" method="POST">
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" />
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" />
            </div>
            <button type="submit" value="login" name="login">Login</button>
        </form>
    </div>

</body>
</html>