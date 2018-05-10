<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('M_login');
	}
	
	public function index()
	{
		$this->load->view('loginpage');
	
	}
	public function Admin()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/home');
		$this->load->view('admin/footer');
	} 

	function aksi_login(){
		$username = $this->input->post('username');
		$password = sha1($this->input->post('password'));
		$where = array(
				'username' => $username,
				'password' => $password);
		$cek = $this->M_login->cek_login("admin",$where)->num_rows(); 
		if($cek > 0){
			$data_session = array(
				'nama'=>$username,
				'status'=> "login"); 
			$this->session->set_userdata($data_session);
			$this->Admin();
			
		}
		else {
			$this->index();
			echo '<script language="javascript">';
			echo 'alert("Login Gagal");';
			echo 'window.history.go(-1);';
			echo '</script>';
		
		}
	}
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('index.php/loginpage'));
	}
}