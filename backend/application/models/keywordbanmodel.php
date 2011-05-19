<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Keywordbanmodel extends Model
{
		var $keyword="";
		var $bantype="";
		
		function Keywordbanmodel()
		{
			// Call the Model constructor
			parent::Model();
		}

		
		function addbans($keyword,$bantype)
		{
		
			$data['keyword']=$keyword;
			$data['bantype']=$bantype;		
			$this->db->insert('keywordbans',$data);
		
		}
		
		function getbans($bantype)
		{
			$this->db->where("bantype",$bantype);
			$query = $this->db->get('keywordbans');
			return $query->result();
		}

		function checkbans($keyword,$bantype)
		{
			$this->db->where('keyword',$keyword);
			$this->db->where('bantype',$bantype);		
			$count=$this->db->count_all_results('keywordbans');
			
			if($count)
				return 1;
			else
				return 0;
		}
}
