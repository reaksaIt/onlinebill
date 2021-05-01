<?php
	/**
	 * 
	 */
	class QueryController extends CI_Controller
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



		public function login(){
			$email = $this->input->post('email');
			$pass = $this->input->post('password');
			$data = $this->queryModel->check_login($email,$pass);
			if($data->num_rows()>0){
				$se_email;
				$se_rule;
				foreach($data->result() as $row){
					$se_email = $row->us_email;
					$se_rule = $row->us_rule;
				}
				$user_session = array(
					'email' =>$se_email,
					'rule'=>$se_rule,
				);
				$this->session->set_userdata($user_session);
				$array= array('success'=>true);echo json_encode($array);
			}
			else{
				$array = array('fail'=>true);echo json_encode($array);
			}

		}

		public function querycategory(){
			$sql = $this->queryModel->defaultQuery('tb_category','*');
			
				$data = $sql->result_array();
				echo json_encode($data);

		}

		//Page Products
		public function queryproduct(){
			$sql = $this->queryModel->query_join_table('pro_id,pro_name,pro_price,pro_description,cat_name','tb_products','tb_category','tb_products.pro_cat=tb_category.cat_id');
			$data = $sql->result_array();
			echo json_encode($data);
			
		}
		public function editproduct(){
			$id = $this->input->post('id');
			$data = $this->queryModel->query_one_cond('tb_products','*','pro_id',$id);
			echo json_encode($data->result_array());
		}
		public function queryprice($id){
			$data= $this->queryModel->query_one_cond('tb_products','pro_price','pro_id',$id);
			echo json_encode($data->result_array());
		}

		//page customer
		public function querycustomer(){
			$data = $this->queryModel->query_join_table('cus_id,cus_name,cus_phone,cus_email,cus_address,cus_cre_date,us_fname,us_lname','tb_customer','tb_user','tb_customer.cus_cre_by=tb_user.us_id');
			echo json_encode($data->result_array());
		}
		public function editcustomer($id){
			$data = $this->queryModel->query_one_cond('tb_customer','cus_id,cus_name,cus_phone,cus_email,cus_address','cus_id',$id);
			echo json_encode($data->result_array());
		}
		public function queryQnum(){
			$data = $this->queryModel->defaultQuery('tb_quote','max(quote_num) as num');
			$sql = $data->result_array();
			echo json_encode($sql);
		}

		//Page Quote
		public function queryQuote(){
			$data = $this->queryModel->query_quote_info();
			$sql = $data->result_array();
			echo json_encode($sql);
		}

		//Page Items
		public function queryitem(){
			$id =$this->input->post('id');
			$data = $this->queryModel->query_item_info($id);
			echo json_encode($data->result_array());
		}
		public function edititem($id){
			$data = $this->queryModel->query_join_table_cond('pro_id,pro_price,item_qty,item_description,item_id','tb_items','tb_products','tb_items.item_pro=tb_products.pro_id','item_id',$id);
			echo json_encode($data->result_array());
		}

		//Query number invoice
		public function queryInvNum(){
			$data =$this->queryModel->defaultQuery('tb_invoice','max(iv_num) as ivNum');
			echo json_encode($data->result_array());
		}

		public function queryInvoice(){
			$data = $this->queryModel->query_invoice_info();
			echo json_encode($data->result_array());
		}

		public function queryAmount($id){
			$data =$this->queryModel->query_join_table_cond('quote_amount,iv_id','tb_invoice','tb_quote','tb_invoice.iv_quote = tb_quote.quote_id','iv_id',$id);
			echo json_encode($data->result_array());
		}
	}



?>