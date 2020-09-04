<?php
include '../../connections/connection_db.php';
if (isset($_POST['no_sk'])) {
	$no=$_POST['no_sk'];
	$sql1=mysqli_query($con,"UPDATE surat_keluar SET status_surat='1' where no_surat='$no' ");

	echo json_encode($sql1);
}
?>