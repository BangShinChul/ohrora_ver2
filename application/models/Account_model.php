<?php
//model의 클래스명 규칙
// 클래스명은 반드시 대문자 컨트롤러명_model 로 지정한다.
// 그리고 반드시 CI_Model을 상속받는다.

/*
	사용자 계정 생성, 수정, 삭제 model
*/
class Account_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	public function create_account($id,$password,$name,$email){
		//회원가입 기능
		$data = array(
			'user_id' => $id,
			'user_password' => $password,
			'user_email' => $email,
			'user_name' => $name
		);
		$this->db->insert('userinfo',$data);
		//실행한 마지막 쿼리문을 보여준다.
		//echo $this->db->last_query();
		return true;
	}
}