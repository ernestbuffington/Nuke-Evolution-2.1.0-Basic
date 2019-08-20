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

global $db, $cache, $evoconfig;

function block_donations_cache($block_cachetime) {
    global $db, $cache;
    if ((($blockcache = $cache->load('donations', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        // All Categories and their active Modules sorted by Categorie Position and Module Position
        $result = $db->sql_query('SELECT `config_name`, `config_value` FROM `'._DONATIONS_DONATOR_CONFIG_TABLE.'`');
        $a     = 0;
        $total = 0;
        while (list($config_name, $config_value) = $db->sql_fetchrow($result)) {
            $blockcache[0][$config_name] = $config_value;
        }
        $donator_limit = ($blockcache[0]['block_num_donations'] ? $blockcache[0]['block_num_donations'] : 10);
        $db->sql_freeresult($result);
        $result = $db->sql_query('SELECT `uname`, `donshow`, `donated`, `dondate`, `msg` FROM `'._DONATIONS_DONATOR_TABLE.'` WHERE `donok` = 0 ORDER BY `dondate` DESC LIMIT 0,'.$donator_limit);
        while (list($uname, $donshow, $donated, $dondate, $msg) = $db->sql_fetchrow($result)) {
            $a++;
            $blockcache[$a]['uname']    = $uname;
            $blockcache[$a]['donshow']  = $donshow;
            $blockcache[$a]['donated']  = $donated;
            $blockcache[$a]['dondate']  = $dondate;
            $blockcache[$a]['msg']      = $msg;
            $total                      = $total + $donated;

        }
        $db->sql_freeresult($result);
        $result = $db->sql_ufetchrow('SELECT sum(`donated`) as total FROM  `'._DONATIONS_DONATOR_TABLE.'` WHERE month(from_unixtime(`dondate`)) = month(now())
                            AND year(from_unixtime(`dondate`)) = year(now())');
        $blockcache[0]['stat_created'] = time();
        $blockcache[0]['total']        = $result['total'];
        $cache->save('donations', 'blocks', $blockcache);
    }
    return $blockcache;
}

$blocksession   = block_donations_cache($evoconfig['block_cachetime']);


/*==============================================================================================
    Function:    donation_block_get_currency_code()
    In:          N/A
    Return:      Returns the selected currency code
    Notes:       N/A
================================================================================================*/
function donation_block_get_currency_code ($currency) {
    switch ($currency) {
        case 'USD':
            return "&#36;";
        break;
        case 'AUD':
            return "&#36;";
        break;
        case 'CAD':
            return "&#36;";
        break;
        case 'EUR':
            return "&euro;";
        break;
        case 'GBP':
            return "&pound;";
        break;
        case 'JPY':
            return "&yen;";
        break;
        default:
            return '';
        break;
    }
}

/*==============================================================================================
    Function:    donation_block_make_image_button()
    In:          N/A
    Return:      Either a submit button or an image button
    Notes:       N/A
================================================================================================*/
function donation_block_make_image_button ($button_image) {
    if (empty($button_image)) {
        return "<form action='modules.php?name=Donations&amp;op=make' method='post'><input type='submit' value='".$lang_block['BLOCK_DONATIONS_DONATE']."' /></form>\n";
    } else {
        return "<form action='modules.php?name=Donations&amp;op=make' method='post'><input type='image' src='".$button_image."' name='submit' /></form>\n";
    }
}


$currency_code = donation_block_get_currency_code($blocksession[0]['gen_currency']);
$blockcontent  = '';
for ($a = 1, $max = count($blocksession); $a < $max; $a++) {
    if ((empty($blocksession[$a]['uname']) || $blocksession[$a]['donshow'] == 0) && $blocksession[0]['block_show_anon_amount'] == 'no') {
        continue;
    }
    $blockcontent .= "<div style='width:100%; margin: 0 auto; text-align:center;'>";
    if ($blocksession[0]['block_numbers'] == 'yes') {
        $blockcontent .= "<span style='font-weight: bold;'>";
        $blockcontent .= ($a < 10) ? '0'.$a : $a;
        $blockcontent .= "</span>-&nbsp;";
    }
    if (is_admin()) {
        if (!empty($blocksession[$a]['msg'])) {
            $don_msg = addslashes(strtr($blocksession[$a]['msg'],chr(10),chr(32)));
            $blockcontent .= "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$blocksession[$a]['uname']."\" onmouseover=\"return overlib('".$don_msg."', BELOW, CENTER, CAPTION, '', WIDTH, 300, OFFSETY, 20, FGCOLOR, '#ffffff', BGCOLOR, '#000000', TEXTCOLOR, '#000000', CAPCOLOR, '#ffffff', CLOSECOLOR, '#ffffff', CAPICON, '', BORDER, '2');\" onmouseout=\"return nd();\">\n";
        } else {
            $blockcontent .= "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$blocksession[$a]['uname']."\" >\n";
        }
    }
    if (empty($blocksession[$a]['uname']) || $blocksession[$a]['donshow'] == 0) {
        $blockcontent .= $lang_block['BLOCK_DONATIONS_ANON'];
    } else {
        $blockcontent .= UsernameColor(trim($blocksession[$a]['uname']));
    }
    if (is_admin()) {
        $blockcontent .= "</a>\n";
    }
    if ($blocksession[0]['block_numbers'] == 'yes') {
        $blockcontent .= "<br />";
    } else {
        $blockcontent .= "&nbsp;-&nbsp;";
    }
    if ((($blocksession[0]['block_show_amount'] == 'yes') && ($blocksession[$a]['donshow'] == 1)) || is_admin()) {
        $blockcontent .= $currency_code.sprintf('%.2f',$blocksession[$a]['donated']);
    }
    if ($blocksession[0]['block_show_dates'] == 'yes') {
        if ((is_numeric($blocksession[$a]['dondate'])) && ($blocksession[$a]['dondate'] > 0)) {
            $date = formatTimestamp($blocksession[$a]['dondate'], '', true);
        } else {
            $date = $blocksession[$a]['dondate']; // donations date is saved either in old format or something is wrong
        }
        $blockcontent .= "<br />".$date;
    }
    $blockcontent .= "</div><br />";
}

if($blocksession[0]['block_show_goal'] == 'yes') {
    $block_goal = "<div style='width:90%; text-align:left;'>\n";
    $block_goal .= "<span style='float:left; margin-left: 5px; width:60%;'>".$lang_block['BLOCK_DONATIONS_DONATE_TOTAL'] ."</span>\n";
    $block_goal .= "<span style='float:right; margin-right: 5px; width:30%;'>". $currency_code.sprintf('%.2f',$blocksession[0]['total']) ."</span>\n";
    $block_goal .= "<br />\n";
    $block_goal .= "<span style='float:left; margin-left: 5px; width:60%;'>". $lang_block['BLOCK_DONATIONS_DONATE_GOAL'] ."</span>\n";
    $block_goal .= "<span style='float:right; margin-right: 5px; width:30%;'>". $currency_code.sprintf('%.2f',$blocksession[0]['gen_monthly_goal']) ."</span>\n";
    $block_goal .= "<br />\n";
    $block_goal .= "<span style='float:left; margin-left: 5px; width:60%;'>". $lang_block['BLOCK_DONATIONS_DONATE_DIF'] ."</span>\n";
    $block_goal .= "<span style='float:right; margin-right: 5px; width:30%;'>". $currency_code.sprintf('%.2f',floatval($blocksession[0]['gen_monthly_goal'] - $blocksession[0]['total'])) ."</span>\n";
    $block_goal .= "</div>\n\n";
}


$content = "<div style='width:100%; text-align:center;font-size: x-small;'>\n";
if ($blocksession[0]['block_scroll'] == 'yes') {
    $content .= "<div style='height:80px; width:100%; text-align:center; font-size: x-small; overflow:hidden;'>\n";
    $content .= evo_marquee('block_Donations_scroll', '100%', '100%', $blockcontent, 'up', 1, '100%', '100%' , 0, 0);
} else {
    $content .= "<div style='width:100%; margin: 0 auto; text-align:center;font-size: x-small;'>\n";
    $content .= $blockcontent;
}
$content .= "</div>\n";
$content .= "<br />\n<hr />\n";
if($blocksession[0]['block_show_goal'] == 'yes') {
    $content .= $block_goal;
    $content .= "<br />\n<hr />\n";
}
$content .= (!empty($blocksession[0]['block_message'])) ? $blocksession[0]['block_message'].'<br /><br />' : '';
//Button
$content .= donation_block_make_image_button($blocksession[0]['block_button_image']);
$content .= "</div>\n";

?>