<?php

class Top extends Controller {

	function Top()
	{
		parent::Controller();	
		$this->load->database();
		$this->load->helper('url');
	}
	
	function index($filter="day")
	{
		$validfilterarray=array('day','week','month','year');

		if(in_array($filter,$validfilterarray))
		{
			$this->load->library('pagination');
			$this->load->library('facebook_connect');
			$data_header = array(
				'user'		=> $this->facebook_connect->user,
				'user_id'	=> $this->facebook_connect->user_id
				);

			$this->load->model('Urlmodel');
			
			switch($filter)
			{
				case 'day':
				$config['base_url'] = base_url().'top/index/day/';
				break;
				
				case 'week':
				$config['base_url'] = base_url().'top/index/week/';
				break;

				case 'month':
				$config['base_url'] = base_url().'top/index/month/';
				break;

				case 'year':
				$config['base_url'] = base_url().'top/index/year/';
				break;
				
				default:
				$config['base_url'] = base_url().'top/index/day/';
			}
		
			$config['total_rows'] = $this->Urlmodel->get_total_urls_wf($filter);
			$config['per_page'] = 8;
			$config['uri_segment']=4;

			$this->pagination->initialize($config);
			
			$off=$this->uri->segment(4)?$this->uri->segment(4):0;

			if($config['total_rows'])
			{
				$this->pagination->initialize($config);
				$data['results'] = $this->Urlmodel->get_links_wf($filter,$config['per_page'],$off);	
				$data['error']="";
				
				$this->load->view('header_view',$data_header);
				$this->load->view('top_view',$data);
				$this->load->view('footer_view'); 
			}
			else
			{
				$data['error']="No URLs submitted in the selected timeline!";
				$this->load->view('header_view',$data_header);
				$this->load->view('top_error',$data);
				$this->load->view('footer_view'); 
			}		
		
		}
		else
		{
			$this->load->view('header_view',$data_header);
			$this->load->view('top_view',array('error'=>'Invalid Filter'));
			$this->load->view('footer_view'); 
		}
	}
}
?>
