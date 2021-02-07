<?php
	include 'koneksi.php';
	
	$query_jml_total_populasi_mhs=mysqli_query($kon,"select jml_populasi from jml_sampel_mhs where kode_jur='total'");
	$total_populasi_mhs_asli = mysqli_fetch_object($query_jml_total_populasi_mhs);
	$total_populasi_mhs=$total_populasi_mhs_asli->jml_populasi;
	
	$query_jml_total_sampel_mhs=mysqli_query($kon,"select jml_sampel from jml_sampel_mhs where kode_jur='total'");
	$total_sampel_mhs_asli = mysqli_fetch_object($query_jml_total_sampel_mhs);
	$total_sampel_mhs=$total_sampel_mhs_asli->jml_sampel;
	
	extract($_POST);
	$row = mysqli_query($kon,"update jml_sampel_mhs set jml_populasi='$populasi_mhs' where kode_jur='$kode_jurusan' ");

	$x = $_POST["populasi_mhs"];

	$tahapsatu=$x/$total_populasi_mhs;
	$result=$tahapsatu*$total_sampel_mhs;
	//$final=ceil($result);
	$final=ceil($result);

	$row2 = mysqli_query($kon,"update jml_sampel_mhs set jml_sampel='$final' where kode_jur='$kode_jurusan' ");

	if($row==1){
		header('location:index-researcher.php');
	}

?>