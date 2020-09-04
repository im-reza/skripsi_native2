<?php 
session_start();
include_once'../connections/auth_kabag.php';
if ($_SESSION['username']=='kabag') {
  include_once '../assets/header_kabag.php';
} else {
  include_once '../assets/header.php';
}
include_once '../assets/sidebar.php';

$foto=mysqli_query($con,"SELECT * FROM user WHERE username='admin'");
$foto_u=mysqli_fetch_array($foto);
$admin=$foto_u['images'];
$foto_kb=mysqli_query($con,"SELECT * FROM user WHERE username='kabag'");
$foto_k=mysqli_fetch_array($foto_kb);
$kabag=$foto_k['images'];
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark"><i class="fas fa-scroll text-red"></i> Data Disposisi yang belum diverifikasi</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="surat_masuk.php">Surat masuk</a></li>
          <li class="breadcrumb-item"><a href="disposisi.php">Disposisi</a></li>
          <li class="breadcrumb-item active">Verifikasi</li>
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
    }elseif (isset($_SESSION['failed'])) {
      echo "".$_SESSION['failed']."";
    }
    unset($_SESSION['success']);
    unset($_SESSION['failed']);
    ?>
    <div class="row">
      <?php 
      $query = mysqli_query($con,"SELECT * FROM surat_masuk WHERE status_disposisi='0'");
      if (mysqli_num_rows($query)==0) {
        ?>
        <h5>Data masih kosong..</h5>
      <?php } else {
        while ($d = mysqli_fetch_array($query)) {  
          $tgl_surat=$d['tgl_surat'];
          $tgl_diterima=$d['tgl_diterima'];
          ?> 
          <div class="col-md-4">
            <!-- DIRECT CHAT PRIMARY -->
            <div class="card card-primary cardutline direct-chat direct-chat-primary">
              <div class="card-header">
                <h3 class="card-title">Nomor <?php echo $d['no_surat']; ?></h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                  <!-- Message. Default to the left -->
                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">Admin Bagpem</span>
                      <span class="direct-chat-timestamp float-right"><?php echo tgl_indo(date('D, d-m-Y H:i', strtotime($tgl_diterima))); ?></span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="../assets/images/<?php echo $admin ?>" alt="Message User Image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">Perihal : <div class="text-red"><?php echo $d['perihal']; ?></div>
                    Pengirim : <div class="text-red"><?php echo $d['pengirim']; ?></div>
                    File: <a href="../file/<?php echo $d['file']; ?>" target="_blank" class="text-primary"><?php echo $d['file']; ?></a>
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->

                <!-- Message to the right -->
                <div class="direct-chat-msg right">
                  <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-right">Kabag</span>
                    <span class="direct-chat-timestamp float-left"><?php echo tgl_indo(date('D, d-m-Y H:i')); ?></span>
                  </div>
                  <!-- /.direct-chat-infos -->
                  <img class="direct-chat-img" src="../assets/images/<?php echo $kabag ?>" alt="Message User Image">
                  <!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
                    Ok tunggu !
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
              </div>
              <!-- /.direct-chat-pane -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <a href="#" data-toggle="modal" data-target="#verifikasi_ds">
                <button class="btn btn-primary float-right btn_ds" id="<?php echo $d['id_sm'];?>">Verifikasi</button>
              </a>
            </div>
            <!-- /.card-footer-->
          </div>
          <!--/.direct-chat -->
        </div>
      <?php  }} ?>
      <!-- /.col -->
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

