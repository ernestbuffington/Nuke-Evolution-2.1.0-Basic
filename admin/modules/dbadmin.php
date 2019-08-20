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

if (!defined('ADMIN_FILE')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

$adminpoint = @basename(__FILE__,'.php');
global $db, $admin_file, $lang_admin, $_GETVAR;

if(is_god_admin()) {
    getmodule_lang($adminpoint);
    function DB_Admin_Header() {
        global $admin_file, $adminpoint, $lang_admin;
        include_once(NUKE_BASE_DIR.'header.php');
        echo "<script type=\"text/javascript\">\n";
        echo "<!--\n";
        echo "  function checkAll(numTables) {
                    for (var j = 0; j <= numTables+2; j++) {
                        document.forms.DBAdmin.elements[j].checked = true;
                    }
                }

                function uncheckAll(numTables) {
                    for (var j = 0; j <= numTables+2; j++) {
                        document.forms.DBAdmin.elements[j].checked = false;
                    }
                }

                function switchAll(numTables) {
                    for (var j = 0; j <= numTables+2; j++) {
                        if (document.forms.DBAdmin.elements[j].checked)
                            document.forms.DBAdmin.elements[j].checked = false;
                        else
                            document.forms.DBAdmin.elements[j].checked = true;
                    }
                }\n";
        echo "//-->\n";
        echo "</script>\n\n";

        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=DB_Admin\">" . $lang_admin[$adminpoint]['ADMIN_HEADER'] . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $lang_admin[$adminpoint]['ADMIN_GO_MAIN'] . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
    }

    function DB_Admin_Menu() {
        global $adminpoint, $lang_admin, $admin_file;
        OpenTable();
        echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['MAIN_HEADER'] . "</strong></span></center><br /><br /><hr noshade=\"noshade\" /><br />";
        echo "<table class='admintable' style='width:100%;'>\n";
        echo "<tr class='TableRow'>\n";
        echo "<td class='TableColumn' style='width:7.5%;'>&nbsp;</td>\n";
        echo "<td class='TableColumn' style='width:21.25%;' align='left' ><span class=\"content\"><a href=\"".$admin_file.".php?op=DB_Admin_ShowStatistics\">" . $lang_admin[$adminpoint]['TITLE_SHOW_STATISTICS'] . "</a></span></td>\n";
        echo "<td class='TableColumn' style='width:21.25%;' align='left' ></td>\n";
        echo "<td class='TableColumn' style='width:21.25%;' align='left' ><span class=\"content\"><a href=\"".$admin_file.".php?op=DB_Admin_DeleteTables\">" . $lang_admin[$adminpoint]['TITLE_TABLES_DELETE'] . "</a></span></td>\n";
        echo "<td class='TableColumn' style='width:21.25%;' align='left' ><span class=\"content\"><a href=\"".$admin_file.".php?op=DB_Admin_BackupTables\">" . $lang_admin[$adminpoint]['TITLE_TABLES_BACKUP'] . "</a></span></td>\n";
        echo "<td class='TableColumn' style='width:7.5%;'>&nbsp;</td>\n";
        echo "</tr>\n";

        echo "<tr class='TableRow'>\n";
        echo "<td class='TableColumn' style='width:7.5%;'>&nbsp;</td>\n";
        echo "<td class='TableColumn' style='width:21.25%;' align='left' ><span class=\"content\"><a href=\"".$admin_file.".php?op=DB_Admin_AnalyzeDB\">" . $lang_admin[$adminpoint]['TITLE_ANALYZE_DB'] . "</a></span></td>\n";
        echo "<td class='TableColumn' style='width:21.25%;' align='left' ></td>\n";
        echo "<td class='TableColumn' style='width:21.25%;' align='left' ><span class=\"content\"><a href=\"".$admin_file.".php?op=DB_Admin_OptimizeDB\">" . $lang_admin[$adminpoint]['TITLE_OPTIMIZE_DB'] . "</a></span></td>\n";
        echo "<td class='TableColumn' style='width:21.25%;' align='left' ><span class=\"content\"><a href=\"".$admin_file.".php?op=DB_Admin_BackupTablesShow\">" . $lang_admin[$adminpoint]['TITLE_TABLES_BACKUP_SHOW'] . "</a></span></td>\n";
        echo "<td class='TableColumn' style='width:7.5%;'>&nbsp;</td>\n";
        echo "</tr>\n";

        echo "<tr class='TableRow'>\n";
        echo "<td class='TableColumn' style='width:7.5%;'>&nbsp;</td>\n";
        echo "<td class='TableColumn' style='width:21.25%;' align='left' ></td>\n";
        echo "<td class='TableColumn' style='width:21.25%;' align='left' ></td>\n";
        echo "<td class='TableColumn' style='width:21.25%;' align='left' ></td>\n";
        echo "<td class='TableColumn' style='width:21.25%;' align='left' ></td>\n";
        echo "<td class='TableColumn' style='width:7.5%;'>&nbsp;</td>\n";
        echo "</tr>\n";

        echo "<tr class='TableRow'>\n";
        echo "<td class='TableColumn' style='width:7.5%;'>&nbsp;</td>\n";
        echo "<td class='TableColumn' style='width:21.25%;' align='left' ></td>\n";
        echo "<td class='TableColumn' style='width:21.25%;' align='left' ></td>\n";
        echo "<td class='TableColumn' style='width:21.25%;' align='left' ></td>\n";
        echo "<td class='TableColumn' style='width:21.25%;' align='left' ></td>\n";
        echo "<td class='TableColumn' style='width:7.5%;'>&nbsp;</td>\n";
        echo "</tr>\n";
        echo "</table>\n";
        CloseTable();
    }

    function DB_Admin_Footer() {
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function DB_Admin_GetDatabaseInfos() {
        global $db, $adminpoint, $lang_admin;
        static $database_info;
        if ( !is_array($database_info) || $database_info[0]['Status'] != 'OK' ) {
            $database_info = array();
            $count = 0;
            $database_info[0]['DatabaseSize'] = 0;
            $result = $db->sql_query('SHOW TABLE STATUS');
            if (!$result) {
                $database_info[0]['Status']  = 'NOK';
                $database_info[0]['Message'] = $lang_admin[$adminpoint]['DATABASE_QUERY_NO_RIGHT'];
            } else {
                $database_info[0]['Status']  = 'OK';
                $database_info[0]['Message'] = $lang_admin[$adminpoint]['DATABASE_QUERY_RESULT'];
                while ($result_row = $db->sql_fetchrow($result)) {
                    $count++;
                    $database_info[$count]['TableName']      = $result_row['Name'];
                    $result2 = $db->sql_fetchrow($db->sql_query('ANALYZE TABLE '.$result_row['Name']));
                    switch ($result2['Msg_type']) {
                        case 'status':
                            $database_info[$count]['TableAnalyzeTyp'] = $lang_admin[$adminpoint]['DB_TABLE_ANALYZE_STATUS'];
                            break;
                        case 'error':
                            $database_info[$count]['TableAnalyzeTyp'] = '<span style="color:red;">'.$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_ERROR'].'</span>';
                            break;
                        case 'info':
                            $database_info[$count]['TableAnalyzeTyp'] = $lang_admin[$adminpoint]['DB_TABLE_ANALYZE_INFO'];
                            break;
                        case 'warning':
                            $database_info[$count]['TableAnalyzeTyp'] = '<span style="color:red;">'.$lang_admin[$adminpoint]['DB_TABLE_ANALYZE_WARNING'].'</span>';
                            break;
                    }
                    $database_info[$count]['TableAnalyzeOp']  = $lang_admin[$adminpoint]['DB_TABLE_ANALYZE_OP_ANALYZE'];
                    if ( $result2['Msg_text'] == 'OK' || $result2['Msg_text'] == 'Table is already up to date' ) {
                        $database_info[$count]['TableAnalyzeMsg'] = 'OK';
                    } else {
                        $database_info[$count]['TableAnalyzeMsg'] = $result2['Msg_text'];
                    }
                    $database_info[$count]['TableType'] = (isset($result_row['Type']) ? $result_row['Type'] : $result_row['Row_format']);
                    switch ($result_row['Row_format']) {
                        case 'Fixed':
                            $database_info[$count]['TableRowFormat'] = $lang_admin[$adminpoint]['DB_TABLE_TYPE_FIXED'];
                            break;
                        case 'Dynamic':
                            $database_info[$count]['TableRowFormat'] = $lang_admin[$adminpoint]['DB_TABLE_TYPE_DYNAMIC'];
                            break;
                        case 'Compressed':
                            $database_info[$count]['TableRowFormat'] = $lang_admin[$adminpoint]['DB_TABLE_TYPE_COMPRESSED'];
                            break;
                        case 'Redundant':
                            $database_info[$count]['TableRowFormat'] = $lang_admin[$adminpoint]['DB_TABLE_TYPE_REDUNDANT'];
                            break;
                        case 'Compact':
                            $database_info[$count]['TableRowFormat'] = $lang_admin[$adminpoint]['DB_TABLE_TYPE_FIXED'];
                            break;
                        default:
                            $database_info[$count]['TableRowFormat'] = $lang_admin[$adminpoint]['DB_TABLE_TYPE_DYNAMIC'];
                            break;
                    }
                    $database_info[$count]['TableRows']      = ((isset($result_row['Rows']) && !empty($result_row['Rows'])) ? $result_row['Rows'] : 0);
                    $database_info[$count]['TableSize']      = ((isset($result_row['Data_length']) && !empty($result_row['Data_length'])) ? $result_row['Data_length'] : 0);
                    $database_info[0]['DatabaseSize']        = $database_info[0]['DatabaseSize'] + $result_row['Data_length'];
                    $database_info[$count]['TableSizeMax']   = $result_row['Max_data_length'];
                    $database_info[$count]['TableIncrement'] = ((isset($result_row['Auto_increment']) && !empty($result_row['Auto_increment'])) ? $result_row['Auto_increment'] : $lang_admin[$adminpoint]['NONE']);
                    $database_info[$count]['TableCreated']   = $result_row['Create_time'];
                    $database_info[$count]['TableUpdated']   = $result_row['Update_time'];
                    $database_info[$count]['TableChecked']   = $result_row['Check_time'];
                    $database_info[$count]['TableCollation'] = ((isset($result_row['Collation']) && !empty($result_row['Collation'])) ? $result_row['Collation'] : '---');
                    $database_info[$count]['TableComment']   = ((isset($result_row['Comment']) && !empty($result_row['Comment']))  ? $result_row['Comment'] : '---');
                }
                $db->sql_freeresult($result);
                $database_info[0]['Num_Tables'] = $count;
            }
        }
        return $database_info;
    }

    function DB_Admin_AnalyzeDB() {
        global $adminpoint, $lang_admin, $bgcolor1, $bgcolor2;
        DB_Admin_Header();
        DB_Admin_Menu();
        OpenTable();
        echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['TITLE_ANALYZE_DB'] . "</strong></span></center><br /><br />";
        $database_actual = DB_Admin_GetDatabaseInfos();
        if ($database_actual[0]['Num_Tables'] > 0) {
            echo "<table class='admintable' style='width:50%;' align='center'>\n";
            echo "<tr class='TableRow'>\n";
            echo "<td class='TableColumn' align='left' >".$lang_admin[$adminpoint]['STATISTICS_DATABASE_SIZE']."</td>\n";
            echo "<td class='TableColumn' align='right' >".round(($database_actual[0]['DatabaseSize']/1024/1024), 2)."&nbsp;".$lang_admin[$adminpoint]['MB']."</td>\n";
            echo "</tr>\n";
            echo "<tr class='TableRow'>\n";
            echo "<td class='TableColumn' align='left' >".$lang_admin[$adminpoint]['STATISTICS_DATABASE_TABLES']."</td>\n";
            echo "<td class='TableColumn' align='right' >".$database_actual[0]['Num_Tables']."</td>\n";
            echo "</tr>\n";
            echo "</table>\n<br />";
            echo "<table class='admintable' style='width:90%;'>\n";
            echo "<tr class='TableRow'>\n";
            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['ANALYZE_HEADER_NAME']."</th>\n";
            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['ANALYZE_HEADER_OP']."</th>\n";
            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['ANALYZE_HEADER_MSGTYPE']."</th>\n";
            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['ANALYZE_HEADER_MSGTEXT']."</th>\n";
            echo "</tr>\n";
            $colorchange = 0;
            for ( $i = 1; $i<=$database_actual[0]['Num_Tables']; $i++) {
                if ($colorchange == 0) {
                    $columncolor = $bgcolor1;
                } else {
                    $columncolor = $bgcolor2;
                }
                echo "<tr class='TableRow' style='background-color:".$columncolor.";'>\n";
                echo "<td class='TableColumn' align='left' >".$database_actual[$i]['TableName']."</td>\n";
                echo "<td class='TableColumn' align='left' >".$database_actual[$i]['TableAnalyzeOp']."</td>\n";
                echo "<td class='TableColumn' align='left' >".$database_actual[$i]['TableAnalyzeTyp']."</td>\n";
                echo "<td class='TableColumn' align='left' >".$database_actual[$i]['TableAnalyzeMsg']."</td>\n";
                echo "</tr>\n";
                $colorchange = ($colorchange == 0 ? 1: 0);
            }
            echo "</table>\n";
        } elseif ( $database_info[0]['Status'] == 'NOK' ) {
            echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['DATABASE_QUERY_NO_RIGHT'] . "</strong></span></center><br />";
        } else {
            echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['DATABASE_QUERY_NO_RESULT'] . "</strong></span></center><br />";
        }
        CloseTable();
        DB_Admin_Footer();
    }

    function DB_Admin_OptimizeDB($optimize='') {
        global $admin_file, $adminpoint, $lang_admin, $bgcolor1, $bgcolor2, $_GETVAR;
        DB_Admin_Header();
        DB_Admin_Menu();
        OpenTable();
        echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['TITLE_OPTIMIZE_DB'] . "</strong></span></center><br /><br />";
        $database_actual = DB_Admin_GetDatabaseInfos();
        if ($database_actual[0]['Num_Tables'] > 0) {
            if ( $optimize != 'optimize' ) {
                echo "<form name='DBAdmin' action='".$admin_file.".php?op=DB_Admin_OptimizeDBConfirm' method='post' accept-charset='UTF-8'>\n";
            } else {
                echo "<form name='DBAdmin' action='".$admin_file.".php?op=DB_Admin_OptimizeDBDoit' method='post' accept-charset='UTF-8'>\n";
            }
            echo "<table class='admintable' style='width:90%;'>\n";
            echo "<tr class='TableRow'>\n";
            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['OPTIMIZE_HEADER_NAME']."</th>\n";
            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['OPTIMIZE_HEADER_OPTIMIZE']."</th>\n";
            echo "</tr>\n";
            echo "<tr>\n";
            echo "<td colspan='2'><input type='button' value='".$lang_admin[$adminpoint]['CHECK_ALL']."'   onclick='checkAll(".$database_actual[0]['Num_Tables'].")' />
                                  <input type='button' value='".$lang_admin[$adminpoint]['UNCHECK_ALL']."' onclick='uncheckAll(".$database_actual[0]['Num_Tables'].")' />
                                  <input type='button' value='".$lang_admin[$adminpoint]['SWITCH_ALL']."'  onclick='switchAll(".$database_actual[0]['Num_Tables'].")' /></td>\n";
            echo "</tr>\n";
            $colorchange = 0;
            for ( $i = 1; $i<=$database_actual[0]['Num_Tables']; $i++) {
                if ( $optimize == 'optimize') {
                    if ( $_GETVAR->get($database_actual[$i]['TableName'], '_POST', 'string') == 'optimize' ) {
                        echo "<tr class='TableRow' style='background-color:red;'>\n";
                        echo "<td class='TableColumn' align='left' >".$database_actual[$i]['TableName']."</td>\n";
                        echo "<td class='TableColumn' align='left' ><input type='checkbox' name='".$database_actual[$i]['TableName']."' value='optimize' checked='checked' /></td>\n";
                        echo "</tr>\n";
                    } else {
                        continue;
                    }
                } else {
                    if ($colorchange == 0) {
                        $columncolor = $bgcolor1;
                    } else {
                        $columncolor = $bgcolor2;
                    }
                    echo "<tr class='TableRow' style='background-color:".$columncolor.";'>\n";
                    echo "<td class='TableColumn' align='left' >".$database_actual[$i]['TableName']."</td>\n";
                    echo "<td class='TableColumn' align='left' ><input type='checkbox' name='".$database_actual[$i]['TableName']."' value='optimize' /></td>\n";
                    echo "</tr>\n";
                    $colorchange = ($colorchange == 0 ? 1: 0);
                }
            }
            echo "<tr>\n";
            echo "<td colspan='2'><input type='button' value='".$lang_admin[$adminpoint]['CHECK_ALL']."'   onclick='checkAll(".$database_actual[0]['Num_Tables'].")' />
                                  <input type='button' value='".$lang_admin[$adminpoint]['UNCHECK_ALL']."' onclick='uncheckAll(".$database_actual[0]['Num_Tables'].")' />
                                  <input type='button' value='".$lang_admin[$adminpoint]['SWITCH_ALL']."'  onclick='switchAll(".$database_actual[0]['Num_Tables'].")' /></td>\n";
            echo "</tr>\n";
            echo "</table>\n";
            echo "<center><input type='submit' name='submitoptimize' value='" . $lang_admin[$adminpoint]['OPTIMIZE_SUBMIT'] . "' /></center>\n";
            echo "</form>\n";
        } elseif ( $database_info[0]['Status'] == 'NOK' ) {
            echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['DATABASE_QUERY_NO_RIGHT'] . "</strong></span></center><br />\n";
        } else {
            echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['DATABASE_QUERY_NO_RESULT'] . "</strong></span></center><br />\n";
        }
        CloseTable();
        DB_Admin_Footer();
    }

    function DB_Admin_OptimizeDBDoit($submit='') {
        global $db, $adminpoint, $lang_admin, $_GETVAR;
        DB_Admin_Header();
        DB_Admin_Menu();
        OpenTable();
        echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['TITLE_TABLES_OPTIMIZED'] . "</strong></span></center><br /><br />\n";
        echo "<center><span style='color:red;'>".$lang_admin[$adminpoint]['OPTIMIZE_TABLES_OPTIMIZED_MSG']."</span></center><br /><br />\n";
        $database_actual = DB_Admin_GetDatabaseInfos();
        for ( $i = 1; $i <= $database_actual[0]['Num_Tables']; $i++) {
            if ( ($submit != '') && ($_GETVAR->get($database_actual[$i]['TableName'], '_POST') == 'optimize') ) {
                echo "<center>".$database_actual[$i]['TableName']."</center><br />\n";
                $db->sql_uquery('OPTIMIZE TABLE '.$database_actual[$i]['TableName']);
            }
        }
        CloseTable();
        DB_Admin_Footer();
    }

    function DB_Admin_DeleteTables($delete='') {
        global $admin_file, $adminpoint, $lang_admin, $bgcolor1, $bgcolor2, $_GETVAR;
        DB_Admin_Header();
        DB_Admin_Menu();
        OpenTable();
        echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['TITLE_TABLES_DELETE'] . "</strong></span></center><br /><br />";
        $database_actual = DB_Admin_GetDatabaseInfos();
        if ($database_actual[0]['Num_Tables'] > 0) {
            if ( $delete != 'delete' ) {
                echo "<form name='DBAdmin' action='".$admin_file.".php?op=DB_Admin_DeleteTableConfirm' method='post' accept-charset='UTF-8'>\n";
            } else {
                echo "<form name='DBAdmin' action='".$admin_file.".php?op=DB_Admin_DeleteTableDoit' method='post' accept-charset='UTF-8'>\n";
            }
            echo "<table class='admintable' style='width:90%;'>\n";
            echo "<tr class='TableRow'>\n";
            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['DELETE_HEADER_NAME']."</th>\n";
            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['DELETE_HEADER_DELETE']."</th>\n";
            echo "</tr>\n";
            echo "<tr>\n";
            echo "<td colspan='2'><input type='button' value='".$lang_admin[$adminpoint]['CHECK_ALL']."'   onclick='checkAll(".$database_actual[0]['Num_Tables'].")' />
                                  <input type='button' value='".$lang_admin[$adminpoint]['UNCHECK_ALL']."' onclick='uncheckAll(".$database_actual[0]['Num_Tables'].")' />
                                  <input type='button' value='".$lang_admin[$adminpoint]['SWITCH_ALL']."'  onclick='switchAll(".$database_actual[0]['Num_Tables'].")' /></td>\n";
            echo "</tr>\n";
            $colorchange = 0;
            for ( $i = 1; $i<=$database_actual[0]['Num_Tables']; $i++) {
                if ( $delete == 'delete') {
                    if ( $_GETVAR->get($database_actual[$i]['TableName'], '_POST', 'string') == 'delete' ) {
                        echo "<tr class='TableRow' style='background-color:red;'>\n";
                        echo "<td class='TableColumn' align='left' >".$database_actual[$i]['TableName']."</td>\n";
                        echo "<td class='TableColumn' align='left' ><input type='checkbox' name='".$database_actual[$i]['TableName']."' value='delete' checked='checked' /></td>\n";
                        echo "</tr>\n";
                    } else {
                        continue;
                    }
                } else {
                    if ($colorchange == 0) {
                        $columncolor = $bgcolor1;
                    } else {
                        $columncolor = $bgcolor2;
                    }
                    echo "<tr class='TableRow' style='background-color:".$columncolor.";'>\n";
                    echo "<td class='TableColumn' align='left' >".$database_actual[$i]['TableName']."</td>\n";
                    echo "<td class='TableColumn' align='left' ><input type='checkbox' name='".$database_actual[$i]['TableName']."' value='delete' /></td>\n";
                    echo "</tr>\n";
                    $colorchange = ($colorchange == 0 ? 1: 0);
                }
            }
            echo "<tr>\n";
            echo "<td colspan='2'><input type='button' value='".$lang_admin[$adminpoint]['CHECK_ALL']."'   onclick='checkAll(".$database_actual[0]['Num_Tables'].")' />
                                  <input type='button' value='".$lang_admin[$adminpoint]['UNCHECK_ALL']."' onclick='uncheckAll(".$database_actual[0]['Num_Tables'].")' />
                                  <input type='button' value='".$lang_admin[$adminpoint]['SWITCH_ALL']."'  onclick='switchAll(".$database_actual[0]['Num_Tables'].")' /></td>\n";
            echo "</tr>\n";
            echo "</table>\n";
            echo "<center><input type='submit' name='submitdelete' value='" . $lang_admin[$adminpoint]['DELETE_SUBMIT'] . "' /></center>\n";
            echo "</form>\n";
        } elseif ( $database_info[0]['Status'] == 'NOK' ) {
            echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['DATABASE_QUERY_NO_RIGHT'] . "</strong></span></center><br />\n";
        } else {
            echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['DATABASE_QUERY_NO_RESULT'] . "</strong></span></center><br />\n";
        }
        CloseTable();
        DB_Admin_Footer();
    }

    function DB_Admin_DeleteTableDoit($submit='') {
        global $db, $adminpoint, $lang_admin, $_GETVAR;
        DB_Admin_Header();
        DB_Admin_Menu();
        OpenTable();
        echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['TITLE_TABLES_DELETED'] . "</strong></span></center><br /><br />\n";
        echo "<center><span style='color:red;'>".$lang_admin[$adminpoint]['DELETE_TABLES_DELETED_MSG']."</span></center><br /><br />\n";
        $database_actual = DB_Admin_GetDatabaseInfos();
        for ( $i = 1; $i <= $database_actual[0]['Num_Tables']; $i++) {
            if ( ($submit != '') && ($_GETVAR->get($database_actual[$i]['TableName'], '_POST') == 'delete') ) {
                echo "<center>".$database_actual[$i]['TableName']."</center><br />\n";
                $db->sql_uquery('DROP TABLE '.$database_actual[$i]['TableName']);
            }
        }
        CloseTable();
        DB_Admin_Footer();
    }

    function DB_Admin_RepairTables() {
    }

    function DB_Admin_BackupTables($backup='') {
        global $admin_file, $adminpoint, $lang_admin, $bgcolor1, $bgcolor2, $_GETVAR;
        DB_Admin_Header();
        DB_Admin_Menu();
        OpenTable();
        echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['TITLE_TABLES_BACKUP'] . "</strong></span></center><br />";
        echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['BACKUP_INFO_MSG'] . "</strong></span></center><br /><br />";
        $database_actual = DB_Admin_GetDatabaseInfos();
        if ($database_actual[0]['Num_Tables'] > 0) {
            if ( $backup != 'backup' ) {
                echo "<form name='DBAdmin' action='".$admin_file.".php?op=DB_Admin_BackupTablesConfirm' method='post' accept-charset='UTF-8'>\n";
            } else {
                echo "<form name='DBAdmin' action='".$admin_file.".php?op=DB_Admin_BackupTablesDoit' method='post' accept-charset='UTF-8'>\n";
            }
            echo "<table class='admintable' style='width:90%;'>\n";
            echo "<tr class='TableRow'>\n";
            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['BACKUP_HEADER_NAME']."</th>\n";
            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['BACKUP_HEADER_BACKUP']."</th>\n";
            echo "</tr>\n";
            echo "<tr>\n";
            echo "<td colspan='2'><input type='button' value='".$lang_admin[$adminpoint]['CHECK_ALL']."'   onclick='checkAll(".$database_actual[0]['Num_Tables'].")' />
                                  <input type='button' value='".$lang_admin[$adminpoint]['UNCHECK_ALL']."' onclick='uncheckAll(".$database_actual[0]['Num_Tables'].")' />
                                  <input type='button' value='".$lang_admin[$adminpoint]['SWITCH_ALL']."'  onclick='switchAll(".$database_actual[0]['Num_Tables'].")' /></td>\n";
            echo "</tr>\n";
            $colorchange = 0;
            for ( $i = 1; $i<=$database_actual[0]['Num_Tables']; $i++) {
                if ( $backup == 'backup') {
                    if ( $_GETVAR->get($database_actual[$i]['TableName'], '_POST', 'string') == 'backup' ) {
                        echo "<tr class='TableRow' style='background-color:red;'>\n";
                        echo "<td class='TableColumn' align='left' >".$database_actual[$i]['TableName']."</td>\n";
                        echo "<td class='TableColumn' align='left' ><input type='checkbox' name='".$database_actual[$i]['TableName']."' value='backup' checked='checked' /></td>\n";
                        echo "</tr>\n";
                    } else {
                        continue;
                    }
                } else {
                    if ( $database_actual[$i]['TableRows'] > 0 ) {
                        if ($colorchange == 0) {
                            $columncolor = $bgcolor1;
                        } else {
                            $columncolor = $bgcolor2;
                        }
                        echo "<tr class='TableRow' style='background-color:".$columncolor.";'>\n";
                        echo "<td class='TableColumn' align='left' >".$database_actual[$i]['TableName']."</td>\n";
                        echo "<td class='TableColumn' align='left' ><input type='checkbox' name='".$database_actual[$i]['TableName']."' value='backup' /></td>\n";
                        echo "</tr>\n";
                        $colorchange = ($colorchange == 0 ? 1: 0);
                    } else {
                        continue;
                    }
                }
            }
            echo "<tr>\n";
            echo "<td colspan='2'><input type='button' value='".$lang_admin[$adminpoint]['CHECK_ALL']."'   onclick='checkAll(".$database_actual[0]['Num_Tables'].")' />
                                  <input type='button' value='".$lang_admin[$adminpoint]['UNCHECK_ALL']."' onclick='uncheckAll(".$database_actual[0]['Num_Tables'].")' />
                                  <input type='button' value='".$lang_admin[$adminpoint]['SWITCH_ALL']."'  onclick='switchAll(".$database_actual[0]['Num_Tables'].")' /></td>\n";
            echo "</tr>\n";
            echo "</table>\n";
            echo "<center><input type='submit' name='submitbackup' value='" . $lang_admin[$adminpoint]['BACKUP_SUBMIT'] . "' /></center>\n";
            echo "</form>\n";
        } elseif ( $database_info[0]['Status'] == 'NOK' ) {
            echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['DATABASE_QUERY_NO_RIGHT'] . "</strong></span></center><br />\n";
        } else {
            echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['DATABASE_QUERY_NO_RESULT'] . "</strong></span></center><br />\n";
        }
        CloseTable();
        DB_Admin_Footer();
    }

    function DB_Admin_BackupTablesDoit($backup='') {
        global $db, $adminpoint, $lang_admin, $_GETVAR, $do_gzip_compress;
        DB_Admin_Header();
        DB_Admin_Menu();
        OpenTable();
        echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['TITLE_TABLES_BACKUPED'] . "</strong></span></center><br />\n";
        echo "<center><span style='color:red;'>".$lang_admin[$adminpoint]['BACKUP_TABLES_BACKUP_MSG']."</span></center><br />\n";
        $database_actual = DB_Admin_GetDatabaseInfos();
        $actualtime      = time();
        $filename        = NUKE_CACHE_DIR . 'dbbackup-'.$actualtime.'.xml';
        $downloadname    = 'dbbackup-'.$actualtime.'.xml';
        $select_step     = 500;
        if(!$directory_mode) {
            $directory_mode = 0755; 
        }
        if (!$file_mode) {
            $file_mode = 0644; 
        }
        if(@is_file($filename)) {
            @unlink($filename);
        }
        if (!$handle = @fopen($filename, 'ab')) {
            $error = false;
        } else {
            @fwrite($handle, "<?xml version='1.0' encoding='UTF-8' standalone='no'?>");
            @fwrite($handle, '<database>');
            for ( $i = 1; $i <= $database_actual[0]['Num_Tables']; $i++) {
                if ( ($backup != '') && ($_GETVAR->get($database_actual[$i]['TableName'], '_POST') == 'backup') ) {
                    @fwrite($handle, '<'.$database_actual[$i]['TableName'].'>');
                    $sql_select = '';
                    $sql_tablefield = '';
                    $sql_fields = array();
                    $result1 = $db->sql_query('SHOW COLUMNS FROM `'.$database_actual[$i]['TableName'].'`');
                    while ($column = $db->sql_fetchrow($result1)) {
                        $sql_select .= ( strlen($sql_select) < 1 ? '' : ', ' ) . $column['Field'];
                        $sql_fields[] = $column['Field'];
                    }
                    $db->sql_freeresult($result1);
                    foreach ($sql_fields as $fieldkey => $tablefield) {
                        $sql_tablefield .= ( strlen($sql_tablefield) < 1 ? '' : ', ' ) . $tablefield;
                    }
                    $result2 = $db->sql_ufetchrow('SELECT COUNT('.$sql_fields[0].') AS rows FROM `'.$database_actual[$i]['TableName'].'`');
                    $rounds = ceil($result2['rows'] / $select_step);
                    for ($j = 0; $j < $rounds; $j++) {
                        $check++;
                        $start = $j*$select_step;
                        $end   = $start + $select_step;
                        $rowid   = 0;
                        $result3 = $db->sql_query('SELECT '.$sql_select.' FROM `'.$database_actual[$i]['TableName'].'` LIMIT '.$start.', '.$end);
                        while ( $row = $db->sql_fetchrow($result3)) {
                            $content = '';
                            $rowid++;
                            $sql_valuefield = '';
                            $content .= "<row id='".$rowid."'>";
                            $content .= "<statement>";
                            $content .= "INSERT INTO ".$database_actual[$i]['TableName']." (".$sql_tablefield.") VALUES (";
                            foreach ($sql_fields as $fieldkey => $tablefield) {
                                $sql_valuefield .= ( strlen($sql_valuefield) < 1 ? '' : ', ' ) . $row[$tablefield];
                            }
                            $content .= $sql_valuefield.")";
                            $content .= "</statement>";
                            $content .= "</row>";
                            @fwrite($handle, $content);
                        }
                        $db->sql_freeresult($result3);
                    }
                    @fwrite($handle, '</'.$database_actual[$i]['TableName'].'>');
                    echo "<center>".$database_actual[$i]['TableName']."</center>\n";
                }
            }
            @fwrite($handle, '</database>');
            @fclose($handle);
        }
        CloseTable();
        DB_Admin_Footer();
    }

    function DB_Admin_BackupTablesShow() {
        global $admin_file, $adminpoint, $lang_admin, $bgcolor1, $bgcolor2, $_GETVAR;
        DB_Admin_Header();
        DB_Admin_Menu();
        OpenTable();
        echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['TITLE_TABLES_BACKUP_SHOW'] . "</strong></span></center><br />";
        echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['SHOW_BACKUP_INFO_MSG'] . "</strong></span></center><br />";
        $backup_delete = "<img src=\"".evo_image('delete.png', '')."\" alt=\"".$lang_admin[$adminpoint]['SHOW_BACKUP_BUTTON_DELETE']."\" title=\"".$lang_admin[$adminpoint]['SHOW_BACKUP_BUTTON_DELETE']."\" border=\"0\" width=\"16\" height=\"16\" />";
        $backup_info   = "<img src=\"".evo_image('view.png', '')."\" alt=\"".$lang_admin[$adminpoint]['SHOW_BACKUP_BUTTON_VIEW']."\" title=\"".$lang_admin[$adminpoint]['SHOW_BACKUP_BUTTON_VIEW']."\" border=\"0\" width=\"16\" height=\"16\" />";
        $opendir = @opendir(NUKE_CACHE_DIR);
        $backupfiles = array();
        $counter = 0;
        while (false !== ($entry = @readdir($opendir))) {
            if( preg_match('/(\.xml$)$/is', $entry)) {
                    $backupfiles[$counter] = $entry;
                    $counter++;
            }
        }
        if ($counter > 0) {
            echo "<table class='admintable' style='width:90%;'>\n";
            echo "<tr class='TableRow'>\n";
            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['SHOW_BACKUP_HEADER_NAME']."</th>\n";
            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['SHOW_BACKUP_HEADER_CREATED']."</th>\n";
            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['SHOW_BACKUP_HEADER_BACKUP']."</th>\n";
            echo "</tr>\n";
            echo "<tr>\n";
            $colorchange = 0;
            for ( $i = 0; $i < $counter; $i++) {
                if ($colorchange == 0) {
                    $columncolor = $bgcolor1;
                } else {
                    $columncolor = $bgcolor2;
                }
                $createdate = formatTimestamp(substr($backupfiles[$i], 9, 10));
                echo "<tr class='TableRow' style='background-color:".$columncolor.";'>\n";
                echo "<td class='TableColumn' align='left' >".$backupfiles[$i]."</td>\n";
                echo "<td class='TableColumn' align='left' >".$createdate."</td>\n";
                echo "<td class='TableColumn' align='left' ><a href=\"$admin_file.php?op=DB_Admin_BackupTablesDelete&amp;backupfile=" . $backupfiles[$i] . "\">" . $backup_delete . "</a>\n";
                echo "&nbsp;<a href=\"$admin_file.php?op=DB_Admin_BackupTablesInfo&amp;backupfile=" . $backupfiles[$i] . "\">" . $backup_info . "</a>\n";
                echo "</td>\n";
                
                echo "</tr>\n";
                $colorchange = ($colorchange == 0 ? 1: 0);
            }
            echo "<tr>\n";
            echo "</table>\n";
            echo "</form>\n";
        } else {
            echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['FILES_QUERY_NO_RESULT'] . "</strong></span></center><br />\n";
        }
        CloseTable();
        DB_Admin_Footer();
    }

    function DB_Admin_BackupTablesDelete($backupfile) {
        global $adminpoint, $lang_admin, $admin_file;
        DB_Admin_Header();
        DB_Admin_Menu();
        OpenTable();
        echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['TITLE_TABLES_BACKUP_SHOW'] . "</strong></span></center><br />";
        if (@is_file(NUKE_CACHE_DIR . $backupfile)) {
            @unlink(NUKE_CACHE_DIR . $backupfile);
        }
        redirect($admin_file.'.php?op=DB_Admin_BackupTablesShow');
        CloseTable();
        DB_Admin_Footer();
    }

    function DB_Admin_BackupTablesInfo($backupfile) {
        global $adminpoint, $lang_admin, $admin_file;
        DB_Admin_Header();
        DB_Admin_Menu();
        OpenTable();
        $error = '';
        echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['TITLE_TABLES_BACKUP_SHOW'] . "</strong></span></center><br />";
        if (@is_file(NUKE_CACHE_DIR . $backupfile)) {
            $parser = @xml_parser_create('UTF-8');
            @xml_parser_set_option( $parser, XML_OPTION_CASE_FOLDING, 0 );
            $data   = file_get_contents(NUKE_CACHE_DIR . $backupfile);
            if (@xml_parse_into_struct($parser, trim($data), $xml_values, $xml_index)) {
                $table_counter = 0;
                $row_counter   = 0;
                foreach($xml_values as $xml_key => $xml_value) {
                    if ( $xml_value['level'] == 2 && $xml_value['type'] == 'open' ) {
                        $tables[$table_counter] = $xml_value['tag'];
                        $table_counter++;
                    } elseif ( $xml_value['level'] == 3 && $xml_value['type'] == 'open') {
                        $row_counter++;
                    }
                }
                echo "<table class='admintable' style='width:50%;' align='center'>\n";
                echo "<tr class='TableRow'>\n";
                echo "<td class='TableColumn' align='left' >".$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_FILE']."</td>\n";
                echo "<td class='TableColumn' align='right' >".$backupfile."</td>\n";
                echo "</tr>\n";
                echo "<tr class='TableRow'>\n";
                echo "<td class='TableColumn' align='left' >".$lang_admin[$adminpoint]['SHOW_BACKUP_HEADER_CREATED']."</td>\n";
                echo "<td class='TableColumn' align='right' >".formatTimestamp(substr($backupfile, 9, 10))."</td>\n";
                echo "</tr>\n";
                echo "<tr class='TableRow'>\n";
                echo "<td class='TableColumn' align='left' >".$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_TABLES']."</td>\n";
                echo "<td class='TableColumn' align='right' >".$table_counter."</td>\n";
                echo "</tr>\n";
                echo "<tr class='TableRow'>\n";
                echo "<td class='TableColumn' align='left' >".$lang_admin[$adminpoint]['SHOW_BACKUP_INFO_ROWS']."</td>\n";
                echo "<td class='TableColumn' align='right' >".$row_counter."</td>\n";
                echo "</tr>\n";
                echo "</table>\n<br />";
                echo "<table class='admintable' style='width:90%;'>\n";
                echo "<tr class='TableRow'>\n";
                echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['BACKUP_HEADER_NAME']."</th>\n";
                echo "</tr>\n";
                echo "<tr>\n";
                $colorchange = 0;
                for ( $i = 0; $i < $table_counter; $i++) {
                    if ($colorchange == 0) {
                        $columncolor = $bgcolor1;
                    } else {
                        $columncolor = $bgcolor2;
                    }
                    echo "<tr class='TableRow' style='background-color:".$columncolor.";'>\n";
                    echo "<td class='TableColumn' align='left' >".$tables[$i]."</td>\n";
                    echo "</tr>\n";
                    $colorchange = ($colorchange == 0 ? 1: 0);
                }
                echo "<tr>\n";
                echo "</table>\n";
            } else {
                $error = @xml_error_string(@xml_get_error_code($parser));
            }
            @xml_parser_free($parser);
        }
        CloseTable();
        DB_Admin_Footer();
    }

    function DB_Admin_ShowStatistics() {
        global $adminpoint, $lang_admin, $bgcolor1, $bgcolor2;
        DB_Admin_Header();
        DB_Admin_Menu();
        OpenTable();
        echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['TITLE_SHOW_STATISTICS'] . "</strong></span></center><br /><br />";
        $database_actual = DB_Admin_GetDatabaseInfos();
        if ($database_actual[0]['Num_Tables'] > 0) {
            echo "<table class='admintable' style='width:50%;' align='center'>\n";
            echo "<tr class='TableRow'>\n";
            echo "<td class='TableColumn' align='left' >".$lang_admin[$adminpoint]['STATISTICS_DATABASE_SIZE']."</td>\n";
            echo "<td class='TableColumn' align='right' >".round(($database_actual[0]['DatabaseSize']/1024/1024), 2)."&nbsp;".$lang_admin[$adminpoint]['MB']."</td>\n";
            echo "</tr>\n";
            echo "<tr class='TableRow'>\n";
            echo "<td class='TableColumn' align='left' >".$lang_admin[$adminpoint]['STATISTICS_DATABASE_TABLES']."</td>\n";
            echo "<td class='TableColumn' align='right' >".$database_actual[0]['Num_Tables']."</td>\n";
            echo "</tr>\n";
            echo "</table>\n<br />";
            echo "<table class='admintable' style='width:90%;' align='center'>\n";
            echo "<tr class='TableRow'>\n";
            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['STATISTICS_HEADER_NAME']."</th>\n";
            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['STATISTICS_HEADER_TIMESTAMPS']."</th>\n";
            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['STATISTICS_HEADER_TYPE']."</th>\n";
            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['STATISTICS_HEADER_FORMAT']."</th>\n";
            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['STATISTICS_HEADER_ROWS']."</th>\n";
            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['STATISTICS_HEADER_SIZE']."</th>\n";
            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['STATISTICS_HEADER_MAXSIZE']."</th>\n";
//            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['STATISTICS_HEADER_INCREMENT']."</th>\n";
            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['STATISTICS_HEADER_COLLATION']."</th>\n";
            echo "<th class='TableHeader' align='center'>".$lang_admin[$adminpoint]['STATISTICS_HEADER_COMMENT']."</th>\n";
            echo "</tr>\n";
            $colorchange = 0;
            for ( $i = 1; $i<=$database_actual[0]['Num_Tables']; $i++) {
                if ($colorchange == 0) {
                    $columncolor = $bgcolor1;
                } else {
                    $columncolor = $bgcolor2;
                }
                echo "<tr class='TableRow' style='background-color:".$columncolor.";'>\n";
                echo "<td class='TableColumn' align='left' >".$database_actual[$i]['TableName']."</td>\n";
                echo "<td class='TableColumn' align='left'  nowrap='nowrap'>".formatTimestamp($database_actual[$i]['TableCreated'])."<br />";
                echo (isset($database_actual[$i]['TableUpdated']) ? formatTimestamp($database_actual[$i]['TableUpdated']) : $lang_admin[$adminpoint]['NONE'])."<br />";
                echo (isset($database_actual[$i]['TableChecked']) ? formatTimestamp($database_actual[$i]['TableChecked']) : $lang_admin[$adminpoint]['NONE'])."</td>\n";
                echo "<td class='TableColumn' align='left' >".$database_actual[$i]['TableType']."</td>\n";
                echo "<td class='TableColumn' align='left' >".$database_actual[$i]['TableRowFormat']."</td>\n";
                echo "<td class='TableColumn' align='right' >".$database_actual[$i]['TableRows']."</td>\n";
                echo "<td class='TableColumn' align='right' >".round(($database_actual[$i]['TableSize']/1024),2)."&nbsp;".$lang_admin[$adminpoint]['KB']."</td>\n";
                echo "<td class='TableColumn' align='right' >".round(($database_actual[$i]['TableSizeMax']/1024/1024),2)."&nbsp;".$lang_admin[$adminpoint]['MB']."</td>\n";
//                echo "<td class='TableColumn' align='left' >".$database_actual[$i]['TableIncrement']."</td>\n";
                echo "<td class='TableColumn' align='left' >".$database_actual[$i]['TableCollation']."</td>\n";
                echo "<td class='TableColumn' align='left' >".$database_actual[$i]['TableComment']."</td>\n";
                echo "</tr>\n";
                $colorchange = ($colorchange == 0 ? 1: 0);
            }
            echo "</table>\n";
        } elseif ( $database_info[0]['Status'] == 'NOK' ) {
            echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['DATABASE_QUERY_NO_RIGHT'] . "</strong></span></center><br />";
        } else {
            echo "<center><span class=\"title\"><strong>" . $lang_admin[$adminpoint]['DATABASE_QUERY_NO_RESULT'] . "</strong></span></center><br />";
        }
        CloseTable();
        DB_Admin_Footer();
    }

$submitdelete   = $_GETVAR->get('submitdelete', '_POST', 'string');
$submitoptimize = $_GETVAR->get('submitoptimize', '_POST', 'string');
$submitbackup   = $_GETVAR->get('submitbackup', '_POST', 'string');
$backupfile     = $_GETVAR->get('backupfile', '_GET', 'string');

    switch($op) {
        case 'DB_Admin_AnalyzeDB':
            DB_Admin_AnalyzeDB();
            break;
        case 'DB_Admin_OptimizeDB':
            DB_Admin_OptimizeDB();
            break;
        case 'DB_Admin_OptimizeDBConfirm':
            DB_Admin_OptimizeDB('optimize');
            break;
        case 'DB_Admin_OptimizeDBDoit':
            DB_Admin_OptimizeDBDoit($submitoptimize);
            break;
        case 'DB_Admin_DeleteTables':
            DB_Admin_DeleteTables();
            break;
        case 'DB_Admin_DeleteTableConfirm':
            DB_Admin_DeleteTables('delete');
            break;
        case 'DB_Admin_DeleteTableDoit':
            DB_Admin_DeleteTableDoit($submitdelete);
            break;
        case 'DB_Admin_RepairTables':
            DB_Admin_RepairTables();
            break;
        case 'DB_Admin_BackupTables':
            DB_Admin_BackupTables();
            break;
        case 'DB_Admin_BackupTablesConfirm':
            DB_Admin_BackupTables('backup');
            break;
        case 'DB_Admin_BackupTablesDoit':
            DB_Admin_BackupTablesDoit($submitbackup);
            break;
        case 'DB_Admin_BackupTablesShow':
            DB_Admin_BackupTablesShow();
            break;
        case 'DB_Admin_BackupTablesDelete':
            DB_Admin_BackupTablesDelete($backupfile);
            break;
        case 'DB_Admin_BackupTablesInfo':
            DB_Admin_BackupTablesInfo($backupfile);
            break;
        case 'DB_Admin_ShowStatistics':
            DB_Admin_ShowStatistics();
            break;
        case 'DB_Admin_Menu':
        case 'DB_Admin':
            DB_Admin_Header();
            DB_Admin_Menu();
            DB_Admin_Footer();
            break;
    }
} else {
    DisplayError('<strong>' . $lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['NO_ADMIN_RIGHTS'] . '<strong>' . $adminpoint . '</strong>');
}

?>