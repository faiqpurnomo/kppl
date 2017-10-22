<?php
class Display extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('email');
	}

	function session() {
		if ($this->session->userdata('status') != 'siap') {
			//var_dump($this->session->userdata('status'));die();
			redirect('display');
		}
	}

	function index() {
		$this->load->view('index');
		
		$data['err_message'] = "";
	}

	function login(){
		$this->load->view('user/login');
		$data['err_message'] = "";
	}

	function register(){
		$this->load->view('user/register');
		$data['err_message'] = "";
	}

	function loginadmin(){
		$this->session();
		$this->load->view('admin/loginadmin');
		$data['err_message'] = "";
	}

}
?>