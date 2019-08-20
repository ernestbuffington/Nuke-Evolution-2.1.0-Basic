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

if(!defined("EVO_CREDITS")) {
  die("Access Denied");
}

function credits_get_content($faq_credits) {
    global $db, $textcolor1, $module_name, $lang_new;
    $style = 'style="display: none;"';
    $title = ucfirst($faq_credits['name']);
    echo "<table width=\"100%\" cellpadding=\"2\" cellspacing=\"1\" align=\"center\">";
    echo "<tr><th width='20%' align='left'>";
    echo "<div class=\"showstate\" onclick=\"expandcontent(this, '" . $faq_credits['div_name'] . "')\" style=\"cursor: pointer;\" />";
    echo "<span class=\"content\"><strong><a name=\"".$faq_credits['name']."\"><font color=\"$textcolor1\">" . $lang_new[$module_name]['CREDITS_'.strtoupper($faq_credits['name'])] . "</font></a></strong></span></th></tr>";
    echo "<tr><th class=\"row3\" width='10%' align='right'><span class=\"content\"><a href=\"#top\"><font color=\"$textcolor1\">".$lang_new[$module_name]['CREDITS_TOP']."</font></a></span></div></th></tr>";
    echo "</table>";


    if ($faq_credits['name'] == 'personal') {
    $result = $db->sql_query( "SELECT `id`, `person`, `website`, `description` FROM "._CREDITS_TABLE."_".$faq_credits['name']);
    echo "<div id=\"". $faq_credits['div_name'] ."\" class=\"switchcontent\" $style><br />";
    echo "<table width=\"100%\" cellpadding=\"2\" cellspacing=\"1\" class=\"forumline\">";
    while ( list($id, $person, $website, $description) = $db->sql_fetchrow($result) )
      {
       echo "<tr>"
            ."<td class=\"row2\" colspan='2' width='100%' align='left'><span class=\"content\"><strong>" . $person . "</strong></span></td>"
            ."</tr>"
            ."<tr>"
            ."<td class=\"row1\" width='20%' align='left'><span class=\"content\">".$lang_new[$module_name]['CREDITS_WEBSITE']."</span></td>"
            ."<td class=\"row1\" width='80%' align='left'><span class=\"content\"><a href=\"http://$website\">" . $website . "</a></span></td>"
            ."</tr>"
            ."<tr>"
            ."<td class=\"row1\" width='20%' align='left'><span class=\"content\">".$lang_new[$module_name]['CREDITS_DESCRIPTION']."</span></td>"
            ."<td class=\"row1\" width='80%' align='left'><span class=\"content\">" . $description . "</span></td>"
            ."</tr>";
      }
      echo "</table></div>";

      $db->sql_freeresult($result);
    } else {
    $result = $db->sql_query( "SELECT `id`, `author`, `website`, `creditname`, `version`, `gpl`, `description` FROM "._CREDITS_TABLE."_".$faq_credits['name']);
    echo "<div id=\"". $faq_credits['div_name'] ."\" class=\"switchcontent\" $style><br />";
    echo "<table width=\"100%\" cellpadding=\"2\" cellspacing=\"1\" class=\"forumline\">";
    
    while ( list($id, $author, $website, $creditname, $version, $gpl, $description) = $db->sql_fetchrow($result) )
      {
        $description = check_html($description, 'nohtml');
        $author = check_html($author, 'nohtml');
        $website = check_html($website, 'nohtml');
        $creditname = check_html($creditname, 'nothml');
        echo "<tr>"
             ."<td class=\"row2\" colspan='2' width='100%' align='left'><span class=\"content\"><strong>" . $creditname . "</strong></span></td>"
             ."</tr>"
             ."<tr>"
             ."<td class=\"row1\" width='20%' align='left'><span class=\"content\">" . $lang_new[$module_name]['CREDITS_VERSION'] . "</span></td>"
             ."<td class=\"row1\" width='80%' align='left'><span class=\"content\">" . $version . "</span></td>"
             ."</tr>"
             ."<tr>"
             ."<td class=\"row1\" width='20%' align='left'><span class=\"content\">" . $lang_new[$module_name]['CREDITS_AUTHOR'] . "</span></td>"
             ."<td class=\"row1\" width='80%' align='left'><span class=\"content\">" . $author . "</span></td>"
             ."</tr>"
             ."<tr>"
             ."<td class=\"row1\" width='20%' align='left'><span class=\"content\">".$lang_new[$module_name]['CREDITS_WEBSITE']."</span></td>"
             ."<td class=\"row1\" width='80%' align='left'><span class=\"content\"><a href=\"http://$website\">" . $website . "</a></span></td>"
             ."</tr>"
             ."<tr>"
             ."<td class=\"row1\" width='20%' align='left'><span class=\"content\">" . $lang_new[$module_name]['CREDITS_GPL'] . "</span></td>"
             ."<td class=\"row1\" width='80%' align='left'><span class=\"content\">" . $gpl . "</span></td>"
             ."</tr>"
             ."<tr>"
             ."<td class=\"row1\" width='20%' align='left'><span class=\"content\">".$lang_new[$module_name]['CREDITS_DESCRIPTION']."</span></td>"
             ."<td class=\"row1\" width='80%' align='left'><span class=\"content\">" . $description . "</span></td>"
             ."</tr>";
      }
      echo "</table></div>";
      $db->sql_freeresult($result);
    }
}

?>