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

global $admin_file, $_GETVAR, $db;

if (is_admin()) {

    $importer   = $_GETVAR->get('importer', '_REQUEST', 'string', '');
    $importmess = '';
    @set_time_limit(600);
    $pagetitle = _AB_NUKESENTINEL.": "._AB_ADMINISTRATION.": "._AB_IMPORTRANGE;
    include("header.php");
    OpenTable();
    OpenMenu(_AB_IMPORTRANGE);
    mastermenu();
    CarryMenu();
    importmenu();
    CloseMenu();
    CloseTable();
    echo "<br />\n";
    OpenTable();
    ABLoadDataMenu($importer, "ABImportBlockedRange");
    if(isset($importer) AND $importer > "") {
        echo "<hr />\n";
        // Read and import Country Data
        $import_data = @file(NUKE_INCLUDE_DIR."nukesentinel/import/".$importer.".data");
        $import_data = (is_array($import_data)) ? implode($import_data) : '';
        if (!$import_data OR $import_data == "") {
            echo "<center><strong>"._AB_UNAVAILABLE."</strong></center>\n";
        } else {
            $import_data - str_replace("\r", "", $import_data);
            $import_data = explode("\n", $import_data);
            $import_count = count($import_data);
            $importmess = _AB_EVERYTHINGSUCCESSFULLY."<br />\n";
            for ($i=0; $i < $import_count; $i++) {
                $import_data[$i] = trim($import_data[$i]);
                if ($import_data[$i] > "") {
                    $grabline = explode("||", $import_data[$i]);
                    if ($grabline[0] == "--") {
                        $db->sql_uquery("DELETE FROM `"._SENTINEL_BLOCKED_RANGES_TABLE."` WHERE `c2c`='".$grabline[3]."'");
                        $db->sql_uquery("OPTIMIZE TABLE `"._SENTINEL_BLOCKED_RANGES_TABLE."`");
                    } else {
                        $grabline['ip_lo'] = long2ip($grabline[0]);
                        $grabline['ip_hi'] = long2ip($grabline[1]);
                        $datainserted = False;
                        $importby = _AB_IMPORTBY." "._AB_NUKESENTINEL;
                        $datetime = time();
                        $datainserted = $db->sql_uquery("INSERT INTO `"._SENTINEL_BLOCKED_RANGES_TABLE."` (c2c, date, expires, ip_hi, ip_lo, notes, reason) VALUES('$grabline[3]', '$datetime', 0, '$grabline[1]', '$grabline[0]', '$importby', '')");
                        if(!$datainserted) {
                            echo "<strong>$grabline[ip_lo] - $grabline[ip_hi] "._AB_NOTINSERTED." "._SENTINEL_BLOCKED_RANGES_TABLE."</strong><br />\n";
                            $importmess = "";
                        }
                    }
                }
            }
        }
    }
    echo "$importmess<br />\n";
CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>