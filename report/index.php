<?php ob_start(); ?>
<?php 
	require '../functions.php';
	session_start();
	if( !isset($_SESSION['username']) ){
		header("Location:../login.php");
		exit;
	}

	$hasil = loadBarang();
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <link rel="stylesheet" href="style.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="../images/logo_pesonaedu.png">
      </div>
      <h1>Data Barang Periode </h1>
      
    </header>
    <main>
      <table>
        <thead>
          <tr>
		  <th class="service">No</th>
					      <th class="service">Nama Barang</th>
					      <th class="service">Merk Barang</th>
					      <th class="service">Jumlah Barang</th>
					      <th class="service">Kategori Barang</th>
					      <th class="service">Divisi</th>
					      <th class="service">Tanggal Masuk</th>
           
          </tr>
        </thead>
        <tbody>
          <?php for($i = 0; $i < count($hasil); $i++) : ?>
					    	<tr>
						      <td  class="service"><?php echo $i+1; ?></td>
						      <td class="service"><?php echo $hasil[$i]['NamaBarang']; ?></td>
						      <td class="service"><?php echo $hasil[$i]['NamaMerk']; ?></td>
						      <td class="service"><?php echo $hasil[$i]['JumlahBarang'];  ?></td>
						      <td class="service"><?php echo $hasil[$i]['NamaKategori']; ?></td>
						      <td class="service"><?php echo $hasil[$i]['NamaDivisi']; ?></td>
						      <td class="service"><?php echo $hasil[$i]['TglMasuk']; ?></td>
						      	</tr>
					    <?php endfor; ?>
        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();
        
require_once('../html2pdf/html2pdf.class.php');
$pdf = new HTML2PDF('P','A4','en');
$pdf->WriteHTML($html);
$pdf->Output('Data Siswaa.pdf');
?>