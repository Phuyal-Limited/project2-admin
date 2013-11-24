<?php

class Rooms extends CI_Model{

	public function change_password($id,$credentials){
		$this->db->where('user_id',$id);
		$this->db->update('user',$credentials);
	}

}

?>
