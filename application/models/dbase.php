<?php

class Dbase extends CI_Model{

	public function login($data){
		$this->db->where($data);
		$login_result = $this->db->get('user');
		return $login_result->result();

	}

	//get the image details
	public function get_Image_Details($image_id){
		$details = array();
		if($image_id == ''){
			return $details;
		}
		if($image_id == 0){
			return $details;
		}
		$id_array = explode(', ', $image_id);
		
		for($i=0;$i<sizeof($id_array);$i++){
			$img_id = $id_array[$i];

			$this->db->where('image_id', $img_id);
			$image_details = $this->db->get('images');
			$image_details = $image_details->result();
			array_push($details, $image_details[0]);
		}
		return $details;
	}

		//get last image id
	public function last_image(){
		$this->db->order_by('image_id', 'desc');
		$image_details = $this->db->get('images');
		$image_details = $image_details->result();
		if($image_details==array()){
			$last_id = 1;
		}else{
			$last_id = $image_details[0]->image_id;
			$last_id = $last_id + 1;
		}
		return $last_id;
	}

	//update hotel details
	public function hotel_Update($hotel_details, $hotel_id){
		$this->db->where('hotel_id', $hotel_id);
		$this->db->update('hotel', $hotel_details); 
	}

	//update hotel facilities
	public function hotel_facilities_update($hotel_facilities, $hotel_id){
		$this->db->where('hotel_id', $hotel_id);
		$this->db->delete('hotel_facilities'); 
		$this->db->insert_batch('hotel_facilities', $hotel_facilities); 
	}

	//update hotel images
	public function image_add($details){
		$this->db->insert_batch('images', $details);
	}

	//add new template
	public function add_Template($details){
		$this->db->insert('room_templates/standards', $details);
	}

	//add room no to a template
	public function add_Room($details){
		$this->db->insert('room', $details);	
	}
}

?>