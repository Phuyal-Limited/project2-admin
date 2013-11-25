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

	public function room_setting()
	{
		$data['title'] = 'Nepalinn | Room Setting';
		$this->load->view('header', $data);
		$this->load->view('room_setting');
		$this->load->view('footer');
	}

	public function change_password()
	{
		//Check if the form has been submitted.
		if($this->input->post('pswChng')){
			//First check if the current password is correct
			$login_details=array(
				'username' => $this->session->userdata['username'],
				'password' => sha1($this->input->post('old'))
			);
			$result=$this->dbase->login($login_details);
			if($result == array()){
				$data['success']=0;
				$data['message']="Invalid Password. Please enter correct password.";
			}
			else
			{
				//Here old password entered is correct now
				$new=$this->input->post("new");
				$new=sha1($new);
				$id= $result[0]->user_id;
				$credentials=array(
					'password' => $new
				);
				$this->rooms->change_password($id,$credentials);
				$data["success"] = 1;
				$data['message']="Password Changed successfully.";
			}
		}
		//Load the change password form
		$data['title'] = 'Nepalinn | Change Password';
		$this->load->view('header', $data);
		$this->load->view('change_password');
		$this->load->view('footer');
	}

	//login function
	public function login_entry()
	{
		//check if submit button clicked or not
		if (!isset($_POST['name'])){
			redirect('login');
		}else{
			$pass = $this->input->post('pass');
			$pass = sha1($pass);
			$login_details = array(
				'username' => $this->input->post('name'),
				'password' => $pass
			);
			
			$output = $this->dbase->login($login_details);
			
			
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

	public function edit()
	{
		$data['title'] = 'Edit | Home';
		$hotel_id = $this->session->userdata['hotel_id'];
		$data['hotel_details'] = $this->booking->get_Hotel_Details($hotel_id);
		$data['hotel_facilities'] = $this->booking->get_hotel_facilities($hotel_id);
		
		$default_image = $data['hotel_details'][0]->default_imgid;
		$other_image = $data['hotel_details'][0]->image_id;
		
		$data['default_image'] = $this->dbase->get_Image_Details($default_image);
		$data['other_image'] = $this->dbase->get_Image_Details($other_image);

		
		$this->load->view('header', $data);
		$this->load->view('edit');
		$this->load->view('footer');
	}

	public function edit_update(){
		if(!isset($_POST['update'])){
			redirect('home');
		}else{
			
			$hotel_id = $this->session->userdata['hotel_id'];
			// $hotel_details = $this->booking->get_Hotel_Details($hotel_id);

			// $hotel_name = $hotel_details[0]->name;
			// $default_image = $hotel_details[0]->default_imgid;
			// $last_id = $this->dbase->last_image();
			// if($default_image==0){
			// 	$default_image = $last_id;
			// 	$last_id = $last_id + 1;
			// }
			
			

			// //image upload to the folder
			

			// $this->load->library('upload');

	  //      $config['upload_path'] = './assets/images/hotel_image/';
	  //      $config['allowed_types'] = 'jpg|png|jpeg|JPG|PNG|JPEG';
	       
	  //      $config['overwrite'] = TRUE;

	  //      $config['file_name'] = $hotel_name;
	  //      $this->upload->initialize($config);
	        
	  //      $details = array();
	  //      $error = array();
	  //      $upload_error = array();
	  //      $i++;
	  //      foreach($_FILES as $field => $file)
	  //      {
	       	
	  //          // No problems with the file
	  //          if($file['error'] == 0)
	  //          {
	  //              // So lets upload
	  //              if ($this->upload->do_upload($field))
	  //              {

	  //                  $data = $this->upload->data();
	  //                 //default image update
	  //                  if($field=='default_image'){
	  //               		$name=$data['file_name'];
	  //                  		$image_details = array(
	  //                  		'name' => $name,
	  //                   		'path' => 'http://admin.nepalinn.com/assets/images/hotel_image/'.$name,
	  //                   		'alt' => $hotel_name
	  //                   	);

	  //                   	$this->dbase->image_add($default_image);
	  //                   }else{
	  //                   	$name = $this->input->post('image_name');
	  //                   	if($name==''){
	  //                   		$name=$data['file_name'];
	  //                   	}

	  //                   	$image_details = array(
	  //                   		'name' => $name,
	  //                   		'path' => 'http://admin.nepalinn.com/assets/images/hotel_image/'.$name,
	  //                   		'alt' => $name
	  //                   	);
	  //                   	array_push($details, $data);
	  //               	}
	  //               }else
	  //               {
	  //                   $errors = $this->upload->display_errors();print_r($errors);
	  //                   array_push($upload_error, $error);
	  //               }
	  //           }
	  //           else{
		 //    		array_push($error, 'Error');
	  //           }
	  //       }
	        
			//update hotel facilities
			$hotel_facilities = array();
			foreach ($_POST['check'] as $key => $value) {
				$hotel_facility['hotel_id'] = $hotel_id;
				$hotel_facility['facility_id'] = $value;
				array_push($hotel_facilities, $hotel_facility);
			}

			$this->dbase->hotel_facilities_update($hotel_facilities, $hotel_id);

	        //update hotel details
	        $update_hotel = array(
	        	'address' => $this->input->post('address'),
	        	'city' => $this->input->post('city'),
	        	'url' => $this->input->post('url'),
	        	'google_map_url' => $this->input->post('google_url'),
	        	'phone1' => $this->input->post('phone1'),
	        	'phone2' => $this->input->post('phone2'),
	        	'email' => $this->input->post('email'),
	        	'description' => $this->input->post('description')
	        );

	        $this->dbase->hotel_Update($update_hotel, $hotel_id);

	        redirect('home');

    	}
	}

	//autoload pickup details
	public function pickup(){
		$hotel_id = $this->session->userdata['hotel_id'];
		$pickup_details = $this->booking->get_Pickup_Details(1);
		print_r(json_encode($pickup_details));
	}

}

