<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
// if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * User Management class created by CodexWorld
 */
class Map extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        // if(!$this->require_min_level(1)){
        //     redirect('users/login');
        // }

        $this->load->library('form_validation');
        $this->load->model('user');
    }
    
    public function view(){
        $data = array();
        $data['page_title'] = "Customize Map";
        $this->load->view('header', $data);
        $this->load->view('map/mapp', $data);
    }
}