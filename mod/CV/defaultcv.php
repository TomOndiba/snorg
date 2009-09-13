<?php
	
	require_once(dirname(dirname(dirname(__FILE__))) . '/engine/start.php');
	
	admin_gatekeeper();
	set_context('admin');
	
	set_page_owner($_SESSION['guid']);
	
	$title = elgg_view_title(elgg_echo('cv:edit:default'));
	
	$form = elgg_view('cv/editdefaultcv');
	
			
	set_context('search');
	
	
	// List form elements
	$n = 0;
	$loaded_defaults = array();
	$listing .= "<div class=\"contentWrapper\">";
	while ($translation = get_plugin_setting("admin_defined_cv_$n", 'cv'))
	{
		$type = get_plugin_setting("admin_defined_cv_type_$n", 'cv');
			
		$even_odd = ( 'odd' != $even_odd ) ? 'odd' : 'even';					
	
		$listing .= "<p class=\"{$even_odd}\"><b>$translation: </b>";
		$listing .= elgg_view("output/{$type}",array('value' => " [$type]"));
		$listing .= "</p>";
		
		$n++;
	}
	$listing .= "</div>";
	
	$listing .= "<div class=\"contentWrapper resetdefaultprofile\">" . elgg_view('input/form', 
		array(
			'body' => elgg_view('input/submit', array('value' => elgg_echo('cv:resetdefault'))), 
			'action' => $CONFIG->wwwroot . 'action/cv/editdefault/reset'
		)
	) . "</div>";
	
	set_context('admin');
	

	page_draw(elgg_echo('cv:edit:default'),elgg_view_layout("two_column_left_sidebar", '', $title . $form. $listing ));
	
?>