<?php
require_once '../_config/config.php';
require '../assets/libs/vendor/autoload.php';

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

// membuat fungsi multiple tambah data
if (isset($_POST['add'])) {
	$total  = $_POST['total'];
	for ($i=1; $i<=$total; $i++) { 
		$uuid = Uuid::uuid4()->toString();
		$nama = trim(mysqli_real_escape_string($con, $_POST['nama-'.$i]));
		$gedung = trim(mysqli_real_escape_string($con, $_POST['gedung-'.$i]));
		$sql = mysqli_query($con, "INSERT INTO tb_poliklinik (id_poli, nama_poli, gedung) VALUES ('$uuid', '$nama', '$gedung')") or die (mysqli_error($con));
	}
	if($sql){
		echo "<script>alert('".$total." Data Berhasil Ditambah'); window.location='data.php';</script>";
	}else{
		echo "<script>alert('Gagal Tambah Data'); window.location='generate.php';</script>";
	}
// membuat fungsi multiple edit data
}else if(isset($_POST['edit'])) {
	for ($i=0; $i<count($_POST['id']); $i++) { 
		$id = $_POST['id'][$i];
		$nama = $_POST['nama'][$i];
		$gedung = $_POST['gedung'][$i];
		$sql = mysqli_query($con, "UPDATE tb_poliklinik SET nama_poli = '$nama', gedung = '$gedung' WHERE id_poli = '$id'") or die (mysqli_error($con));
	} 
		echo "<script>alert('Data Berhasil Diubah'); window.location='data.php';</script>";	
}
?>