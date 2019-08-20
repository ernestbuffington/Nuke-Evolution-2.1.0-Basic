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

//
// Pick a language, any language ...
//
function language_select($default, $select_name = 'language', $dirname='modules/Forums/language') {

    $lang_select = '<select name="' . $select_name . '">';
    $languageslist = lang_list();
    for ($i=0, $maxi = count($languageslist); $i < $maxi; $i++) {
        if(!empty($languageslist[$i])) {
            $lang_select .= "<option value='".$languageslist[$i]."' ";
            if ($languageslist[$i]==$default) {
                $lang_select .= "selected='selected'";
            }
            $lang_select .= ">".ucwords($languageslist[$i])."</option>\n";
        }
    }
    $lang_select .= "</select>\n";
    return $lang_select;
}

//
// Pick a timezone
//
function tz_select($default, $select_name = 'timezone') {
        global $sys_timezone, $lang;

        if ( !isset($default) ) {
            $default == $sys_timezone;
        }
        $tz_select = '<select name="' . $select_name . '">';
        while( list($offset, $zone) = @each($lang['tz']) ) {
            $selected = ( $offset == $default ) ? ' selected="selected"' : '';
            $tz_select .= '<option value="' . $offset . '"' . $selected . '>' . str_replace('GMT', 'UTC', $zone) . '</option>';
        }
        $tz_select .= '</select>';
        return $tz_select;
}

function quick_reply_select($default, $select_name = 'show_quickreply') {
    global $lang;

    $sqr_select = '<select name="' . $select_name . '">';
    while( list($value, $mode) = @each($lang['sqr']) ) {
        $selected = ( $value == $default ) ? ' selected="selected"' : '';
        $sqr_select .= '<option value="' . $value . '"' . $selected . '>' . $mode . '</option>';
    }
    $sqr_select .= '</select>';
    return $sqr_select;
}

function glance_option_select($default, $select_name = 'glance_show') {
global $lang;

    $g_select = '<select name="' . $select_name . '">';
    while( list($value, $text) = @each($lang['show_glance_option']) ) {
        $selected = ( $value == $default ) ? ' selected="selected"' : '';
        $g_select .= '<option value="' . $value . '"' . $selected . '>' . $text . '</option>';
    }
    $g_select .= '</select>';
    return $g_select;
}

function auc_colors_select($default, $select_name = 'color_groups', $value = 'group_id') {
global $db;

    $g_select = '<select name="' . $select_name . '">';
    $sql = "SELECT * FROM ".AUC_TABLE."  ORDER BY group_name ASC";
    if (!$result = $db->sql_query($sql)) {
        die(mysql_error());
    }
    $selected = (!$default) ? 'selected="selected"' : '';
    $g_select .= '<option value="0" '.$selected.'>None</option>';
    while( $row = $db->sql_fetchrow($result) ) {
        $selected = ( $row['group_id'] == $default ) ? ' selected="selected"' : '';
        $g_select .= '<option value="' . $row[$value] . '"' . $selected . '>' . $row['group_name'] . '</option>';
    }
    $db->sql_freeresult($result);
    $g_select .= '</select>';
    return $g_select;
}

function ranks_select($default, $select_name = 'ranks', $value = 'rank_id') {
    global $db;

    $g_select = '<select name="' . $select_name . '">';
    $sql = "SELECT * FROM " . RANKS_TABLE . " WHERE rank_special = 1 ORDER BY rank_title ASC";
    if (!$result = $db->sql_query($sql)) {
        die(mysql_error());
    }
    $selected = (!$default) ? 'selected="selected"' : '';
    $g_select .= '<option value="0" '.$selected.'>None</option>';
    while( $row = $db->sql_fetchrow($result) ) {
        $selected = ( $row['rank_id'] == $default ) ? ' selected="selected"' : '';
        $g_select .= '<option value="' . $row[$value] . '"' . $selected . '>' . $row['rank_title'] . '</option>';
    }
    $db->sql_freeresult($result);
    $g_select .= '</select>';
    return $g_select;
}

function allow_view_select($default) {
global $lang;

    $g_select = '<select name="logs_view_level">';
    while( list($value, $text) = @each($lang['logs_view_level']) ) {
        $selected = ( $value == $default ) ? ' selected="selected"' : '';
        $g_select .= '<option value="' . $value . '"' . $selected . '>' . $text . '</option>';
    }
    $g_select .= '</select>';
    return $g_select;
}

function edit_profile_panel_feel_select($default, $select_name = 'edit_profile_panel_feel') {
    global $lang;

    $panel_feel_select = '<select name="' . $select_name . '">';
    while( list($value, $mode) = @each($lang['panel_feel']) ) {
        $selected = ( $value == $default ) ? ' selected="selected"' : '';
        $panel_feel_select .= '<option value="' . $value . '"' . $selected . '>' . $mode . '</option>';
    }
    $panel_feel_select .= '</select>';
    return $panel_feel_select;
}

// group_selectbox function by Technocrat
function group_selectbox($fieldname, $current=0, $mvanon=false, $all=true) {
    static $groups;
    if (!isset($groups)) {
        global $db;
        $groups = array(0=>_MVALL, 1=>_MVUSERS, 2=>_MVADMIN, 3=>_MVANON);
        $groupsResult = $db->sql_query('SELECT group_id, group_name FROM '.GROUPS_TABLE.' WHERE group_single_user=0', true);
        while (list($groupID, $groupName) = $db->sql_fetchrow($groupsResult)) {
            $groups[($groupID+3)] = $groupName;
        }
        $db->sql_freeresult($groupsResult);
    }
    $tmpgroups = $groups;
    if (!$all) { unset($tmpgroups[0]); }
    if (!$mvanon) { unset($tmpgroups[3]); }
    return select_box($fieldname, $current, $tmpgroups);
}

// select_box function by Technocrat
function select_box($name, $default, $options) {
    $select = '<select class="set" name="'.$name.'" id="'.$name."\">\n";
    foreach($options as $value => $title) {
        $select .= "<option value=\"$value\"".(($value == $default)?' selected="selected"':'').">$title</option>\n";
    }
    return $select.'</select>';
}

// select_gallery function by ReOrGaNiSaTiOn
function select_gallery($name='default', $gallery='', $img_show = FALSE, $selected='') {
    if (empty($gallery)) {
        $select = "<select class='set' name='".$name."' id='".$name."'>";
        $select .= "<option value='".FALSE."' >"._NONE."</option>";
        return $select.'</select>';
    }
    if ( substr($gallery, 0, 1) == '/' ) {
        $gallery = substr($gallery, 1);
    }
    if ( substr($gallery, -1) == '/' ) {
        $gallery = substr($gallery, 0, strlen($gallery) -1);
    }
    $dir = NUKE_BASE_DIR . $gallery;
    $href_dir = NUKE_HREF_BASE_DIR . $gallery;
    if (is_dir($dir)) {
        if (!defined('GALLERY_JAVASCRIPT') && ($img_show == TRUE)) {
            $select = '<script language="javascript" type="text/javascript">
                        <!--
                        function update_gallery(newimage)
                        {
                            document.gallery_image.src = newimage;
                        }
                        //-->
                        </script>';
            define('GALLERY_JAVASCRIPT', TRUE);
        }
        $opendir = @opendir($gallery);
        if ( $img_show == TRUE ) {
            $select .= "<select class='set' name='".$name."' id='".$name."' onchange='update_gallery(this.options[selectedIndex].value);'>";
        } else {
            $select .= "<select class='set' name='".$name."' id='".$name."'>";
        }
        if ( empty($selected)) {
            $select .= "<option value='".NUKE_IMAGES_BASE_DIR."evo/spacer.gif' selected='selected'>"._NONE."</option>";
        } else {
            $select .= "<option value='".NUKE_IMAGES_BASE_DIR."evo/spacer.gif' >"._NONE."</option>";
        }
        while (false !== ($entry = @readdir($opendir))) {
            if( preg_match('/(\.gif$|\.png$|\.jpg|\.jpeg)$/is', $entry)) {
                if( $entry != '.' && $entry != '..' && is_file($dir . '/' . $entry) && !is_link($dir . '/' . $entry) ) {
                    $extension = substr($entry, strrpos($entry, '.'));
                    if ((!preg_match("#http#", $selected) && (basename($selected) == $entry )) || ($selected == $href_dir."/".$entry)) {
                        $select .= "<option value='".$href_dir."/".$entry."' selected='selected'>".str_replace($extension, '', $entry)."</option>";
                    } else {
                        $select .= "<option value='".$href_dir."/".$entry."' >".str_replace($extension, '', $entry)."</option>";
                    }
                }
            }
        }
        @closedir($dir);
    } else {
        $select = "<select class='set' name='".$name."' id='".$name."'>";
        $select .= "<option value='".FALSE."' >"._NONE."</option>";
    }
    if ( $img_show == TRUE ) {
        if (!empty($selected)){
            return $select."</select>&nbsp;<br /><img name='gallery_image' src='".$selected."' border='0' alt='' />";
        } else {
            return $select."</select>&nbsp;<br /><img name='gallery_image' src='".NUKE_IMAGES_BASE_DIR."evo/spacer.gif' border='0' alt='' />";
        }
    } else {
        return $select."</select>";
    }
}


// yesno_option function by Technocrat
function yesno_option($name, $value=0) {
    $value = ($value>0) ? 1 : 0;
    switch ($value) {
        case '0': $sel[0] = ' checked="checked"';
                  $sel[1] = ' ';
                  break;
        case '1': $sel[0] = ' ';
                  $sel[1] = ' checked="checked"';
                  break;
    }
    return '<input type="radio" name="'.$name.'" id="'.$name.'_yes" value="1"'.$sel[1].' /><label for="'.$name.'_yes">'._YES.'</label><input type="radio" name="'.$name.'" id="'.$name.'_no" value="0" '.$sel[0].' /><label for="'.$name.'_no">'._NO.'</label> ';
}

// select_option function by Technocrat
function select_option($name, $default, $options) {
    $select = '<select class="set" name="'.$name.'" id="'.$name."\">\n";
    foreach($options as $var) {
        $select .= '<option'.(($var == $default)?' selected="selected"':'').">$var</option>\n";
    }
    return $select.'</select>';
}

?>