<?php
	include 'koneksi.php';
	
	$query_jml_total_populasi_dosen=mysqli_query($kon,"select jml_populasi from jml_sampel_dosen where kode_jur='total'");
	$total_populasi_dosen_asli = mysqli_fetch_object($query_jml_total_populasi_dosen);
	$total_populasi_dosen=$total_populasi_dosen_asli->jml_populasi;
	
	$query_jml_total_sampel_dosen=mysqli_query($kon,"select jml_sampel from jml_sampel_dosen where kode_jur='total'");
	$total_sampel_dosen_asli = mysqli_fetch_object($query_jml_total_sampel_dosen);
	$total_sampel_dosen=$total_sampel_dosen_asli->jml_sampel;
	
	extract($_POST);
	$row = mysqli_query($kon,"update jml_sampel_dosen set jml_populasi='$populasi_dosen' where kode_jur='$kode_jurusan' ");

	$x = $_POST["populasi_dosen"];

	$tahapsatu=$x/$total_populasi_dosen;
	$result=$tahapsatu*$total_sampel_dosen;
	//$final=ceil($result);
	$final=ceil($result);

	$row2 = mysqli_query($kon,"update jml_sampel_dosen set jml_sampel='$final' where kode_jur='$kode_jurusan' ");

	if($row==1){
		header('location:index-researcher.php');
	}

?>