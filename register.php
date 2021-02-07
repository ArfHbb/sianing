<?php include 'koneksi.php'; 
session_start();
$_SESSION['msg_login']="";

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  </head>
  
  <body>
    <!-- Begin page content -->
<div id="content" class="p-4 p-md-5 pt-5">
    <h1 class="mt-5">Register Form</h1>
	
	<div id="myModalusername" class="modal fade" role="dialog">
			
						<div class="modal-dialog">

							
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Username Sama</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form method="post">
								
								
								Username ini sudah ada. Silakan masukkan username yang berbeda. 
								
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
	
    <p class="lead">Silahkan Daftarkan Identitas Anda</p>
    <hr/>
    <form method="post" action="proses_register.php">
    <div class="form-group row">
      <label for="username" class="col-sm-2 col-form-label">Username</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
      </div>
    </div>

    <div class="form-group row">
      <label for="nama" class="col-sm-2 col-form-label">Nama</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
      </div>
    </div>


  <div class="form-group row">
    <label for="password" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
    </div>
  </div>
  
  
    <div class="form-group row">
      <label for="nama" class="col-sm-2 col-form-label">Status</label><div class="col-sm-10">
   <select name="status" id="status" class="placeholder" required>
    <option disabled selected value>-- Pilih Status --</option>
						<?php
						$queryambiljurusan="select * from status_login";
						$hasilqueryjurusan=mysqli_query($kon,$queryambiljurusan);
						
						while($datajurusan=mysqli_fetch_assoc($hasilqueryjurusan)){
							
							
							?>
							<font color="black">
							
							<option value="<?php echo $datajurusan['nama'];?>"> <?php echo $datajurusan['nama'];?></option>
							</font>
						<?php
						
						}
						
						
						?>
</select>
										</div></div>
  
  
  <!--
  <div class="form-group row">
      <label for="nama" class="col-sm-2 col-form-label">Status</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="status" name="status" placeholder="Status">
      </div>
    </div>
	
	-->
	
  <div class="form-group row">
    <div class="col-sm-10">
      <a href="login.php" class="btn btn-success">Login</a>
      <button type="submit" class="btn btn-primary" name="register">Register</button>
    </div>
  </div>
  </div>
</form>
  </div>
</main>

<footer class="footer mt-auto py-3">
  <div class="container">

  </div>
</footer>
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
		
		
			
			if($_SESSION['msg_register']=='sama'){
				
			
			echo '<script>
				
				
				$("#myModalusername").modal("show");
			
			</script>';
			
			}
			
			?>
</body>
</html>
