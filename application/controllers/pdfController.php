<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pdfController extends CI_Controller {

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

	public function __construct(){
		parent::__construct();
		$this->load->model('querymodel');
		$this->load->model('updatemodel');
		//$this->load->model('homeModel');
		$this->load->helper('url');
		$this->load->library('pdf');
	}

	public function quotepdf($id){
		$data['info'] = $this->querymodel->query_quote_info_pdf($id);
		$data['quote'] = $this->querymodel->query_item_info($id);
		//$this->load->view('dashboard/header');
		//$html = $this->load->view('pdf/quotepdf',[],true);
		$this->pdf->load_view('pdf/quotepdf',$data);
		//$this->load->view('dashboard/footer');
	}
	
}
