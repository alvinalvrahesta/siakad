<?php

class Dosen_model extends CI_Model{
	/*public $table = 'dosen';
	public $id = 'id_dosen';
	public $order = 'DESC';

	public function tampil_data($table)
	{
		return $this->db->get($table);
	}
	public function ambil_id_dosen($id)
	{
		$hasil = $this->db->where('id',$id)->get('dosen');
		if($hasil->num_rows() > 0){
			return $hasil->result();
		}else{
			return false;
		}
	}

	public function insert_data($data,$table)
	{
		$this->db->insert($table,$data);
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($where,$table)
	{
		$this->db->where($where);
		$this->db->update($table);
	}*/
}