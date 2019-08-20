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

if (!defined('NUKE_EVO')) {
   die('You can\'t access this file directly...');
}

$img_ok = '<img src="install/images/ok.png" width="16" height="16" title="'.$lang_install['IMG_OK'].'" alt="" />';
$img_bad = '<img src="install/images/error.png" width="16" height="16" title="'.$lang_install['IMG_BAD'].'" alt="" />';
$img_warn = '<img src="install/images/warn.png" width="16" height="16" title="'.$lang_install['IMG_WARN'].'" alt="" />';
$img_done = '<img src="install/images/tick.png" width="16" height="16" title="'.$lang_install['IMG_Done'].'" alt="" />';

require_once(NUKE_DATA_DIR.'db.php');
require_once(NUKE_LANGUAGE_DIR.'lang_'.$InstallConfig['language'].'/default.php');

$table_fields = @array_keys($field_values);

$errorcounter = 0;
if ( $InstallConfig['informationsetup'] == 1 ) {
    $aktTable = $_GETVAR->get('tableid', '_REQUEST', 'int', 0);
    $num_tables = count($tables);
    $loop = ((($aktTable + 15) <= $num_tables) ? 15 : ($num_tables - $aktTable));
    for ( $run_aktTable=$aktTable; $run_aktTable <= ($loop+$aktTable); $run_aktTable++) {
        if ( $tables[$run_aktTable] ) {
            $table_error = 0;
            if ( @in_array($tables[$run_aktTable], $table_fields) ) {
                foreach ( $field_values[$tables[$run_aktTable]] as $insert_row ) {
                    $insert_fields = '';
                    $insert_values = '';
                    foreach ( $insert_row as $db_field => $db_value) {
                        $insert_fields .= '`'.$db_field.'`,';
                        $insert_values .= '"'.$_GETVAR->fixQuotes($db_value).'",';
                    }
                    $insert_fields = @substr($insert_fields, 0, -1);
                    $insert_values = @substr($insert_values, 0, -1);
                    if ( $InstallConfig['update'] == 2 ) {
                        // If we are in update mode we produce an error on this insertion if row allready exists
                        // but we have to add default values for tables or fields which didn't exist before
                        $sql = 'INSERT INTO `'.$InstallConfig['dbprefix'].'_'.$tables[$run_aktTable].'` ('.$insert_fields.') VALUES ('.$insert_values.')';
                        $db->sql_uquery($sql, false, true);
                    } else {
                        // Here we insert in a fresh or repeated installation. "IGNORE" helps to override existing rows in the table
                        $sql = 'INSERT IGNORE INTO `'.$InstallConfig['dbprefix'].'_'.$tables[$run_aktTable].'` ('.$insert_fields.') VALUES ('.$insert_values.')';
                        if (!$result = $db->sql_query($sql)) {
                            $errorcounter++;
                            $table_error++;
                        }
                    }
                }
                if ( $table_error == 0 ) {
                    $db->sql_uquery('UPDATE `evo_installer_done` SET `info_done` = 1 WHERE `tablename`="'.$tables[$run_aktTable].'"');
                }
            } else {
                $db->sql_uquery('UPDATE `evo_installer_done` SET `info_done` = 1 WHERE `tablename`="'.$tables[$run_aktTable].'"');
            }                
        }
    }
    $aktTable = $aktTable + $loop;
    $tableid = ( $aktTable < count($tables) ? $aktTable+1 : $aktTable);
    $InstallConfig['informationsetup'] = ( $aktTable == $tableid ? 2 : 1);

    if ( $errorcounter > 0 ) {
        $lang_temp .= '<br />'.$lang_install['DB_Entry_Update_missed'];
        $InstallConfig['informationsetup'] = 0;
    }
}

if ( $InstallConfig['informationsetup'] == 2 ) {
    $insert_sql = '';
    $base_error = 0;
    $var_result = $db->sql_query('SELECT * FROM `evo_installer_vars`');
    while ( list($db_id, $db_tablename, $db_fieldname, $db_fieldvalue, $db_valuefield, $db_value, $db_done) = $db->sql_fetchrow($var_result) ) {
        if ( @in_array($db_tablename, $tables) ) {
            if ( $db_valuefield == '' && ($InstallConfig['update'] != 2 || $tables_overwrite[$db_tablename] == '!OVERWRITE!') ) {
                // if in db.php we have choosen to "Overwrite" a table, we have to fill default data with default settings
                $insert_sql = 'UPDATE `'.$InstallConfig['dbprefix'].'_'.$db_tablename.'` SET `'.$db_fieldname.'` = "'.$_GETVAR->fixQuotes($db_value).'";';
                if ( !$result = $db->sql_query($insert_sql) ) {
                    log_write($lang_install['DB_Entry_Update_missed'].':&nbsp;'.$insert_sql);
                    $base_error++;
                }
            } elseif (strlen($db_valuefield) > 1 && strlen($db_fieldvalue) > 1) {
                $insert_sql = 'UPDATE `'.$InstallConfig['dbprefix'].'_'.$db_tablename.'` SET `'.$db_valuefield.'` = "'.$_GETVAR->fixQuotes($db_value).'" WHERE `'.$db_fieldname.'` = "'.$db_fieldvalue.'";';
                if ( !$result = $db->sql_query($insert_sql) ) {
                    log_write($lang_install['DB_Entry_Update_missed'].':&nbsp;'.$insert_sql);
                    $base_error++;
                }
            }
        }
    }
}

if ( $InstallConfig['informationsetup'] == 2 && $base_error == 0 ) {
    $insert_sql = '';
    // Set Admin Account
    $insert_sql = 'REPLACE INTO `'.$InstallConfig['dbprefix'].'_authors` (admlanguage, aid, counter, email, name, pwd, radminsuper, url) 
                    VALUES ("'.$InstallConfig['admin_lang'].'", "'.$InstallConfig['admin_name'].'", 0, "'.$InstallConfig['admin_email'].'",
                            "God", "'.md5($InstallConfig['admin_password']).'", 1, "'.$InstallConfig['admin_homepage'].'")';
    if ( !$result = $db->sql_query($insert_sql) ) {
        log_write($lang_install['DB_Entry_Update_missed'].':&nbsp;'.$insert_sql);
        $base_error++;
    }
    if ( $InstallConfig['update'] != 2 ) {
        $insert_sql = 'REPLACE INTO `'.$InstallConfig['dbprefix'].'_nsnst_admins` (`aid`, `login`, `protected`)
                    VALUES ("'.$InstallConfig['admin_name'].'", "'.$InstallConfig['admin_name'].'", 1)';
        if ( !$result = $db->sql_query($insert_sql) ) {
            log_write($lang_install['DB_Entry_Update_missed'].':&nbsp;'.$insert_sql);
            $base_error++;
        }
    }
}    

if ( $InstallConfig['informationsetup'] == 2 ) {
    //Now we create or update Nuke-Sentinel informations
    // If we are in installation-modus, admins are allready inserted into nsnst_admins
    // If we are in update-modus, we do not need to add or change them
    // Tables and fields are allready created or Updated from Installer
    // so we only have to empty tables where new informations are available
    if ($InstallConfig['update'] != 2) {
        $db->sql_uquery('DELETE FROM `'.$InstallConfig['dbprefix'].'_nsnst_blockers`');
        $db->sql_uquery('DELETE FROM `'.$InstallConfig['dbprefix'].'_nsnst_countries`');
        $db->sql_uquery('DELETE FROM `'.$InstallConfig['dbprefix'].'_nsnst_harvesters`');
        $db->sql_uquery('DELETE FROM `'.$InstallConfig['dbprefix'].'_nsnst_referers`');
        $db->sql_uquery('DELETE FROM `'.$InstallConfig['dbprefix'].'_nsnst_ip2country`');
    }
    // Populate Data (Code from original Nuke-Sentinel Installer) changed to fit Evo needs
    $wfilename = NUKE_DATA_DIR.'nuke_sentinel/blockers.data';
    if(@file_exists($wfilename)) {
      $wfread = @fopen($wfilename, 'r');
      $linecount = 0;
      while (!@feof($wfread)) {
        $DataRead = @fgets($wfread, 1024);
        $DataRead = preg_replace ('#\r#', '', $DataRead);
        $DataRead = preg_replace ('#\n#', '', $DataRead);
        $data = @explode ("||", $DataRead);
        if(intval($data[0] >= 0) && (strlen($data[1]) >= 1)) {
          for($i=0, $max=count($data); $i < $max; $i++) {
            if(!get_magic_quotes_runtime()) { $data[$i] = addslashes($data[$i]); } 
          }
          $db->sql_uquery('INSERT INTO `'.$InstallConfig['dbprefix'].'_nsnst_blockers` 
                        (`blocker`, `block_name`, `activate`, `block_type`, `email_lookup`, `forward`, `reason`, `template`, `duration`, `htaccess`, `list`)
                        VALUES ('.intval($data[0]).', "'.$data[1].'", "'.$data[2].'", "'.$data[3].'", "'.$data[4].'", "'.$data[5].'", "'.$data[6].'", "'.$data[7].'", "'.$data[8].'", "'.$data[9].'", "'.$data[10].'")', false, true);
        }
      }
      @fclose($wfread);
    }
    $wfilename = NUKE_DATA_DIR.'nuke_sentinel/countries.data';
    if(@file_exists($wfilename)) {
      $wfread = @fopen($wfilename, 'r');
      $linecount = 0;
      while (!@feof($wfread)) {
        $DataRead = @fgets($wfread, 1024);
        $DataRead = preg_replace ('#\r#', '', $DataRead);
        $DataRead = preg_replace ('#\n#', '', $DataRead);
        $data = @explode ("||", $DataRead);
        if(intval($data[0] >= 0)) {
          for($i=0, $max=count($data); $i < $max; $i++) {
            if(!get_magic_quotes_runtime()) { $data[$i] = addslashes($data[$i]); } 
          }
          $db->sql_uquery('INSERT INTO `'.$InstallConfig['dbprefix'].'_nsnst_countries` 
                        (`c2c`, `country`)
                        VALUES ("'.$data[0].'", "'.$data[1].'")', false, true);
        }
      }
      @fclose($wfread);
    }
    $wfilename = NUKE_DATA_DIR.'nuke_sentinel/harvesters.data';
    if(@file_exists($wfilename)) {
      $wfread = @fopen($wfilename, 'r');
      $linecount = 0;
      while (!@feof($wfread)) {
        $DataRead = @fgets($wfread, 1024);
        $DataRead = preg_replace ('#\r#', '', $DataRead);
        $DataRead = preg_replace ('#\n#', '', $DataRead);
        $data = @explode ("||", $DataRead);
        if(intval($data[0] >= 0)) {
          for($i=0, $max=count($data); $i < $max; $i++) {
            if(!get_magic_quotes_runtime()) { $data[$i] = addslashes($data[$i]); } 
          }
          $db->sql_uquery('INSERT INTO `'.$InstallConfig['dbprefix'].'_nsnst_harvesters` 
                        (`hid`, `harvester`)
                        VALUES ("'.$data[0].'", "'.$data[1].'")', false, true);
        }
      }
      @fclose($wfread);
    }
    $wfilename = NUKE_DATA_DIR.'nuke_sentinel/referers.data';
    if(@file_exists($wfilename)) {
      $wfread = @fopen($wfilename, 'r');
      $linecount = 0;
      while (!@feof($wfread)) {
        $DataRead = @fgets($wfread, 1024);
        $DataRead = preg_replace ('#\r#', '', $DataRead);
        $DataRead = preg_replace ('#\n#', '', $DataRead);
        $data = @explode ("||", $DataRead);
        if(intval($data[0] >= 0)) {
          for($i=0, $max=count($data); $i < $max; $i++) {
            if(!get_magic_quotes_runtime()) { $data[$i] = addslashes($data[$i]); } 
          }
          $db->sql_uquery('INSERT INTO `'.$InstallConfig['dbprefix'].'_nsnst_referers` 
                        (`rid`, `referer`)
                        VALUES ("'.$data[0].'", "'.$data[1].'")', false, true);
        }
      }
      @fclose($wfread);
    }
    $wfilename = NUKE_DATA_DIR.'nuke_sentinel/ip2country.data';
    if(@file_exists($wfilename)) {
      $wfread = @fopen($wfilename, 'r');
      $linecount = 0;
      while (!@feof($wfread)) {
        $DataRead = @fgets($wfread, 1024);
        list ($ip_lo, $ip_hi, $ip_date, $ip_c2c) = explode ("||", $DataRead);
        $ip_c2c = preg_replace ('#\r#', '', $ip_c2c);
        $ip_c2c = preg_replace ('#\n#', '', $ip_c2c);
        if($ip_lo > "") {
          $db->sql_uquery('INSERT INTO `'.$InstallConfig['dbprefix'].'_nsnst_ip2country`
                        (`ip_lo`, `ip_hi`, `date`, `c2c`) 
                        VALUES ("'.$ip_lo.'", "'.$ip_hi.'", "'.$ip_date.'", "'.$ip_c2c.'")', false, true);
        }
      }
      @fclose($wfread);
    }
}

   
if ($InstallConfig['next_step'] < $InstallConfig['max_step'] && $InstallConfig['dbsetup'] == 1 && $InstallConfig['informationsetup'] == 2) {
    $goback = 1;
    $gonext = 1;
} else {
    $goback = 1;
    $gonext = 0;
}

install_header($goback, $gonext);

OpenTable();
OpenTable2();
echo "<div class='topictitle'><center>".$lang_install['Base_Information_Setup']."</center></div>";
echo "<div class='textarea'><center>".$lang_install['Base_Informations_NoNeed'].":&nbsp;&nbsp;".$img_ok."</center></div>";
echo "<div class='textarea'><center>".$lang_install['Base_Informations_ToDo'].":&nbsp;&nbsp;".$img_warn."</center></div>";
echo "<div class='textarea'><center>".$lang_install['Base_Informations_Done'].":&nbsp;&nbsp;".$img_done."</center></div>";
CloseTable2();
echo '<br />';

if ( $InstallConfig['informationsetup'] == 1 ) {
    OpenTable2();
    echo '<table width="100%"><tr><td id="create_window1" style="align:center;" width="75%"><div style="color:red; text-align:center;">'.$lang_install['Base_Informations_in_process'].'</div></td></tr>';
    echo '<tr><td id="create_window2" style="align:center;" width="75%">'.$lang_temp.'</td></tr></table>';
    CloseTable2();
} elseif ( $InstallConfig['informationsetup'] == 2 && $base_error == 0) {
    $InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 2;
    evo_setcookie($InstallConfig);
    OpenTable2();
    echo '<table width="100%"><tr><td id="create_window1" style="align:center;" width="75%"><div style="text-align:center;">'.$lang_install['Base_Informations_ready'].'</div></td></tr></table>';
    CloseTable2();
}elseif ( $InstallConfig['informationsetup'] == 2 && $base_error > 0) {
    OpenTable2();
    $InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 1;
    evo_setcookie($InstallConfig);
    echo '<table width="100%"><tr><td id="create_window1" style="align:center;" width="75%"><div style="color:red; text-align:center;">'.$lang_install['Base_Informations_ready_error'].'</div></td></tr></table>';
    CloseTable2();
}elseif ( $InstallConfig['informationsetup'] == 0 && $errorcounter > 0) {
    OpenTable2();
    $InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 1;
    evo_setcookie($InstallConfig);
    echo '<table width="100%"><tr><td id="create_window1" style="align:center;" width="75%"><div style="color:red; text-align:center;">'.$lang_install['Base_Informations_ready_error'].'</div></td></tr></table>';
    CloseTable2();
}
echo '<form method="post" name="form_informationsetup" action="' . $_SERVER['PHP_SELF'] . '">';
echo '<input type="hidden" name="informationsetup" value="1" />';
echo '<input type="hidden" name="step" value="'.$InstallConfig['step'].'" />';

echo '<table width="100%">';

$temp_result = $db->sql_query('SELECT * FROM `evo_installer_done`');
$done_tables = array();
while( list($tablename, $done, $info_done) = $db->sql_fetchrow($temp_result)) {
    $done_tables[$tablename]['done'] = $done;
    $done_tables[$tablename]['info_done'] = $info_done;
}
for ( $i=0, $y = count($tables); $i < $y; $i++) {
    $create_table = $tables[$i];
    echo '<tr><td width="32%" class="row1">'.$create_table.'</td><td width="1%" class="row1">';
    if ( @array_key_exists($create_table, $done_tables) ) {
        if ( $done_tables[$create_table]['done'] == 1 ) {
            if (@in_array($tables[$i], $table_fields) ) {
                if ( $done_tables[$create_table]['info_done'] == 0 ) {
                    echo '<div id="'.$create_table.'">'.$img_warn.'</div>';
                } elseif ( $done_tables[$create_table]['info_done'] == 1 ) {
                    echo '<div id="'.$create_table.'">'.$img_done.'</div>';
                } else {
                    echo '<div id="'.$create_table.'">'.$img_bad.'</div>';
                }
            } else {
                echo '<div id="'.$create_table.'">'.$img_ok.'</div>';
            }
        } else {
            echo '<div id="'.$create_table.'">'.$img_bad.'</div>';
        }
    } else {
        echo '<div id="'.$create_table.'">'.$img_bad.'</div>';
    }
    echo '</td>';
    $i++;
    if ( $i < $y) {
        $create_table = $tables[$i];
        echo '<td width="32%" class="row1">'.$create_table.'</td><td width="1%" class="row1">';
        if ( @array_key_exists($create_table, $done_tables) ) {
            if ( $done_tables[$create_table]['done'] == 1 ) {
                if (@in_array($tables[$i], $table_fields) ) {
                    if ( $done_tables[$create_table]['info_done'] == 0 ) {
                        echo '<div id="'.$create_table.'">'.$img_warn.'</div>';
                    } elseif ( $done_tables[$create_table]['info_done'] == 1 ) {
                        echo '<div id="'.$create_table.'">'.$img_done.'</div>';
                    } else {
                        echo '<div id="'.$create_table.'">'.$img_bad.'</div>';
                    }
                } else {
                    echo '<div id="'.$create_table.'">'.$img_ok.'</div>';
                }
            } else {
                echo '<div id="'.$create_table.'">'.$img_bad.'</div>';
            }
        } else {
            echo '<div id="'.$create_table.'">'.$img_bad.'</div>';
        }
        echo '</td>';
    }
    $i++;
    if ( $i < $y) {
        $create_table = $tables[$i];
        echo '<td width="32%" class="row1">'.$create_table.'</td><td width="1%" class="row1">';
        if ( @array_key_exists($create_table, $done_tables) ) {
            if ( $done_tables[$create_table]['done'] == 1 ) {
                if (@in_array($tables[$i], $table_fields) ) {
                    if ( $done_tables[$create_table]['info_done'] == 0 ) {
                        echo '<div id="'.$create_table.'">'.$img_warn.'</div>';
                    } elseif ( $done_tables[$create_table]['info_done'] == 1 ) {
                        echo '<div id="'.$create_table.'">'.$img_done.'</div>';
                    } else {
                        echo '<div id="'.$create_table.'">'.$img_bad.'</div>';
                    }
                } else {
                    echo '<div id="'.$create_table.'">'.$img_ok.'</div>';
                }
            } else {
                echo '<div id="'.$create_table.'">'.$img_bad.'</div>';
            }
        } else {
            echo '<div id="'.$create_table.'">'.$img_bad.'</div>';
        }
        echo '</td>';
    }
    echo '</tr>';
}


if ($InstallConfig['informationsetup'] == 1) {
    echo '<meta http-equiv="refresh" content="1;url=' . $_SERVER['PHP_SELF'] . '?step='.$InstallConfig['step'].'&amp;informationsetup='.$InstallConfig['informationsetup'].'&amp;tableid='.$tableid.'" />';
}
if ($InstallConfig['informationsetup'] != 1 && $InstallConfig['informationsetup'] != 2) {
    echo '<tr><td colspan="6"><center><input type="submit" name="button_informationsetup" value="'.$lang_install['Submit'].'" /></center></td></tr>';
}
echo '</table></form>';

if ($InstallConfig['informationsetup'] == 2) {
    $previous = $next = '';
    if ($InstallConfig['old_step'] > $InstallConfig['min_step'] ) {
        $previous = '<a href="install.php?step='.$InstallConfig['old_step'].'"><img src="install/images/left.png" width="32" height="32" border="0" title="" alt="" /></a>';
    }
    if ($InstallConfig['next_step'] < $InstallConfig['max_step'] && $InstallConfig['dbsetup'] == 1) {
        $next = '<a href="install.php?step='.$InstallConfig['next_step'].'"><img src="install/images/right.png" width="32" height="32" border="0" title="" alt="" /></a>';
    } else {
        $next = '<a href="install.php?step='.$InstallConfig['step'].'"><img src="install/images/right.png" width="32" height="32" border="0" title="" alt="" /></a>';
    }    
    echo "<center>$previous&nbsp;&nbsp;$next</center>";
}
echo "<br /><br />";
CloseTable();

?>