<?php 
include '../../connections/connection_db.php';
include '../../connections/tgl_indo.php';
session_start();
date_default_timezone_set('Asia/Jakarta');
if (isset($_REQUEST['submit'])) {
	$id=$_POST['id'];
	$type=$_POST['type_surat'];
	$tgl_s=$_POST['tgl_surat'];
	$tgl_srt=date("Y-m-d",strtotime($tgl_s));
	$tgl_trm=$_POST['tgl_diterima'];
	$tgl_diterima=date("Y-m-d",strtotime($tgl_trm));
	$tgl_diterima_waktu=date('H:i:s');
	$no_br=htmlspecialchars($_POST['no_surat']);
	$pengirim=htmlspecialchars($_POST['pengirim']);
	$perihal=htmlspecialchars($_POST['perihal']);

	$ekstensi_boleh=array('pdf','jpg','jpeg','png');
	$namafile=$_FILES['file']['name'];
	$namasementara=$_FILES['file']['tmp_name'];
	$x=explode('.', $namafile);
	$namabaru='('.date("d_m_y_Hs").')'.' '.($namafile);
	$ekstensi=strtolower(end($x));
	$ukuran=$_FILES['file']['size'];
	$dirUpload="../../file/";


	if ($namafile=='') {
		$query_p=mysqli_query($con,"UPDATE surat_masuk SET pengirim='$pengirim',perihal='$perihal', tgl_surat='$tgl_srt', tgl_diterima='$tgl_diterima $tgl_diterima_waktu', type_surat='$type' where id_sm='$id' ");
		$_SESSION['success_edit']='<div class="alert alert-primary alert-dismissible fade show" role="alert">
		Berhasil mengedit data surat pemberitahuan !
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>';
		echo "<script>window.location.href='../surat_masuk.php'</script>";
	}else{
		if (in_array($ekstensi, $ekstensi_boleh)==true) {
			if ($ukuran<21044070) {
				$delet=mysqli_query($con,"select * from surat_masuk where no_surat='$no_br'");
				$r=mysqli_fetch_array($delet);
				$nama_f=$r['file'];
				unlink("../../file/".$nama_f);
				move_uploaded_file($namasementara, $dirUpload.$namabaru);
				$query=mysqli_query($con,"UPDATE surat_masuk SET pengirim='$pengirim',perihal='$perihal', tgl_surat='$tgl_srt', tgl_diterima='$tgl_diterima $tgl_diterima_waktu', type_surat='$type', file='$namabaru' where id_sm='$id' ");
				if ($query) {
					$_SESSION['success_edit']='<div class="alert alert-primary alert-dismissible fade show" role="alert">
					Berhasil mengedit data dan file surat pemberitahuan !
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>';
					echo "<script>window.location.href='../surat_masuk.php'</script>";
				} else {
					$_SESSION['failed_edit']='<div class="alert alert-danger alert-dismissible fade show" role="alert">
					Gagal mengedit !
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>';
					echo "<script>window.location.href='../editsm_pemberitahuan.php'</script>";
				}
			} else {
				$_SESSION['size_big']='<div class="alert alert-danger alert-dismissible fade show" role="alert">
				File Terlalu Besar
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>';
				echo "<script>window.location.href='../editsm_pemberitahuan.php'</script>";
			}
		} else {
			$_SESSION['size_format']='<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Hanya file yang berformat PDF, atau JPG. yang dapat diinput !
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>';
			echo "<script>window.location.href='../editsm_pemberitahuan.php'</script>";
		}
	}
}





?>
