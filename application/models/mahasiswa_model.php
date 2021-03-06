<?php

class Mahasiswa_model extends CI_Model{

	public function tampil_data($userid)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('mahasiswa', 'mahasiswa.nim = users.userid', 'left');
		$this->db->join('matakuliah', 'matakuliah.id_makul = mahasiswa.id_makul', 'left');
		$this->db->where('userid', $userid);
		return $this->db->get()->result();
	}

	public function makul()
	{
		$this->db->select('*');
		$this->db->from('matakuliah');
		return $this->db->get()->result();
	}

	public function insert_makul($data)
	{
		$this->db->insert('mahasiswa', $data);
	}

	public function update_makul($data)
	{
		$this->db->where('id_mhs', $data['id_mhs']);
		$this->db->update('mahasiswa', $data);
	}

	public function delete_makul($data)
	{
		$this->db->where('id_mhs', $data['id_mhs']);
		$this->db->delete('mahasiswa', $data);
	}

	public function tampil_profil($userid)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('userid', $userid);
		return $this->db->get()->first_row();
	}

	public function edit_profil($userid)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('userid', $userid);
		return $this->db->get()->first_row();
	}

	public function update_profil($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('users', $data);
	}

	public function getdatatableby($table, $by, $userid)
    {
        return $this->db->get_where($table, [$by => $userid])->row_array();
    }
	
    public function update($table, $data, $where)
    {
        return $this->db->update($table, $data, $where);
    }

	public function ambil_id_mahasiswa($id)
	{
		// $hasil = $this->db->where('id',$id)->('mahasiswa');
		// if($hasil->num_rows() > 0){
		// 	return $hasil->result();
		// }else{
		// 	return false;
		// }
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
	}
	
}
