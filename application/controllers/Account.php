<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
	사용자 인증 컨트롤러
*/
class Account extends CI_Controller{
    function __construct()
    {       
        parent::__construct();
        //중복되는 부분은 생성자에서 작업해주는것이 좋다.
        $this->load->database(); //database 라이브러리 로드
        
        $this->load->model('account_model');
        $this->load->model('auth_model');

        $this->load->helper('form'); #helper 로드
        $this->load->helper(array('url','date')); #helper 로드
        $this->load->library('form_validation'); # validation library 로드
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
        $this->create_account();
    }


    public function create_account(){
        if($_POST){
            // validation 조건 설정 (태그name, 이름(임의로지정), 조건)
            $this->form_validation->set_rules('id','ID','required');
            
            //password는 필수로 입력받아야하고 password_chk와 같아야하며, 최소길이가 8자 이상이여야 한다.
            $this->form_validation->set_rules('password','Password','required|matches[password_chk]|min_length[8]');
            $this->form_validation->set_rules('password_chk','Password Check','required');
            
            $this->form_validation->set_rules('name','Name','required');
            $this->form_validation->set_rules('email','Email','required|valid_email');

            if($this->form_validation->run() == FALSE){
                $this->load->view('account/signup_page');
            }else{
                # 입력받은 id값을 가져와서 중복확인
                $id = $this->input->post('id',TRUE);

                $login_info = $this->auth_model->account_check($id);
                if($login_info != null){ //select 결과물이 있을때 => 이미 DB에 해당 id의 데이터가 있다는 뜻
                    echo '<p style="text-align:center; color:red;">이미 사용중인 아이디 입니다.</p>';
                    $this->load->view('account/signup_page');
                }else{
                    //모든 validation을 통과하면 모델을 통해서 DB에 insert
                    $result = $this->account_model->create_account($this->input->post('id',TRUE), $this->input->post('password',TRUE), $this->input->post('name',TRUE), $this->input->post('email',TRUE));
                    if($result == true){
                        echo '<p style="text-align:center; font-weight:bold;">회원가입이 완료되었습니다.<br> 가입하신 계정으로 로그인해주세요!</p>';
                        $this->load->view('account/login_form_page');
                    }else{
                        echo 'validation은 충족시켰지만 DB insert 과정에서 문제가 발생했습니다.<br>';
                        $this->load->view('account/signup_page');
                    }               
                }
            }
        }else{
            $this->load->view('account/signup_page');
        }
    }

}