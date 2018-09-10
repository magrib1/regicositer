<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap_nilai extends CI_Controller {
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
			'page' => 'rekap_nilai',
			'link' => 'rekap_nilai',
			'script' => '',
			'list' => $this->Model->group('YEAR(tahun_diajukan) AS tahun','tb_usulan_proposal','YEAR(tahun_diajukan)'),
		);
		$this->load->view('template/wrapper', $data);
	}

	public function nilai_excel(){

		$test = $this->load->library('PHPExcel', 'phpexcel');
		$jenis = $this->input->post('jenis', true);
		//$status = $this->input->post('status', true);
		$tahun = $this->input->post('tahun', true);

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
        $sheet->setTitle ( "Data Rekap Nilai Proposal" );
        /*end - BLOCK SETUP SHEET*/
         
        /*start - BLOCK HEADER*/
        $sheet  ->setCellValue ( "B5", "No" )
            ->setCellValue ( "C5", "Judul Proposal" )
            ->setCellValue ( "D5", "Ketua Peneliti" )
            ->setCellValue ( "E5", "Jenis" )
            ->setCellValue ( "F5", "Kategori" )
            ->setCellValue ( "G5", "Program Studi" )
            ->setCellValue ( "H5", "Anggota Dosen" )
            ->setCellValue ( "I5", "Anggota Mahasiswa" )
            ->setCellValue ( "J5", "Nama Reviewer" )
            ->setCellValue ( "K5", "Nilai" )
            ->setCellValue ( "L5", "Biaya Diusulkan" )
            ->setCellValue ( "M5", "Biaya Rekomendasi" )
            ->setCellValue ( "N5", "Komentar Reviewer" );
        /*end - BLOCK HEADER*/

        /* start - BLOCK MEMASUKAN DATABASE*/
       	if ($jenis == 'semua') {
            $this->Model->default->select('*');
            $this->Model->default->from('vw_nilai_proposal');
            //$this->Model->default->join('tb_review_proposal', 'tb_usulan_proposal.id_proposal=tb_review_proposal.id_proposal');
            //$this->Model->default->join('tb_nilai_review', 'tb_review_proposal.id_review_proposal=tb_nilai_review.id_review_proposal')
            $this->Model->default->where(array('ketua_peneliti<>' => '','delete' => '0','status_proposal' => 'diterima', 'YEAR(tahun_diajukan)' => $tahun));
        }else{
            $this->Model->default->select('*');
            $this->Model->default->from('vw_nilai_proposal');
            //$this->Model->default->join('tb_review_proposal', 'tb_usulan_proposal.id_proposal=tb_review_proposal.id_proposal');
            //$this->Model->default->join('tb_nilai_review', 'tb_review_proposal.id_review_proposal=tb_nilai_review.id_review_proposal')
            $this->Model->default->where(array('ketua_peneliti<>' => '','delete' => '0', 'jenis' => $jenis, 'status_proposal' => 'diterima', 'YEAR(tahun_diajukan)' => $tahun));
        }
    	

        $query = $this->Model->default->get();

    	// var_dump($query->result());
    	// die();
        
        $nomor = 5;
        $no = 1;
        foreach($query->result() as $row){
            $nomor++;
            $sheet  ->setCellValue ( "B".$nomor, $no++ )
                ->setCellValue ( "C".$nomor, $row->judul_penelitian )
                ->setCellValue ( "D".$nomor, "$row->nama_ketua_peneliti ($row->NIDN)" )
                ->setCellValue ( "E".$nomor, $row->jenis )
                ->setCellValue ( "F".$nomor, $row->nama_kategori )
                ->setCellValue ( "G".$nomor, $row->nama_prodi )
                ->setCellValue ( "H".$nomor, $row->anggota_dosen )
                ->setCellValue ( "I".$nomor, $row->anggota_mahasiswa )
                ->setCellValue ( "J".$nomor, $row->nama_reviewer )
                ->setCellValue ( "K".$nomor, $row->nilai_total )
                ->setCellValue ( "L".$nomor, $row->biaya_diusulkan )
                ->setCellValue ( "M".$nomor, $row->biaya_rekomendasi )
                ->setCellValue ( "N".$nomor, $row->komentar_reviewer );
        }
        /* end - BLOCK MEMASUKAN DATABASE*/

        /* start - BLOCK MEMBUAT LINK DOWNLOAD*/
         header('Content-Type: text/html; charset=ISO-8859-1');
        //namanya adalah keluarga.xls
        header ( 'Content-Disposition: attachment;filename="data_rekap_nilai_proposal_ppm.xls"' ); 
        header ( 'Cache-Control: max-age=0' );
        $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel5' );
        $writer->save ( 'php://output' );
        /* start - BLOCK MEMBUAT LINK DOWNLOAD*/

	}


}