<?php include 'koneksi.php'; 
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
  	<title>Hasil Analisis Admin</title>
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
        <h2 class="mb-4" align="center">Hasil Analisis Responden Admin</h2>
		
        
		
		
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
									RESPONDEN ADMIN<br/>
			1. Buat kolom rerata<br/>
			-->
			
				<?php

$buat_kolom_jml="alter table butir_pertanyaan_admin add rerata varchar(20)";
$eksekyut=mysqli_query($kon,$buat_kolom_jml);
if ($b=$eksekyut){
				//echo "Kolom rerata telah dibuat";
				//echo "<br/>";
}else {
	//echo "Kolom rerata gagal dibuat";
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
					
					
					$sql=mysqli_query($kon,"select avg($kolomqasekarang) from admin");
					$avg=mysqli_fetch_assoc($sql);
					$avg=implode($avg);
					
					//echo $kolomqasekarang;
					//echo ": ";
					//echo $avg;
					//echo "<br/>";
					
					
					
					$set_update_jml = mysqli_query($kon,"update butir_pertanyaan_admin set rerata='$avg' where kode_pertanyaan='$kolomqasekarang' ");

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
				$querybaru=mysqli_query($kon,"select avg(rerata) from butir_pertanyaan_admin where variabel='Teknologi' and konstruk='Sumber Daya'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$teknologisumberdaya_admin=implode($hasilquerybaru);
					
					//echo $teknologisumberdaya_admin;
					//echo "<br/>";
				
						?>
						
						<!--
				2. Variabel Teknologi Konstruk Keterampilan Responden admin<br/>
					-->
					
				<?php
				$querybaru=mysqli_query($kon,"select avg(rerata) from butir_pertanyaan_admin where variabel='Teknologi' and konstruk='Keterampilan'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$teknologiketerampilan_admin=implode($hasilquerybaru);
					
					//echo $teknologiketerampilan_admin;
					//echo "<br/>";
				
						?>
						
						<!--
				3. Variabel Teknologi Konstruk Sikap Responden admin<br/>
					-->
					
				<?php
				$querybaru=mysqli_query($kon,"select avg(rerata) from butir_pertanyaan_admin where variabel='Teknologi' and konstruk='Sikap'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$teknologisikap_admin=implode($hasilquerybaru);
					
					//echo $teknologisikap_admin;
					//echo "<br/>";
				
						?>
						<!--
						4. Variabel Inovasi Konstruk Sumber Daya Responden admin<br/>
						-->
				
				<?php
				$querybaru=mysqli_query($kon,"select avg(rerata) from butir_pertanyaan_admin where variabel='Inovasi' and konstruk='Sumber Daya'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$inovasisumberdaya_admin=implode($hasilquerybaru);
					
					//echo $inovasisumberdaya_admin;
					//echo "<br/>";
				
						?>
						
						<!--
						5. Variabel Inovasi Konstruk Keterampilan Responden admin<br/>
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg(rerata) from butir_pertanyaan_admin where variabel='Inovasi' and konstruk='Keterampilan'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$inovasiketerampilan_admin=implode($hasilquerybaru);
					
					//echo $inovasiketerampilan_admin;
					//echo "<br/>";
				
						?>
						<!--
						6. Variabel Inovasi Konstruk Sikap Responden admin<br/>
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg(rerata) from butir_pertanyaan_admin where variabel='Inovasi' and konstruk='Sikap'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$inovasisikap_admin=implode($hasilquerybaru);
					
					//echo $inovasisikap_admin;
					//echo "<br/>";
				
						?>
						<!--
						7. Variabel Manusia Konstruk Sumber Daya Responden admin<br/>
						-->
				<?php
				$querybaru=mysqli_query($kon,"select avg(rerata) from butir_pertanyaan_admin where variabel='Manusia' and konstruk='Sumber Daya'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$manusiasumberdaya_admin=implode($hasilquerybaru);
					
					//echo $manusiasumberdaya_admin;
					//echo "<br/>";
				
						?>
						<!--
						8. Variabel Manusia Konstruk Keterampilan Responden admin<br/>
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg(rerata) from butir_pertanyaan_admin where variabel='Manusia' and konstruk='Keterampilan'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$manusiaketerampilan_admin=implode($hasilquerybaru);
					
					//echo $manusiaketerampilan_admin;
					//echo "<br/>";
				
						?>
						
						<!--
						
						9. Variabel Pengembangan Diri Konstruk Sumber Daya Responden admin<br/>
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg(rerata) from butir_pertanyaan_admin where variabel='Pengembangan Diri' and konstruk='Sumber Daya'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$pengembangandirisumberdaya_admin=implode($hasilquerybaru);
					
					//echo $pengembangandirisumberdaya_admin;
					//echo "<br/>";
				
						?>
						<!--
						10. Variabel Pengembangan Diri Konstruk Keterampilan Responden admin<br/>
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg(rerata) from butir_pertanyaan_admin where variabel='Pengembangan Diri' and konstruk='Keterampilan'");
					$hasilquerybaru=mysqli_fetch_assoc($querybaru);
					$pengembangandiriketerampilan_admin=implode($hasilquerybaru);
					
					//echo $pengembangandiriketerampilan_admin;
					//echo "<br/>";
				
						?>
						<!--
						11. Variabel Pengembangan Diri Konstruk Sikap Responden admin<br/>
						-->
						
				<?php
				$querybaru=mysqli_query($kon,"select avg(rerata) from butir_pertanyaan_admin where variabel='Pengembangan Diri' and konstruk='Sikap'");
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
						echo round($teknologisumberdaya_admin,2);
						
						if($teknologisumberdaya_admin>=1&&$teknologisumberdaya_admin<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($teknologisumberdaya_admin>2.6&&$teknologisumberdaya_admin<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($teknologisumberdaya_admin>3.4&&$teknologisumberdaya_admin<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($teknologisumberdaya_admin>4.2&&$teknologisumberdaya_admin<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>
						</td>
						<td align="center"><?php
						echo round($teknologiketerampilan_admin,2);
						
						if($teknologiketerampilan_admin>=1&&$teknologiketerampilan_admin<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($teknologiketerampilan_admin>2.6&&$teknologiketerampilan_admin<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($teknologiketerampilan_admin>3.4&&$teknologiketerampilan_admin<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($teknologiketerampilan_admin>4.2&&$teknologiketerampilan_admin<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>
						</td>
						<td align="center"><?php
						echo round($teknologisikap_admin,2);
						
						if($teknologisikap_admin>=1&&$teknologisikap_admin<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($teknologisikap_admin>2.6&&$teknologisikap_admin<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($teknologisikap_admin>3.4&&$teknologisikap_admin<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($teknologisikap_admin>4.2&&$teknologisikap_admin<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>
						</td>
						<td align="center"><?php
						$totalteknologi=($teknologisumberdaya_admin+$teknologiketerampilan_admin+$teknologisikap_admin)/3;
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
						echo round($inovasisumberdaya_admin,2);
						
						if($inovasisumberdaya_admin>=1&&$inovasisumberdaya_admin<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($inovasisumberdaya_admin>2.6&&$inovasisumberdaya_admin<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($inovasisumberdaya_admin>3.4&&$inovasisumberdaya_admin<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($inovasisumberdaya_admin>4.2&&$inovasisumberdaya_admin<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>
						</td>
						<td align="center"><?php
						echo round($inovasiketerampilan_admin,2);
						
						if($inovasiketerampilan_admin>=1&&$inovasiketerampilan_admin<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($inovasiketerampilan_admin>2.6&&$inovasiketerampilan_admin<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($inovasiketerampilan_admin>3.4&&$inovasiketerampilan_admin<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($inovasiketerampilan_admin>4.2&&$inovasiketerampilan_admin<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>						
						</td>
						<td align="center"><?php
						echo round($inovasisikap_admin,2);
						
						if($inovasisikap_admin>=1&&$inovasisikap_admin<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($inovasisikap_admin>2.6&&$inovasisikap_admin<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($inovasisikap_admin>3.4&&$inovasisikap_admin<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($inovasisikap_admin>4.2&&$inovasisikap_admin<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>	
						</td>
						<td align="center"><?php
						$totalinovasi=($inovasisumberdaya_admin+$inovasiketerampilan_admin+$inovasisikap_admin)/3;
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
						echo round($manusiasumberdaya_admin,2);
						
						if($manusiasumberdaya_admin>=1&&$manusiasumberdaya_admin<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($manusiasumberdaya_admin>2.6&&$manusiasumberdaya_admin<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($manusiasumberdaya_admin>3.4&&$manusiasumberdaya_admin<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($manusiasumberdaya_admin>4.2&&$manusiasumberdaya_admin<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>
						</td>
						<td align="center"><?php
						echo round($manusiaketerampilan_admin,2);
						
						if($manusiaketerampilan_admin>=1&&$manusiaketerampilan_admin<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($manusiaketerampilan_admin>2.6&&$manusiaketerampilan_admin<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($manusiaketerampilan_admin>3.4&&$manusiaketerampilan_admin<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($manusiaketerampilan_admin>4.2&&$manusiaketerampilan_admin<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>						
						</td>
						<td align="center">-
						</td>
						<td align="center"><?php
						$totalmanusia=($manusiasumberdaya_admin+$manusiaketerampilan_admin)/2;
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
						echo round($pengembangandirisumberdaya_admin,2);
						
						if($pengembangandirisumberdaya_admin>=1&&$pengembangandirisumberdaya_admin<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($pengembangandirisumberdaya_admin>2.6&&$pengembangandirisumberdaya_admin<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($pengembangandirisumberdaya_admin>3.4&&$pengembangandirisumberdaya_admin<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($pengembangandirisumberdaya_admin>4.2&&$pengembangandirisumberdaya_admin<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>
						</td>
						<td align="center"><?php
						echo round($pengembangandiriketerampilan_admin,2);
						
						if($pengembangandiriketerampilan_admin>=1&&$pengembangandiriketerampilan_admin<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($pengembangandiriketerampilan_admin>2.6&&$pengembangandiriketerampilan_admin<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($pengembangandiriketerampilan_admin>3.4&&$pengembangandiriketerampilan_admin<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($pengembangandiriketerampilan_admin>4.2&&$pengembangandiriketerampilan_admin<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>
						</td>
						<td align="center"><?php
						echo round($pengembangandirisikap_admin,2);
						
						if($pengembangandirisikap_admin>=1&&$pengembangandirisikap_admin<=2.6){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan banyak peningkatan)';
						}else if($pengembangandirisikap_admin>2.6&&$pengembangandirisikap_admin<=3.4){
						echo '<br/>';
						echo'(Tidak siap, membutuhkan sedikit peningkatan)';
						}else if($pengembangandirisikap_admin>3.4&&$pengembangandirisikap_admin<=4.2){
						echo '<br/>';
						echo'(Siap, tetapi membutuhkan sedikit peningkatan)';
						}else if($pengembangandirisikap_admin>4.2&&$pengembangandirisikap_admin<=5){
						echo '<br/>';
						echo'(Siap, penerapan e-learning dapat dilanjutkan)';
						}
						?>
						</td>
						<td align="center"><?php
						$totalpengembangandiri=($pengembangandirisumberdaya_admin+$pengembangandiriketerampilan_admin+$pengembangandirisikap_admin)/3;
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
						Nilai akhir tingkat kesiapan e-learning di kalangan Admin adalah 
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
			
		echo "Variabel Pengembangan Diri memiliki nilai paling tinggi dibandingkan variabel yang lain. Hal ini berarti faktor pengembangan diri seperti diskusi pengembangan e-learning ke depan, penyediaan anggaran e-learning dan optimisme terhadap kesuksesan implementasi e-learning di Polije memiliki nilai yang lebih tinggi dibanding faktor yang lain.";
		
		}
		else if($totalinovasi>$totalteknologi&&$totalinovasi>$totalmanusia&&$totalinovasi>$totalpengembangandiri){
			
		echo "Variabel Inovasi memiliki nilai paling tinggi dibandingkan variabel yang lain. Hal ini berarti nilai kemampuan admin prodi di Polije dalam mengadaptasi inovasi baru terkait e-learning melampaui faktor e-learning yang lain.";
		
		}
		else if($totalmanusia>$totalteknologi&&$totalmanusia>$totalpengembangandiri&&$totalmanusia>$totalinovasi){
			
		echo "Variabel Manusia memiliki nilai paling tinggi dibandingkan variabel yang lain. Hal ini berarti nilai kemampuan admin prodi di Polije dalam menggunakan e-learning lebih dominan dibandingkan faktor yang lain dalam e-learning.";
		
		}
		
		else{
			echo "Nilai maksimal dari analisis responden Admin Prodi adalah ";
			echo round((max($totalteknologi, $totalpengembangandiri, $totalinovasi, $totalmanusia)),2);
			echo ".";
		}
		
		
		//Mencari nilai Min
		if($totalteknologi<$totalinovasi&&$totalteknologi<$totalmanusia&&$totalteknologi<$totalpengembangandiri){
			
		echo " Akan tetapi, variabel Teknologi memiliki nilai yang paling rendah diantara variabel yang lain. Hal ini berarti perlu adanya peningkatan kualitas teknologi, baik hardware, software ataupun peralatan penunjang yang lain agar implementasi e-learning di Polije dapat berjalan dengan maksimal.";
		
		}

		else if($totalpengembangandiri<$totalinovasi&&$totalpengembangandiri<$totalmanusia&&$totalpengembangandiri<$totalteknologi){
			
		echo " Akan tetapi, variabel Pengembangan Diri memiliki nilai yang paling rendah diantara variabel yang lain.  Hal ini berarti perlu dilakukan pemantapan manajemen dan rencana pengembangan e-learning melalui kegiatan seperti diskusi pengembangan e-learning ke depan dan penyediaan anggaran e-learning yang lebih baik demi meningkatkan optimisme terhadap kesuksesan implementasi e-learning di Polije.";
		
		}
		else if($totalinovasi<$totalteknologi&&$totalinovasi<$totalmanusia&&$totalinovasi<$totalpengembangandiri){
			
		echo " Akan tetapi, variabel Inovasi memiliki nilai yang paling rendah diantara variabel yang lain. Hal ini berarti nilai kemampuan admin prodi di Polije dalam mengadaptasi inovasi baru terkait e-learning lebih rendah dibandingkan faktor e-learning yang lain, sehingga perlu adanya pembiasaan dalam mengadaptasi inovasi baru.";
		
		}
		else if($totalmanusia<$totalteknologi&&$totalmanusia<$totalpengembangandiri&&$totalmanusia<$totalinovasi){
			
		echo " Akan tetapi, variabel Manusia memiliki nilai yang paling rendah diantara variabel yang lain. Hal ini berarti perlu adanya peningkatan kualitas SDM Admin prodi yang lebih baik di Polije, dalam menggunakan dan mengelola e-learning.";
		
		}
		else{
			echo "Nilai minimal dari analisis responden Admin Prodi adalah ";
			echo round((min($totalteknologi, $totalpengembangandiri, $totalinovasi, $totalmanusia)),2);
			echo ".";
		}
		
		
		
		?>
		
		</p>
		
		
			<br/><br/>
			
			<center>
		<form action="penelitian_utama-onlyview.php" method="post">
				<button type="submit" class="btn btn-warning">Analisis Keseluruhan</button>	
		</form><br/>
		<form action="penelitian_utama_dosen-onlyview.php" method="post">
				<button type="submit" class="btn btn-primary">Analisis Spesifik: Dosen</button>
		</form><br/>
		<form action="penelitian_utama_mhs-onlyview.php" method="post">
		<button type="submit" class="btn btn-primary">Analisis Spesifik: Mahasiswa</button>
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