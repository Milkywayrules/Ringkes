<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// .
//                            Admin
// .                         -------
// list method:
// - index
// - profile
// - inbox
// - settings
//
// .

class Home extends CI_Controller {

  function __construct(){
    parent::__construct();
    $this->_mustLoginValidation();
    $this->_adminPrivilegeValidation();
    $this->load->model('M_users');
    $this->load->model('M_url');
  	// inisialisasi variabel kelas global
  	$this->classData = array(
  		'ringkesin'	=> '| Ringkesin: Admin',
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
	private function _adminPrivilegeValidation(){
		// aonly for adminUser
		if ( $this->session->userdata('privilege') != 'adminUser' ) {
			redirect(base_url(), 'refresh');
		}
	}
//
//
//  ======================================== DASHBOARD ========================================
	// public function index(){
  //   // set data $data untuk view
  //   $data['header'] = array(
  //     'tabTitle'  => "Dashboard {$this->classData['ringkesin']}",
  //     'tabIcon'   => $this->classData['tabIcon'],
  //     'active'    => 'dashboard',
  //   );
  //   $data['content'] = array(
  //     'subTitle'    => 'Admin Dashboard',
  //     'totAccounts' => count( $this->M_users->get_all() ),
  //     'totUrl'      => count( $this->M_url->get_all() ),
  //   );
  //   $this->load->view('admin/v_header', $data);
	// 	$this->load->view('admin/v_home', $data);
  //   $this->load->view('admin/v_footer');
	}

//  ======================================== PROFIL ========================================
  // public function profile(){
  //   // set data $data untuk view
  //   $data['header'] = array(
  //     'tabTitle'  => "Profile {$this->classData['ringkesin']}",
  //     'tabIcon'   => $this->classData['tabIcon'],
  //     'active'    => 'profile',
  //   );
  //   $data['content'] = array(
  //     'subTitle' => 'Basic Information',
  //   );
  //   // syarat form
  //   $this->form_validation->set_rules('email', 'E-Mail', 'trim');
  //   $this->form_validation->set_rules('nama', 'Full Name', 'trim');
  //   $this->form_validation->set_rules('phone', 'Phonenumber', 'trim');
  //
	// 	if ($this->form_validation->run() == FALSE) {
	//     $this->load->view('admin/v_header', $data);
	// 		$this->load->view('admin/v_profile', $data);
	//     $this->load->view('admin/v_footer');
	// 	}else {
  //
	// 		$update = $this->M_users->set_info( $this->input->post( 'email' ), $this->input->post( 'nama' ),
	// 		 													$this->input->post( 'phone' ), $this->session->userdata( 'username' ) );
  //     if ($update) {
	// 			$this->session->set_flashdata('success_message', 1);
	// 			$this->session->set_userdata('name', $this->input->post( 'nama' ));
	// 			$this->session->set_userdata('email', $this->input->post( 'email' ));
	// 			$this->session->set_userdata('phone', $this->input->post( 'phone' ));
	// 			redirect(base_url('admin/profile'));
  //     }else {
	// 			$this->session->set_flashdata('failed_message', 1);
	// 			redirect(base_url('admin/profile'));
  //     }
	// 	}
  // }

//  ======================================== INBOX ========================================
  // public function inbox(){
  //   // set data $data untuk view
  //   $data['header'] = array(
  //     'tabTitle'  => "Inbox {$this->classData['ringkesin']}",
  //     'tabIcon'   => $this->classData['tabIcon'],
  //     'active'    => 'inbox',
  //   );
  //   $data['content'] = array(
  //     'subTitle' => 'Admin Inbox',
  //   );
  //   $this->load->view('admin/v_header', $data);
  //   $this->load->view('admin/v_inbox', $data);
  //   $this->load->view('admin/v_footer');
  // }

//  ======================================== SETTINGS ========================================
  // public function settings(){
  //   // set data $data untuk view
  //   $data['header'] = array(
  //     'tabTitle'  => "Profile {$this->classData['ringkesin']}",
  //     'tabIcon'   => $this->classData['tabIcon'],
  //     'active'    => 'settings',
  //   );
  //   $data['content'] = array(
  //     'subTitle' => 'Change Password',
  //   );
  //   $this->load->view('admin/v_header', $data);
	// 	$this->load->view('admin/v_settings', $data);
  //   $this->load->view('admin/v_footer');
  // }


}
