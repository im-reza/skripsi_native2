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
if (isset($_REQUEST['id'])) {
	$secret_token = "1350546823:AAEZAZmOD7esCYC0o5Sl17bLLkqpwX8jnq4";
	$id=$_GET['id'];

	$cari_sk=mysqli_query($con,"select * from surat_keluar inner join user on surat_keluar.pembuat=user.username where surat_keluar.id_sk='$id'");
	$d=mysqli_fetch_array($cari_sk);
	$pembuat=$d['pembuat'];
	$no_br=$d['no_surat'];
	$perihal=$d['perihal'];
	$tgl_dibuat=$d['tgl_dibuat'];
	$telegram_id=$d['telegram_id'];

	$text='#-- *Surat anda telah dihapus Kabag* --#
	Pembuat : *'.$pembuat.'*,
	Surat nomor *'.$no_br.'*,
	Perihal : *'.$perihal.'*,
	Tanggal dibuat : *'.tgl_indo(date('D, d-m-Y',strtotime($tgl_dibuat))).'*
   #-- no reply ! --# ';

	$hapus=mysqli_query($con,"DELETE FROM surat_keluar WHERE id_sk='$id' ");	
	if ($hapus) {
		if ($_SESSION['username']=='kabag' and $pembuat!='kabag') {
			sendMessage($telegram_id, $text, $secret_token);
		} else {
		}
		
		$_SESSION['success_delete']='<div class="alert alert-danger alert-dismissible fade show" role="alert">
		Data berhasil dihapus !
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>';
		echo "<script>window.location.href='../surat_keluar.php'</script>";
		$reset=mysqli_query($con,"alter table surat_keluar auto_increment=1");
	} else {
		$_SESSION['error_delete']='<div class="alert alert-danger alert-dismissible fade show" role="alert">
		Gagal menghapus Data
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>';
		echo "<script>window.location.href='../surat_keluar.php'</script>";
	}
}
?>