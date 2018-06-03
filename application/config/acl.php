<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file
 *
 * Configuration for ACL permissions
 *
 */

/**
 * Each controller or action can have its own permission array
 *
 * I've created some simple sample permissions based on the Drupal scheme
 *
 * Each controller or action can have add, edit own, edit all,
 * delete own and delete all - then add roles against the permissions
 */
$config['permission'] = array(
	/*'crop' => array(
		'index' => array('blogger','editor','admin','deo','manager')
	),*/
	'Login' => array(
		'validate' => array('blogger','editor','admin','deo','manager'),
		'error' => array('blogger','editor','admin','deo','manager'),
		'index' => array('blogger','editor','admin','deo','manager'),
		'home' => array('blogger','editor','admin','deo','manager'),
		'logout' => array('blogger','editor','admin','deo','manager'),
	),
	'category' => array(
		'index' => array('editor','admin','manager'),
		'manage_categories' => array('editor','admin','manager'),
		'add' => array('editor', 'admin'),
		'delete' => array('editor', 'admin'),
		'change_status' => array('editor', 'admin'),
		'change_cat_order' => array('editor', 'admin')		
	),
	'sub_category' => array(
		'index' => array('editor','admin','manager'),
		'manage_sub_categories' => array('editor','admin','manager'),
		'add' => array('editor', 'admin'),
		'delete' => array('editor', 'admin'),
		'change_status' => array('editor', 'admin'),
	),
);



/**
 * You can have as many roles as you like, each user or object can have multiple roles.
 */
$config['roles'] = array('admin', 'editor', 'blogger', 'deo','manager');
/* End of applications/config/acl.php */
