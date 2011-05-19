<?php 
class Votemodel extends Model {


	var $vote_date = '';
	var	$vote_link_id ='';
	var	$vote_value='';
	var	$vote_ip='';
	var $vote_user_id;
	
    function Votemodel()
    {
        // Call the Model constructor
        parent::Model();
    }
    
/*add votes - could be plus or minus one. have to query the whole table for each link and find out all the plus ones and minus ones. Allow a more flexible voting system in the future maybe?*/	
    function insert_votes($val)
    {
	

        $this->vote_date = date("Y-m-d H:i:s",time());
		$this->vote_link_id = $val['link_id'];
		$this->vote_value= $val['vote'];
		$this->vote_ip=$_SERVER['REMOTE_ADDR'];
		$this->vote_user_id=$val['uid'];
		
        $this->db->insert('votes', $this);
    }

	/*after inserting into the votes table, update value in the links table*/
	function updatevotesinlinks($ids,$no){
	
		if($no==1)
		{
			$this->db->set('link_votes', 'link_votes+1', FALSE);
			$this->db->where('link_id', $ids);
			$this->db->update('links'); 
		}
		elseif($no==0)
		{
			$this->db->set('link_votes', 'link_votes-1', FALSE);
			$this->db->where('link_id', $ids);
			$this->db->update('links'); 
		}
	}
}
?>
