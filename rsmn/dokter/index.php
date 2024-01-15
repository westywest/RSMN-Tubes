<?php
	session_start(); //untuk menyimpan data saat login

			if(isset($_SESSION['status']) && $_SESSION['status'] === "login"){ //jika sudah pernah login maka diarahkan ke dashboard, dan proses dibawahnya tidak dijalankan
				header("location:/RSMN/rsmn/dokter/dashboard.php");
				die();
			}
	include("../../koneksi/config.php");
	if(isset($_POST['username']) && $_POST['password']){
		$username=$_POST['username'];	
		$password=($_POST['password']);
		$sql= "SELECT * FROM dokter WHERE username='$username' and password='$password'";
		$data = $con->query($sql);

		$check = mysqli_num_rows($data);

		if(isset($_POST['submit'])){
			if($check != 0){
				$_SESSION['username'] = $username;
				$_SESSION['status'] = "login";
				header("location:/RSMN/rsmn/dokter/dashboard.php");
				die();
			}else{
				$_SESSION['error'] = "Gagal login, silahkan cek kembali username dan password anda!";
			}
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Dokter-Login</title>
		
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    	<link href="https://cdn.jsdelivr.net/npm/@icon/themify-icons@1.0.1-alpha.3/themify-icons.min.css" rel="stylesheet">
    	<link rel="stylesheet" href="https://vendor/bootstrap/css/bootstrap.min.css">
    	<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    	<link rel="stylesheet" href="vendor/animate.css/animate.min.css" media="screen">
    	<link rel="stylesheet" href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" media="screen">
    	<link rel="stylesheet" href="vendor/switchery/switchery.min.css" media="screen">
    	<link rel="stylesheet" href="../assets/css/styles.css">
    	<link rel="stylesheet" href="../assets/css/plugins.css">
    	<link rel="stylesheet" href="../assets/css/themes/theme-1.css" id="skin_color" />
	</head>
	<body class="login">
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="logo margin-top-30">
				<a href="../index.php"><h2>Dokter Login</h2></a>
				</div>

				<div class="box-login">
					<form class="form-login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
						<fieldset>
							<legend>
								Sign in to your account
							</legend>
							<p>
								Please enter your name and password to log in.<br />
								
							</p>
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" name="username" id="username" placeholder="Username">
									<i class="fa fa-user"></i> </span>
							</div>
							<div class="form-group form-actions">
								<span class="input-icon">
									<input type="password" class="form-control password" name="password" id="password" placeholder="Password">
									<i class="fa fa-lock"></i>
									 </span><a href="forgot-password.php">
									Forgot Password ?
								</a>
							</div>
							<div class="form-actions">
								<p style="color: red; font-size: 12px;"><?php if(isset($_SESSION['error'])){ echo($_SESSION['error']);} ?>
								</p>
								<button type="submit" name="submit" class="btn btn-primary pull-right">
									Login <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
							<div class="new-account">
								Don't have an account yet?
								<a href="registrasi-dokter.php">
									Create an account
								</a>
							</div>
						</fieldset>
					</form>

					<?php
						unset($_SESSION['error']);
					?>
					<div class="copyright">
						</span><span class="text-bold text-uppercase"> RS Medika Nusantara </span>.
					</div>
			
				</div>

			</div>
			<div class="text-center margin-top-20">
    			<a href="../index.php" class="btn btn-default"><i class="fa fa-home"></i> Kembali ke Menu Awal</a>
			</div>
		</div>
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
	
		<script src="assets/js/main.js"></script>

		<script src="assets/js/login.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
	
	</body>
	<!-- end: BODY -->
</html>