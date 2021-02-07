
<?php include 'koneksi.php'; 
session_start();
$_SESSION['msg_login']="";


$queryfinaljurusanprodi = mysqli_query($kon,"select Count(*) from setting where nama='statusfinaljurusanprodi'");
$statusfinaljurusanprodi=	mysqli_fetch_assoc($queryfinaljurusanprodi);
$statusfinaljurusanprodi=implode($statusfinaljurusanprodi);


$queryfinalsemuapertanyaan = mysqli_query($kon,"select Count(*) from setting where nama='statusfinalsemuapertanyaan'");
$statusfinalsemuapertanyaan=	mysqli_fetch_assoc($queryfinalsemuapertanyaan);
$statusfinalsemuapertanyaan=implode($statusfinalsemuapertanyaan);

$linkdosen='biodata_dosen.php';
$linkmhs='biodata_mhs.php';
$linkadmin='biodata_admin.php';

if ($statusfinaljurusanprodi==0||$statusfinalsemuapertanyaan==0){

//jika belum,
$linkdosen='tidak_selesai.php';
$linkmhs='tidak_selesai.php';
$linkadmin='tidak_selesai.php';

	
}	
		
		?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no, initial-scale=1, maximum-scale=1,minimum-scale=1, height=device-height,target-densitydpi+device-dpi">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beranda  </title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
</head>
<body>


        <div id="formContainer">
		
		
		
                <div id="survey-form" >
                  <h1 id="title" align="center">Selamat Datang!</h1>
            	  	<center>
					<p id="description">Sebelum mengisi kuesioner, silakan pilih identitas Anda:</p>
					
					<a href="<?php echo $linkdosen; ?>">
				  <input type="submit" id="tombol" value="Dosen">
				  </a> 
				  		  
						  
					<a href="<?php echo $linkmhs; ?>">	  
				  <input type="submit" id="tombol" value="Mahasiswa">
				  </a>
                  
				  <a href="<?php echo $linkadmin; ?>">	  
				  <input type="submit" id="tombol" value="Admin Prodi">
				  </a>
				  
				  <p id="description">
				 <br/> Atau <a href="index-researcher.php">
				  
				  <button class="btn btn-primary" onclick="showFormlogin()"><i class="fa fa-plus"></i> Login</button>
					</a>
					</div>
					
				
					
                  </div>
                
</body>
</html>