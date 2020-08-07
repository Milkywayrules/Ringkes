<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// .
//                            User
// .                         ------
// list method:
// - view_qrcode
// - about
// - contact_us
// - comingsoon
//
// .

class Pages extends CI_Controller {

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
//  ======================================== QRCODE VIEWER ========================================
  public function view_qrcode($qrcode = ''){
    if ( $qrcode == '' ) {
      redirect(base_url());
    }
    $imageContents = file_get_contents( FCPATH . "assets/img/qr/{$qrcode}" );
    header('Content-Type: image/png');
    echo $imageContents;
  }

//  ======================================== ABOUT ========================================
  public function about (){
    echo "belom ada hehe";
  }

//  ======================================== CONCTACT US ========================================
  public function contact_us (){
    // set data $data untuk view
		$data['header'] = array(
			'tabTitle' 	=> 'Contact us! '.$this->classData['ringkesin'],
			'tabIcon'		=> $this->classData['tabIcon'],
		);
    $data['content']  = array(
      'active'    => 'contactus',
    );
		$this->load->view('pages/v_contactus', $data);
  }

//  ======================================== COMINGSOON ========================================
  public function comingsoon (){
    //
		$data['header'] = array(
			'tabTitle' 	=> 'Coming very soon! '.$this->classData['ringkesin'],
			'tabIcon'		=> $this->classData['tabIcon'],
		);
    //
    $data['content']  = array(
      'active'    => 'comingsoon',
      'appName'   => $this->classData['appName'],
    );
		$this->load->view('pages/v_comingsoon', $data);
  }

}


 ?>
