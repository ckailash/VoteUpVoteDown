<?php

class Login extends Controller 
{
	function Login()
	{
		parent::Controller();	
		$this->load->database();
		$this->load->helper('url');
	}
	
	function index()
	{
		$this->load->library('session');
		$this->load->library('facebook_connect');
		$data_header = array(
			'user'		=> $this->facebook_connect->user,
			'user_id'	=> $this->facebook_connect->user_id
			);
		
		if(!$this->facebook_connect->user_id)
		{
			$this->load->view('header_view',$data_header);
			$this->load->view('login_view');
			$this->load->view('footer_view');
		}
		else
		{
			$this->load->view('header_view',$data_header);
			$this->load->view('login_view');
			$this->load->view('footer_view');
		}
	}
}
?>
