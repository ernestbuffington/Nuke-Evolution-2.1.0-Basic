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
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

if (!defined('IN_WEBLINKS_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN WEBLINKS ADMINISTRATION');
}

$result = $db->sql_query("SELECT `url` FROM `"._WEBLINKS_LINKS_TABLE."` WHERE `url`='$url'");
$numrows = $db->sql_numrows($result);
if ($numrows>0) {
    linksHeader();
    OpenTable();
    echo "<center><span class=\"option\">"
        ."<strong>" . $lang_new[$module_name]['ERROR_URL_EXISTS'] . "</strong><br /><br />"
        . $lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
    echo "</span></center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    /* Check if Title exist */
    if (empty($title)) {
        linksHeader();
        OpenTable();
        echo "<center><span class=\"option\">"
            ."<strong>" . $lang_new[$module_name]['ERROR_NO_TITLE'] . "</strong><br />"
            .$lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
        echo "</span></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
    /* Check if URL exist */
    if (empty($url)) {
        linksHeader();
        OpenTable();
        echo "<center><span class=\"option\">"
            ."<strong>" . $lang_new[$module_name]['ERROR_NO_URL'] . "</strong><br />"
            .$lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
        echo "</span></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
    // Check if Description exist
    if (empty($description)) {
        linksHeader();
        OpenTable();
        echo "<center><span class=\"option\">"
            ."<strong>" . $lang_new[$module_name]['ERROR_NO_DESCRIPTION'] . "</strong><br />"
            . $lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
        echo "</span></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
    $title   = $_GETVAR->fixQuotes($title);
    $image   = $_GETVAR->fixQuotes($image);
    $url     = $_GETVAR->fixQuotes($url);
    $description = $_GETVAR->fixQuotes($description);
    $dbname  = $_GETVAR->fixQuotes($username);
    $dbemail = $_GETVAR->fixQuotes($email);
    $db->sql_query("INSERT INTO `"._WEBLINKS_LINKS_TABLE."` (`lid`, `cid` , `sid` , `title` , `image`, `url`, `description` , `date`, `date_validated`, `name` , `email` , `submitter` )
              VALUES (NULL, '".$cat."', '0', '".$title."', '".$image."', '".$url."', '".$description."', '".$date."', '".time()."', '".$dbname."', '".$dbemail."', '".$submitter."')");
    if ($new == 1) {
        $db->sql_query("DELETE FROM `"._WEBLINKS_NEWLINK_TABLE."` WHERE `lid`='$lid'");
        $cache->delete('numwaitl', 'submissions');
        if (!empty($email)) {
            $subject = $lang_new[$module_name]['MAIL_SITENAME'] . " ".EVO_SERVER_SITENAME;
            $message = $lang_new[$module_name]['MAIL_HELLO'] . " $name:\n\n" . $lang_new[$module_name]['MAIL_APPROVED_MESSAGE'] . "\n\n" . $lang_new[$module_name]['TITLE'] . ": $title\n" . $lang_new[$module_name]['LINK_URL'] . ": $url\n\n\n" . $lang_new[$module_name]['MAIL_BROWSEURL'] . " <a href=\"".EVO_SERVER_URL."/modules.php?name=Web_Links\">".EVO_SERVER_URL."/modules.php?name=Web_Links</a>\n\n" . $lang_new[$module_name]['MAIL_THANKYOU'] . "\n\n".EVO_SERVER_SITENAME."\n " . $lang_new[$module_name]['MAIL_SIGNATURE'] . "";
            $to      = $email.', '.$username;
            $return  = evo_mail($to, $subject, $message);
        }
    }
    linksHeader();
    OpenTable();
    echo "<center><span class=\"option\">";
    echo  $lang_new[$module_name]['MESSAGE_LINK_VALIDATED'] . "<br />";
    echo "</span></center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

?>