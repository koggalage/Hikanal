<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model{
    function __construct() {
        $this->table = 'users';
    }
    /*
     * get rows from the users table
     */
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

        //return fetched data
        return $result;
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

}