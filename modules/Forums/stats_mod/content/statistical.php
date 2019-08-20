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

if (!defined('MODULE_FILE') ) {
    die('You can\'t access this file directly...');
}

if (!defined('IN_PHPBB')) {
    die('Hacking attempt');
}

class Content_statistical {
    var $columns     = 0;
    var $rows        = 0;
    var $column_data = array();
    var $align       = array();
    var $width       = array();

    function Content_statistical()
    {
    }

    function set_columns($data) {
        global $stats_template;

        @reset($data);
        $i = 0;
        while (list($key, $value) = each($data)) {
            // check pre-defined value
            if (is_array($value)) {
                list($this->column_data[$i]['key'], $this->column_data[$i]['value']) = each($value);
            } else {
                $this->column_data[$i]['key'] = $key;
                $this->column_data[$i]['value'] = $value;
            }
            $i++;
        }
        $stats_template->assign_vars(array(
            'NUM_COLUMNS' => $this->columns)
        );

        // to the run_module part ?
        for ($i = 0; $i < $this->columns; $i++) {
            $first_column = ($i == 0) ? TRUE : FALSE;
            $last_column = ($i == $this->columns-1) ? TRUE : FALSE;
            $stats_template->assign_block_vars('column', array(
                'FIRST_COLUMN'  => $first_column,
                'LAST_COLUMN'   => $last_column,
                'VALUE'         => $this->column_data[$i]['value'])
            );
        }
    }

    function align_rows($data) {
        // Default: center
        $this->align = $data;
    }

    function width_rows($data) {
        $this->width = $data;
    }

    function set_rows($data, $auth_data) {
        global $core, $stats_template, $phpbb_root_path, $stat_functions, $lang;

        // make global...
        if (count($core->global_array) > 0) {
            eval('global ' . implode(', ', $core->global_array) . ';');
        }
        $width = array();
        // If we are in an auth condition, please clean them first
        $auth_array = array();
        $authed = FALSE;
        if ($auth_data) {
            $auth_array = $stat_functions->clean_auth_values($auth_data);
            $authed = TRUE;
        }
        for ($i = 0; $i < count($core->calculation_data); $i++) {
            $rank_column = array();
            $stats_template->assign_block_vars('row', array());
            $row_value = array();
            $auth_replace = array();
            for ($j = 0; $j < $this->columns; $j++) {
                $auth_replace[$j]['replace'] = FALSE;
                $auth_replace[$j]['lang'] = FALSE;
                eval('$result = ' . $data[$j] . ';');
                $rank_column[$j] = FALSE;
                if (!isset($this->align[$j]) || empty($this->align[$j])) {
                    $this->align[$j] = 'center';
                }
                if (($this->width[$j] == '') || (empty($this->width[$j])) ) {
                    $width[$j] = '';
                } else {
                    $width[$j] = 'width="' . $this->width[$j] . '"';
                }
                if ($result == '__PRE_DEFINED_VALUE__') {
                    if ($this->column_data[$j]['key'] == '__PRE_DEFINE_RANK__') {
                        $row_value[$j] = $i+1;
                        $rank_column[$j] = TRUE;
                    }
                } else {
                    if (!$authed) {
                        $row_value[$j] = $result;
                    } else {
                        eval('$auth_key = ' . $auth_array['auth_key'] . ';');
                        if ($auth_array['auth_check'][$auth_key]) {
                            $row_value[$j] = $result;
                        } else {
                            eval('$result = ' . $auth_array['auth_replacement'][$j] . ';');
                            $auth_replace[$j]['replace'] = TRUE;
                            if ( (is_string($auth_array['auth_replacement'][$j])) && (strstr($auth_array['auth_replacement'][$j], '$lang')) ) {
                                $auth_replace[$j]['lang'] = TRUE;
                            }
                            $row_value[$j] = $result;
                        }
                    }
                }
            }
            for ($j = 0; $j < $this->columns; $j++) {
                $first_column = ($j == 0) ? TRUE : FALSE;
                $last_column = ($j == $this->columns-1) ? TRUE : FALSE;
                $stats_template->assign_block_vars('row.row_column', array(
                    'FIRST_COLUMN'      => $first_column,
                    'LAST_COLUMN'       => $last_column,
                    'RANK_COLUMN'       => $rank_column[$j],
                    'ROW'               => $i,
                    'VALUE'             => (isset($row_value[$j]) && !empty($row_value[$j]) ? $row_value[$j] : 0),
                    'ALIGNMENT'         => $this->align[$j],
                    'WIDTH'             => $width[$j],
                    'AUTH_REPLACEMENT'  => $auth_replace[$j]['replace'],
                    'AUTH_LANG_ENTRY'   => $auth_replace[$j]['lang'])
                );
            }
            $core->calc_index++;
        }
    }
}

?>