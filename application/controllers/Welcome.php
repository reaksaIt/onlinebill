<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$this->load->model('query');
		$this->load->model('update');
		$this->load->model('homeModel');
		$this->load->helper('url');
	}
	public function showstudent()
	{
		$this->load->view('dashboard/header');
		$this->load->view('student');
		$this->load->view('dashboard/footer');
	}

	public function readstudent(){
		$data = $this->query->query_join_table('*','score','student','score.student_id=student.stu_id');
		$sql = $data->result_array();
		echo json_encode($sql);
	}
	// public function setval(){

	// 	$id = $this->input->post('id');
	// 	$data = $this->query->query_one_cond('score','*','student_id',$id);
	// 	$sql = $data->result_array();
	// 	echo json_encode($sql);

	// }
	public function addstudent(){
		$data =array('st_name'=>$this->input->post('name'));
		
		$this->homeModel->insertdata('student',$data);
		$array = array('success'=>true);echo json_encode($array);
		
	}
	public function readstuid(){
		$data = $this->query->defaultQuery('student','max(stu_id) as stuId');
		$sql = $data->result_array();
		echo json_encode($sql);
	}
	public function newscore(){
		$data =array('student_id'=>$this->input->post('id'));
		$id = $this->input->post('id');
		$sql = $this->query->query_one_cond('score','*','student_id',$id);
		if($sql->num_rows()==0){
			$this->homeModel->insertdata('score',$data);
			$array= array('success'=>true);echo json_encode($array);
		}
		//$this->homeModel->insertdata('score',$data);
	}

	//Update field
	public function upkh(){
		$data = array('khmer'=>$this->input->post('val'));
		$id= $this->input->post('id');
			$this->update->update_one_cond('score',$data,'student_id',$id);
			echo json_encode($id);
		
	}public function upma(){
		$data = array('math'=>$this->input->post('val'));
		$id= $this->input->post('id');
		$this->update->update_one_cond('score',$data,'student_id',$id);
		echo json_encode($id);
	}public function upmo(){
		$data = array('moral'=>$this->input->post('val'));
		$id= $this->input->post('id');
		$this->update->update_one_cond('score',$data,'student_id',$id);
		echo json_encode($id);
	}public function upsi(){
		$data = array('scient'=>$this->input->post('val'));
		$id= $this->input->post('id');
		$this->update->update_one_cond('score',$data,'student_id',$id);
		echo json_encode($id);
	}
}
