<?php
	include 'koneksi.php';
	session_start();
	extract($_POST);
	if(isset($_POST['simpan'])){
		$querypermhs = mysqli_query($kon,"select Count(*) from butir_pertanyaan_mhs where pertanyaan='$per_mhs'");
		$permhs=	mysqli_fetch_assoc($querypermhs);
		$permhs=implode($permhs);
		
		
		if($permhs==1){

			$_SESSION['msg_per_mhs']="sama";
			$_SESSION['msg_per_dosen']="";
			$_SESSION['msg_per_admin']="";
			header('location:kelola_pertanyaan.php');
		
				}else{
			
			$_SESSION['msg_per_mhs']="";
			$_SESSION['msg_per_dosen']="";
			$_SESSION['msg_per_admin']="";
		
		$variabel_mhs_tambah = str_replace('_',' ',$variabel_mhs_tambah);
		$konstruk_mhs_tambah = str_replace('_',' ',$konstruk_mhs_tambah);
		mysqli_query($kon,"insert into butir_pertanyaan_mhs values('$kodeper_mhs','$variabel_mhs_tambah','$konstruk_mhs_tambah','$per_mhs','')");
		header('location:kelola_pertanyaan.php');
		}
		}
	