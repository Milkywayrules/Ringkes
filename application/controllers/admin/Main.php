<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| ----------------------------------------------------------------------
|  (ADMIN) Manage.php
| ----------------------------------------------------------------------
| There are 2 sections in this class and
| these are list of the methods:
|
| 1.
| 2.
| 3.
| 4.
| 5.
|
*/
class Main extends CI_Controller {

  function __construct(){
    parent::__construct();
    $this->_mustLoginValidation();
    // $this->_adminPrivilegeValidation();
    $this->load->model('M_users');
    $this->load->model('M_url');
    // inisialisasi variabel kelas global
    $this->classData = array(
      'ringkesin'	=> '| Ringkesin: Admin',
      'tabIcon'   => base_url("assets/img/logo/mainicon.png"),
      'appName'   => SITE_NAME,
    );
    $this->class = 'main';
  }


  /*
  | ----------------------------------------------------------------------
  |  I/II | (ADMIN) VALIDATION
  | ----------------------------------------------------------------------
  | These are the methods in this section:
  |
  | 1. _mustLoginValidation()
  | 2. _adminPrivilegeValidation()
  |
  |
  | ----------------------------------------------------------------------
  */

  /** (1/2)
   * ============================== VALIDASI LOGIN ==================
   * validasi status login, bahwa hanya user yang untuk user yang
   * sudah berhasil login,selain itu redirect ke home.
   * @return location redirect ke home
   */
  private function _mustLoginValidation(){
    ($this->session->userdata('isLogin') == 1) ?: (redirect(base_url(), 'refresh'));
	}

  /** (2/2)
   * ============================== VALIDASI PRIVILEGE ==============
   * validasi hak akses atau privilege atau permissions, bahwa hanya
   * untuk 'adminUser', selain itu redirect ke home.
   * @return location redirect ke home
   */
	private function _adminPrivilegeValidation(){
    ($this->session->userdata('privilege') == 'adminUser') ?: (redirect(base_url(), 'refresh'));
	}


  /*
  | ----------------------------------------------------------------------
  |  II/II | (ADMIN) ACC CUSTOMIZATION
  | ----------------------------------------------------------------------
  | These are the methods in this section:
  |
  | 1. dashboard()
  | 2. profile()
  | 3. inbox()
  | 4. settings()
  |
  |
  | ----------------------------------------------------------------------
  */

  //  ============================== INBOX ==========================
  public function dashboard(){
    // set data $data untuk view
    $data['header'] = array(
      'tabTitle'  => "Dashboard {$this->classData['ringkesin']}",
      'tabIcon'   => $this->classData['tabIcon'],
      'active'    => 'dashboard',
    );
    $data['content'] = array(
      'subTitle'    => 'Admin Dashboard',
      'totAccounts' => count( $this->M_users->get_all() ),
      'totUrl'      => count( $this->M_url->get_all() ),
    );
    $this->load->view('admin/v_header', $data);
		$this->load->view('admin/v_home', $data);
    $this->load->view('admin/v_footer');
  }



  // ============================== PROFILE =========================
  public function profile(){
    // set data $data untuk view
    $data['header'] = array(
      'tabTitle'  => "Profile {$this->classData['ringkesin']}",
      'tabIcon'   => $this->classData['tabIcon'],
      'active'    => "{$this->class}/profile",
    );
    $data['content'] = array(
      'subTitle' => 'Basic Information',
      'user'     => (object)$this->session->userdata(),
    );
    // syarat form
    $this->form_validation->set_rules('email', 'E-Mail', 'trim');
    $this->form_validation->set_rules('fullname', 'Full Name', 'trim');
    $this->form_validation->set_rules('phone_number', 'phone_number', 'trim');

		if ($this->form_validation->run() == FALSE) {
	    $this->load->view('admin/v_header', $data);
			$this->load->view('admin/v_profile', $data);
	    $this->load->view('admin/v_footer');

		}else {
      // set parameter dengan key dan value untuk update data
      $params = array(
        'email'         => $this->input->post('email'),
        'fullname'      => $this->input->post('fullname'),
        'phone_number'  => $this->input->post('phone_number'),
      );
      // set kondisi dengan key dan value untuk update data
      $where = array( 'username' => $this->session->userdata('username') );
      // lakukan update, jika berhasil = 1, jika gagal = 0
			$update = $this->M_users->set_update_admin_profile($params, $where);

      if ($update) {
        // flashdata untuk sweetalert
				$this->session->set_flashdata('success_message', 1);
        $this->session->set_flashdata('title', "Update profile success!");
        $this->session->set_flashdata('text', 'Enjoy with your new profile');
        // update session dengan data yg sudah update
				$this->session->set_userdata('fullname', $this->input->post('fullname'));
				$this->session->set_userdata('email', $this->input->post('email'));
				$this->session->set_userdata('phone_number', $this->input->post('phone_number'));
				redirect(base_url('admin/profile'));

      }else {
        // flashdata untuk sweetalert
				$this->session->set_flashdata('failed_message', 1);
        $this->session->set_flashdata('title', "Update profile failed!");
        $this->session->set_flashdata('text', 'Please check again your information');
				redirect(base_url('admin/profile'));
      } // end if($update): success or failed
		} // end form_validation
  } // end method: profile



  //  ============================== INBOX ==========================
  public function inbox(){
    // set data $data untuk view
    $data['header'] = array(
      'tabTitle'  => "Inbox {$this->classData['ringkesin']}",
      'tabIcon'   => $this->classData['tabIcon'],
      'active'    => "{$this->class}/inbox",
    );
    $data['content'] = array(
      'subTitle' => 'Admin Inbox',
    );
    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/v_inbox', $data);
    $this->load->view('admin/v_footer');
  }

} //end class Main



  // ============================== CONTOH ==========================================================================================
  /*
  | ----------------------------------------------------------------------
  |  {SECTION NAME}
  | ----------------------------------------------------------------------
  | These are the methods in this section:
  |
  | 1.
  | 2.
  | 3.
  | 4.
  | 5.
  |
  |
  | ----------------------------------------------------------------------
  */

 ?>
