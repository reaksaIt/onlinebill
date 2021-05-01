<?php 
/**
 * 
 */
class UpdateController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('queryModel');
		$this->load->model('insertModel');
		$this->load->model('deleteModel');
		$this->load->model('updateModel');
		$this->load->helper('url');
	}
	public function updateproduct(){
		$id = $this->input->post('edit_id');
		$data = array(
			'pro_name'=>$this->input->post('edit_name'),
			'pro_price'=>$this->input->post('edit_price'),
			'pro_description'=>$this->input->post('edit_des'),
			'pro_cat'=>$this->input->post('edit_cat'),
		);
		$sql = $this->updateModel->update_one_cond('tb_products',$data,'pro_id',$id);
		if($sql ==true){
			$array = array('success'=>true);echo json_encode($array);
		}
	}
	public function updatecustomer($id){
		$data = array(
			'cus_name'=>$this->input->post('edit_name'),
			'cus_phone'=>$this->input->post('edit_phone'),
			'cus_email'=>$this->input->post('edit_email'),
			'cus_address'=>$this->input->post('edit_add'),
		);
		$sql = $this->updateModel->update_one_cond('tb_customer',$data,'cus_id',$id);
		if($sql==true){
			$array = array('updated'=>true);echo json_encode($array);
		}

	}

	//Update Amount in Quote
	public function updateamount(){
		$id = $this->input->post('id');
		$data = array(
			'quote_amount'=>$this->input->post('total'),
		);
		$this->updateModel->update_one_cond('tb_quote',$data,'quote_id',$id);
	}

	//Update Item
	public function updateitem($id){
		$data =array(
			'item_description'=>$this->input->post('edititem_des'),
			'item_qty'=>$this->input->post('edititem_qty'),
		);
		$sql= $this->updateModel->update_one_cond('tb_items',$data,'item_id',$id);
		if($sql==true){
			$array = array('updated'=>true);echo json_encode($array);
		}
	}

	//Update Invoice
	public function updateInvoice(){
		$id = $this->input->post('up_id');
		$data = array(
			'iv_paid'=>$this->input->post('paid'),
			'iv_balance'=>$this->input->post('balance'),
			'iv_note'=>$this->input->post('note')
		);
		$sql = $this->updateModel->update_one_cond('tb_invoice',$data,'iv_id',$id);
		if($sql){
			$array = array('inserted'=>true);echo json_encode($array);
		}
	}
}
 ?>