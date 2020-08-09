<?php
/*
 * Plugin Name:	Block User Agents
 * Plugin URI: https://github.com/slick2/wp-block-user-agents
 * Description:	Blocking of User agents 
 * Version:		1.0.0
 * Author:			Carey Dayrit
 * Author URI:		http://webtuners.pro
 * */

// A collection of snippets
//
//
// // limit user agents
//
add_action( 'init', 'wt_limit_user_agents' );

function wt_limit_user_agents(){
 	$bots = ['python-requests', 'PetalBot'];
 		foreach ($bots as $bot) {
 				if (stripos($_SERVER['HTTP_USER_AGENT'], $bot) !== FALSE) {
					header('HTTP/1.0 403 Forbidden');
 					exit;
				}
		}	
}

