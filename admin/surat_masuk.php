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
        <h1 class="m-0 text-dark"><i class="fas ffas fa-dice-d6 text-secondary"></i> Data Surat Masuk</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Surat masuk</li>
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
    }elseif (isset($_SESSION['success_edit'])) {
      echo "".$_SESSION['success_edit']."";
    }elseif (isset($_SESSION['success_delete'])) {
      echo "".$_SESSION['success_delete']."";
    }elseif (isset($_SESSION['error_delete'])) {
      echo "".$_SESSION['error_delete']."";
    }
    unset($_SESSION['success']);
    unset($_SESSION['success_edit']);
    unset($_SESSION['success_delete']);
    unset($_SESSION['error_delete']);
    ?>
    <div class="card">
      <div class="card-header border-0 bg-gradient-secondary">
        <h3 class="card-title">
          <i class="fas fa-th mr-1"></i>
          Tabel surat masuk
        </h3>
        <div class="card-tools">
          <?php 
          if ($_SESSION['username']=='admin') {
            ?>
            Tambah Data :
            <a href="tambahsm_pemberitahuan.php" class="ml-3 btn bg-primary btn-sm">
              <i class="fas fa-volume-up"></i>
            </a>
            <a href="tambahsm_undangan.php" class="mr-3 btn bg-primary btn-sm">
              <i class="fas fa-calendar"></i>
            </a>
            <?php
          } else {
              # code...
          }
          ?>
          Laporan :
          <a href="laporan/lap_sm.php?tgl_sm_awal=1" target="_blank" class="ml-3 btn bg-warning btn-sm">
            <i class="fas fa-print"></i>
          </a>
          <button type="button" class="btn bg-warning btn-sm" data-toggle="modal" data-target="#lap_sm">
            <i class="fas fa-calendar"></i>
          </button>
          <button type="button" class="btn bg-light btn-sm" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
       <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover table-sm" id="surat_masuk" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th width="20%">Surat</th>
              <th width="30%">Pengirim</th>
              <th>Diterima</th>
              <th>Disposisi</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no=1;
            $query = mysqli_query($con,"SELECT * FROM surat_masuk ORDER BY id_sm desc");
            while ($d = mysqli_fetch_array($query)) {  
              $tgl_surat=$d['tgl_surat'];
              $tgl_diterima=$d['tgl_diterima'];
              ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $d['no_surat']  . '<br>' . strtolower($d['perihal']) ?></td>
                <td><?php echo $d['pengirim']; ?></td>
                <td><?php echo tgl_indo(date('d-m-Y',strtotime($tgl_diterima))) ?></td>
                <td class="ml-auto">
                  <?php if ($d['status_disposisi']=="0"){
                    echo "<div class='text-danger'>Belum didisposisi</div>";
                  }else{
                   echo "<center>
                   <a target='_blank' href='laporan/lap_data_ds.php?id=".$d['no_surat']."' class='btn btn-raised btn-primary img-circle btn-sm text btn_show' data-toggle='tooltip' title='Sudah diverifikasi' ><i class='fas fa-print'></i></a>";
                 }
                 ?>
               </center>
             </td>
             <td class="text-center">
              <?php echo "<a href='../file/".$d['file']."' class='btn btn-raised btn-secondary img-circle btn-sm' target='_blank' data-toggle='tooltip' title='".$d['file']."'><span class='fas fa-file-pdf'></span></a>"; ?>
              <?php if ($d['type_surat']=='pemberitahuan'){
                if ($_SESSION['username']=='admin') {
                  echo "<a href='editsm_pemberitahuan.php?id=".$d['id_sm']." ' class='btn btn-raised btn-success img-circle btn-sm' data-toggle='tooltip' title='Surat pemberitahuan'><span class='far fa-edit'></a>";
                }else{
                 echo "<button disabled='' class='btn btn-raised btn-success img-circle btn-sm btn_edit' id=".$d['id_sm']."><span class='far fa-edit' data-toggle='tooltip' title='Hanya admin'></button>";
               }
             }elseif ($d['type_surat']=='undangan') {
              if ($_SESSION['username']=='admin') {
                echo "<a href='editsm_undangan.php?id=".$d['id_sm']." ' class='btn btn-raised btn-success img-circle btn-sm' data-toggle='tooltip' title='Surat undangan'><span class='far fa-edit'></a>";
              } else {
               echo "<button disabled='' class='btn btn-raised btn-success img-circle btn-sm btn_edit_u'><span class='far fa-edit' data-toggle='tooltip' title='Hanya admin'></button>";
             }  
           } ?> 
           <?php if ($_SESSION['username']=='admin'){
            echo "<button class='btn btn-raised btn-danger img-circle btn-sm' data-href='actions/hapus_sm.php?id=".$d['id_sm']." ' data-toggle='modal' data-target='#hapus_surat'><span class='fas fa-trash-alt'></span></button>";
          }else{
            echo "<button disabled='' class='btn btn-raised btn-danger img-circle btn-sm'><span class='fas fa-trash-alt' data-toggle='tooltip' title='Hanya admin'></span></button>";
          } 
          $no++;
        }?>
      </td>
    </tr>
  </tbody>
</table>
</div>
</div>
<!-- /.card-body -->

<!-- /.card-footer -->
</div>

<!-- /.info-box -->
</div>
</div><!--/. container-fluid -->
</section>





<?php 
include_once '../assets/footer.php';  
?>


<!-- Modal hapus data surat masuk -->
<div class="modal fade" id="hapus_surat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus surat masuk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda benar ingin menghapus Data surat Masuk ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button class="btn btn-danger "><a class="btn-hapus text-white">Ya, Hapus !</a></button>
      </div>
    </div>
  </div>
</div>
<!-- ================================= -->

<script>
  $('#surat_masuk').DataTable();
</script>

<script>
  $('#hapus_surat').on('show.bs.modal',function(e){
    $(this).find('.btn-hapus').attr('href',$(e.relatedTarget).data('href'));;
  });
</script>

