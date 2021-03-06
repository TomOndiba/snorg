<?php

	/**
	 * Add static page
	 * 
	 * @author KimKha
	 * @package Snorg
	 */

	/**
	 * Elgg Simple editing of external pages frontpage/about/term/contact and privacy
	 * 
	 * @package ElggExPages
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008-2009
	 * @link http://elgg.com/
	 */

	function expages_init() {
		
		global $CONFIG;
		
		// Register a page handler, so we can have nice URLs
		register_page_handler('expages','expages_page_handler');
		
		// Register a URL handler for external pages
		register_entity_url_handler('expages_url','object','expages');
		
		// extend views
		extend_view('footer/links', 'expages/footer_menu');
		extend_view('index/righthandside', 'expages/front_right');
		extend_view('index/lefthandside', 'expages/front_left');
		
		// Register entity type
		register_entity_type('object', 'expages');
	}
	
	/**
	 * Page setup. Adds admin controls to the admin panel.
	 *
	 */
	function expages_pagesetup()
	{
		if (get_context() == 'admin' && isadminloggedin()) {
			global $CONFIG;
			add_submenu_item(elgg_echo('expages'), $CONFIG->wwwroot . 'pg/expages/');
			
			if (is_included($CONFIG->path."mod/externalpages/index.php")) {
				add_submenu_item(elgg_echo('expages:create'), $CONFIG->wwwroot . 'pg/expages/?act=new', 'expages');
			}
		}
	}
	
	function expages_url($expage = "") {
			
			global $CONFIG;
			return $CONFIG->url . "pg/expages/".$expage;
			
	}
	
	
	function expages_page_handler($page) 
	{
		global $CONFIG;
		
		if ($page[0])
		{
			switch ($page[0])
			{
				case "read":
					set_input('expages',$page[1]);
					@include(dirname(__FILE__) . "/read.php");
					break;
				default : 
					@include(dirname(__FILE__) . "/index.php"); 
			}
		}
		else
			@include(dirname(__FILE__) . "/index.php"); 
	}
	
	function expages_parent_tree(&$array, $container_guid=0, $prefix="", $prefix_more="") {
		$expages = get_entities("object", "expages", 0, "", 0, 0, false, 0, $container_guid);
		if ($expages && is_array($expages)) {
			foreach ($expages as $item) {
				$array[$item->guid] = $prefix.$item->title;
				expages_parent_tree($array, $item->guid, $prefix.$prefix_more, $prefix_more);
			}
		}
	}
	
	// Initialise log browser
	register_elgg_event_handler('init','system','expages_init');
	register_elgg_event_handler('pagesetup','system','expages_pagesetup');
	
	// Register actions
		global $CONFIG;
		register_action("expages/add",false,$CONFIG->pluginspath . "externalpages/actions/add.php");
		register_action("expages/addfront",false,$CONFIG->pluginspath . "externalpages/actions/addfront.php");
		register_action("expages/edit",false,$CONFIG->pluginspath . "externalpages/actions/edit.php");
		register_action("expages/delete",false,$CONFIG->pluginspath . "externalpages/actions/delete.php");
		register_action("expages/page",false,$CONFIG->pluginspath . "externalpages/actions/page.php");
			
?>