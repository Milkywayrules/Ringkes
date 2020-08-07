<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// .
//                            Authentication
// .                         ----------------
// list method:
// - login (all user)
// - register (basicuser)
// - reset (all user)
// - logout (all user)
//
// .

class Auth extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('M_users');
	  // inisialisasi variabel kelas global
	  $this->classData = array(
	    'ringkesin'	=> '| Ringkesin',
	    'tabIcon'   => base_url("assets/img/logo/mainicon.png"),
	    'appName'   => 'ringkesin',
	  );
	}
// ======================================== VALIDASI LOGIN DAN PRIVILEGE ========================================
	private function _notLoginValidation(){
		// sudah login atau belum
		// kalau sudah redirect ke home
		if ( $this->session->userdata('isLogin') == 1 ) {
			redirect(base_url());
		}
	}
	private function _tipeLoginValidation($tipeLogin = ''){
		// --- ada 2 tipe login
		// -- admin dan biasa (untuk basicUser dan premiumUser)
		// website.com/login  			(benar) | tipe 1
		// website.com/admin/login  (benar) | tipe 2
		// website.com/member/login (salah)
		if ( ($tipeLogin == 'admin') or ($tipeLogin == '') ) {

		}else {
      redirect(base_url('login'));
    }
	}
//
//
//  ======================================== LOGIN ========================================
	/**
	 * [login description]
	 * @param  string $tipeLogin
	 * [$tipeLogin diambil dari parameter sebelum 'login' pada URL
	 * misal, 'website.com/admin/login', maka $tipeLogin = 'admin']
	 */
	public function login($tipeLogin = '')
	{
		// sudah login atau belum
		// kalau sudah redirect ke home
		$this->_notLoginValidation();
		// admin harus login melalui 'admin/login'
		// lakukan validasi apakah admin melakukan login melalui halaman 'login' atau 'admin/login'
    $this->_tipeLoginValidation($tipeLogin);
    // set data $data untuk view
		$data['header'] 	= array(
			'tabTitle' 		=> "Login ".ucfirst($tipeLogin)." {$this->classData['ringkesin']}",
			'tabIcon'			=> base_url("assets/img/logo/mainicon.png"),
		);
		$data['content']	= array(
			'tipeLogin'	=>	$tipeLogin,
		);
		// syarat form
		$this->form_validation->set_rules('emailUsername', 'E-Mail / Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 							'required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if ($this->form_validation->run() == FALSE){
			// jika syarat form belum terpenuhi (tombol login belum ditekan)
      $this->load->view('v_login', $data);

    }else{
			// jika syarat pada form sudah terpenuhi (tombol login sudah ditekan)
			// cek email / username pada db
			$query = $this->M_users->get_user_by_email_or_username($this->input->post('emailUsername'));

			// jika email/username ditemukan (!= false)
			if ( $query != false ) {
				// hasil 1 row data pada $query masukkan ke $user
				$user = $query->row();
				// lalu cek apakah password sesuai dengan db
				// jika password input = password tb_user
				if ( $this->bcrypt->check_password($this->input->post('password', true), $user->password) ) {
					$this->session->set_flashdata('success_message', 1);
					$this->session->set_flashdata('title', "Bonjour {$user->name} !");
					$this->session->set_flashdata('text', 'Enjoy your time with ringkesin');
					$this->session->set_userdata('isLogin', 1);

					// --- cek jenis akun yg login (privilege akun)
					// -- basicUser, premiumUser dan adminUser
					// validasi admin harus login dari halaman 'admin/login'
					// validasi basicUser dan premiumUser harus login dari halaman 'login'
					if (($user->privilege == 'adminUser' AND $tipeLogin == 'admin')
					OR (($user->privilege == 'basicUser' OR $user->privilege == 'premiumUser')
					AND $tipeLogin != 'admin')) {
						// set session userdata
						$this->session->set_userdata((array)$user);
						$this->session->unset_userdata('password');
						redirect(base_url(''));

					}else {
						$this->session->set_userdata('isLogin', 0);
						$this->session->set_flashdata('failed_message', 1);
						$this->session->set_flashdata('title', 'Login gagal !');
						$this->session->set_flashdata('text', 'Your credentials doesn\'t match !');
						redirect(base_url("{$tipeLogin}/login"));
					}
				}else {
					// jika password inputan tidak cocok pada db
					$this->session->set_flashdata('failed_message', 1);
					$this->session->set_flashdata('title', 'Login failed !');
					$this->session->set_flashdata('text', 'Invalid username / E-mail / password');
					redirect(base_url("{$tipeLogin}/login"));
				}
			}else {
				// jika email / username tidak terdaftar pada db
				$this->session->set_flashdata('failed_message', 1);
				$this->session->set_flashdata('title', 'Login failed !');
				$this->session->set_flashdata('text', 'Invalid username / E-mail / password');
				redirect(base_url("{$tipeLogin}/login"));
			}
    }
	} //end fungsi login

// ======================================== REGISTER ========================================
  public function register()
	{
		// sudah login atau belum
		// kalau sudah redirect ke home
		$this->_notLoginValidation();
		// set content for header
		$header2 = array(
			'tabTitle' 		=> "Register {$this->classData['ringkesin']}",
			'tabIcon'			=> base_url("assets/img/logo/mainicon.png"),
		);

		// syarat form
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[50]|alpha_dash|is_unique[tb_user.username]',
																			array(
																				'min_length'	=> 'Username must contain at least 5 characters',
																				'max_length' 	=> 'Username must contain at max 50 characters',
																				'alpha_dash' 	=> 'Only alphabet, number, underscores and dashes allowed',
																				'is_unique' 	=> 'Username already registered.',
																			));
		$this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email|max_length[50]|is_unique[tb_user.email]',
																			array(
																				'is_unique' 	=> 'E-mail already registered.',
																				'max_length' 	=> 'E-mail must contain at max 50 characters',
																			));
		$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|min_length[2]|max_length[50]',
																			array(
																				'min_length' 	=> 'Fullname must contain at least 2 characters',
																				'max_length' 	=> 'Fullname must contain at max 50 characters',
																			));
		$this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required|min_length[10]|max_length[15]|numeric|is_unique[tb_user.phone_number]',
																			array(
																				'min_length' 	=> 'Phone number must contain at least 10 characters',
																				'max_length' 	=> 'Phone number must contain at max 15 characters',
																				'numeric' 		=> 'Phone number must contain only numbers.',
																				'is_unique' 	=> 'Phone number already registered.',
																			));
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[250]',
																			array(
																				'min_length' 	=> 'Password must contain at least 5 characters',
																				'max_length' 	=> 'Password must contain at max 250 characters',
																			));
		$this->form_validation->set_rules('verPassword', 'Repeat Password', 'required|matches[password]');
		$this->form_validation->set_error_delimiters('<sup class="text-danger">', '</sup>');

		// jika syarat form belum terpenuhi (tombol register belum ditekan)
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('v_register', $header2);

		// jika syarat pada form sudah terpenuhi (tombol register sudah ditekan)
		}else {
			// echo "<hr>";

			$dataModel = array(
				'username' 				=> $this->input->post('username'),
				'email' 					=> $this->input->post('email'),
				'fullname' 				=> $this->input->post('fullname'),
				'phone_number'		=> $this->input->post('phoneNumber'),
				'gender' 					=> $this->input->post('gender'),
				'password' 				=> $this->bcrypt->hash_password($this->input->post('password',TRUE)),
				'privilege' 			=> 'basicUser',
				'activation_code' => md5(rand().time()),
			);
			// print_r($data);

			$register = $this->M_users->set_new_user($dataModel);

			if ($register == 1) {
				//
				//  kirim kode aktivasi ke email pendaftar
				//  pendaftar buka link yg dikirim berisi kode aktivasi
				//  akun pendaftar aktif setelahnya
				//
				$this->session->set_flashdata('success_message', 1);
				$this->session->set_flashdata('title', 'Registration complete !');
				$this->session->set_flashdata('text', 'Please activate your account via email');
				redirect(base_url('login'));
			}else {
				$this->session->set_flashdata('failed_message', 1);
				$this->session->set_flashdata('title', 'Registration failed !');
				$this->session->set_flashdata('text', 'Please check again your information');
				redirect(base_url('register'));
			}

		}
	}

// ======================================== RESET PASSWORD ========================================
	public function reset($resetCode = '')
	{
		$this->_notLoginValidation();
		$this->_tipeLoginValidation();
		// set content for header
		$header2 = array(
			'tabTitle' 		=> "Reset Password {$this->classData['ringkesin']}",
			'tabIcon'			=> base_url("assets/img/logo/mainicon.png"),
		);

		if ( $resetCode != '' ) {
      // kalo masuk ke resetpassword/(:any)
			if ( $this->M_users->get_reset_code($resetCode)->num_rows() == 1 ) {
        // cek reset_code nya ada di db atau engga
				$row = $this->M_users->get_reset_code($resetCode)->row();
				echo $row->activation_code;
			}
			// print_r($res);
			die();
		}

		// syarat form
		$this->form_validation->set_rules('reset-email', 'E-Mail', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if ( $this->form_validation->run() == FALSE ) {
			$this->load->view('v_reset_password', $header2);
		}else {
			$this->session->set_flashdata('reset-email', $this->input->post('reset-email'));
			redirect(base_url( 'mail/reset_password' ));
		}
	}

//  ======================================== LOGOUT ========================================
/**
 * hancurkan seluruh session dan redirect ke 'auth/logout_sw'
 * @return [redirect] [auth/logout_sw]
 */
  public function logout(){
    $this->session->sess_destroy();
		redirect(base_url('auth/logout_sw'));
  }
	/**
	 * set_flashdata untuk sweetalert berhasil logout
	 * @return [redirect] [home]
	 */
	public function logout_sw(){
		$this->session->set_flashdata('success_message', 1);
		$this->session->set_flashdata('title', 'Adios buddy!');
		$this->session->set_flashdata('text', 'See you in the next time with ringkesin');
		redirect(base_url());
  }

}
