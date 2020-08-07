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
class Manage extends CI_Controller {

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
  |  II/II | (ADMIN) CREATE METHOD
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

  //  ============================== URL ============================
  public function create_url(){
  }

  //  ============================== ADMIN ==========================
  public function add_admin(){
  }



  /*
  | ----------------------------------------------------------------------
  |  II/II | (ADMIN) RETRIEVE DATA METHOD
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

  //  ============================== URL ============================
  public function users(){
    // set data $data untuk view
    $data['header'] = array(
      'tabTitle'    => "User(s) Management {$this->classData['ringkesin']}",
      'tabIcon'     => $this->classData['tabIcon'],
      'active'      => 'manage/users',
      'dataTables'  => '1',
    );
    $data['content'] = array(
      'subTitle'    => 'User(s) Management',
      'totAccount'  => $this->M_users->get_all(),
    );
    $data['footer'] = array(
      'dataTables'  => '1',
    );

    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/manage/v_users', $data);
    $this->load->view('admin/v_footer');
  }

  //  ============================== ADMIN ==========================
  public function url($params = '', $key = ''){
    if ($params == 'detail' and $key != '') {
      $this->detail($key);
      // die('d');
    }elseif ($params == 'edit' and $key != '') {
      $this->edit($key);
      die('e');
    }else {
      // set data $data untuk view
      $data['header'] = array(
        'tabTitle'    => "Link (URL) Management {$this->classData['ringkesin']}",
        'tabIcon'     => $this->classData['tabIcon'],
        'active'      => 'manage/url',
        'dataTables'  => '1',
      );
      $data['content'] = array(
        'subTitle'  => 'Link (URL) Management',
        'totUrl'    => $this->M_url->get_all(),
      );
      $data['footer'] = array(
        'dataTables'  => '1',
      );

      $this->load->view('admin/v_header', $data);
      $this->load->view('admin/manage/v_url', $data);
      $this->load->view('admin/v_footer');
    }
  }

  //
	public function detail($key = ''){
    if ($key == '') {
      redirect(base_url("admin/manage/{$this->uri->segment(3)}"));
    }
    $this->uri->segment(5);
    echo "{$a}";
    $rowData = $this->M_url->get_url_by_id($key)->row();
    // set data $data untuk view
    $data['header'] = array(
      'tabTitle'    => "URL Detail {$this->classData['ringkesin']}",
      'tabIcon'     => $this->classData['tabIcon'],
      'active'      => 'manage/url',
    );
    $data['content'] = array(
      'subTitle'    => "URL detail with ID: {$rowData->id}",
      'cardTitle'   => "Basic Information",
      'rowData'     => $rowData,
    );

    $this->load->view('admin/v_header', $data);
    $this->load->view('admin/manage/v_detail_user', $data);
    $this->load->view('admin/v_footer');


		// die($from.'/'.$id);
		// DETAIL PROVIDER
		// if ($from == 'data_provider') {
		// 	$this->header2 = array(
		// 		'tabTitle' 		=> 'Detail Provider - superadmin',
		// 		'heading' 		=> "Detail Provider : @{$username}",
		// 		'active' 			=> 'data_provider',
		// 	);
		// 	$this->header = array_merge($this->header1, $this->header2);
		// 	// ambil data member berdasarkan username
		// 	// lalu pecah created_at untuk menghasilkan tanggal dan waktu yang terpisah
		// 	// kemudian insert kembali ke dalam object. created_at yg sudah dipecah insert ke dalam key created_at
		// 	$this->data['user'] = $this->M_user->get_provider_by_username($username)->row();
		// 	$explode = explode(' ', $this->data['user']->created_at);
		// 	$this->data['user']->created_at = $explode;
    //
		// 	$this->load->view($this->header['tipeAkun'] . '/template/v_header', $this->header);
		// 	$this->load->view($this->header['tipeAkun'] . '/panel/v_detail_provider', $this->data);
		// 	$this->load->view($this->header['tipeAkun'] . '/template/v_footer');
    //
		// // DETAIL MEMBER
		// }elseif ($from == 'data_member') {
		// 	$this->header2 = array(
		// 		'tabTitle' 		=> 'Detail Member - superadmin',
		// 		'heading' 		=> "Detail Member : @{$username}",
		// 		'active' 			=> 'data_member',
		// 	);
		// 	$this->header = array_merge($this->header1, $this->header2);
		// 	// ambil data member berdasarkan username
		// 	// lalu pecah created_at untuk menghasilkan tanggal dan waktu yang terpisah
		// 	// kemudian insert kembali ke dalam object. created_at yg sudah dipecah insert ke dalam key created_at
		// 	$this->data['user'] = $this->M_user->get_member_by_username($username)->row();
		// 	$explode = explode(' ', $this->data['user']->created_at);
		// 	$this->data['user']->created_at = $explode;
		// 	// echo "<pre>";
		// 	// print_r($this->data['user']);
		// 	// die();
    //
		// 	$this->load->view($this->header['tipeAkun'] . '/template/v_header', $this->header);
		// 	$this->load->view($this->header['tipeAkun'] . '/panel/v_detail_member', $this->data);
		// 	$this->load->view($this->header['tipeAkun'] . '/template/v_footer');
    //
		// }
	}

} // end class



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
