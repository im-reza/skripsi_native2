<?php 
session_start();
include_once'../connections/auth_admin.php';
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
				<h1 class="m-0 text-dark"><i class="fas ffas fa-dice-d6 text-primary"></i> Tambah Surat undangan</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item"><a href="index.php">Surat masuk</a></li>
					<li class="breadcrumb-item active">Undangan</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
		<hr>
	</div><!-- /.container-fluid -->
</div>

<section class="content">
	<div class="container-fluid">
		<?php if (isset($_SESSION['failed'])) {
			echo " ".$_SESSION['failed']."";
		}elseif (isset($_SESSION['size_format'])) {
			echo "".$_SESSION['size_format']."";
		}elseif (isset($_SESSION['size_big'])) {
			echo "".$_SESSION['size_big']."";
		}elseif (isset($_SESSION['duplicate'])) {
			echo "".$_SESSION['duplicate']."";
		}elseif (isset($_SESSION['success_delete'])) {
			echo "".$_SESSION['success_delete']."";
		}elseif (isset($_SESSION['error_delete'])) {
			echo "".$_SESSION['error_delete']."";
		}elseif (isset($_SESSION['success_edit'])) {
			echo "".$_SESSION['success_edit']."";
		}elseif (isset($_SESSION['failed_edit'])) {
			echo "".$_SESSION['failed_edit']."";
		}
		unset($_SESSION['failed']);
		unset($_SESSION['size_format']);
		unset($_SESSION['size_big']);
		unset($_SESSION['duplicate']);
		unset($_SESSION['success_delete']);
		unset($_SESSION['error_delete']);
		unset($_SESSION['success_edit']);
		unset($_SESSION['failed_edit']);
		?>
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="card card-primary border border-warning">
					<div class="card-header">
						<h3 class="card-title"><i class="fas ffas fa-dice-d6"></i> Isi data surat undangan</h3>
					</div>
					<!-- /.card-header -->
					<!-- form start -->
					<form role="form" method="POST" action="actions/tambahsm_undangan.php" enctype="multipart/form-data">
						<div class="card-body">
							<div class="row">
								<div class="form-group col-md-6">
									<label for="exampleInputEmail1">Nomor surat</label>
									<input type="text" class="form-control" name="no_surat" placeholder="Masukkan nomor surat.." required="">
								</div>
								<div class="form-group col-md-6">
									<label for="exampleInputPassword1">Tanggal Surat</label>
									<input type="date" class="form-control" name="tgl_surat" value="<?php echo date('Y-m-d') ?>" required="">
								</div>
								<div class="form-group col-md-6">
									<label for="exampleInputPassword1">Pengirim</label>
									<input type="text" class="form-control" name="pengirim" placeholder="Masukkan pengirim surat.." required="">
								</div>
								<div class="form-group col-md-6">
									<label for="exampleInputPassword1">Perihal</label>
									<input type="text" class="form-control" name="perihal" placeholder="Masukkan perihal surat.." required="">
								</div>
								<div class="form-group col-md-12">
									<label for="exampleInputPassword1">Tempat acara</label>
									<input type="text" class="form-control" name="tempat" placeholder="Masukkan tempat acara.." required="">
								</div>
								<div class="form-group col-md-3">
									<label for="exampleInputPassword1">Tanggal acara</label>
									<input type="date" class="form-control" name="tgl_mulai" required="">
								</div>
								<div class="form-group col-md-3">
									<label for="exampleInputPassword1">Waktu mulai</label>
									<input type="time" class="form-control" name="waktu_mulai" required="">
								</div>
								<div class="form-group col-md-3">
									<label for="exampleInputPassword1">Tanggal selesai</label>
									<input type="date" class="form-control" name="tgl_selesai" required="">
								</div>
								<div class="form-group col-md-3">
									<label for="exampleInputPassword1">Waktu selesai</label>
									<input type="time" class="form-control" name="waktu_selesai" required="">
								</div>
								<input type="text" name="type_surat" hidden="" value="undangan">
								<div class="form-group col-md-12">
									<div class="dropzone-wrapper">
										<div class="dropzone-desc">
											<label for="exampleInputPassword1">Upload file</label>
										</div>
										<input type="file" name="file" class="dropzone form-control col-md-12" required="">
									</div>
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
