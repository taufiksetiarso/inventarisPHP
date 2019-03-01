<?php 
	require 'functions.php';
	session_start();
	if( !isset($_SESSION['username']) ){
		header("Location:login.php");
		exit;
	}

	$hasil = loadMerkItem();
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
	
	
	<!--Content-->
	<div class="container container-custom">
		<div class="row">
			<div class="col-md-12">
				<h3 >Merk Barang</h3>
				<div class="pull-left" style="margin:15px;">
				<button type="button" data-toggle="modal" data-target="#TmbhMerkModal"  class="btn btn-primary btn-block" pull-right><i class="fa fa-plus"></i> Tambah Kategori</button>
			</div>
				<div class="table-responsive">
					<table class="table text-center">
					  <thead class="thead-light">
					    <tr>
					      <th scope="col">Id Merk</th>
					      <th scope="col">Nama Merek</th>
					      <th scope="col">Aksi</th>
					    </tr>
					<?php for($i = 0; $i < count($hasil); $i++) : ?>
					    	<tr>
						     
						      <td><?php echo $hasil[$i]['IdMerk']; ?></td>
						    
							<?php if ($idMerk!=$hasil[$i]['IdMerk']): ?>  
								<td><?php echo $hasil[$i]['NamaMerk']; ?></td>			   
								<td><a href="masterdata-Merk.php?editMerk=<?php echo $hasil[$i]['IdMerk']; ?>" class="btn btn-success btn-sm"	>Edit</a> | <a onclick="return confirm('Apakah Yakin Ingin Menghapus Merk Tersebut Dari Semua Table? ')" class="btn btn-Danger btn-sm" href="functions.php?deleteMerk=<?php echo $hasil[$i]['IdMerk']; ?>">Hapus</a></td>
							<?php endif; ?>
							 
							 <?php if ($idMerk==$hasil[$i]['IdMerk']): ?>   
						
								<form method="POST" action="functions.php"> 
								
								<input type="hidden" name="idMerk" value="<?php echo $idMerk ?>"  class="form-control" >
							
								<td style="width:160px;">  <input type="text" value="<?php echo $namaMerk ?>" name="namaMerk" class="form-control" ></td>
								<td><button name="updateMerk" class="btn btn-warning btn-sm">Update</button> 
							
							</form>
							<?php endif; ?>
							
							</tr>
					    <?php endfor; ?>
					  </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!--Content-->
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

	<script type="text/javascript" src="boostrap/popper.js/1.14.0/umd/popper.min.js"></script>
	<script type="text/javascript" src="boostrap/jquery/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="boostrap/jquery/jquery.js"></script>
	<script type="text/javascript" src="boostrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			
			$('#simpanMerk').click(function(){
				$.ajax({url:'tambah_merk.php?value='+$('#txtNamaMerk').val()}).done(function(){
					loadMerk();
				});
			});

	
		});
	</script>
</body>