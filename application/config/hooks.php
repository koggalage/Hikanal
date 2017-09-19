<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['pre_system'] = [];
$hook['pre_system']['function'] = 'auth_constants';
$hook['pre_system']['filename'] = 'auth_constants.php';
$hook['pre_system']['filepath'] = 'hooks';

$hook['post_system'] = array(
	'function' => 'auth_sess_check', 
	'filename' => 'auth_sess_check.php', 
	'filepath' => 'hooks'
	);