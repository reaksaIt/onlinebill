<?php 
/**
 * 
 */
class updateModel extends CI_Model
{
	
	public function update_one_cond($tb,$data,$field,$id){
		$this->db->where($field,$id);
		$this->db->update($tb,$data);
		return true;
	}
	public function update_two_cond($tb,$data,$field1,$id1,$field2,$id2){
		$this->db->where($field1,$id1)->where($field2,$id2);
		$this->db->update($tb,$data);
		return true;
	}
}









 ?>