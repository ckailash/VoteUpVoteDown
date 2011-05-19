<?php

class Home extends Controller 
{
	function Home()
	{
		parent::Controller();
		$this->load->helper('url');
	}
		
	function index()
	{
		$this->load->library('facebook_connect');
			
		$data = array(
			'user'		=> $this->facebook_connect->user,
			'user_id'	=> $this->facebook_connect->user_id
			);

		// This is how to call a client API methods
		//
		// $this->facebook_connect->client->feed_registerTemplateBundle($one_line_story_templates, $short_story_templates, $full_story_template);
		// $this->facebook_connect->client->events_get($data['user_id']);

		$this->load->view('fbtest', $data);
	}
}
