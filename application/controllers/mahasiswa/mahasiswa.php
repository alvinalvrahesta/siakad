<?php

class Mahasiswa extends CI_Controller{

	public function index()
	{
		//$data['mahasiswa'] = $this->mahasiswa_model->tampil_data('mahasiswa')->result();
		//$data['prodi'] = $this->prodi_model->tampil_data('profiler_no_db')->result();
		$this->load->view('wrapper/mahasiswa_header');
		$this->load->view('wrapper/mahasiswa_sidebar');
		$this->load->view('mahasiswa/mahasiswa');//$this->load->view('mahasiswa/mahasiswa', $data);
		$this->load->view('wrapper/mahasiswa_footer');
	}

	public function detail($id)
	{
		$data['detail'] = $this->mahasiswa_model->ambil_id_mahasiswa($id);
		$this->load->view('templates_administrator/header');
		$this->load->view('templates_administrator/sidebar');
		$this->load->view('administrator/mahasiswa_detail',$data);
		$this->load->view('templates_administrator/footer');
	}

	public function tambah_mahasiswa()
	{
		$data['prodi'] = $this->mahasiswa_model->tampil_data('prodi')->result();
		$this->load->view('templates_administrator/header');
		$this->load->view('templates_administrator/sidebar');
		$this->load->view('administrator/mahasiswa_form',$data);
		$this->load->view('templates_administrator/footer');
	}

	public function tambah_mahasiswa_aksi()
	{
		$this->_rules();

		if($this->form_validation->run() == FALSE) {
			$this->tambah_mahasiswa();
		}
		else{
			$nim = $this->input->post('nim');
			$nama_lengkap = $this->input->post('nama_lengkap');
			$alamat = $this->input->post('alamat');
			$email = $this->input->post('email');
			$telepon = $this->input->post('telepon');
			$tempat_lahir = $this->input->post('tempat_lahir');
			$tanggal_lahir = $this->input->post('tanggal_lahir');
			$jenis_kelamin = $this->input->post('jenis_kelamin');
			$nama_prodi = $this->input->post('nama_prodi');
			$photo = $_FILES['photo'];
			if ($photo=''){}else{
				$config['upload_path'] = './assets/uploads';
				$config['allowed_path'] = '.jpg|png|gif|tiff';

				$this->load->library('upload',$config);
				if(!$this->upload->do_upload('photo')){
					echo "Gagal Upload"; die();
				}else{
					$photo=$this->upload->data('file_name');
				}
			}

			$data = array();
			/*	'nim' = $nim,
				'nama_lengkap' = $nama_lengkap,
				'alamat' = $alamat,
				'email' = $email,
				'telepon' = $telepon,
				'tempat_lahir' = $tempat_lahir,
				'tanggal_lahir' = $tanggal_lahir,
				'jenis_kelamin' = $jenis_kelamin,
				'nama_prodi' = $nama_prodi,
				'photo' = $photo
			);*/

			$this->mahasiswa_model->insert_data($data,'mahasiswa');
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
				Data Mahasiswa Berhasil Ditambahkan!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span
				aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('administrator/Mahasiswa');
		}
	}


	public function update($id)
	{
		$where = array('id' => $id);

		$data['mahasiswa'] = $this->db->query("select * form mahasiswa mhs, prodi prd where mhs.nama_prodi=prd.nama_prodi and mhs.id='$id'")->result();
		$data['prodi'] = $this->matakuliah_model->tampil_data('prodi')->result();
		$data['detail'] = $this->mahasiswa_model->ambil_id_mahasiswa($id);
		$this->load->view('templates_administrator/header');
		$this->load->view('templates_administrator/sidebar');
		$this->load->view('administrator/mahasiswa_update',$data);
		$this->load->view('templates_administrator/footer');
	}

	public function update_mahasiswa_aksi()
	{
		$this->_rules();

		if($this->form_validation->run() == FALSE)
		{
			$this->update();
		}else{
			$id = $this->input->post('id');
			$nim = $this->input->post('nim');
			$nama_lengkap = $this->input->post('nama_lengkap');
			$alamat = $this->input->post('alamat');
			$email = $this->input->post('email');
			$telepon = $this->input->post('telepon');
			$tempat_lahir = $this->input->post('tempat_lahir');
			$tanggal_lahir = $this->input->post('tanggal_lahir');
			$jenis_kelamin = $this->input->post('jenis_kelamin');
			$nama_prodi = $this->input->post('nama_prodi');
			$photo = $_FILES['userfile']['name'];

			if ($photo){
				$config['upload_path'] = './assets/uploads';
				$config['allowed_path'] = '.jpg|png|gif|tiff';

				$this->load->library('upload',$config);
				if(!$this->upload->do_upload('userfile')){
					$userfile = $this->upload->data('file_name');
					$this->db->set('photo', $userfile);
				}else{
					echo "Gagal Upload";
				}
			}

			$data = array(
				'nim' =>$nim,
				'nama_lengkap' =>$nama_lengkap,
				'alamat' =>$alamat,
				'email' =>$email,
				'telepon' =>$telepon,
				'tempat_lahir' =>$tempat_lahir,
				'tanggal_lahir' =>$tanggal_lahir,
				'jenis_kelamin' =>$jenis_kelamin,
				'nama_prodi' =>$nama_prodi,
				'photo' =>$photo
			);

			$where = array (
				'id' => $id
			);

			$this->mahasiswa_model->update_data($data,'mahasiswa');
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
				Data Mahasiswa Berhasil Diupdate!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span
				aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('administrator/Mahasiswa');
		}
	}

	public function delete($id)
	{
		$where = array('id' => $id);
		$this->mahasiswa_model->hapus_data($where,'mahasiswa');
		$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dimissible fade show" role="alert">
			Data Mahasiswa Berhasil Dihapus!
			<button type="button" class="close"
			data-dimiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
		redirect('administrator/mahasiswa');
	}

	public function _rules()
	{
		$this->form_Validation->set_rules('nim','Nim','required',['required' => 'NIM wajib diisi']);
		$this->form_Validation->set_rules('nama_lengkap','Nama Lengkap','required',['required' => 'Nama Lengkap wajib diisi']);
		$this->form_Validation->set_rules('alamat','Alamat','required',['required' => 'Alamat wajib diisi']);
		$this->form_Validation->set_rules('email','Email','required',['required' => 'Email wajib diisi']);
		$this->form_Validation->set_rules('telepon','Telepon','required',['required' => 'Nomor Telepon wajib diisi']);
		$this->form_Validation->set_rules('tempat_lahir','Tempat Lahir','required',['required' => 'Tempat Lahir wajib diisi']);
		$this->form_Validation->set_rules('tanggal_lahir','Tanggal Lahir','required',['required' => 'Tanggal Lahir wajib diisi']);
		$this->form_Validation->set_rules('jenis_kelamin','Jenis Kelamin','required',['required' => 'Jenis Kelamin wajib diisi']);
		$this->form_Validation->set_rules('nama-prodi','Nama Prodi','required',['required' => 'Nama Prodi wajib diisi']);
	}
}
