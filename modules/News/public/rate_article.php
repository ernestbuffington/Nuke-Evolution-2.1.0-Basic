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

if (!defined('MODULE_FILE') && !defined('NEWS_INDEX_FILE')) {
   die('You can\'t access this file directly...');
}

function ModuleNewsRateForm($artinfo) {
    global $module_name;

    $rateTitle = _RATEARTICLE;
    $ratecontent = "<div style='text-align:center;'>"._VOTES.":&nbsp;<span style='font-weight:bold;'>".$artinfo['ratings']."</span></div>\n";
    $ratecontent .= "<div style='text-align:center;'>"._AVERAGESCORE.":&nbsp;<span style='font-weight:bold;'>".$artinfo['average']."</span></div>\n";
    $ratecontent .= "<div style='text-align:center;'>".$artinfo['the_image']."</div>\n";
    $ratecontent .= "<br /><div style='text-align:center;'>"._RATETHISARTICLE."</div><br />\n";
    $ratecontent .= "<form action='modules.php?name=".$module_name."' method='post'>\n";
    $ratecontent .= "<div style='text-align:left'>\n";
    $ratecontent .= "<input type='hidden' name='sid' value='".$artinfo['sid']."' />\n";
    $ratecontent .= "<input type='hidden' name='op' value='rate_article' />\n";
    $ratecontent .= "<input type='hidden' name='mode' value='doarticlerating' />\n";
    $ratecontent .= "<input type='radio' name='score' value='5' />&nbsp;<img src='".evo_image('stars-5.png', $module_name)."' border='0' alt='"._EXCELLENT."' title='"._EXCELLENT."' /><br />\n";
    $ratecontent .= "<input type='radio' name='score' value='4' />&nbsp;<img src='".evo_image('stars-4.png', $module_name)."' border='0' alt='"._VERYGOOD."' title='"._VERYGOOD."' /><br />\n";
    $ratecontent .= "<input type='radio' name='score' value='3' />&nbsp;<img src='".evo_image('stars-3.png', $module_name)."' border='0' alt='"._GOOD."' title='"._GOOD."' /><br />\n";
    $ratecontent .= "<input type='radio' name='score' value='2' />&nbsp;<img src='".evo_image('stars-2.png', $module_name)."' border='0' alt='"._REGULAR."' title='"._REGULAR."' /><br />\n";
    $ratecontent .= "<input type='radio' name='score' value='1' />&nbsp;<img src='".evo_image('stars-1.png', $module_name)."' border='0' alt='"._BAD."' title='"._BAD."' /><br />\n";
    $ratecontent .= "</div><br /><div style='text-align:center;'><input type='submit' value='"._CASTMYVOTE."' /></div></form><br /><br />\n";
    themesidebox($rateTitle, $ratecontent, 'ModuleNewsRateForm');
}

function ModuleNewsRateArticle() {
    global $db, $module_name, $_GETVAR;

    $sid        = $_GETVAR->get('sid', '_POST', 'int', 0);
    $score      = $_GETVAR->get('score', '_POST', 'int', 0);
    $rated      = $_GETVAR->get('rated', '_REQUEST', 'int', 9);
    $ratecookie = evo_getcookie('ratecookie');
    if ($score > 0 && $sid > 0) {
        if ($score > 5) {
            $score = 5;
        } else {
            $score = round($score, 0);
        }
        if (!empty($ratecookie)) {
            $r_cookie = explode(':', $ratecookie);
            $r_cookie_count = count($r_cookie);
            for ($i=0; $i < $r_cookie_count; $i++) {
                if ($r_cookie[$i] == $sid) {
                    $a = 1;
                }
            }
        }
        if ($a == 1) {
            redirect('modules.php?name='.$module_name.'&amp;op=rate_article&amp;mode=rate_complete&amp;sid='.$sid.'&amp;rated=1');
        } else {
            $db->sql_uquery("UPDATE `"._STORIES_TABLE."` SET `score`=`score`+".$score.", `ratings`=`ratings`+1 WHERE `sid`='".$sid."'");
            $info = $rcookie.$sid.':';
            evo_setcookie('ratecookie', $info, 86400);
            redirect('modules.php?name='.$module_name.'&amp;op=rate_article&amp;mode=rate_complete&amp;sid='.$sid.'&amp;rated=2');
        }
    } else {
        DisplayError('<strong>'._ERROR.'</strong><br /><br />' ._DIDNTRATE);
    }
}

function ModuleNewsRateComplete() {
    global $module_name, $display, $_GETVAR;

    $sid      = $_GETVAR->get('sid', '_POST', 'int', 0);
    $rated    = $_GETVAR->get('rated', '_REQUEST', 'int', 9);
    $ratetext = '';
    if ($rated == 2) {
        $ratetext .= "<div style='text-align:center; width:100%;'>"._THANKSVOTEARTICLE."</div><br />\n";
    } elseif ($rated == 1) {
        $ratetext .= "<div style='text-align:center; width:100%;'>"._ALREADYVOTEDARTICLE."</div><br /><br />\n";
    } else {
        DisplayError('<strong>'._ERROR.'</strong><br /><br />' ._RATE_FAILURE);
    }
    $ratetext .= "<div style='text-align:center; width:100%;'>[&nbsp;<a href='modules.php?name=".$module_name."&amp;op=article&amp;sid=".$sid.$display."'>"._BACKTOARTICLEPAGE."</a>&nbsp;]</div>\n";
    include_once(NUKE_BASE_DIR.'header.php');
    ModuleNewsHeading();
    OpenTable();
    echo "<div style='text-align:center; width:100%;'>"._ARTICLERATING."</div><br /><br /><br />\n";
    echo $ratetext."<br /><br />\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}
$mode       = $_GETVAR->get('mode', '_REQUEST', 'string', '');

switch($mode) {
    case 'doarticlerating':   ModuleNewsRateArticle(); break;
    case 'rate_complete':     ModuleNewsRateComplete(); break;
}

?>
