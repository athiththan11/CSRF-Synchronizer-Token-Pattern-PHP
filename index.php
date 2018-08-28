<?php

    session_start();

    if(!isset($_SESSION['csrf_session'])){
        header("location: ./views/login.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CSRF Synchronizer Token Pattern</title>

    <?php include (realpath(__DIR__)."/views/addons/header.php") ?>

</head>
<body>
    
    Hi

</body>
</html>