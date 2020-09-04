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
if (isset($_POST['submit'])) {
	$id_kabag=mysqli_query($con,"select telegram_id from user where username='kabag'");
	while ($kabag=mysqli_fetch_array($id_kabag)) {
		$telegram_id=$kabag['telegram_id'];
	}
	$secret_token = "1350546823:AAEZAZmOD7esCYC0o5Sl17bLLkqpwX8jnq4";
	$tgl_s=$_POST['tgl_surat'];
	$type=$_POST['type_surat'];
	$tgl_srt=date("Y-m-d",strtotime($tgl_s));
	$tgl_diterima=date("Y-m-d H:i:s");
	$no_br=htmlspecialchars($_POST['no_surat']);
	$pengirim=htmlspecialchars($_POST['pengirim']);
	$perihal=htmlspecialchars($_POST['perihal']);
	$tempat=htmlspecialchars($_POST['tempat']);
	$start_event=date('Y-m-d',strtotime($_POST['tgl_mulai']));
	$end_event=date('Y-m-d',strtotime($_POST['tgl_selesai']));
	$time=date('H:i',strtotime($_POST['waktu_mulai']));
	$time1=date('H:i',strtotime($_POST['waktu_selesai']));

	$ekstensi_boleh=array('pdf','jpg','jpeg','png');
	$namafile=$_FILES['file']['name'];
	$namasementara=$_FILES['file']['tmp_name'];
	$x=explode('.', $namafile);
	$namabaru='('.date("d_m_y_Hs").')'.' '.($namafile);
	$ekstensi=strtolower(end($x));
	$ukuran=$_FILES['file']['size'];
	$dirUpload="../../file/";

	$text='#-- *Surat Undangan* --#
	Surat nomor *'.$no_br.'*,
	dari : *'.$pengirim.'*,
	Perihal : *'.$perihal.'*, 
	Tempat : *'.$tempat.'*,
	Mulai : *'.tgl_indo(date('D, d-m-Y', strtotime($start_event))).' '.date('H:i',strtotime($time)).'*,
	sampai : *'.tgl_indo(date('D, d-m-Y',strtotime($end_event))).' '.date('H:i',strtotime($time1)).'*, 
	 #-- Harap segera diverifikasi ! --# ';

	$cek=mysqli_num_rows(mysqli_query($con,"select * from surat_masuk where no_surat='$no_br'"));

	if ($cek>0) {
		$_SESSION['duplicate']='<div class="alert alert-secondary alert-dismissible fade show" role="alert">
		Data dengan no <b> " '.$no_br.' " </b> Sudah Ada !!!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>';
		echo "<script>window.location.href='../tambahsm_undangan.php'</script>";

	} else {

		if (in_array($ekstensi, $ekstensi_boleh)==true) {
			if ($ukuran<21044070) {
				sendMessage($telegram_id, $text, $secret_token);
				move_uploaded_file($namasementara, $dirUpload.$namabaru);
				$query=mysqli_query($con,"insert into surat_masuk values ('','$no_br','$pengirim','$perihal','$tgl_srt','$tgl_diterima','$type','$namabaru','0') ");
				$queryacara=mysqli_query($con,"insert into acara values ('$no_br','$tempat','$start_event $time','$end_event $time1')");
				if ($queryacara) {
              # code...
					$_SESSION['success']='<div class="alert alert-success alert-dismissible fade show" role="alert">
					Berhasil menambahkan data, selamat !
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>';
					echo "<script>window.location.href='../surat_masuk.php'</script>";
				} else {
					$_SESSION['failed']='<div class="alert alert-danger alert-dismissible fade show" role="alert">
					Gagal Upload !
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>';
					echo "<script>window.location.href='../tambahsm_undangan.php'</script>";
				}

			} else {
				$_SESSION['size_format']='<div class="alert alert-warning alert-dismissible fade show" role="alert">
				File Terlalu Besar
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>';
				echo "<script>window.location.href='../tambahsm_undangan.php'</script>";
			}
		} else {
			$_SESSION['size_big']='<div class="alert alert-warning alert-dismissible fade show" role="alert">
			Hanya file yang berformat PDF, atau JPG. yang dapat diinput !
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>';
			echo "<script>window.location.href='../tambahsm_undangan.php'</script>";
		}
	}

}

?>