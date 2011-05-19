<?php

class Feed extends Controller 
{
	function Feed()
	{
		parent::Controller(); 
		$this->load->database(); 
		$this->load->helper('xml');  
		$this->load->helper('text');  
		$this->load->helper('url');  
	}

	function index($filter="day")
	{
		$validfilterarray=array('day','week','month','year');

		if(in_array($filter,$validfilterarray)){
			
			$this->load->model('Urlmodel');
			$data['feed_name'] = "Submission";
			$data['encoding'] = 'utf-8'; // the encoding
			$data['feed_url'] = base_url()."feed/".$filter;
			$data['page_description'] = 'Top rated URLs for the past '.$filter;
			$data['page_language'] = 'en-en';
			$data['creator_email'] = 'itsmekailash88@gmail.com';
				
			$totl=$this->Urlmodel->get_total_urls_wf($filter);
			$data['result'] = $this->Urlmodel->get_links_wf($filter,$totl,0);
				
			header("Content-Type: application/rss+xml"); 

			$this->load->view('rss', $data);
		}
	}
}
?>
