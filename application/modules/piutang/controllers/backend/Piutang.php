<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*| --------------------------------------------------------------------------*/
/*| dev : mpampamdev  */
/*| version : V.0.0.2 */
/*| facebook : https://web.facebook.com/mpampam */
/*| fanspage : https://web.facebook.com/programmerjalanan */
/*| instagram : https://www.instagram.com/programmer_jalanan */
/*| youtube : https://www.youtube.com/channel/UC1TlTaxRNdwrCqjBJ5zh6TA */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 03/03/2021 21:58*/
/*| Please DO NOT modify this information*/


class Piutang extends Backend{

private $title = "Data Piutang";


public function __construct()
{
  $config = array(
    'title' => $this->title,
   );
  parent::__construct($config);
  $this->load->model("Piutang_model","model");
}

function index()
{
  $this->is_allowed('piutang_list');
  $this->template->set_title($this->title);
  $this->template->view("index");
}

function json()
{
  if ($this->input->is_ajax_request()) {
    if (!is_allowed('piutang_list')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $list = $this->model->get_datatables();
    $data = array();
    foreach ($list as $row) {
        $rows = array();
        $total_percent = ($row->bunga/100) * $row->jumlah;
        $total = $row->jumlah+$total_percent;
                $rows[] = "<i class='fa fa-id-card'></i> <a href=".url("pelanggan/detail/".enc_url($row->id_pelanggan))." target='_blank'>".$row->nik."</a> <br><i class='fa fa-user'></i> ".$row->nama;
                $rows[] = date("d-m-Y H:i",  strtotime($row->waktu_utang));
                $rows[] = date("d-m-Y",  strtotime($row->estimasi_bayar));
                $rows[] = "Rp." . number_format("$row->jumlah", 0, "", ".");
                $rows[] = "Rp." . number_format("$total_percent", 0, "", ".")." <span class='text-success'>(".$row->bunga."%)</span>";
                $rows[] = "Rp." . number_format("$total", 0, "", ".");
                $rows[] = $row->status_pembayaran == "belum" ? '<span class="badge badge-danger">Belum Lunas</span>':'<span class="badge badge-success">Lunas</span>';
        $rows[] = '
                  <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="'.url("piutang/detail/".enc_url($row->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
                        <i class="mdi mdi-file"></i>
                      </a>
                      <a href="'.url("piutang/update/".enc_url($row->id)).'" id="update" class="btn btn-warning" title="'.cclang("update").'">
                        <i class="ti-pencil"></i>
                      </a>
                      <a href="'.url("piutang/cetakPelanggan/".enc_url($row->id)).'" id="update" class="btn btn-success" title="Cetak" target="_blank">
                        <i class="ti-printer"></i>
                      </a>
                      <a href="'.url("piutang/delete/".enc_url($row->id)).'" id="delete" class="btn btn-danger" title="'.cclang("delete").'">
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

function filter()
{
  if(!is_allowed('piutang_filter'))
  {
    echo "access not permission";
  }else{
    $this->template->view("filter",[],false);
  }
}

function detail($id)
{
  $this->is_allowed('piutang_detail');
    if ($row = $this->model->get_detail(dec_url($id))) {
    $this->template->set_title("Detail ".$this->title);
    $total_pembayaran = $this->model->total_pembayaran(dec_url($id));
    $total_pembayarans = $total_pembayaran == "" ? 0:$total_pembayaran;

    $total_percent = ($row->bunga/100) * $row->jumlah;
    $total = $row->jumlah+$total_percent;

    if ($total_pembayarans >= $total) {
      $this->db->update('piutang', ["status_pembayaran" => "sudah"],['id'=>dec_url($id)]);
      $status = "sudah";
    }else {
      $this->db->update('piutang', ["status_pembayaran" => "belum"],['id'=>dec_url($id)]);
      $status = "belum";
    }

    $data = array(
          "id" => $id,
          "id_pelanggan" => $row->id_pelanggan,
          "nik" => $row->nik,
          "nama" => $row->nama,
          "waktu_utang" => $row->waktu_utang,
          "estimasi_bayar" => $row->estimasi_bayar,
          "jumlah" => $row->jumlah,
          "status_pembayaran" => $status,
          "bunga" => $row->bunga,
          "keterangan" => $row->keterangan,
          "pembayaran" => $this->model->pembayaran(dec_url($id)),
          "total_pembayaran" => $total_pembayarans
    );
    $this->template->view("view",$data);
  }else{
    $this->error404();
  }
}

function add()
{
  $this->is_allowed('piutang_add');
  $this->template->set_title(cclang("add")." ".$this->title);
  $data = array('action' => url("piutang/add_action"),
                  'id_pelanggan' => set_value("id_pelanggan"),
                  'waktu_utang' => set_value("waktu_utang"),
                  'jumlah' => set_value("jumlah"),
                  'bunga' => set_value("bunga"),
                  'keterangan' => set_value("keterangan"),
                  );
  $this->template->view("add",$data);
}

function add_action()
{
  if($this->input->is_ajax_request()){
    if (!is_allowed('piutang_add')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $json = array('success' => false);
    $this->form_validation->set_rules("id_pelanggan","* Data Pelanggan","trim|xss_clean|required");
    $this->form_validation->set_rules("waktu_utang","* Waktu Pemberian Utang","trim|xss_clean|required");
    $this->form_validation->set_rules("estimasi_bayar","* Estimasi Waktu Pembayaran","trim|xss_clean|required");
    $this->form_validation->set_rules("jumlah","* Jumlah","trim|xss_clean|required|numeric");
    $this->form_validation->set_rules("bunga","* Bunga","trim|xss_clean|required|numeric");
    $this->form_validation->set_rules("keterangan","* Keterangan","trim|xss_clean");
    $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

    if ($this->form_validation->run()) {
      $save_data['id_pelanggan'] = $this->input->post('id_pelanggan',true);
      $save_data['waktu_utang'] = date("Y-m-d H:i",  strtotime($this->input->post('waktu_utang', true)));
      $save_data['estimasi_bayar'] = date("Y-m-d",  strtotime($this->input->post('estimasi_bayar', true)));
      $save_data['jumlah'] = $this->input->post('jumlah',true);
      $save_data['bunga'] = $this->input->post('bunga',true);
      $save_data['keterangan'] = $this->input->post('keterangan',true);

      $this->model->insert($save_data);

      set_message("success",cclang("notif_save"));
      $json['redirect'] = url("piutang");
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
  $this->is_allowed('piutang_update');
  if ($row = $this->model->get_detail(dec_url($id))) {
    $this->template->set_title(cclang("update")." ".$this->title);
    $data = array('action' => url("piutang/update_action/$id"),
                  'nik' => set_value("nik", $row->nik),
                  'nama' => set_value("nama", $row->nama),
                  'waktu_utang' => date("Y-m-d",  strtotime($row->waktu_utang))."T".date("H:i",  strtotime($row->waktu_utang)),
                  'estimasi_bayar' => date("Y-m-d",  strtotime($row->estimasi_bayar)),
                  'jumlah' => set_value("jumlah", $row->jumlah),
                  'bunga' => set_value("bunga", $row->bunga),
                  'keterangan' => set_value("keterangan", $row->keterangan),
                  );
    $this->template->view("update",$data);
  }else {
    $this->error404();
  }
}

function update_action($id)
{
  if($this->input->is_ajax_request()){
    if (!is_allowed('piutang_update')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $json = array('success' => false);
    // $this->form_validation->set_rules("id_pelanggan","* Data Pelanggan","trim|xss_clean|required");
    $this->form_validation->set_rules("waktu_utang","* Waktu Pemberian Utang","trim|xss_clean|required");
    $this->form_validation->set_rules("estimasi_bayar","* Estimasi Waktu Pembayaran","trim|xss_clean|required");
    $this->form_validation->set_rules("jumlah","* Jumlah","trim|xss_clean|required|numeric");
    $this->form_validation->set_rules("bunga","* Bunga","trim|xss_clean|required|numeric");
    $this->form_validation->set_rules("keterangan","* Keterangan","trim|xss_clean");
    $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

    if ($this->form_validation->run()) {
      // $save_data['id_pelanggan'] = $this->input->post('id_pelanggan',true);
      $save_data['waktu_utang'] = date("Y-m-d H:i",  strtotime($this->input->post('waktu_utang', true)));
      $save_data['estimasi_bayar'] = date("Y-m-d",  strtotime($this->input->post('estimasi_bayar', true)));
      $save_data['jumlah'] = $this->input->post('jumlah',true);
      $save_data['bunga'] = $this->input->post('bunga',true);
      $save_data['keterangan'] = $this->input->post('keterangan',true);

      $save = $this->model->change(dec_url($id), $save_data);

      set_message("success",cclang("notif_update"));

      $json['redirect'] = url("piutang");
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
    if (!is_allowed('piutang_delete')) {
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

function cetak($status = "")
{
  // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdf');


        // title dari pdf
        $this->data['title_pdf'] = 'Laporan Piutang Pelanggan';
        $this->data['piutang'] = $this->model->cetak($status);

        // filename dari pdf ketika didownload
        $file_pdf = 'Laporan Piutang Pelanggan';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

		      $html = $this->load->view('laporan_pdf',$this->data, true);

        // run dompdf
        $this->pdf->generate($html, $file_pdf,$paper,$orientation);
}

function cetakPelanggan($id)
{
  // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdf');
        $total_pembayaran = $this->model->total_pembayaran(dec_url($id));
        $total_pembayarans = $total_pembayaran == "" ? 0:$total_pembayaran;

        // title dari pdf
        $this->data['title_pdf'] = 'Data Piutang Pelanggan';
        $this->data['dt'] = $this->model->cetakId(dec_url($id));
        $this->data['total_pembayaran'] = $total_pembayarans;
        $this->data["pembayaran"] = $this->model->pembayaran(dec_url($id));
        // filename dari pdf ketika didownload
        $file_pdf = 'Data Piutang Pelanggan';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

		      $html = $this->load->view('laporan_pdf_id',$this->data, true);

        // run dompdf
        $this->pdf->generate($html, $file_pdf,$paper,$orientation);
}


function tambahPembayaran($id)
{
  $this->is_allowed('piutang_add_pembayaran');
  $this->template->set_title(cclang("add")." ".$this->title);
  $data = array('action' => url("piutang/tambahPembayaranAction/$id"));
  $this->template->view("add_pembayaran",$data,false);
}

function tambahPembayaranAction($id)
{
  if($this->input->is_ajax_request()){
    if (!is_allowed('piutang_add_pembayaran')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $json = array('success' => false);
    $this->form_validation->set_rules("waktu_bayar","* Waktu Bayar","trim|xss_clean|required");
    $this->form_validation->set_rules("jumlah_pembayaran","* Jumlah Pembayaran","trim|xss_clean|required|numeric");
    $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

    if ($this->form_validation->run()) {
      $save_data['id_piutang'] = dec_url($id);
      $save_data['waktu_pembayaran'] = date("Y-m-d H:i",  strtotime($this->input->post('waktu_bayar', true)));
      $save_data['jumlah_pembayaran'] = $this->input->post('jumlah_pembayaran',true);

      $this->db->insert("pembayaran",$save_data);

      set_message("success",cclang("notif_save"));
      $json['redirect'] = url("piutang/detail/$id");
      $json['success'] = true;
    }else {
      foreach ($_POST as $key => $value) {
        $json['alert'][$key] = form_error($key);
      }
    }

    $this->response($json);
  }
}

function hapusPembayaran($id)
{
  if ($this->input->is_ajax_request()) {
    if (!is_allowed('piutang_pembayaran_delete')) {
      return $this->response([
        'type_msg' => "error",
        'msg' => "do not have permission to access"
      ]);
    }

      $this->db->where('id', dec_url($id));
      $this->db->delete("pembayaran");
      set_message("success",cclang("notif_delete"));
      $json['success'] = true;
    return $this->response($json);
  }
}

}

/* End of file Piutang.php */
/* Location: ./application/modules/piutang/controllers/backend/Piutang.php */
