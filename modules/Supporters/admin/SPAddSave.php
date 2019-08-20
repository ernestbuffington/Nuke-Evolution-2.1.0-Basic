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

$site_name          = $_GETVAR->get('site_name', '_POST');
$site_description   = $_GETVAR->get('site_description', '_POST');
$site_url           = $_GETVAR->get('site_url', '_POST', 'url');
$site_image         = $_GETVAR->get('site_image', '_POST');
if (empty($site_image)) {
    $site_file_image= $_GETVAR->get('site_image_file', '_FILES', 'array');
    $imageurl_name  = $site_file_image['name'];
    $imageurl_temp  = $site_file_image['tmp_name'];
    $imageurl_type  = $site_file_image['Type'];
    $imageurl_error = $site_file_image['error'];
} else {
    $imageurl_name  = '';
    $imageurl_temp  = '';
}
$user_id            = $_GETVAR->get('user_id', '_POST', 'int');
$user_name          = $_GETVAR->get('user_name', '_POST');
$user_email         = $_GETVAR->get('user_email', '_POST', 'email');
$user_ip            = $_GETVAR->get('user_ip', '_POST');

if(empty($site_name) || empty($site_url) || empty($site_description) || empty($site_image) && empty($imageurl_name) ) {
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
    if (empty($site_image) || empty($imageurl_name)) {echo "<span style='color:red'><strong>".$lang_new[$module_name]['SP_IMAGE']."</strong></span><br />\n";}
    echo "<br />"._GOBACK."</center>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
}

list($newest_oid) = $db->sql_fetchrow($db->sql_query("SELECT max(`site_id`) AS newest_oid FROM `"._NSNSP_SITES_TABLE."`"));
if($newest_oid == '-1' ) { 
    $new_oid = 1; 
} else { 
    $new_oid = $newest_oid+1; 
}

if(!empty($imageurl_name)) {
    $error = '';
    if (is_uploaded_file($imageurl_temp) && $imageurl_error == 0) {
        //Check if we have an image
        $img_info = @getimagesize($imageurl_temp);
        if (empty($img_info)) {$error = 'kein Bild';}
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
    $oid = str_pad($new_oid, 6, '0', STR_PAD_LEFT);
    $ext = substr($imageurl_name, strrpos($imageurl_name,'.'), 5);
    if(move_uploaded_file($imageurl_temp, NUKE_MODULES_DIR . $module_name .'/images/supporters/'.$oid.$ext)) {
        $img_ary = array(1 => 1,2 => 2,3 => 3,4 => 4);
        $img_info = @getimagesize(NUKE_MODULES_DIR . $module_name .'/images/supporters/'.$oid.$ext);
        if (in_array($img_info[2], $img_ary)) {
            @chmod (NUKE_MODULES_DIR . $module_name .'/images/supporters/'.$oid.$ext, $file_mode);
            $imgurl = $module_name . '/images/supporters/'.$oid.$ext;
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
} else {
    $imgurl = $site_image;
    $site_image_type = 0;
}
$site_name  = $_GETVAR->fixQuotes($site_name);
$imgurl     = $_GETVAR->fixQuotes($imgurl);
$site_url   = $_GETVAR->fixQuotes($site_url);
$site_description = $_GETVAR->fixQuotes($site_description);
$user_name  = $_GETVAR->fixQuotes($user_name);
$user_email = $_GETVAR->fixQuotes($user_email);
$result = $db->sql_query("INSERT INTO `"._NSNSP_SITES_TABLE."` (`site_id`, `site_name`, `site_url`, `site_image`, `image_type`, `site_status`, `site_hits`, `site_date`, `site_description`, `user_id`, `user_name`, `user_email`, `user_ip`, `last_edit_user_date`, `last_edit_user_name`, `last_edit_user_id`)  
                            VALUES (NULL, '$site_name', '$site_url', '$imgurl', '$site_image_type', '1', '0', ".time().", '$site_description', '$user_id', '$user_name', '$user_email', '$user_ip', '0', '', '')");
if(!$result) {
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=SPMain\">" . $lang_new[$module_name]['SP_ADMIN_HEADER'] . "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $lang_new[$module_name]['SP_RETURNMAIN'] . "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<center><strong>".$lang_new[$module_name]['SP_DBERROR1']."</strong></center><br />\n";
    echo "<center>"._GOBACK."</center>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
}
$cache->delete('numsuppen', 'submissions');
$cache->delete('numsupact', 'submissions');
$cache->delete('numsupdea', 'submissions');
$cache->delete('image_atts', 'nsnsp');
redirect($admin_file.'.php?op=SPMain');

?>