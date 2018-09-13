<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{

	function __construct() {//konstruktor
        parent::__construct();
    }

	public function Index(){
		//khusus login
        $this->load->view('login');//memanggil file view
	}

	public function proseslogin(){
		//form  validationnya gan
		$this->form_validation->set_error_delimiters('<div class="error alert alert-danger">', '</div>');//semua pessan error ditampilkan oleh script delimiter ini dengan format div dst tersebut
		$this->form_validation->set_rules('username','Username','required',array(
																			'required'=>'<h5>Username tidak boleh kosong gan</h5>'));//rule pada input username tidak boleh kosong
		$this->form_validation->set_rules('password','Password','required|min_length[2]',array(
																			'required'=>'<h5>Password tidak boleh kosong gan</h5>',
																			'min_length'=>'<h5>Password minimal 2 char</h5>'));//rule pada input password tidak boleh kosong dan minimal 2 karakter

		if($this->form_validation->run()==false){
			//jika tidak sesuai yang diminta muncul validasinya
			$this->index(); ///script ini lemah tidak seperti redirect menurut saya
			//redirect('dashboard/login');//redirect ini seperti akses action pada form, jadi perlu refresh page
		}else{
			//jika benar valid dicek dulu seperti security dan kesesuaian di dbnya, jika tidak sesuai redirect login
			$u = $this->security->xss_clean($this->input->post('username'));//data post username dicek clean dari XSS (Cross Scripting) tidak
	        $p = $this->security->xss_clean($this->input->post('password'));//data post password dicek clean dari XSS (Cross Scripting) tidak, kemudian dibungkus dngan hash md5
	        $dtlogin = array(
	        	'username' => $u,//variabel username ditampung ke array
	        	);
	         
	        $q_cek  = $this->SIObat->getWhere('user',$dtlogin);//mengecek array diatas ke tabel user, digenerate oleh model yang mana hasilnya jika dengan query biasa yaitu select * from user where username=$u and pasword=$p atau tidak
	        $j_cek  = $q_cek->num_rows();//number of row, jika lebih dari 0 maka ada datanya
	        $d_cek  = $q_cek->row();//mengakses database user pada kolomnya tidak seperti result yang harus ditampung kedalam array / fetch array / foreach

	        if($j_cek == 1) {//nilai num row apakah 1 (true) / ada ?    	
		        if($this->password->verify_hash($p, $d_cek->password)){
		        	//jika ada aksessesuai kolomnya
		            $data = array(
		                    'nama' => $d_cek->nama,//row nama
		                    'level' => $d_cek->lv,//row level
		                    'validated' => true //menandakan validasi nanti untuk session
		                    );
		            $this->session->set_userdata($data);//data array diatas ditampung ke session
		            redirect('obat');//redirect ke index
		        } else {
	        	//jika salah tampil pesan
	            $this->session->set_flashdata("k", "<div style='font-size:12px;' class='alert alert-danger'> 
	                                    Username / Password anda salah        
	                                </div>");//pesan kesalahannya
	            redirect('dashboard');//dan redirect ke function login
		        }
	        } else {
	        	//jika salah tampil pesan
	            $this->session->set_flashdata("k", "<div style='font-size:12px;' class='alert alert-danger'> 
	                                    Username tidak terdaftar       
	                                </div>");//pesan kesalahannya
	            redirect('dashboard');//dan redirect ke function login
	        }			
		}
    }

    public function logout(){
        $this->session->sess_destroy();//semua session dihancurkan
        redirect('obat');//redirect ke function atur(file ini, yaitu index)
    }

}