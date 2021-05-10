<?php 
/**
 * 
 */
class InsertController extends CI_Controller
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


// Page Register
	public function register(){
		$data = array(
			'us_fname'=>$this->input->post('fname'),
			'us_lname'=>$this->input->post('lname'),
			'us_gender'=>$this->input->post('gender'),
			'us_rule'=>$this->input->post('permission'),
			'us_email'=>$this->input->post('email'),
			'us_pass'=>$this->input->post('password'),
			'us_date'=>$this->input->post('create_on'),
		);
		$email=$this->input->post('email');
		$row = $this->queryModel->query_one_cond('tb_user','us_email','us_email',$email);
		if($row->num_rows()>0){
			$array = array('error'=>true);
			echo json_encode($array);
		}
		else{
			$sql = $this->insertModel->defaultInsert('tb_user',$data);
			$array = array('success'=>true);
			echo json_encode($array);
		}
		
	}

	// Insert Category
	function addcategory(){
		$data = array(
			'cat_name'=>$this->input->post('cat_name'),
			'cat_description'=>$this->input->post('cat_des'),
		);
		$this->insertModel->defaultInsert('tb_category',$data);
		$array = array('success'=>true);
		echo json_encode($array);
	}

	//Insert Product
	function addproduct(){
		$pro_name = $this->input->post('pro_name');
		$proNameLow = strtolower($pro_name);

		$data = array(
			'pro_name'=>$proNameLow,
			'pro_price'=>$this->input->post('pro_price'),
			'pro_cat'=>$this->input->post('pro_cat'),
			'pro_description'=>$this->input->post('pro_des'),
		);
		$get_proName = $this->queryModel->query_one_cond('tb_products','pro_name','pro_name',$proNameLow);
		if($get_proName->num_rows()>0){
			$array = array('ready'=>true);echo json_encode($array);
		}
		else{
			$this->insertModel->defaultInsert('tb_products',$data);
			$array = array('success'=>true);echo json_encode($array);
		}

	}

	//Insert Customer
	function addcustomer(){
		$us_email = $this->session->userdata('email');
		$sql = $this->queryModel->query_one_cond('tb_user','us_id','us_email',$us_email);
		$us_id='';
		foreach ($sql->result() as $row) {
			$us_id =$row->us_id;
		}
		if($us_id==''){
			$array = array('tolog'=>true);echo json_encode($array);
		}
		else{
			$data = array(
				'cus_name'=>$this->input->post('cus_name'),
				'cus_phone'=>$this->input->post('cus_phone'),
				'cus_email'=>$this->input->post('cus_email'),
				'cus_address'=>$this->input->post('cus_add'),
				'cus_cre_date'=>$this->input->post('cus_on'),
				'cus_cre_by'=>$us_id,
			);
			$this->insertModel->defaultInsert('tb_customer',$data);
			$array = array('success'=>true);echo json_encode($array);
		}
	}

	//Insert Quote
	public function addquote(){
		$email = $this->session->userdata('email');
		$email_id = $this->queryModel->query_one_cond('tb_user','us_id','us_email',$email);
		
		if($email_id->num_rows()>0){
			$us_id;
			foreach ($email_id->result() as $row) {
				$us_id = $row->us_id;
			}
			$data = array(
				'quote_num'=>$this->input->post('q_num'),
				'quote_status'=>$this->input->post('q_status'),
				'quote_cre_date'=>$this->input->post('q_on'),
				'quote_ex_date'=>$this->input->post('q_ex'),
				'quote_cus'=>$this->input->post('q_cus'),
				'quote_amount'=>$this->input->post('q_amount'),
				'quote_by'=>$us_id
			);
			$this->insertModel->defaultInsert('tb_quote',$data);
			$array = array('success'=>true);echo json_encode($array);
		}
		else{
			$array = array('redi'=>true);echo json_encode($array);
		}
	}
	public function additem(){
		if($this->session->userdata('email')){
			$quote = $this->input->post('item_quote');
			$pro = $this->input->post('item_name');
			$stmt = $this->queryModel->query_item_update($quote,$pro);
			if($stmt->num_rows()>0){
				$qty="";
				foreach($stmt->result() as $row){
					$qty=$row->item_qty;
				};
				$in_qty = $this->input->post('item_qty');
				$new_qty = (int)$qty+(int)$in_qty;
				$data = array(
					'item_qty'=>$new_qty,
					'item_description'=>$this->input->post('item_des'),
				);
				$updata = $this->updateModel->update_two_cond('tb_items',$data,'item_quote',$quote,'item_pro',$pro);
				if($updata ==true){
					$array =array('updated'=>true);echo json_encode($array);
				}

			}
			else{
				$data = array(
					'item_qty'=>$this->input->post('item_qty'),
					'item_description'=>$this->input->post('item_des'),
					'item_quote'=>$this->input->post('item_quote'),
					'item_pro'=>$this->input->post('item_name'),
				);
				$sql = $this->insertModel->defaultInsert('tb_items',$data);
				if($sql ==true){
					$array =array('inserted'=>true);echo json_encode($array);
				}
			}
			
		}
		else{
			$array = array('redir'=>true);echo json_encode($array);
		}
	}

	public function addInvoice(){
		$cre_date = date('d/m/Y');
		$ex_date = date('d/m/Y',strtotime('+10 days'));
		$email = $this->session->userdata('email');
		$sql = $this->queryModel->query_one_cond('tb_user','us_id','us_email',$email);
		if($sql->num_rows()>0){
			$iv_by;
			foreach($sql->result() as $row){
				$iv_by = $row->us_id;
			}
			$iv_quote = $this->input->post('iv_quote');
			$quote = $this->queryModel->query_one_cond('tb_invoice','iv_quote','iv_quote',$iv_quote);
			if($quote->num_rows()>0){

				$array = array('exit'=>true);echo json_encode($array);
			}else{
				$data = array(
					'iv_num'=>$this->input->post('iv_num'),
					'iv_quote'=>$this->input->post('iv_quote'),
					'iv_status'=>$this->input->post('iv_status'),
					'iv_date'=>$cre_date,
					'iv_ex_date'=>$ex_date,
					'iv_by'=>$iv_by,
					'iv_paid'=>0,
					'iv_balance'=>0,
					'iv_note'=>' ',
				);
				$this->insertModel->defaultInsert('tb_invoice',$data);
				$array = array('inserted'=>true);echo json_encode($array);
			}
		}
		else{
			$array = array('redir'=>true);echo json_encode($array);
		}
	}
}
 ?>