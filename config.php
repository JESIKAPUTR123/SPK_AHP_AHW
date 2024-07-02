<?php
	// connection
	$host = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'dat_spk';

	$kon = mysqli_connect($host,$username,$password);

	if (!$kon)
	{
		echo "Tidak dapat terkon dengan server";
		exit();
	}

	if(!mysqli_select_db($kon, $database))
	{
		echo "Tidak dapat menemukan database";
		exit();
	}
?>