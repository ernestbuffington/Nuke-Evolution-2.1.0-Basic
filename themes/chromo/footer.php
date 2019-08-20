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

global $theme_name;

echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
echo "  <tr>\n";
echo "    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
echo "      <tr>\n";
echo "        <td width='57' height='17'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/foot_01.gif' alt='' width='57' height='17' /></td>\n";
echo "        <td style='background-image: url(".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/foot_02_tile.gif)'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/spacer.gif' alt='' width='1' height='1' /></td>\n";
echo "        <td width='57' height='17'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/foot_03.gif' alt='' width='57' height='17' /></td>\n";
echo "      </tr>\n";
echo "    </table>\n";
echo "      <table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
echo "        <tr>\n";
echo "          <td width='31' height='36'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/foot_04.gif' alt='' width='31' height='36' /></td>\n";
echo "          <td style='background-image: url(".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/foot_05_tile.gif)'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/spacer.gif' alt='' width='1' height='1' /></td>\n";
echo "          <td width='31'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/foot_06.gif' alt='' width='31' height='36' /></td>\n";
echo "        </tr>\n";
echo "      </table>\n";
echo "      <table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
echo "        <tr>\n";
echo "          <td width='31' height='16'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/foot_07.gif' alt='' width='31' height='16' /></td>\n";
echo "          <td width='190'><a href='http://www.evo-german.com' target='_blank'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/foot_08_evopower.gif' alt='Powered by Evo CMS' width='190' height='16' border='0' title='Evo-CMS site engine' /></a></td>\n";
echo "          <td style='background-image: url(".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/foot_09_tile.gif)'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/spacer.gif' alt='' width='1' height='1' /></td>\n";
echo "          <td width='195'><a href='http://effectica.com' target='_blank'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/foot_10_effpower.gif' alt='theme designed by effectica.com' width='195' height='16' border='0' title='".$theme_name." theme by effectica' /></a></td>\n";
echo "          <td width='31'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/foot_11.gif' alt='' width='31' height='16' /></td>\n";
echo "        </tr>\n";
echo "      </table>\n";
echo "      <table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
echo "        <tr>\n";
echo "          <td width='31' height='2'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/foot_12.gif' alt='' width='31' height='2' /></td>\n";
echo "          <td style='background-image: url(".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/foot_13_tile.gif)'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/spacer.gif' alt='' width='1' height='1' /></td>\n";
echo "          <td width='31'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/foot_14.gif' alt='' width='31' height='2' /></td>\n";
echo "        </tr>\n";
echo "      </table>\n";
echo "      <table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
echo "        <tr>\n";
echo "          <td width='31' height='16'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/foot_15.gif' alt='' width='31' height='16' /></td>\n";
echo "          <td width='146'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/foot_16.gif' alt='' width='146' height='16' /></td>\n";
echo "          <td style='background-image: url(".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/foot_17_tile.gif)'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/spacer.gif' alt='' width='1' height='1' /></td>\n";
echo "          <td width='31'><img src='".NUKE_THEMES_IMAGE_DIR.$theme_name."/images/foot_18.gif' alt='' width='31' height='16' /></td>\n";
echo "        </tr>\n";
echo "      </table>\n";
echo "  </td>\n";
echo "  </tr>\n";
echo "</table>";
echo "<div style='font-size: xx-small;' align='center'>\n";
// Bottom banner
echo ads(2);
footmsg();
echo "</div>";

?>