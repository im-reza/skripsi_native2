<?php include_once '../../assets/kop_surat.php';
$no=1;
?>
<u><h2 align="center">LAPORAN DISPOSISI</h2></u><br>
<table border="2">
	<thead>
		<tr>
			<th scope="row" width="5%">No</th>
			<th>No Surat</th>
			<th>Pengirim</th>
			<th>Perihal</th>
			<th>Tanggal Didisposisi</th>
			<th>Kepada</th>
			<th>Catatan Kabag</th>
			<th>Status Dibaca</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		if ($tgl_disposisi_f=$_GET['tgl_ds_awal']=='1') {
			$query=mysqli_query($con,"select * from surat_masuk inner join disposisi on surat_masuk.no_surat=disposisi.no_surat order by surat_masuk.tgl_diterima");
		} else {
			$tgl_disposisi_f=$_GET['tgl_ds_awal'];
			$tgl_disposisi_2=$_GET['tgl_ds_akhir'];
			$query=mysqli_query($con,"select * from surat_masuk inner join disposisi on surat_masuk.no_surat=disposisi.no_surat where disposisi.tgl_disposisi between '$tgl_disposisi_f 23:59:59' and '$tgl_disposisi_2 23:59:59' order by surat_masuk.tgl_diterima");
		}
		while ($d=mysqli_fetch_array($query)) {
			$tgl_disposisi=$d['tgl_disposisi'];
			?>
			<tr>
				<td class="text-center"><?php echo $no; ?></td>
				<td><?php echo $d['no_surat']; ?></td>
				<td><?php echo $d['pengirim']; ?></td>
				<td><?php echo $d['perihal']; ?></td>
				<td class="text-left"><?php echo tgl_indo(date('D, d-m-Y',strtotime($tgl_disposisi))) ?></td>
				<td class="text-center"><?php echo $d['kepada']; ?></td>
				<td class="text-left"><?php echo $d['catatan']; ?></td>
				<?php 
					if ($d['status_ds']=='0') {
						echo "<td class='text-center text-danger'>Belum dibaca</td>";
					} else {
						echo "<td class='text-center'>Sudah dibaca</td>";
					}
					
				 ?>
			</tr>
		</tbody>

		<?php $no++; }?>
	</table>



	<?php include_once '../../assets/tutup_surat.php'; ?>
	
