<?php
    //includes login script
	include( 'functions.php' );

    //Checks to see if you're already logged in and if so redirect user to the dashboard.
    checkLogin( true );

    //Starts login function written in the function.php page.
    startLogin();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Retro Gecko Login</title>
	<link rel="apple-touch-icon" sizes="180x180" href="../images/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/fav/favicon-16x16.png">
    <link rel="manifest" href="../images/fav/site.webmanifest">
    <link rel="mask-icon" href="../images/fav/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#00a300">
    <meta name="theme-color" content="#ffffff">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
	 crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP"
	 crossorigin="anonymous">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="/font/customfonts.css">
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/cms/css/login.css">


</head>

<body>
	<div id="space">
		<div class="container h-100">
			<div class="d-flex justify-content-center h-100">
				<div class="user_card">
					<div class="d-flex justify-content-center">
						<h3><span class="rwthin pl-3">RETRO</span><span class="sym">GECKO</span></h3>
                    </div>
                    <p class="error-message text-center" style="color:red; font-weight:bold;"><?php echo $_SESSION['Error'] ?></p>
					<div class="d-flex justify-content-center form_container">
						<form action="" method="post" class="form-signin">
							<div class="input-group mb-3">
								<div class="input-group-append">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" name="email" class="form-control input_user" placeholder="Email Address" required>
							</div>
							<div class="input-group mb-2">
								<div class="input-group-append">
									<span class="input-group-text"><i class="fas fa-key"></i></span>
								</div>
								<input type="password" name="password" class="form-control input_pass" placeholder="Password" required>
							</div>
							<div class="form-group">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="customControlInline">
									<label class="custom-control-label" for="customControlInline">Remember me</label>
								</div>
                            </div>
                            <div class="d-flex justify-content-center mt-3 login_container">
						        <button type="submit" value="submit" name="submit" class="btn login_btn">Login</button>
					        </div>
						</form>
					</div>
					
					<div class="mt-4">
						<div class="d-flex justify-content-center links dosis">
							<span class="dosis">Don't have an account? <a href="#" class="ml-2">Sign Up</a></span>
						</div>


						<div class="d-flex justify-content-center links dosis">
							<span class="dosis">Go<a href="/index.php" class="ml-2">back</a></span>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<!-- threejs.org canvas lines example -->
	<script src="
	https://cdnjs.cloudflare.com/ajax/libs/three.js/r67/three.min.js">
	</script>
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
	 crossorigin="anonymous"></script>
	<script src="/js/particle-background.js"></script>
</body>

</html>