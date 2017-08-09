<?php

function get_user_name($user_id = NULL){
	$CI =& get_instance();
	$CI->load->model('user');
	if (is_null($user_id))
		$user = $CI->user->getRows(array('id'=>$CI->session->userdata('userId')));
	else 
		$user = $CI->user->getRows(array('id'=> $user_id));
	// var_dump($user_id); die;
    if ($user) {
	    return $user->name;
    } else
    	return "Not Available";
}