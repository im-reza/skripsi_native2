<?php include_once '../../assets/kop_surat.php';
$no=1;
?>
<u><h2 align="center">LAPORAN SURAT MASUK</h2></u><br>
<table border="2">
	<thead>
		<tr style="text-align: center;">
			<th scope="row" width="5%">No</th>
			<th>Nomor Surat</th>
			<th>Tanggal Surat</th>
			<th>Pengirim</th>
			<th>Perihal</th>
			<th>Tanggal Diterima</th>
			<th>Status Disposisi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if ($tgl_sm_f=$_GET['tgl_sm_awal']=='1') {
			$query=mysqli_query($con,"SELECT * FROM surat_masuk order by tgl_diterima");
		} else {
			$tgl_sm_f=$_GET['tgl_sm_awal'];
			$tgl_sm_2=$_GET['tgl_sm_akhir'];
			$query=mysqli_query($con,"SELECT * FROM surat_masuk where tgl_diterima between '$tgl_sm_f 23:59:59' and '$tgl_sm_2 23:59:59' order by tgl_diterima");
		}
		while ($d=mysqli_fetch_array($query)) {
			$tgl_surat=$d['tgl_surat'];
			$tgl_diterima=$d['tgl_diterima'];
			?>
			<tr>
				<td><?php echo $no; ?></td>
				<td><?php echo $d['no_surat']; ?></td>
				<td><?php echo tgl_indo(date('d-m-Y',strtotime($tgl_surat))) ?></td>
				<td><?php echo $d['pengirim']; ?></td>
				<td><?php echo $d['perihal']; ?></td>
				<td><?php echo tgl_indo(date('D, d-m-Y',strtotime($tgl_diterima))) ?></td>
				<?php if ($d['status_disposisi']=='0') {
					echo "<td class='text-center text-danger'>Belum didisposisi</td>";
				} else {
					echo "<td class='text-center'>Sudah didisposisi</td>";
				}
				 ?>
			</tr>
		</tbody>
		<?php $no++; }?>
	</table>



	<?php include_once '../../assets/tutup_surat.php'; ?>
	
	
