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

global $admin_file, $ab_config;

if (is_god_admin()) {

    $pagetitle = _AB_NUKESENTINEL.": "._AB_CGIAUTHSETUP;
    include_once(NUKE_BASE_DIR.'header.php');
    title($pagetitle);
    OpenTable();
    $rp = strtolower(str_replace('index.php', '', realpath('index.php')));
    $staccess = str_replace($rp, "", $ab_config['staccess_path']);
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
    echo '<tr>'."\n";
    echo '<td>'."\n";
    echo _AB_SAVEIN.' <strong>'.$ab_config['htaccess_path'].' :</strong><br /><br />'."\n";
    echo '<textarea rows="19" cols="44" readonly="readonly" style="font-family:Courier New;">'."\n";
    echo '#-------------------------------------------'."\n";
    echo '# Start of NukeSentinel(tm) '.$admin_file.'.php Auth'."\n";
    echo '#-------------------------------------------'."\n";
    echo '&lt;Files '.$staccess.'&gt;'."\n";
    echo '  deny from all'."\n";
    echo '&lt;/Files&gt;'."\n";
    echo "\n";
    echo '&lt;Files '.$admin_file.'.php&gt;'."\n";
    echo '  &lt;Limit GET POST PUT&gt;'."\n";
    echo '    require valid-user'."\n";
    echo '  &lt;/Limit&gt;'."\n";
    echo '  AuthName "Restricted by NukeSentinel(tm)"'."\n";
    echo '  AuthType Basic'."\n";
    echo '  AuthUserFile '.$ab_config['staccess_path']."\n";
    echo '&lt;/Files&gt;'."\n";
    echo '#-------------------------------------------'."\n";
    echo '# End of NukeSentinel(tm) '.$admin_file.'.php Auth'."\n";
    echo '#-------------------------------------------</textarea>'."\n";
    echo '</td>'."\n";
    echo '</tr>'."\n";
    echo '</table>'."\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    redirect($admin_file.'.php?op=ABMain');
}
?>