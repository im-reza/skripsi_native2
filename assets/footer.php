</div>
<footer class="main-footer text-sm">
	<div class="text-muted text-center">&copy; copyright  2020 | by. Reza.
		<a href="https://github.com/mreza18" target="_blank" class="text-muted ml-4"><i class="fab fa-github"></i>
		</a>
		&middot;
		<a href="https://web.facebook.com/reza.p.tibiamerz/" target="_blank" class="text-muted"><i class="fab fa-facebook"></i>
		</a>
		&middot;
		<a href="https://instagram.com/riza.a1" target="_blank" class="text-muted"><i class="fab fa-instagram"></i>
		</a>
		&middot;
		<a href="#" class="text-muted"><i class="fab fa-whatsapp"></i>
		</a>
		&middot;
		<a href="#" class="text-muted"><i class="fas fa-paper-plane"></i>
		</a>
		&middot;
		<a href="#" class="text-muted"><i class="fab fa-google-plus"></i>
		</a>
	</div>
</footer>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/all.min.js"></script>
<!-- overlayScrollbars -->
<script src='../assets/fullcalendar/packages/core/main.js'></script>
<script src='../assets/fullcalendar/packages/core/locales/id.js'></script>
<script src='../assets/fullcalendar/packages/interaction/main.js'></script>
<script src='../assets/fullcalendar/packages/daygrid/main.js'></script>
<script src='../assets/fullcalendar/packages/timegrid/main.js'></script>

<script src="https://cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.12.0/js/OverlayScrollbars.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/js/adminlte.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dropzone/dist/min/dropzone.min.js"></script>
<script src='../assets/summernote/summernote-bs4.min.js'></script>
<script src="../assets/js/scripts.js"></script>


</body>

</html>
<!-- modal verifikasi disposisi kabag -->
<div class="modal fade" id="verifikasi_ds" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header border-0 bg-gradient-danger">
        <h5 class="modal-title" id="exampleModalLabel">Disposisi surat masuk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="actions/tambah_ds.php" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label><strong>Nomor Surat :</strong></label>
              <input type="text" class="form-control" name="no_surat" id="no_surat" readonly="">
            </div>
            <div class="form-group col-md-4">
              <label><strong>Tanggal di surat :</strong></label>
              <input type="date" class="date form-control" name="tgl_surat" id="tgl_surat" readonly="">
            </div>
            <div class="form-group col-md-4">
              <label><strong>Tanggal diterima :</strong></label>
              <input type="text" class="date form-control" name="tgl_diterima" id="tgl_diterima" readonly="">
            </div>
            <div class="form-group col-md-6">
              <label><strong>Pengirim :</strong></label>
              <input type="text"class="form-control" name="pengirim" id="pengirim" readonly="">
            </div>
            <div class="form-group col-md-6">
              <label><strong>Perihal surat :</strong></label>
              <input type="text"class="form-control" name="perihal" id="perihal" readonly="">
            </div>
            <div class="form-group col-md-12">
              <div class="well">
                <a class="btn btn-warning btn-sm btn-block" id="file"><i class="fas fa-file-pdf mr-2"></i>Buka File</a>
              </div>
            </div>
          </div>
          <label><strong>Diteruskan kpd :</strong></label>
          <select style="width: 100%" class="custom-select" id="kepada-multiple" name="kepada[]" multiple="multiple" required="">
            <?php 
            $queryuser=mysqli_query($con,"select * from user"); 
            while ($d=mysqli_fetch_array($queryuser)) {
              ?>
              <option value="<?php echo $d['username']; ?>"><?php echo $d['username']; ?></option>
            <?php } ?>
          </select>
          <div class="form-group mt-2">
           <label><strong>Catatan :</strong></label>
           <textarea class="form-control" name="catatan" rows="3" required="" placeholder="Harap diisi..."></textarea>
         </div>
       </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
      </form>
    </div>
  </div>
</div>
</div>
<!-- ================================== -->

<!-- modal melacak surat -->
<div class="modal fade" id="lacak_surat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="exampleModalLabel">Melacak surat masuk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="GET" action="track.php">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label><strong>Ketik nomor surat :</strong></label>
              <input type="text" class="form-control" name="no_surat" id="no_s" required="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" name="submit" class="btn btn-primary">Cari</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ===================== -->


<!-- Modal cetak data surat masuk bedasarkan tanngal -->
<div class="modal fade" id="lap_sm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Laporan surat masuk berdasarkan tanggal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="GET" action="laporan/lap_sm.php" target="_blank">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label><strong>Dari tanggal :</strong></label>
              <input type="date" class="form-control" name="tgl_sm_awal" required="">
            </div>
            <div class="form-group col-md-12">
              <label><strong>Sampai Tanggal :</strong></label>
              <input type="date" class="form-control" name="tgl_sm_akhir" value="<?php echo date('Y-m-d') ?>" required="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" name="submit" class="btn btn-primary">Cetak</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ================================================ -->

<!-- Modal cetak data surat masuk bedasarkan tanngal -->
<div class="modal fade" id="lap_ds" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Laporan surat disposisi berdasarkan tanggal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="GET" action="laporan/lap_ds.php" target="_blank">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label><strong>Dari tanggal :</strong></label>
              <input type="date" class="form-control" name="tgl_ds_awal" required="">
            </div>
            <div class="form-group col-md-12">
              <label><strong>Sampai Tanggal :</strong></label>
              <input type="date" class="form-control" name="tgl_ds_akhir" value="<?php echo date('Y-m-d') ?>" required="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" name="submit" class="btn btn-primary">Cetak</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ================================================ -->

<!-- Modal cetak data surat masuk bedasarkan tanngal -->
<div class="modal fade" id="lap_sk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Laporan surat keluar berdasarkan tanggal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="GET" action="laporan/lap_sk.php" target="_blank">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label><strong>Dari tanggal :</strong></label>
              <input type="date" class="form-control" name="tgl_sk_awal" required="">
            </div>
            <div class="form-group col-md-12">
              <label><strong>Sampai Tanggal :</strong></label>
              <input type="date" class="form-control" name="tgl_sk_akhir" value="<?php echo date('Y-m-d') ?>" required="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" name="submit" class="btn btn-primary">Cetak</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ================================================ -->


<!-- Modal hapus data surat keluar -->
<div class="modal fade" id="hapus_surat_sk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus surat masuk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda benar ingin menghapus Data surat Keluar ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button class="btn btn-danger "><a class="btn-hapus_sk text-white">Ya, Hapus !</a></button>
      </div>
    </div>
  </div>
</div>
<!-- ============================ -->


<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- kenapa script diletakan di bawah footer karena akan bersifat global, jadi dihalaman manapun dapat terpanggil -->
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

<!-- script hapus surat keluar -->
<script>
  $('#hapus_surat_sk').on('show.bs.modal',function(e){
    $(this).find('.btn-hapus_sk').attr('href',$(e.relatedTarget).data('href'));;
  });
</script>
<!-- ++++++++++++++++++++++++ -->

<!-- script select2 -->
<script>
  $(document).ready(function() {
    $('#kepada-multiple').select2();
  });
</script>
<!-- +++++++++++++ -->

<!-- script autocomplite di form modal lacak surat masuk -->
<script>
	$(function() {
		$("#no_s").autocomplete({
			source: 'json/autocomplete.php'
		});
	});
</script>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++ -->



<!-- script saat kabag mengklik disposisi di header maka akan memunculkan modal disposisi  -->
<script>
  $(document).on('click','.btn_ds',function(){
    var no=$(this).attr("id");
    $.ajax({
      url:"json/show_ds.php",
      method:"POST",
      data:{
        no:no
      },
      dataType:"json",
      success:function(data){
        $('#no_surat').val(data.no_surat);
        $('#tgl_surat').val(data.tgl_surat);
        $('#tgl_diterima').val(data.tgl_diterima);
        $('#pengirim').val(data.pengirim);
        $('#perihal').val(data.perihal);
        $('#file').click(function(){
          window.open("../file/"+data.file);
        });
      }
    });
  });
</script>
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

<!-- script saat kabag mengklik surat keluar di header maka akan mengupdate data surat keluar  -->
<script>
  $('.baca_s').click(function(){
    var no_sk=$(this).attr("id");
    $.ajax({
      url:"json/baca_sk.php",
      method:"POST",
      data:{
        no_sk:no_sk
      },
      success:function(data){
        console.log(data);
      }
    });
  });
</script>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

<!-- script saat user mengklik data disposisi di header maka akan mengupdate data disposisi menjadi sudah terbaca -->
<script>
  $(document).on('click','.btn_baca',function(){
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
</script>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

