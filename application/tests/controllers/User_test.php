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

	public function test_viewshowDashboard1()
	{
        $_SESSION['status'] = 'siap';
		$output = $this->request('GET', 'user/showDashboard1');
		$this->assertContains('<h3>Apa yang akan anda lakukan hari ini?</h3>', $output);
	}

	public function test_viewshowPrint1()
	{
        $_SESSION['status'] = 'siap';
		$output = $this->request('GET', 'user/showPrint');
		$this->assertContains('<h3>Apa yang ingin anda cetak hari ini ?</h3>', $output);
	}

	public function test_viewshowHistory()
	{
        $_SESSION['status'] = 'siap';
		$output = $this->request('GET', 'user/showHistory');
		$this->assertContains('<h2>HISTORI TRANSAKSI</h2>', $output);
	}
    public function test_viewreaddatalogin()
    {
        $_SESSION['status'] = 'siap';
        $output = $this->request('GET', 'user/readData');
        $this->assertContains('<h2>HISTORI TRANSAKSI</h2>', $output);
    }
    public function test_logoutuser()
    {
        $this->assertFalse( isset($_SESSION['email']) );
        $this->request('GET', 'user/logout');
        $this->assertRedirect('');
        $this->assertFalse( isset($_SESSION['email']) );}

    
	//ganti email karena primary key jika ingin testing
	// public function test_addUser_berhasil() {
 //        $this->request('POST', 'user/register',
 //            [
 //                'email' => 'Fdaar@0.com',
 //                'password' => '8787',
 //                'password2'    => '8787',
 //                'nohandphone' => '082114009415',
 //                'nama' => 'Faiq Purnomo',
 //            ]);
       
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
        $this->request('POST', 'user/register',
            [
                'email' => '3d3@i.com',
                'password' => '8787',
                'password2'    => '8786',
                'nohandphone' => '082114009415',
                'nama' => 'Faiq Purnomo',
            ]);
        
    }

}
