<?php 
include '../../connections/connection_db.php';
session_start();
date_default_timezone_set('Asia/Jakarta');
if (isset($_REQUEST['submit'])) {
	$username=$_POST['username'];
	$password=$_POST['password_new'];
	$nama=$_POST['nama'];
	$nip=$_POST['nip'];
	$pangkat=$_POST['pangkat'];
	$telegram_id=$_POST['telegram_id'];

	$ekstensi_boleh=array('jpg','jpeg','png');
	$nama_images=$_FILES['images']['name'];
	$namasementara=$_FILES['images']['tmp_name'];
	$x=explode('.', $nama_images);
	$namabaru='('.$_SESSION['username'].')'.' '.($nama_images);
	$ekstensi=strtolower(end($x));
	$ukuran=$_FILES['images']['size'];
	$dirUpload="../../assets/images/";


	if ($nama_images=='') {
		$query_p=mysqli_query($con,"UPDATE user SET password=md5('$password'),nama='$nama', nip='$nip', pangkat='$pangkat', telegram_id='$telegram_id' where username='$username' ");
		echo "<script>window.location.href='../../logout.php'</script>";
	}else{
		if (in_array($ekstensi, $ekstensi_boleh)==true) {
			if ($ukuran<21044070) {
				$delet=mysqli_query($con,"select * from user where username='$username'");
				$r=mysqli_fetch_array($delet);
				$nama_f=$r['images'];
				unlink("../../assets/images/".$nama_f);
				move_uploaded_file($namasementara, $dirUpload.$namabaru);
				$query=mysqli_query($con,"UPDATE user SET password=md5('$password'),nama='$nama', nip='$nip', pangkat='$pangkat', telegram_id='$telegram_id', images='$namabaru' where username='$username' ");
				if ($query) {
					echo "<script>window.location.href='../../logout.php'</script>";
				} else {
					echo "<script>window.location.href='../index.php'</script>";
				}
			} else {
				echo "<script>window.location.href='../index.php'</script>";
			}
		} else {
			echo "<script>window.location.href='../index.php'</script>";
		}
	}
}






?>
