<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SIObat extends CI_Model
{

    public $table = 'siobat';//nama tabel buku

    function __construct()
    {
        parent::__construct();
    }

    public function get_by_id($tab,$param,$id)//mengambil data berdasarkan id pada tabel buku
    {
        $this->db->from($tab);//mengambil database dari tabel (tabel buku)
        $this->db->where($param,$id);//dimana kdbuku= id ?
        $query = $this->db->get();//get ambil datanya
        return $query;//dikembalikan datanya ke controller
    }

    // get all
    function getOrder($param1,$order,$tab)
    {
        $this->db->order_by($param1, $order);
        $data =  $this->db->get($tab);
        return $data;
    }

    public function insertData($tab,$data){//meng-insertkan data sesuai parameter
        $this->db->insert($tab, $data);//otomatis insert ke dalam tabel (tabel buku) sesuai semua inputan (controller)
        //hasil generate seperti insert into database ....
    }

    public function insertDataDB($tab,$data){//meng-insertkan data sesuai parameter
        $this->db->insert($tab, $data);//otomatis inser ke dalam tabel (nama tabel ditentukan di controller) dan sesuai semua inputan (controller), karena basisnya ini parameter
    }

    public function AlterIncrement($table,$val){//meng alter tabel
        $this->db->query("ALTER TABLE $table AUTO_INCREMENT = $val");//reset auto increment sesuai value parameter (controller)
    }

    public function getAll($tab){//menampilkan semua data
        //$data = $this->db->from($this->table);
        $data = $this->db->get($tab);//mencari semua data dari sebuah tabel sesuai parameter (nama tabel via controller)
        ////hasil generate seperti select * from nametable  
        return $data;//mengembalikan nilai data query
    }

    public function getWhere($tab,$data){//mencari data berdasrkan parameter
        $this->db->where($data);//dimana parameter yang mau dicari
        $data = $this->db->get($tab);//pada tabel apa parameter itu dijalankan ?
        return $data;//mengambalikan hasil query
    }

    public function getUpdate($tab,$where, $data)//mengupdate data
    {
        $this->db->update($tab, $data, $where);//update data pada tabel (tabel buku), nilai datanya, parameter acuan didatabase semisal idnya
        return $this->db->affected_rows(); //kembalikan hasil query (affect row, true or false)
    }

    public function deleteData($code,$param,$tab){//menghapus data
        $this->db->where($param, $code);//parameter apa yang jadi patokan ? dan code inputannya ?
        $this->db->delete($tab);//pada tabel apa data itu ?
    }

    public function getviaQuery($que){//mengambil berdasarkan query manual
        $this->db->query($que);//mengambilkan data berdasrkan query manual
        //manual disini langsung ditulis seperti select * freom dst
    }

}
