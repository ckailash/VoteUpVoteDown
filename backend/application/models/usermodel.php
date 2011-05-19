<?php 
class Usermodel extends Model {

	var $fb_uid;
	var $fb_fname;
	var $fb_lname;
	var $fb_name;
	var $fb_profile_url;
	var $fb_birthday;
	var $fb_email;


/*insert users */
    function insert_users($v)
    {
	
		$this->fb_uid=$v['uid'];
		$this->fb_fname=$v['first_name'];
		$this->fb_lname=$v['last_name'];
		$this->fb_name=$v['name'];
		$this->fb_profile_url=$v['profile_url'];
		$this->fb_birthday=$v['birthday'];
		$this->fb_email=$v['email'];
		
		$this->db->insert('users', $this);
	
	}
	
	/*check if user already present in db returns 1 if yes else 0*/
	function check_users($v1)
	{
	
		$this->db->where('fb_uid',$v1);
		$count=$this->db->count_all_results('users');	
		
		if($count)
			return 1;
		else
			return 0;
	}
}
