<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nepalinn extends CI_Controller {

	
	public function index()
	{
		$data['title'] = 'Hotelinn | Loign';
		$this->load->view('login', $data);
	}
	
	public function login()
	{
		$this->load->view('login');
	}

	public function home()
	{
		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
	}


}

