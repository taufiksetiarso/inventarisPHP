<?php 
	require 'functions.php';
	session_start();
	if( !isset($_SESSION['username']) ){
		header("Location:login.php");
		exit;
	}
	$hasil = loadDataMutasiBarang();
	if( isset($_POST['btnSearch']) ){
		if($_POST['txtTanggalDari']=='' && $_POST['txtTanggalSampai']==''){
		echo "<script type='text/javascript'>alert('dari dan sampai tidak boleh kosong'); location = '/inventarisEdu/inventaris/laporan-mutasi-barang.php';</script>";
		
		}
		$hasil = loadTanggalMutasi($_POST['txtTanggalDari'],$_POST['txtTanggalSampai']);
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
	<div class="container container-custom" style="max-width: 1300px;">
		<div class="row">
			<div class="col-md-12">
			
				<h3>Data Barang</h3>
				<div class="row">
				
				<div class="col-sm-8 form-inline"style="margin-bottom:30px;margin-top:30px;">
				<form action="" method="post" class="form-inline">
				<label>Periode dari</label>&nbsp;&nbsp;
				
				
				<input type="date" name="txtTanggalDari" id="txtTanggalDari" class="form-control" style="width:30%;">
					&nbsp;&nbsp;&nbsp;&nbsp;
				<label>Sampai</label>&nbsp;&nbsp;  
				<input type="date" name="txtTanggalSampai" id="txtTanggalSampai" class="form-control" style="width:30%;">
						&nbsp;&nbsp;	<button class="btn btn-lg btn-secondary "  name="btnSearch"><i class="fa fa-search"></i> </button>
			     </form>
				</div>
				
				<div class="col-sm-1">
				
				</div>
				<div class="col-sm-3">
				<?php	if( isset($_POST['btnSearch']) ):?>
					<a href="simpan-print-mutasi-barang.php?dari=<?php echo $_POST['txtTanggalDari']?>&sampai=<?php echo $_POST['txtTanggalSampai']?>" class="btn btn-primary " style="margin-bottom:30px;margin-top:30px;"><i class="fa fa-print"></i> Simpan</a>
			
			<?php endif; ?>
					
					<?php	if( !isset($_POST['btnSearch']) ):?>
					<a href="simpan-print-mutasi-barang.php" class="btn btn-primary " style="margin-bottom:30px;margin-top:30px;"><i class="fa fa-print"></i> Simpan</a>
					<?php endif; ?>&nbsp;
			<?php	if( isset($_POST['btnSearch']) ):?>
					<a href="print-mutasi-barang.php?dari=<?php echo $_POST['txtTanggalDari']?>&sampai=<?php echo $_POST['txtTanggalSampai']?>" class="btn btn-info " style="margin-bottom:30px;margin-top:30px;"><i class="fa fa-print"></i> Cetak</a>
			
			<?php endif; ?>
					
					<?php	if( !isset($_POST['btnSearch']) ):?>
					<a href="print-mutasi-barang.php" class="btn btn-info " style="margin-bottom:30px;margin-top:30px;"><i class="fa fa-print"></i> Cetak</a>
					<?php endif; ?>
				</div>
				</div>
				<div class="table-responsive">
					<table class="table text-center">
					  <thead>
					    <tr>
					      <th scope="col">No</th>
					      <th scope="col">Nama Barang</th>
					      <th scope="col">Lokasi Awal</th>
					      <th scope="col">Lokasi Baru</th>
					      <th scope="col">Status Barang</th>
					      <th scope="col">Jumlah Barang</th>
					      <th scope="col">Sisa Barang</th>
					      <th scope="col">Keterangan</th>
						  <th scope="col">Tanggal Mutasi</th>
						
					    </tr>
					  </thead>
					  <tbody>
					    <?php for($i = 0; $i < count($hasil); $i++) : ?>
					    	<tr>
						      <th scope="row"><?php echo $i+1; ?></th>
						      <td><?php echo $hasil[$i]['NamaBarang']; ?></td>
						      <td><?php echo $hasil[$i]['NamaDivisi']; ?></td>
						      <td><?php echo $hasil[$i]['divisiBaru'];  ?></td>
						      <td><?php echo $hasil[$i]['statusBarang']; ?></td>
						      <td><?php echo $hasil[$i]['JumlahMutasiBarang']; ?></td>
						      <td><?php echo $hasil[$i]['JumlahBarang']; ?></td>
							  <td><?php echo $hasil[$i]['Keterangan']; ?></td>
						      <td><?php echo $hasil[$i]['TanggalMutasi']; ?></td>
						     	</tr>
					    <?php endfor; ?>
					  </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="boostrap/popper.js/1.14.0/umd/popper.min.js"></script>
	<script type="text/javascript" src="boostrap/jquery/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="boostrap/js/bootstrap.min.js"></script>
</body>