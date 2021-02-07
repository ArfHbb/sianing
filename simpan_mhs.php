<?php
//Include file koneksi ke database
include "koneksi.php";
session_start();


$nim=$_SESSION['nim'];


				$querynimutama = mysqli_query($kon,"select Count(*) from mhs_ujicoba where nim like '$nim'");
				$hasilquerynimutama=	mysqli_fetch_assoc($querynimutama);
				$nimutama=implode($hasilquerynimutama);
			
				
		
				
				$querynimuji = mysqli_query($kon,"select Count(*) from mhs where nim like '$nim'");
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

$query_jml_pertanyaan_mhs = mysqli_query($kon,"select Count(*) as totalper_mhs from butir_pertanyaan_mhs");
				$jml_per_mhs= mysqli_fetch_assoc($query_jml_pertanyaan_mhs);
				$jml_pert_mhsvalid=implode($jml_per_mhs);
				
				
				$i=1;
				while ($i<=$jml_pert_mhsvalid){
					$kodepertanyaansaatini="qm".''.$i;
					
					$querynilaitotalmhs=mysqli_query($kon,"select * from butir_pertanyaan_mhs where kode_pertanyaan='$kodepertanyaansaatini'");
					$nilaitotalmhs = mysqli_fetch_object($querynilaitotalmhs);
					$kevalidan=$nilaitotalmhs->validitas;	
					
					if($kevalidan=='Valid'){
																	
						}
					
					$i++;
				}



//menerima nilai dari kiriman form input-barang 
$nama_mhs=$_SESSION['nama_mhs'];
$nim=$_SESSION['nim'];
$semester=$_SESSION['semester'];
$jurusan=$_SESSION['jurusan'];
$prodi=$_SESSION['prodi'];




//cari nilai jumlah ketentuan jururusan saat ini



				$query_jml_sampeljur_mhs=mysqli_query($kon,"select * from jml_sampel_mhs where jurusan='$jurusan'");
				$sampeljurmhs = mysqli_fetch_object($query_jml_sampeljur_mhs);
				$jmlsampelque=$sampeljurmhs->jml_sampel;
				
		
				
				$queryjmldatamhs = mysqli_query($kon,"select Count(*) from mhs where jurusan='$jurusan'");
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

$qm_terbuka=$_POST["qm_terbuka"];
//$email=$_POST["email"];


//ambil kode responden dari jumlah data saat ini +1.
				$query_respondenku = mysqli_query($kon,"select Count(*) as totalper_mhs from mhs");
				$kode_responden= mysqli_fetch_assoc($query_respondenku);
				$koderesponden=implode($kode_responden);
				$koderesponden=$koderesponden+1;
				$koderesponden="mhs".''.$koderesponden;
				//$koderesponden=(string)$kode_responden;
				
date_default_timezone_set('Asia/Jakarta');
$waktu_mhs=date('d-m-Y H:i:s');

//Query input menginput data kedalam tabel barang
  $sql="insert into mhs (kode_responden,waktu,nama,nim,semester,jurusan,prodi,qm_terbuka) values
		('$koderesponden','$waktu_mhs','$nama_mhs','$nim','$semester','$jurusan','$prodi','$qm_terbuka')";

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

				$query_jml_pertanyaan_mhs = mysqli_query($kon,"select Count(*) as totalper_mhs from butir_pertanyaan_mhs");
				$jml_per_mhs= mysqli_fetch_assoc($query_jml_pertanyaan_mhs);
				$jml_pert_mhs=implode($jml_per_mhs);
				
				$i=1;
				while ($i<=$jml_pert_mhs){
					$kodepertanyaansaatini="qm".''.$i;
					
					$querynilaitotalmhs=mysqli_query($kon,"select * from butir_pertanyaan_mhs where kode_pertanyaan='$kodepertanyaansaatini'");
					$nilaitotalmhs = mysqli_fetch_object($querynilaitotalmhs);
					$kevalidan=$nilaitotalmhs->validitas;	
					
					if($kevalidan=='Valid'){
						
						$nilaiyangdiinput=$_POST["$kodepertanyaansaatini"];
						//update db set db mhs  set kolom $kodepertanyaansaatini=$nilaiyangdiinput
						//echo "nilai ";
						//echo $kodepertanyaansaatini;
						//echo $nilaiyangdiinput;
						$set_update_qm = mysqli_query($kon,"update mhs set $kodepertanyaansaatini='$nilaiyangdiinput' where kode_responden='$koderesponden' ");

						if($set_update_qm==1){
							//echo "<br/>";
							//echo $kodepertanyaansaatini;
							//echo "telah diupdate";
							//echo "<br/>";
							//echo "jumlah sampel: ";
							//echo $jmlsampelque;
							//echo "<br/>";
							//echo "jumlah data saat ini: ";
							//echo $jmldatamhs;
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
				


			}
				}

?>