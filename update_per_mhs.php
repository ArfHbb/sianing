<?php
	include 'koneksi.php';
	session_start();

	extract($_POST);
	$variabel_mhs = str_replace('_',' ',$variabel_mhs);
	$konstruk_mhs = str_replace('_',' ',$konstruk_mhs);
	$row = mysqli_query($kon,"update butir_pertanyaan_mhs set variabel='$variabel_mhs',konstruk='$konstruk_mhs',pertanyaan='$pertanyaan_mhs' where kode_pertanyaan='$kode_pertanyaan_mhs' ");

	if($row==1){
			$_SESSION['msg_per_mhs']="";
			$_SESSION['msg_per_dosen']="";
			$_SESSION['msg_per_admin']="";
		header('location:kelola_pertanyaan.php');
	}

?>