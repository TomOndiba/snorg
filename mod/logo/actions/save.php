<?php
	/**
	 * Elgg file browser save action
	 * 
	 * @package ElggFile
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008-2009
	 * @link http://elgg.com/
	 */

	global $CONFIG;
	
	// Get variables
	$title = get_input("title");
	$description = get_input("description");
	//$tags = get_input("tags");
	//$access_id = (int) get_input("access_id");
	
	$guid = (int) get_input('file_guid');
	
	if (!$file = get_entity($guid)) {
		register_error(elgg_echo("file:uploadfailed"));
		forward($CONFIG->wwwroot . "pg/logo/" . $_SESSION['user']->username);
		exit;
	}
	
	$result = false;
	
	$container_guid = $file->container_guid;
	$container = get_entity($container_guid);
	
	if ($file->canEdit()) {
	
		$file->access_id = ACCESS_PUBLIC;
		$file->title = $title;
		$file->description = $description;
	
		// Save tags
			///$tags = explode(",", $tags);
			//$file->tags = $tags;

			$result = $file->save();
	}
	
	if ($result)
		system_message(elgg_echo("file:saved"));
	else
		register_error(elgg_echo("file:uploadfailed"));
	
	forward($CONFIG->wwwroot . "pg/logo/" . $container->username);
?>