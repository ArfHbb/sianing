<?php include 'koneksi.php'; 
set_time_limit(240);

session_start();

$username=$_SESSION['username'];

//echo $username;

$querystatus=mysqli_query($kon,"select * from login where username='$username'");
$belumdipanah = mysqli_fetch_object($querystatus);
$statusku=$belumdipanah->status;
?>
<!doctype html>
<html lang="en">
<head>
   <title>Pengujian Validitas dan Reliabilitas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>
<body>

<!--
Saat ini data ujicoba sudah masuk dan tombol analisis uji coba baru saja diklik <br/>
<br/>
-ambil data jumlah responden dari setting<br/>

<?php
				$query_jml_sampel_uji=mysqli_query($kon,"select * from setting where nama='jml_sampeluji_mhs'");
				$jml_mhs_uji = mysqli_fetch_object($query_jml_sampel_uji);
				$angkasampelmhs=$jml_mhs_uji->ketentuan;
			?>
			
data jml responden mhs dari setting:	<?php //echo $angkasampelmhs ?> <br/>
		
-buat kolom jml <br/>

<?php

$buat_kolom_jml="alter table mhs_ujicoba add jml varchar(20)";
$eksekyut=mysqli_query($kon,$buat_kolom_jml);
if ($b=$eksekyut){
				//echo "Kolom jml telah dibuat";
}else {
	//echo "Kolom jml gagal dibuat";
}
	
		?>

<br/>


-ambil banyaknya pertanyaan dari db <br/>

<?php
				$query_jml_pertanyaan_mhs = mysqli_query($kon,"select Count(*) as totalper_mhs from butir_pertanyaan_mhs");
				$jml_per_mhs= mysqli_fetch_assoc($query_jml_pertanyaan_mhs);
				$jml_pert_mhs=implode($jml_per_mhs);
			?>
			
banyaknya pertanyaan mhs:	<?php //echo $jml_pert_mhs ?> <br/>





-jumlahkan data setiap jwban dan taruh di jml pakai looping nested

<br/>
<?php
$iterasi=1;
$tampungtotalsemuamhs=0;


while ($iterasi<=$angkasampelmhs ) {


$no = 1;
$no_string=(string)$no;

$koderespondensaatini="mhs".''.$iterasi;
//echo "<br/>responden saat ini:";
//echo $koderespondensaatini;
$totalnilai=0;
$tampungtotalnilai=0;


while ($no<=$jml_pert_mhs ) {
$pertanyaansaatini="qm".''.$no_string;
////echo "<br/>pertanyaan saat ini:";
////echo $pertanyaansaatini;

$akumulasi_jml=mysqli_query($kon,"select * from mhs_ujicoba where kode_responden='$koderespondensaatini'");
$nilai_mhs= mysqli_fetch_object($akumulasi_jml);
$tampungnilai=$nilai_mhs->$pertanyaansaatini;
////echo "nilai variabel tampungnilai adalah:";
////echo $tampungnilai;
$tampungtotalnilai=$tampungtotalnilai+$tampungnilai;
////echo "nilai variabel tampungnilaitotal adalah:";
////echo $tampungtotalnilai;


$no++;
$no_string=(string)$no;
}
//echo "<br/>nilai jml responden mhs";
//echo $iterasi;
//echo " : ";
//echo $tampungtotalnilai;


//set updte jumlah
$set_update_jml = mysqli_query($kon,"update mhs_ujicoba set jml='$tampungtotalnilai' where kode_responden='$koderespondensaatini' ");

//$set_update_jml="update table mhs_ujicoba set jml='$tampungtotalnilai' where kode_responden='$koderespondensaatini' ";
//$eksekyut_update_jml=mysqli_query($kon,$set_update_jml);
if($set_update_jml==1){
//echo "<br/>Kolom jml telah diupdate";
}else {
	//echo "<br/>Kolom jml gagal diupdate";
}
//if ($cek_hasilupdate=$eksekyut_update_jml){
//				//echo "<br/>Kolom jml telah diupdate";
//}else {
//	//echo "<br/>Kolom jml gagal diupdate";
//}


//echo "<br/>";
//echo "Iterasi ke-";
//echo $iterasi;


$iterasi=$iterasi+1;
//echo "<br/>";

$tampungtotalsemuamhs=$tampungtotalsemuamhs+$tampungtotalnilai;
}

//echo "total semuaaaanyyya: ";
//echo $tampungtotalsemuamhs;



$jmlbaristotal = mysqli_query($kon,"select Count(*) from mhs_ujicoba where kode_responden='total'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"insert into mhs_ujicoba set kode_responden='total' jml='$tampungtotalsemuamhs'");

if($buat_baris_total==1){
//echo "<br/>baris total sudah diinsert";
}else {
	//echo "<br/>baris total seharusnya sudah diinsert, tapi gagal";
}


}	else{
	
	//echo "<br/>baris total sudah ada";

	
	$set_update_jml = mysqli_query($kon,"update mhs_ujicoba set jml='$tampungtotalsemuamhs' where kode_responden='total' ");

if($set_update_jml==1){
//echo "<br/>baris total sudah ada dan telah diupdate";
}else {
	//echo "<br/>baris total sudah ada dan gagal diupdate";
}
	
	
	//kosong
	
	
}	




?>





<br/>
-buat tabel xy untuk menampung data menggunakan looping
<br/>

<?php

	
$no_tambahtabel=1;	

while ($no_tambahtabel<=$jml_pert_mhs ) {
	
$no_tambahtabel_string=(string)$no_tambahtabel;	
$kode_xy="xyqm".''.$no_tambahtabel_string;
	
$buat_tabel_xy="alter table mhs_ujicoba add $kode_xy varchar(20)";
$eksekyut2=mysqli_query($kon,$buat_tabel_xy);
if ($b2=$eksekyut2){
				//echo "Kolom $kode_xy telah dibuat";
				//echo "<br/>";
				
}else {
	//echo "Kolom $kode_xy gagal dibuat";
	//echo "<br/>";
	
}

	$no_tambahtabel++;
}
		?>

<!--		
		-buat kolom jmlxy<br/>
		-->
		
		<?php

//$buat_kolom_jmlxy="alter table mhs_ujicoba add jmlxy int(7)";
//$eksekyut3=mysqli_query($kon,$buat_kolom_jmlxy);
//if ($b=$eksekyut3){
//				//echo "Kolom jmlxy telah dibuat";
//}else {
//	//echo "Kolom jmlxy gagal dibuat";
//}
	
		?>
		
		<!--
		<br/>-buat kolom x2qm<br/>
		
		
		<?php

	
$no_tambahtabel=1;	

while ($no_tambahtabel<=$jml_pert_mhs ) {
	
$no_tambahtabel_string=(string)$no_tambahtabel;	
$kode_x2="x2qm".''.$no_tambahtabel_string;
	
$buat_tabel_x2="alter table mhs_ujicoba add $kode_x2 varchar(20)";
$eksekyut4=mysqli_query($kon,$buat_tabel_x2);
if ($b2=$eksekyut4){
				//echo "Kolom $kode_x2 telah dibuat";
				//echo "<br/>";
				
}else {
	//echo "Kolom $kode_x2 gagal dibuat";
	//echo "<br/>";
	
}

	$no_tambahtabel++;
}
		?>
		
		<!--
		<br/>-buat kolom jmlx2<br/>
		
		<?php

$buat_kolom_jmlx2="alter table mhs_ujicoba add jmlx2 varchar(20)";
$eksekyut5=mysqli_query($kon,$buat_kolom_jmlx2);
if ($b=$eksekyut5){
				//echo "Kolom jmlx2 telah dibuat";
}else {
	//echo "Kolom jmlx2 gagal dibuat";
}
	
		?>
		
		<!--
		<br/>-insert data masing-masing tabel xy<br/>
		
		
		<?php
		
$iterasi=1;
$bariske = 1;
$bariske_string=(string)$bariske;

//looping 25 kali
while ($iterasi<= $jml_pert_mhs ) {


$no = 1;
$no_string=(string)$no;


$koderespondensaatini="mhs".''.$iterasi;
$kodepertanyaansaatini="xyqm".''.$iterasi;
//echo "<br/>pertanyaan ke ";
//echo $iterasi;
//echo "<br/>";

//$totalnilai=0;
//$tampungtotalnilai=0;

$status=1;
//looping 40 kali
while ($no<=$angkasampelmhs) {



$pertanyaansaatini="qm".''.$bariske;

$targetisi="xyqm".''.$bariske_string;


	$koderespondensaatini="mhs".''.$status;
$ambildata=mysqli_query($kon,"select * from mhs_ujicoba where kode_responden='$koderespondensaatini'");
$nilai_mhs= mysqli_fetch_object($ambildata);
$nilaikuesioner=$nilai_mhs->$pertanyaansaatini;
$jml_nilaikuesioner=$nilai_mhs->jml;


$masukkannilai=$nilaikuesioner*$jml_nilaikuesioner;

//echo " mhs";
//echo $no;
//echo " : ";
//echo $masukkannilai;

$targetkolom="xyqm".''.$bariske;
$targetbaris="mhs".''.$no;
$darikolomx2="qm".''.$bariske;
$targetkolomx2="x2qm".''.$bariske;

//Query update taruh disini yes, insert into kolom values where

$set_inputtabelxy = mysqli_query($kon,"update mhs_ujicoba set $targetkolom='$masukkannilai' where kode_responden='$targetbaris' ");

if($set_inputtabelxy==1){
//echo "<br/>data terinput";
}else {
	//echo "<br/>data tidak terinput";
}

//Query update tabel x2 taruh dibawah sini yaa..


$ambildatax2=mysqli_query($kon,"select * from mhs_ujicoba where kode_responden='$targetbaris'");
$datax2= mysqli_fetch_object($ambildatax2);
$nilaix2=$datax2->$darikolomx2;

$masukkannilaix2=$nilaix2*$nilaix2;

$set_inputtabelx2 = mysqli_query($kon,"update mhs_ujicoba set $targetkolomx2='$masukkannilaix2' where kode_responden='$targetbaris' ");

if($set_inputtabelx2==1){
//echo "<br/>data x2 terinput";
}else {
	//echo "<br/>data x2 tidak terinput";
}


$status++;

$no++;
$no_string=(string)$no;
}


//echo "<br/>";
//echo "Iterasi ke-";
//echo $iterasi;


$iterasi=$iterasi+1;
//echo "<br/>";

$bariske++;
//$tampungtotalsemuamhs=$tampungtotalsemuamhs+$tampungtotalnilai;
}

?>
		<!--
<br/>-Hitung kolom jumlah X2 dan input ke db, now!
		
		
		
<br/>
<?php
$iterasi=1;
$tampungtotalsemuamhs=0;


while ($iterasi<=$angkasampelmhs ) {


$no = 1;
$no_string=(string)$no;

$koderespondensaatini="mhs".''.$iterasi;
//echo "<br/>responden saat ini:";
//echo $koderespondensaatini;
$totalnilai=0;
$tampungtotalnilai=0;


while ($no<=$jml_pert_mhs ) {



$akumulasi_jml=mysqli_query($kon,"select * from mhs_ujicoba where kode_responden='$koderespondensaatini'");
$nilai_mhs= mysqli_fetch_object($akumulasi_jml);
$tampungnilai=$nilai_mhs->jml;

$tampungtotalnilai=$tampungnilai*$tampungnilai;


$no++;
$no_string=(string)$no;
}
//echo "<br/>nilai x2 jml responden mhs";
//echo $iterasi;
//echo " : ";
//echo $tampungtotalnilai;


$set_update_jml = mysqli_query($kon,"update mhs_ujicoba set jmlx2='$tampungtotalnilai' where kode_responden='$koderespondensaatini' ");

if($set_update_jml==1){
//echo "<br/>Kolom jmlx2 telah diupdate";
}else {
	//echo "<br/>Kolom jmlx2 gagal diupdate";
}


//echo "<br/>";
//echo "Iterasi ke-";
//echo $iterasi;


$iterasi=$iterasi+1;
//echo "<br/>";

$tampungtotalsemuamhs=$tampungtotalsemuamhs+$tampungtotalnilai;
}

?>
<!--
	<br/>-tambahkan baris total data
	<br/> jumlah baris saat ini:	
		<?php
		

$jmlbaristotal = mysqli_query($kon,"select Count(*) from mhs_ujicoba where kode_responden='total'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"insert into mhs_ujicoba set kode_responden='total'");

if($buat_baris_total==1){
//echo "<br/>baris total sudah diinsert";
}else {
	//echo "<br/>baris total seharusnya sudah diinsert, tapi gagal";
}


}	else{
	
	//echo "<br/>baris total sudah ada";

	//kosong
	
	
}	
		?>
		
		<!--
		
		<br/>-Menambahkan jumlah ke tabel asli
		
		<?php //Ngeditnya disini woooyyy
$iterasi=1;
$tampungtotalsemuamhs=0;

//looping 25x
while ($iterasi<=$jml_pert_mhs ) {

$no = 1;
$no_string=(string)$no;
$iterasi_string=(string)$iterasi;

$koderespondensaatini="qm".''.$iterasi_string;
//echo "<br/>responden saat ini:";
//echo $koderespondensaatini;
$totalnilai=0;
$tampungtotalnilai=0;

//looping 40x
while ($no<=$angkasampelmhs ) {
$pertanyaansaatini="mhs".''.$no_string;

//echo $pertanyaansaatini;
$akumulasi_jml=mysqli_query($kon,"select * from mhs_ujicoba where kode_responden='$pertanyaansaatini'");
$nilai_mhs= mysqli_fetch_object($akumulasi_jml);
$tampungnilaiy=$nilai_mhs->$koderespondensaatini;

////echo $tampungnilaiy;
$tampungtotalnilai=$tampungtotalnilai+$tampungnilaiy;


//set updte jumlah
$set_update_jml = mysqli_query($kon,"update mhs_ujicoba set $koderespondensaatini='$tampungtotalnilai' where kode_responden='total' ");

if($set_update_jml==1){
//echo "<br/>Kolom jml telah diupdate";
}else {
	//echo "<br/>Kolom jml gagal diupdate";
}

$no++;
$no_string=(string)$no;
}
//echo "<br/>nilai jml pertanyaan ";
//echo $iterasi;
//echo " : ";
//echo $tampungtotalnilai;





//echo "<br/>";
//echo "Iterasi ke-";
//echo $iterasi;


$iterasi=$iterasi+1;
//echo "<br/>";

$tampungtotalsemuamhs=$tampungtotalsemuamhs+$tampungtotalnilai;
}

//echo "total semuaaaanyyya: ";
//echo $tampungtotalsemuamhs;

$settotaljml = mysqli_query($kon,"update mhs_ujicoba set jml='$tampungtotalsemuamhs' where kode_responden='total' ");

if($settotaljml==1){
//echo "<br/>satu nilai total jml diupdate";
}else {
	//echo "<br/>satu nilai total jml gagal diupdate";
}
?>

		
		
		<!--
		
			<br/>-Menambahkan jumlah ke tabel xy
		
		<?php //Ngeditnya disini woooyyy
$iterasi=1;
$tampungtotalsemuamhs=0;

//looping 25x
while ($iterasi<=$jml_pert_mhs ) {

$no = 1;
$no_string=(string)$no;
$iterasi_string=(string)$iterasi;

$koderespondensaatini="xyqm".''.$iterasi_string;
//echo "<br/>responden saat ini:";
//echo $koderespondensaatini;
$totalnilai=0;
$tampungtotalnilai=0;

//looping 40x
while ($no<=$angkasampelmhs ) {
$pertanyaansaatini="mhs".''.$no_string;

//echo $pertanyaansaatini;
$akumulasi_jml=mysqli_query($kon,"select * from mhs_ujicoba where kode_responden='$pertanyaansaatini'");
$nilai_mhs= mysqli_fetch_object($akumulasi_jml);
$tampungnilaiy=$nilai_mhs->$koderespondensaatini;

////echo $tampungnilaiy;
$tampungtotalnilai=$tampungtotalnilai+$tampungnilaiy;


//set updte jumlah
$set_update_jml = mysqli_query($kon,"update mhs_ujicoba set $koderespondensaatini='$tampungtotalnilai' where kode_responden='total' ");

if($set_update_jml==1){
//echo "<br/>Kolom jml xyqm telah diupdate";
}else {
	//echo "<br/>Kolom jml xyqm gagal diupdate";
}

$no++;
$no_string=(string)$no;
}
//echo "<br/>nilai jml pertanyaan ";
//echo $iterasi;
//echo " : ";
//echo $tampungtotalnilai;





//echo "<br/>";
//echo "Iterasi ke-";
//echo $iterasi;


$iterasi=$iterasi+1;
//echo "<br/>";

$tampungtotalsemuamhs=$tampungtotalsemuamhs+$tampungtotalnilai;
}

//echo "total semuaaaanyyya: ";
//echo $tampungtotalsemuamhs;

$apdetjmlx2 = mysqli_query($kon,"update mhs_ujicoba set jmlx2='$tampungtotalsemuamhs' where kode_responden='total' ");

if($apdetjmlx2==1){
//echo "<br/>Jml x2 dipojok sudah dipudate";
}else {
	//echo "<br/>Jml x2 dipojok gagal dipudate";
}

?>

	

<!--
<br/>-Menambahkan jumlah ke tabel x2
		
		<?php //Ngeditnya disini woooyyy
$iterasi=1;
$tampungtotalsemuamhs=0;

//looping 25x
while ($iterasi<=$jml_pert_mhs ) {

$no = 1;
$no_string=(string)$no;
$iterasi_string=(string)$iterasi;

$koderespondensaatini="x2qm".''.$iterasi_string;
//echo "<br/>responden saat ini:";
//echo $koderespondensaatini;
$totalnilai=0;
$tampungtotalnilai=0;

//looping 40x
while ($no<=$angkasampelmhs ) {
$pertanyaansaatini="mhs".''.$no_string;

//echo $pertanyaansaatini;
$akumulasi_jml=mysqli_query($kon,"select * from mhs_ujicoba where kode_responden='$pertanyaansaatini'");
$nilai_mhs= mysqli_fetch_object($akumulasi_jml);
$tampungnilaiy=$nilai_mhs->$koderespondensaatini;

////echo $tampungnilaiy;
$tampungtotalnilai=$tampungtotalnilai+$tampungnilaiy;


//set updte jumlah
$set_update_jml = mysqli_query($kon,"update mhs_ujicoba set $koderespondensaatini='$tampungtotalnilai' where kode_responden='total' ");

if($set_update_jml==1){
//echo "<br/>Kolom jml x2qm telah diupdate";
}else {
	//echo "<br/>Kolom jml x2qm gagal diupdate";
}

$no++;
$no_string=(string)$no;
}
//echo "<br/>nilai jml pertanyaan ";
//echo $iterasi;
//echo " : ";
//echo $tampungtotalnilai;





//echo "<br/>";
//echo "Iterasi ke-";
//echo $iterasi;


$iterasi=$iterasi+1;
//echo "<br/>";

$tampungtotalsemuamhs=$tampungtotalsemuamhs+$tampungtotalnilai;
}

//echo "total semuaaaanyyya: ";
//echo $tampungtotalsemuamhs;
?>	
		<!--
		<br/>-Membuat baris x2kuadrat, menghitung dan mengisinya
		
		

	<br/> jumlah baris x2kuadrat saat ini:	
		<?php
		

$jmlbaristotal = mysqli_query($kon,"select Count(*) from mhs_ujicoba where kode_responden='x2kuadrat'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"insert into mhs_ujicoba set kode_responden='x2kuadrat'");

if($buat_baris_total==1){
//echo "<br/>baris total sudah diinsert";
}else {
	//echo "<br/>baris total seharusnya sudah diinsert, tapi gagal";
}


}	else{
	
	//echo "<br/>baris total sudah ada";

	//kosong
	
	
}	//ini gausah dihapus,lanjut dibawahnya
		?>
		
		
		
			<?php //Ngeditnya disini woooyyy
$iterasi=1;
$tampungtotalsemuamhs=0;

//looping 25x
while ($iterasi<=$jml_pert_mhs ) {

$no = 1;
$no_string=(string)$no;
$iterasi_string=(string)$iterasi;

$koderespondensaatini="qm".''.$iterasi_string;
//echo "<br/>responden saat ini:";
//echo $koderespondensaatini;
$totalnilai=0;
$tampungtotalnilai=0;


$pertanyaansaatini="mhs".''.$no_string;
$variabeluntukdikali="qm".''.$no_string;

//echo $pertanyaansaatini;
$akumulasi_jml=mysqli_query($kon,"select * from mhs_ujicoba where kode_responden='$pertanyaansaatini'");
$nilai_mhs= mysqli_fetch_object($akumulasi_jml);
$tampungnilaiy=$nilai_mhs->$koderespondensaatini;

//untuk mengambil nilai yang akan dikalikan
$yangakandikali=mysqli_query($kon,"select $koderespondensaatini from mhs_ujicoba where kode_responden='total'");
$var_yangakandikali= mysqli_fetch_object($yangakandikali);
$dikali=$var_yangakandikali->$koderespondensaatini;
//echo 'yang akan dikali: ';
//echo $dikali;

////echo $tampungnilaiy;
$tampungtotalnilai=$dikali*$dikali;


//set updte jumlah
$set_update_jml = mysqli_query($kon,"update mhs_ujicoba set $koderespondensaatini='$tampungtotalnilai' where kode_responden='x2kuadrat' ");


if($set_update_jml==1){
//echo "<br/>Kolom jml x2kuadrat telah diupdate";
}else {
	//echo "<br/>Kolom jml x2kuadrat gagal diupdate";
}

$no++;
$no_string=(string)$no;

//echo "<br/>nilai jml pertanyaan ";
//echo $iterasi;
//echo " : ";
//echo $tampungtotalnilai;





//echo "<br/>";
//echo "Iterasi ke-";
//echo $iterasi;


$iterasi=$iterasi+1;
//echo "<br/>";

$tampungtotalsemuamhs=$tampungtotalsemuamhs+$tampungtotalnilai;
}

//echo "total semuaaaanyyya: ";
//echo $tampungtotalsemuamhs;




//set updte jumlah
$set_update_jml2 = mysqli_query($kon,"update mhs_ujicoba set jml='$tampungtotalsemuamhs' where kode_responden='x2kuadrat' ");

if($set_update_jml2==1){
//echo "<br/>jmlkuadrat diinput";
}else {
	//echo "<br/>jmlkuadrat gagal diinput";
}

$tampungtotalnilai=0;
?>	
			
			
			
		
<!--
		<br/>-Membuat baris nykuadrat_mhs di setting, menghitung dan mengisinya
		
		
		<br/> jumlah baris nykuadrat_mhs saat ini:	
		<?php
		

		
	$query_jmlx2=mysqli_query($kon,"select * from mhs_ujicoba where kode_responden='total'");
				$hasil_queryjmlx2 = mysqli_fetch_object($query_jmlx2);
				$angkajmlx2=$hasil_queryjmlx2->jmlx2;
				
				$hasilperkalianjmlx2=$angkajmlx2*$angkasampelmhs;



		
		
		
$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='nykuadrat_mhs'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

//$buat_baris_total = mysqli_query($kon,"insert into setting set nama='nykuadrat_mhs' ketentuan='$hasilperkalianjmlx2'");
$buat_baris_total=mysqli_query($kon,"INSERT INTO `setting`(`nama`, `ketentuan`) VALUES ('nykuadrat_mhs','$hasilperkalianjmlx2')");
//tambah query insert ke setting


if($buat_baris_total==1){
//echo "<br/>baris nykuadrat_mhs sudah diinsert";
}else {
	//echo "<br/>baris nykuadrat_mhs seharusnya sudah diinsert, tapi gagal";
}


}	else{


	
	//echo "<br/>baris nykuadrat_mhs sudah ada";

$set_update_jml2 = mysqli_query($kon,"update setting set ketentuan='$hasilperkalianjmlx2' where nama='nykuadrat_mhs' ");

if($set_update_jml2==1){
//echo "<br/>jmlkuadrat diinput";
}else {
	//echo "<br/>jmlkuadrat gagal diinput";
}
	
}	
		?>
		

		<!--
		<br/>-Membuat baris ykuadrat_mhs di setting, menghitung dan mengisinya
		
		<br/> jumlah baris ykuadrat_mhs saat ini:	
		<?php
		

		
	$query_jmlx2=mysqli_query($kon,"select * from mhs_ujicoba where kode_responden='total'");
				$hasil_queryjmlx2 = mysqli_fetch_object($query_jmlx2);
				$angkajmlx2=$hasil_queryjmlx2->jml;
				
				//echo 'nilai awal: ';
				//echo $angkajmlx2;
				//echo '<br/>';
				$hasilperkalianykuadrat=$angkajmlx2*$angkajmlx2;
				//echo $hasilperkalianykuadrat;



		
		
		
$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='ykuadrat_mhs'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"INSERT INTO `setting`(`nama`, `ketentuan`) VALUES ('ykuadrat_mhs','$hasilperkalianykuadrat');");

//tambah query insert ke setting


if($buat_baris_total==1){
//echo "<br/>baris nykuadrat_mhs sudah diinsert";
}else {
	//echo "<br/>baris nykuadrat_mhs seharusnya sudah diinsert, tapi gagal";
}


}	else{


	
	//echo "<br/>baris nykuadrat_mhs sudah ada";

$set_update_jml2 = mysqli_query($kon,"update setting set ketentuan='$hasilperkalianykuadrat' where nama='ykuadrat_mhs' ");

if($set_update_jml2==1){
//echo "<br/>ykuadrat diinput";
}else {
	//echo "<br/>ykuadrat gagal diinput";
}
	
}	
		?>
		<!--
		<br/>-Membuat baris nxminxy, menghitung dan mengisinya
		
		
		
		<br/> jumlah baris nxyminxy saat ini:	
		<?php
		

$jmlbaristotal = mysqli_query($kon,"select Count(*) from mhs_ujicoba where kode_responden='nxyminxy'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"insert into mhs_ujicoba set kode_responden='nxyminxy'");

if($buat_baris_total==1){
//echo "<br/>baris total sudah diinsert";
}else {
	//echo "<br/>baris total seharusnya sudah diinsert, tapi gagal";
}


}	else{
	
	//echo "<br/>baris total sudah ada";

	//disini kasih query update yang ber looping, karena diatas gak bisa ditaruh looping. Kayaknya gak perlu deh,
	
	
}	
		?>
		
		
		
			<?php 
			
			//ambil nilai variabel $jmlttl;
			$query_jmlttl=mysqli_query($kon,"select jml from mhs_ujicoba where kode_responden='total'");
			$var_jmlttl= mysqli_fetch_object($query_jmlttl);
			$jmlttl=$var_jmlttl->jml;
			
			//echo "hmm.. nilai aa43 adalah : ";
			//echo $jmlttl;
			
			
			
$loop=1;

//looping 25x
while ($loop<=$jml_pert_mhs ) {

$loop_string=(string)$loop;

$kolomxysekarang="xyqm".''.$loop_string;
$kolomqmsekarang="qm".''.$loop_string;


//mengambil nilai total xy;
$ambilnilaixy=mysqli_query($kon,"select * from mhs_ujicoba where kode_responden='total'");
$nilaixy= mysqli_fetch_object($ambilnilaixy);
$tampungnilaixy=$nilaixy->$kolomxysekarang;


//lakukan perhitungan 1
$tampungnilaixy=$tampungnilaixy*$angkasampelmhs;


//mengambil nilai toal qm;
$ambilnilaiqm=mysqli_query($kon,"select * from mhs_ujicoba where kode_responden='total'");
$nilaiqm= mysqli_fetch_object($ambilnilaiqm);
$tampungnilaiqm=$nilaiqm->$kolomqmsekarang;


//lakukan perhitungan 1
$tampungnilaiqm=$tampungnilaiqm*$jmlttl;


//lakukan perhitungan 3
$hasilnyoo=$tampungnilaixy-$tampungnilaiqm;

//set updte jumlah
$set_update_jml = mysqli_query($kon,"update mhs_ujicoba set $kolomqmsekarang='$hasilnyoo' where kode_responden='nxyminxy' ");


if($set_update_jml==1){
//echo "<br/>Baris nxyminxy telah diupdate";
}else {
	//echo "<br/>Baris nxyminxy gagal diupdate";
}

$loop++;

}

?>	
		
		<!--
		<br/>-Membuat baris nxminxkuadrat, menghitung dan mengisinya
		
		
		
		<br/> jumlah baris nxminxkuadrat saat ini:	
		<?php
		

$jmlbaristotal = mysqli_query($kon,"select Count(*) from mhs_ujicoba where kode_responden='nxminxkuadrat'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"insert into mhs_ujicoba set kode_responden='nxminxkuadrat'");

if($buat_baris_total==1){
//echo "<br/>baris total sudah diinsert";
}else {
	//echo "<br/>baris total seharusnya sudah diinsert, tapi gagal";
}


}	else{
	
	//echo "<br/>baris total sudah ada";

	//disini kasih query update yang ber looping, karena diatas gak bisa ditaruh looping. Kayaknya gak perlu deh,
	
	
}	
		?>
		
		
		
			<?php 
			
			
			
			
$loop=1;

//looping 25x
while ($loop<=$jml_pert_mhs ) {

$loop_string=(string)$loop;

$kolomx2sekarang="x2qm".''.$loop_string;
$kolomqmsekarang="qm".''.$loop_string;


//mengambil nilai total x2;
$ambilnilaixy=mysqli_query($kon,"select * from mhs_ujicoba where kode_responden='total'");
$nilaixy= mysqli_fetch_object($ambilnilaixy);
$tampungnilaix2=$nilaixy->$kolomx2sekarang;


//lakukan perhitungan 1
$tampungnilaix2=$tampungnilaix2*$angkasampelmhs;


//mengambil nilai toal qm;
$ambilnilaiqm=mysqli_query($kon,"select * from mhs_ujicoba where kode_responden='total'");
$nilaiqm= mysqli_fetch_object($ambilnilaiqm);
$tampungnilaiqm=$nilaiqm->$kolomqmsekarang;


//lakukan perhitungan 2
$tampungnilaiqm=$tampungnilaiqm*$tampungnilaiqm;


//lakukan perhitungan 3
$hasilnyoo=$tampungnilaix2-$tampungnilaiqm;

//set updte jumlah
$set_update_jml = mysqli_query($kon,"update mhs_ujicoba set $kolomqmsekarang='$hasilnyoo' where kode_responden='nxminxkuadrat' ");


if($set_update_jml==1){
//echo "<br/>Baris nxminxkuadrat telah diupdate";
}else {
	//echo "<br/>Baris nxminxkuadrat gagal diupdate";
}

$loop++;

}

?>	
		
		
		<!--
		<br/>-Membuat baris nxminykuadrat_mhs menghitung dan mengisinya
		
		
			<br/> jumlah baris nxminykuadrat_mhs saat ini:	
		<?php
		

$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='nxminykuadrat_mhs'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"insert into setting set nama='nxminykuadrat_mhs'");

if($buat_baris_total==1){
//echo "<br/>baris total sudah diinsert";
}else {
	//echo "<br/>baris total seharusnya sudah diinsert, tapi gagal";
}


}	else{
	
	//echo "<br/>baris total sudah ada";

	//disini kasih query update yang ber looping, karena diatas gak bisa ditaruh looping. Kayaknya gak perlu deh,
	
	
}	
		?>
		
		
		
			<?php 
			
			
			//gaperlu looping
	

//mengambil nilai jmlykuadrat_mhs;
$ambilnilaixy=mysqli_query($kon,"select * from setting where nama='nykuadrat_mhs'");
$nilaixy= mysqli_fetch_object($ambilnilaixy);
$tampungnilainykuadrat_mhs=$nilaixy->ketentuan;


//mengambil nilai ykuadrat_mhs;
$ambilnilaiqm=mysqli_query($kon,"select * from setting where nama='ykuadrat_mhs'");
$nilaiqm= mysqli_fetch_object($ambilnilaiqm);
$tampungnilaiykuadrat_mhs=$nilaiqm->ketentuan;


//lakukan perhitungan 1
$pilpiltampil=$tampungnilainykuadrat_mhs-$tampungnilaiykuadrat_mhs;



//set updte jumlah
$set_update_jml = mysqli_query($kon,"update setting set ketentuan='$pilpiltampil' where nama='nxminykuadrat_mhs' ");


if($set_update_jml==1){
//echo "<br/>Baris nxminykuadrat telah diupdate";
}else {
	//echo "<br/>Baris nxminykuadrat gagal diupdate";
}

?>
		
		<!--
		<br/>-Membuat baris Rxy, menghitung dan mengisi kriterianya
		
		<br/> jumlah baris rxy saat ini:	
		<?php
		

$jmlbaristotal = mysqli_query($kon,"select Count(*) from mhs_ujicoba where kode_responden='rxy'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"insert into mhs_ujicoba set kode_responden='rxy'");

if($buat_baris_total==1){
//echo "<br/>baris rxy sudah diinsert";
}else {
	//echo "<br/>baris rxy seharusnya sudah diinsert, tapi gagal";
}


}	else{
	
	//echo "<br/>baris rxy sudah ada";

	//disini kasih query update yang ber looping, karena diatas gak bisa ditaruh looping. Kayaknya gak perlu deh,
	
	
}	
		?>
		
		
		
			<?php 
			
			
$loop=1;

//looping 25x
while ($loop<=$jml_pert_mhs ) {

$loop_string=(string)$loop;


$kolomqmsekarang="qm".''.$loop_string;

	

//mengambil nilai nxminxkuadrat
$ambilnilaixy=mysqli_query($kon,"select * from mhs_ujicoba where kode_responden='nxminxkuadrat'");
$nilaixy= mysqli_fetch_object($ambilnilaixy);
$tampungnilainxminxkuadrat=$nilaixy->$kolomqmsekarang;


//mengambil nilai nxminykuadrat_mhs;
$ambilnilaiqm=mysqli_query($kon,"select * from setting where nama='nxminykuadrat_mhs'");
$nilaiqm= mysqli_fetch_object($ambilnilaiqm);
$tampungnilainxminykuadrat_mhs=$nilaiqm->ketentuan;


//lakukan perhitungan 1
$hitingsiti=$tampungnilainxminxkuadrat*$tampungnilainxminykuadrat_mhs;

//lakukan perhitungan 2
$hitingdiwi=sqrt($hitingsiti);



//mengambil nilai nxminxy;
$ambilnilaiqm=mysqli_query($kon,"select * from mhs_ujicoba where kode_responden='nxyminxy'");
$nilaiqm= mysqli_fetch_object($ambilnilaiqm);
$tampungnilainxminykuadrat_mhs=$nilaiqm->$kolomqmsekarang;


//lakukan perhitungan 3
$hitingtigi=$tampungnilainxminykuadrat_mhs/$hitingdiwi;


//set updte jumlah
$set_update_jml = mysqli_query($kon,"update mhs_ujicoba set $kolomqmsekarang='$hitingtigi' where kode_responden='rxy' ");


if($hitingtigi>0.312){
	$set_update_valid = mysqli_query($kon,"update butir_pertanyaan_mhs set validitas='Valid' where kode_pertanyaan='$kolomqmsekarang' ");
	//echo $kolomqmsekarang;
	//echo ' valid';
}else{
	$set_update_tidakvalid = mysqli_query($kon,"update butir_pertanyaan_mhs set validitas='Tidak Valid' where kode_pertanyaan='$kolomqmsekarang' ");
	//echo $kolomqmsekarang;
	//echo ' tidak valid';
	
}

if($set_update_jml==1){
//echo "<br/>Baris rxy telah diupdate";
}else {
	//echo "<br/>Baris rxy gagal diupdate";
}

$loop++;

}
?>
	<!--
		<br/>-membuat baris varian dan mengisinya
		
		
		<br/> jumlah baris varian saat ini:	
		<?php
		

$jmlbaristotal = mysqli_query($kon,"select Count(*) from mhs_ujicoba where kode_responden='varian'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"insert into mhs_ujicoba set kode_responden='varian'");

if($buat_baris_total==1){
//echo "<br/>baris varian sudah diinsert";
}else {
	//echo "<br/>baris varian seharusnya sudah diinsert, tapi gagal";
}


}	else{
	
	//echo "<br/>baris varian sudah ada";

	
	
}	
		?>
		
		
		
			<?php 
			
			

$loop=1;
$tutalvarian=0;

//looping 25x
while ($loop<=$jml_pert_mhs ) {

$loop_string=(string)$loop;


$kolomqmsekarang="qm".''.$loop_string;
$x2qmnow="x2qm".''.$loop_string;
	

//mengambil nilai totalqmloop
$ambilnilaixy=mysqli_query($kon,"select * from mhs_ujicoba where kode_responden='total'");
$nilaixy= mysqli_fetch_object($ambilnilaixy);
$totalqmlooph=$nilaixy->$kolomqmsekarang;

$totalqmloop=$totalqmlooph*$totalqmlooph;

$hytung1=$totalqmloop/$angkasampelmhs;

//mengambil nilai x2qmloop;
$ambilnilaiqm=mysqli_query($kon,"select * from mhs_ujicoba where kode_responden='total'");
$nilaiqm= mysqli_fetch_object($ambilnilaiqm);
$x2qmloop=$nilaiqm->$x2qmnow;

$hytung2=$x2qmloop-$hytung1;

$hytung3=$hytung2/$angkasampelmhs;

//set updte jumlah
$set_update_jml = mysqli_query($kon,"update mhs_ujicoba set $kolomqmsekarang='$hytung3' where kode_responden='varian' ");


if($set_update_jml==1){
//echo "<br/>Baris varian telah diupdate. Nilai: ";
//echo $hytung3;
}else {
	//echo "<br/>Baris varian gagal diupdate";
}


$tutalvarian=$tutalvarian+$hytung3;


$loop++;



}


//udate total varian

$updatetutalvarian = mysqli_query($kon,"update mhs_ujicoba set jml='$tutalvarian' where kode_responden='varian' ");


if($updatetutalvarian==1){
//echo "<br/>tutal varian telah diupdate. Nilai: ";
//echo $tutalvarian;
}else {
	//echo "<br/>tutal varian gagal diupdate";
}

?>
		
		
<!--
		
		<br/>-membuat 1 baris varian total dan mengisinya ke setting
		
		
				<br/> jumlah baris totalvarian_mhs saat ini:	
		<?php
		

$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='totalvarian_mhs'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"insert into setting set nama='totalvarian_mhs'");

if($buat_baris_total==1){
//echo "<br/>baris totalvarian sudah diinsert";
}else {
	//echo "<br/>baris totalvarian seharusnya sudah diinsert, tapi gagal";
}


}	else{
	
	//echo "<br/>baris totalvarian sudah ada";

	
	
}	
		?>
		
		
		
			<?php 
			
			



	

//mengambil nilai datatotaljml
$ambilnilaixy=mysqli_query($kon,"select * from mhs_ujicoba where kode_responden='total'");
$nilaixy= mysqli_fetch_object($ambilnilaixy);
$datatotaljml=$nilaixy->jml;

//mengkuadratkan datatotaljml
$datatotaljmlkuadrat=$datatotaljml*$datatotaljml;

//mengkuadratkan datatotaljmldibagisampel
$datatotaljmlkuadratdibagisampel=$datatotaljmlkuadrat/$angkasampelmhs;

//mengambil nilai totaljmlxdua;
$ambilnilaiqm=mysqli_query($kon,"select * from mhs_ujicoba where kode_responden='total'");
$nilaiqm= mysqli_fetch_object($ambilnilaiqm);
$totaljmlxdua=$nilaiqm->jmlx2;

//perhitungan nilai pulupulu
$pulupulu=$totaljmlxdua-$datatotaljmlkuadratdibagisampel;

//perhitungan nilai resulto
$resulto=$pulupulu/$angkasampelmhs;



//set updte jumlah
$set_update_totalvarian = mysqli_query($kon,"update setting set ketentuan='$resulto' where nama='totalvarian_mhs' ");


if($set_update_totalvarian==1){
//echo "<br/>Baris totalvarian telah diupdate. Nilai: ";
//echo $resulto;
}else {
	//echo "<br/>Baris totalvarian gagal diupdate";
}

?>
		
		<!--
		<br/>-membuat baris reliabilitas_mhs, kategori di setting dan mengisinya
		
				<br/> jumlah baris reliabilitas_mhs saat ini:	
		<?php
		

$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='reliabilitas_mhs'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"insert into setting set nama='reliabilitas_mhs'");

if($buat_baris_total==1){
//echo "<br/>baris reliabilitas_mhs sudah diinsert";
}else {
	//echo "<br/>baris reliabilitas_mhs seharusnya sudah diinsert, tapi gagal";
}


}	else{
	
	//echo "<br/>baris reliabilitas_mhs sudah ada";

	
	
}	


//mengecek baris kategori di setting

$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='kategori_reliabilitasmhs'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"insert into setting set nama='kategori_reliabilitasmhs'");

if($buat_baris_total==1){
//echo "<br/>baris kategori_reliabilitasmhs sudah diinsert";
}else {
	//echo "<br/>baris kategori_reliabilitasmhs seharusnya sudah diinsert, tapi gagal";
}


}	else{
	
	//echo "<br/>baris kategori_reliabilitasmhs sudah ada";

	
	
}	





		?>
		
		
		
			<?php 
			
			



//mengkuadratkan datatotaljml
$hitong1=$jml_pert_mhs-1;

//mengkuadratkan datatotaljmldibagisampel
$hitong2=$jml_pert_mhs/$hitong1;

//mengambil nilai varianjumlo;
$ambilnilaiqm=mysqli_query($kon,"select * from mhs_ujicoba where kode_responden='varian'");
$nilaiqm= mysqli_fetch_object($ambilnilaiqm);
$varianjumlo=$nilaiqm->jml;

//mengambil nilai varianjumlomhs;
$ambilnilaiqm=mysqli_query($kon,"select * from setting where nama='totalvarian_mhs'");
$nilaiqm= mysqli_fetch_object($ambilnilaiqm);
$varianjumlomhs=$nilaiqm->ketentuan;

//perhitungan nilai pulupulu
$hitong3=$varianjumlo/$varianjumlomhs;

//perhitungan nilai pulupulu
$hitong4=1-$hitong3;

//perhitungan nilai resulto
$resultohhh=$hitong2*$hitong4;


if($resultohhh>0&&$resultohhh<0.2){
	$kategori='Sangat Rendah';
}else if($resultohhh>0.2&&$resultohhh<0.4){
	$kategori='Rendah';
}else if($resultohhh>0.4&&$resultohhh<0.7){
	$kategori='Sedang';
}else if($resultohhh>0.7&&$resultohhh<0.9){
	$kategori='Tinggi';
}else if($resultohhh>0.9&&$resultohhh<1){
	$kategori='Sangat Tinggi';
}

//echo 'kategori reliabilitas: ';
//echo $kategori;

//set updte jumlah
$set_update_totalvarian = mysqli_query($kon,"update setting set ketentuan='$resultohhh' where nama='reliabilitas_mhs' ");


if($set_update_totalvarian==1){
//echo "<br/>Baris totalvarian telah diupdate. Nilai: ";
//echo $resultohhh;
}else {
	//echo "<br/>Baris totalvarian gagal diupdate";
}


//set updte kategori
$set_update_kategori = mysqli_query($kon,"update setting set ketentuan='$kategori' where nama='kategori_reliabilitasmhs' ");


if($set_update_kategori==1){
//echo "<br/>Baris kategori telah diupdate. Nilai: ";
//echo $kategori;
}else {
	//echo "<br/>Baris kategori gagal diupdate";
}

?>





<!--

INI ADALAH BATAS DUA DUNIA ANTARA RESPONDEN MHS DAN DOSENNN............

-->

<!--

INI ADALAH WEBSITE UNTUK DOSEN. Jangan diRUN dulu, databasenya belum siap<br/>
Saat ini data ujicoba sudah masuk dan tombol analisis uji coba baru saja diklik <br/>
<br/>
-ambil data jumlah responden dari setting<br/>

<?php
				$query_jml_sampel_uji=mysqli_query($kon,"select * from setting where nama='jml_sampeluji_dosen'");
				$jml_mhs_uji = mysqli_fetch_object($query_jml_sampel_uji);
				$angkasampeldosen=$jml_mhs_uji->ketentuan;
			?>
			
			<!--
data jml responden mhs dari setting:	<?php //echo $angkasampeldosen ?> <br/>
		
-buat kolom jml <br/>

<?php

$buat_kolom_jml="alter table dosen_ujicoba add jml varchar(20)";
$eksekyut=mysqli_query($kon,$buat_kolom_jml);
if ($b=$eksekyut){
				//echo "Kolom jml telah dibuat";
}else {
	//echo "Kolom jml gagal dibuat";
}
	
		?>
		
		<!--

<br/>


-ambil banyaknya pertanyaan dari db <br/>

<?php
				$query_jml_pertanyaan_mhs = mysqli_query($kon,"select Count(*) as totalper_dosen from butir_pertanyaan_dosen");
				$jml_per_mhs= mysqli_fetch_assoc($query_jml_pertanyaan_mhs);
				$jml_pert_dosen=implode($jml_per_mhs);
			?>
			
			<!--
			
banyaknya pertanyaan mhs:	<?php //echo $jml_pert_dosen ?> <br/>


<BR/>SAMPAI DISINI YA, KAREN DB BELUM SIAP. SIAPIN DB DULU BARU LANJUT<BR/>


-jumlahkan data setiap jwban dan taruh di jml pakai looping nested

<br/>
<?php
$iterasi=1;
$tampungtotalsemuamhs=0;


while ($iterasi<=$angkasampeldosen ) {


$no = 1;
$no_string=(string)$no;

$koderespondensaatini="dosen".''.$iterasi;
//echo "<br/>responden saat ini:";
//echo $koderespondensaatini;
$totalnilai=0;
$tampungtotalnilai=0;


while ($no<=$jml_pert_dosen ) {
$pertanyaansaatini="qd".''.$no_string;
////echo "<br/>pertanyaan saat ini:";
////echo $pertanyaansaatini;

$akumulasi_jml=mysqli_query($kon,"select * from dosen_ujicoba where kode_responden='$koderespondensaatini'");
$nilai_mhs= mysqli_fetch_object($akumulasi_jml);
$tampungnilai=$nilai_mhs->$pertanyaansaatini;
////echo "nilai variabel tampungnilai adalah:";
////echo $tampungnilai;
$tampungtotalnilai=$tampungtotalnilai+$tampungnilai;
////echo "nilai variabel tampungnilaitotal adalah:";
////echo $tampungtotalnilai;


$no++;
$no_string=(string)$no;
}
//echo "<br/>nilai jml responden mhs";
//echo $iterasi;
//echo " : ";
//echo $tampungtotalnilai;


//set updte jumlah
$set_update_jml = mysqli_query($kon,"update dosen_ujicoba set jml='$tampungtotalnilai' where kode_responden='$koderespondensaatini' ");

//$set_update_jml="update table dosen_ujicoba set jml='$tampungtotalnilai' where kode_responden='$koderespondensaatini' ";
//$eksekyut_update_jml=mysqli_query($kon,$set_update_jml);
if($set_update_jml==1){
//echo "<br/>Kolom jml telah diupdate";
}else {
	//echo "<br/>Kolom jml gagal diupdate";
}
//if ($cek_hasilupdate=$eksekyut_update_jml){
//				//echo "<br/>Kolom jml telah diupdate";
//}else {
//	//echo "<br/>Kolom jml gagal diupdate";
//}


//echo "<br/>";
//echo "Iterasi ke-";
//echo $iterasi;


$iterasi=$iterasi+1;
//echo "<br/>";

$tampungtotalsemuamhs=$tampungtotalsemuamhs+$tampungtotalnilai;
}

//echo "total semuaaaanyyya: ";
//echo $tampungtotalsemuamhs;

//$apdetjml = mysqli_query($kon,"insert into dosen_ujicoba set kode_responden='total', jml='$tampungtotalsemuamhs'");

//disini tambahan yang error




$jmlbaristotal = mysqli_query($kon,"select Count(*) from dosen_ujicoba where kode_responden='total'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"insert into dosen_ujicoba set kode_responden='total' jml='$tampungtotalsemuamhs'");

if($buat_baris_total==1){
//echo "<br/>baris total sudah diinsert";
}else {
	//echo "<br/>baris total seharusnya sudah diinsert, tapi gagal";
}


}	else{
	
	//echo "<br/>baris total sudah ada";

	
	$set_update_jml = mysqli_query($kon,"update dosen_ujicoba set jml='$tampungtotalsemuamhs' where kode_responden='total' ");

if($set_update_jml==1){
//echo "<br/>baris total sudah ada dan telah diupdate";
}else {
	//echo "<br/>baris total sudah ada dan gagal diupdate";
}
	
	
	//kosong
	
	
}	


?>



<!--

<br/>
-buat tabel xy untuk menampung data menggunakan looping
<br/>

<?php

	
$no_tambahtabel=1;	

while ($no_tambahtabel<=$jml_pert_dosen ) {
	
$no_tambahtabel_string=(string)$no_tambahtabel;	
$kode_xy="xyqd".''.$no_tambahtabel_string;
	
$buat_tabel_xy="alter table dosen_ujicoba add $kode_xy varchar(20)";
$eksekyut2=mysqli_query($kon,$buat_tabel_xy);
if ($b2=$eksekyut2){
				//echo "Kolom $kode_xy telah dibuat";
				//echo "<br/>";
				
}else {
	//echo "Kolom $kode_xy gagal dibuat";
	//echo "<br/>";
	
}

	$no_tambahtabel++;
}
		?>

<!--		
		-buat kolom jmlxy<br/>
		-->
		
		<?php

//$buat_kolom_jmlxy="alter table dosen_ujicoba add jmlxy int(7)";
//$eksekyut3=mysqli_query($kon,$buat_kolom_jmlxy);
//if ($b=$eksekyut3){
//				//echo "Kolom jmlxy telah dibuat";
//}else {
//	//echo "Kolom jmlxy gagal dibuat";
//}
	
		?>
		
		<!--
		<br/>-buat kolom x2qd<br/>
		
		
		<?php

	
$no_tambahtabel=1;	

while ($no_tambahtabel<=$jml_pert_dosen ) {
	
$no_tambahtabel_string=(string)$no_tambahtabel;	
$kode_x2="x2qd".''.$no_tambahtabel_string;
	
$buat_tabel_x2="alter table dosen_ujicoba add $kode_x2 varchar(20)";
$eksekyut4=mysqli_query($kon,$buat_tabel_x2);
if ($b2=$eksekyut4){
				//echo "Kolom $kode_x2 telah dibuat";
				//echo "<br/>";
				
}else {
	//echo "Kolom $kode_x2 gagal dibuat";
	//echo "<br/>";
	
}

	$no_tambahtabel++;
}
		?>
		
		<!--
		<br/>-buat kolom jmlx2<br/>
		
		<?php

$buat_kolom_jmlx2="alter table dosen_ujicoba add jmlx2 varchar(20)";
$eksekyut5=mysqli_query($kon,$buat_kolom_jmlx2);
if ($b=$eksekyut5){
				//echo "Kolom jmlx2 telah dibuat";
}else {
	//echo "Kolom jmlx2 gagal dibuat";
}
	
		?>
		<!--
		<br/>-insert data masing-masing tabel xy<br/>
		
		
		<?php
		
$iterasi=1;
$bariske = 1;
$bariske_string=(string)$bariske;

//looping 25 kali
while ($iterasi<= $jml_pert_dosen ) {


$no = 1;
$no_string=(string)$no;


$koderespondensaatini="dosen".''.$iterasi;
$kodepertanyaansaatini="xyqd".''.$iterasi;
//echo "<br/>pertanyaan ke ";
//echo $iterasi;
//echo "<br/>";

//$totalnilai=0;
//$tampungtotalnilai=0;

$status=1;
//looping 40 kali
while ($no<=$angkasampeldosen) {



$pertanyaansaatini="qd".''.$bariske;

$targetisi="xyqd".''.$bariske_string;


	$koderespondensaatini="dosen".''.$status;
$ambildata=mysqli_query($kon,"select * from dosen_ujicoba where kode_responden='$koderespondensaatini'");
$nilai_mhs= mysqli_fetch_object($ambildata);
$nilaikuesioner=$nilai_mhs->$pertanyaansaatini;
$jml_nilaikuesioner=$nilai_mhs->jml;


$masukkannilai=$nilaikuesioner*$jml_nilaikuesioner;

//echo " mhs";
//echo $no;
//echo " : ";
//echo $masukkannilai;

$targetkolom="xyqd".''.$bariske;
$targetbaris="dosen".''.$no;
$darikolomx2="qd".''.$bariske;
$targetkolomx2="x2qd".''.$bariske;

//Query update taruh disini yes, insert into kolom values where

$set_inputtabelxy = mysqli_query($kon,"update dosen_ujicoba set $targetkolom='$masukkannilai' where kode_responden='$targetbaris' ");

if($set_inputtabelxy==1){
//echo "<br/>data terinput";
}else {
	//echo "<br/>data tidak terinput";
}

//Query update tabel x2 taruh dibawah sini yaa..


$ambildatax2=mysqli_query($kon,"select * from dosen_ujicoba where kode_responden='$targetbaris'");
$datax2= mysqli_fetch_object($ambildatax2);
$nilaix2=$datax2->$darikolomx2;

$masukkannilaix2=$nilaix2*$nilaix2;

$set_inputtabelx2 = mysqli_query($kon,"update dosen_ujicoba set $targetkolomx2='$masukkannilaix2' where kode_responden='$targetbaris' ");

if($set_inputtabelx2==1){
//echo "<br/>data x2 terinput";
}else {
	//echo "<br/>data x2 tidak terinput";
}


$status++;

$no++;
$no_string=(string)$no;
}


//echo "<br/>";
//echo "Iterasi ke-";
//echo $iterasi;


$iterasi=$iterasi+1;
//echo "<br/>";

$bariske++;
//$tampungtotalsemuamhs=$tampungtotalsemuamhs+$tampungtotalnilai;
}

?>
		<!--
<br/>-Hitung kolom jumlah X2 dan input ke db, now!
		
		
		
<br/>
<?php
$iterasi=1;
$tampungtotalsemuamhs=0;


while ($iterasi<=$angkasampeldosen ) {


$no = 1;
$no_string=(string)$no;

$koderespondensaatini="dosen".''.$iterasi;
//echo "<br/>responden saat ini:";
//echo $koderespondensaatini;
$totalnilai=0;
$tampungtotalnilai=0;


while ($no<=$jml_pert_dosen ) {



$akumulasi_jml=mysqli_query($kon,"select * from dosen_ujicoba where kode_responden='$koderespondensaatini'");
$nilai_mhs= mysqli_fetch_object($akumulasi_jml);
$tampungnilai=$nilai_mhs->jml;

$tampungtotalnilai=$tampungnilai*$tampungnilai;


$no++;
$no_string=(string)$no;
}
//echo "<br/>nilai x2 jml responden mhs";
//echo $iterasi;
//echo " : ";
//echo $tampungtotalnilai;


$set_update_jml = mysqli_query($kon,"update dosen_ujicoba set jmlx2='$tampungtotalnilai' where kode_responden='$koderespondensaatini' ");

if($set_update_jml==1){
//echo "<br/>Kolom jmlx2 telah diupdate";
}else {
	//echo "<br/>Kolom jmlx2 gagal diupdate";
}


//echo "<br/>";
//echo "Iterasi ke-";
//echo $iterasi;


$iterasi=$iterasi+1;
//echo "<br/>";

$tampungtotalsemuamhs=$tampungtotalsemuamhs+$tampungtotalnilai;
}

?>
<!--
	<br/>-tambahkan baris total data
	<br/> jumlah baris saat ini:	
		<?php
		

$jmlbaristotal = mysqli_query($kon,"select Count(*) from dosen_ujicoba where kode_responden='total'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"insert into dosen_ujicoba set kode_responden='total'");

if($buat_baris_total==1){
//echo "<br/>baris total sudah diinsert";
}else {
	//echo "<br/>baris total seharusnya sudah diinsert, tapi gagal";
}


}	else{
	
	//echo "<br/>baris total sudah ada";

	//kosong
	
	
}	
		?>
		
		
		<!--
		<br/>-Menambahkan jumlah ke tabel asli
		
		<?php //Ngeditnya disini woooyyy
$iterasi=1;
$tampungtotalsemuamhs=0;

//looping 25x
while ($iterasi<=$jml_pert_dosen ) {

$no = 1;
$no_string=(string)$no;
$iterasi_string=(string)$iterasi;

$koderespondensaatini="qd".''.$iterasi_string;
//echo "<br/>responden saat ini:";
//echo $koderespondensaatini;
$totalnilai=0;
$tampungtotalnilai=0;

//looping 40x
while ($no<=$angkasampeldosen ) {
$pertanyaansaatini="dosen".''.$no_string;

//echo $pertanyaansaatini;
$akumulasi_jml=mysqli_query($kon,"select * from dosen_ujicoba where kode_responden='$pertanyaansaatini'");
$nilai_mhs= mysqli_fetch_object($akumulasi_jml);
$tampungnilaiy=$nilai_mhs->$koderespondensaatini;

////echo $tampungnilaiy;
$tampungtotalnilai=$tampungtotalnilai+$tampungnilaiy;


//set updte jumlah
$set_update_jml = mysqli_query($kon,"update dosen_ujicoba set $koderespondensaatini='$tampungtotalnilai' where kode_responden='total' ");

if($set_update_jml==1){
//echo "<br/>Kolom jml telah diupdate";
}else {
	//echo "<br/>Kolom jml gagal diupdate";
}

$no++;
$no_string=(string)$no;
}
//echo "<br/>nilai jml pertanyaan ";
//echo $iterasi;
//echo " : ";
//echo $tampungtotalnilai;





//echo "<br/>";
//echo "Iterasi ke-";
//echo $iterasi;


$iterasi=$iterasi+1;
//echo "<br/>";

$tampungtotalsemuamhs=$tampungtotalsemuamhs+$tampungtotalnilai;
}

//echo "total semuaaaanyyya: ";
//echo $tampungtotalsemuamhs;

$settotaljml = mysqli_query($kon,"update dosen_ujicoba set jml='$tampungtotalsemuamhs' where kode_responden='total' ");

if($settotaljml==1){
//echo "<br/>satu nilai total jml diupdate";
}else {
	//echo "<br/>satu nilai total jml gagal diupdate";
}
?>

		
		
		
		<!--
			<br/>-Menambahkan jumlah ke tabel xy
		
		<?php //Ngeditnya disini woooyyy
$iterasi=1;
$tampungtotalsemuamhs=0;

//looping 25x
while ($iterasi<=$jml_pert_dosen ) {

$no = 1;
$no_string=(string)$no;
$iterasi_string=(string)$iterasi;

$koderespondensaatini="xyqd".''.$iterasi_string;
//echo "<br/>responden saat ini:";
//echo $koderespondensaatini;
$totalnilai=0;
$tampungtotalnilai=0;

//looping 40x
while ($no<=$angkasampeldosen ) {
$pertanyaansaatini="dosen".''.$no_string;

//echo $pertanyaansaatini;
$akumulasi_jml=mysqli_query($kon,"select * from dosen_ujicoba where kode_responden='$pertanyaansaatini'");
$nilai_mhs= mysqli_fetch_object($akumulasi_jml);
$tampungnilaiy=$nilai_mhs->$koderespondensaatini;

////echo $tampungnilaiy;
$tampungtotalnilai=$tampungtotalnilai+$tampungnilaiy;


//set updte jumlah
$set_update_jml = mysqli_query($kon,"update dosen_ujicoba set $koderespondensaatini='$tampungtotalnilai' where kode_responden='total' ");

if($set_update_jml==1){
//echo "<br/>Kolom jml xyqd telah diupdate";
}else {
	//echo "<br/>Kolom jml xyqd gagal diupdate";
}

$no++;
$no_string=(string)$no;
}
//echo "<br/>nilai jml pertanyaan ";
//echo $iterasi;
//echo " : ";
//echo $tampungtotalnilai;





//echo "<br/>";
//echo "Iterasi ke-";
//echo $iterasi;


$iterasi=$iterasi+1;
//echo "<br/>";

$tampungtotalsemuamhs=$tampungtotalsemuamhs+$tampungtotalnilai;
}

//echo "total semuaaaanyyya: ";
//echo $tampungtotalsemuamhs;

$apdetjmlx2 = mysqli_query($kon,"update dosen_ujicoba set jmlx2='$tampungtotalsemuamhs' where kode_responden='total' ");

if($apdetjmlx2==1){
//echo "<br/>Jml x2 dipojok sudah dipudate";
}else {
	//echo "<br/>Jml x2 dipojok gagal dipudate";
}

?>

	

<!--
<br/>-Menambahkan jumlah ke tabel x2
		
		<?php //Ngeditnya disini woooyyy
$iterasi=1;
$tampungtotalsemuamhs=0;

//looping 25x
while ($iterasi<=$jml_pert_dosen ) {

$no = 1;
$no_string=(string)$no;
$iterasi_string=(string)$iterasi;

$koderespondensaatini="x2qd".''.$iterasi_string;
//echo "<br/>responden saat ini:";
//echo $koderespondensaatini;
$totalnilai=0;
$tampungtotalnilai=0;

//looping 40x
while ($no<=$angkasampeldosen ) {
$pertanyaansaatini="dosen".''.$no_string;

//echo $pertanyaansaatini;
$akumulasi_jml=mysqli_query($kon,"select * from dosen_ujicoba where kode_responden='$pertanyaansaatini'");
$nilai_mhs= mysqli_fetch_object($akumulasi_jml);
$tampungnilaiy=$nilai_mhs->$koderespondensaatini;

////echo $tampungnilaiy;
$tampungtotalnilai=$tampungtotalnilai+$tampungnilaiy;


//set updte jumlah
$set_update_jml = mysqli_query($kon,"update dosen_ujicoba set $koderespondensaatini='$tampungtotalnilai' where kode_responden='total' ");

if($set_update_jml==1){
//echo "<br/>Kolom jml x2qd telah diupdate";
}else {
	//echo "<br/>Kolom jml x2qd gagal diupdate";
}

$no++;
$no_string=(string)$no;
}
//echo "<br/>nilai jml pertanyaan ";
//echo $iterasi;
//echo " : ";
//echo $tampungtotalnilai;





//echo "<br/>";
//echo "Iterasi ke-";
//echo $iterasi;


$iterasi=$iterasi+1;
//echo "<br/>";

$tampungtotalsemuamhs=$tampungtotalsemuamhs+$tampungtotalnilai;
}

//echo "total semuaaaanyyya: ";
//echo $tampungtotalsemuamhs;
?>	

		
		<!--
		<br/>-Membuat baris x2kuadrat, menghitung dan mengisinya
		
		

	<br/> jumlah baris x2kuadrat saat ini:	
	
		<?php
		

$jmlbaristotal = mysqli_query($kon,"select Count(*) from dosen_ujicoba where kode_responden='x2kuadrat'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"insert into dosen_ujicoba set kode_responden='x2kuadrat'");

if($buat_baris_total==1){
//echo "<br/>baris total sudah diinsert";
}else {
	//echo "<br/>baris total seharusnya sudah diinsert, tapi gagal";
}


}	else{
	
	//echo "<br/>baris total sudah ada";

	//kosong
	
	
}	//ini gausah dihapus,lanjut dibawahnya
		?>
		
		
		
			<?php //Ngeditnya disini woooyyy
$iterasi=1;
$tampungtotalsemuamhs=0;

//looping 25x
while ($iterasi<=$jml_pert_dosen ) {

$no = 1;
$no_string=(string)$no;
$iterasi_string=(string)$iterasi;

$koderespondensaatini="qd".''.$iterasi_string;
//echo "<br/>responden saat ini:";
//echo $koderespondensaatini;
$totalnilai=0;
$tampungtotalnilai=0;


$pertanyaansaatini="dosen".''.$no_string;
$variabeluntukdikali="qd".''.$no_string;

//echo $pertanyaansaatini;
$akumulasi_jml=mysqli_query($kon,"select * from dosen_ujicoba where kode_responden='$pertanyaansaatini'");
$nilai_mhs= mysqli_fetch_object($akumulasi_jml);
$tampungnilaiy=$nilai_mhs->$koderespondensaatini;

//untuk mengambil nilai yang akan dikalikan
$yangakandikali=mysqli_query($kon,"select $koderespondensaatini from dosen_ujicoba where kode_responden='total'");
$var_yangakandikali= mysqli_fetch_object($yangakandikali);
$dikali=$var_yangakandikali->$koderespondensaatini;
//echo 'yang akan dikali: ';
//echo $dikali;

////echo $tampungnilaiy;
$tampungtotalnilai=$dikali*$dikali;


//set updte jumlah
$set_update_jml = mysqli_query($kon,"update dosen_ujicoba set $koderespondensaatini='$tampungtotalnilai' where kode_responden='x2kuadrat' ");


if($set_update_jml==1){
//echo "<br/>Kolom jml x2kuadrat telah diupdate";
}else {
	//echo "<br/>Kolom jml x2kuadrat gagal diupdate";
}

$no++;
$no_string=(string)$no;

//echo "<br/>nilai jml pertanyaan ";
//echo $iterasi;
//echo " : ";
//echo $tampungtotalnilai;





//echo "<br/>";
//echo "Iterasi ke-";
//echo $iterasi;


$iterasi=$iterasi+1;
//echo "<br/>";

$tampungtotalsemuamhs=$tampungtotalsemuamhs+$tampungtotalnilai;
}

//echo "total semuaaaanyyya: ";
//echo $tampungtotalsemuamhs;




//set updte jumlah
$set_update_jml2 = mysqli_query($kon,"update dosen_ujicoba set jml='$tampungtotalsemuamhs' where kode_responden='x2kuadrat' ");

if($set_update_jml2==1){
//echo "<br/>jmlkuadrat diinput";
}else {
	//echo "<br/>jmlkuadrat gagal diinput";
}

$tampungtotalnilai=0;
?>	
			
			
			
		<!--

		<br/>-Membuat baris nykuadrat_dosen di setting, menghitung dan mengisinya
		
		
		<br/> jumlah baris nykuadrat_dosen saat ini:	
		
		
		
		<?php
		

		
	$query_jmlx2=mysqli_query($kon,"select * from dosen_ujicoba where kode_responden='total'");
				$hasil_queryjmlx2 = mysqli_fetch_object($query_jmlx2);
				$angkajmlx2=$hasil_queryjmlx2->jmlx2;
				
				$hasilperkalianjmlx2=$angkajmlx2*$angkasampeldosen;



		
		
		
$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='nykuadrat_dosen'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

//$buat_baris_nykuadrat_dosen = mysqli_query($kon,"insert into setting set nama='nykuadrat_dosen' ketentuan='$hasilperkalianjmlx2'");

$buat_baris_nykuadrat_dosen=mysqli_query($kon,"INSERT INTO `setting`(`nama`, `ketentuan`) VALUES ('nykuadrat_dosen','$hasilperkalianjmlx2')");

//tambah query insert ke setting


if($buat_baris_nykuadrat_dosen==1){
//echo "<br/>baris nykuadrat_dosen sudah diinsert";
}else {
	//echo "<br/>baris nykuadrat_dosen seharusnya sudah diinsert, tapi gagal<br/>Hasil nilai yang seharunya dimasukkan ketentuan: ";
	//echo $hasilperkalianjmlx2;
}


}	else{


	
	//echo "<br/>baris nykuadrat_dosen sudah ada";

$set_update_jml2 = mysqli_query($kon,"update setting set ketentuan='$hasilperkalianjmlx2' where nama='nykuadrat_dosen' ");

if($set_update_jml2==1){
//echo "<br/>jmlkuadrat diinput";
}else {
	//echo "<br/>jmlkuadrat gagal diinput";
}
	
}	
		?>
		
<!--
		
		<br/>-Membuat baris ykuadrat_dosen di setting, menghitung dan mengisinya
		
		<br/> jumlah baris ykuadrat_dosen saat ini:	
		-->
		<?php
		

		
	$query_jmlx2=mysqli_query($kon,"select * from dosen_ujicoba where kode_responden='total'");
				$hasil_queryjmlx2 = mysqli_fetch_object($query_jmlx2);
				$angkajmlx2=$hasil_queryjmlx2->jml;
				
				//echo 'nilai awal: ';
				//echo $angkajmlx2;
				//echo '<br/>';
				$hasilperkalianykuadrat=$angkajmlx2*$angkajmlx2;
				//echo $hasilperkalianykuadrat;



		
		
		
$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='ykuadrat_dosen'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"INSERT INTO `setting`(`nama`, `ketentuan`) VALUES ('ykuadrat_dosen','$hasilperkalianykuadrat');");

//tambah query insert ke setting


if($buat_baris_total==1){
//echo "<br/>baris nykuadrat_dosen sudah diinsert";
}else {
	//echo "<br/>baris nykuadrat_dosen seharusnya sudah diinsert, tapi gagal";
}


}	else{


	
	//echo "<br/>baris nykuadrat_dosen sudah ada";

$set_update_jml2 = mysqli_query($kon,"update setting set ketentuan='$hasilperkalianykuadrat' where nama='ykuadrat_dosen' ");

if($set_update_jml2==1){
//echo "<br/>ykuadrat diinput";
}else {
	//echo "<br/>ykuadrat gagal diinput";
}
	
}	
		?>
		
		
		<!--
		<br/>-Membuat baris nxminxy, menghitung dan mengisinya
		
		
		
		<br/> jumlah baris nxyminxy saat ini:	
		
		
		<?php
		

$jmlbaristotal = mysqli_query($kon,"select Count(*) from dosen_ujicoba where kode_responden='nxyminxy'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"insert into dosen_ujicoba set kode_responden='nxyminxy'");

if($buat_baris_total==1){
//echo "<br/>baris total sudah diinsert";
}else {
	//echo "<br/>baris total seharusnya sudah diinsert, tapi gagal";
}


}	else{
	
	//echo "<br/>baris total sudah ada";

	//disini kasih query update yang ber looping, karena diatas gak bisa ditaruh looping. Kayaknya gak perlu deh,
	
	
}	
		?>
		
		
		
			<?php 
			
			//ambil nilai variabel $jmlttl;
			$query_jmlttl=mysqli_query($kon,"select jml from dosen_ujicoba where kode_responden='total'");
			$var_jmlttl= mysqli_fetch_object($query_jmlttl);
			$jmlttl=$var_jmlttl->jml;
			
			//echo "hmm.. nilai aa43 adalah : ";
			//echo $jmlttl;
			
			
			
$loop=1;

//looping 25x
while ($loop<=$jml_pert_dosen ) {

$loop_string=(string)$loop;

$kolomxysekarang="xyqd".''.$loop_string;
$kolomqmsekarang="qd".''.$loop_string;


//mengambil nilai total xy;
$ambilnilaixy=mysqli_query($kon,"select * from dosen_ujicoba where kode_responden='total'");
$nilaixy= mysqli_fetch_object($ambilnilaixy);
$tampungnilaixy=$nilaixy->$kolomxysekarang;


//lakukan perhitungan 1
$tampungnilaixy=$tampungnilaixy*$angkasampeldosen;


//mengambil nilai toal qm;
$ambilnilaiqm=mysqli_query($kon,"select * from dosen_ujicoba where kode_responden='total'");
$nilaiqm= mysqli_fetch_object($ambilnilaiqm);
$tampungnilaiqm=$nilaiqm->$kolomqmsekarang;


//lakukan perhitungan 1
$tampungnilaiqm=$tampungnilaiqm*$jmlttl;


//lakukan perhitungan 3
$hasilnyoo=$tampungnilaixy-$tampungnilaiqm;

//set updte jumlah
$set_update_jml = mysqli_query($kon,"update dosen_ujicoba set $kolomqmsekarang='$hasilnyoo' where kode_responden='nxyminxy' ");


if($set_update_jml==1){
//echo "<br/>Baris nxyminxy telah diupdate";
}else {
	//echo "<br/>Baris nxyminxy gagal diupdate";
}

$loop++;

}

?>	
		
		<!--
		<br/>-Membuat baris nxminxkuadrat, menghitung dan mengisinya
		
		
		
		<br/> jumlah baris nxminxkuadrat saat ini:	
		
		
		
		<?php
		

$jmlbaristotal = mysqli_query($kon,"select Count(*) from dosen_ujicoba where kode_responden='nxminxkuadrat'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"insert into dosen_ujicoba set kode_responden='nxminxkuadrat'");

if($buat_baris_total==1){
//echo "<br/>baris total sudah diinsert";
}else {
	//echo "<br/>baris total seharusnya sudah diinsert, tapi gagal";
}


}	else{
	
	//echo "<br/>baris total sudah ada";

	//disini kasih query update yang ber looping, karena diatas gak bisa ditaruh looping. Kayaknya gak perlu deh,
	
	
}	
		?>
		
		
		
			<?php 
			
			
			
			
$loop=1;

//looping 25x
while ($loop<=$jml_pert_dosen ) {

$loop_string=(string)$loop;

$kolomx2sekarang="x2qd".''.$loop_string;
$kolomqmsekarang="qd".''.$loop_string;


//mengambil nilai total x2;
$ambilnilaixy=mysqli_query($kon,"select * from dosen_ujicoba where kode_responden='total'");
$nilaixy= mysqli_fetch_object($ambilnilaixy);
$tampungnilaix2=$nilaixy->$kolomx2sekarang;


//lakukan perhitungan 1
$tampungnilaix2=$tampungnilaix2*$angkasampeldosen;


//mengambil nilai toal qm;
$ambilnilaiqm=mysqli_query($kon,"select * from dosen_ujicoba where kode_responden='total'");
$nilaiqm= mysqli_fetch_object($ambilnilaiqm);
$tampungnilaiqm=$nilaiqm->$kolomqmsekarang;


//lakukan perhitungan 2
$tampungnilaiqm=$tampungnilaiqm*$tampungnilaiqm;


//lakukan perhitungan 3
$hasilnyoo=$tampungnilaix2-$tampungnilaiqm;

//set updte jumlah
$set_update_jml = mysqli_query($kon,"update dosen_ujicoba set $kolomqmsekarang='$hasilnyoo' where kode_responden='nxminxkuadrat' ");


if($set_update_jml==1){
//echo "<br/>Baris nxminxkuadrat telah diupdate";
}else {
	//echo "<br/>Baris nxminxkuadrat gagal diupdate";
}

$loop++;

}

?>	
		
		<!--
		
		<br/>-Membuat baris nxminykuadrat_dosen menghitung dan mengisinya
		
		
			<br/> jumlah baris nxminykuadrat_dosen saat ini:	
			
		<?php
		

$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='nxminykuadrat_dosen'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"insert into setting set nama='nxminykuadrat_dosen'");

if($buat_baris_total==1){
//echo "<br/>baris total sudah diinsert";
}else {
	//echo "<br/>baris total seharusnya sudah diinsert, tapi gagal";
}


}	else{
	
	//echo "<br/>baris total sudah ada";

	//disini kasih query update yang ber looping, karena diatas gak bisa ditaruh looping. Kayaknya gak perlu deh,
	
	
}	
		?>
		
		
		
			<?php 
			
			
			//gaperlu looping
	

//mengambil nilai jmlykuadrat_dosen;
$ambilnilaixy=mysqli_query($kon,"select * from setting where nama='nykuadrat_dosen'");
$nilaixy= mysqli_fetch_object($ambilnilaixy);
$tampungnilainykuadrat_dosen=$nilaixy->ketentuan;


//mengambil nilai ykuadrat_dosen;
$ambilnilaiqm=mysqli_query($kon,"select * from setting where nama='ykuadrat_dosen'");
$nilaiqm= mysqli_fetch_object($ambilnilaiqm);
$tampungnilaiykuadrat_dosen=$nilaiqm->ketentuan;


//lakukan perhitungan 1
$pilpiltampil=$tampungnilainykuadrat_dosen-$tampungnilaiykuadrat_dosen;



//set updte jumlah
$set_update_jml = mysqli_query($kon,"update setting set ketentuan='$pilpiltampil' where nama='nxminykuadrat_dosen' ");


if($set_update_jml==1){
//echo "<br/>Baris nxminykuadrat telah diupdate";
}else {
	//echo "<br/>Baris nxminykuadrat gagal diupdate";
}

?>
	
		<!--
		<br/>-Membuat baris Rxy, menghitung dan mengisi kriterianya
		
		<br/> jumlah baris rxy saat ini:	
		
		<?php
		

$jmlbaristotal = mysqli_query($kon,"select Count(*) from dosen_ujicoba where kode_responden='rxy'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"insert into dosen_ujicoba set kode_responden='rxy'");

if($buat_baris_total==1){
//echo "<br/>baris rxy sudah diinsert";
}else {
	//echo "<br/>baris rxy seharusnya sudah diinsert, tapi gagal";
}


}	else{
	
	//echo "<br/>baris rxy sudah ada";

	//disini kasih query update yang ber looping, karena diatas gak bisa ditaruh looping. Kayaknya gak perlu deh,
	
	
}	
		?>
		
		
		
			<?php 
			
			
$loop=1;

//looping 25x
while ($loop<=$jml_pert_dosen ) {

$loop_string=(string)$loop;


$kolomqmsekarang="qd".''.$loop_string;

	

//mengambil nilai nxminxkuadrat
$ambilnilaixy=mysqli_query($kon,"select * from dosen_ujicoba where kode_responden='nxminxkuadrat'");
$nilaixy= mysqli_fetch_object($ambilnilaixy);
$tampungnilainxminxkuadrat=$nilaixy->$kolomqmsekarang;


//mengambil nilai nxminykuadrat_dosen;
$ambilnilaiqm=mysqli_query($kon,"select * from setting where nama='nxminykuadrat_dosen'");
$nilaiqm= mysqli_fetch_object($ambilnilaiqm);
$tampungnilainxminykuadrat_dosen=$nilaiqm->ketentuan;


//lakukan perhitungan 1
$hitingsiti=$tampungnilainxminxkuadrat*$tampungnilainxminykuadrat_dosen;

//lakukan perhitungan 2
$hitingdiwi=sqrt($hitingsiti);



//mengambil nilai nxminxy;
$ambilnilaiqm=mysqli_query($kon,"select * from dosen_ujicoba where kode_responden='nxyminxy'");
$nilaiqm= mysqli_fetch_object($ambilnilaiqm);
$tampungnilainxminykuadrat_dosen=$nilaiqm->$kolomqmsekarang;


//lakukan perhitungan 3
$hitingtigi=$tampungnilainxminykuadrat_dosen/$hitingdiwi;


//set updte jumlah
$set_update_jml = mysqli_query($kon,"update dosen_ujicoba set $kolomqmsekarang='$hitingtigi' where kode_responden='rxy' ");


if($hitingtigi>0.312){
	$set_update_valid = mysqli_query($kon,"update butir_pertanyaan_dosen set validitas='Valid' where kode_pertanyaan='$kolomqmsekarang' ");
	//echo $kolomqmsekarang;
	//echo ' valid';
}else{
	$set_update_tidakvalid = mysqli_query($kon,"update butir_pertanyaan_dosen set validitas='Tidak Valid' where kode_pertanyaan='$kolomqmsekarang' ");
	//echo $kolomqmsekarang;
	//echo ' tidak valid';
	
}

if($set_update_jml==1){
//echo "<br/>Baris rxy telah diupdate";
}else {
	//echo "<br/>Baris rxy gagal diupdate";
}

$loop++;

}
?>

<!--
	
		<br/>-membuat baris varian dan mengisinya
		
		
		<br/> jumlah baris varian saat ini:	
		
		<?php
		

$jmlbaristotal = mysqli_query($kon,"select Count(*) from dosen_ujicoba where kode_responden='varian'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"insert into dosen_ujicoba set kode_responden='varian'");

if($buat_baris_total==1){
//echo "<br/>baris varian sudah diinsert";
}else {
	//echo "<br/>baris varian seharusnya sudah diinsert, tapi gagal";
}


}	else{
	
	//echo "<br/>baris varian sudah ada";

	
	
}	
		?>
		
		
		
			<?php 
			
			

$loop=1;
$tutalvarian=0;

//looping 25x
while ($loop<=$jml_pert_dosen ) {

$loop_string=(string)$loop;


$kolomqmsekarang="qd".''.$loop_string;
$x2qdnow="x2qd".''.$loop_string;
	

//mengambil nilai totalqmloop
$ambilnilaixy=mysqli_query($kon,"select * from dosen_ujicoba where kode_responden='total'");
$nilaixy= mysqli_fetch_object($ambilnilaixy);
$totalqmlooph=$nilaixy->$kolomqmsekarang;

$totalqmloop=$totalqmlooph*$totalqmlooph;

$hytung1=$totalqmloop/$angkasampeldosen;

//mengambil nilai x2qdloop;
$ambilnilaiqm=mysqli_query($kon,"select * from dosen_ujicoba where kode_responden='total'");
$nilaiqm= mysqli_fetch_object($ambilnilaiqm);
$x2qdloop=$nilaiqm->$x2qdnow;

$hytung2=$x2qdloop-$hytung1;

$hytung3=$hytung2/$angkasampeldosen;

//set updte jumlah
$set_update_jml = mysqli_query($kon,"update dosen_ujicoba set $kolomqmsekarang='$hytung3' where kode_responden='varian' ");


if($set_update_jml==1){
//echo "<br/>Baris varian telah diupdate. Nilai: ";
//echo $hytung3;
}else {
	//echo "<br/>Baris varian gagal diupdate";
}


$tutalvarian=$tutalvarian+$hytung3;


$loop++;



}


//udate total varian

$updatetutalvarian = mysqli_query($kon,"update dosen_ujicoba set jml='$tutalvarian' where kode_responden='varian' ");


if($updatetutalvarian==1){
//echo "<br/>tutal varian telah diupdate. Nilai: ";
//echo $tutalvarian;
}else {
	//echo "<br/>tutal varian gagal diupdate";
}

?>
		
		
<!--
		
		<br/>-membuat 1 baris varian total dan mengisinya ke setting
		
		
				<br/> jumlah baris totalvarian_dosen saat ini:	
				
		<?php
		

$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='totalvarian_dosen'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"insert into setting set nama='totalvarian_dosen'");

if($buat_baris_total==1){
//echo "<br/>baris totalvarian sudah diinsert";
}else {
	//echo "<br/>baris totalvarian seharusnya sudah diinsert, tapi gagal";
}


}	else{
	
	//echo "<br/>baris totalvarian sudah ada";

	
	
}	
		?>
		
		
		
			<?php 
			
			



	

//mengambil nilai datatotaljml
$ambilnilaixy=mysqli_query($kon,"select * from dosen_ujicoba where kode_responden='total'");
$nilaixy= mysqli_fetch_object($ambilnilaixy);
$datatotaljml=$nilaixy->jml;

//mengkuadratkan datatotaljml
$datatotaljmlkuadrat=$datatotaljml*$datatotaljml;

//mengkuadratkan datatotaljmldibagisampel
$datatotaljmlkuadratdibagisampel=$datatotaljmlkuadrat/$angkasampeldosen;

//mengambil nilai totaljmlxdua;
$ambilnilaiqm=mysqli_query($kon,"select * from dosen_ujicoba where kode_responden='total'");
$nilaiqm= mysqli_fetch_object($ambilnilaiqm);
$totaljmlxdua=$nilaiqm->jmlx2;

//perhitungan nilai pulupulu
$pulupulu=$totaljmlxdua-$datatotaljmlkuadratdibagisampel;

//perhitungan nilai resulto
$resulto=$pulupulu/$angkasampeldosen;



//set updte jumlah
$set_update_totalvarian = mysqli_query($kon,"update setting set ketentuan='$resulto' where nama='totalvarian_dosen' ");


if($set_update_totalvarian==1){
//echo "<br/>Baris totalvarian telah diupdate. Nilai: ";
//echo $resulto;
}else {
	//echo "<br/>Baris totalvarian gagal diupdate";
}

?>
		<!--
	
		<br/>-membuat baris reliabilitas_dosen, kategori di setting dan mengisinya
		
				<br/> jumlah baris reliabilitas_dosen saat ini:	
				
				
		<?php
		

$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='reliabilitas_dosen'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"insert into setting set nama='reliabilitas_dosen'");

if($buat_baris_total==1){
//echo "<br/>baris reliabilitas_dosen sudah diinsert";
}else {
	//echo "<br/>baris reliabilitas_dosen seharusnya sudah diinsert, tapi gagal";
}


}	else{
	
	//echo "<br/>baris reliabilitas_dosen sudah ada";

	
	
}	


//mengecek baris kategori di setting

$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='kategori_reliabilitasdosen'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"insert into setting set nama='kategori_reliabilitasdosen'");

if($buat_baris_total==1){
//echo "<br/>baris kategori_reliabilitasdosen sudah diinsert";
}else {
	//echo "<br/>baris kategori_reliabilitasdosen seharusnya sudah diinsert, tapi gagal";
}


}	else{
	
	//echo "<br/>baris kategori_reliabilitasdosen sudah ada";

	
	
}	





		?>
		
		
		
			<?php 
			
			



//mengkuadratkan datatotaljml
$hitong1=$jml_pert_dosen-1;

//mengkuadratkan datatotaljmldibagisampel
$hitong2=$jml_pert_dosen/$hitong1;

//mengambil nilai varianjumlo;
$ambilnilaiqm=mysqli_query($kon,"select * from dosen_ujicoba where kode_responden='varian'");
$nilaiqm= mysqli_fetch_object($ambilnilaiqm);
$varianjumlo=$nilaiqm->jml;

//mengambil nilai varianjumlomhs;
$ambilnilaiqm=mysqli_query($kon,"select * from setting where nama='totalvarian_dosen'");
$nilaiqm= mysqli_fetch_object($ambilnilaiqm);
$varianjumlomhs=$nilaiqm->ketentuan;

//perhitungan nilai pulupulu
$hitong3=$varianjumlo/$varianjumlomhs;

//perhitungan nilai pulupulu
$hitong4=1-$hitong3;

//perhitungan nilai resulto
$resultohhh=$hitong2*$hitong4;


if($resultohhh>0&&$resultohhh<0.2){
	$kategori='Sangat Rendah';
}else if($resultohhh>0.2&&$resultohhh<0.4){
	$kategori='Rendah';
}else if($resultohhh>0.4&&$resultohhh<0.7){
	$kategori='Sedang';
}else if($resultohhh>0.7&&$resultohhh<0.9){
	$kategori='Tinggi';
}else if($resultohhh>0.9&&$resultohhh<1){
	$kategori='Sangat Tinggi';
}

//echo 'kategori reliabilitas: ';
//echo $kategori;

//set updte jumlah
$set_update_totalvarian = mysqli_query($kon,"update setting set ketentuan='$resultohhh' where nama='reliabilitas_dosen' ");


if($set_update_totalvarian==1){
//echo "<br/>Baris totalvarian telah diupdate. Nilai: ";
//echo $resultohhh;
}else {
	//echo "<br/>Baris totalvarian gagal diupdate";
}


//set updte kategori
$set_update_kategori = mysqli_query($kon,"update setting set ketentuan='$kategori' where nama='kategori_reliabilitasdosen' ");


if($set_update_kategori==1){
//echo "<br/>Baris kategori telah diupdate. Nilai: ";
//echo $kategori;
}else {
	//echo "<br/>Baris kategori gagal diupdate";
}

?>




-->

<!--
DIBAWAH INI ADALAH KODE UNTUK MENYIAPKAN DATABASE MHS, DOSEN DAN ADMIN DENGAN MENYEDIAKAN KOLOM HANYA UNTUK PERTANYAAN YANG VALID SAJA
-->
<?php

				$query_jml_pertanyaan_mhs = mysqli_query($kon,"select Count(*) as totalper_mhs from butir_pertanyaan_mhs");
				$jml_per_mhs= mysqli_fetch_assoc($query_jml_pertanyaan_mhs);
				$jml_pert_mhs=implode($jml_per_mhs);
				
				//echo "jumlah pertanyaan mhs (termasuk yang tidak valid) adalah sebanyak: ";
				//echo $jml_pert_mhs;
				//echo "<br/>";
				
?>
<!--
2. Membuat tabel mhs<br/>
-->
<?php

//tabel mhs dibuat untuk menampung pertanyaan pada saat analisis utama, dengan hanya menenrima nilai dari pertanyaan yag valid

$buat_tabel_mhs="CREATE TABLE `mhs` (`kode_responden` varchar(30),`waktu` varchar(30),`nama` varchar(40),`nim` varchar(20),`semester` int(5),`jurusan` varchar(40),`prodi` varchar(40))";
$eksekyut2=mysqli_query($kon,$buat_tabel_mhs);
if ($tawuraja=$eksekyut2){
				//echo "Tabel mhs telah dengan sebagian kolom telah dibuat";
				//echo "<br/>";
				
}else {
	//echo "Tabel mhs telah dengan sebagian kolom telah dibuat";
	//echo "<br/>";
	
}

?>
<!--
3. Membuat kolom qm dalam tabel mhs dengan hanya pertanyaan yang valid saja<br/>
-->
<?php

$looping=1;

while ($looping<=$jml_pert_mhs){
	
	
$seleksipertanyaanini="qm".''.$looping;
//echo "<br/>menyeleksi pertanyaan mhs saat ini:";
//echo $seleksipertanyaanini;

$pilihpertanyaan=mysqli_query($kon,"select * from butir_pertanyaan_mhs where kode_pertanyaan='$seleksipertanyaanini'");
$pertanyaanterpilih= mysqli_fetch_object($pilihpertanyaan);
$statuspertanyaan=$pertanyaanterpilih->validitas;

//echo "status pertanyaan saat ini adalah: ";
//echo $statuspertanyaan;

if($statuspertanyaan=='Valid'){
	
	
	//jika pertanyaan valid, maka akan dibuat kolom pertanyaan yang bersangkutan di tabel mhs
	
	
		//atlertable
	$buatkolomtotal="alter table mhs add $seleksipertanyaanini varchar(20)";
	$eksekyut2=mysqli_query($kon,$buatkolomtotal);
	if ($b2=$eksekyut2){
	//			echo "Kolom pertanyaan telah dibuat";
		//		echo "<br/>";
				
				}	else{
	
			//	echo "<br/>kolom pertanyaan gagal";
				}
					
	
}
	
	$looping++;
}
?>

<!--

4. Membuat kolom sisa setelah kolom pertanyaan, untuk tabel mhs<br/>

-->

	<?php
	$buatkolomsisa="alter table mhs add qm_terbuka varchar(1000)";
	$eksekyut2=mysqli_query($kon,$buatkolomsisa);
	//$buatkolomemail="alter table mhs add email varchar(20)";
	//$eksekyut3=mysqli_query($kon,$buatkolomemail);
	if ($b2=$eksekyut2){
	//			echo "Kolom sisa untuk tabel mhs telah dibuat";
		//		echo "<br/>";
				
				}	else{
	
			//	echo "<br/>kolom sisa untuk tabel mhs gagal dibuat";
				}
				
				?>
				<!--
<br/>UNTUK RESPONDEN DOSEN<br/>
1. Me-load jumlah semua pertanyaan dosen dari database<br/>
-->
<?php

				$query_jml_pertanyaan_dosen = mysqli_query($kon,"select Count(*) as totalper_dosen from butir_pertanyaan_dosen");
				$jml_per_dosen= mysqli_fetch_assoc($query_jml_pertanyaan_dosen);
				$jml_pert_dosen=implode($jml_per_dosen);
				
		//		echo "jumlah pertanyaan dosen (termasuk yang tidak valid) adalah sebanyak: ";
			//	echo $jml_pert_dosen;
				//echo "<br/>";
				
?>

<!--
2. Membuat tabel dosen<br/>
-->
<?php

//tabel mhs dibuat untuk menampung pertanyaan pada saat analisis utama, dengan hanya menenrima nilai dari pertanyaan yag valid


$buat_tabel_dosen="CREATE TABLE `dosen` (`kode_responden` varchar(30),`waktu` varchar(30),`nama` varchar(40),`nip` varchar(30),`jurusan` varchar(30),`prodi` varchar(50),`usia` int(5))";
$eksekyut2=mysqli_query($kon,$buat_tabel_dosen);
if ($tawuraja=$eksekyut2){
			//	echo "Tabel dosen telah dengan sebagian kolom telah dibuat";
				//echo "<br/>";
				
}else {
	//echo "Tabel dosen telah dengan sebagian kolom telah dibuat";
	//echo "<br/>";
	
}

?>

<!--
3. Membuat kolom qd dalam tabel dosen dengan hanya pertanyaan yang valid saja<br/>
-->
<?php

$looping=1;

while ($looping<=$jml_pert_dosen){
	
	
$seleksipertanyaanini="qd".''.$looping;
//echo "<br/>menyeleksi pertanyaan mhs saat ini:";
//echo $seleksipertanyaanini;

$pilihpertanyaan=mysqli_query($kon,"select * from butir_pertanyaan_dosen where kode_pertanyaan='$seleksipertanyaanini'");
$pertanyaanterpilih= mysqli_fetch_object($pilihpertanyaan);
$statuspertanyaan=$pertanyaanterpilih->validitas;

//echo "status pertanyaan saat ini adalah: ";
//echo $statuspertanyaan;

if($statuspertanyaan=='Valid'){
	
	
	//jika pertanyaan valid, maka akan dibuat kolom pertanyaan yang bersangkutan di tabel mhs
	
	
	
	//atlertable
	$buatkolomtotal="alter table dosen add $seleksipertanyaanini varchar(20)";
	$eksekyut2=mysqli_query($kon,$buatkolomtotal);
	if ($b2=$eksekyut2){
//				echo "Kolom pertanyaan telah dibuat";
	//			echo "<br/>";
				
				}	else{
	
		//		echo "<br/>kolom pertanyaan gagal";
				}
					
	
}
	
	$looping++;
}
?>

<!--
4. Membuat kolom sisa setelah kolom pertanyaan, untuk tabel mhs<br/>
-->
	<?php
	$buatkolomsisa="alter table dosen add qd_terbuka varchar(1000)";
	$eksekyut2=mysqli_query($kon,$buatkolomsisa);
	//$buatkolomemail="alter table dosen add email varchar(20)";
	//$eksekyut3=mysqli_query($kon,$buatkolomemail);
	if ($b2=$eksekyut2){
	//			echo "Kolom sisa untuk tabel dosen telah dibuat";
		//		echo "<br/>";
				
				}	else{
	
		//		echo "<br/>kolom sisa untuk tabel dosen gagal dibuat";
				}
				
				?>
			
<!--			
				<br/> UNTUK RESPONDEN ADMIN
				1. Me-load banyaknya jumla pertanyaan admin<br/>
	-->			
				<?php
				
				$query_jml_pertanyaan_admin = mysqli_query($kon,"select Count(*) as totalper_admin from butir_pertanyaan_admin");
				$jml_per_admin= mysqli_fetch_assoc($query_jml_pertanyaan_admin);
				$jml_pert_admin=implode($jml_per_admin);
				
		//		echo "jumlah pertanyaan admin (termasuk yang tidak valid) adalah sebanyak: ";
			//	echo $jml_pert_admin;
				//echo "<br/>";
				
				?>
		<!--		
				2. Membuat tabel admin<br/>
				-->
<?php

//tabel mhs dibuat untuk menampung pertanyaan pada saat analisis utama, dengan hanya menenrima nilai dari pertanyaan yag valid


$buat_tabel_admin="CREATE TABLE `admin` (`kode_responden` varchar(30),`waktu` varchar(30),`nama` varchar(40),`jurusan` varchar(30),`prodi` varchar(50))";
$eksekyut2=mysqli_query($kon,$buat_tabel_admin);
if ($tawuraja=$eksekyut2){
			//	echo "Tabel admin telah dengan sebagian kolom telah dibuat";
				//echo "<br/>";
				
}else {
	//echo "Tabel admin telah dengan sebagian kolom telah dibuat";
	//echo "<br/>";
	
}

?>

<!--
3. Membuat kolom qa dalam tabel admin dengan hanya pertanyaan yang valid saja<br/>
-->
<?php

$looping=1;

while ($looping<=$jml_pert_admin){
	
	
$seleksipertanyaanini="qa".''.$looping;
//echo "<br/>menyeleksi pertanyaan admin saat ini:";
//echo $seleksipertanyaanini;

	
	
	//jika pertanyaan valid, maka akan dibuat kolom pertanyaan yang bersangkutan di tabel mhs
	
	
		
	//atlertable
	$buatkolomtotal="alter table admin add $seleksipertanyaanini varchar(20)";
	$eksekyut2=mysqli_query($kon,$buatkolomtotal);
	if ($b2=$eksekyut2){
			//	echo "Kolom pertanyaan telah dibuat";
				//echo "<br/>";
				
				}	else{
	
				//echo "<br/>kolom pertanyaan gagal";
				}
					
	

	
	$looping++;
}
?>

<!--
4. Membuat kolom sisa setelah kolom pertanyaan, untuk tabel mhs<br/>

-->

	<?php
	$buatkolomsisa="alter table admin add qa_terbuka varchar(1000)";
	$eksekyut2=mysqli_query($kon,$buatkolomsisa);
	//$buatkolomemail="alter table admin add email varchar(20)";
	//$eksekyut3=mysqli_query($kon,$buatkolomemail);
	if ($b2=$eksekyut2){
			//	echo "Kolom sisa untuk tabel admin telah dibuat";
				//echo "<br/>";
				
				}	else{
	
				//echo "<br/>kolom sisa untuk tabel admin gagal dibuat";
				}
				
				?>
				

<?php

//INI ADALAH KODE UNTUK MEN-SET BAHWA VALIDITAS DAN RELIABILITAS SUDAH DILAKUKAN. SEHINGGA NANTINYA USER LANGSUNG DIREDIRECT KE ALAMAT INI, GAPERLU PENCET TOMBOL LAGI



$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='prosesvaliditasreliabilitas'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);
//echo $angkatotal;					

if ($angkatotal==0){

$buat_baris_total = mysqli_query($kon,"INSERT INTO `setting`(`nama`, `ketentuan`) VALUES ('prosesvaliditasreliabilitas','sudah')");

if($buat_baris_total==1){
//echo "<br/>baris validitas sudah diinsert";
}else {
	//echo "<br/>status pengaturan validitas seharusnya sudah diinsert, tapi gagal";
	
}


}	else{
	
	//echo "<br/>status pengaturan validitas sudah ada";

	
	$set_update_jml = mysqli_query($kon,"update setting set ketentuan='sudah' where nama='prosesvaliditasreliabilitas' ");

if($set_update_jml==1){
//echo "<br/>status pengaturan validitas telah diupdate";
}else {
	//echo "<br/>status pengaturan validitas gagal diupdate";
}
	
	
	//kosong
	
	
}	


?>








<!-- INI ADALAH BATAS ANTARA DUNIA CODING. YANG ATAS PERHITUNGAN, YANG BAWAH TAMPILANNN -->




		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
				<div class="p-4">
		  		<h1 align='center'><a href="index.php" class="logo">Si Aning <span>Sistem Analisis Kesiapan E-learning</span></a></h1>
	        <ul class="list-unstyled components mb-5">
			 <?php
				
				$menuatursampel='
	          <li>
	            <a href="index-researcher.php"><span class="fa fa-home mr-3"></span> Atur Sampel</a>
	          </li>';
			  $menukelolabutirpertanyaan='
	          <li>
	              <a href="kelola_pertanyaan.php"><span class="fa fa-user mr-3"></span> Kelola Butir Pertanyaan</a>
	          </li>';
			  $menuvaliditasreliabilitas='
	          <li  class="active">
              <a href="tentukan_sampel_ujicoba.php"><span class="fa fa-briefcase mr-3"></span> Pengujian Validitas dan Reliabilitas</a>
	          </li>';
			  $menupenelitianutama='
	          <li>
              <a href="#"><span class="fa fa-sticky-note mr-3"></span> Penelitian Utama</a>
	          </li>';
			  $menuhasilanalisisutama='
	          <li>
              <a href="#"><span class="fa fa-suitcase mr-3"></span> Hasil Analisis Penelitian</a>
	          </li>';
			  
			  if($statusku=='pimpinan'){
				  echo $menuatursampel;
				  echo $menuhasilanalisisutama;
			  }else if ($statusku=='peneliti'){
				  echo $menukelolabutirpertanyaan;
				  echo $menuvaliditasreliabilitas;
				  //echo $menupenelitianutama;
				  echo $menuhasilanalisisutama;
				  
			  }
			  
			  ?>
			  
			  
			  
			  <li>
              <a href="logout.php"><span class="fa fa-cogs mr-3"></span> Logout (<?php echo $_SESSION['username']?>)</a>
	          </li>
	        </ul>

	        

	        <div class="footer">
	        	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> <br/> Made by Hbb
						  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
	        </div>

	      </div>
    	</nav>

        <!-- Page Content  -->
		<?php
				$jumlahpertmhs = mysqli_query($kon,"select Count(*) from butir_pertanyaan_mhs");
				//$query_jml_total_mhs=mysqli_query($kon,"select * from jml_sampel_mhs where kode_jur='total'");
				$data_jmlpertmhs = mysqli_fetch_assoc($jumlahpertmhs);
				$data_jmlpertmhs=implode($data_jmlpertmhs);
				//echo $data_jmlpertmhs;
				
				$jumlahpertdosen = mysqli_query($kon,"select Count(*) from butir_pertanyaan_dosen");
				//$query_jml_total_mhs=mysqli_query($kon,"select * from jml_sampel_mhs where kode_jur='total'");
				$data_jmlpertdosen = mysqli_fetch_assoc($jumlahpertdosen);
				$data_jmlpertdosen=implode($data_jmlpertdosen);
				
				$query_jml_sampel_ujidosen=mysqli_query($kon,"select * from setting where nama='jml_sampeluji_dosen'");
				$jml_dosen_uji = mysqli_fetch_object($query_jml_sampel_ujidosen);
				$angkasampeldosen=$jml_dosen_uji->ketentuan;
				
				$query_jml_sampel_uji=mysqli_query($kon,"select * from setting where nama='jml_sampeluji_mhs'");
				$jml_mhs_uji = mysqli_fetch_object($query_jml_sampel_uji);
				$angkasampelmhs=$jml_mhs_uji->ketentuan;

				
			?>
      <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4" align="center">Uji Validitas dan Reliabilitas</h2>
		<p align="justify"> Berdasarkan uji validitas dan reliabilitas terhadap <?php echo $angkasampelmhs?> sampel uji coba mahasiswa dan <?php echo $angkasampelmhs?> dosen, didapatkan nilai validitas dan reliabilitas sebagai berikut.</p>
        <br/>
		<h6 align="center">Sampel Uji Coba Mahasiswa</h6>
		
			
		
		<br/>
			<center>
			<!--<form id="atur_total_mhs" method="post" action="atur_total_mhs.php">-->
			<label for="">Jumlah Pertanyaan Responden Mahasiswa: <?php echo $data_jmlpertmhs ?></label>
			<!--
			<input type="number" name="total_populasi_mhs" class="total" value="">
			
			
			
			&nbsp;&nbsp;&nbsp;
			
			<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal<?php echo $total ?>"><i class="fa fa-pencil"></i></button>
			-->
			
			</center>
								
			
			
			
			<!--
			<input type="submit" id="submit" value="Ubah">
			-->
			</form>
			
			<br/>
			
				<table class="table table-stripped table-hovered">
			<tr>
				<td>No</td>
				<td>Kode Pertanyaan</td>
				<td>Variabel</td>
				<td>Konstruk</td>
				<td>Pertanyaan</td>
				<td>Validitas</td>
			</tr> 
			
			<?php
				$no = 0;
				$query_jml_mhs=mysqli_query($kon,"select * from butir_pertanyaan_mhs");
				while($dt = mysqli_fetch_object($query_jml_mhs)){
					$no++;
			?>
			
			<tr>
				<td><?php echo $no ?></td>
				<td><?php 
				
				echo $dt->kode_pertanyaan ?></td>
				<td><?php echo $dt->variabel ?></td>
				<td><?php echo $dt->konstruk ?></td>
				<td><?php echo $dt->pertanyaan ?></td>
				<td><?php echo $dt->validitas ?></td>

				
				
			<?php
				
				}
			?>
			
			</tr>
			<td colspan=6 align='center'>
			Nilai Reliabilitas: 
				<?php
				
				$queryreliabilitasmhs=mysqli_query($kon,"select * from setting where nama='reliabilitas_mhs'");
				$reliabilitasmhs = mysqli_fetch_object($queryreliabilitasmhs);
				echo $reliabilitasmhs->ketentuan
				?>
				
				(
				<?php
				
				$queryreliabilitasmhs=mysqli_query($kon,"select * from setting where nama='kategori_reliabilitasmhs'");
				$reliabilitasmhs = mysqli_fetch_object($queryreliabilitasmhs);
				echo $reliabilitasmhs->ketentuan
				?>
				)
			</td>
			
			</table> 
		
		
		 <br/>
		<h6 align="center">Sampel Uji Coba Dosen</h6>
		
			
		
		<br/>
			<center>
			<!--<form id="atur_total_mhs" method="post" action="atur_total_mhs.php">-->
			<label for="">Jumlah Pertanyaan Responden Dosen: <?php echo $data_jmlpertdosen ?></label>
			<!--
			<input type="number" name="total_populasi_mhs" class="total" value="">
			
			
			
			&nbsp;&nbsp;&nbsp;
			
			<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal<?php echo $total ?>"><i class="fa fa-pencil"></i></button>
			-->
			
			</center>
								
			
			
			
			<!--
			<input type="submit" id="submit" value="Ubah">
			-->
			</form>
			
			<br/>
			
				<table class="table table-stripped table-hovered">
			<tr>
				<td>No</td>
				<td>Kode Pertanyaan</td>
				<td>Variabel</td>
				<td>Konstruk</td>
				<td>Pertanyaan</td>
				<td>Validitas</td>
			</tr> 
			
			<?php
				$no = 0;
				$query_jml_mhs=mysqli_query($kon,"select * from butir_pertanyaan_dosen");
				while($dt = mysqli_fetch_object($query_jml_mhs)){
					$no++;
			?>
			
			<tr>
				<td><?php echo $no ?></td>
				<td><?php 
				
				echo $dt->kode_pertanyaan ?></td>
				<td><?php echo $dt->variabel ?></td>
				<td><?php echo $dt->konstruk ?></td>
				<td><?php echo $dt->pertanyaan ?></td>
				<td><?php echo $dt->validitas ?></td>

				
				<td>
					
				</td>

			<?php
				
				}
			?>
			
			</tr>
			<td colspan=6 align='center'>
			Nilai Reliabilitas: 
				<?php
				
				$queryreliabilitasmhs=mysqli_query($kon,"select * from setting where nama='reliabilitas_dosen'");
				$reliabilitasmhs = mysqli_fetch_object($queryreliabilitasmhs);
				echo $reliabilitasmhs->ketentuan
				?>
				
				(
				<?php
				
				$queryreliabilitasmhs=mysqli_query($kon,"select * from setting where nama='kategori_reliabilitasdosen'");
				$reliabilitasmhs = mysqli_fetch_object($queryreliabilitasmhs);
				echo $reliabilitasmhs->ketentuan
				?>
				)
			</td>
			
			</table> 
			
			<!--
		<center>
		<button class="btn btn-primary" onclick="showForm()"> Lanjutkan ke Penelitian Utama !</button>		
		</center>
		-->
		
		<center>
		
		
		<form action="penelitian_utama.php" method="post">
		<button class="btn btn-primary"> Lanjutkan ke Penelitian Utama !</button>		
		</center>
		</form>
		
		
		</div>
		</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>
</html>
