<?php
	/**
	 * Elgg Stick
	 * 
	 * @author KimKha
	 * @package SNORG
	 */
	
	global $CONFIG;
	admin_gatekeeper();
	action_gatekeeper();
	
	$userId = (int) get_input('userid');
	$user = get_entity($userId);
	
	$id = (int) get_input("id", 0);
	$title = get_input("title");
	$description = get_input("description");
	
	if (empty($title) || empty($description)) {
		register_error(elgg_echo("stick:user:notempty"));
		forward($_SERVER['HTTP_REFERER']);
	}
	
	if ($id == 0) { // Create new
		$object = new ElggObject();
	}
	else {
		$object = get_entity($id);
	}
	
	$object->subtype = _STICK_COMMEND_SUBTYPE_;
	$object->title = $title;
	$object->description = $description;
	$object->owner_guid = $userId;
	$object->container_guid = $userId;
	$object->access_id = ACCESS_PUBLIC;
	
	if (!$object->save()) {
		register_error(elgg_echo("stick:user:error"));
		forward($_SERVER['HTTP_REFERER']);
	}
	
	if ($id == 0) {
		remove_metadata($userId, 'stick:user:all');
		create_metadata($userId, 'stick:user:all', stick_cv_commends($userId), 'text', $object->guid, ACCESS_PUBLIC);
	}
	
	system_message(elgg_echo("stick:user:successful"));
	forward("pg/stick/commend?id=".$object->guid);
	
?>