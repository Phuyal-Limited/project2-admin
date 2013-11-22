<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nepalinn extends CI_Controller {

	
	public function index()
	{
		if(isset($this->session->userdata['user_id']) && isset($this->session->userdata['username']) && isset($this->session->userdata['full_name']) && isset($this->session->userdata['hotel_id'])){
			redirect('home');
		}
		
		$data['title'] = 'Nepalinn | Login';
		$this->load->view('login', $data);
	}
	
	public function login()
	{
		$this->index();
	}

	public function home()
	{
		$data['title'] = 'Nepalinn | Home';
		$this->load->view('header', $data);
		$this->load->view('home');
		$this->load->view('footer');
	}

	//login function
	public function login_entry()
	{
		//check if submit button clicked or not
		if (!isset($_POST['name'])){
			redirect('login');
		}else{
			$pass = $_POST['pass'];
			$pass = sha1($pass);
			$login_details = array(
				'username' => $_POST['name'],
				'password' => $pass
			);
			
			$output = $this->database->login($login_details);
			
			
			if($output == array()){
				echo 'User or Password invalid!';exit();
				
			}else{
			
				$sess_data = array(
					'user_id' => $output[0]->user_id,
					'username' => $output[0]->username,
					'full_name' => $output[0]->full_name,
					'hotel_id' => $output[0]->hotel_id
				);
				
				$this->session->set_userdata($sess_data);
				
				echo 'successful';exit();
			}
		}
	}

	public function logout(){
		$this->session->sess_destroy();

		$this->index();
	}


}

