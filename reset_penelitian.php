<?php
	include 'koneksi.php';
	
	$hapus = mysqli_query($kon,"drop database `skripsi`");
	
	$buatdb = mysqli_query($kon,"create database `skripsi`");
	
	$host="localhost";
	$user="root";
	$password="";
	$db="skripsi";

	$kon = mysqli_connect($host,$user,$password);


	$hasil=mysqli_select_db($kon,$db);

	
	
	$buattabeladmin = mysqli_query($kon,"create table admin(kode_responden varchar(30) DEFAULT NULL, waktu varchar(30) DEFAULT NULL, nama varchar(40) DEFAULT NULL, jurusan varchar(40) DEFAULT NULL, prodi varchar(50) DEFAULT NULL, qa_terbuka varchar(1000) DEFAULT NULL)");

	$buattabeldosen = mysqli_query($kon,"CREATE TABLE `dosen` (`kode_responden` varchar(30) DEFAULT NULL,`waktu` varchar(30) DEFAULT NULL,`nama` varchar(40) DEFAULT NULL,`nip` varchar(30) DEFAULT NULL,`jurusan` varchar(40) DEFAULT NULL,`prodi` varchar(50) DEFAULT NULL,`usia` int(5) DEFAULT NULL,`qd_terbuka` varchar(1000) DEFAULT NULL);");

	$buattabelmhs = mysqli_query($kon,"CREATE TABLE `mhs`(`kode_responden` varchar(30) DEFAULT NULL,`waktu` varchar(30) DEFAULT NULL,`nama` varchar(40) DEFAULT NULL,`nim` varchar(20) DEFAULT NULL,`semester` varchar(20) DEFAULT NULL,`jurusan` varchar(40) DEFAULT NULL,`prodi` varchar(40) DEFAULT NULL,`qm_terbuka` varchar(1000) DEFAULT NULL);");
	
	$buattabeldosenujicoba = mysqli_query($kon,"CREATE TABLE `dosen_ujicoba`(`kode_responden` varchar(30) DEFAULT NULL,`waktu` varchar(30) DEFAULT NULL,`nama` varchar(30) DEFAULT NULL,`nip` varchar(30) DEFAULT NULL,`jurusan` varchar(40) DEFAULT NULL,`prodi` varchar(50) DEFAULT NULL,`usia` int(5) DEFAULT NULL,`qd_terbuka` varchar(1000) DEFAULT NULL);");
	
	$buattabelmhsujicoba = mysqli_query($kon,"CREATE TABLE `mhs_ujicoba`(`kode_responden` varchar(50) DEFAULT NULL,`waktu` varchar(30) DEFAULT NULL,`nama` varchar(40) DEFAULT NULL,`nim` varchar(20) DEFAULT NULL,`semester` varchar(20) DEFAULT NULL,`jurusan` varchar(40) DEFAULT NULL,`prodi` varchar(40) DEFAULT NULL,`qm_terbuka` varchar(1000) DEFAULT NULL);");
	
	$buattabelperadmin = mysqli_query($kon,"CREATE TABLE `butir_pertanyaan_admin`(`kode_pertanyaan` varchar(10) DEFAULT NULL,`variabel` varchar(30) DEFAULT NULL,`konstruk` varchar(30) DEFAULT NULL,`pertanyaan` varchar(500) DEFAULT NULL);");
	
	$buattabelperdosen = mysqli_query($kon,"CREATE TABLE `butir_pertanyaan_dosen`(`kode_pertanyaan` varchar(10) DEFAULT NULL,`variabel` varchar(30) DEFAULT NULL,`konstruk` varchar(30) DEFAULT NULL,`pertanyaan` varchar(500) DEFAULT NULL, `validitas` varchar(25) NOT NULL);");
	
	$buattabelpermhs = mysqli_query($kon,"CREATE TABLE `butir_pertanyaan_mhs`(`kode_pertanyaan` varchar(10) DEFAULT NULL,`variabel` varchar(30) DEFAULT NULL,`konstruk` varchar(30) DEFAULT NULL,`pertanyaan` varchar(500) DEFAULT NULL, `validitas` varchar(25) NOT NULL);");

	$buattabelsampeladmin = mysqli_query($kon,"CREATE TABLE `jml_sampel_admin`(`kode_jur` varchar(10) DEFAULT NULL,`jurusan` varchar(50) DEFAULT NULL,`jml_populasi` int(11) DEFAULT NULL,`jml_sampel` int(11) DEFAULT NULL);");

	$buattabelsampeldosen = mysqli_query($kon,"CREATE TABLE `jml_sampel_dosen`(`kode_jur` varchar(10) DEFAULT NULL,`jurusan` varchar(50) DEFAULT NULL,`jml_populasi` int(11) DEFAULT NULL,`jml_sampel` int(11) DEFAULT NULL);");

	$buattabelsampelmhs = mysqli_query($kon,"CREATE TABLE `jml_sampel_mhs`(`kode_jur` varchar(10) DEFAULT NULL,`jurusan` varchar(50) DEFAULT NULL,`jml_populasi` int(11) DEFAULT NULL,`jml_sampel` int(11) DEFAULT NULL);");

	$buattabellogin = mysqli_query($kon,"CREATE TABLE `login`(`id` int(11) DEFAULT NULL,`username` varchar(255) DEFAULT NULL,`password` varchar(255) DEFAULT NULL,`nama` varchar(2555) DEFAULT NULL,`status` varchar(50) DEFAULT NULL);");

	$buattabelsetting = mysqli_query($kon,"CREATE TABLE `setting`(`nama` varchar(100) DEFAULT NULL,`ketentuan` varchar(100) DEFAULT NULL);");

	$isisetting = mysqli_query($kon,"INSERT INTO `setting` (`nama`, `ketentuan`) VALUES('jml_sampeluji_mhs', '0'),('jml_sampeluji_dosen', '0');");
	
	$isitotalsampelmhs = mysqli_query($kon,"INSERT INTO `jml_sampel_mhs` (`kode_jur`, `jurusan`, `jml_populasi`, `jml_sampel`) VALUES ('total', 'total', '0', '0');");

	$isitotalsampeldosen = mysqli_query($kon,"INSERT INTO `jml_sampel_dosen` (`kode_jur`, `jurusan`, `jml_populasi`, `jml_sampel`) VALUES ('total', 'total', '0', '0');");

	$isitotalsampeladmin = mysqli_query($kon,"INSERT INTO `jml_sampel_admin` (`kode_jur`, `jurusan`, `jml_populasi`, `jml_sampel`) VALUES ('total', 'total', '0', '0');");
	
	$buattabeljurusan = mysqli_query($kon,"CREATE TABLE `jurusan`(`kode_jurusan` varchar(250) DEFAULT NULL,`jurusan` varchar(250) DEFAULT NULL);");
	
	$buattabelprodi = mysqli_query($kon,"CREATE TABLE `prodi`(`jurusan` varchar(250) DEFAULT NULL,`prodi` varchar(250) DEFAULT NULL);");

	$buattabelstatuslogin = mysqli_query($kon,"CREATE TABLE `status_login`(`nama` varchar(250) DEFAULT NULL);");
	
	$isistatuslogin = mysqli_query($kon,"INSERT INTO `status_login` (`nama`) VALUES ('peneliti'),('pimpinan'),('admin');");
	
	//kodediatas belum selesai, yang isi status login
	
	//$isitabelsampeladmin=mysqli_query($kon,"INSERT INTO `jml_sampel_admin` (`kode_jur`, `jurusan`, `jml_populasi`, `jml_sampel`) VALUES
	//('ti', 'Teknologi Informasi', 0, 0),
	//('tnk', 'Peternakan', 0, 0),
	//('pp', 'Produksi Pertanian', 0, 0),
	//('tp', 'Teknologi Pertanian', 0, 0),
	//('mna', 'Manajemen Agribisnis', 0, 0),
	//('bkp', 'Bahasa Komunikasi dan Pariwisata', 0, 0),
	//('kes', 'Kesehatan', 0, 0),
	//('teknik', 'Teknik', 0, 0);");
		
	//$isitabelsampeldosen=mysqli_query($kon,"INSERT INTO `jml_sampel_dosen` (`kode_jur`, `jurusan`, `jml_populasi`, `jml_sampel`) VALUES
	//('ti', 'Teknologi Informasi', 0, 0),
	//('tnk', 'Peternakan', 0, 0),
	//('pp', 'Produksi Pertanian', 0, 0),
	//('tp', 'Teknologi Pertanian', 0, 0),
	//('mna', 'Manajemen Agribisnis', 0, 0),
	//('bkp', 'Bahasa Komunikasi dan Pariwisata', 0, 0),
	//('kes', 'Kesehatan', 0, 0),
	//('teknik', 'Teknik', 0, 0);");
	
	//$isitabelsampelmhs=mysqli_query($kon,"INSERT INTO `jml_sampel_mhs` (`kode_jur`, `jurusan`, `jml_populasi`, `jml_sampel`) VALUES
	//('ti', 'Teknologi Informasi', 0, 0),
	//('tnk', 'Peternakan', 0, 0),
	//('pp', 'Produksi Pertanian', 0, 0),
	//('tp', 'Teknologi Pertanian', 0, 0),
	//('mna', 'Manajemen Agribisnis', 0, 0),
	//('bkp', 'Bahasa Komunikasi dan Pariwisata', 0, 0),
	//('kes', 'Kesehatan', 0, 0),
	//('teknik', 'Teknik', 0, 0);");
	
	if($hapus==1&&$buatdb==1&&$buattabeladmin==1&&$buattabeldosen==1&&$buattabelmhs==1&&$buattabeldosenujicoba==1&&$buattabelmhsujicoba==1&&$buattabelperadmin==1&&$buattabelperdosen==1&&$buattabelpermhs==1&&$buattabelsampeladmin==1&&$buattabelsampeldosen==1&&$buattabelsampelmhs==1&&$buattabellogin==1&&$buattabelsetting==1&&$isisetting==1&&$isitotalsampelmhs==1&&$isitotalsampeldosen==1&&$isitotalsampeladmin==1&&$buattabeljurusan==1&&$buattabelprodi==1&&$buattabelstatuslogin==1&&$isistatuslogin==1){
		header('location:logout.php');
	}
	
	
	?>
	