<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 AJAX 댓글 처리 컨트롤러
*/
class Board_comment extends CI_Controller{
    function __construct()
    {       
        parent::__construct();
        //중복되는 부분은 생성자에서 작업해주는것이 좋다.
        $this->load->database(); //database 라이브러리 로드
        $this->load->model('board_model'); 
        $this->load->helper(array('url','date')); #helper 로드

        $this->load->library('form_validation'); //validation 라이브러리 로드
    }

    public function index(){
    
    }

    public function ajax_comment_get(){
        $id = $this->input->post('board_id');
        $board_id = $this->uri->segment(3);
        if($board_id){
            $data['board_id'] = $board_id;
            $data['comment_list'] = $this->board_model->get_comment('board_comment', $board_id);
            $this->load->view('board/board_comment_page',$data);
        }elseif($id){
            $data['board_id'] = $id;
            $data['comment_list'] = $this->board_model->get_comment('board_comment', $id);
            $this->load->view('board/board_comment_page',$data); 
        }else{
            $this->load->view('board/board_comment_page');
        }
    }

    public function ajax_comment_add(){
        if(@$this->session->userdata('logged_in') == TRUE){
            // 로그인 되어있을 시 
            $table = 'board_comment';
            $board_id = $this->input->post('board_id',TRUE);
            $comment_contents = $this->input->post('comment_contents',TRUE);
            

            $array_for_id = array(
                'table' => $table,
                'board_id' => $board_id
            );

            $comment_id = 0;

            $latest_comment_id = $this->board_model->get_latest_comment_id($array_for_id); 

            if($latest_comment_id){
                $comment_id = (int)$latest_comment_id['comment_id'] + 1;
            }else{
                $comment_id = 1;
            }
            
            if($comment_contents != ''){

                $write_data = array(
                    'table' => $table,
                    'board_id' => $board_id,
                    'comment_id' => $comment_id,
                    'comment_pk' => $board_id.'_'.$comment_id,
                    'user_id' => $this->session->userdata('user_id'),
                    'comment_contents' => $comment_contents
                );

                $result = $this->board_model->insert_comment($write_data);

                if ($result) {
                    $board_id = $this->uri->segment(3);
                    $this->load->view('/index.php/board/view/');
                } else {
                    // 글 실패시
                    echo "2000";
                }
            } else {
                // 글 내용이 없을 경우
                echo "1000";
            }
        } else {
            // 로그인 필요 에러
            echo "9000";
        }
        
    }


    function ajax_comment_modify(){
        echo "modify";
    }


    function ajax_comment_delete(){
        echo "delete";
    }
}