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

if (!defined('ADMIN_FILE')) {
   die ('Illegal File Access');
}

if (!defined('IN_SITEMAP_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN SITEMAP ADMINISTRATION');
}

$smxm   = $_GETVAR->get('smxm', '_POST', 'int');
$ndown  = $_GETVAR->get('ndown', '_POST', 'int');
$nnews  = $_GETVAR->get('nnews', '_POST', 'int');
$nrev   = $_GETVAR->get('nrev', '_POST', 'int');
$ntopics = $_GETVAR->get('ntopics', '_POST', 'int');
$nuser  = $_GETVAR->get('nuser', '_POST', 'int');

if( !empty($nnews) && !empty($ntopics) && !empty($ndown) && !empty($nrev) && !empty($nuser) ) {
    //$db->sql_uquery("UPDATE " . _JMAP_TABLE . " SET xml = ".$xml.", nnews = ".$nnews.", ntopics = ".$ntopics.", ndown = ".$ndown.", nrev = ".$nrev.", nuser = ".$nuser);
    $db->sql_uquery("UPDATE " . _JMAP_TABLE . " SET value = '".$smxm."' WHERE name = 'xml'");
    $db->sql_uquery("UPDATE " . _JMAP_TABLE . " SET value = '".$nnews."' WHERE name = 'nnews'");
    $db->sql_uquery("UPDATE " . _JMAP_TABLE . " SET value = '".$ntopics."' WHERE name = 'ntopics'");
    $db->sql_uquery("UPDATE " . _JMAP_TABLE . " SET value = '".$ndown."' WHERE name = 'ndown'");
    $db->sql_uquery("UPDATE " . _JMAP_TABLE . " SET value = '".$nrev."' WHERE name = 'nrev'");
    $db->sql_uquery("UPDATE " . _JMAP_TABLE . " SET value = '".$nuser."' WHERE name = 'nuser'");

    redirect($admin_file.'.php?op=sitemap');
} else {
    switch (TRUE) {
        case(empty($snnews)):
            $wrong_value = $lang_new[$module_name]['ERR_NNEWS'];
            break;
        case(empty($ntopics)):
            $wrong_value = $lang_new[$module_name]['ERR_NTOPICS'];
            break;
        case(empty($ndown)):
            $wrong_value = $lang_new[$module_name]['ERR_NDOWN'];
            break;
        case(empty($nrev)):
            $wrong_value = $lang_new[$module_name]['ERR_NREV'];
            break;
        case(empty($nuser)):
            $wrong_value = $lang_new[$module_name]['ERR_NUSER'];
            break;
    }
    include(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<div align=\"center\"><a href=\"$admin_file.php?op=sitemap\">" .$lang_new[$module_name]['SITEMAP_ADMIN_HEADER'] . "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . $lang_new[$module_name]['SITEMAP_RETURNMAIN'] . "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<center>"
        ."<strong>" . $lang_new[$module_name]['ERROR'] . "</strong><br /><br />"
        . $lang_new[$module_name]['Value_missing'] . ":&nbsp;&nbsp;"
        . $wrong_value . "<br /><br />"
        . _GOBACK . "<br />";
    echo "</center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    
}

?>