<?php 
	require 'functions.php';
	session_start();
	if( !isset($_SESSION['username']) ){
		header("Location:login.php");
		exit;
	}

	$hasil = loadBarangWithId($_GET['id']);
	$Kategori = loadKategoriItem();
	$Merk = loadMerkItem();
	$Divisi = loadDivisiItem();

	if( isset($_POST['btnSubmit']) ){
		if( editBarang($_GET['id'],$_POST['ddlDivisi'],$_POST['ddlKategori'],$_POST['ddlMerk'],$_POST['txtNamaBarang'],$_POST['txtJmlBarang'],$_POST['txtTanggalMasuk']) ){
			echo "<script>alert('Berhasil Mengubah Data!!!')</script>";
			header("Location:index.php");
		}
		else{
			echo "<script>alert('Gagal Mengubah Data!!!')</script>";
		}
	}
?>
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
			</ul>
		</div>
	</nav>
	<div class="container container-custom">
		<div class="row">
			<div class="col-md-12">
				<h3>Edit Barang</h3>
			</div>
		</div>
		<div class="row">
			
			</div>
			<div class="row" style="margin-top: 3%;">
			<div class="col-md-12">
				<form action="" method="post">
					<div class="row">
						<div class="col-md-6">
						<div class="form-group">
						<label for="ddlDivisi">Divisi :</label>
						<select name="ddlKategori" id="ddlKategori" class="form-control">
							<?php for($i = 0; $i < count($Kategori); $i++): ?>
								<option value="<?php echo $Kategori[$i]['IdKategori']; ?>"<?php if($hasil[0]['IdKategori'] == $Kategori[$i]['IdKategori']){echo "selected=selected";} ?>><?php echo $Kategori[$i]['NamaKategori']; ?></option>
							<?php endfor; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="ddlMerk">Divisi :</label>
						<select name="ddlMerk" id="ddlMerk" class="form-control">
							<?php for($i = 0; $i < count($Merk); $i++): ?>
								<option value="<?php echo $Merk[$i]['IdMerk']; ?>"<?php if($hasil[0]['IdMerk'] == $Merk[$i]['IdMerk']){echo "selected=selected";} ?>><?php echo $Merk[$i]['NamaMerk']; ?></option>
							<?php endfor; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="ddlDivisi">Divisi :</label>
						<select name="ddlDivisi" id="ddlDivisi" class="form-control">
							<?php for($i = 0; $i < count($Divisi); $i++): ?>
								<option value="<?php echo $Divisi[$i]['IdDivisi']; ?>"<?php if($hasil[0]['IdDivisi'] == $Divisi[$i]['IdDivisi']){echo "selected=selected";} ?>><?php echo $Divisi[$i]['NamaDivisi']; ?></option>
							<?php endfor; ?>
						</select>
					</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="txtNamaBarang">Nama Barang :</label>
							<input type="text" name="txtNamaBarang" id="txtNamaBarang" value="<?php echo $hasil[0]['NamaBarang']; ?>" class="form-control">
						</div>
						<div class="form-group">
							<label for="txtJmlBarang">Jumlah Barang :</label>
							<input type="number" value="<?php echo $hasil[0]['JumlahBarang']; ?>" name="txtJmlBarang" id="txtJmlBarang" class="form-control">
						</div>
						<div class="form-group">
							<label for="txtTanggalMasuk">Tanggal Masuk :</label>
							<input type="date" value="<?php echo $hasil[0]['TglMasuk']; ?>" name="txtTanggalMasuk" id="txtTanggalMasuk" class="form-control">
						</div>
					</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<a class="btn btn-secondary btn-block" href="index.php"><i class="fa fa-arrow-left"></i> Kembali</a>
						</div>
						<div class="col-md-3">
							<button type="submit" name="btnSubmit" class="btn btn-success btn-block"><i class="fa fa-save"></i> Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>

	<script type="text/javascript" src="boostrap/popper.js/1.14.0/umd/popper.min.js"></script>
	<script type="text/javascript" src="boostrap/jquery/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="boostrap/jquery/jquery.js"></script>
	<script type="text/javascript" src="boostrap/js/bootstrap.min.js"></script>
</body>