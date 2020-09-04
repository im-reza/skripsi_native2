<?php 
include '../../connections/connection_db.php'; 
include '../../connections/tgl_indo.php';
session_start();
date_default_timezone_set('Asia/Jakarta');

function sendMessage($telegram_id, $text, $secret_token) {

	$url = "https://api.telegram.org/bot" . $secret_token . "/sendMessage?parse_mode=markdown&chat_id=" . $telegram_id;
	$url = $url . "&text=" . urlencode($text);
	$ch = curl_init();
	$optArray = array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true
	);
	curl_setopt_array($ch, $optArray);
	$result = curl_exec($ch);
	curl_close($ch);
}
if (isset($_REQUEST['submit'])) {
	$pembuat=$_POST['pembuat'];
	$no_br=$_POST['no_surat'];
	$tgl_dibuat=date("Y-m-d H:i");
	$perihal=$_POST['perihal'];
	$penerima=$_POST['penerima'];
	$isi=$_POST['isi'];
	$type_surat=$_POST['type_surat'];
	$secret_token = "1350546823:AAEZAZmOD7esCYC0o5Sl17bLLkqpwX8jnq4";

	$dibuat=tgl_indo(date('D d-m-Y H:i',strtotime($tgl_dibuat)));

	$text='#-- *Membuat Surat Keluar* --#
	Tanggal : *'.$dibuat.'*,
	Nomor Surat : *'.$no_br.'*,
	Yang Membuat : *'.$pembuat.'*,
	Perihal : *'.$perihal.'*,
	Jenis : Surat *'.$type_surat.'*,
	#-- Terimakasih --# ';

	$id_kabag=mysqli_query($con,"select telegram_id from user where username='kabag'");
	while ($kabag=mysqli_fetch_array($id_kabag)) {
		$telegram_id=$kabag['telegram_id'];
	}
	$query=mysqli_query($con,"insert into surat_keluar values ('','$pembuat','$no_br','$tgl_dibuat','$perihal','$penerima','$isi','$type_surat', '0') ");
	if ($query) {
		sendMessage($telegram_id, $text, $secret_token);
		$_SESSION['success']='<div class="alert alert-success alert-dismissible fade show" role="alert">
		Berhasil membuat surat Selamat !
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>';
		echo "<script>window.location.href='../surat_keluar.php'</script>";
	} else {
		$_SESSION['failed']='<div class="alert alert-danger alert-dismissible fade show" role="alert">
		Gagal membuat surat
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>';
		echo "<script>window.location.href='../surat_keluar.php'</script>";
	}
}



?>