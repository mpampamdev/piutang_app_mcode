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


class Pelanggan_model extends MY_Model{

  private $table        = "pelanggan";
  private $primary_key  = "id";
  private $column_order = array('nik', 'nama', 'jenis_kelamin', 'telepon', 'foto');
  private $order        = array('pelanggan.id'=>"DESC");
  private $select       = "pelanggan.id,pelanggan.nik,pelanggan.nama,pelanggan.jenis_kelamin,pelanggan.telepon,pelanggan.foto";

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

    if($this->input->post("nik"))
        {
          $this->db->like("pelanggan.nik", $this->input->post("nik"));
        }

    if($this->input->post("nama"))
        {
          $this->db->like("pelanggan.nama", $this->input->post("nama"));
        }

    if($this->input->post("jenis_kelamin"))
        {
          $this->db->where("pelanggan.jenis_kelamin", $this->input->post("jenis_kelamin"));
        }

    if($this->input->post("telepon"))
        {
          $this->db->like("pelanggan.telepon", $this->input->post("telepon"));
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
      return $this->db->count_all_results();
    }



}

/* End of file Pelanggan_model.php */
/* Location: ./application/modules/pelanggan/models/Pelanggan_model.php */
