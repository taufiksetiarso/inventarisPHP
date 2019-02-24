<?php

	require 'functions.php';
	if( isset($_POST['btnSubmit']) ){
		$username = $_POST['txtUsername'];
		$email = $_POST['txtEmail'];
		$password = $_POST['txtPassword'];

		if( registrasi($username,$email,$password) ){
			echo "<script>alert('Registrasi Berhasil!!!')</script>";
			header("Location:login.php");
			exit;
		}
		else{
			echo "<script>alert('Registrasi Gagal!!!')</script>";
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
						<img src="images/logo_pesonaedu.png" class="w-100 h-100">
					</div>
					<div class=" col-12 col-md-12 col-sm-12">
						<form action="" method="post">
						<div class="form-group">
							<input type="text" name="txtUsername" class="form-control" placeholder="Username..." required>
						</div>
						<div class="form-group">
							<input type="text" name="txtEmail" class="form-control" placeholder="Email..." required="">
						</div>
						<div class="form-group">
							<input type="password" name="txtPassword" class="form-control" placeholder="Password..." required>
						</div>
							<a href="login.php">Sudah punya akun ? Masuk</a>
							<br>
							<br>
						<button type="submit" name="btnSubmit" class="btn btn-block btn-primary"><i class="fa fa-sign-in"></i> Registrasi</button>
					</form> 
					</div>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
</body>
</html>