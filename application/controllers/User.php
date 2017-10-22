<?php
class User extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('User_Model');
		$this->load->library('upload');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->library('form_validation');
		//$this->load->library('email');
		//$this = get_instance();
	}

	function session() {
		if ($this->session->userdata('status') != 'siap') {
			//var_dump($this->session->userdata('status'));die();
			redirect('display');
		}
	}


	function login() {
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('pass', 'Password', 'required');

		if($this->form_validation->run() == false){
			redirect('Display/login');
		}
		else
		{
		$email = $this->input->post('email');
		$password = $this->input->post('pass');
		$isLogin = $this->User_Model->login_authen($email, $password);
		$read = $this->User_Model->getData($email);
		$nama = $read['nama'];

			if ($isLogin == true) {
				$this->session->set_userdata('email', $email);
				$this->session->set_userdata('nama', $nama);
				$this->session->set_userdata('status', 'siap');
				$this->load->view('user/dashboard1');
			}
			else
			{
				$this->load->view('user/gagallogin');
			}
		}
	}

	function register() {
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('nohandphone', 'No Handphone', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('password2', 'Password2', 'required');

		if($this->form_validation->run() == false){
			redirect('Display/register');
		}
		else{
		$pass = $this->input->post('password');
		$pass2 = $this->input->post('password2');

		if ($pass != $pass2) {
			$data['err_message'] = "Password tidak cocok!";
			$this->load->view(user/register);
		} else {

		$data = array(
			'nama' => $this->input->post('nama'),
			'nohandphone' => $this->input->post('nohandphone'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password')
		);
		
		$this->User_Model->addUserdata($data);
		$this->load->view('user/registersuccess');
		}}
	}


	function readData() {
		$this->session();
		$data = $this->User_Model->getHistory();
		$this->load->view('user/history', array('data' => $data));
	}

	function showDashboard1(){
		$this->session();
		$this->load->view('user/dashboard1');
		$data['err_message'] = "";
	}

	function showPrint(){
		$this->session();
		$this->load->view('user/print');
		$data['err_message'] = "";
		
	}

	function showHistory(){
		$this->session();
		$this->load->view('user/history', array('data' => $data));
		$data['err_message'] = "";
	}

	function logout(){
		$this->session->sess_destroy();
		redirect();
	}

	/*public function print(){
		$is_submit = $this->input->post('is_submit');
		
		if(isset($is_submit) && $is_submit == 1){
			$fileUpload = array();
		 	$isUpload = FALSE;
		 	$config = array(
		 		'upload_path' => './uploads/',
		 		'allowed_types' => 'doc|docx|pdf',
		 		'max_size' => 15000
		 	);

			$this->upload->initialize($config);
		
			if($this->upload->do_upload('userfile')){
				$fileUpload = $this->upload->data();
			 	$isUpload = TRUE;
			}

			if($isUpload){
			 	$data =array(
			 		'tgl_order' => date('j F Y'),
					'email' => $this->session->userdata('email'),
					'ukuran_krts' => $this->input->post('ukuran_krts'),
					'warna' => $this->input->post('warna'),
					'jumlah_copy' => $this->input->post('jumlah_copy'),
					'tgl_ambil' => $this->input->post('tgl_ambil'),
					'waktu' => $this->input->post('waktu'),
					'pesan' => $this->input->post('pesan'),
					'file' => $fileUpload['file_name'],
					'status'=> 'Proses'
			 	);
				
				$this->User_Model->addOrder($data);
			 	//redirect('user/showDashboard1');
			 	$this->load->view('user/showDashboard1');
			}
		} else {
		 	$this->load->view('user/print');
		}
	}*/
}
?>