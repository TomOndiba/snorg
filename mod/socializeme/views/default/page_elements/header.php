<?php

	/**
	 * Elgg pageshell 
	 * The standard HTML header that displays across the site
	 * 
	 * @package Elgg
	 * @subpackage Core
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2009
	 * @link http://elgg.org/
	 * 
	 * @uses $vars['config'] The site configuration settings, imported
	 * @uses $vars['title'] The page title
	 * @uses $vars['body'] The main content of the page
	 * @uses $vars['messages'] A 2d array of various message registers, passed from system_messages()
	 */
	 
	 // Set title
		if (empty($vars['title'])) {
			$title = $vars['config']->sitename;
		} else if (empty($vars['config']->sitename)) {
			$title = $vars['title'];
		} else {
			$title = $vars['config']->sitename . ": " . $vars['title'];
		}
		
		global $autofeed;
		if (isset($autofeed) && $autofeed == true) {
			$url = $url2 = full_url();
			if (substr_count($url,'?')) {
				$url .= "&view=rss";
			} else {
				$url .= "?view=rss";
			}
			if (substr_count($url2,'?')) {
				$url2 .= "&view=odd";
			} else {
				$url2 .= "?view=opendd";
			}
			$feedref = <<<END
			
	<link rel="alternate" type="application/rss+xml" title="RSS" href="{$url}" />
	<link rel="alternate" type="application/odd+xml" title="OpenDD" href="{$url2}" />
			
END;
		} else {
			$feedref = "";
		}
		
		$version = get_version();
		$release = get_version(true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="SnorgRelease" content="<?php echo $release; ?>" />
	<meta name="SnorgVersion" content="<?php echo $version; ?>" />
	<title><?php echo $title; ?></title>

	

	
	
	<script type="text/javascript" src="<?php echo $vars['url']; ?>javascript/browserDetect.js">
	</script>
	<script type="text/javascript" src="<?php echo $vars['url']; ?>vendors/jquery/jquery-1.2.6.pack.js"></script>
	<script type="text/javascript" src="<?php echo $vars['url']; ?>vendors/jquery/jquery-ui-personalized-1.5.3.packed.js"></script>
	<script type="text/javascript" src="<?php echo $vars['url']; ?>vendors/jquery/jquery.timer.js">
	</script>
	
	<script type="text/javascript" src="<?php echo $vars['url']; ?>_css/js.php/<?php echo $vars['config']->lastcache; ?>?js=initialise_elgg&viewtype=<?php echo $vars['view']; ?>"></script>
<?php
	global $pickerinuse;
	if (isset($pickerinuse) && $pickerinuse == true) {
?>
	<!-- only needed on pages where we have friends collections and/or the friends picker -->
	<script type="text/javascript" src="<?php echo $vars['url']; ?>vendors/jquery/jquery.easing.1.3.packed.js"></script>
	<script type="text/javascript" src="<?php echo $vars['url']; ?>_css/js.php/<?php echo $vars['config']->lastcache; ?>?js=friendsPickerv1&viewtype=<?php echo $vars['view']; ?>"></script>
<?php
	}
?>
	<!-- include the default css file -->
	<link rel="stylesheet" href="<?php echo $vars['url']; ?>_css/css.php?lastcache=<?php echo $vars['config']->lastcache; ?>&viewtype=<?php echo $vars['view']; ?>" type="text/css" />
	<?php 
		echo $feedref;
		echo elgg_view('metatags',$vars); 
	?>
<!--[if lt IE 7]>
<script language="JavaScript">
function correctPNG() // correctly handle PNG transparency in Win IE 5.5 & 6.
{
   var arVersion = navigator.appVersion.split("MSIE")
   var version = parseFloat(arVersion[1])
   if ((version >= 5.5) && (document.body.filters)) 
   {
      for(var i=0; i<document.images.length; i++)
      {
         var img = document.images[i]
         var imgName = img.src.toUpperCase()
         if (imgName.substring(imgName.length-3, imgName.length) == "PNG")
         {
            var imgID = (img.id) ? "id='" + img.id + "' " : ""
            var imgClass = (img.className) ? "class='" + img.className + "' " : ""
            var imgTitle = (img.title) ? "title='" + img.title + "' " : "title='" + img.alt + "' "
            var imgStyle = "display:inline-block;" + img.style.cssText 
            if (img.align == "left") imgStyle = "float:left;" + imgStyle
            if (img.align == "right") imgStyle = "float:right;" + imgStyle
            if (img.parentElement.href) imgStyle = "cursor:hand;" + imgStyle
            var strNewHTML = "<span " + imgID + imgClass + imgTitle
            + " style=\"" + "width:" + img.width + "px; height:" + img.height + "px;" + imgStyle + ";"
            + "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"
            + "(src=\'" + img.src + "\', sizingMethod='scale');\"></span>" 
            img.outerHTML = strNewHTML
            i = i-1
         }
      }
   }    
}
window.attachEvent("onload", correctPNG);
</script>
<![endif]-->

	<link rel="stylesheet" href="<?php echo $vars['url']; ?>vendors/snorg/style.css" type="text/css" />

<script type="text/javascript" src="<?php echo $vars['url']; ?>vendors/snorg/kk.js"></script>
</head>
<body>
<div id="kdialog" class="kDlg"></div>