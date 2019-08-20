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

if(!defined('HEADER')) return;
if (defined('LOADER')) return;

define('NUKE_FOOTER', true);

function footmsg() {
    global $evoconfig, $total_time, $start_time, $footmsg, $db, $queries_count, $use_cache, $debugger, $debug, $cache, $start_mem;
    static $has_echoed;
    if(isset($has_echoed) && $has_echoed == 1) { return; }
    $footmsg = "<div class=\"footmsg\"><br />\n";
    if (!empty($evoconfig['foot1'])) {
        $footmsg .= $evoconfig['foot1']."<br />\n";
    }
    if (!empty($evoconfig['foot2'])) {
        $footmsg .= $evoconfig['foot2']."<br />\n";
    }
    if (!empty($evoconfig['foot3'])) {
        $footmsg .= $evoconfig['foot3']."<br />\n";
    }

    if($use_cache && $evoconfig['usrclearcache']) {
        $footmsg .= "<form method='post' name='clear_cache' action='".htmlspecialchars($_SERVER['REQUEST_URI'])."'>";
        $footmsg .= "<input type='hidden' name='clear_cache' value='1' /><span style='font-size: 11px;'>";
        $footmsg .= _SITECACHED . "</span> <a href=\"javascript:document.clear_cache.submit()\">" . _UPDATECACHE . "</a>";
        $footmsg .= "</form>";
    }
    $total_time = get_microtime() - $start_time;
    $total_time = '<span class="copyright">[ '._PAGEGENERATION." ".sprintf("%01.2f", ($total_time))." "._SECONDS;
    if ($start_mem > 0) {
        $total_mem = memory_get_usage()-$start_mem;
        $total_time .= ' | '._MEMORYUSAGE.' '.(($total_mem >= 1048576) ? round((round($total_mem / 1048576 * 100) / 100), 2).' MB' : (($total_mem >= 1024) ? round((round($total_mem / 1024 * 100) / 100), 2).' KB' : $total_mem.' Bytes'));
    }
    if($queries_count) {
        $total_time .= ' | '._DBQUERIES.' ' . $db->num_queries;
    }
    $total_time .= ' ]';
    $total_time .= '</span>';
    if(is_admin()) {
        $first_time = false;
        if (($last_optimize = $cache->load('last_optimize', 'config')) === false) {
            $last_optimize = time();
            $first_time = true;
        }
        //For information on how to change the auto-optimize intervals
        //Please see www.php.net/strtotime
        //Default: -1 day
        $interval = strtotime('-1 day');
        if (($last_optimize <= $interval) || ($first_time && $cache->valid && $use_cache))
        {
            if ($db->sql_optimize()) {
                $cache->save('last_optimize', 'config', time());
                $total_time .='<br />' ._OPTIMIZE_DB;
            }
        }
    }
    $footmsg .= $total_time."<br />\n";
    if(is_admin() && $debugger->debug && count($debugger->errors) > 0) {
        $footmsg .= "<br /><div align=\"center\"><strong>Debugging:</strong></div>";
        $footmsg .= "<div align='center'>";
        $footmsg .= $debugger->return_errors();
        $footmsg .= "</div>";
    }
    if (is_admin()) {
        $footmsg .= $db->print_debug();
    }
    $debug_sql = false;
    if (is_admin() && !is_bool($debug) && $debug == 'full') {
        $strstart = strlen(NUKE_BASE_DIR);
        $debug_sql = '<span style="font-weight: bold;">SQL Debug:</span><br /><br />';
        foreach ($db->querylist as $file => $queries) {
            $file = substr($file, $strstart);
            if (empty($file)){ $file = 'unknown file';}
            $debug_sql .= '<span style="font-weight: bold;">'.$file.'</span><ul>';
            foreach ($queries as $query) {
                $explode_query = explode(' ', $query);
                foreach ($explode_query as $k => $v){
                    $count = strlen($explode_query[$k]);
                    if($count >= 140){
                        $explode_query[$k] = wordwrap($explode_query[$k], 140, "\n", true);
                    }
                }
                $query = implode(' ', $explode_query);
                $debug_sql .= "<li>$query</li>";
            }
            $debug_sql .= '</ul>';
        }
        $debug_sql .= '<span style="color: #0000FF; font-weight: bold;">*</span> - Result freed<br /><br />';
    }
    $footmsg .= $debug_sql;
    unset($debug_sql);
    global $browser;
    if ($browser == 'Bot' || $browser == 'Other') {
        $footmsg .= "<span style=\"display:none;\"><a href=\"trap.php\" >Do Not Click</a></span>\n";
    }
    // DO NOT REMOVE THE FOLLOWING COPYRIGHT LINES. YOU'RE NOT ALLOWED TO REMOVE NOR EDIT THIS.
    // IF YOU REALLY NEED TO REMOVE IT YOU NEED OUR WRITTEN AUTHORIZATION.
    // CHECK: http://www.evo-german.com/modules.php?name=Commercial_License
    // PLAY FAIR AND SUPPORT THE DEVELOPMENT, PLEASE!
    $footmsg .= '<div style="font-size:x-small; text-align:center;">';
    $footmsg .= (preg_match(HEX_PREG,$evoconfig['copyright'])) ? "\n<br />".$evoconfig['copyright']."<br />\n" : "\n<br />".ord_crypt_decode(HEX_CACHED)."<br />\n";
    $footmsg .= "</div>\n</div>";
    echo $footmsg;
    // END COPYRIGHT
    $has_echoed = 1;
}

global $db, $footmsg, $name, $persistency, $do_gzip_compress, $cache;
if(defined('HOME_FILE')) {
    blocks('Down');
}
if (!defined('HOME_FILE') AND defined('MODULE_FILE') AND @file_exists(NUKE_MODULES_DIR.$name.'/copyright.php')) {
    $cpname = str_replace("_", " ", $name);
    echo "<div align=\"right\"><a href=\"javascript:openwindow()\">$cpname &copy;</a></div>";
}
if (!defined('HOME_FILE') AND defined('MODULE_FILE') AND (@file_exists(NUKE_MODULES_DIR.$name.'/admin/panel.php') && is_admin())) {
    echo "<br />";
    OpenTable();
    include_once(NUKE_MODULES_DIR . $name . '/admin/panel.php');
    CloseTable();
}
if(!defined('ADMIN_FILE')) {
    echo '</div>';
}

themefooter();
if (@file_exists(NUKE_INCLUDE_DIR . 'custom_files/custom_footer.php')) {
    include_once(NUKE_INCLUDE_DIR . 'custom_files/custom_footer.php');
}
echo "\n</body>\n</html>";
$cache->resync();
$db->sql_close();

if(GZIPSUPPORT && $do_gzip_compress) {
    $gzip_contents = ob_get_contents();
    ob_end_clean();
    $gzip_size = strlen($gzip_contents);
    $gzip_crc = crc32($gzip_contents);
    $gzip_contents = gzcompress($gzip_contents, 9);
    $gzip_contents = substr($gzip_contents, 0, strlen($gzip_contents) - 4);
    echo "\x1f\x8b\x08\x00\x00\x00\x00\x00";
    echo $gzip_contents;
    echo pack('V', $gzip_crc);
    echo pack('V', $gzip_size);
}
ob_end_flush();
exit;

?>