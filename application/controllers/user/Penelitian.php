<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penelitian extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Model');
		$this->load->model('M_simuk');
		$this->load->model('M_siakad');
		$this->load->model('M_ref');
		$this->load->library('image_lib');
		$this->load->library('upload');
		if(!$this->session->userdata('is_login') || $this->session->userdata('rule') != 'dosen'){
            echo '<script>alert("Maaf, anda tidak boleh mengakses halaman ini")</script>';
            echo'<script>window.location.href="'.base_url().'";</script>';
        }
	}

	public function index(){
		$data = array(
			'page' => 'penelitian_user',
			'link' => 'penelitian',
			'script' => 'script/penelitian_user',
			'list' => $this->Model->ambil_banyak_kondisi('tb_usulan_proposal', array('jenis' => 'penelitian', 'ketua_peneliti' => $this->session->userdata('id'),'delete' => '0') )->result(),
		);
		$this->load->view('template/wrapper', $data);
	}

	public function auto_pegawai(){
        $keyword = $this->input->post('nama_pegawai', true);
        $data = $this->M_simuk->like('tb_pegawai', 'nama_pegawai', $keyword)->result_array();   
        echo json_encode($data);
    }

    public function auto_mhs(){
        $keyword = $this->input->post('nama_mhs', true);
        $data = $this->M_siakad->like('mahasiswa', 'nama_mhs', $keyword)->result_array();   
        echo json_encode($data);
    }

    public function auto_prodi(){
        $keyword = $this->input->post('nama_prodi', true);
        $data = $this->M_simuk->simuk->query("SELECT * FROM tb_unit WHERE nama_unit LIKE '%.'$keyword'.%' AND level_unit ='1' ")->result_array();   
        echo json_encode($data);
    }

	public function usulan($id){
		$waktu_sekarang = time();
	    $waktu_akhir = $this->Model->ambil('jenis','penelitian','tb_timeline')->row();
	    $waktu_akhir = strtotime($waktu_akhir->waktu_selesai);

		$data = array(
			'page' => 'usulan_penelitian',
			'link' => 'penelitian',
			'script' => 'script/penelitian_user',
			'list' => $this->Model->ambil('id_proposal',$id,'tb_usulan_proposal')->row(),
			'list_kategori' => $this->Model->list_data_all('tb_kategori'),
			'list_afiliasi_dosen' => $this->Model->ambil('id_proposal',$id,'tb_afiliasi_dosen')->result(),
			'list_afiliasi_mhs' => $this->Model->ambil('id_proposal',$id,'tb_afiliasi_mhs')->result(),
			'list_mitra' => $this->Model->ambil('id_proposal',$id,'tb_mitra')->result(),
			'list_prodi' => $this->M_simuk->simuk->query("SELECT * FROM `tb_unit` WHERE `nama_unit` LIKE '%Program Studi%' ")->result(),

		);

		if ($waktu_sekarang  < $waktu_akhir) {
			$this->load->view('template/wrapper',$data);
		}else{
		echo '<script>alert("Maaf, waktu submit proposal sudah habis !")</script>';
            echo'<script>window.location.href="'.base_url().'/user/penelitian";</script>';
		}

		
	}

	public function create_usulan(){

	    $cek_ketua = $this->Model->ambil_banyak_kondisi('tb_usulan_proposal', array('ketua_peneliti' => $this->session->userdata('id'), 'jenis' => 'penelitian', 'delete' => '0', 'status' => 'diterima', 'didanai' => 'didanai') )->num_rows();
	    $waktu_sekarang = time();
	    $waktu_akhir = $this->Model->ambil('jenis','penelitian','tb_timeline')->row();
	    $waktu_akhir = strtotime($waktu_akhir->waktu_selesai);

	    if ($cek_ketua < 1 && $waktu_sekarang  < $waktu_akhir) {

			$last_id = $this->Model->max_id('tb_usulan_proposal','id_proposal','DESC');
			// var_dump(substr($last_id[0]->id_submission, 2,6));
			// var_dump(date('ymd')) ;
			// die();
	        if (empty($last_id[0]->id_proposal)) {
	            $id_proposal= "PR".date('ymd')."0001";
	        }else if(substr($last_id[0]->id_proposal, 2,6) == date('ymd')){
	        	$id_proposal= $this->Model->autonumber($last_id[0]->id_proposal,'8','4');
	        }else{
	            $id_proposal= "PR".date('ymd')."0001";
	        }

			$data = array(
				'id_proposal' => $id_proposal,
				'status' => 'diusulkan',
				'jenis' => 'penelitian',
			);

				
			$simpan = $this->Model->simpan_data($data, 'tb_usulan_proposal');

			if($simpan){
				 // echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil disimpan !</div>';
				//echo  redirect('admin/submission/detail/'.$id_submission, 'refresh');
				echo '<script>window.location.href="usulan/'.$id_proposal.'";</script>';
			}else{
				echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';		
			}

	}else{
		echo '<script>alert("Maaf, anda tidak boleh mengakses halaman ini")</script>';
            echo'<script>window.location.href="'.base_url().'/user/penelitian";</script>';
	}

	}


	public function ambil_usulan(){
		$id = $this->input->post('id',true);
		$data = $this->Model->ambil('id_usulan',$id,'tb_usulan')->row();
		echo json_encode($data);
	}

	public function ubah_usulan(){
		$id=$this->input->post('id_proposal', true);

		$ketua = explode(' - ', $this->input->post('nama_pegawai'));
		$prodi = explode(' - ', $this->input->post('nama_prodi'));

		// var_dump($ketua);
		// die();

		$data = array(
			'judul_penelitian' => $this->input->post('judul_penelitian', true),
			'abstrak_penelitian' => $this->input->post('abstrak_penelitian', true),
			'keyword' => $this->input->post('keyword', true),
			'id_kategori' => $this->input->post('id_kategori', true),
			'ketua_peneliti' => $ketua[0],
			'nama_ketua_peneliti' => $ketua[1],
			'tahun_diajukan' => $this->input->post('tahun_diajukan', true),
			'lama_penelitian' => $this->input->post('lama_penelitian', true),
			'biaya_diusulkan' => $this->input->post('biaya_diusulkan', true),
			'sumber_lain' => $this->input->post('sumber_lain', true),
			'status' => 'diusulkan',
			'kd_unit' => $prodi[0],
			'nama_prodi' => $prodi[1],

		);
		// var_dump($data);
		// die();

		$ubah = $this->Model->update('id_proposal', $id, 'tb_usulan_proposal', $data);
		if($ubah){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil diupdate !</div>';
            //echo'<script>location.reload();</script>';
		}else{
		    echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Gagal diupdate !</div>';
		}
	}

	public function simpan_afiliasi_dosen(){

		$dosen = explode(' - ', $this->input->post('afiliasi_dosen'));

		$cek_anggota = $this->Model->list_join_where_banyak('tb_usulan_proposal','tb_afiliasi_dosen','tb_usulan_proposal.id_proposal=tb_afiliasi_dosen.id_proposal', array('delete' => '0', 'status' => 'diterima', "id_anggota" => $dosen[0] , 'jenis' => 'penelitian','didanai' => 'didanai') )->num_rows();

		$cek_ketua = $this->Model->ambil_banyak_kondisi('tb_usulan_proposal', array('ketua_peneliti' => $dosen[0], 'delete' => '0', 'status' => 'diterima', 'didanai' => 'didanai', 'jenis' => 'penelitian') )->num_rows();

		$cek_all = $cek_anggota + $cek_ketua;

		var_dump($cek_ketua);
		var_dump($cek_anggota);

		// var_dump($cek_all);
		die();

		if ($cek_all >= 3 ) {
			echo '<script>alert("Maaf, orang ini tidak dapat ditambahkan lagi")</script>';
		}else{

				$data = array(
				'id_proposal' => $this->input->post('id_proposal', true),
				'id_anggota' => $dosen[0],
				'nama_anggota' => $dosen[1],
			);

			$simpan =  $this->Model->simpan_data($data, 'tb_afiliasi_dosen');
			if($simpan){
				echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil disimpan !</div>';
				echo '<script>location.reload();</script>';
			}else{
				echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';		
			}

		}

		
	}

	public function hapus_afiliasi_dosen(){
        $id=$this->input->post('id', true);
     
        //hapus tabel upload_mandiri
        $hapus = $this->Model->hapus('id_afiliasi_dosen',$id,'tb_afiliasi_dosen');
        if($hapus){
            echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil dihapus !</div>';
            echo'<script>location.reload();</script>';
        }else{
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Gagal dihapus !</div>';
        }
    }

	public function simpan_afiliasi_mhs(){
		$mhs = explode(' - ', $this->input->post('afiliasi_mhs'));
		// var_dump($mhs);
		// die();
		$data = array(
			'id_proposal' => $this->input->post('id_proposal', true),
			'id_anggota' => $mhs[0],
			'nama_mhs' => $mhs[1],
		);

		$simpan =  $this->Model->simpan_data($data, 'tb_afiliasi_mhs');
		if($simpan){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil disimpan !</div>';
			echo '<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';		
		}
	}

	public function hapus_afiliasi_mhs(){
        $id=$this->input->post('id', true);
     
        //hapus tabel upload_mandiri
        $hapus = $this->Model->hapus('id_afiliasi_mhs',$id,'tb_afiliasi_mhs');
        if($hapus){
            echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil dihapus !</div>';
            echo'<script>location.reload();</script>';
        }else{
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Gagal dihapus !</div>';
        }
    }

    public function simpan_mitra(){
		
		$data = array(
			'id_proposal' => $this->input->post('id_proposal', true),
			'nama_mitra' => $this->input->post('nama_mitra', true),
			'propinsi' => $this->input->post('propinsi', true),
			'kabupaten' => $this->input->post('kabupaten', true),
			'jarak_lokasi' => $this->input->post('jarak_lokasi', true),
		);

		$simpan =  $this->Model->simpan_data($data, 'tb_mitra');
		if($simpan){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil disimpan !</div>';
			echo '<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';		
		}
	}

	public function hapus_mitra(){
        $id=$this->input->post('id', true);
     
        //hapus tabel upload_mandiri
        $hapus = $this->Model->hapus('id_mitra',$id,'tb_mitra');
        if($hapus){
            echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil dihapus !</div>';
            echo'<script>location.reload();</script>';
        }else{
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Gagal dihapus !</div>';
        }
    }

	public function hapus_usulan(){
		$id = $this->input->post('id', true);
		//hapus tabel usulan
		$data = array(
			'delete' => '1',
			'delete_by' => $this->session->userdata('nama'),
			'delete_when' => date('Y-m-d:H-i-s'),
		);


		$hapus = $this->Model->update('id_proposal', $id, 'tb_usulan_proposal', $data);

		if($hapus){
		echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil dihapus !</div>';
            echo'<script>location.reload();</script>';
        }else{
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Gagal dihapus !</div>';
        }

	}

	public function upload_proposal(){

		if (!is_uploaded_file($_FILES['file_proposal']['tmp_name'])) {
            //jika tidak ada file
            
                echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-barang="close">&times;</a> File Tidak Boleh Kosong !</div>';

        }else{

			$id = $this->session->userdata('id').'_'.$this->input->post('id_proposal', true).'_proposal';        	
        	
            $config ['upload_path'] = './assets/file_upload/';
            $config ['allowed_types'] = 'pdf|PDF';
            $config ['max_size'] = '2048';
            //$config ['file_name'] = $id;
            $this->upload->initialize($config);

            // var_dump($id);
            // die();

   //          if (!is_dir('./assets/file_upload/'.$path) ) {
			//     mkdir('./assets/file_upload/' . $path, 0777, TRUE);
			// }

            if ( ! $this->upload->do_upload('file_proposal')){
                $error = $this->upload->display_errors();
                // var_dump($error);
                // die();

                echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> '.$error.' </div>';
                }else{

           //      	$pathnya = './assets/file_upload/';
			        // $filenya = $id;

			        // var_dump($pathnya.$filenya);
			        // die();

			        // if (file_exists($pathnya.$filenya)) {
			        // 	 unlink($pathnya.$filenya);
			        // }

                  $upload_data = $this->upload->data();

                  $data = array(
                
                    // 'kode_barang_simak' => $this->input->post('kode_barang_simak'),
                    'nama_file' => $upload_data['file_name'],
                    'id_proposal' => $this->input->post('id_proposal', true),
                    'status' => 'proposal',
                    
                    );
                  // var_dump($data);
                  // die();
			        

                    $upload = $this->Model->simpan_data($data, 'tb_file_upload');
                    if($upload){
                        echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-barang="close">&times;</a> Berhasil diupload !</div>';
                        echo'<script>location.reload();</script>';
                    }else{
                        echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-barang="close">&times;</a> Gagal diupload !</div>';
                    }
            }
        }
	}

	public function cetak_pengesahan($id){

		$data = array(
			'page' => 'cetak_pengesahan2',
			'link' => 'penelitian',
			'script' => 'script/penelitian_user',
			'list' => $this->Model->ambil('id_proposal',$id,'tb_usulan_proposal')->row(),
		);
		$this->load->view('cetak_pengesahan2', $data);

	}

	public function hapus_file_proposal(){
		$id = $this->input->post('id_proposal_', true);
		// var_dump($id);
		// die();
		//hapus usulan

		$pathnya = './assets/file_upload/';
		$filenya = $id;

        if (file_exists($pathnya.$filenya)) {
        	 unlink($pathnya.$filenya);
        }

		$hapus = $this->Model->hapus('id_proposal',$id,'tb_file_upload');

		if($hapus){
		echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil dihapus !</div>';
            echo'<script>location.reload();</script>';
        }else{
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Gagal dihapus !</div>';
        }

	}

	public function ambil_file(){
		$id = $this->input->post('id', true);

		$data = $this->Model->ambil('id_proposal',$id,'tb_file_upload');
		if ($data->num_rows() == 0) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Data tidak ada !</div>';
		}else{
			echo '<object width="100%" height="800" data="'.base_url().'assets/file_upload/'.$data->row()->nama_file.'" type="application/pdf"></object>';
		}
	}

	public function ambil_komentar(){
		$id = $this->input->post('id', true);

		$data = $this->Model->ambil('id_proposal',$id,'tb_usulan_proposal');
		if ($data->num_rows() == 0) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Data tidak ada !</div>';
		}else{
			echo ''.$data->row()->komentar.'';
		}
	}

	public function cek_nilai($id){
		$data = array(
			'page' => 'cek_nilai',
			'link' => 'penelitian',
			'script' => '',
			'list' => $this->Model->ambil('id_proposal', $id, 'tb_review_proposal')->result(),
		);
		$this->load->view('template/wrapper', $data);
	}


}