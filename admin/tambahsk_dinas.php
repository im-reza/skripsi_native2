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
				<h1 class="m-0 text-dark"><i class="fas fa-pen-alt text-warning"></i> Membuat Surat perjalanan dinas</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item"><a href="surat_keluar.php">Surat keluar</a></li>
					<li class="breadcrumb-item active">Perjalan dinas</li>
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
								<input type="text" name="type_surat" value="dinas" hidden="">
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
									<input type="text" class="form-control" name="perihal" value="Surat Perjalanan Dinas <?php echo $_SESSION['nama']; ?>" placeholder="Masukkan perihal surat.." required="">
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
										<center><table border="1" cellspacing="0" class="TableNormal1" style="border-collapse:collapse">
											<tbody>
												<tr>
													<td style="border-bottom:1px solid #000; border-left:1px solid #000; border-right:1px solid #000; border-top:none; height:32px; vertical-align:top; width:28px">
														<p style="margin-left:6px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">1</span></span></span></p>
													</td>
													<td style="border-bottom:1px solid #000; border-left:none; border-right:1px solid #000; border-top:1px solid #000; height:34px; vertical-align:top; width:292px">
														<p style="margin-left:7px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">Pejabat benwenang yang memberi perintah</span></span></span></p>
													</td>
													<td colspan="2" style="border-bottom:1px solid #000; border-left:none; border-right:1px solid #000; border-top:1px solid #000; height:34px; vertical-align:top; width:334px">
														<p style="margin-left:4px"><strong><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">KEPALA BAGIAN PEMERINTAHAN</span></span></span></strong></p>

														<p style="margin-left:4px"><strong><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">Drs. DOLLY SYAHBANA, MM</span></span></span></strong></p>
													</td>
												</tr>
												<tr>
													<td style="border-bottom:1px solid #000; border-left:1px solid #000; border-right:1px solid #000; border-top:none; height:32px; vertical-align:top; width:28px">
														<p style="margin-left:6px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">2</span></span></span></p>
													</td>
													<td style="border-bottom:1px solid #000; border-left:none; border-right:1px solid #000; border-top:none; height:32px; vertical-align:top; width:292px">
														<p style="margin-left:7px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">Nama Pegawai&nbsp;yang diperintahkan</span></span></span></p>
													</td>
													<td colspan="2" style="border-bottom:1px solid #000; border-left:none; border-right:1px solid #000; border-top:none; height:32px; vertical-align:top; width:334px">
														<p style="margin-left:4px"><strong><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">MUHAMMAD REZA</span></span></span></strong></p>
													</td>
												</tr>
												<tr>
													<td style="border-bottom:1px solid #000; border-left:1px solid #000; border-right:1px solid #000; border-top:none; height:75px; vertical-align:top; width:28px">
														<p style="margin-left:6px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">3</span></span></span></p>
													</td>
													<td style="border-bottom:1px solid #000; border-left:none; border-right:1px solid #000; border-top:none; height:83px; vertical-align:top; width:292px">
														<ol style="list-style-type:lower-alpha">
															<li>
																<p><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">Pangkat/Gol.Ruang</span></span></span></p>
															</li>
															<li>
																<p><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">Jabatan</span></span></span></p>
															</li>
															<li>
																<p><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">Gaji&nbsp;Pokok</span></span></span></p>
															</li>
														</ol>
													</td>
													<td colspan="2" style="border-bottom:1px solid #000; border-left:none; border-right:1px solid #000; border-top:none; height:83px; vertical-align:top; width:334px">
														<ol style="list-style-type:lower-alpha">
															<li>
																<p><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">Pranata Muda, III/a</span></span></span></p>
															</li>
															<li>
																<p>&nbsp;</p>
															</li>
															<li>
																<p>&nbsp;</p>
															</li>
														</ol>

														<p style="margin-left:3px">&nbsp;</p>
													</td>
												</tr>
												<tr>
													<td style="border-bottom:1px solid #000; border-left:1px solid #000; border-right:1px solid #000; border-top:none; height:67px; vertical-align:top; width:28px">
														<p style="margin-left:4px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">4</span></span></span></p>
													</td>
													<td style="border-bottom:1px solid #000; border-left:none; border-right:1px solid #000; border-top:none; height:67px; vertical-align:top; width:292px">
														<p style="margin-left:12px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">Maksud Perjalanan Dinas</span></span></span></p>
													</td>
													<td colspan="2" style="border-bottom:1px solid #000; border-left:none; border-right:1px solid #000; border-top:none; height:67px; vertical-align:top; width:334px">
														<p style="margin-left:4px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">Melaksanankan Rapat Pleno Tahunan Provinsi 2020.</span></span></span></p>
													</td>
												</tr>
												<tr>
													<td style="border-bottom:1px solid #000; border-left:1px solid #000; border-right:1px solid #000; border-top:none; height:34px; vertical-align:top; width:28px">
														<p style="margin-left:6px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">5</span></span></span></p>
													</td>
													<td style="border-bottom:1px solid #000; border-left:none; border-right:1px solid #000; border-top:none; height:34px; vertical-align:top; width:292px">
														<p style="margin-left:6px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">Alat Transportasi</span></span></span></p>
													</td>
													<td colspan="2" style="border-bottom:1px solid #000; border-left:none; border-right:1px solid #000; border-top:none; height:34px; vertical-align:top; width:334px">
														<p style="margin-left:4px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">Mobil</span></span></span></p>
													</td>
												</tr>
												<tr>
													<td style="border-bottom:1px solid #000; border-left:1px solid #000; border-right:1px solid #000; border-top:none; height:40px; vertical-align:top; width:28px">
														<p style="margin-left:4px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">6</span></span></span></p>
													</td>
													<td style="border-bottom:1px solid #000; border-left:none; border-right:1px solid #000; border-top:none; height:40px; vertical-align:top; width:292px">
														<p style="margin-left:27px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">a. Tempat berangkat</span></span></span></p>

														<p style="margin-left:28px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">b.&nbsp;Tempat Tujuan</span></span></span></p>
													</td>
													<td colspan="2" style="border-bottom:1px solid #000; border-left:none; border-right:1px solid #000; border-top:none; height:40px; vertical-align:top; width:334px">
														<p style="margin-left:3px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">&nbsp; &nbsp; &nbsp;a. Banjarmasin</span></span></span></p>

														<p style="margin-left:4px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">&nbsp; &nbsp; &nbsp;b.&nbsp;Palangkaraya</span></span></span></p>
													</td>
												</tr>
												<tr>
													<td style="border-bottom:1px solid #000; border-left:1px solid #000; border-right:1px solid #000; border-top:none; height:67px; vertical-align:top; width:28px">
														<p style="margin-left:6px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">7</span></span></span></p>
													</td>
													<td style="border-bottom:1px solid #000; border-left:none; border-right:1px solid #000; border-top:none; height:67px; vertical-align:top; width:292px">
														<ol style="list-style-type:lower-alpha">
															<li>
																<p><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">Lama&nbsp;Perjalanan Dinas</span></span></span></p>
															</li>
															<li>
																<p><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">Tanggal&nbsp;berangkat</span></span></span></p>
															</li>
															<li>
																<p><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">Tanggal Harus Kembali</span></span></span></p>
															</li>
														</ol>
													</td>
													<td colspan="2" style="border-bottom:1px solid #000; border-left:none; border-right:1px solid #000; border-top:none; height:67px; vertical-align:top; width:334px">
														<ol style="list-style-type:lower-alpha">
															<li>
																<p><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">3 Hari</span></span></span></p>
															</li>
															<li>
																<p><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif"><?php echo tgl_indo(date('d M')); ?>&nbsp;<?php echo date('Y'); ?></span></span></span></p>
															</li>
															<li>
																<p><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif"><?php echo tgl_indo(date('d')); ?>&nbsp;<?php echo tgl_indo(date('M')); ?>&nbsp;<?php echo tgl_indo(date('Y')); ?></span></span></span></p>
															</li>
														</ol>
													</td>
												</tr>
												<tr>
													<td style="border-bottom:1px solid #000; border-left:1px solid #000; border-right:1px solid #000; border-top:none; height:68px; vertical-align:top; width:28px">
														<p style="margin-left:4px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">8</span></span></span></p>
													</td>
													<td style="border-bottom:1px solid #000; border-left:none; border-right:1px solid #000; border-top:none; height:68px; vertical-align:top; width:292px">
														<p style="margin-left:7px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">Pengikut:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nama</span></span></span></p>

														<p style="margin-left:7px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">1.</span></span></span></p>

														<p style="margin-left:7px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">2.</span></span></span></p>

														<p style="margin-left:7px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">3.</span></span></span></p>
													</td>
													<td style="border-bottom:1px solid #000; border-left:none; border-right:1px solid #000; border-top:none; height:68px; vertical-align:top; width:128px">
														<p style="margin-left:1px; text-align:center"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">Umur</span></span></span></p>
													</td>
													<td style="border-bottom:1px solid #000; border-left:none; border-right:1px solid #000; border-top:none; height:68px; vertical-align:top; width:206px">
														<p style="margin-left:7px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">Keterangan</span></span></span></p>
													</td>
												</tr>
												<tr>
													<td style="border-bottom:1px solid #000; border-left:1px solid #000; border-right:1px solid #000; border-top:none; height:83px; vertical-align:top; width:28px">
														<p style="margin-left:4px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">9</span></span></span></p>
													</td>
													<td style="border-bottom:1px solid #000; border-left:none; border-right:1px solid #000; border-top:none; height:83px; vertical-align:top; width:292px">
														<p style="margin-left:7px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">Pembebanan Anggaran :</span></span></span></p>

														<ol style="list-style-type:lower-alpha">
															<li>
																<p><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">lnstansi:</span></span></span></p>
															</li>
															<li>
																<p><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">Mata anggaran</span></span></span></p>
															</li>
														</ol>
													</td>
													<td colspan="2" style="border-bottom:1px solid #000; border-left:none; border-right:1px solid #000; border-top:none; height:83px; vertical-align:top; width:334px">
														<p>&nbsp;</p>

														<p style="margin-left:27px; margin-right:150px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">a. Pemerintah Kota</span></span></span></p>

														<p style="margin-left:27px; margin-right:150px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">b.</span></span></span></p>
													</td>
												</tr>
												<tr>
													<td style="border-bottom:1px solid #000; border-left:1px solid #000; border-right:1px solid #000; border-top:none; height:32px; vertical-align:top; width:28px">
														<p style="margin-left:6px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">10</span></span></span></p>
													</td>
													<td style="border-bottom:1px solid #000; border-left:none; border-right:1px solid #000; border-top:none; height:32px; vertical-align:top; width:292px">
														<p style="margin-left:7px"><span style="font-size:14px"><span style="color:#000"><span style="font-family: sans-serif">Keterangan lain-lain</span></span></span></p>
													</td>
													<td colspan="2" style="border-bottom:1px solid #000; border-left:none; border-right:1px solid #000; border-top:none; height:32px; vertical-align:top; width:334px">
														<p>&nbsp;</p>
													</td>
												</tr>
											</tbody>
										</table>
									</center>
									
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