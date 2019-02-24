<?php 

	require 'functions.php';
	if(hapusBarang($_GET['id'])){
		echo "<script>alert('Berhasil Menghapus Data!!!')</script>";
		header("Location:index.php");
		exit;
	}
	else{
		echo "<script>alert('Gagal Menghapus Data!!!')</script>";
		header("Location:index.php");
		exit;
	}

?>