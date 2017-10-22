<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Admin_test extends TestCase
{
	public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->Model('Admin_model');
    }
	/*    public function setUp()
    {
        $this->resetInstance();
    }
    */
    

	public function test_submit_masuk(){
        //$this->assertFalse( isset($_SESSION['email']) );
        $this->request('POST', 'admin/login',
            [
                'username' => 'admin',
                'pass' => 'admin123',
            ]);
        //$this->assertRedirect('');
        //$this->assertEquals('admin', $_SESSION['username']);
    }
    public function test_submit_masuk_kosong(){
        //$this->assertFalse( isset($_SESSION['email']) );
        $this->request('POST', 'admin/login',
            [
                'username' => '',
                'pass' => '',
            ]);
        //$this->assertRedirect('');
        //$this->assertEquals('admin', $_SESSION['username']);
    }

     public function test_submit_masuk_sala(){
        //$this->assertFalse( isset($_SESSION['email']) );
        $this->request('POST', 'admin/login',
            [
                'username' => 'aa',
                'pass' => 'ddd',
            ]);
        //$this->assertRedirect('');
        //$this->assertEquals('admin', $_SESSION['username']);
    }
    public function test_viewdashboardadmin()
	{
		$output = $this->request('GET', 'admin/dashboardadmin');
		$this->assertContains('<p>Menu untuk menambah admin</p>', $output);
	}

	
	public function test_viewdatauser()
	{
		$output = $this->request('GET', 'admin/datauser');
		$this->assertContains('<td><strong>Authentication</strong></td>', $output);
	}

	public function test_viewupdateorder()
	{
		$output = $this->request('GET', 'admin/showUpdateorder');
		$this->assertContains('<h3>UPDATE ORDER</h3>', $output);
	}

	public function test_viewhistoryadmin()
	{
		$output = $this->request('GET', 'admin/historyadmin');
		$this->assertContains('<h2>HISTORI ORDER</h2>', $output);
	}

	public function test_viewtambahadmin()
	{
		$output = $this->request('GET', 'admin/tambahAdmin');
		$this->assertContains('<h1>Daftar Baru</h1>', $output);
	}

	public function test_viewdataadmin()
	{
		//$_SESSION['username'] = "admin";
		$output = $this->request('GET', 'admin/dataAdmin');
		$this->assertContains('<h2>DATA ADMIN</h2>', $output);
	}
	public function test_viewdatahistory()
	{
		$output = $this->request('GET', 'admin/dataHistory');
		$this->assertContains('<h2>HISTORI ORDER</h2>', $output);
	}
	public function test_viewreaddata()
	{
		$output = $this->request('GET', 'admin/readData');
		$this->assertContains('<h2>DATA USER</h2>', $output);
	}

	public function test_viewreaddata2()
	{
		$output = $this->request('GET', 'admin/readData2');
		$this->assertContains('<h2>DATA ADMIN</h2>', $output);
	}

    public function test_submit_masuk_salah(){
        //$this->assertFalse( isset($_SESSION['email']) );
	        $this->request('POST', 'admin/login',
	            [
	                'username' => 'admin',
	                'pass' => 'admin12',
	            ]);
        //$this->assertRedirect('');
        $this->assertFalse( isset($_SESSION['username']) );
    }
  
    public function test_updateDataUser(){
        //$this->assertFalse( isset($_SESSION['email']) );
	        $this->request('POST', 'admin/updateDataUser/a@gmail.com',
	            [
	                'name' => 'ijul'
	            ]);

    }
    public function test_updateTransaksi(){
        //$this->assertFalse( isset($_SESSION['email']) );
	        $this->request('POST', 'admin/update/29');

    }
    public function test_updateOrder(){
        //$this->assertFalse( isset($_SESSION['email']) );
	        $this->request('POST', 'admin/updateOrder/29');
    }
    public function test_userupdate(){
        //$this->assertFalse( isset($_SESSION['email']) );
	        $this->request('POST', 'admin/userupdate/a@gmail.com');
    }
    public function test_hapusData(){
        //$this->assertFalse( isset($_SESSION['email']) );
	        $this->request('POST', 'admin/hapus/25');
        //$this->assertRedirect('');
    }
    public function test_hapusAdmin(){
        //$this->assertFalse( isset($_SESSION['email']) );
	        $this->request('POST', 'admin/hapusAdmin/fiko');

    }

  //    public function test_submit_masuk_block(){
  //       //$this->assertFalse( isset($_SESSION['email']) );
	 //    $this->request('POST', 'admin/login',
	 //            [
	 //                'username' => 'admin',
	 //                'pass' => 'admin12',
	 //            ]);
	 //    $output = $this->request('GET', 'admin/dashboardadmin');
		// $this->assertContains(' <p>Menu untuk data user</p>', $output);
        
  //       //$this->assertRedirect('');
  //       //$this->assertFalse( isset($_SESSION['username']) );
  //   }
  //   public function test_addAdmin_berhasil() {
  //       $this->request('POST', 'admin/addAdmin',
  //           [
  //               'username' => '986',
  //               'password' => '8787',
  //               'password2'    => '8787',
  //           ]);
       
  //   }

    
  //   public function test_addAdmin_gagal() {
  //       $this->request('POST', 'admin/addAdmin',
  //           [
  //               'username' => '098',
  //               'password' => '8787',
  //               'password2'    => '8786',
  //           ]);
        
  //   }

    public function test_logout()
	{
		$this->assertFalse( isset($_SESSION['username']) );
        $this->request('GET', 'admin/logout');
        $this->assertRedirect('');
        $this->assertFalse( isset($_SESSION['username']) );
	}
    public function test_Delete_produk(){
        //$_SESSION['eo'] = 'eo';
        $expectedGet = $this->CI->Admin_model->testing_purpose()-1;

        $output = $this->request('GET', 'admin/hapusAdmin/fiko1');

        $actualGet = $this->CI->Admin_model->testing_purpose();
        $this->assertEquals($expectedGet, $actualGet);

        $actualFind = $this->CI->Admin_model->testing_purpose_find(cac);
        $expectedFind = 0;
        $this->assertEquals($expectedFind, $actualFind);

    }

    public function test_Delete_produk_wrong_id(){
        //$_SESSION['eo'] = 'eo';
        $output = $this->request('GET', 'admin/hapusAdmin/183hd');
        $this->assertResponseCode(404);
    }
    public function test_Delete_produk_no_logged(){
        $this->request('GET', 'admin/hapusAdmin/c88');
        $this->assertRedirect('display/login');
    }

}
