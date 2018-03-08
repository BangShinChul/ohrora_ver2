<?php
/*
	사용자 인증 model
*/
class Auth_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}


	public function account_check($id){
		return $this->db->get_where('userinfo', array('user_id' => $id))->row();
	}

	public function get_check($auth){
		return $this->db->get_where('userinfo', array('user_id' => $auth['user_id']))->row();
	}

}