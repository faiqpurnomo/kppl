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

    public function test_logout()
	{
        $_SESSION['status'] = 'siap';
        $this->request('GET', 'admin/logout');
        $this->assertFalse( isset($_SESSION['status']) );
	}

    public function test_Delete_admin(){
        $_SESSION['status'] = 'siap';
        $expectedGet = $this->CI->Admin_model->testing_purpose1()-1;

        $output = $this->request('GET', 'admin/hapusAdmin/fiko1');

        $actualGet = $this->CI->Admin_model->testing_purpose1();
        $this->assertEquals($expectedGet, $actualGet);

        $actualFind = $this->CI->Admin_model->testing_purpose_find('fiko1');
        $expectedFind = 0;
        $this->assertEquals($expectedFind, $actualFind);
        $this->CI->Admin_model->testing_reset_purpose_oppose_delete('fiko1');
    }

    public function test_addAdmin_berhasil() {
        $_SESSION['status'] = 'siap';
        $expected = $this->CI->Admin_model->testing_purpose1()+1;
        $this->request('POST', 'admin/addAdmin',
            [
                'username' => 'fafaiq',
                'password' => '1234',
                'password2'    => '1234',
            ]);
        $actual = $this->CI->Admin_model->testing_purpose1();
        $this->assertEquals($expected, $actual);


        $expectedAdmin = array('username' => 'fafaiq',
                                'password' => '1234',
                                'authentication' => '0');
        $actualAdmin = $this->CI->Admin_model->find_testing_akun('fafaiq');
        $this->assertEquals($expecteduser, $actualuser);
        $this->CI->Admin_model->hapusAdmin('fafaiq');
        


    }


    public function test_edit_produk(){
        $_SESSION['status'] = 'siap';
        $output = $this->request('POST', 'admin/updateOrder/',
            [
                'id' => 32,
                'status' => 'Proses'
            ]);
        $updated = $this->CI->Admin_model->find_testing_order(32);
        $actual1 = $updated->status;

        $this->assertEquals('Proses', $actual1);
    }
}
