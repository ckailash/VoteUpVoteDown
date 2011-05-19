<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userlist extends Admin_Controller
{
	function Userlist()
	{
		parent::Admin_Controller();


		// Load userlib language


		// Set breadcrumb
		$this->bep_site->set_crumb("Banned User List",'auth/admin/userlist');

		// Check for access permission
		check('Members');

		// Load the validation library
		$this->load->library('validation');
		$this->load->model('Userbanmodel');
		
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
			
			if(!$this->Userbanmodel->checkbans($formtxtstring[$i]))
				$this->Userbanmodel->addbans($formtxtstring[$i]);
		}
		
		
		$txtstring="";
		
		// Display Page
		$ans=$this->Userbanmodel->getbans();
		$c=count($ans);
		for($i=0;$i<$c;$i++){
			if($i!=0 && $i!=$c)
			$txtstring=$txtstring.",".$ans[$i]->userid;
			else
			$txtstring.=$ans[$i]->userid;
		}
			
		
		$data['header'] = "Ban Users";
		$data['page'] = $this->config->item('backendpro_template_admin') . "userlistview";
		$data['module'] = 'auth';
		$data['value']=$txtstring;
		$this->load->view($this->_container,$data);
		
		
		}else{
		
		$txtstring="";
		
		// Display Page
		$ans=$this->Userbanmodel->getbans();
		$c=count($ans);
		for($i=0;$i<$c;$i++){
			if($i!=0 && $i!=$c)
			$txtstring=$txtstring.",".$ans[$i]->userid;
			else
			$txtstring.=$ans[$i]->userid;
		}
		

		$data['header'] = "Ban Users";
		$data['page'] = $this->config->item('backendpro_template_admin') . "userlistview";
		$data['module'] = 'auth';
		$data['value']=$txtstring;
		
		$this->load->view($this->_container,$data);
		}
	}

	
}
