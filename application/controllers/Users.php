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
        $this->load->helper('auth');
        // $this->user->make_user_admin($user_id);
        $this->db->where('user_id', $user_id);
        $this->db->set('auth_level', 6);
        $this->db->update(db_table('user_table'));
        echo TRUE;
    }


    public function delete_user($user_id){
        // $this->user->disable_user($user_id);
        $this->load->helper('auth');
        $this->db->where('user_id', $user_id);
        $this->db->set('banned', "1");
        $this->db->update(db_table('user_table'));
        echo TRUE;
    }

    public function login_history(){
        $this->is_logged_in();
        $data['page_title'] = "Login History";
        $data['history'] = $this->db->get('login_errors')->result();
        // $data['history'] = $this->user->get_login_history();
        // var_dump($data['users']);
        $this->load->view('header', $data);
        $this->load->view('users/login_history', $data);
    }

    public function user_list(){
        if(!$this->verify_min_level(3)){
            redirect('/login');
        }
        // $data['current_user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
        $data['page_title'] = "Users List";
        $this->is_logged_in();

        // $data['users'] = $this->db->get('users')->result();
        $data['users'] = $this->db->where('banned' , "0")->get('users')->result();
        // var_dump($data['users'] ); die;
        // $data['users'] = $this->user->getRows();
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

        if ($this->is_logged_in()) {
            redirect('map/view');
            # code...
        }

        if( strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post' )
            $this->require_min_level(1);

        $this->setup_login_form();

        $data = array();

        $html = $this->load->view('header', $data, TRUE);
        $html .= $this->load->view('users/login', $data, TRUE);
        echo $html;
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

        public function registration()
    {
        if (!$this->verify_min_level(3)) {
            redirect("/login");
        } else {


            $data = array();
            // Load resources
            $this->load->helper('auth');
            // $this->load->model('examples/examples_model');
            $this->load->model('examples/validation_callables');
            $this->load->library('form_validation');
            $this->is_logged_in();
            // var_dump($this->input->post()); die();

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
                    // 'rules' => 'trim|required|external_callbacks[model,formval_callbacks,_check_password_strength,FALSE]',
                    'rules' => [
                        'trim',
                        'required',
                        [ 
                            '_check_password_strength', 
                            [ $this->validation_callables, '_check_password_strength' ] 
                        ]
                    ],
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

                // $user_data = $this->input->post();
            $this->form_validation->set_rules( $validation_rules );
            // $this->form_validation->set_data( $user_data );

            if( $this->form_validation->run() )
            {       
                $user_data = [
                    'username'   => $this->input->post('username'),
                    'passwd'     => $this->input->post('passwd'),
                    'email'      => $this->input->post('email'),
                    'auth_level' => '1', // 9 if you want to login @ examples/index.
                ];
            // var_dump("expression"); die;
                $user_data['passwd']     = $this->authentication->hash_passwd($user_data['passwd']);
                $user_data['user_id']    = $this->user->get_unused_id();
                $user_data['created_at'] = date('Y-m-d H:i:s');

                // If username is not used, it must be entered into the record as NULL
                if( empty( $user_data['username'] ) )
                {
                    $user_data['username'] = NULL;
                }

                $this->db->set($user_data)
                    ->insert(db_table('user_table'));

                if( $this->db->affected_rows() == 1 )
                    // echo '<h1>Congratulations</h1>' . '<p>User ' . $user_data['username'] . ' was created.</p>';
                    $data['suc_msg'] = TRUE;
            }
            else
            {
                // echo '<h1>User Creation Error(s)</h1>' . validation_errors();
            }

            // echo $this->load->view('examples/page_footer', '', TRUE);       

            $this->load->view('header', $data);
            $this->load->view('users/registration', $data);
        }
    }
}