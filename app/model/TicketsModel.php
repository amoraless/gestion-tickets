<?php 
class TicketsModel
{
	
	function __construct()
	{
		$this->db=Conection::connect();
	}
	public function listTickets($filter,$search,$option)
	{
		if($filter!=""){
			$query_filter=" WHERE tbl_tickets.ls_id=".$filter;
		}else{
			$query_filter="";
		}

		if($search!=""){
			if($option==1){
				$query_search=' WHERE tic_name LIKE "%'.$search.'%" ';
			}elseif($option==2){
				$query_search=' WHERE tic_description LIKE "%'.$search.'%" ';
			}
		}else{
			$query_search="";
		}
		$query = 'SELECT tic_id , tbl_tickets.ls_id , ls_name,tic_name , tic_description ,tic_registration_date FROM tbl_tickets INNER JOIN tbl_level_significance on tbl_tickets.ls_id=tbl_level_significance.ls_id '.$query_filter.$query_search.' ORDER BY tic_id DESC';
		
		$result = $this->db->query($query); 
		return $result->fetchAll();
	}
	public function insert($ls_id,$tic_name,$tic_description){
		$query="INSERT INTO tbl_tickets(ls_id, tic_name, tic_description, tic_registration_date) VALUES ('$ls_id','$tic_name','$tic_description',now())";
		$result = $this->db->query($query); 

		return true;
	}
	public function getTickets($tic_id)
	{
		$query = 'SELECT tic_id, ls_id, tic_name, tic_description FROM tbl_tickets WHERE tic_id='.$tic_id;
		$result = $this->db->query($query); 
		return $result->fetchAll();
	}
	public function update($tic_id,$ls_id,$tic_description){
		$query="UPDATE tbl_tickets SET ls_id='$ls_id',tic_description='$tic_description' WHERE tic_id=".$tic_id;
		$result = $this->db->query($query); 

		return true;
	}
	public function delete($tic_id){
		$query="DELETE FROM tbl_tickets WHERE tic_id=".$tic_id;
		$result = $this->db->query($query); 

		return true;
	}
}