<?php

class Database extends CI_Model{

	public function login($data){
		$this->db->where($data);
		$login_result = $this->db->get('user');
		return $login_result->result();

	}
}

?>