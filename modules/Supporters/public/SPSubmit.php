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
   die('You can\'t access this file directly...');
}

if($supporter_config['require_user'] == 0 || is_user()) {
    $pagetitle  = $lang_new[$module_name]['SP_ADDSUPPORTER'];
    $sip = identify::get_ip();
    include_once(NUKE_BASE_DIR.'header.php');
    title($lang_new[$module_name]['SP_ADDSUPPORTER'], $module_name, 'supporter-logo.png');
    OpenTable();
    echo "<center><strong>".$lang_new[$module_name]['SP_ALLREQ']."</strong><br />\n";
    if(is_mod_admin($module_name)) {
        echo "<center>[ <a href='".$admin_file.".php?op=SPMain'>".$lang_new[$module_name]['SP_GOTOADMIN']."</a> ]\n";
    }
    echo "<br /><br />";
    echo "<table border='0'>\n";
    echo "<form name='addsupporter' action='modules.php?name=$module_name' method='post' enctype='multipart/form-data'>\n";
    echo "<input type='hidden' name='op' value='SPSubmitSave' />\n";
    echo "<input type='hidden' name='user_id' value='".$userinfo['user_id']."' />\n";
    echo "<input type='hidden' name='user_name' value='".$userinfo['username']."' />\n";
    echo "<input type='hidden' name='user_email' value='".$userinfo['user_email']."' />\n";
    echo "<input type='hidden' name='user_ip' value='".$sip."' />\n";
    echo "<tr><td><strong>".$lang_new[$module_name]['SP_NAME'].":</strong></td><td><input type='text' name='site_name' size='75' /></td></tr>\n";
    echo "<tr><td><strong>".$lang_new[$module_name]['SP_URL'].":</strong></td><td><input type='text' name='site_url' size='75' value='http://' /></td></tr>\n";
    if($supporter_config['image_type']==0) {
        $type = "type='input'";
    } else {
        $type = "type='file'";
    }
    echo "<tr><td valign='top'><strong>".$lang_new[$module_name]['SP_IMAGE'].":</strong></td><td><input $type name='site_image' size='75' />";
    echo "<br />".$lang_new[$module_name]['SP_MUSTBE'];
    if($supporter_config['image_type'] == 0) {
        echo "<br />".$lang_new[$module_name]['SP_IMAGETYPE0'];
    } else {
        echo "<br />".$lang_new[$module_name]['SP_IMAGETYPE1'];
    }
    echo "</td></tr>\n";
    echo "<tr><td valign='top'><strong>".$lang_new[$module_name]['SP_DESCRIPTION'].":</strong></td><td>";
    echo Make_TextArea('site_description', '','addsupporter');
    echo "</td></tr>\n";
    if (is_user()) {
        echo "<tr><td><strong>".$lang_new[$module_name]['SP_YOURNAME'].":</strong></td><td>".$userinfo['username']."</td></tr>\n";
        echo "<tr><td><strong>".$lang_new[$module_name]['SP_YOUREMAIL'].":</strong></td><td>".$userinfo['user_email']."</td></tr>\n";
        echo "<tr><td><strong>".$lang_new[$module_name]['SP_YOURIP'].":</strong></td><td>".$sip."</td></tr>\n";
    } else {        
        echo "<tr><td><strong>".$lang_new[$module_name]['SP_YOURNAME'].":</strong></td><td><input type='text' name='user_name' size='75' value='".$userinfo['username']."' /></tr></td>";
        echo "<tr><td><strong>".$lang_new[$module_name]['SP_YOUREMAIL'].":</strong></td><td><input type='text' name='user_email' size='75' value='' /></tr></td>";
        echo "<tr><td><strong>".$lang_new[$module_name]['SP_YOURIP'].":</strong></td><td>".$sip."</td></tr>\n";
    }
    echo "<input type='hidden' name='comefrom' value='index.php' />\n";
    echo "<tr><td align='center' colspan='2'><input type='submit' value='".$lang_new[$module_name]['SP_SUBMITSITE']."' /></td></tr>\n";
    echo "</form></table></center>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    redirect('modules.php?name='.$module_name);
}

?>