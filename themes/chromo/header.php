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

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }

global $ThemeInfo, $theme_name;

echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
echo "  <tr>\n";
echo "    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
echo "      <tr>\n";
echo "        <td width='72' height='34'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/bnr_01.gif' alt='' width='72' height='34' /></td>\n";
echo "        <td width='51'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/bnr_02.gif' alt='' width='51' height='34' /></td>\n";
echo "        <td style='background-image: url(".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/bnr_03_tile.gif)'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/spacer.gif' alt='' width='1' height='1' /></td>\n";
echo "        <td width='51'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/bnr_04.gif' alt='' width='51' height='34' /></td>\n";
echo "        <td width='72' height='34'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/bnr_05.gif' alt='' width='72' height='34' /></td>\n";
echo "      </tr>\n";
echo "    </table>\n";
echo "      <table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
echo "        <tr>\n";
echo "          <td width='61' height='98'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/bnr_06.jpg' alt='' width='61' height='98' /></td>\n";
echo "          <td width='317'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/bnr_07_logo.jpg' alt='".EVO_SERVER_SITENAME."' width='317' height='98' /></td>\n";
$ads = ads(0);
if(empty($ads)) {
    echo "          <td style='background-image: url(".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/bnr_08_tile.gif)'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/spacer.gif' alt='' width='1' height='1' /></td>\n";
} else {
    echo "          <td style='background-image: url(".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/bnr_08_tile.gif)'>$ads</td>\n";
}
echo "          <td width='62'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/bnr_09.gif' alt='' width='62' height='98' /></td>\n";
echo "          <td width='61'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/bnr_10.jpg' alt='' width='61' height='98' /></td>\n";
echo "        </tr>\n";
echo "      </table>\n";
echo "      <table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
echo "        <tr>\n";
echo "          <td width='72' height='34'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/bnr_11.gif' alt='' width='72' height='34' /></td>\n";
echo "          <td style='background-image: url(".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/bnr_12_tile.gif)'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/spacer.gif' alt='' width='1' height='1' /></td>\n";
echo "          <td width='72'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/bnr_13.gif' alt='' width='72' height='34' /></td>\n";
echo "        </tr>\n";
echo "      </table>\n";
echo "      <table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
echo "        <tr>\n";
echo "          <td width='91' height='46'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/bnr_14.jpg' alt='' width='91' height='46' /></td>\n";
echo "          <td style='background-image: url(".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/bnr_14_tile.jpg)'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/spacer.gif' alt='' width='1' height='1' /></td>\n";
echo "          <td width='478'>\n";
echo "      <object type='application/x-shockwave-flash' data='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/bnrnav.swf?link1=" . urlencode($ThemeInfo['link1']) . "&amp;link1text=" . urlencode($ThemeInfo['link1text']) . "&amp;link2=" . urlencode($ThemeInfo['link2']) . "&amp;link2text=" . urlencode($ThemeInfo['link2text']) . "&amp;link3=" . urlencode($ThemeInfo['link3']) . "&amp;link3text=" . urlencode($ThemeInfo['link3text']) . "&amp;link4=" . urlencode($ThemeInfo['link4']) . "&amp;link4text=" . urlencode($ThemeInfo['link4text']) . "' width='478' height='46'>\n";
echo "      <param name='movie' value='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/bnrnav.swf?link1=" . urlencode($ThemeInfo['link1']) . "&amp;link1text=" . urlencode($ThemeInfo['link1text']) . "&amp;link2=" . urlencode($ThemeInfo['link2']) . "&amp;link2text=" . urlencode($ThemeInfo['link2text']) . "&amp;link3=" . urlencode($ThemeInfo['link3']) . "&amp;link3text=" . urlencode($ThemeInfo['link3text']) . "&amp;link4=" . urlencode($ThemeInfo['link4']) . "&amp;link4text=" . urlencode($ThemeInfo['link4text']) . "' />\n";
echo "      <param name='quality' value='high' />";
echo "      <param name='scale' value='noborder' /> <param name='wmode' value='transparent' /> <param name='bgcolor' value='#000000' />";
echo "      </object>";
echo "          </td>\n";
echo "          <td style='background-image: url(".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/bnr_14_tile.jpg)'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/spacer.gif' alt='' width='1' height='1' /></td>\n";
echo "          <td width='86'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/bnr_17.jpg' width='86' height='46' alt='' /></td>\n";
echo "        </tr>\n";
echo "      </table>\n";
echo "  </td>\n";
echo "  </tr>\n";
echo "</table>";

?>