<?php
include 'koneksi.php';




//PENGATURAN STATUS FINAL PENENTUAN SAMPEL UJI COBA 

$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='statusfinalsampelujicoba'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"INSERT INTO `setting`(`nama`, `ketentuan`) VALUES ('statusfinalsampelujicoba','sudah')");

if($buat_baris_total==1){
echo "<br/>baris total sudah diinsert";
}else {
	echo "<br/>status pengaturan sampel ujicoba seharusnya sudah diinsert, tapi gagal";
	
}


}	else{
	
	echo "<br/>status pengaturan sampel ujicoba sudah ada";

	
	$set_update_jml = mysqli_query($kon,"update setting set ketentuan='sudah' where nama='statusfinalsampelujicoba' ");

if($set_update_jml==1){
echo "<br/>status pengaturan sampel ujicoba telah diupdate";
}else {
	echo "<br/>status pengaturan sampel ujicoba gagal diupdate";
}
	
	
	//kosong
	
	
}	

header('location:index-researcher-onlyview.php');

?>