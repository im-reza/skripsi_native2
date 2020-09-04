<?php include_once '../../assets/kop_surat.php';
$no=1;
?>
<u><h2 align="center">LAPORAN SURAT KELUAR</h2></u><br>
<table border="2">
	<thead>
		<tr style="text-align: center;">
			<th scope="row" width="5%">No</th>
			<th>Pembuat</th>
			<th>Nomor Surat</th>
			<th>Tanggal Dibuat</th>
			<th>Perihal</th>
			<th>Kepada</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if ($tgl_sk_f=$_GET['tgl_sk_awal']=='1') {
			$query=mysqli_query($con,"SELECT * FROM surat_keluar INNER JOIN user on surat_keluar.pembuat=user.username order by surat_keluar.tgl_dibuat");
		} else {
			$tgl_sk_f=$_GET['tgl_sk_awal'];
			$tgl_sk_2=$_GET['tgl_sk_akhir'];
			$query=mysqli_query($con,"SELECT * FROM surat_keluar INNER JOIN user on surat_keluar.pembuat=user.username where surat_keluar.tgl_dibuat between '$tgl_sk_f 23:59:59' and '$tgl_sk_2 23:59:59'");
		}
		while ($d=mysqli_fetch_array($query)) {
			$tgl_dibuat=$d['tgl_dibuat'];
			?>
			<tr>
				<td class="text-center"><?php echo $no; ?></td>
				<td class="text-center"><?php echo $d['pembuat']; ?></td>
				<td class="text-center"><?php echo $d['no_surat']; ?></td>
				<td align="center"><?php echo tgl_indo(date('D, d-m-Y', strtotime($tgl_dibuat))) ?></td>
				<td align="center"><?php echo $d['perihal']; ?></td>
				<td class="text-left"><?php echo $d['penerima']; ?></td>
			</tr>
		</tbody>

		<?php $no++; }?>
	</table>



	<?php include_once '../../assets/tutup_surat.php'; ?>
	