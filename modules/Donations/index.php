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

global $_GETVAR;
$_GETVAR->unsetVariables();

$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$pagetitle = $lang_donate['DONATIONS'];

define('NUKE_DONATIONS', dirname(__FILE__) . '/');
define('NUKE_DONATIONS_INCLUDES', NUKE_DONATIONS . 'includes/');

include_once(NUKE_DONATIONS_INCLUDES . 'base.php');

function donation_index() {
    global $lang_donate, $module_name;
    title($lang_donate['DONATIONS'], $module_name, 'donations-logo.png');
    OpenTable();
    echo "<table width=\"100%\">";
    echo "<tr>\n<td width=\"35%\"></td><td width=\"10%\" align=\"center\"><a href=\"modules.php?name=Donations&amp;op=view\"><img src=\"".evo_image('view.png', $module_name)."\" width=\"32\" height=\"32\" border=\"0\" alt=\"".$lang_donate['VIEW_DONATIONS']."\" /><br />".$lang_donate['VIEW_DONATIONS']."</a></td>\n";
    echo "<td width=\"10%\"></td><td width=\"10%\" align=\"center\"><a href=\"modules.php?name=Donations&amp;op=make\"><img src=\"".evo_image('money.png', $module_name)."\" width=\"32\" height=\"32\" border=\"0\" alt=\"".$lang_donate['MAKE_DONATIONS']."\" /><br />".$lang_donate['MAKE_DONATIONS']."</a></td>\n";
    echo "<td width=\"35%\"></td></tr>\n</table>\n";
    CloseTable();
}

global $more_js;
$more_js[] = '<script type="text/javascript">
function createCookie(name, value, days)
{
  if (days) {
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
    }
  else var expires = "";
  document.cookie = name+"="+value+expires+";";
}
function donationcookie() {
   createCookie("DONATION", "1", 1);
}
</script>';

$op = $_GETVAR->get('op', 'REQUEST');

include_once(NUKE_BASE_DIR.'header.php');
switch ($op) {
    case 'thankyou':
        include_once(NUKE_DONATIONS_INCLUDES . 'thankyou.php');
    break;
    case 'cancel':
        include_once(NUKE_DONATIONS_INCLUDES . 'cancel.php');
    break;
    case 'make':
        include_once(NUKE_DONATIONS_INCLUDES . 'make.php');
    break;
    case 'view':
        include_once(NUKE_DONATIONS_INCLUDES . 'view.php');
    break;
    case 'confirm':
        include_once(NUKE_DONATIONS_INCLUDES . 'confirm.php');
    break;
    default:
        donation_index();
    break;
}
include_once(NUKE_BASE_DIR.'footer.php');

?>