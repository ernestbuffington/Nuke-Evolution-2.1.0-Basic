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

$theme_name = basename(dirname(__FILE__));
global $currentlang, $evoconfig, $ThemeInfo;

if ( strlen($evoconfig['default_lang']) < 1 ) {
    $evoconfig['default_lang'] = 'english';
}

/************************************************************/
/* Theme Default Definitions                                */
/************************************************************/
$ThemeInfo   = LoadThemeInfo($theme_name);
$ThemeImgDir = NUKE_THEMES_IMAGE_DIR.$theme_name.'/images/';

/************************************************************/
/* Theme Colors Definition                                  */
/************************************************************/
// please be aware, that for future versions this variables are depreciated.
// Use ThemeInfo Array
$gfxcolor  = "#00aa50";


/************************************************************/
/* OpenTable Functions                                      */
/************************************************************/
function OpenTable() {
    global $theme_name, $ThemeImgDir;

    echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
    echo "  <tr>\n";
    echo "    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
    echo "      <tr>\n";
    echo "        <td width='57' height='47'><img src='".$ThemeImgDir."new_01.gif' alt='' width='57' height='47' /></td>\n";
    echo "        <td style='background-image: url(".$ThemeImgDir."new_02_tile.gif)'><img src='".$ThemeImgDir."spacer.gif' alt='' width='1' height='1' /></td>\n";
    echo "        <td width='57' height='47'><img src='".$ThemeImgDir."new_03.gif' alt='' width='57' height='47' /></td>\n";
    echo "      </tr>\n";
    echo "    </table>\n";
    echo "      <table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
    echo "        <tr>\n";
    echo "          <td width='10' style='background-image: url(".$ThemeImgDir."new_04_bl.gif)'><img src='".$ThemeImgDir."spacer.gif' alt='' width='1' height='1' /></td>\n";
    echo "          <td style='background-color: #E6E6E6;'>";
}

function OpenTable2() {
    echo "<table border='0' cellspacing='1' cellpadding='0' align='center'><tr><td class='extras'>\n";
    echo "<table border='0' cellspacing='1' cellpadding='8' ><tr><td>\n";
}

function CloseTable() {
    global $theme_name, $ThemeImgDir;
    echo "</td>\n";
    echo "          <td width='10' style='background-image: url(".$ThemeImgDir."new_05_br.gif)'><img src='".$ThemeImgDir."spacer.gif' alt='' width='1' height='1' /></td>\n";
    echo "        </tr>\n";
    echo "      </table>\n";
    echo "      <table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
    echo "        <tr>\n";
    echo "          <td width='57' height='38'><img src='".$ThemeImgDir."new_06.gif' alt='' width='57' height='38' /></td>\n";
    echo "          <td style='background-image: url(".$ThemeImgDir."new_07_tile.gif)'><img src='".$ThemeImgDir."spacer.gif' alt='' width='1' height='1' /></td>\n";
    echo "          <td width='57'><img src='".$ThemeImgDir."new_08.gif' alt='' width='57' height='38' /></td>\n";
    echo "        </tr>\n";
    echo "      </table>\n";
    echo "  </td>\n";
    echo "  </tr>\n";
    echo "</table>";

}

function CloseTable2() {
    echo "</td></tr></table></td></tr></table>\n";
}

/************************************************************/
/* Function themeheader()                                   */
/************************************************************/
function themeheader() {
    global $theme_name, $ThemeImgDir;

    echo "<body lang='"._LANGCODE."'>\n";
    if (function_exists('networkbar')) {
        networkbar();
    }

    include_once(NUKE_THEMES_DIR.$theme_name.'/header.php');

    echo "\n<table width='100%' cellpadding='0' cellspacing='0' border='0' align='center'>\n";
    echo "        <tr valign='top'>\n";
    echo "        <td style='width: 36px; background-image: url(".$ThemeImgDir."bord_l.gif)' valign='top'><img src='".$ThemeImgDir."spacer.gif' width='36' height='1' border='0' alt='' /></td>\n";
    echo "        <td valign='top'>\n";

    if(blocks_visible('left')) {
        blocks('left');
        echo "    </td>\n";
        echo " <td style='width: 10px;' valign ='top'><img src='".$ThemeImgDir."spacer.gif' alt='' width='10' height='1' border='0' /></td>\n";
        echo " <td width='100%'>\n";
    } else {
        echo "    </td>\n";
        echo " <td style='width: 1px;' valign ='top'><img src='".$ThemeImgDir."spacer.gif' alt='' width='1' height='1' border='0' /></td>\n";
        echo " <td width='100%'>\n";
    }
}

/************************************************************/
/* Function themefooter()                                   */
/************************************************************/
function themefooter() {
    global $theme_name, $ThemeImgDir;

    // Banner in the middle of the site

    if (blocks_visible('right') && !defined('ADMIN_FILE')) {
        echo "</td>\n";
        echo "        <td style='width: 10px;' valign='top'><img src='".$ThemeImgDir."spacer.gif' alt='' width='15' height='1' /></td>\n";
        echo "       <td style='width: 168px;' valign='top'>\n";
        blocks('right');
    }
    echo "        </td>\n";
    echo "        <td style='width: 36px; background-image: url(".$ThemeImgDir."bord_r.gif)' valign='top'><img src='".$ThemeImgDir."spacer.gif' alt=''  width='36' height='1' /></td>\n";
    echo "        </tr>\n";
    echo "</table>\n\n\n";

    include_once(NUKE_THEMES_DIR.$theme_name."/footer.php");

}

/************************************************************/
/* Function themeindex()                                    */
/* This function format the stories on the Homepage         */
/************************************************************/
function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext, $informantwrites) {
    global $theme_name, $ThemeImgDir;

    if(!empty($topicimage)) {
        $t_image   = @evo_image(@basename($topicimage), 'Topics');
        $topic_img = "<a href='modules.php?name=News&amp;new_topic=".$topic."'><img src='".$t_image."' border='0' alt='".$topictext."' title='".$topictext."'/></a>\n";
    } else {
        $topic_img = '';
    }
    if (!empty($notes)) {
        $notes = "<span style='font-weight:bold;'>"._NOTE."</span>&nbsp;".$notes."\n";
    } else {
        $notes = '';
    }
    if(!$informantwrites) {
        $infowrites = _POSTEDBY.':&nbsp;';
        if(is_array($informant)) {
            $infowrites .= "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$informant[0]."\">".$informant[1]."</a>";
        } else {
            $infowrites .= "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$informant."\">".$informant."</a>";
        }
        $infowrites .= '&nbsp;'._ON.'&nbsp;'.$time;
    } else {
        $infowrites = '';
    }
    $topictext = "<span style='font-size:smaller;font-weight:bold;'>".$topictext."</span>";
    $title     = "<span style='font-size:smaller;font-weight:bold;'>".$title."</span>";
    $content   = "<br />".$thetext."<br /><br />".$notes;
    echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
    echo "  <tr>\n";
    echo "    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
    echo "      <tr>\n";
    echo "        <td width='57' height='47'><img src='".$ThemeImgDir."new_01.gif' alt='' width='57' height='47' /></td>\n";
    echo "        <td align='center' style='background-image: url(".$ThemeImgDir."new_02_tile.gif)'><a href='modules.php?name=News&amp;new_topic=".$topic."'>\n";
    echo            $topictext."</a>&nbsp;:&nbsp;".$title."</td>\n";
    echo "        <td width='57' height='47'><img src='".$ThemeImgDir."new_03.gif' alt='' width='57' height='47' /></td>\n";
    echo "      </tr>\n";
    echo "    </table>\n";
    echo "      <table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
    echo "        <tr>\n";
    echo "          <td width='10' style='background-image: url(".$ThemeImgDir."new_04_bl.gif)'><img src='".$ThemeImgDir."spacer.gif' alt='' width='1' height='1' /></td>\n";
    echo "          <td style='background-color: #E6E6E6;'><table border='0' cellpadding='0' cellspacing='0' width='100%' align='center'>\n";
    echo "            <tr>\n";
    echo "              <td><table border='0' cellpadding='4' cellspacing='0' width='100%'>\n";
    echo "                  <tr>\n";
    echo "                      <td class='extra' width='15%' align='center'>\n".$topic_img."</td>\n";
    echo "                      <td class='extra' width='85%'>\n";
    echo "                          <div class='content'>".$content."</div><br />\n";
    echo "                      </td>\n";
    echo "                  </tr>\n";
    echo "              </table></td>\n";
    echo "            </tr>\n";
    echo "            <tr>\n";
    echo "              <td class='extra'>\n";
    echo "                  <table border='0' cellpadding='4' cellspacing='0' width='100%'>\n";
    echo "                    <tr>\n";
    echo "                      <td align='left' width='50%'><span class='option'>".$infowrites."</span></td>\n";
    echo "                      <td align='right' width='50%'><span class='option'>".$morelink."</span></td>\n";
    echo "                    </tr>\n";
    echo "                </table></td>\n";
    echo "            </tr>\n";
    echo "          </table></td>\n";
    echo "          <td width='10' style='background-image: url(".$ThemeImgDir."new_05_br.gif)'><img src='".$ThemeImgDir."spacer.gif' alt='' width='1' height='1' /></td>\n";
    echo "        </tr>\n";
    echo "      </table>\n";
    echo "      <table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
    echo "        <tr>\n";
    echo "          <td width='57' height='38'><img src='".$ThemeImgDir."new_06.gif' alt='' width='57' height='38' /></td>\n";
    echo "          <td style='background-image: url(".$ThemeImgDir."new_07_tile.gif)'><img src='".$ThemeImgDir."spacer.gif' alt='' width='1' height='1' /></td>\n";
    echo "          <td width='57'><img src='".$ThemeImgDir."new_08.gif' alt='' width='57' height='38' /></td>\n";
    echo "        </tr>\n";
    echo "      </table>\n";
    echo "  </td>\n";
    echo "  </tr>\n";
    echo "</table>\n";
    echo "<br />\n";
}

/************************************************************/
/* Function themearticle()                                  */
/************************************************************/
// This function is depreciated. The News Modul supports this function in articles.php but its not recommended
// to use it, because in a later version this function isn't called from News-Modul
// function themearticle ()

function themecenterbox($title, $content) {
    OpenTable();
    echo '<center><span class="option"><strong>'.$title.'</strong></span></center><br />'.$content;
    CloseTable();
    echo '<br />';
}

function themepreview($title, $hometext, $bodytext='', $notes='') {
    echo '<strong>'.$title.'</strong><br /><br />'.$hometext;
    if (!empty($bodytext)) {
        echo '<br /><br />'.$bodytext;
    }
    if (!empty($notes)) {
        echo '<br /><br /><strong>'._NOTE.'</strong>&nbsp;<em>'.$notes.'</em>';
    }
}

/************************************************************/
/* Function themesidebox()                                  */
/************************************************************/
function themesidebox($title, $content, $bid=0) {
    global $theme_name, $ThemeImgDir;
    echo "<table width='168' border='0' cellspacing='0' cellpadding='0'>\n";
    echo "  <tr>\n";
    echo "    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
    echo "      <tr>\n";
    echo "        <td width='26' height='18'><img src='".$ThemeImgDir."block_01.gif' alt='' width='26' height='18' /></td>\n";
    echo "        <td style='background-image: url(".$ThemeImgDir."block_01_tile.gif)'><img src='".$ThemeImgDir."spacer.gif' alt='' width='1' height='1' /></td>\n";
    echo "        <td width='98'><img src='".$ThemeImgDir."block_01_centerimg.gif' alt='' width='98' height='18' /></td>\n";
    echo "        <td style='background-image: url(".$ThemeImgDir."block_01_tile.gif)'><img src='".$ThemeImgDir."spacer.gif' alt='' width='1' height='1' /></td>\n";
    echo "        <td width='26'><img src='".$ThemeImgDir."block_01_r.gif' alt='' width='26' height='18' /></td>\n";
    echo "      </tr>\n";
    echo "    </table>\n";
    echo "      <table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
    echo "        <tr>\n";
    echo "          <td width='8' height='18'><img src='".$ThemeImgDir."block_02.gif' alt='' width='8' height='26' /></td>\n";
    echo "          <td class='blocktitle'>".$title."</td>\n";
    echo "          <td width='8'><img src='".$ThemeImgDir."block_03.gif' alt='' width='8' height='26' /></td>\n";
    echo "        </tr>\n";
    echo "      </table>\n";
    echo "      <table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
    echo "        <tr>\n";
    echo "          <td width='12' height='13'><img src='".$ThemeImgDir."block_04.gif' alt='' width='12' height='13' /></td>\n";
    echo "          <td style='background-image: url(".$ThemeImgDir."block_05_tile.gif)'><img src='".$ThemeImgDir."spacer.gif' alt='' width='1' height='1' /></td>\n";
    echo "          <td width='12'><img src='".$ThemeImgDir."block_06.gif' alt='' width='12' height='13' /></td>\n";
    echo "        </tr>\n";
    echo "      </table>\n";
    echo "      <table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
    echo "        <tr>\n";
    echo "          <td width='14' style='background-image: url(".$ThemeImgDir."block_07_bl.gif)'>&nbsp;</td>\n";
    echo "          <td style='background-color: #E6E6E6;'>";
    echo "              <div style='width:140px; overflow:hidden;'>".$content."<br /></div></td>\n";
    echo "          <td width='14' style='background-image: url(".$ThemeImgDir."block_08_bl.gif)'>&nbsp;</td>\n";
    echo "        </tr>\n";
    echo "      </table>\n";
    echo "      <table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
    echo "        <tr>\n";
    echo "          <td width='21' height='20'><img src='".$ThemeImgDir."block_09.gif' alt='' width='21' height='20' /></td>\n";
    echo "          <td style='background-image: url(".$ThemeImgDir."block_01_tile-13.gif)'><img src='".$ThemeImgDir."spacer.gif' alt='' width='1' height='1' /></td>\n";
    echo "          <td width='104'><img src='".$ThemeImgDir."block_10.gif' alt='' width='104' height='20' /></td>\n";
    echo "          <td style='background-image: url(".$ThemeImgDir."block_01_tile-13.gif)'><img src='".$ThemeImgDir."spacer.gif' alt='' width='1' height='1' /></td>\n";
    echo "          <td width='21' height='20'><img src='".$ThemeImgDir."block_11.gif' alt='' width='21' height='20' /></td>\n";
    echo "        </tr>\n";
    echo "      </table>\n";
    echo "      <table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
    echo "        <tr>\n";
    echo "          <td width='28' height='13'><img src='".$ThemeImgDir."block_12.gif' alt='' width='28' height='13' /></td>\n";
    echo "          <td style='background-image: url(".$ThemeImgDir."block_14_tile.gif)'><img src='".$ThemeImgDir."spacer.gif' alt='' width='1' height='1' /></td>\n";
    echo "          <td width='104'><img src='".$ThemeImgDir."block_13.gif' alt='' width='104' height='13' /></td>\n";
    echo "          <td style='background-image: url(".$ThemeImgDir."block_14_tile.gif)'><img src='".$ThemeImgDir."spacer.gif' alt='' width='1' height='1' /></td>\n";
    echo "          <td width='28'><img src='".$ThemeImgDir."block_15.gif' alt='' width='28' height='13' /></td>\n";
    echo "        </tr>\n";
    echo "      </table>\n";
    echo "      </td>\n";
    echo "  </tr>\n";
    echo "</table>\n";
    echo "<br />\n";
}

?>