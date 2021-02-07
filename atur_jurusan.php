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

if($statusku=='peneliti'){
	$_SESSION['msg_per_mhs']="";
	$_SESSION['msg_per_dosen']="";
	$_SESSION['msg_per_admin']="";
	header('location:kelola_pertanyaan.php');
	
}else if($statusku=='pimpinan'){
	header('location:index-pimpinan.php');
	
}



?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Atur Jurusan</title>
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
			
			<!-- saya ingin memperbaiki menu bar disamping -->
			
			
			
			
	          <?php
			  
			  $menuaturjurusan='
	          <li class="active">
              <a href="atur_jurusan.php"><span class="fa fa-sticky-note mr-3"></span> Atur Jurusan</a>
	          </li>';
				
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
			  
			  if($statusku=='admin'){
				  echo $menuaturjurusan;
				  //echo $menuatursampel;
				  
				  
				  
			$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='statusfinaljurusanprodi'");
			$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
			$angkatotal=implode($angkatotal);
	
			
				
			if ($angkatotal==1){

			//tampilkan buton

			echo $menuatursampel;
	
			}	
				  
				  
				  
				  
			$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='prosesanalisisutama'");
			$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
			$angkatotal=implode($angkatotal);
	
			$menuprosesanalisisutama='
	          <li>
              <a href="penelitian_utama-onlyview.php"><span class="fa fa-suitcase mr-3"></span> Hasil Analisis Penelitian</a>
	          </li>';
				
			if ($angkatotal==1){

			//tampilkan buton

			echo $menuprosesanalisisutama;
	
			}	
			
				  
				  
				  
				  
				  //echo $menuhasilanalisisutama;
			  }else if ($statusku=='peneliti'){
				  echo $menukelolabutirpertanyaan;
				  echo $menuvaliditasreliabilitas;
				  //echo $menupenelitianutama;
				  //echo $menuhasilanalisisutama;
				  
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
        <h2 class="mb-4" align="center">Atur Jurusan</h2>
		
		
		
		

<div id="myModalpesanjurusan" class="modal fade" role="dialog">
			
						<div class="modal-dialog">

							
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Data Sama</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form method="post">
								
								
								Data kode jurusan atau nama jurusan sudah ada. Masukkan data jurusan yang berbeda. 
								
									<div class="form-group">
										
									</div>
								
							</div>
							<div class="modal-footer">
							
							</form>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
							</div>
							</div>

						</div>
					</div>
					
					
					

		
		
		<div id="myModalpesanprodi" class="modal fade" role="dialog">
		
				
						<div class="modal-dialog">

							
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Data Sama</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form method="post">
								
								
								Data nama prodi sudah ada. Masukkan data prodi yang berbeda. 
								
									<div class="form-group">
										
									</div>
								
							</div>
							<div class="modal-footer">
							
							</form>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
							</div>
							</div>

						</div>
					</div>
		
		
		
	
		
		<p align="center"> Sebelum memulai penelitian, Anda diminta untuk memasukkan data jurusan dan program studi</p>
        <br/>
	
		
		<p align="center">Jurusan</p>
		
		
		<?php
		
		

//PENGATURAN STATUS FINAL PENENTUAN SAMPEL UJI COBA 

$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='statusfinaljurusanprodi'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);

$buttonprodi='<button class="btn btn-primary" onclick="showFormprodi()"><i class="fa fa-plus"></i> Tambah Data Prodi</button>';
$buttonjurusan='<button class="btn btn-primary" onclick="showForm()"><i class="fa fa-plus"></i> Tambah Data Jurusan</button>';
$buttonsimpanfinal='<button type="button" data-toggle="modal" class="btn btn-success" data-target="#myModalsimpanfinal"><i class="fa fa-true"></i> Simpan Final Data Jurusan dan Prodi</button>';

if ($angkatotal==0){

//tampilkan buton

	echo $buttonjurusan;
	
}	
		
		?>
		
			
			
					<br/><br/>
			
				<table class="table table-stripped table-hovered">
			<tr>
				<td><b>No</b></td>
				<td><b>Kode Jurusan</b></td>
				<td><b>Jurusan</b></td>
				
			</tr> 
			
			<?php
				$no = 0;
				$query_pertanyaan_mhs=mysqli_query($kon,"select * from jurusan");
				while($per_mhs = mysqli_fetch_object($query_pertanyaan_mhs)){
					$no++;
			?>
			
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo $per_mhs->kode_jurusan ?></td>
				<td><?php echo $per_mhs->jurusan ?></td>
				
					

			<?php
				
				}
			?>
			
			<tr id="form-insert" style="display:none">
				<td>
					<button class="btn btn-warning" onclick="hideForm()"><i class="fa fa-close"></i></button>
				</td>
					<!-- form tambah data -->
					
										
					<form action="<?= 'simpan_data_jurusan.php' ?>" method="post">
						<td><input type="text" name="kode_jurusan" class="form-control" id="kode_jurusan" placeholder="Masukkan Periode" required></td>
						<td>
						<input type="text" name="jurusan" class="form-control" id="jurusan" placeholder="Masukkan Pertanyaan" required>			
						</td>
						
						
						<td>
							<button name="simpan" type="submit" class="btn btn-primary"><i class="fa fa-true"></i> Simpan</button>
						</td>
					</form>
			</tr>
			</table> 
		
			
			<br/>
			<br/>
			<p align="center">Program Studi</p>
			<br/>
			
			<?php
			
			if ($angkatotal==0){

//tampilkan buton

	echo $buttonprodi;
	
}	
			?>
			
			
			<br/><br/>
			
				<table class="table table-stripped table-hovered">
			<tr>
				<td><b>No</b></td>
				<td><b>Jurusan</b></td>
				<td><b>Prodi</b></td>
				
			</tr> 
			
			<?php
				$no = 0;
				$query_pertanyaan_mhs=mysqli_query($kon,"select * from prodi");
				while($per_mhs = mysqli_fetch_object($query_pertanyaan_mhs)){
					$no++;
			?>
			
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo $per_mhs->jurusan ?></td>
				<td><?php echo $per_mhs->prodi ?></td>
				
					

			<?php
				
				}
			?>
			
			<tr id="form-insertprodi" style="display:none">
				<td>
					<button class="btn btn-warning" onclick="hideFormprodi()"><i class="fa fa-close"></i></button>
				</td>
					<!-- form tambah data -->
					
										
					<form action="<?= 'simpan_data_prodi.php' ?>" method="post">
						<td>
						<p style="color:black">
						<select name="jurusan" id="jurusan" class="form-control" placeholder="Masukkan Pertanyaan" required>
						<option disabled selected value>-- Pilih Jurusan --</option>
						<?php
						$queryambiljurusan="select * from jurusan";
						$hasilqueryjurusan=mysqli_query($kon,$queryambiljurusan);
						
						while($datajurusan=mysqli_fetch_assoc($hasilqueryjurusan)){
							
							
							?>
							<font color="black">
							
							<option value="<?php echo $datajurusan['jurusan'];?>"> <?php echo $datajurusan['jurusan'];?></option>
							</font>
						<?php
						
						}
						
						
						?>
						
						</select>
						</p>
						</td>
						<td>
						<input type="text" name="prodi" class="form-control" id="prodi" placeholder="Masukkan Pertanyaan" required>			
						</td>
						
						
						<td>
							<button name="simpan" type="submit" class="btn btn-primary"><i class="fa fa-true"></i> Simpan</button>
						</td>
					</form>
			</tr>
			</table> 
		
			<br/>
			<center>
			
<?php

			$jmljurusan = mysqli_query($kon,"select Count(*) from jurusan");
			$angkajurusan=	mysqli_fetch_assoc($jmljurusan);
			$angkajurusan=implode($angkajurusan);
	
			$jmlprodi = mysqli_query($kon,"select Count(*) from prodi");
			$angkaprodi=	mysqli_fetch_assoc($jmlprodi);
			$angkaprodi=implode($angkaprodi);
			
if ($angkatotal==0&&$angkajurusan!=0&&$angkaprodi!=0){

//tampilkan buton

	echo $buttonsimpanfinal;
	
}	
		
		?>
			
			</center>
			
			<div id="myModalsimpanfinal" class="modal fade" role="dialog">
						<div class="modal-dialog">

							
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Simpan Final data Jurusan dan Prodi</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form action="simpanfinal_jurusan_prodi.php" method="post">
								
								
								Apakah anda yakin akan melakukan simpan final data jurusan dan prodi? <br/>Data yang tersimpan tidak dapat diubah kembali.
								
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

	<script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
	<script type="text/javascript">
	function showForm(){
		if($("#form-insert").is(':hidden')==true){
			$("#form-insert").show();
			$("#kode_jurusan").focus();
		}
	}
	function hideForm(){
		$("#form-insert").hide();
	}
	
		function showFormprodi(){
		if($("#form-insertprodi").is(':hidden')==true){
			$("#form-insertprodi").show();
			$("#prodi").focus();
		}
	}
	function hideFormprodi(){
		$("#form-insertprodi").hide();
	}

	</script>
	
	
		<?php
		
		
			
			if($_SESSION['msg_jurusan']=='sama'){
				
			
			echo '<script>
				
				
				$("#myModalpesanjurusan").modal("show");
			
			</script>';
			
			
			
				
			}else if($_SESSION['msg_prodi']=='sama'){
								
			
			echo '<script>
				
				
				$("#myModalpesanprodi").modal("show");
			
			</script>';
			
			
			
			//$msg_jurusan='';
				
			}
		
		?>
	
	
  </body>
</html>