<?php

class Submit extends Controller 
{
	/*class constructor*/
	
	function Submit()
	{
		parent::Controller();	
		$this->load->database();
		$this->load->helper('url');
	}
	
	
	/*main submit functionality*/
	function index()
  	{
    
		$this->load->library('curlcheck');
		$this->load->library('form_validation');
		$this->load->library('facebook_connect');
		$data_header = array(
				'user'		=> $this->facebook_connect->user,
				'user_id'	=> $this->facebook_connect->user_id
				);
	
		$this->load->model('Urlmodel');
		$this->load->model('Votemodel');

		$this->load->helper('form');
    
		$this->load->view('header_view',$data_header);
	
		$config = array(
				   array(
						 'field'   => 'URL',
						 'label'   => 'URL',
						 'rules'   => 'required'
					  )
				 );
	
		$this->form_validation->set_rules($config); 
	
		if ($this->form_validation->run()) 
		{
	  		$inp=$this->input->post("URL");	
			
			if($this->curlcheck->validate_url($inp))
			{
				$tags=$this->curlcheck->page_exists($inp);
				$title=@$tags['title'];
				$desc=@$tags['metaTags']['description']['value'];
				if($tags)
				{
					$parts=parse_url($inp);
					$domain=$parts['host'];
					
					//flag to check if error on or not
					$flag=true;
					$error="";
					//ban checks before insert
					
					//user ban check
					$this->load->model('Userbanmodel');
					if($this->Userbanmodel->checkbans($this->facebook_connect->user_id))
					{
						$error.="URL submission has been disabled. Please contact support incase of any queries";
						$flag=false;
					//add a view here
					}	
				
					//domain ban check
					$this->load->model('Domainbanmodel');
					if($this->Domainbanmodel->checkbans($domain))
					{
						$error.=" URLs from this domain have been disabled. Please contact support incase of any queries";
						$flag=false;
					}
				
					if($flag==true)
					{
						$this->load->model('Keywordbanmodel');
						$val['url']=$this->input->post("URL",TRUE);
						$val['title']=$title;
						$val['description']=$desc;
						$val['domain']=$domain;
						$val['uid']=$this->facebook_connect->user_id;
						$val['name']=$this->facebook_connect->user['name'];
				
						$titleban=false;
						$descban=false;
						$titlecheck=explode(" ",$val['title']);
						$desccheck=explode(" ",$val['description']);
						$titlecount=count($titlecheck);
						$desccount=count($desccheck);
				
						for($i=0;$i<$titlecount;$i++)
						{
							if($this->Keywordbanmodel->checkbans($titlecheck[$i],'title'))
							{
								$titleban=true;
								break;
							}
						}
						for($i=0;$i<$desccount;$i++)
						{
							if($this->Keywordbanmodel->checkbans($desccheck[$i],'description'))
							{
								$descban=true;
								break;
							}
						}
				
						if($titleban == true or $descban == true)
						{
								$val['flag']="disabled";
								$error="The URL submitted had a few filtered terms. It will be approved by an administrator if deemed fit.";
						}
						else
						{
								$val['flag']="approved";
						}
				
						$this->Urlmodel->insert_links($val);
						$ids=$this->Urlmodel->get_insert_id();	
						
						$val1['link_id']=$ids;
						$val1['vote']=1;
						$val1['uid']=$this->facebook_connect->user_id;
						$this->Votemodel->insert_votes($val1);
						$this->Votemodel->updatevotesinlinks($ids,1);

						if($titleban == false and $descban == false)
						{
							$this->load->view('after_submit',array('url'=>$inp,'title'=>$title,'description'=>$desc,'ids'=>$ids)); 
						}
						else
						{
							$this->load->view('entry_error',array('error'=>$error)); 
						}
					}else
					{
						$this->load->view('entry_error',array('error'=>$error)); 
					}
				}
				else
				{
					$this->load->view('submit_view',array('urlerror'=>'Error occured with the remote URL. Please try again with a working URL.'));
				}
			}
			else
			{
				$this->load->view('submit_view',array('urlerror'=>'Invalid URL. Please enter a valid URL'));	
			}
		}
		else
		{ 
			$this->load->view('submit_view',array('urlerror'=>''));
		}
	
		$this->load->view('footer_view'); 
	
  	}
	
	/*ajax vote functionality*/
	function vote($uni,$no,$ids)
	{
		$this->load->model('Votemodel');
		$this->load->library('facebook_connect');
		$data_header = array(
			'user'		=> $this->facebook_connect->user,
			'user_id'	=> $this->facebook_connect->user_id
			);
		
		if($this->facebook_connect->user_id)
		{
			$selfuni=$_SERVER['REMOTE_ADDR']."agentcris".$ids;
			$selfuni=md5($selfuni);
			if($selfuni==$uni)
			{
				if($no==1)
				{
					$val1['uid']=$this->facebook_connect->user_id;
					$val1['link_id']=$ids;
					$val1['vote']=$no;
					$this->Votemodel->insert_votes($val1);
					$this->Votemodel->updatevotesinlinks($ids,1);
					echo "Successfully Voted Up!";

				}
				elseif($no==0)
				{
					$val1['uid']=$this->facebook_connect->user_id;							
					$val1['link_id']=$ids;
					$val1['vote']=$no;
					$this->Votemodel->insert_votes($val1);
					$this->Votemodel->updatevotesinlinks($ids,0);
					echo "Successfully Voted Down!";
				}
			}
			else
			{
				echo "Invalid Vote!";
			}
		}
		else
		{
			echo "Please login via Facebook to vote on URLs! Use the connect button on the right hand side corner of your screen to login!";
		}
	}

	
	/*ajax function to flag an entry*/
	function flag($id)
	{
		$this->load->model('Urlmodel');
	
		if($this->Urlmodel->check_link_id($id))
		{
			$this->Urlmodel->flag_link($id);
			echo "Link successfully flagged!";
		}
  	}
}
