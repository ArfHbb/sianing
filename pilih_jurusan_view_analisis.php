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
  	<title>Hasil Analisis Keseluruhan</title>
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
        <h2 class="mb-4" align="center">Pilih Hasil Analisis Tiap Jurusan</h2>
		
        
		<hr/>
		<br/>
		
		
			
			<center>
		
		<!-- disini isinya tabel, trus ada tombol mengarah ke hasil analisis
		-->
		
		<table class="table table-stripped table-hovered">
			<tr>
				<td><b>No</b></td>
				<td><b>Jurusan</b></td>
				<td><b>Action</b></td>
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
				$jurusannow=$per_mhs->kode_jur;
				
				?></td>
				 
								
				
				<td>
				<form action="penelitian_utama-perjurusan.php" method="post">
				<input type="hidden" name="jurusan_now" value='<?php echo $jurusannow;?>'>
				<button name="lihat" type="submit" class="btn btn-warning">Lihat</button>
				</form>
				</td>
				

			<?php
				
				}
			?>
			
			
			</tr>
			
			</table>
			
			
		
		<br/>
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