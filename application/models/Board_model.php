<?php
//model의 클래스명 규칙
// 클래스명은 반드시 대문자 컨트롤러명_model 로 지정한다.
// 그리고 반드시 CI_Model을 상속받는다.

class Board_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

    function get_list($table = '', $type = '', $offset = '', $limit = '', $search_word = '') {
        $sword = '';
 
        if ($search_word != '') {
            // 검색어 있을 경우
            $sword = ' WHERE subject like "%' . $search_word . '%" or contents like "%' . $search_word . '%" ';
        }
 
        $limit_query = '';
 
        if ($limit != '' OR $offset != '') {
            // 페이징이 있을 경우 처리
            $limit_query = ' LIMIT ' . $offset . ', ' . $limit;
        }
 
        $sql = "SELECT * FROM " . 'board' . $sword . " ORDER BY board_id DESC " . $limit_query;
        $query = $this -> db -> query($sql);
 
        if ($type == 'count') {
            $result = $query -> num_rows();
        } else {
            $result = $query -> result();
        }
 
        return $result;
    }

    function get_view($table, $id){
    	// 조회수 증가
		$sql0 = "UPDATE " . $table . " SET hits = hits + 1 WHERE board_id='" . $id . "'";
        $this -> db -> query($sql0);
 
        $sql = "SELECT * FROM " . $table . " WHERE board_id = '" . $id . "'";
        $query = $this -> db -> query($sql);

        //게시물 내용 반환
        return $this->db->get_where('board', array('board_id' => $id))->row();
    }

    # 게시물 입력
    /*
     * @param array $arrays 테이블 명, 게시물 제목, 게시물 내용 1차 배열
     * @return boolean 입력 성공여부
    */
    function insert_board($arrays){
        $insert_array = array(
            'board_pid' => 0,
            'user_id' => 'advisor',
            'user_name' => 'noname',
            'subject' => $arrays['subject'],
            'contents' => $arrays['contents'],
            'reg_date' => date("Y-m-d H:i:s")
        );

        $result = $this->db->insert($arrays['table'], $insert_array);
        return $result;
    }



    /**
     * 게시물 수정
     * 
     * @param array $arrays 테이블 명, 게시물 번호, 게시물 제목, 게시물 내용
     * @return boolean 성공 여부
     */
    function modify_board($arrays){
        $modify_array = array(
            'subject' => $arrays['subject'],
            'contents' => $arrays['contents']
        );

        $where = array(
            'board_id' => $arrays['board_id']
        );

        $result = $this->db->update($arrays['table'], $modify_array, $where);
        return $result;
    }

     /*
     * 게시물 삭제
     * 
     * @param string $table 테이블 명
     * @param string $no 게시물 번호
     * @return boolean 성공 여부
     * 
     */
    function delete_board($id){
        $delete_id = array(
            'board_id' => $id
        );
        $result = $this->db->delete('board',$delete_id);
        return $result;
    }

}
?>