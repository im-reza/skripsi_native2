<?php include_once '../../assets/kop_surat.php'; include '../../connections/connection_db.php';?>
<?php  
$id=$_GET['id'];
$sql=mysqli_query($con,"SELECT * from surat_keluar where no_surat='$id'");
while ($data=mysqli_fetch_array($sql)) {
	$tgl_dibuat_dibuat=$data['tgl_dibuat'];
	?>
	<div class="row">
		<div class="col-md-2">
		</div>
		<div class="col-md-7">
		</div>
		<div class="col-md-3" style="">
			Banjarmasin , <?php echo tgl_indo(date("D d-M-Y",strtotime($tgl_dibuat_dibuat))) ?>
			<br>
			<br>
			Kepada Yth,
			<br>
			<br>
			<b><?php echo $data['penerima']; ?></b>
			di- <b>Banjarmasin</b>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12">
			<center>
				<u><h2>SURAT PERMOHONAN CUTI TAHUNAN</h2></u>
				Nomor : <?php echo $data['no_surat']; ?>
			</center>
		</div>
	</div>
	<br>
	<br>
	<div class="col-md-12" style="margin-top: 5px;">
		<?php echo $data['isi']; ?>
	</div>
	<?php } ?>
<center>
	<table cellspacing="0" class="MsoTableGrid" style="border-collapse:collapse; border:none; margin-left:17px; width:15.0cm">
		<tbody>
			<tr>
				<td rowspan="2" style="border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:1px solid black; height:111px; vertical-align:top; width:269px">
					<p><span style="font-size:14pt"><span style="font-family: sans-serif;font-size: 14px"><span style="font-size:9.0pt"><span style="font-family: sans-serif;font-size: 14px"><span style="color:black">CATATAN PEJABAT KEPEGAWAIAN</span></span></span></span></span></p>

				</td>
				<td class="text-left" style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:1px solid black; height:105px; vertical-align:top; width:298px">
					<p><span style="font-size:14pt"><span style="font-size:9.0pt"><span style="font-family: sans-serif;font-size: 14px"><span style="color:black">CATATAN/PERTIMBANGAN&nbsp;ATASAN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LANGSUNG</span></span></span></span></p>

					<p>&nbsp;</p>

					<p style="text-align:center"><u><span style="font-family: sans-serif;font-size: 14px"><span style="color:black">Drs. Dolly Syahbana, MM</span></span></u></p>

					<p style="text-align:center;"><span style="font-family: sans-serif;font-size: 14px"><span style="font-family: sans-serif;font-size: 14px"><span style="color:black">NIP. 19660601 19860 21 009</span></span></span></p>

					<p style="text-align:center"></p>
				</td>
			</tr>
			<tr>
				<td class="text-left"  style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; height:105px; vertical-align:top; width:298px">
					<p><span style="font-size:14pt"><span style="font-family: sans-serif;font-size: 14px"><span style="font-size:9.0pt"><span style="font-family: sans-serif;font-size: 14px"><span style="color:black">KEPUTUSAN PEJABAT YANG BERWENANG MEMBERIKAN CUTI</span></span></span></span></span></p>

					<p>&nbsp; &nbsp;</p>

					<p style="text-align:center"><span style="font-size:14pt"><span style="font-family: sans-serif;font-size: 14px"><u><span style="font-size:9.0pt"><span style="font-family: sans-serif;font-size: 14px"><span style="color:black">Drs. Faisal Anshory</span></span></span></u></span></span></p>

					<p style="text-align:center"><span style="font-size:14pt"><span style="font-family: sans-serif;font-size: 14px"><span style="font-size:9.0pt"><span style="font-family: sans-serif;font-size: 14px"><span style="color:black">NIP. 19660601 19860 21 009</span></span></span></span></span></p>
				</td>
			</tr>
		</tbody>
	</table>
</center>

<div class="row mt-2">
	<div class="col-md-6"></div>
	<div class="col-md-2"></div>
	<div class="col-md-4" style="text-align: center; font-size: 14px;font-family: sans-serif;margin-top: 1%;">
		<b>
			<?php
			$query = mysqli_query($con, "select * from surat_keluar inner join user on surat_keluar.pembuat=user.username where surat_keluar.no_surat='$id'");
			$user = mysqli_fetch_array($query);
			$ttd = $user['nama'];
			$nip = $user['nip'];
			$tgl_dibuat = $user['tgl_dibuat']


			?>
			<p>Banjarmasin, <?php echo tgl_indo(date('D d-M-Y',strtotime($tgl_dibuat))) ?> </p>
			<p style="margin-bottom: 70px;">Hormat Saya</p>
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