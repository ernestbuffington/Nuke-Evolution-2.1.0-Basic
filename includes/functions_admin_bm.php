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

if (!defined('ADMIN_FILE') && !defined('FORUM_ADMIN')) {
    exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

if ( !defined('IN_PHPBB') ) {
    die('Hacking attempt');
}

function IsLeapYear ( $yr ) {
    $leap = ( (mod($yr,4)==0) && ( (mod($yr,100)<>0) || (mod($yr,400)==0) ) );
    return $leap;
}

function mod ( $a,$b ) {
    $x1=(int) abs($a/$b);
    $x2=$a/$b;
    return $a-($x1*$b);
}

function make_drop_down ( $from, $to, $name, $nrsel, $step, $mode) {
    $step = ( $step == '0' ) ? $step==1 : $step;
    $option = "&nbsp;<select name =" . $name . ">";
    for ( $i = $from; $i <= $to ; $i+=$step ) {
        if ( $mode == 'month' ) {
            $displ_value = date ("M", mktime(0,0,0,$i+1,0,0));
            $selected = ( $i-1 == $nrsel-1 ) ? ' selected="selected"' : '';
        } else {
            $displ_value = $i;
            $displ_value = ( strlen ( $displ_value ) > 1 ) ? $displ_value  : '0' . $displ_value;
            $selected = ( $i == $nrsel ) ? ' selected="selected"' : '';
        }
        $option .= '<option value="' . $i . '"'  . $selected . '>' . $displ_value . '</option>';
    }
    $option .= '</select>&nbsp;';
    return $option;
}

function make_combo_row( $value, $strpage, $nrselc ) {
    $selectd = ( $value == $nrselc ) ? ' selected="selected"' : '';
    return '<option value= "' . $value . '"' . $selectd . '>' . $strpage . '</option>';
}

function make_showpage_dropdown ( $name, $nrsel ) {
    global $db, $lang;

    $option = '&nbsp;<select name =' . $name . '>';
    $option .= make_combo_row( '-9999', $lang['Bm_off'], $nrsel );
    $option .= make_combo_row( '9999', $lang['Bm_all_pages'], $nrsel );
    $option .= make_combo_row( PAGE_INDEX, $lang['Bm_index'], $nrsel );
    $sql = "SELECT * FROM " . FORUMS_TABLE . " ORDER BY cat_id, forum_order";
    $oldcat = 999999999999;
    if ( $result = $db->sql_query($sql) ) {
        while ( $row = $db->sql_fetchrow($result) ) {
            if ( $oldcat == $row['cat_id'] ) {
                $option .= make_combo_row( $row['forum_id'], $row['forum_name'], $nrsel );
            } else {
                $option .= make_combo_row( '-9998',' ', $nrsel );
                $option .= make_combo_row( '-9998', '----------------', $nrsel );
                $option .= make_combo_row( $row['forum_id'], $row['forum_name'], $nrsel );
            }
            $oldcat = $row['cat_id'];
        }
    }
    $db->sql_freeresult($result);
    $option .= make_combo_row( '-9998',' ', $nrsel );
    $option .= make_combo_row( '-9998', '----------------', $nrsel );
    $option .= make_combo_row( PAGE_SEARCH, $lang['Search'], $nrsel );
    $option .= make_combo_row( PAGE_VIEWMEMBERS, $lang['Memberlist'], $nrsel );
    $option .= make_combo_row( PAGE_FAQ, $lang['FAQ'], $nrsel );
    $option .= make_combo_row( PAGE_LOGIN, $lang['Login'], $nrsel );
    $option .= make_combo_row( PAGE_PRIVMSGS, $lang['Private_Message'], $nrsel );
    $option .= make_combo_row( PAGE_VIEWONLINE, $lang['Who_is_Online'], $nrsel );
    $option .= make_combo_row( PAGE_REGISTER, $lang['Register'], $nrsel );
    $option .= make_combo_row( PAGE_PROFILE, $lang['Profile'], $nrsel );
    $option .= make_combo_row( PAGE_GROUPCP, $lang['Usergroups'], $nrsel );
    $option .= make_combo_row( PAGE_POSTING, $lang['Posting_message'], $nrsel );
    $option .= '</select>&nbsp;';
    return $option;
}

function checkdays ( $month, $days, $year ) {
    if ( $month == '4' || $month == '6' || $month == '9' || $month == '11' ) {
        if ( $days > '30' ) {
            $days = '30';
        }
    }
    if ( $month == '2' ) {
        if ( IsLeapYear ( $year ) ) {
            if ( $days > '29' ) {
                $days = '29';
            }
        } else {
            if ( $days > '28' ) {
                $days = '28';
            }
        }
    }
    return $days;
}

function make_days_checkbox ( $strdays ) {
    global $lang;
    $checkbox = '';
    $c = array ( $lang['datetime']['Sun'],
    $lang['datetime']['Mon'],
    $lang['datetime']['Tue'],
    $lang['datetime']['Wed'],
    $lang['datetime']['Thu'],
    $lang['datetime']['Fri'],
    $lang['datetime']['Sat']);
    for ( $a = 0; $a < 7; $a++ ) {
        $b = substr($strdays, $a, 1);
        if ( $b == '1' ) {
            $checkbox .= '<input type="checkbox" name="days[]" value="' . $a . '" checked />' . $c[$a];
        } else {
            $checkbox .= '<input type="checkbox" name="days[]" value="' . $a  . '" />' . $c[$a];
        }
    }
    return $checkbox;
}

function make_days_string ( $arrdays ) {
    $b='0000000';
    for ( $a = 0; $a < count($arrdays); $a++ ) {
        $b = substr_replace($b, '1', $arrdays[$a],1);
    }
    return $b;
}

function make_days_abbr_string ( $strdays ) {
    global $lang;
    $arrdays = array ( $lang['datetime']['Sun'],
        $lang['datetime']['Mon'],
        $lang['datetime']['Tue'],
        $lang['datetime']['Wed'],
        $lang['datetime']['Thu'],
        $lang['datetime']['Fri'],
        $lang['datetime']['Sat']);
    $strbin = '';
    for ( $a = 0; $a < strlen($strdays); $a++ ) {
        if ( substr($strdays,$a,1) == 1 ) {
            $strbin .= $arrdays[$a] . " ";
        }
    }
    $strbin = substr($strbin ,0,strlen($strbin )-2);
    return $strbin ;
}

function generate_smilies_bm($mode) {
    global $db, $board_config, $template, $lang, $images, $phpbb_root_path;

    $inline_columns = 5;
    $inline_rows = 4;
    $window_columns = 8;
    if ( $mode == 'window' ) {
        $gen_simple_header = TRUE;
        $page_title = $lang['Review_topic'] . " - $topic_title";
        $template->set_filenames(array(
            'smiliesbody' => 'posting_smilies.tpl')
        );
    }
    $sql = "SELECT emoticon, code, smile_url FROM " . SMILIES_TABLE . " ORDER BY smilies_id";
    if ( $result = $db->sql_query($sql) ) {
        $num_smilies = 0;
        $rowset = array();
        while ( $row = $db->sql_fetchrow($result) ) {
            if ( empty($rowset[$row['smile_url']]) ) {
                $rowset[$row['smile_url']]['code'] = str_replace('\\', '\\\\', str_replace("'", "\\'", $row['code']));
                $rowset[$row['smile_url']]['emoticon'] = $row['emoticon'];
                $num_smilies++;
            }
        }
        if ( $num_smilies ) {
            $smilies_count = ( $mode == 'inline' ) ? min(19, $num_smilies) : $num_smilies;
            $smilies_split_row = ( $mode == 'inline' ) ? $inline_columns - 1 : $window_columns - 1;
            $s_colspan = 0;
            $row = 0;
            $col = 0;
            while ( list($smile_url, $data) = @each($rowset) ) {
                if ( !$col ) {
                    $template->assign_block_vars('smilies_row', array());
                }
                $template->assign_block_vars('smilies_row.smilies_col', array(
                    'SMILEY_CODE' => $data['code'],
                    'SMILEY_IMG' =>  NUKE_HREF_BASE_DIR .$board_config['smilies_path'] .'/'.  $smile_url,
                    'SMILEY_DESC' => $data['emoticon'])
                );
                $s_colspan = max($s_colspan, $col + 1);
                if ( $col == $smilies_split_row ) {
                    if ( $mode == 'inline' && $row == $inline_rows - 1 ) {
                        break;
                    }
                    $col = 0;
                    $row++;
                } else {
                    $col++;
                }
            }
            if ( $mode == 'inline' && $num_smilies > $inline_rows * $inline_columns ) {
                $template->assign_block_vars('switch_smilies_extra', array());
                $template->assign_vars(array(
                    'L_MORE_SMILIES' => $lang['More_emoticons'],
                    'U_MORE_SMILIES' => append_sid('admin_board_msg_xl.php?mode=smilies'))
                );
            }
            $template->assign_vars(array(
                'L_EMOTICONS'       => $lang['Emoticons'],
                'L_CLOSE_WINDOW'    => $lang['Close_window'],
                'S_SMILIES_COLSPAN' => $s_colspan)
            );
        }
    }
    $db->freeresult($result);
    if ( $mode == 'window' ) {
        $template->pparse('smiliesbody');
    }
}

?>