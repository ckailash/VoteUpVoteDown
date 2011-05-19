<?php

class Entry extends Controller 
{
	function Entry()
	{
		parent::Controller();	
		$this->load->database();
		$this->load->helper('url');
	}
	
	function index($id=0)
	{
		if($id)
		{
			$this->load->model('Urlmodel');
			$this->load->library('facebook_connect');
			$data_header = array(
				'user'		=> $this->facebook_connect->user,
				'user_id'	=> $this->facebook_connect->user_id
				);

			
			$data['results']=$this->Urlmodel->get_link_given_id($id);
			$data['error']="";
			
			if(!empty($data['results'][0]->link_url))
			{
				$this->load->view('header_view',$data_header);
				$this->load->view('entry_view',$data); 
				$this->load->view('footer_view');
			}
			else
			{
				$this->load->view('header_view',$data_header);
				$this->load->view('entry_error',array('error'=>"Invalid Submission ID!")); 
				$this->load->view('footer_view');
			}
		}
		else
		{
			$this->load->library('facebook_connect');
			$data_header = array(
				'user'		=> $this->facebook_connect->user,
				'user_id'	=> $this->facebook_connect->user_id
				);
			$this->load->view('header_view',$data_header);
			$this->load->view('entry_error',array('error'=>"Invalid Submission ID!")); 
			$this->load->view('footer_view');
		}		
	}
}
?>
