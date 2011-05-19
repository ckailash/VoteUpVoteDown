<?php 
class Urlmodel extends Model
{

    var $link_votes  = '';
    var $link_date = '';
    var $link_url    = '';
    var $link_url_encoded    = '';
	var $link_flag = "";
    var $link_title    = '';
	var $link_content    = '';
	var $link_domain    = '';
	var $link_user_name    = '';
	var $link_user_id  = '';

    function Urlmodel()
    {
        // Call the Model constructor
        parent::Model();
    }
    
	/*get total number of urls in our system - for pagination*/
	function get_total_urls()
	{

		$this->db->where('link_flag !=','disabled');		
		$c=$this->db->count_all_results('links');
		return $c;
	
	}

	/*get total number of urls in our system with the TIME FILTER - for pagination*/
	function get_total_urls_wf($filter)
	{
	
		switch($filter)
		{
			case 'day':
			
			$this->db->where('link_flag !=','disabled');
			$this->db->where("DATE_FORMAT(link_date,GET_FORMAT(DATE,'JIS'))=CURDATE()");
			break;
			
			case 'week':
			
			$this->db->where('link_flag !=','disabled');		
			$this->db->where("DATE_FORMAT(link_date,GET_FORMAT(DATE,'JIS')) BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY ) AND CURDATE( )");
			break;

			case 'month':
			
			$this->db->where('link_flag !=','disabled');		
			$this->db->where("DATE_FORMAT(link_date,GET_FORMAT(DATE,'JIS')) BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE( )");
			break;

			case 'year':
			
			$this->db->where('link_flag !=','disabled');		
			$this->db->where("DATE_FORMAT(link_date,GET_FORMAT(DATE,'JIS')) BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 YEAR) AND CURDATE( )");
			break;
			
			default:
			
			$this->db->where('link_flag !=','disabled');		
			$this->db->where("DATE_FORMAT(link_date,GET_FORMAT(DATE,'JIS'))=CURDATE()");
		}
	
		$result=$this->db->count_all_results('links');

		return $result;

	}

	
	/*admin panel flagged links*/
	function get_total_urls_flagged()
	{

		$this->db->or_where('link_flag','flagged');
		$this->db->or_where('link_flag','disabled');
		
		$results=$this->db->count_all_results('links');

		return $results;
	}

	
	/*home page latest 8 entries with pagination*/
    function get_links($num, $offset)
    {	
		$this->db->where('link_flag !=','disabled');		
		$this->db->order_by('link_date desc,link_votes desc'); 	
        $query = $this->db->get('links', $num, $offset);
		return $query->result();
    }
	
	/*get urls with filters*/
	function get_links_wf($filter,$num, $offset)
    {	
		
		switch($filter)
		{
			case 'day':
			
			$this->db->where('link_flag !=','disabled');		
			$this->db->where("DATE_FORMAT(link_date,GET_FORMAT(DATE,'JIS'))=CURDATE()");
			break;
			
			case 'week':
			
			$this->db->where('link_flag !=','disabled');		
			$this->db->where("DATE_FORMAT(link_date,GET_FORMAT(DATE,'JIS')) BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY ) AND CURDATE( )");
			break;

			case 'month':
			
			$this->db->where('link_flag !=','disabled');		
			$this->db->where("DATE_FORMAT(link_date,GET_FORMAT(DATE,'JIS')) BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE( )");
			break;

			case 'year':
			
			$this->db->where('link_flag !=','disabled');		
			$this->db->where("DATE_FORMAT(link_date,GET_FORMAT(DATE,'JIS')) BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 YEAR) AND CURDATE( )");
			break;
			
			default:
			
			$this->db->where('link_flag !=','disabled');		
			$this->db->where("DATE_FORMAT(link_date,GET_FORMAT(DATE,'JIS'))=CURDATE()");
		}


		$this->db->order_by('link_date desc,link_votes desc'); 	
        $query = $this->db->get('links', $num, $offset);
		
		return $query->result();
    }
	
	/*admin panel flagged entries*/
    function get_links_flagged($num, $offset)
    {
		$this->db->or_where('link_flag','flagged');
		$this->db->or_where('link_flag','disabled');
		$this->db->or_where('link_flag','penabled');

        $query = $this->db->get('links', $num, $offset);
		return $query->result();
    }
	
	/* get the insert id after inserting a new link*/
	function get_insert_id(){
	
		return $this->db->insert_id();
	
	}
	
	/* get details of the link given the id*/
	function get_link_given_id($id)
	{
	
		$this->db->where('link_id',$id);
		$query=$this->db->get('links');

		return $query->result();
		
	}
	
	/*check if such a link id exists*/
	function check_link_id($id)
	{
	
		$this->db->where('link_id', $id);	
		$query=$this->db->count_all_results('links');
		
		if($query==1)
			return 1;
		else
			return 0;
	}
	
	/*flag the link*/
	function flag_link($id)
	{
		$this->db->set('link_flag', 'flagged');
		$this->db->set('link_num_flags','link_num_flags+1',FALSE);
		$this->db->where('link_id', $id);	
		$this->db->update('links'); 
	}	
	
	/*set a particular flag on a link*/
	function set_flag($id,$flag)
	{
	
		$this->db->set('link_flag', $flag);
		$this->db->where('link_id',$id);
		$this->db->update('links'); 
	
	}
	
	
	
	/*insert link after cleaning up*/
    function insert_links($val)
    {
	    $this->link_votes  = 0;
		$this->link_date = date("Y-m-d H:i:s",time());
		$this->link_url    = $val['url'];
		$this->link_url_encoded    = urlencode($val['url']);
		$this->link_title    = $val['title'];
		$this->link_content    = $val['description'];
		$this->link_domain    = $val['domain'];
		$this->link_user_name	= $val['name'];
		$this->link_user_id 	= $val['uid'];
		$this->link_flag = $val['flag'];

	    $this->db->insert('links', $this);
    }	
}
?>
