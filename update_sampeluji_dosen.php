<?php
	include 'koneksi.php';
	
	
	extract($_POST);
	//$row = mysqli_query($kon,"update setting set ketentuan='$sampeluji_dosen' where nama='jml_sampeluji_dosen' ");

	
	//if($row==1){
		//header('location:tentukan_sampel_ujicoba.php');
	//}

?>





<?php
	//include 'koneksi.php';
	
	
	extract($_POST);
	$row = mysqli_query($kon,"update setting set ketentuan='$sampeluji_dosen' where nama='jml_sampeluji_dosen' ");

	
	//if($row==1){
		//header('location:tentukan_sampel_ujicoba.php');
		
								
	//}

	
	
	
	
	
	$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='jml_sampeluji_dosen'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"INSERT INTO `setting`(`nama`, `ketentuan`) VALUES ('jml_sampeluji_dosen','$sampeluji_dosen')");

if($buat_baris_total==1){
echo "<br/>baris total sudah diinsert";
}else {
	echo "<br/>status pengaturan sampel ujicoba seharusnya sudah diinsert, tapi gagal";
	
}


}	else{
	
	echo "<br/>status pengaturan sampel ujicoba sudah ada";

	
	$set_update_jml = mysqli_query($kon,"update setting set ketentuan='$sampeluji_dosen' where nama='jml_sampeluji_dosen' ");

if($set_update_jml==1){
echo "<br/>status pengaturan sampel ujicoba telah diupdate";
}else {
	echo "<br/>status pengaturan sampel ujicoba gagal diupdate";
}
	
	
	//kosong
	
	
}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='statussetsampelujidosen'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"INSERT INTO `setting`(`nama`, `ketentuan`) VALUES ('statussetsampelujidosen','sudah')");

if($buat_baris_total==1){
echo "<br/>baris total sudah diinsert";
}else {
	echo "<br/>status pengaturan sampel ujicoba seharusnya sudah diinsert, tapi gagal";
	
}


}	else{
	
	echo "<br/>status pengaturan sampel ujicoba sudah ada";

	
	$set_update_jml = mysqli_query($kon,"update setting set ketentuan='sudah' where nama='statussetsampelujidosen' ");

if($set_update_jml==1){
echo "<br/>status pengaturan sampel ujicoba telah diupdate";
}else {
	echo "<br/>status pengaturan sampel ujicoba gagal diupdate";
}
	
	
	//kosong
	
	
}	

header('location:tentukan_sampel_ujicoba.php');
	
	
	
?>