<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// .
//                            Admin
// .                         -------
// list method:
// - url (create)
// - add (admin)
//
// .
/**
 *-accounts
 *-url
 *-inbox
 *-generatereport
 */
class Panel extends CI_Controller {

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
//  ---------------------------------------- CREATE ----------------------------------------
//  ======================================== URL ========================================
  public function url(){
    // set data $data untuk view
    $data['header'] = array(
      'tabTitle'  => "Create Short URL {$this->classData['ringkesin']}",
      'tabIcon'   => $this->classData['tabIcon'],
      'active'    => 'url',
    );
    $data['content'] = array(
      'subTitle' => 'Create Short URL',
      'appName'  => $this->classData['appName'],
    );
    // syarat form
		$this->form_validation->set_rules('url', 'URL',           'trim|required|valid_url');
		$this->form_validation->set_rules('custom', 'custom URL', 'trim|alpha_dash|is_unique[tb_url.custom_url]');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if ($this->form_validation->run() == FALSE) {
      $this->load->view('admin/v_header', $data);
  		$this->load->view('admin/v_create', $data);
      $this->load->view('admin/v_footer');
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

//  ======================================== ADMIN ========================================
  public function add(){
    // set data $data untuk view
    $data['header'] = array(
      'tabTitle'  => "Add New Admin {$this->classData['ringkesin']}",
      'tabIcon'   => $this->classData['tabIcon'],
      'active'    => 'add',
    );
    $data['content'] = array(
      'subTitle' => 'Add new admin',
    );
    $this->load->view('admin/v_header', $data);
		$this->load->view('admin/v_add', $data);
    $this->load->view('admin/v_footer');
  }

}


 ?>
