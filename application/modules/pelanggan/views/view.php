<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card-header bg-primary text-white">
      <?=ucwords($title_module)?>
    </div>
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped">
        <tr>
          <td>Nik</td>
          <td><?=$nik?></td>
        </tr>
        <tr>
          <td>Nama</td>
          <td><?=$nama?></td>
        </tr>
        <tr>
          <td>Tempat, tanggal lahir</td>
          <td><?=$tempat_lahir?>, <?=date("d-m-Y", strtotime($tanggal_lahir))?></td>
        </tr>
        <tr>
          <td>Jenis kelamin</td>
          <td><?=$jenis_kelamin?></td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td><?=$alamat?></td>
        </tr>
        <tr>
          <td>Telepon</td>
          <td><?=$telepon?></td>
        </tr>
        <tr>
          <td>Foto</td>
          <td><?=is_image($foto)?></td>
        </tr>
        </table>

        <a href="<?=url($this->uri->segment(2))?>" class="btn btn-sm btn-danger mt-3"><?=cclang("back")?></a>
      </div>
    </div>
  </div>
</div>
