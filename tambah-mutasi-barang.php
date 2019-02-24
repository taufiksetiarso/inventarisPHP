<?php

	session_start();
	require 'functions.php';
	$Divisi = loadDivisiItem();
	if( !isset($_SESSION['username']) ){
		header("Location:location.php");
		exit;
	}
	
	if( isset($_POST['btnSubmit']) ){
		if( tambahMutasiBarang($_POST['idBarang'],$_POST['ddlDivisi'],$_POST['txtStatusBaru'],$_POST['txtjumlahBarang'],$_POST['txtKeterangan'],$_POST['txtTanggalMutasi']) ){
			echo "<script>alert('Berhasil Menambahkan Mutasi Barang!!!')</script>";
			header("Location:data-mutasi-barang.php");
		}
		else{
			echo "<script>alert('Gagal Menambahkan Mutasi Barang!!!')</script>";
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
		</div>
	</nav>
	<div class="container container-custom">
		<div class="row">
			<div class="col-md-12">
				<h3>Form Mutasi Barang</h3>
			</div>
		</div>
		<div class="row">
		
			<div class="col-lg-4">
				<button type="button" data-toggle="modal" data-target="#TmbhDivisiModal" class="btn btn-warning btn-block"><i class="fa fa-plus"></i> Tambah Divisi</button>
			</div>
			</div>
			<div class="row" style="margin-top: 3%;">
			<div class="col-md-12">
				<form action="" method="post">
			        

					<div class="form-group">
						<label for="ddlDivisi">Nama Barang :</label>
						<select name="idBarang" id="idBarang" onchange="changeValue(this.value)" class="form-control">
					<option value=0>-Pilih-</option>
				<?php 
					  
					$query = "SELECT A.IdBarang,A.NamaBarang,B.IdMerk, B.NamaMerk, 
					A.JumlahBarang, C.IdKategori,C.NamaKategori,D.IdDivisi, D.NamaDivisi, A.TglMasuk
					FROM barang A join merk B on A.IdMerk = B.IdMerk join 
					kategori C on A.IdKategori = C.IdKategori
					join divisi D on A.IdDivisi = D.IdDivisi";
					$hasil = mysqli_query($con,$query);
					$result = [];
					$jsArray = "var dtMhs = new Array();\n";
					while ($row = mysqli_fetch_assoc($hasil)) {
						echo '<option value="' . $row['IdBarang'] . '">' . $row['NamaBarang'] . '</option>';
						$jsArray .= "dtMhs['" . $row['IdBarang'] . "'] = {namaDivisi:'" . addslashes($row['NamaDivisi']) . "',jumlahBarang:'".addslashes($row['JumlahBarang'])."'};\n";    
								
					}					
					?>    
					</select>
					</div>
					<div class="form-group">
						<label for="LokasiAwal">Lokasi Awal :</label>
						<input type="text" name="txtlokasiAwal" id="txtlokasiAwal" style="border: transparent !important;">
					</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						<label for="ddlDivisi">Lokasi Baru :</label>
						<select name="ddlDivisi" id="ddlDivisi" class="form-control">
						<option value=0>-Pilih-</option>
						<?php for($i = 0; $i < count($Divisi); $i++): ?>
								<option value="<?php echo $Divisi[$i]['NamaDivisi']; ?>"><?php echo $Divisi[$i]['NamaDivisi']; ?></option>
							<?php endfor; ?>
						</select>
						
					</div>
						<div class="form-group">
							<label for="txtJmlBarang">Keterangan :</label>
							<input type="text" name="txtKeterangan" id="txtKeterangan" class="form-control">
						</div>
						<div class="form-group">
							<label for="txtTanggalMasuk">Tanggal Mutasi :</label>
							<input type="date" name="txtTanggalMutasi" id="txtTanggalMutasi" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						<label for="ddlDivisi">Jumlah Barang :</label>
						<input type="number" name="txtjumlahBarang" id="txtjumlahBarang" class="form-control" >
						
					</div>
						<div class="form-group">
							<label for="txtJmlBarang">Sisa Barang :</label>
							<input type="text" name="txtsisaBarang" id="txtsisaBarang" class="form-control" disabled>
						</div>
						<div class="form-group">
							<label for="txtTanggalMasuk">Status Barang :</label>
							<input type="text" name="txtStatusBaru" id="txtStatusBaru" class="form-control">
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

		
	<script type="text/javascript" src="boostrap/popper.js/1.14.0/umd/popper.min.js"></script>
	<script type="text/javascript" src="boostrap/jquery/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="boostrap/jquery/jquery.js"></script>
	<script type="text/javascript" src="boostrap/js/bootstrap.min.js"></script>
	
	
	<script type="text/javascript">    
    <?php echo $jsArray; ?>  
    function changeValue(idBarang){  
    document.getElementById('txtlokasiAwal').value = dtMhs[idBarang].namaDivisi;  
    document.getElementById('txtsisaBarang').value = dtMhs[idBarang].jumlahBarang;
    }  
 
		$(document).ready(function(){
			
			var loadKategori = function(){
				$('#ddlKategori').load('loadDataMutasiBarang()');
			}

			var loadMerk = function(){
				$('#ddlBarang').load('loadBarangItem.php');
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