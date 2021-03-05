<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card m-b-30">
      <div class="card-header bg-primary text-white">
        <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
          <form action="<?=$action?>" id="form" autocomplete="off">

          <div class="form-group">
            <label>Nik</label>
            <input type="text" class="form-control form-control-sm" placeholder="Nik" name="nik" id="nik">
          </div>

          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control form-control-sm" placeholder="Nama" name="nama" id="nama">
          </div>

          <div class="form-group">
            <label>Tempat lahir</label>
            <input type="text" class="form-control form-control-sm" placeholder="Tempat lahir" name="tempat_lahir" id="tempat_lahir">
          </div>

          <div class="form-group">
            <label>Tanggal lahir</label>
            <input type="date" class="form-control form-control-sm" placeholder="Tanggal lahir" name="tanggal_lahir" id="tanggal_lahir">
          </div>

          <div class="form-group">
            <label>Jenis kelamin</label>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="jenis_kelamin" value="pria">
                Pria
                <i class="input-helper"></i>
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="jenis_kelamin" value="wanita">
                Wanita
                <i class="input-helper"></i>
              </label>
            </div>
            <div id="jenis_kelamin"></div>
          </div>

          <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control form-control-sm" placeholder="Alamat" name="alamat" id="alamat" rows="3" cols="80"></textarea>
          </div>

          <div class="form-group">
            <label>Telepon</label>
            <input type="text" class="form-control form-control-sm" placeholder="Telepon" name="telepon" id="telepon">
          </div>

          <div class="form-group">
            <label>Foto</label>
            <input type="file" name="img" class="file-upload-default" data-id="foto"/>
            <div class="input-group col-xs-12">
              <input type="hidden" class="file-dir" name="file-dir-foto" data-id="foto"/>
              <input type="text" class="form-control form-control-sm file-upload-info file-name" data-id="foto" placeholder="Foto" readonly name="foto" />
            <span class="input-group-append">
              <button class="btn-remove-image btn btn-danger btn-sm" type="button" data-id="foto" style="display:<?=$foto!=''?'block':'none'?>;"><i class="ti-trash"></i></button>
              <button class="file-upload-browse btn btn-primary btn-sm" data-id="foto" type="button">Select File</button>
            </span>
            </div>
            <div id="foto"></div>
          </div>


          <input type="hidden" name="submit" value="add">

          <div class="text-right">
            <a href="<?=url($this->uri->segment(2))?>" class="btn btn-sm btn-danger"><?=cclang("cancel")?></a>
            <button type="submit" id="submit"  class="btn btn-sm btn-primary"><?=cclang("save")?></button>
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
