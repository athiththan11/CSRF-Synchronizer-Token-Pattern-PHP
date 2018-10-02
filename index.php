<?php

    session_start();

    if(!isset($_COOKIE['csrf_session_cookie']) || !isset($_SESSION['csrf_session'])){
        header("location: ./_/login.php");
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
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
            <div class="col-md-4 mx-auto align-self-center">
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
            <div class="col-md-6 mx-auto my-5 align-self-center">
                <h4>CSRF Synchronizer Token Pattern</h4>
                <hr class="my-4">
                <p>
                    Provided form is a sample form to explain the <i>Synchronizer Token Pattern</i>. This form contains a
                    hidden input field to store the CSRF token to verify the process of submission. <br/><br/> The generated
                    CSRF token is <b><i> <span id="csrf_token_string"></span> </i></b>
                </p>
                <p class="text-justify">
                    CSRF attacks are done by using the sessions of another authenticated user and executing confidential moves 
                    with the server without any knowlegde to the end-user. To brief, assume this application as a private 
                    banking site which is used to transfer money between multiple accounts. You are a registered user 
                    of this private bank and you want to do some transactions and check the balances in your accounts. So, you 
                    just did authenticated by the private banking site by providing your credentials.
                </p>
                <p class="text-justify">
                    A session will start as soon as you authenticate with the system, and this is used to keep you logged in 
                    to the system until you logout or close the browser. You made a simple transaction between your accounts, 
                    and you navigate to another different page and see some advertisements saying <b>'Click Here'</b>. You click 
                    on it, then the attacker can use your session to perform the transaction from your private bank account to 
                    any other account.
                </p>
            </div>
            <!-- End Description block -->

        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md pb-5">
                        <p class="text-secondary text-center">
                            Attackers use your authenticated sessions to perform authenticated state changes without your knowledge 
                            and interactions. In order to perform CSRF attacks, attackers use custom crafted links and sites as 
                            promotional advertisements to force the end-user to click on it.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Description block -->
    <div class="container-fluid">
        <div class="row text-light bg-dark">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 mx-auto my-5 align-self-center">

                        <p class="text-secondary text-justify">
                            CSRF tokens are introduced to prevent this act. There are several ways to implement and integrate CSRF tokens with the application
                            to perform private transactions by verifiying the token at the server end.This application is
                            built to demonstrate <b>Synchronizer Token Pattern (STP)</b>, where
                            the CSRF token is generated by the server at the start of a user session and stored inside the
                            server for later verification.
                        </p>
                        <p class="text-secondary text-justify">
                            An ajax call is made to retrieve the generated CSRF token from the server when loading the page. The retrieved CSRF token is
                            then append into a hidden input field which is placed in the form. The ajax call script can be
                            found at the bottom of <b>index.php</b> file. <br/><br/> The following
                            code snippet represents the hidden input field.
                        </p>
                        <p class="lead text-center">
                            &lt;input type="hidden" id="csrf_token" name="csrf_token" value="csrf" /&gt;
                        </p>
                        <br/>
                        <p class="text-secondary text-justify">
                            The following image shows the snippet of the form provided above, including the hidden field with a custom text value for
                            csrf token.
                        </p>
                        <br/>
                        <a class="text-muted disabled" href="https://github.com/athiththan11/csrf-synchronizer-token-pattern-php" target="_blank">
                            <i data-feather="github"></i>
                            Github Repo
                        </a>
                    </div>

                    <div class="col-md-6 mx-auto align-self-center">
                        <img class="w-100" src="/www/img/stp_form.png">
                    </div>

                </div>
            </div>
        </div>

        <div class="row text-light">
            <div class="container">
                <div class="row">

                    <div class="col-md-6 mx-auto mt-5 align-self-center">
                        <p class="text-secondary text-center">
                            The following snippet presents the implementation of ajax call script. This script can be found at the bottom of <b>index.php</b>
                            file.
                        </p>
                    </div>

                    <div class="w-100"></div>

                    <div class="col-md-8 mx-auto mb-5 align-self-center">
                        <img class="w-100" src="www/img/ajax_call.png" />
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Description block -->

    <!-- CSRF Token retrieve | ajax call to the service.php -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

        $(document).ready(function () {
            $.ajax({
                url: '/src/service.php',
                type: 'post',
                async: false,
                data: {
                    'csrf_request': '<?php echo $_COOKIE['csrf_session_cookie'] ?>'
                },
                success: function (data) {
                    document.getElementById("csrf_token").value = data;
                    $("#csrf_token_string").text(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log("Error on Ajax call :: " + xhr.responseText);
                }
            });
        });

        feather.replace();
    </script>

</body>

</html>