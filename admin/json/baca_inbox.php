<?php
include '../../connections/connection_db.php';
date_default_timezone_set('Asia/Jakarta');
session_start();
$user=$_SESSION['username'];
if (isset($_POST['nomor'])) {
	$no=$_POST['nomor'];
	$tgl_dibaca=date("Y-m-d H:i:s");
	$sql_cek=mysqli_query($con,"select * from disposisi where no_surat='$no' and kepada='$user'  ");
	$d=mysqli_fetch_array($sql_cek);
	$tgl_dibaca1=$d['tgl_dibaca'];
	if ($tgl_dibaca1=='0000-00-00 00:00:00') {
		$sql=mysqli_query($con,"UPDATE disposisi SET status_ds='1', tgl_dibaca='$tgl_dibaca' where no_surat='$no' and kepada='$user'  ");
	} else {
		$sql=mysqli_query($con,"UPDATE disposisi SET status_ds='1' where no_surat='$no' and kepada='$user'  "); // query sql untuk menampilkan 
	}
	
	echo json_encode($sql);
}



?>