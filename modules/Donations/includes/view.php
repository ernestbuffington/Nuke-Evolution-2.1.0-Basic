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

if (!defined('MODULE_FILE') ) {
   die('You can\'t access this file directly...');
}

global $_GETVAR;
$_GETVAR->unsetVariables();

//Display the page title
donation_index();


/*==============================================================================================
    Function:    view_display()
    In:          $page
                    Passed in page number
    Return:      N/A
    Notes:       Displays the donations
================================================================================================*/
function view_display ($page=0) {
    global $gen_configs, $page_configs, $donations, $lang_donate, $dis;

    $currency_code = get_currency_code();
    if (!empty($page_configs['header_image'])) {
        echo "<div align=\"center\">\n";
        echo "<img src=\"".$page_configs['header_image']."\" alt=\"\" border=\"0\" />\n";
        echo "</div>\n";
    }
    //Set table size depending on if we are showing the date or not
    if ($page_configs['show_dates'] == 'yes') {
        echo "<div align=\"center\"><table width=\"55%\" border=\"0\" >\n";
    } else {
        echo "<div align=\"center\"><table width=\"35%\" border=\"0\" >\n";
    }
    echo "<tr>\n";
    //Show date title if dates are on or off
    if ($page_configs['show_dates'] == 'yes') {
        $width = '70';
        echo "<td width=\"17%\"><div align=\"center\"><strong>".$lang_donate['DATE']."</strong></div></td>\n";
    } else {
        $width = '87';
    }
    //Display username and amount title
    echo "<td width=\"".$width."%\"><div align=\"center\"><strong>".$lang_donate['USERNAME']."</strong></div></td>";
    echo "<td width=\"13%\"><div align=\"right\"><strong>".$lang_donate['AMOUNT']."</strong></div></td>";
    echo "</tr>\n";
    $total = 0;
    //Setup the for start and stop points
    $start = $page * $page_configs['num_donations'];
    $stop = ($page+1) * $page_configs['num_donations'];
    if ($stop > sizeof($donations)) {
        $stop = sizeof($donations);
        if ($page == 0) {
            //If there is only one page make the next and previous disappear
            $no_next_prev = 1;
        }
    }
    //Loop through the donation array
    for ($i=$start; $i < $stop; $i++) {
        //Set donator = to the current donation in the array
        $donator = $donations[$i];
        echo "<tr>\n";
        if ($page_configs['show_dates'] == 'yes') {
            if (empty($donator['dondate'])) {
                $date = '??/??/????';
            } else if (!strpos($donator['dondate'], '/')){
                $date = date($gen_configs['date_format'],$donator['dondate']);
            } else {
                $date = $donator['dondate'];
            }
            $date = ($date == '12/31/1969') ? $donator['dondate'] : $date;
            echo "<td><div align=\"center\">".$date."</div></td>\n";
        }
        if (empty($donator['uname']) || $donator['donshow'] == 0) {
            echo "<td><div align=\"center\">".$lang_donate['TYPE_ANON']."</div></td>\n";
        } else {
            echo "<td><div align=\"center\">".UsernameColor(trim($donator['uname']))."</div></td>\n";
        }
        if ($page_configs['show_amount'] == 'yes') {
            echo "<td><div align=\"right\">".$currency_code.sprintf('%.2f',$donator['donated'])."</div></td>\n";
        } else {
            echo "<td><div align=\"right\">".$lang_donate['N/A']."</div></td>\n";
        }
        $total += floatval($donator['donated']);
        echo "</tr>\n";
    }
    if ($page_configs['show_dates'] != 'yes') {
        $date_spacer = '';
    } else {
        $date_spacer = "<td width=\"17%\">&nbsp;</td>\n";
    }
    echo "<tr>\n<td colspan=\"3\">\n<hr />\n</td>\n</tr>\n";
    if ($stop == sizeof($donations)) {
        echo "<tr>\n";
        echo $date_spacer;
        echo "<td><div align=\"right\"><strong>".$lang_donate['TOTAL'].$lang_donate['BREAK']."</strong></div></td>";
        echo "<td><div align=\"right\">".$currency_code.sprintf('%.2f',$total)."</div></td>";
        echo "</tr>\n";
        if ($dis == 'goal') {
            echo "<tr>\n";
            echo $date_spacer;
            echo "<td><div align=\"right\"><strong>".$lang_donate['GOAL'].$lang_donate['BREAK']."</strong></div></td>";
            echo "<td><div align=\"right\">".$currency_code.sprintf('%.2f',$gen_configs['monthly_goal'])."</div></td>";
            echo "</tr>\n";
            $diff = floatval($gen_configs['monthly_goal']) - $total;
            $diff = sprintf('%.2f',$diff);
            echo "<tr>\n";
            echo $date_spacer;
            echo "<td><div align=\"right\"><strong>".$lang_donate['DIFF'].$lang_donate['BREAK']."</strong></div></td>";
            echo "<td><div align=\"right\">".$currency_code.$diff."</div></td>";
            echo "</tr>\n";
        }
    }
    //Setup previous link and text
    if ($page != '0') {
        $prev_page = $page - 1;
        $prev = '<strong><a href="modules.php?name=Donations&amp;op=view&amp;page='.$prev_page.'">'.$lang_donate['PREV_DIRECTION'].$lang_donate['PREV'].'</a></strong>';
    } else {
        $prev = $lang_donate['PREV_DIRECTION'].$lang_donate['PREV'];
    }
    //Setup the next link and text
    if ($stop != sizeof($donations)) {
        $next_page = $page + 1;
        $next = '<strong><a href="modules.php?name=Donations&amp;op=view&amp;page='.$next_page.'">'.$lang_donate['NEXT'].$lang_donate['NEXT_DIRECTION'].'</a></strong>';
    } else {
        $next = $lang_donate['NEXT'].$lang_donate['NEXT_DIRECTION'];
    }
    //Show the next and previous if needed
    if (!isset($no_next_prev)) {
        echo "<tr><td colspan=\"3\">\n<div align=\"center\">\n";
        echo $prev.'&nbsp;'.$lang_donate['BREAK'].'&nbsp;'.$next;
        echo "</div>\n</td></tr>\n";
    }
    echo "</table></div>";
}

/*==============================================================================================
    Function:    display()
    In:          $page
                    Passed in page number
    Return:      N/A
    Notes:       Displays the donations
================================================================================================*/

function view_display_links () {
    global $lang_donate, $gen_configs;

    echo "<div align=\"center\"><table width=\"55%\" border=\"1\" >\n";
    echo "<tr>\n<td align=\"center\">\n<a href=\"modules.php?name=Donations&amp;op=view&amp;dis=total\" ".make_help_popup($lang_donate['HELP_TOTAL'],$lang_donate['TOTAL']).">".$lang_donate['TOTAL']."</a>\n</td>\n";
    echo "<td align=\"center\">\n<a href=\"modules.php?name=Donations&amp;op=view&amp;dis=goal\" ".make_help_popup($lang_donate['HELP_GOAL'],$lang_donate['GOAL']).">".$lang_donate['GOAL']."</a>\n</td>\n</tr>\n";
    echo "</table></div>\n";
    if (!empty($gen_configs['codes'])) {
        echo "<br /><br />";

        $codes = $gen_configs['codes'];
        $codes = str_replace("\r\n", "\n", $codes);
        $codes = explode("\n", $codes);
        echo "<table width=\"55%\" border=\"1\" align=\"center\">\n";
        echo "<tr>";
        for ($i=1, $maxi=count($codes); $i < $maxi; $i=$i+2) {
            $j = $i - 1;
            echo "<td align=\"center\">\n<a href=\"modules.php?name=Donations&amp;op=view&amp;dis=".$codes[$i]."\"> ".$codes[$j]."</a>\n</td>\n";
        }
        echo "</tr>\n";
        echo "</table>\n";
    }
}

/*~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-*/

//Get values
global $gen_configs, $page_configs, $donations;
$page_configs = get_page_configs();
$gen_configs = get_gen_configs();
OpenTable();
view_display_links();

$page = $_GETVAR->get('page', 'GET', 'int');
$dis = $_GETVAR->get('dis', 'GET');

echo "<br />";
if ($dis == 'goal') {
    $donations = ($page_configs['show_anon_amount'] == 'yes') ? get_donations_goal() : get_donations_goal_no_anon();
} else if (empty($dis) || $dis == 'total') {
    $donations = ($page_configs['show_anon_amount'] == 'yes') ? get_donations() : get_donations_no_anon();
} else {
   //Look for . / \ and kick it out
    if (preg_match('/.*?(\/|\.|\\\)/i',$dis)) {
        DisplayError($lang_donate['ACCESS_DENIED']);
    }
    $dis = Fix_Quotes($dis);
    $donations = ($page_configs['show_anon_amount'] == 'yes') ? get_donations($dis) : get_donations_no_anon($dis);
}
//Display donations
view_display($page);
CloseTable();
?>