
        <div class="mb-2">
          <button type="button" id="reload" class="btn btn-sm btn-info-2 btn-icon-text"><i class="mdi mdi-backup-restore btn-icon-prepend"></i> Reload</button>
          <a href="<?=url("pelanggan/filter/")?>" id="filter-show" class="btn btn-sm btn-primary btn-icon-text"><i class="mdi mdi-magnify btn-icon-prepend"></i> Filter</a>
        </div>

        <form autocomplete="off" class="content-filter">
          <div class="row">
            <div class="form-group col-md-6">
              <input type="text" id="nik" class="form-control form-control-sm" placeholder="Nik" />
            </div>

            <div class="form-group col-md-6">
              <input type="text" id="nama" class="form-control form-control-sm" placeholder="Nama" />
            </div>

            <div class="form-group col-md-6">
              <select class="form-control form-control-sm" id="jenis_kelamin" name="jenis_kelamin">
                <option value="">-- pilih Jenis Kelamin --</option>
                <option value="pria">Pria</option>
                <option value="wanita">Wanita</option>
              </select>
            </div>


            <div class="form-group col-md-6">
              <input type="text" id="telepon" class="form-control form-control-sm" placeholder="Telepon" />
            </div>

            <div class="col-md-12">
              <button type='button' class='btn btn-default btn-sm' id="filter-cancel"><?=cclang("cancel")?></button>
              <button type="button" class="btn btn-primary btn-sm" id="filter">Filter</button>
            </div>
          </div>
        </form>

        <table class="table table-bordered table-striped" id="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
          <thead>
            <tr>
							<th>Nik</th>
							<th>Nama</th>
							<th>Jenis kelamin</th>
							<th>Telepon</th>
              <th>#</th>
            </tr>
          </thead>

        </table>





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
          "url": "<?= url("pelanggan/json_model")?>",
          "type": "POST",
          "data":function(data){
              data.nik = $("#nik").val();
              data.nama = $("#nama").val();
              data.jenis_kelamin = $("#jenis_kelamin").val();
              data.telepon = $("#telepon").val();
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
            "className": "text-center",
            "orderable": false,
            "targets": 4
        },
      ],
    });

  $("#reload").click(function(){
  $("#nik").val("");
  $("#nama").val("");
  $("#jenis_kelamin").val("");
  $("#telepon").val("");
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

  $(document).on("click","#gunakan",function(e){
    e.preventDefault();
    $("#pelanggan").val($(this).data('nik')+ " - " +$(this).data('nama'));
    $("#id_pelanggan").val($(this).data('id'));
    $("#modalGue").modal("hide");
  })

});
</script>
