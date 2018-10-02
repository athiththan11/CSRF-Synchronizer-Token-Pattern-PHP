<?php

    session_start();

    if(isset($_POST['login'])){

        $username = $_POST['username'];
        $password = $_POST['password'];

        if(($username == "csrf") && ($password == "token")){

			// set a session variable
			$_SESSION['csrf_session'] = "csrfstpsamplephp";

			// regenerate an id for session and store it in a cookie
			session_regenerate_id();
			setcookie("csrf_session_cookie", session_id(), (time() + (56400)), "/");
			
			// include service.php to generate csrf token
			include(realpath(__DIR__)."/../src/service.php");
			generateCSRFToken(session_id());

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
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
	<title>CSRF Synchronizer Token Pattern | Login</title>

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
								<input type="text" class="form-control" id="username" name="username" value="csrf" required autofocus/>
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" id="password" name="password" value="token" required/>
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
				<p class="lead text-justify">
					This is a sample PHP application implemented to explain the <b>Cross Site Request Forgery (CSRF) - Synchronizer Token
						Pattern
					</b>.
				</p>
				<p>
					You can use the following credentials to login and demo with the system
				</p>
				<ul>
					<li><span>Username: csrf</span></li>
					<li><span>Password: token</span></li>
				</ul>
				<br/>
				<a class="disabled" href="https://github.com/athiththan11/csrf-synchronizer-token-pattern-php" target="_blank"><i data-feather="github"></i>
					Github Repo</a>
				<br/><br/>
				<small>Check out CSRF Double Submit Cookies Pattern implementation on PHP in
					<ul class="list-inline">
						<li class="list-inline-item">
							<a class="disabled" href="https://github.com/athiththan11/csrf-double-submit-cookies-pattern-php" target="_blank">Github</a>
						</li>
						<li class="list-inline-item">
							<a class="disabled" href="https://csrf-dscp.herokuapp.com" target="_blank">Heroku</a>
						</li>
					</ul>
				</small>
				<br/>
				<a class="text-muted disabled" href="https://medium.com/@code19111995/cross-site-request-forgery-aa396341eb7c" target="_blank">
					<img src="https://cdn-images-1.medium.com/max/1600/1*TGH72Nnw24QL3iV9IOm4VA.png" width="80" />
				</a>
			</div>
			<!-- End Description block -->

		</div>
	</div>

	<script>
		feather.replace()
	</script>

</body>

</html>