<?php
$total_percent = ($bunga/100) * $jumlah;
$total = $jumlah+$total_percent;
 ?>
<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card-header bg-primary text-white">
      <?=ucwords($title_module)?>
    </div>
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped">
          <tr>
            <td>Nik Pelanggan</td>
            <td>
              <a href="<?=url("pelanggan/detail/".enc_url($id_pelanggan))?>" target="_blank"><?=$nik?></a>
            </td>
          </tr>
        <tr>
          <td>Nama Pelanggan</td>
          <td><?=$nama?></td>
        </tr>
        <tr>
          <td>Waktu Pemberian Utang</td>
          <td><?=$waktu_utang != "" ? date('d-m-Y H:i',strtotime($waktu_utang)):""?></td>
        </tr>
        <tr>
          <td>Estimasi Pembayaran</td>
          <td><?=$estimasi_bayar != "" ? date('d-m-Y',strtotime($estimasi_bayar)):""?></td>
        </tr>
        <tr>
          <td>Jumlah</td>
          <td><?="Rp." . number_format("$jumlah", 0, "", ".");?></td>
        </tr>
        <tr>
          <td>Bunga</td>
          <td><?="Rp." . number_format("$total_percent", 0, "", ".");?> <span class="text-success">(<?=$bunga?>%)</span></td>
        </tr>
        <tr>
          <td>Total</td>
          <td><?="Rp." . number_format("$total", 0, "", ".");?></td>
        </tr>
        <tr>
          <td>Status Lunas</td>
          <td><?=$status_pembayaran == "belum" ? '<span class="badge badge-danger">Belum Lunas</span>':'<span class="badge badge-success">Lunas</span>'?></td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td><?=$keterangan?></td>
        </tr>
        </table>

        <div class="mt-4">
          <div class="row mb-2">
            <div class="col-sm-12">
              <h5 class="">Data Pembayaran</h5>
              <hr>
            </div>
            <div class="col-sm-12 text-right">
              <a href="<?=url("piutang/tambahPembayaran/$id")?>" class="btn btn-sm btn-primary" id="tambah_pembayaran">Tambah Pembayaran</a>
            </div>
          </div>
          <table class="table table-bordered table-striped">
            <thead>
              <th width="10px">#</th>
              <th>Waktu Pembayaran</th>
              <th>Jumlah</th>
            </thead>

            <tbody>
              <?php if ($pembayaran->num_rows() > 0): ?>
                <?php foreach ($pembayaran->result() as $row): ?>
                <tr>
                  <td class="text-center">
                    <a href="<?=url("piutang/hapusPembayaran/".enc_url($row->id))?>" id="delete"><i class="fa fa-trash text-danger"></i></a>
                  </td>
                  <td><?=date("d/m/Y H:i", strtotime($row->waktu_pembayaran))?></td>
                  <td><?="Rp." . number_format("$row->jumlah_pembayaran", 0, "", ".");?></td>
                </tr>
              <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="3" class="text-center"><i>Belum Pernah Membayar</i></td>
                  </tr>
              <?php endif; ?>


              <tr style="font-weight:bold">
                <td colspan="2" class="text-center">Total</td>
                <td>
                    <?="Rp." . number_format("$total_pembayaran", 0, "", ".");?></td>
              </tr>
            </tbody>
          </table>
        </div>

        <a href="<?=url($this->uri->segment(2))?>" class="btn btn-sm btn-danger mt-3"><?=cclang("back")?></a>
        <a href="<?=url("piutang/cetakPelanggan/$id")?>" target="_blank" class="btn btn-sm btn-warning mt-3"><i class="mdi mdi-printer btn-icon-prepend"></i> Cetak</a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).on("click","#tambah_pembayaran",function(e){
  e.preventDefault();
  $('.modal-dialog').addClass('modal-md');
  $("#modalTitle").text('Tambah Pembayaran');
  $('#modalContent').load($(this).attr("href"));
  $("#modalGue").modal('show');
});

$(document).on("click","#delete",function(e){
  e.preventDefault();
  $('.modal-dialog').addClass('modal-sm');
  $("#modalTitle").text('<?=cclang("confirm")?>');
  $('#modalContent').html(`<p class="mb-4"><?=cclang("delete_description")?></p>
                            <button type='button' class='btn btn-default btn-sm' data-dismiss='modal'><?=cclang("cancel")?></button>
                            <button type='button' class='btn btn-primary btn-sm' id='ya-hapus' data-id=`+$(this).attr('alt')+`  data-url=`+$(this).attr('href')+`><?=cclang("delete_action")?></button>
                            `);
  $("#modalGue").modal('show');
});


$(document).on('click','#ya-hapus',function(e){
  $(this).prop('disabled',true)
          .text('Processing...');
  $.ajax({
          url:$(this).data('url'),
          type:'POST',
          cache:false,
          dataType:'json',
          success:function(json){
            location.reload();
          }
        });
});

</script>
