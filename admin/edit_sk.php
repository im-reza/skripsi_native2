<?php 
session_start();
if ($_SESSION['username']=='kabag') {
	include_once '../assets/header_kabag.php';
} else {
	include_once '../assets/header.php';
}
include_once '../assets/sidebar.php';
$id=$_GET['id'];
?>
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark"><i class="fas fa-pen-alt text-warning"></i> Edit surat <?php echo $id; ?> </h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item"><a href="surat_keluar.php">Surat keluar</a></li>
					<li class="breadcrumb-item active">Edit</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
		<hr>
	</div><!-- /.container-fluid -->
</div>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="card card-primary border border-warning">
					<div class="card-header">
						<h3 class="card-title"><i class="fas ffas fa-dice-d6"></i> Edit data disini</h3>
					</div>
					<?php 
					include '../connections/connection_db.php';
					$id=$_GET['id'];
					$data=mysqli_query($con,"select * from surat_keluar where no_surat='$id'");
					while ($d=mysqli_fetch_array($data)) {
						?>
						<form role="form" method="POST" action="actions/edit_sk.php">
							<div class="card-body">
								<div class="row">
									<input type="text" name="id" value="<?php echo $d['id_sk']; ?>" hidden="">
									<input type="text" name="type_surat" value="<?php echo $d['type_surat'] ?>" hidden="">
									<div class="form-group col-md-3">
										<label for="exampleInputEmail1">Pembuat</label>
										<input type="text" class="form-control" value="<?php echo $d['pembuat'] ?>" readonly="">
									</div>
									<div class="form-group col-md-3">
										<label for="exampleInputPassword1">No surat</label>
										<input type="text" class="form-control" name="no_surat" value="<?php echo $d['no_surat'] ?>"  readonly="">
									</div>
									<div class="form-group col-md-3">
										<label for="exampleInputPassword1">Perihal Surat</label>
										<input type="text" class="form-control" name="perihal" value="<?php echo $d['perihal']; ?>">
									</div>
									<div class="form-group col-md-3">
										<label for="exampleInputPassword1">Tanggal dibuat</label>
										<input type="date" class="form-control" name="tgl_dibuat" readonly="" value="<?php echo date('Y-m-d',strtotime($d['tgl_dibuat'])) ?>">
									</div>
									<div class="form-group col-md-12">
										<label for="exampleInputPassword1">Ditujukan kepada</label>
										<textarea type="text" class="form-control textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="penerima" required="">
											<?php echo $d['penerima']; ?>
										</textarea>
									</div>
									<div class="form-group col-md-12">
										<label for="exampleInputPassword1">Isi surat :</label>
										<textarea type="text" class="form-control textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="isi" required="">
											<?php echo $d['isi']; ?>
										</textarea>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<button type="submit" name="submit" class="btn btn-info">Edit</button>
								<button class="btn btn-danger"><a href="surat_keluar.php" class="text-white">Cancel</a></button>
							</div>
						</form>
					<?php } ?>
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
