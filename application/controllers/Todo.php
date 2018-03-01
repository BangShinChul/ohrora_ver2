<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo extends CI_Controller{
    function __construct()
    {       
        parent::__construct();
        //중복되는 부분은 생성자에서 작업해주는것이 좋다.
        $this->load->database(); //database 라이브러리 로드
        
        $this->load->model('todo_model');
        $this->load->helper(array('url','date')); #helper 로드

    	$this->load->view('header');
    }

    public function index(){
        $data['list'] = $this->todo_model->get_list();

        $this->load->view('todo/todo_page', $data);
        $this->load->view('footer');
    }

    # todo 목록
    public function todo(){
        $data['list'] = $this->todo_model->get_list();

        $this->load->view('todo/todo_page', $data);
        $this->load->view('footer');
    }
    # todo 글 조회
    public function todo_view(){
        $id = $this->uri->segment(3);
        $data['views'] = $this->todo_model->get_view($id);
        $this->load->view('todo/todo_view_page',$data);
    }

    # todo 글 작성 : 
    # controller -> view -> controller -> model -> view 순으로 동작 
    public function todo_write(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('content','content','required');
        $this->form_validation->set_rules('created_on','created_on','required');
        $this->form_validation->set_rules('due_date','due_date','required');

        if($_POST){
            //글쓰기 POST 전송 시     
            if($this->form_validation->run() == FALSE){
                $this->load->view('todo/todo_write_page');
            }else{
            //모든 validation을 통과하면 모델을 통해서 DB에 insert
                $content = $this->input->post('content', TRUE);
                $created_on = $this->input->post('created_on', TRUE);
                $due_date = $this->input->post('due_date', TRUE);

                $this->todo_model->insert_todo($content, $created_on, $due_date);

                # 글작성 완료 후 다시 todo 리스트로 이동
                $this->todo();
                echo '<script>alert("TODO 작성이 완료되었습니다.");</script>';
            }
        }else{
            //쓰기 폼 view 호출
            $this->load->view('todo/todo_write_page');
        }
    }

    # todo 글 삭제
    public function todo_delete($id){
        $id = $this->uri->segment(3);
        $data = $this->todo_model->delete_todo($id);
        
        # 글삭제 완료 후 다시 todo 리스트로 이동
        $this->todo();
        echo '<script>alert("'.$id.'번 TODO 삭제가 완료되었습니다.");</script>';
    }


}