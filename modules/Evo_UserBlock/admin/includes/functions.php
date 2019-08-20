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

function evouserinfo_parse_data($data) {
    $containers = explode(":", $data);
    foreach($containers AS $container) {
        $container = str_replace(")", "", $container);
        $i = 0;
        $lastly = explode("(", $container);
        $values = explode(",", $lastly[1]);
        foreach($values AS $value) {
            if($value == '') {
                continue;
            }
            $final[$lastly[0]][] = $value;
            $i ++;
        }
    }
    return $final;
}

function evouserinfo_getactive () {
    global $db, $lang_evo_userblock, $evo_userblock_count_active;

    $sql = 'SELECT * FROM `'._BLOCK_EVO_USERINFO_TABLE.'` WHERE `active`="1" ORDER BY `position` ASC';
    $result = $db->sql_query($sql);
    $i = 0;
    while($row = $db->sql_fetchrow($result)) {
        $active[$row['position']] = $row;
        if ($row['filename'] != 'break') {
            $i++;
        }
    }
    $db->sql_freeresult($result);
    $evo_userblock_count_active = $i;
    return $active;
}

function evouserinfo_getinactive () {
    global $db, $lang_evo_userblock, $evo_userblock_count_inactive;

    $sql = 'SELECT * FROM `'._BLOCK_EVO_USERINFO_TABLE.'` WHERE `active`="0" ORDER BY `position` ASC';
    $result = $db->sql_query($sql);
    $i = 0;
    $inactive = array();
    while($row = $db->sql_fetchrow($result)) {
        $inactive[$row['position']] = $row;
        if ($row['filename'] != 'break') {
            $i++;
        }
    }
    $db->sql_freeresult($result);
    $evo_userblock_count_inactive = $i;
    return $inactive;
}

function evouserinfo_write_addon ($ext, $values) {
    global $db, $lang_evo_userblock;
    foreach ($values as $key => $value) {
        $sql = 'UPDATE `'._BLOCK_EVO_USERINFO_ADDONS_TABLE.'` SET `value` = "'.$value.'" WHERE `name` = "'.$ext.'_'.$key.'"';
        $db->sql_uquery($sql);
    }
}

function evouserinfo_load_addon ($name) {
    $content = '';
    if(@file_exists(NUKE_EVO_USERBLOCK_ADDONS.$name.'.php')){
        @include_once(NUKE_EVO_USERBLOCK_ADDONS.$name.'.php');
        if(defined('NO_EVO_USERBLOCK_ADMIN')) {
            return '';
        }
        $output = 'evouserinfo_'.$name;
        global $$output, $evouserinfo_rank;
        $content .= $$output;
    }
    return $content;
}


/*==============================================================================================
    Function:    evouserinfo_radio()
    In:          $data
                    Array of radio button data
                 $br
                    A <br /> after the radio button
    Return:      Radio button HTML code using the passed in array
    Notes:       N/A
================================================================================================*/
function evouserinfo_radio ($data, $br=0) {
    $out = '';
    foreach ($data as $single) {
        $out .= "<input type=\"radio\" name=\"".$single['name']."\" value=\"".$single['value']."\" ".$single['checked']." />".$single['text']."\n";
        if($br) {
            $out .= "<br /><br />";
        }
        $br = 1;
    }
    if ($br) {
        $out = substr($out, 0, strlen($out) - 6);
    }
    return $out;
}

/*==============================================================================================
    Function:    evouserinfo_text()
    In:          $name
                    Name of the text box
                 $text
                    Text to be displayed in the box
                 $size
                    Size of the text box
                 $max
                    Max characters
    Return:      Text box HTML code
    Notes:       N/A
================================================================================================*/
function evouserinfo_text ($name, $text, $size='', $max='') {
    $size = ($size) ? "size=\"".$size."\"" : '';
    $max = ($max) ? "maxlength=\"".$max."\"" : '';
    return "<input type=\"text\" name=\"".$name."\" value=\"".$text."\" ".$size." ".$max." />";
}

/*==============================================================================================
    Function:    evouserinfo_area()
    In:          $name
                    Name of the text area
                 $text
                    Text to be displayed in the area
                 $rows
                    How many rows big
                 $cols
                    How many cols big
    Return:      Text area HTML code
    Notes:       N/A
================================================================================================*/
function evouserinfo_text_area ($name, $text, $rows=5, $cols=20, $size='', $max='') {
    $size = ($size) ? "size=\"".$size."\"" : '';
    $max = ($max) ? "maxlength=\"".$max."\"" : '';
    return "<textarea name=\"".$name."\" rows=\"".$rows."\" cols=\"".$cols."\">".$text."</textarea>";
}

/*==============================================================================================
    Function:    evouserinfo_combo()
    In:          $name
                    Name of the combo box
                 $data
                    Array of the data to put in the box
                 $default
                    Default choice
    Return:      Combo box HTML code
    Notes:       N/A
================================================================================================*/
function evouserinfo_combo ($name, $data, $default) {
    $out = "<select name=\"".$name."\">\n";
    foreach ($data as $single) {
        $selected = ($default == $single['value']) ? 'SELECTED' : '';
        $out .= "<option value=\"".$single['value']."\" ".$selected.">".$single['text']."</option>\n";
    }
    $out .= "</select>\n";
    return $out;
}

/*==============================================================================================
    Function:    evouserinfo_help_popup()
    In:          $text
                    Popup text
                 $caption
                    Popup caption
    Return:      N/A
    Notes:       The javacode for the popup
================================================================================================*/
function evouserinfo_help_popup($text, $caption) {
    return "onmouseover=\"return overlib('".$text."', BELOW, CENTER, CAPTION, '".$caption."', WIDTH, 300, OFFSETY, 20, FGCOLOR, '#ffffff', BGCOLOR, '#000000', TEXTCOLOR, '#000000', CAPCOLOR, '#ffffff', CLOSECOLOR, '#ffffff', CAPICON, '', BORDER, '2');\" onmouseout=\"return nd();\"";
}

?>