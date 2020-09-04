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
        <h1 class="m-0 text-dark"><i class="fas fa-envelope text-dark"></i> Kotak pesan saya</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="surat_masuk.php">Surat masuk</a></li>
          <li class="breadcrumb-item"><a href="disposisi.php">Disposisi</a></li>
          <li class="breadcrumb-item active">Inbox</li>
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
      <!-- /.col -->
      <div class="col-md-12">
        <div class="card card-warning card-outline">
          <div class="card-header">
            <h3 class="card-title">Inbox dari Kabag</h3>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive mailbox-messages">
              <table class="table table-hover table-striped" id="surat_masuk">
                <thead hidden="">
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  date_default_timezone_set('Asia/Jakarta');
                  $no=1;
                  $user=$_SESSION['username'];
                  $query_kabag=mysqli_query($con,"SELECT * FROM user WHERE username='kabag'");
                  $us=mysqli_fetch_array($query_kabag);
                  $kabag=$us['images'];

                  $query = mysqli_query($con,"SELECT * FROM surat_masuk INNER JOIN disposisi on surat_masuk.no_surat=disposisi.no_surat where disposisi.kepada='$user' ORDER BY disposisi.tgl_disposisi desc");
                  while ($d = mysqli_fetch_array($query)) {
                    $tgl_disposisi=$d['tgl_disposisi'];

                    $waktu1=strtotime($tgl_disposisi);
                    $waktu2=strtotime("now");

                    $diff=$waktu2 - $waktu1;
                    $jam=floor($diff/(60*60));
                    $menit=$diff - $jam * (60*60);
                    $sisa = $menit % 60;
                    $jumlah_detik = floor($sisa/1);
                    $menit_fix=floor($menit/60);
                    $hari = floor($diff/86400);
                    ?>
                    <?php 
                    if ($d['status_ds']=='0') {
                      ?>
                      <tr class="click_row bg-warning" id="<?php echo $d['no_surat']; ?>" data-href="baca_inbox.php?id=<?php echo $d['no_surat']; ?>">
                        <?php 
                      } else {
                        ?>
                        <tr class="click_row" id="<?php echo $d['no_surat']; ?>" data-href="baca_inbox.php?id=<?php echo $d['no_surat']; ?>">
                        <?php
                      }
                      
                      ?>
                      <td><?php echo $no; ?></td>
                      <td class="mailbox-name text-center"> 
                        <ul class="list-inline">
                          <li class="list-inline-item">
                            <img alt="Avatar" class="table-avatar img-size-50 img-circle" src="../assets/images/<?php echo $kabag?>"> <br>Kabag
                          </li>
                        </ul>
                      </td>
                      <td><b><?php echo $d['pengirim']; ?></b></td>
                      <td class="mailbox-subject"><b><?php echo $d['perihal']; ?></b><br> <?php echo $d['catatan']; ?>
                    </td>
                    <td class="mailbox-attachment"><a href="#" target="_blank" class='btn btn-raised btn-primary img-circle btn-sm text btn_show' data-toggle='tooltip' title='Cetak disposisi'><i class='fas fa-print'></i></a></td>
                    <td class="mailbox-date"><i class="far fa-clock mr-1"></i> <?php if ($menit_fix=='0') {       
                      echo " ".$jumlah_detik." detik yang lalu ";
                    } elseif ($jam=='0') {
                      echo " ".$menit_fix." menit yang lalu ";
                    }elseif($hari=='0') {
                      echo " ".$jam." jam ".$menit_fix." menit yang lalu ";
                    }else{
                      echo " ".$hari." hari yang lalu ";
                    } ?></td>
                    <td>
                      <?php if ($d['status_ds']=='0') {
                        echo "<a id='".$d['no_surat']."' class='btn_baca' href='baca_inbox.php?id=".$d['no_surat']."'><span class='badge badge-danger'>New</span></a>";
                      } else {
                        echo "<a id='".$d['no_surat']."' class='text-dark btn_baca' href='baca_inbox.php?id=".$d['no_surat']."'><i class='fas fa-paperclip'></i></a>";
                      }
                      ?>
                    </td>
                  </tr>
                  <?php $no++; } ?>
                </tbody>
              </table>
              <!-- /.table -->
            </div>
            <!-- /.mail-box-messages -->
          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>

  </div><!--/. container-fluid -->
</section>





<?php 
include_once '../assets/footer.php';  
?>

<script>
  $('#surat_masuk').DataTable();
</script>



<script>
  $(document).on('click','.btn_edit',function(){
    var no=$(this).attr("id");
    $.ajax({
      url:"table/show_ds_sm.php",
      method:"POST",
      data:{
        no:no
      },
      dataType:"json",
      success:function(data){
        $('#no_surat').val(data.no_surat);
        $('#pengirim').val(data.pengirim);
        $('#tgl_surat').val(data.tgl_surat);
        $('#tgl_masuk').val(data.tgl_masuk);
        $('#perihal').val(data.perihal);
        $('#catatan').val(data.catatan);
        $('#edit_ds').modal('show');
      }
    });
  });
</script>

<!-- script cari data -->
<script>
  $(document).ready(function(){
    $('.click_row').click(function(){
      window.location=$(this).data("href");
      var nomor=$(this).attr("id");
      $.ajax({
        url:"json/baca_inbox.php",
        method:"POST",
        data:{
          nomor:nomor
        },
        success:function(data){
          console.log(data);
        }
      });
    });
  });
</script>
  <!-- tutup cari data -->