<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| ----------------------------------------------------------------------
|  (ADMIN) Manage.php
| ----------------------------------------------------------------------
| There are 3 sections in this class and
| these are list of the methods:
|
| 1.
| 2.
| 3.
| 4.
| 5.
|
*/
/**
 *-accounts
 *-url
 *-inbox
 *-generatereport
 */
class Manage2 extends CI_Controller {

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
//  ======================================== ACCOUNTS MANAGEMENT ========================================
  // public function accounts(){
  //   // set data $data untuk view
  //   $data['header'] = array(
  //     'tabTitle'    => "Account Management {$this->classData['ringkesin']}",
  //     'tabIcon'     => $this->classData['tabIcon'],
  //     'active'      => 'manageAccounts',
  //     'dataTables'  => '1',
  //   );
  //   $data['content'] = array(
  //     'subTitle'    => 'Account Management',
  //     'totAccount'  => $this->M_users->get_all(),
  //   );
  //   $data['footer'] = array(
  //     'dataTables'  => '1',
  //   );
  //
  //   $this->load->view('admin/v_header', $data);
  //   $this->load->view('admin/v_accounts', $data);
  //   $this->load->view('admin/v_footer');
  // }
//  ======================================== URL MANAGEMENT ========================================
  // public function url(){
  //   // set data $data untuk view
  //   $data['header'] = array(
  //     'tabTitle'    => "Link (URL) Management {$this->classData['ringkesin']}",
  //     'tabIcon'     => $this->classData['tabIcon'],
  //     'active'      => 'manageUrl',
  //     'dataTables'  => '1',
  //   );
  //   $data['content'] = array(
  //     'subTitle'  => 'Link (URL) Management',
  //     'totUrl'    => $this->M_url->get_all(),
  //   );
  //   $data['footer'] = array(
  //     'dataTables'  => '1',
  //   );
  //
  //   $this->load->view('admin/v_header', $data);
  //   $this->load->view('admin/v_url', $data);
  //   $this->load->view('admin/v_footer');
  // }

  // public function generatereport(){
  //   $data['header'] = array(
  //     'tabTitle' => 'Report Admin',
  //     'tabIcon'  => $this->classData['tabIcon'],
  //     'active'   => 'manageGeneratereport',
  //   );
  //   $data = array(
  //     'subTitle' => 'Admin Report',
  //   );
  //   $this->load->view('admin/v_header', $data);
  //   $this->load->view('admin/v_report', $data);
  //   $this->load->view('admin/v_footer');
  // }


}


 ?>
