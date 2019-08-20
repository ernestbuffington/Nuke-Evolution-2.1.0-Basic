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

$module_name = basename(dirname(dirname(__FILE__)));
global $admin_file, $db, $module_name, $_GETVAR, $lang_admin;

$op = $_GETVAR -> get ('op', '_REQUEST', 'string', '');

if(is_mod_admin($module_name)) {
    getmodule_lang($module_name);

    $c_num = $db->sql_unumrows("SELECT COUNT(cid) FROM "._BANNER_CLIENT_TABLE);
    if ($c_num == 0) {
        $cli = "<em>".$lang_new[$module_name]['_ADDNEWBANNER']."</em>";
    } else {
        $cli = "<a href='".$admin_file.".php?op=add_banner'>".$lang_new[$module_name]['_ADDNEWBANNER']."</a>";
    }
    if (!is_active($module_name)) {
        $act = "<br /><center>".$lang_new[$module_name]['_ADSMODULEINACTIVE']."</center>";
    } else {
        $act = "";
    }
    $ad_admin_menu_main = "<center><span class='title'><strong>".$lang_new[$module_name]['_BANNERSADMIN']."</strong></span><br /><br />[ <a href='".$admin_file.".php?op=ad_positions'>".$lang_new[$module_name]['_ADPOSITIONS']."</a> - ".$cli." - <a href='".$admin_file.".php?op=add_client'>".$lang_new[$module_name]['_ADDCLIENT']."</a> - <a href='".$admin_file.".php?op=ad_terms'>".$lang_new[$module_name]['_TERMS']."</a> - <a href='".$admin_file.".php?op=ad_plans'>".$lang_new[$module_name]['_PLANSPRICES']."</a> ]</center>$act";
    $ad_admin_menu = "<center><span class='title'><strong>".$lang_new[$module_name]['_BANNERSADMIN']."</strong></span><br /><br />[ <a href='".$admin_file.".php?op=BannersAdmin'>".$lang_new[$module_name]['_BANNERS']."</a> - <a href='".$admin_file.".php?op=ad_positions'>".$lang_new[$module_name]['_ADPOSITIONS']."</a> - ".$cli." - <a href='".$admin_file.".php?op=add_client'>".$lang_new[$module_name]['_ADDCLIENT']."</a> - <a href='".$admin_file.".php?op=ad_terms'>".$lang_new[$module_name]['_TERMS']."</a> - <a href='".$admin_file.".php?op=ad_plans'>".$lang_new[$module_name]['_PLANSPRICES']."</a> ]</center>".$act;

    function BannersAdmin() {
        global $db, $ThemeInfo, $admin_file, $ad_admin_menu_main, $bgcolor1, $module_name, $lang_new;

        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align='center'>\n<a href='$admin_file.php?op=BannersAdmin'>".$lang_new[$module_name]['_BANNERS_ADMIN_HEADER']."</a></div>\n";
        echo "<br /><br />";
        echo "<div align='center'>\n[ <a href='$admin_file.php'>".$lang_new[$module_name]['_BANNERS_RETURNMAIN']."</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo $ad_admin_menu_main;
        CloseTable();
        echo "<br /><a name='top' />";
        OpenTable();
        echo "<p style='font-weight:bold; text-align:center;'>".$lang_new[$module_name]['_ACTIVEBANNERS']."</p>"
        ."<table width='100%' border='1'><tr>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_BANNERNAME']."</strong></td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_CLIENT']."</strong></td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_IMPRESSIONS']."</strong></td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_IMPLEFT']."</strong></td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_CLICKS']."</strong></td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_CLICKSPERCENT']."</strong></td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_POSITION']."</strong></td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_CLASS']."</strong></td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_FUNCTIONS']."</strong></td></tr>";
        $result = $db->sql_query("SELECT bid, cid, name, imptotal, impmade, clicks, imageurl, date, position, active, ad_class, type FROM "._BANNER_TABLE." WHERE active='1' ORDER BY position,bid", true);
        while (list($bid, $cid, $clientname, $imptotal, $impmade, $clicks, $imageurl, $date, $type, $active, $ad_class) = $db->sql_fetchrow($result)) {
            $bid = intval($bid);
            $cid = intval($cid);
            $imptotal = intval($imptotal);
            $impmade = intval($impmade);
            $clicks = intval($clicks);
            $active = intval($active);
            list($cid, $client_name) = $db->sql_ufetchrow("SELECT cid, name FROM "._BANNER_CLIENT_TABLE." WHERE cid='$cid'");
            $cid = intval($cid);
            $clientname = trim($clientname);
            if (empty($clientname)) {
                $clientname = $lang_new[$module_name]['_NONE'];
            } else {
                if ($ad_class == 'image') {
                    $clientname = "<a href='$imageurl' target='_blank'>".$clientname."</a>";
                }
            }
            if (empty($ad_class)) {
                $ad_class = 'image';
            }
            $ad_class = ucfirst($ad_class);
            if($impmade==0) {
                $percent = 0;
            } else {
                $percent = substr(100 * $clicks / $impmade, 0, 5);
            }
            if($imptotal==0) {
                $left = $lang_new[$module_name]['_UNLIMITED'];
            } else {
                $left = $imptotal-$impmade;
            }
            $percent = $percent.'%';
            if ($ad_class == 'Code' || $ad_class == 'Flash') {
                $clicks = 'N/A';
                $percent = 'N/A';
            }
            $row2 = $db->sql_ufetchrow("SELECT apid, position_name FROM "._BANNER_POSITIONS_TABLE." WHERE position_number='".$type."'");
            $type = "<a href='".$admin_file.".php?op=position_edit&amp;apid=".$row2['apid'] . "'>".$row2['position_name']."</a>";
            if ($active == 1) {
                $t_active = "<img src='".evo_image('active.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_ACTIVE']."' title='".$lang_new[$module_name]['_ACTIVE']."' />";
                $c_active = "<img src='".evo_image('inactive.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_INACTIVE']."' title='".$lang_new[$module_name]['_INACTIVE']."' />";
            } else {
                $t_active = "<img src='".evo_image('inactive.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_INACTIVE']."' title='".$lang_new[$module_name]['_INACTIVE']."' />";
                $c_active = "<img src='".evo_image('active.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_ACTIVE']."' title='".$lang_new[$module_name]['_ACTIVE']."' />";
            }
            echo "<tr><td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>".$clientname."</td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'><a href='".$admin_file.".php?op=BannerClientEdit&amp;cid=".$cid."'>".$client_name."</a></td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>".$impmade."</td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>".$left."</td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>".$clicks."</td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>".$percent."</td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>".$type."</td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>".$ad_class."</td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>&nbsp;<a href='".$admin_file.".php?op=BannerEdit&amp;bid=".$bid."'><img src='".evo_image('edit.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_EDIT']."' title='".$lang_new[$module_name]['_EDIT']."' /></a>&nbsp;&nbsp;<a href='".$admin_file.".php?op=BannerStatus&amp;bid=".$bid."&amp;status=".$active."'>".$c_active."</a>&nbsp;&nbsp;<a href='".$admin_file.".php?op=BannerDelete&amp;bid=".$bid."&amp;ok=0'><img src='".evo_image('delete.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_DELETE']."' title='".$lang_new[$module_name]['_DELETE']."' /></a>&nbsp;</td></tr>";
        }
        $db->sql_freeresult($result);
        echo "</table><br />"
        ."<p style='font-weight:bold; text-align:center;'>".$lang_new[$module_name]['_INACTIVEBANNERS']."</p>"
        ."<table width='100%' border='1'><tr>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_BANNERNAME']."</strong></td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_CLIENT']."</strong></td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_IMPRESSIONS']."</strong></td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_IMPLEFT']."</strong></td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_CLICKS']."</strong></td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_CLICKSPERCENT']."</strong></td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_POSITION']."</strong></td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_CLASS']."</strong></td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_FUNCTIONS']."</strong></td></tr>";
        $result = $db->sql_query("SELECT bid, cid, name, imptotal, impmade, clicks, imageurl, date, position, active, ad_class FROM "._BANNER_TABLE." WHERE active='0' ORDER BY position,bid");
        while ($row = $db->sql_fetchrow($result)) {
            $bid        = intval($row['bid']);
            $cid        = intval($row['cid']);
            $imptotal   = intval($row['imptotal']);
            $impmade    = intval($row['impmade']);
            $clicks     = intval($row['clicks']);
            $imageurl   = $row['imageurl'];
            $date       = $row['date'];
            $type       = $row['position'];
            $active     = intval($row['active']);
            $row2 = $db->sql_ufetchrow("SELECT cid, name FROM "._BANNER_CLIENT_TABLE." WHERE cid='".$cid."'");
            $cid  = intval($row2['cid']);
            $clientname = trim($row2['name']);
            $ad_class   = $row['ad_class'];
            if (empty($row['name'])) {
                $row['name'] = $lang_new[$module_name]['_NONE'];
            } else {
                if ($row['ad_class'] == 'image') {
                    $row['name'] = "<a href='".$imageurl."' target='_blank'>".$row['name']."</a>";
                }
            }
            if (empty($ad_class)) {
                $ad_class = 'image';
            }
            $ad_class = ucFirst($ad_class);
            if($impmade==0) {
                $percent = 0;
            } else {
                $percent = substr(100 * $clicks / $impmade, 0, 5);
            }
            if($imptotal==0) {
                $left = $lang_new[$module_name]['_UNLIMITED'];
            } else {
                $left = $imptotal-$impmade;
            }
            $percent = $percent.'%';
            if ($ad_class == 'Code' || $ad_class == 'Flash') {
                $clicks  = $lang_new[$module_name]['_NA'];
                $percent = $lang_new[$module_name]['_NA'];
            }
            $row2 = $db->sql_ufetchrow("SELECT apid, position_name FROM "._BANNER_POSITIONS_TABLE." WHERE position_number='".$type."'");
            $type = "<a href='".$admin_file.".php?op=position_edit&amp;apid=".$row2['apid'] . "'>".$row2['position_name']."</a>";
            if ($active == 1) {
                $t_active = "<img src='".evo_image('active.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_ACTIVE']."' title='".$lang_new[$module_name]['_ACTIVE']."' />";
                $c_active = "<img src='".evo_image('inactive.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_DEACTIVATE']."' title='".$lang_new[$module_name]['_DEACTIVATE']."' />";
            } else {
                $t_active = "<img src='".evo_image('inactive.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_INACTIVE']."' title='".$lang_new[$module_name]['_INACTIVE']."' />";
                $c_active = "<img src='".evo_image('active.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_ACTIVATE']."' title='".$lang_new[$module_name]['_ACTIVATE']."' />";
            }

            echo "<tr><td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>".$row['name']."</td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'><a href='".$admin_file.".php?op=BannerClientEdit&amp;cid=".$row['cid']."'>".$clientname."</a></td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>$impmade</td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>$left</td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>$clicks</td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>$percent</td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>$type</td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>$ad_class</td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>&nbsp;<a href='".$admin_file.".php?op=BannerEdit&amp;bid=".$bid."'><img src='".evo_image('edit.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_EDIT']."' title='".$lang_new[$module_name]['_EDIT']."' /></a>&nbsp;&nbsp;<a href='".$admin_file.".php?op=BannerStatus&amp;bid=".$bid."&amp;status=".$active."'>".$c_active."</a>&nbsp;&nbsp;<a href='".$admin_file.".php?op=BannerDelete&amp;bid=".$bid."&amp;ok=0'><img src='".evo_image('delete.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_DELETE']."' title='".$lang_new[$module_name]['_DELETE']."' /></a>&nbsp;</td></tr>";
        }
        $db->sql_freeresult($result);
        echo "</table>";
        CloseTable();
        echo "<br />";
        /* Clients List */
        OpenTable();
        echo "<p style='font-weight:bold; text-align:center;'>".$lang_new[$module_name]['_ADVERTISINGCLIENTS']."</p>"
        ."<table width='100%' border='1'><tr>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_CLIENTNAME']."</strong></td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_ACTIVEBANNERS2']."</strong></td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_INACTIVEBANNERS']."</strong></td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_CONTACTNAME']."</strong></td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_CONTACTEMAIL']."</strong></td>"
        ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_FUNCTIONS']."</strong></td></tr>";
        $result3 = $db->sql_query("SELECT cid, name, contact, email FROM "._BANNER_CLIENT_TABLE." ORDER BY cid");
        while ($row3 = $db->sql_fetchrow($result3)) {
            $cid        = intval($row3['cid']);
            $clientname = $row3['name'];
            $contact    = $row3['contact'];
            $email      = $row3['email'];
            $result4    = $db->sql_query("SELECT cid FROM "._BANNER_TABLE." WHERE cid='$cid' AND active='1'");
            $numrows    = $db->sql_numrows($result4);
            $row4       = $db->sql_fetchrow($result4);
            $db->sql_freeresult($result4);
            $rcid = intval($row4['cid']);
            list($numrows2) = $db->sql_ufetchrow("SELECT COUNT(*) FROM "._BANNER_TABLE." WHERE cid='".$cid."' AND active='0'");
            echo "<tr><td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>".$clientname."</td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>".$numrows."</td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>".$numrows2."</td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>".$contact."</td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'><a href='mailto:".$email."'>".$email."</a></td>"
            ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center' nowrap='nowrap'>&nbsp;<a href='".$admin_file.".php?op=BannerClientEdit&amp;cid=".$cid."'><img src='".evo_image('edit.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_EDIT']."' title='".$lang_new[$module_name]['_EDIT']."' /></a>&nbsp;&nbsp;<a href='".$admin_file.".php?op=BannerClientDelete&amp;cid=".$cid."'><img src='".evo_image('delete.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_DELETE']."' title='".$lang_new[$module_name]['_DELETE']."' /></a>&nbsp;</td></tr>";
        }
        $db->sql_freeresult($result3);
        echo "</table>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function add_banner() {
        global $db, $admin_file, $ad_admin_menu, $module_name, $lang_new;

        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align='center'>\n<a href='".$admin_file.".php?op=BannersAdmin'>".$lang_new[$module_name]['_BANNERS_ADMIN_HEADER']."</a></div>\n";
        echo "<br /><br />";
        echo "<div align='center'>\n[ <a href='".$admin_file.".php'>".$lang_new[$module_name]['_BANNERS_RETURNMAIN']."</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo $ad_admin_menu;
        CloseTable();
        echo "<br />";
        OpenTable();
        $result = $db->sql_query("select * FROM "._BANNER_CLIENT_TABLE);
        if($db->sql_numrows($result) > 0) {
            echo "<center><span class='title'><strong>".$lang_new[$module_name]['_ADDNEWBANNER']."</strong></span></center><br /><br />"
            ."<form action='".$admin_file.".php?op=BannersAdd' method='post'>"
            ."<table border='0'><tr><td>"
            .$lang_new[$module_name]['_CLIENTNAME'].":</td>"
            ."<td><select name='cid'>";
            while ($row = $db->sql_fetchrow($result)) {
                $cid = intval($row['cid']);
                $clientname = $row['name'];
                echo "<option value='$cid'>".$clientname."</option>";
            }
            $db->sql_freeresult($result);
            echo "</select></td></tr>"
            ."<tr><td nowrap='nowrap'>".$lang_new[$module_name]['_BANNERNAME'].":</td><td><input type='text' name='adname' size='12' maxlength='50' /></td></tr>"
            ."<tr><td nowrap='nowrap'>".$lang_new[$module_name]['_PURCHASEDIMPRESSIONS'].":</td><td><input type='text' name='imptotal' size='12' maxlength='11' /> 0 = ".$lang_new[$module_name]['_UNLIMITED']."</td></tr>"
            ."<tr><td>".$lang_new[$module_name]['_ADCLASS'].":</td><td><select name='ad_class'>"
            ."<option value='image'>".$lang_new[$module_name]['_ADIMAGE']."</option>"
            ."<option value='code'>".$lang_new[$module_name]['_ADCODE']."</option>"
            ."<option value='flash'>".$lang_new[$module_name]['_ADFLASH']."</option>"
            ."</select></td></tr>"
            ."<tr><td>&nbsp;</td><td><em>".$lang_new[$module_name]['_CLASSNOTE']."</em></td></tr>"
            ."<tr><td>".$lang_new[$module_name]['_IMAGESWFURL'].":</td><td><input type='text' name='imageurl' size='50' maxlength='100' value='http://' /></td></tr>"
            ."<tr><td>".$lang_new[$module_name]['_IMAGESIZE'].":</td><td>".$lang_new[$module_name]['_WIDTH'].": <input type='text' name='ad_width' size='4' maxlength='4' />&nbsp;".$lang_new[$module_name]['_HEIGHT'].":<input type='text' name='ad_height' size='4' maxlength='4' />&nbsp;".$lang_new[$module_name]['_INPIXELS']."</td></tr>"
            ."<tr><td>".$lang_new[$module_name]['_CLICKURL']."</td><td><input type='text' name='clickurl' size='50' maxlength='200' value='http://' /></td></tr>"
            ."<tr><td>".$lang_new[$module_name]['_ALTTEXT'].":</td><td><input type='text' name='alttext' size='50' maxlength='255' /></td></tr>"
            ."<tr><td>".$lang_new[$module_name]['_ADCODE'].":</td><td><textarea name='ad_code' rows='15' cols='70'></textarea></td></tr>"
            ."<tr><td>".$lang_new[$module_name]['_TYPE'].":</td><td><select name='position'>";
            $result = $db->sql_query("SELECT position_number, position_name FROM "._BANNER_POSITIONS_TABLE." ORDER BY position_number");
            while ($row = $db->sql_fetchrow($result)) {
                echo "<option value='".$row['position_number']."'>".$row['position_number']." - ".$row['position_name']."</option>";
            }
            $db->sql_freeresult($result);
            echo "</select></td></tr><tr><td>&nbsp;</td><td>".$lang_new[$module_name]['_POSITIONNOTE']."</td></tr>"
                ."<tr><td>".$lang_new[$module_name]['_ACTIVATE'].":</td><td><input type='radio' name='active' value='1' checked='checked' />".$lang_new[$module_name]['_YES']."&nbsp;&nbsp;<input type='radio' name='active' value='0' />".$lang_new[$module_name]['_NO']."</td></tr>"
                ."<tr><td colspan='2' align='center'><input type='submit' value='".$lang_new[$module_name]['_ADDBANNER']."' />"
                ."</td></tr></table></form>";
        } else {
            echo "<center><span class='title'><strong>".$lang_new[$module_name]['_ADDNEWBANNER']."</strong></span></center><br /><br />"
                ."<center>".$lang_new[$module_name]['_ADSNOCLIENT']."<br /><br />".$lang_new[$module_name]['_GOBACK']."</center>";
        }
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function add_client() {
        global $db, $admin_file, $ad_admin_menu, $module_name, $lang_new;

        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align='center'>\n<a href='".$admin_file.".php?op=BannersAdmin'>".$lang_new[$module_name]['_BANNERS_ADMIN_HEADER']."</a></div>\n";
        echo "<br /><br />";
        echo "<div align='center'>\n[ <a href='".$admin_file.".php'>".$lang_new[$module_name]['_BANNERS_RETURNMAIN']."</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo $ad_admin_menu;
        CloseTable();
        echo "<br />";
        OpenTable();
        $cl_pass = makePass();
        echo"<center><span class='title'><strong>".$lang_new[$module_name]['_ADDCLIENT']."</strong></span></center><br /><br />
            <form action='".$admin_file.".php?op=BannerAddClient' method='post'>
            <table border='0'><tr><td>
            ".$lang_new[$module_name]['_CLIENTNAME'].":</td><td><input type='text' name='clientname' size='30' maxlength='60' /></td></tr>
            <tr><td>".$lang_new[$module_name]['_CONTACTNAME'].":</td><td><input type='text' name='contact' size='30' maxlength='60' /></td></tr>
            <tr><td>".$lang_new[$module_name]['_CONTACTEMAIL'].":</td><td><input type='text' name='email' size='30' maxlength='60' /></td></tr>
            <tr><td>".$lang_new[$module_name]['_CLIENTLOGIN'].":</td><td><input type='text' name='login' size='12' maxlength='10' /></td></tr>
            <tr><td>".$lang_new[$module_name]['_CLIENTPASSWD'].":</td><td><input type='text' name='passwd' size='12' maxlength='10' value='".$cl_pass."' /></td></tr>
            <tr><td>".$lang_new[$module_name]['_EXTRAINFO'].":</td><td><textarea name='extrainfo' cols='70' rows='15'></textarea></td></tr>
            <tr><td>&nbsp;</td><td><input type='hidden' name='op' value='BannerAddClient' />
            <input type='submit' value='".$lang_new[$module_name]['_ADDCLIENT2']."' />
            </td></tr></table></form>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function BannerStatus() {
        global $db, $admin_file, $cache, $_GETVAR;

        $status = $_GETVAR->get('status', '_REQUEST', 'int', 0);
        $bid    = $_GETVAR->get('bid', '_REQUEST', 'int', 0);
        if ($status == 1) {
            $active = 0;
        } else {
            $active = 1;
        }
        $db->sql_uquery("UPDATE "._BANNER_TABLE." SET active='".$active."' WHERE bid='".$bid."'");
        $cache->delete('numbanact', 'submissions');
        $cache->delete('numbandea', 'submissions');
        redirect($admin_file.'.php?op=BannersAdmin');
    }

    function BannersAdd() {
        global $db, $admin_file, $ad_admin_menu, $module_name, $lang_new;

        $active         = $_GETVAR -> get ('active', '_POST', 'int', 0);
        $ad_class       = $_GETVAR -> get ('ad_class', '_POST', 'string', '');
        $ad_code        = $_GETVAR -> get ('ad_code', '_POST', 'string', '');
        $ad_height      = $_GETVAR -> get ('ad_height', '_POST', 'int', 0);
        $ad_width       = $_GETVAR -> get ('ad_width', '_POST', 'int', 0);
        $adname         = $_GETVAR -> get ('adname', '_POST', 'string', '');
        $alttext        = convert_slashes($_GETVAR -> get ('alttext', '_POST', 'string', ''));
        $cid            = $_GETVAR -> get ('cid', '_POST', 'int', 0);
        $clickurl       = $_GETVAR -> get ('clickurl', '_POST', 'string', '');
        $clientname     = $_GETVAR -> get ('clientname', '_POST', 'string', '');
        $imageurl       = $_GETVAR -> get ('imageurl', '_POST', 'string', '');
        $imptotal       = $_GETVAR -> get ('imptotal', '_POST', 'int', 0);
        $position       = $_GETVAR -> get ('position', '_POST', 'int', 0);

        if ($ad_class == 'image') {
            if ($imageurl == 'http://' || empty($imageurl)) {
                $a = 1;
            }
            if ($add_class == 'flash' && ($ad_width == 0 || $ad_heigth == 0)) {
                $a = 1;
            }
        }
        if (($ad_class == 'code') && (empty($ad_code))) {
            $a = 1;
        }
        if ($a == 1) {
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
            echo "<div align='center'>\n<a href='".$admin_file.".php?op=BannersAdmin'>".$lang_new[$module_name]['_BANNERS_ADMIN_HEADER']."</a></div>\n";
            echo "<br /><br />";
            echo "<div align='center'>\n[ <a href='".$admin_file.".php'>".$lang_new[$module_name]['_BANNERS_RETURNMAIN']."</a> ]</div>\n";
            CloseTable();
            echo "<br />";
            OpenTable();
            echo $ad_admin_menu;
            CloseTable();
            echo "<br />";
            OpenTable();
            echo "<center>".$lang_new[$module_name]['_ADINFOINCOMPLETE']."<br /><br />".$lang_new[$module_name]['_GOBACK']."</center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
            exit;
        }
        $db->sql_uquery("INSERT INTO "._BANNER_TABLE." (`bid`, `cid`, `name`, `imptotal`, `impmade`, `clicks`, `imageurl`, `clickurl`, `alttext`, `date`, `dateend`, `position`, `active`, `ad_class`, `ad_code`, `ad_width`, `ad_height`)
                        VALUES (NULL, '$cid', '$adname', '$imptotal', '1', '0', '$imageurl', '$clickurl', '$alttext', now(), '00-00-0000 00:00:00', '$position', '$active', '$ad_class', '$ad_code', '$ad_width', '$ad_height')");
        redirect($admin_file.'.php?op=BannersAdmin');
    }

    function BannerAddClient() {
        global $db, $admin_file, $module_name, $lang_new, $_GETVAR;

        $clientname     = $_GETVAR -> get ('clientname', '_POST', 'string', '');
        $contact        = $_GETVAR -> get ('contact', '_POST', 'string', '');
        $email          = $_GETVAR -> get ('email', '_POST', 'string', '');
        $extrainfo      = $_GETVAR -> get ('extrainfo', '_POST', 'string', '');
        $login          = $_GETVAR -> get ('login', '_POST', 'string', '');
        $passwd         = $_GETVAR -> get ('passwd', '_POST', 'string', '');

        /* Check if all not optional fields exists */
        if (empty($clientname) || empty($email) || empty($login) || empty($passwd) ) {
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
            echo "<center><span class='option'>"
                ."<strong>".$lang_new[$module_name]['_ADINFOINCOMPLETE']."</strong><br />"
                .$lang_new[$module_name]['_GOBACK']."<br />";
            echo "</span></center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
        } else {
            $db->sql_uquery("INSERT INTO "._BANNER_CLIENT_TABLE." (`cid`, `name`, `contact`, `email`, `login`, `passwd`, `extrainfo`) VALUES (NULL, '$clientname', '$contact', '$email', '$login', '$passwd', '$extrainfo')");
            redirect($admin_file.'.php?op=BannersAdmin');
        }
    }

    function BannerDelete() {
        global $db, $admin_file, $bgcolor1, $ThemeInfo, $ad_admin_menu, $module_name, $lang_new, $_GETVAR;

        $bid = $_GETVAR->get('bid', '_REQUEST', 'int', 0);
        $ok  = $_GETVAR->get('ok', '_REQUEST', 'int', 0);

        if ($ok == 1 && $bid != 0) {
            $db->sql_uquery("DELETE FROM "._BANNER_TABLE." WHERE bid='".$bid."'");
            redirect($admin_file.".php?op=BannersAdmin");
        } else {
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
            echo "<div align='center'>\n<a href='".$admin_file.".php?op=BannersAdmin'>".$lang_new[$module_name]['_BANNERS_ADMIN_HEADER']."</a></div>\n";
            echo "<br /><br />";
            echo "<div align='center'>\n[ <a href='".$admin_file.".php'>".$lang_new[$module_name]['_BANNERS_RETURNMAIN']."</a> ]</div>\n";
            CloseTable();
            echo "<br />";
            OpenTable();
            echo $ad_admin_menu;
            CloseTable();
            echo "<br />";
            $row = $db->sql_fetchrow($db->sql_query("SELECT cid, name, imptotal, impmade, clicks, imageurl, clickurl, alttext, ad_class, ad_code, ad_width, ad_height FROM "._BANNER_TABLE." WHERE bid='$bid'"));
            $cid        = intval($row['cid']);
            $imptotal   = intval($row['imptotal']);
            $impmade    = intval($row['impmade']);
            $clicks     = intval($row['clicks']);
            $imageurl   = $row['imageurl'];
            $clickurl   = $row['clickurl'];
            $ad_class   = $row['ad_class'];
            $ad_code    = $row['ad_code'];
            $ad_width   = $row['ad_width'];
            $ad_height  = $row['ad_height'];
            $alttext    = $row['alttext'];
            if (empty($row['name'])) {
                $row['name'] = $lang_new[$module_name]['_NONE'];
            }
            OpenTable();
            echo "<center><span class='title'><strong>".$lang_new[$module_name]['_DELETEBANNER']."</strong></span><br /><br />";
            if ($ad_class == 'code') {
                $ad_code = stripslashes(Fix_Quotes($ad_code));
                echo "<table border='0' align='center'><tr><td>".$ad_code."</td></tr></table><br /><br />";
            } elseif ($ad_class == 'flash') {
                echo "<center>
                    <OBJECT classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000'
                    codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0'
                    WIDTH='$ad_width' HEIGHT='".$ad_height."' id='".$bid."'>
                    <PARAM NAME=movie VALUE='".$imageurl."'>
                    <PARAM NAME=quality VALUE=high>
                    <EMBED src='".$imageurl."' quality=high WIDTH='".$ad_width."' HEIGHT='".$ad_height."'
                    NAME='$bid' ALIGN='' TYPE='application/x-shockwave-flash'
                    PLUGINSPAGE='http://www.macromedia.com/go/getflashplayer'>
                    </EMBED>
                    </OBJECT>
                    </center><br /><br />";
            } else {
                echo "<center><img src='".$imageurl."' border='1' alt='".$alttext."' title='".$alttext."' width='".$ad_width."' height='".$ad_height."' /></center><br /><br />";
            }
            echo "<table width='100%' border='1'><tr>"
                ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_BANNERNAME']."</strong></td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_IMPRESSIONS']."</strong></td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_IMPLEFT']."</strong></td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_CLICKS']."</strong></td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_CLICKSPERCENT']."</strong></td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_CLIENTNAME']."</strong></td></tr>";
            $row2 = $db->sql_ufetchrow("SELECT cid, name FROM "._BANNER_CLIENT_TABLE." WHERE cid='".$cid."'");
            $cid = intval($row2['cid']);
            $clientname = $row2['name'];
            $percent = substr(100 * $clicks / $impmade, 0, 5);
            if($imptotal==0) {
                $left = $lang_new[$module_name]['_UNLIMITED'];
            } else {
                $left = $imptotal-$impmade;
            }
            echo "<tr><td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>".$row['name']."</td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>".$impmade."</td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>".$left."</td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>".$clicks."</td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>".$percent."%</td>"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>".$clientname."</td></tr>";
            echo "</table><br />";
        }
        echo $lang_new[$module_name]['_SURETODELBANNER']."<br /><br />"
            ."[ <a href='".$admin_file.".php?op=BannersAdmin'>".$lang_new[$module_name]['_NO']."</a> | <a href='".$admin_file.".php?op=BannerDelete&amp;bid=".$bid."&amp;ok=1'>".$lang_new[$module_name]['_YES']."</a> ]</center><br />";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function BannerEdit() {
        global $db, $admin_file, $ad_admin_menu, $module_name, $lang_new, $_GETVAR;

        $bid = $_GETVAR->get('bid', '_REQUEST', 'int', 0);

        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align='center'>\n<a href='".$admin_file.".php?op=BannersAdmin'>".$lang_new[$module_name]['_BANNERS_ADMIN_HEADER']."</a></div>\n";
        echo "<br /><br />";
        echo "<div align='center'>\n[ <a href='".$admin_file.".php'>".$lang_new[$module_name]['_BANNERS_RETURNMAIN']."</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo $ad_admin_menu;
        CloseTable();
        echo "<br />";
        $row = $db->sql_ufetchrow("SELECT cid, name, imptotal, impmade, clicks, imageurl, clickurl, alttext, date, position, active, ad_class, ad_code, ad_width, ad_height FROM "._BANNER_TABLE." WHERE bid='$bid'");
        $cid = intval($row['cid']);
        $imptotal = intval($row['imptotal']);
        $impmade = intval($row['impmade']);
        $clicks = intval($row['clicks']);
        $imageurl = $row['imageurl'];
        $clickurl = $row['clickurl'];
        $alttext = $row['alttext'];
        $date = $row['date'];
        $date = explode(' ', $date);
        $date = $date[0].' @ '.$date[1];
        $position = $row['position'];
        $active = intval($row['active']);
        $ad_class = $row['ad_class'];
        $ad_code = $row['ad_code'];
        $ad_width = $row['ad_width'];
        $ad_height = $row['ad_height'];
        OpenTable();
        echo"<center><span class='title'><strong>".$lang_new[$module_name]['_EDITBANNER']."</strong></span></center><br /><br />";
        if ($ad_class == 'code') {
            $ad_code = stripslashes($ad_code);
            echo "<table border='0' align='center'><tr><td>".$ad_code."</td></tr></table><br /><br />";
        } elseif ($ad_class == 'flash') {
            echo "<center>
                 <object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000'
                 codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0'
                 width='".$ad_width."' height='".$ad_height."' id='".$bid."'>
                 <param name=movie value='".$imageurl."'>
                 <param name=quality value=high>
                 <embed src='".$imageurl."' quality=high width='".$ad_width."' height='".$ad_height."'
                 name='".$bid."' align='' type='application/x-shockwave-flash'
                 pluginspace='http://www.macromedia.com/go/getflashplayer'>
                 </embed>
                 </object>
                </center><br /><br />";
        } else {
            echo "<center><img src='".$imageurl."' border='1' alt='".$alttext."' title='".$alttext."' width='".$ad_width."' height='".$ad_height."' /></center><br /><br />";
        }
        echo "<form action='".$admin_file.".php?op=BannerChange' method='post'>"
            ."<table border='0' cellpadding='3'><tr><td>"
            .$lang_new[$module_name]['_CLIENTNAME'].":</td><td>"
            ."<select name='cid'>";
        $row2 = $db->sql_ufetchrow("SELECT cid, name FROM "._BANNER_CLIENT_TABLE." WHERE cid='".$cid."'");
        $cid = intval($row2['cid']);
        $clientname = $row2['name'];
        echo "<option value='$cid' selected='selected'>".$clientname."</option>";
        $result3 = $db->sql_query("SELECT cid, name FROM "._BANNER_CLIENT_TABLE);
        while ($row3 = $db->sql_fetchrow($result3)) {
            $ccid = intval($row3['cid']);
            $clientname = $row3['name'];
            if($cid!=$ccid) {
                echo "<option value='".$ccid."'>".$clientname."</option>";
            }
        }
        $db->sql_freeresult($result3);
        echo "</select></td></tr>";
        if($imptotal==0) {
            $impressions = $lang_new[$module_name]['_UNLIMITED'];
        } else {
            $impressions = $imptotal;
        }
        if ($active == 1) {
            $check1 = 'checked="checked"';
            $check2 = '';
        } else {
            $check1 = '';
            $check2 = 'checked="checked"';
        }
        $unl = '';
        if ($imptotal != 0) {
            $unl = '&nbsp;<em>('.$lang_new[$module_name]['_XFORUNLIMITED'].')</em>';
        }
        echo "<tr><td>".$lang_new[$module_name]['_BANNERNAME'].":</td><td><input type='text' name='adname' size='20' maxlength='50' value='".$row['name']."' /></td></tr>";
        echo "<tr><td>".$lang_new[$module_name]['_ADDEDDATE'].":</td><td>".$date."</td></tr>";
        echo "<tr><td>".$lang_new[$module_name]['_IMPPURCHASED'].":</td><td><strong>".$impressions."</strong></td></tr>";
        echo "<tr><td>".$lang_new[$module_name]['_IMPMADE'].":</td><td><strong>".$impmade."</strong></td></tr>";
        echo "<tr><td>".$lang_new[$module_name]['_ADDIMPRESSIONS'].":</td><td><input type='text' name='impadded' size='12' maxlength='11' value='0' />".$unl."</td></tr>";
        echo "<tr><td>".$lang_new[$module_name]['_ADCLASS'].":</td><td><strong>".ucFirst($ad_class)."</strong></td></tr>";
        if ($ad_class == 'code') {
            echo "<tr><td>".$lang_new[$module_name]['_ADCODE'].":</td><td><textarea name='ad_code' rows='15' cols='70'>".$ad_code."</textarea>"
                ."<input type='hidden' name='imageurl' value='".$imageurl."' />"
                ."<input type='hidden' name='ad_width' value='".$ad_width."' />"
                ."<input type='hidden' name='ad_height' value='".$ad_height."' />"
                ."<input type='hidden' name='clickurl' value='".$clickurl."' />"
                ."<input type='hidden' name='alttext' value='".$alttext."' /></td></tr>";
        } elseif ($ad_class == 'flash') {
            echo "<tr><td>".$lang_new[$module_name]['_FLASHFILEURL'].":</td><td><input type='text' name='imageurl' size='50' maxlength='100' value='".$imageurl."' />&nbsp;<a href='".$imageurl."' target='_blank'><img src='".evo_image('view.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_SHOW']."' title='".$lang_new[$module_name]['_SHOW']."' /></a></td></tr>"
                ."<tr><td>".$lang_new[$module_name]['_FLASHSIZE'].":</td><td>"._WIDTH.": <input type='text' name='ad_width' size='4' maxlength='4' value='$ad_width' /> &nbsp; ".$lang_new[$module_name]['_HEIGHT'].": <input type='text' name='ad_height' size='4' maxlength='4' value='".$ad_height."' />&nbsp;".$lang_new[$module_name]['_INPIXELS'].""
                ."<input type='hidden' name='clickurl' value='$clickurl' />"
                ."<input type='hidden' name='alttext' value='$alttext' />"
                ."<input type='hidden' name='ad_code' value='$ad_code' /></td></tr>";
        } else {
            echo "<tr><td>".$lang_new[$module_name]['_IMAGESWFURL'].":</td><td><input type='text' name='imageurl' size='50' maxlength='100' value='".$imageurl."' /></td></tr>"
                ."<tr><td>".$lang_new[$module_name]['_IMAGESIZE'].":</td><td>".$lang_new[$module_name]['_WIDTH'].": <input type='text' name='ad_width' size='4' maxlength='4' value='".$ad_width."' />&nbsp;".$lang_new[$module_name]['_HEIGHT'].": <input type='text' name='ad_height' size='4' maxlength='4' value='".$ad_height."' />&nbsp;".$lang_new[$module_name]['_INPIXELS']."</td></tr>"
                ."<tr><td>".$lang_new[$module_name]['_CLICKURL']."</td><td><input type='text' name='clickurl' size='50' maxlength='200' value='".$clickurl."' /></td></tr>"
                ."<tr><td>".$lang_new[$module_name]['_ALTTEXT'].":</td><td><input type='text' name='alttext' size='50' maxlength='255' value='".$alttext."' />"
                ."<input type='hidden' name='ad_code' value='".$ad_code."' /></td></tr>";
        }
        echo "<tr><td>".$lang_new[$module_name]['_TYPE'].":</td><td><select name='position'>";
        $result4 = $db->sql_query("SELECT position_number, position_name FROM "._BANNER_POSITIONS_TABLE." ORDER BY position_number");
        while ($row4 = $db->sql_fetchrow($result4)) {
            if ($position == $row4['position_number']) {
                $sel = "selected='selected'";
            } else {
                $sel = "";
            }
            echo "<option value='".$row4['position_number']."' ".$sel.">".$row4['position_number']." - ".$row4['position_name']."</option>";
        }
        $db->sql_freeresult($result4);
        echo "</select></td></tr>"
            ."<tr><td>".$lang_new[$module_name]['_ACTIVATE'].":</td><td><input type='radio' name='active' value='1' ".$check1." />".$lang_new[$module_name]['_YES']."&nbsp;&nbsp;<input type='radio' name='active' value='0' ".$check2." />".$lang_new[$module_name]['_NO']."</td></tr>"
            ."<tr><td>&nbsp;</td><td><input type='hidden' name='bid' value='".$bid."' />"
            ."<input type='hidden' name='imptotal' value='".$imptotal."' />"
            ."<input type='hidden' name='impmade' value='".$impmade."' />"
            ."<input type='hidden' name='op' value='BannerChange' />"
            ."<input type='submit' value='".$lang_new[$module_name]['_SAVECHANGES']."' />"
            ."</td></tr></table></form>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function BannerChange() {
        global $db, $admin_file, $_GETVAR;

        $active         = $_GETVAR -> get ('active', '_POST', 'int', 0);
        $ad_code        = $_GETVAR -> get ('ad_code', '_POST', 'string', '');
        $ad_height      = $_GETVAR -> get ('ad_height', '_POST', 'int', 0);
        $ad_width       = $_GETVAR -> get ('ad_width', '_POST', 'int', 0);
        $alttext        = convert_slashes($_GETVAR -> get ('alttext', '_POST', 'string', ''));
        $adname         = $_GETVAR -> get ('adname', '_POST', 'string', '');
        $bid            = $_GETVAR -> get ('bid', '_POST', 'int', 0);
        $cid            = $_GETVAR -> get ('cid', '_POST', 'int', 0);
        $clickurl       = $_GETVAR -> get ('clickurl', '_POST', 'string', '');
        $imageurl       = $_GETVAR -> get ('imageurl', '_POST', 'string', '');
        $imptotal       = $_GETVAR -> get ('imptotal', '_POST', 'int', 0);
        $impadded       = $_GETVAR -> get ('impadded', '_POST', 'string', '');
        $impmade        = $_GETVAR -> get ('impmade', '_POST', 'int', 0);
        $position       = $_GETVAR -> get ('position', '_POST', 'int', 0);

        if (!is_numeric($impadded)) {
            $impadded = strtoupper($impadded);
            if ($impadded == 'X') {
                $imp = 0;
            }
        } else {
            if ($impadded == 0) {
                $imp = $imptotal;
            } else {
                if ($imptotal == 0) {
                    $imp = $impmade+$impadded;
                } else {
                    $imp = $imptotal+$impadded;
                }
            }
        }
        $db->sql_uquery("UPDATE "._BANNER_TABLE." SET cid='$cid', name='$adname', imptotal='$imp', imageurl='$imageurl', clickurl='$clickurl', alttext='$alttext', position='$position', active='$active', ad_code='$ad_code', ad_width='$ad_width', ad_height='$ad_height' WHERE bid='$bid'");
        redirect($admin_file.'.php?op=BannersAdmin');
    }

    function BannerClientDelete() {
        global $db, $admin_file, $ad_admin_menu, $_GETVAR;

        $cid = $_GETVAR->get('cid', '_REQUEST', 'int', 0);
        $ok  = $_GETVAR->get('ok', '_REQUEST', 'int', 0);
        if ($ok==1 && $cid != 0) {
            $db->sql_uquery("DELETE FROM "._BANNER_TABLE." WHERE cid='$cid'");
            $db->sql_uquery("DELETE FROM "._BANNER_CLIENT_TABLE." WHERE cid='$cid'");
            redirect($admin_file.'.php?op=BannersAdmin');
        } else {
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
            echo "<div align='center'>\n<a href='".$admin_file.".php?op=BannersAdmin'>".$lang_new[$module_name]['_BANNERS_ADMIN_HEADER']."</a></div>\n";
            echo "<br /><br />";
            echo "<div align='center'>\n[ <a href='".$admin_file.".php'>".$lang_new[$module_name]['_BANNERS_RETURNMAIN']."</a> ]</div>\n";
            CloseTable();
            echo "<br />";
            OpenTable();
            echo $ad_admin_menu;
            CloseTable();
            echo "<br />";
            $row = $db->sql_ufetchrow("SELECT cid, name FROM "._BANNER_CLIENT_TABLE." WHERE cid='".$cid."'");
            $cid = intval($row['cid']);
            $clientname = $row['name'];
            OpenTable();
            echo "<center><strong>".$lang_new[$module_name]['_DELETECLIENT'].": ".$clientname."</strong><br /><br />
                 ".$lang_new[$module_name]['_SURETODELCLIENT']."<br /><br />";
            $numrows = $db->sql_unumrows("SELECT imageurl, clickurl FROM "._BANNER_TABLE." WHERE cid='".$cid."'");
            $numrows = $db->sql_numrows($result2);
            if ($numrows == 0) {
                echo $lang_new[$module_name]['_CLIENTWITHOUTBANNERS']."<br /><br />";
            } else {
                echo "<strong>".$lang_new[$module_name]['_WARNING']."!!!</strong><br />".$lang_new[$module_name]['_DELCLIENTHASBANNERS'].":<br /><br />";
            }
            while ($row2 = $db->sql_fetchrow($result2)) {
                $imageurl = $row2['imageurl'];
                $clickurl = $row2['clickurl'];
                echo "<a href='".$clickurl."'><img src='".$imageurl."' border='1' alt='' /></a><br />
                    <a href='".$clickurl."'>".$clickurl."</a><br /><br />";
            }
            $db->sql_freeresult($result2);
        }
        echo $lang_new[$module_name]['_SURETODELCLIENT']."<br /><br />[ <a href='".$admin_file.".php?op=BannersAdmin#top'>".$lang_new[$module_name]['_NO']."</a> | <a href='".$admin_file.".php?op=BannerClientDelete&amp;cid=".$cid."&amp;ok=1'>".$lang_new[$module_name]['_YES']."</a> ]</center><br /><br /></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function BannerClientEdit() {
        global $db, $admin_file, $ad_admin_menu, $module_name, $lang_new, $_GETVAR;

        $cid = $_GETVAR->get('cid', '_REQUEST', 'int', 0);
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align='center'>\n<a href='".$admin_file.".php?op=BannersAdmin'>".$lang_new[$module_name]['_BANNERS_ADMIN_HEADER']."</a></div>\n";
        echo "<br /><br />";
        echo "<div align='center'>\n[ <a href='".$admin_file.".php'>".$lang_new[$module_name]['_BANNERS_RETURNMAIN']."</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo $ad_admin_menu;
        CloseTable();
        echo "<br />";
        $cid = intval($cid);
        $row = $db->sql_fetchrow($db->sql_query("SELECT name, contact, email, login, passwd, extrainfo FROM "._BANNER_CLIENT_TABLE." WHERE cid='".$cid."'"));
        $clientname = $row['name'];
        $contact = $row['contact'];
        $email = $row['email'];
        $login = $row['login'];
        $passwd = $row['passwd'];
        $extrainfo = $row['extrainfo'];
        OpenTable();
        echo "<center><span class='option'><strong>".$lang_new[$module_name]['_EDITCLIENT']."</strong></span></center><br /><br />"
        ."<form action='".$admin_file.".php?op=BannerClientChange' method='post'>"
        .$lang_new[$module_name]['_CLIENTNAME'].": <input type='text' name='clientname' value='".$clientname."' size='30' maxlength='60' /><br /><br />"
        .$lang_new[$module_name]['_CONTACTNAME'].": <input type='text' name='contact' value='".$contact."' size='30' maxlength='60' /><br /><br />"
        .$lang_new[$module_name]['_CONTACTEMAIL'].": <input type='text' name='email' size=30 maxlength='60' value='".$email."' /><br /><br />"
        .$lang_new[$module_name]['_CLIENTLOGIN'].": <input type='text' name='login' size=12 maxlength='10' value='".$login."' /><br /><br />"
        .$lang_new[$module_name]['_CLIENTPASSWD'].": <input type='text' name='passwd' size=12 maxlength='10' value='".$passwd."' /><br /><br />"
        .$lang_new[$module_name]['_EXTRAINFO']."<br /><textarea name='extrainfo' cols='70' rows='15'>".$extrainfo."</textarea><br /><br />"
        ."<input type='hidden' name='cid' value='".$cid."' />"
        ."<input type='hidden' name='op' value='BannerClientChange' />"
        ."<input type='submit' value='".$lang_new[$module_name]['_SAVECHANGES']."' />"
        ."</form>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function BannerClientChange() {
        global $db, $admin_file, $_GETVAR;

        $cid            = $_GETVAR -> get ('cid', '_POST', 'int', 0);
        $clientname     = $_GETVAR -> get ('clientname', '_POST', 'string', '');
        $contact        = $_GETVAR -> get ('contact', '_POST', 'string', '');
        $country        = $_GETVAR -> get ('country', '_POST', 'string', '', '');
        $email          = $_GETVAR -> get ('email', '_POST', 'string', '');
        $extrainfo      = $_GETVAR -> get ('extrainfo', '_POST', 'string', '');
        $login          = $_GETVAR -> get ('login', '_POST', 'string', '');
        $passwd         = $_GETVAR -> get ('passwd', '_POST', 'string', '');

        $db->sql_uquery("UPDATE "._BANNER_CLIENT_TABLE." SET name='$clientname', contact='$contact', email='$email', login='$login', passwd='$passwd', extrainfo='$extrainfo' WHERE cid='$cid'");
        redirect($admin_file.'.php?op=BannersAdmin#top');
    }

    function ad_positions() {
        global $db, $admin_file, $ad_admin_menu, $bgcolor1, $ThemeInfo, $module_name, $lang_new;

        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align='center'>\n<a href='$admin_file.php?op=BannersAdmin'>".$lang_new[$module_name]['_BANNERS_ADMIN_HEADER']."</a></div>\n";
        echo "<br /><br />";
        echo "<div align='center'>\n[ <a href='$admin_file.php'>".$lang_new[$module_name]['_BANNERS_RETURNMAIN']."</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo $ad_admin_menu;
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><span class='title'><strong>".$lang_new[$module_name]['_CURRENTPOSITIONS']."</strong></span></center><br /><br />\n<table width='100%' border='1'>\n<tr>"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_POSITIONNAME']."</strong></td>\n"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_POSITIONNUMBER']."</strong></td>\n"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_ASSIGNEDADS']."</strong></td>\n"
            ."<td bgcolor='".$ThemeInfo['bgcolor2']."' align='center'><strong>".$lang_new[$module_name]['_FUNCTIONS']."</strong></td></tr>\n";
        $result = $db->sql_query("SELECT * FROM "._BANNER_POSITIONS_TABLE." ORDER BY apid");
        while ($row = $db->sql_fetchrow($result)) {
            $ban_num = $db->sql_unumrows("SELECT position FROM "._BANNER_TABLE." WHERE position='".$row['position_number']."'");
            echo "<tr><td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>".$row['position_name']."</td>\n"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>".$row['position_number']."</td>\n"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>".$ban_num."</td>\n"
                ."<td bgcolor='".$ThemeInfo['bgcolor1']."' align='center'>&nbsp;<a href='".$admin_file.".php?op=position_edit&amp;apid=".$row['apid']."'><img src='".evo_image('edit.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_EDIT']."' title='".$lang_new[$module_name]['_EDIT']."' /></a>&nbsp;&nbsp;<a href='".$admin_file.".php?op=position_delete&amp;apid=".$row['apid']."'><img src='".evo_image('delete.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_DELETE']."' title='".$lang_new[$module_name]['_DELETE']."' /></a>&nbsp;</td></tr>\n";
        }
        $db->sql_freeresult($result);
        echo "</table>\n<br />";
        CloseTable();
        echo "<br />";
        OpenTable();
        $numrows = $db->sql_unumrows("SELECT position_number FROM "._BANNER_POSITIONS_TABLE);
        if ($numrows == 0) {
            $pos_num = 0;
        } else {
            $row = $db->sql_ufetchrow("SELECT position_number FROM "._BANNER_POSITIONS_TABLE." ORDER BY position_number DESC LIMIT 0,1");
            $pos_num = $row['position_number']+1;
        }
        echo "<center><span class='title'><strong>".$lang_new[$module_name]['_ADDNEWPOSITION']."</strong></span><br /><br />"
            ."<form method='post' action='".$admin_file.".php'>"
            .$lang_new[$module_name]['_POSITIONNAME'].": <input type='text' name='ad_position_name' /> ".$lang_new[$module_name]['_POSITIONNUMBER'].": <strong>".$pos_num."</strong><input type='hidden' name='ad_position_number' value='".$pos_num."' /><input type='hidden' name='position_new' value='1' /><input type='hidden' name='op' value='position_save' /><br /><br /><input type='submit' value='".$lang_new[$module_name]['_ADDPOSITION']."' />"
            ."</form></center>";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><strong>".$lang_new[$module_name]['_NOTE']."</strong><br /><br />".$lang_new[$module_name]['_POSITIONNOTE']."<br />".$lang_new[$module_name]['_POSEXAMPLE']."</center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function position_save() {
        global $db, $admin_file, $ad_admin_menu, $module_name, $lang_new, $_GETVAR;

        $ad_position_number = $_GETVAR -> get ('ad_position_number', '_POST', 'int', 0);
        $ad_position_name   = $_GETVAR -> get ('ad_position_name', '_POST', 'string', '');
        $apid               = $_GETVAR -> get ('apid', '_POST', 'int', 0);
        $position_new       = $_GETVAR -> get ('position_new', '_POST', 'int', 0);

        if (empty($ad_position_name)) {
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
            echo "<div align='center'>\n<a href='$admin_file.php?op=BannersAdmin'>".$lang_new[$module_name]['_BANNERS_ADMIN_HEADER']."</a></div>\n";
            echo "<br /><br />";
            echo "<div align='center'>\n[ <a href='$admin_file.php'>".$lang_new[$module_name]['._BANNERS_RETURNMAIN']."</a> ]</div>\n";
            CloseTable();
            echo "<br />";
            OpenTable();
            echo $ad_admin_menu;
            CloseTable();
            echo "<br />";
            OpenTable();
            echo "<center><span class='title'><strong>".$lang_new[$module_name]['_ADDNEWPOSITION']."</strong></span><br /><br />".$lang_new[$module_name]['_POSINFOINCOMPLETE']."<br /><br />".$lang_new[$module_name]['_GOBACK']."</center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
            exit;
        }
        $ad_position_name = Fix_Quotes(filter_text($ad_position_name, 'nohtml'));
        if ($position_new == 1) {
            $db->sql_uquery("INSERT INTO "._BANNER_POSITIONS_TABLE." (`apid`, `position_number`, `position_name`) VALUES (NULL, '$ad_position_number', '$ad_position_name')");
        } else {
            $db->sql_uquery("UPDATE "._BANNER_POSITIONS_TABLE." SET position_name='$ad_position_name' WHERE apid='$apid'");
        }
        redirect($admin_file.'.php?op=ad_positions');
    }

    function position_edit() {
        global $db, $admin_file, $ad_admin_menu, $module_name, $lang_new, $_GETVAR;

        $apid = $_GETVAR->get('apid', '_REQUEST', 'int', 0);
        if ($apid == 0) {
            redirect($admin_file.'.php?op=ad_positions');
            exit;
        }
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align='center'>\n<a href='$admin_file.php?op=BannersAdmin'>".$lang_new[$module_name]['_BANNERS_ADMIN_HEADER']."</a></div>\n";
        echo "<br /><br />";
        echo "<div align='center'>\n[ <a href='$admin_file.php'>".$lang_new[$module_name]['_BANNERS_RETURNMAIN']."</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo $ad_admin_menu;
        CloseTable();
        echo "<br />";
        OpenTable();
        $row = $db->sql_ufetchrow("SELECT * FROM "._BANNER_POSITIONS_TABLE." WHERE apid='".$apid."'");
        echo "<center><span class='title'><strong>".$lang_new[$module_name]['_EDITPOSITION']."</strong></span><br /><br />"
            ."<form method='POST' action='".$admin_file.".php'>"
            .$lang_new[$module_name]['_POSITIONNAME'].": <input type='text' name='ad_position_name' value='".$row['position_name']."' /> ".$lang_new[$module_name]['_POSITIONNUMBER'].": <strong>".$row['position_number']."</strong><input type='hidden' name='ad_position_number' value='".$row['position_number']."' /><input type='hidden' name='apid' value='".$apid."' /><input type='hidden' name='op' value='position_save' /><br /><br /><input type='submit' value='".$lang_new[$module_name]['_SAVEPOSITION']."' />"
            ."</form></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function position_delete() {
        global $db, $admin_file, $ad_admin_menu, $_GETVAR;

        $apid       = $_GETVAR->get('apid', '_REQUEST', 'int', 0);
        $ok         = $_GETVAR->get('ok', '_REQUEST', 'int', 0);
        $active     = $_GETVAR->get('active', '_REQUEST', 'string', '');
        $new_pos    = $_GETVAR->get('new_pos', '_REQUEST', 'string', 'x');
        $numrows = $db->sql_unumrows("SELECT * FROM "._BANNER_POSITIONS_TABLE);
        if ($numrows == 1) {
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
            echo "<div align='center'>\n<a href='".$admin_file.".php?op=BannersAdmin'>".$lang_new[$module_name]['_BANNERS_ADMIN_HEADER']."</a></div>\n";
            echo "<br /><br />";
            echo "<div align='center'>\n[ <a href='".$admin_file.".php'>".$lang_new[$module_name]['_BANNERS_RETURNMAIN']."</a> ]</div>\n";
            CloseTable();
            echo "<br />";
            OpenTable();
            echo $ad_admin_menu;
            CloseTable();
            echo "<br />";
            OpenTable();
            echo "<center><strong>".$lang_new[$module_name]['_DELETEPOSITION']."</strong><br /><br />".$lang_new[$module_name]['_CANTDELETEPOSITION']."<br /><br />".$lang_new[$module_name]['_GOBACK']."";
           CloseTable();
           include_once(NUKE_BASE_DIR.'footer.php');
           exit;
        }
        if ($ok == 1) {
            if ($new_pos == 'x') {
                $db->sql_uquery("DELETE FROM "._BANNER_POSITIONS_TABLE." WHERE apid='".$apid."'");
            } else {
                if ($active == 'same') {
                    $row = $db->sql_ufetchrow("SELECT * FROM "._BANNER_POSITIONS_TABLE." WHERE apid='".$apid."'");
                    $result = $db->sql_query("SELECT * FROM "._BANNER_TABLE." WHERE position='".$row['position_number']."'");
                    while($row2 = $db->sql_fetchrow($result)) {
                        $db->sql_uquery("UPDATE "._BANNER_TABLE." SET position='".$new_pos."' WHERE bid='".$row2['bid']."'");
                    }
                    $db->sql_freeresult($result);
                    $db->sql_uquery("DELETE FROM "._BANNER_POSITIONS_TABLE." WHERE apid='".$apid."'");
                } elseif ($active == 'active') {
                    $row = $db->sql_ufetchrow("SELECT * FROM "._BANNER_POSITIONS_TABLE." WHERE apid='".$apid."'");
                    $result = $db->sql_query("SELECT * FROM "._BANNER_TABLE." WHERE position='".$row['position_number']."'");
                    while($row2 = $db->sql_fetchrow($result)) {
                        $db->sql_uquery("UPDATE "._BANNER_TABLE." SET position='".$new_pos."', active='1' WHERE bid='".$row2['bid']."'");
                    }
                    $db->sql_freeresult($result);
                    $db->sql_uquery("DELETE FROM "._BANNER_POSITIONS_TABLE." WHERE apid='".$apid."'");
                } elseif ($active == 'inactive') {
                    $row = $db->sql_ufetchrow("SELECT * FROM "._BANNER_POSITIONS_TABLE." WHERE apid='".$apid."'");
                    $result = $db->sql_query("SELECT * FROM "._BANNER_TABLE." WHERE position='".$row['position_number']."'");
                    while($row2 = $db->sql_fetchrow($result)) {
                        $db->sql_uquery("UPDATE "._BANNER_TABLE." SET position='".$new_pos."', active='0' WHERE bid='".$row2['bid']."'");
                    }
                    $db->sql_freeresult($result);
                    $db->sql_uquery("DELETE FROM "._BANNER_POSITIONS_TABLE." WHERE apid='".$apid."'");
                } elseif ($active == 'delete_all') {
                    $row = $db->sql_ufetchrow("SELECT * FROM "._BANNER_POSITIONS_TABLE." WHERE apid='$apid'");
                    $db->sql_uquery("DELETE FROM "._BANNER_TABLE." WHERE position='".$row['position_number']."'");
                    $db->sql_uquery("DELETE FROM "._BANNER_POSITIONS_TABLE." WHERE apid='".$apid."'");
                }
            }
            redirect($admin_file.'.php?op=ad_positions');
            exit;
        } else {
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
            echo "<div align='center'>\n<a href='".$admin_file.".php?op=BannersAdmin'>".$lang_new[$module_name]['_BANNERS_ADMIN_HEADER']."</a></div>\n";
            echo "<br /><br />";
            echo "<div align='center'>\n[ <a href='".$admin_file.".php'>".$lang_new[$module_name]['_BANNERS_RETURNMAIN']."</a> ]</div>\n";
            CloseTable();
            echo "<br />";
            OpenTable();
            echo $ad_admin_menu;
            CloseTable();
            echo "<br />";
            OpenTable();
            $row = $db->sql_ufetchrow("SELECT * FROM "._BANNER_POSITIONS_TABLE." WHERE apid='".$apid."'");
            echo "<br /><center><strong>".$lang_new[$module_name]['_DELETEPOSITION'].": ".$row['position_name']."</strong><br /><br />".$lang_new[$module_name]['_SURETODELPOSITION']."<br /><br />";
            $numrows = $db->sql_unumrows("SELECT position FROM "._BANNER_TABLE." WHERE position='".$row['position_number']."'");
            if($numrows != 0) {
                echo $lang_new[$module_name]['_POSITIONHASADS']."<br /><br />";
                echo "<form action='".$admin_file.".php' method='POST'>";
                echo $lang_new[$module_name]['_MOVEADS'].": <select name='new_pos'>";
                $result = $db->sql_query("SELECT * FROM "._BANNER_POSITIONS_TABLE." WHERE apid!='".$apid."'");
                while($row = $db->sql_fetchrow($result)) {
                    echo "<option value='".$row['position_number']."'>".$row['position_number'].": ".$row['position_name']."</option>";
                }
                $db->sql_freeresult($result);
                echo "</select><br /><br />";
                echo $lang_new[$module_name]['_MOVEDADSSTATUS'].": <select name='active'>";
                echo "<option value='same'>".$lang_new[$module_name]['_NOCHANGES']."</option>";
                echo "<option value='active'>".$lang_new[$module_name]['_ACTIVE']."</option>";
                echo "<option value='inactive'>".$lang_new[$module_name]['_INACTIVE']."</option>";
                echo "<option value='delete_all'>".$lang_new[$module_name]['_DELETEALLADS']." ($numrows)</option>";
                echo "</select><br /><br />";
                echo "<input type='hidden' name='apid' value='".$apid."' /><input type='hidden' name='ok' value='1' /><input type='hidden' name='op' value='position_delete' /><input type='submit' value='".$lang_new[$module_name]['_DELETE']."' />";
                echo "</form>";
            } else {
                echo "[ <a href='".$admin_file.".php?op=ad_positions'>".$lang_new[$module_name]['_NO']."</a> | <a href='".$admin_file.".php?op=position_delete&amp;apid=".$apid."&amp;ok=1'>".$lang_new[$module_name]['_YES']."</a> ]</center>";
            }
        }
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function ad_terms() {
        global $db, $admin_file, $ad_admin_menu, $module_name, $lang_new, $_GETVAR;

        $save       = $_GETVAR->get('save', '_REQUEST', 'int', 0);
        $terms_body = $_GETVAR->get('terms_body', '_REQUEST', 'string', '');
        $country    = $_GETVAR->get('country', '_REQUEST', 'string', '');
        if ($save != 0) {
            $db->sql_uquery("UPDATE "._BANNER_TERMS_TABLE." SET terms_body='".Fix_Quotes($terms_body)."', country='$country'");
            redirect($admin_file.".php?op=ad_terms");
            exit;
        }
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align='center'>\n<a href='".$admin_file.".php?op=BannersAdmin'>".$lang_new[$module_name]['_BANNERS_ADMIN_HEADER']."</a></div>\n";
        echo "<br /><br />";
        echo "<div align='center'>\n[ <a href='".$admin_file.".php'>".$lang_new[$module_name]['_BANNERS_RETURNMAIN']."</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo $ad_admin_menu;
        CloseTable();
        echo "<br />";
        OpenTable();
        $row = $db->sql_ufetchrow("SELECT * FROM "._BANNER_TERMS_TABLE);
        echo "<center><span class='title'><strong>".$lang_new[$module_name]['_EDITTERMS']."</strong></span><br /><br /><em>".$lang_new[$module_name]['_SITENAMEADS']."</em><br /><br />"
            ."<form method='post' name='termspost' action='".$admin_file.".php'>"
            .$lang_new[$module_name]['_TERMSOFSERVICEBODY'].":<br /><br />";
            global $wysiwyg_buffer;
            $wysiwyg_buffer = 'terms_body';
            Make_TextArea('terms_body', $row['terms_body'], 'termspost');
            echo $lang_new[$module_name]['_COUNTRYNAME'].":<br /><br /><select name='country'>";
        $result = $db->sql_query("SELECT name FROM "._COUNTRY_TABLE);
        while ($row2 = $db->sql_fetchrow($result)) {
            if ($row['country'] == $row2['name']) {
                $sel = 'selected="selected"';
            } else {
                $sel = '';
            }
            echo "<option value='".$row2['name']."' $sel>".$row2['name']."</option>";
        }
        $db->sql_freeresult($result);
        echo "</select><br /><br />"
            ."<input type='hidden' name='save' value='1' /><input type='hidden' name='op' value='ad_terms' /><br /><br /><input type='submit' value='".$lang_new[$module_name]['_SAVECHANGES']."' />"
            ."</form></center><br /><table border='0' width='80%' align='center'><tr><td align='center'><em>".$lang_new[$module_name]['_TERMSNOTE']."</em></td></tr></table>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function ad_plans() {
        global $db, $admin_file, $ad_admin_menu, $bgcolor1, $ThemeInfo, $module_name, $lang_new;

        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align='center'>\n<a href='".$admin_file.".php?op=BannersAdmin'>".$lang_new[$module_name]['_BANNERS_ADMIN_HEADER']."</a></div>\n";
        echo "<br /><br />";
        echo "<div align='center'>\n[ <a href='".$admin_file.".php'>".$lang_new[$module_name]['_BANNERS_RETURNMAIN']."</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo $ad_admin_menu;
        CloseTable();
        echo "<br />";
        $numrows = $db->sql_unumrows("SELECT * FROM "._BANNER_PLANS_TABLE);
        if ($numrows != 0) {
            OpenTable();
            $result = $db->sql_query("SELECT * FROM "._BANNER_PLANS_TABLE);
            echo "<center><span class='title'><strong>".$lang_new[$module_name]['_ADVERTISINGPLANS']."</strong></span></center><br />";
            echo "<table border='1' width='100%'><tr><td bgcolor='".$ThemeInfo."'><strong>&nbsp;".$lang_new[$module_name]['_PLANNAME']."</strong></td><td align='center' bgcolor='".$ThemeInfo."'><strong>".$lang_new[$module_name]['_DELIVERY']."</strong></td><td align='center' bgcolor='".$ThemeInfo."'><strong>".$lang_new[$module_name]['_STATUS']."</strong></td><td align='center' bgcolor='".$ThemeInfo."'><strong>".$lang_new[$module_name]['_PRICE']."</strong></td><td align='center' bgcolor='".$ThemeInfo."'><strong>".$lang_new[$module_name]['_FUNCTIONS']."</strong></td></tr>";
            while ($row = $db->sql_fetchrow($result)) {
                if ($row['delivery_type'] == 0) {
                    $type = $lang_new[$module_name]['_IMPRESSIONS'];
                } elseif ($row['delivery_type'] == 1) {
                    $type = $lang_new[$module_name]['_CLICKS'];
                } elseif ($row['delivery_type'] == 2) {
                    $type = $lang_new[$module_name]['_PDAYS'];
                } elseif ($row['delivery_type'] == 3) {
                    $type = $lang_new[$module_name]['_PMONTHS'];
                } elseif ($row['delivery_type'] == 4) {
                    $type = $lang_new[$module_name]['_PYEARS'];
                }
                $active = intval($row['active']);
                if ($active == 1) {
                    $t_active = "<img src='".evo_image('active.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_ACTIVE']."' title='".$lang_new[$module_name]['_ACTIVE']."' />";
                    $c_active = "<img src='".evo_image('inactive.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_DEACTIVATE']."' title='".$lang_new[$module_name]['_DEACTIVATE']."' />";
                } else {
                    $t_active = "<img src='".evo_image('inactive.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_INACTIVE']."' title='".$lang_new[$module_name]['_INACTIVE']."' />";
                    $c_active = "<img src='".evo_image('active.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_ACTIVATE']."' title='".$lang_new[$module_name]['_ACTIVATE']."' />";
                }
                echo "<tr><td bgcolor='".$ThemeInfo['bgcolor1']."'>&nbsp;".$row['name']."</td>"
                    ."<td align='center' bgcolor='".$ThemeInfo['bgcolor1']."'>".$row['delivery']." $type</td>"
                    ."<td align='center' bgcolor='".$ThemeInfo['bgcolor1']."'>$t_active</td>"
                    ."<td align='center' bgcolor='".$ThemeInfo['bgcolor1']."'>".$row['price']."</td>"
                    ."<td align='center' bgcolor='".$ThemeInfo['bgcolor1']."'>&nbsp;<a href='".$admin_file.".php?op=&amp;pid=".$row['pid']."'><img src='".evo_image('edit.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_EDIT']."' title='".$lang_new[$module_name]['_EDIT']."' /></a>&nbsp;&nbsp;<a href='".$admin_file.".php?op=ad_plans_status&amp;pid=".$row['pid']."&amp;status=".$active."'>".$c_active."</a>&nbsp;&nbsp;<a href='".$admin_file.".php?op=ad_plans_delete&amp;pid=".$row['pid']."&amp;ok=0'><img src='".evo_image('delete.png', $module_name)."' width='16' height='16' border='0' alt='".$lang_new[$module_name]['_DELETE']."' title='".$lang_new[$module_name]['_DELETE']."' /></a>&nbsp;</td></tr>";
            }
            $db->sql_freeresult($result);
            echo "</table>";
            CloseTable();
            echo "<br />";
        }
        OpenTable();
        echo "<center><span class='title'><strong>".$lang_new[$module_name]['_ADDADVERTISINGPLAN']."</strong></span></center><br /><br />";
        echo "<form method='post' action='".$admin_file.".php'>";
        echo "<table border='0'><tr><td>";
        echo $lang_new[$module_name]['_PLANNAME'].":</td><td><input type='text' size='40' name='planname' /></td></tr>";
        echo "<tr><td>".$lang_new[$module_name]['_PLANDESCRIPTION'].":</td><td><textarea name='description' rows='15' cols='70'></textarea></td></tr>";
        echo "<tr><td>".$lang_new[$module_name]['_DELIVERYQUANTITY'].":</td><td><input type='text' size='10' name='delivery' value='0'/></td></tr>";
        echo "<tr><td>".$lang_new[$module_name]['_DELIVERYTYPE'].":</td><td><select name='type'>"
            ."<option value='0'>".$lang_new[$module_name]['_IMPRESSIONS']."</option>"
            ."<option value='1'>".$lang_new[$module_name]['_CLICKS']."</option>"
            ."<option value='2'>".$lang_new[$module_name]['_PDAYS']."</option>"
            ."<option value='3'>".$lang_new[$module_name]['_PMONTHS']."</option>"
            ."<option value='4'>".$lang_new[$module_name]['_PYEARS']."</option>"
            ."</select></td></tr>";
        echo "<tr><td>".$lang_new[$module_name]['_PRICE'].":</td><td><input type='text' size='10' name='price' /></td></tr>";
        echo "<tr><td>".$lang_new[$module_name]['_PLANBUYLINKS'].":</td><td><textarea name='buy_links' rows='15' cols='70'></textarea></td></tr>";
        echo "<tr><td>".$lang_new[$module_name]['_INITIALSTATUS'].":</td><td><input type='radio' name='status' value='1' checked='checked' />".$lang_new[$module_name]['_ACTIVE']."&nbsp;&nbsp;<input type='radio' name='status' value='0' />".$lang_new[$module_name]['_INACTIVE']."</td></tr>";
        echo "<tr><td>&nbsp;</td><td><input type='hidden' name='op' value='ad_plans_add' /><input type='submit' value='".$lang_new[$module_name]['_ADDNEWPLAN']."' /></td></tr></table></form><br /><center><em>".$lang_new[$module_name]['_PLANSNOTE']."</em></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function ad_plans_add() {
        global $db, $admin_file, $ad_admin_menu, $module_name, $lang_new, $_GETVAR;

        $planname       = $_GETVAR->get('planname', '_POST', 'string', '');
        $description    = $_GETVAR->get('description', '_POST', 'string', '');
        $delivery       = $_GETVAR->get('delivery', '_POST', 'int', 0);
        $type           = $_GETVAR->get('type', '_POST', 'int', -1);
        $price          = $_GETVAR->get('price', '_POST', 'string', '');
        $buy_links      = $_GETVAR->get('buy_links', '_POST', 'string', '');
        $status         = $_GETVAR->get('status', '_POST', 'int', 0);
        $price          = (is_numeric($price) ? floatval($price) : '');
        if (!empty($planname) && !empty($description) && ($delivery != 0) && ($type != -1) && (is_numeric($price)) && !empty($buy_links)) {
            $db->sql_uquery("INSERT INTO "._BANNER_PLANS_TABLE." (`pid`, `active`, `name`, `description`, `delivery`, `delivery_type`, `price`, `buy_links`) VALUES (NULL, '$status', '$planname', '$description', '$delivery', '$type', '$price', '$buy_links')");
            redirect($admin_file.'.php?op=ad_plans');
            exit;
        } else {
            $error = '<br />';
            if (empty($planname)) {
                $error .= $lang_new[$module_name]['_PLANNAME'].'<br />';
            }
            if (empty($description)) {
                $error .= $lang_new[$module_name]['_PLANDESCRIPTION'].'<br />';
            }
            if ($delivery == 0) {
                $error .= $lang_new[$module_name]['_DELIVERYQUANTITY'].'<br />';
            }
            if ($type == -1) {
                $error .= $lang_new[$module_name]['_DELIVERYTYPE'].'<br />';
            }
            if (!is_numeric($price)) {
                $error .= $lang_new[$module_name]['_PRICE'].'<br />';
            }
            if (empty($buy_links)) {
                $error .= $lang_new[$module_name]['_PLANBUYLINKS'].'<br />';
            }
            $error = "<span style='color:red;'>".$error."</span>";
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
            echo "<div align='center'>\n<a href='".$admin_file.".php?op=BannersAdmin'>".$lang_new[$module_name]['_BANNERS_ADMIN_HEADER']."</a></div>\n";
            echo "<br /><br />";
            echo "<div align='center'>\n[ <a href='".$admin_file.".php'>".$lang_new[$module_name]['_BANNERS_RETURNMAIN']."</a> ]</div>\n";
            CloseTable();
            echo "<br />";
            OpenTable();
            echo $ad_admin_menu;
            CloseTable();
            echo "<br />";
            OpenTable();
            echo "<center>".$lang_new[$module_name]['_ADDPLANERROR']."<br />".$error."<br />".$lang_new[$module_name]['_GOBACK']."</center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
        }
        redirect($admin_file.'.php?op=ad_plans');
        exit;
    }

    function ad_plans_edit() {
        global $db, $admin_file, $ad_admin_menu, $module_name, $lang_new, $_GETVAR;

        $pid = $_GETVAR->get('pid', '_REQUEST', 'int', 0);
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align='center'>\n<a href='$admin_file.php?op=BannersAdmin'>".$lang_new[$module_name]['_BANNERS_ADMIN_HEADER']."</a></div>\n";
        echo "<br /><br />";
        echo "<div align='center'>\n[ <a href='$admin_file.php'>".$lang_new[$module_name]['_BANNERS_RETURNMAIN']."</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo $ad_admin_menu;
        CloseTable();
        echo "<br />";
        OpenTable();
        $row = $db->sql_ufetchrow("SELECT * FROM "._BANNER_PLANS_TABLE." WHERE pid='$pid'");
        echo "<center><span class='title'><strong>".$lang_new[$module_name]['_ADVERTISINGPLANEDIT']."</strong></span></center><br /><br />";
        echo "<form method='post' action='".$admin_file.".php'>";
        echo "<table border='0'><tr><td>";
        echo $lang_new[$module_name]['_PLANNAME'].":</td><td><input type='text' size='40' name='planname' value='".$row['name']."' /></td></tr>";
        echo "<tr><td>".$lang_new[$module_name]['_PLANDESCRIPTION'].":</td><td><textarea name='description' rows='15' cols='70'>".$row['description']."</textarea></td></tr>";
        echo "<tr><td>".$lang_new[$module_name]['_DELIVERYQUANTITY'].":</td><td><input type='text' size='10' name='delivery' value='".$row['delivery']."' /></td></tr>";
        $sel0 = $sel1 = $sel2 = $sel3 = $sel4 = '';
        if ($row['delivery_type'] == 0) {
            $sel0 = 'selected="selected"';
        }
        if ($row['delivery_type'] == 1) {
            $sel1 = 'selected="selected"';
        }
        if ($row['delivery_type'] == 2) {
            $sel2 = 'selected="selected"';
        }
        if ($row['delivery_type'] == 3) {
            $sel3 = 'selected="selected"';
        }
        if ($row['delivery_type'] == 4) {
            $sel4 = 'selected="selected"';
        }
        echo "<tr><td>".$lang_new[$module_name]['_DELIVERYTYPE'].":</td><td><select name='type'>"
            ."<option value='0' ".$sel0.">".$lang_new[$module_name]['_IMPRESSIONS']."</option>"
            ."<option value='1' $sel1>".$lang_new[$module_name]['_CLICKS']."</option>"
            ."<option value='2' $sel2>".$lang_new[$module_name]['_PDAYS']."</option>"
            ."<option value='3' $sel3>".$lang_new[$module_name]['_PMONTHS']."</option>"
            ."<option value='4' $sel4>".$lang_new[$module_name]['_PYEARS']."</option>"
            ."</select></td></tr>";
        echo "<tr><td>".$lang_new[$module_name]['_PRICE'].":</td><td><input type='text' size='10' name='price' value='".$row['price']."' /></td></tr>";
        echo "<tr><td>".$lang_new[$module_name]['_PLANBUYLINKS'].":</td><td><textarea name='buy_links' rows='15' cols='70'>".$row['buy_links']."</textarea></td></tr>";
        if ($row['active'] == 1) {
            $check0 = 'checked="checked"';
            $check1 = '';
        } elseif ($row['active'] == 0) {
            $check0 = '';
            $check1 = 'checked="checked"';
        }
        echo "<tr><td>".$lang_new[$module_name]['_STATUS'].":</td><td><input type='radio' name='status' value='1' ".$check0." /> ".$lang_new[$module_name]['_ACTIVE']."&nbsp;&nbsp;<input type='radio' name='status' value='0' ".$check1." /> ".$lang_new[$module_name]['_INACTIVE']."</td></tr>";
        echo "<tr><td>&nbsp;</td><td><input type='hidden' name='pid' value='".$pid."' /><input type='hidden' name='op' value='ad_plans_save' /><input type='submit' value='".$lang_new[$module_name]['_SAVECHANGES']."' /></td></tr></table></form><br /><center><em>".$lang_new[$module_name]['_PLANSNOTE']."</em></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function ad_plans_save() {
        global $db, $admin_file, $ad_admin_menu, $module_name, $lang_new, $_GETVAR;

        $pid            = $_GETVAR->get('pid', '_POST', 'int', 0);
        $planname       = $_GETVAR->get('planname', '_POST', 'string', '');
        $description    = $_GETVAR->get('description', '_POST', 'string', '');
        $delivery       = $_GETVAR->get('delivery', '_POST', 'int', 0);
        $type           = $_GETVAR->get('type', '_POST', 'int', -1);
        $price          = $_GETVAR->get('price', '_POST', 'string', '');
        $buy_links      = $_GETVAR->get('buy_links', '_POST', 'string', '');
        $status         = $_GETVAR->get('status', '_POST', 'int', 0);
        $price          = (is_numeric($price) ? floatval($price) : '');

        if (!empty($planname) && !empty($description) && ($delivery != 0) && ($type != -1) && (is_numeric($price)) && !empty($buy_links) && ($pid != 0)) {
            $db->sql_uquery("UPDATE "._BANNER_PLANS_TABLE." SET active='".$status."', name='".$planname."', description='".$description."', delivery='".$delivery."', delivery_type='".$type."', buy_links='".$buy_links."', price='".$price."' WHERE pid='".$pid."'");
            redirect($admin_file.'.php?op=ad_plans');
            exit;
        } else {
            $error = '<br />';
            if (empty($planname)) {
                $error .= $lang_new[$module_name]['_PLANNAME'].'<br />';
            }
            if (empty($description)) {
                $error .= $lang_new[$module_name]['_PLANDESCRIPTION'].'<br />';
            }
            if ($delivery == 0) {
                $error .= $lang_new[$module_name]['_DELIVERYQUANTITY'].'<br />';
            }
            if ($type == -1) {
                $error .= $lang_new[$module_name]['_DELIVERYTYPE'].'<br />';
            }
            if (!is_numeric($price)) {
                $error .= $lang_new[$module_name]['_PRICE'].'<br />';
            }
            if (empty($buy_links)) {
                $error .= $lang_new[$module_name]['_PLANBUYLINKS'].'<br />';
            }
            if ($pid == 0)  {
                $error .= $lang_new[$module_name]['_PIDERROR'].'<br />';
            }
            $error = "<span style='color:red;'>".$error."</span>";
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
            echo "<div align='center'>\n<a href='".$admin_file.".php?op=BannersAdmin'>".$lang_new[$module_name]['_BANNERS_ADMIN_HEADER']."</a></div>\n";
            echo "<br /><br />";
            echo "<div align='center'>\n[ <a href='".$admin_file.".php'>".$lang_new[$module_name]['_BANNERS_RETURNMAIN']."</a> ]</div>\n";
            CloseTable();
            echo "<br />";
            OpenTable();
            echo $ad_admin_menu;
            CloseTable();
            echo "<br />";
            OpenTable();
            echo "<center>".$lang_new[$module_name]['_ADDPLANERROR']."<br />".$error."<br />".$lang_new[$module_name]['_GOBACK']."</center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
        }
    }

    function ad_plans_delete() {
        global $db, $admin_file, $ad_admin_menu, $module_name, $lang_new, $_GETVAR;

        $pid            = $_GETVAR->get('pid', '_REQUEST', 'int', 0);
        $ok             = $_GETVAR->get('ok', '_REQUEST', 'int', 0);
        if ($ok == 1) {
            $db->sql_uquery("DELETE FROM "._BANNER_PLANS_TABLE." WHERE pid='".$pid."'");
            redirect($admin_file.'.php?op=ad_plans');
            exit;
        } else {
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
            echo "<div align='center'>\n<a href='".$admin_file.".php?op=BannersAdmin'>".$lang_new[$module_name]['_BANNERS_ADMIN_HEADER']."</a></div>\n";
            echo "<br /><br />";
            echo "<div align='center'>\n[ <a href='".$admin_file.".php'>".$lang_new[$module_name]['_BANNERS_RETURNMAIN']."</a> ]</div>\n";
            CloseTable();
            echo "<br />";
            OpenTable();
            echo $ad_admin_menu;
            CloseTable();
            echo "<br />";
            OpenTable();
            $row = $db->sql_ufetchrow("SELECT * FROM "._BANNER_PLANS_TABLE." WHERE pid='".$pid."'");
            echo "<center><strong>".$lang_new[$module_name]['_DELETEPLAN'].": ".$row['name']."</strong><br /><br />"._SURETODELPLAN."<br /><br />"
                ."[ <a href='".$admin_file.".php?op=ad_plans'>".$lang_new[$module_name]['_NO']."</a> | <a href='".$admin_file.".php?op=ad_plans_delete&amp;pid=".$pid."&amp;ok=1'>".$lang_new[$module_name]['_YES']."</a> ]</center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
        }
    }

    function ad_plans_status() {
        global $db, $admin_file, $_GETVAR;

        $pid    = $_GETVAR->get('pid', '_REQUEST', 'int', 0);
        $status = $_GETVAR->get('status', '_REQUEST', 'int', 0);
        if ($status == 1) {
            $active = 0;
        } else {
            $active = 1;
        }
        $db->sql_uquery("UPDATE "._BANNER_PLANS_TABLE." SET active='$active' WHERE pid='$pid'");
        redirect($admin_file.'.php?op=ad_plans');
    }

    switch($op) {

        case 'BannersAdmin':
            BannersAdmin();
        break;

        case 'BannersAdd':
            BannersAdd();
        break;

        case 'BannerAddClient':
            BannerAddClient();
        break;

        case 'BannerDelete':
            BannerDelete();
        break;

        case 'BannerEdit':
            BannerEdit();
        break;

        case 'BannerChange':
            BannerChange();
        break;

        case 'BannerClientDelete':
            BannerClientDelete();
        break;

        case 'BannerClientEdit':
            BannerClientEdit();
        break;

        case 'BannerClientChange':
            BannerClientChange();
        break;

        case 'BannerStatus':
            BannerStatus();
        break;

        case 'add_banner':
            add_banner();
        break;

        case 'add_client':
            add_client();
        break;

        case 'ad_positions':
            ad_positions();
        break;

        case 'position_save':
            position_save();
        break;

        case 'position_edit':
            position_edit();
        break;

        case 'position_delete':
            position_delete();
        break;

        case 'ad_terms':
            ad_terms();
        break;

        case 'ad_plans':
            ad_plans();
        break;

        case 'ad_plans_add':
            ad_plans_add();
        break;

        case 'ad_plans_edit':
            ad_plans_edit();
        break;

        case 'ad_plans_save':
            ad_plans_save();
        break;

        case 'ad_plans_delete':
            ad_plans_delete();
        break;

        case 'ad_plans_status':
            ad_plans_status();
        break;
    }

} else {
    DisplayError('<strong>' . $lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['NO_ADMIN_RIGHTS'] . '<strong>' . $op . '</strong>');
}

?>