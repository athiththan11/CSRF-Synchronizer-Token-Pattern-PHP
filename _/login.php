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
		<div class="row">

			<!-- Sign in block -->
			<div class="col-md-4 mx-auto order-12">
				<div class="card my-5 p-3 shadow">
					<div class="card-body">
						<h5 class="card-title text-center">Sign In</h5>

						<!-- Sign in Form -->
						<form class="mt-5 mb-3" action="login.php" method="POST">
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" class="form-control" id="username" name="username" required autofocus/>
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" id="password" name="password" required/>
							</div>
							<button type="submit" class="btn btn-primary btn-block mt-5" name="login">Login</button>
						</form>
						<!-- End Sign in Form -->

					</div>
				</div>
			</div>
			<!-- End Sign in block -->

			<!-- Description block -->
			<div class="col-md-6 mx-auto my-5 order-1">
				<h4>CSRF Synchronizer Token Pattern</h4>
				<hr class="my-4">
				<p>
					This is a sample PHP application implemented to explain the <b>Cross Site Request Forgery (CSRF) - <i>Synchronizer Token
							Pattern
						</i></b>.<br/><br/>You can use the following credentials to login to the system.
				</p>
				<ul>
					<li><span>Username: csrf</span></li>
					<li><span>Password: token</span></li>
				</ul>
			</div>
			<!-- End Description block -->

		</div>
	</div>

</body>

</html>