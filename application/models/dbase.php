<?php

class Database extends CI_Model{

	public function login($data){
		$this->db->where($data);
		$login_result = $this->db->get('user');
		return $login_result->result();

	}

	//function to get hotel details
	public function get_Hotel_Details($hotelID){
		$this->db->where("hotel_id", $hotelID);
		$hotel_details = $this->db->get('hotel');
		return $hotel_details->result();
	}

	/*//To display in Today's Guest Pickup
	public function get_Pickup_Details($hotelID)
	{
		$this->db->select('guest.name, booking.pickup_place, booking.pickup_time');
		$this->db->from('guest');
		$this->db->from('booking');
		$this->db->where('guest.guest_id = booking.guest_id');
		$pickup_details = $this->db->get();
		return $pickup_details->result();		
	}*/

	/*
		Given hotel id, this function returns all the facilites in the database with the avaibility of them in the hotel.
		It returns facility id, facility name and avaibility of that facility in that hotel (1 or 0).
	*/
	public function get_hotel_facilities($hotelID){
		//to find available facility id of the given hotel.
		$this->db->select('facility_id');
		$this->db->where('hotel_id', $hotelID);
		$facilityId = $this->db->get('hotel_facilities');

		/*gets all the facilities for filtering. the facility id from above is compared to all the facility id's and marked
			as 1 if the facility is available else 0.
		*/
		$allFacilities = $this->db->get('facilities');
		$availableFacilities = array();
		$resultFacilities = array();
		$check = 0;
		foreach ($allFacilities->result() as $rowAll) {
			$i=0;
			foreach ($facilityId->result() as $rowId) {
				$this->db->where('facility_id', $rowId->facility_id);
				$facilityName = $this->db->get('facilities');
				$facilityName = $facilityName->result();
				$availableFacilities[0] = $rowAll->facility_id;
				$availableFacilities[1] = $rowAll->facility_name;
				
				if ($rowAll->facility_id == $rowId->facility_id) {
					$check = 1;
					break;
				}
			}
			if ($check == '1') {
				$availableFacilities[2] = '1';
			}
			else
			{
				$availableFacilities[2] = '0';
			}
			array_push($resultFacilities, $availableFacilities);
			$check = 0;			
		}
		return $resultFacilities; //Returns two dimentional array
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
}

?>