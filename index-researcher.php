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

//if($statusku=='peneliti'){
//	header('location:kelola_pertanyaan.php');
	
//}



$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='statusfinalsampelujicoba'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);



if($angkatotal==1){
$querystatusfinal=mysqli_query($kon,"select * from setting where nama='statusfinalsampelujicoba'");
$hasilquerystatusfinal = mysqli_fetch_object($querystatusfinal);
$statusfinal=$hasilquerystatusfinal->ketentuan;
if($statusfinal=='sudah'){
	header('location:index-researcher-onlyview.php');
}
}

else{
		//header('location:index-researcher.php');
}



?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Beranda <?php echo $statusku?></title>
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
              <a href="atur_jurusan.php"><span class="fa fa-sticky-note mr-3"></span> Atur Jurusan</a>
	          </li>
			  
	          <li class="active">
	            <a href="#"><span class="fa fa-home mr-3"></span> Atur Sampel</a>
	          </li>
			  <!--
	          <li>
	              <a href="kelola_pertanyaan.php"><span class="fa fa-user mr-3"></span> Kelola Butir Pertanyaan</a>
	          </li>
	          <li>
              <a href="tentukan_sampel_ujicoba.php"><span class="fa fa-briefcase mr-3"></span> Pengujian Validitas dan Reliabilitas</a>
	          </li>
			  
	          <li>
              <a href="#"><span class="fa fa-sticky-note mr-3"></span> Penelitian Utama</a>
	          </li>
			  -->
			  <?php
			  
			  
			  $apakahsudahditeliti = mysqli_query($kon,"select Count(*) from setting where nama='prosesanalisisutama' and ketentuan='sudah'");
$keterangansudahditeliti=	mysqli_fetch_assoc($apakahsudahditeliti);
$keterangansudahditeliti=implode($keterangansudahditeliti);
					

					
$menuhasil='
	          <li>
              <a href="penelitian_utama-onlyview.php"><span class="fa fa-suitcase mr-3"></span> Hasil Analisis Penelitian</a>
	          </li>';
			  
if ($keterangansudahditeliti==1){

echo $menuhasil;

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
        <h2 class="mb-4" align="center">Tentukan Jumlah Sampel</h2>
		<p align="justify"> Anda diminta untuk memasukkan jumlah populasi dari sampel yang akan diteliti. Adapun jenis populasi dibagi menjadi mahasiswa aktif, dosen tetap dan tenaga administrasi program studi yang terbagi pada setiap jurusan. Jumlah sampel dihitung otomatis dengan tingkat kesalahan sebesar 5%.</p>
        <br/>
		<h6 align="center">Sampel Mahasiswa</h6>
		
			<?php
				$query_jml_total_mhs=mysqli_query($kon,"select * from jml_sampel_mhs where kode_jur='total'");
				$data = mysqli_fetch_object($query_jml_total_mhs)
			?>
		
		<br/>
			<center>
			<form id="atur_total_mhs" method="post" action="atur_total_mhs.php">
			<label for="">Jumlah Total Mahasiswa Polije: <?php echo $data->jml_populasi; ?></label>
			<!--
			<input type="number" name="total_populasi_mhs" class="total" value="<?=  $data->jml_populasi; ?>">
			-->
			<?php $total='total' ?>
			
			&nbsp;&nbsp;&nbsp;
			
			<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal<?php echo $total ?>"><i class="fa fa-pencil"></i></button>	
			
			
			
			
			</center>
					<div id="myModal<?php echo $total?>" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Edit Data</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form action="update_sampel_mhs.php" method="post">
								
								<!--
								<?php
								$kode_jurusan=$total;
								echo $kode_jurusan;
								?>
								-->
								
								<input type="hidden" name="kode_jurusan" value='<?php echo $total;?>'>
								
								<!--
									<div class="form-group">
										<label for="">Total</label>
										<input type="text" name="jurusan_mhs" class="form-control" value="<?=  $total ?>" readonly>
									</div>
									-->
									<div class="form-group">
										<label for="">Jumlah Populasi</label>
										<input type="number" name="total_populasi_mhs" class="form-control" value="<?=  $data->jml_populasi; ?>" min="1">
									</div>
									<div class="form-group">
										<!--<label for="" >Jumlah Sampel (otomatis)</label>-->
										<input type="hidden" name="total_sampel_mhs" class="form-control" value="<?= $data->jml_sampel; ?>" readonly>
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
			
			
			
			
			
			
			
			<!--
			<input type="submit" id="submit" value="Ubah">
			-->
			</form>
			
			<br/>
			
				<table class="table table-stripped table-hovered">
			<tr>
				<td>No</td>
				<td>Jurusan</td>
				<td>Jumlah Populasi</td>
				<td>Jumah Sampel</td>
				
				<td>Action</td>
				
				
				
				
				
				
			</tr> 
			
			<?php
				$no = 0;
				$query_jml_mhs=mysqli_query($kon,"select * from jml_sampel_mhs where kode_jur!='total'");
				while($dt = mysqli_fetch_object($query_jml_mhs)){
					$no++;
			?>
			
			<tr>
				<td><?php echo $no ?></td>
				<td><?php 
				
				echo $dt->jurusan ?></td>
				<td><?php echo $dt->jml_populasi ?></td>
				<td><?php echo $dt->jml_sampel ?></td>
				
				
				<td>
				
					<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal<?php echo $dt->kode_jur ?>" 
					
					<?php
				//jika total mhs belum diset, maka kolom action hide. Jika sudah, maka show
				if($data->jml_populasi==0){
				
				echo "disabled";
				
				}
					
				
				?>
					
					><i class="fa fa-pencil"></i></button>
					
		
				
				<div id="myModal<?php echo $dt->kode_jur?>" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Edit Data</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form action="update_sampel_mhs.php" method="post">
								
								<!--
								<?php
								$kode_jurusan=$dt->kode_jur;
								echo $kode_jurusan;
								?>
								-->
								
								<input type="hidden" name="kode_jurusan" value='<?php echo $dt->kode_jur;?>'>
								
									<div class="form-group">
										<label for="">Jurusan</label>
										<input type="text" name="jurusan_mhs" class="form-control" value="<?=  $dt->jurusan; ?>" readonly>
									</div>
									<div class="form-group">
										<label for="">Jumlah Populasi</label>
										<input type="number" name="populasi_mhs" class="form-control" value="<?= $dt->jml_populasi ?>" min="1">
									</div>
									<div class="form-group">
										<label for="">Jumlah Sampel (otomatis)</label>
										<input type="text" name="sampel_mhs" class="form-control" value="<?= $dt->jml_sampel ?>" readonly>
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
				</td>

			<?php
				
				}
			?>
			
			</table> 
		
		
		 <br/>
		<h6 align="center">Sampel Dosen</h6>
		
			<?php
				$query_jml_total_dosen=mysqli_query($kon,"select * from jml_sampel_dosen where kode_jur='total'");
				$datadosen = mysqli_fetch_object($query_jml_total_dosen)
			?>
		
		<br/>
			<center>
			<form id="atur_total_dosen" method="post" action="atur_total_dosen.php">
			<label for="">Jumlah Total Dosen Polije: <?php echo $datadosen->jml_populasi; ?></label>
			
			<?php $total='total' ?>
			
			<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModalDosen<?php echo $total ?>"><i class="fa fa-pencil"></i></button>
			
			
			
			
			</center>
					<div id="myModalDosen<?php echo $total?>" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Edit Data</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form action="update_sampel_dosen.php" method="post">
								
								<!--
								<?php
								$kode_jurusan=$total;
								echo $kode_jurusan;
								?>
								-->
								
								<input type="hidden" name="kode_jurusan" value='<?php echo $total;?>'>
								
								<!--
									<div class="form-group">
										<label for="">Total</label>
										<input type="text" name="jurusan_mhs" class="form-control" value="<?=  $total ?>" readonly>
									</div>
									-->
									<div class="form-group">
										<label for="">Jumlah Populasi</label>
										<input type="number" name="total_populasi_dosen" class="form-control" value="<?=  $datadosen->jml_populasi; ?>" min="1">
									</div>
									<div class="form-group">
										<!--<label for="">Jumlah Sampel (otomatis)</label>-->
										<input type="hidden" name="total_sampel_dosen" class="form-control" value="<?= $datadosen->jml_sampel; ?>" readonly>
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
			
			
			
			
			
			
			
			<!--
			<input type="submit" id="submit" value="Ubah">
			-->
			</form>
			
			<br/>
			
				<table class="table table-stripped table-hovered">
			<tr>
				<td>No</td>
				<td>Jurusan</td>
				<td>Jumlah Populasi</td>
				<td>Jumah Sampel</td>
				<td>Action</td>
				
				
			</tr> 
			
			<?php
				$no = 0;
				$query_jml_dosen=mysqli_query($kon,"select * from jml_sampel_dosen where kode_jur!='total'");
				while($datadosen = mysqli_fetch_object($query_jml_dosen)){
					$no++;
			?>
			
			<tr>
				<td><?php echo $no ?></td>
				<td><?php 
				
				echo $datadosen->jurusan ?></td>
				<td><?php echo $datadosen->jml_populasi ?></td>
				<td><?php echo $datadosen->jml_sampel ?></td>
				
				
					<td>
					<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModalDosen<?php echo $datadosen->kode_jur ?>"
					
					
					<?php
					
				$queryjumlahpopulasidosen=mysqli_query($kon,"select * from jml_sampel_dosen where kode_jur='total'");
				$hasiljumlahpopulasidosen = mysqli_fetch_object($queryjumlahpopulasidosen);
				$populasidosen=$hasiljumlahpopulasidosen->jml_populasi;
				
				//jika total mhs belum diset, maka kolom action hide. Jika sudah, maka show
				if($populasidosen==0){
				
				echo "disabled";
				
				}
					
				
				?>
					
					
					><i class="fa fa-pencil"></i></button>
					
				
				
									<div id="myModalDosen<?php echo $datadosen->kode_jur?>" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Edit Data</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form action="update_sampel_dosen.php" method="post">
								
								<!--
								<?php
								$kode_jurusan=$datadosen->kode_jur;
								echo $kode_jurusan;
								?>
								-->
								
								<input type="hidden" name="kode_jurusan" value='<?php echo $datadosen->kode_jur;?>'>
								
									<div class="form-group">
										<label for="">Jurusan</label>
										<input type="text" name="jurusan_dosen" class="form-control" value="<?=  $datadosen->jurusan; ?>" readonly>
									</div>
									<div class="form-group">
										<label for="">Jumlah Populasi</label>
										<input type="number" name="populasi_dosen" class="form-control" value="<?= $datadosen->jml_populasi ?>" min="1">
									</div>
									<div class="form-group">
										<label for="">Jumlah Sampel (otomatis)</label>
										<input type="text" name="sampel_mhs" class="form-control" value="<?= $datadosen->jml_sampel ?>" readonly>
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
				</td>

			<?php
				
				}
			?>
			
			</table> 
		
		
		
		
		
		<br/>
		<h6 align="center">Sampel Admin Prodi</h6>
		
			<?php
				$query_jml_total_admin=mysqli_query($kon,"select * from jml_sampel_admin where kode_jur='total'");
				$dataadmin = mysqli_fetch_object($query_jml_total_admin)
			?>
		
		<br/>
			<center>
			<form id="atur_total_admin" method="post" action="atur_total_admin.php">
			<label for="">Jumlah Total Admin Polije: <?php echo $dataadmin->jml_populasi; ?></label>
			
			<?php $total='total' ?>
		
		
		<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModalAdmin<?php echo $total ?>"><i class="fa fa-pencil"></i></button>
			</center>
					<div id="myModalAdmin<?php echo $total?>" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Edit Data</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form action="update_sampel_admin.php" method="post">
								
								<!--
								<?php
								$kode_jurusan=$total;
								echo $kode_jurusan;
								?>
								-->
								
								<input type="hidden" name="kode_jurusan" value='<?php echo $total;?>'>
								
								<!--
									<div class="form-group">
										<label for="">Total</label>
										<input type="text" name="jurusan_mhs" class="form-control" value="<?=  $total ?>" readonly>
									</div>
									-->
									<div class="form-group">
										<label for="">Jumlah Populasi</label>
										<input type="number" name="total_populasi_admin" class="form-control" value="<?=  $dataadmin->jml_populasi; ?>" min="1">
									</div>
									<div class="form-group">
										<label for="">Jumlah Sampel (otomatis)</label>
										<input type="text" name="total_sampel_admi"n class="form-control" value="<?= $dataadmin->jml_sampel; ?>" readonly>
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
			
			
			
			
			
			
			
			<!--
			<input type="submit" id="submit" value="Ubah">
			-->
			</form>
			
			<br/>
			
				<table class="table table-stripped table-hovered">
			<tr>
				<td>No</td>
				<td>Jurusan</td>
				<td>Jumlah Populasi</td>
				<td>Jumah Sampel</td>
				<td>Action</td>
			</tr> 
			
			<?php
				$no = 0;
				$query_jml_admin=mysqli_query($kon,"select * from jml_sampel_admin where kode_jur!='total'");
				while($dataadmin = mysqli_fetch_object($query_jml_admin)){
					$no++;
			?>
			
			<tr>
				<td><?php echo $no ?></td>
				<td><?php 
				
				echo $dataadmin->jurusan ?></td>
				<td><?php echo $dataadmin->jml_populasi ?></td>
				<td><?php echo $dataadmin->jml_sampel ?></td>
				
				<td>
					<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModalAdmin<?php echo $dataadmin->kode_jur ?>"
					
					<?php
					
				$queryjumlahpopulasiadmin=mysqli_query($kon,"select * from jml_sampel_admin where kode_jur='total'");
				$hasiljumlahpopulasiadmin = mysqli_fetch_object($queryjumlahpopulasiadmin);
				$populasiadmin=$hasiljumlahpopulasiadmin->jml_populasi;
				
				//jika total mhs belum diset, maka kolom action hide. Jika sudah, maka show
				if($populasiadmin==0){
				
				echo "disabled";
				
				}
					
				
				?>
					
					
					><i class="fa fa-pencil"></i></button>
					<div id="myModalAdmin<?php echo $dataadmin->kode_jur?>" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Edit Data</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form action="update_sampel_admin.php" method="post">
								
								<!--
								<?php
								$kode_jurusan=$dataadmin->kode_jur;
								echo $kode_jurusan;
								?>
								-->
								
								<input type="hidden" name="kode_jurusan" value='<?php echo $dataadmin->kode_jur;?>'>
								
									<div class="form-group">
										<label for="">Jurusan</label>
										<input type="text" name="jurusan_admin" class="form-control" value="<?=  $dataadmin->jurusan; ?>" readonly>
									</div>
									<div class="form-group">
										<label for="">Jumlah Populasi</label>
										<input type="number" name="populasi_admin" class="form-control" value="<?= $dataadmin->jml_populasi ?>" min="1">
									</div>
									<div class="form-group">
										<label for="">Jumlah Sampel (otomatis)</label>
										<input type="text" name="sampel_admin" class="form-control" value="<?= $dataadmin->jml_sampel ?>" readonly>
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
				</td>

			<?php
				
				}
			?>
			
			</table>
		
		<center>
	
<?php	
			$queryjmlsampelmhssikiring=mysqli_query($kon,"select * from jml_sampel_mhs where kode_jur='total'");
			$hasiljmlsampelmhssikiring = mysqli_fetch_object($queryjmlsampelmhssikiring);
			$jmlsampelmhssikiring=$hasiljmlsampelmhssikiring->jml_populasi;	
			
			//echo $jmlsampelmhssikiring;
			
			$queryjmlsampeldosensikiring=mysqli_query($kon,"select * from jml_sampel_dosen where kode_jur='total'");
			$hasiljmlsampeldosensikiring = mysqli_fetch_object($queryjmlsampeldosensikiring);
			$jmlsampeldosensikiring=$hasiljmlsampeldosensikiring->jml_populasi;	
			
			//echo $jmlsampeldosensikiring;

			
			$queryjmlsampeladminsikiring=mysqli_query($kon,"select * from jml_sampel_admin where kode_jur='total'");
			$hasiljmlsampeladminsikiring = mysqli_fetch_object($queryjmlsampeladminsikiring);
			$jmlsampeladminsikiring=$hasiljmlsampeladminsikiring->jml_populasi;	
			
			//echo $jmlsampeladminsikiring;

			$tombolsimpanfinalsemuasampel='<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalsimpanfinal">Simpan Final Jumlah Semua Sampel</button>';
		
		if($jmlsampelmhssikiring>0&&$jmlsampeldosensikiring>0&&$jmlsampeladminsikiring>0){
			
			echo $tombolsimpanfinalsemuasampel;
			
		}
		
		?>
		
		
		
		
		</center>			<div id="myModalsimpanfinal" class="modal fade" role="dialog">
						<div class="modal-dialog">

							
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Simpan Final Semua Jumlah Sampel</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form action="simpanfinal_sampelujicoba.php" method="post">
								
								
								Apakah anda yakin akan melakukan simpan final semua sampel? <br/>Data yang tersimpan tidak akan dapat diubah kembali.
								
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