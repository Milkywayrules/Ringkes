<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// .
//                            User
// .                         ------
// list method:
// - index
// - create
// - qrcode
// - cek
// - cek_custom
//
// .

class Short extends CI_Controller {

  function __construct(){
    parent::__construct();
    $this->load->model('M_url');
    // inisialisasi variabel kelas global
    $this->classData = array(
      'ringkesin'	=> '| Ringkesin',
      'tabIcon'   => base_url("assets/img/logo/mainicon.png"),
      'appName'   => 'ringkesin',
    );
  }
// ======================================== VALIDASI REQUEST METHOD ========================================
  function _validasi_request_method(){
    // request method harus 'POST'
    if ( $_SERVER[ 'REQUEST_METHOD' ] != 'POST' ) {
      echo "<center><h3>hayoo ngapain ah</center></h3>";
      header("Refresh: 3; URL=".base_url('u/dashboard'));
      die();
    }
  }
//
//
// ======================================== INDEX ========================================
  public function index()
  {
    $this->_validasi_request_method();
  }
// ======================================== CREATE RINGKES URL ========================================
  // method untuk membuat data shortened link berdasarkan link panjang yang dimasukkan oleh user
  public function create()
  {
    // echo $this->session->url;die();
    // $this->_validasi_request_method();

    // $this->form_validation->set_rules('url', 'URL', 'trim|required');
    // $this->form_validation->set_rules('custom', 'custom URL', 'trim|required|is_unique[tb_url.custom_url]');
    // $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    //
    // if ($this->form_validation->run() == FALSE) {
    //   $this->load->view('v_home');echo "111111";
    // }else {
    //   echo "222222";
    // }die();

    // load lib converter
    $this->load->library('converter');
    // konversi max id pada db menjadi int
    $id         = intval($this->M_url->get_max_id()->Max_id) + 1;
    $createUrl  = $this->session->userdata('createUrl');
    // echo "<pre>";
    // print_r($this->session->userdata());
    // die();

    if ( $this->session->userdata('createCustom') == 'ringkesin_url_custom_' ) {
      $this->createCustom = $this->session->userdata('createCustom') . $id;
    }else {
      $this->createCustom = $this->session->userdata('createCustom');
    }
    // validasi inputan user pada home agar menjadi url valid
    $createUrl = prep_url( $createUrl );
    $short = $this->converter->url_encode($id);
    // set flashdata
    $this->session->set_flashdata('short_url', $short);
    $this->session->set_flashdata('id', $id);
    // hasil encode ID dari MAX(ID) masukan ke $short

    // $exist = $this->cek_custom($createUrl);
    // TIDAK DIPAKAI UNTUK SEMENTARA | UNTUK BUAT CEK CUSTOM NAME PADA DB
    $exist = FALSE;
    // panggil method cek_custom() untuk cek apakah inputan custom user sudah terdata di db atau belum
    // kalau sudah redirect ke home, kalau belum maka lanjut kebawah

    // VALIDASI BAHWA LINK PANJANG PERNAH DIPENDEKIN OLEH USER TERTENTU---

    if ($exist == FALSE) {
      // jika link inputan user($exist) itu false(belum ada) di db
      // $oriUrl = $this->session->flashdata('ori_url');
      // $custom = $this->session->flashdata('custom_url');
      // flashdata berasal dari $inputUrl pada method $this->cek_custom()
      $home = base_url();
      $this->qrcode();
      if ($this->session->username == '') {
        // jika tidak login maka created_by = guest
        if ($this->M_url->create_url($createUrl, $short, $createCustom, $this->session->qrcode_img, 'guest')) {
          // jika berhasil create data
          $this->session->set_flashdata('success', 1);
          $this->session->set_flashdata('ori_url', $createUrl);
          $this->session->set_flashdata('short_url', $short);
          $this->session->set_flashdata('custom_url', $createCustom);
          redirect(base_url());
        }else {
          // jika gagal create data pada model create_url()
          echo "Gagal create data. Hubungi kami jika masalah masih berlanjut :) - Kode error : sh/cr/1";
          header("Refresh: 5; URL=".base_url());
        }
      }else {
        // jika login maka input_by = username
        if ( $this->M_url->create_url($createUrl, $short, $createCustom, $this->session->qrcode_img, $this->session->username) ) {
          // jika berhasil create data
          $message = $short;
          $this->session->set_flashdata('success', 1);
          $this->session->set_flashdata('ori_url', $createUrl);
          $this->session->set_flashdata('short_url', $short);
          $this->session->set_flashdata('custom_url', $createCustom);
          if ( $this->session->privilege <= 4 ) {
            redirect(base_url('admin/url'));
          }else {
            redirect(base_url('u/create'));
          }
        }else {
          // jika gagal create data pada model create_url()
          echo "Gagal create data. Hubungi kami jika masalah masih berlanjut :) - Kode error : sh/cr/2";
          header("Refresh: 5; URL=".base_url());
        }
      }
    }else {
      // jika link sudah ada di db $exist==TRUE
      $error = 'Sorry for the error !';
      $this->session->set_flashdata('error', $error);
      redirect(base_url('admin/url'));
    }
  }

// ======================================== CREATE QRCODE ========================================
  public function qrcode(){
    die($this->createCustom);

		$this->load->library('qrcode/ciqrcode'); //pemanggilan library QR CODE

		$config['cacheable']	= true; //boolean, the default is true
		$config['cachedir']		= 'assets/qr/cache/'; //string, the default is application/cache/
		$config['errorlog']		= 'assets/qr/logs/'; //string, the default is application/logs/
		$config['imagedir']		= 'assets/img/qr/'; //direktori penyimpanan qr code
		$config['quality']		= true; //boolean, the default is true
		$config['size']			  = '1024'; //interger, the default is 1024
		$config['black']		  = array(224,255,255); // array, default is array(255,255,255)
		$config['white']		  = array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);

    $timestamp = now();
    $image_name = "{$this->classData['appName']}_{$this->session->id}_{$this->session->short_url}_{$timestamp}.png"; //buat name dari qr code sesuai dengan short_url
    if ( $this->session->createCustom == 'ringkesin_url_custom_' ) {
      $params['data'] = base_url($this->session->short_url); //data yang akan di jadikan QR CODE
    }else {
      // $image_name = 'qrcode_' . $this->session->createCustom .'.png'; //buat name dari qr code sesuai dengan nim
      $params['data'] = base_url($this->session->createCustom); //data yang akan di jadikan QR CODE
    }
		// $params['data'] = "WIFI:T:$type;S:$ssid;P:$ssidPW;;"; //membuat data WIFI
		$params['level'] = 'H'; //H=High
		$params['size'] = 10;
		$params['savename'] = FCPATH . $config['imagedir'].$image_name ; //simpan image QR CODE ke folder assets/images/

    if ( $this->ciqrcode->generate($params) ) {
    // fungsi untuk generate QR CODE
      $this->session->set_flashdata( 'qrcode', base_url( $config['imagedir'].$image_name ) );
      $this->session->set_flashdata( 'qrcode_img', $image_name );
    }else {
      redirect(base_url());
    }
	}

// ======================================== CEK KODE UNIK URL ========================================
  public function cek($unique='')
  // param berupa short url / slug
  {
    if ( $unique == '' ) {
      // jika kode unik untuk dicek kosong
      echo "<center><h3>Mana kode uniknya kak?</center></h3>";
      header("Refresh: 3; URL=".base_url('u/dashboard'));
      die();
    }

    if($res = $this->M_url->get_url($unique)){
      // cek apakah short url sudah ada

      // header("Refresh: 5; URL={$home}");
      // if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
      //   die('dari fungsi create');
      // }else {
      //   die('bukan dari create');
      // }
      if ($res->result_id->num_rows > 0) {
        // jika short url sudah ada

        // $http  = strpos($res->row_array()['ori_url'], 'http://');
        // $https = strpos($res->row_array()['ori_url'], 'https://');
        // if(($http !== false) or ($https !== false)){
        //   // jika http atau https sudah ada pada ori url
        //   $oriUrl = $res->row_array()['ori_url'];
        // }else {
        //   // jika http atau https belum ada, maka tambahkan http
        //   $arr = array('http://', $res->row_array()['ori_url']);
        //   $oriUrl = implode($arr);
        //   echo "nah gaada<br>$oriUrl";
        //   redirect('u/dashboard');
        // }
        if ( $this->M_url->update_hit($unique) ) {
          // tambah 1 hit pada db
          redirect( $res->row_array()['ori_url'] );
          // lalu redirect ke ori url
        }
      }else {
        // jika short url belum ada
        // if ( $this->input->post('url') == null ) {
        //   // jika inputan url kosong
        //   redirect(base_url());die();
        // }
        // $http  = strpos($this->input->post('url'), 'http://');
        // $https = strpos($this->input->post('url'), 'https://');
        // if( ($http !== false) or ($https !== false) ){
        //   // kalo ada http atau https masuk kesini (TRUE)
        //   $oriUrl = $this->input->post('url');
        //   $this->session->set_flashdata('url', $oriUrl);
        //   echo "Sukses 1-";
        // }else{
        //   // kalo gaada http atau https masuk kesini
        //   $arr = array('http://', $this->input->post('url'));
        //   $oriUrl = implode($arr);
        //   $this->session->set_flashdata('url', $oriUrl);
        //   echo $this->session->url;
        // }
        $this->load->view('errors/html/error_url_404');
        // redirect('url/not/found');
        // redirect untuk daftar
      }
    }else {
      echo "gagal fetch";
    }
    // die();

  } // end function cek()

// ======================================== CEK CUSTOM URL ========================================
  public function cek_custom($inputUrl='')
  // AKAN SELALU FALSE UNTUK SEMENTARA TIDAK DIGUNAKAN
  // method untuk cek apakah custom url sudah ada di db atau belum
  // digunakan hanya untuk validasi ketika user ingin pendekin urlnya pada home
  // $this->create() panggil $this->cek_custom() kemudian return ke $this->create() lagi
  {
    $this->_validasi_request_method();

    if($res = $this->M_url->get_url_ori($inputUrl)){
      // get data melalui model get_url_ori()
      if ($res->result_id->num_rows > 0) {
        // jika ori url sudah ada maka
        $rs = $res->row_object();
        // $this->session->set_flashdata('found', $this->input->post('custom'));
        // $this->session->set_flashdata('ori_url', $inputUrl);
        //
        $this->session->set_flashdata('ori_url', $inputUrl);
        $this->session->set_flashdata('custom_url', $this->input->post('custom'));
        //
        return FALSE;
      }else {
        // jika ori url belom ada
        $this->session->set_flashdata('ori_url', $inputUrl);
        $this->session->set_flashdata('custom_url', $this->input->post('custom'));
        // inisialisasi flashdata ori_url berdasarkan $inputUrl yg akan digunakan pada method $this->create()
        return FALSE;
      }
    }else {
      // jika gagal get data melalui model get_url_ori()
      echo "Gagal get data. Hubungi kami jika masalah masih berlanjut :) - Kode error : s/c_l/1";
      header("Refresh: 5; URL=".base_url());
    }
    die();
  }


} // end library/class shortener


 ?>
