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
				<h1 class="m-0 text-dark"><i class="fas ffas fa-dice-d6 text-success"></i> Data Surat Keluar</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item active">Surat keluar</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
		<hr>
	</div><!-- /.container-fluid -->
</div>

<section class="content">
	<div class="container-fluid">
		<?php if (isset($_SESSION['success'])) {
			echo "".$_SESSION['success']."";
		}elseif (isset($_SESSION['success_edit'])) {
			echo "".$_SESSION['success_edit']."";
		}elseif (isset($_SESSION['success_delete'])) {
			echo "".$_SESSION['success_delete']."";
		}elseif (isset($_SESSION['error_delete'])) {
			echo "".$_SESSION['error_delete']."";
		}elseif (isset($_SESSION['failed_edit'])) {
			echo "".$_SESSION['failed_edit']."";
		}
		unset($_SESSION['success']);
		unset($_SESSION['success_edit']);
		unset($_SESSION['success_delete']);
		unset($_SESSION['error_delete']);
		unset($_SESSION['failed_edit']);
		?>
		<div class="card">
			<div class="card-header border-0 bg-gradient-success">
				<h3 class="card-title">
					<i class="fas fa-th mr-1"></i>
					Tabel surat keluar
				</h3>
				<div class="card-tools">
					Laporan :
					<a href="laporan/lap_sk.php?tgl_sk_awal=1" target="_blank" class="ml-3 btn bg-warning btn-sm">
						<i class="fas fa-print"></i>
					</a>
					<button type="button" class="btn bg-warning btn-sm" data-toggle="modal" data-target="#lap_sk">
						<i class="fas fa-calendar"></i>
					</button>
					<button type="button" class="btn bg-light btn-sm" data-card-widget="collapse">
						<i class="fas fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover table-sm" id="surat_masuk" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>#</th>
								<th width="6%">Pembuat</th>
								<th width="20%">Surat</th>
								<th>Perihal</th>
								<th>Kepada</th>
								<th>Cetak</th>
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no=1;
							$query = mysqli_query($con,"SELECT * FROM surat_keluar inner join user on surat_keluar.pembuat=user.username ORDER BY surat_keluar.tgl_dibuat desc");
							while ($d = mysqli_fetch_array($query)) {  
								$tgl_dibuat=$d['tgl_dibuat'];
								?>
								<tr>
									<td><?php echo $no; ?></td>
									<td><?php echo $d['pembuat']; ?></td>
									<td><?php echo $d['no_surat'] . '<br> Tanggal :' . strtolower(date('d-m-Y',strtotime($tgl_dibuat))) ?></td>
									<td><?php echo $d['perihal']; ?></td>
									<td><?php echo $d['penerima']; ?></td>
									<td class="text-center">
										<?php if ($d['type_surat']=="cuti"){
											echo "<a target='_blank' href='laporan/lap_sk_cuti.php?id=".$d['no_surat']."' data-toggle='tooltip' title='Surat cuti'><button class='btn btn-raised btn-primary img-circle btn-sm'><span class='fas fa-file-pdf'></span></button></a>";
										}elseif ($d['type_surat']=="dinas") {
											echo "<a target='_blank' href='laporan/lap_sk_dinas.php?id=".$d['no_surat']."' data-toggle='tooltip' title='Surat perjalanan dinas'><button class='btn btn-raised btn-primary img-circle btn-sm'><span class='fas fa-file-pdf'></span></button></a>";
										}elseif ($d['type_surat']=="kerja") {
											echo "<a target='_blank' href='laporan/lap_sk_kerja.php?id=".$d['no_surat']."' data-toggle='tooltip' title='Surat Perintah Kerja'><button class='btn btn-raised btn-primary img-circle btn-sm'><span class='fas fa-file-pdf'></span></button></a>"; 
										}elseif ($d['type_surat']=="undangan") {
											echo "<a target='_blank' href='laporan/lap_sk_undangan.php?id=".$d['no_surat']."' data-toggle='tooltip' title='Surat undangan'><button class='btn btn-raised btn-primary img-circle btn-sm'><span class='fas fa-file-pdf'></span></button></a>";
										}elseif ($d['type_surat']=="biasa") {
											echo "<a target='_blank' href='laporan/lap_sk_undangan.php?id=".$d['no_surat']."' data-toggle='tooltip' title='Surat yang Dibuat Sendiri'><button class='btn btn-raised btn-primary img-circle btn-sm'><span class='fas fa-file-pdf'></span></button></a>";
										}
										?>
									</td>
									<td class="text-center">
										<?php if ($_SESSION['username']==$d['pembuat']){
											echo "<a href='baca_sk.php?id=".$d['no_surat']."' class='btn btn-raised btn-success img-circle btn-sm'><span class='far fa-eye'></span></button></a>";
										}elseif ($_SESSION['username']=='kabag') {
											echo "<a href='baca_sk.php?id=".$d['no_surat']."' class='btn btn-raised btn-success img-circle btn-sm'><span class='far fa-eye'></span></button></a>";
										}else{
											echo "<button disabled='' class='btn btn-raised btn-success img-circle btn-sm'><span class='far fa-eye'></span></button>";
										}?>
										<?php if ($_SESSION['username']==$d['pembuat']) {
											echo "<button class='btn btn-raised btn-danger img-circle btn-sm' data-href='actions/hapus_sk.php?id=".$d['id_sk']."' data-toggle='modal' data-target='#hapus_surat_sk'><span class='fas fa-trash-alt'></span></button>";
										}elseif ($_SESSION['username']=='kabag') {
											echo "<button class='btn btn-raised btn-danger img-circle btn-sm' data-href='actions/hapus_sk.php?id=".$d['id_sk']."' data-toggle='modal' data-target='#hapus_surat_sk'><span class='fas fa-trash-alt'></span></button>";
										}else{
											echo "<button disabled='' class='btn btn-raised btn-danger img-circle btn-sm'><span class='fas fa-trash-alt'></span></button>";
										}
										$no++;
									}?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<!-- /.card-body -->

			<!-- /.card-footer -->
		</div>

		<!-- /.info-box -->
	</div>
</div><!--/. container-fluid -->
</section>





<?php 
include_once '../assets/footer.php';  
?>


<script>
	$('#surat_masuk').DataTable();
</script>