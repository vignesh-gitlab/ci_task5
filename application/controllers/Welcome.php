<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('user_model');
		$this->load->library('session');

	}

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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	 public function index() //page loads on while site opening
	{
		$this->load->view('login_view');
	}
	public function register(){ // opens new user registration page
		$this->load->view('register_view');
	}
	public function register_data(){ //get data from view page
		$data=array(
			'name'=>$this->input->post("name"),
			'user_name'=>$this->input->post("user_name"),
			'password'=>$this->input->post("password"),
			'latitude'=>$this->input->post("latitude"),
			'longitude'=>$this->input->post("longitude")
		);
		if($this->user_model->insert($data)){
			echo json_encode(true);
		}else{
			echo json_encode(false);
		}		
	}
	public function login(){ //login validation
		$user_name=$this->input->post("user_name");
		$password=$this->input->post("password");
		$res=$this->user_model->login_validate($user_name,$password);
		if($res->user_type=="admin"){
			$this->session->set_userdata('id',$res->id);
			echo "flag1";
			//$this->load->view('admin_home_view');
		}else if($res->user_type=="normal"){
			$this->session->set_userdata('id',$res->id);
			echo "flag2";
			//$this->load->view('user_home_view');
		}else{
			echo "flag3";
			//echo "username and password did not match";
		}
	}
	public function admin_home(){ //login goto admin home page
		if($this->session->has_userdata('id')){
			$this->load->view('admin_home_view');
		}else{
			$this->load->view('login_view');
		}		
	}
	
	public function user_home(){ //login goto user home page
		if($this->session->has_userdata('id')){
			$this->load->view('user_home_view');
		}else{
			$this->load->view('login_view');
		}
	}
	public function log_out(){ //logout function
		$this->session->unset_userdata('id');
		$this->load->view('login_view');
	}
	public function view_users(){ //load user details
		if($this->session->has_userdata('id')){
			$this->load->view('user_details_view');
		}else{
			$this->load->view('login_view');
		}
		
	}
	public function get_users(){ //get user details from database
		$data=$this->user_model->get_data();
		echo json_encode($data);

	}
	public function update_data(){ //update user details into database
		//$this->load->view('edit_view');
		$id=$this->input->post("edit_id");
		$data=array(			
			'name'=>$this->input->post("name"),
			'user_name'=>$this->input->post("user_name"),
			'password'=>$this->input->post("password")
		);
		$result=$this->user_model->update_data($id,$data);
		echo $result;
	}
	public function delete_data(){ //delete user details from database
		$id=$this->input->post("id");
		$result=$this->user_model->delete_row($id);
		echo $result;
	}
}
