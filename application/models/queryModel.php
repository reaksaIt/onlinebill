<?php 
/**
 * 
 */
class queryModel extends CI_Model
{
	//Default Method
	public function defaultQuery($tb,$data){
		$this->db->select($data);
		return $this->db->get($tb);
	}
	public function query_one_cond($tb,$data,$field,$id){
		$this->db->select($data)->where($field,$id);
		return $this->db->get($tb);
	}
	public function query_join_table($data,$tb,$j_tb,$j_cond){
		$this->db->select($data);
		$this->db->from($tb);
		$this->db->join($j_tb,$j_cond);
		return $this->db->get();
	}
	public function query_join_table_cond($data,$tb,$j_tb,$j_cond,$w_field,$id){
		$this->db->select($data);
		$this->db->from($tb);
		$this->db->join($j_tb,$j_cond);
		$this->db->where($w_field,$id);
		return $this->db->get();
	}

	//Read Query Controller
	public function check_login($email,$pass){
		$this->db->select('us_email,us_pass,us_rule');
		$this->db->where('us_email',$email);
		$this->db->where('us_pass',$pass);
		return $this->db->get('tb_user');
	}

	//Query Quote join tree table
	public function query_quote_info(){
		$this->db->select('quote_id,quote_status,quote_num,quote_cre_date,quote_ex_date,quote_amount,cus_name,us_fname,us_lname');
		$this->db->from('tb_quote');
		$this->db->join('tb_user','tb_quote.quote_by=tb_user.us_id');
		$this->db->join('tb_customer','tb_quote.quote_cus=tb_customer.cus_id');
		return $this->db->get();
	}
	public function query_quote_info_pdf($id){
		$this->db->select('quote_amount,quote_num,quote_cre_date,quote_ex_date,quote_amount,cus_name,cus_address,cus_phone,cus_email,us_fname,us_lname,us_address,us_phone');
		$this->db->from('tb_quote');
		$this->db->join('tb_user','tb_quote.quote_by=tb_user.us_id');
		$this->db->join('tb_customer','tb_quote.quote_cus=tb_customer.cus_id');
		$this->db->where('quote_id',$id);
		return $this->db->get();
	}

	//Query Item Join Two table
	public function query_item_info($id){
		$this->db->select('pro_name,pro_price,item_qty,item_description,item_id,item_quote');
		$this->db->from('tb_items');
		$this->db->join('tb_products','tb_items.item_pro=tb_products.pro_id');
		$this->db->join('tb_quote','tb_items.item_quote=tb_quote.quote_id');
		$this->db->where('item_quote',$id);
		return $this->db->get();
	}
	public function query_item_update($quote,$pro){
		$this->db->select('item_quote,item_pro,item_qty')->where('item_quote',$quote)->where('item_pro',$pro);
		return $this->db->get('tb_items');
	}

	//Query Invoice
	public function query_invoice_info(){
		$this->db->select('iv_num,iv_status,iv_date,iv_ex_date,iv_id,iv_paid,iv_balance,iv_note,us_fname,us_lname,quote_amount,quote_cus,cus_name');
		$this->db->from('tb_invoice');
		$this->db->join('tb_user','tb_invoice.iv_by = tb_user.us_id');
		$this->db->join('tb_quote','tb_invoice.iv_quote=tb_quote.quote_id');
		$this->db->join('tb_customer','tb_quote.quote_cus=tb_customer.cus_id');
		$this->db->order_by('iv_num','asc');
		return $this->db->get();
	}

}









?>