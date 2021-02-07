<?php
	include 'koneksi.php';
	session_start();
	extract($_POST);
	if(isset($_POST['simpan'])){
		
		//Cari apakah di tabel jurusan, ada $kode_jurusan atau $jurusan yang sama
		//jika tidak ada, maka simpan. Jika ada, maka tampilkan notifikasi
		
		$queryjurusansama = mysqli_query($kon,"select Count(*) from jurusan where kode_jurusan='$kode_jurusan' or jurusan='$jurusan'");
		$jurusansama=	mysqli_fetch_assoc($queryjurusansama);
		$jurusansama=implode($jurusansama);
		
		
		if($jurusansama==1){
			//$msg="sama";
			
			//$show='show';
			$_SESSION['msg_prodi']="";
			$_SESSION['msg_jurusan']='sama';
			header('location:atur_jurusan.php');
			
		}else{
			
			$_SESSION['msg_jurusan']="";
			$_SESSION['msg_prodi']="";
			//$msg="";
		
		mysqli_query($kon,"insert into jurusan values('$kode_jurusan','$jurusan')");
		
		//isi tablel jml_sampel_dosen, jml_sampel_mhs dan jml_sampel_admin dengan data jurusan itu
		mysqli_query($kon,"insert into jml_sampel_mhs values('$kode_jurusan','$jurusan','','')");
		mysqli_query($kon,"insert into jml_sampel_dosen values('$kode_jurusan','$jurusan','','')");
		mysqli_query($kon,"insert into jml_sampel_admin values('$kode_jurusan','$jurusan','','')");
		header('location:atur_jurusan.php');
	}
	
	}
	