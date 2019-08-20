<?php
/*=======================================================================
 Nuke-Evolution     :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :       #$#BASE
 Nuke-Evo Version       :       #$#VER
 Nuke-Evo Build         :       #$#BUILD
 Nuke-Evo Patch         :       #$#PATCH
 Nuke-Evo Filename      :       #$#FILENAME
 Nuke-Evo Date          :       #$#DATE

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

if (!defined('ADMIN_FILE') && !defined('MODULE_FILE')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}


/*==============================================================================================
    Function:    head_open()
    In:          $title
                    Header title
    Return:      N/A
    Notes:       Displays the page header, graphic admin, and the title
================================================================================================*/
function head_open ($title='') {
    global $lang_donate, $admin_file;
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<div style='text-align: center;'>\n<a href=\"$admin_file.php?op=Donations\">" .$lang_donate['ADMIN_HEADER']. "</a></div>\n";
    echo "<br /><br />";
    echo "<div style='text-align: center;'>\n[ <a href=\"$admin_file.php\">" .$lang_donate['RETURNMAIN']. "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    title("<div style='text-align: center;'>\n".$title."</div>\n");
    OpenTable();
    return;
}

/*==============================================================================================
    Function:    foot_close()
    In:          N/A
    Return:      N/A
    Notes:       Close the open table and displays the footer
================================================================================================*/
function foot_close () {
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    return;
}

/*==============================================================================================
    Function:    br2nl()
    In:          N/A
    Return:      N/A
    Notes:       Changes <br /> or <br /> to \n
================================================================================================*/
function br2nl($str) {
   $str = preg_replace("/(\r\n|\n|\r)/", "", $str);
   return preg_replace("=<br */?>=i", "\n", $str);
}

/*==============================================================================================
    Function:    config_select()
    In:          N/A
    Return:      N/A
    Notes:       Displays the donation config links
================================================================================================*/
function config_select () {
    global $lang_donate, $admin_file, $module_name;
    echo "<div style='text-align: center;'>\n";
    echo "<table style='width:100%;'><tr style='width:100%;'>";
    echo "<td style='text-align:center;'><a href='".$admin_file.".php?op=Donations&amp;file=current'><img src='".evo_image('view.png', $module_name)."' border='0' alt='".$lang_donate['CURRENT_DONATIONS']."' /><br />".$lang_donate['CURRENT_DONATIONS']."</a></td>\n";
    echo "<td style='text-align:center;'><a href='".$admin_file.".php?op=Donations&amp;file=add'><img src='".evo_image('donadd.png', $module_name)."' border='0' alt='".$lang_donate['ADD_DONATION']."' /><br />".$lang_donate['ADD_DONATION']."</a></td>\n";
    echo "<td style='text-align:center;'><a href='".$admin_file.".php?op=Donations&amp;file=values'><img src='".evo_image('money.png', $module_name)."' border='0' alt='".$lang_donate['DONATION_VALUES']."' /><br />".$lang_donate['DONATION_VALUES']."</a></td>\n";
    echo "</tr><tr style='width:100%;'>\n";
    echo "<td style='text-align:center;'><a href='".$admin_file.".php?op=Donations&amp;file=config_block'><img src='".evo_image('blocks.png', $module_name)."' border='0' alt='".$lang_donate['CONFIG_BLOCK']."' /><br />".$lang_donate['CONFIG_BLOCK']."</a></td>\n";
    echo "<td style='text-align:center;'><a href='".$admin_file.".php?op=Donations&amp;file=config_donations'><img src='".evo_image('donator.png', $module_name)."' border='0' alt='".$lang_donate['CONFIG_GENERAL']."' /><br />".$lang_donate['CONFIG_GENERAL']."</a></td>\n";
    echo "<td style='text-align:center;'><a href='".$admin_file.".php?op=Donations&amp;file=config_page'><img src='".evo_image('page.png', $module_name)."' border='0' alt='".$lang_donate['CONFIG_PAGE']."' /><br />".$lang_donate['CONFIG_PAGE']."</a></td>\n";
    echo "</tr></table>\n";
    echo "</div>";
}

/*==============================================================================================
    Function:    DonateError()
    In:          $text
                    Message text
                 $close
                    CloseTable or not
    Return:      N/A
    Notes:       Displays an error message
================================================================================================*/
function DonateError($text, $close=1) {
    global $lang_donate;
    echo '<div style="text-align: center;">';
    echo $lang_donate['ERROR'] . '<br />';
    echo $text;
    echo '</div>';
    if ($close) {
        CloseTable();
    }
    die();
}

/*==============================================================================================
    Function:    donate_radio()
    In:          $data
                    Array of radio button data
                 $br
                    A <br /> after the radio button
    Return:      Radio button HTML code using the passed in array
    Notes:       N/A
================================================================================================*/
function donate_radio ($data, $br=0) {
    $out = '';
    foreach ($data as $single) {
        $single['name'] = isset($single['name']) ? $single['name'] : '';
        $single['value']= isset($single['value'])? $single['value'] : '';
        $single['help'] = isset($single['help']) ? $single['help'] : '';
        $single['text'] = isset($single['text']) ? $single['text'] : '';
        $mouseover      = isset($single['mouseover']) ? $single['mouseover'] : '';
        $out .= "<input type='radio' name='".$single['name']."' value='".$single['value']."'  ".$single['checked']." ".$mouseover." />".$single['text']."\n";
        if($br) {
            $out .= "<br />";
        }
    }
    if ($br) {
        $out = substr($out, 0, strlen($out) - 6);
    }
    return $out;
}

/*==============================================================================================
    Function:    donate_text()
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
function donate_text ($name, $text='', $size='', $max='', $help='') {
    $size = ($size) ? "size='".$size."'" : '';
    $max = ($max) ? "maxlength='".$max."'" : '';
    return "<input type='text' name='".$name."' value='".$text."' ".$size." ".$max." ".$help." />";
}

/*==============================================================================================
    Function:    donate_area()
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
function donate_text_area ($name, $text='', $rows=5, $cols=20, $help='') {
    return "<textarea name='".$name."' rows='".$rows."' cols='".$cols."' ".$help.">".$text."</textarea>";
}

/*==============================================================================================
    Function:    donate_combo()
    In:          $name
                    Name of the combo box
                 $data
                    Array of the data to put in the box
                 $default
                    Default choice
    Return:      Combo box HTML code
    Notes:       N/A
================================================================================================*/
function donate_combo ($name, $data, $default) {
    $out = "<select name='".$name."'>\n";
    foreach ($data as $single) {
        $selected = ($default == $single['value']) ? 'selected="selected"' : '';
        $out .= "<option value='".$single['value']."' ".$selected.">".$single['text']."</option>\n";
    }
    $out .= "</select>\n";
    return $out;
}

/*==============================================================================================
    Function:    make_help_popup()
    In:          $text
                    Popup text
                 $caption
                    Popup caption
    Return:      N/A
    Notes:       The javacode for the popup
================================================================================================*/
function make_help_popup($text, $caption) {
    $text = addslashes(strtr($text,chr(10),chr(32)));
    return "onmouseover=\"return overlib('".$text."', BELOW, CENTER, CAPTION, '".$caption."', WIDTH, 300, OFFSETY, 20, FGCOLOR, '#ffffff', BGCOLOR, '#000000', TEXTCOLOR, '#000000', CAPCOLOR, '#ffffff', CLOSECOLOR, '#ffffff', CAPICON, '', BORDER, '2');\" onmouseout=\"return nd();\"";
}

?>