<?php

class Dump extends Controller {

	function Dump()
	{
		parent::Controller();	
		$this->load->database();
		$this->load->helper('url');
	}
	
	function index($url="")
	{
		if($url)
		{
			$this->load->library('curlcheck');
			$this->load->library('session');
			$this->load->model('Urlmodel');
			$this->load->model('Votemodel');
			$this->load->library('facebook_connect');
			$data_header = array(
				'user'		=> $this->facebook_connect->user,
				'user_id'	=> $this->facebook_connect->user_id
			);
			
			$inp=base64_decode($url);
			if($this->curlcheck->validate_url($inp))
			{
				$tags=$this->curlcheck->page_exists($inp);
				$title=@$tags['title'];
				$desc=@$tags['metaTags']['description']['value'];
				if($tags)
				{
					if($this->facebook_connect->user_id)
					{				
						$parts=parse_url($inp);
						$domain=$parts['host'];
						
						$val['url']=$inp;
						$val['title']=$title;
						$val['description']=$desc;
						$val['domain']=$domain;
						$val['uid']=$this->facebook_connect->user_id;
						$val['name']=$this->facebook_connect->user['name'];		
						$this->Urlmodel->insert_links($val);
						$ids=$this->Urlmodel->get_insert_id();
						
						$val1['link_id']=$ids;
						$val1['vote']=1;
						$val1['uid']=$this->facebook_connect->user_id;
						$this->Votemodel->insert_votes($val1);
						$this->Votemodel->updatevotesinlinks($ids,1);
				
						echo "Success";
					}
					else
					{
						$this->session->set_userdata('url', $inp);
						header("Location:".base_url()."login");
					}
				}
				else
				{
					echo "Error occured in the remote URL!";
				}
			}
			else
			{
				echo "Invalid URL! Please submit a valid URL";
			}
		}
		else
		{
			echo "Enter URL";		
		}	
	}
}
?>
