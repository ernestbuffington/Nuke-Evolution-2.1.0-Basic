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

$img_ok      = '<img src="install/images/ok.png" width="16" height="16" alt="" title="'.$lang_install['IMG_OK'].'" />';
$img_bad     = '<img src="install/images/error.png" width="16" height="16" alt="" title="'.$lang_install['IMG_BAD'].'" />';
$img_warn    = '<img src="install/images/warn.png" width="16" height="16" alt="" title="'.$lang_install['IMG_WARN'].'" />';
$img_done    = '<img src="install/images/tick.png" width="16" height="16" alt="" title="'.$lang_install['IMG_Done'].'" />';

$ftpchmod    = $_GETVAR->get('ftpchmod', '_REQUEST', 'string', '');
if ($ftpchmod == 'true') {
    header('Location: install.php/install/step2.1.php');
}
require_once(NUKE_DATA_DIR.'files.php');

$content     = '<table width="100%">';
$warnings    = 0;
$errors      = 0;
$not_changed = 0;

foreach ( $files as $filecheck => $filefields ) {
    $addinfo  = '';
    if (!empty($filecheck)) {
        if ( $filefields['filename'] ) {
            $filechange = TRUE;
            if ( $filefields['language'] == 1 ) {
                $file_to_change = ($filefields['path'] ? NUKE_BASE_DIR . $filefields['path'].'lang_'.$InstallConfig['language'].'/'.$filefields['filename'] : NUKE_BASE_DIR . $filefields['filename']);
            } else {
                $file_to_change = ($filefields['path'] ? NUKE_BASE_DIR . $filefields['path'].$filefields['filename'] : NUKE_BASE_DIR . $filefields['filename']);
            }
        } else {
            $filechange = FALSE;
            if ( $filefields['language'] == 1 ) {
                $file_to_change = ($filefields['path'] ? NUKE_BASE_DIR . $filefields['path'].'lang_'.$InstallConfig['language'].'/'.$filefields['filename'] : NUKE_BASE_DIR . $filefields['filename']);
            } else {
                $file_to_change = NUKE_BASE_DIR . $filefields['path'];
            }
        }
        $filerights = get_fileinfo($file_to_change);
        if ($filerights['exists']) {
        // There is no difference for chmod if it's a file or a directory
            if ( @chmod($file_to_change, intval($filefields['mode'],8))) {
                $filechanged = TRUE;
                $show_img = $img_done;
            } else {
                $filechanged = FALSE;
                $not_changed++;
            }
            if (!$filechanged) {
                // Get more infos for the user and for us
                if ( $filefields['must'] == 1 ) {
                    log_write($lang_install['File_error'].':  '.$file_to_change);
                    $show_img = $img_warn;
                    $addinfo .= $lang_install['File_CantChange'];
                    $errors++;
                } else {
                    log_write($lang_install['File_warning'].':  '.$file_to_change);
                    $show_img = $img_warn;
                    $addinfo .= $lang_install['File_CantChange'];
                    $warnings++;
                }
                if (!$filerights['is_owner']) {
                    //$addinfo .= 'Der Benutzer, unter dem der Webserver l&auml;uft ('.$filerights['run_user'].'), ist nicht der Besitzer der Datei ('.$filerights['owner'].')<br />';
                }
                if (!$filerights['is_group']) {
                    //$addinfo .= 'Die Benutzergruppe, unter dem der Webserver l&auml;uft ('.$filerights['run_group'].'), ist nicht Mitglied der Gruppe des Dateiinhabers ('.$filerights['group'].')<br />';
                }
            }
        } else {
            if ( $filefields['must'] == 1 ) {
                log_write($lang_install['File_notchanged'].':  '.$file_to_change);
                $addinfo .= $lang_install['File_mustexist'];
                $show_img = $img_bad;
                $errors++;
            } else {
                log_write($lang_install['File_notchanged'].':  '.$file_to_change);
                $addinfo .= $lang_install['File_shouldexist'];
                $show_img = $img_warn;
                $warnings++;
            }
        }
        $content .=  '<tr><td class="row1" width="90%">'.evo_help_img($filefields['help']).'&nbsp;'.$filefields['textlang'];
        if (!empty($addinfo)) {
            $content .= '<br /><div style="color : red;font-size: 10px;">'.$addinfo.'</div>';
        }
        $content .= "</td>\n";
        $content .=  '<td width="10%" class="row1">'.$show_img."</td>\n</tr>\n";
    }
}
$content .=  "</table>\n";
$content .=  '<br />';

if ( $errors == 0 ) {
    $goback = 1;
    $gonext = 1;
} else {
    $goback = 1;
    $gonext = 0;
}
install_header($goback, $gonext);

OpenTable();
OpenTable2();
echo "<div class='topictitle'><center>".$lang_install['File_Setup']."</center></div><br />";
echo "<div class='textarea'><center>".$lang_install['File_error'].":&nbsp;&nbsp;".$img_bad."</center></div>";
echo "<div class='textarea'><center>".$lang_install['File_notchanged'].":&nbsp;&nbsp;".$img_warn."</center></div>";
echo "<div class='textarea'><center>".$lang_install['File_done'].":&nbsp;&nbsp;".$img_done."</center></div>";
CloseTable2();
echo '<br />';
if ($not_changed > 0) {
    OpenTable2();
    echo '<br /><div style="color:red;font-size:10px;text-align:center;">'.$lang_install['File_ErrorChmod'].'</div>';
    echo '<br /><div style="font-size:10px;text-align:center;"><input type="submit" name="Button1" value="'.$lang_install['File_FTPChmod'].'" onclick="location.href=\'install.php?step='.$InstallConfig['step'].'&amp;addition=1\'"/></div>';
    CloseTable2();
}
echo $content;

$previous = $next = '';
if ($InstallConfig['old_step'] > $InstallConfig['min_step'] ) {
    $previous = '<a href="install.php?step='.$InstallConfig['old_step'].'"><img src="install/images/left.png" width="32" height="32" border="0" title="" alt="" /></a>';
}
if ($InstallConfig['next_step'] < $InstallConfig['max_step'] && $errors == 0) {
    $InstallConfig['Step_'.$InstallConfig['step'].'_'.'_error'] = 2;
    evo_setcookie($InstallConfig);
    $next = '<a href="install.php?step='.$InstallConfig['next_step'].'"><img src="install/images/right.png" width="32" height="32" border="0" title="" alt="" /></a>';
}
echo "<center>$previous&nbsp;&nbsp;$next</center>";
echo "<br /><br />";
CloseTable();

?>