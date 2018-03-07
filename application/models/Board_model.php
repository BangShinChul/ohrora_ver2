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
            'user_name' => $arrays['user_id'],
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

    /*
    댓글 리스트 가져오기
    @param String $table 테이블
    @param String $id 게시물 번호
    @return array
    */
    function get_comment($table, $id){
        $sql = "select * from ".$table." where board_id = '". $id . "' order by reg_date desc";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function get_comment_count($id, $offset = '', $limit = ''){

        /*
        if ($limit != '' OR $offset != '') {
            // 페이징이 있을 경우 처리
            $limit_query = ' LIMIT ' . $offset . ', ' . $limit;
        }
        */

        //$sql = "select board_id, count(*) as count from ".$table." where board_id= '".$id."'";

        $limit_query = '';
 
        if ($limit != '' OR $offset != '') {
            // 페이징이 있을 경우 처리
            $limit_query = ' LIMIT ' . $offset . ', ' . $limit;
        }

        $sql = "select b.board_id, count(c.board_id) as count from board as b join board_comment as c on b.board_id=c.board_id where b.board_id='".$id."' ORDER BY board_id DESC " . $limit_query;
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;    
    }

    function insert_comment($arrays){

        // 1. comment를 insert한다. 
        // 2. board_comment테이블에서 board_id의 댓글을 count한 값을 가져온다. 
        // 3. 이 count 수대로 board테이블에서 board_id의 comments 값을 업데이트한다.
        
        //1. 
        $insert_array = array(
            'board_id' => $arrays['board_id'],
            'comment_id' => $arrays['comment_id'],
            'comment_pk' => $arrays['comment_pk'],
            'user_id' => $arrays['user_id'],
            'comment_contents' => $arrays['comment_contents'],
            'reg_date' => date('Y-m-d H:i:s')
        );
        
        $result = $this->db->insert($arrays['table'], $insert_array);    
        
        //2. 
        $sql = "select count(board_id) as count from board_comment where board_id='".$arrays['board_id']."'";
        $query = $this->db->query($sql);
        $select_result = $query->result();
        

        //3.

        $update_array = array(
            'comments' => $select_result['count']
        );
        $where = array(
            'board_id' => $arrays['board_id']
        );
        $update_result = $this->db->update('board',$update_array,$where);
        if($update_result){
            return $result;
        }else{
            echo '<script>alert("insert comment error");</script>';
        }
    }

    // function update_comment($add_or_del, $board_id){
    //     // $add_or_del 이 'add' 이면 +1, 'del' 이면 -1

    //     $this->db->select('comments');        
    //     $get_comments = $this->db->get_where('board', array('board_id' => $arrays['board_id']))->row();

    //     if($add_or_del == 'add'){
    //         $comments_count = (int)$get_comments + 1;
    //     }elseif($add_or_del == 'del'){
    //         if($get_comments != 0){
    //             $comments_count = (int)$get_comments - 1;    
    //         }else{
    //             $comments_count = 0;
    //         }
            
    //     }

    //     $modify_array = array(
    //         'comments' => $comments_count,
    //     );

    //     $where = array(
    //         'board_id' => $arrays['board_id']
    //     );

    //     $result = $this->db->update('board', $modify_array, $where);
    //     return $result;
    // } 



    function get_latest_comment_id($arrays){
        $sql = "select comment_id from ".$arrays['table']." where board_id ='".$arrays['board_id']."' order by reg_date desc limit 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

}
?>