<?php
class Display extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('email');
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
		$this->load->view('admin/loginadmin');
		$data['err_message'] = "";
	}

}
?>