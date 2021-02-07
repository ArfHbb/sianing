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

?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Kelola Pertanyaan</title>
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
	          <li class="active">
	              <a href="#"><span class="fa fa-user mr-3"></span> Kelola Butir Pertanyaan</a>
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
	          <li>
              <a href="#"><span class="fa fa-suitcase mr-3"></span> Hasil Analisis Penelitian</a>
	          </li>';
			  
			  if($statusku=='pimpinan'){
				  echo $menuatursampel;
				  //echo $menuhasilanalisisutama;
			  }else if ($statusku=='peneliti'){
				  echo $menukelolabutirpertanyaan;
				  echo $menuvaliditasreliabilitas;
				  //echo $menupenelitianutama;
				  //echo $menuhasilanalisisutama;
				  
			  }
			  
			  
			  
			  
			  		  
//JIKA PENELITIAN SUDAH DILAKUKAN, MAKA TOMBOL RESET DAPAT TERLIHAT 

$apakahsudahditeliti = mysqli_query($kon,"select Count(*) from setting where nama='prosesanalisisutama' and ketentuan='sudah'");
$keterangansudahditeliti=	mysqli_fetch_assoc($apakahsudahditeliti);
$keterangansudahditeliti=implode($keterangansudahditeliti);
					

					$menuhasilanalisisutama='
	          <li>
              <a href="penelitian_utama.php"><span class="fa fa-suitcase mr-3"></span> Hasil Analisis Penelitian</a>
	          </li>';
					
$menureset='
	          <li>
              <a href="reset_penelitian-onlyview.php"><span class="fa fa-paper-plane mr-3"></span> Reset Penelitian</a>
	          </li>';
			  
if ($keterangansudahditeliti==1&&$statusku=='peneliti'){

echo $menuhasilanalisisutama;
echo $menureset;


}			  
			  
if ($keterangansudahditeliti==1&&$statusku=='pimpinan'){

echo $menuhasilanalisisutama;
			  
		
}
			  
			  ?>
			  
			  
			  <li>
              <a href="logout.php"><span class="fa fa-cogs mr-3"></span> Logout (<?php echo $_SESSION['username'];?>)</a>
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
        <h2 class="mb-4" align="center">Kelola Pertanyaan</h2>
		
		
		
		<?php
		//mengecek apakah sampel utama sudah diset atau belum jika belum akan ada popup notif bahwa belum diset, dan jika sudah akan ditampilkan progress data saat ini
			//aku salah kasih nama, harusnya bukan sampelujicoba, tapi sampel utama,hahahah
			
			
			$popup='<div class="modal-dialog">

							
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Prodi dan Jurusan Belum Disetting</h4>
								
							</div>
							<div class="modal-body">
								
								
								
								Silakan hubungi user pimpinan untuk mengisi prodi dan jurusan terlebih dahulu. 
								
									<div class="form-group">
										
									</div>
								
							</div>
							<div class="modal-footer">
							
								
							</div>
							</div>

						</div>';
			
			
			
			
			
			$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='statusfinaljurusanprodi'");
			$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
			$angkatotal=implode($angkatotal);



			if($angkatotal==1){
			$querystatusfinal=mysqli_query($kon,"select * from setting where nama='statusfinaljurusanprodi'");
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
		
		
		
		<br/>
		<h6 align="center">Responden Mahasiswa</h6>
		
			
			
			<br/><br/>
			
				<table class="table table-stripped table-hovered">
			<tr>
				<td>No</td>
				<td>Kode Pertanyaan</td>
				<td>Variabel</td>
				<td>Konstruk</td>
				<td>Butir Pertanyaan</td>
				
			</tr> 
			
			<?php
				$no = 0;
				$query_pertanyaan_mhs=mysqli_query($kon,"select * from butir_pertanyaan_mhs");
				while($per_mhs = mysqli_fetch_object($query_pertanyaan_mhs)){
					$no++;
			?>
			
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo $per_mhs->kode_pertanyaan ?></td>
				<td><?php echo $per_mhs->variabel ?></td>
				<td><?php echo $per_mhs->konstruk ?></td>
				<td><?php echo $per_mhs->pertanyaan ?></td>
				
				

			<?php
				
				}
			?>
			
			<tr id="form-insert" style="display:none">
				<td>
					<button class="btn btn-warning" onclick="hideForm()"><i class="fa fa-close"></i></button>
				</td>
					<!-- form tambah data -->
					
					<?php 
						$jmlper_mhs = mysqli_query($kon,"select Count(*) from butir_pertanyaan_mhs");
						
						foreach (mysqli_fetch_assoc($jmlper_mhs) as $key ) {
							$angka =  $key+1;
							
						}
					?>
					
					<form action="<?= 'simpan_per_mhs.php' ?>" method="post">
						<td><input type="text" name="kodeper_mhs" class="form-control" id="kodeper_mhs" placeholder="Masukkan Periode" value=qm<?=$angka?> readonly></td>
						<td>
						
						<select name="variabel_mhs" id="variabel_mhs" class="form-control" required>
						<option disabled selected value>-- Pilih Variabel --</option>
										<option value="Teknologi">Teknologi</option>
										<option value="Inovasi">Inovasi</option>
										<option value="Manusia">Manusia</option>
										<option value="Pengembangan Diri">Pengembangan Diri</option>
						</select>
						
						</td>
						
						<td>
						
						<select name="konstruk_mhs" id="konstruk_mhs" class="form-control" required>
						<option disabled selected value>-- Pilih Konstruk --</option>
										<option value="Sumber Daya">Sumber Daya</option>
										<option value="Keterampilan">Keterampilan</option>
										<option value="Sikap">Sikap</option>
						</select>
						
						</td>
						
						<td><input type="text" name="per_mhs" class="form-control" id="per_mhs" placeholder="Masukkan Pertanyaan" required></td>
						
						<td>
							<button name="simpan" type="submit" class="btn btn-primary"><i class="fa fa-true"></i> Simpan</button>
						</td>
					</form>
			</tr>
			</table> 
		
		
		<br/>
		<h6 align="center">Responden Dosen</h6>
		
			
			
				<br/><br/>
			
				<table class="table table-stripped table-hovered">
			<tr>
				<td>No</td>
				<td>Kode Pertanyaan</td>
				<td>Variabel</td>
				<td>Konstruk</td>
				<td>Butir Pertanyaan</td>
				
			</tr> 
			
			<?php
				$no = 0;
				$query_pertanyaan_dosen=mysqli_query($kon,"select * from butir_pertanyaan_dosen");
				while($per_dosen = mysqli_fetch_object($query_pertanyaan_dosen)){
					$no++;
			?>
			
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo $per_dosen->kode_pertanyaan ?></td>
				<td><?php echo $per_dosen->variabel ?></td>
				<td><?php echo $per_dosen->konstruk ?></td>
				<td><?php echo $per_dosen->pertanyaan ?></td>
				
				

			<?php
				
				}
			?>
			
			<tr id="form-insertDosen" style="display:none">
				<td>
					<button class="btn btn-warning" onclick="hideFormDosen()"><i class="fa fa-close"></i></button>
				</td>
					<!-- form tambah data -->
					
					<?php 
						$jmlper_dosen = mysqli_query($kon,"select Count(*) from butir_pertanyaan_dosen");
						
						foreach (mysqli_fetch_assoc($jmlper_dosen) as $key ) {
							$angka =  $key+1;
							
						}
					?>
					
					<form action="<?= 'simpan_per_dosen.php' ?>" method="post">
						<td><input type="text" name="kodeper_dosen" class="form-control" id="kodeper_dosen" placeholder="Masukkan Periode" value=qd<?=$angka?> readonly></td>
						<td>
						
						<select name="variabel_dosen" id="variabel_dosen" class="form-control" required>
						<option disabled selected value>-- Pilih Variabel --</option>
						<option value="Teknologi">Teknologi</option>
						<option value="Inovasi">Inovasi</option>
						<option value="Manusia">Manusia</option>
						<option value="Pengembangan Diri">Pengembangan Diri</option>
						</select>
						
						</td>
						
						<td>
						
						<select name="konstruk_dosen" id="konstruk_dosen" class="form-control" required>
						<option disabled selected value>-- Pilih Konstruk --</option>
						<option value="Sumber Daya">Sumber Daya</option>
						<option value="Keterampilan">Keterampilan</option>
						<option value="Sikap">Sikap</option>
						</select>
						
						</td>
						
						<td><input type="text" name="per_dosen" class="form-control" id="per_dosen" placeholder="Masukkan Pertanyaan" required></td>
						
						<td>
							<button name="simpan" type="submit" class="btn btn-primary"><i class="fa fa-true"></i> Simpan</button>
						</td>
					</form>
			</tr>
			</table> 
		
		
		
		
		
		
		<br/>
		<h6 align="center">Responden Admin</h6>
		
			
			
				<br/><br/>
			
				<table class="table table-stripped table-hovered">
			<tr>
				<td>No</td>
				<td>Kode Pertanyaan</td>
				<td>Variabel</td>
				<td>Konstruk</td>
				<td>Butir Pertanyaan</td>
				
			</tr> 
			
			<?php
				$no = 0;
				$query_pertanyaan_admin=mysqli_query($kon,"select * from butir_pertanyaan_admin");
				while($per_admin = mysqli_fetch_object($query_pertanyaan_admin)){
					$no++;
			?>
			
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo $per_admin->kode_pertanyaan ?></td>
				<td><?php echo $per_admin->variabel ?></td>
				<td><?php echo $per_admin->konstruk ?></td>
				<td><?php echo $per_admin->pertanyaan ?></td>
				
				

			<?php
				
				}
			?>
			
			<tr id="form-insertAdmin" style="display:none">
				<td>
					<button class="btn btn-warning" onclick="hideFormAdmin()"><i class="fa fa-close"></i></button>
				</td>
					<!-- form tambah data -->
					
					<?php 
						$jmlper_admin = mysqli_query($kon,"select Count(*) from butir_pertanyaan_admin");
						
						foreach (mysqli_fetch_assoc($jmlper_admin) as $key ) {
							$angka =  $key+1;
							
						}
					?>
					
					<form action="<?= 'simpan_per_admin.php' ?>" method="post">
						<td><input type="text" name="kodeper_admin" class="form-control" id="kodeper_admin" placeholder="Masukkan Periode" value=qa<?=$angka?> readonly></td>
						<td>
						
						<select name="variabel_admin" id="variabel_admin" class="form-control"required>
						<option disabled selected value>-- Pilih Variabel --</option>
						<option value="Teknologi">Teknologi</option>
						<option value="Inovasi">Inovasi</option>
						<option value="Manusia">Manusia</option>
						<option value="Pengembangan Diri">Pengembangan Diri</option>
						</select>
						
						</td>
						
						<td>
						
						<select name="konstruk_admin" id="konstruk_admin" class="form-control" required>
						<option disabled selected value>-- Pilih Konstruk --</option>
							<option value="Sumber Daya">Sumber Daya</option>
							<option value="Keterampilan">Keterampilan</option>
							<option value="Sikap">Sikap</option>
						</select>
						
						</td>
						
						<td><input type="text" name="per_admin" class="form-control" id="per_admin" placeholder="Masukkan Pertanyaan" required></td>
						
						<td>
							<button name="simpan" type="submit" class="btn btn-primary"><i class="fa fa-true"></i> Simpan</button>
						</td>
					</form>
			</tr>
			</table> 
		
		
		
		<br/>
		<center>
		</center>			<div id="myModalsimpanfinal" class="modal fade" role="dialog">
						<div class="modal-dialog">

							
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Simpan Final Semua Pertanyaan</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form action="simpan final semua pertanyaan.php" method="post">
								
								
								Apakah anda yakin akan melakukan simpan final semua pertanyaan? <br/>Data yang tersimpan tidak akan dapat diubah kembali.
								
									<div class="form-group">
										
									</div>
								</form>
							</div>
							<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Yakin</button>
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
			$("#per_mhs").focus();
		}
	}
	function hideForm(){
		$("#form-insert").hide();
	}
	
	function showFormDosen(){
		if($("#form-insertDosen").is(':hidden')==true){
			$("#form-insertDosen").show();
			$("#per_dosen").focus();
		}
	}
	function hideFormDosen(){
		$("#form-insertDosen").hide();
	}
	
	function showFormAdmin(){
		if($("#form-insertAdmin").is(':hidden')==true){
			$("#form-insertAdmin").show();
			$("#per_admin").focus();
		}
	}
	function hideFormAdmin(){
		$("#form-insertAdmin").hide();
	}
</script>
  </body>
</html>