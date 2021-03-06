<?php

	/**
	 * Improve thewire plugin
	 * 
	 * @author KimKha
	 * @package SNORG
	 */

// Make sure we're logged in (send us to the front page if not)
	if (!isloggedin()) exit();

// Get input data
	$body = get_input('note');
	$tags = get_input('thewiretags');
//	$access_id = get_default_access();
	$location = get_input('location');
	$method = get_input('method');
	$owner = get_user(get_input('owner'));
	$parent = (int)get_input('parent', 0);
	if(!$parent)   
	    $parent = 0;
// convert the shout body into tags
    $tagarray = filter_string($body);
	
// Make sure the title / description aren't blank
	if (!empty($body)) {
		if (thewire_save_post($body, ACCESS_PUBLIC, $parent, $method, $tagarray, $owner->guid)) {
			$latest_wire = get_entities("object", "thewire", null, "", 1, 0, false, 0, $owner->guid);
			
			
				
			if ($latest_wire) {
				$return = array();
				$latest_wire = $latest_wire[0];
				
				
				
				// View new status
				$return['status'] = $latest_wire->description;
				$return['status'] .= "<span> (" . friendly_time($latest_wire->time_created) . ")</span>";
				if($owner->guid != $_SESSION['user']->guid) $return['status'] = '';
				
				if($owner->guid != $_SESSION['user']->guid)
				{
					notify_user($owner->guid, $_SESSION['user']->getGUID(),' đã viết lên',' tường của bạn -'. $CONFIG->wwwroot."pg/profile/" . $owner->username); 
				}
				// Update list
				$return['list'] = elgg_view_entity($latest_wire);
				$return['wall'] = view_wallpost($latest_wire->getSubtype(), array('entity' => $latest_wire, 'viewtype' => 'wall'));
				
				header("Content-Type: application/json; charset=UTF-8");
				header("Cache-Control: no-store, no-cache, must-revalidate");
				header("Cache-Control: post-check=0, pre-check=0", false);
				header("Pragma: no-cache");
				
				echo json_encode($return);
			}
		}
	}
	exit();

?>