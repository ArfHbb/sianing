<?php

$host="localhost";
$user="root";
$password="";
$db="skripsi";

$kon = mysqli_connect($host,$user,$password);

//if ($kon){
//	echo "Database MYSQL <b>berhasil</b> dikoneksikan<br>";
//}else {
//	echo"Database  MYSQL <b>gagal</b> dikoneksikan<br>";
//}

$hasil=mysqli_select_db($kon,$db);
//if ($hasil){
//	echo "Database $db berhasil dipilih";
//}else {
//	echo "Database $db gagal dipilih";
//}





//UNTUK LOGIN
class database{
	var $host = "localhost";
	var $username = "root";
	var $password = "";
	var $database = "skripsi";
	var $koneksi;

	function __construct(){
		$this->koneksi = mysqli_connect($this->host, $this->username, $this->password,$this->database);
	}


	function register($username,$password,$nama,$status)
	{	
		$insert = mysqli_query($this->koneksi,"insert into login values ('','$username','$password','$nama','$status')");
		$_SESSION['msg_login']="";
		return $insert;
	}

	function login($username,$password,$remember)
	{
		$query = mysqli_query($this->koneksi,"select * from login where username='$username'");
		$data_user = $query->fetch_array();
		if(password_verify($password,$data_user['password']))
		{

			if($remember)
			{
				setcookie('username', $username, time() + (60 * 60 * 24 * 5), '/');
				setcookie('nama', $data_user['nama'], time() + (60 * 60 * 24 * 5), '/');
				//setcookie('status', $data_user['status'], time() + (60 * 60 * 24 * 5), '/');
			}
			$_SESSION['username'] = $username;
			$_SESSION['nama'] = $data_user['nama'];
			//$_SESSION['status'] = $data_user['status'];
			$_SESSION['is_login'] = TRUE;
			$_SESSION['msg_login']="";
			return TRUE;
		}else{
			
			$_SESSION['msg_login']="salah input";
			
		}
	}

	function relogin($username)
	{
		$query = mysqli_query($this->koneksi,"select * from login where username='$username'");
		$data_user = $query->fetch_array();
		$_SESSION['username'] = $username;
		$_SESSION['nama'] = $data_user['nama'];
		$_SESSION['is_login'] = TRUE;
	}
} 




?>