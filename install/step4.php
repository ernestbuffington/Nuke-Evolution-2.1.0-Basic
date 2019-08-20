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

 Copyright (c) 2010 by The Nuke-Evolution Development Team
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
 /* Known Errors:
 - If we are not in override modus:
    + if we change fields, which are keys in the database, an error is thrown out
*/

if (!defined('NUKE_EVO')) {
   die('You can\'t access this file directly...');
}


$error      = '';
$db_array   = array();

$img_ok     = '<img src="install/images/ok.png" width="16" height="16" title="'.$lang_install['IMG_OK'].'" alt="" />';
$img_bad    = '<img src="install/images/error.png" width="16" height="16" title="'.$lang_install['IMG_BAD'].'" alt="" />';
$img_warn   = '<img src="install/images/warn.png" width="16" height="16" title="'.$lang_install['IMG_WARN'].'" alt="" />';
$img_done   = '<img src="install/images/tick.png" width="16" height="16" title="'.$lang_install['IMG_Done'].'" alt="" />';

require_once(NUKE_DATA_DIR.'db.php');
$result = $db->sql_query('SHOW TABLES');
while ($row = $db->sql_fetchrow($result) ) {
    $dbname     = $row[0];
    $db_array[] = $dbname;
}
$db->sql_freeresult($result);

$allowed_field_type    = array('tinyint', 'smallint', 'mediumint', 'int', 'integer', 'bigint', 'bit', 'real', 'double', 'float', 'decimal', 'numeric', 'char', 'varchar', 'date', 'time', 'year', 'timestamp', 'datetime', 'tinyblob', 'blob', 'mediumblob', 'longblob', 'tinytext', 'text', 'mediumtext', 'longtext', 'enum', 'set', 'binary', 'varbinar');
$to_convert_field_type = array('char', 'varchar', 'date', 'time', 'year', 'timestamp', 'datetime', 'tinytext', 'text', 'mediumtext', 'longtext');

if ( $InstallConfig['tablesetup'] == 1 ) {
    function inArray($value, $array)
    {   
        if (empty($value) || empty($array)) { return '-1';}
        foreach ($array as $key => $item) {
            $item1 = $item;
            $key1 = $key;     
            foreach ($item1 as $key2 => $item2) {
                if ($item2 == $value && ($key2 != 'column' && $key2 !='keyname')) return $key1;
            }
        }
        return '-1';
    }
    $aktTable = $_GETVAR->get('tableid', '_REQUEST', 'int', 0);
    $num_tables = count($tables);
    $lang_temp = '';
    $all_errors = 0;
    $time = time();
    $loop = ((($aktTable + 15) < $num_tables) ? 15 : ($num_tables - $aktTable));
    for ( $run_aktTable=$aktTable; $run_aktTable <= ($loop+$aktTable); $run_aktTable++) {
        // check if something is to do
        if ( $tables[$run_aktTable] ) {
            $key_not_deleted = array();
            $do_table = '';
            $sqlerror = 0;
            $table_name = $tables[$run_aktTable];
            $db_table = $InstallConfig['dbprefix'].'_'.$tables[$run_aktTable];
            $field_table = $tables[$run_aktTable];
            $table_dropped = (@in_array($db_table, $db_array) ? 0 : 1);
            if ( $InstallConfig['dbtab'] == 2 ) {
                // User had decided to drop his tables
                $db->sql_uquery('DROP TABLE IF EXISTS `'.$db_table.'`');
                $table_dropped = 1;
            }
            if ( $table_dropped == 0 ) {
                if ($result = $db->sql_query('SHOW COLUMNS FROM `'.$db_table.'`')) {
                    // Get the table fields of the existing installation
                    $db_field_array = array();
                    $db_field_names = array();
                    $i = 0;
                    while ($row = $db->sql_fetchrow($result) ) {
                        // Now we want all informations about this field in the existing table
                        // Two arrays:  $db_field_array = actual informations || $db_field_names = Array with all fieldnames auf this table
                        $db_field_array[$i]['Field']   = $row['Field'];
                        if ( strstr($row['Type'], '(') ) {
                            $db_field_array[$i]['Type'] = trim(substr($row['Type'],0,strpos($row['Type'],'(')+(strlen('(')-1)));
                            $db_field_array[$i]['Length'] = strstr($row['Type'], '(');
                        } else {
                            $db_field_array[$i]['Type'] = trim($row['Type']);
                            $db_field_array[$i]['Length'] = '';
                        }
                        $db_field_array[$i]['Null']    = (strlen($row['Null']) > 0) ? 'YES' : 'NOT NULL';
                        $db_field_array[$i]['Key']     = $row['Key'];
                        $db_field_array[$i]['Default'] = $row['Default'];
                        $db_field_array[$i]['Extra']   = $row['Extra'];
                        $db_field_names[$i] = $row['Field'];
                        $i++;
                    }
                    $db->sql_freeresult($result);
                }
                if ( $i > 0 ) {
                    // Only do something if the "old" table has fields
                    $do_table = 'alter';
                }
            } else {
                $do_table = 'create';
            }
            $sqlerror        = 0;
            $primkey         = array();
            $fields_in_table = array();
            $key_sql         = '';
            $field_sql       = '';
            $change_field    = array();
            $alter_sql       = 'ALTER TABLE `'.$db_table.'` ';
            $create_sql      = '';
            $table_sql       = 'CREATE TABLE `'.$db_table.'` ( ';
            $create_temp_sql = 'CREATE TABLE `'.$db_table.'_temp'.$time.'` ( ';
            $temp_table      = $db_table.'_temp'.$time;
            $rename_sql      = 'RENAME TABLE `'.$db_table.'` TO `'.$db_table.'_temp'.$time.'`';
            foreach ( $fields[$tables[$run_aktTable]] as $fieldvalues ) {
                // now we do a loop through our default Installation Informations db.php
                // there we get all fields which are neccessary to create or to alter
                // all informations are stored in array $fields_in_table
                foreach ($fieldvalues as $elementname => $elementvalue) {
                    switch ($elementname) {
                        case 'fieldname': $sqlerror = $sqlerror + (empty($elementvalue) ? 1 : 0);
                                          $fields_in_table[$fieldvalues['fieldname']] = $fieldvalues['fieldname'];
                                          break;
                        case 'type':      $sqlerror = $sqlerror + (in_array($elementvalue, $allowed_field_type) ? 0 : 1); 
                                          break;
                        case 'length':
                                          if ( (substr($elementvalue, 0, 1) != '(') && (strlen($elementvalue) > 0) ) { $fieldvalues[$elementname] = '('.$fieldvalues[$elementname]; }
                                          if ( (substr($elementvalue, -1) != ')') && (strlen($elementvalue) > 0) && (is_numeric(substr(trim($elementvalue), -1))) ) { $fieldvalues[$elementname] = $fieldvalues[$elementname].')'; }
                                          break;
                        case 'null':      if ( ($elementvalue == 'NO') || ($elementvalue == '1') ) { 
                                                $fieldvalues[$elementname] = 'NOT NULL';                                            
                                          } elseif ($elementvalue == 'YES' || $elementvalue == '') {
                                                $fieldvalues[$elementname] = 'YES';
                                          }
                                          break;
                        case 'default':   if ( !empty($elementvalue) && $elementvalue != '' && $elementvalue != '\'\'' && !stristr($fieldvalues['extra'], 'auto_increment')) {
                                                $fieldvalues[$elementname] = $elementvalue;
                                          } elseif ( ($fieldvalues['null'] == 'NOT NULL' || ((strlen($fieldvalues['null']) > 0) && $fieldvalues['null'] != 'YES')) && !stristr($fieldvalues['extra'], 'auto_increment')) {
                                              switch ($fieldvalues['type']) {
                                                case 'tinyint'  : $fieldvalues[$elementname] = '0'; break;
                                                case 'smallint' : $fieldvalues[$elementname] = '0'; break;
                                                case 'int'      : $fieldvalues[$elementname] = '0'; break;
                                                case 'integer'  : $fieldvalues[$elementname] = '0'; break;
                                                case 'bigint'   : $fieldvalues[$elementname] = '0'; break;
                                                case 'real'     : $fieldvalues[$elementname] = '0'; break;
                                                case 'double'   : $fieldvalues[$elementname] = '0'; break;
                                                case 'float'    : $fieldvalues[$elementname] = '0'; break;
                                                case 'decimal'  : $fieldvalues[$elementname] = '0'; break;
                                                case 'numeric'  : $fieldvalues[$elementname] = '0'; break;
                                                case 'timestamp': $fieldvalues[$elementname] = '2005-12-31 23:59:59'; break;
                                                case 'date'     : $fieldvalues[$elementname] = '2005-12-31'; break;
                                                case 'datetime' : $fieldvalues[$elementname] = '2005-12-31 23:59:59'; break;
                                                case 'time'     : $fieldvalues[$elementname] = '23:59:59'; break;
                                                case 'var'      : $fieldvalues[$elementname] = ''; break;
                                                case 'varchar'  : $fieldvalues[$elementname] = ''; break;
                                                case 'char'     : $fieldvalues[$elementname] = ''; break;
                                                default         : $fieldvalues[$elementname] = ''; break;
                                              }
                                          }
                                          break;
                        case 'extra':     $fieldvalues[$elementname] = $elementvalue; break;
                     }
                     if ( $sqlerror != 0 ) {
                        // We got an error on reading from default data in db.php
                        continue 2;
                     }
                }
                if ( $fieldvalues['fieldname'] ) {
                    // We build the create statement even if we are in update-modus
                    $field_sql .= '`'.$fieldvalues['fieldname'].'` '.$fieldvalues['type'].' '.$fieldvalues['length'].' '.($fieldvalues['null'] == 'NO' ? '' : 'NOT NULL').' '.($fieldvalues['default'] != '' ? 'DEFAULT "'.$fieldvalues['default'].'"' : '').' '.($fieldvalues['extra'] != '' ? $fieldvalues['extra'] : '').',';
                    if (is_array($db_field_array) && !empty($db_field_array)) {
                        $ary_key = @inArray($fieldvalues['fieldname'], $db_field_array);
                        if ( $db_field_array[$ary_key]['Type'] != $fieldvalues['type']) {
                                    $change_field[$fieldvalues['fieldname']]             = $fieldvalues['fieldname'];
                                    $change_field[$fieldvalues['fieldname']]['new_type'] = $fieldvalues['type'];
                        }
                    }
                } elseif ( $fieldvalues['keyname']) {
                    $keyname = $fieldvalues['keyname'];
                    $sequenz = $fieldvalues['sequenz'];
                    $primkey[$keyname][$sequenz]['sequenz'] = $sequenz;
                    $primkey[$keyname][$sequenz]['column']  = $fieldvalues['column'];
                    $primkey[$keyname][$sequenz]['subpart'] = $fieldvalues['subpart'];
                    $primkey[$keyname][$sequenz]['unique']  = $fieldvalues['unique'];
                }
            }
            if ( $sqlerror == 0 ) {
                // No error occured during fieldsql
                if ( !$primkey ) {
                    $field_sql = substr($field_sql, 0, -1); // We delete last commata from field_sql creation
                    if ( strlen($field_sql) > 1) {
                        $doit = 1;
                    } else {
                        $doit = 0;
                    }
                } else {
                    $primkey_sql = array();
                    array_multisort($primkey);
                    foreach ($primkey as $keyname => $keyvalue) {
                        for ($i = 1, $max = count($keyvalue); $i <= $max; $i++) {
                            if ($keyname == 'PRIMARY' && $keyvalue[$i]['sequenz'] == 1 ) {
                                $keyname = 'PRIMARY KEY';
                                $primkey_sql[$keyname] = $keyname.' (`'.$keyvalue[$i]['column'].'`'.($keyvalue[$i]['subpart'] ? $keyvalue[$i]['subpart'] : '');
                            } elseif ( $keyvalue[$i]['unique'] == 0 && $keyvalue[$i]['sequenz'] == 1) {
                                $keyname = 'UNIQUE KEY `'.$keyname.'`';
                                $primkey_sql[$keyname] = $keyname.' (`'.$keyvalue[$i]['column'].'`'.($keyvalue[$i]['subpart'] ? $keyvalue[$i]['subpart'] : '');
                            } elseif ($keyvalue[$i]['sequenz'] == 1) {
                                $primkey_sql[$keyname] = 'KEY `'.$keyname.'` (`'.$keyvalue[$i]['column'].'`'.($keyvalue[$i]['subpart'] ? $keyvalue[$i]['subpart'] : '');
                            } else {
                                $primkey_sql[$keyname] = $primkey_sql[$keyname] . ', `'.$keyvalue[$i]['column'].'`'.($keyvalue[$i]['subpart'] ? $keyvalue[$i]['subpart'] : '');
                            }
                        } 
                    }
                    foreach ($primkey_sql as $keyname => $keyvalue) {
                        $primkey_sql[$keyname] = $primkey_sql[$keyname].'),';
                        $key_sql .= $primkey_sql[$keyname];
                    }
                    $key_sql = substr($key_sql, 0, -1); // Delete last commata
                }
                $create_sql = $table_sql.$field_sql.$key_sql.') TYPE = MyISAM;';
                if ( $do_table == 'alter') {
                    // Ok, we have to alter a table - so we first makes our old table a temp-table
                    if (!$result = $db->sql_query($rename_sql)) {
                        $sqlerror++;
                    } else {
                        log_write($rename_sql);
                    }
                }
                // Now we create the new table
                if ($result = $db->sql_query($create_sql)) {
                    log_write($create_sql);
                } else {
                    $sqlerror++;
                }
                if ( $do_table == 'alter' && $sqlerror == 0 && ($tables_overwrite[$table_name] != '!OVERWRITE!')) {
                    // If a table is marked as "!OVERWRITE!" in db.php we do not fill it with the old rows
                    //
                    // Here should be added an include for conversion from other systems.
                    // Should be an array with fields to convert from for us unknown fields to evo-fields
                    // The next we have to do is - we copy all rows from the temp-table to our fine new table
                    // This statement should be replaced with the implementation of the include-conversion because
                    // I read the complete data into db-memory - which could cause memory problems
                    $select_statement = '';
                    for ($i=0, $max=count($db_field_array); $i < $max; $i++) {
                        if ( in_array($db_field_array[$i]['Field'], $fields_in_table) ) {
                            // The field is even too an evo-field, so we have to add it to our select-statement
                            $select_statement .= '`'.$db_field_array[$i]['Field'].'`,';
                        }
                    }
                    $select_statement = substr($select_statement, 0, -1); // Delete last commata
                    $select_statement = 'SELECT '.$select_statement.' FROM `'.$temp_table.'`';
                    log_write($select_statement);
                    $insert_fields = '';
                    $all_result = $db->sql_query($select_statement);
                    while ($row = $db->sql_fetchrow($all_result)) {
                        $insert_fields='';
                        // We have to do this loop again, because it could be, that we have to convert a field
                        // The select-statement delivers the rows from database in exactly the same order we have here
                        for ($i=0, $max=count($db_field_array); $i < $max; $i++) {
                            //Now we have to decide, what we should do with this field
                            $fieldname = $db_field_array[$i]['Field'];
                            $fieldtype = $db_field_array[$i]['Type'];
                            if (in_array($fieldname, $fields_in_table)) {
                                if ( in_array($fieldtype, $to_convert_field_type) ) {
                                    //The field should be converted
                                        //We have the allowance to convert the characterset
                                        switch ($db_field_array[$i]['Type']) {
                                            case 'char'      :
                                            case 'varchar'   :
                                            case 'tinytext'  :
                                            case 'text'      :
                                            case 'mediumtext':
                                            case 'longtext'  : 
                                                            if ($InstallConfig['dbconvert']==2 ) {
                                                                $row[$fieldname] = $_GETVAR->fixQuotes(utf8_encode($row[$fieldname]));
                                                                $change_field[$fieldname]['new_type'] = 'utf8-conversion done';
                                                                break;
                                                            } else {
                                                                $row[$fieldname] = $_GETVAR->fixQuotes($row[$fieldname]);
                                                                $change_field[$fieldname]['new_type'] = 'fixQuotes done';
                                                                break;
                                                            }
                                        }
                                    //Let's see, if we have to make a type-conversion
                                    if (in_array($fieldname, $change_field)) {
                                        switch ($fieldtype) {
                                            case 'timestamp'     :
                                                         if ($change_field[$fieldname]['new_type'] == 'date') {
                                                            // No conversion has to be done because timestamp and date are identical
                                                            $row[$fieldname] = $row[$fieldname];
                                                         } elseif ($change_field[$fieldname]['new_type'] == 'time') {
                                                            $row[$fieldname] = ' TIME("'.$fieldname.'")';
                                                         } elseif ($change_field[$fieldname]['new_type'] == 'int') {
                                                            $row[$fieldname] = ' UNIX_TIMESTAMP("'.$fieldname.'")';
                                                         }
                                                         break;
                                            case 'date'          :
                                                         if ($change_field[$fieldname]['new_type'] == 'timestamp') {
                                                            // No conversion has to be done because timestamp and date are identical
                                                            $row[$fieldname] = $row[$fieldname];
                                                         } elseif ($change_field[$fieldname]['new_type'] == 'time') {
                                                            $row[$fieldname] = ' TIME("'.$fieldname.'")';
                                                         } elseif ($change_field[$fieldname]['new_type'] == 'int') {
                                                            $row[$fieldname] = ' UNIX_TIMESTAMP("'.$fieldname.'")';
                                                         }
                                                         break;
                                            case 'time'          :
                                                         if ($change_field[$fieldname]['new_type'] == 'timestamp') {
                                                            // time has no date informations, so we have to add a default value
                                                            $row[$fieldname] = '"2005-12-31 '.$fieldname.'"';
                                                         } elseif ($change_field[$fieldname]['new_type'] == 'date') {
                                                            // time has no date informations, so we have to add a default value
                                                            $row[$fieldname] = '"2005-12-31 '.$fieldname.'"';
                                                         } elseif ($change_field[$fieldname]['new_type'] == 'int') {
                                                            $row[$fieldname] = ' UNIX_TIMESTAMP("'.$fieldname.'")';
                                                         }
                                                         break;
                                        }
                                    }
                                    log_write('CONVERSION: '.$db_table.'    old: '.$fieldtype.'    new: '.$change_field[$fieldname]['new_type']);
                                }
                                $insert_fields .= '`'.$fieldname.'` = "'.$row[$fieldname].'",';
                            }
                        }
                        $insert_fields  = substr($insert_fields, 0, -1); // Delete last commata
                        $insert_statement = 'INSERT INTO `'.$db_table.'` SET '.$insert_fields;
                        if (!$result = $db->sql_query($insert_statement)) {
                            log_write('ERROR: '.$insert_statement);
                            $sqlerror++;
                        }
                    }
                    $db->sql_freeresult($all_result);
                }
            }
            if ($sqlerror <= 0) {
                    $db->sql_uquery('UPDATE `evo_installer_done` SET `done` = 1 WHERE `tablename` = "'.$field_table.'"');
            }
            if ( $sqlerror >0 && $do_table == 'create') {
                log_write($lang_install['DB_Table_Created_not'].':&nbsp;'.$db_table.'<br />'.$create_sql);
                $lang_temp .= '<br />'.$lang_install['DB_Table_Created_not'].':&nbsp;'.$db_table;
                $all_errors++;
            } elseif ( $sqlerror > 0 ) {
                log_write($lang_install['DB_Table_Changed_not'].':&nbsp;'.$db_table.'<br />'.$updatetable_sql);
                $lang_temp .= '<br />'.$lang_install['DB_Table_Changed_not'].':&nbsp;'.$db_table;
                $all_errors++;
            }
        }
    }
    $aktTable = $aktTable + $loop;
    $tableid = ( $aktTable < count($tables) ? $aktTable+1 : $aktTable);
    $InstallConfig['tablesetup'] = ( $aktTable == $tableid ? 2 : 1);
} elseif ($InstallConfig['tablesetup'] != 1 && $InstallConfig['tablesetup'] != 2) {
    $num_tables = count($tables);
    $db->sql_uquery('DROP TABLE IF EXISTS `evo_installer_done`');
    $db->sql_uquery('CREATE TABLE `evo_installer_done` (`tablename` varchar(100) NOT NULL, `done` int(1) default "0", `info_done` int(1) default "0",  PRIMARY KEY (`tablename`)) TYPE=MyISAM');
    for ($i = 0; $i < $num_tables; $i++) {
        $db->sql_uquery('INSERT INTO `evo_installer_done` (`tablename`, `done`, `info_done` ) VALUES ("'.$tables[$i].'", 0, 0)');
    }
}

if ($InstallConfig['next_step'] < $InstallConfig['max_step'] && $InstallConfig['tablesetup'] == 2 && $all_errors == 0) {
    $goback = 1;
    $gonext = 1;
} else {
    $goback = 1;
    $gonext = 0;
}    
install_header($goback, $gonext);

OpenTable();
OpenTable2();
if ( $InstallConfig['update'] == 2 ) {
    echo "<div class='topictitle'><center>".$lang_install['DB_Upgrade']."</center></div><br />";    
} else {
    echo "<div class='topictitle'><center>".$lang_install['DB_Installation']."</center></div><br />";
}
echo "<div class='textarea'><center>".$lang_install['DB_Table_NotExists'].":&nbsp;&nbsp;".$img_ok."</center></div>";
echo "<div class='textarea'><center>".$lang_install['DB_Table_Exists'].":&nbsp;&nbsp;".$img_warn."</center></div>";
echo "<div class='textarea'><center>".$lang_install['DB_Table_Done'].":&nbsp;&nbsp;".$img_done."</center></div>";
CloseTable2();
echo '<br />';
if ( $InstallConfig['dbtab'] == 2 && $InstallConfig['tablesetup'] != 1 && $InstallConfig['tablesetup'] != 2) {
    OpenTable2();
    echo '<table width="100%"><tr><td width="100%"><div style="color:red;text-align:center;">'.$lang_install['DB_Table_Warning_override'].'</div></td></tr></table>';
    CloseTable2();
} elseif ( $InstallConfig['tablesetup'] == 1 ) {
    OpenTable2();
    echo '<table width="100%"><tr><td id="create_window1" style="align:center;" width="75%"><div style="color:red; text-align:center;">'.$lang_install['DB_Table_Create_in_process'].'</div></td></tr>';
    echo '<tr><td id="create_window2" style="align:center;" width="75%"><div style="color:red; text-align:center;">'.$lang_temp.'</div></td></tr></table>';
    CloseTable2();
} elseif ( ($InstallConfig['tablesetup'] == 2) && ($all_errors > 0)) {
    $InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 1;
    evo_setcookie($InstallConfig);
    OpenTable2();
    echo '<table width="100%"><tr><td id="create_window1" style="align:center;" width="75%"><div style="text-align:center;">'.$lang_install['DB_Table_Created_ready_error'].'</div></td></tr></table>';
    CloseTable2();
} elseif ( ($InstallConfig['tablesetup'] == 2) && ($all_errors == 0)) {
    $InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 2;
    evo_setcookie($InstallConfig);
    OpenTable2();
    echo '<table width="100%"><tr><td id="create_window1" style="align:center;" width="75%"><div style="text-align:center;">'.$lang_install['DB_Table_Created_ready'].'</div></td></tr></table>';
    CloseTable2();
}    

echo '<table width="100%">';

$temp_result = $db->sql_query('SELECT `tablename` FROM `evo_installer_done` WHERE `done`= 1');
$i = 0;
while( list($tablename) = $db->sql_fetchrow($temp_result)) {
    $done_tables[$i] = $tablename;
    $i++;
}
for ( $i=0, $y = count($tables); $i < $y; $i++) {
    $create_table = $tables[$i];
    echo '<tr><td width="32%" class="row1">'.$create_table.'</td><td width="1%" class="row1">';
    if ( @in_array($create_table, $done_tables) ) {
        echo '<div id="'.$create_table.'">'.$img_done.'</div>';
    } elseif ( @in_array($InstallConfig['dbprefix'].'_'.$create_table, $db_array) ) {
        echo '<div id="'.$create_table.'">'.$img_warn.'</div>';
    } else {
        echo '<div id="'.$create_table.'">'.$img_ok.'</div>';
    }
    echo '</td>';
    $i++;
    if ( $i < $y) {
        $create_table = $tables[$i];
        echo '<td width="32%" class="row1">'.$create_table.'</td><td width="1%" class="row1">';
        if ( @in_array($create_table, $done_tables) ) {
            echo '<div id="'.$create_table.'">'.$img_done.'</div>';
        } elseif ( @in_array($InstallConfig['dbprefix'].'_'.$create_table, $db_array) ) {
            echo '<div id="'.$create_table.'">'.$img_warn.'</div>';
        } else {
            echo '<div id="'.$create_table.'">'.$img_ok.'</div>';
        }
    } else {
        echo '<td>';
    }
    echo '</td>';
    $i++;
    if ( $i < $y) {
        $create_table = $tables[$i];
        echo '<td width="32%" class="row1">'.$create_table.'</td><td width="1%" class="row1">';
        if ( @in_array($create_table, $done_tables) ) {
            echo '<div id="'.$create_table.'">'.$img_done.'</div>';
        } elseif ( @in_array($InstallConfig['dbprefix'].'_'.$create_table, $db_array) ) {
            echo '<div id="'.$create_table.'">'.$img_warn.'</div>';
        } else {
            echo '<div id="'.$create_table.'">'.$img_ok.'</div>';
        }
    } else {
        echo '<td>';
    }
    echo '</td></tr>';
}
echo '</table>';
echo '<br />';

if ($InstallConfig['tablesetup'] == 1) {
    echo '<meta http-equiv="refresh" content="1;url=' . $_SERVER['PHP_SELF'] . '?step='.$InstallConfig['step'].'&amp;tablesetup='.$InstallConfig['tablesetup'].'&amp;tableid='.$tableid.'" />';
}
if ($InstallConfig['tablesetup'] != 1) {
    $previous = $next = '';
    if ($InstallConfig['old_step'] > $InstallConfig['min_step'] ) {
        $previous = '<a href="install.php?step='.$InstallConfig['old_step'].'"><img src="install/images/left.png" width="32" height="32" border="0" title="" alt="" /></a>';
    }
    if ($InstallConfig['next_step'] < $InstallConfig['max_step'] && $InstallConfig['tablesetup'] == 2 && $all_errors == 0) {
        $next = '<a href="install.php?step='.$InstallConfig['next_step'].'"><img src="install/images/right.png" width="32" height="32" border="0" title="" alt="" /></a>';
    } else {
        $next = '<a href="install.php?step='.$InstallConfig['step'].'&amp;tablesetup=1"><img src="install/images/right.png" width="32" height="32" border="0" title="" alt="" /></a>';
    }    
    echo "<center>$previous&nbsp;&nbsp;$next</center>";
}
echo "<br /><br />";
CloseTable();

?>