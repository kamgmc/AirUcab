<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AirUCAB - Login</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="all,follow">
	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<!-- Fontastic Custom icon font-->
	<link rel="stylesheet" href="css/fontastic.css">
	<!-- Font Awesome CSS-->
	<link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
	<!-- Google fonts - Poppins -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
	<!-- theme stylesheet-->
	<link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/airucab.ico"> </head>

<body>
	<div class="page login-page">
		<div class="container d-flex align-items-center">
			<div class="form-holder has-shadow">
				<div class="row">
					<!-- Logo & Information Panel-->
					<div class="col-lg-6">
						<div class="info d-flex align-items-center">
							<div class="content center-block">
								<div class="logo">
									<h1>Air<strong>UCAB</strong></h1> </div>
								<hr class="style-hr"> </div>
						</div>
					</div>
					<!-- Form Panel    -->
					<div class="col-lg-6 bg-white">
						<div class="form d-flex align-items-center">
							<form id="login-form" method="post" action="control.php" autocomplete="off">
								<div class="content">
									<div class="form-group">
										<input id="login-username" placeholder="Usuario" type="text" name="loginUsername" required class="input-material">
									</div>
									<div class="form-group">
										<input id="login-password" placeholder="Contraseña" type="password" name="loginPassword" required class="input-material">
									</div>
									<a href="#" class="forgot-pass pad-top">¿Olvidaste la contraseña?</a><br><br> 
									<button id="login" type="submit" class="btn btn-primary mar-top btn-block btn-lg">Iniciar</button> 
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="copyrights text-center">
			<p>Diseño por <a href="" class="external">AK</a></p>
		</div>
	</div>
	<!-- Javascript files-->
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="vendor/popper.js/umd/popper.min.js">
	</script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/jquery.cookie/jquery.cookie.js">
	</script>
	<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
	<script src="js/front.js"></script>
</body>

</html>