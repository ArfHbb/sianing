<?php
	include 'koneksi.php';
	session_start();
	extract($_POST);
	if(isset($_POST['simpan'])){
		$queryperdosen = mysqli_query($kon,"select Count(*) from butir_pertanyaan_dosen where pertanyaan='$per_dosen'");
		$perdosen=	mysqli_fetch_assoc($queryperdosen);
		$perdosen=implode($perdosen);
		
		
		if($perdosen==1){

			$_SESSION['msg_per_mhs']="";
			$_SESSION['msg_per_dosen']="sama";
			$_SESSION['msg_per_admin']="";
			header('location:kelola_pertanyaan.php');
			
		}else{
			
			$_SESSION['msg_per_mhs']="";
			$_SESSION['msg_per_dosen']="";
			$_SESSION['msg_per_admin']="";
		
		$variabel_dosen_tambah = str_replace('_',' ',$variabel_dosen_tambah);
		$konstruk_dosen_tambah = str_replace('_',' ',$konstruk_dosen_tambah);
		mysqli_query($kon,"insert into butir_pertanyaan_dosen values('$kodeper_dosen','$variabel_dosen_tambah','$konstruk_dosen_tambah','$per_dosen','')");
		header('location:kelola_pertanyaan.php');
	}
	}
	