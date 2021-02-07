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
  	<title>Reset Penelitian</title>
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
	          <li>
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
			  
			  
			  
			  //dibawah ini adalah kode untuk menampilkan tombol reset

//JIKA PENELITIAN SUDAH DILAKUKAN, MAKA TOMBOL RESET DAPAT TERLIHAT 

$apakahsudahditeliti = mysqli_query($kon,"select Count(*) from setting where nama='prosesanalisisutama' and ketentuan='sudah'");
$keterangansudahditeliti=	mysqli_fetch_assoc($apakahsudahditeliti);
$keterangansudahditeliti=implode($keterangansudahditeliti);
					

					
$menureset='
	          <li class="active">
              <a href="#"><span class="fa fa-paper-plane mr-3"></span> Reset Penelitian</a>
	          </li>';
			  
if ($keterangansudahditeliti==1){

echo $menureset;

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
        <h2 class="mb-4" align="center">Reset Penelitian</h2>
				<hr/>

		<p align="justify"> Jika penelitian sudah selesai, Anda dapat melakukan reset penelitian. Reset penelitian akan menghapus semua data, termasuk login, data responden, data analisis dan lain-lain. Pastikan Anda telah mendownload hasil penelitian agar analisis penelitian dapat dilihat kembali. </p>
        <br/>
		
        
		
		<br/>
		<center>
		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModalsimpanfinalpertanyaan">Reset Penelitian</button>
		</center>			<div id="myModalsimpanfinalpertanyaan" class="modal fade" role="dialog">
						<div class="modal-dialog">

							
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Simpan Final Semua Pertanyaan</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form action="reset_penelitian.php" method="post">
								
								
								Apakah anda yakin akan melakukan reset penelitian? <br/>Reset penelitian akan menghapus semua data penelitian, termasuk data sampel, pertanyaan, respon jawaban dan analisis penelitian.
								
									<div class="form-group">
										
									</div>
								
							</div>
							<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Yakin</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
							</div>
							</form>
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