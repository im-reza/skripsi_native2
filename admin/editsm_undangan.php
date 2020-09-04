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
				<h1 class="m-0 text-dark"><i class="fas fa-edit text-success"></i> Edit Surat undangan</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item"><a href="surat_masuk.php">Surat masuk</a></li>
					<li class="breadcrumb-item active">Edit</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
		<hr>
	</div><!-- /.container-fluid -->
</div>

<section class="content">
	<div class="container-fluid">
		<?php if (isset($_SESSION['size_format'])) {
			echo "".$_SESSION['size_format']."";
		}elseif (isset($_SESSION['size_big'])) {
			echo "".$_SESSION['size_big']."";
		}elseif (isset($_SESSION['failed_edit'])) {
			echo "".$_SESSION['failed_edit']."";
		}
		unset($_SESSION['size_format']);
		unset($_SESSION['size_big']);
		unset($_SESSION['failed_edit']);
		?>
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="card card-success border border-warning">
					<div class="card-header">
						<h3 class="card-title"><i class="fas ffas fa-dice-d6"></i> Isi edit surat undangan</h3>
					</div>
					<?php 
						$id=$_GET['id'];
						$query=mysqli_query($con,"select * from surat_masuk inner join acara on surat_masuk.no_surat=acara.no_surat where surat_masuk.id_sm='$id' ");
						while ($d=mysqli_fetch_array($query)) {
					 ?>
					<form role="form" method="POST" action="actions/editsm_undangan.php" enctype="multipart/form-data">
						<div class="card-body">
							<div class="row">
								<input type="text" hidden="" name="id" value="<?php echo $d['id_sm'] ?>">
								<div class="form-group col-md-4">
									<label for="exampleInputEmail1">Nomor surat</label>
									<input type="text" class="form-control" name="no_surat" readonly="" value="<?php echo $d['no_surat'] ?>" required="">
								</div>
								<div class="form-group col-md-4">
									<label for="exampleInputPassword1">Tanggal surat</label>
									<input type="date" class="form-control" name="tgl_surat" value="<?php echo date('Y-m-d', strtotime($d['tgl_surat'])) ?>" required="">
								</div>
								<div class="form-group col-md-4">
									<label for="exampleInputPassword1">Tanggal diterima</label>
									<input type="date" class="form-control" name="tgl_diterima" value="<?php echo date('Y-m-d', strtotime($d['tgl_diterima'])) ?>" required="">
								</div>
								<div class="form-group col-md-6">
									<label for="exampleInputPassword1">Pengirim</label>
									<input type="text" class="form-control" name="pengirim" value="<?php echo $d['pengirim'] ?>" required="">
								</div>
								<div class="form-group col-md-6">
									<label for="exampleInputPassword1">Perihal</label>
									<input type="text" class="form-control" name="perihal" value="<?php echo $d['perihal'] ?>" required="">
								</div>
								<div class="form-group col-md-12">
									<label for="exampleInputPassword1">Tempat acara</label>
									<input type="text" class="form-control" name="tempat" value="<?php echo $d['tempat'] ?>" required="">
								</div>
								<div class="form-group col-md-3">
									<label for="exampleInputPassword1">Tanggal acara</label>
									<input type="date" class="form-control" name="tgl_mulai" value="<?php echo date('Y-m-d', strtotime($d['start_event'])) ?>" required="">
								</div>
								<div class="form-group col-md-3">
									<label for="exampleInputPassword1">Waktu mulai</label>
									<input type="time" class="form-control" name="waktu_mulai" value="<?php echo date('H:i', strtotime($d['start_event'])) ?>" required="">
								</div>
								<div class="form-group col-md-3">
									<label for="exampleInputPassword1">Tanggal selesai</label>
									<input type="date" class="form-control" name="tgl_selesai" value="<?php echo date('Y-m-d', strtotime($d['end_event'])) ?>" required="">
								</div>
								<div class="form-group col-md-3">
									<label for="exampleInputPassword1">Waktu selesai</label>
									<input type="time" class="form-control" name="waktu_selesai" value="<?php echo date('H:i', strtotime($d['end_event'])) ?>" required="">
								</div>
								<input type="text" name="type_surat" hidden="" value="undangan">
								<div class="form-group col-md-12">
									<div class="dropzone-wrapper">
										<div class="dropzone-desc">
											<label for="exampleInputPassword1">Upload file</label>
										</div>
										<input type="file" name="file" class="dropzone form-control col-md-12">
										file lama<input type="text" class="form-control" name="file_lama" value="<?php echo $d['file']; ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button type="submit" name="submit" class="btn btn-info">Edit</button>
							<button type="reset" class="btn btn-danger">Cancel</button>
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
