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


class Piutang_model extends MY_Model{

  private $table        = "piutang";
  private $primary_key  = "id";
  private $column_order = array('id_pelanggan', 'waktu_utang', 'jumlah', 'status_pembayaran', 'waktu_bayar');
  private $order        = array('piutang.id'=>"DESC");
  private $select       = "piutang.id,piutang.id_pelanggan,piutang.waktu_utang,piutang.estimasi_bayar,piutang.jumlah,piutang.bunga,piutang.status_pembayaran,piutang.waktu_bayar";

public function __construct()
	{
		$config = array(
      'table' 	      => $this->table,
			'primary_key' 	=> $this->primary_key,
		 	'select' 	      => $this->select,
      'column_order' 	=> $this->column_order,
      'order' 	      => $this->order,
		 );

		parent::__construct($config);
	}

  private function _get_datatables_query()
    {
      $this->db->select($this->select);
      $this->db->from($this->table);
      $this->_get_join();

      if($this->input->post("nik"))
          {
            $this->db->like("pelanggan.nik", $this->input->post("nik"));
          }

    if($this->input->post("id_pelanggan"))
        {
          $this->db->like("pelanggan.nama", $this->input->post("id_pelanggan"));
        }

    if($this->input->post("waktu_utang"))
        {
          $this->db->like("piutang.waktu_utang", date('Y-m-d',strtotime($this->input->post("waktu_utang"))));
        }

        if($this->input->post("estimasi_bayar"))
            {
              $this->db->like("piutang.estimasi_bayar", date('Y-m-d',strtotime($this->input->post("estimasi_bayar"))));
            }

    if($this->input->post("jumlah"))
        {
          $this->db->like("piutang.jumlah", $this->input->post("jumlah"));
        }

    if($this->input->post("status_pembayaran"))
        {
          $this->db->like("piutang.status_pembayaran", $this->input->post("status_pembayaran"));
        }

      if(isset($_POST['order'])) // here order processing
       {
           $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
       }
       else if(isset($this->order))
       {
           $order = $this->order;
           $this->db->order_by(key($order), $order[key($order)]);
       }

    }


    public function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
      $this->db->select($this->select);
      $this->db->from("$this->table");
      $this->_get_join();
      return $this->db->count_all_results();
    }

    public function _get_join()
    {
      $this->db->select("pelanggan.nama,pelanggan.nik");
      $this->db->join("pelanggan","pelanggan.id = piutang.id_pelanggan");
    }

    public function get_detail($id)
    {
        $this->db->select("".$this->table.".*");
        $this->db->from($this->table);
        $this->_get_join();
        $this->db->where("".$this->table.'.'.$this->primary_key,$id);
        $query = $this->db->get();
        if($query->num_rows()>0)
        {
          return $query->row();
        }else{
          return FALSE;
        }
    }

    function pembayaran($id_piutang)
    {
      return $this->db->get_where("pembayaran",["id_piutang" => $id_piutang]);
    }

    function total_pembayaran($id_piutang)
    {
      $this->db->select_sum("jumlah_pembayaran");
      $this->db->from("pembayaran");
      $this->db->where(["id_piutang" => $id_piutang]);
      return $this->db->get()->row()->jumlah_pembayaran;
    }


    function cetak()
    {
      $this->db->select($this->select);
      $this->db->from("$this->table");
      $this->_get_join();
      if($this->input->post("nik"))
          {
            $this->db->like("pelanggan.nik", $this->input->post("nik"));
          }

    if($this->input->post("id_pelanggan"))
        {
          $this->db->like("pelanggan.nama", $this->input->post("id_pelanggan"));
        }

    if($this->input->post("waktu_utang"))
        {
          $this->db->like("piutang.waktu_utang", date('Y-m-d',strtotime($this->input->post("waktu_utang"))));
        }

        if($this->input->post("estimasi_bayar"))
            {
              $this->db->like("piutang.estimasi_bayar", date('Y-m-d',strtotime($this->input->post("estimasi_bayar"))));
            }

    if($this->input->post("jumlah"))
        {
          $this->db->like("piutang.jumlah", $this->input->post("jumlah"));
        }

    if($this->input->post("status_pembayaran"))
        {
          $this->db->like("piutang.status_pembayaran", $this->input->post("status_pembayaran"));
        }
      return $this->db->get()->result();
    }

    function cetakId($id = "")
    {
      $this->db->select("piutang.*,pelanggan.*");
      $this->db->from("$this->table");
      $this->db->join("pelanggan","pelanggan.id = piutang.id_pelanggan");
      $this->db->where("piutang.id","$id");
      return $this->db->get()->row();
    }

}

/* End of file Piutang_model.php */
/* Location: ./application/modules/piutang/models/Piutang_model.php */
