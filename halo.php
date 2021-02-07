<?php include 'koneksi.php'; ?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Beranda Peneliti</title>
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
	            <a href="#"><span class="fa fa-home mr-3"></span> Atur Sampel</a>
	          </li>
	          <li>
	              <a href="kelola_pertanyaan.php"><span class="fa fa-user mr-3"></span> Kelola Butir Pertanyaan</a>
	          </li>
	          <li  class="active">
              <a href="tentukan_sampel_ujicoba.php"><span class="fa fa-briefcase mr-3"></span> Pengujian Validitas dan Reliabilitas</a>
	          </li>
	          <li>
              <a href="#"><span class="fa fa-sticky-note mr-3"></span> Penelitian Utama</a>
	          </li>
	          <li>
              <a href="#"><span class="fa fa-suitcase mr-3"></span> Hasil Analisis Penelitian</a>
	          </li>
			  <li>
              <a href="#"><span class="fa fa-cogs mr-3"></span> Logout</a>
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
			
		<center>
		<button class="btn btn-primary" onclick="showForm()"> Lanjutkan ke Penelitian Utama !</button>		
		</center>
		
		
		</div>
		</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>