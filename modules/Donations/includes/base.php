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

if (!defined('ADMIN_FILE') && !defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

define_once('NUKE_DONATIONS_ADMIN', NUKE_DONATIONS . '/admin/');
define_once('NUKE_DONATIONS_ADMIN_INCLUDES', NUKE_DONATIONS_ADMIN . 'includes/');
define_once('NUKE_DONATIONS_ANONYM', 'ANONYM');
define_once('NUKE_DONATIONS_PRIVAT', 'PRIVAT');
define_once('NUKE_DONATIONS_REGULAR', 'REGULAR');

if (!defined('ADMIN_FILE')) {
    include_once(NUKE_DONATIONS_ADMIN_INCLUDES . 'base.php');
}
/*==============================================================================================
    Function:    cancel_get_gen_configs()
    In:          N/A
    Return:      An array of the current general settings
    Notes:       N/A
================================================================================================*/
function get_gen_configs () {
    global $db, $lang_donate, $cache;
    static $gen;
    if(isset($gen) && is_array($gen)) { return $gen; }
    if (!$gen = $cache->load('general', 'donations')) {
        $sql = 'SELECT config_value, config_name from '._DONATIONS_DONATOR_CONFIG_TABLE.' WHERE config_name LIKE "gen_%"';
        if(!$result = $db->sql_query($sql)) {
            DonateError($lang_donate['GEN_NF'],0);
        }
        while ($row = $db->sql_fetchrow($result)) {
            $gen[str_replace('gen_', '', $row['config_name'])] = $row['config_value'];
        }
        $db->sql_freeresult($result);
        $cache->save('general', 'donations', $gen);
    }
    return $gen;
}

/*==============================================================================================
    Function:    get_page_configs()
    In:          N/A
    Return:      An array of the current page settings
    Notes:       N/A
================================================================================================*/
function get_page_configs () {
    global $db, $lang_donate, $cache;
    static $page;
    if(isset($page) && is_array($page)) { return $page; }
    if (!$page = $cache->load('page', 'donations')) {
        $sql = 'SELECT config_value, config_name from '._DONATIONS_DONATOR_CONFIG_TABLE.' WHERE config_name LIKE "page_%"';
        if(!$result = $db->sql_query($sql)) {
            DonateError($lang_donate['PAGE_NF'],0);
        }
        while ($row = $db->sql_fetchrow($result)) {
            $page[str_replace('page_', '', $row['config_name'])] = $row['config_value'];
        }
        $db->sql_freeresult($result);
        $cache->save('page', 'donations', $page);
    }
    return $page;
}

/*==============================================================================================
    Function:    get_donations()
    In:          N/A
    Return:      An array of the current donations
    Notes:       N/A
================================================================================================*/
function get_donations ($type='') {
    global $db, $lang_donate, $cache;

    if(empty($type)) {
        $clear = $cache->load('donations_clear', 'donations');
        if(!isset($clear) || $clear <= time()) {
            $cache->delete('donations', 'donations');
            $cache->save('donations_clear', 'donations', strtotime("+1 Week"));
        }
        static $don;
        if(isset($don) && is_array($don)) { return $don; }
        if (!$don = $cache->load('donations', 'donations')) {
            $sql = 'SELECT * FROM `'._DONATIONS_DONATOR_TABLE.'` ORDER BY `id` DESC';
            if(!$result = $db->sql_query($sql)) {
                DonateError($lang_donate['DON_NF'],0);
            }
            $don = $db->sql_fetchrowset($result);
            $db->sql_freeresult($result);
            $cache->save('donations', 'donations', $don);
        }
    } else {
        $sql = 'SELECT * FROM `'._DONATIONS_DONATOR_TABLE.'` WHERE `donto`="'.$type.'" ORDER BY `id` DESC';
        if(!$result = $db->sql_query($sql)) {
            DonateError($lang_donate['DON_NF'],0);
        }
        $don = $db->sql_fetchrowset($result);
        $db->sql_freeresult($result);
    }
    return $don;
}

/*==============================================================================================
    Function:    get_donations_no_anon()
    In:          N/A
    Return:      An array of the current donations with out anon donations
    Notes:       N/A
================================================================================================*/
function get_donations_no_anon ($type='') {
    global $db, $lang_donate, $cache;

    if(empty($type)) {
        $clear = $cache->load('donations_clear', 'donations');
        if(!isset($clear) || $clear <= time()) {
            $cache->delete('donations', 'donations');
            $cache->save('donations_clear', 'donations', strtotime("+1 Week"));
        }
        static $don_no_anon;
        if(isset($don_no_anon) && is_array($don_no_anon)) { return $don_no_anon; }
        if (!$don = $cache->load('donations', 'donations')) {
            $sql = 'SELECT * FROM `'._DONATIONS_DONATOR_TABLE.'` WHERE donshow <> 0 AND uname <> "" ORDER BY `id` DESC';
            if(!$result = $db->sql_query($sql)) {
                DonateError($lang_donate['DON_NF'],0);
            }
            $don_no_anon = $db->sql_fetchrowset($result);
            $db->sql_freeresult($result);
            $cache->save('donations_no_anon', 'donations', $don_no_anon);
        }
    } else {
        $sql = 'SELECT * FROM `'._DONATIONS_DONATOR_TABLE.'` WHERE donshow <> 0 AND uname <> "" AND `donto`="'.$type.'" ORDER BY `id` DESC';
        if(!$result = $db->sql_query($sql)) {
            DonateError($lang_donate['DON_NF'],0);
        }
        $don_no_anon = $db->sql_fetchrowset($result);
        $db->sql_freeresult($result);
    }
    return $don_no_anon;
}

/*==============================================================================================
    Function:    get_donations_goal()
    In:          N/A
    Return:      An array of the current donations
    Notes:       N/A
================================================================================================*/
function get_donations_goal () {
    global $db, $cache;
    $clear = $cache->load('donations_clear', 'donations');
    if(!isset($clear) || $clear <= time()) {
        $cache->delete('donations', 'donations');
        $cache->save('donations_clear', 'donations', strtotime("+1 Week"));
    }
    static $don_goal;
    if (isset($don_goal) && is_array($don_goal)) { return $don_goal; }

    if (!$don_goal = $cache->load('donations_goal', 'donations')) {
        $sql = 'SELECT * FROM `'._DONATIONS_DONATOR_TABLE.'` WHERE MONTH(FROM_UNIXTIME(`dondate`)) = "'.date('m').'" AND YEAR(FROM_UNIXTIME(`dondate`)) = "'.date('Y').'" ORDER BY `id` DESC';
        $result = $db->sql_query($sql);
        $don_goal = $db->sql_fetchrowset($result);
        $db->sql_freeresult($result);
        $cache->save('donations_goal', 'donations', $don_goal);
    }
    return $don_goal;
}

/*==============================================================================================
    Function:    get_donations_goal_no_anon()
    In:          N/A
    Return:      An array of the current donations with out anon donations
    Notes:       N/A
================================================================================================*/
function get_donations_goal_no_anon () {
    global $db, $cache;
    $clear = $cache->load('donations_clear', 'donations');
    if(!isset($clear) || $clear <= time()) {
        $cache->delete('donations', 'donations');
        $cache->save('donations_clear', 'donations', strtotime("+1 Week"));
    }
    static $don_goal_no_anon;
    if (isset($don_goal_no_anon) && is_array($don_goal_no_anon)) { return $don_goal_no_anon; }

    if (!$don_goal_no_anon = $cache->load('donations_goal_no_anon', 'donations')) {
        $sql = 'SELECT * FROM `'._DONATIONS_DONATOR_TABLE.'` WHERE MONTH(FROM_UNIXTIME(`dondate`)) = "'.date('n').'" AND donshow <> 0 AND uname <> "" ORDER BY `id` DESC';
        $result = $db->sql_query($sql);
        $don_goal_no_anon = $db->sql_fetchrowset($result);
        $db->sql_freeresult($result);
        $cache->save('donations_goal_no_anon', 'donations', $don_goal_no_anon);
    }
    return $don_goal_no_anon;
}

/*==============================================================================================
    Function:    donation_title()
    In:          N/A
    Return:      N/A
    Notes:       Displays the page title
================================================================================================*/
function donation_title() {
    global $lang_donate;
    OpenTable();
    echo "<div align=\"center\">\n";
    echo "<span style=\"font-size: large; font-weight: bold;\">\n";
    echo $lang_donate['DONATIONS'];
    echo "</span>\n";
    echo "</div>";
    CloseTable();
    echo "<br />";
}

/*==============================================================================================
    Function:    get_currency_code()
    In:          N/A
    Return:      Returns the selected currency code
    Notes:       N/A
================================================================================================*/
function get_currency_code () {
    global $gen_configs;
    if (!is_array($gen_configs)) {
        $gen_configs = get_gen_configs();
    }
    switch ($gen_configs['currency']) {
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

?>