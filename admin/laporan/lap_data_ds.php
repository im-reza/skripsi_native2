<?php include_once '../../assets/kop_surat.php';
$id = $_GET['id'];
$sql = mysqli_query($con, "select surat_masuk.no_surat,surat_masuk.tgl_surat,surat_masuk.tgl_diterima,surat_masuk.pengirim,surat_masuk.perihal,disposisi.catatan,disposisi.tgl_disposisi, GROUP_CONCAT(kepada SEPARATOR  ' & ') as kepada from disposisi inner join surat_masuk  on surat_masuk.no_surat=disposisi.no_surat where disposisi.no_surat='$id' GROUP BY disposisi.no_surat order by disposisi.tgl_disposisi;");
while ($d = mysqli_fetch_array($sql)) {
	$tgl_masuk = tgl_indo(date('D, d-m-Y', strtotime($d['tgl_diterima'])));
	$tgl_surat = tgl_indo(date('D, d-m-Y', strtotime($d['tgl_surat'])));
	$tgl_verif = tgl_indo(date('D, d-m-Y H:i', strtotime($d['tgl_disposisi'])));
	$tgl_ttd = date('d-m-Y', strtotime($d['tgl_disposisi']));
	?>
	<div class="row">
		<div class="col-md-12">
			<center>
				<u>
					<h2>LEMBAR DISPOSISI</h2>
				</u>
				<h5></h5>
			</center>
		</div>
	</div>
	<div class="row" style="margin-top: 2%">
		<div class="col-md-12">
			<div class="main-card mb-3">
				<div class="card-body border-warning">
					<table class="mt-3" border="2">
						<thead>
							<tr>
								<th width="15%" class="text-left"> No Surat : <?php echo $d['no_surat'] ?></th>
							</tr>						
						</thead>
					</table>

					<table class="mt-3" border="2">
						<thead>
							<tr>
								<th width="15%">Pengirim</th>
								<td width="2%">:</td>
								<td><?php echo $d['pengirim']; ?></td>
								<th width="15%">Diterima Tanggal</th>
								<td width="2%">:</td>
								<td><?php echo $tgl_masuk; ?></td>
							</tr>
							<tr>
								<th width="15%">Tanggal Surat</th>
								<td width="2%">:</td>
								<td><?php echo $tgl_surat ?></td>
								<th width="15%">Tanggal Diverifikasi</th>
								<td width="2%">:</td>
								<td><?php echo $tgl_verif ?></td>
							</tr>
						</thead>
					</table>

					<table class="mt-3" border="2">
						<thead>
							<tr>
								<th width="15%" class="text-left"> Perihal Surat : <?php echo $d['perihal'] ?></th>
							</tr>
							<tr>
								<th width="15%" class="text-left"> Kepada Sodara : <?php echo $d['kepada'] ?></th>
							</tr>
							<tr>
								<th width="15%" class="text-left"> Catatan : <?php echo $d['catatan'] ?></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php } ?>


<div class="row">
	<div class="col-md-6"></div>
	<div class="col-md-2"></div>
	<div class="col-md-4" style="text-align: center; font-size: 14px;font-family: sans-serif;margin-top: 1%;">
		<b>
			<?php 
			$query = mysqli_query($con, "select * from user where username='kabag'");
			$user = mysqli_fetch_array($query);
			$ttd = $user['nama'];
			$nip = $user['nip'];

			?>
			<p>Banjarmasin, <?php echo tgl_indo(date('D d-m-Y',strtotime($tgl_ttd))) ?> </p>
			<p style="margin-bottom: 70px;">KABAG PEMERINTAHAN</p>
			<p><u><?php echo $ttd; ?></u><br>NIP. <?php echo $nip; ?></p>
		</b>
	</div>
</div>
</div>
<script src="../../assets/jquery/dist/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>

</html>