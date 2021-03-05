<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*| --------------------------------------------------------------------------*/
/*| dev : mpampamdev  */
/*| version : V.0.0.2 */
/*| facebook : https://web.facebook.com/mpampam */
/*| fanspage : https://web.facebook.com/programmerjalanan */
/*| instagram : https://www.instagram.com/programmer_jalanan */
/*| youtube : https://www.youtube.com/channel/UC1TlTaxRNdwrCqjBJ5zh6TA */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 03/03/2021 21:37*/
/*| Please DO NOT modify this information*/


class Pelanggan extends Backend{

private $title = "Data Pelanggan";


public function __construct()
{
  $config = array(
    'title' => $this->title,
   );
  parent::__construct($config);
  $this->load->model("Pelanggan_model","model");
}

function index()
{
  $this->is_allowed('pelanggan_list');
  $this->template->set_title($this->title);
  $this->template->view("index");
}

function json()
{
  if ($this->input->is_ajax_request()) {
    if (!is_allowed('pelanggan_list')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $list = $this->model->get_datatables();
    $data = array();
    foreach ($list as $row) {
        $rows = array();
                $rows[] = is_image($row->foto);
                $rows[] = $row->nik;
                $rows[] = $row->nama;
                $rows[] = $row->jenis_kelamin;
                $rows[] = $row->telepon;

        $rows[] = '
                  <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="'.url("pelanggan/detail/".enc_url($row->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
                        <i class="mdi mdi-file"></i>
                      </a>
                      <a href="'.url("pelanggan/update/".enc_url($row->id)).'" id="update" class="btn btn-warning" title="'.cclang("update").'">
                        <i class="ti-pencil"></i>
                      </a>
                      <a href="'.url("pelanggan/delete/".enc_url($row->id)).'" id="delete" class="btn btn-danger" title="'.cclang("delete").'">
                        <i class="ti-trash"></i>
                      </a>
                    </div>
                 ';

        $data[] = $rows;
    }

    $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->model->count_all(),
                    "recordsFiltered" => $this->model->count_filtered(),
                    "data" => $data,
            );
    //output to json format
    return $this->response($output);
  }
}


function pelanggan_model()
{
  $this->template->view("model",[],false);
}

function json_model()
{
  if ($this->input->is_ajax_request()) {
    if (!is_allowed('pelanggan_list')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $list = $this->model->get_datatables();
    $data = array();
    foreach ($list as $row) {
        $rows = array();
                $rows[] = $row->nik;
                $rows[] = $row->nama;
                $rows[] = $row->jenis_kelamin;
                $rows[] = $row->telepon;

        $rows[] = '
                    <button class="btn btn-sm btn-primary" id="gunakan" data-id="'.$row->id.'" data-nama="'.$row->nama.'" data-nik="'.$row->nik.'">Gunakan</button>
                 ';

        $data[] = $rows;
    }

    $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->model->count_all(),
                    "recordsFiltered" => $this->model->count_filtered(),
                    "data" => $data,
            );
    //output to json format
    return $this->response($output);
  }
}

function filter()
{
  if(!is_allowed('pelanggan_filter'))
  {
    echo "access not permission";
  }else{
    $this->template->view("filter",[],false);
  }
}

function detail($id)
{
  $this->is_allowed('pelanggan_detail');
    if ($row = $this->model->find(dec_url($id))) {
    $this->template->set_title("Detail ".$this->title);
    $data = array(
          "nik" => $row->nik,
          "nama" => $row->nama,
          "tempat_lahir" => $row->tempat_lahir,
          "tanggal_lahir" => $row->tanggal_lahir,
          "jenis_kelamin" => $row->jenis_kelamin,
          "alamat" => $row->alamat,
          "telepon" => $row->telepon,
          "foto" => $row->foto,
    );
    $this->template->view("view",$data);
  }else{
    $this->error404();
  }
}

function add()
{
  $this->is_allowed('pelanggan_add');
  $this->template->set_title(cclang("add")." ".$this->title);
  $data = array('action' => url("pelanggan/add_action"),
                  'nik' => set_value("nik"),
                  'nama' => set_value("nama"),
                  'tempat_lahir' => set_value("tempat_lahir"),
                  'tanggal_lahir' => set_value("tanggal_lahir"),
                  'jenis_kelamin' => set_value("jenis_kelamin"),
                  'alamat' => set_value("alamat"),
                  'telepon' => set_value("telepon"),
                  'foto' => set_value("foto"),
                  'created_at' => set_value("created_at"),
                  );
  $this->template->view("add",$data);
}

function add_action()
{
  if($this->input->is_ajax_request()){
    if (!is_allowed('pelanggan_add')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $json = array('success' => false);
    $this->form_validation->set_rules("nik","* Nik","trim|xss_clean|required|numeric|is_unique[pelanggan.nik]",[
      "is_unique" => "* Nik sudah ada"
    ]);
    $this->form_validation->set_rules("nama","* Nama","trim|xss_clean|required|htmlspecialchars");
    $this->form_validation->set_rules("tempat_lahir","* Tempat lahir","trim|xss_clean|required|htmlspecialchars");
    $this->form_validation->set_rules("tanggal_lahir","* Tanggal lahir","trim|xss_clean|required");
    $this->form_validation->set_rules("jenis_kelamin","* Jenis kelamin","trim|xss_clean|required");
    $this->form_validation->set_rules("alamat","* Alamat","trim|xss_clean|required");
    $this->form_validation->set_rules("telepon","* Telepon","trim|xss_clean|required|numeric");
    $this->form_validation->set_rules("foto","* Foto","trim|xss_clean");
    $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

    if ($this->form_validation->run()) {
      $save_data['nik'] = $this->input->post('nik',true);
      $save_data['nama'] = $this->input->post('nama',true);
      $save_data['tempat_lahir'] = $this->input->post('tempat_lahir',true);
      $save_data['tanggal_lahir'] = date("Y-m-d",  strtotime($this->input->post('tanggal_lahir', true)));
      $save_data['jenis_kelamin'] = $this->input->post('jenis_kelamin',true);
      $save_data['alamat'] = $this->input->post('alamat',true);
      $save_data['telepon'] = $this->input->post('telepon',true);
      $save_data['foto'] = $this->imageCopy($this->input->post('foto',true),$_POST['file-dir-foto']);
      $save_data['created_at'] = date("Y-m-d H:i");

      $this->model->insert($save_data);

      set_message("success",cclang("notif_save"));
      $json['redirect'] = url("pelanggan");
      $json['success'] = true;
    }else {
      foreach ($_POST as $key => $value) {
        $json['alert'][$key] = form_error($key);
      }
    }

    $this->response($json);
  }
}

function update($id)
{
  $this->is_allowed('pelanggan_update');
  if ($row = $this->model->find(dec_url($id))) {
    $this->template->set_title(cclang("update")." ".$this->title);
    $data = array('action' => url("pelanggan/update_action/$id"),
                  'nik' => set_value("nik", $row->nik),
                  'nama' => set_value("nama", $row->nama),
                  'tempat_lahir' => set_value("tempat_lahir", $row->tempat_lahir),
                  'tanggal_lahir' => date("Y-m-d",  strtotime($row->tanggal_lahir)),
                  'jenis_kelamin' => set_value("jenis_kelamin", $row->jenis_kelamin),
                  'alamat' => set_value("alamat", $row->alamat),
                  'telepon' => set_value("telepon", $row->telepon),
                  'foto' => set_value("foto", $row->foto),
                  'update_at' => date("Y-m-d H:i"),
                  );
    $this->template->view("update",$data);
  }else {
    $this->error404();
  }
}

function update_action($id)
{
  if($this->input->is_ajax_request()){
    if (!is_allowed('pelanggan_update')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $json = array('success' => false);
    $this->form_validation->set_rules("nik","* Nik","trim|xss_clean|required|numeric");
    $this->form_validation->set_rules("nama","* Nama","trim|xss_clean|required|htmlspecialchars");
    $this->form_validation->set_rules("tempat_lahir","* Tempat lahir","trim|xss_clean|required|htmlspecialchars");
    $this->form_validation->set_rules("tanggal_lahir","* Tanggal lahir","trim|xss_clean|required");
    $this->form_validation->set_rules("jenis_kelamin","* Jenis kelamin","trim|xss_clean|required");
    $this->form_validation->set_rules("alamat","* Alamat","trim|xss_clean|required");
    $this->form_validation->set_rules("telepon","* Telepon","trim|xss_clean|required|numeric");
    $this->form_validation->set_rules("foto","* Foto","trim|xss_clean");
    $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

    if ($this->form_validation->run()) {
      $save_data['nik'] = $this->input->post('nik',true);
      $save_data['nama'] = $this->input->post('nama',true);
      $save_data['tempat_lahir'] = $this->input->post('tempat_lahir',true);
      $save_data['tanggal_lahir'] = date("Y-m-d",  strtotime($this->input->post('tanggal_lahir', true)));
      $save_data['jenis_kelamin'] = $this->input->post('jenis_kelamin',true);
      $save_data['alamat'] = $this->input->post('alamat',true);
      $save_data['telepon'] = $this->input->post('telepon',true);
      $save_data['foto'] = $this->imageCopy($this->input->post('foto',true),$_POST['file-dir-foto']);
      $save_data['update_at'] = date("Y-m-d H:i");

      $save = $this->model->change(dec_url($id), $save_data);

      set_message("success",cclang("notif_update"));

      $json['redirect'] = url("pelanggan");
      $json['success'] = true;
    }else {
      foreach ($_POST as $key => $value) {
        $json['alert'][$key] = form_error($key);
      }
    }

    $this->response($json);
  }
}

function delete($id)
{
  if ($this->input->is_ajax_request()) {
    if (!is_allowed('pelanggan_delete')) {
      return $this->response([
        'type_msg' => "error",
        'msg' => "do not have permission to access"
      ]);
    }

      $this->model->remove(dec_url($id));
      $json['type_msg'] = "success";
      $json['msg'] = cclang("notif_delete");


    return $this->response($json);
  }
}


}

/* End of file Pelanggan.php */
/* Location: ./application/modules/pelanggan/controllers/backend/Pelanggan.php */
