<?php include_once'../connections/auth.php';  include '../connections/connection_db.php'; include '../connections/tgl_indo.php'; 
date_default_timezone_set('Asia/Jakarta');
$user=$_SESSION['username'];
$ds=mysqli_query($con,"SELECT count(*) AS jumlah_ds FROM surat_masuk where status_disposisi='0'");
$sk=mysqli_query($con,"SELECT count(*) AS jumlah_sk FROM surat_keluar where status_surat='0' ");
$box_masuk=mysqli_query($con,"SELECT count(*) AS t_masuk FROM disposisi where kepada='$user'");
$inbox=mysqli_query($con,"SELECT count(*) as t_inbox from disposisi where kepada='$user' and status_ds='0' ");

$foto=mysqli_query($con,"SELECT * FROM user WHERE username='admin'");
$foto_u=mysqli_fetch_array($foto);
$admin=$foto_u['images'];

$foto_kb=mysqli_query($con,"SELECT * FROM user WHERE username='kabag'");
$foto_k=mysqli_fetch_array($foto_kb);
$kabag=$foto_k['images'];

$t_disposisi=mysqli_fetch_array($ds);
$t_sk=mysqli_fetch_array($sk);
$t_masuk=mysqli_fetch_array($box_masuk);
$t_inbox=mysqli_fetch_array($inbox);
$angka_ds=$t_disposisi['jumlah_ds'];
$angka_inbox=$t_inbox['t_inbox'];
$jumlah_kabag=$angka_ds+$angka_inbox;


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Bagpem</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
  <meta name="description" content="This is an example dashboard created using build-in elements and components.">
  <meta name="msapplication-tap-highlight" content="no">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
  <!-- overlayScrollbars -->
  <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.0/animate.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

  <link href='../assets/fullcalendar/packages/core/main.css' rel='stylesheet' />
  <link href='../assets/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
  <link href='../assets/fullcalendar/packages/timegrid/main.css' rel='stylesheet' />
  <link href='../assets/dropzone/dist/min/dropzone.min.css' rel='stylesheet' />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.12.0/css/OverlayScrollbars.min.css">
  <link href='../assets/summernote/summernote-bs4.css' rel='stylesheet' />
  <link href='../assets/style.css' rel='stylesheet' />
  <!-- Google Font: Source Sans Pro -->

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
 <div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link"><i class="fas fa-home"></i></a>
      </li>

      <!-- header ucapan  -->
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">
         <?php
         date_default_timezone_set("Asia/Jakarta");
         $b = time();
         $hour = date("G", $b);
         if ($hour >= 0 && $hour <= 11) {
          echo "Selamat Pagi,";
        } elseif ($hour >= 12 && $hour <= 14) {
          echo "Selamat Siang,";
        } elseif ($hour >= 15 && $hour <= 17) {
          echo "Selamat Sore,";
        } elseif ($hour >= 17 && $hour <= 18) {
          echo "Selamat Petang,";
        } elseif ($hour >= 19 && $hour <= 23) {
          echo "Selamat Malam,";
        }
        ?>
        <?php echo $_SESSION['username']; ?>
      </a>
    </li>
    <!-- +++++++++++++ -->

  </ul>

  <ul class="navbar-nav ml-auto">

    <!-- meanu header mesage penerima disposisi -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-envelope"></i>
        <?php if ($t_inbox['t_inbox']>0) {
          echo "<span class='badge badge-danger navbar-badge'>".$t_inbox['t_inbox']."</span>";
        } else {
          echo "";
        }
        ?>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <?php
        date_default_timezone_set('Asia/Jakarta');
        $query = mysqli_query($con,"SELECT * FROM surat_masuk INNER JOIN disposisi on surat_masuk.no_surat=disposisi.no_surat where disposisi.status_ds='0' and disposisi.kepada='$user' ORDER BY disposisi.no_surat desc LIMIT 3");
        while ($d = mysqli_fetch_array($query)) {  
          $tgl_surat=$d['tgl_surat'];
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
          <a id="<?php echo $d['no_surat'];?>" href="baca_inbox.php?id=<?php echo $d['no_surat'] ?>" class="dropdown-item btn_baca">
            <!-- Message Start -->
            <div class="media">
              <img src="../assets/images/<?php echo $kabag ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <?php echo substr_replace($d['perihal'], '...', 14); ?>
                  <span class="float-right text-sm text-danger"><i class="fas fa-envelope"></i></span>
                </h3>
                <p class="text-sm"><?php $d['catatan']; ?></p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?php if ($menit_fix=='0') {       
                  echo " ".$jumlah_detik." detik yang lalu ";
                } elseif ($jam=='0') {
                  echo " ".$menit_fix." menit yang lalu ";
                }elseif($hari=='0') {
                  echo " ".$jam." jam ".$menit_fix." menit yang lalu ";
                }else{
                  echo " ".$hari." hari yang lalu ";
                } ?></p>
              </div>
            </div>
            <!-- Message End -->
          </a>
        <?php } ?>
        <div class="dropdown-divider"></div>
        <a href="inbox.php" class="dropdown-item dropdown-footer">Tampilkan semua..</a>
      </div>
    </li>
    <!-- ++++++++++++++++++++++++++ -->


    <!-- menu header surat keluar -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-copy"></i>
        <?php if ($t_sk['jumlah_sk']>0) {
          echo "<span class='badge badge-danger navbar-badge'>".$t_sk['jumlah_sk']."</span>";
        } else {
          echo "";
        }?>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <?php
        date_default_timezone_set('Asia/Jakarta');
        $query = mysqli_query($con,"SELECT * FROM surat_keluar inner join user on surat_keluar.pembuat=user.username where surat_keluar.status_surat='0' ORDER BY id_sk DESC LIMIT 3 ");
        while ($d = mysqli_fetch_array($query)) {  
          $tgl_dibuat=$d['tgl_dibuat'];

          $waktu1=strtotime($tgl_dibuat);
          $waktu2=strtotime("now");

          $diff=$waktu2 - $waktu1;
          $jam=floor($diff/(60*60));
          $menit=$diff - $jam * (60*60);
          $sisa = $menit % 60;
          $jumlah_detik = floor($sisa/1);
          $menit_fix=floor($menit/60);
          $hari = floor($diff/86400);

          ?>
          <a href="baca_sk.php?id=<?php echo $d['no_surat']; ?>" id="<?php echo $d['no_surat'];?>" class="dropdown-item baca_s">
            <!-- Message Start -->
            <div class="media">
              <img src="../assets/images/<?php echo $d['images'] ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <?php echo substr_replace($d['pembuat'], '...', 14);  ?>
                  <span class="float-right text-sm text-muted"><i class="fas fa-copy text-danger"></i></span>
                </h3>
                <p class="text-sm"><?php echo $d['perihal']; ?></p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?php if ($menit_fix=='0') {       
                  echo " ".$jumlah_detik." detik yang lalu ";
                } elseif ($jam=='0') {
                  echo " ".$menit_fix." menit yang lalu ";
                }elseif($hari=='0') {
                  echo " ".$jam." jam ".$menit_fix." menit yang lalu ";
                }else{
                  echo " ".$hari." hari yang lalu ";
                } ?></p>
              </div>
            </div>
            <!-- Message End -->
          </a>
        <?php } ?>
        <div class="dropdown-divider"></div>
        <a href="surat_keluar.php" class="dropdown-item dropdown-footer">Tampilan semua..</a>
      </div>
    </li>
    <!-- +++++++++++++++++++++ -->


    <!-- menu header disposisi yang harus diproses -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-bell"></i>
        <?php if ($t_disposisi['jumlah_ds']>0) {
          echo "<span class='badge badge-danger navbar-badge'>".$t_disposisi['jumlah_ds']."</span>";
        } else {
          echo "";
        }?>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <?php
        date_default_timezone_set('Asia/Jakarta');
        $query = mysqli_query($con,"SELECT * FROM surat_masuk where surat_masuk.status_disposisi='0' ORDER BY id_sm DESC LIMIT 3 ");
        while ($d = mysqli_fetch_array($query)) {  
          $tgl_surat=$d['tgl_surat'];
          $tgl_diterima=$d['tgl_diterima'];

          $waktu1=strtotime($tgl_diterima);
          $waktu2=strtotime("now");

          $diff=$waktu2 - $waktu1;
          $jam=floor($diff/(60*60));
          $menit=$diff - $jam * (60*60);
          $sisa = $menit % 60;
          $jumlah_detik = floor($sisa/1);
          $menit_fix=floor($menit/60);
          $hari = floor($diff/86400);

          ?>
          <button class="dropdown-item btn_ds" id="<?php echo $d['id_sm'];?>" data-toggle="modal" data-target="#verifikasi_ds">
            <!-- Message Start -->
            <div class="media">
              <img src="../assets/images/<?php echo $admin ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <?php echo substr_replace($d['pengirim'], '...', 14);  ?>
                  <span class="float-right text-sm text-muted"><i class="fas fa-scroll text-danger"></i></span>
                </h3>
                <p class="text-sm"><?php echo $d['perihal']; ?></p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?php if ($menit_fix=='0') {       
                  echo " ".$jumlah_detik." detik yang lalu ";
                } elseif ($jam=='0') {
                  echo " ".$menit_fix." menit yang lalu ";
                }elseif($hari=='0') {
                  echo " ".$jam." jam ".$menit_fix." menit yang lalu ";
                }else{
                  echo " ".$hari." hari yang lalu ";
                } ?></p>
              </div>
            </div>
            <!-- Message End -->
          </button>
        <?php } ?>
        <div class="dropdown-divider"></div>
        <a href="disposisi_verif.php" class="dropdown-item dropdown-footer">Tampilan semua..</a>
      </div>
    </li>
    <!-- ++++++++++++++++++++++++++ -->



    <!-- menu user logout atau ubah profile -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fa fa-user"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header"><?php echo $_SESSION['nama']; ?></span>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="profile.php">
          <i class="fas fa-user-cog mr-2"></i> Profile
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="../logout.php">
          <i class="fas fa-power-off mr-2"></i>
          Logout
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">------</a>
      </div>
    </li>
    <!-- ++++++++++++++++++++++++++++++ -->

  </ul>
</nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="../assets/images/rumah-banjar.png" alt="AdminLTE Logo" class="brand-image elevation-1"
    style="opacity: .8">
    <span class="brand-text font-weight-light">Banjarmasin</span>
  </a>

  <!-- Sidebar -->








