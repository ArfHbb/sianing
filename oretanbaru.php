<?php include 'koneksi.php'; 

		?>
			
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no, initial-scale=1, maximum-scale=1,minimum-scale=1, height=device-height,target-densitydpi+device-dpi">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Convert pertanyaan </title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
</head>
<body>
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
	
	
	//$pilihnilaitotal=mysqli_query($kon,"select * from butir_pertanyaan_mhs where kode_responden='total'");
	//$nilaiterpilih= mysqli_fetch_object($pilihnilaitotal);
	//$nilaitotal=$nilaiterpilih->$seleksipertanyaanini;
	
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
	$buatkolomemail="alter table mhs add email varchar(20)";
	$eksekyut3=mysqli_query($kon,$buatkolomemail);
	if ($b2=$eksekyut2&&$b2=$eksekyut3){
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
	
	
	//$pilihnilaitotal=mysqli_query($kon,"select * from butir_pertanyaan_mhs where kode_responden='total'");
	//$nilaiterpilih= mysqli_fetch_object($pilihnilaitotal);
	//$nilaitotal=$nilaiterpilih->$seleksipertanyaanini;
	
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
	$buatkolomemail="alter table dosen add email varchar(20)";
	$eksekyut3=mysqli_query($kon,$buatkolomemail);
	if ($b2=$eksekyut2&&$b2=$eksekyut3){
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
	
	
	//$pilihnilaitotal=mysqli_query($kon,"select * from butir_pertanyaan_mhs where kode_responden='total'");
	//$nilaiterpilih= mysqli_fetch_object($pilihnilaitotal);
	//$nilaitotal=$nilaiterpilih->$seleksipertanyaanini;
	
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
	$buatkolomemail="alter table admin add email varchar(20)";
	$eksekyut3=mysqli_query($kon,$buatkolomemail);
	if ($b2=$eksekyut2&&$b2=$eksekyut3){
			//	echo "Kolom sisa untuk tabel admin telah dibuat";
				//echo "<br/>";
				
				}	else{
	
				//echo "<br/>kolom sisa untuk tabel admin gagal dibuat";
				}
				
				?>
				
</body>
</html>