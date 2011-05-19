<?php 
class Contactmodel extends Model {

	var $name;
	var $email;
	var $message;
	
	function Contactmodel(){

        // Call the Model constructor
        parent::Model();

	
	}

/*insert message */
    function insert_message($v)
    {
	
		$this->name=$v['name'];
		$this->email=$v['email'];
		$this->message=$v['message'];
		
		$this->db->insert('contact', $this);
	
	}
	

}