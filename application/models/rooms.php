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
	  Nov 26, 2013 */
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
		$this->db->where("checkin_date < '$fromDate' AND checkout_date > '$fromDate'");
		$this->db->or_where("checkin_date < '$toDate' AND checkout_date > '$toDate'");
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

}
?>
