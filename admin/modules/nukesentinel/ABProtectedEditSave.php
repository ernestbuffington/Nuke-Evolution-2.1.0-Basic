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

if (!defined('NUKESENTINEL_ADMIN')) {
   die ('You can\'t access this file directly...');
}

global $admin_file, $ab_config, $db, $bgcolor2, $bgcolor1, $_GETVAR;

if (is_admin()) {

    $old_ip_lo  = $_GETVAR->get('old_ip_lo', '_POST', 'string');
    $old_ip_hi  = $_GETVAR->get('old_ip_hi', '_POST', 'string');
    $xip_lo     = $_GETVAR->get('xip_lo', '_POST', 'array');
    $xip_hi     = $_GETVAR->get('xip_hi', '_POST', 'array');
    $xnotes     = $_GETVAR->get('xnotes', '_POST', 'string');
    $xc2c       = $_GETVAR->get('xc2c', '_POST', 'string');
    $xop        = $_GETVAR->get('xop', '_POST', 'string');
    $min        = $_GETVAR->get('min', '_POST', 'int', 0);
    $sip        = $_GETVAR->get('sip', '_POST', 'string');
    $column     = $_GETVAR->get('column', '_POST', 'string');
    $direction  = $_GETVAR->get('direction', '_POST', 'string');
    $testmessage = '';
    if(($xip_lo[0] < 0 OR $xip_lo[0] > 255 OR !is_numeric($xip_lo[0])) OR ($xip_lo[1] < 0 OR $xip_lo[1] > 255 OR !is_numeric($xip_lo[1])) OR ($xip_lo[2] < 0 OR $xip_lo[2] > 255 OR !is_numeric($xip_lo[2])) OR ($xip_lo[3] < 0 OR $xip_lo[3] > 255 OR !is_numeric($xip_lo[3]))) {
        $pagetitle = _AB_NUKESENTINEL.": "._AB_ADDRANGEERROR;
        include_once(NUKE_BASE_DIR.'header.php');
        title($pagetitle);
        OpenTable();
        echo '<br />'."\n";
        echo '<center><strong>'._AB_LOERROR.' </strong></center><br />'."\n";
        echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        die();
    }
    $xip_lo = implode(".", $xip_lo);
    $longip_lo = sprintf("%u", ip2long($xip_lo));
    if(($xip_hi[0] < 0 OR $xip_hi[0] > 255 OR !is_numeric($xip_hi[0])) OR ($xip_hi[1] < 0 OR $xip_hi[1] > 255 OR !is_numeric($xip_hi[1])) OR ($xip_hi[2] < 0 OR $xip_hi[2] > 255 OR !is_numeric($xip_hi[2])) OR ($xip_hi[3] < 0 OR $xip_hi[3] > 255 OR !is_numeric($xip_hi[3]))) {
        $pagetitle = _AB_NUKESENTINEL.": "._AB_ADDRANGEERROR;
        include_once(NUKE_BASE_DIR.'header.php');
        title($pagetitle);
        OpenTable();
        echo '<br />'."\n";
        echo '<center><strong>'._AB_HIERROR.' </strong></center><br />'."\n";
        echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        die();
    }
    $xip_hi = implode(".", $xip_hi);
    $longip_hi = sprintf("%u", ip2long($xip_hi));
    if($longip_hi < $longip_lo) {
        $pagetitle = _AB_NUKESENTINEL.": "._AB_ADDRANGEERROR;
        include_once(NUKE_BASE_DIR.'header.php');
        title($pagetitle);
        OpenTable();
        echo '<br />'."\n";
        echo '<center><strong>'._AB_HILOERROR.' </strong></center><br />'."\n";
        echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        die();
    }
    $test1 = $db->sql_query("SELECT * FROM "._SENTINEL_PROTECTED_RANGES_TABLE." WHERE (ip_lo<='$longip_lo' AND ip_hi>='$longip_lo') AND (`ip_lo`!='$old_ip_lo' AND `ip_hi`!='$old_ip_hi') ORDER BY `ip_lo`");
    $test2 = $db->sql_query("SELECT * FROM "._SENTINEL_PROTECTED_RANGES_TABLE." WHERE (ip_lo<='$longip_hi' AND ip_hi>='$longip_hi') AND (`ip_lo`!='$old_ip_lo' AND `ip_hi`!='$old_ip_hi') ORDER BY `ip_lo`");
    $test3 = $db->sql_query("SELECT * FROM "._SENTINEL_PROTECTED_RANGES_TABLE." WHERE (ip_lo>='$longip_lo' AND ip_hi<='$longip_hi') AND (`ip_lo`!='$old_ip_lo' AND `ip_hi`!='$old_ip_hi') ORDER BY `ip_lo`");
    $test4 = $db->sql_query("SELECT * FROM "._SENTINEL_PROTECTED_RANGES_TABLE." WHERE (ip_lo<='$longip_lo' AND ip_hi>='$longip_hi') AND (`ip_lo`!='$old_ip_lo' AND `ip_hi`!='$old_ip_hi') ORDER BY `ip_lo`");
    $testnum1 = $db->sql_numrows($test1);
    $testnum2 = $db->sql_numrows($test2);
    $testnum3 = $db->sql_numrows($test3);
    $testnum4 = $db->sql_numrows($test4);
    if($testnum1 > 0 OR $testnum2 >0 OR $testnum3 >0 OR $testnum4 >0) {
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        OpenMenu(_AB_EDITPROTECTEDERROR);
        mastermenu();
        CarryMenu();
        protectedmenu();
        CloseMenu();
        CloseTable();
        echo '<br />'."\n";
        OpenTable();
        if($testnum1 > 0) {
            $testmessage .= '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
            $testmessage .= '<tr bgcolor="'.$bgcolor1.'"><td align="center" colspan="6"><strong>'.long2ip($xip_lo).' '._AB_IN.':</strong></td></tr>'."\n";
            $testmessage .= '<tr bgcolor="'.$bgcolor2.'">'."\n";
            $testmessage .= '<td width="25%"><strong>'._AB_IPLO.'</strong></td>'."\n";
            $testmessage .= '<td width="25%"><strong>'._AB_IPHI.'</strong></td>'."\n";
            $testmessage .= '<td align="center" width="15%"><strong>'._AB_FLAG.'</strong></td>'."\n";
            $testmessage .= '<td align="center" width="15%"><strong>'._AB_CODE.'</strong></td>'."\n";
            $testmessage .= '<td align="center" width="20%"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
            $testmessage .= '</tr>'."\n";
            while($testrow1 = $db->sql_fetchrow($test1)) {
                $testrow1['ip_lo_ip'] = long2ip($testrow1['ip_lo']);
                $testrow1['ip_hi_ip'] = long2ip($testrow1['ip_hi']);
                $testrow1['c2c'] = strtoupper($testrow1['c2c']);
                $testrow1['flag_img'] = flag_img($testrow1['c2c']);
                $testmessage .= '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
                $testmessage .= '<td><a href="'.$ab_config['lookup_link'].$testrow1['ip_lo_ip'].'" target="_blank">'.$testrow1['ip_lo_ip'].'</a></td>'."\n";
                $testmessage .= '<td><a href="'.$ab_config['lookup_link'].$testrow1['ip_hi_ip'].'" target="_blank">'.$testrow1['ip_hi_ip'].'</a></td>'."\n";
                $testmessage .= '<td align="center">'.$testrow1['flag_img'].'</td>'."\n";
                $testmessage .= '<td align="center">'.$testrow1['c2c'].'</td>'."\n";
                $testmessage .= '<td align="center" nowrap="nowrap">&nbsp;<a href="'.$admin_file.'.php?op=ABBlockedRangeEdit&amp;ip_lo='.$testrow1['ip_lo'].'&amp;ip_hi='.$testrow1['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
                $testmessage .= '<a href="'.$admin_file.'.php?op=ABBlockedRangeDelete&amp;ip_lo='.$testrow1['ip_lo'].'&amp;ip_hi='.$testrow1['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/delete.png" border="0" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" height="16" width="16" /></a>&nbsp;</td>'."\n";
                $testmessage .= '</tr>'."\n";
            }
            $db->sql_freeresult($test1);
            $testmessage .= '</table>'."\n";
            $testmessage .= '<br />'."\n";
        }
        if($testnum2 > 0) {
            $testmessage .= '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
            $testmessage .= '<tr bgcolor="'.$bgcolor1.'"><td align="center" colspan="6"><strong>'.long2ip($xip_hi).' '._AB_IN.':</strong></td></tr>'."\n";
            $testmessage .= '<tr bgcolor="'.$bgcolor2.'">'."\n";
            $testmessage .= '<td width="25%"><strong>'._AB_IPLO.'</strong></td>'."\n";
            $testmessage .= '<td width="25%"><strong>'._AB_IPHI.'</strong></td>'."\n";
            $testmessage .= '<td align="center" width="15%"><strong>'._AB_FLAG.'</strong></td>'."\n";
            $testmessage .= '<td align="center" width="15%"><strong>'._AB_CODE.'</strong></td>'."\n";
            $testmessage .= '<td align="center" width="20%"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
            $testmessage .= '</tr>'."\n";
            while($testrow2 = $db->sql_fetchrow($test2)) {
                $testrow2['ip_lo_ip'] = long2ip($testrow2['ip_lo']);
                $testrow2['ip_hi_ip'] = long2ip($testrow2['ip_hi']);
                $testrow2['c2c'] = strtoupper($testrow2['c2c']);
                $testrow2['flag_img'] = flag_img($testrow2['c2c']);
                $testmessage .= '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
                $testmessage .= '<td><a href="'.$ab_config['lookup_link'].$testrow2['ip_lo_ip'].'" target="_blank">'.$testrow2['ip_lo_ip'].'</a></td>'."\n";
                $testmessage .= '<td><a href="'.$ab_config['lookup_link'].$testrow2['ip_hi_ip'].'" target="_blank">'.$testrow2['ip_hi_ip'].'</a></td>'."\n";
                $testmessage .= '<td align="center">'.$testrow2['flag_img'].'</td>'."\n";
                $testmessage .= '<td align="center">'.$testrow2['c2c'].'</td>'."\n";
                $testmessage .= '<td align="center" nowrap="nowrap">&nbsp;<a href="'.$admin_file.'.php?op=ABBlockedRangeEdit&amp;ip_lo='.$testrow2['ip_lo'].'&amp;ip_hi='.$testrow2['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
                $testmessage .= '<a href="'.$admin_file.'.php?op=ABBlockedRangeDelete&amp;ip_lo='.$testrow2['ip_lo'].'&amp;ip_hi='.$testrow2['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/delete.png" border="0" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" height="16" width="16" /></a>&nbsp;</td>'."\n";
                $testmessage .= '</tr>'."\n";
            }
            $db->sql_freeresult($test2);
            $testmessage .= '</table>'."\n";
            $testmessage .= '<br />'."\n";
        }
        if($testnum3 > 0) {
            $testmessage .= '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
            $testmessage .= '<tr bgcolor="'.$bgcolor1.'"><td align="center" colspan="6"><strong>'.long2ip($xip_lo).' - '.long2ip($xip_hi).' '._AB_COVERS.':</strong></td></tr>'."\n";
            $testmessage .= '<tr bgcolor="'.$bgcolor2.'">'."\n";
            $testmessage .= '<td width="25%"><strong>'._AB_IPLO.'</strong></td>'."\n";
            $testmessage .= '<td width="25%"><strong>'._AB_IPHI.'</strong></td>'."\n";
            $testmessage .= '<td align="center" width="15%"><strong>'._AB_FLAG.'</strong></td>'."\n";
            $testmessage .= '<td align="center" width="15%"><strong>'._AB_CODE.'</strong></td>'."\n";
            $testmessage .= '<td align="center" width="20%"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
            $testmessage .= '</tr>'."\n";
            while($testrow3 = $db->sql_fetchrow($test3)) {
                $testrow3['ip_lo_ip'] = long2ip($testrow3['ip_lo']);
                $testrow3['ip_hi_ip'] = long2ip($testrow3['ip_hi']);
                $testrow3['c2c'] = strtoupper($testrow3['c2c']);
                $testrow3['flag_img'] = flag_img($testrow3['c2c']);
                $testmessage .= '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
                $testmessage .= '<td><a href="'.$ab_config['lookup_link'].$testrow3['ip_lo_ip'].'" target="_blank">'.$testrow3['ip_lo_ip'].'</a></td>'."\n";
                $testmessage .= '<td><a href="'.$ab_config['lookup_link'].$testrow3['ip_hi_ip'].'" target="_blank">'.$testrow3['ip_hi_ip'].'</a></td>'."\n";
                $testmessage .= '<td align="center">'.$testrow3['flag_img'].'</td>'."\n";
                $testmessage .= '<td align="center">'.$testrow3['c2c'].'</td>'."\n";
                $testmessage .= '<td align="center" nowrap="nowrap">&nbsp;<a href="'.$admin_file.'.php?op=ABBlockedRangeEdit&amp;ip_lo='.$testrow3['ip_lo'].'&amp;ip_hi='.$testrow3['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
                $testmessage .= '<a href="'.$admin_file.'.php?op=ABBlockedRangeDelete&amp;ip_lo='.$testrow3['ip_lo'].'&amp;ip_hi='.$testrow3['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/delete.png" border="0" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" height="16" width="16" /></a>&nbsp;</td>'."\n";
                $testmessage .= '</tr>'."\n";
            }
            $db->sql_freeresult($test3);
            $testmessage .= '</table>'."\n";
            $testmessage .= '<br />'."\n";
        }
        if($testnum4 > 0) {
            $testmessage .= '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
            $testmessage .= '<tr bgcolor="'.$bgcolor1.'"><td align="center" colspan="6"><strong>'.long2ip($xip_lo).' - '.long2ip($xip_hi).' '._AB_ISCOVERED.':</strong></td></tr>'."\n";
            $testmessage .= '<tr bgcolor="'.$bgcolor2.'">'."\n";
            $testmessage .= '<td width="25%"><strong>'._AB_IPLO.'</strong></td>'."\n";
            $testmessage .= '<td width="25%"><strong>'._AB_IPHI.'</strong></td>'."\n";
            $testmessage .= '<td align="center" width="15%"><strong>'._AB_FLAG.'</strong></td>'."\n";
            $testmessage .= '<td align="center" width="15%"><strong>'._AB_CODE.'</strong></td>'."\n";
            $testmessage .= '<td align="center" width="20%"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
            $testmessage .= '</tr>'."\n";
            while($testrow4 = $db->sql_fetchrow($test4)) {
                $testrow4['ip_lo_ip'] = long2ip($testrow4['ip_lo']);
                $testrow4['ip_hi_ip'] = long2ip($testrow4['ip_hi']);
                $testrow4['c2c'] = strtoupper($testrow4['c2c']);
                $testrow4['flag_img'] = flag_img($testrow4['c2c']);
                $testmessage .= '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
                $testmessage .= '<td><a href="'.$ab_config['lookup_link'].$testrow4['ip_lo_ip'].'" target="_blank">'.$testrow4['ip_lo_ip'].'</a></td>'."\n";
                $testmessage .= '<td><a href="'.$ab_config['lookup_link'].$testrow4['ip_hi_ip'].'" target="_blank">'.$testrow4['ip_hi_ip'].'</a></td>'."\n";
                $testmessage .= '<td align="center">'.$testrow4['flag_img'].'</td>'."\n";
                $testmessage .= '<td align="center">'.$testrow4['c2c'].'</td>'."\n";
                $testmessage .= '<td align="center" nowrap="nowrap">&nbsp;<a href="'.$admin_file.'.php?op=ABBlockedRangeEdit&amp;ip_lo='.$testrow4['ip_lo'].'&amp;ip_hi='.$testrow4['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
                $testmessage .= '<a href="'.$admin_file.'.php?op=ABBlockedRangeDelete&amp;ip_lo='.$testrow4['ip_lo'].'&amp;ip_hi='.$testrow4['ip_hi'].'&amp;xop=ABMain" target="_blank"><img src="images/nukesentinel/delete.png" border="0" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" height="16" width="16" /></a>&nbsp;</td>'."\n";
                $testmessage .= '</tr>'."\n";
            }
            $db->sql_freeresult($test4);
            $testmessage .= '</table>'."\n";
            $testmessage .= '<br />'."\n";
        }
        echo $testmessage;
        echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        $xnotes = str_replace("<br />", "\r\n", $xnotes);
        $xnotes = str_replace("<br />", "\r\n", $xnotes);
        $xtime = time();
        $db->sql_uquery("UPDATE `"._SENTINEL_PROTECTED_RANGES_TABLE."` SET `ip_lo`='$longip_lo', `ip_hi`='$longip_hi', `c2c`='$xc2c', `date`='$xtime', `notes`='$xnotes' WHERE `ip_lo`='$old_ip_lo' AND `ip_hi`='$old_ip_hi'");
        redirect($admin_file.'.php?op='.$xop.'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;sip='.$sip);
    }
} else {
    redirect($admin_file.'.php?op=ABMain');
}

?>