<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Domainlist extends Admin_Controller
{
	function Domainlist()
	{
		parent::Admin_Controller();


		// Load userlib language


		// Set breadcrumb
		$this->bep_site->set_crumb("Banned Domains List",'auth/admin/domainlist');

		// Check for access permission
		check('Members');

		// Load the validation library
		$this->load->library('validation');
		$this->load->model('Domainbanmodel');

		log_message('debug','BackendPro : Members class loaded');
	}

	/**
	 * View Members
	 *
	 * @access public
	 */
	function index()
	{
	
		if($this->input->post('submit')=="Submit"){
		$formtxtstring=trim($this->input->post('words',TRUE));
		
		$formtxtstring=explode(",",$formtxtstring);
		
		$c=count($formtxtstring);
		
		for($i=0;$i<$c;$i++){
			
			if(!$this->Domainbanmodel->checkbans($formtxtstring[$i]))
				$this->Domainbanmodel->addbans($formtxtstring[$i]);
		}
		
		
		$txtstring="";
		
		// Display Page
		$ans=$this->Domainbanmodel->getbans();
		$c=count($ans);
		for($i=0;$i<$c;$i++){
			if($i!=0 && $i!=$c)
			$txtstring=$txtstring.",".$ans[$i]->domain;
			else
			$txtstring.=$ans[$i]->domain;
		}
			
		
		$data['header'] = "Ban Domains";
		$data['page'] = $this->config->item('backendpro_template_admin') . "domainlistview";
		$data['module'] = 'auth';
		$data['value']=$txtstring;
		$this->load->view($this->_container,$data);
		
		
		}else{
		
		$txtstring="";
		
		// Display Page
		$ans=$this->Domainbanmodel->getbans();
		$c=count($ans);
		for($i=0;$i<$c;$i++){
			if($i!=0 && $i!=$c)
			$txtstring=$txtstring.",".$ans[$i]->domain;
			else
			$txtstring.=$ans[$i]->domain;
		}
		

		$data['header'] = "Ban Domains";
		$data['page'] = $this->config->item('backendpro_template_admin') . "domainlistview";
		$data['module'] = 'auth';
		$data['value']=$txtstring;
		
		$this->load->view($this->_container,$data);
		}
	}

	
}
