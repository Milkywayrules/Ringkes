<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// .
//                            Report
// .                         --------
// list method:
// - index
// - excel
//
// .

class Report extends CI_Controller {

  function __construct(){
    parent::__construct();
    $this->load->model( 'M_url' );
    // inisialisasi variabel kelas global
    $this->classData = array(
      'ringkesin'	=> '| Ringkesin',
      'tabIcon'   => base_url("assets/img/logo/mainicon.png"),
      'appName'   => 'ringkesin',
    );
  }
// ======================================== INDEX ========================================
  public function index(){
    redirect(base_url());
  }

// ======================================== EXCEL GENERATE ========================================
  public function excel(){
    // echo "belom jadi bentar lagi sabar...";
    // header("Refresh:5; url=".base_url());
    // die();

    if ( $this->session->login == 0 ) {
      redirect('login');
    }
    // Load plugin PHPExcel nya
    include APPPATH.'third_party/PHPExcel/PHPExcel.php';

    // Panggil class PHPExcel nya
    $excel = new PHPExcel();

    $reportType   = 'URL';
    $setTitle     = 'ringkesin report |';
    $setSubject   = 'ringkesin report |';
    $setDesc      = 'ringkesin report |';
    $setKeywords  = 'ringkesin report';
    // Settingan awal file excel
    $excel->getProperties()->setCreator( $this->session->username )
        ->setLastModifiedBy( $this->session->username )
        ->setTitle( "{$setTitle} {$reportType}" )
        ->setSubject( "{$setSubject} {$reportType}")
        ->setDescription( "{$setDesc} {$reportType}" )
        ->setKeywords( "{$setKeywords}" );
    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    $style_col = array(
        'font' => array('bold' => true), // Set font nya jadi bold
        'alignment' => array(
            'horizontal'  => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
            'vertical'    => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
        ),
        'borders' => array(
            'top'     => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right'   => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom'  => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left'    => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
        )
    );
    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    $style_row = array(
        'alignment' => array(
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
        ),
        'borders' => array(
            'top'     => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right'   => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom'  => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left'    => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
        )
    );
    $excel->setActiveSheetIndex(0)->setCellValue('B2', "{$setTitle} {$reportType}"); // Set kolom B2 dengan tulisan "DATA SISWA"
    $excel->getActiveSheet()->mergeCells('B2:H2'); // Set Merge Cell pada kolom B2 sampai H2
    $excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(TRUE); // Set bold kolom B2
    $excel->getActiveSheet()->getStyle('B2')->getFont()->setSize(20); // Set font size 15 untuk kolom B2
    $excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom B2
    $excel->getActiveSheet()->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom B2
    // Buat header tabel nya pada baris ke 3
    $excel->setActiveSheetIndex(0)->setCellValue('B3', "No"); // Set kolom A3 dengan tulisan "NO"
    $excel->setActiveSheetIndex(0)->setCellValue('C3', "Original Link"); // Set kolom B3 dengan tulisan "NIM"
    $excel->setActiveSheetIndex(0)->setCellValue('D3', "Shortened"); // Set kolom C3 dengan tulisan "NAMA"
    $excel->setActiveSheetIndex(0)->setCellValue('E3', "Custom"); // Set kolom D3 dengan tulisan "KELAS"
    $excel->setActiveSheetIndex(0)->setCellValue('F3', "Visited"); // Set kolom E3 dengan tulisan "VISI"
    $excel->setActiveSheetIndex(0)->setCellValue('G3', "Created At"); // Set kolom E3 dengan tulisan "MISI"

    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);

    // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
    if ( $this->session->privilege <= 4 ) {
      $res = $this->M_url->get_all();
    }else {
      $res = $this->M_url->get_all_by_username( $this->session->userdata( 'username' ) );
    }
    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
    foreach($res as $data){ // Lakukan looping pada variabel siswa
      // echo "<pre>";
      // print_r($data->nim);die();
      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $no);
      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->ori_url);
      $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->short_url);
      if ( strpos($data->custom_url, 'pndkn_cstm_xx_') == 1 ) {
        $custom_url = ' ';
      }else {
        $custom_url = $data->custom_url;
      }
      $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $custom_url);
      $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->hit);
      $date = explode(' ', $data->created_at);
      $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $date[0]);


      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
      $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);

      // $excel->getActiveSheet()->getStyle('F'.$numrow)->getAlignment()->setWrapText(true);

      $no++; // Tambah 1 setiap kali looping
      $numrow++; // Tambah 1 setiap kali looping
      $total[] = $data->hit++;
    }

    $total = array_sum($total);
    $excel->getActiveSheet()->mergeCells('B'.$numrow.':E'.$numrow); // Set Merge Cell pada kolom B2 sampai H2
    $excel->getActiveSheet()->mergeCells('F'.$numrow.':G'.$numrow); // Set Merge Cell pada kolom B2 sampai H2
    $excel->getActiveSheet()->getStyle('B'.$numrow)->getFont()->setBold(TRUE); // Set bold kolom B2
    $excel->getActiveSheet()->getStyle('I'.$numrow)->getFont()->setBold(TRUE); // Set bold kolom B2
    $excel->getActiveSheet()->getStyle('B2')->getFont()->setSize(15); // Set font size 15 untuk kolom B2
    $excel->getActiveSheet()->getStyle('B2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); // Set text center untuk kolom B2
    $excel->getActiveSheet()->getStyle('B'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // Set text center untuk kolom B2
    $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, 'Total visit on all URL(s) : '); // <<<<-------------------------
    $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $total . ' visit(s)'); // <<<<-------------------------

    // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
    $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);

    // Set width kolom
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(4); // Set width kolom A
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(35); // Set width kolom A
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(15); // Set width kolom B
    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(25); // Set width kolom C
    $excel->getActiveSheet()->getColumnDimension('F')->setWidth(7); // Set width kolom D
    $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom E



    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
    $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(30);
    $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
    $excel->getActiveSheet()->getRowDimension('9')->setRowHeight(30);
    // Set orientasi kertas jadi LANDSCAPE
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    // Set judul file excel nya
    $excel->getActiveSheet(0)->setTitle( "{$setTitle} {$reportType}" );
    $excel->setActiveSheetIndex(0);
    //
    // pecah date dan time
    $now = unix_to_human(now(), true, 'europe');
    $dateTime = explode(' ', $now);
    $time = explode(':', $dateTime[1]);
    //
    // print_r($exp);die();
    // Proses file excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename={$this->classData['appName']}-{$dateTime[0]}.xlsx"); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');
  }

}


 ?>
