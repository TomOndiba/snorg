<?php
	
?>

.rating {
	cursor: pointer;
	
}
.rating:after {
	content: '.';
	height: 0;
	width: 0;
	clear: both;
	visibility: hidden;
}
.cancel,
.star {
	float: left;
	width: 17px;
	height: 15px;
	overflow: hidden;
	text-indent: -999em;
	cursor: pointer;
}
.star-left,
.star-right {
  width: 8px
}
.cancel,
.cancel a {background: url(<?php echo $vars['url'].'_graphics/'?>delete.gif) no-repeat 0 -16px;}

.star,
.star a {background: url(<?php echo $vars['url'].'_graphics/'?>star.gif) no-repeat 0 0px;}
.star-left,
.star-left a {background: url(<?php echo $vars['url'].'_graphics/'?>star-left.gif) no-repeat 0 0px;}
.star-right,
.star-right a {background: url(<?php echo $vars['url'].'_graphics/'?>star-right.gif) no-repeat 0 0px;}
	
.cancel a,
.star a {
	display: block;
	width: 100%;
	height: 100%;
	background-position: 0 0px;
}

div.rating div.on a {
	background-position: 0 -16px;
}
div.rating div.hover a,
div.rating div a:hover {
	background-position: 0 -32px;
}


