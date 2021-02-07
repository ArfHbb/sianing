<?php
	include 'koneksi.php';
	
	
	extract($_POST);
	$row = mysqli_query($kon,"update jml_sampel_admin set jml_populasi='$populasi_admin',jml_sampel='$populasi_admin' where kode_jur='$kode_jurusan' ");

	
	if($row==1){
		header('location:index-researcher.php');
	}

?>