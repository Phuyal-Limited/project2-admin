<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nepalinn extends CI_Controller {

	
	public function index()
	{
		$data['title'] = 'Hotelinn | Loign';
		$this->load->view('header', $data);
		$this->load->view('login');
		$this->load->view('footer');
	}
	
	public function login()
	{
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
	}

	
}

