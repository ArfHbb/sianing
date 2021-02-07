<?php
	include 'koneksi.php';
	session_start();

	extract($_POST);
	$variabel_dosen = str_replace('_',' ',$variabel_dosen);
	$konstruk_dosen = str_replace('_',' ',$konstruk_dosen);
	$row = mysqli_query($kon,"update butir_pertanyaan_dosen set variabel='$variabel_dosen',konstruk='$konstruk_dosen',pertanyaan='$pertanyaan_dosen' where kode_pertanyaan='$kode_pertanyaan_dosen' ");

	if($row==1){
			$_SESSION['msg_per_mhs']="";
			$_SESSION['msg_per_dosen']="";
			$_SESSION['msg_per_admin']="";
		header('location:kelola_pertanyaan.php');
	}

?>