<?php
	/**
	 * Elgg file browser download action.
	 * 
	 * @package ElggFile
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008-2009
	 * @link http://elgg.com/
	 */

	// Get the guid
	$file_guid = get_input("file_guid");
	
	// Get the file
	$file = get_entity($file_guid);
	
	
	//echo "<pre>"; print_r($file); die;
	if ($file)
	{
	//	$mime = $file->getMimeType();
	//	if (!$mime) $mime = "application/octet-stream";
		
		$filename = $file->originalfilename;
		//echo "<pre>"; print_r($filename); die;
		
	
			header("Content-Disposition: inline; filename=\"$filename\"");
		
		$contents = $file->grabFile();
		$splitString = str_split($contents, 8192);
		foreach($splitString as $chunk)
			echo $chunk;
		exit;
	}
	else
		register_error(elgg_echo("file:downloadfailed"));
?>