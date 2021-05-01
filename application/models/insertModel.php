<?php
/**
 * 
 */
class insertModel extends CI_Model
{
	
	public function defaultInsert($tb,$data){
		$this->db->insert($tb,$data);
		return true;
	}
}








?>