<?php
/*=======================================================================
 Nuke-Evolution   :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :   #$#BASE
 Nuke-Evo Version       :   #$#VER
 Nuke-Evo Build         :   #$#BUILD
 Nuke-Evo Patch         :   #$#PATCH
 Nuke-Evo Filename      :   #$#FILENAME
 Nuke-Evo Date          :   #$#DATE

 Copyright (c) 2010 by The Nuke Evolution Development Team
 ========================================================================

 LICENSE INFORMATIONS COULD BE FOUND IN COPYRIGHTS.PHP WHICH MUST BE
 DISTRIBUTED WITHIN THIS MODULEPACKAGE OR WITHIN FILES WHICH ARE
 USED FROM WITHIN THIS PACKAGE.
 IT IS "NOT" ALLOWED TO DISTRIBUTE THIS MODULE WITHOUT THE ORIGINAL
 COPYRIGHT-FILE.
 ALL INFORMATIONS ABOVE THIS SECTION ARE "NOT" ALLOWED TO BE REMOVED.
 THEY HAVE TO STAY AS THEY ARE.
 IT IS ALLOWED AND SHOULD BE DONE TO ADD ADDITIONAL INFORMATIONS IN
 THE SECTIONS BELOW IF YOU CHANGE OR MODIFY THIS FILE.

/*****[CHANGES]**********************************************************
-=[Base]=-
-=[Mod]=-
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

$module_name = basename(dirname(dirname(__FILE__)));
get_lang($module_name);

if ( is_mod_admin($module_name) )
{ 
	$cid = ((isset($cid) && isset($pid))? intval($cid) : 0);
	$pid = (isset($pid) ? intval($pid) : 0);
  echo "<center><span class=\"title\"><strong>" . _CONTENT_ADMIN_HEADER . "</strong></span></center><br /><br />";
	if (isset($cid)) {
	    $row = $db->sql_fetchrow($db->sql_query("SELECT title FROM "._PAGES_CATEGORIES_TABLE." WHERE cid='".$cid."'"));
	    if ( empty($row['title']) ) { 
	    	$row['title'] = _NO_CATEGORY; 
	    	echo "<center><strong>"._CATEGORY.": </strong>".$row['title']."<br /></center><br /><br />";
	    } else {
	    	echo "<center><strong>"._CATEGORY.": </strong>".$row['title']."<br /> [ <a href='".$admin_file.".php?op=edit_category&amp;cid=".$cid."'>"._EDIT."</a> | <a href='".$admin_file.".php?op=del_content_cat&amp;cid=".$cid."&amp;ok=0'>"._DELETE."</a> ]</center><br /><br />";
	    }
	}
	if (isset($pid)) {
	    $row = $db->sql_fetchrow($db->sql_query("SELECT title, active FROM "._PAGES_TABLE." WHERE pid='".$pid."'"));
	    if ( empty($row['title']) ) { 
	    	$row['title'] = _NO_ARTICLE; 
	    	echo "<center><strong>"._ARTICLE.": </strong>".$row['title']."<br /></center><br /><br />";
	    } else {
	        echo "<center><strong>"._ARTICLE.": </strong>".$row["title"]."<br />[ <a href='".$admin_file.".php?op=content_edit&amp;pid=$pid'>"._EDIT."</a> | ";
    	    if ($row["active"] == 1) {
    	        echo "<a href='".$admin_file.".php?op=content_change_status&amp;pid=$pid&amp;active=1'>"._DEACTIVATE."</a> | ";
    	    } elseif ($row["active"] == 0) {
    	        echo "<a href='".$admin_file.".php?op=content_change_status&amp;pid=$pid&amp;active=0'>"._ACTIVATE."</a> | ";
    	    }
	        echo "<a href='".$admin_file.".php?op=content_delete&amp;pid=$pid&amp;ok=0'>"._DELETE."</a> ]";
	    }
	    echo "</center>";
	}
}
else
{ 
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . _NO_ADMIN_RIGHTS . $module_name);
}

?>