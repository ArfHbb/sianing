<?php
	include 'koneksi.php';
	extract($_POST);
	
	$row = mysqli_query($kon,"update jml_sampel_admin set jml_populasi='$total_populasi_admin',jml_sampel='$total_populasi_admin' where kode_jur='total' ");
	

	if($row==1){
		header('location:index-researcher.php');
	}

?>