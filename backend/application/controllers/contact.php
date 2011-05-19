<?php

class Contact extends Controller {

	function Contact()
	{
		parent::Controller();	
		$this->load->database();
		$this->load->helper('url');
	}
	
	function index()
	{
		$this->load->library('recaptcha');
		$this->load->library('form_validation');
		$this->lang->load('recaptcha');
		
		$this->load->library('facebook_connect');
		
		$this->load->model('Contactmodel');

		$config = array(
				array(
				'field' => 'name',
      			'label' => 'Name',
      			'rules' => 'required'
				),
				array(
				'field' => 'email',
      			'label' => 'Email',
      			'rules' => 'required|valid_email'
				),
  			    array(
      			'field' => 'recaptcha_response_field',
      			'label' => 'lang:recaptcha_field_name',
      			'rules' => 'required|callback_check_captcha'
    			)
 			);
		
		$this->form_validation->set_rules($config);

		
		$data_header = array(
			'user'		=> $this->facebook_connect->user,
			'user_id'	=> $this->facebook_connect->user_id
			);
		$this->load->view('header_view',$data_header);
			
		if ($this->form_validation->run())
		{
			$data['name']=$this->input->post('name',true);
			$data['email']=$this->input->post('email',true);
			$data['message']=$this->input->post('message',true);
			$this->Contactmodel->insert_message($data);
			$this->load->view('contact_success');

		}
		else
		{
			$this->load->view('contact_view',array('recaptcha'=>$this->recaptcha->get_html()));
		}
		$this->load->view('footer_view'); 	
	}
		

	function check_captcha($val)
	{
		if ($this->recaptcha->check_answer($this->input->ip_address(),$this->input->post('recaptcha_challenge_field'),$val)) 
		{
			return TRUE;
		} 
		else 
		{
			$this->form_validation->set_message('check_captcha',$this->lang->line('recaptcha_incorrect_response'));
			return FALSE;
		}
	}
}
?>
