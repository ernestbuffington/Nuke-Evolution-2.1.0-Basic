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

global $db, $admin_file, $_GETVAR, $cache;
$module_name = basename(dirname(dirname(__FILE__)));

get_lang($module_name);

if(is_mod_admin($module_name)) {

    define('NUKE_DONATIONS', dirname(dirname(__FILE__)) . '/');
    define('NUKE_DONATIONS_INCLUDES', NUKE_DONATIONS . '/includes/');
    define('NUKE_DONATIONS_ADMIN', dirname(__FILE__) . '/');
    define('NUKE_DONATIONS_ADMIN_INCLUDES', NUKE_DONATIONS_ADMIN . 'includes/');

    include_once(NUKE_DONATIONS_ADMIN_INCLUDES . 'base.php');
    include_once(NUKE_DONATIONS_INCLUDES . 'base.php');

    $file = $_GETVAR->get('file', '_GET');
    $page = $_GETVAR->get('page', '_GET', 'int');
    if (!empty($file)){
        //Look for . / \ and kick it out
        if (preg_match('/.*?(\/|\.|\\\)/i',$file)) {
            DisplayError($lang_donate['ACCESS_DENIED']);
        }
    }

    function Main($file) {
        global $lang_donate, $page;
        head_open($lang_donate['DONATIONS']);
        config_select();
        if(!empty($file)) {
            if(@file_exists(NUKE_DONATIONS_ADMIN_INCLUDES.$file.'.php')){
                @include_once(NUKE_DONATIONS_ADMIN_INCLUDES.$file.'.php');
            }
        }
        foot_close();
    }

    $id = null;
    if (!empty($_GET['delete'])) {
        $id = $_GETVAR->get('delete', 'GET', 'int');
        if (!empty($id)) {
            $sql = 'DELETE FROM `'._DONATIONS_DONATOR_TABLE.'` WHERE `id`='.$id;
            $db->sql_query($sql);
            $cache->delete('donations', 'donations');
            $cache->delete('donations_goal', 'donations');
            redirect($admin_file.".php?op=Donations&file=current");
            die();
        }
    }

    if (empty($id)) {
        Main($file);
    }

} else {
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . _ADMIN_NO_MODULE_RIGHTS . $module_name);
}

?>