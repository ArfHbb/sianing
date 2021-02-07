<?php include 'koneksi.php'; 
session_start();


if(! isset($_SESSION['is_login']))
{
  header('location:login.php');
}

$username=$_SESSION['username'];

//echo $username;

$querystatus=mysqli_query($kon,"select * from login where username='$username'");
$belumdipanah = mysqli_fetch_object($querystatus);
$statusku=$belumdipanah->status;






$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='prosesvaliditasreliabilitas'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);



if($angkatotal==1){
$querystatusfinal=mysqli_query($kon,"select * from setting where nama='prosesvaliditasreliabilitas'");
$hasilquerystatusfinal = mysqli_fetch_object($querystatusfinal);
$statusfinal=$hasilquerystatusfinal->ketentuan;
if($statusfinal=='sudah'){
	header('location:validitas_reliabilitas-onlyview.php');
}
}

else{
		//header('location:kelola_pertanyaan.php');
}










//$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='statussetsampelujimhs'");
//$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
//$angkatotal=implode($angkatotal);

//if($angkatotal==1){
//$querystatusfinal=mysqli_query($kon,"select * from setting where nama='statussetsampelujimhs'");
//$hasilquerystatusfinal = mysqli_fetch_object($querystatusfinal);
//$statussetmhs=$hasilquerystatusfinal->ketentuan;
//if($statusfinal=='sudah'){
//	header('location:index-researcher-onlyview.php');
//}
//}

//else{
		//header('location:index-researcher.php');
//}


$adakahstatussetsampelujidosen = mysqli_query($kon,"select Count(*) from setting where nama='statussetsampelujidosen'");
$keberadaanstatussetsampelujidosen=	mysqli_fetch_assoc($adakahstatussetsampelujidosen);
$adastatussetsampelujidosen=implode($keberadaanstatussetsampelujidosen);

if($adastatussetsampelujidosen==1){
$querystatussetsampelujidosen=mysqli_query($kon,"select * from setting where nama='statussetsampelujidosen'");
$hasilquerystatussetsampelujidosen = mysqli_fetch_object($querystatussetsampelujidosen);
$statussettdosen=$hasilquerystatussetsampelujidosen->ketentuan;
}


?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Tentukan Jumlah Sampel Uji Coba</title>
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
      <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4" align="center">Tentukan Jumlah Sampel Uji Coba</h2>
		<p align="justify"> Anda diminta untuk memasukkan jumlah sampel uji coba. Jumlah sampel ujicoba yang disarankan lebih dari 2. Adapun jenis populasi dibagi menjadi mahasiswa aktif dan dosen tetap.</p>
        <br/>
	
		
		<br/>
			<center>
			
			
			
			
			
			<?php
		//mengecek apakah sampel utama sudah diset atau belum jika belum akan ada popup notif bahwa belum diset, dan jika sudah akan ditampilkan progress data saat ini
			//aku salah kasih nama, harusnya bukan sampelujicoba, tapi sampel utama,hahahah
			
			
			$popup='<div class="modal-dialog">

							
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Pertanyaan Belum Disetting</h4>
								
							</div>
							<div class="modal-body">
								
								
								
								Silakan klik simpan final pertanyaan terlebih dahulu. 
								
									<div class="form-group">
										
									</div>
								
							</div>
							<div class="modal-footer">
							
								
							</div>
							</div>

						</div>';
			
			
			
			
			
			$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='statusfinalsemuapertanyaan'");
			$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
			$angkatotal=implode($angkatotal);



			if($angkatotal==1){
			$querystatusfinal=mysqli_query($kon,"select * from setting where nama='statusfinalsemuapertanyaan'");
			$hasilquerystatusfinal = mysqli_fetch_object($querystatusfinal);
			$statusfinal=$hasilquerystatusfinal->ketentuan;
			if($statusfinal=='sudah'){
				
				$simpanfinalpertanyaan='sudah';
				//abaikan saja, karena sudah di set to, yaudah berarti bener
				
			}else{
				//if di db ada, tapi statusnya bukan sudah, maka tampilkan popup
				echo $popup;
				$simpanfinalpertanyaan='belum';
				
			}
			
			}

			else{
				
			//if di db gak ada, maka tampilkan popup
			echo $popup;
			$simpanfinalpertanyaan='belum';
			}
		
		
		
		
		
		?>
			
			
			
			
			
			
			
			<?php
				$query_jml_sampel_uji=mysqli_query($kon,"select * from setting where nama='jml_sampeluji_mhs'");
				$datamhs = mysqli_fetch_object($query_jml_sampel_uji)
			?>
			
			<label for="">Jumlah Sampel Uji Coba Mahasiswa: <?php echo $datamhs->ketentuan; ?></label>
			
			
			<?php
				
			$statusmhs='belumnih';
			$kecukupandatamhs='belum';
			$buttonuntukmhs='<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModalujicobamhs"><i class="fa fa-pencil"></i></button>';
			
			$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='statussetsampelujimhs'");
			$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
			$angkatotal=implode($angkatotal);

			if($angkatotal==1){
			$querystatusfinal=mysqli_query($kon,"select * from setting where nama='statussetsampelujimhs'");
			$hasilquerystatusfinal = mysqli_fetch_object($querystatusfinal);
			$statussetmhs=$hasilquerystatusfinal->ketentuan;
				if($statussetmhs=='sudah'){
					$statusmhs='sudahdong';
				//kalau ada di db dan isinya sudah, sembunyikan button
				//	tambahkan coding untuk menampilkan jumlah data ujicoba saat ini
				$queryjmldatamhs = mysqli_query($kon,"select Count(*) from mhs_ujicoba where kode_responden like 'mhs%'");
				$hasilqueryjmldatamhs=	mysqli_fetch_assoc($queryjmldatamhs);
				$jmldatamhs=implode($hasilqueryjmldatamhs);

				echo "<br/>";
				echo "Jumlah data yang terkumpul: ";
				echo $jmldatamhs;
				
				if($jmldatamhs==$datamhs->ketentuan){
					
					echo " (cukup)";
					$kecukupandatamhs='sudah';
					
				}
				
				if($jmldatamhs<$datamhs->ketentuan){
					
					echo " (kurang)";
					
				}
				
				if($jmldatamhs>$datamhs->ketentuan){
					
					echo " (lebih dari cukup)";
					$kecukupandatamhs='sudah';
				}
				
				echo "<br/>";
				echo "<br/>";
				}else{
				//kalau ada di db tapi bukan sudah, tampilkan button
				echo $buttonuntukmhs;
				}
				
			}
			
			if($angkatotal==0){
				
				//kalau gak ada di db, tampilkan button
				echo $buttonuntukmhs;
				
			}
		
			
			?>
			
			
			</center>
					<div id="myModalujicobamhs" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Edit Data</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form action="update_sampeluji_mhs.php" method="post">
								
														
								
									<div class="form-group">
										<label for="">Jumlah Sampel Uji Coba</label>
										<input type="number" name="sampeluji_mhs" class="form-control" value="<?=  $datamhs->ketentuan; ?>" min="2">
									</div>
									
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Simpan</button>
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
							</div>

						</div>
					</div>
			
			</form>
			
			
			
			
			
			
			<center>
			<form id="atur_total_mhs" method="post" action="update_sampeluji_dosen.php">
			
						<?php
				$query_jml_sampel_uji_dosen=mysqli_query($kon,"select * from setting where nama='jml_sampeluji_dosen'");
				$datadosen = mysqli_fetch_object($query_jml_sampel_uji_dosen)
			?>
			
			
			
			<label for="">Jumlah Sampel Uji Coba Dosen: <?php echo $datadosen->ketentuan; ?></label>
			<!--
			<input type="number" name="total_populasi_mhs" class="total" value="<?=  $datadosen->ketentuan; ?>">
			-->
			<?php $total='total' ?>
			
			<?php
			
			$statusdosen='belumnih';
			$buttonuntukdosen='<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModalujicobaDosen"><i class="fa fa-pencil"></i></button>';
			$kecukupandatadosen='belum';
			
			$adakahstatussetsampelujidosen = mysqli_query($kon,"select Count(*) from setting where nama='statussetsampelujidosen'");
			$keberadaanstatussetsampelujidosen=	mysqli_fetch_assoc($adakahstatussetsampelujidosen);
			$adastatussetsampelujidosen=implode($keberadaanstatussetsampelujidosen);

			if($adastatussetsampelujidosen==1){
			$querystatussetsampelujidosen=mysqli_query($kon,"select * from setting where nama='statussetsampelujidosen'");
			$hasilquerystatussetsampelujidosen = mysqli_fetch_object($querystatussetsampelujidosen);
			$statussetdosen=$hasilquerystatussetsampelujidosen->ketentuan;
			
				if($statussetdosen=='sudah'){
					$statusdosen='sudahdong';
				//kalau ada di db dan isinya sudah, sembunyikan button
				//	tambahkan coding untuk menampilkan jumlah data ujicoba saat ini
				$queryjmldatadosen = mysqli_query($kon,"select Count(*) from dosen_ujicoba where kode_responden like 'dosen%'");
				$hasilqueryjmldatadosen=	mysqli_fetch_assoc($queryjmldatadosen);
				$jmldatadosen=implode($hasilqueryjmldatadosen);

				echo "<br/>";
				echo "Jumlah data yang terkumpul: ";
				echo $jmldatadosen;
				
				
				if($jmldatadosen==$datadosen->ketentuan){
					
					echo " (cukup)";
					$kecukupandatadosen='sudah';
					
				}
				
				if($jmldatamhs<$datamhs->ketentuan){
					
					echo " (kurang)";
					
				}
				
				if($jmldatamhs>$datamhs->ketentuan){
					
					echo " (lebih dari cukup)";
					$kecukupandatadosen='sudah';
				}
				
				echo "<br/>";
				echo "<br/>";
				}else{
				//kalau ada di db tapi bukan sudah, tampilkan button
				echo $buttonuntukdosen;
				}
				
			}
			
			
			if($adastatussetsampelujidosen==0){
				
				//kalau gak ada di db, tampilkan button
				echo $buttonuntukdosen;
				
			}
			
			
			
			
			
			
			?>
			
						</center>
					<div id="myModalujicobaDosen" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Edit Data</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form action="update_sampeluji_dosen.php" method="post">
								
								
								
								

									<div class="form-group">
										<label for="">Jumlah Sampel Uji Coba</label>
										<input type="number" name="sampeluji_dosen" class="form-control" value="<?=  $datadosen->ketentuan; ?>" min="2">
									</div>
									
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Simpan</button>
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
							</div>

						</div>
					</div>
			
			<br/>
			
			<!--
			<form id="hitungan_validitas" method="post" action="validitas_reliabilitas.php">
			<center>
			-->
			
			
			
			<!--
			</center>
			</form>
			-->
			<center>
			<?php
			$tombolhitungvaliditas='<button type="button" data-toggle="modal" class="btn btn-primary" data-target="#myModalsimpanfinal"><i class="fa fa-true"></i> Hitung Nilai Validitas dan Reliabilitas</button>';
			if($statusmhs=='sudahdong'&&$statusdosen=='sudahdong'&&$simpanfinalpertanyaan=='sudah'&&$kecukupandatamhs=='sudah'&&$kecukupandatadosen=='sudah'){
				
				//harusnya ditampilkan berapa jumlah sampel ujicoba saat ini yang masuk dan kategorinya (cukup/enggak)
				//harusnya gak langsung ditampilkan buttonnya. Di seleksi dulu, apakah jumlah sampel ujicoba sudah cukup apa enggak. kalo cukup bari ditampilkan
				echo $tombolhitungvaliditas;
				
			}
			
			?>
			</center>
			
			<div id="myModalsimpanfinal" class="modal fade" role="dialog">
						<div class="modal-dialog">

							
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Hitung Validitas dan Reliabilitas</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form action="validitas_reliabilitas.php" method="post">
								
								
								Apakah anda yakin akan menghitung nilai validitas dan reiabilitas? <br/>Proses perhitungan membutuhkan waktu beberapa menit. Mohon tunggu hingga selesai dan tidak menutup tab browser.
								
									<div class="form-group">
										
									</div>
								
							</div>
							<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Yakin</button>
							</form>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
							</div>
							</div>

						</div>
					</div>
			
			
		
		</div>
		</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>