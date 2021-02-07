<?php include 'koneksi.php'; 
set_time_limit(240);
?>
<html>
<head>
   
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

</body>
</html>

