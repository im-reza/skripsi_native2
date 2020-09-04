<?php include_once '../../assets/kop_surat.php'; include '../../connections/connection_db.php';?>
<?php  
$id=$_GET['id'];
$sql=mysqli_query($con,"SELECT * from surat_keluar where no_surat='$id'");
while ($data=mysqli_fetch_array($sql)) {
	$tgl_dibuat=$data['tgl_dibuat'];
	?>
	<div class="row">
		<div class="col-md-2">
			No 
			<br>
			Lampiran 
			<br>
			Perihal 
		</div>
		<div class="col-md-7">
			: <?php echo $data['no_surat']; ?> 
			<br>
			: -
			<br>
			: <u><?php echo $data['perihal']; ?></u>

		</div>
		<div class="col-md-3" style="">
			Banjarmasin , <?php echo tgl_indo(date("D d-m-Y",strtotime($tgl_dibuat))) ?>
			<br>
			<br>
			Kepada Yth,
			<br>
			<br>
			<b><?php echo $data['penerima']; ?></b>
			di- Banjarmasin
		</div>
	</div>
	<br>
	<br>
	<div class="col-md-12" style="margin-top: 35px;">
		<?php echo $data['isi']; ?>
	</div>

	<div class="row">
		<div class="col-md-6"></div>
		<div class="col-md-2"></div>
		<div class="col-md-4" style="text-align: center; font-size: 14px;font-family: sans-serif;margin-top: 3%;">
			<b>
			Banjarmasin, <?php echo tgl_indo(date("D d-m-Y",strtotime($tgl_dibuat))) ?>

<?php } ?>

			<?php 
			$query=mysqli_query($con,"select * from user where username='kabag'");
			$user=mysqli_fetch_array($query);
			$ttd=$user['nama'];
			$nip=$user['nip'];

			?>
			<p style="margin-bottom: 70px;">KABAG PEMERINTAHAN</p>
			<p><u><?php echo $ttd; ?></u><br>NIP. <?php echo $nip; ?></p>
		</b>
	</div>
</div>
</div>
<script src="../assets/jquery/dist/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>