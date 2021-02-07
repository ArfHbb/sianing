<?php
	include 'koneksi.php';
	session_start();

	extract($_POST);
	$variabel_admin = str_replace('_',' ',$variabel_admin);
	$konstruk_admin = str_replace('_',' ',$konstruk_admin);
	$row = mysqli_query($kon,"update butir_pertanyaan_admin set variabel='$variabel_admin',konstruk='$konstruk_admin',pertanyaan='$pertanyaan_admin' where kode_pertanyaan='$kode_pertanyaan_admin' ");

	if($row==1){
			$_SESSION['msg_per_mhs']="";
			$_SESSION['msg_per_dosen']="";
			$_SESSION['msg_per_admin']="";
		header('location:kelola_pertanyaan.php');
	}

?>