<?php


class Model extends CI_Model {

    public function __construct(){
        parent::__construct();
        $this->default = $this->load->database('default', TRUE);
    }
    
    function simpan_data($data, $table){
        $this->default->insert($table,$data);
        return true;
    }
    
    function simpan_batch($data, $table){
        $this->default->insert_batch($table,$data);
        return true;
    }

    function rubah_batch($data,$table,$id){
        $this->default->update_batch($table, $data, $id);
        return true;
    }
    
    function list_data($table, $limit, $start){
         return $query = $this->default->get($table, $limit, $start)->result();  
    }

    function list_data_all($table){
         return $query = $this->default->get($table)->result();  
    }
    
    function hitung($param_id, $id, $table){
        return $this->default->get_where($table, array($param_id => $id))->num_rows();
    }
    
    function hapus($param_id, $id, $table){
        $this->default->delete($table, array($param_id => $id)); 
        return true;
    }
    
    function ambil($param_id, $id, $table){
       return $this->default->get_where($table, array($param_id => $id));
    }

    function list_join($table1, $table2, $param){
        $this->default->select('*');
        $this->default->from($table1);
        $this->default->join($table2, $param);
        return $query = $this->default->get()->result();
    }

    function list_join_order_where($table1, $table2, $param, $kondisi_param, $id_kondisi_param, $order_,$by){
        $this->default->select('*');
        $this->default->from($table1);
        $this->default->join($table2, $param);
        $this->default->where($kondisi_param, $id_kondisi_param);
        $this->default->order_by($order_, $by);
        return $query = $this->default->get()->result();
    }

    function list_join_where($table1, $table2, $param, $kondisi_param, $id_kondisi_param){
        $this->default->select('*');
        $this->default->from($table1);
        $this->default->join($table2, $param);
        $this->default->where($kondisi_param, $id_kondisi_param);
        return $query = $this->default->get();
    } 

    function list_join_where_banyak($table1, $table2, $param, $kondisi){
        $this->default->select('*');
        $this->default->from($table1);
        $this->default->join($table2, $param);
        $this->default->where($kondisi);
        return $query = $this->default->get();
    } 
    
    function update($param_id, $id, $table, $data){       
        $this->default->where($param_id, $id);
        $this->default->update($table, $data); 
        return true;
    }

    function autocomplete($table, $param_table, $id){
        //$this->default->order_by('id', 'DESC');
        $this->default->like($param_table, $id);
        $this->default->limit(5);
        return $this->default->get($table);
    }

    function autonumber($id_terakhir, $panjang_kode, $panjang_angka) {
 
    // mengambil nilai kode ex: KNS0015 hasil KNS
    $kode = substr($id_terakhir, 0, $panjang_kode);
 
    // mengambil nilai angka
    // ex: KNS0015 hasilnya 0015
    $angka = substr($id_terakhir, $panjang_kode, $panjang_angka);
 
    // menambahkan nilai angka dengan 1
    // kemudian memberikan string 0 agar panjang string angka menjadi 4
    // ex: angka baru = 6 maka ditambahkan strig 0 tiga kali
    // sehingga menjadi 0006
    $angka_baru = str_repeat("0", $panjang_angka - strlen($angka+1)).($angka+1);
 
    // menggabungkan kode dengan nilang angka baru
    $id_baru = $kode.$angka_baru;
 
    return $id_baru;
    }

    function max_id($table,$field,$param){
        $this->default->select($field);
        $this->default->from($table);
        $this->default->order_by($field,$param);
        $this->default->limit(1);
        return $query = $this->default->get()->result();

    }

    function group($field,$table,$param){
        $this->default->select($field);
        $this->default->from($table);
        $this->default->group_by($param);
        return $this->default->get()->result();
    }

    function group_where($field,$table,$param,$param_id, $id){
        $this->default->select($field);
        $this->default->from($table);
        $this->default->where($param_id, $id);
        $this->default->group_by($param);
        return $this->default->get()->result();
    }

    function group_where_banyak($field,$table,$kondisi,$param){
        $this->default->select($field);
        $this->default->from($table);
        $this->default->where($kondisi);
        $this->default->group_by($param);
        return $this->default->get()->result();
    }

    function sum_group($field,$table,$param){
        $this->default->select_sum($field);
        $this->default->from($table);
        $this->default->group_by($param);
        return $query = $this->default->get();
    }

    function ambil_banyak_kondisi($table, $kondisi){
        return $this->default->get_where($table, $kondisi);
    }

    function ambil_banyak_kondisi_order($table, $kondisi, $field, $param){
        $this->default->select('*');
        $this->default->from($table);
        $this->default->where($kondisi);
        $this->default->order_by($field,$param);
        return $this->default->get();
    }

    function jumlah($field,$table,$kondisi_param,$id_kondisi_param){
        $this->default->select_sum($field);
        $this->default->from($table);
        $this->default->where($kondisi_param, $id_kondisi_param);
        return $query = $this->default->get();
    }

    
}