<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
// if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * User Management class created by CodexWorld
 */
class Map extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        // $this->load->model('user');
    }
    
    public function index(){
        // echo "string"; die();
        if($this->session->userdata('isUserLoggedIn')){
            //load the view
            $this->load->view('users/account', $data);
        }else{
            redirect('users/login');
        }
    }
}