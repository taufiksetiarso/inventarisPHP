<?php

	require 'functions.php';
	session_start();
	if( !isset($_SESSION['username']) ){
		header("Location:login.php");
		exit;
	}

	if( isset($_POST['btnSubmit']) ){
		if( UbahPassword($_SESSION['username'],$_POST['txtPasswordLama'],$_POST['txtPasswordBaru']) ){
			echo "<script>alert('Berhasil Mengubah Password!!!')</script>";
			session_destroy();
			header("Location:login.php");
			exit;
		}
		else{
			echo "<script>alert('Gagal Mengubah Password!!!')</script>";
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
<body class="bg">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a href="#" class="navbar-brand">
			<img src="images/logo_pesonaedu.png" width="100" height="50" class="d-inline-block align-top">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#content" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>
		<div class="collapse navbar-collapse" id="content">
			<ul class="navbar-nav">
				<li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          Inventaris
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          <a class="dropdown-item" href="index.php"><i class="fa fa-database"></i> Data Barang</a>
			          <a class="dropdown-item" href="tambah.php"><i class="fa fa-plus"></i> Tambah Barang</a>
			        </div>
		      </li>
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          Pengguna
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			        	<a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> Log Out</a>
			          <a class="dropdown-item" href="ubah_password.php"><i class="fa fa-lock"></i> Ubah Password</a>
			        </div>
		      </li>
			  <ul class="navbar-nav">
				<li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          Laporan
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			        	<a class="dropdown-item" href="laporan-barang.php"><i class="fa fa-sign-list"></i> Laporan barang</a>
			          <a class="dropdown-item" href="laporan-mutasi.php"><i class="fa fa-list"></i> Laporan Mutasi</a>
			        </div>
		      </li>
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          Master Data
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			        	<a class="dropdown-item" href="masterdata-kategori.php"><i class="fa fa-list"></i> Kategori</a>
			          <a class="dropdown-item" href="masterdata-merk.php"><i class="fa fa-briefcase"></i> Merk</a>
					  <a class="dropdown-item" href="masterdata-divisi.php"><i class="fa fa-map-marker"></i> divisi</a>
					  <a class="dropdown-item" href="masterdata-user.php"><i class="fa fa-user"></i> User</a>
			        </div>
		      </li>
			</ul>
			<div class="pull-right" style="padding-left:650px;padding-top:15px"> <span class="badge badge-primary"><font size="3" color="white">hai, <?php echo $_SESSION['username'];?></font></span></div>
		
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6" style="margin-top: 15vh;">
				<div class="card">
					<div class="card-header">
						<h3 class="text-center">Ubah Password</h3>
					</div>
					<div class="card-body">
						<form action="" method="post">
							<div class="form-group">
								<label for="txtPasswordLama">Password Lama :</label>
								<input type="Password" name="txtPasswordLama" class="form-control">
							</div>
							<div class="form-group">
								<label for="txtPasswordBaru">Password Baru :</label>
								<input type="Password" name="txtPasswordBaru" class="form-control">
							</div>
							<button type="submit" name="btnSubmit" class="btn btn-primary btn-block">Ubah Password</button>
						</form> 
					</div>
				</div>
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
	<script type="text/javascript" src="boostrap/popper.js/1.14.0/umd/popper.min.js"></script>
	<script type="text/javascript" src="boostrap/jquery/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="boostrap/js/bootstrap.min.js"></script>
</body>
</html>