<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Domainbanmodel extends Model
{
		var $domain="";
		
		function Domainbanmodel()
		{
			// Call the Model constructor
			parent::Model();
		}

		
		function addbans($domain)
		{
		
			$data['domain']=$domain;
			$this->db->insert('bans',$data);
		
		}
		
		function getbans()
		{
		
			$query = $this->db->get('bans');
			return $query->result();
		
		}

		function checkbans($domain)
		{
			$this->db->where('domain',$domain);
			$count=$this->db->count_all_results('bans');
			
			if($count)
				return 1;
			else
				return 0;
		}
}
