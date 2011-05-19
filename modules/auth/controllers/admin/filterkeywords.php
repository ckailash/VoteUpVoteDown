<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filterkeywords extends Admin_Controller
{
	function Filterkeywords()
	{
		parent::Admin_Controller();


		// Load userlib language


		// Set breadcrumb
		$this->bep_site->set_crumb("Filter Keywords",'auth/admin/filterkeywords');

		// Check for access permission
		check('Members');

		// Load the validation library
		$this->load->library('validation');
		$this->load->model('Keywordbanmodel');

		log_message('debug','BackendPro : Members class loaded');
	}

	
	function index()
	{
		
		if($this->input->post('submit')=="Submit"){

		$formtxtstring=trim($this->input->post('words',TRUE));
		
		$formtxtstring=explode(",",$formtxtstring);
		
		$c=count($formtxtstring);
		
		for($i=0;$i<$c;$i++){
			
			if(!$this->Keywordbanmodel->checkbans($formtxtstring[$i],"title"))
				$this->Keywordbanmodel->addbans($formtxtstring[$i],"title");
		}
		
		$formtxtstring2=trim($this->input->post('words1',TRUE));
		
		$formtxtstring2=explode(",",$formtxtstring2);
		
		$c=count($formtxtstring2);
		
		for($i=0;$i<$c;$i++){
			
			if(!$this->Keywordbanmodel->checkbans($formtxtstring2[$i],"description"))
				$this->Keywordbanmodel->addbans($formtxtstring2[$i],"description");
		}
		
		
		$txtstring="";
		$txtstring2="";		
	
		// Display Page
		$ans=$this->Keywordbanmodel->getbans("title");
		$c=count($ans);
		for($i=0;$i<$c;$i++){
			if($i!=0 && $i!=$c)
			$txtstring=$txtstring.",".$ans[$i]->keyword;
			else
			$txtstring.=$ans[$i]->keyword;
		}
		
		$ans2=$this->Keywordbanmodel->getbans("description");
		$c2=count($ans2);
		for($i=0;$i<$c2;$i++){
			if($i!=0 && $i!=$c2)
			$txtstring2=$txtstring2.",".$ans2[$i]->keyword;
			else
			$txtstring2.=$ans2[$i]->keyword;
		}
		
		$data['value']=$txtstring;
		$data['value1']=$txtstring2;
		$data['header'] = "Add Filterable Keywords";
		$data['page'] = $this->config->item('backendpro_template_admin') . "filterkeywordsview";
		$data['module'] = 'auth';
		$this->load->view($this->_container,$data);
		
		}else{
		
		$txtstring="";
		$txtstring2="";		
	
		// Display Page
		$ans=$this->Keywordbanmodel->getbans("title");
		$c=count($ans);
		for($i=0;$i<$c;$i++){
			if($i!=0 && $i!=$c)
			$txtstring=$txtstring.",".$ans[$i]->keyword;
			else
			$txtstring.=$ans[$i]->keyword;
		}
		
		$ans2=$this->Keywordbanmodel->getbans("description");
		$c2=count($ans2);
		for($i=0;$i<$c2;$i++){
			if($i!=0 && $i!=$c2)
			$txtstring2=$txtstring2.",".$ans2[$i]->keyword;
			else
			$txtstring2.=$ans2[$i]->keyword;
		}
		
		$data['value']=$txtstring;
		$data['value1']=$txtstring2;
		$data['header'] = "Add Filterable Keywords";
		$data['page'] = $this->config->item('backendpro_template_admin') . "filterkeywordsview";
		$data['module'] = 'auth';
		$this->load->view($this->_container,$data);		}
	}

	
}
