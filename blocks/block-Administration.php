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

if(!defined('NUKE_EVO')) exit;

if (is_admin()) {
    global $db, $admin_file, $currentlang;

    $content = "<p style='text-align: center; font-weight: bold; font-style: italic;'>"._ADMIN_BLOCK_TITLE.":</p>";

    $links = array(
        // Admin [Nuke-Evo]
        _ADMIN_BLOCK_NUKE => $admin_file.'.php',
        // Admin [Forums]
        _ADMIN_BLOCK_FORUMS => $admin_file.'.php?op=forums',
        // Line Break
        'BREAK1' => '<hr />',
        // Cache
        _CACHE_ADMIN => $admin_file.'.php?op=cache',
        // Blocks
        _ADMIN_BLOCK_BLOCKS => $admin_file.'.php?op=blocks',
        // Modules
        _ADMIN_BLOCK_MODULES => $admin_file.'.php?op=modules',
        // Settings
        _ADMIN_BLOCK_SETTINGS => $admin_file.'.php?op=show',
        // Themes
        _THEMES => $admin_file.'.php?op=themes',
        // Line Break
        'BREAK2' => '<hr />',
        // Downloads
        _ADMIN_BLOCK_DOWNLOADS => $admin_file.'.php?op=Downloads',
        // Evolution UserInfo Block
        _ADMIN_BLOCK_EVO_USER => $admin_file.'.php?op=evo-userinfo',
        // Messages
        _ADMIN_BLOCK_MSGS => $admin_file.'.php?op=messages',
        // Module Block Admin
        _ADMIN_BLOCK_MODULE_BLOCK => $admin_file.'.php?op=modules&amp;area=block',
        // Nuke Sentinel
        _AB_NUKESENTINEL => $admin_file.'.php?op=ABMain',
        // News
        _ADMIN_BLOCK_NEWS => $admin_file.'.php?op=adminStory',
        // Reviews
        _ADMIN_BLOCK_REVIEWS => $admin_file.'.php?op=Reviews',
        // CNBYA
        _ADMIN_BLOCK_CNBYA => $admin_file.'.php?op=Your_Account',
        // Web Links
        _ADMIN_BLOCK_WEBLINKS => $admin_file.'.php?op=Links',
        // Line Break
        'BREAK3' => '<hr />',
        // Clear Cache
        _CACHE_CLEAR => $admin_file.'.php?op=cache_clear',
        // Error Log
        _ADMIN_BLOCK_ERRORLOG => $admin_file.'.php?op=viewadminlog&amp;log=error',
        // System Info
        _ADMIN_BLOCK_SYSTEMINFO => $admin_file.'.php?op=info',
        // Logout
        _ADMIN_BLOCK_LOGOUT => $admin_file.'.php?op=logout',
    );

    if (is_array($links)) {
        foreach($links as $text => $link) {
            if ($link != '<hr />') {
                $content .= "<img src='". evo_image('arrow.png', 'blocks/modules')."' border='0' alt='' />&nbsp;<a href='" . $link . "'>".$text."</a><br />";
            } else {
                $content .= $link;
            }
        }
    }

} else {
    global $admin_file;
    $content ="<span style='text-align: center; font-weight: bold;'>"._ADMIN_BLOCK_LOGIN."</span><br />";
    $content .= "<form action='".$admin_file.".php' method='post'>";
    $content .= "<span style='text-align: center;'>"._ADMIN_ID."&nbsp;<input type='text' name='aid' size='8' maxlength='25' /><br />";
    $content .= _ADMIN_PASS."&nbsp;<input type='password' name='pwd' size='8' maxlength='40' /></span><br />";
    $gfxchk = array(1,5,6,7);
    $content .= "<p style='margin-left: auto; margin-right: auto; text-align:center; width: 100%;'>".security_code($gfxchk)."</p>";
    $content .= "<input type='hidden' name='op' value='login' />";
    $content .= "<input type='submit' value='"._LOGIN."' />";
    $content .= "</form>";
}

?>