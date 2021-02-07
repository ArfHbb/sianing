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




$jmlbaristotal = mysqli_query($kon,"select Count(*) from setting where nama='statusfinalsemuapertanyaan'");
$angkatotal=	mysqli_fetch_assoc($jmlbaristotal);
$angkatotal=implode($angkatotal);



if($angkatotal==1){
$querystatusfinal=mysqli_query($kon,"select * from setting where nama='statusfinalsemuapertanyaan'");
$hasilquerystatusfinal = mysqli_fetch_object($querystatusfinal);
$statusfinal=$hasilquerystatusfinal->ketentuan;
if($statusfinal=='sudah'){
	header('location:kelola_pertanyaan-onlyview.php');
}
}

else{
		//header('location:kelola_pertanyaan.php');
}


			$querytanyajurusan = mysqli_query($kon,"select Count(*) from setting where nama='statusfinaljurusanprodi'");
			$tanyajurusan=	mysqli_fetch_assoc($querytanyajurusan);
			$tanyajurusan=implode($tanyajurusan);
			
			$querytanyasampel = mysqli_query($kon,"select Count(*) from setting where nama='statusfinalsampelujicoba'");
			$tanyasampel=	mysqli_fetch_assoc($querytanyasampel);
			$tanyasampel=implode($tanyasampel);

			$jurusandansampel="fix";

			
			if($tanyajurusan==0||$tanyasampel==0){
				
				
				//echo $popup;
				$jurusandansampel="tidak fix";
				
				
			}

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
		
			<script src="jquery.min.js"></script>
	<script language="javascript" type="text/javascript">  
$(document).ready(function(){

//let's create arrays
var Teknologi = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }, 
	{display: "Sikap", value: "Sikap" }];
	
var Inovasi = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }, 
	{display: "Sikap", value: "Sikap" }];
	

var Manusia = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }];
	
var Pengembangan_Diri = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }, 
	{display: "Sikap", value: "Sikap" }];
	


//If parent option is changed
$("#variabel_mhs").change(function() {
		var parent = $(this).val(); //get option value from parent 
		
		switch(parent){ //using switch compare selected option and populate child
			  case 'Teknologi':
			 	list(Teknologi);
				break;
			  case 'Inovasi':
			 	list(Inovasi);
				break;				
			case 'Manusia':
			 	list(Manusia);
				break;			
			case 'Pengembangan_Diri':
			 	list(Pengembangan_Diri);
				break;						
			default: //default child option is blank
				$("#konstruk_mhs").html('');	 
				break;
		   }
});

//function to populate child select box
function list(array_list)
{
	$("#konstruk_mhs").html(""); //reset child options
	$(array_list).each(function (i) { //populate child options 
		$("#konstruk_mhs").append("<option value=\""+array_list[i].value+"\">"+array_list[i].display+"</option>");
	});
}

});



//------------------------------------------------------------------


$(document).ready(function(){

//let's create arrays
var Teknologi = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }, 
	{display: "Sikap", value: "Sikap" }];
	
var Inovasi = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }, 
	{display: "Sikap", value: "Sikap" }];
	

var Manusia = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }];
	
var Pengembangan_Diri = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }, 
	{display: "Sikap", value: "Sikap" }];
	


//If parent option is changed
$("#variabel_mhs_tambah").change(function() {
		var parent = $(this).val(); //get option value from parent 
		
		switch(parent){ //using switch compare selected option and populate child
			  case 'Teknologi':
			 	list(Teknologi);
				break;
			  case 'Inovasi':
			 	list(Inovasi);
				break;				
			case 'Manusia':
			 	list(Manusia);
				break;			
			case 'Pengembangan_Diri':
			 	list(Pengembangan_Diri);
				break;						
			default: //default child option is blank
				$("#konstruk_mhs_tambah").html('');	 
				break;
		   }
});

//function to populate child select box
function list(array_list)
{
	$("#konstruk_mhs_tambah").html(""); //reset child options
	$(array_list).each(function (i) { //populate child options 
		$("#konstruk_mhs_tambah").append("<option value=\""+array_list[i].value+"\">"+array_list[i].display+"</option>");
	});
}

});


//---------------------------------------------------------------------------------------


$(document).ready(function(){

//let's create arrays
var Teknologi = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }, 
	{display: "Sikap", value: "Sikap" }];
	
var Inovasi = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }, 
	{display: "Sikap", value: "Sikap" }];
	

var Manusia = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }];
	
var Pengembangan_Diri = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }, 
	{display: "Sikap", value: "Sikap" }];
	


//If parent option is changed
$("#variabel_dosen").change(function() {
		var parent = $(this).val(); //get option value from parent 
		
		switch(parent){ //using switch compare selected option and populate child
			  case 'Teknologi':
			 	list(Teknologi);
				break;
			  case 'Inovasi':
			 	list(Inovasi);
				break;				
			case 'Manusia':
			 	list(Manusia);
				break;			
			case 'Pengembangan_Diri':
			 	list(Pengembangan_Diri);
				break;						
			default: //default child option is blank
				$("#konstruk_dosen").html('');	 
				break;
		   }
});

//function to populate child select box
function list(array_list)
{
	$("#konstruk_dosen").html(""); //reset child options
	$(array_list).each(function (i) { //populate child options 
		$("#konstruk_dosen").append("<option value=\""+array_list[i].value+"\">"+array_list[i].display+"</option>");
	});
}

});


//--------------------------------------------------------------------------------


$(document).ready(function(){

//let's create arrays
var Teknologi = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }, 
	{display: "Sikap", value: "Sikap" }];
	
var Inovasi = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }, 
	{display: "Sikap", value: "Sikap" }];
	

var Manusia = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }];
	
var Pengembangan_Diri = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }, 
	{display: "Sikap", value: "Sikap" }];
	


//If parent option is changed
$("#variabel_dosen_tambah").change(function() {
		var parent = $(this).val(); //get option value from parent 
		
		switch(parent){ //using switch compare selected option and populate child
			  case 'Teknologi':
			 	list(Teknologi);
				break;
			  case 'Inovasi':
			 	list(Inovasi);
				break;				
			case 'Manusia':
			 	list(Manusia);
				break;			
			case 'Pengembangan_Diri':
			 	list(Pengembangan_Diri);
				break;						
			default: //default child option is blank
				$("#konstruk_dosen_tambah").html('');	 
				break;
		   }
});

//function to populate child select box
function list(array_list)
{
	$("#konstruk_dosen_tambah").html(""); //reset child options
	$(array_list).each(function (i) { //populate child options 
		$("#konstruk_dosen_tambah").append("<option value=\""+array_list[i].value+"\">"+array_list[i].display+"</option>");
	});
}

});

//-------------------------------------------------------------------------------


$(document).ready(function(){

//let's create arrays
var Teknologi = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }, 
	{display: "Sikap", value: "Sikap" }];
	
var Inovasi = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }, 
	{display: "Sikap", value: "Sikap" }];
	

var Manusia = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }];
	
var Pengembangan_Diri = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }, 
	{display: "Sikap", value: "Sikap" }];
	


//If parent option is changed
$("#variabel_admin").change(function() {
		var parent = $(this).val(); //get option value from parent 
		
		switch(parent){ //using switch compare selected option and populate child
			  case 'Teknologi':
			 	list(Teknologi);
				break;
			  case 'Inovasi':
			 	list(Inovasi);
				break;				
			case 'Manusia':
			 	list(Manusia);
				break;			
			case 'Pengembangan_Diri':
			 	list(Pengembangan_Diri);
				break;						
			default: //default child option is blank
				$("#konstruk_admin").html('');	 
				break;
		   }
});

//function to populate child select box
function list(array_list)
{
	$("#konstruk_admin").html(""); //reset child options
	$(array_list).each(function (i) { //populate child options 
		$("#konstruk_admin").append("<option value=\""+array_list[i].value+"\">"+array_list[i].display+"</option>");
	});
}

});


//--------------------------------------------------------------------------------------


$(document).ready(function(){

//let's create arrays
var Teknologi = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }, 
	{display: "Sikap", value: "Sikap" }];
	
var Inovasi = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }, 
	{display: "Sikap", value: "Sikap" }];
	

var Manusia = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }];
	
var Pengembangan_Diri = [
	{display: "Sumber Daya", value: "Sumber_Daya" }, 
	{display: "Keterampilan", value: "Keterampilan" }, 
	{display: "Sikap", value: "Sikap" }];
	


//If parent option is changed
$("#variabel_admin_tambah").change(function() {
		var parent = $(this).val(); //get option value from parent 
		
		switch(parent){ //using switch compare selected option and populate child
			  case 'Teknologi':
			 	list(Teknologi);
				break;
			  case 'Inovasi':
			 	list(Inovasi);
				break;				
			case 'Manusia':
			 	list(Manusia);
				break;			
			case 'Pengembangan_Diri':
			 	list(Pengembangan_Diri);
				break;						
			default: //default child option is blank
				$("#konstruk_admin_tambah").html('');	 
				break;
		   }
});

//function to populate child select box
function list(array_list)
{
	$("#konstruk_admin_tambah").html(""); //reset child options
	$(array_list).each(function (i) { //populate child options 
		$("#konstruk_admin_tambah").append("<option value=\""+array_list[i].value+"\">"+array_list[i].display+"</option>");
	});
}

});
</script>
		
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
			  $menuvaliditasreliabilitas_onlyview='
	          <li>
              <a href="#"><span class="fa fa-briefcase mr-3"></span> Pengujian Validitas dan Reliabilitas</a>
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
				  
				  if($tanyajurusan==0||$tanyasampel==0){
				
						echo $menuvaliditasreliabilitas_onlyview;
					}else{
						echo $menuvaliditasreliabilitas;
					}
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
        <h2 class="mb-4" align="center">Kelola Pertanyaan</h2>
		
		
		<div id="myModalpermhs" class="modal fade" role="dialog">
			
						<div class="modal-dialog">

							
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Pertanyaan Sama</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form method="post">
								
								
								Pertanyaan ini sudah ada. Masukkan pertanyaan yang berbeda untuk responden mahasiswa. 
								
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
					
					
					<div id="myModalperdosen" class="modal fade" role="dialog">
			
						<div class="modal-dialog">

							
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Pertanyaan Sama</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form method="post">
								
								
								Pertanyaan ini sudah ada. Masukkan pertanyaan yang berbeda untuk responden dosen. 
								
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
					
					
					<div id="myModalperadmin" class="modal fade" role="dialog">
			
						<div class="modal-dialog">

							
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Pertanyaan Sama</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form method="post">
								
								
								Pertanyaan ini sudah ada. Masukkan pertanyaan yang berbeda untuk responden admin prodi. 
								
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
		
		
		
		<p align="justify"> Anda diminta untuk memasukkan butir pertanyaan yang akan dibagikan beserta variabel dan konstruknya. Adapun butir pertanyaan dibagi menjadi tiga responden, yaitu mahasiswa aktif, dosen tetap dan tenaga administrasi program studi di lingkungan Polije.</p>
        
		
		
		
		
		
		
		
		<?php
		//mengecek apakah sampel utama sudah diset atau belum jika belum akan ada popup notif bahwa belum diset, dan jika sudah akan ditampilkan progress data saat ini
			//aku salah kasih nama, harusnya bukan sampelujicoba, tapi sampel utama,hahahah
			
			
			$popup='<div class="modal-dialog">

							
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Jurusan atau Sampel Belum Disetting</h4>
								
							</div>
							<div class="modal-body">
								
								
								
								Anda tidak dapat melakukan simpan final jika data jurusan atau data sampel belum diatur. Silakan hubungi user admin untuk mengisi jurusan dan sampel terlebih dahulu. 
								
									<div class="form-group">
										
									</div>
								
							</div>
							<div class="modal-footer">
							
								
							</div>
							</div>

						</div>';
			
			
			
			
			
			

			if($tanyajurusan==0||$tanyasampel==0){
				
				
				echo $popup;
				
				
				
			}
				
			
			//$querystatusfinal=mysqli_query($kon,"select * from setting where nama='statusfinaljurusanprodi'");
			//$hasilquerystatusfinal = mysqli_fetch_object($querystatusfinal);
			//$statusfinal=$hasilquerystatusfinal->ketentuan;
			
			
			
			//if($statusfinal=='sudah'){
				
				//$simpanfinalpertanyaan='sudah';
				
			//}else{
				//echo $popup;
				//$simpanfinalpertanyaan='belum';
				
			//}
			
			//}

			//else{
				
			//if di db gak ada, maka tampilkan popup
			//echo $popup;
			//$simpanfinalpertanyaan='belum';
			//}
		
		
		
		
		
		?>
		
		
		
		
		
		
		
		
		
		
		
		
		
		<br/>
		<h6 align="center">Responden Mahasiswa</h6>
		
			
			
			<button class="btn btn-primary" onclick="showForm()"><i class="fa fa-plus"></i> Tambah Data</button>
			<br/><br/>
			
				<table class="table table-stripped table-hovered">
			<tr>
				<td>No</td>
				<td>Kode Pertanyaan</td>
				<td>Variabel</td>
				<td>Konstruk</td>
				<td>Butir Pertanyaan</td>
				<td>Action</td>
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
				
				<td>
					<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModalper_mhs<?php echo $per_mhs->kode_pertanyaan ?>"><i class="fa fa-pencil"></i></button>
					<div id="myModalper_mhs<?php echo $per_mhs->kode_pertanyaan?>" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Edit Data</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form action="update_per_mhs.php" method="post">
								
								<!--
								<?php
								$kode_per=$per_mhs->kode_pertanyaan;
								echo $kode_per;
								?>
								-->
								
								
								
									<div class="form-group">
										<label for="">Kode Pertanyaan</label>
										<input type="text" name="kode_pertanyaan_mhs" class="form-control" value="<?=  $per_mhs->kode_pertanyaan; ?>" readonly>
									</div>
									<div class="form-group">
										<label for="">Variabel</label>
										<select name="variabel_mhs" id="variabel_mhs" class="form-control" required>
										<option disabled selected value>-- Pilih Variabel --</option>
										<option value="Teknologi">Teknologi</option>
										<option value="Inovasi">Inovasi</option>
										<option value="Manusia">Manusia</option>
										<option value="Pengembangan_Diri">Pengembangan Diri</option>
										</select>
									</div>
									<div class="form-group">
										<label for="">Konstruk</label>
										<select name="konstruk_mhs" id="konstruk_mhs" class="form-control" required>
										<option disabled selected value>-- Pilih Konstruk --</option>
										<option value="Sumber_Daya">Sumber Daya</option>
										<option value="Keterampilan">Keterampilan</option>
										<option value="Sikap">Sikap</option>
										
										</select>
									</div>
									<div class="form-group">
										<label for="">Pertanyaan</label>
										<input type="text" name="pertanyaan_mhs" class="form-control" value="<?= $per_mhs->pertanyaan ?>" required>
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
						
						<select name="variabel_mhs_tambah" id="variabel_mhs_tambah" class="form-control" required>
						<option disabled selected value>-- Pilih Variabel --</option>
										<option value="Teknologi">Teknologi</option>
										<option value="Inovasi">Inovasi</option>
										<option value="Manusia">Manusia</option>
										<option value="Pengembangan_Diri">Pengembangan Diri</option>
						</select>
						
						</td>
						
						<td>
						
						<select name="konstruk_mhs_tambah" id="konstruk_mhs_tambah" class="form-control" required>
						<option disabled selected value>-- Pilih Konstruk --</option>
										<option value="Sumber_Daya">Sumber Daya</option>
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
		
			
			
			<button class="btn btn-primary" onclick="showFormDosen()"><i class="fa fa-plus"></i> Tambah Data</button>
			<br/><br/>
			
				<table class="table table-stripped table-hovered">
			<tr>
				<td>No</td>
				<td>Kode Pertanyaan</td>
				<td>Variabel</td>
				<td>Konstruk</td>
				<td>Butir Pertanyaan</td>
				<td>Action</td>
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
				
				<td>
					<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModalper_dosen<?php echo $per_dosen->kode_pertanyaan ?>"><i class="fa fa-pencil"></i></button>
					<div id="myModalper_dosen<?php echo $per_dosen->kode_pertanyaan?>" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Edit Data</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form action="update_per_dosen.php" method="post">
								
								<!--
								<?php
								$kode_per=$per_dosen->kode_pertanyaan;
								echo $kode_per;
								?>
								-->
								
								
								
									<div class="form-group">
										<label for="">Kode Pertanyaan</label>
										<input type="text" name="kode_pertanyaan_dosen" class="form-control" value="<?=  $per_dosen->kode_pertanyaan; ?>" readonly>
									</div>
									<div class="form-group">
										<label for="">Variabel</label>
										<select name="variabel_dosen" id="variabel_dosen" class="form-control" required>
										<option disabled selected value>-- Pilih Variabel --</option>
										<option value="Teknologi">Teknologi</option>
										<option value="Inovasi">Inovasi</option>
										<option value="Manusia">Manusia</option>
										<option value="Pengembangan_Diri">Pengembangan Diri</option>
										</select>
									</div>
									<div class="form-group">
										<label for="">Konstruk</label>
										<select name="konstruk_dosen" id="konstruk_dosen" class="form-control" required>
										<option disabled selected value>-- Pilih Konstruk --</option>
										<option value="Sumber_Daya">Sumber Daya</option>
										<option value="Keterampilan">Keterampilan</option>
										<option value="Sikap">Sikap</option>
										</select>
									</div>
									<div class="form-group">
										<label for="">Pertanyaan</label>
										<input type="text" name="pertanyaan_dosen" class="form-control" value="<?= $per_dosen->pertanyaan ?>" required>
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
						
						<select name="variabel_dosen_tambah" id="variabel_dosen_tambah" class="form-control" required>
						<option disabled selected value>-- Pilih Variabel --</option>
						<option value="Teknologi">Teknologi</option>
						<option value="Inovasi">Inovasi</option>
						<option value="Manusia">Manusia</option>
						<option value="Pengembangan_Diri">Pengembangan Diri</option>
						</select>
						
						</td>
						
						<td>
						
						<select name="konstruk_dosen_tambah" id="konstruk_dosen_tambah" class="form-control" required>
						<option disabled selected value>-- Pilih Konstruk --</option>
						<option value="Sumber_Daya">Sumber Daya</option>
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
		
			
			
			<button class="btn btn-primary" onclick="showFormAdmin()"><i class="fa fa-plus"></i> Tambah Data</button>
			<br/><br/>
			
				<table class="table table-stripped table-hovered">
			<tr>
				<td>No</td>
				<td>Kode Pertanyaan</td>
				<td>Variabel</td>
				<td>Konstruk</td>
				<td>Butir Pertanyaan</td>
				<td>Action</td>
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
				
				<td>
					<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModalper_admin<?php echo $per_admin->kode_pertanyaan ?>"><i class="fa fa-pencil"></i></button>
					<div id="myModalper_admin<?php echo $per_admin->kode_pertanyaan?>" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Edit Data</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form action="update_per_admin.php" method="post">
								
								<!--
								<?php
								$kode_per=$per_admin->kode_pertanyaan;
								echo $kode_per;
								?>
								-->
								
								
								
									<div class="form-group">
										<label for="">Kode Pertanyaan</label>
										<input type="text" name="kode_pertanyaan_admin" class="form-control" value="<?=  $per_admin->kode_pertanyaan; ?>" readonly>
									</div>
									<div class="form-group">
										<label for="">Variabel</label>
										<select name="variabel_admin" id="variabel_admin" class="form-control" required>
										<option disabled selected value>-- Pilih Variabel --</option>
										<option value="Teknologi">Teknologi</option>
										<option value="Inovasi">Inovasi</option>
										<option value="Manusia">Manusia</option>
										<option value="Pengembangan_Diri">Pengembangan Diri</option>
										</select>
									</div>
									<div class="form-group">
										<label for="">Konstruk</label>
										<select name="konstruk_admin" id="konstruk_admin" class="form-control" required>
										<option disabled selected value>-- Pilih Konstruk --</option>
										<option value="Sumber_Daya">Sumber Daya</option>
										<option value="Keterampilan">Keterampilan</option>
										<option value="Sikap">Sikap</option>
										</select>
									</div>
									<div class="form-group">
										<label for="">Pertanyaan</label>
										<input type="text" name="pertanyaan_admin" class="form-control" value="<?= $per_admin->pertanyaan ?>" required>
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
						
						<select name="variabel_admin_tambah" id="variabel_admin_tambah" class="form-control"required>
						<option disabled selected value>-- Pilih Variabel --</option>
						<option value="Teknologi">Teknologi</option>
						<option value="Inovasi">Inovasi</option>
						<option value="Manusia">Manusia</option>
						<option value="Pengembangan_Diri">Pengembangan Diri</option>
						</select>
						
						</td>
						
						<td>
						
						<select name="konstruk_admin_tambah" id="konstruk_admin_tambah" class="form-control" required>
						<option disabled selected value>-- Pilih Konstruk --</option>
							<option value="Sumber_Daya">Sumber Daya</option>
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
		
		
		<?php
		
		//seleksi apakah jumlah pertanyaan di tabel mahasiswa, dosen dan admin lebih dari 0
		//kalau iya, maka tampilkan tombol simpan final
		
		
		$jmlpertinyiinmhs = mysqli_query($kon,"select Count(*) from butir_pertanyaan_mhs");
		$angkapertinyiinmhs=mysqli_fetch_assoc($jmlpertinyiinmhs);
		$angkapertinyiinmhs=implode($angkapertinyiinmhs);

		//echo $angkapertinyiinmhs;
		
		$jmlpertinyiindosen = mysqli_query($kon,"select Count(*) from butir_pertanyaan_dosen");
		$angkapertinyiindosen=mysqli_fetch_assoc($jmlpertinyiindosen);
		$angkapertinyiindosen=implode($angkapertinyiindosen);

		//echo $angkapertinyiindosen;
		
		$jmlpertinyiinadmin = mysqli_query($kon,"select Count(*) from butir_pertanyaan_admin");
		$angkapertinyiinadmin=mysqli_fetch_assoc($jmlpertinyiinadmin);
		$angkapertinyiinadmin=implode($angkapertinyiinadmin);

		//echo $angkapertinyiinadmin;
		
		$tombolsimpanfinalpertanyaan='<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalsimpanfinalpertanyaan">Simpan Final Semua Pertanyaan</button>';
		
		if($angkapertinyiinmhs>=1&&$angkapertinyiindosen>=1&&$angkapertinyiinadmin>=1&&$jurusandansampel=='fix'){
			
			//Salah! if atur jurusan sudah, atur sampel sudah, dan setiap pertanyaan >= 1
			echo $tombolsimpanfinalpertanyaan;
			
		}
		?>
		
		
		
		
		</center>			<div id="myModalsimpanfinalpertanyaan" class="modal fade" role="dialog">
						<div class="modal-dialog">

							
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Simpan Final Semua Pertanyaan</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form action="simpanfinal_semuapertanyaan.php" method="post">
								
								
								Apakah anda yakin akan melakukan simpan final semua pertanyaan? <br/>Data yang tersimpan tidak akan dapat diubah kembali.
								
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

<?php
		
		
			
			if($_SESSION['msg_per_mhs']=='sama'){
				
			
			echo '<script>
				
				
				$("#myModalpermhs").modal("show");
			
			</script>';
			
			
			
				
			}else if($_SESSION['msg_per_dosen']=='sama'){
								
			
			echo '<script>
				
				
				$("#myModalperdosen").modal("show");
			
			</script>';
			
			
			
			//$msg_jurusan='';
				
			}else if($_SESSION['msg_per_admin']=='sama'){
								
			
			echo '<script>
				
				
				$("#myModalperadmin").modal("show");
			
			</script>';
			
			
			
			//$msg_jurusan='';
				
			}
		
		?>
  </body>
</html>