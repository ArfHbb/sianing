<?php
	include 'koneksi.php';
	session_start();
	extract($_POST);
	if(isset($_POST['simpan'])){
		
		$queryperadmin = mysqli_query($kon,"select Count(*) from butir_pertanyaan_admin where pertanyaan='$per_admin'");
		$peradmin=	mysqli_fetch_assoc($queryperadmin);
		$peradmin=implode($peradmin);
		
			if($peradmin==1){

			$_SESSION['msg_per_mhs']="";
			$_SESSION['msg_per_dosen']="";
			$_SESSION['msg_per_admin']="sama";
			header('location:kelola_pertanyaan.php');
			
		}else{
			
			$_SESSION['msg_per_mhs']="";
			$_SESSION['msg_per_dosen']="";
			$_SESSION['msg_per_admin']="";


		$variabel_admin_tambah = str_replace('_',' ',$variabel_admin_tambah);
		$konstruk_admin_tambah = str_replace('_',' ',$konstruk_admin_tambah);
		mysqli_query($kon,"insert into butir_pertanyaan_admin values('$kodeper_admin','$variabel_admin_tambah','$konstruk_admin_tambah','$per_admin')");
		header('location:kelola_pertanyaan.php');
	}
	}
	