<?php 
session_start();
include_once('koneksi.php');
$database = new database();

$_SESSION['msg_register']="";

if(isset($_SESSION['is_login']))
	
{
	
	$_SESSION['msg_jurusan']="";
	$_SESSION['msg_prodi']="";
    header('location:atur_jurusan.php');
}

if(isset($_COOKIE['username']))
{
  $database->relogin($_COOKIE['username']);
 
 $_SESSION['msg_jurusan']="";
 $_SESSION['msg_prodi']="";
  header('location:atur_jurusan.php');
}

//$old_error_reporting=error_reporting(0);

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
	//$status = $_POST['status'];
    if(isset($_POST['remember']))
    {
      $remember = TRUE;
    }
    else
    {
      $remember = FALSE;
    }

    if($database->login($username,$password,$remember))
    {
		
	$_SESSION['msg_jurusan']="";
	$_SESSION['msg_prodi']="";
      header('location:atur_jurusan.php');
    }
}

//error_reporting($old_error_reporting);


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Login Form</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">

    <!-- Bootstrap core CSS -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="assets/css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
  
  
  <div id="myModalsalahlogin" class="modal fade" role="dialog">
			
						<div class="modal-dialog">

							
							<div class="modal-content">
							<div class="modal-header">
								
								<h4 class="modal-title">Username atau password salah</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form method="post">
								
								
								Username atau password salah. Silakan masukkan username dan password yang benar. 
								
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
  
  
    <form class="form-signin" method="post" action="proses_login.php">
  <img class="mb-4" src="assets/assets/css/bootstrap-solid.svg" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
  <label for="username" class="sr-only">Username</label>
  <input type="text" id="username" class="form-control" placeholder="Username" name="username" required autofocus>
  <label for="password" class="sr-only">Password</label>
  <input type="password" id="password" class="form-control" placeholder="Password" name="password" required>
  <div class="checkbox mb-3">
    <label>
      <!--
	  <input type="checkbox" value="remember-me" name="remember"> Remember me
	  -->
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>
  <a href="register.php" class="btn btn-lg btn-success btn-block">Register</a>
  
</form>

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
		
		if(isset($_SESSION['msg_login']))
	
{
			
			if($_SESSION['msg_login']=="salah input"){
				
			
			echo '<script>
				
				
				$("#myModalsalahlogin").modal("show");
			
			</script>';
	
			}
			
}
		
		?>
</body>
</html>
