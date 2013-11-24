<?php

class Booking extends CI_Model{

	
	//function to get hotel details
	public function get_Hotel_Details($hotelID){
		$this->db->where("hotel_id", $hotelID);
		$hotel_details = $this->db->get('hotel');
		return $hotel_details->result();
	}

	
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
				if ($rowAll->facility_id == $rowId->facility_id) {
					$check = 1;
					break;
				}
			}
			$availableFacilities[0] = $rowAll->facility_id;
			$availableFacilities[1] = $rowAll->facility_name;
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

}
?>