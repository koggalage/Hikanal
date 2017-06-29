<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
// if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * User Management class created by CodexWorld
 */
class Map extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if(!$this->session->userdata('isUserLoggedIn')){
            redirect('users/login');
        }

        $this->load->library('form_validation');
        $this->load->model('user');
    }
    
    public function view(){
        $data = array();
        $data['current_user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            //load the view
        $this->load->view('header', $data);
        $this->load->view('map/mapp', $data);
    }
}