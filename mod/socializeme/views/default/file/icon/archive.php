<?php

	if ($vars['size'] == 'large') {
		$ext = '_lrg';
	} else {
		$ext = '';
	}
	echo "<img src=\"{$CONFIG->wwwroot}mod/socializeme/graphics/file_icons/archive{$ext}.gif\" border=\"0\" />";

?>