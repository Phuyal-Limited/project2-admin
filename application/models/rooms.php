<?php

class Rooms extends CI_Model{

	/*Function to change password of given user
	  User ID and new passwoed should be provided
	  Does not check for any validity
	  By: Bidur Subedi
	  Nov 24, 2013 */
	public function change_password($id,$credentials){
		$this->db->where('user_id',$id);
		$this->db->update('user',$credentials);
	}

	/*Function to obtain the status of room
	  Room ID and the date  to check status should be supplied
	  By: Bidur Subedi
	  Nov 25, 2013 */
	public function get_status($roomID,$date){
		//Obtain all booking with that room ID
		$this->db->select('booking_id');
		$this->db->where('room_id',$roomID);
		$booking_id=$this->db->get('booking_room');
		$booking_id=$booking_id->result();
		$book_id = array();
		foreach ($booking_id as $value) {
			array_push($book_id, $value->booking_id);	
		}
		if ($book_id == array())
			return 0;
		$this->db->select('status');
		$this->db->where_in('booking_id',$book_id);
		$this->db->where('checkin_date <=', $date);
		$this->db->where('checkout_date >=', $date);
		$result=$this->db->get('booking')->result();
		if($result == array())
			return 0;
		$result=$result[0]->status;
		return $result;
	}

	/*Function to obtain the status of room for a range of dates
	  Room ID and the date range  to check status should be supplied
	  By: Bidur Subedi
	  Nov 26, 2013 
	  Altered: Nov 28, 2013 by Bidur Subedi
	  Alteration: Removal of Bugs. Some test condition were missing*/
	public function get_status_on_range($roomID,$fromDate,$toDate){
		//Obtain all booking with that room ID
		$this->db->select('booking_id');
		$this->db->where('room_id',$roomID);
		$booking_id=$this->db->get('booking_room');
		$booking_id=$booking_id->result();
		$book_id = array();
		foreach ($booking_id as $value) {
			array_push($book_id, $value->booking_id);	
		}
		if ($book_id == array())
			return 0;
		$this->db->select('status');
		$this->db->where_in('booking_id',$book_id);
		$this->db->where("checkin_date <= '$fromDate' AND checkout_date > '$fromDate'");
		$this->db->or_where("checkin_date < '$toDate' AND checkout_date >= '$toDate'");
		$this->db->or_where("checkin_date > '$fromDate' AND checkout_date < '$toDate'");
		$result=$this->db->get('booking')->result();
		if($result == array())
			return 0;
		$result=$result[0]->status;
		return $result;
	}

	
	/*Function to obtain the list of rooms in hotel in that day
	  Returns an array of room number, standard and status
	  By: Bidur Subedi
	  Nov 27, 2013 */
	public function get_room_with_status_today($hotelID){
		$dateToday = date('Y-m-d');
		$room_with_status=array();
		$templates=$this->booking->get_Templates($hotelID);		
		$roomInfo=array();
		$result=array();
		foreach ($templates as $aTemplate) {
			$template_Name=$aTemplate['name'];
			$rooms=$this->booking->get_Rooms($aTemplate['template_id']);
			foreach ($rooms as $aRoom) {
				$roomInfo['roomNumber']=$aRoom['room_no'];
				$roomInfo['standard']=$template_Name;
				$status=$this->get_status($aRoom['room_id'],$dateToday);
				if ($status == 0) {
					$roomInfo['status']="available";
				}
				else if ($status == 1) {
					$roomInfo['status']="occupied";
				}
				else{
					$roomInfo['status']="booked";	
				}
				array_push($result, $roomInfo);
			}
		}
		return $result;
	}

	/*Function to check if a room number exists in a hotel
	  Returns boolean. True if exist and false if not
	  hotel ID and room number to be passed as arguments
	  By: Bidur Subedi
	  Nov 28, 2013 */
	public function room_no_exist($hotelID,$roomNumber){
		$templates=$this->booking->get_Templates($hotelID);		
		foreach ($templates as $aTemplate) {
			$rooms=$this->booking->get_Rooms($aTemplate['template_id']);
			foreach ($rooms as $aRoom) {
				$room_no=$aRoom['room_no'];
				if($room_no == $roomNumber)
					return true;
			}
		}
		return false;
	}

	/*Function to return a list of rooms available for a range of date
	  takes hotel ID and range of dates as argument
	  returns an array of Standards with array of available rooms each
	  By: Bidur Subedi
	  Nov 28, 2013 */
	public function get_available_rooms($hotelID,$fromDate,$toDate){
		$result = array();
		$templates=$this->booking->get_Templates($hotelID);
		foreach ($templates as $aTemplate) {
			$templateID=$aTemplate['template_id'];
			$rooms=$this->booking->get_Rooms($aTemplate['template_id']);
			$validRooms = array();
			foreach ($rooms as $aRoom) {
				$roomStatus=$this->get_status_on_range($aRoom['room_id'],$fromDate,$toDate);
				if($roomStatus == 0){
					array_push($validRooms, $aRoom);
				}
			}
			if($validRooms != array()){
				$aTemplate['rooms']=$validRooms;
				array_push($result, $aTemplate);
			}
		}
		return $result;
	}
}
?>
