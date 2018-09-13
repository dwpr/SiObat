<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat extends CI_Controller{

	function __construct() {//konstruktor
        parent::__construct();
    }

	public function Index(){
        $data = array(
        	'title' => 'Beranda', //merk page
        	'content' => 'main/content_home', //nama file view
        	);
        $this->parser->parse('template',$data);//memparsing data array diatas ke file template (view tetap)
	}

	public function Sintesis(){
		$data  = array(
			'title' => 'Obat Sintesis',
			'content' => 'main/Sintesis',
			'obat' => $this->SIObat->getOrder("nama_obat","ASC","obat_sintesis")->result(),
		);

		//for sub menu only gan
		$ke=$this->uri->segment(3); //sub menu atau function dari sintesis (cek url untuk lebih jelasnya)
        $code = $this->uri->segment(4); //sub juga tapi digunakan untuk beberapa data param non ajax
		if($ke=="tambah"){//ke segment / url tambah
			if($this->input->post('foto')==NULL){
				$fot = "no_foto.png";
			}else{
				$fot = $this->input->post('foto');
			}
			$data = array(//data array
				'nama_obat' => ucfirst($this->input->post('nama_obat')),
				'merk' => ucfirst($this->input->post('merk')),
				'indikasi' => ucfirst($this->input->post('indikasi')),
				'aturan_pakai' => ucfirst($this->input->post('aturan_pakai')),
				'efek' => ucfirst($this->input->post('efek')),
				'keterangan' => ucfirst($this->input->post('keterangan')),
				'foto' => $fot,
				);
				$this->SIObat->AlterIncrement("obat_sintesis","1");
				$this->SIObat->insertData("obat_sintesis",$data);
                $this->session->set_flashdata("k", "<div class=\"alert alert-success\">Obat berhasil ditambahkan</div>");
                redirect('obat/sintesis');
        }else if($ke=="delete"){//ke segment / url delete
        	$this->SIObat->deleteData($code,'id_obat','obat_sintesis');
			$this->SIObat->AlterIncrement("obat_sintesis","1");
            $this->session->set_flashdata("k", "<div class=\"alert alert-danger\">Obat berhasil dihapus</div>");
            redirect('obat/sintesis');
    	}else if($ke=="edit"){//ke segment edit
			if($this->input->post('foto')==NULL){
				$fot = "no_foto.png";
			}else{
				$fot = $this->input->post('foto');
			}
			$data = array(//data array
				'nama_obat' => ucfirst($this->input->post('nama_obat')),
				'merk' => ucfirst($this->input->post('merk')),
				'indikasi' => ucfirst($this->input->post('indikasi')),
				'aturan_pakai' => ucfirst($this->input->post('aturan_pakai')),
				'efek' => ucfirst($this->input->post('efek')),
				'keterangan' => ucfirst($this->input->post('keterangan')),
				'foto' => $fot,
				);
			$this->SIObat->getUpdate("obat_sintesis",array('id_obat' => $this->input->post('id_obat')), $data);
			echo json_encode(array("status" => TRUE));
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\">Obat berhasil diedit</div>");
            redirect('obat/sintesis');
    	}else if($ke=="getobatbyid"){
			$datanya = $this->SIObat->get_by_id("obat_sintesis","id_obat",$code);
			$datanya2 = $datanya->row();
			echo json_encode($datanya2);
		}else{
			$this->parser->parse('template',$data);
		} 
	}

	public function herbal(){
		$data  = array(
			'title' => 'Obat Herbal',
			'content' => 'main/herbal',
			'obat' => $this->SIObat->getOrder("nama_tanaman","ASC","obat_herbal")->result(),
		);

		//for sub menu only gan
		$ke=$this->uri->segment(3); //sub menu atau function dari herbal (cek url untuk lebih jelasnya)
        $code = $this->uri->segment(4); //sub juga tapi digunakan untuk beberapa data param non ajax
		if($ke=="tambah"){//ke segment / url tambah
			if($this->input->post('foto')==NULL){
				$fot = "no_foto.png";
			}else{
				$fot = $this->input->post('foto');
			}
			$data = array(//data array
				'nama_tanaman' => ucfirst($this->input->post('nama_tanaman')),
				'indikasi' => ucfirst($this->input->post('indikasi')),
				'cara_pakai' => ucfirst($this->input->post('cara_pakai')),
				'keterangan' => ucfirst($this->input->post('keterangan')),
				'foto' => $fot,
				);
				$this->SIObat->AlterIncrement("obat_herbal","1");
				$this->SIObat->insertData("obat_herbal",$data);
                $this->session->set_flashdata("k", "<div class=\"alert alert-success\">Obat berhasil ditambahkan</div>");
                redirect('obat/herbal');
        }else if($ke=="delete"){//ke segment / url delete
        	$this->SIObat->deleteData($code,'id_obat','obat_herbal');
			$this->SIObat->AlterIncrement("obat_herbal","1");
            $this->session->set_flashdata("k", "<div class=\"alert alert-danger\">Obat berhasil dihapus</div>");
            redirect('obat/herbal');
    	}else if($ke=="edit"){//ke segment edit
			if($this->input->post('foto')==NULL){
				$fot = "no_foto.png";
			}else{
				$fot = $this->input->post('foto');
			}
			$data = array(//data array
				'nama_tanaman' => ucfirst($this->input->post('nama_tanaman')),
				'indikasi' => ucfirst($this->input->post('indikasi')),
				'cara_pakai' => ucfirst($this->input->post('cara_pakai')),
				'keterangan' => ucfirst($this->input->post('keterangan')),
				'foto' => $fot,
				);
			$this->SIObat->getUpdate("obat_herbal",array('id_obat' => $this->input->post('id_obat')), $data);
			echo json_encode(array("status" => TRUE));
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\">Obat berhasil diedit</div>");
            redirect('obat/herbal');
    	}else if($ke=="getobatbyid"){
			$datanya = $this->SIObat->get_by_id("obat_herbal","id_obat",$code);
			$datanya2 = $datanya->row();
			echo json_encode($datanya2);
		}else{
			$this->parser->parse('template',$data);
		} 		
	}

	public function Dashboard(){
		redirect('dashboard');
	}
}