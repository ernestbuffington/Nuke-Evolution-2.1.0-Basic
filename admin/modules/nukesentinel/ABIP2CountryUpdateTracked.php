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

if (!defined('NUKESENTINEL_ADMIN')) {
   die ('You can\'t access this file directly...');
}

global $admin_file, $db, $ab_config, $_GETVAR, $bgcolor2;

if (is_admin()) {

    $min        = $_GETVAR->get('min', '_REQUEST', 'int', 0);
    $max        = $_GETVAR->get('max', '_REQUEST', 'int', 0);
    $xc2c       = $_GETVAR->get('xc2c', '_REQUEST', 'string');
    @set_time_limit(600);
    $perpage = 200;
    if (!$ab_config['page_delay'] OR $ab_config['page_delay'] < 1) {
        $pagedelay = 5;
    } else {
        $pagedelay = $ab_config['page_delay'];
    }
    $totalselected = $db->sql_unumrows("SELECT DISTINCT(`ip_addr`) FROM `"._SENTINEL_TRACKED_IPS_TABLE."`");
    if ($min == 0) {
        $pagesint = ($totalselected / $perpage);
        $pages = ceil($pagesint);
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        OpenMenu(_AB_IP2CUPDATETRACKED);
        mastermenu();
        CarryMenu();
        ip2cmenu();
        CloseMenu();
        CloseTable();
        echo '<br />'."\n";
        OpenTable();
        echo _AB_IP2CUPDATETRACKED01.'<br />'."\n";
        echo _AB_IP2CUPDATETRACKED02.'<br />'."\n";
        echo _AB_IP2CINSECTIONS.'<br />'."\n";
        echo _AB_YOUHAVE.$pages._AB_SECTIONSTOGO.'<br />'."\n";
        echo _AB_IP2CUPDATE04C.'<br />'."\n";
        echo '<br />'."\n";
        echo '<form action="'.$admin_file.'.php" method="post">'."\n";
        echo '<input type="hidden" name="op" value="ABIP2CountryUpdateTracked" />'."\n";
        echo '<input type="hidden" name="min" value="1" />'."\n";
        echo '<input type="submit" value="'._AB_LETSGETSTART.'" />'."\n";
        echo '</form>'."\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else if($min < $totalselected) {
        $db->sql_uquery("UPDATE `"._SENTINEL_CONFIG_TABLE."` SET `config_value`='1' WHERE `config_name`='site_switch'");
        $ab_config['site_switch'] = 1;
        $result = $db->sql_query("SELECT DISTINCT(`ip_addr`) FROM `"._SENTINEL_TRACKED_IPS_TABLE."` LIMIT $min, $perpage");
        while(list($xip_addr) = $db->sql_fetchrow($result)) {
            $xip_long = sprintf("%u", ip2long($xip_addr));
            list($xc2c) = $db->sql_ufetchrow("SELECT `c2c` FROM `"._SENTINEL_IP2COUNTRY_TABLE."` WHERE `ip_lo`<='$xip_long' AND `ip_hi`>='$xip_long' LIMIT 0,1");
            if (!$xc2c) {
                $xc2c = "00";
            }
            $db->sql_uquery("UPDATE `"._SENTINEL_TRACKED_IPS_TABLE."` SET `c2c`='$xc2c' WHERE `ip_addr`='$xip_addr'");
        }
        $db->sql_freeresult($result);
        $max=$min+$perpage;
        $pagesint = ($totalselected / $perpage);
        $pages = ceil($pagesint);
        $currentpage = ($max / $perpage);
        $pagetitle = _AB_NUKESENTINEL.": "._AB_IP2CUPDATETRACKED;
        include_once(NUKE_BASE_DIR.'header.php');
        title($pagetitle);
        OpenTable();
        echo '<script type="text/javascript"><!--'."\n";
        echo 'setTimeout(\'Redirect()\','.($pagedelay*1000).');'."\n";
        echo 'function Redirect()'."\n";
        echo '{'."\n";
        echo ' location.href = \''.$admin_file.'.php?op=ABIP2CountryUpdateTracked&min='.$max.'\';'."\n";
        echo '}'."\n";
        echo '// --></script>'."\n";
        echo '<strong>'._AB_SECTION.' '.$currentpage.' '._AB_OF.' '.$pages.' '._AB_COMPLETED.'</strong><br />'."\n";
        if ($currentpage < $pages) {
            echo '<strong>'._AB_SECTION.' '.($currentpage+1).' '._AB_WILLSTART.'</strong><br />'."\n";
        }
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        $db->sql_uquery("UPDATE `"._SENTINEL_CONFIG_TABLE."` SET `config_value`='0' WHERE `config_name`='site_switch'");
        $ab_config['site_switch'] = 0;
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        OpenMenu(_AB_IP2CUPDATETRACKED);
        mastermenu();
        CarryMenu();
        ip2cmenu();
        CloseMenu();
        CloseTable();
        echo '<br />'."\n";
        OpenTable();
        echo '<center><strong>'._AB_IP2CUPDATETRACKED.' '._AB_COMPLETED.'</strong></center>'."\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>