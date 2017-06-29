<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
// if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user');
    }
    
    public function index(){
        $data = array();
        if($this->session->userdata('isUserLoggedIn')){
            redirect('map/view');
        }else{
            redirect('users/login');
        }
    }


    public function account(){
        
        redirect('map/view');

        $data = array();
        if($this->session->userdata('isUserLoggedIn')){
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            //load the view
            $this->load->view('users/account', $data);
        }else{
            redirect('users/login');
        }
    }
    

    public function login(){
        if($this->session->userdata('isUserLoggedIn')){
            redirect('map/view');
        }
        $data = array();
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }
        if($this->input->post('loginSubmit')){
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'password', 'required');
            if ($this->form_validation->run()) {
                $con['returnType'] = 'single';
                $con['conditions'] = array(
                    'username'=>$this->input->post('username'),
                    'password' => md5($this->input->post('password'))
                );
                $checkLogin = $this->user->getRows($con);
                // var_dump($checkLogin); die;
                if($checkLogin){
                    $this->session->set_userdata('isUserLoggedIn',TRUE);
                    $this->session->set_userdata('userId',$checkLogin->id);
                    $this->session->set_userdata('userType',$checkLogin->user_type);
                    redirect('map/view');
                }else{
                    $data['error_msg'] = 'Wrong email or password, please try again.';
                }
            }
        }
        //load the view
        $this->load->view('header', $data);
        $this->load->view('users/login', $data);
    }
    
    public function registration(){
        if($this->session->userdata('userType') != "A"){
            redirect('map/view');

        }
        $data = array();
        $data['current_user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }
        $userData = array();
        if($this->input->post('regisSubmit')){
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required|callback_username_check');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('conf_password', 'Confirm password', 'required|matches[password]');

            $userData = array(
                'name' => strip_tags($this->input->post('name')),
                'username' => strip_tags($this->input->post('username')),
                'password' => md5($this->input->post('password')),
                // 'gender' => $this->input->post('gender'),
                'contact_no' => strip_tags($this->input->post('contact_no'))
            );

            if($this->form_validation->run()){
                $insert = $this->user->insert($userData);
                if($insert){
                    $this->session->set_userdata('success_msg', 'Your registration was successfully. Please login to your account.');
                    // redirect('users/login');
                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            }
        }
        $data['user'] = $userData;
        //load the view
        $this->load->view('header', $data);
        $this->load->view('users/registration', $data);
    }
    
    /*
     * User logout
     */
    public function logout(){
        $this->session->unset_userdata('isUserLoggedIn');
        $this->session->unset_userdata('userId');
        $this->session->sess_destroy();
        redirect('users/login/');
    }
    
    /*
     * Existing username check during validation
     */
    public function username_check($str){
        $con['returnType'] = 'count';
        $con['conditions'] = array('username'=>$str);
        $checkEmail = $this->user->getRows($con);
        if($checkEmail > 0){
            $this->form_validation->set_message('email_check', 'The given username already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}