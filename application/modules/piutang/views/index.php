<div class="row">
  <div class="col-md-12 col-xl-12 mx-auto animated fadeIn delay-2s">
    <div class="card m-b-30">
      <div class="card-header bg-primary text-white">
        <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
        <div class="mb-2">
          <a href="<?=url("piutang/add")?>" class="btn btn-sm btn-success btn-icon-text"><i class="fa fa-file btn-icon-prepend"></i><?=cclang("add_new")?></a>
          <button type="button" id="reload" class="btn btn-sm btn-info-2 btn-icon-text"><i class="mdi mdi-backup-restore btn-icon-prepend"></i> Muat Ulang</button>
          <a href="<?=url("piutang/filter/")?>" id="filter-show" class="btn btn-sm btn-primary btn-icon-text"><i class="mdi mdi-magnify btn-icon-prepend"></i> Filter & Cetak</a>
            <!-- <div class="dropdown float-right">
                <button class="btn btn-warning btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="mdi mdi-printer btn-icon-prepend"></i> Cetak
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="<?=url("piutang/cetak")?>" target="_blank">Semua</a>
                  <a class="dropdown-item" href="<?=url("piutang/cetak/lunas")?>" target="_blank">Belum Lunas</a>
                  <a class="dropdown-item" href="<?=url("piutang/cetak/sudah")?>" target="_blank">Lunas</a>
                </div>
            </div> -->
        </div>


        <form autocomplete="off" class="content-filter" action="<?=url("piutang/cetak")?>" method="post" target="_blank">
          <div class="row">

            <div class="form-group col-md-6">
              <label for="">Nik Pelanggan</label>
              <input type="text" id="nik" class="form-control form-control-sm" placeholder="Nik pelanggan" />
            </div>

            <div class="form-group col-md-6">
              <label for="">Nama Pelanggan</label>
              <input type="text" class="form-control form-control-sm" name="id_pelanggan" id="id_pelanggan" placeholder="Nama pelanggan">
            </div>

            <div class="form-group col-md-6">
              <label for="">Waktu Pemberian Utang</label>
              <input type="date" id="waktu_utang" class="form-control form-control-sm" placeholder="Waktu Pemberian Utang" />
            </div>

            <div class="form-group col-md-6">
              <label for="">Estimasi Waktu Pembbayaran</label>
              <input type="date" id="estimasi_bayar" class="form-control form-control-sm" placeholder="Estimasi Waktu Pembayaran" />
            </div>

            <div class="form-group col-md-6">
              <label for="">Jumlah</label>
              <input type="text" id="jumlah" class="form-control form-control-sm" placeholder="Jumlah" />
            </div>

            <div class="form-group col-md-6">
              <label for="">Status Lunas</label>
              <select class="form-control form-control-sm" id="status_pembayaran" name="status_pembayaran">
                <option value="">-- Status Pembayaran --</option>
                <option value="belum">Belum Lunas</option>
                <option value="sudah">Lunas</option>
              </select>
            </div>


            <div class="col-md-12">
              <button type='button' class='btn btn-default btn-sm' id="filter-cancel"><?=cclang("cancel")?></button>
              <button type="button" class="btn btn-primary btn-sm" id="filter">Filter</button>
              <button type="submit" class="btn btn-warning btn-sm" id="submit"><i class="mdi mdi-printer btn-icon-prepend"></i> Cetak</button>
            </div>
          </div>
        </form>

        <table class="table table-bordered table-striped" id="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
          <thead>
            <tr>
							<th>Data Pelanggan</th>
							<th>Waktu Pemb. Utang</th>
              <th>Estimasi Bayar</th>
							<th>Jumlah</th>
              <th>Bunga</th>
              <th>Total</th>
							<th>Status</th>
              <th>#</th>
            </tr>
          </thead>
        </table>

      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
$(document).ready(function(){
var table;
//datatables
  table = $('#table').DataTable({

      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      "ordering": true,
      "searching": false,
      "info": true,
      "bLengthChange": false,
      oLanguage: {
          sProcessing: '<i class="fa fa-spinner fa-spin fa-fw"></i> Loading...'
      },

      // Load data for the table's content from an Ajax source
      "ajax": {
          "url": "<?= url("piutang/json")?>",
          "type": "POST",
          "data":function(data){
              data.nik = $("#nik").val();
              data.id_pelanggan = $("#id_pelanggan").val();
              data.waktu_utang = $("#waktu_utang").val();
              data.estimasi_bayar = $("#estimasi_bayar").val();
              data.jumlah = $("#jumlah").val();
              data.status_pembayaran = $("#status_pembayaran").val();
              }
            },

      //Set column definition initialisation properties.
        "columnDefs": [

					{
            "targets": 0,
            "orderable": false
          },

					{
            "targets": 1,
            "orderable": false
          },

					{
            "targets": 2,
            "orderable": false
          },

					{
            "targets": 3,
            "orderable": false
          },

					{
            "targets": 4,
            "orderable": false
          },

          {
            "targets": 5,
            "orderable": false
          },

          {
              "className": "text-center",
              "orderable": false,
              "targets": 6
          },

        {
            "className": "text-center",
            "orderable": false,
            "targets": 7
        },
      ],
    });

  $("#reload").click(function(){
  $("#nik").val("");
  $("#id_pelanggan").val("");
  $("#waktu_utang").val("");
  $("#estimasi_bayar").val("");
  $("#jumlah").val("");
  $("#status_pembayaran").val("");
  table.ajax.reload();
  });

  $(document).on("click","#filter-show",function(e){
    e.preventDefault();
    $(".content-filter").slideDown();
  });

  $(document).on("click","#filter",function(e){
    e.preventDefault();
    $("#table").DataTable().ajax.reload();
  })

  $(document).on("click","#filter-cancel",function(e){
    e.preventDefault();
    $(".content-filter").slideUp();
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
              $('#modalGue').modal('hide');
              swal(json.msg, {
                icon:json.type_msg
              });
              $('#table').DataTable().ajax.reload();
            }
          });
  });


});
</script>
