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

if (!defined('IN_SUPPORTER_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN SUPPORTER ADMINISTRATION');
}

$comefrom           = $_GETVAR->get('comefrom', 'POST');
$site_name          = $_GETVAR->get('site_name', 'POST');
$site_description   = $_GETVAR->get('site_description', 'POST');
$site_id            = $_GETVAR->get('site_id', 'POST', 'int');
$site_url           = $_GETVAR->get('site_url', 'POST', 'url');
$site_date          = $_GETVAR->get('site_date', 'POST');
$old_image          = $_GETVAR->get('old_image', 'POST');
$oid                = str_pad($site_id, 6, '0', STR_PAD_LEFT);
$old_image_type     = $_GETVAR->get('old_image_type', 'POST', 'int');
$user_name          = $_GETVAR->get('user_name', 'POST');
$user_email         = $_GETVAR->get('user_email', 'POST', 'email');
$user_ip            = $_GETVAR->get('user_ip', 'POST');
$edit_user_name     = $_GETVAR->get('edit_user_name', 'POST');
$edit_user_id       = $_GETVAR->get('edit_user_id', 'POST', 'int');
$new_image          = $_GETVAR->get('new_image', 'POST');
if (empty($new_image)) {
    $new_file_image = $_GETVAR->get('new_image_file', '_FILES', 'array');
    $imageurl_name  = $new_file_image['name'];
    $imageurl_temp  = $new_file_image['tmp_name'];
    $imageurl_type  = $new_file_image['Type'];
    $imageurl_error = $new_file_image['error'];
} else {
    $imageurl_name  = '';
    $imageurl_temp  = '';
}
if( empty($site_name) || empty($site_url) || empty($site_description) ) {
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=SPMain\">" . $lang_new[$module_name]['SP_ADMIN_HEADER'] . "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $lang_new[$module_name]['SP_RETURNMAIN'] . "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<center><strong>".$lang_new[$module_name]['SP_MISSINGDATA']."</strong><br /><br />\n";
    if (empty($site_name)) {echo "<span style='color:red'><strong>".$lang_new[$module_name]['SP_NAME']."</strong></span><br />\n";}
    if (empty($site_url)) {echo "<span style='color:red'><strong>".$lang_new[$module_name]['SP_URL']."</strong></span><br />\n";}
    if (empty($site_description)) {echo "<span style='color:red'><strong>".$lang_new[$module_name]['SP_DESCRIPTION']."</strong></span><br />\n";}
    echo "<br />"._GOBACK."</center>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
}

if(!empty($imageurl_name)) {
    $error = '';
    if (is_uploaded_file($imageurl_temp) && $imageurl_erro == 0) {
        //Check if we have an image
        $img_info = @getimagesize($imageurl_temp);
        if (empty($img_info)) {$error = $lang_new[$module_name]['SP_FILETYPERROR'];}
    } else {
        $error = $lang_new[$module_name]['SP_FILETYPERROR'];
    }
    if (!empty($error)) {
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=SPMain\">" . $lang_new[$module_name]['SP_ADMIN_HEADER'] . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $lang_new[$module_name]['SP_RETURNMAIN'] . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><strong>".$lang_new[$module_name]['SP_UPLOADERROR']."</strong><br />\n";
        echo "<span style='color:red'><strong>".$error."</strong></span><br />\n";
        echo _GOBACK."</center>\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        exit;
    }
    if(@move_uploaded_file($imageurl_temp, NUKE_MODULES_DIR . $old_image)) {
        $img_ary = array(1 => 1,2 => 2,3 => 3,4 => 4);
        $img_info = @getimagesize(NUKE_MODULES_DIR . $old_image);
        if (in_array($img_info[2], $img_ary)) {
            @chmod (NUKE_MODULES_DIR . $old_image, $file_mode);
            $imgurl = $old_image;
        } else {
            $error = $lang_new[$module_name]['SP_FILETYPERROR'];
        }
    } else {
        $error = $lang_new[$module_name]['SP_NOUPLOAD'];
    }
    if (!empty($error)) {
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=SPMain\">" . $lang_new[$module_name]['SP_ADMIN_HEADER'] . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $lang_new[$module_name]['SP_RETURNMAIN'] . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        title($lang_new[$module_name]['SP_CONFBANN']);
        OpenTable();
        echo "<center><strong>".$error."</strong></center><br />\n";
        echo "<center>"._GOBACK."</center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        exit;
    }
    $site_image_type = 1;
} elseif (!empty($new_image)) {
    $imgurl = $new_image;
    $site_image_type = 0;
} else {
    $imgurl = $old_image;
    $site_image_type = $old_image_type;
}

$result = $db->sql_uquery("UPDATE `"._NSNSP_SITES_TABLE."` SET `site_name`='$site_name', `site_url`='$site_url', `image_type`='$site_image_type', `site_image`='$imgurl', `site_description`='$site_description', `user_name`='$user_name', `user_email`='$user_email', `last_edit_user_date`='".time()."', `last_edit_user_name`='".$userinfo['username']."', `last_edit_user_id`='$edit_user_id' WHERE `site_id`='$site_id'");
$cache->delete('numsuppen', 'submissions');
$cache->delete('numsupact', 'submissions');
$cache->delete('numsupdea', 'submissions');
$cache->delete('image_atts', 'nsnsp');
redirect($admin_file.'.php?op='.$comefrom);

?>