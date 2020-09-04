<?php 
include '../../connections/connection_db.php';

if (isset($_POST['no'])) {
	$no=$_POST['no'];
	$query=mysqli_query($con,"select * from surat_masuk where id_sm='$no' ");
	while ($d=mysqli_fetch_array($query)) {
		
		echo json_encode($d);
	}
}

?>