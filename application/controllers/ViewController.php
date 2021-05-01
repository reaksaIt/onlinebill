<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


	function __construct(){
		parent::__construct();
		$this->load->model('querymodel');
		$this->load->model('insertmodel');
		$this->load->model('deletemodel');
		$this->load->model('updatemodel');
		$this->load->library('form_validation');
		$this->load->helper("url");
	}


	// Page home
	public function index()
	{
		
		$this->load->view('dashboard/header');
		$this->load->view('dashboard/home');
		$this->load->view('dashboard/footer');
	}
	public function viewLogin(){
		$this->load->view('dashboard/header');
		$this->load->view('log/login');
		$this->load->view('dashboard/footer');
	}
	//View Register page
	public function register(){
		$sql = $this->querymodel->defaultQuery('tb_rule','rule_id,rule_type');
		$data['rule'] =$sql->result();
		$this->load->view('dashboard/header');
		$this->load->view('log/register',$data);
		$this->load->view('dashboard/footer');
	}
	//View Product page
	public function viewproduct(){
		$sql = $this->querymodel->defaultQuery('tb_category','cat_id,cat_name');
		$data['cat'] = $sql->result();
		
		$this->load->view('dashboard/header');
		$this->load->view('products/addproduct',$data);
		$this->load->view('dashboard/footer');
	}

	//View customer page
	public function viewcustomer(){
		$this->load->view('dashboard/header');
		$this->load->view('customer/customer');
		$this->load->view('dashboard/footer');
	}

	//Veiw Quote Page
	public function viewquote(){
		$data = $this->querymodel->defaultQuery('tb_customer','cus_id,cus_name');
		$sql['cus']=$data->result();
		$this->load->view('dashboard/header');
		$this->load->view('quote/quote',$sql);
		$this->load->view('dashboard/footer');
	}

	//Veiw Invoice Page
	public function viewinvoice(){
		$this->load->view('dashboard/header');
		$this->load->view('invoice/invoice');
		$this->load->view('dashboard/footer');
	}

	//Page Month Fee
	public function viewmonthfee(){
		$this->load->view('dashboard/header');
		$this->load->view('monthfee');
		$this->load->view('dashboard/footer');
	}

	public function viewItem($id){
		$sql['url'] = $this->uri->segment(3);
		$data = $this->querymodel->defaultQuery('tb_products','pro_id,pro_name');
		$sql['pro']=$data->result();
		$this->load->view('dashboard/header');
		$this->load->view('quote/items',$sql);
		$this->load->view('dashboard/footer');
	}

	
}
