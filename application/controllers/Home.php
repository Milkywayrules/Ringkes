<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// .
//                            User
// .                         ------
// list method:
// - index
//
// .

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
    // inisialisasi variabel kelas global
    $this->classData = array(
      'ringkesin'	=> '| Ringkesin',
      'tabIcon'   => base_url("assets/img/logo/mainicon.png"),
      'appName'   => 'ringkesin',
    );
	}
//
//
//  ======================================== HOMEPAGE ========================================
	public function index()
	{
    // set data $data untuk view
		$data['header'] = array(
			'tabTitle' 	=> "Homepage {$this->classData['ringkesin']}",
			'tabIcon'		=> base_url("assets/img/logo/mainicon.png"),
		);
		// echo $this->bcrypt->hash_password('hmif');die();
		// syarat form
		$this->form_validation->set_rules('url', 'URL', 					'trim|required|valid_url');
		$this->form_validation->set_rules('custom', 'custom URL', 'trim|alpha_dash|is_unique[tb_url.custom_url]');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('v_home_bulma', $data);

		}else {
			// $this->load->view('v_home');
			$this->session->set_flashdata('createUrl', $this->input->post('url'));
			if ($this->input->post('custom') == '') {
				$this->session->set_flashdata('createCustom', 'ringkesin_url_custom_');
			}else{
				$this->session->set_flashdata('createCustom', $this->input->post('custom'));
			}
			redirect('short/create');
		}
	}

}
