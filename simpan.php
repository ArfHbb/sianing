<?php
//Include file koneksi ke database
include "koneksi.php";
session_start();

//$i=1000;
//$kodepertanyaansaatini="qm".''.$i;
//echo $_SESSION['$kodepertanyaansaatini'];

//echo $_SESSION['qm1'];


$nip=$_SESSION['nip'];


				$querynimutama = mysqli_query($kon,"select Count(*) from dosen_ujicoba where nip like '$nip'");
				$hasilquerynimutama=	mysqli_fetch_assoc($querynimutama);
				$nimutama=implode($hasilquerynimutama);
			
				
		
				
				$querynimuji = mysqli_query($kon,"select Count(*) from dosen where nip like '$nip'");
				$hasilquerynimuji=	mysqli_fetch_assoc($querynimuji);
				$nimuji=implode($hasilquerynimuji);

								
				
				if($nimutama!=0||$nim!=0){
					
					//echo "jumlah sampel: ";
					//echo $datadosen->ketentuan;
					//echo "<br/>";
					//echo "jumlah data sekarang: ";
					//echo $jmldatadosen;
					//echo "<br/>";
					//echo "seharusnya tidak selesai";
					header("Location: sudah_ngisi.php");
					session_destroy();
					
				}
				
				else{


$query_jml_pertanyaan_mhs = mysqli_query($kon,"select Count(*) as totalper_dosen from butir_pertanyaan_dosen");
				$jml_per_mhs= mysqli_fetch_assoc($query_jml_pertanyaan_mhs);
				$jml_pert_mhsvalid=implode($jml_per_mhs);
				
				
				$i=1;
				while ($i<=$jml_pert_mhsvalid){
					$kodepertanyaansaatini="qd".''.$i;
					
					$querynilaitotalmhs=mysqli_query($kon,"select * from butir_pertanyaan_dosen where kode_pertanyaan='$kodepertanyaansaatini'");
					$nilaitotalmhs = mysqli_fetch_object($querynilaitotalmhs);
					$kevalidan=$nilaitotalmhs->validitas;	
					
					if($kevalidan=='Valid'){
																	
						//$kodepertanyaansaatini=$_SESSION["$kodepertanyaansaatini"];
						//$_SESSION['$kodepertanyaansaatini'] = $kodepertanyaansaatini;
						
						
						
						//echo $kodepertanyaansaatini;
						//echo $_POST[$kodepertanyaansaatini];
						//echo "<br/>";
						
						//echo $_SESSION['qm1'];
						//echo $_SESSION['qm2'];
						//echo $_SESSION['qm3'];
						//echo $_SESSION['qm4'];
						//echo $_SESSION['qm5'];
					}
					
					$i++;
				}









//$qm1=$_SESSION['qm1'];
//echo $qm1;
//echo $_SESSION['qm2'];
//echo $_SESSION['qm3'];
//echo $_SESSION['qm4'];
//echo $_SESSION['qm5'];

//menerima nilai dari kiriman form input-barang 
$nama_dosen=$_SESSION['nama_dosen'];
$nip=$_SESSION['nip'];
$semester=$_SESSION['semester'];
$jurusan=$_SESSION['jurusan'];
$prodi=$_SESSION['prodi'];
$usia=$_SESSION['usia'];











				$query_jml_sampeljur_mhs=mysqli_query($kon,"select * from jml_sampel_dosen where jurusan='$jurusan'");
				$sampeljurmhs = mysqli_fetch_object($query_jml_sampeljur_mhs);
				$jmlsampelque=$sampeljurmhs->jml_sampel;
				
		
				
				$queryjmldatamhs = mysqli_query($kon,"select Count(*) from dosen where jurusan='$jurusan'");
				$hasilqueryjmldatamhs=	mysqli_fetch_assoc($queryjmldatamhs);
				$jmldatamhs=implode($hasilqueryjmldatamhs);

								
				
				if($jmldatamhs==$jmlsampelque){
					echo "jumlah sampel: ";
					echo $jmlsampelque;
					echo "<br/>";
					echo "jumlah data saat ini: ";
					echo $jmldatamhs;
					header("Location: tidak_selesai.php");
					session_destroy();
					
				}
				else{
















//ini diinput duluan

$qd_terbuka=$_POST["qd_terbuka"];
//$email=$_POST["email"];


//ambil kode responden dari jumlah data saat ini +1.
				$query_respondenku = mysqli_query($kon,"select Count(*) as totalper_dosen from dosen");
				$kode_responden= mysqli_fetch_assoc($query_respondenku);
				$koderesponden=implode($kode_responden);
				$koderesponden=$koderesponden+1;
				$koderesponden="dosen".''.$koderesponden;
				//$koderesponden=(string)$kode_responden;
				
date_default_timezone_set('Asia/Jakarta');
$waktu_mhs=date('d-m-Y H:i:s');

//Query input menginput data kedalam tabel barang
  $sql="insert into dosen (kode_responden,waktu,nama,nip,jurusan,prodi,usia,qd_terbuka) values
		('$koderesponden','$waktu_mhs','$nama_dosen','$nip','$jurusan','$prodi','$usia','$qd_terbuka')";

//Mengeksekusi/menjalankan query diatas	
  $hasil=mysqli_query($kon,$sql);

//Kondisi apakah berhasil atau tidak
  if ($hasil) {
	//header("Location: selesai.php");
	//session_destroy();
	//echo "data kloter pertama berhasil diinput";
	//echo "<br/>";

  }
else {
	//echo "Gagal insert data kloter pertama";
	//echo "<br/>";
	//exit;
}  




//untuk menyimpan ke db, pake looping di postnya. Ini ditaruh dibawah karena pake query update, jadi yang lain diinput dulu. ini belakangan

				$query_jml_pertanyaan_mhs = mysqli_query($kon,"select Count(*) as totalper_dosen from butir_pertanyaan_dosen");
				$jml_per_mhs= mysqli_fetch_assoc($query_jml_pertanyaan_mhs);
				$jml_pert_mhs=implode($jml_per_mhs);
				
				$i=1;
				while ($i<=$jml_pert_mhs){
					$kodepertanyaansaatini="qd".''.$i;
					
					$querynilaitotalmhs=mysqli_query($kon,"select * from butir_pertanyaan_dosen where kode_pertanyaan='$kodepertanyaansaatini'");
					$nilaitotalmhs = mysqli_fetch_object($querynilaitotalmhs);
					$kevalidan=$nilaitotalmhs->validitas;	
					
					if($kevalidan=='Valid'){
						
						$nilaiyangdiinput=$_POST["$kodepertanyaansaatini"];
						//update db set db mhs  set kolom $kodepertanyaansaatini=$nilaiyangdiinput
						//echo "nilai ";
						//echo $kodepertanyaansaatini;
						//echo $nilaiyangdiinput;
						
						//setelah set update, update baris totalnya
						$set_update_qm = mysqli_query($kon,"update dosen set $kodepertanyaansaatini='$nilaiyangdiinput' where kode_responden='$koderesponden' ");

						if($set_update_qm==1){
							//echo "<br/>";
							//echo $kodepertanyaansaatini;
							//echo "telah diupdate";
							//echo "<br/>";
							
							header("Location: selesai.php");
							session_destroy();
							
							
							}else {
								
							//echo "<br/>";
							//echo $kodepertanyaansaatini;
							//echo "gagal diupdate";
							//echo "<br/>";
							}
					}
					
					$i++;
				}
				


//$qm11=$_POST["qm11"];
//$qm13=$_POST["qm13"];
//$qm14=$_POST["qm14"];
//$qm15=$_POST["qm15"];
//$qm16=$_POST["qm16"];
//$qm17=$_POST["qm17"];
//$qm18=$_POST["qm18"];
//$qm19=$_POST["qm19"];
//$qm20=$_POST["qm20"];
//$qm21=$_POST["qm21"];
//$qm22=$_POST["qm22"];
//$qm23=$_POST["qm23"];
//$qm25=$_POST["qm25"];


				}
				}
?>