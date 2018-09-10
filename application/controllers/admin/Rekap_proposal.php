<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap_proposal extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Model');
		$this->load->model('M_simuk');
		if(!$this->session->userdata('is_login') || $this->session->userdata('level_ppm') != 'admin'){
            echo '<script>alert("Maaf, anda tidak boleh mengakses halaman ini")</script>';
            echo'<script>window.location.href="'.base_url().'";</script>';
        }
	}


	public function index(){
		$data = array(
			'page' => 'rekap_proposal',
			'link' => 'rekap_proposal',
			'script' => '',
			'list' => $this->Model->group('YEAR(tahun_diajukan) AS tahun','tb_usulan_proposal','YEAR(tahun_diajukan)'),
		);
		$this->load->view('template/wrapper', $data);
	}

	public function proposal_excel(){

        $jenis = $this->input->post('jenis', true);
        $status = $this->input->post('status', true);
        $tahun = $this->input->post('tahun', true);
        $test = $this->load->library('PHPExcel', 'phpexcel');

        $file = new PHPExcel ();
        $file->getProperties ()->setCreator ( "itera" );
        $file->getProperties ()->setLastModifiedBy ( "TIK" );
        $file->getProperties ()->setTitle ( "Rekap Proposal" );
        $file->getProperties ()->setSubject ( "Rekap Proposal" );
        $file->getProperties ()->setDescription ( "Data Rekap Proposal" );
        $file->getProperties ()->setKeywords ( "PPM" );
        $file->getProperties ()->setCategory ( "PPM" );

        /*start - BLOCK SETUP SHEET*/
        $file->createSheet ( NULL,0);
        $file->setActiveSheetIndex ( 0 );
        $sheet = $file->getActiveSheet ( 0 );
        //memberikan title pada sheet
        $sheet->setTitle ( "Data Rekap Proposal" );
        /*end - BLOCK SETUP SHEET*/
         
        /*start - BLOCK HEADER*/
        $sheet  ->setCellValue ( "B5", "No" )
            ->setCellValue ( "C5", "Judul Proposal" )
            ->setCellValue ( "D5", "Ketua Peneliti" )
            ->setCellValue ( "E5", "Jenis" )
            ->setCellValue ( "F5", "Status" )
            ->setCellValue ( "G5", "Kategori" )
            ->setCellValue ( "H5", "Program Studi" )
            ->setCellValue ( "I5", "Anggota Dosen" )
            ->setCellValue ( "J5", "Anggota Mahasiswa" )
            ->setCellValue ( "K5", "Usulan Biaya" );
        /*end - BLOCK HEADER*/

        /* start - BLOCK MEMASUKAN DATABASE*/       
        if ($jenis == 'semua' && $status != 'semua') {
            $this->Model->default->select('*');
            $this->Model->default->from('vw_rekap_proposal');
            //$this->Model->default->join('tb_kategori', 'tb_usulan_proposal.id_kategori=tb_kategori.id_kategori');
            $this->Model->default->where(array('ketua_peneliti<>' => '' ,'delete' => '0', 'status' => $status, 'YEAR(tahun_diajukan)' => $tahun));
             $this->Model->default->order_by('id_proposal', 'ASC');  
        }elseif ($status == 'semua' && $jenis != 'semua') {
            $this->Model->default->select('*');
            $this->Model->default->from('vw_rekap_proposal');
            //$this->Model->default->join('tb_kategori', 'tb_usulan_proposal.id_kategori=tb_kategori.id_kategori');
            $this->Model->default->where(array('ketua_peneliti<>' => '' ,'delete' => '0', 'jenis' => $jenis, 'YEAR(tahun_diajukan)' => $tahun));
            $this->Model->default->order_by('id_proposal', 'ASC');  
        }elseif ($jenis == 'semua' && $status == 'semua') {
            $this->Model->default->select('*');
            $this->Model->default->from('vw_rekap_proposal');
            //$this->Model->default->join('tb_kategori', 'tb_usulan_proposal.id_kategori=tb_kategori.id_kategori');
            $this->Model->default->where(array('ketua_peneliti<>' => '' ,'delete' => '0', 'YEAR(tahun_diajukan)' => $tahun));
            $this->Model->default->order_by('id_proposal', 'ASC'); 
        }else{
            $this->Model->default->select('*');
            $this->Model->default->from('vw_rekap_proposal');
            //$this->Model->default->join('tb_kategori', 'tb_usulan_proposal.id_kategori=tb_kategori.id_kategori');
            $this->Model->default->where(array('ketua_peneliti<>' => '','delete' => '0', 'jenis' => $jenis, 'status' => $status, 'YEAR(tahun_diajukan)' => $tahun));
             $this->Model->default->order_by('id_proposal', 'ASC');  
        }


        $query = $this->Model->default->get();

       // echo $this->Model->default->last_query();
        // var_dump($query->result());
        // die();
        //$row= $query->result();
        $nomor = 5;
        $no = 1;
        foreach($query->result() as $row){

            $nomor++;
            $sheet  ->setCellValue ( "B".$nomor, $no++)
                ->setCellValue ( "C".$nomor, "$row->judul_penelitian" )
                ->setCellValue ( "D".$nomor, "$row->nama_ketua_peneliti ($row->NIDN)" )
                ->setCellValue ( "E".$nomor, $row->jenis )
                ->setCellValue ( "F".$nomor, $row->status )
                ->setCellValue ( "G".$nomor, $row->nama_kategori )
                ->setCellValue ( "H".$nomor, $row->nama_prodi )
                ->setCellValue ( "I".$nomor, $row->anggota_dosen )
                ->setCellValue ( "J".$nomor, $row->anggota_mahasiswa )
                ->setCellValue ( "K".$nomor, $row->biaya_diusulkan );
                 //$nomor++;
        }
            
        /* end - BLOCK MEMASUKAN DATABASE*/

        /* start - BLOCK MEMBUAT LINK DOWNLOAD*/
        //header ( 'Content-Type: application/vnd.ms-excel;charset=utf-8' );
        //namanya adalah keluarga.xls
        header('Content-Type: text/html; charset=ISO-8859-1');
        header ( 'Content-Disposition: attachment;filename="data_rekap_proposal_ppm.xls"' ); 
        header ( 'Cache-Control: max-age=0' );
        $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel5' );
        $writer->save ( 'php://output' );

	}


}