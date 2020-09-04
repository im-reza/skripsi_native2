<?php 
session_start();
if ($_SESSION['username']=='kabag') {
	include_once '../assets/header_kabag.php';
} else {
	include_once '../assets/header.php';
}
include_once '../assets/sidebar.php';
?>
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark"><i class="fas fa-pen-alt text-warning"></i> Membuat Surat perintah kerja</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item"><a href="surat_keluar.php">Surat keluar</a></li>
					<li class="breadcrumb-item active">Perintah kerja</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
		<hr>
	</div><!-- /.container-fluid -->
</div>

<?php 
include '../connections/connection_db.php';
$carimax=mysqli_query($con,"select max(no_surat) as angka_akhir from surat_keluar");
$data=mysqli_fetch_array($carimax);
$hasilmax=$data['angka_akhir'];
$noUrut=(int)substr($hasilmax, 15,3);
$noUrut++;
$char="100/BAGPEM-BJM/";
$tahun="/2020";
$noSurat=$char.sprintf("%03s",$noUrut).$tahun;
?>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="card card-warning border border-warning">
					<div class="card-header">
						<h3 class="card-title"><i class="fas ffas fa-dice-d6"></i> Isi data disini</h3>
					</div>
					<form role="form" method="POST" action="actions/tambah_sk.php" enctype="multipart/form-data">
						<div class="card-body">
							<div class="row">
								<input type="text" name="type_surat" value="kerja" hidden="">
								<div class="form-group col-md-4">
									<label for="exampleInputEmail1">Pembuat</label>
									<input type="text" class="form-control" name="pembuat" value="<?php echo $_SESSION['username']; ?>" readonly="">
								</div>
								<div class="form-group col-md-4">
									<label for="exampleInputPassword1">No surat</label>
									<input type="text" class="form-control" name="no_surat" value="<?php echo $noSurat ?>"  readonly="">
								</div>
								<div class="form-group col-md-4">
									<label for="exampleInputPassword1">Perihal Surat</label>
									<input type="text" class="form-control" name="perihal" value="Surat Perintah Kerja <?php echo $_SESSION['nama']; ?>" placeholder="Masukkan perihal surat.." required="">
								</div>
								<div class="form-group col-md-12">
									<label for="exampleInputPassword1">Ditujukan kepada</label>
									<textarea type="text" class="form-control textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="penerima" required="">
										<p style="margin-left:40px">-</p>
									</textarea>
								</div>
								<div class="form-group col-md-12">
									<label for="exampleInputPassword1">Isi surat :</label>
									<textarea type="text" class="form-control textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="isi" required="">
										<p><span style="font-family: sans-serif"><span style="font-size:14px">Dasar :&nbsp; Sehubungan dengan Surat Badan Keuangan da Aset Daerah Nomor : <strong>005/392/BAKEUDA-III/2020</strong> Tanggal <?php echo date('d M Y'); ?>, </span></span></p>

										<p><span style="font-family: sans-serif"><span style="font-size:14px">Perihal : Monitoring Aplikasi Palui Online. Maka dengan ini Kepala Bagian Pemerintahan Sekretariat Daerah Kota Banjarmasin :</span></span></p>

										<p>&nbsp;</p>

										<p style="text-align:center"><span style="font-family: sans-serif"><span style="font-size:14px"><strong>MENUGASKAN :</strong></span></span></p>

										<p><span style="font-family: sans-serif"><span style="font-size:14px">Kepada :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1. Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Muhammad Reza</span></span></p>

										<p><span style="font-family: sans-serif"><span style="font-size:14px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; NIP&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : 16630460</span></span></p>

										<p><span style="font-family: sans-serif"><span style="font-size:14px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Pangkat/Gol. Ruang&nbsp; &nbsp; : -</span></span></p>

										<p><span style="font-family: sans-serif"><span style="font-size:14px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Jabatan&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: Teknisi Jaringan</span></span></p>

										<p><span style="font-family: sans-serif"><span style="font-size:14px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;2. Nama&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: Abdurrahman Siddiq</span></span></p>

										<p><span style="font-family: sans-serif"><span style="font-size:14px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;NIP&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: 122222</span></span></p>

										<p><span style="font-family: sans-serif"><span style="font-size:14px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Pangkat/Gol. Ruang&nbsp; &nbsp; : -</span></span></p>

										<p><span style="font-family: sans-serif"><span style="font-size:14px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Jabatan&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : Programer</span></span></p>

										<p>&nbsp;</p>

										<p><span style="font-family: sans-serif"><span style="font-size:14px">Untuk :&nbsp;&nbsp;&nbsp;1. Menghadiri acara dimaksud, yang akan dilaksanakan pada :</span></span></p>

										<p><span style="font-family: sans-serif"><span style="font-size:14px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Hari &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Senin</span></span></p>

										<p><span style="font-family: sans-serif"><span style="font-size:14px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Tanggal&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo date('d M Y'); ?></span></span></p>

										<p><span style="font-family: sans-serif"><span style="font-size:14px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Tempat &nbsp;&nbsp;&nbsp; &nbsp;: Kantor Badan Keuangan dan Aset Daerah</span></span></p>

										<p><span style="font-family: sans-serif"><span style="font-size:14px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;2. Mempersiapkan bahan-bahan yang diperlukan untuk hal dimaksud.</span></span></p>

										<p><span style="font-family: sans-serif"><span style="font-size:14px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;3. Berangkat pada tanggal <?php echo date('d'); ?>&nbsp;<?php echo date('M'); ?>&nbsp;<?php echo date('Y'); ?>, tanggal harus kembali 29&nbsp;<?php echo date('M'); ?>&nbsp;<?php echo date('Y'); ?></span></span></p>

										<p><span style="font-family: sans-serif"><span style="font-size:14px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;4. Melaporkan hasil pelaksanaan tugas kepada Kepala Bagian Pemerintahan Sekretariat Daerah Kota Banjarmasin. </span></span><span style="font-family: sans-serif"><span style="font-size:14px">&nbsp; </span></span></p>

										<p><span style="font-family: sans-serif"><span style="font-size:14px">Demikian Surat Perintah Tugas ini diperbuat, untuk dapat dilaksanakan dengan penuh tanggung jawab.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></p>
										

										
									</textarea>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button type="submit" name="submit" class="btn btn-info">Simpan</button>
							<button type="reset" class="btn btn-danger">Cancel</button>
						</div>
					</form>
				</div>

			</div>

			<!--/.col (right) -->
		</div>

	</div>
</div><!--/. container-fluid -->
</section>

<?php 
include_once '../assets/footer.php';  
?>
<script>
	$(function () {
    // Summernote
    $('.textarea').summernote()
})
</script>