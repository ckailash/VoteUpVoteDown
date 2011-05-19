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
		$this->load->library('pagination');
		$this->load->library('facebook_connect');
		
		$this->load->model('Urlmodel');

			
		$data_header = array(
			'user'		=> $this->facebook_connect->user,
			'user_id'	=> $this->facebook_connect->user_id
			);


		$config['base_url'] = base_url().'welcome/index/';
		$config['total_rows'] = $this->Urlmodel->get_total_urls();
		$config['per_page'] = '8';

		$this->pagination->initialize($config);
		
		$data['results'] = $this->Urlmodel->get_links($config['per_page'],$this->uri->segment(3));	
			
		$this->load->view('header_view',$data_header);
		$this->load->view('content_view', $data);
		$this->load->view('footer_view'); 
	}
}
?>
