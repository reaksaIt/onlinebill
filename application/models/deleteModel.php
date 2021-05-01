<?php 

/**
 * 
 */
class deleteModel extends CI_Model
{
	
	public function defaultDelete($tb,$field,$id){
		$this->db->where($field,$id);
		$this->db->delete($tb);
		return true;
	}
	//Delete Payment and quote
	
}















?>