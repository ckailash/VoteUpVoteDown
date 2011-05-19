<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();	
		$this->load->database();
		$this->load->helper('url');
	}
	
	function index()
	{
		$this->load->library('facebook_connect');
		$data_header = array(
			'user'		=> $this->facebook_connect->user,
			'user_id'	=> $this->facebook_connect->user_id
			);
		$this->load->view('header_view',$data_header);
		$this->load->view('content_view', $data);
		$this->load->view('footer_view'); 
	}

}
?>
