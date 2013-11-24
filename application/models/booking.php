<?php

class Booking extends CI_Model{

	
	//function to get hotel details
	public function get_Hotel_Details($hotelID){
		$this->db->where("hotel_id", $hotelID);
		$hotel_details = $this->db->get('hotel');
		return $hotel_details->result();
	}


}
?>