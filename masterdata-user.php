<?php 
	require 'functions.php';
	session_start();
	if( !isset($_SESSION['username']) ){
		header("Location:login.php");
		exit;
	}
	$userActive=$_SESSION['username'];
	$hasil = loadUser();
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
			<img src="images/logo_pesonaedu.png" width="100" height="100" class="d-inline-block align-top">
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
			        	<a class="dropdown-item" href="laporan-barang.php"><i class="fa fa-list-alt"></i> Laporan barang</a>
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
	
	<!--Content-->
	<div class="container container-custom">
		<div class="row">
			<div class="col-md-12">
				<h3 >Divisi</h3>
				<div class="pull-left" style="margin:15px;">
				<a type="button" href="tambah-user.php"  class="btn btn-primary btn-block" pull-right><i class="fa fa-plus"></i> Tambah User</a>
			</div>
				<div class="table-responsive">
					<table class="table text-center">
					  <thead class="thead-light">
					    <tr>
					      
							<th scope="col">User</th>
							<th scope="col">Email</th>
						     <th scope="col">Password</th>
						     <th scope="col">Aksi</th>
					    </tr>
					  </thead>
					  <tbody>
					    <?php for($i = 0; $i < count($hasil); $i++) : ?>
						 
					    	<tr>
						     <?php if ($userActive!=$hasil[$i]['Username']): ?>     
						      
						      <td><?php echo $hasil[$i]['Username']; ?></td>
							 
							 <?php if ($username!=$hasil[$i]['Username']): ?>  
								<td><?php echo $hasil[$i]['Email']; ?></td>
								<td><?php echo $hasil[$i]['password']; ?></td>								
								<td><a href="masterdata-user.php?editUser=<?php echo $hasil[$i]['Username']; ?>" class="btn btn-success btn-sm"	>Edit</a> | <a onclick="return confirm('Apakah Yakin Ingin Menghapus?')" class="btn btn-Danger btn-sm" href="functions.php?deleteUser=<?php echo $hasil[$i]['Username']; ?>">Hapus</a></td>
							<?php endif; ?>
							
							
							 <?php if ($username==$hasil[$i]['Username']): ?>   
							 <form method="POST" action="functions.php"> 
								
								<input type="hidden" name="username" value="<?php echo $username ?>"  class="form-control" >
							
								<td style="width:160px;">  <input type="text" value="<?php echo $email ?>" name="email" class="form-control" ></td>
								<td style="width:160px;">  <input type="text" value="<?php echo $password ?>" name="password" class="form-control" ></td>
								
								
								<td><button name="updateUser" class="btn btn-warning btn-sm">Update</button> 
							
							</form>
							<?php endif; ?>
							  
							  
							  
						 	
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
	

	<script type="text/javascript" src="boostrap/popper.js/1.14.0/umd/popper.min.js"></script>
	<script type="text/javascript" src="boostrap/jquery/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="boostrap/jquery/jquery.js"></script>
	<script type="text/javascript" src="boostrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			
			$('#simpanDivisi').click(function(){
				$.ajax({url:'tambah_divisi.php?value='+$('#txtNamaDivisi').val()}).done(function(){
					loadUser();
				});
			});

	
		});
	</script>
</body>