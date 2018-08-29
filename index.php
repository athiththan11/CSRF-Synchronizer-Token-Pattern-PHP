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
                            <button class="btn btn-link" type="submit" value="Logout" name="logout">Logout</button>
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
                                <label for="php">Do you like PHP ?</label>
                                <input type="text" class="form-control" id="php" name="php" placeholder="not at all... ;) " required autofocus/>
                            </div>
                            <div class="form-group">
                                <label for="demo">Do you like this demo ?</label>
                                <input type="text" class="form-control" id="demo" name="demo" placeholder="waiting for your answer .... :D" required/>
                            </div>
                            <button type="submit" class="btn btn-success btn-block mt-5" name="verify">Submit</button>
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
                    Provided form is a sample form to explain the <i>Synchronizer Token Pattern</i>. This form contains 
                    a hidden input field to store the CSRF token to verify the process of submission. <br/><br/>
                    The ajax call script can be found at the bottom of <b>index.php</b> file. <br/><br/>
                    The newly generated CSRF token is <b><i> <span id="csrf_token_string"></span> </i></b>
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
                async:false,
                data: {
                    'csrf_request': '<?php echo $_COOKIE['csrf_session_cookie'] ?>'
                },
                success: function (data) {
                    document.getElementById("csrf_token").value = data;
                    $("#csrf_token_string").text(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log("Something went wrong :: " + xhr.responseText);
                }
            });
        });
    </script>

</body>

</html>