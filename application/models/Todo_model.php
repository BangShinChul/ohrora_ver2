<?php
//model의 클래스명 규칙
// 클래스명은 반드시 대문자 컨트롤러명_model 로 지정한다.
// 그리고 반드시 CI_Model을 상속받는다.

class Todo_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	# 모든 todo 항목들 데이터 가져오기
	function get_list(){
		return $this->db->get('items')->result();
	}

	# 해당 id의 todo 컨턴츠 조회
	function get_view($id){
		return $this->db->get_where('items', array('id' => $id))->row();
	}

	# todo 컨텐츠 insert
	function insert_todo($content, $created_on, $due_date){
		$data = array(
			'content' => $content,
			'created_on' => $created_on,
			'due_date' => $due_date
		);
		$this->db->insert('items',$data);
	}

	# todo 컨텐츠 delete
	function delete_todo($id){
		$this->db->where('id',$id);
		$this->db->delete('items');
		# delete from items where id = $id;
	}
}
?>