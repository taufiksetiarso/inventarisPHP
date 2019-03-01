<?php

	session_start();
	require 'functions.php';
	if( !isset($_SESSION['username']) ){
		header("Location:location.php");
		exit;
	}

	if( isset($_POST['btnSubmit']) ){
		if( tambahBarang($_POST['ddlDivisi'],$_POST['ddlKategori'],$_POST['ddlMerk'],$_POST['txtNamaBarang'],$_POST['txtJmlBarang'],$_POST['txtTanggalMasuk']) ){
			echo "<script>alert('Berhasil Menambahkan Barang!!!')</script>";
		}
		else{
			echo "<script>alert('Gagal Menambahkan Barang!!!')</script>";
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
			<img src="images/logo_pesonaedu.png" width="100" height="63" class="d-inline-block align-top">
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
			          Mutasi Barang
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			        	<a class="dropdown-item" href="data-mutasi-barang.php"><i class="fa fa-list-alt"></i> Data barang</a>
			          <a class="dropdown-item" href="tambah-mutasi-barang.php"><i class="fa fa-plus"></i> Tambah Mutasi Barang </a>
			        </div>
		      </li>
			</ul>
			  <ul class="navbar-nav">
				<li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          Laporan
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			        	<a class="dropdown-item" href="laporan-barang.php"><i class="fa fa-list-alt"></i> Laporan barang</a>
			          <a class="dropdown-item" href="laporan-mutasi-barang.php"><i class="fa fa-list"></i> Laporan Mutasi</a>
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
				<div class="pull-right" style="padding-left:500px;padding-top:15px"> <span class="badge badge-primary"><font size="3" color="white">hai, <?php echo $_SESSION['username'];?></font></span></div>
		</div>
	</nav>
	<div class="container container-custom">
		<div class="row">
			<div class="col-md-12">
				<h3>Tambah Barang</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<button type="button" data-toggle="modal" data-target="#TmbhKategoriModal"  class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Tambah Kategori</button>
			</div>
			<div class="col-lg-4">
				<button type="button" data-toggle="modal" data-target="#TmbhMerkModal" class="btn btn-danger btn-block"><i class="fa fa-plus"></i> Tambah Merk</button>
			</div>
			<div class="col-lg-4">
				<button type="button" data-toggle="modal" data-target="#TmbhDivisiModal" class="btn btn-warning btn-block"><i class="fa fa-plus"></i> Tambah Divisi</button>
			</div>
			</div>
			<div class="row" style="margin-top: 3%;">
			<div class="col-md-12">
				<form action="" method="post">
					<div class="row">
						<div class="col-md-6">
						<div class="form-group">
						<label for="ddlDivisi">Kategori :</label>
						<select name="ddlKategori" id="ddlKategori" class="form-control">
						</select>
					</div>
					<div class="form-group">
						<label for="ddlDivisi">Merk :</label>
						<select name="ddlMerk" id="ddlMerk" class="form-control">
						</select>
					</div>
					<div class="form-group">
						<label for="ddlDivisi">Divisi :</label>
						<select name="ddlDivisi" id="ddlDivisi" class="form-control">
						</select>
					</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="txtNamaBarang">Nama Barang :</label>
							<input type="text" name="txtNamaBarang" id="txtNamaBarang" class="form-control">
						</div>
						<div class="form-group">
							<label for="txtJmlBarang">Jumlah Barang :</label>
							<input type="number" name="txtJmlBarang" id="txtJmlBarang" class="form-control">
						</div>
						<div class="form-group">
							<label for="txtTanggalMasuk">Tanggal Masuk :</label>
							<input type="date" name="txtTanggalMasuk" id="txtTanggalMasuk" class="form-control">
						</div>
					</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<a href="index.php" class="btn btn-secondary btn-block"><i class="fa fa-arrow-left"></i> Kembali</a>
						</div>
						<div class="col-md-3">
							<button type="submit" name="btnSubmit" id="simpanDivisi" class="btn btn-success btn-block"><i class="fa fa-save"></i> Simpan</button>
						</div>
					</div>
					</div>
				</form>
			</div>
		</div>

		<!-- Modal Untuk Tambah Kategori -->
		<div class="modal" id="TmbhKategoriModal" tabindex="-1" role="dialog">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Tambah Kategori</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<form action="" method="post">
		        <div class="form-group">
							<label for="txtNamaKtgri">Nama Kategori :</label>
							<input type="text" name="txtNamaKtgri" id="txtNamaKtgri" class="form-control">
				</div>
				</form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" data-dismiss="modal" id="simpanKategori" class="btn btn-primary">Simpan</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>

				<!-- Modal Untuk Tambah Kategori -->
		<div class="modal" id="TmbhMerkModal" tabindex="-1" role="dialog">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Tambah Merk</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<form action="" method="post">
		        <div class="form-group">
							<label for="txtNamaMerk">Nama Merk :</label>
							<input type="text" name="txtNamaMerk" id="txtNamaMerk" class="form-control">
				</div>
				</form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" data-dismiss="modal" class="btn btn-primary" id="simpanMerk">Simpan</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>

				<!-- Modal Untuk Tambah Kategori -->
		<div class="modal" id="TmbhDivisiModal" tabindex="-1" role="dialog">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Tambah Divisi</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<form action="" method="post">
		        <div class="form-group">
							<label for="txtNamaDivisi">Nama Divisi:</label>
							<input type="text" name="txtNamaDivisi" id="txtNamaDivisi" class="form-control">
				</div>
				</form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" data-dismiss="modal" class="btn btn-primary" id="aaa">Simpan</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
	<script type="text/javascript" src="boostrap/popper.js/1.14.0/umd/popper.min.js"></script>
	<script type="text/javascript" src="boostrap/jquery/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="boostrap/jquery/jquery.js"></script>
	<script type="text/javascript" src="boostrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			
			var loadKategori = function(){
				$('#ddlKategori').load('loadKategoriItem.php');
			}

			var loadMerk = function(){
				$('#ddlMerk').load('loadMerkItem.php');
			}

			var loadDivisi = function(){
				$('#ddlDivisi').load('loadDivisiItem.php');
			}

			loadKategori();
			loadMerk();
			loadDivisi();
			$('#simpanKategori').click(function(){
				$.ajax({url:'tambah_kategori.php?value='+$('#txtNamaKtgri').val()}).done(function(){
					loadKategori();
				});
			});

			$('#simpanMerk').click(function(){
				$.ajax({url:'tambah_merk.php?value='+$('#txtNamaMerk').val()}).done(function(){
					loadMerk();
				});
			});

			$('#aaa').click(function(){
				$.ajax({url:'tambah_divisi.php?value='+$('#txtNamaDivisi').val()}).done(function(){
					loadDivisi();
				});
			});
		});
	</script>
</body>