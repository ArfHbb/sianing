<?php
include "koneksi.php";


$querynamapeneliti=mysqli_query($kon,"select * from login where status='peneliti'");
$hasilquerynamapeneliti = mysqli_fetch_object($querynamapeneliti);
$namapeneliti=$hasilquerynamapeneliti->nama;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no, initial-scale=1, maximum-scale=1,minimum-scale=1, height=device-height,target-densitydpi=device-dpi">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kuesioner Admin Penelitian Kesiapan E-Learning </title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">

	
	<meta charset='UTF-8' />
	<script src="jquery.min.js"></script>
	
	

	
	</head>
<body>
        <div id="formContainer">
                <form id="survey-form" method="post" action="kuesioner_admin.php">
            
                  <h1 id="title" align="center">Kuesioner Penelitian Tingkat Kesiapan Penerapan <i>E-Learning</i> di Politeknik Negeri Jember</h1>
                  <hr>
				  
				  
				  <div id="foto" style="float:left"><img src="diriku.png" width="90px" height="100px"></div>
				  <p id="description" align="justify">Kepada Responden yang terhormat,
<br/><br/>Nama saya <?php echo $namapeneliti ?> dari program Studi Teknik Informatika.
Dalam rangka penelitian
studi permasalahan untuk skripsi, diperlukan dukungan Bapak/Ibu/Saudara(i) untuk mengisi
kuesioner ini.<br/><br/>
Kuesioner ini diedarkan untuk mengetahui tingkat kesiapan penerapan e-learning di Politeknik
Negeri Jember yang dapat diakses pada alamat <b>e-learning.polije.ac.id</b>. Untuk itu, saya sangat
mengharapkan kesediaan Bapak/Ibu/Saudara(i) meluangkan waktu untuk mengisi kuesioner ini.
Masukan dan informasi yang jujur, benar, dan akurat sangat diharapkan agar informasi ilmiah
yang akan disajikan benar-benar dapat dipertanggung jawabkan dan berguna bagi peningkatan
kualitas pelayanan e-learning Politeknik Negeri Jember.<br/><br/>

Kuesioner ini terbagi menjadi 3 (tiga) bagian.<br/>
Pada bagian pertama, Anda diminta untuk mengisi biodata diri. Data yang dimasukkan dirahasiakan dan tidak akan dipublikasikan.<br/>
Pada bagian kedua, Anda diminta untuk mengisi setiap pernyataan yag ada dengan memilih pada salah satu kategori, yaitu Tidak Setuju (TS), Kurang Setuju (KS), Netral (N), Setuju (S) dan Sangat Setuju (SS).<br/>
Pada bagian ketiga, Anda diminta untuk mengisi kritik, saran atau komentar mengenai e-learning di Polije. Bagian ini bersifat opsional dan dapat dikosongi.<br/><br/>

Terima kasih atas bantuan dan kesediannya dalam meluangkan waktu untuk mengisi kuesioner ini.
</p>
<hr>

            
                  <div>
                    <label for="name" id="name-label">Nama:</label>
					<form action="simpan-dosen.php" method="post">
						<div class="form-group">
						</div>
        				
					
                    <input type="text" name="nama_admin" id="name" class="placeholder" placeholder="Masukkan Nama Lengkap" required>
                    
										
				 </div>
                                    
                  <div>
                    <label for="dropdown">Pilih Jurusan</label>
                    <select name="parent_selection" id="parent_selection" class="placeholder" required>
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


<!-- Nyimpannya pakai $_POST['child_selection'] -->
<label for="dropdown">Pilih Program Studi</label>
<select name="child_selection" id="child_selection" class="placeholder" required>
<option disabled selected value>-- Pilih Prodi --</option>
						<?php
						$queryambiljurusan="select * from prodi";
						$hasilqueryjurusan=mysqli_query($kon,$queryambiljurusan);
						
						while($datajurusan=mysqli_fetch_assoc($hasilqueryjurusan)){
							
							
							?>
							<font color="black">
							
							<option value="<?php echo $datajurusan['prodi'];?>"> <?php echo $datajurusan['prodi'];?></option>
							</font>
						<?php
						
						}
						
						
						?>
</select>
                  </div>
				  
			
                 
            
                  <!-- Submit -->
            
                  <input type="submit" id="submit" value="Lanjut">
				  
				  
				  <label id="keterangan_halaman"><center>
					<br/>Halaman 1 dari 2
					</center>
					</label>
					
					</form>
					
                  
                </form>
</body>
</html>