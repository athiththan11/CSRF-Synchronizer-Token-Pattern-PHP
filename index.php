<?php

    session_start();

    if(!isset($_SESSION['csrf_session'])){
        header("location: ./_/login.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CSRF Synchronizer Token Pattern</title>

    <?php include (realpath(__DIR__)."/_/addons/header.php") ?>

</head>
<body>
    
    <?php
        if(isset($_COOKIE['csrf_session_cookie'])){
            echo 
                '<form method="POST" action="/src/service.php">
                    <input type="submit" value="Logout" name="logout"/>
                </form>';
        }
    ?>

    Hi

    <form action="/src/service.php" method="POST">
        <input type="hidden" id="csrf_token" name="csrf_token" value="csrf" />
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name"/>
        </div>
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name"/>
        </div>
        <button type="submit" name="submit" value="submit">Submit</button>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/src/service.php',
                type: 'post',
                data: {
                    'csrf_request': '<?php echo $_COOKIE['csrf_session_cookie'] ?>'
                },
                success: function(data) {
                    console.log(data);
                    document.getElementById("csrf_token").value = data;
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log("Something went wrong :: " + xhr.responseText);
                }
            });
        });
    </script>

</body>
</html>