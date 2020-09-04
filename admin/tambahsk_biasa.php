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
				<h1 class="m-0 text-dark"><i class="fas fa-pen-alt text-warning"></i> Membuat Surat</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item"><a href="surat_keluar.php">Surat keluar</a></li>
					<li class="breadcrumb-item active">Surat</li>
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
								<input type="text" name="type_surat" value="biasa" hidden="">
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
									<input type="text" class="form-control" name="perihal" value="Surat <?php echo $_SESSION['username']; ?>" placeholder="Masukkan perihal surat.." required="">
								</div>
								<div class="form-group col-md-12">
									<label for="exampleInputPassword1">Ditujukan kepada</label>
									<textarea type="text" class="form-control textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="penerima" required="">
										<ol>
											<li><span style="font-family: sans-serif;">&nbsp;Bank Kalsel Cabang Banjarmasin</span><span style="font-family: sans-serif;">﻿</span><span style="font-family: sans-serif;">﻿</span><span style="font-family: sans-serif;">﻿</span></li>
										</ol>
									</textarea>
								</div>
								<div class="form-group col-md-12">
									<label for="exampleInputPassword1">Isi surat :</label>
									<textarea type="text" class="form-control textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="isi" required="">
										<p><span style="font-family: sans-serif;font-size: 14px">Tes 123 Halo</span></p><p style="text-align:justify">

										</p>
										<p></p>
										
										<p></p>
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