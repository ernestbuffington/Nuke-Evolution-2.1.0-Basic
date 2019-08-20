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

if (!defined('IN_REVIEWS_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN REVIEWS ADMINISTRATION');
}

/* Check if Title exist */
if (empty($title)) {
    reviewsHeader();
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
    $reviewheader = $_GETVAR->fixQuotes($reviewheader);
    $reviewbody = $_GETVAR->fixQuotes($reviewbody);
    $reviewfooter = $_GETVAR->fixQuotes($reviewfooter);
    $reviewsignature = $_GETVAR->fixQuotes($reviewsignature);
    $sqlurl = '';
} else {
    Validate($url,'url',$lang_new[$module_name]['REVIEWS']);
    $reviewheader = '';
    $reviewbody = '';
    $reviewfooter = '';
    $reviewsignature = '';
    $url = $_GETVAR->fixQuotes($url);
    $sqlurl = "OR `url`='$url'";
}
/* Check if Description exist */
if (empty($description)) {
    reviewsHeader();
    OpenTable();
    echo "<center><span class=\"option\">"
        ."<strong>" . $lang_new[$module_name]['ERROR_NO_DESCRIPTION'] . "</strong><br />"
        . $lang_new[$module_name]['SUBMIT_GOBACK'] . "<br />";
    echo "</span></center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}
$title = $_GETVAR->fixQuotes($title);
$image = $_GETVAR->fixQuotes($image);
$description = $_GETVAR->fixQuotes($description);
$name = $_GETVAR->fixQuotes($username);
$email = $_GETVAR->fixQuotes($email);
if (!empty($email)) {
     Validate($email,'email',$lang_new[$module_name]['REVIEWS']);
}

if (intval($new) == 1) {
    $num_new = 0;
} else {
    $num_new = $db->sql_numrows($db->sql_query("SELECT `rid` FROM `"._REVIEWS_NEWREVIEW_TABLE."` WHERE `title`='$title' $sqlurl"));
}
$num_new2 = $db->sql_numrows($db->sql_query("SELECT `rid` FROM `"._REVIEWS_REVIEWS_TABLE."` WHERE `title`='$title' $sqlurl"));

if ($num_new > 0 || $num_new2 > 0) {
    $message = $lang_new[$module_name]['ERROR_URL_OR_TITLE_EXISTS'] . '<br /><br /><center>'.$lang_new[$module_name]['SUBMIT_GOBACK'].'<br />';
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . $message);
} else {
    $db->sql_query("INSERT INTO `"._REVIEWS_REVIEWS_TABLE."` (`rid`, `cid` , `sid` , `title` , `image`, `url`, `description` , `date`, `name` , `email` , `submitter`, `header`, `body`, `footer`, `signature` )
                      VALUES (NULL, '".$cat."', '0', '".$title."', '".$image."', '".$url."', '".$description."', '".time()."', '".$name."', '".$email."', '".$submitter."', '".$reviewheader."', '".$reviewbody."', '".$reviewfooter."', '".$reviewsignature."')");
    if (intval($new) == 1) {
        $db->sql_query("DELETE FROM `"._REVIEWS_NEWREVIEW_TABLE."` WHERE `rid`='$rid'");
        $cache->delete('numwaitr', 'submissions');
        if (!empty($email)) {
            $subject = $lang_new[$module_name]['MAIL_SITENAME'] . " ".EVO_SERVER_SITENAME;
            $message = $lang_new[$module_name]['MAIL_HELLO'] . " $name:\n\n" . $lang_new[$module_name]['MAIL_APPROVED_MESSAGE'] . "\n\n" . $lang_new[$module_name]['TITLE'] . ": $title\n\n\n" . $lang_new[$module_name]['MAIL_BROWSEURL'] . " <a href=\"".EVO_SERVER_URL."/modules.php?name=Reviews\">".EVO_SERVER_URL."/modules.php?name=Reviews</a>\n\n" . $lang_new[$module_name]['MAIL_THANKYOU'] . "\n\n".EVO_SERVER_SITENAME."\n " . $lang_new[$module_name]['MAIL_SIGNATURE'] . "";
            $to      = $email.', '.$name;
            $return = evo_mail($to, $subject, $message);
        }
    }
    reviewsHeader();
    OpenTable();
    echo "<center><span class=\"option\">";
    echo  $lang_new[$module_name]['MESSAGE_REVIEW_VALIDATED'] . "<br />";
    echo "</span></center>";
    CloseTable();
}

include_once(NUKE_BASE_DIR.'footer.php');

?>