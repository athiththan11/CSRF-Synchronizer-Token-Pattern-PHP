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

    <ul class="nav justify-content-center mt-3">
        <?php
            if(isset($_COOKIE['csrf_session_cookie'])){
                echo 
                    '<li class="nav-item">
                        <form class="nav-link" method="POST" action="/src/service.php">
                            <button class="btn btn-link" type="submit" value="Logout" name="logout">Lgout</button>
                        </form>
                    </li>';
            }
        ?> 
    </ul>

    <div class="container">
        <div class="row">

            <!-- csrf form block -->
            <div class="col-md-4 mx-auto">
                <div class="card shadow my-5 p-3">
                    <div class="card-body">
                        <h5 class="card-title text-center">CSRF Token Example Form</h5>
                        <hr class="my-4">

                        <!-- csrf form -->
                        <form class="mt-3 mb-3" action="/src/service.php" method="POST">

                            <!-- csrf hidden input field -->
                            <input type="hidden" id="csrf_token" name="csrf_token" value="csrf" />

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" />
                            </div>
                            <div class="form-group">
                                <label for="some">Some</label>
                                <input type="text" class="form-control" id="some" name="some" />
                            </div>
                            <button type="submit" class="btn btn-success btn-block mt-5" name="submit">Submit</button>
                        </form>
                        <!-- End csrf form -->

                    </div>
                </div>
            </div>
            <!-- End csrf form block -->

            <!-- Description block -->
            <div class="col-md-6 mx-auto my-5">
                <h4>CSRF Synchronizer Token Pattern</h4>
                <hr class="my-4">
                <p>
                    Lorem Ipsum
                </p>
            </div>
            <!-- End Description block -->

        </div>
    </div>

    <!-- CSRF Token retrieve | ajax call to the service.php -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: '/src/service.php',
                type: 'post',
                data: {
                    'csrf_request': '<?php echo $_COOKIE['csrf_session_cookie'] ?>'
                },
                success: function (data) {
                    console.log(data);
                    document.getElementById("csrf_token").value = data;
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log("Something went wrong :: " + xhr.responseText);
                }
            });
        });
    </script>

</body>

</html>