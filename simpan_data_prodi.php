<?php
	include 'koneksi.php';
	session_start();
	extract($_POST);
	if(isset($_POST['simpan'])){
		
		
		$queryprodisama = mysqli_query($kon,"select Count(*) from prodi where prodi='$prodi'");
		$prodisama=	mysqli_fetch_assoc($queryprodisama);
		$prodisama=implode($prodisama);
		
		
		if($prodisama==1){
			//$msg="sama";
			
			//$show='show';
			$_SESSION['msg_jurusan']="";
			$_SESSION['msg_prodi']='sama';
			header('location:atur_jurusan.php');
			
		}else{
			$_SESSION['msg_prodi']="";
			$_SESSION['msg_jurusan']="";
			//$msg="";
		
		
		
		
		mysqli_query($kon,"insert into prodi values('$jurusan','$prodi')");
		header('location:atur_jurusan.php');
			}
	}
	