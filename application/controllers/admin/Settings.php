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
class Settings extends CI_Controller {

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
      'appName'   => SITE_NAME,
    );
    $this->class = 'settings';
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
  | 1. index()
  | 2. update_profile()
  | 3. update_password()
  | 4. settings()
  |
  |
  | ----------------------------------------------------------------------
  */

  //  ============================== index ================
  public function index(){
    // set data $data untuk view
    $data['header'] = array(
      'tabTitle'  => "Settings {$this->classData['ringkesin']}",
      'tabIcon'   => $this->classData['tabIcon'],
      'active'    => "{$this->class}/index",
    );
    $data['content'] = array(
      'subTitle' => 'Settings Account',
      'user'     => (object)$this->session->userdata(),
    );
    $this->load->view('admin/v_header', $data);
		$this->load->view('admin/settings/v_settings', $data);
    $this->load->view('admin/v_footer');
  } // end method: update_password



  // ============================== UPDATE_PROFILE =========================
  public function update_profile(){
    // set data $data untuk view
    $data['header'] = array(
      'tabTitle'  => "Update profile {$this->classData['ringkesin']}",
      'tabIcon'   => $this->classData['tabIcon'],
      'active'    => "{$this->class}/updateProfile",
    );
    $data['content'] = array(
      'subTitle' => 'Basic Information',
    );
    // syarat form
    $this->form_validation->set_rules('email', 'E-Mail', 'trim');
    $this->form_validation->set_rules('fullname', 'Full Name', 'trim');
    $this->form_validation->set_rules('phone_number', 'phone_number', 'trim');

		if ($this->form_validation->run() == FALSE) {
	    $this->load->view('admin/v_header', $data);
			$this->load->view('admin/settings/v_update_profile', $data);
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
				redirect(base_url('admin/settings/update-profile'));
      } // end if($update): success or failed
		} // end form_validation
  } // end method: update_profile



  //  ============================== UPDATE_PASSWORD ================
  public function update_password(){
    // set data $data untuk view
    $data['header'] = array(
      'tabTitle'  => "Update password {$this->classData['ringkesin']}",
      'tabIcon'   => $this->classData['tabIcon'],
      'active'    => "{$this->class}/updatePassword",
    );
    $data['content'] = array(
      'subTitle' => 'Update Password',
    );
    // syarat form
    $this->form_validation->set_rules('inputCurrentPw', 'Current Password', 'required');
		$this->form_validation->set_rules('inputNewPw', 'New Password', 'required|min_length[5]|max_length[250]',
																			array(
																				'min_length' 	=> 'New password must contain at least 5 characters',
																				'max_length' 	=> 'New password must contain at max 250 characters',
																			));
    $this->form_validation->set_rules('inputRepeatNewPw', 'Repeat New Password', 'required|matches[inputNewPw]');

		if ($this->form_validation->run() == FALSE) {
      $this->load->view('admin/v_header', $data);
      $this->load->view('admin/settings/v_update_password', $data);
      $this->load->view('admin/v_footer');

		}else {
      // retrieve current password on DB
      $user       = $this->M_users->get_user_hashed_password_by_username($this->session->userdata('username'));
      $currentPw  = $user->row()->password;

      // check input old password with current password on DB
      if ( ! $this->bcrypt->check_password($this->input->post('inputCurrentPw', true), $currentPw)) {
        $this->session->set_flashdata('currentPwNotMatch', 'You entered wrong password !');
        redirect(current_url());

      }else {
        $newHashedPw = $this->bcrypt->hash_password($this->input->post('inputNewPw',TRUE));
        // set parameter dengan key dan value untuk update data
        $params = array( 'password' => $newHashedPw );
        // set kondisi dengan key dan value untuk update data
        $where = array( 'username' => $this->session->userdata('username') );
        // lakukan update, jika berhasil = 1, jika gagal = 0
  			$update = $this->M_users->set_update_password($params, $where);

        if ($update) {
          // flashdata untuk sweetalert
  				$this->session->set_flashdata('success_message', 1);
          $this->session->set_flashdata('title', "Update password success!");
          $this->session->set_flashdata('text', 'Ssstt, don\'t tell your secret to anyone !');
  				redirect(base_url('admin/settings'));

        }else {
          // flashdata untuk sweetalert
  				$this->session->set_flashdata('failed_message', 1);
          $this->session->set_flashdata('title', "Update password failed!");
          $this->session->set_flashdata('text', 'Please check again your information');
  				redirect(current_url());
        } // end if($update): success or failed
      } // end if(check input old password with current password on DB)
		} // end form_validation
  } // end method: update_password

} //end class: Settings



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
