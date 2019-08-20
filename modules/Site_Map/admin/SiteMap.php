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
   die ('Illegal File Access');
}

if (!defined('IN_SITEMAP_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN SITEMAP ADMINISTRATION');
}

$result = $db->sql_query("SELECT * FROM "._JMAP_TABLE);
while ($row = $db->sql_fetchrow($result)) {
    $nametask = $row['name'];
    $value    = $row['value'];
    $conf[$nametask] = $value;
}
$smxm    = $conf['xml'];
$ndown   = $conf['ndown'];
$nnews   = $conf['nnews'];
$nrev    = $conf['nrev'];
$ntopics = $conf['ntopics'];
$nuser   = $conf['nuser'];

include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\"><a href=\"$admin_file.php?op=sitemap\">" .$lang_new[$module_name]['SITEMAP_ADMIN_HEADER'] . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . $lang_new[$module_name]['SITEMAP_RETURNMAIN'] . "</a> ]</div>\n";
CloseTable();
echo "<br />";
OpenTable();
echo"<center><strong>".$lang_new[$module_name]['SITEMAPADMIN']."</strong></center>";
CloseTable();
echo "<br />";
OpenTable();
echo "<form method=\"post\" action=\"".$admin_file.".php\" name=\"sitemap_settings\">";
echo "<input type=\"hidden\" name=\"op\" value=\"sitemap_save\" />";
echo '<table border="0" id="table6" width="50%" align="center">
        <tr>
            <td width="50%" height="30%" align="center">
                <table border="0" width="588" id="table7">
                    <tr>
                        <td width="146" height="102">
                            <p align="left">'.$lang_new[$module_name]['XMLCREATE'].'</p>
                        </td>
                        <td height="102">';
echo                        '<p align="left">' . yesno_option('smxm', $smxm) .'</p>';
echo'                   </td>
                        <td height="102">
                            <p align="left">'.$lang_new[$module_name]['NDOWN'].'</p>
                        </td>
                        <td height="102">
                            <p align="left">&nbsp;<input name="ndown" size="6" value="'.$ndown.'" /></p>
                        </td>
                    </tr>
                    <tr>
                        <td width="146" height="102">
                            <p align="left">'.$lang_new[$module_name]['NNEWS'].'</p>
                        </td>
                        <td width="146" height="102">
                            <p align="left">&nbsp;<input name="nnews" size="6" value="'.$nnews.'" /></p>
                        </td>
                        <td width="147" height="102">
                            <p align="left">'.$lang_new[$module_name]['NREV'].'</p>
                        </td>
                        <td width="147" height="102">
                            <p align="left">&nbsp;<input name="nrev" size="6" value="'.$nrev.'" /></p>
                        </td>
                    </tr>
                    <tr>
                        <td width="146" height="102">
                            <p align="left">'.$lang_new[$module_name]['NTOPICS'].'</p>
                        </td>
                        <td width="146" height="102">
                            <p align="left">&nbsp;<input name="ntopics" size="6" value="'.$ntopics.'" /></p>
                        </td>
                        <td width="147" height="102">
                            <p align="left">'.$lang_new[$module_name]['NUSER'].'</p>
                        </td>
                        <td width="147" height="102">
                            <p align="left">&nbsp;<input name="nuser" size="6" value="'.$nuser.'" /></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" height="72">
                <table border="0" width="566" id="table14">
                    <tr>
                        <td width="188">
                            &nbsp;
                        </td>
                        <td width="164">
                            <p align="center"><input type="submit" value="'.$lang_new[$module_name]['OK'].'" name="ok" /></p>
                        </td>
                        <td width="200">
                            &nbsp;
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    </form>
';


CloseTable();
// YOU ARE NOT AUTHORISED TO REMOVE OR EDIT BELOW LINES WITHOUT AUTHORS PERMISSIONS. PLEASE PLAY FAIR.
// NON MOFIFICARE O RIMUOBERE LE LINEE SEGUENTI SENZA IL PERMESSO DELL'AUTORE
echo "<script type=\"text/javascript\">\n";
echo "<!--\n";
echo "function openpopupjmap(){\n";
echo "  window.open (\"modules/Site_Map/copyright.php\",\"Copyright\",\"toolbar=no,location=no,directories=no,status=no,scrollbars=auto,resizable=no,copyhistory=no,width=400,height=230\");\n";
echo "}\n";
echo "//-->\n";
echo "</script>\n\n";
echo "<div align=\"right\"><a href=\"javascript:openpopupjmap()\">Site Map &copy;</a></div><br />";

include_once(NUKE_BASE_DIR.'footer.php');

?>