<?php
	include 'koneksi.php';
	session_start();
	extract($_POST);
	if(isset($_POST['register'])){
		
		//Cari apakah di tabel jurusan, ada $kode_jurusan atau $jurusan yang sama
		//jika tidak ada, maka simpan. Jika ada, maka tampilkan notifikasi
		
		$queryhitungusername = mysqli_query($kon,"select Count(*) from login where username='$username'");
		$hitungusername=	mysqli_fetch_assoc($queryhitungusername);
		$hitungusername=implode($hitungusername);
		
		
		if($hitungusername==1){
			//$msg="sama";
			
			//$show='show';
			
			$_SESSION['msg_register']='sama';
			header('location:register.php');
			
		}else{
			
			$_SESSION['msg_register']="";

			//$password = password_hash($_POST['password'],PASSWORD_DEFAULT);
		mysqli_query($kon,"insert into login values('0','$username','$nama','$password','$status')");
		
		//if status == peneliti, then hapus status_login peneliti.
		
		if($status=='peneliti'){
			
			mysqli_query($kon,"DELETE FROM `status_login` WHERE nama='peneliti'");
						
		}
		
		
		header('location:login.php');
	}
	
	}
	