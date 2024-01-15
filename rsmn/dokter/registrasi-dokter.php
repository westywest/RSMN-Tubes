<?php
	session_start();
	include("../../koneksi/config.php");

	if(isset($_POST['submit']))
		{
			$username=$_POST['username'];
			$full_name=$_POST['full_name'];
			$address=$_POST['address'];
			$city=$_POST['city'];
			$foto  = upload();
            $spesialis=$_POST['spesialis'];
			$gender=$_POST['gender'];
			$email=$_POST['email'];
			$password=$_POST['password'];
			$sql   = "INSERT INTO dokter (username, password, full_name, foto, spesialis, gender, email, address, city) VALUES ('$username', '$password', '$full_name', '$foto', '$spesialis', '$gender',  '$email', '$address', '$city');";
			$datas = $con->query($sql);

			if(mysqli_affected_rows($con) > 0){
                header("Location:index.php");
            }else{
                $_SESSION['error'] = "Menambah data gagal!";
            }
		}

	function upload(){
		$namaFile = $_FILES['foto']['name'];
		$ukuranFile = $_FILES['foto']['size'];
		$error = $_FILES['foto']['error'];
		$tmpName = $_FILES['foto']['tmp_name'];

		//cek apakah tdk ada gambar yg diupload
		if($error === 4){
			echo"<script>
				alert('pilih gambar terlebih dahulu!');
				</script>";
			return false;
		}

		//cek apakah yg diupload adlh gambar
		$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
		$ekstensiGambar = explode('.', $namaFile);
		$ekstensiGambar = strtolower(end($ekstensiGambar));
		if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
			echo"<script>
				alert('Yang anda upload bukan Foto!');
				</script>";
			return false;
		}

		//cek jika ukurannya terlalu besar
		if($ukuranFile > 2048000){
			echo"<script>
				alert('Ukuran Foto terlalu besar!');
				</script>";
			return false;
		}

		//lolos pengecekan, foto siap diupload
		//generate nama baru
		$namaFileBaru = uniqid();
		$namaFileBaru .= '.';
		$namaFileBaru .= $ekstensiGambar;
		move_uploaded_file($tmpName, '../../assets/imgDokter/' . $namaFileBaru);
		return $namaFileBaru;
	}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daftar akun Dokter RS MedikaNusantara</title>

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

    <script type="text/javascript">
        function valid() {
            if (document.registration.password.value != document.registration.password_again.value) {
                alert("Password and Confirm Password Field do not match  !!");
                document.registration.password_again.focus();
                return false;
            }
            return true;
        }
    </script>
		
	</head>

	<body class="login">
		<!-- start: REGISTRATION -->
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="logo margin-top-30">
				<a href="../index.php"><h2>Rs Medika Nusantara</h2></a>
				</div>
				<!-- start: REGISTER BOX -->
				<div class="box-register">
					<form name="registration" id="registration"  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onSubmit="return valid();" enctype="multipart/form-data">
						<fieldset>
							<legend>
								Sign Up
							</legend>
							<p>
								Enter your personal details below:
							</p>
							<div class="form-group">
								<input type="text" class="form-control" name="username" id="username" placeholder="username" required>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="full_name" id="full_name" placeholder="Nama Lengkap" required>
							</div>
							<div class="form-group">
							<label for="foto" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="foto" name="foto" placeholder="foto" required>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="address" id="address" placeholder="Alamat" required>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="city" id="city" placeholder="Kota" required>
							</div>
							<div class="form-group">
								<label class="block">
									Gender
								</label>
								<div class="form-group">
								<select name="gender" id="gender" class="form-control" required>
                                    <option value="">--Pilih--</option>
                                    <option value="Male">Laki-Laki</option>
                                    <option value="Female">Perempuan</option>
                                </select>
								</div>
							</div>
                            <div class="form-group">
								<label class="block">
									Spesialis
								</label>
								<div class="form-group">
								<select name="spesialis" id="spesialis" class="form-control" required>
                                    <option value="">--Pilih Spesialis--</option>
                                    <option value="Anak">Anak</option>
                                    <option value="FemJantung dan Pembuluh Darahale">Jantung dan Pembuluh Darah</option>
                                    <option value="Penyakit Dalam">Penyakit Dalam</option>
                                    <option value="Bedah">Bedah</option>
                                    <option value="Mata">Mata</option>
                                    <option value="Kandungan dan Ginekologi">Kandungan dan Ginekologi</option>
                                </select>
								</div>
							</div>
							<p>
								Enter your account details below:
							</p>
							<div class="form-group">
								<span class="input-icon">
									<input type="email" class="form-control" name="email" id="email" onBlur="userAvailability()"  placeholder="Email" required>
									<i class="fa fa-envelope"></i> </span>
									 <span id="user-availability-status1" style="font-size:12px;"></span>
							</div>
							<div class="form-group">
								<span class="input-icon">
									<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
									<i class="fa fa-lock"></i> </span>
							</div>
							<div class="form-group">
								<span class="input-icon">
									<input type="password" class="form-control"  id="password_again" name="password_again" placeholder="Password Again" required>
									<i class="fa fa-lock"></i> </span>
							</div>
							<div class="form-group">
								<div class="checkbox clip-check check-primary">
									<input type="checkbox" id="agree" value="agree" checked="true" readonly=" true">
									<label for="agree">
										I agree
									</label>
								</div>
							</div>
							<div class="form-actions">
								<p>
									Already have an account?
									<a href="index.php">
										Log-in
									</a>
								</p>
								<p style="color:red; font-size: 12px;"><?php if(isset($_SESSION['error'])){ echo($_SESSION['error']);} ?></p>
								<button type="submit" class="btn btn-primary pull-right" id="submit" name="submit">
									Submit <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</fieldset>
					</form>

					<div class="copyright">
						&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> Rs Medika Nusantara</span>. <span>All rights reserved</span>
					</div>

				</div>

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
		
	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>	
		
	</body>
	<!-- end: BODY -->
</html>