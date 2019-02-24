<?php
	
	session_start();
	require 'functions.php';
	if( isset($_POST['btnSubmit']) ){
		if( login($_POST['txtUsername'],$_POST['txtPassword']) ){
			$_SESSION['username'] = $_POST['txtUsername'];
			header("Location:index.php");
			exit;
		}
		else{
			echo "<script>alert('Maaf Username Atau Password Yang Anda Masukkan Salah!!!')</script>";
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Edukasi Star Indonesia</title>
	<link rel="stylesheet" type="text/css" href="boostrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="custom.css">
		<link rel="stylesheet" type="text/css" href="boostrap/font-awesome/css/font-awesome.min.css">

</head>
<body class="body">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4 form-container">
				<div class="row">
					<div class=" col-4 col-md-4 col-md-4 offset-4 " style="margin-bottom: 3%;">
						<img src="images/logo_esi.jpg" class="w-100 h-100">
					</div>
					<div class=" col-12 col-md-12 col-sm-12">
						<form action="" method="post">
						<div class="form-group">
							<input type="text" name="txtUsername" class="form-control" placeholder="Username..." required>
						</div>
						<div class="form-group">
							<input type="password" name="txtPassword" class="form-control" placeholder="Password..." required>
						</div>
							<a href="registrasi.php">Registrasi Akun Baru</a>
							<br>
							<br>
						<button type="submit" name="btnSubmit" class="btn btn-block btn-primary"><i class="fa fa-sign-in"></i> Login</button>
					</form> 
					</div>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
</body>
</html>