<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settingsmodel extends Model
{
		var $name="";
		var $status="";
		
		function Settingsmodel()
		{
			// Call the Model constructor
			parent::Model();
		}

		
		function checkstatus($name)
		{
			$this->db->where('name',$name);
			$query=$this->db->get('bansettings');
			return $query->result();
		}
		
		function turnoff($name)
		{
			$this->db->set('status','off');
			$this->db->where('name',$name);
			$this->db->update('bansettings');
		}
		
		function turnon($name)
		{
			$this->db->set('status','on');
			$this->db->where('name',$name);
			$this->db->update('bansettings');
		}

}
