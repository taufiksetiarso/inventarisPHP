<?php

	require 'functions.php';
	$hasil = loadBarang();

	foreach ($hasil as $a) {
		echo "<option value = '".$a['IdBarang']."'>".$a['NamaBarang']."</option>";
	}

?>