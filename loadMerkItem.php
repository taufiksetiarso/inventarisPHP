<?php

	require 'functions.php';
	$hasil = loadMerkItem();

	foreach ($hasil as $a) {
		echo "<option value = '".$a['IdMerk']."'>".$a['NamaMerk']."</option>";
	}

	

?>