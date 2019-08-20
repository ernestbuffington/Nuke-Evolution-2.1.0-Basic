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

$content = '';

global $currentlang;
include_lang($currentlang);

if (is_admin()) {
    function block_submissions_cache() {
        global $db, $cache;
        static $blockcache;
        if ( (isset($blockcache)) && (is_array($blockcache)) && ($blockcache[0]['stat_created'] < time() - 3600) ) {
            return $blockcache;
        }
        $a = 0;
        $handle = @opendir(NUKE_MODULES_DIR);
        while(false !== ($module = @readdir($handle))) {
            $a++;
            if (is_active($module) && @file_exists(NUKE_MODULES_DIR . $module . '/admin/wait.php')) {
                $blockcache[$a] = $module;
            }
        }
        @closedir($handle);
        @sort($blockcache);
        $tempvalue['stat_created'] = time();
        @array_unshift($blockcache, $tempvalue);
        $cache->save('block', 'submissions', $blockcache);
        return $blockcache;
    }

    $blocksession = block_submissions_cache();

    for ($a = 1, $max = count($blocksession); $a < $max; $a++) {
        @include_once(NUKE_MODULES_DIR . $blocksession[$a] . '/admin/wait.php');
        $content .= "<br />\n";
    }

} else {
    $content .="<span style='text-align: center; font-weight: bold;'>".$lang_block['BLOCK_NO_CONTENT']."</span>\n";
}

?>