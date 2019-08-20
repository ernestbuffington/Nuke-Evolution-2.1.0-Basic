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

if (!defined('NUKESENTINEL_ADMIN')) {
   die ('You can\'t access this file directly...');
}

global $_GETVAR, $admin_file, $evoconfig, $db;

if(is_god_admin()) {
    $importnamed = $exportnamed = '';
    $importadded = $exportadded = 0;
    $importad = $db->sql_query("SELECT `aid`, `name`, `pwd` FROM `"._AUTHOR_TABLE."`");
    while(list($a_aid, $a_name, $a_pwd) = $db->sql_fetchrow($importad)) {
        $adminrow = $db->sql_unumrows("SELECT `aid` FROM `"._SENTINEL_ADMINS_TABLE."` WHERE `aid`='$a_aid'");
        if($adminrow == 0) {
            $importadded++;
            if($importnamed == '') {
                $importnamed = $a_aid;
            } else {
                $importnamed = $importnamed.', '.$a_aid;
            }
            $makepass = "";
            $strs = "abc2def3ghj4kmn5opq6rst7uvw8xyz9";
            for($x=0; $x < 20; $x++) {
                mt_srand ((double) microtime() * 1000000);
                $str[$x] = substr($strs, mt_rand(0, strlen($strs)-1), 1);
                $makepass = $makepass.$str[$x];
            }
            $xpassword_md5 = md5($makepass);
            $xpassword_crypt = crypt($makepass);
            if(strtolower($a_name) == 'god') {
                $is_god = 1;
            } else {
                $is_god = 0;
            }
            $result = $db->sql_uquery("INSERT INTO `"._SENTINEL_ADMINS_TABLE."` (`aid`, `login`, `protected`, `password`, `password_md5`, `password_crypt`) VALUES ('$a_aid', '$a_aid', '$is_god', '$makepass', '$xpassword_md5', '$xpassword_crypt')");
            $db->sql_uquery("OPTIMIZE TABLE `"._AUTHOR_TABLE."`");
            $aidrow   = $db->sql_ufetchrow("SELECT * FROM `"._SENTINEL_ADMINS_TABLE."` WHERE `aid`='$a_aid' LIMIT 0,1");
            $subject  = _AB_ACCESSFOR." ".$evoconfig['sitename'];
            $message  = _AB_HTTPONLY."\n";
            $message .= _AB_LOGIN.': '.$aidrow['login']."\n";
            $message .= _AB_PASSWORD.': '.$aidrow['password']."\n";
            $message .= _AB_PROTECTED.': ';
            if ( !$aidrow['protected']) {
                $message .= _AB_NO."\n";
            } else {
                $message .= _AB_YES."\n";
            }
            $return = evo_mail($aidrow['email'], $subject, $message);
        }
    }
    $db->sql_freeresult($importad);
    $exportad = $db->sql_query("SELECT `aid` FROM `"._SENTINEL_ADMINS_TABLE."`");
    while(list($a_aid) = $db->sql_fetchrow($exportad)) {
        $adminrow = $db->sql_unumrows("SELECT `aid` FROM `"._AUTHOR_TABLE."` WHERE `aid`='$a_aid' LIMIT 0,1");
        if($adminrow == 0) {
            $exportadded++;
            if($exportnamed == '') {
                $exportnamed = $a_aid;
            } else {
                $exportnamed = $exportnamed.', '.$a_aid;
            }
            $db->sql_uquery("DELETE FROM `"._SENTINEL_ADMINS_TABLE."` WHERE `aid`='$a_aid' LIMIT 1");
            $db->sql_uquery("OPTIMIZE TABLE `"._SENTINEL_ADMINS_TABLE."`");
      }
    }
    $db->sql_freeresult($exportad);
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    OpenMenu(_AB_SCANADMINS);
    mastermenu();
    CarryMenu();
    authmenu();
    CloseMenu();
    CloseTable();
    echo '<br />'."\n";
    OpenTable();
    echo '<center><strong>'._AB_SCANADMINSDONE.'</strong></center><br />'."\n";
    echo '<center><strong>'._AB_ADMINSADDED.':</strong> '.$importadded;
    if ($importnamed > '') {
        echo ' ('.$importnamed.')';
    }
    echo '<br/>'."\n";
    echo '<strong>'._AB_ADMINSREMOVED.':</strong> '.$exportadded;
    if ($exportnamed > '') {
        echo ' ('.$exportnamed.')';
    }
    echo '</center><br />'."\n";
    echo '<center><a href="'.$admin_file.'.php?op=ABAuthList">'._AB_LISTHTTPAUTH.'</a></center>'."\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    redirect($admin_file.'.php?op=ABMain');
}
?>
