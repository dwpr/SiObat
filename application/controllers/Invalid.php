<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invalid extends CI_Controller{

	function __construct() {
        parent::__construct();
    }

	public function Index(){
        $data = array(
        	'title' => 'Invalid Page', //judul page
        	'content' => 'main/invalid', //nama file view
        	);
        $this->parser->parse('template',$data);//memparsing data array diatas ke file template (view tetap)
	}
}