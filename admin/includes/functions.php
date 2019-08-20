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

function need_delete($file, $dir=false) {
    global $lang_admin;
    if (!$dir) {
        if(!@is_file($file)) {
            return;
        }
        if ( !(@unlink($file)) ) {
            DisplayError("<span style='color: red; font-size: 24px;'>".$lang_admin['KERNEL']['INFO_NEED_DELETE']." ".$file."</span><br /><br /><a href='javascript:location.reload(true)'>". $lang_admin['KERNEL']['SUBMIT'] ."</a>\n");
        } else {
            DisplayError("<span style='color: red; font-size: 24px;'>".$lang_admin['KERNEL']['INFO_IS_DELETED']." ".$file."</span><br /><br /><a href='javascript:location.reload(true)'>". $lang_admin['KERNEL']['GOBACK'] ."</a>\n");
        }
    } else {
        if(!@is_dir($file)) {
            return;
        }
        function SureRemoveDir($dir, $DeleteMe) {
            if(!$dh = @opendir($dir)) return;
            while (false !== ($obj = @readdir($dh))) {
                if($obj=='.' || $obj=='..') continue;
                if (!@unlink($dir.'/'.$obj)) SureRemoveDir($dir.'/'.$obj, true);
            }

            @closedir($dh);
            if ($DeleteMe){
                @rmdir($dir);
            }
        }
        SureRemoveDir($file, true);
        if (!@is_dir($file)){
            DisplayError("<span style='color: red; font-size: 24px;'>".$lang_admin['KERNEL']['INFO_IS_DELETED'] ." ".$file."'</span><br /><br /><a href='javascript:location.reload(true)'>". $lang_admin['KERNEL']['GOBACK'] ."</a>\n");
        } else {
            DisplayError("<span style='color: red; font-size: 24px;'>".$lang_admin['KERNEL']['INFO_NEED_DELETED'] ." ".$file."'</span><br /><br /><a href='javascript:location.reload(true)'>". $lang_admin['KERNEL']['SUBMIT'] ."</a>\n");
        }
    }
}

function create_first() {
    global $db, $evoconfig, $admin_file, $cache, $_GETVAR, $evoconfig, $lang_admin;

    $email = $_GETVAR->get('email', 'POST', 'email');
    $name  = $_GETVAR->get('name', 'POST', 'alphanumeric');
    $url   = $_GETVAR->get('url', 'POST', 'url');
    $pwd   = $_GETVAR->get('pwd', 'POST');
    $cpwd  = $_GETVAR->get('cpwd', 'POST');
    $user_new = $_GETVAR->get('user_new', 'POST', 'int', 1);

    if (empty($email)) {
        DisplayError('<center><p style="color:red">'.$lang_admin['KERNEL']['ERROR_FIRST_EMAIL'].'</p><br /><a href="javascript:history.back(-1)">'. $lang_admin['KERNEL']['GOBACK'] .'</a></center>');
    }
    if (empty($name)) {
        DisplayError('<center><p style="color:red">'.$lang_admin['KERNEL']['ERROR_FIRST_NICK'].'</p><br /><a href="javascript:history.back(-1)">'. $lang_admin['KERNEL']['GOBACK'] .'</a></center>');
    }
    if (empty($url)) {
        DisplayError('<center><p style="color:red">'.$lang_admin['KERNEL']['ERROR_FIRST_URL'].'</p><br /><a href="javascript:history.back(-1)">'. $lang_admin['KERNEL']['GOBACK'] .'</a></center>');
    }
    if($cpwd != $pwd) {
        DisplayError("<center><p style='color:red'>".$lang_admin['KERNEL']['ERROR']."</p>".$lang_admin['KERNEL']['ERROR_PASS_NOT_MATCH']."</center>");
    }
    $defaultlang = (!($evoconfig['default_lang'])) ? 'english' : $evoconfig['default_lang'];

    list($first) = $db->sql_ufetchrow("SELECT aid FROM `"._AUTHOR_TABLE."`");
    if ($first == 0) {
        $pwd = EvoCrypt($pwd);
        $the_adm = 'God';
        $email = validate_mail($email);
        $db->sql_uquery("INSERT INTO `"._AUTHOR_TABLE."` (`admlanguage`, `aid`, `counter`, `email`, `name`, `pwd`, `radminsuper`, `url`) VALUES ('$defaultlang', '$name', '0', '$email','$the_adm' , '$pwd', '1', '$url')");
        $db->sql_uquery("INSERT INTO `"._SENTINEL_ADMINS_TABLE."` (`aid`, `login`, `protected`) VALUES ('$name', '$name', '1')");
        $cookie_value = "$name:$pwd:$defaultlang:0";
        evo_setcookie('admin', $cookie_value, 43200);  // 12 hours until first login as admin should be enough
        if ($user_new == 1) {
                $user_regdate = date('M d, Y');
                $user_avatar = 'blank.gif';
                $commentlimit = ($evoconfig['commentlimit'] ? $evoconfig['commentlimit'] : 4096);
                $defaultdateformat = (!($evoconfig['default_dateformat'])) ? 'D M d, Y g:i a' : $evoconfig['default_dateformat'];
                $db->sql_uquery("INSERT INTO `"._USERS_TABLE."` (`user_id`, `username`, `user_email`, `user_website`, `user_avatar`, `user_regdate`, `user_password`, `theme`, `commentmax`, `user_level`, `user_rank`, `user_lang`, `user_dateformat`, `user_color_gc`, `user_color_gi`, `user_posts`) VALUES ('2','FirstAdmin','".$email."','".$url."','".$user_avatar."','".$user_regdate."','".$pwd."','".$evoconfig['default_Theme']."','".$commentlimit."', '2', '1', '".$defaultlang."','".$defaultdateformat."','FFA34F','--1--', '1')");
                $user_id = $db->sql_fetchrow($db->sql_query("SELECT `user_id` FROM `"._USERS_TABLE."` WHERE `username` = 'FirstAdmin'"));
                $db->sql_uquery("INSERT INTO `".GROUPS_TABLE."` (`group_type`, `group_name`, `group_description`, `group_moderator`, `group_single_user`, `group_allow_pm`, `max_inbox`, `max_sentbox`, `max_savebox`)
                                                                VALUES ('1', 'FirstAdmin', 'Personal User', '0', '1', '5', '0', '0', '0')");
                $group_id = $db->sql_fetchrow($db->sql_query("SELECT `group_id` FROM `".GROUPS_TABLE."` WHERE `group_name` = 'FirstAdmin'"));
                $db->sql_uquery("INSERT INTO `".USER_GROUP_TABLE."` (`group_id`, `user_id`, `user_pending`) VALUES ('".$group_id['group_id']."', '".$user_id['user_id']."', '0')");
                $db->sql_uquery("UPDATE `"._USERS_TABLE."` SET `username` = '$name' WHERE `username` = 'FirstAdmin'");
                $db->sql_uquery("UPDATE `".GROUPS_TABLE."` SET `group_name` = '' WHERE `group_name` = 'FirstAdmin'");
                $uid = $user_id['user_id'];
                $cookiedata = "$uid:$name:$pwd";
                evo_setcookie('user', $cookiedata, 2592000);
                $cache->delete('UserColors', 'config');
        }
        log_write('admin', $lang_admin['KERNEL']['ERROR_LOG_GOD_ADMIN_CREATED'] .'(' . $name . ')', $lang_admin['KERNEL']['ERROR_LOG_GENERAL_INFORMATION']);
        redirect($admin_file.'.php');
    }
}

function create_admin() {
die('Ich bin hier'.$the_first);
    global $admin_file, $lang_admin, $currentlang;
    define('CREATE_ADMIN', TRUE);
    include_once(NUKE_BASE_DIR.'header.php');
    title(EVO_SERVER_SITENAME.': '.$lang_admin['KERNEL']['TITLE_ADMINISTRATION']);
    OpenTable();
    echo "<div align=\"center\"><strong>".$lang_admin['KERNEL']['NOADMINYET']."</strong></div><br /><br />"
        ."<form action=\"".$admin_file.".php\" method=\"post\" name=\"form1\">"
        ."<dl class=\"twocolumn\">"
        ."<dt class=\"twocolumn\"><strong>".$lang_admin['KERNEL']['NICKNAME'].":</strong></dt><dd class=\"twocolumn\"><input type=\"text\" name=\"name\" size=\"30\" maxlength=\"25\" /></dd>"
        ."<dt class=\"twocolumn\"><strong>".$lang_admin['KERNEL']['HOMEPAGE'].":</strong></dt><dd class=\"twocolumn\"><input type=\"text\" name=\"url\" size=\"30\" maxlength=\"255\" value=\"http://\" /></dd>"
        ."<dt class=\"twocolumn\"><strong>".$lang_admin['KERNEL']['EMAIL'].":</strong></dt><dd class=\"twocolumn\"><input type=\"text\" name=\"email\" size=\"30\" maxlength=\"255\" /></dd>"
        ."<dt class=\"twocolumn\"><strong>".$lang_admin['KERNEL']['PASSWORD'].":</strong></dt><dd class=\"twocolumn\"><input type=\"password\" name=\"pwd\" size=\"40\" maxlength=\"40\" onkeyup='chkpwd(form1.pwd.value)' onblur='chkpwd(form1.pwd.value)' onmouseout='chkpwd(form1.pwd.value)' /></dd>";
    echo "<dt class=\"twocolumn\"><strong>".$lang_admin['KERNEL']['PASS_CONFIRM'].":</strong></dt><dd class=\"twocolumn\"><input type=\"password\" name=\"cpwd\" size=\"40\" maxlength=\"40\" /></dd>";
    echo "</dl><div class=\"clear-left\"></div><table width='300' cellpadding='2' cellspacing='0' border='1' style='border-collapse: collapse;'><tr>"
        ."<td id='td1' width='100' align='center'><div id='div1'></div></td>"
        ."<td id='td2' width='100' align='center'><div id='div2'></div></td>"
        ."<td id='td3' width='100' align='center'><div id='div3'>".$lang_admin['KERNEL']['PSM_NOTRATED']."</div></td>"
        ."<td id='td4' width='100' align='center'><div id='div4'></div></td>"
        ."<td id='td5' width='100' align='center'><div id='div5'></div></td>"
        ."</tr></table><div id='divTEMP'></div><p>";
    echo "".$lang_admin['KERNEL']['PSM_CLICK']." <a href=\"javascript:strengthhelp('".$currentlang."')\">".$lang_admin['KERNEL']['PSM_HERE']."</a> ".$lang_admin['KERNEL']['PSM_HELP']."";
    echo "<br />".$lang_admin['KERNEL']['CREATEUSERDATA']." <input type=\"radio\" name=\"user_new\" value=\"1\" checked />".$lang_admin['KERNEL']['YES']."&nbsp;&nbsp;<input type=\"radio\" name=\"user_new\" value=\"0\" />".$lang_admin['KERNEL']['NO']."</p>";
    echo "<div><input type=\"hidden\" name=\"fop\" value=\"create_first\" />"
        ."<input type=\"submit\" value=\"".$lang_admin['KERNEL']['SUBMIT']."\" />"
        ."</div></div></form>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    return;
}

function login() {
    global $admin_file, $db, $lang_admin;
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo '<fieldset><legend><strong>'.$lang_admin['KERNEL']['ADMIN_LOGIN_TITLE'].'</strong></legend><form method="post" action="'.$admin_file.'.php">'
        ."<br /><table border='0'>"
        ."<tr><td>".$lang_admin['KERNEL']['ADMIN_LOGIN_AID']."</td>"
        ."<td><input type='text' name='aid' size='20' maxlength='25' /></td></tr>"
        ."<tr><td>".$lang_admin['KERNEL']['ADMIN_LOGIN_PASSWORD']."</td>"
        ."<td><input type='password' name='pwd' size='20' maxlength='40' /></td></tr>";
    $gfxchk = array(1,5,6,7);
    echo security_code($gfxchk, 'large', 0, 'admin');
    echo "<tr><td colspan='2'>".$lang_admin['KERNEL']['INFO_LOGIN_PERSISTENT'].":"
        ."<input type='checkbox' name='persistent' value='1' checked='checked' />"
        ."</td></tr>";
    echo "<tr><td><br />"
        ."<input type='hidden' name='op' value='login' />"
        ."<input type='submit' value='".$lang_admin['KERNEL']['LOGIN']."' />"
        ."</td></tr></table>"
        ."</form></fieldset>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}


function adminmenu($url, $title, $image, $settings=false) {
    global $evoconfig, $adminmenucounter;

    if (!isset($adminmenucounter)) {
        $adminmenucounter = 0;
        echo "<tr>\n";
    }
    $img = '';
    if (isset($image) && (strlen($image) > 3) && $evoconfig['admingraphic']) {
        if ($settings) {
            $image = evo_image($image, 'admin/settings');
        } else {
            $image = evo_image($image, 'admin');
        }
        $img = "<img src='".$image."' border='0' width='32' height='32' alt='".$title."' title='".$title."' />";
    }
    echo "<td align='center' valign='top' width='10%'><span class='content'><a href='".$url."'>\n";
    if ($evoconfig['admin_pos']) {
        echo "<strong>".$title."</strong><br />".$img;
    } else {
        echo $img."<br /><strong>".$title."</strong>";
    }
    echo "</a><br /><br /></span></td>\n";
    if ($adminmenucounter == 5) {
        echo '</tr><tr>';
    }
    $adminmenucounter = ($adminmenucounter == 5) ? 0 : $adminmenucounter + 1;
}

function GraphicAdmin($pos=1) {
    global $db, $admin_file, $lang_admin, $adminmenucounter;
    if (is_mod_admin('super') || is_god_admin()) {
        update_modules();
        OpenTable();
        echo "<center><a href='".$admin_file.".php'><font size='3' class='title'><strong>".$lang_admin['KERNEL']['MENUE_ADMINISTRATION']."</strong></font></a>";
        echo "<br /><br /><br />";
        echo"<table border='0' width='100%' cellspacing='1'><tr>";
        $linksdir = @opendir(NUKE_ADMIN_DIR.'links');
        $menulist = array();
        $i = 0;
        while(false !== ($func = @readdir($linksdir))) {
            if(substr($func, 0, 6) == 'links.') {
                $menulist[$i]['filename'] = $func;
                $menulist[$i]['basename'] = @basename(substr($func, 9),'.php');
                $i++;
            }
        }
        @closedir($linksdir);
        sort($menulist);
        $adminmenucounter = 0;
        for ($j=0; $j < $i; $j++) {
            if(!empty($menulist[$j]['filename'])) {
                $adminpoint = (isset($menulist[$j]['basename']) ? $menulist[$j]['basename'] : 'NoLangEntry'.$j);
                if ( !isset($lang_admin[$adminpoint]['LINK_TEXT']) ) {
                    $lang_admin[$adminpoint]['LINK_TEXT'] = ucfirst($menulist[$j]['basename']);
                }
                getlinks_lang($adminpoint);
                include_once(NUKE_ADMIN_DIR.'links/'.$menulist[$j]['filename']);
            }
        }
        adminmenu($admin_file.'.php?op=logout', $lang_admin['KERNEL']['LOGOUT'], 'logout.png');
        echo"</tr></table></center>";
        CloseTable();
        echo "<br />";
    }
    OpenTable();
    echo "<center><a href='".$admin_file.".php'><font size='3' class='title'><strong>".$lang_admin['KERNEL']['MENUE_MODULEADMINISTRATION']."</strong></font></a>";
    echo "<br /><br /><br />";
    echo"<table border='0' width='100%' cellspacing='1'><tr>";
    getlinks_lang('oldmodules');
    $result = $db->sql_query("SELECT title FROM "._MODULES_TABLE." ORDER BY title ASC");
    $adminmenucounter = 0;
    while($row = $db->sql_fetchrow($result)) {
        if (is_mod_admin($row['title'])) {
            if (@file_exists(NUKE_MODULES_DIR.$row['title'].'/admin/index.php') AND @file_exists(NUKE_MODULES_DIR.$row['title'].'/admin/links.php') AND @file_exists(NUKE_MODULES_DIR.$row['title'].'/admin/case.php')) {
                include_once(NUKE_MODULES_DIR.$row['title'].'/admin/links.php');
            }
        }
    }
    $db->sql_freeresult($result);
    adminmenu($admin_file.'.php?op=logout', $lang_admin['KERNEL']['LOGOUT'], 'logout.png');
    echo"</tr></table></center>";
    CloseTable();
    echo '<br />';
    return;
}


function getadmin_lang ($adminpoint) {
    global $currentlang, $lang_admin;

    if (@file_exists(NUKE_ADMIN_DIR . 'language/lang_'.$currentlang.'/lang_'.$adminpoint.'.php')) {
        include_once(NUKE_ADMIN_DIR . 'language/lang_'.$currentlang.'/lang_'.$adminpoint.'.php');
    } else if (@file_exists(NUKE_ADMIN_DIR . 'language/lang_english/lang_'.$adminpoint.'.php')) {
        include_once(NUKE_ADMIN_DIR . 'language/lang_english/lang_'.$adminpoint.'.php');
    } else {
        DisplayError("<span style='color: red; font-size: 24px;'>No Language File found for getadmin: $adminpoint</span>");
    }
}

function getmodule_lang ($adminpoint) {
    global $currentlang, $lang_admin, $module_name, $lang_new;

    // The first test, if it's a modul inside Administration
    if (@file_exists(NUKE_ADMIN_DIR . 'language/lang_'.$currentlang.'/modules/lang_'.$adminpoint.'.php')) {
        include_once(NUKE_ADMIN_DIR . 'language/lang_'.$currentlang.'/modules/lang_'.$adminpoint.'.php');
    } else if (@file_exists(NUKE_ADMIN_DIR . 'language/modules/lang_english/lang_'.$adminpoint.'.php')) {
        include_once(NUKE_ADMIN_DIR . 'language/modules/lang_english/lang_'.$adminpoint.'.php');
    //Second is to test, of it's an "old" Module with language file inside admin directory
    } else if (@file_exists(NUKE_MODULES_DIR . $adminpoint.'/admin/language/lang-'.$currentlang.'.php')) {
        include_once(NUKE_MODULES_DIR . $adminpoint.'/admin/language/lang-'.$currentlang.'.php');
    } else if (@file_exists(NUKE_MODULES_DIR . $adminpoint.'/admin/language/lang-english.php')) {
        include_once(NUKE_MODULES_DIR . $adminpoint.'/admin/language/lang-english.php');
    //Third is to test if it's a new module (only one language dir and $lang Variables
    } else if (@file_exists(NUKE_MODULES_DIR . $adminpoint .'/language/lang-'.$currentlang.'.php')) {
        include_once(NUKE_MODULES_DIR . $adminpoint .'/language/lang-'.$currentlang.'.php');
    } else if (@file_exists(NUKE_MODULES_DIR . $adminpoint .'/language/lang-english.php')) {
        include_once(NUKE_MODULES_DIR . $adminpoint .'/language/lang-english.php');
    } else {
        DisplayError("<span style='color: red; font-size: 24px;'>No Language File found for getmodule: $adminpoint</span>");
    }
}

function getlinks_lang ($adminpoint) {
    global $currentlang, $lang_admin;

    if (@file_exists(NUKE_ADMIN_DIR . 'language/lang_'.$currentlang.'/links/lang_'.$adminpoint.'.php')) {
        include_once(NUKE_ADMIN_DIR . 'language/lang_'.$currentlang.'/links/lang_'.$adminpoint.'.php');
    } else if (@file_exists(NUKE_ADMIN_DIR . 'language/linkss/lang_english/lang_'.$adminpoint.'.php')) {
        include_once(NUKE_ADMIN_DIR . 'language/linkss/lang_english/lang_'.$adminpoint.'.php');
    }
}
?>