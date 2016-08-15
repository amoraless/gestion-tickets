<?php 
class LevelSignificanceModel
{
	
	function __construct()
	{
		$this->db=Conection::connect();
	}
	public function listLevel()
	{
		$query = 'SELECT ls_id, ls_name FROM tbl_level_significance ORDER BY ls_id';
		$result = $this->db->query($query); 
		return $result->fetchAll();
		
	}
}