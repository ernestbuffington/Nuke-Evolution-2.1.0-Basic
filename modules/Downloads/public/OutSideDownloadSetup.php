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

if (!defined('MODULE_FILE') || !defined('DOWNLOADS_INDEX_FILE') ) {
   die('You can\'t access this file directly...');
}

include_once(NUKE_BASE_DIR.'header.php');
DownloadsHeading();
OpenTable();
echo "<center><span class='option'><strong>".$lang_new[$module_name]['PROMOTE_YOUR_WEBSITE']."</strong></span></center><br /><br />

".$lang_new[$module_name]['INFO_PROMOTE_1']."<br /><br />

<strong>1) ".$lang_new[$module_name]['PROMOTE_RATING_TEXT_DOWNLOAD']."</strong><br /><br />

".$lang_new[$module_name]['INFO_PROMOTE_2']."<br /><br />
<center><a href='".EVO_SERVER_URL."/modules.php?name=".$module_name."&amp;op=ratedownload&amp;did=".$did."'>".$lang_new[$module_name]['DO_RATE']."&nbsp;@".EVO_SERVER_SITENAME."</a></center><br /><br />
<center>".$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_1']."</center><br />
<center><em>&lt;a href='".EVO_SERVER_URL."/modules.php?name=".$module_name."&amp;op=ratedownload&amp;did=".$did."'&gt;".$lang_new[$module_name]['DO_RATE']."&lt;/a&gt;</em></center>
<br /><br />
".$lang_new[$module_name]['PROMOTE_RATING_THE_NUMBER']."&nbsp;'".$did."'&nbsp;".$lang_new[$module_name]['PROMOTE_RATING_ID_REFERER']."<br /><br />

<strong>2) ".$lang_new[$module_name]['PROMOTE_RATING_BUTTON_DOWNLOAD']."</strong><br /><br />

".$lang_new[$module_name]['INFO_PROMOTE_3']."<br /><br />

<center>
<form action='modules.php?name=".$module_name."' method='post'>\n
<input type='hidden' name='did' value='".$did."' />\n
<input type='hidden' name='op' value='ratedownload' />\n
<input type='submit' value='".$lang_new[$module_name]['DO_RATE']."' />\n
</form>\n
</center>

<center>".$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_2']."</center><br /><br />

<table border='0' align='center'><tr><td align='left'><em>
&lt;form action='".EVO_SERVER_URL."/modules.php?name=".$module_name."' method='post'&gt;<br />\n
&nbsp;&nbsp;&lt;input type='hidden' name='did' value='".$did."'&gt;<br />\n
&nbsp;&nbsp;&lt;input type='hidden' name='op' value='ratedownload'&gt;<br />\n
&nbsp;&nbsp;&lt;input type='submit' value='".$lang_new[$module_name]['DO_RATE']."'&gt;<br />\n
&lt;/form&gt;\n
</em></td></tr></table>

<br /><br />";

if ( !$downloadsconfig['securitycheck'] ) {
echo "

<strong>3) ".$lang_new[$module_name]['PROMOTE_RATING_FORM']."</strong><br /><br />

".$lang_new[$module_name]['INFO_PROMOTE_4']."

<center>
<form method='post' action='".EVO_SERVER_URL."/modules.php?name=".$module_name."'>
<table align='center' border='0' width='175' cellspacing='0' cellpadding='0'>
<tr><td align='center'><strong>".$lang_new[$module_name]['DO_VOTE_THIS_SITE']."</strong></a></td></tr>
<tr><td>
<table border='0' cellspacing='0' cellpadding='0' align='center'>
<tr><td valign='top'>
<select name='rating'>
<option selected='selected'>--</option>
<option>10</option>
<option>9</option>
<option>8</option>
<option>7</option>
<option>6</option>
<option>5</option>
<option>4</option>
<option>3</option>
<option>2</option>
<option>1</option>
</select>
</td><td valign='top'>
<input type='hidden' name='ratingdid' value='".$did."' />
<input type='hidden' name='ratinguser' value='outside' />
<input type='hidden' name='op value='addrating' />
<input type='submit' value='".$lang_new[$module_name]['SUBMIT_VOTE']."' />
</td></tr></table>
</td></tr></table></form>

<br />".$lang_new[$module_name]['INFO_PROMOTE_HTML_CODE_3']."<br /><br /></center>

<blockquote><em>
&lt;form method='post' action='".EVO_SERVER_URL."/modules.php?name=".$module_name."'&gt;<br />
&lt;table align='center' border='0' width='175' cellspacing='0' cellpadding='0'&gt;<br />
    &lt;tr&gt;&lt;td align='center'&gt;&lt;b&gt;".$lang_new[$module_name]['DO_VOTE_THIS_SITE']."&lt;/b&gt;&lt;/a&gt;&lt;/td&gt;&lt;/tr&gt;<br />
    &lt;tr&gt;&lt;td&gt;<br />
    &lt;table border='0' cellspacing='0' cellpadding='0' align='center'&gt;<br />
    &lt;tr&gt;&lt;td valign='top'&gt;<br />
    &lt;select name='rating'&gt;<br />
    &lt;option selected&gt;--&lt;/option&gt;<br />
    &lt;option&gt;10&lt;/option&gt;<br />
    &lt;option&gt;9&lt;/option&gt;<br />
    &lt;option&gt;8&lt;/option&gt;<br />
    &lt;option&gt;7&lt;/option&gt;<br />
    &lt;option&gt;6&lt;/option&gt;<br />
    &lt;option&gt;5&lt;/option&gt;<br />
    &lt;option&gt;4&lt;/option&gt;<br />
    &lt;option&gt;3&lt;/option&gt;<br />
    &lt;option&gt;2&lt;/option&gt;<br />
    &lt;option&gt;1&lt;/option&gt;<br />
    &lt;/select&gt;<br />
    &lt;/td&gt;&lt;td valign='top'&gt;<br />
    &lt;input type='hidden' name='ratingdid' value='".$did."'&gt;<br />
    &lt;input type='hidden' name='ratinguser' value='outside'&gt;<br />
    &lt;input type='hidden' name='op' value='addrating'&gt;<br />
    &lt;input type='submit' value='".$lang_new[$module_name]['SUBMIT_VOTE']."'&gt;<br />
    &lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;<br />
&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;<br />
&lt;/form&gt;<br />
</em></blockquote>";
}
echo "<br /><br /><center>
".$lang_new[$module_name]['INFO_PROMOTE_5']."<br /><br />
- ".EVO_SERVER_SITENAME." -<br />".$lang_new[$module_name]['DOWNLOADS_SIGNATURE']."
<br /><br /></center>";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>