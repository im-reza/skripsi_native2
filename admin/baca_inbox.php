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
        <h1 class="m-0 text-dark"><i class="fas fa-scroll text-red"></i> Inbox Nomor <?php echo $nomor; ?> </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="surat_masuk.php">Surat masuk</a></li>
          <li class="breadcrumb-item"><a href="inbox.php">Inbox</a></li>
          <li class="breadcrumb-item active">Baca</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <hr>
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <a href="inbox.php" class="btn btn-primary btn-block mb-3">Kembali ke Inbox</a>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <?php 
      $query = mysqli_query($con,"select * from surat_masuk inner join disposisi on surat_masuk.no_surat=disposisi.no_surat where disposisi.no_surat='$nomor' and disposisi.kepada='".$_SESSION['username']."' ");
      while ($d = mysqli_fetch_array($query)) {
        $tgl_disposisi=$d['tgl_disposisi'];
        ?>
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Nomor surat : <?php echo $nomor; ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h5>Catatan : <?php echo $d['catatan']; ?>
                <span class="mailbox-read-time float-right">
                  <a target='_blank' href='laporan/lap_data_ds.php?id=<?php echo $d['no_surat'] ?>' class='btn btn-default text-dark' data-toggle='tooltip' title='Surat cuti'>
                    <i class='fas fa-print'></i> Cetak disposisi
                  </a>
                </span></h5>
                <h5>Perihal : <?php echo $d['perihal']; ?></h5>
                <h6>Surat dari : <?php echo $d['pengirim']; ?></h6>
                <h6>Disposisi dari: Kabag Pemerintahan Kota Banjarmasin
                  <span class="mailbox-read-time float-right"><?php echo  tgl_indo(date('D d-M-Y H:i', strtotime($tgl_disposisi))); ?></span></h6>
                  <h6>Kepada sdr : <?php echo $d['kepada']; ?> </h6>
                </div>
                <!-- /.mailbox-read-info -->
                <div class="mailbox-controls with-border text-center">
                </div>
                <!-- /.mailbox-controls -->
                <div class="mailbox-read-message">
                  <embed width="100%" height="600px" src="../file/<?php echo $d['file'] ?>"></embed>
                </div>
                <!-- /.mailbox-read-message -->
              </div>
              <!-- /.card-footer -->
              <div class="card-footer">
                <div class="text-center">
                </div>
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
