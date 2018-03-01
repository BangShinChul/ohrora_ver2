<?php
//model의 클래스명 규칙
// 클래스명은 반드시 대문자 컨트롤러명_model 로 지정한다.
// 그리고 반드시 CI_Model을 상속받는다.

class Main_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	public function gets(){
		//데이터를 가져오는 코드
		//아래는 현재 설정한 DB에 접속하는 인스턴스이다.
		//query안의 문자열로 쿼리를 날리고 result()으로 결과값을 가져온다.
		//return $this->db->query('SELECT * FROM topic')->result(); //쿼리를 날려 가져온 결과를 객체로 리턴해준다. result_array(); 로 하면 array로 리턴해준다.
		return $this->db->get('topic')->result();
	}

	public function get($topic_id){

		// $this->db->select('title'); //select 문은 이렇게 사용함 

		//topic 테이블에서 id를 넘겨서 조건검색한다. 결과는 한줄만 가져올것이므로 row()로 가져온다.
		return $this->db->get_where('topic', array('id' => $topic_id ))->row(); //active record 방식의 코딩법. 이것의 장점은 DB의 이식성이 좋아짐.(다른 DB로 옮길때 수정할필요가 없음)
		# return $this->db->qurey('SELECT * FROM topic WHERE id='.$topic_id)->result(); 와 똑같은 것임.
	}

	public function get_login($id){
		return $this->db->get_where('userinfo', array('user_id' => $id))->row();
	}

	public function create_account($id,$password){
		//회원가입 기능
		$data = array(
			'user_id' => $id,
			'user_password' => $password
		);
		$this->db->insert('userinfo',$data);
		//실행한 마지막 쿼리문을 보여준다.
		//echo $this->db->last_query();
		return true;
	}

}
?>