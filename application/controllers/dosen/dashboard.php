<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('Dosen_model');
    }

    public function index()
    {
        $mydata = $this->Admin_model->getuserid($this->session->userdata('userid'));
        $data['myuser'] = $mydata;

        $data['title'] = 'Dashboard Dosen';

        $this->load->view('wrapper/header', $data);
        $this->load->view('wrapper/dosen_sidebar', $data);
        $this->load->view('dosen/dashboard', $data);
        $this->load->view('wrapper/footer');
    }

    public function dosenview()
	{
		$username=$this->session->userdata('username');

		$data = array(
			'dosen'=>$this->Dosen_model->tampil_data($username),
			'makuls'=>$this->Admin_model->getAll('matakuliah')->result(),
			);
		$this->load->view('wrapper/header');
		$this->load->view('wrapper/dosen_sidebar');
		$this->load->view('dosen/dosenview',$data,FALSE);
		$this->load->view('wrapper/footer');
	}

    public function insert_makul()
    {
        $nrp = $this->input->post('nrp');
        $id_makul = $this->input->post('id_makul');

        $data = array(
            'nrp' => $nrp,
            'id_makul' => $id_makul,
        );
        $data = $this->Admin_model->Insert('dosen', $data);
        redirect(base_url('dosen/dashboard/dosenview'), 'refresh');
    }

}
