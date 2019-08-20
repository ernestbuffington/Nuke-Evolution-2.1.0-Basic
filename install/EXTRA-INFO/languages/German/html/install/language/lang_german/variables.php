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
 Nuke-Evo Author        :   ReOrGaNiSaTiOn

 Copyright (c) 2008 by The Nuke-Evolution Development Team
 ========================================================================

 LICENSE INFORMATIONS COULD BE FOUND IN COPYRIGHTS.PHP WHICH MUST BE
 DISTRIBUTED WITHIN THIS MODULEPACKAGE OR WITHIN FILES WHICH ARE
 USED FROM WITHIN THIS PACKAGE.
 IT IS 'NOT' ALLOWED TO DISTRIBUTE THIS MODULE WITHOUT THE ORIGINAL
 COPYRIGHT-FILE.
 ALL INFORMATIONS ABOVE THIS SECTION ARE 'NOT' ALLOWED TO BE REMOVED.
 THEY HAVE TO STAY AS THEY ARE.
 IT IS ALLOWED AND SHOULD BE DONE TO ADD ADDITIONAL INFORMATIONS IN
 THE SECTIONS BELOW IF YOU CHANGE OR MODIFY THIS FILE.

/*****[CHANGES]**********************************************************
-=[Base]=-
-=[Mod]=-
 ************************************************************************/

// Variables needed after database setup to fill base-informations
$var_install['version'] = 'Nuke Evolution 2.1.0 Basic';
$var_install['bbconfig_sitename'] = 'Meine Seite';
$var_install['bbconfig_site_desc'] = 'Das ist meine Seite';
$var_install['bbconfig_server_name'] = 'meineseite.com';
$var_install['bbconfig_server_port'] = '80';
$var_install['bbconfig_cookie_domain'] = 'meineseite.com';
$var_install['bbconfig_cookie_path'] = '/';
$var_install['bbconfig_cookie_name'] = 'evolution';
$var_install['bbconfig_board_email'] = 'Webmaster@meineseite.com';
$var_install['bbconfig_board_email_sig'] = 'Danke\n, webmaster@meineseite.com';
$var_install['bbconfig_default_lang'] = 'german';
$var_install['bbconfig_default_dateformat'] = 'd.m.y';
$var_install['bbconfig_board_startdate'] = '1193889600';
$var_install['bbconfig_board_timezone'] = '1';
$var_install['bbconfig_record_online_date'] = '1193889600';

$var_install['bbposts_post_time'] = '1193889600';
$var_install['bbstats_config_install_date'] = '1193889600';
$var_install['bbtopics_topic_time'] = '1193889600';

$var_install['bbconfig_initial_group_id'] = '4';

$var_install['config_sitename'] = 'Meine Seite';
$var_install['config_nukeurl'] = 'http://--------.---';
$var_install['config_adminmail'] = 'webmaster@------.---';
$var_install['config_notify_email'] = 'webmaster@---------.---';
$var_install['config_notify_email'] = 'webmaster@---------.---';
$var_install['config_language'] = 'german';
$var_install['config_startdate'] = 'August 2008';

$var_install['nsnst_config_admin_contact'] = 'webmaster@---------.---';
$var_install['nsnst_config_version_check'] = '1195559810';
$var_install['cnbya_config_cookiepath'] = '';
$var_install['timeStamp'] = '961405160';
$var_install['users_regdate_Anonymous'] = date('M d, Y');
$var_install['evolution_cache_last_cleared'] = time();
$var_install['stories_time'] = '2008-08-01 04:00:00';

$var_install['config_backend_language'] = 'de-de';
$var_install['config_locale'] = 'de-DE';
$var_install['config_notify_from'] = 'webmaster';

$var_install['stories_aid'] = 'webmaster';


$var_install['tz'] = array(
        '-12'       => 'UTC - 12',
        '-11'       => 'UTC - 11',
        '-10'       => 'UTC - 10',
        '-9.5'      => 'UTC - 9:30',
        '-9'        => 'UTC - 9',
        '-8'        => 'UTC - 8',
        '-7'        => 'UTC - 7',
        '-6'        => 'UTC - 6',
        '-5'        => 'UTC - 5',
        '-4'        => 'UTC - 4',
        '-3.5'      => 'UTC - 3:30',
        '-3'        => 'UTC - 3',
        '-2'        => 'UTC - 2',
        '-1'        => 'UTC - 1',
        '0'         => 'UTC',
        '1'         => 'UTC + 1',
        '2'         => 'UTC + 2',
        '3'         => 'UTC + 3',
        '3.5'       => 'UTC + 3:30',
        '4'         => 'UTC + 4',
        '4.5'       => 'UTC + 4:30',
        '5'         => 'UTC + 5',
        '5.5'       => 'UTC + 5:30',
        '5.75'      => 'UTC + 5:45',
        '6'         => 'UTC + 6',
        '6.5'       => 'UTC + 6:30',
        '7'         => 'UTC + 7',
        '8'         => 'UTC + 8',
        '8.75'      => 'UTC + 8:45',
        '9'         => 'UTC + 9',
        '9.5'       => 'UTC + 9:30',
        '10'        => 'UTC + 10',
        '10.5'      => 'UTC + 10:30',
        '11'        => 'UTC + 11',
        '11.5'      => 'UTC + 11:30',
        '12'        => 'UTC + 12',
        '12.75'     => 'UTC + 12:45',
        '13'        => 'UTC + 13',
        '14'        => 'UTC + 14'
    );

$var_install['tz_zones'] = array(
        '-12'       => '[UTC - 12] Baker Island',
        '-11'       => '[UTC - 11] Niue, Samoa',
        '-10'       => '[UTC - 10] Hawaii-Aleutian, Cook Island',
        '-9.5'      => '[UTC - 9:30] Marquesas Islands',
        '-9'        => '[UTC - 9] Alaska, Gambier Island',
        '-8'        => '[UTC - 8] Pacific',
        '-7'        => '[UTC - 7] Mountain',
        '-6'        => '[UTC - 6] Central',
        '-5'        => '[UTC - 5] Eastern',
        '-4'        => '[UTC - 4] Atlantic',
        '-3.5'      => '[UTC - 3:30] Newfoundland',
        '-3'        => '[UTC - 3] Amazon, Central Greenland',
        '-2'        => '[UTC - 2] Fernando de Noronha, South Georgia &amp; the South Sandwich Islands',
        '-1'        => '[UTC - 1] Azores, Cape Verde, Eastern Greenland',
        '0'         => '[UTC - 0] Western European, Greenwich Mean',
        '1'         => '[UTC + 1] Central European, West African',
        '2'         => '[UTC + 2] Eastern European, Central African',
        '3'         => '[UTC + 3] Moscow, Eastern African',
        '3.5'       => '[UTC + 3:30] Iran',
        '4'         => '[UTC + 4] Gulf, Samara',
        '4.5'       => '[UTC + 4:30] Afghanistan',
        '5'         => '[UTC + 5] Pakistan, Yekaterinburg',
        '5.5'       => '[UTC + 5:30] Indian, Sri Lanka',
        '5.75'      => '[UTC + 5:45] Nepal',
        '6'         => '[UTC + 6] Bangladesh, Bhutan, Novosibirsk',
        '6.5'       => '[UTC + 6:30] Cocos Islands, Myanmar',
        '7'         => '[UTC + 7] Indochina, Krasnoyarsk',
        '8'         => '[UTC + 8] Chinese, Australian Western, Irkutsk',
        '8.75'      => '[UTC + 8:45] Southeastern Western Australia',
        '9'         => '[UTC + 9] Japan, Korea, Chita',
        '9.5'       => '[UTC + 9:30] Australian Central',
        '10'        => '[UTC + 10] Australian Eastern, Vladivostok',
        '10.5'      => '[UTC + 10:30] Lord Howe',
        '11'        => '[UTC + 11] Solomon Island, Magadan',
        '11.5'      => '[UTC + 11:30] Norfolk Island',
        '12'        => '[UTC + 12] New Zealand, Fiji, Kamchatka',
        '12.75'     => '[UTC + 12:45] Chatham Islands',
        '13'        => '[UTC + 13] Tonga, Phoenix Islands',
        '14'        => '[UTC + 14] Line Island',
    );
?>