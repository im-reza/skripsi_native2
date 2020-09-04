      <div class="sidebar text-sm">

        <!-- Sidebar Menu -->
        <nav id="nav" class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-header">DASHBOARD</li>
           <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="fas fa-home nav-icon"></i>
              <p>Home</p>
            </a>
          </li>
        </li>
        <li class="nav-header">MENU SURAT MASUK</li>
        <li class="nav-item">
          <a href="surat_masuk.php" class="nav-link">
            <i class="nav-icon fas ffas fa-dice-d6"></i>
            <p>
              Surat Masuk
              <span class="right badge badge-danger">New</span>
            </p>
          </a>
        </li>
        <?php if ($_SESSION['username']=='admin') {
          ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-inbox"></i>
              <p>
                Tambah Surat
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="tambahsm_pemberitahuan.php" class="nav-link">
                  <i class="fas fa-volume-up nav-icon"></i>
                  <p>Surat masuk pemberitahuan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="tambahsm_undangan.php" class="nav-link">
                  <i class="fas fa-calendar nav-icon"></i>
                  <p>Surat masuk undangan</p>
                </a>
              </li>
            </ul>
          </li>
          <?php
        } else {
          # code...
        }
        ?>
        <li class="nav-item">
          <a href="disposisi.php" class="nav-link">
            <i class="nav-icon fas fa-scroll"></i>
            <p>
              Disposisi
              <span class="right badge badge-danger">New</span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link" data-toggle="modal" data-target="#lacak_surat">
            <i class="nav-icon fas fa-search-location"></i>
            <p>
              Lacak Surat
            </p>
          </a>
        </li>
        <li class="nav-header">MENU SURAT KELUAR</li>
        <li class="nav-item">
          <a href="surat_keluar.php" class="nav-link">
            <i class="nav-icon fas ffas fa-dice-d6"></i>
            <p>
              Surat Keluar
              <span class="right badge badge-danger">New</span>
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Buat Surat
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="tambahsk_undangan.php" class="nav-link">
                <i class="fas fa-pen-alt nav-icon"></i>
                <p>Undangan Rapat</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="tambahsk_cuti.php" class="nav-link">
                <i class="fas fa-pen-alt nav-icon"></i>
                <p>Permohonan Cuti</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="tambahsk_kerja.php" class="nav-link">
                <i class="fas fa-pen-alt nav-icon"></i>
                <p>Perintah Kerja</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="tambahsk_dinas.php" class="nav-link">
                <i class="fas fa-pen-alt nav-icon"></i>
                <p>Perjalanan Dinas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="tambahsk_biasa.php" class="nav-link">
                <i class="fas fa-pen-alt nav-icon"></i>
                <p>Format Sendiri</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">LAPORAN</li>
        <li class="nav-item">
          <a href="laporan/lap_sm.php?tgl_sm_awal=1" target="_blank" class="nav-link">
            <i class="nav-icon fas fa-file-pdf"></i>
            <p>
              Data Surat Masuk
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="laporan/lap_ds.php?tgl_ds_awal=1" target="_blank" class="nav-link">
            <i class="nav-icon fas fa-file-pdf"></i>
            <p>
              Data Disposisi
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="laporan/lap_sk.php?tgl_sk_awal=1" target="_blank" class="nav-link">
            <i class="nav-icon fas fa-file-pdf"></i>
            <p>
              Data Surat Keluar
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<div class="content-wrapper text-sm">