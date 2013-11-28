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
		$hotel_id = $this->session->userdata['hotel_id'];
		$data['rooms'] = $this->rooms->get_room_with_status_today($hotel_id);
		$this->load->view('header', $data);
		$this->load->view('home');
		$this->load->view('footer');
	}

	public function room_setting()
	{
		$data['title'] = 'Nepalinn | Room Setting';

		$allrooms = array();
		$hotel_id = $this->session->userdata['hotel_id'];
		$data['template_details'] = $this->booking->get_Templates($hotel_id);
		foreach ($data['template_details'] as $eachTemplate) {
			$template_id = $eachTemplate['template_id'];
			$template_room = $this->booking->get_Rooms($template_id);
			array_push($allrooms, $template_room);
		}//print_r($allrooms);exit();
		$data['template_room'] = $allrooms;

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


	//logout function
	public function logout(){
		$this->session->sess_destroy();
		$this->index();
	}


	//profile edit function
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
		if($this->input->post('update')==false){
			redirect('home');
		}else{
			
			$hotel_id = $this->session->userdata['hotel_id'];
			$hotel_details = $this->booking->get_Hotel_Details($hotel_id);

			$images_list = $hotel_details[0]->image_id;
			$hotel_name = $hotel_details[0]->name;
			$default_image_id = $hotel_details[0]->default_imgid;

			//get last id + 1. if empty gets 1
			$last_id = $this->dbase->last_image();
			if($_FILES['default_image']['error']==0){
				if($default_image_id==0){
					$default_image = $last_id;
					$last_id = $last_id + 1;
				}
			}
			
			

			//image upload to the folder
			

			$this->load->library('upload');

	       $config['upload_path'] = './assets/images/hotel_image/';
	       $config['allowed_types'] = 'jpg|png|jpeg|JPG|PNG|JPEG';
	       
	       $config['overwrite'] = TRUE;

	       
	        
	       $details = array();
	       $error = array();
	       $upload_error = array();
	       $id_list = array();
	       foreach($_FILES as $field => $file)
	       {
				
	           // No problems with the file
	           if($file['error'] == 0)
	           {
	           		//provide the file name before uploading like 1.jpg, 2.png etc correspond to the image_id
	           		if($field=='default_image'){
		       			$config['file_name'] = $default_image;
	       			}else{
	       				$config['file_name'] = $last_id;

	       				array_push($id_list, $last_id);    //id list for updating
	       				$last_id = $last_id + 1;
	       			}
	       			$this->upload->initialize($config);



	               // So lets upload
	               if ($this->upload->do_upload($field))
	               {

	                   $data = $this->upload->data();

	                   $name = $data['file_name']; //get the name of file name like 1.jpg, 2.png - correspond to the image_id
	                   

	                   	//default image update
	                   	if($field=='default_image'){
	                		$image_details = array(
	                   			'name' => $hotel_name,
	                    		'path' => 'http://admin.nepalinn.com/assets/images/hotel_image/'.$name,
	                    		'alt' => $hotel_name
	                    	);

	                		if($default_image_id==0){
	                			array_push($details, $image_details);
	                		}else{
	                			//do nothing as the file is uploaded to the folder and database contains the data
	                		}
	                    }else{
	                    	$image_details = array(
	                    		'name' => $hotel_name,
	                    		'path' => 'http://admin.nepalinn.com/assets/images/hotel_image/'.$name,
	                    		'alt' => $hotel_name
	                    	);
	                    	array_push($details, $image_details);
	                	}
	                }else
	                {
	                    $errors = $this->upload->display_errors();print_r($errors);
	                    array_push($upload_error, $error);
	                }
	            }
	            else{
		    		array_push($error, 'Error');
	            }
	        }

	        //change array of id list to comma separated string
	        if($images_list != ''){
	        	array_push($id_list, $images_list);	
	        }
	        
	        $ids = implode(', ', $id_list);


	        //update images or to say add new images
	        $this->dbase->image_add($details);
	        
			//update hotel facilities
			$hotel_facilities = array();
			foreach ($_POST['check'] as $key => $value) {
				$hotel_facility['hotel_id'] = $hotel_id;
				$hotel_facility['facility_id'] = $value;
				array_push($hotel_facilities, $hotel_facility);
			}

			$this->dbase->hotel_facilities_update($hotel_facilities, $hotel_id);



	        //update hotel details
	        if(!isset($default_image)){
	        	$default_image = $default_image_id;
	        }
	        $update_hotel = array(
	        	'address' => $this->input->post('address'),
	        	'city' => $this->input->post('city'),
	        	'url' => $this->input->post('url'),
	        	'google_map_url' => $this->input->post('google_url'),
	        	'phone1' => $this->input->post('phone1'),
	        	'phone2' => $this->input->post('phone2'),
	        	'email' => $this->input->post('email'),
	        	'image_id' => $ids,
	        	'default_imgid' => $default_image,
	        	'description' => $this->input->post('description')
	        );

	        $this->dbase->hotel_Update($update_hotel, $hotel_id);

	        redirect('home');

    	}
	}

	//autoload today pickup details
	public function pickup(){
		$hotel_id = $this->session->userdata['hotel_id'];
		$pickup_details = $this->booking->get_Pickup_Details($hotel_id);
		print_r(json_encode($pickup_details));
	}


	//autoload scheduled arrival details
	public function scheduled_arrival(){
		$hotel_id = $this->session->userdata['hotel_id'];
		$scheduled_arrival = $this->booking->get_Booking_Details($hotel_id, 0);
		print_r(json_encode($scheduled_arrival));
	}

	//autoload scheduled arrival details
	public function recent_booking(){
		$hotel_id = $this->session->userdata['hotel_id'];
		$recent_booking = $this->booking->get_Booking_Details($hotel_id, 1);
		print_r(json_encode($recent_booking));
	}

	//add new hotel template
	public function add_template(){
		if($this->input->post('add')==false){
			redirect('home');
		}else{
			$hotel_id = $this->session->userdata['hotel_id'];
			$template_details = array(
				'name' => $this->input->post('template_name'),
				'hotel_id' => $hotel_id,
				'rate' => $this->input->post('rate'),
				'description' => $this->input->post('description')
			);

			$this->dbase->add_Template($template_details);
			$this->room_setting();
		}
	}

	//add room to the room standards
	public function add_room(){
		if(!isset($_POST['template_id'])){
			echo 'exy';exit();redirect('home');
		}else{
			$hotel_id = $this->session->userdata['hotel_id'];
			$room_no = $_POST['room_no'];
			$room_exist = $this->rooms->room_no_exist($hotel_id, $room_no);
			echo $room_exist;
		}
	}

}

