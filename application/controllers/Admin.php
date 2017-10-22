<?php
class Admin extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Admin_model');
		$this->load->library('session');
		$this->load->helper('download');
		$this->load->library('form_validation');
	}

	function session() {
		if ($this->session->userdata('status') != 'siap') {
			redirect('display');
		}
	}

	function login() {
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('pass', 'pass', 'required');

		if($this->form_validation->run()==false)
		{
			redirect('display/loginadmin');
		}
		else
		{

		$username = $this->input->post('username');
		$pass = $this->input->post('pass');
		$isLogin = $this->Admin_model->login_authenAdmin($username, $pass);
		$read = $this->Admin_model->getDataAdmin($username);

		$i = $this->Admin_model->authen_admin($username);
		}

		if ($isLogin == true /*&& $i[0]['authentication'] < 3*/) {
			$this->session->set_userdata('username', $username);
			$this->session->set_userdata('status', 'siap');
			$this->load->view('admin/dashboardadmin');
		/*} else {
			if ($i[0]['authentication'] < 3) {
				$update = $this->Admin_model->wrong_passwordAdmin($username, $i[0]['authentication']+1);
				$data['err_message'] = "" . ($i[0]['authentication']+1);
				$this->load->view('display/loginadmin', $data);
			} else {
				$data['err_message'] = "AKUN ANDA TERBLOCK";
				$this->load->view('display/loginadmin', $data);
				$this->session->sess_destroy();
			}*/
		}
		else {
			$error = 'error_message';
			$this->load->view('admin/loginadmin', $error);
		}
		$this->session();
	}

	function addAdmin() {
		$this->session();
		$pass = $this->input->post('password');
		$pass2 = $this->input->post('password2');

		if ($pass != $pass2) {
			$data['err_message'] = "Password tidak cocok!";
			$this->load->view(user/register);
		} else {

		$data = array(
			'username' => $this->input->post('username'),
			'pass' => $this->input->post('password')
		);
		
		$this->Admin_model->addAdmindata($data);
		$this->load->view('admin/dashboardadmin');
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect();
	}

	function readData() {
		$this->session();
		$data = $this->Admin_model->getData();
		$this->load->view('admin/datauser', array('data' => $data));
	}

	function readData2() {
		$this->session();
		$data = $this->Admin_model->getDataAdmin2();
		$this->load->view('admin/dataadmin', array('data' => $data));
	}
/*
	function downloadFile(){
		$data = $this->Admin_model->getFile($id);
		foreach ($data as $r) {
			$file = $r['file'];
		}

		$files = file_get_contents('./uploads/');

		force_download($files, 'file');
	}
*/
	function hapus($delete){
		$this->session();
		$this->Admin_model->hapus($delete);
		$this->dataHistory();
	}

	function hapusAdmin($delete){
		$this->session();
		$this->Admin_model->hapusAdmin($delete);
		$this->readData2();
	}

	function delete_item($item){
		$this->session();
		$this->db->where_in('email', $item);
		$this->db->delete('userdata');
	}

	function delete_admin($item){
		$this->session();
		$this->db->where_in('username', $item);
		$this->db->delete('admin');
	}

	function dataHistory() {
		$this->session();
		$data = $this->Admin_model->getDataHistory();
		$this->load->view('admin/historyadmin', array('data' => $data));
	}

	function dataAdmin() {
		$this->session();
		$data = $this->Admin_model->getDataAdmin2();
		$this->load->view('admin/dataadmin', array('data' => $data));
	}

	function dashboardadmin(){
		$this->session();
		$this->load->view('admin/dashboardadmin');
		$data['err_message'] = "";
	}

	function datauser(){
		$this->session();
		$this->load->view('admin/datauser');
		$data['err_message'] = "";
	}

	function showUpdateorder(){
		$this->session();
		$this->load->view('admin/updateorder');
		$data['err_message'] = "";
	}

	function historyadmin(){
		$this->session();
		$this->load->view('admin/historyadmin', array('data'=>$data));
		$data['err_message']="";
	}

	function tambahAdmin(){
		$this->session();
		$this->load->view('admin/addadmin');
		$data['err_message'] = "";
	}

	function update($baru) {
		$this->session();
		$data = $this->Admin_model->getItem($baru);
		$item = array (
			'id' => $data[0]['id'],
			'email' => $data[0]['email'],
			'tgl_order' => $data[0]['tgl_ambil'],
			'waktu' => $data[0]['waktu'],
			'jumlah_copy' => $data[0]['jumlah_copy'],
			'file' => $data[0]['file'],
			'status' => $data[0]['status']
		);		
		$this->load->view('admin/updateorder', $item);
	}

	function updateOrder() {
		$this->session();
		$status = $this->input->post('status');		
		$id = $this->input->post('id');
		$data = $this->Admin_model->getItem($id);
		
		$update = array(
			'status' => $this->input->post('status')
		);
		
		$this->Admin_model->Update($update, $id);
		$this->dataHistory();
	}

	function userupdate() {
		$this->session();
		$authentication = $this->input->post('authentication');		
		$email = $this->input->post('email');
		$data = $this->Admin_model->getUser($email);
		
		$update = array(
			'authentication' => $this->input->post('authentication')
		);
		
		$this->Admin_model->updateUser($update, $email);
		$this->readData();
	}

	function updateDataUser($baru) {
		$this->session();
		$data = $this->Admin_model->getUser($baru);
		$item = array (
			'nama' => $data[0]['nama'],
			'nohandphone' => $data[0]['nohandphone'],
			'email' => $data[0]['email'],
			'password' => $data[0]['password'],
			'authentication' => $data[0]['authentication']
		);		
		$this->load->view('admin/updatedatauser', $item);
	}
}
?>