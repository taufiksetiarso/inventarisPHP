<?php

	$con = mysqli_connect("localhost","root","","inventaris");
	$namaKategori="";
	$idKategori=0;
	$idMerk=0;
	$idDivisi=0;
	$namaMerk="";
	$namaDivisi="";
	$password="";
	$email="";
	$username="";
	
	
	function login($username,$password){

		global $con;
		$user = mysqli_query($con,"SELECT * FROM user WHERE username = '".$username."' AND password = '".$password."'");

		if( $a = mysqli_fetch_assoc($user) ){
			return $a;
		}
		else{
			return false;
		}

	}

	function registrasi($username,$email,$password){

		global $con;

		$query = "INSERT INTO user (Username,Email,Password) VALUES ('".$username."','".$email."','".$password."')";

		if( mysqli_query($con,$query) ){
			return true;
		}
		else{
			return false;
		}

	}
	
	
	function loadTanggalBarang($dari,$sampai){
		global $con;

		$query = "SELECT A.IdBarang,A.NamaBarang,B.IdMerk, B.NamaMerk, 
					A.JumlahBarang, C.IdKategori,C.NamaKategori,D.IdDivisi, D.NamaDivisi, A.TglMasuk
					FROM barang A join merk B on A.IdMerk = B.IdMerk join 
					kategori C on A.IdKategori = C.IdKategori
					join divisi D on A.IdDivisi = D.IdDivisi WHERE (A.TglMasuk BETWEEN '".$dari."' AND '".$sampai."')ORDER BY A.TglMasuk Asc";
		$result = mysqli_query($con,$query);
		$hasil = [];
		while ( $a = mysqli_fetch_assoc($result) ) {
			$hasil[] = $a;
		}
		return $hasil;
		
		
		
	}
	
	
	function loadTanggalMutasi($dari,$sampai){
		global $con;

		$query = "SELECT A.IdMutasiBarang,B.NamaBarang,D.NamaDivisi,A.divisiBaru,A.statusBarang,A.JumlahMutasiBarang,B.JumlahBarang,A.Keterangan,A.TanggalMutasi from data_mutasi_barang A join barang B on A.idBarang=B.IdBarang JOIN divisi D on B.IdDivisi=D.IdDivisi where (TanggalMutasi BETWEEN '".$dari."' AND '".$sampai."' )ORDER BY A.TanggalMutasi Asc";
		$result = mysqli_query($con,$query);
		$hasil = [];
		while ( $a = mysqli_fetch_assoc($result) ) {
			$hasil[] = $a;
		}
		return $hasil;
		
		
		
	}
	
	function loadUser(){
		global $con;

		$query = "SELECT * FROM user";
		$result = mysqli_query($con,$query);
		$hasil = [];
		while ( $a = mysqli_fetch_assoc($result) ) {
			$hasil[] = $a;
		}
		return $hasil;
	}
	
	function loadKategoriItem(){
		global $con;

		$query = "SELECT * FROM kategori";
		$result = mysqli_query($con,$query);
		$hasil = [];
		while ( $a = mysqli_fetch_assoc($result) ) {
			$hasil[] = $a;
		}
		return $hasil;
	}

	function loadMerkItem(){
		global $con;

		$query = "SELECT * FROM merk";
		$result = mysqli_query($con,$query);
		$hasil = [];
		while ( $a = mysqli_fetch_assoc($result) ) {
			$hasil[] = $a;
		}
		return $hasil;
	}

	function loadDivisiItem(){
		global $con;

		$query = "SELECT * FROM divisi";
		$result = mysqli_query($con,$query);
		$hasil = [];
		while ( $a = mysqli_fetch_assoc($result) ) {
			$hasil[] = $a;
		}
		return $hasil;
	}

	function tambahKategoriItem($nama){
		global $con;

		$query = "INSERT INTO kategori (NamaKategori) VALUES ('".$nama."')";
		mysqli_query($con,$query);
	}

	function tambahMerkItem($nama){
		global $con;

		$query = "INSERT INTO merk (NamaMerk) VALUES ('".$nama."')";
		mysqli_query($con,$query);
	}

	function tambahDivisiItem($nama){
		global $con;

		$query = "INSERT INTO divisi (NamaDivisi) VALUES ('".$nama."')";
		mysqli_query($con,$query);
	}

	function tambahBarang($IdDivisi,$IdKategori,$IdMerk,$NamaBarang,$JumlahBarang,$TglMasuk){
		global $con;

		$query = "INSERT INTO barang (IdDivisi,IdKategori,IdMerk,NamaBarang,JumlahBarang,TglMasuk) VALUES ('".$IdDivisi."','".$IdKategori."','".$IdMerk."','".$NamaBarang."','".$JumlahBarang."','".$TglMasuk."')";
		if( mysqli_query($con,$query) ){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	function tambahMutasiBarang($idBarang,$divisiBaru,$statusBarang,$jumlahBarang,$keterangan,$tanggalMutasi){
		global $con;

		$query = "INSERT INTO `data_mutasi_barang` (`IdMutasiBarang`, `idBarang`, `divisiBaru`, `statusBarang`, `JumlahMutasiBarang`, `Keterangan`, `TanggalMutasi`) 
					VALUES (NULL, '".$idBarang."', '".$divisiBaru."', '".$statusBarang."', '".$jumlahBarang."', '".$keterangan."', '$tanggalMutasi')";
		if( mysqli_query($con,$query) ){
			return true;
		}
		else{
			return false;
		}
	}
	
	function updateMutasiBarang($idMutasiBarang,$idBarang,$divisiBaru,$statusBarang,$jumlahBarang,$keterangan,$tanggalMutasi){
		global $con;
		
	

		$query = "	UPDATE `data_mutasi_barang` SET `idBarang` = '".$idBarang."', `divisiBaru` = '".$divisiBaru."',`statusBarang`='".$statusBarang."', `JumlahMutasiBarang` = '".$jumlahBarang."', `Keterangan` = '".$keterangan."', `TanggalMutasi` = '".$tanggalMutasi."' WHERE `data_mutasi_barang`.`IdMutasiBarang` = $idMutasiBarang";
		if( mysqli_query($con,$query) ){
			return true;
		}
		else{
			mysql_error;
			return false;
		}
	}
	
	function loadDataMutasiBarang(){
		global $con;

		$query = "SELECT A.IdMutasiBarang,B.NamaBarang,D.NamaDivisi,A.divisiBaru,A.statusBarang,A.JumlahMutasiBarang,B.JumlahBarang,A.Keterangan,A.TanggalMutasi from data_mutasi_barang A join barang B on A.idBarang=B.IdBarang JOIN divisi D on B.IdDivisi=D.IdDivisi order by A.IdMutasiBarang ";
		$hasil = mysqli_query($con,$query);
		$result = [];
		while ($a = mysqli_fetch_assoc($hasil)) {
			$result[] = $a;
		}
		return $result;
	}
	function loadDataMutasiBarangId($idMutasiBarang){
		global $con;

		$query = "SELECT B.IdBarang,B.NamaBarang,D.NamaDivisi,A.divisiBaru,A.statusBarang,A.JumlahMutasiBarang,B.JumlahBarang,A.Keterangan,A.TanggalMutasi from data_mutasi_barang A join barang B on A.idBarang=B.IdBarang JOIN divisi D on B.IdDivisi=D.IdDivisi where A.IdMutasiBarang=$idMutasiBarang";
		$hasil = mysqli_query($con,$query);
		$result = [];
		while ($a = mysqli_fetch_assoc($hasil)) {
			$result[] = $a;
		}
		return $result;
	}
	
	function loadBarang(){
		global $con;

		$query = "SELECT A.IdBarang,A.NamaBarang,B.IdMerk, B.NamaMerk, 
					A.JumlahBarang, C.IdKategori,C.NamaKategori,D.IdDivisi, D.NamaDivisi, A.TglMasuk
					FROM barang A join merk B on A.IdMerk = B.IdMerk join 
					kategori C on A.IdKategori = C.IdKategori
					join divisi D on A.IdDivisi = D.IdDivisi";
		$hasil = mysqli_query($con,$query);
		$result = [];
		while ($a = mysqli_fetch_assoc($hasil)) {
			$result[] = $a;
		}
		return $result;
	}

	function loadBarangWithId($id){
		global $con;

		$query = "SELECT A.IdBarang,A.NamaBarang,B.IdMerk, B.NamaMerk, 
					A.JumlahBarang, C.IdKategori,C.NamaKategori,D.IdDivisi, D.NamaDivisi, A.TglMasuk
					FROM barang A join merk B on A.IdMerk = B.IdMerk join 
					kategori C on A.IdKategori = C.IdKategori
					join divisi D on A.IdDivisi = D.IdDivisi WHERE A.IdBarang = $id";
		$hasil = mysqli_query($con,$query);
		$result = [];
		while ($a = mysqli_fetch_assoc($hasil)) {
			$result[] = $a;
		}
		return $result;
	}
		function loadKategoriWithId($id){
		global $con;
		$query="select * from kategori where IdKategori=$id";
		$hasil = mysqli_query($con,$query);
		$result = [];
		
		while ($a = mysqli_fetch_assoc($hasil)) {
			$result[] = $a;
		}
		return $result;
		}
		
		if (isset($_GET['editKategori'])){
			$id=$_GET['editKategori'];
			$result=$con->query("select * from kategori where IdKategori=$id")or die($con->error());
			if(count($result)==1){
				$row=$result->fetch_array();
				$namaKategori=$row['NamaKategori'];
				$idKategori=$row['IdKategori'];
			}
		}
		
		if (isset($_POST['updateKategori'])){
			
			$cb=$_POST['idKat'];
			$namaKategori=$_POST['namaKategori'];
			$result=$con->query("update kategori set NamaKategori='$namaKategori' where IdKategori=$cb")or die($con->error);
			echo "<script>alert('Data Telah Update!!!');location = '/inventarisEdu/inventaris/masterdata-kategori.php';</script>";
		
		}
		
		if (isset($_GET['editMerk'])){
			$id=$_GET['editMerk'];
			$result=$con->query("select * from merk where IdMerk=$id")or die($con->error());
			if(count($result)==1){
				$row=$result->fetch_array();
				$namaMerk=$row['NamaMerk'];
				$idMerk=$row['IdMerk'];
			}
		}
		
		if (isset($_POST['updateMerk'])){
			
			$cb=$_POST['idMerk'];
			$namaMerk=$_POST['namaMerk'];
			$result=$con->query("update merk set NamaMerk='$namaMerk' where IdMerk=$cb")or die($con->error);
			echo "<script>alert('Data Telah Update!!!');location = '/inventarisEdu/inventaris/masterdata-merk.php';</script>";
		}
		
		if (isset($_GET['editDivisi'])){
			$id=$_GET['editDivisi'];
			$result=$con->query("select * from divisi where IdDivisi=$id")or die($con->error);
			if(count($result)==1){
				$row=$result->fetch_array();
				$namaDivisi=$row['NamaDivisi'];
				$idDivisi=$row['IdDivisi'];
			}
		}
		
		if (isset($_POST['updateDivisi'])){
			
			$cb=$_POST['idDivisi'];
			$namaDivisi=$_POST['namaDivisi'];
			$result=$con->query("update divisi set NamaDivisi='$namaDivisi ' where IdDivisi=$cb")or die($con->error);
			echo "<script>alert('Data Telah Update!!!');location = '/inventarisEdu/inventaris/masterdata-divisi.php';</script>";
		}
		
		if (isset($_GET['editUser'])){
			$id=$_GET['editUser'];
			$result=$con->query("select * from user where Username='$id'")or die($con->error);
			if(count($result)==1){
				$row=$result->fetch_array();
				$email=$row['Email'];
				$password=$row['password'];
				$username=$row['Username'];
			}
		}
		
		if (isset($_POST['updateUser'])){
			
			$cb=$_POST['username'];
			$email=$_POST['email'];
			$password=$_POST['password'];
			$result=$con->query("update user set email='$email',password='$password' where username='$cb'")or die($con->error);
			echo "<script>alert('Data Telah Update!!!');location = '/inventarisEdu/inventaris/masterdata-user.php';</script>";
		}
		
	function hapusBarang($id){
		global $con;
		$query = "DELETE FROM barang WHERE IdBarang=$id";
		if(mysqli_query($con,$query)){
			return true;
		}
		else{
			return false;
		}
	}
	
	function hapusBarangKategori($id){
		global $con;
		$query = "DELETE FROM barang WHERE IdKategori=$id";
		if(mysqli_query($con,$query)){
			return true;
		}
		else{
			return false;
		}
	}
	
	if (isset($_GET['deleteKategori'])){
		$id=$_GET['deleteKategori'];
		global $con;
		hapusBarangKategori($id);
		$query="delete from kategori where IdKategori=$id";
		
		if(mysqli_query($con,$query)){
			echo "<script>alert('Berhasil Menghapus Data!!!')</script>";
			header("Location:masterdata-kategori.php");
			return true;
		}
		else{
			echo "<script>alert('gagal Menghapus Data kategori!!!')</script>";
			header("Location:masterdata-kategori.php");
			return false;
		}
		
	}
	
	if (isset($_GET['deleteUser'])){
		$id=$_GET['deleteUser'];
		global $con;
		$query="delete from user where Username='$id'";
		
		if(mysqli_query($con,$query)){
			echo "<script>alert('Berhasil Menghapus Data!!!')</script>";
			header("Location:masterdata-user.php");
			return true;
		}
		else{
			echo "<script>alert('gagal Menghapus Data kategori!!!')</script>";
			header("Location:masterdata-user.php");
			return false;
		}
	}

	function hapusBarangMerk($id){
		global $con;
		$query = "DELETE FROM barang WHERE IdMerk=$id";
		if(mysqli_query($con,$query)){
			return true;
		}
		else{
			return false;
		}
	}
	if (isset($_GET['deleteMerk'])){
		$id=$_GET['deleteMerk'];
		global $con;
		hapusBarangMerk($id);
		$query="delete from merk where IdMerk=$id";
		
		if(mysqli_query($con,$query)){
			echo "<script>alert('Berhasil Menghapus Data!!!')</script>";
			header("Location:masterdata-merk.php");
			return true;
		}
		else{
			echo "<script>alert('gagal Menghapus Data kategori!!!')</script>";
			header("Location:masterdata-merk.php");
			return false;
		}
	}
	
	function hapusDivisi($id){
		global $con;
		$query = "DELETE FROM barang WHERE IdDivisi=$id";
		if(mysqli_query($con,$query)){
			return true;
		}
		else{
			return false;
		}
	}
	if (isset($_GET['deleteDivisi'])){
		$id=$_GET['deleteDivisi'];
		global $con;
		hapusDivisi($id);
		$query="delete from divisi where IdDivisi=$id";
		
		if(mysqli_query($con,$query)){
			echo "<script>alert('Berhasil Menghapus Data!!!')</script>";
			header("Location:masterdata-divisi.php");
			return true;
		}
		else{
			echo "<script>alert('gagal Menghapus Data kategori!!!')</script>";
			header("Location:masterdata-divisi.php");
			return false;
		}
	}
	
	function editBarang($id,$IdDivisi,$IdKategori,$IdMerk,$NamaBarang,$JumlahBarang,$TglMasuk){
		global $con;
		$query = "UPDATE barang SET IdDivisi = $IdDivisi,
		IdKategori = $IdKategori, IdMerk = $IdMerk, NamaBarang = '$NamaBarang',
		JumlahBarang = $JumlahBarang, TglMasuk = '$TglMasuk' WHERE IdBarang = $id";

		if( mysqli_query($con,$query) ){
			return true;
		}
		else{
			var_dump($query);
		}
	}

	function UbahPassword($username,$passLama,$passBaru){
		global $con;
		$query = "SELECT * FROM user WHERE Username = '$username'";
		$user = mysqli_fetch_assoc(mysqli_query($con,$query));
		if( $user['password'] == $passLama ){
			$query2 = "UPDATE user SET password = '$passBaru' WHERE Username = '$username'";
			if( mysqli_query($con,$query2) ){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}

?>