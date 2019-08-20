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
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

global $userinfo, $profieldata, $evoconfig, $_GETVAR;

if ($evoconfig['my_headlines'] == TRUE && (( $userinfo['user_id'] == $profiledata['user_id']|| is_admin() )) )  {
    $bypass = $_GETVAR->get('bypass', 'post');
    $url    = $_GETVAR->get('url', 'post', 'url');
    $hid    = $_GETVAR->get('hid', 'post', 'int');

    echo "<br />";
    OpenTable();
    echo "<strong>"._MYHEADLINES."</strong><br /><br />";
    echo _SELECTASITE."<br /><br />";
    echo "<form action=\"modules.php?name=Profile\" method=\"post\">";
    echo "<input type=\"hidden\" name=\"mode\" value=\"viewprofile\" />";
    echo "<input type=\"hidden\" name=\"u\" value=\"".$userinfo['user_id']."\" />";
    echo "<input type=\"hidden\" name=\"bypass\" value=\"bypass\" />";
    echo "<input type=\"hidden\" name=\"url\" value=\"0\" />";
    echo "<select name=\"hid\" onchange='submit()'>\n";
    echo "<option value=\"0\">"._SELECTASITE2."</option>";
    $sql4 = "SELECT hid, sitename FROM "._HEADLINES_TABLE." ORDER BY sitename";
    $headl = $db->sql_query($sql4);
    while($row4 = $db->sql_fetchrow($headl)) {
        $nhid = intval($row4['hid']);
        $hsitename = $row4['sitename'];
        if ($hid == $nhid ) {
            $sel = "selected";
        } else {
            $sel = "";
        }
        echo "<option value=\"$nhid\" $sel>$hsitename</option>\n";
    }
    echo "</select></form>";
    echo _ORTYPEURL."<br /><br />";
    echo "<form action=\"modules.php?name=Profile\" method=\"post\">";
    echo "<input type=\"hidden\" name=\"mode\" value=\"viewprofile\" />";
    echo "<input type=\"hidden\" name=\"u\" value=\"".$userinfo['user_id']."\" />";
    echo "<input type=\"hidden\" name=\"bypass\" value=\"bypass\" />";
    echo "<input type=\"hidden\" name=\"hid\" value=\"0\" />";
    echo "<input type=\"text\" name=\"url\" size=\"40\" maxlength=\"200\" value=\"http://\" />&nbsp;&nbsp;";
    echo "<input type=\"submit\" value=\""._GO."\" /></form>";
    echo "<br />";
    if ( $bypass == 'bypass' ) { 
        OpenTable2();
        if( !empty($url) ) {
            if (!preg_match('#://#',$url)) { 
                $url = 'http://'.$url; 
            }
            if ( $content = rss_content($url) ) { 
                $rss_content = $content;
                $rss_title = $url;
            } else {
                $rss_content = _RSSPROBLEM.' ('.$url.')';
            }   
        } else {
            $row = $db->sql_ufetchrow('SELECT `sitename`, `headlinesurl` FROM `'._HEADLINES_TABLE.'` WHERE `hid`='.$hid, SQL_ASSOC);
            $content = rss_content($row['headlinesurl']);
            if (empty($content)) {
                $rss_content = _RSSPROBLEM.' ('.$row['sitename'].')';
            } else {
                $rss_title = $row['sitename'];
                $rss_content = '<span class="content">'.$content.'</span>';
            }
        }
        echo "<strong>$rss_title</strong><br /><br />";
        echo $rss_content;
        CloseTable2();
    }
    CloseTable();
}
?>