<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
// if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('user');
    }
    
    public function index(){
        $data = array();
        if($this->is_logged_in()){
            redirect('map/view');
        }else{
            redirect('/login');
        }
    }


    public function make_admin($user_id){
        $this->user->make_user_admin($user_id);
        echo TRUE;
    }


    public function delete_user($user_id){
        $this->user->disable_user($user_id);
        echo TRUE;
    }

    public function login_history(){
        $data['current_user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
        $data['page_title'] = "Login History";
        $data['history'] = $this->user->get_login_history();
        // var_dump($data['users']);
        $this->load->view('header', $data);
        $this->load->view('users/login_history', $data);
    }

    public function user_list(){
        $data['current_user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
        $data['page_title'] = "Users List";
        $data['users'] = $this->user->getRows(['conditions' => ["active" =>1]]);
        // var_dump($data['users']);
        $this->load->view('header', $data);
        $this->load->view('users/users_list', $data);

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
        if( $this->uri->uri_string() == 'users/login')
            show_404();

        if( strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post' )
            $this->require_min_level(1);

        $this->setup_login_form();

        $data = array();
        // if($this->session->userdata('success_msg')){
        //     $data['success_msg'] = $this->session->userdata('success_msg');
        //     $this->session->unset_userdata('success_msg');
        // }
        // if($this->session->userdata('error_msg')){
        //     $data['error_msg'] = $this->session->userdata('error_msg');
        //     $this->session->unset_userdata('error_msg');
        // }
        // if($this->input->post('loginSubmit')){
        //     $this->form_validation->set_rules('username', 'Username', 'required');
        //     $this->form_validation->set_rules('password', 'Password', 'required');
        //     if ($this->form_validation->run()) {
        //         $con['returnType'] = 'single';
        //         $con['conditions'] = array(
        //             'username'=>$this->input->post('username'),
        //             'passwd' => md5($this->input->post('password')),
        //             'active' => 1
        //         );
        //         $checkLogin = $this->user->getRows($con);
        //         // var_dump($checkLogin); die;
        //         if($checkLogin){
        //             $this->session->set_userdata('isUserLoggedIn',TRUE);
        //             $this->session->set_userdata('userId',$checkLogin->id);
        //             $this->session->set_userdata('userType',$checkLogin->user_type);
        //             $this->user->set_last_login($checkLogin->id);
        //             $this->user->add_login_attempt($checkLogin->id, $this->input->ip_address());
        //             redirect('map/view');
        //         }else{
        //             $data['error_msg'] = 'Wrong username or password, please try again.';
        //         }

        //     }
        // }
        //load the view

        $html = $this->load->view('header', $data, TRUE);
        $html .= $this->load->view('users/login', $data, TRUE);
        echo $html;
    }
    
    public function registration(){
        if(!$this->require_role('admin')){
            redirect('map/view');
        }
        $data = array();
        // $data['current_user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
        if($this->session->flashdata('success_msg')){
            $data['success_msg'] = $this->session->flashdata('success_msg');
            // $this->session->unset_userdata('success_msg');
        }
        if($this->session->flashdata('error_msg')){
            $data['error_msg'] = $this->session->flashdata('error_msg');
            // $this->session->unset_userdata('error_msg');
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
                'added_by' => $this->session->userdata('userId'),
                'contact_no' => strip_tags($this->input->post('contact_no'))
            );

            if($this->form_validation->run()){
                $insert = $this->user->insert($userData);
                if($insert){
                    $this->session->set_flashdata('success_msg', 'Your registration was successfully. Please login to your account.');
                    redirect('users/user_list');
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
    
    public function logout()
    {
        $this->authentication->logout();

        // Set redirect protocol
        $redirect_protocol = USE_SSL ? 'https' : NULL;

        redirect( site_url( LOGIN_PAGE . '?' . AUTH_LOGOUT_PARAM . '=1', $redirect_protocol ) );
    }
    
    /*
     * Existing username check during validation
     */
    public function username_check($str){
        $con['returnType'] = 'count';
        $con['conditions'] = array('username'=>$str);
        $checkEmail = $this->user->getRows($con);
        if($checkEmail > 0){
            $this->form_validation->set_message('username_check', 'The given username already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

        public function create_user()
    {
        // Customize this array for your user
        // $user_data = [
        //     'username'   => 'admin2',
        //     'passwd'     => 'Admin123',
        //     'email'      => 'aaaa@example.com',
        //     'auth_level' => '1', // 9 if you want to login @ examples/index.
        // ];

        // $this->is_logged_in();


        // Load resources
        $this->load->helper('auth');
        // $this->load->model('examples/examples_model');
        $this->load->model('examples/validation_callables');
        $this->load->library('form_validation');

        // $this->form_validation->set_data( $user_data );

        $validation_rules = [
            [
                'field' => 'username',
                'label' => 'username',
                'rules' => 'trim|required|max_length[12]|is_unique[' . db_table('user_table') . '.username]',
                'errors' => [
                    'is_unique' => 'Username already in use.'
                ]
            ],
            [
                'field' => 'passwd',
                'label' => 'passwd',
                'rules' => 'trim|required|external_callbacks[model,formval_callbacks,_check_password_strength,FALSE]',
                // 'rules' => [
                //     'trim',
                //     'required',
                //     [ 
                //         '_check_password_strength', 
                //         [ $this->validation_callables, '_check_password_strength' ] 
                //     ]
                // ],
                'errors' => [
                    'required' => 'The password field is required.'
                ]
            ],
            [
                'field'  => 'email',
                'label'  => 'email',
                'rules'  => 'trim|required|valid_email|is_unique[' . db_table('user_table') . '.email]',
                'errors' => [
                    'is_unique' => 'Email address already in use.'
                ]
            ],
            [
                'field' => 'auth_level',
                'label' => 'auth_level',
                'rules' => 'required|integer|in_list[1,6,9]'
            ]
        ];

        $this->form_validation->set_rules( $validation_rules );

        if( $this->form_validation->run() )
        {
            $user_data['passwd']     = $this->authentication->hash_passwd($user_data['passwd']);
            $user_data['user_id']    = $this->user_model->get_unused_id();
            $user_data['created_at'] = date('Y-m-d H:i:s');

            // If username is not used, it must be entered into the record as NULL
            if( empty( $user_data['username'] ) )
            {
                $user_data['username'] = NULL;
            }

            $this->db->set($user_data)
                ->insert(db_table('user_table'));

            if( $this->db->affected_rows() == 1 )
                echo '<h1>Congratulations</h1>' . '<p>User ' . $user_data['username'] . ' was created.</p>';
        }
        else
        {
            echo '<h1>User Creation Error(s)</h1>' . validation_errors();
        }

        echo $this->load->view('examples/page_footer', '', TRUE);
    }
}