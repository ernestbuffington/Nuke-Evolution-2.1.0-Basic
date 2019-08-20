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

if (defined('ADMIN_FILE')) {
    global $evouserinfo_online, $db, $cache, $evoconfig, $blocksession, $lang_evo_userblock;
}

function block_Evo_UserInfo_online_cache($block_cachetime) {
    global $db, $cache;
    if ((($blockcache = $cache->load('whoisonline', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        if (!function_exists('phpBB_whoisonline')) {
            include(NUKE_INCLUDE_DIR . 'sessions.php');
        }
        $blockcache = phpBB_whoisonline();
    }
    return $blockcache;
}

$online_blocksession  = block_Evo_UserInfo_online_cache($evoconfig['block_cachetime']);

$text_guests  = '';
$text_members = '<div style="white-space:nowrap;">';
$text_bots    = '';
$img_admin    = evo_image('admin.png', 'evo_userinfo');
$img_staff    = evo_image('staff.png', 'evo_userinfo');
$num_guests   = 0;
$num_members  = 0;
$num_bots     = 0;
if ( is_array($online_blocksession) && ($online_blocksession[0]['stat_created'] != FALSE) && ($online_blocksession[0]['count_sessions'] > 0)) {
    $count_hidden       = $online_blocksession[0]['count_hidden'];
    $count_reg_user     = $online_blocksession[0]['count_reg_user'];
    $count_members      = $count_hidden + $count_reg_user;
    $count_guests       = $online_blocksession[0]['count_guests'];
    $count_last_update  = $online_blocksession[0]['stat_created'];
    $count_sess         = $online_blocksession[0]['count_sessions'];
    for ( $i = 1; $i < $count_sess; $i++) {
        if ($online_blocksession[$i]['isactive']) {
            $sess_username  = $online_blocksession[$i]['username'];
            $sess_username_color = $online_blocksession[$i]['username_color'];
            $sess_userid    = $online_blocksession[$i]['user_id'];
            $sess_hostadr   = $online_blocksession[$i]['hostaddr'];
            $sess_usertyp   = $online_blocksession[$i]['usertyp'];
            $sess_url       = str_replace("&", "&amp;", $online_blocksession[$i]['url']);
            $sess_module    = $online_blocksession[$i]['module'];
            $sess_guest     = $online_blocksession[$i]['guest'];
            $user_level     = get_user_field('user_level', $sess_userid);
            $sess_where_active = (!empty($sess_module)) ? str_replace('_', ' ', $sess_module) : 'Forum ACP';
            $username       = $sess_username_color;
            $text           = '<a href="'.$sess_url.'" title="'.$module.'" target="_blank">';
            if ( ($sess_guest == 0) || ($sess_guest == 2) ) {
                $num_members++;
                if($num_members < 10) {
                    $num_text = '0'.$num_members;
                } else {
                    $num_text = $num_members;
                }
                $text_members   .= $text;
                $text_members   .= '&nbsp;&nbsp;('.$num_text.')&nbsp;'.$username;
                switch ($user_level['user_level']) {
                    case (2):   $text_members .= '&nbsp;<img src="'. $img_admin. '" alt="" />'."</a>"; break;
                    case (3):   $text_members .= '&nbsp;<img src="'. $img_staff. '" alt="" />'."</a>"; break;
                    default :   $text_members .= "</a>"; break;
                }
                if($blocksession[1]['online_scroll'] != 'yes') {
                    $text_members .= '<br />';
                }
            } elseif ($sess_guest == 3) {
                $num_bots++;
                if($num_bots < 10) {
                    $num_text = '0'.$num_bots;
                } else {
                    $num_text = $num_bots;
                }
                $text_bots   .= $text;
                $text_bots   .= '&nbsp;&nbsp;('.$num_text.')&nbsp;'.$sess_username;
                $text_bots   .= "</a>";
                if($blocksession[1]['online_scroll'] != 'yes') {
                    $text_bots .= '<br />';
                }
            } else {
                $num_guests++;
                if($num_guests < 10) {
                    $num_text = '0'.$num_guests;
                } else {
                    $num_text = $num_guests;
                }
                $text_guests .= $text;
                $text_guests .= '&nbsp;&nbsp;('.$num_text.')&nbsp;'.$sess_hostadr;
                $text_guests .= "</a>";
                if($blocksession[1]['online_scroll'] != 'yes') {
                    $text_guests .= '<br />';
                }
            }
        }
    }
}
$text_guests  .= '';
$text_members .= '</div>';
$text_bots    .= '';

if($blocksession[1]['online_show_members'] == 'yes') {
    $out = "<img src='".evo_image('group.png', 'evo_userinfo')."' alt='' />&nbsp;<span style='text-decoration:underline; font-weight: bold;'>".$lang_evo_userblock['BLOCK']['ONLINE']['STATS'].$lang_evo_userblock['BLOCK']['BREAK']."</span>".evouserinfo_expand_collapse_start('online_amount')."<br />\n";
    $out .= "<img src='".evo_image('li.png', 'evo_userinfo')."' alt='' />&nbsp;".$lang_evo_userblock['BLOCK']['ONLINE']['MEMBERS'].$lang_evo_userblock['BLOCK']['BREAK']."&nbsp;".$count_members."<br />\n";
    if($blocksession[1]['online_show_hv'] == 'yes') {
        $out .= "&nbsp;&nbsp;&nbsp;<img src='".evo_image('li.png', 'evo_userinfo')."' alt='' />&nbsp;<span style='font-style: italic;'>".$lang_evo_userblock['BLOCK']['ONLINE']['VISIBLE'].$lang_evo_userblock['BLOCK']['BREAK']."&nbsp;".$count_reg_user."</span><br />\n";
        $out .= "&nbsp;&nbsp;&nbsp;<img src='".evo_image('li.png', 'evo_userinfo')."' alt='' />&nbsp;<span style='font-style: italic;'>".$lang_evo_userblock['BLOCK']['ONLINE']['HIDDEN'].$lang_evo_userblock['BLOCK']['BREAK']."&nbsp;".$count_hidden."</span><br />\n";
    }
    $out .= "<img src='".evo_image('li.png', 'evo_userinfo')."' alt='' />&nbsp;".$lang_evo_userblock['BLOCK']['ONLINE']['GUESTS'].$lang_evo_userblock['BLOCK']['BREAK']."&nbsp;".$num_guests."<br />\n";
    $out .= "<img src='".evo_image('li.png', 'evo_userinfo')."' alt='' />&nbsp;".$lang_evo_userblock['BLOCK']['ONLINE']['BOTS'].$lang_evo_userblock['BLOCK']['BREAK']."&nbsp;".$num_bots."<br />\n";
    $out .= "<img src='".evo_image('li.png', 'evo_userinfo')."' alt='' />&nbsp;".$lang_evo_userblock['BLOCK']['ONLINE']['TOTAL'].$lang_evo_userblock['BLOCK']['BREAK']."&nbsp;".($num_guests+$num_bots+$count_members)."<br />\n";
    $out .= evouserinfo_expand_collapse_end();
}
$out .= "<img src='".evo_image('online.png', 'evo_userinfo')."' alt='' />&nbsp;<span style='text-decoration:underline; font-weight: bold;'>".$lang_evo_userblock['BLOCK']['ONLINE']['ONLINE'].$lang_evo_userblock['BLOCK']['BREAK']."</span>" .evouserinfo_expand_collapse_start('online')."<br />\n";
if($blocksession[1]['online_scroll'] == 'yes') {
    $out .= "<table width='90%'>\n<tr>\n<td>\n";
    $out .= "<img src='".evo_image('li.png', 'evo_userinfo')."' alt='' />&nbsp;".$lang_evo_userblock['BLOCK']['ONLINE']['MEMBERS'].$lang_evo_userblock['BLOCK']['BREAK'];
    $out .= evo_marquee('EvoUserBlock_Members', '25px', '100%', $text_members, 'left', 4, '25px', '100%', 1, 0);
    $out .= "</td>\n</tr>\n</table>\n";
    $out .= "<table width='90%'>\n<tr>\n<td>\n";
    $out .= "<img src='".evo_image('li.png', 'evo_userinfo')."' alt='' />&nbsp;".$lang_evo_userblock['BLOCK']['ONLINE']['GUESTS'].$lang_evo_userblock['BLOCK']['BREAK'];
    $out .= evo_marquee('EvoUserBlock_Guests', '25px', '100%', $text_guests, 'left', 4, '25px', '100%', 1, 0);
    $out .= "</td>\n</tr>\n</table>\n";
    $out .= "<table width='90%'>\n<tr>\n<td>\n";
    $out .= "<img src='".evo_image('li.png', 'evo_userinfo')."' alt='' />&nbsp;".$lang_evo_userblock['BLOCK']['ONLINE']['BOTS'].$lang_evo_userblock['BLOCK']['BREAK'];
    $out .= evo_marquee('EvoUserBlock_Bots', '25px', '100%', $text_bots, 'left', 4, '25px', '100%', 1, 0);
    $out .= "</td>\n</tr>\n</table>\n";
} else {
    $out .= "<table width='90%'>\n<tr>\n<td>\n";
    $out .= "<img src='".evo_image('li.png', 'evo_userinfo')."' alt='' />&nbsp;";
    $out .= $lang_evo_userblock['BLOCK']['ONLINE']['MEMBERS'].$lang_evo_userblock['BLOCK']['BREAK']."<br />".$text_members."<br />";
    $out .= "</td>\n</tr>\n</table>\n";
    $out .= "<table width='90%'>\n<tr>\n<td>\n";
    $out .= "<img src='".evo_image('li.png', 'evo_userinfo')."' alt='' />&nbsp;";
    $out .= $lang_evo_userblock['BLOCK']['ONLINE']['GUESTS'].$lang_evo_userblock['BLOCK']['BREAK']."<br />".$text_guests."<br />";
    $out .= "</td>\n</tr>\n</table>\n";
    $out .= "<table width='90%'>\n<tr>\n<td>\n";
    $out .= "<img src='".evo_image('li.png', 'evo_userinfo')."' alt='' />&nbsp;";
    $out .= $lang_evo_userblock['BLOCK']['ONLINE']['BOTS'].$lang_evo_userblock['BLOCK']['BREAK']."<br />".$text_bots."<br />";
    $out .= "</td>\n</tr>\n</table>\n";
}
$out .= evouserinfo_expand_collapse_end();

$evouserinfo_online = $out;

?>