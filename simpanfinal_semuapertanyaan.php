<?php
include 'koneksi.php';




//PENGATURAN STATUS FINAL PENENTUAN SAMPEL UJI COBA 

$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='statusfinalsemuapertanyaan'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"INSERT INTO `setting`(`nama`, `ketentuan`) VALUES ('statusfinalsemuapertanyaan','sudah')");

if($buat_baris_total==1){
echo "<br/>baris total sudah diinsert";
}else {
	echo "<br/>status pengaturan sampel ujicoba seharusnya sudah diinsert, tapi gagal";
	
}


}	else{
	
	echo "<br/>status pengaturan sampel ujicoba sudah ada";

	
	$set_update_jml = mysqli_query($kon,"update setting set ketentuan='sudah' where nama='statusfinalsemuapertanyaan' ");

if($set_update_jml==1){
echo "<br/>status pengaturan sampel ujicoba telah diupdate";
}else {
	echo "<br/>status pengaturan sampel ujicoba gagal diupdate";
}
	
	
	//kosong
	
	
}	


//Disini query untuk menambahkan kolom qd dan qm di tabel mhs dan dosen ujicoba dan admin

$jmlbarisadmin = mysqli_query($kon,"select Count(*) from butir_pertanyaan_admin");
$angkaadmin=	mysqli_fetch_assoc($jmlbarisadmin);
$angkaadmin=implode($angkaadmin);
echo $angkaadmin;

$loop=1;
while($loop<=$angkaadmin){
	
	//create kolumn
	
	$no=(string)$loop;
	$kodeqasaatini="qa".''.$no;
	
	$buat_kolom_qa="alter table admin add $kodeqasaatini varchar(20)";
	$eksekyut=mysqli_query($kon,$buat_kolom_qa);
	
	$loop++;
}


$jmlbarismhs = mysqli_query($kon,"select Count(*) from butir_pertanyaan_mhs");
$angkamhs=	mysqli_fetch_assoc($jmlbarismhs);
$angkamhs=implode($angkamhs);
echo $angkamhs;

$loop=1;
while($loop<=$angkamhs){
	
	//create kolumn
	
	$no=(string)$loop;
	$kodeqmsaatini="qm".''.$no;
	
	$buat_kolom_qm="alter table mhs_ujicoba add $kodeqmsaatini varchar(20)";
	$eksekyut=mysqli_query($kon,$buat_kolom_qm);
	
	$loop++;
}



$jmlbarisdosen = mysqli_query($kon,"select Count(*) from butir_pertanyaan_dosen");
$angkadosen=	mysqli_fetch_assoc($jmlbarisdosen);
$angkadosen=implode($angkadosen);
echo $angkadosen;

$loop=1;
while($loop<=$angkadosen){
	
	//create kolumn
	
	$no=(string)$loop;
	$kodeqdsaatini="qd".''.$no;
	
	$buat_kolom_qd="alter table dosen_ujicoba add $kodeqdsaatini varchar(20)";
	$eksekyut=mysqli_query($kon,$buat_kolom_qd);
	
	$loop++;
}


header('location:kelola_pertanyaan-onlyview.php')

?>