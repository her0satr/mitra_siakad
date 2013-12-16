<style type="text/css">
#cssmenu {
	float:left;
	width:200px;
	height:auto;
	padding: 0px 0 0 2px;
	text-align:left;
}
#cssmenu > ul {
  list-style: none;
  margin: 0;
  padding: 0;
  vertical-align: baseline;
  line-height: 1;
}
/* The container */
#cssmenu > ul {
  display: block;
  position: relative;
  width: 200px;
}
/* The list elements which contain the links */
#cssmenu > ul li {
  display: block;
  position: relative;
  margin: 0;
  padding: 0;
  width: 100%;
}
/* General link styling */
#cssmenu > ul li a {
  /* Layout */

  display: block;
  position: relative;
  margin: 0;
  border-top: 1px solid hsl(0, 0%, 87%);

  padding: 11px 20px;
  /* Typography */

  font-family: Helvetica, Arial, sans-serif;
  color: #000;
  text-decoration: none;
  text-transform: uppercase;
  text-shadow: 0 1px 0 #fff;
  font-size: 13px;
  font-weight: 300;
  /* Background & effects */

  background: #eaeaea;
}
/* Rounded corners for the first link of the menu/submenus */
#cssmenu > ul li:first-child > a {
  border-top-left-radius: 4px;
  border-top-right-radius: 4px;
  border-top: 0;
}
/* Rounded corners for the last link of the menu/submenus */
#cssmenu > ul li:last-child > a {
  border-bottom-left-radius: 4px;
  border-bottom-right-radius: 4px;
  border-bottom: 0;
}
/* The hover state of the menu/submenu links */
#cssmenu > ul li a:hover,
#cssmenu > ul li:hover > a {
  color: #ffffff;
  text-shadow: 0 1px 0 rgba(0, 0, 0, 0.25);
  background: #026dbf;
  background: -webkit-linear-gradient(#026dbf, #01508d);
  background: -moz-linear-gradient(#026dbf, #01508d);
  background: linear-gradient(#026dbf, #01508d);
}
/* The arrow indicating a submenu */
#cssmenu > ul .has-sub > a::after {
  content: '';
  position: absolute;
  top: 16px;
  right: 10px;
  width: 0px;
  height: 0px;
  /* Creating the arrow using borders */

  border: 4px solid transparent;
  border-left: 4px solid #000;
}
/* The same arrow, but with a darker color, to create the shadow effect */
#cssmenu > ul .has-sub > a::before {
  content: '';
  position: absolute;
  top: 17px;
  right: 10px;
  width: 0px;
  height: 0px;
  /* Creating the arrow using borders */

  border: 4px solid transparent;
  border-left: 4px solid #fff;
}
/* Changing the color of the arrow on hover */
#cssmenu > ul li > a:hover::after,
#cssmenu > ul li:hover > a::after {
  border-left: 4px solid #fff;
}
#cssmenu > ul li > a:hover::before,
#cssmenu > ul li:hover > a::before {
  border-left: 4px solid rgba(0, 0, 0, 0.25);
}
/* THE SUBMENUS */
#cssmenu > ul ul {
  position: absolute;
  left: 100%;
  top: -9999px;
  padding-left: 5px;
  opacity: 0;
  width: 250px;
  /* The fade effect, created using an opacity transition */

  -webkit-transition: opacity 0.3s ease-in;
  -moz-transition: opacity 0.3s ease-in;
  transition: opacity 0.3s ease-in;
}
#cssmenu > ul ul li a {
  font-size: 12px;
}
/* Showing the submenu when the user is hovering the parent link */
#cssmenu > ul li:hover > ul {
  top: 0px;
  opacity: 1;
  z-index: 1;
}
</style>
<div id='cssmenu'>
<ul>
<li class='active'><a href='#' style="background-color:#026dbf;color:#fff;text-align:center"><span >MENU</span></a></li>
<?php

$sid = session_id();
$agent = $_SERVER['HTTP_USER_AGENT'];

include_once "dwo.mnu.php";

$modul = array();
$modul = GetUserModule();

StartMenu($modul);
/*
foreach ($modul as $submenu) {
    GetModule($submenu);
}

RunMenu();
*/
?>
</ul></div>