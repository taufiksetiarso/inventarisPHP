<?php

	require 'functions.php';
	$hasil = loadDivisiItem();

	foreach ($hasil as $a) {
		
		echo "<option value = '".$a['IdDivisi']."'>".$a['NamaDivisi']."</option>";
	}

	

?>