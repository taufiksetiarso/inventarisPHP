<?php ob_start(); ?>
<?php 
	require 'functions.php';
	session_start();

	if( !isset($_SESSION['username']) ){
		header("Location:login.php");
		exit;
	}
	if (isset($_GET['dari'])){
		$message=date('d-m-Y', strtotime($_GET['dari'])).'      sampai     '.date('d-m-Y', strtotime($_GET['sampai']));
		$hasil = loadTanggalMutasi($_GET['dari'],$_GET['sampai']);
	}
	if (!isset($_GET['dari'])){
		$message="Semua Data Barang";
		$hasil = loadDataMutasiBarang();}
?>
<html>
<head>
  <title>Cetak PDF</title>
    
   <style>
   table {border-collapse:collapse; table-layout:fixed;width: 300px;}
   table td {word-wrap:break-word;width: 10%;}
  table th, td {
  padding: 10px;
}
   </style>
</head>
<body>
  
<h1 style="text-align: center;"><img src="images/logo_pesonaedu.png" style="width:100px"> </h1>
<hr>
 <h1 style="text-align: center;">Data Mutasi Barang </h1>
 <p>Periode : <?php echo $message?></p>
 

					 
					
					<table border="1" width="40%">
					  <thead class="thead-light">
					    <tr>
					      <th scope="col" style=" padding: 5px;">No</th>
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
							   <td ><?php echo $i+1; ?></td>
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
				
<br>
<br>
<br>
<br>
<br>
<p style="text-align:right;padding:70px"><?php echo 'Jakarta,';echo hari_indo(date('l'));echo " ";echo tgl_indo(date('Y-m-d'));?></p>

<p style="text-align:right;padding-right:125px;margin:0px;">Galuh Ayu</p>
<p style="text-align:right;padding-right:104px;margin:0px;">(Staff Administrasi)</p>

	
	<?php
function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function hari_indo($hari){
		
		if($hari='Monday')return 'Senin';
		if($hari='Tuesday')return 'Selasa';
		if($hari='Wednesday')return 'Rabu';
		if($hari='Thursday')return 'Kamis';
		if($hari='Friday')return 'Jumat';
		if($hari='Saturday')return 'Sabtu';
		if($hari='Sunday')return 'Minggu';
		}		

 
?>
</body>

</html>
<?php
$html = ob_get_contents();
ob_end_clean();
        
require_once('html2pdf/html2pdf.class.php');
$pdf = new HTML2PDF('L','A4','en');
$pdf->WriteHTML($html);
$pdf->Output('Data Mutasi Barang.pdf','D');
?>