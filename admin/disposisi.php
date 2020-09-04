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
        <h1 class="m-0 text-dark"><i class="fas fa-scroll text-red"></i> Data Disposisi</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="surat_masuk.php">Surat masuk</a></li>
          <li class="breadcrumb-item active">Disposisi</li>
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
    <div class="card">
      <div class="card-header border-0 bg-gradient-danger">
        <h3 class="card-title">
          <i class="fas fa-th mr-1"></i>
          Tabel
        </h3>
        <div class="card-tools">
          Laporan :
          <a href="laporan/lap_ds.php?tgl_ds_awal=1" target="_blank" class="ml-3 btn bg-warning btn-sm">
            <i class="fas fa-print"></i>
          </a>
          <button type="button" class="btn bg-warning btn-sm" data-toggle="modal" data-target="#lap_ds">
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
              <th>Tanggal disiposisi</th>
              <th>Kepada</th>
              <th>Catatan</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no=1;
            $query = mysqli_query($con,"select surat_masuk.id_sm,surat_masuk.no_surat,surat_masuk.pengirim,surat_masuk.perihal,surat_masuk.tgl_surat,surat_masuk.tgl_diterima,surat_masuk.file,surat_masuk.status_disposisi,disposisi.catatan,disposisi.tgl_disposisi, GROUP_CONCAT(kepada SEPARATOR  ' & ') as kepada from disposisi inner join surat_masuk on surat_masuk.no_surat=disposisi.no_surat GROUP BY disposisi.no_surat order by disposisi.tgl_disposisi DESC");
            while ($d = mysqli_fetch_array($query)) {  
              $tgl_surat=$d['tgl_surat'];
              $tgl_diterima=$d['tgl_diterima'];
              $tgl_disposisi=$d['tgl_disposisi'];
              ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $d['no_surat']  . '<br>' . strtolower($d['perihal']) ?></td>
                <td><?php echo $d['pengirim']; ?></td>
                <td><?php echo tgl_indo(date('d-m-Y',strtotime($tgl_disposisi))) ?></td>
                <td><?php echo $d['kepada']; ?></td>
                <td><?php echo $d['catatan']; ?></td>
                <td class="text-center">
                  <?php echo "<a href='../file/".$d['file']."' class='btn btn-raised btn-secondary img-circle btn-sm' target='_blank' data-toggle='tooltip' title='".$d['file']."'><span class='fas fa-file-pdf'></span></a>"; ?>
                  <?php if ($_SESSION['username']=='kabag') {
                    echo "<button id=".$d['no_surat']." class='btn btn-raised btn-success img-circle btn-sm edit_ds'><span class='far fa-edit'></button>";
                  }else{
                    echo "<button disabled='' class='btn btn-raised btn-success img-circle btn-sm btn_edit' id=".$d['id_sm']."><span class='far fa-edit' data-toggle='tooltip' title='Hanya kabag'></button>";
                  } $no++; } ?>
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

<!-- modal ubah disposisi kabag -->
<div class="modal fade" id="edit_ds" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header border-0 bg-gradient-info">
        <h5 class="modal-title" id="exampleModalLabel">Edit Disposisi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="actions/edit_ds.php" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label><strong>Nomor Surat :</strong></label>
              <input type="text" class="form-control" name="no_surat" id="no_surat_ds" readonly="">
            </div>
            <div class="form-group col-md-4">
              <label><strong>Tanggal di surat :</strong></label>
              <input type="text" class="date form-control" id="tgl_surat_ds" readonly="">
            </div>
            <div class="form-group col-md-4">
              <label><strong>Tanggal diterima :</strong></label>
              <input type="text" class="date form-control" id="tgl_diterima_ds" readonly="">
            </div>
            <div class="form-group col-md-4">
              <label><strong>Pengirim :</strong></label>
              <input type="text"class="form-control" id="pengirim_ds" readonly="">
            </div>
            <div class="form-group col-md-4">
              <label><strong>Perihal surat :</strong></label>
              <input type="text"class="form-control" name="perihal" id="perihal_ds" readonly="">
            </div>
            <div class="form-group col-md-4">
              <label><strong>Tgl Didisposisi :</strong></label>
              <input type="text"class="form-control" id="didisposisi_ds" readonly="">
            </div>
            <div class="form-group col-md-12">
              <div class="well">
                <a class="btn btn-warning btn-sm btn-block" id="file_ds"><i class="fas fa-file-pdf mr-2"></i>Buka File</a>
              </div>
            </div>
          </div>
          <label><strong>Ubah Diteruskan kpd :</strong></label>
          <select style="width: 100%" class="custom-select" id="kepada-edit" name="kepada[]" multiple="multiple" required="">
            <?php 
            $queryuser=mysqli_query($con,"select * from user"); 
            while ($d=mysqli_fetch_array($queryuser)) {
              ?>
              <option value="<?php echo $d['username']; ?>"><?php echo $d['username']; ?></option>
            <?php } ?>
          </select>
          <div class="form-group mt-2">
           <label><strong>Catatan :</strong></label>
           <textarea class="form-control" name="catatan" rows="3" id="catatan_ds" required="" placeholder="Harap diisi..."></textarea>
         </div>
       </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" name="submit" class="btn btn-primary">Ubah</button>
      </form>
    </div>
  </div>
</div>
</div>
<!-- ================================== -->


<script>
  $('#surat_masuk').DataTable();
</script>

<script>
  $(document).ready(function() {
    $('#kepada-edit').select2();
  });
</script>

<script>
  $(document).on('click','.edit_ds',function(){
    var no=$(this).attr("id");
    $.ajax({
      url:"json/show_data_ds.php",
      method:"POST",
      data:{
        no:no
      },
      dataType:"json",
      success:function(data){
        $('#no_surat_ds').val(data.no_surat);
        $('#tgl_surat_ds').val(data.tgl_surat);
        $('#tgl_diterima_ds').val(data.tgl_diterima);
        $('#pengirim_ds').val(data.pengirim);
        $('#perihal_ds').val(data.perihal);
        $('#didisposisi_ds').val(data.tgl_disposisi);
        $('#catatan_ds').val(data.catatan);
        $('#file_ds').click(function(){
          window.open("../file/"+data.file);
        });
        $('#edit_ds').modal('show');
        console.log(data);
      }
    });
  });
</script>
