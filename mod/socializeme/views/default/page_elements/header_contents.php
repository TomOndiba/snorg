<?php

	/**
	 * Elgg header contents 
	 * This file holds the header output that a user will see
	 * 
	 * @package Elgg
	 * @subpackage Core
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2009
	 * @link http://elgg.org/
	 **/
	 
?>

<div id="page_container">
<div id="page_wrapper">

<div id="layout_header">
<div id="wrapper_header">
	<!-- display the page title 
	<h1><a href="<?php echo $vars['url']; ?>"><?php echo $vars['config']->sitename; ?></a></h1>
	-->

<table width="959" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="200" valign="top"><a href="<?php echo $vars['url']; ?>">
			<img src="<?php echo $vars['url']; ?>mod/socializeme/graphics/logo.png" border="0" /></a></td>
    <td width="759" valign="top" align="right"> <div id="tabs6">
    
    	<ul id="navigation" class="topbardropdownmenu">
			<li id="current"><a href="<?php echo $vars['url']; ?>"><span><?php echo elgg_echo("home"); ?></span></a></li>
    <?php
    	echo elgg_view("expages/navigation");
    ?>
    		<li><a href="<?php echo $vars['url']; ?>pg/expages/read/About"><span><?php echo elgg_echo("contact"); ?></span></a></li>
    	</ul>

        </div>
         <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div style="float:right; vertical-align:middle; margin-top:5px; background:#f5f5f5; border:1px solid #ccc; width:728px; height:90px;" align="right">
      <div align="center"><br />Here you can place a 728x90 advertisement - Maximum Page Impressions</div>
    </div></td>
    </tr>
</table></td>
  </tr>
</table>


</div><!-- /#wrapper_header -->
</div><!-- /#layout_header -->
