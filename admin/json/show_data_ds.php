<?php 
include '../../connections/connection_db.php';

if (isset($_POST['no'])) {
	$no=$_POST['no'];
	$query=mysqli_query($con,"select surat_masuk.no_surat,surat_masuk.tgl_surat,surat_masuk.tgl_diterima,surat_masuk.pengirim,surat_masuk.perihal,surat_masuk.file,disposisi.kepada,disposisi.catatan,disposisi.tgl_disposisi from disposisi inner join surat_masuk on surat_masuk.no_surat=disposisi.no_surat where disposisi.no_surat='$no' GROUP BY disposisi.no_surat; ");
	while ($d=mysqli_fetch_array($query)) {

		echo json_encode($d);
	}

}

?>