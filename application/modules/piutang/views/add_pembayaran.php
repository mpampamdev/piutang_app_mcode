<form id="form" autocomplete="off" action="<?=$action?>">
  <div class="form-group">
    <label for="">Waktu Bayar</label>
    <input type="datetime-local" class="form-control form-control-sm" name="waktu_bayar" id="waktu_bayar">
  </div>

  <div class="form-group">
    <label for="">Jumlah</label>
    <input type="text" class="form-control form-control-sm" name="jumlah_pembayaran" id="jumlah_pembayaran">
  </div>

  <button type='button' class='btn btn-default btn-sm' data-dismiss='modal'><?=cclang("cancel")?></button>
  <button type="submit" class="btn btn-sm btn-primary" id="submit" name="submit">Tambahkan</button>
</form>


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
