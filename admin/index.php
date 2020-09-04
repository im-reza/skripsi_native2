    <?php
    session_start();
    if ($_SESSION['username']=='kabag') {
      include_once '../assets/header_kabag.php';
    } else {
      include_once '../assets/header.php';
    }
    include_once '../assets/sidebar.php';
    $surat_masuk = mysqli_query($con, "SELECT COUNT(*) AS total FROM surat_masuk");
    $disposisi = mysqli_query($con, "SELECT COUNT(*) AS dis FROM surat_masuk where status_disposisi='1'");
    $surat_keluar = mysqli_query($con, "SELECT COUNT(*) AS sk FROM surat_keluar");
    $inbox = mysqli_query($con, "SELECT count(*) AS t_inbox FROM disposisi where kepada='$user' ");
    $t_disposisi = mysqli_fetch_array($disposisi);
    $t_suratmasuk = mysqli_fetch_array($surat_masuk);
    $t_suratkeluar = mysqli_fetch_array($surat_keluar);
    $t_inbox = mysqli_fetch_array($inbox);

    ?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-home text-dark"></i> Hello, <?php echo $_SESSION['username']; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Home</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <hr>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-secondary elevation-1"><i class="fas ffas fa-dice-d6"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Surat masuk</span>
                <span class="info-box-number"> Total : 
                  <?php echo $t_suratmasuk['total']; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-scroll"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Disposisi</span>
                <span class="info-box-number"> Total : <?php echo $t_disposisi['dis']; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas ffas fa-dice-d6"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Surat keluar</span>
                <span class="info-box-number"> Total : <?php echo $t_suratkeluar['sk']; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Inbox saya</span>
                <span class="info-box-number"> Total : <?php echo $t_inbox['t_inbox']; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="col-md-12">
          <div class="info-box mb-3">
            <div id="calendar"></div>
          </div>
          <!-- /.info-box -->
        </div>

        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>

    <?php
    include_once '../assets/footer.php';
    ?>

    <!-- script memenggil tabel acara dan ditampilan kedalam kalendar pada halaman home (masih Error selain halaman home) -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {

          timeZone: 'UTC',
          locale :'id',

          plugins: ['interaction', 'dayGrid', 'timeGrid'],
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          navLinks: true,
          selectable: true,
          selectMirror: true,
          eventLimit: true,
          events: 'json/load_calendar.php',
          eventClick: function(info) {
            info.jsEvent.preventDefault();

            if (info.event.url) {
              window.open(info.event.url);
            }
          },
        });
        calendar.render();
      });
    </script>
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->