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

global $db, $cache, $lang_block, $evoconfig;
$module_name = 'Downloads';
$showlines = 5; // Define here the number of Up-/Downloads which should be shown

function Block_DownloadAccessConfig() {
  global $db, $cache;
  static $downloadsconfig;
    if(isset($downloadsconfig) && is_array($downloadsconfig)) { return $downloadsconfig; }
    if ((($downloadsconfig = $cache->load('Downloads', 'config')) === false) || empty($downloadsconfig)) {
        $result = $db->sql_query('SELECT `config_value`, `config_name` from `'._DOWNLOADS_CONFIG_TABLE.'`');
        while ($row = $db->sql_fetchrow($result)) {
            $downloadsconfig[$row['config_name']] = $row['config_value'];
        }
        $cache->save('Downloads', 'config', $downloadsconfig);
        $db->sql_freeresult($result);
    }
    return $downloadsconfig;
}

$downloadblockconfig = $cache->load('Downloads', 'config');
if ( empty($downloadblockconfig) ) {
    $downloadblockconfig = Block_DownloadAccessConfig();
}

function block_DownloadAccess_cache($block_cachetime, $showlines) {
    global $db, $cache;
    if ((($blockcache = $cache->load('downloadaccess', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        $result = $db->sql_query('SELECT dt.user_id,  count(dt.did) as counted, du.username
                                FROM `'._DOWNLOADS_HISTORY_TABLE.'` as dt,`'. _USERS_TABLE.'` as du 
                                WHERE du.user_id = dt.user_id
                                AND dt.type = 0
                                AND  dt.status=9
                                GROUP BY dt.user_id ORDER BY counted DESC LIMIT 0,'.$showlines);
        $a = 0;
        while (list($user_id, $uploads, $username) = $db->sql_fetchrow($result)) {
            $a++;
            $blockcache[$a]['username']  = $username;
            $blockcache[$a]['uploads']   = $uploads;
            $blockcache[$a]['user_id']   = $user_id;
        }
        $db->sql_freeresult($result);
        $result = $db->sql_query('SELECT dt.user_id,  count(dt.did) as counted, du.username
                                FROM `'._DOWNLOADS_HISTORY_TABLE.'` as dt,`'. _USERS_TABLE.'` as du 
                                WHERE du.user_id = dt.user_id
                                AND dt.type > 0
                                AND  dt.status=9
                                GROUP BY dt.user_id ORDER BY counted DESC LIMIT 0,'.$showlines);
        while (list($user_id, $downloads, $username) = $db->sql_fetchrow($result)) {
            $a++;
            $blockcache[$a]['username']  = $username;
            $blockcache[$a]['downloads'] = $downloads;
            $blockcache[$a]['user_id']   = $user_id;
        }
        $result = $db->sql_ufetchrow('SELECT SUM(`hits`) as hits FROM `'._DOWNLOADS_DOWNLOADS_TABLE.'` WHERE `download_active`= 1');
        $blockcache[0]['hits'] = $result['hits'];
        $db->sql_freeresult($result);
        $result = $db->sql_ufetchrow('SELECT COUNT(`did`) as totalfiles FROM `'._DOWNLOADS_DOWNLOADS_TABLE.'` WHERE `download_active`= 1');
        $blockcache[0]['totalfiles'] = $result['totalfiles'];
        $db->sql_freeresult($result);
        $blockcache[0]['stat_created'] = time();
        $cache->save('downloadaccess', 'blocks', $blockcache);
    }
    return $blockcache;
}

$blocksession    = block_DownloadAccess_cache($evoconfig['block_cachetime'], $showlines);

$blockcontent    = '';
$uploadcontent   = '';
$downloadcontent = '';
$totalhits       = $blocksession[0]['hits'];
$totalfiles      = $blocksession[0]['totalfiles'];
$uploadcount     = 0;
$downloadcount   = 0;
for ($a = 1, $max = $max = count($blocksession); $a < $max; $a++) {
    if (isset($blocksession[$a]['uploads'])) {
        $uploadcount++;
        $username = $blocksession[$a]['username'];
        $accesses = $blocksession[$a]['uploads'];
        $uploadcontent .= "<div style='float: left;width: 10%;'><img src='".evo_image('arrow.png', 'blocks/modules')."' alt='' title='' />&nbsp;</div>\n";
        $uploadcontent .= "<div style='float: left;width: 90%;font-weight: bold;font-size: x-small;white-space: normal;'>&nbsp;".$uploadcount.":&nbsp;<a href='modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$username."'>". UsernameColor($username) ."</a>&nbsp;($accesses)&nbsp;</div><br />\n";
//        $uploadcontent .= "<div style='clear: both;'></div><br />\n";

    } else {
        $downloadcount++;
        $username = $blocksession[$a]['username'];
        $accesses = $blocksession[$a]['downloads'];
        $downloadcontent .= "<div style='float: left;width: 10%;'><img src='".evo_image('arrow.png', 'blocks/modules')."' alt='' title='' />&nbsp;</div>\n";
        $downloadcontent .= "<div style='float: left;width: 90%;font-weight: bold;font-size: x-small;white-space: normal;'>&nbsp;".$downloadcount.":&nbsp;<a href='modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$username."'>". UsernameColor($username) ."</a>&nbsp;($accesses)&nbsp;</div><br />\n";
//        $downloadcontent .= "<div style='clear: both;'></div><br />\n";
    }
}

$content = "<div style='width: 100%;'>\n";
if (empty($uploadcontent) && empty($downloadcontent)) {
    $content .= "<div style='text-align:center;font-size: x-small;'>".$lang_block['BLOCK_NO_CONTENT']."</div>\n";
} else {
    $content .= "<div style='text-align:left;'><img src='". evo_image('uploads.png', 'blocks') ."' height='16' width='16' alt='".$lang_block['Download_Top_Uploader']."' title='".$lang_block['Download_Top_Uploader']."' />&nbsp;<strong>".$lang_block['Download_Top_Uploader'].":</strong><br /></div>\n";
    $content .= $uploadcontent."<br />\n";
    $content .= "<div style='text-align:left;'><img src='". evo_image('downloads.png', 'blocks') ."' height='16' width='16' alt='".$lang_block['Download_Top_Downloads']."' title='".$lang_block['Download_Top_Downloads']."'/>&nbsp;<strong>".$lang_block['Download_Top_Downloads'].":</strong><br /></div>\n";
    $content .= $downloadcontent."<br />\n";
    $content .= "<div style='text-align:left;'><img src='". evo_image('totals.png', 'blocks') ."' height='16' width='16' alt='".$lang_block['Download_Statistic']."' title='".$lang_block['Download_Statistic']."'/>&nbsp;<strong>".$lang_block['Download_Statistic'].":</strong><br /></div>\n";

    $content .= "<div style='float: left;width: 10%;'><img src='".evo_image('arrow.png', 'blocks/modules')."' alt='' title='' />&nbsp;</div>\n";
    $content .= "<div style='float: left;width: 90%;text-align:left;font-size: x-small;'>".$lang_block['Download_Total_Files'].":&nbsp;".$totalfiles."</div><br />\n";

    $content .= "<div style='float: left;width: 10%;'><img src='".evo_image('arrow.png', 'blocks/modules')."' alt='' title='' />&nbsp;</div>\n";
    $content .= "<div style='float: left;width: 90%;text-align:left;font-size: x-small;'>".$lang_block['Download_Total_Hits'].":&nbsp;".$totalhits."</div>\n";
}
$content .= "</div>\n";

?>