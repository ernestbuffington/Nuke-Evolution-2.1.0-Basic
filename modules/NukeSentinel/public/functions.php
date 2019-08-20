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

if (!defined('MODULE_FILE') || !defined('NUKESENTINEL_PUBLIC') ) {
   die ('You can\'t access this file directly...');
}
function stmain_menu($subtitle = "") {
    global $db, $module_name;
    if($subtitle > "") { $subtitle = ": ".$subtitle; }
    OpenTable();
    $checkrow = $db->sql_numrows($db->sql_query("SELECT * FROM `"._SENTINEL_IP2COUNTRY_TABLE."`"));
    echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
    echo '<tr><td><a href="modules.php?name='.$module_name.'&amp;op=STIPS">'._AB_BLOCKEDIPS.'</a></td></tr>'."\n";
    echo '<tr><td><a href="modules.php?name='.$module_name.'&amp;op=STRanges">'._AB_BLOCKEDRANGES.'</a></td></tr>'."\n";
    echo '<tr><td><a href="modules.php?name='.$module_name.'&amp;op=STReferers">'._AB_BLOCKEDREFERERS.'</a></td></tr>'."\n";
    if ($checkrow > 0) {
        echo '<tr><td><a href="modules.php?name='.$module_name.'&amp;op=STIP2C">'._AB_IP2COUNTRY.'</a></td></tr>'."\n";
    }
    echo '</table>'."\n";
    CloseTable();
}

function stpagenumspub($op, $totalselected, $perpage, $max, $column, $direction) {
    global $module_name;
    $pagesint = ($totalselected / $perpage);
    $pageremainder = ($totalselected % $perpage);
    if($pageremainder != 0) {
        $pages = ceil($pagesint);
        if($totalselected < $perpage) {
            $pageremainder = 0;
        }
    } else {
        $pages = $pagesint;
    }
    if($pages != 1 && $pages != 0) {
        $counter = 1;
        $currentpage = ($max / $perpage);
        echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" width="100%">'."\n";
        echo '<tr>'."\n";
        echo '<td width="33%">'."\n";
        echo '<form action="modules.php?name='.$module_name.'&amp;op='.$op.'" method="post" style="padding: 0px; margin: 0px;">'."\n";
        echo '<input type="hidden" name="min" value="'.(($max - $perpage) - $perpage).'" />'."\n";
        echo '<input type="hidden" name="column" value="'.$column.'" />'."\n";
        echo '<input type="hidden" name="direction" value="'.$direction.'" />'."\n";
        if($currentpage <= 1) {
            echo '&nbsp;';
        } else {
            echo '<input type="submit" value="'._AB_PREVPAGE.'" />';
        }
        echo '</form>'."\n";
        echo '</td>'."\n";
        echo '<td align="center" width="34%" nowrap>'."\n";
        echo '<form action="modules.php?name='.$module_name.'&amp;op='.$op.'" method="post" style="padding: 0px; margin: 0px;">'."\n";
        echo '<input type="hidden" name="column" value="'.$column.'" />'."\n";
        echo '<input type="hidden" name="direction" value="'.$direction.'" />'."\n";
        echo '<strong>'._AB_PAGE.':</strong> <select name="min">'."\n";
        while ($counter <= $pages ) {
            $cpage = $counter;
            $mintemp = ($perpage * $counter) - $perpage;
            echo '<option value="'.$mintemp.'"';
            if ($counter == $currentpage) {
                echo ' selected="selected"';
            }
            echo '>'.$counter.'</option>'."\n";
            $counter++;
        }
        echo '</select><strong> '._AB_OF.' '.$pages.' '._AB_PAGES.'</strong> <input type="submit" value="'._AB_GO.'" />'."\n";
        echo '</form>'."\n";
        echo '</td>'."\n";
        echo '<td align="right" width="33%">';
        echo '<form action="modules.php?name='.$module_name.'&amp;op='.$op.'" method="post" style="padding: 0px; margin: 0px;">'."\n";
        echo '<input type="hidden" name="min" value="'.$max.'" />'."\n";
        echo '<input type="hidden" name="column" value="'.$column.'" />'."\n";
        echo '<input type="hidden" name="direction" value="'.$direction.'" />'."\n";
        if($currentpage >= $pages) {
            echo '&nbsp;';
        } else {
            echo '<input type="submit" value="'._AB_NEXTPAGE.'" />';
        }
        echo '</form>'."\n";
        echo '</td>'."\n";
        echo '</tr>'."\n";
        echo '</table>'."\n";
    }
}

?>