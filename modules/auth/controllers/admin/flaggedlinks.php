<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Flaggedlinks extends Admin_Controller
{
	function Flaggedlinks()
	{
		parent::Admin_Controller();


		// Load userlib language


		// Set breadcrumb
		$this->bep_site->set_crumb("Flagged Links",'auth/admin/flaggedlinks');

		// Check for access permission
		check('Members');

		// Load the validation library
		$this->load->library('validation');
		$this->load->library('pagination');
		$this->load->model('Urlmodel');
		log_message('debug','BackendPro : Members class loaded');
	}

	/**
	 * View Members
	 *
	 * @access public
	 */
	function index()
	{
	
	
		$config['base_url'] = base_url().'auth/admin/flaggedlinks/';
		$config['total_rows'] = $this->Urlmodel->get_total_urls_flagged();

		$config['per_page'] = '8';

		$this->pagination->initialize($config);
		$data['results'] = $this->Urlmodel->get_links_flagged($config['per_page'],$this->uri->segment(3));	
			
		// Display Page
		$data['header'] = "Flagged Links";
		$data['page'] = $this->config->item('backendpro_template_admin') . "flaggedlinksview";
		$data['module'] = 'auth';
		$this->load->view($this->_container,$data);
	}

	function flagstatus($id,$currentstatus,$newstatus){
	
	
		$old=$this->Urlmodel->get_link_given_id($id);
		$old=$old[0]->link_flag;
		if($old==$currentstatus and $old!=$newstatus){
			$this->Urlmodel->set_flag($id,$newstatus);
		}
		header("Location:".base_url()."auth/admin/flaggedlinks/");
	
	
	
	}
	
}
