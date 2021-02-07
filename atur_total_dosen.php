<?php
	include 'koneksi.php';
	extract($_POST);
	
	$row = mysqli_query($kon,"update jml_sampel_dosen set jml_populasi='$total_populasi_dosen' where kode_jur='total' ");
	
	$x = $_POST["total_populasi_dosen"];;

	$eror=0.05*0.05;
	$xeror=$x*$eror;
	$satune=1+$xeror;
	$result=$x/$satune;
	$final=ceil($result);

	$row2 = mysqli_query($kon,"update jml_sampel_dosen set jml_sampel='$final' where kode_jur='total' ");
	
	if($row==1){
		header('location:index-researcher.php');
	}

?>