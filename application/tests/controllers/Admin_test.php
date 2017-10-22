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



//Nanti yang dibawah dipake
 //    public function test_logout()
	// {
	// 	$this->assertFalse( isset($_SESSION['username']) );
 //        $this->request('GET', 'admin/logout');
 //        $this->assertRedirect('');
 //        $this->assertFalse( isset($_SESSION['username']) );
	// }
 //    public function test_Delete_produk(){
 //        //$_SESSION['eo'] = 'eo';
 //        $expectedGet = $this->CI->Admin_model->testing_purpose()-1;

 //        $output = $this->request('GET', 'admin/hapusAdmin/fiko1');

 //        $actualGet = $this->CI->Admin_model->testing_purpose();
 //        $this->assertEquals($expectedGet, $actualGet);

 //        $actualFind = $this->CI->Admin_model->testing_purpose_find(cac);
 //        $expectedFind = 0;
 //        $this->assertEquals($expectedFind, $actualFind);

 //    }

 //    public function test_Delete_produk_wrong_id(){
 //        //$_SESSION['eo'] = 'eo';
 //        $output = $this->request('GET', 'admin/hapusAdmin/183hd');
 //        $this->assertResponseCode(404);
 //    }
 //    public function test_Delete_produk_no_logged(){
 //        $this->request('GET', 'admin/hapusAdmin/c88');
 //        $this->assertRedirect('display/login');
 //    }

}
