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
        <h1 class="m-0 text-dark"><i class="fas fa-search-location text-success"></i> Lacak surat</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Lacak surat</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <hr>
  </div><!-- /.container-fluid -->
</div>

<style type="text/css">

  .status-circle {
    width: 15px;
    height: 15px;
    border-radius: 50%;
    background-color: grey;
    border: 2px solid white;
  }
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }

  /* Hide default HTML checkbox */
  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  /* The slider */
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked + .slider {
    background-color: #2196F3;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
  .events li { 
    display     : flex; 
  }

  .events time { 
    position : relative;
    color    : #000;
    padding  : 0 1.5em;  
    width: 170px
  }

  .events time::after { 
    content: "";
    position      : absolute;
    z-index       : 2;
    right         : 0;
    top           : 0;
    transform     : translateX(50%);
    border-radius : 50%;
    background    : #ccc;
    border        : 1px #eee solid;
    width         : .8em;
    height        : .8em;
  }


  .events span {
    padding  : 0 1.5em 1.5em 1.5em;
    position : relative;
  }

  .events span::before {
    content     : "";
    position    : absolute;
    z-index     : 1;
    left        : 0;
    height      : 100%;
    border-left : 1px #888 solid;
  }

  .events strong {
    display: block;
  }
</style>

<section class="content">
  <div class="container-fluid">
    <?php 
    $no=$_GET['no_surat'];
    $cek=mysqli_query($con,"select * from user");
    while ($us=mysqli_fetch_array($cek)) {
      if ($us['username']=='kabag') {
        $kabag="<div class='widget-content-left'>
        <img width='42' class='rounded-circle' src='../assets/images/".$us['images']."'>
        </div>";
      } elseif ($us['username']=='admin') {
        $admin="<div class='widget-content-left'>
        <img width='42' class='rounded-circle' src='../assets/images/".$us['images']."'>
        </div>";
      } elseif ($us['username']=='kasubag otda') {
        $ks_otda="<div class='widget-content-left'>
        <img width='42' class='rounded-circle' src='../assets/images/".$us['images']."'>
        </div>";
      }elseif ($us['username']=='kasubag kecamatan') {
        $ks_kecamatan="<div class='widget-content-left'>
        <img width='42' class='rounded-circle' src='../assets/images/".$us['images']."'>
        </div>";
      }else{
        $ks_kerjasama="<div class='widget-content-left'>
        <img width='42' class='rounded-circle' src='../assets/images/".$us['images']."'>
        </div>";
      }
    }
    $query=mysqli_query($con,"SELECT * FROM surat_masuk LEFT JOIN disposisi ON surat_masuk.no_surat=disposisi.no_surat WHERE surat_masuk.no_surat='$no' ");
    if (mysqli_num_rows($query)==0) {
      echo '<center><b>Tidak ada data dengan nomor tersebut</b></center>';
    }else{
      while ($d=mysqli_fetch_array($query)) {
        $tgl_diterima=$d['tgl_diterima'];
        $tgl_disposisi=$d['tgl_disposisi'];
        $tgl_dibaca=$d['tgl_dibaca'];
        ?>
        <div class="col-md-12">
          <div class="card">
            <div class="card-header"><center><?php echo $d['pengirim']; ?> | <?php echo $no ?> | <?php echo $d['perihal']; ?> | <?php echo $d['kepada']; ?></center><a href="laporan/lap_data_ds.php?id=<?php echo $d['no_surat'] ?> " target='_blank' class="btn btn-default float-right">Disposisi</a></div>
            <div class="card-body">
              <ul class="events">
                <li>
                  <time><?php echo tgl_indo(date('D, d-F-Y, H:i',strtotime($tgl_diterima))) ?></time> 
                  <span><strong>Surat diterima & Diinput</strong>Admin</span><?php echo $admin; ?>
                </li>
                <?php if ($d['status_disposisi']=='0'){
                  echo "<li>
                  <time>".tgl_indo(date('D, d-F-Y, H:i'))."</time> 
                  <span style='color:red'><strong>Belum Diverifikasi</strong>Kabag</span> <div class='widget-content-left'>
                  ".$kabag."</li> ";
                }else{
                  echo  "<li>
                  <time>".tgl_indo(date('D, d-F-Y, H:i',strtotime($tgl_disposisi)))."</time> 
                  <span><strong>Diverifikasi kabag, dan diteruskan kpd : ".$d['kepada']."</strong>Kabag<br> Catatan : ".$d['catatan']."</span> <div class='widget-content-left'>".$kabag."
                  </li>
                  ";
                } ?>
                <?php if ($d['status_ds']=='0') {
                 if ($d['kepada']=='kabag') {
                  echo "<li>
                  <time>".tgl_indo(date('D, d-F-Y, H:i'))."</time> 
                  <span style='color:red'><strong>Belum Dibaca</strong>".$d['kepada']."</span> ".$kabag."
                  </li>";
                }elseif ($d['kepada']=='admin') {
                  echo "<li>
                  <time>".tgl_indo(date('D, d-F-Y, H:i'))."</time> 
                  <span style='color:red'><strong>Belum Dibaca</strong>".$d['kepada']."</span> ".$admin."
                  </li>";
                }elseif($d['kepada']=='kasubag otda'){
                  echo "<li>
                  <time>".tgl_indo(date('D, d-F-Y, H:i'))."</time>  
                  <span style='color:red'><strong>Belum Dibaca</strong>".$d['kepada']."</span> ".$ks_otda."
                  </li>";
                }elseif($d['kepada']=='kasubag kecamatan'){
                  echo "<li>
                  <time>".tgl_indo(date('D, d-F-Y, H:i'))."</time>  
                  <span style='color:red'><strong>Belum Dibaca</strong>".$d['kepada']."</span> ".$ks_kecamatan."
                  </li>";
                }else{
                  echo "<li>
                  <time>".tgl_indo(date('D, d-F-Y, H:i'))."</time> 
                  <span style='color:red'><strong>Belum Dibaca</strong>".$d['kepada']."</span> ".$ks_kerjasama."
                  </li>";
                }
              } elseif ($d['status_ds']=='1') {
                if ($d['kepada']=='kabag') {
                  echo "<li>
                  <time>".tgl_indo(date('D, d-F-Y, H:i',strtotime($tgl_dibaca)))."</time> 
                  <span><strong>Diterima & Dibaca</strong>".$d['kepada']."</span> ".$kabag."
                  </li>";
                }elseif ($d['kepada']=='admin') {
                  echo "<li>
                  <time>".tgl_indo(date('D, d-F-Y, H:i',strtotime($tgl_dibaca)))."</time> 
                  <span><strong>Diterima & Dibaca</strong>".$d['kepada']."</span> ".$admin."
                  </li>";
                }elseif($d['kepada']=='kasubag otda'){
                  echo "<li>
                  <time>".tgl_indo(date('D, d-F-Y, H:i',strtotime($tgl_dibaca)))."</time> 
                  <span><strong>Diterima & Dibaca</strong>".$d['kepada']."</span> ".$ks_otda."
                  </li>";
                }elseif ($d['kepada']=='kasubag kecamatan') {
                  echo "<li>
                  <time>".tgl_indo(date('D, d-F-Y, H:i',strtotime($tgl_dibaca)))."</time> 
                  <span><strong>Diterima & Dibaca</strong>".$d['kepada']."</span> ".$ks_kecamatan."
                  </li>";
                }else{
                  echo "<li>
                  <time>".tgl_indo(date('D, d-F-Y, H:i',strtotime($tgl_dibaca)))."</time> 
                  <span><strong>Diterima & Dibaca</strong>".$d['kepada']."</span> ".$ks_kerjasama."
                  </li>";
                }

              }
              ?>
            </ul>
          </div>
        </div>
      </div>

    <?php }} ?>
  </div>
  <!-- /.timeline -->

</section>




<?php 
include_once '../assets/footer.php';  
?>
<script>
  $('#surat_masuk').DataTable();
</script>