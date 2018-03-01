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

    	$this->load->view('header');
    }

	public function index(){
		$this->load->view('home/home_page');
		$this->load->view('footer');
		//view를 가져올때에는 이런식으로 가져온다.
	}

	public function home(){
		$this->load->view('home/home_page');
		$this->load->view('footer');
		//view를 가져올때에는 이런식으로 가져온다.
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

	public function get_login(){
		$id = $this->input->post('id');
		$password = $this->input->post('password');
		
		$this->load->library('form_validation');
		// validation 조건 설정 (태그name, 이름(임의로지정), 조건)
		$this->form_validation->set_rules('id','ID','required');
		$this->form_validation->set_rules('password','Password','required');

		if($this->form_validation->run() == FALSE){//사용자가 입력한 정보를 유효성검사함
			//validation이 유효한 경우
			$this->load->view('home/login_form_page');
		}else{
			//validation이 유효한 경우
			//model을 통해 DB의 값 조회 및 체크 
			$login_info = $this->main_model->get_login($id);
			
			if($login_info != null){ //select 결과물이 있을때
				if($password == $login_info->user_password){
					//입력한 비밀번호가 DB에 저장된 id의 비밀번호와 같은경우
					//로그인 완료 페이지를 보여줌
					$this->load->view('home/main_page', array('login_info'=>$login_info));
				}else{
					//입력한 비밀번호가 DB에 저장된 id의 비밀번호와 다른경우
					//에러를 보여주고 다시 form 호출
					echo '<p style="text-align:center; color:red;">ID와 PASSWORD가 일치하지 않습니다.</p>';
					$this->load->view('home/login_form_page');
				}			
			}else{//select 결과물이 없을때
				echo '<p style="text-align:center; font-weight:bold;">해당 계정이 존재하지 않습니다.</p>';
				$this->load->view('home/login_form_page');
			}	
		}
		$this->load->view('footer');
	}

	public function get_account(){
		$this->load->library('form_validation');
		// validation 조건 설정 (태그name, 이름(임의로지정), 조건)
		$this->form_validation->set_rules('id','ID','required');
		$this->form_validation->set_rules('password','Password','required|matches[password_chk]|min_length[8]');
		//password는 필수로 입력받아야하고 password_chk와 같아야하며, 최소길이가 8자 이상이여야 한다.
		$this->form_validation->set_rules('password_chk','Password Check','required');
		if($this->form_validation->run() == FALSE){
			$this->load->view('home/signup_page');
		}else{
			//모든 validation을 통과하면 모델을 통해서 DB에 insert
			$result = $this->main_model->create_account($this->input->post('id'), $this->input->post('password'));
			if($result == true){
				echo '<p style="text-align:center; font-weight:bold;">회원가입이 완료되었습니다.<br> 가입하신 계정으로 로그인해주세요!</p>';
				$this->load->view('home/login_form_page');
				$this->load->view('footer');	
			}else{
				echo 'validation은 충족시켰지만 DB insert 과정에서 문제가 발생했습니다.<br>';
				$this->load->view('home/signup_page');
				$this->load->view('footer');
			}
			
		}



		$this->load->view('footer');
	}
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