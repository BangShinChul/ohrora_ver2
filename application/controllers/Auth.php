<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
	사용자 인증 컨트롤러
*/
class Auth extends CI_Controller{
    function __construct()
    {       
        parent::__construct();
        //중복되는 부분은 생성자에서 작업해주는것이 좋다.
        $this->load->database(); //database 라이브러리 로드
        $this->load->model('auth_model'); 
        
        $this->load->helper('form'); #helper 로드
        $this->load->library('form_validation'); # validation library 로드
        $this->load->helper('alert');
    }

    public function _remap($method){
    	$this->load->view('header');

    	if(method_exists($this, $method)){
    		$this->{"{$method}"}();
    	}
    	$this->load->view('footer');
    }

	public function index(){
		$this->get_login();
	}


	public function get_login(){
		if($_POST){
			$id = $this->input->post('id',TRUE);
			$password = $this->input->post('password',TRUE);
			
			// validation 조건 설정 (태그name, 이름(임의로지정), 조건)
			$this->form_validation->set_rules('id','ID','required');
			$this->form_validation->set_rules('password','Password','required');

			$auth_data = array(
				'user_id' => $id,
				'password' => $password
			);

			$result = $this->auth_model->get_check($auth_data);

			if($result){
				$newdata = array(
					'user_id' => $result->user_id,
					'user_name' => $result->user_name,
					'user_email' => $result->user_email,
					'logged_in' => TRUE	
				);

				$this->session->set_userdata($newdata);

				alert('로그인 되었습니다.', '/index.php/main');
				exit;
			}else{
				echo '<p style="text-align:center; color:red;">ID와 PASSWORD가 일치하지 않습니다.</p>';
				$this->load->view('account/login_form_page');
				exit;
			}

			if($this->form_validation->run() == FALSE){//사용자가 입력한 정보를 유효성검사함
				//validation이 유효하지않은 경우
				$this->load->view('account/login_form_page');
			}else{
				//validation이 유효한 경우
				//model을 통해 DB의 값 조회 및 체크 
				$login_info = $this->auth_model->account_check($id);
				
				if($login_info != null){ //select 결과물이 있을때
					if($password == $login_info->user_password){
						//입력한 비밀번호가 DB에 저장된 id의 비밀번호와 같은경우
						//로그인 완료 페이지를 보여줌
						$this->load->view('home/main_page', array('login_info'=>$login_info));
					}else{
						//입력한 비밀번호가 DB에 저장된 id의 비밀번호와 다른경우
						//에러를 보여주고 다시 form 호출
						echo '<p style="text-align:center; color:red;">ID와 PASSWORD가 일치하지 않습니다.</p>';
						$this->load->view('account/login_form_page');
					}			
				}else{//select 결과물이 없을때
					echo '<p style="text-align:center; font-weight:bold;">해당 계정이 존재하지 않습니다.</p>';
					$this->load->view('account/login_form_page');
				}	
			}
		}else{
			$this->load->view('account/login_form_page');
		}
	}

	public function get_logout(){
		$this->session->sess_destroy();
		alert('로그아웃 되었습니다.','/index.php/main/');
		exit;
	}


}