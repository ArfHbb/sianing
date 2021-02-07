<?php include 'koneksi.php'; 
session_start();
if(! isset($_SESSION['is_login']))
{
  header('location:login.php');
}

	
	
	//echo $_SESSION['password'];
	
$username=$_SESSION['username'];

$querystatus=mysqli_query($kon,"select * from login where username='$username'");
$belumdipanah = mysqli_fetch_object($querystatus);
$statusku=$belumdipanah->status;



$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='prosesanalisisutama'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);



if($angkatotal==1){
$querystatusfinal=mysqli_query($kon,"select * from setting where nama='prosesanalisisutama'");
$hasilquerystatusfinal = mysqli_fetch_object($querystatusfinal);
$statusfinal=$hasilquerystatusfinal->ketentuan;
if($statusfinal=='sudah'){
	header('location:penelitian_utama-onlyview.php');
}
}

else{
		//header('location:kelola_pertanyaan.php');
}



?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Penelitian Utama</title>
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
	          			  
	          <li>
	              <a href="kelola_pertanyaan.php"><span class="fa fa-user mr-3"></span> Kelola Butir Pertanyaan</a>
	          </li>
	          <li>
              <a href="tentukan_sampel_ujicoba.php"><span class="fa fa-briefcase mr-3"></span> Pengujian Validitas dan Reliabilitas</a>
	          </li>
			  
			  <!--
	          <li class="active">
              <a href="#"><span class="fa fa-sticky-note mr-3"></span> Penelitian Utama</a>
	          </li>
			  -->
			  
			  
	          <li>
			  <a href="#"><span class="fa fa-suitcase mr-3"></span> Hasil Analisis Penelitian</a>
	          </li>
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
        <h2 class="mb-4" align="center">Penelitian Utama</h2>
		
        <br/>
		
		
		
		
		
		
		
		
		
		
		<?php
		//mengecek apakah sampel utama sudah diset atau belum jika belum akan ada popup notif bahwa belum diset, dan jika sudah akan ditampilkan progress data saat ini
			//aku salah kasih nama, harusnya bukan sampelujicoba, tapi sampel utama,hahahah
			
			
			$popup='<div class="modal-dialog">

							
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Jumlah Sampel Belum Disetting</h4>
								
							</div>
							<div class="modal-body">
								
								
								
								Jumlah sampel utama belum disetting oleh pimpinan. <br/>Untuk dapat melanjutkan proses penelitian, silakan hubungi pimpinan perguruan tinggi agar terlebih dahulu mensetting jumlah sampel utama.
								
									<div class="form-group">
										
									</div>
								
							</div>
							<div class="modal-footer">
							
								
							</div>
							</div>

						</div>';
			
			
			
			
			
			$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='statusfinalsampelujicoba'");
			$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
			$angkatotal=implode($angkatotal);



			if($angkatotal==1){
			$querystatusfinal=mysqli_query($kon,"select * from setting where nama='statusfinalsampelujicoba'");
			$hasilquerystatusfinal = mysqli_fetch_object($querystatusfinal);
			$statusfinal=$hasilquerystatusfinal->ketentuan;
			if($statusfinal=='sudah'){
				
				//abaikan saja, karena sudah di set to, yaudah berarti bener
				//header('location:validitas_reliabilitas-onlyview.php');
			}else{
				//if di db ada, tapi statusnya bukan sudah, maka tampilkan popup
				echo $popup;
				$statusfinal='belum';
				
			}
			
			}

			else{
				
			//if di db gak ada, maka tampilkan popup
			echo $popup;
			$statusfinal='belum';
			}
		
		
		
		
		
		?>
		
		
		
		
		
		
		<?php
		//mengecek apakah proses validitas sudah diset atau belum jika belum akan ada popup notif bahwa belum diset, dan jika sudah akan ditampilkan progress data saat ini
			//aku salah kasih nama, harusnya bukan sampelujicoba, tapi sampel utama,hahahah
			
			
			$popupku='<div class="modal-dialog">

							
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Proses validitas dan reliabilitas belum dilakukan</h4>
								
							</div>
							<div class="modal-body">
								
								
								
								Silakan lakukan proses validitas dan reliabilitas terlebih dahulu sebelum melakukan penelitian utama 
								
									<div class="form-group">
										
									</div>
								
							</div>
							<div class="modal-footer">
							
								
							</div>
							</div>

						</div>';
			
			
			
			
			
			$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='prosesvaliditasreliabilitas'");
			$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
			$angkatotal=implode($angkatotal);



			if($angkatotal==1){
			$querystatusfinal=mysqli_query($kon,"select * from setting where nama='prosesvaliditasreliabilitas'");
			$hasilquerystatusfinal = mysqli_fetch_object($querystatusfinal);
			$statusvaliditas=$hasilquerystatusfinal->ketentuan;
			if($statusvaliditas=='sudah'){
				
				//abaikan saja, karena sudah di set to, yaudah berarti bener
				//header('location:validitas_reliabilitas-onlyview.php');
			}else{
				//if di db ada, tapi statusnya bukan sudah, maka tampilkan popup
				echo $popupku;
				$statusvaliditas='belum';
				
			}
			
			}

			else{
				
			//if di db gak ada, maka tampilkan popup
			echo $popupku;
			$statusvaliditas='belum';
			}
		
		
		
		
		
		?>
		
		
		
		
		
		
		
		<h6 align="center">Sampel Mahasiswa</h6><br/>
		
			
			
			
			
			
			<table class="table table-stripped table-hovered">
			<tr>
				<td>No</td>
				<td>Jurusan</td>
				<td>Target Sampel</td>
				<td>Jumlah Saat Ini</td>
				<td>Keterangan</td>
			</tr> 
			
			<?php
				$no = 0;
				$cukupmhs=0;
				$query_pertanyaan_mhs=mysqli_query($kon,"select * from jml_sampel_mhs where kode_jur!='total'");
				//$query_jmlmhssaatini=mysqli_query($kon,"select count(*) from mhs");
				while($per_mhs = mysqli_fetch_object($query_pertanyaan_mhs)){
					$no++;
			?>
			
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo $per_mhs->jurusan;
				$jurusansaatini=$per_mhs->jurusan;
				
				?></td>
				<td><?php echo $per_mhs->jml_sampel; 
								$sampelperjur=$per_mhs->jml_sampel;
				?></td>
				<td><?php 
				
				$jumlahperjur = mysqli_query($kon,"select Count(*) from mhs where jurusan='$jurusansaatini'");
				$data_jmlperjur = mysqli_fetch_assoc($jumlahperjur);
				$data_jmlperjur=implode($data_jmlperjur);
				echo $data_jmlperjur;
				?></td> 
				
				
				<td>
				<?php
				
				if($data_jmlperjur<$sampelperjur){
					
					echo "Kurang";
					
				}
				
				if($data_jmlperjur==$sampelperjur){
					
					echo "Cukup";
					$cukupmhs++;
					
				}
				
				if($data_jmlperjur>$sampelperjur){
					
					echo "Lebih dari cukup";
					$cukupmhs++;
				}
				?>
				</td>
				

			<?php
				
				}
			?>
			
			
			</tr>
			<tr>
			<td colspan=5><center>
			Progress pengumpulan data responden mahasiswa:
			<?php 
			
			$queryjmljurmhs = mysqli_query($kon,"select Count(*) from jurusan");
			$jmljurmhs=	mysqli_fetch_assoc($queryjmljurmhs);
			$jmljurmhs=implode($jmljurmhs);
			
			$progressmhs=(100*$cukupmhs)/$jmljurmhs;
			
			echo $progressmhs;
				echo "%";
			?></center>
			</td>
			</tr>
			</table> 
			
			
			
			
			
			<h6 align="center">Sampel Dosen</h6><br/>
		
			
			
			
			
			
			<table class="table table-stripped table-hovered">
			<tr>
				<td>No</td>
				<td>Jurusan</td>
				<td>Target Sampel</td>
				<td>Jumlah Saat Ini</td>
				<td>Keterangan</td>
			</tr> 
			
			<?php
				$no = 0;
				$cukupdosen=0;
				$query_pertanyaan_mhs=mysqli_query($kon,"select * from jml_sampel_dosen where kode_jur!='total'");
				//$query_jmlmhssaatini=mysqli_query($kon,"select count(*) from mhs");
				while($per_mhs = mysqli_fetch_object($query_pertanyaan_mhs)){
					$no++;
			?>
			
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo $per_mhs->jurusan;
				$jurusansaatini=$per_mhs->jurusan;
				
				?></td>
				<td><?php echo $per_mhs->jml_sampel; 
								$sampelperjur=$per_mhs->jml_sampel;
				?></td>
				<td><?php 
				
				$jumlahperjur = mysqli_query($kon,"select Count(*) from dosen where jurusan='$jurusansaatini'");
				$data_jmlperjur = mysqli_fetch_assoc($jumlahperjur);
				$data_jmlperjur=implode($data_jmlperjur);
				echo $data_jmlperjur;
				?></td> 
				
				
				<td>
				<?php
				
				if($data_jmlperjur<$sampelperjur){
					
					echo "Kurang";
					
				}
				
				if($data_jmlperjur==$sampelperjur){
					
					echo "Cukup";
					$cukupdosen++;
					
				}
				
				if($data_jmlperjur>$sampelperjur){
					
					echo "Lebih dari cukup";
					$cukupdosen++;
				}
				?>
				</td>
				

			<?php
				
				}
			?>
			
			
			</tr>
			<tr>
			<td colspan=5><center>
			Progress pengumpulan data responden dosen:
			
			<?php 
			
			$queryjmljurmhs = mysqli_query($kon,"select Count(*) from jurusan");
			$jmljurmhs=	mysqli_fetch_assoc($queryjmljurmhs);
			$jmljurmhs=implode($jmljurmhs);
			
			$progressdosen=(100*$cukupdosen)/$jmljurmhs;
			
			echo $progressdosen;
				echo "%";
			?>
			</center>
			</td>
			</tr>
			</table>
			<br/>
			
			
			
			
			
			
			
			<h6 align="center">Sampel Admin</h6><br/>
		
			
			
			
			
			
			<table class="table table-stripped table-hovered">
			<tr>
				<td>No</td>
				<td>Jurusan</td>
				<td>Target Sampel</td>
				<td>Jumlah Saat Ini</td>
				<td>Keterangan</td>
			</tr> 
			
			<?php
				$no = 0;
				$cukupadmin=0;
				$query_pertanyaan_mhs=mysqli_query($kon,"select * from jml_sampel_admin where kode_jur!='total'");
				//$query_jmlmhssaatini=mysqli_query($kon,"select count(*) from mhs");
				while($per_mhs = mysqli_fetch_object($query_pertanyaan_mhs)){
					$no++;
			?>
			
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo $per_mhs->jurusan;
				$jurusansaatini=$per_mhs->jurusan;
				
				?></td>
				<td><?php echo $per_mhs->jml_sampel; 
								$sampelperjur=$per_mhs->jml_sampel;
				?></td>
				<td><?php 
				
				$jumlahperjur = mysqli_query($kon,"select Count(*) from admin where jurusan='$jurusansaatini'");
				$data_jmlperjur = mysqli_fetch_assoc($jumlahperjur);
				$data_jmlperjur=implode($data_jmlperjur);
				echo $data_jmlperjur;
				?></td> 
				
				
				<td>
				<?php
				
				if($data_jmlperjur<$sampelperjur){
					
					echo "Kurang";
					
				}
				
				if($data_jmlperjur==$sampelperjur){
					
					echo "Cukup";
					$cukupadmin++;
					
				}
				
				if($data_jmlperjur>$sampelperjur){
					
					echo "Lebih dari cukup";
					$cukupadmin++;
				}
				?>
				</td>
				

			<?php
				
				}
			?>
			
			
			</tr>
			<tr>
			<td colspan=5><center>
			Progress pengumpulan data responden admin:
			
			<?php 
			
			$queryjmljurmhs = mysqli_query($kon,"select Count(*) from jurusan");
			$jmljurmhs=	mysqli_fetch_assoc($queryjmljurmhs);
			$jmljurmhs=implode($jmljurmhs);
			
			$progressadmin=(100*$cukupadmin)/$jmljurmhs;
			
			echo $progressadmin;
				echo "%";
			?>
			</center>
			</td>
			</tr>
			</table>
			
			
			
			
			
		
		<br/>
			<center>
			
		
		<?php
		//echo "jumlah data jurusan mhs yang cukup saat ini: ";
		//echo $cukupmhs;
		//echo "<br/>";
		//echo "jumlah data jurusan dosen yang cukup saat ini: ";
		//echo $cukupdosen;
		//echo "<br/>";
		//echo "jumlah data jurusan admin yang cukup saat ini: ";
		//echo $cukupadmin;
		//echo "<br/>";
		//echo 12.5*3;

		$buttin='<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalsimpanfinal">Hitung Hasil Analisis Penelitian</button>';

		
		if($progressadmin=='100'&&$progressdosen=='100'&&$progressmhs=='100'&&$statusfinal=='sudah'&&$statusvaliditas=='sudah'){
		
			//if tidak ada yang belum cukup, then show button.
				echo $buttin;
		}
		
		
		?>
		
		<center>
				</center>			<div id="myModalsimpanfinal" class="modal fade" role="dialog">
						<div class="modal-dialog">

							
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Hitung Analisis Penelitian</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form action="simpanfinal_analisisutama.php" method="post">
								
								
								Apakah anda yakin akan menghitung analisis penelitian?
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