<?php 
/**
 * 
 */
class DeleteController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('queryModel');
		$this->load->model('insertModel');
		$this->load->model('deleteModel');
		$this->load->model('updateModel');
		$this->load->helper('url');
		$this->load->library('session');
	}
	public function logout(){
		$remove_session = array('email','rule');
		$this->session->unset_userdata($remove_session);
		redirect(base_url().'index.php/viewcontroller/viewlogin');
	}

	function deleteproduct(){
		$id = $this->input->post('id');
		$data = $this->deleteModel->defaultDelete('tb_products','pro_id',$id);
		if($data==true){
			$array = array('delete'=>true);echo json_encode($array);
		}
		
	}

	private function default_deleted($table,$field,$id){
		$delete = $this->deleteModel->defaultDelete($table,$field,$id);
		if($delete==true){
			$array = array('deleted'=>true);echo json_encode($array);
		}
	}
	private function default_deleted_nr($table,$field,$id){
		$delete = $this->deleteModel->defaultDelete($table,$field,$id);
	}


	public function deletecustomer($id){
		$this->default_deleted_nr('tb_quote','quote_cus',$id);
		$this->default_deleted('tb_customer','cus_id',$id);
	}



	public function deletequote($id){
		$delete=$this->deleteModel->defaultDelete('tb_quote','quote_id',$id);
		if($delete==true){
			$array = array('deleted'=>true);echo json_encode($array);
		}
	}

	//Delete Items
	public function deleteitem($id){
		$this->default_deleted('tb_items','item_id',$id);
	}
	//Delete Invoice
	public function deleteInvoice($id){
		$this->default_deleted('tb_invoice','iv_id',$id);
	}
}
 ?>