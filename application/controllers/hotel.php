<?php
include('nepalinn.php');
class Hotel extends Nepalinn{
	public function test(){
		print_r ($this->rooms->get_room_with_status_today(1));
	}
}
?>