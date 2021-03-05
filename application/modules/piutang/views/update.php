<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card m-b-30">
      <div class="card-header bg-primary text-white">
        <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
          <form action="<?=$action?>" id="form" autocomplete="off">

          <div class="form-group">
            <label>Data Pelanggan</label>
            <input type="text" class="form-control form-control-sm" name="" value="<?=$nik?> - <?=$nama?>" readonly>
          </div>

          <div class="form-group">
            <label>Waktu Pemberian Utang</label>
            <input type="datetime-local" class="form-control form-control-sm" placeholder="Waktu Pemberian Utang" name="waktu_utang" id="waktu_utang" value="<?=$waktu_utang?>">
          </div>

          <div class="form-group">
            <label>Estimasi Pembayaran</label>
            <input type="date" class="form-control form-control-sm" placeholder="Estimasi Pembayaran" name="estimasi_bayar" id="estimasi_bayar" value="<?=$estimasi_bayar?>">
          </div>

          <div class="form-group">
            <label>Jumlah</label>
            <input type="text" class="form-control form-control-sm" placeholder="Jumlah" name="jumlah" id="jumlah" value="<?=$jumlah?>">
          </div>


          <div class="form-group">
            <label>Bunga</label>
            <div class="input-group">
              <input type="text" class="form-control"  placeholder="Bunga" name="bunga" value="<?=$bunga?>">
              <div class="input-group-append">
                <span class="input-group-text" style="color:#000">%</span>
              </div>
            </div>
            <div id="bunga"></div>
          </div>

          <div class="form-group">
            <label>Keterangan</label>
            <textarea class="form-control form-control-sm" placeholder="Keterangan" name="keterangan" id="keterangan" rows="3" cols="80"><?=$keterangan?></textarea>
          </div>

          <input type="hidden" name="submit" value="update">

          <div class="text-right">
            <a href="<?=url($this->uri->segment(2))?>" class="btn btn-sm btn-danger"><?=cclang("cancel")?></a>
            <button type="submit" id="submit"  class="btn btn-sm btn-primary"><?=cclang("update")?></button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
$("#form").submit(function(e){
e.preventDefault();
var me = $(this);
$("#submit").prop('disabled',true).html('Loading...');
$(".form-group").find('.text-danger').remove();
$.ajax({
      url             : me.attr('action'),
      type            : 'post',
      data            :  new FormData(this),
      contentType     : false,
      cache           : false,
      dataType        : 'JSON',
      processData     :false,
      success:function(json){
        if (json.success==true) {
          location.href = json.redirect;
          return;
        }else {
          $("#submit").prop('disabled',false)
                      .html('<?=cclang("save")?>');
          $.each(json.alert, function(key, value) {
            var element = $('#' + key);
            $(element)
            .closest('.form-group')
            .find('.text-danger').remove();
            $(element).after(value);
          });
        }
      }
    });
});
</script>
