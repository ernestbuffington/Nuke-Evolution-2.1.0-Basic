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

//Close the open table
CloseTable();
echo '<br />';
//Start a new table
OpenTable();

/*==============================================================================================
    Function:    get_values()
    In:          N/A
    Return:      Array of the values from the DB.
    Notes:       Will toss a DonateError if the values are not found
================================================================================================*/
function get_values() {
    global $db, $lang_donate;
    $sql = 'SELECT config_value from `'._DONATIONS_DONATOR_CONFIG_TABLE.'` WHERE config_name="values"';
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    $values = ($row['config_value']) ? explode(',',$row['config_value']) : DonateError($lang_donate['VALUES_NF']);
    return $values;
}

/*==============================================================================================
    Function:    display_values
    In:          $values
                    The array of values from the DB
    Return:      N/A
    Notes:       Will display all the values in the form/table
================================================================================================*/
function display_values($values) {
    global $lang_donate, $admin_file;
    if (!is_array($values)) {
        DonateError($lang_donate['VALUES_ND']);
    }
    echo '<div style="font-size:large; font-weight:bold; text-align:center;">'.$lang_donate['DONATION_VALUES'].'</div>';
    echo '<form id="values" method="post" action="'.$admin_file.'.php?op=Donations&amp;file=values"><table width="100%" border="0" align="center">';
    for ($i = 1; $i <= 5; $i++) {
        echo '<tr>';
            echo '<td width="48%" align="right">';
                echo $i;
            echo '</td>';
            echo '<td width="52%" align="left">';
                $value = ($values[$i-1]) ? $values[$i-1] : '';
                echo '<input type="text" size="5" name="value'.$i.'" value="'.$value.'" />';
            echo '</td>';
        echo '</tr>';
    }
    echo '<tr><td colspan="2"><div align="center"><input type="submit" value="'.$lang_donate['DONATION_SUBMIT'].'" /></div></td></tr>';
    echo '</table></form>';
}

/*==============================================================================================
    Function:    strip_values()
    In:          N/A
    Return:      String of values with , speration
    Notes:       Gets the data from $_POST
================================================================================================*/
function strip_values() {
    $values = '';
    for ($i = 1; $i <= 5; $i++) {
        $values .= ($_POST['value'.$i]) ? Fix_Quotes($_POST['value'.$i]) . ',' : ',';
    }
    $values = substr($values,0,strlen($values)-1);
    return $values;
}

/*==============================================================================================
    Function:    write_values()
    In:          $values
                    The string of values from strip_values
    Return:      N/A
    Notes:       Writes new values to the DB
================================================================================================*/
function write_values($values) {
    global $db, $lang_donate;
    $sql = 'UPDATE `'._DONATIONS_DONATOR_CONFIG_TABLE.'` SET config_value="'.$values.'" WHERE config_name="values"';
    $db->sql_query($sql);
}

/*~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-*/

//If new values were posted
if (!empty($_POST)) {
    write_values(strip_values());
}

//Display the current values
display_values(get_values());

?>