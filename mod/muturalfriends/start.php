<?php

	/**
	 * Mutural friends
	 * 
	 * @author KimKha
	 * @package Snorg
	 */


	function muturalfriends_pagesetup() {
		global $CONFIG;
		
		// Extend hover-over menu	
		extend_view('profile/menu/links','muturalfriends/menu', 500);
		//extend_view('widgets/muturalfriends/view', 'muturalfriends/dialog');
		
			    extend_view("profile/leftbar", "muturalfriends/leftbar", 450);
	}
	
	function muturalfriends_init() {
		// Register a page handler, so we can have nice URLs
		register_page_handler('muturalfriends','muturalfriends_page_handler');
		//add a widget
	//	add_widget_type('muturalfriends',elgg_echo("friends:mutural"),elgg_echo('friends:mutural:widget:description'));
	}
	
	function muturalfriends_page_handler($page) {
		// The first component of a blog URL is the username
		if (isset($page[0])) {
			set_input('username',$page[0]);
		}
		@include(dirname(__FILE__) . "/index.php");
		return true;
	}

	global $CONFIG;
//	register_action('muturalfriends/show', false, $CONFIG->pluginspath . 'muturalfriends/actions/show.php');
	register_elgg_event_handler('init','system','muturalfriends_init');
	register_elgg_event_handler('pagesetup','system','muturalfriends_pagesetup');

?>