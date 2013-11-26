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

	/*
	Given hotelID, this function returns name of the guests who needs to be picked up from specified place at specified time
	*/
	public function get_Pickup_Details($hotelID)
	{
		$dateToday = date('Y-m-d');
		$this->db->select('guest_id, pickup_place, pickup_time');
		$this->db->where('hotel_id', $hotelID);
		$this->db->where('checkin_date', $dateToday);
		$this->db->where('pickup_req', '1');
		$this->db->where('status', '0');
		$id = $this->db->get('booking');
		$details = array();
		$resultDetails = array();
		foreach ($id->result() as $row) {
			$this->db->select('name');
			$this->db->where('guest_id', $row->guest_id);
			$guestName = $this->db->get('guest');
			$guestName = $guestName->result();
			$details['name'] = $guestName[0]->name;
			$details['pickup_place'] = $row->pickup_place;
			$details['pickup_time'] = $row->pickup_time;
			array_push($resultDetails, $details);
		}
		return $resultDetails;
	}

	/*
	provided guest id, this function returns the guest name associated with the guest id.
	*/
	public function get_Guest_Name($guestID){
		$this->db->select('name');
		$this->db->where('guest_id', $guestID);
		$guestName = $this->db->get('guest');
		$guestName = $guestName->result();
		$guestName = $guestName[0]->name;

		return $guestName;
	}

	/*
	provided booking id, this function returns all the room numbers associated with the booking id.
	*/
	public function get_Room_Number($bookingID){
		$this->db->select('room_id');
		$this->db->where('booking_id', $bookingID);
		$roomID = $this->db->get('booking_room');
		$bookedRooms = array();
		foreach ($roomID->result() as $row) {
			$this->db->select('room_no');
			$this->db->where('room_id', $row->room_id);
			$roomNumber = $this->db->get('room');
			$roomNumber = $roomNumber->result();
			$roomNumber = $roomNumber[0]->room_no;
			array_push($bookedRooms, $roomNumber);
		}

		return $bookedRooms;
	}


	/*
	Provided hotelID and flag, this function returns booking details which includes, booking id, guest id, guest's name, checkin date, checkout date, list of room numbers.
	*/
	public function get_Booking_Details($hotelID, $flag){
		$this->db->select('booking_id, guest_id, checkin_date');
		$this->db->select('checkout_date');
		$this->db->where('hotel_id', $hotelID);
		if ($flag == '0') {
			$this->db->order_by('booking_id', 'desc');
			$this->db->limit(5);
		}
		else if ($flag == '1') {
			$dateToday = date('Y-m-d');
			$this->db->where('checkin_date', $dateToday);
			$this->db->where('status', '0');
		}
		else{
			echo "flag set to invalid integer or the flag is not set at all.";
		}
		$guestRaw = $this->db->get('booking');
		$bookingDetails = array();
		$allDetails = array();
		foreach ($guestRaw->result() as $rowRaw) {
			$bookingDetails['booking_id'] = $rowRaw->booking_id;
			$bookingDetails['guest_id'] = $rowRaw->guest_id;
			$bookingDetails['name'] = $this->get_Guest_Name($rowRaw->guest_id);
			$bookingDetails['checkin_date'] = $rowRaw->checkin_date;
			$bookingDetails['checkout_date'] = $rowRaw->checkout_date;
			$bookingDetails['room_numbers'] = $this->get_Room_Number($rowRaw->booking_id);
			array_push($allDetails, $bookingDetails);
		}

		return $allDetails;
	}

	/*
	provided hotel id, this function returns all the room templates and other information in room_templates table associated to the specified hotel by the hotel id.
	*/
	public function get_Templates($hotelID){
		$eachTemplates = array();
		$allTemplates = array();
		$this->db->where('hotel_id', $hotelID);
		$templates = $this->db->get('room_templates/standards');
		foreach ($templates->result() as $row) {
			$eachTemplates = get_object_vars($row);
			array_push($allTemplates, $eachTemplates);
		}
		return $allTemplates;
	}

	/*
	provided template id, this function returns the list of rooms and other information in room table associated to the specified hotel by the template id.
	*/
	public function get_Rooms($templateID){
		$eachRoom = array();
		$allRooms = array();
		$this->db->where('template_id', $templateID);
		$rooms = $this->db->get('room');
		foreach ($rooms->result() as $row) {
			$eachRoom = get_object_vars($row);
			array_push($allRooms, $eachRoom);
		}
		return $allRooms;
	}
}
?>