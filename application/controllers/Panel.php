<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// .
//                            User
// .                         ------
// list method:
// - dashboard
// - create url
// - inbox
// - profile
// - settings
//
// .

class Panel extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->_mustLoginValidation();
		$this->_basicPrivilegeValidation();
		$this->load->model('M_url');
		$this->load->model('M_users');
		// inisialisasi variabel kelas global
		$this->classData = array(
			'ringkesin'	=> '| Ringkesin',
      'tabIcon'   => base_url("assets/img/logo/mainicon.png"),
      'appName'   => 'ringkesin',
		);
	}
// ======================================== VALIDASI LOGIN DAN PRIVILEGE ========================================
	private function _mustLoginValidation(){
		// harus login
		// kalau belum redirect ke home
		if ( $this->session->userdata('isLogin') == 0 ) {
			redirect(base_url(), 'refresh');
		}
	}
	private function _basicPrivilegeValidation(){
		// aonly for basicUser and premiumUser
		if ( $this->session->userdata('privilege') == 'adminUser' ) {
			redirect(base_url(), 'refresh');
		}
	}
//
//
// menu navbar kiri
//  ======================================== DASHBOARD ========================================
	public function dashboard(){
		// set data $data untuk view
		$data['header'] = array(
      'tabTitle' 	=> "Dashboard {$this->classData['ringkesin']}",
			'tabIcon'		=> $this->classData['tabIcon'],
      'active' 		=> 'dashboard',
    );
    $data['content'] = array(
      'subTitle' 			=> 'Dashboard User',
			'totUrl' 				=> count( $this->M_url->get_all_by_username($this->session->userdata('username')) ),
			'totUrlCustom' 	=> count( $this->M_url->get_all_custom_by_username($this->session->userdata('username')) ),
    );
		$this->load->view('v_header', $data);
		$this->load->view('v_dashboard', $data);
		$this->load->view('v_footer');
	}

// ======================================== CREATE RINGKES URL ========================================
	public function create(){
		// set data $data untuk view
    $data['header'] = array(
      'tabTitle' 	=> "Create {$this->classData['ringkesin']}",
			'tabIcon'		=> $this->classData['tabIcon'],
      'active' 		=> 'create',
    );
    $data['content'] = array(
      'subTitle' => 'Create',
    );
		// syarat form
		$this->form_validation->set_rules('url', 'URL', 					'trim|required|valid_url');
		$this->form_validation->set_rules('custom', 'custom URL', 'trim|alpha_dash|is_unique[tb_url.custom_url]');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('v_header', $data);
			$this->load->view('v_create', $data);
			$this->load->view('v_footer');
		}else {
			$this->session->set_flashdata('createUrl', $this->input->post('url'));
			if ($this->input->post('custom') == '') {
				$this->session->set_flashdata('createCustom', 'ringkesin_url_custom_');
			}else{
				$this->session->set_flashdata('createCustom', $this->input->post('custom'));
			}
			redirect('short/create');
		}
  }

// menu sebelah kanan atas
// ======================================== INBOX ========================================
	public function inbox(){
		// set data $data untuk view
		$data['header'] = array(
			'tabTitle' 	=> "Inbox {$this->classData['ringkesin']}",
			'tabIcon'		=> $this->classData['tabIcon'],
			'active' 		=> 'inbox',
		);
		$data['content'] = array(
			'subTitle' => 'User inbox',
		);
		$this->load->view('v_header', $data);
		$this->load->view('v_inbox', $data);
		$this->load->view('v_footer');
	}

// ======================================== PROFILE ========================================
	public function profile(){
		// set data $data untuk view
    $data['header'] = array(
      'tabTitle' 	=> "Profile {$this->classData['ringkesin']}",
			'tabIcon'		=> $this->classData['tabIcon'],
      'active' 		=> 'profile',
    );
    $data['content'] = array(
      'subTitle' => 'Profile',
    );
		// syarat form
		$this->form_validation->set_rules('email', 'E-Mail', 'trim');
		$this->form_validation->set_rules('nama', 'Full Name', 'trim');
		$this->form_validation->set_rules('phone', 'Phonenumber', 'trim');

		if ($this->form_validation->run() == FALSE) {
	    $this->load->view('v_header', $data);
			$this->load->view('v_profile', $data);
	    $this->load->view('v_footer');
		}else {

			$update = $this->M_users->set_info( $this->input->post( 'email' ), $this->input->post( 'nama' ),
			 																		$this->input->post( 'phone' ), $this->session->userdata( 'username' ) );
      if ($update) {
				$this->session->set_flashdata('success_message', 1);
				$this->session->set_flashdata('title', "Profile changes saved !");
				$this->session->set_flashdata('text', 'Enjoy your time with pendekin');
				$this->session->set_userdata('name', $this->input->post( 'nama' ));
				$this->session->set_userdata('email', $this->input->post( 'email' ));
				$this->session->set_userdata('phone', $this->input->post( 'phone' ));
				redirect(base_url('u/profile'));
      }else {
				$this->session->set_flashdata('failed_message', 1);
				$this->session->set_flashdata('title', "Profile changes error !");
				$this->session->set_flashdata('text', 'Please check again or contact us');
				redirect(base_url('u/profile'));
      }
		}
  }
// ======================================== SETTINGS ========================================
	public function settings(){
		// set data $data untuk view
    $data['header'] = array(
      'tabTitle' 	=> "Settings {$this->classData['ringkesin']}",
			'tabIcon'		=> $this->classData['tabIcon'],
      'active' 		=> 'settings',
    );
    $data['content'] = array(
      'subTitle' => 'Settings',
    );
		$this->load->view('v_header', $data);
		$this->load->view('v_settings', $data);
		$this->load->view('v_footer');
  }


}
