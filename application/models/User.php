<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Model{
    function __construct() {
        $this->table = 'users';
    }
    /*
     * get rows from the users table
     */
    function get_login_history(){
        $this->db->from("login_history");
        return $this->db->get()->result();

    }

    function getRows($params = array()){

        $this->db->from($this->table);
        
        //fetch data by conditions
        if(array_key_exists("conditions",$params)){
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key,$value);
            }
        }
        
        if(array_key_exists("id",$params)){
            $this->db->where('id',$params['id']);
            $query = $this->db->get();
            $result = $query->row();
        }else{
            //set start and limit
            // if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            //     $this->db->limit($params['limit'],$params['start']);
            // }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            //     $this->db->limit($params['limit']);
            // }
            $query = $this->db->get();
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $query->num_rows();
            }elseif(array_key_exists("returnType",$params) && $params['returnType'] == 'single'){
                $result = $query->row();
            }else{
                $result = $query->result();
            }
        }
        // var_dump($params['conditions']); die;
        //return fetched data
        return $result;
    }
    

    public function add_login_attempt($user_id, $ip) {
        $data['user_id'] = $user_id;
        $data['ip_address'] = $ip;
        $data['time'] = date("Y-m-d H:i:s");
        $data['success'] = true;
        $this->db->insert('login_history', $data);
    }

    public function set_last_login($user_id) {
        $this->db->where("id", $user_id);
        $data['last_login'] = date("Y-m-d H:i:s");
        $this->db->update($this->table, $data);
    }

    public function disable_user($user_id){
        $this->db->where("id", $user_id);
        $data['active'] = 0;
        $this->db->update($this->table, $data);
    }

    public function make_user_admin($user_id){
        $this->db->where("id", $user_id);
        $data['user_type'] = "A";
        $this->db->update($this->table, $data);
    }

    /*
     * Insert user information
     */
    public function insert($data = array()) {
        //add created and modified data if not included
        if(!array_key_exists("created", $data)){
            // $data['created'] = date("Y-m-d H:i:s");
        }
        if(!array_key_exists("modified", $data)){
            // $data['modified'] = date("Y-m-d H:i:s");
        }
        $data['account_created'] = date("Y-m-d H:i:s");
        $data['user_type'] = "U";
        
        //insert user data to users table
        $insert = $this->db->insert($this->table, $data);
        
        //return the status
        if($insert){
            return $this->db->insert_id();;
        }else{
            return false;
        }
    }

        public function get_unused_id()
    {
        // Create a random user id between 1200 and 4294967295
        $random_unique_int = 2147483648 + mt_rand( -2147482448, 2147483647 );

        // Make sure the random user_id isn't already in use
        $query = $this->db->where( 'user_id', $random_unique_int )
            ->get_where( $this->db_table('user_table') );

        if( $query->num_rows() > 0 )
        {
            $query->free_result();

            // If the random user_id is already in use, try again
            return $this->get_unused_id();
        }

        return $random_unique_int;
    }

}