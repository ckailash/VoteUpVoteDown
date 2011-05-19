<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userbanmodel extends Model
{
		var $userid="";
		
		function Userbanmodel()
		{

			// Call the Model constructor
			parent::Model();
		}

		
		function addbans($userid){
		
			$data['userid']=$userid;
			$this->db->insert('userbans',$data);
			
		}
		
		function getbans(){
			
			$query = $this->db->get('userbans');
			return $query->result();
			
		}

		function checkbans($userid){
			$this->db->where('userid',$userid);
			$count=$this->db->count_all_results('userbans');
			
			if($count)
				return 1;
			else
				return 0;
		}
}
