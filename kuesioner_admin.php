<?php include 'koneksi.php'; 

				$query_jml_pertanyaan_mhs = mysqli_query($kon,"select Count(*) as totalper_mhs from butir_pertanyaan_admin");
				$jml_per_mhs= mysqli_fetch_assoc($query_jml_pertanyaan_mhs);
				$jml_pert_mhs=implode($jml_per_mhs);
			
			
			
			
//menerima nilai dari kiriman form input-barang 
$nama_admin=$_POST["nama_admin"];
$jurusan=$_POST["parent_selection"];
$prodi=$_POST["child_selection"];

//echo $nama_mhs, $nim, $semester, $jurusan, $prodi;

session_start();
$_SESSION['nama_admin'] = $nama_admin;
$_SESSION['jurusan'] = str_replace('_',' ',$jurusan);
$_SESSION['prodi'] = str_replace('_',' ',$prodi);

			
			
			
			
			
			?>
			
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no, initial-scale=1, maximum-scale=1,minimum-scale=1, height=device-height,target-densitydpi+device-dpi">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kuesioner Admin</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
</head>
<body>

<!--
Halaman ini merupakan halaman untuk Mhs yang meload pertanyaan dari db<br/>
Diasumsikan halaman biodata sudah diklik sebelumnya, dan sekarang di halama pertanyaan saja<br/>
Proses validasi sudah selesai dilakukan, dan di tabel butir sudah ada keterangan validasinya<br/>
Tahapnya adalah: <br/>
1. Meload berapa banyak pertanyaan yang valid<br/>
Jumlah pertanyaan yang valid adalah sebanyak:
<?php //echo $jml_pert_mhs; ?><br/>
2. Membangun interface (dicopy dari yang sudah ada)<br/>
3. menaruh pertanyan di looping<br/>
-->


       <div id="formContainer">
                <form id="survey-form" method="post" action="simpan_admin.php">
            
                  <h1 id="title" align="center">Pengisian Kuesioner</span></h1>
                  <p id="description" align="justify">
				  
				 
				  

<table cellpadding="0" cellspacing="10px" width="100%" border="0">

<tr>
					<td colspan="2">Bapak/Ibu diharapkan mengisi setiap kriteria penilaian dengan ketentuan sebagai berikut:
					</td>
					</tr>
					
<tr>
<td width="45%">
<b>Tidak Setuju (TS)</b> 
</td>
<td width="55%" align="justify">
Apabila Anda tidak setuju dengan pernyataan yang diberikan<br/>
</td>
</tr>

<td width="45%">
<b>Kurang Setuju (KS)</b> 
</td>

<td width="55%" align="justify">
Apabila Anda kurang setuju dengan pernyataan yang diberikan<br/>
</td>
</tr>

<td width="45%">
<b>Netral (N)</b> 
</td>

<td width="55%" align="justify">
Apabila Anda ragu-ragu dengan pernyataan yang diberikan<br/>
</td>
</tr>


<td width="45%">
<b>Setuju (S)</b> 
</td>


<td width="55%" align="justify">
Apabila Anda setuju dengan pernyataan yang diberikan<br/>
</td>
</tr>

<td width="45%">
<b>Sangat Setuju (S)</b> 
</td>

<td width="55%" align="justify">
Apabila Anda sangat setuju dengan pernyataan yang diberikan 
</td>
<br/>
				  
		  
				  
				  </p>
				  </table>
            
                  <div>
                    
					<form method="post">
							
							
                  <hr>
            
                  <!-- Radio buttons -->
				  <?php
				  $loop=1;
				  //$satu='';
				  
				  				  
					while($loop<=$jml_pert_mhs){
					$kodepertanyaansaatini="qa".''.$loop;
					
					
					$querypertanyaanmhs=mysqli_query($kon,"select * from butir_pertanyaan_admin where kode_pertanyaan='$kodepertanyaansaatini'");
					$hasilpertanyaanmhs = mysqli_fetch_object($querypertanyaanmhs);
					$pertanyaanmhs=$hasilpertanyaanmhs->pertanyaan;	
					//$kevalidan=$hasilpertanyaanmhs->validitas;
					//echo "<br/>Pertanyaan saat ini: ";
					//echo $kodepertanyaansaatini;
					
					//echo $satu;
					//echo isi pertanyaan dari db
					
					

?>
					
					<p id="pernyataan">
					
                 <?php 
				 
				 
					 
				 echo $loop;
				 echo '. ';
				 echo $pertanyaanmhs 
				 
				 ?></p>
                  
				  
				  <div class="selector-group">
                    <div id="radio-container">
            
                      <span><div id="labelgroup"><input type="radio" name="<?php echo $kodepertanyaansaatini?>" value="1" id="radio-input" required="required"><label for="payment" id="radio-label" required >TS</label></div></span>
					  <span><div id="labelgroup"><input type="radio" name="<?php echo $kodepertanyaansaatini?>" value="2" id="radio-input"><label for="payment" id="radio-label" required>KS</label></div></span>
                      <span><div id="labelgroup"><input type="radio" name="<?php echo $kodepertanyaansaatini?>" value="3" id="radio-input"><label for="payment" id="radio-label" required>N</label></div></span>
                      <span><div id="labelgroup"><input type="radio" name="<?php echo $kodepertanyaansaatini?>" value="4" id="radio-input"><label for="payment" id="radio-label" required>S</label></div></span>
			          <span><div id="labelgroup"><input type="radio" name="<?php echo $kodepertanyaansaatini?>" value="5" id="radio-input"><label for="payment" id="radio-label" required>SS</label></div></span>
            
                    </div>
                  </div>
				  
				  
				  
				  <?php
				  
				  $loop++;	
					
					}
				  ?>
				  			  
							  
							  
							  
							  <!-- Addittional comments -->
				  <hr>

                   <p align="center">Saran dan komentar Anda untuk perbaikan/peningkatan kualitas <i>e-learning</i> di Polije (opsional)</p>
                  
				  <div>
                    <center>       
                    <textarea class="placeholder" name="qa_terbuka" rows="5" cols="33" placeholder="Tuliskan saran anda disini" style="height:100px;resize:vertical;"></textarea>
                  </center>
				  </div>
                  <hr>
				  
				  <!--
				  <p align="center">Penasaran dengan hasil penelitian ini? <br/>Masukkan email dan hasil penelitian akan saya bagikan (opsional)</p>
                  
                  				  			  
                  <center><input type="email" id="email" name="email" class="placeholder" placeholder="Masukkan email disini">
                    </center>
						
				-->
							  
							  
							  
							  
				  
                  <!-- Submit -->
            
                  <input type="submit" id="submit" value="Kirim">
				  
				  <label id="keterangan_halaman"><center>
					<br/>Halaman 2 dari 2
					</center>
					</label>
				  
					</form>
                  
                </form>

</body>
</html>