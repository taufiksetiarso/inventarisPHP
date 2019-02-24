<?php

	require 'functions.php';
	$hasil = loadKategoriItem();

	foreach ($hasil as $a) {
		echo "<option value = '".$a['IdKategori']."'>".$a['NamaKategori']."</option>";
	}

?>