<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error404 extends CI_Controller {

	public function __construct(){
        parent::__construct();

    }

   

    //PAGE NOT FOUND PAGE
	public function index(){
		 //$this->load->model('web_model');  
		$this->output->set_status_header('404');
		$data['pageTitle']="Contact Us";
		//$this->load->view('parts/head',$data);
		$this->load->view('error404');		
		//$this->load->view('parts/bottom',$data);


	}




	
}


