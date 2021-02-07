<?php
include 'koneksi.php'; 
	extract($_POST);
	if(isset($_POST['lihat'])){
		
		$kode_jurusan_now=$jurusan_now;
		
		$ambilnilaivalid=mysqli_query($kon,"select * from jurusan where kode_jurusan='$kode_jurusan_now'");
		$hasilnilaivalid= mysqli_fetch_object($ambilnilaivalid);
		$jurusan_now=$hasilnilaivalid->jurusan;
		
		//echo $kode_jurusan_now;
		//echo $jurusan_now;
		
	}
	
	?>
	
	
	
	
	<?php 
session_start();
if(! isset($_SESSION['is_login']))
{
  header('location:login.php');
}

	
	
	////echo $_SESSION['password'];
	
$username=$_SESSION['username'];

$querystatus=mysqli_query($kon,"select * from login where username='$username'");
$belumdipanah = mysqli_fetch_object($querystatus);
$statusku=$belumdipanah->status;



?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Hasil Analisis Spesifik Jurusan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
  </head>
  <body>
		
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
	          <li>
              <a href="tentukan_sampel_ujicoba.php"><span class="fa fa-briefcase mr-3"></span> Pengujian Validitas dan Reliabilitas</a>
	          </li>';
			  $menupenelitianutama='
	          <li>
              <a href="#"><span class="fa fa-sticky-note mr-3"></span> Penelitian Utama</a>
	          </li>';
			  $menuhasilanalisisutama='
	          <li class="active">
              <a href="penelitian_utama-onlyview.php"><span class="fa fa-suitcase mr-3"></span> Hasil Analisis Penelitian</a>
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
      <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4" align="center">Hasil Analisis Jurusan <?php echo $jurusan_now; ?> </h2>
		
        
		
		
		<!--
		RESPONDEN MAHASISWA<br/>
		1.Cari jumlah banyaknya sampel utama mahasiswa <br/>-->
		
		<?php
		
		//		$query_jml_sampeljur_bkp=mysqli_query($kon,"select * from jml_sampel_mhs where kode_jur='bkp'");
			//	$sampeljurbkp = mysqli_fetch_object($query_jml_sampeljur_bkp);
				//$jmlsampelbkp=$sampeljurbkp->jml_sampel;

				//$query_jml_sampeljur_kes=mysqli_query($kon,"select * from jml_sampel_mhs where kode_jur='kes'");
				//$sampeljurkes = mysqli_fetch_object($query_jml_sampeljur_kes);
				//$jmlsampelkes=$sampeljurkes->jml_sampel;
					
				//$query_jml_sampeljur_mna=mysqli_query($kon,"select * from jml_sampel_mhs where kode_jur='mna'");
				//$sampeljurmna = mysqli_fetch_object($query_jml_sampeljur_mna);
				//$jmlsampelmna=$sampeljurmna->jml_sampel;
					
				//$query_jml_sampeljur_tnk=mysqli_query($kon,"select * from jml_sampel_mhs where kode_jur='tnk'");
				//$sampeljurtnk = mysqli_fetch_object($query_jml_sampeljur_tnk);
				//$jmlsampeltnk=$sampeljurtnk->jml_sampel;
				
				//$query_jml_sampeljur_pp=mysqli_query($kon,"select * from jml_sampel_mhs where kode_jur='pp'");
				//$sampeljurpp = mysqli_fetch_object($query_jml_sampeljur_pp);
				//$jmlsampelpp=$sampeljurpp->jml_sampel;
					
				//$query_jml_sampeljur_ti=mysqli_query($kon,"select * from jml_sampel_mhs where kode_jur='ti'");
				//$sampeljurti = mysqli_fetch_object($query_jml_sampeljur_ti);
				//$jmlsampelti=$sampeljurti->jml_sampel;
				
				//$query_jml_sampeljur_tp=mysqli_query($kon,"select * from jml_sampel_mhs where kode_jur='tp'");
				//$sampeljurtp = mysqli_fetch_object($query_jml_sampeljur_tp);
				//$jmlsampeltp=$sampeljurtp->jml_sampel;
				
				//$query_jml_sampeljur_teknik=mysqli_query($kon,"select * from jml_sampel_mhs where kode_jur='teknik'");
				//$sampeljurteknik = mysqli_fetch_object($query_jml_sampeljur_teknik);
				//$jmlsampelteknik=$sampeljurteknik->jml_sampel;
	
							
				//$jmlsampelmhs=$jmlsampelbkp+$jmlsampelkes+$jmlsampelmna+$jmlsampeltnk+$jmlsampelpp+$jmlsampelti+$jmlsampeltp+$jmlsampelteknik;
				
				
				////echo "jumlah total semua responden mahasiswa adalah: ";
				////echo $jmlsampelmhs;
				////echo "<br/>";
				?>

				<!--
				1. Buat kolom kesehatan<br/>
				-->
				<?php

$buat_kolom_jml="alter table butir_pertanyaan_mhs add $kode_jurusan_now varchar(20)";
$eksekyut=mysqli_query($kon,$buat_kolom_jml);
if ($b=$eksekyut){
				//echo "Kolom kesehatan telah dibuat";
				//echo "<br/>";
}else {
	//echo "Kolom kesehatan gagal dibuat";
	//echo "<br/>";
	
}
	
		?>
				
				
				
				
			<!--	
		<br/>2.Bikin nilai total untuk setiap pertanyaan<br/>
		-->
<?php
				
				$query_jml_pertanyaan_mhs = mysqli_query($kon,"select Count(*) as totalper_mhs from butir_pertanyaan_mhs");
				$jml_per_mhs= mysqli_fetch_assoc($query_jml_pertanyaan_mhs);
				$jml_pert_mhs=implode($jml_per_mhs);
				
				$loop=1;
				while ($loop<=$jml_pert_mhs) {

				$loop_string=(string)$loop;


				$kolomqmsekarang="qm".''.$loop_string;
				
				//ambil nilai validitasnya, kalau valid maka qm dibuatin baris total
				$ambilnilaivalid=mysqli_query($kon,"select * from butir_pertanyaan_mhs where kode_pertanyaan='$kolomqmsekarang'");
				$hasilnilaivalid= mysqli_fetch_object($ambilnilaivalid);
				$nilaivalid=$hasilnilaivalid->validitas;
				
				if($nilaivalid=='Valid'){
					
					//jumlahnya nilai total dari semua responden terhadap satu pertanyaan
					
					
					$sql=mysqli_query($kon,"select avg($kolomqmsekarang) from mhs where jurusan='$jurusan_now'");
					$avg=mysqli_fetch_assoc($sql);
					$avg=implode($avg);
					
					//echo $kolomqmsekarang;
					//echo ": ";
					//echo $avg;
					//echo "<br/>";
					
					
					
					$set_update_jml = mysqli_query($kon,"update butir_pertanyaan_mhs set $kode_jurusan_now='$avg' where kode_pertanyaan='$kolomqmsekarang' ");

					if($set_update_jml==1){
					////echo "<br/>status pengaturan validitas telah diupdate";
					}else {
					////echo "<br/>status pengaturan validitas gagal diupdate";
					}
					
					
					}
					
					
					
	
						
					
					
					
					$loop++;
				
				
				}
				
				?>
				<!--
				3.Cari banyaknya pertanyaan yang bervariabel teknologi dan berkonstruk sumberdaya
					-->	<?php
				
				//$queryteknologisumberdaya = mysqli_query($kon,"select Count(*) from butir_pertanyaan_mhs where variabel='Teknologi' and konstruk='Sumber Daya' and validitas='Valid'");
				//$hasilqueryteknologisumerdaya=	mysqli_fetch_assoc($queryteknologisumberdaya);
				//$jmldatateknologisumberdaya=implode($hasilqueryteknologisumerdaya);
				
				////echo "<br/>Jumlah banyaknya data untuk variabel teknologi dan konstruk sumberdaya: ";
				////echo $jmldatateknologisumberdaya;
				////echo "<br/>";
				?>
				
				<!--
				<br/>Hasil perhitungan analisis:<br/>
				1. Variabel Teknologi Konstruk Sumber Daya Responden Mahasiswa<br/>
				-->
				
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_mhs where variabel='Teknologi' and konstruk='Sumber Daya' and validitas='Valid'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$teknologisumberdaya_mhs=implode($hasilquerybaru);
					
					//echo $teknologisumberdaya_mhs;
					//echo "<br/>";
				
						?>
						
						<!--
				2. Variabel Teknologi Konstruk Keterampilan Responden Mahasiswa<br/>
				-->
				
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_mhs where variabel='Teknologi' and konstruk='Keterampilan' and validitas='Valid'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$teknologiketerampilan_mhs=implode($hasilquerybaru);
					
					//echo $teknologiketerampilan_mhs;
					//echo "<br/>";
				
						?>
						
						<!--
				3. Variabel Teknologi Konstruk Sikap Responden Mahasiswa<br/>
				-->
				
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_mhs where variabel='Teknologi' and konstruk='Sikap' and validitas='Valid'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$teknologisikap_mhs=implode($hasilquerybaru);
					
					//echo $teknologisikap_mhs;
					//echo "<br/>";
				
						?>
						
						<!--
						4. Variabel Inovasi Konstruk Sumber Daya Responden Mahasiswa<br/>
					-->
				
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_mhs where variabel='Inovasi' and konstruk='Sumber Daya' and validitas='Valid'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$inovasisumberdaya_mhs=implode($hasilquerybaru);
					
					//echo $inovasisumberdaya_mhs;
					//echo "<br/>";
				
						?>
						
						<!--
						5. Variabel Inovasi Konstruk Keterampilan Responden Mahasiswa<br/>
				
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_mhs where variabel='Inovasi' and konstruk='Keterampilan' and validitas='Valid'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$inovasiketerampilan_mhs=implode($hasilquerybaru);
					
					//echo $inovasiketerampilan_mhs;
					//echo "<br/>";
				
						?>
						
						<!--
						6. Variabel Inovasi Konstruk Sikap Responden Mahasiswa<br/>
				
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_mhs where variabel='Inovasi' and konstruk='Sikap' and validitas='Valid'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$inovasisikap_mhs=implode($hasilquerybaru);
					
					//echo $inovasisikap_mhs;
					//echo "<br/>";
				
						?>
						
						<!--
						7. Variabel Manusia Konstruk Sumber Daya Responden Mahasiswa<br/>
				
						-->
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_mhs where variabel='Manusia' and konstruk='Sumber Daya' and validitas='Valid'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$manusiasumberdaya_mhs=implode($hasilquerybaru);
					
					//echo $manusiasumberdaya_mhs;
					//echo "<br/>";
				
						?>
						<!--
						8. Variabel Manusia Konstruk Keterampilan Responden Mahasiswa<br/>
				
						-->
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_mhs where variabel='Manusia' and konstruk='Keterampilan' and validitas='Valid'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$manusiaketerampilan_mhs=implode($hasilquerybaru);
					
					//echo $manusiaketerampilan_mhs;
					//echo "<br/>";
				
						?>
						
						
						<!--
						9. Variabel Pengembangan Diri Konstruk Sumber Daya Responden Mahasiswa<br/>
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_mhs where variabel='Pengembangan Diri' and konstruk='Sumber Daya' and validitas='Valid'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$pengembangandirisumberdaya_mhs=implode($hasilquerybaru);
					
					//echo $pengembangandirisumberdaya_mhs;
					//echo "<br/>";
				
						?>
						<!--
						10. Variabel Pengembangan Diri Konstruk Keterampilan Responden Mahasiswa<br/>
				
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_mhs where variabel='Pengembangan Diri' and konstruk='Keterampilan' and validitas='Valid'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$pengembangandiriketerampilan_mhs=implode($hasilquerybaru);
					
					//echo $pengembangandiriketerampilan_mhs;
					//echo "<br/>";
				
						?>
						
						<!--
						11. Variabel Pengembangan Diri Konstruk Sikap Responden Mahasiswa<br/>
				
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_mhs where variabel='Pengembangan Diri' and konstruk='Sikap' and validitas='Valid'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$pengembangandirisikap_mhs=implode($hasilquerybaru);
					
					//echo $pengembangandirisikap_mhs;
					//echo "<br/>";
				
						?>
						<!--
						<br/><br/>
						
			RESPONDEN DOSEN<br/>
			1. Buat kolom kesehatan<br/>
			
			-->
				<?php

$buat_kolom_jml="alter table butir_pertanyaan_dosen add $kode_jurusan_now varchar(20)";
$eksekyut=mysqli_query($kon,$buat_kolom_jml);
if ($b=$eksekyut){
				//echo "Kolom kesehatan telah dibuat";
				//echo "<br/>";
}else {
	//echo "Kolom kesehatan gagal dibuat";
	//echo "<br/>";
	
}
	
		?>
		<!--
		<br/>2.Bikin nilai total untuk setiap pertanyaan<br/>
		-->
<?php
				
				$query_jml_pertanyaan_dosen = mysqli_query($kon,"select Count(*) as totalper_dosen from butir_pertanyaan_dosen");
				$jml_per_dosen= mysqli_fetch_assoc($query_jml_pertanyaan_dosen);
				$jml_pert_dosen=implode($jml_per_dosen);
				
				$loop=1;
				while ($loop<=$jml_pert_dosen) {

				$loop_string=(string)$loop;


				$kolomqdsekarang="qd".''.$loop_string;
				
				//ambil nilai validitasnya, kalau valid maka qm dibuatin baris total
				$ambilnilaivalid=mysqli_query($kon,"select * from butir_pertanyaan_dosen where kode_pertanyaan='$kolomqdsekarang'");
				$hasilnilaivalid= mysqli_fetch_object($ambilnilaivalid);
				$nilaivalid=$hasilnilaivalid->validitas;
				
				if($nilaivalid=='Valid'){
					
					//jumlahnya nilai total dari semua responden terhadap satu pertanyaan
					
					
					$sql=mysqli_query($kon,"select avg($kolomqdsekarang) from dosen where jurusan='$jurusan_now'");
					$avg=mysqli_fetch_assoc($sql);
					$avg=implode($avg);
					
					//echo $kolomqdsekarang;
					//echo ": ";
					//echo $avg;
					//echo "<br/>";
					
					
					
					$set_update_jml = mysqli_query($kon,"update butir_pertanyaan_dosen set $kode_jurusan_now='$avg' where kode_pertanyaan='$kolomqdsekarang' ");

					if($set_update_jml==1){
					////echo "<br/>status pengaturan validitas telah diupdate";
					}else {
					////echo "<br/>status pengaturan validitas gagal diupdate";
					}
					
					
					}
					
					
					
	
						
					
					
					
					$loop++;
				
				
				}
				
				?>
				<!--
				<br/>Hasil perhitungan analisis:<br/>
				1. Variabel Teknologi Konstruk Sumber Daya Responden Dosen<br/>
				-->
				
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_dosen where variabel='Teknologi' and konstruk='Sumber Daya' and validitas='Valid'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$teknologisumberdaya_dosen=implode($hasilquerybaru);
					
					//echo $teknologisumberdaya_dosen;
					//echo "<br/>";
				
						?>
						
						<!--
				2. Variabel Teknologi Konstruk Keterampilan Responden Dosen<br/>
				-->
				
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_dosen where variabel='Teknologi' and konstruk='Keterampilan' and validitas='Valid'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$teknologiketerampilan_dosen=implode($hasilquerybaru);
					
					//echo $teknologiketerampilan_dosen;
					//echo "<br/>";
				
						?>
						
						<!--
				3. Variabel Teknologi Konstruk Sikap Responden Dosen<br/>
				-->
				
				
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_dosen where variabel='Teknologi' and konstruk='Sikap' and validitas='Valid'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$teknologisikap_dosen=implode($hasilquerybaru);
					
					//echo $teknologisikap_dosen;
					//echo "<br/>";
				
						?>
						<!--
						4. Variabel Inovasi Konstruk Sumber Daya Responden Dosen<br/>
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_dosen where variabel='Inovasi' and konstruk='Sumber Daya' and validitas='Valid'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$inovasisumberdaya_dosen=implode($hasilquerybaru);
					
					//echo $inovasisumberdaya_dosen;
					//echo "<br/>";
				
						?>
						<!--
						5. Variabel Inovasi Konstruk Keterampilan Responden Dosen<br/>
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_dosen where variabel='Inovasi' and konstruk='Keterampilan' and validitas='Valid'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$inovasiketerampilan_dosen=implode($hasilquerybaru);
					
					//echo $inovasiketerampilan_dosen;
					//echo "<br/>";
				
						?>
						<!--
						6. Variabel Inovasi Konstruk Sikap Responden Dosen<br/>
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_dosen where variabel='Inovasi' and konstruk='Sikap' and validitas='Valid'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$inovasisikap_dosen=implode($hasilquerybaru);
					
					//echo $inovasisikap_dosen;
					//echo "<br/>";
				
						?>
						
						<!--
						7. Variabel Manusia Konstruk Sumber Daya Responden Dosen<br/>
						-->
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_dosen where variabel='Manusia' and konstruk='Sumber Daya' and validitas='Valid'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$manusiasumberdaya_dosen=implode($hasilquerybaru);
					
					//echo $manusiasumberdaya_dosen;
					//echo "<br/>";
				
						?>
						
						<!--
						8. Variabel Manusia Konstruk Keterampilan Responden Dosen<br/>
						-->
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_dosen where variabel='Manusia' and konstruk='Keterampilan' and validitas='Valid'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$manusiaketerampilan_dosen=implode($hasilquerybaru);
					
					//echo $manusiaketerampilan_dosen;
					//echo "<br/>";
				
						?>
						
						
						<!--
						9. Variabel Pengembangan Diri Konstruk Sumber Daya Responden Dosen<br/>
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_dosen where variabel='Pengembangan Diri' and konstruk='Sumber Daya' and validitas='Valid'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$pengembangandirisumberdaya_dosen=implode($hasilquerybaru);
					
					//echo $pengembangandirisumberdaya_dosen;
					//echo "<br/>";
				
						?>
						
						<!--
						10. Variabel Pengembangan Diri Konstruk Keterampilan Responden Dosen<br/>
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_dosen where variabel='Pengembangan Diri' and konstruk='Keterampilan' and validitas='Valid'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$pengembangandiriketerampilan_dosen=implode($hasilquerybaru);
					
					//echo $pengembangandiriketerampilan_dosen;
					//echo "<br/>";
				
						?>
						
						<!--
						11. Variabel Pengembangan Diri Konstruk Sikap Responden Dosen<br/>
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_dosen where variabel='Pengembangan Diri' and konstruk='Sikap' and validitas='Valid'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$pengembangandirisikap_dosen=implode($hasilquerybaru);
					
					//echo $pengembangandirisikap_dosen;
					//echo "<br/>";
				
						?>
						
						

						<!--
									RESPONDEN ADMIN<br/>
			1. Buat kolom kesehatan<br/>
			-->
			
				<?php

$buat_kolom_jml="alter table butir_pertanyaan_admin add $kode_jurusan_now varchar(20)";
$eksekyut=mysqli_query($kon,$buat_kolom_jml);
if ($b=$eksekyut){
				//echo "Kolom kesehatan telah dibuat";
				//echo "<br/>";
}else {
	//echo "Kolom kesehatan gagal dibuat";
	//echo "<br/>";
	
}
	
		?>
		
		
		
		<!--
		<br/>2.Bikin nilai total untuk setiap pertanyaan<br/>
		-->
<?php
				
				$query_jml_pertanyaan_admin = mysqli_query($kon,"select Count(*) as totalper_admin from butir_pertanyaan_admin");
				$jml_per_admin= mysqli_fetch_assoc($query_jml_pertanyaan_admin);
				$jml_pert_admin=implode($jml_per_admin);
				
				$loop=1;
				while ($loop<=$jml_pert_admin) {

				$loop_string=(string)$loop;


				$kolomqasekarang="qa".''.$loop_string;
				
				//ambil nilai validitasnya, kalau valid maka qa dibuatin baris total
				$ambilnilaivalid=mysqli_query($kon,"select * from butir_pertanyaan_admin where kode_pertanyaan='$kolomqasekarang'");
				$hasilnilaivalid= mysqli_fetch_object($ambilnilaivalid);
				//$nilaivalid=$hasilnilaivalid->validitas;
				
				//if($nilaivalid=='Valid'){
					
					//jumlahnya nilai total dari semua responden terhadap satu pertanyaan
					
					
					$sql=mysqli_query($kon,"select avg($kolomqasekarang) from admin where jurusan='$jurusan_now'");
					$avg=mysqli_fetch_assoc($sql);
					$avg=implode($avg);
					
					//echo $kolomqasekarang;
					//echo ": ";
					//echo $avg;
					//echo "<br/>";
					
					
					
					$set_update_jml = mysqli_query($kon,"update butir_pertanyaan_admin set $kode_jurusan_now='$avg' where kode_pertanyaan='$kolomqasekarang' ");

					if($set_update_jml==1){
					////echo "<br/>status pengaturan validitas telah diupdate";
					}else {
					////echo "<br/>status pengaturan validitas gagal diupdate";
					}
					
					
					//}
					
					
					
					
					$loop++;
				
				
				}
				
				?>
		
						<!--
				<br/>Hasil perhitungan analisis:<br/>
				1. Variabel Teknologi Konstruk Sumber Daya Responden admin<br/>
				-->
				
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_admin where variabel='Teknologi' and konstruk='Sumber Daya'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$teknologisumberdaya_admin=implode($hasilquerybaru);
					
					//echo $teknologisumberdaya_admin;
					//echo "<br/>";
				
						?>
						
						<!--
				2. Variabel Teknologi Konstruk Keterampilan Responden admin<br/>
					-->
					
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_admin where variabel='Teknologi' and konstruk='Keterampilan'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$teknologiketerampilan_admin=implode($hasilquerybaru);
					
					//echo $teknologiketerampilan_admin;
					//echo "<br/>";
				
						?>
						
						<!--
				3. Variabel Teknologi Konstruk Sikap Responden admin<br/>
					-->
					
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_admin where variabel='Teknologi' and konstruk='Sikap'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$teknologisikap_admin=implode($hasilquerybaru);
					
					//echo $teknologisikap_admin;
					//echo "<br/>";
				
						?>
						<!--
						4. Variabel Inovasi Konstruk Sumber Daya Responden admin<br/>
						-->
				
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_admin where variabel='Inovasi' and konstruk='Sumber Daya'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$inovasisumberdaya_admin=implode($hasilquerybaru);
					
					//echo $inovasisumberdaya_admin;
					//echo "<br/>";
				
						?>
						
						<!--
						5. Variabel Inovasi Konstruk Keterampilan Responden admin<br/>
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_admin where variabel='Inovasi' and konstruk='Keterampilan'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$inovasiketerampilan_admin=implode($hasilquerybaru);
					
					//echo $inovasiketerampilan_admin;
					//echo "<br/>";
				
						?>
						<!--
						6. Variabel Inovasi Konstruk Sikap Responden admin<br/>
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_admin where variabel='Inovasi' and konstruk='Sikap'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$inovasisikap_admin=implode($hasilquerybaru);
					
					//echo $inovasisikap_admin;
					//echo "<br/>";
				
						?>
						<!--
						7. Variabel Manusia Konstruk Sumber Daya Responden admin<br/>
						-->
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_admin where variabel='Manusia' and konstruk='Sumber Daya'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$manusiasumberdaya_admin=implode($hasilquerybaru);
					
					//echo $manusiasumberdaya_admin;
					//echo "<br/>";
				
						?>
						<!--
						8. Variabel Manusia Konstruk Keterampilan Responden admin<br/>
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_admin where variabel='Manusia' and konstruk='Keterampilan'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$manusiaketerampilan_admin=implode($hasilquerybaru);
					
					//echo $manusiaketerampilan_admin;
					//echo "<br/>";
				
						?>
						
						<!--
						
						9. Variabel Pengembangan Diri Konstruk Sumber Daya Responden admin<br/>
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_admin where variabel='Pengembangan Diri' and konstruk='Sumber Daya'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$pengembangandirisumberdaya_admin=implode($hasilquerybaru);
					
					//echo $pengembangandirisumberdaya_admin;
					//echo "<br/>";
				
						?>
						<!--
						10. Variabel Pengembangan Diri Konstruk Keterampilan Responden admin<br/>
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_admin where variabel='Pengembangan Diri' and konstruk='Keterampilan'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$pengembangandiriketerampilan_admin=implode($hasilquerybaru);
					
					//echo $pengembangandiriketerampilan_admin;
					//echo "<br/>";
				
						?>
						<!--
						11. Variabel Pengembangan Diri Konstruk Sikap Responden admin<br/>
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg($kode_jurusan_now) from butir_pertanyaan_admin where variabel='Pengembangan Diri' and konstruk='Sikap'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$pengembangandirisikap_admin=implode($hasilquerybaru);
					
					//echo $pengembangandirisikap_admin;
					//echo "<br/>";
				
						?>
						<center>
						
						
						<table class="table table-stripped table-hovered">
						<tr>
						<td> </td>
						<td align="center"><b>Sumber Daya</b></td>
						<td align="center"><b>Keterampilan</b></td>
						<td align="center"><b>Sikap</b></td>
						<td align="center"><b>Total</b></td>
						</tr>
						<tr>
						<td><b>Teknologi</b></td>
						<td align="center"><?php 
						$teknologisumberdaya=($teknologisumberdaya_mhs+$teknologisumberdaya_dosen+$teknologisumberdaya_admin)/3;
						echo round($teknologisumberdaya,2);
						
						if($teknologisumberdaya>=1&&$teknologisumberdaya<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($teknologisumberdaya>2.6&&$teknologisumberdaya<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($teknologisumberdaya>3.4&&$teknologisumberdaya<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($teknologisumberdaya>4.2&&$teknologisumberdaya<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>
						</td>
						<td align="center"><?php
						$teknologiketerampilan=($teknologiketerampilan_mhs+$teknologiketerampilan_dosen+$teknologiketerampilan_admin)/3;
						echo round($teknologiketerampilan,2);
						
						if($teknologiketerampilan>=1&&$teknologiketerampilan<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($teknologiketerampilan>2.6&&$teknologiketerampilan<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($teknologiketerampilan>3.4&&$teknologiketerampilan<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($teknologiketerampilan>4.2&&$teknologiketerampilan<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>
						</td>
						<td align="center"><?php
						$teknologisikap=($teknologisikap_mhs+$teknologisikap_dosen+$teknologisikap_admin)/3;
						echo round($teknologisikap,2);
						
						if($teknologisikap>=1&&$teknologisikap<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($teknologisikap>2.6&&$teknologisikap<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($teknologisikap>3.4&&$teknologisikap<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($teknologisikap>4.2&&$teknologisikap<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>
						</td>
						<td align="center"><?php
						$totalteknologi=($teknologisumberdaya+$teknologiketerampilan+$teknologisikap)/3;
						echo round($totalteknologi,2);
						
						if($totalteknologi>=1&&$totalteknologi<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($totalteknologi>2.6&&$totalteknologi<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($totalteknologi>3.4&&$totalteknologi<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($totalteknologi>4.2&&$totalteknologi<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
							?>
						</td>
						</tr>
						<tr>
						<td><b>Inovasi</b></td>
						<td align="center"><?php
						$inovasisumberdaya=($inovasisumberdaya_mhs+$inovasisumberdaya_dosen+$inovasisumberdaya_admin)/3;
						echo round($inovasisumberdaya,2);
						
						if($inovasisumberdaya>=1&&$inovasisumberdaya<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($inovasisumberdaya>2.6&&$inovasisumberdaya<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($inovasisumberdaya>3.4&&$inovasisumberdaya<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($inovasisumberdaya>4.2&&$inovasisumberdaya<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>
						</td>
						<td align="center"><?php
						$inovasiketerampilan=($inovasiketerampilan_mhs+$inovasiketerampilan_dosen+$inovasiketerampilan_admin)/3;
						echo round($inovasiketerampilan,2);
						
						if($inovasiketerampilan>=1&&$inovasiketerampilan<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($inovasiketerampilan>2.6&&$inovasiketerampilan<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($inovasiketerampilan>3.4&&$inovasiketerampilan<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($inovasiketerampilan>4.2&&$inovasiketerampilan<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>						
						</td>
						<td align="center"><?php
						$inovasisikap=($inovasisikap_mhs+$inovasisikap_dosen+$inovasisikap_admin)/3;
						echo round($inovasisikap,2);
						
						if($inovasisikap>=1&&$inovasisikap<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($inovasisikap>2.6&&$inovasisikap<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($inovasisikap>3.4&&$inovasisikap<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($inovasisikap>4.2&&$inovasisikap<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>	
						</td>
						<td align="center"><?php
						$totalinovasi=($inovasisumberdaya+$inovasiketerampilan+$inovasisikap)/3;
						echo round($totalinovasi,2);
						
						if($totalinovasi>=1&&$totalinovasi<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($totalinovasi>2.6&&$totalinovasi<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($totalinovasi>3.4&&$totalinovasi<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($totalinovasi>4.2&&$totalinovasi<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
							?>
						</td>
						</tr>
						<tr>
						<td><b>Manusia</b></td>
						<td align="center"><?php
						$manusiasumberdaya=($manusiasumberdaya_mhs+$manusiasumberdaya_dosen+$manusiasumberdaya_admin)/3;
						echo round($manusiasumberdaya,2);
						
						if($manusiasumberdaya>=1&&$manusiasumberdaya<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($manusiasumberdaya>2.6&&$manusiasumberdaya<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($manusiasumberdaya>3.4&&$manusiasumberdaya<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($manusiasumberdaya>4.2&&$manusiasumberdaya<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>
						</td>
						<td align="center"><?php
						$manusiaketerampilan=($manusiaketerampilan_mhs+$manusiaketerampilan_dosen+$manusiaketerampilan_admin)/3;
						echo round($manusiaketerampilan,2);
						
						if($manusiaketerampilan>=1&&$manusiaketerampilan<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($manusiaketerampilan>2.6&&$manusiaketerampilan<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($manusiaketerampilan>3.4&&$manusiaketerampilan<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($manusiaketerampilan>4.2&&$manusiaketerampilan<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>						
						</td>
						<td align="center">-
						</td>
						<td align="center"><?php
						$totalmanusia=($manusiasumberdaya+$manusiaketerampilan)/2;
						echo round($totalmanusia,2);
						
						if($totalmanusia>=1&&$totalmanusia<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($totalmanusia>2.6&&$totalmanusia<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($totalmanusia>3.4&&$totalmanusia<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($totalmanusia>4.2&&$totalmanusia<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
							?>
						</td>
						</tr>
						<tr>
						<td><b>Pengembangan Diri</b></td>
						<td align="center"><?php
						$pengembangandirisumberdaya=($pengembangandirisumberdaya_mhs+$pengembangandirisumberdaya_dosen+$pengembangandirisumberdaya_admin)/3;
						echo round($pengembangandirisumberdaya,2);
						
						if($pengembangandirisumberdaya>=1&&$pengembangandirisumberdaya<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($pengembangandirisumberdaya>2.6&&$pengembangandirisumberdaya<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($pengembangandirisumberdaya>3.4&&$pengembangandirisumberdaya<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($pengembangandirisumberdaya>4.2&&$pengembangandirisumberdaya<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>
						</td>
						<td align="center"><?php
						$pengembangandiriketerampilan=($pengembangandiriketerampilan_mhs+$pengembangandiriketerampilan_dosen+$pengembangandiriketerampilan_admin)/3;
						echo round($pengembangandiriketerampilan,2);
						
						if($pengembangandiriketerampilan>=1&&$pengembangandiriketerampilan<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($pengembangandiriketerampilan>2.6&&$pengembangandiriketerampilan<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($pengembangandiriketerampilan>3.4&&$pengembangandiriketerampilan<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($pengembangandiriketerampilan>4.2&&$pengembangandiriketerampilan<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>
						</td>
						<td align="center"><?php
						$pengembangandirisikap=($pengembangandirisikap_mhs+$pengembangandirisikap_dosen+$pengembangandirisikap_admin)/3;
						echo round($pengembangandirisikap,2);
						
						if($pengembangandirisikap>=1&&$pengembangandirisikap<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($pengembangandirisikap>2.6&&$pengembangandirisikap<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($pengembangandirisikap>3.4&&$pengembangandirisikap<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($pengembangandirisikap>4.2&&$pengembangandirisikap<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>
						</td>
						<td align="center"><?php
						$totalpengembangandiri=($pengembangandirisumberdaya+$pengembangandiriketerampilan+$pengembangandirisikap)/3;
						echo round($totalpengembangandiri,2);
						
						if($totalpengembangandiri>=1&&$totalpengembangandiri<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($totalpengembangandiri>2.6&&$totalpengembangandiri<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($totalpengembangandiri>3.4&&$totalpengembangandiri<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($totalpengembangandiri>4.2&&$totalpengembangandiri<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
							?></td>
						</tr>
						<tr>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						</tr>
						</table>
						
						<?php
						$nilaiakhirkeseluruhan=round((($totalinovasi+$totalmanusia+$totalpengembangandiri+$totalteknologi)/4),2);
						?>
						
						<font color="black">
						Nilai akhir tingkat kesiapan e-learning di Jurusan <?php echo $jurusan_now; ?> adalah 
						<?php 
						echo $nilaiakhirkeseluruhan; 
						echo " ";
						 
						if($nilaiakhirkeseluruhan>=1&&$nilaiakhirkeseluruhan<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($nilaiakhirkeseluruhan>2.6&&$nilaiakhirkeseluruhan<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($nilaiakhirkeseluruhan>3.4&&$nilaiakhirkeseluruhan<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($nilaiakhirkeseluruhan>4.2&&$nilaiakhirkeseluruhan<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>
						
						</font>
						
						</center>
		
		
		<br/>
		
			<p align="justify">
		<?php
		
		//Mencari nilai Max
		if($totalteknologi>$totalinovasi&&$totalteknologi>$totalmanusia&&$totalteknologi>$totalpengembangandiri){
			
		echo "Variabel Teknologi memiliki nilai paling tinggi dibandingkan variabel yang lain. Hal ini berarti faktor teknologi pada e-learning seperti hardware, software ataupun peralatan penunjang yang lain memiliki fungsi yang lebih baik dibanding faktor e-learning yang lain.";
		
		}

		else if($totalpengembangandiri>$totalinovasi&&$totalpengembangandiri>$totalmanusia&&$totalpengembangandiri>$totalteknologi){
			
		echo "Variabel Pengembangan Diri memiliki nilai paling tinggi dibandingkan variabel yang lain. Hal ini berarti faktor pengembangan diri seperti diskusi pengembangan e-learning ke depan, penyediaan anggaran e-learning dan optimisme terhadap kesuksesan implementasi e-learning di jurusan $jurusan_now Polije memiliki nilai yang lebih tinggi dibanding faktor yang lain.";
		
		}
		else if($totalinovasi>$totalteknologi&&$totalinovasi>$totalmanusia&&$totalinovasi>$totalpengembangandiri){
			
		echo "Variabel Inovasi memiliki nilai paling tinggi dibandingkan variabel yang lain. Hal ini berarti nilai kemampuan mahasiswa, dosen dan admin prodi jurusan $jurusan_now di Polije dalam mengadaptasi inovasi baru terkait e-learning melampaui faktor e-learning yang lain.";
		
		}
		else if($totalmanusia>$totalteknologi&&$totalmanusia>$totalpengembangandiri&&$totalmanusia>$totalinovasi){
			
		echo "Variabel Manusia memiliki nilai paling tinggi dibandingkan variabel yang lain. Hal ini berarti nilai kemampuan mahasiswa, dosen dan admin prodi jurusan $jurusan_now di Polije dalam menggunakan e-learning lebih dominan dibandingkan faktor yang lain dalam e-learning.";
		
		}
		
		else{
			echo "Nilai maksimal dari analisis responden mahasiswa, dosen dan admin prodi di jurusan $jurusan_now adalah ";
			echo round((max($totalteknologi, $totalpengembangandiri, $totalinovasi, $totalmanusia)),2);
			echo ".";
		}
		
		
		//Mencari nilai Min
		if($totalteknologi<$totalinovasi&&$totalteknologi<$totalmanusia&&$totalteknologi<$totalpengembangandiri){
			
		echo " Akan tetapi, variabel Teknologi memiliki nilai yang paling rendah diantara variabel yang lain. Hal ini berarti perlu adanya peningkatan kualitas teknologi, baik hardware, software ataupun peralatan penunjang yang lain agar implementasi e-learning di jurusan $jurusan_now Polije dapat berjalan dengan maksimal.";
		
		}

		else if($totalpengembangandiri<$totalinovasi&&$totalpengembangandiri<$totalmanusia&&$totalpengembangandiri<$totalteknologi){
			
		echo " Akan tetapi, variabel Pengembangan Diri memiliki nilai yang paling rendah diantara variabel yang lain.  Hal ini berarti perlu dilakukan pemantapan manajemen dan rencana pengembangan e-learning melalui kegiatan seperti diskusi pengembangan e-learning ke depan dan penyediaan anggaran e-learning yang lebih baik demi meningkatkan optimisme terhadap kesuksesan implementasi e-learning di jurusan $jurusan_now Polije.";
		
		}
		else if($totalinovasi<$totalteknologi&&$totalinovasi<$totalmanusia&&$totalinovasi<$totalpengembangandiri){
			
		echo " Akan tetapi, variabel Inovasi memiliki nilai yang paling rendah diantara variabel yang lain. Hal ini berarti nilai kemampuan mahasiswa, dosen dan admin prodi jurusan $jurusan_now di Polije dalam mengadaptasi inovasi baru terkait e-learning lebih rendah dibandingkan faktor e-learning yang lain, sehingga perlu adanya pembiasaan dalam mengadaptasi inovasi baru.";
		
		}
		else if($totalmanusia<$totalteknologi&&$totalmanusia<$totalpengembangandiri&&$totalmanusia<$totalinovasi){
			
		echo " Akan tetapi, variabel Manusia memiliki nilai yang paling rendah diantara variabel yang lain. Hal ini berarti perlu adanya peningkatan kualitas SDM mahasiswa, dosen dan admin prodi jurusan $jurusan_now yang lebih baik di Polije, dalam menggunakan dan mengelola e-learning.";
		
		}
		else{
			echo "Nilai minimal dari analisis responden mahasiswa, dosen dan admin prodi jurusan $jurusan_now adalah ";
			echo round((min($totalteknologi, $totalpengembangandiri, $totalinovasi, $totalmanusia)),2);
			echo ".";
		}
		
		
		
		?>
		
		</p>
		
		
			<br/><br/>
			
			<!--
			<center>
		<form action="penelitian_utama_mhs-onlyview.php" method="post">
				<button type="submit" class="btn btn-primary">Analisis Spesifik: Mahasiswa</button>	
		</form><br/>
		<form action="penelitian_utama_mhs-onlyview.php" method="post">
				<button type="submit" class="btn btn-primary">Analisis Spesifik: Dosen</button>
		</form><br/>
		<form action="penelitian_utama_mhs-onlyview.php" method="post">
		<button type="submit" class="btn btn-primary">Analisis Spesifik: Admin</button>
		</form>
			</center>
		-->
		
		<center>
		<form action="penelitian_utama-onlyview.php" method="post">
		<button type="submit" class="btn btn-success">Kembali ke Hasil Analisis Utama</button>
		</form>
		</center>
		
		
		</div>
		</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>