<?php 
session_start();
if ($_SESSION['username']=='kabag') {
  include_once '../assets/header_kabag.php';
} else {
  include_once '../assets/header.php';
}
include_once '../assets/sidebar.php';
$nomor=$_GET['id'];
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark"><i class="fas fa-scroll text-red"></i> Surat keluar Nomor <?php echo $nomor; ?> </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="surat_keluar.php">Surat keluar</a></li>
          <li class="breadcrumb-item active">Detail</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <hr>
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <div class="container-fluid">
    <?php if (isset($_SESSION['success_edit'])) {
      echo "".$_SESSION['success_edit']."";
    }
    unset($_SESSION['success_edit']);
    ?>
    <div class="row">
      <div class="col-md-3">
        <a href="surat_keluar.php" class="btn btn-primary btn-block mb-3">Tabel surat keluar</a>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <?php 
      $query = mysqli_query($con,"select * from surat_keluar inner join user on surat_keluar.pembuat=user.username where surat_keluar.no_surat='$nomor' ");
      while ($d = mysqli_fetch_array($query)) {
        $tgl_dibuat=$d['tgl_dibuat'];
        ?>
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Nomor surat : <?php echo $nomor; ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h5>Perihal : <?php echo $d['perihal']; ?></h5>
                <h6>Type Surat: <?php echo $d['type_surat']; ?>
                <span class="mailbox-read-time float-right"><?php echo  tgl_indo(date('D d-M-Y H:i', strtotime($tgl_dibuat))); ?></span></h6>
              </div>
              <!-- /.mailbox-read-info -->
              <div class="mailbox-controls with-border text-center">
                <div class="float-right">
                  <button type="button" class="btn btn-default">
                    <?php if ($d['type_surat']=="cuti"){
                      echo "<a target='_blank' href='laporan/lap_sk_cuti.php?id=".$d['no_surat']."' class='text-dark' data-toggle='tooltip' title='Surat cuti'><i class='fas fa-print'></i> Cetak</a>";
                    }elseif ($d['type_surat']=="dinas") {
                      echo "<a target='_blank' href='laporan/lap_sk_dinas.php?id=".$d['no_surat']."' class='text-dark' data-toggle='tooltip' title='Surat perjalanan dinas'><i class='fas fa-print'></i> Cetak</a>";
                    }elseif ($d['type_surat']=="kerja") {
                      echo "<a target='_blank' href='laporan/lap_sk_kerja.php?id=".$d['no_surat']."' class='text-dark' data-toggle='tooltip' title='Surat Perintah Kerja'><i class='fas fa-print'></i> Cetak</a>"; 
                    }elseif ($d['type_surat']=="undangan") {
                      echo "<a target='_blank' href='laporan/lap_sk_undangan.php?id=".$d['no_surat']."' class='text-dark' data-toggle='tooltip' title='Surat Undangan'><i class='fas fa-print'></i> Cetak</a>";
                    }elseif ($d['type_surat']=="biasa") {
                      echo "<a target='_blank' href='laporan/lap_sk_undangan.php?id=".$d['no_surat']."' class='text-dark' data-toggle='tooltip' title='Surat yang Dibuat Sendiri'><i class='fas fa-print'></i> Cetak</a>";
                    }
                    ?>
                  </button>
                </div>
                <button type="button" class="btn btn-default float-left" data-href='actions/hapus_sk.php?id=<?php echo $d['id_sk']; ?>' data-toggle='modal' data-target='#hapus_surat_sk'><i class="far fa-trash-alt"></i> Delete</button>
                <button type="button" class="btn btn-default"><a class="text-dark" href="edit_sk.php?id=<?php echo $d['no_surat'] ?>"><i class="fas fa-edit"></i>Edit</a></button>
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <p><?php echo $d['isi']; ?></p>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-footer -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
      <?php } ?>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>





  <?php 
  include_once '../assets/footer.php';  
  ?>
