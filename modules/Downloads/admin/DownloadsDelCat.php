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

if (!defined('IN_DOWNLOADS_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN DOWNLOADS ADMINISTRATION');
}

include_once(NUKE_BASE_DIR.'header.php');
$cid        = intval($cid);
$CatDeleted = '';
$sql_ary    = '';
if($ok == 1) {
    $CatDeleted 		= DownloadsDeleteDirectory($cid);
    DownloadsHeader();
    OpenTable();
    if ( $CatDeleted['ok'] == 'ok' ) {
        echo "<center>".$lang_new[$module_name]['MESSAGE_CATEGORY_DELETED']."</center><br />\n";
        echo "<center>[ <a href=\"".$admin_file.".php?op=DownloadsCatList\">" . $lang_new[$module_name]['SUBMIT_RETURN'] . "</a> ]</center><br /><br />";
    } else if ( $CatDeleted == 'notok' ) {
        echo "<center>".$lang_new[$module_name]['ERROR_CAT_DELETED_ERROR']."</center>\n";
        foreach ($CatDeleted as $type => $id) {
            if ( $type == 'file' ) {
                echo $lang_new[$module_name]['ERROR_FILE_DELETION'].':&nbsp;&nbsp;'.$id."<br />\n";
                echo "<center>[ <a href=\"".$admin_file.".php?op=DownloadsCatList\">" . $lang_new[$module_name]['SUBMIT_RETURN'] . "</a> ]</center><br /><br />";
            } elseif ( $type == 'cat' ) {
                echo $lang_new[$module_name]['ERROR_CAT_DELETION'].':&nbsp;&nbsp;'.$id."<br />\n";
                echo "<center>[ <a href=\"".$admin_file.".php?op=DownloadsCatList\">" . $lang_new[$module_name]['SUBMIT_RETURN'] . "</a> ]</center><br /><br />";
            }
        }
    } else {
        echo "<center>".$lang_new[$module_name]['ERROR_UNKNOWN']."</center>\n";
        echo "<center>[ <a href=\"".$admin_file.".php?op=DownloadsCatList\">" . $lang_new[$module_name]['SUBMIT_RETURN'] . "</a> ]</center><br /><br />";
    }
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    exit();
} else {
    $catarray  	= array();
    $childcats 	= DownloadsdeepCat($cid, $catarray);
    $nbsubcat  	= count($childcats);
	$row 		= $db->sql_fetchrow($db->sql_query("SELECT  `uploaddir` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `cid`='$cid'"));
	$uploaddir 	= stripslashes($row['uploaddir']);
	$nbcat 		= $db->sql_numrows($db->sql_query("SELECT `cid` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `uploaddir`='$uploaddir'"));
	$nbcat	    	= $nbcat -1;
    $sql_ary 	= $cid . ',';
    if ( $nbsubcat > 0 ) {
        foreach ( $childcats as $number => $cat ) {
            $sql_ary .= $cat . ',';
        }
    }
    // Add a category which is never possible, to get a correct sql-statement
    $sql_ary .= '-1';
    $result = $db->sql_ufetchrow("SELECT COUNT(`did`) AS number FROM `"._DOWNLOADS_DOWNLOADS_TABLE."` WHERE `cid` IN ($sql_ary)");
    $nbdownloads = ($result['number'] ? $result['number'] : 0);
    DownloadsHeader();
    OpenTable();
    echo "<center><strong>". $lang_new[$module_name]['DELETE'] ." ".$lang_new[$module_name]['CATEGORY']."</strong><br /><br />";

	if ($nbcat > 0) {
		echo "<strong><style type='text/css'>.style1 {color: #FF0000}</style>"
			."<span class='style1'>"
			.$lang_new[$module_name]['THERE_ARE'] . " $nbcat " . $lang_new[$module_name]['CATEGORIES'] . " " . $lang_new[$module_name]['ADMIN_CAT_ATTACHED'] . "</span></strong><br />";
		}
	if ($nbsubcat > 0) {
		echo "<strong><style type='text/css'>.style1 {color: #FF0000}</style>"
			."<span class='style1'>"
    			.$lang_new[$module_name]['THERE_ARE'] . " $nbsubcat " . $lang_new[$module_name]['CATEGORIESSUB'] . " " . $lang_new[$module_name]['ADMIN_CAT_ATTACHED'] . "<br />";
		}
	if ($nbdownloads > 0) {
		echo "<strong><style type='text/css'>.style1 {color: #FF0000}</style>"
			."<span class='style1'>"
    			.$lang_new[$module_name]['THERE_ARE'] . " $nbdownloads " . $lang_new[$module_name]['DOWNLOADS'] . " " . $lang_new[$module_name]['ADMIN_CAT_ATTACHED'] . "<br /><br />";
		}
    echo "<strong><br /><br />" . $lang_new[$module_name]['WARN_CAT_DELETE'] . "</strong><br /><br />";
    echo "</center>";
}
echo "<center>[ <a href=\"".$admin_file.".php?op=DownloadsDelCat&amp;cid=$cid&amp;ok=1\">" .$lang_new[$module_name]['SUBMIT_DOIT'] . "</a> | <a href=\"".$admin_file.".php?op=DownloadsCatList\">" . $lang_new[$module_name]['SUBMIT_RETURN'] . "</a> ]</center><br /><br />";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>