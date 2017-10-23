<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class User_test extends TestCase
{

    public function setUp() {
        $this->resetInstance();
        $this->CI->load->Model('User_Model');
    }

    public function test_login_berhasil(){
        //$this->assertFalse( isset($_SESSION['email']) );
        $this->request('POST', 'user/login',
            [
                'email' => 'boy@gmail.com',
                'pass' => '123',
            ]);
        //$this->assertRedirect('');
        $this->assertEquals('boy@gmail.com', $_SESSION['email']);
    }
        public function test_login_masuk_salah(){
        //$this->assertFalse( isset($_SESSION['email']) );
            $this->request('POST', 'user/login',
                [
                    'email' => 'boy@gmail.com',
                    'pass' => 'aaaa',
                ]);
    }
    public function test_login_emailkosong(){
         //$this->assertFalse( isset($_SESSION['email']) );
            $this->request('POST', 'user/login',
                [
                    'email' => '',
                    'pass' => 'aaa',
                ]);
        //$this->assertRedirect('');
        $this->assertRedirect('Display/login');
    }
    public function test_login_passwordkosong(){
         //$this->assertFalse( isset($_SESSION['email']) );
            $this->request('POST', 'user/login',
                [
                    'email' => 'boy@gmail.com',
                    'pass' => '',
                ]);
        //$this->assertRedirect('');
        $this->assertRedirect('Display/login');
    }

    public function test_logoutuser()
    {
        $this->assertFalse( isset($_SESSION['email']) );
        $this->request('GET', 'user/logout');
        $this->assertRedirect('');
        $this->assertFalse( isset($_SESSION['email']) );}

    
	//ganti email karena primary key jika ingin testing
	// public function test_addUser_berhasil() {
 //        $expected = $this->CI->User_Model->testing_purpose()+1;
 //        $this->request('POST', 'user/register',
 //            [
 //                'email' => 'derol@haha.com',
 //                'password' => '1234',
 //                'password2'    => '1234',
 //                'nohandphone' => '082116009415',
 //                'nama' => 'Derol waw',
 //            ]);
 //        $actual = $this->CI->User_Model->testing_purpose();
 //        $this->assertEquals($expected, $actual);
       
 //    }

    public function test_addUser_kosong() {
        $this->request('POST', 'user/register',
            [
                'email' => '',
                'password' => '',
                'password2'    => '',
                'nohandphone' => '',
                'nama' => '',
            ]);
        $this->assertRedirect('Display/register');
       
    }

    public function test_addUser_gagal() {
        $output = $this->request('POST', 'user/register',
            [
                'email' => '3d3@i.com',
                'password' => '8787',
                'password2'    => '8786',
                'nohandphone' => '082114009415',
                'nama' => 'Faiq Purnomo',
            ]);
        $this->assertContains('<title>Print-in - Register</title>',$output);
    }

}
