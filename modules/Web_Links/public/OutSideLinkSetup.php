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

if (!defined('MODULE_FILE') || !defined('WEBLINK_INDEX_FILE') ) {
   die('You can\'t access this file directly...');
}

include_once(NUKE_BASE_DIR.'header.php');
LinksHeading();
OpenTable();
echo "<center><span class='option'><strong>".$lang_new[$module_name]['PROMOTE_YOUR_WEBSITE']."</strong></span></center>";
echo "<br /><br />".$lang_new[$module_name]['INFO_PROMOTE_1']."<br /><br />";
echo "<fieldset><legend><strong>".$lang_new[$module_name]['PROMOTE_RATING_TEXT_LINK']."</strong></legend><br /><br />";
echo $lang_new[$module_name]['INFO_PROMOTE_2']."<br /><br />";
echo "<center><a href='".EVO_SERVER_URL."/modules.php?name=".$module_name."&amp;op=ratelink&amp;lid=".$lid."'>".$lang_new[$module_name]['DO_RATE']."&nbsp;@&nbsp;".EVO_SERVER_SITENAME."</a></center><br /><br />";
echo "<center>".$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_1']."</center><br />";
echo "<center><em>&lt;a href='".EVO_SERVER_URL."/modules.php?name=".$module_name."&amp;op=ratelink&amp;ratinguser=outside&amp;ratinglid=".$lid."'&gt;".$lang_new[$module_name]['DO_RATE']."&lt;/a&gt;</em></center><br /><br />";
echo $lang_new[$module_name]['PROMOTE_RATING_THE_NUMBER']."&nbsp;".$lid."&nbsp;".$lang_new[$module_name]['PROMOTE_RATING_ID_REFERER']."<br /><br />";
echo "</fieldset><fieldset><legend><strong>".$lang_new[$module_name]['PROMOTE_RATING_BUTTON_LINK']."</strong></legend><br /><br />";
echo $lang_new[$module_name]['INFO_PROMOTE_3']."<br /><br />";
echo "<center>\n<form action='modules.php?name=".$module_name."' method='post'>\n";
echo "<input type='hidden' name='lid' value='".$lid."' />\n";
echo "<input type='hidden' name='op' value='ratelink' />\n";
echo "<input type='submit' value='".$lang_new[$module_name]['DO_RATE']."' />\n";
echo "</form>\n</center><br /><br />";
echo "<center>".$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_2']."</center><br /><br />";
echo "<table border='0' align='center'><tr><td align='left'>";
echo "<em>&lt;form action='".EVO_SERVER_URL."/modules.php?name=".$module_name." method='post'&gt;<br />\n";
echo "&nbsp;&nbsp;&lt;input type='hidden' name='ratinglid' value='".$lid."'&gt;<br />\n";
echo "&nbsp;&nbsp;&lt;input type='hidden' name='ratinguser' value='outside'&gt;<br />\n";
echo "&nbsp;&nbsp;&lt;input type='hidden' name='op' value='ratelink'&gt;<br />\n";
echo "&nbsp;&nbsp;&lt;input type='submit' value='".$lang_new[$module_name]['DO_RATE']."'&gt;<br />\n";
echo "&lt;/form&gt;\n</em>";
echo "</td></tr></table></fieldset>\n";
if ( $weblinksconfig['securitycheck'] ) {
    echo "<fieldset><legend><strong>".$lang_new[$module_name]['PROMOTE_RATING_FORM']."</strong></legend><br /><br />";
    echo $lang_new[$module_name]['INFO_PROMOTE_4']."<br /><br />";
    echo "<center><form method='post' action='".EVO_SERVER_URL."/modules.php?name=".$module_name."'>\n";
    echo "<table align='center' border='0' width='175' cellspacing='0' cellpadding='0'>\n";
    echo "<tr><td align='center'><strong>".$lang_new[$module_name]['DO_VOTE_THIS_SITE']."</strong><br /></td></tr>\n";
    echo "<tr><td>\n";
    echo "<table border='0' cellspacing='0' cellpadding='0' align='center'>\n";
    echo "<tr><td valign='top'><select name='rating'>\n";
    echo "<option selected='selected'>--</option>\n";
    for ($i=10; $i>=1; $i--) {
        echo "<option>".$i."</option>\n";
    }
    echo "</select>\n";
    echo "</td><td valign='top'><input type='hidden' name='ratinglid' value='".$lid."' />\n";
    echo "<input type='hidden' name='ratinguser' value='outside' />\n";
    echo "<input type='hidden' name='op' value='addrating' />\n";
    echo "<input type='submit' value='".$lang_new[$module_name]['SUBMIT_VOTE']."' />\n";
    echo "</td></tr></table>\n";
    echo "</td></tr></table></form>\n";
    echo "<br />".$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_3']."<br /><br /></center>\n";
    echo "<blockquote><em>&lt;form method='post' action='".EVO_SERVER_URL."/modules.php?name=".$module_name."'&gt;<br />";
    echo "&lt;table align='center' border='0' width='175' cellspacing='0' cellpadding='0'&gt;<br />";
    echo "&lt;tr&gt;&lt;td align='center'&gt;&lt;strong&gt;".$lang_new[$module_name]['DO_VOTE_THIS_SITE']."&lt;/strong&gt;&lt;/a&gt;&lt;/td&gt;&lt;/tr&gt;<br />";
    echo "&lt;tr&gt;&lt;td&gt;<br />";
    echo "&lt;table border='0' cellspacing='0' cellpadding='0' align='center'&gt;<br />";
    echo "&lt;tr&gt;&lt;td valign='top'&gt;<br />";
    echo "&lt;select name='rating'&gt;<br />";
    echo "&lt;option selected&gt;--&lt;/option&gt;<br />";
    for ($i=10; $i>=1; $i--) {
        echo "&lt;option&gt;".$i."&lt;/option&gt;<br />";
    }
    echo "&lt;/select&gt;<br />";
    echo "&lt;/td&gt;&lt;td valign='top'&gt;<br />";
    echo "&lt;input type='hidden' name='ratinglid' value='$lid'&gt;<br />";
    echo "&lt;input type='hidden' name='ratinguser' value='outside'&gt;<br />";
    echo "&lt;input type='hidden' name='op' value='addrating'&gt;<br />";
    echo "&lt;input type='submit' value='".$lang_new[$module_name]['SUBMIT_VOTE']."'&gt;<br />";
    echo "&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;<br />";
    echo "&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;<br />";
    echo "&lt;/form&gt;<br />";
    echo "</em></blockquote></fieldset>";
}
echo "<br /><br /><center>".$lang_new[$module_name]['INFO_PROMOTE_5']."<br /><br />-&nbsp;".EVO_SERVER_SITENAME."&nbsp;-<br />".$lang_new[$module_name]['WEBLINKS_SIGNATURE']."<br /><br /></center>";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>