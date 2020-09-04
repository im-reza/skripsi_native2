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
	$no_br=$_POST['no_surat'];
	$tgl_disposisi=date("Y-m-d H:i:s");
	$catatan=$_POST['catatan'];
	$kepada=$_POST['kepada'];
	$perihal=$_POST['perihal'];
	$jumlah_dipilih = count($kepada);
	$secret_token = "1350546823:AAEZAZmOD7esCYC0o5Sl17bLLkqpwX8jnq4";
	$date=tgl_indo(date('D, d-m-Y'));


	for($x=0;$x<$jumlah_dipilih;$x++){
		$query=mysqli_query($con,"insert into disposisi values ('$no_br','$kepada[$x]','$catatan','$tgl_disposisi','0','0000-00-00 00:00:00') ");
		$user=mysqli_query($con,"select telegram_id from user where username='$kepada[$x]'");
		while ($us=mysqli_fetch_array($user)) {
			$telegram_id=$us['telegram_id'];
		}
		$text='#-- *Disposisi Surat* --#
		Tanggal : *'.$date.'*,
		Nomor Surat : *'.$no_br.'*,
		Tentang : *'.$perihal.'*,
		Catatan dari Kabag : *'.$catatan.'*,
		Kepada : *'.$kepada[$x].'*
			#-- no-reply --# ';
		$send[$x]=sendMessage($telegram_id, $text, $secret_token);
	}
	if ($query) {
		
		$querysm=mysqli_query($con,"update surat_masuk set status_disposisi='1' where no_surat='$no_br'");
		$_SESSION['success']='<div class="alert alert-success alert-dismissible fade show" role="alert">
		Berhasil mendisposisikan surat !
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>';
		echo "<script>window.location.href='../disposisi_verif.php'</script>";
	} else {
		$_SESSION['failed']='<div class="alert alert-danger alert-dismissible fade show" role="alert">
		Gagal
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>';
		echo "<script>window.location.href='../disposisi_verif.php'</script>";
	}
}
?>
