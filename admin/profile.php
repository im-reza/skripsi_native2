<?php 
session_start();
if ($_SESSION['username']=='kabag') {
  include_once '../assets/header_kabag.php';
} else {
  include_once '../assets/header.php';
}
include_once '../assets/sidebar.php';

$user=$_SESSION['username'];
$inbox=mysqli_query($con,"SELECT count(*) as t_inbox from disposisi where kepada='$user' ");
$t_inbox=mysqli_fetch_array($inbox);
$angka_inbox=$t_inbox['t_inbox'];

$sk=mysqli_query($con,"SELECT count(*) AS jumlah_sk FROM surat_keluar inner join user on surat_keluar.pembuat=user.username where surat_keluar.pembuat='$user' ");
$t_sk=mysqli_fetch_array($sk);
$angka_sk=$t_sk['jumlah_sk'];

?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark"><i class="fas fa-user text-dark"></i> Profile</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">User Profile</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <hr>
  </div><!-- /.container-fluid -->
</div>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Profile</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
       <?php 
       $info_user=mysqli_query($con,"select * from user where username='".$_SESSION['username']."' ");
       while ($d=mysqli_fetch_array($info_user)) {
         ?>
         <!-- Profile Image -->
         <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
              src="../assets/images/<?php echo $d['images'] ?>"
              alt="User profile picture">
            </div>

            <h3 class="profile-username text-center"><?php echo $d['nama']; ?></h3>

            <p class="text-muted text-center"><?php echo $d['username']; ?></p>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Menerima disposisi</b> <a class="float-right"><?php echo $angka_inbox; ?></a>
              </li>
              <li class="list-group-item">
                <b>Membuat surat keluar</b> <a class="float-right"><?php echo $angka_sk; ?></a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Ubah profile</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="">
                <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="actions/setting_akun.php">
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-10">
                      <input type="file" name="images">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="username" value="<?php echo $d['username']; ?>" readonly="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" value="<?php echo $d['nama']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">NIP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nip" value="<?php echo $d['nip']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Pangkat/Gol</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="pangkat" value="<?php echo $d['pangkat']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Telegram id</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="telegram_id" value="<?php echo $d['telegram_id']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputSkills" class="col-sm-2 col-form-label">Password baru</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="password" name="password_new" placeholder="Password baru">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" name="submit" class="btn btn-danger">Ubah</button>
                    </div>
                  </div>
                </form>
              </div>
            <?php } ?>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div><!-- /.card-body -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
  </div>
  <!-- /.row -->
</div><!-- /.container-fluid -->
</section>





<?php 
include_once '../assets/footer.php';  
?>
