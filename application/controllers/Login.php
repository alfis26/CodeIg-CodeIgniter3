<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require 'vendor/autoload.php';

class Login extends CI_Controller {

	public function index()
	{
		$login_salah = '';

		if ($this->session->has_userdata('username')) {
			redirect('backend/dashboard');
		}
		if ($this->input->post() ) {
			$username = $this->input->post('username');
	        $password = $this->input->post('password');

			$user = \Orm\User::where(['username' => $username])->first();
			if (empty($user)) {
				$login_salah = 'User tidak ditemukan';
			}else{
			    if ($password == $user->password){
				    $userdata = ['username' => $user->username];
				    $this->session->set_userdata($userdata);
		            redirect('backend/dashboard');
			    }else {
		            $login_salah = 'Kombinasi  username dan password salah';
		        }	
		    }
	    }
		view('login', ['login_salah' => $login_salah]  );
	}
	public function logout()	
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}










