<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller{
    function __construct()
    {       
        parent::__construct();
        //중복되는 부분은 생성자에서 작업해주는것이 좋다.
        $this->load->database(); //database 라이브러리 로드
        $this->load->model('main_model'); 
        $this->load->helper(array('url','date')); #helper 로드
    }

    // header, footer 자동으로 가져오기 
    public function _remap($method){
        $this->load->view('header');
        if(method_exists($this, $method)){
            $this->{"{$method}"}();
        }
        $this->load->view('footer');
    }

	public function index(){
		$this->load->view('home/home_page');
		//view를 가져올때에는 이런식으로 가져온다.
	}

	public function home(){
		$this->load->view('home/home_page');
		//view를 가져올때에는 이런식으로 가져온다.
	}

	public function main(){
		$this->load->view('home/main_page');
	}

	/*
	form validation 조건
		required :
		min_length[] : 
		max_length[] : 
		matches[] : 
		is_unique[] : 
		valid_email : 
	*/

	/*
	public function get_topics(){
		$topics = $this->main_model->gets(); //main_model Object의 function을 실행시켜 결과값을 객체로 가져옴

		$this->load->view('home/list_page', array('topics'=>$topics));//이런식으로 view에 객체(혹은 array)형태로 model을 전달함
		$this->load->view('footer');
	}

	public function get_topic($topic_id){
		$topic = $this->main_model->get($topic_id); //main_model Object의 function을 실행시켜 결과값을 객체로 가져옴
		$topics = $this->main_model->gets();

		$this->load->view('home/list_page', array('topics'=>$topics));
		$this->load->view('home/topic_page', array('topic'=>$topic));
		$this->load->view('footer');
	}
	*/
}