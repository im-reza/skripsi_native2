<?php 
include '../../connections/connection_db.php';
session_start();
date_default_timezone_set('Asia/Jakarta');
if (isset($_REQUEST['submit'])) {
	$id=$_POST['id'];
	$no_br=$_POST['no_surat'];
	$tgl_dibuat=$_POST['tgl_dibuat'];
	$tgl_srt=date("Y-m-d",strtotime($tgl_dibuat));
	$waktu=date('H:i:s');
	$perihal=$_POST['perihal'];
	$penerima=$_POST['penerima'];
	$isi=$_POST['isi'];
	$type_surat=$_POST['type_surat'];
	$query=mysqli_query($con,"update surat_keluar set tgl_dibuat='$tgl_srt $waktu',perihal='$perihal',penerima='$penerima',isi='$isi',type_surat='$type_surat' where id_sk='$id' ");
	if ($query) {
		$_SESSION['success_edit']='<div class="alert alert-primary alert-dismissible fade show" role="alert">
		Data berhasil Diedit !
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>';
		echo "<script>window.location.href='../surat_keluar.php'</script>";
	} else {
		$_SESSION['failed_edit']='<div class="alert alert-danger alert-dismissible fade show" role="alert">
		Gagal Mengedit !
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>';
		echo "<script>window.location.href='../surat_keluar.php'</script>";
	}
}



?>