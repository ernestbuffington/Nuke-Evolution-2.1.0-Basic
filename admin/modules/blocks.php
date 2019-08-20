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

$adminpoint = @basename(__FILE__,'.php');
global $admin_file, $db, $adminpoint, $_GETVAR, $lang_admin, $cache, $evoconfig, $currentlang;

if(is_mod_admin()) {
    getmodule_lang($adminpoint);
    include(NUKE_INCLUDE_DIR . 'ajax/Sajax.php');

    function parse_data($data) {
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

    function update_db($data_array, $col_check) {
        global $cache, $db;

        if (is_array($data_array)) {
            foreach($data_array AS $set => $items) {
                $i = 0;
                foreach($items AS $item) {
                    $item = substr($item, 7);
                    $sql = "UPDATE "._BLOCKS_TABLE." SET bposition = '$set', weight = '$i'  WHERE bid = '$item' $col_check";
                    $db->sql_uquery($sql);
                    $i++;
                }
            }
        }
        $cache->delete('blocks', 'config');
        $cache->resync();
    }

    function blocks_update($data) {
        $data = parse_data($data);
        update_db($data, "AND (bposition = 'l' OR bposition = 'c' OR bposition = 'r' OR bposition = 'd')");
        return 1;
    }

    function status_update($data) {
        global $db, $cache;

        $data = explode(':', $data);
        $bid = $data[0];
        $status = $data[1];
        $status = ($status == 1) ? 0 : 1;
        $sql = "UPDATE "._BLOCKS_TABLE." SET `active` = '$status' WHERE `bid` = '$bid'";
        $db->sql_query($sql);
        $cache->delete('blocks', 'config');
        $cache->resync();
        return 1;
}

    function AddBlock($data) {
        global $cache, $db, $admin_file;

        $data['title'] = FixQuotes($data['title']);
        $data['headline'] = intval($data['headline']);
        $data['view'] = intval($data['view']);
        if($data['headline'] != 0) {
            $result = $db->sql_query("SELECT sitename, headlinesurl FROM "._HEADLINES_TABLE." WHERE hid='" . $data['headline'] . "'");
            list($title, $data['url']) = $db->sql_fetchrow($result);
            if (empty($data['title'])) {
                $data['title'] = $title;
            }
        }
        if (!isset($data['oldposition']) || empty($data['oldposition'])) {
            $result = $db->sql_query("SELECT weight FROM "._BLOCKS_TABLE." WHERE bposition='" . $data['bposition'] . "' ORDER BY weight DESC");
            list($weight) = $db->sql_fetchrow($result);
            $weight++;
        } else {
            $result = $db->sql_query("SELECT weight FROM "._BLOCKS_TABLE." WHERE bid='" . $data['bid'] . "'");
            $row = $db->sql_fetchrow($result);
            $weight = $row[0];
        }
        $db->sql_freeresult($result);
        $data['btime'] = 0;
        if($data['blockfile'] != '') {
            $data['url'] = '';
            if($data['title'] == '') {
                $data['title'] = preg_replace('#(block-)|(.php)#','',$data['blockfile']);
                $data['title'] = str_replace('_',' ',$data['title']);
            }
        }
        if($data['url'] != '') {
            $data['btime'] = time();
            if(!preg_match('#://#',$data['url'])) { 
                $data['url'] = 'http://'.$data['url'];
            }
            if(!($content = rss_content($data['url']))) {
                return false;
            }
            $data['content'] = $content;
        }
        if (isset($data['view']) && $data['view'] == '6') {
            if (is_array($data['add_groups'])) {
                $data['view'] = "";
                foreach ($data['add_groups'] as $group) {
                    $data['view'] .= $group ."-";
                }
            }
        }
        if (!isset($data['oldposition']) || empty($data['oldposition'])) {
            $sql = "INSERT INTO "._BLOCKS_TABLE." (bid, bkey, title, content, url, bposition, weight, active, refresh, time, blanguage, blockfile, view) VALUES (NULL, '', '" . $data['title'] . "', '".$db->sql_escapestring($data['content'])."', '" . $data['url'] . "', '" . $data['bposition'] . "', '" . $weight . "', '" . $data['active'] . "', '" . $data['refresh'] . "', '" . $data['btime'] . "', '" . $data['blanguage'] . "', '" . $data['blockfile'] . "', '" . $data['view'] . "')";
        } else {
            $data['bposition'] = (!empty($data['bposition'])) ? $data['bposition'] : $data['oldposition'];
            $sql = "UPDATE "._BLOCKS_TABLE." SET bkey='', title='" . $data['title'] . "', content='".$db->sql_escapestring($data['content'])."', url='" . $data['url'] . "', bposition='" . $data['bposition'] . "', weight='" . $weight . "', active='" . $data['active'] . "', refresh='" . $data['refresh'] . "', time='" . $data['btime'] . "', blanguage='" . $data['blanguage'] . "', blockfile='" . $data['blockfile'] . "', view='" . $data['view'] . "' WHERE bid=".$data['bid'];
        }
        $db->sql_query($sql);
        $cache->delete('blocks', 'config');
        $cache->resync();
        redirect("$admin_file.php?op=blocks");
    }

    function deleteBlock($bid) {
        global $db;
        $bid = intval($bid);
        $db->sql_uquery("DELETE FROM "._BLOCKS_TABLE." WHERE bid = '" . $bid . "'");
        return true;
    }

    function BlocksAdmin() {
        global $db, $Sajax, $admin_file, $g2, $element_ids, $adminpoint, $lang_admin;

        define('USE_DRAG_DROP',true);
        $g2 = 1;
        $element_ids[] = 'l';
        $element_ids[] = 'c';
        $element_ids[] = 'd';
        $element_ids[] = 'r';
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align='center'>\n<a href='".$admin_file.".php?op=blocks'>" . $lang_admin[$adminpoint]['BLOCKS_BLOCKSADMIN'] . "</a></div>\n";
        echo "<br />";
        echo "<div align='center'>\n[ <a href='".$admin_file.".php'>" . $lang_admin['KERNEL']['MAIN_BACK'] . "</a> ]</div><br /><br />\n";
        echo "<div align='center'>\n";
        echo "<span style='background-color : #ff6c6c;'>".$lang_admin[$adminpoint]['BLOCKS_TITLE']."</span>&nbsp;-&nbsp;".$lang_admin[$adminpoint]['BLOCKS_INACTIVE']."<br />\n";
        echo "<img src='".evo_image('delete.png', 'blocks')."' border='0' alt='' />&nbsp;-&nbsp;".$lang_admin[$adminpoint]['BLOCKS_LINK_DELETE']."<br />\n";
        echo "<img src='".evo_image('edit.png', 'blocks')."' border='0' alt='' />&nbsp;-&nbsp;".$lang_admin[$adminpoint]['BLOCKS_EDITBLOCK']."<br /><br />\n";
        echo $lang_admin[$adminpoint]['BLOCKS_ADMINNOTE'];
        echo "<br /><br />";
        echo "<input type='submit' value='".$lang_admin[$adminpoint]['BLOCKS_REFRESHSCREEN']."' onclick='window.location.reload()' />";
        echo "</div>\n";
        CloseTable();
        OpenTable();
        $result = $db->sql_query('SELECT bid, bkey, title, url, bposition, weight, active, blanguage, blockfile, view FROM '._BLOCKS_TABLE.' ORDER BY weight');
        $blocks = array();
        while($row = $db->sql_fetchrow($result)) {
            $blocks[$row['bposition']][] = $row;
        }
        echo "<center><strong>".$lang_admin[$adminpoint]['BLOCKS_BLOCKSADMIN']."</strong><br />\n";
        echo "<img src='".evo_image('li.png', 'evo')."' border='0' alt='' /><a href='".$admin_file.".php?op=newBlock'> ".$lang_admin[$adminpoint]['BLOCKS_ADDNEWBLOCK']."</a><br /><br /></center>\n";
        echo "<table border='0' width='100%'>\n<tr><td width='25%' align='center' valign='top'>\n";
        echo "<table border='0'>\n";
        echo "<tr><td align='center'><strong>" . $lang_admin[$adminpoint]['BLOCKS_LEFTBLOCK'] . "</strong></td></tr>\n";
        echo "<tr><td align='center'>";
        echo "<ul id='l' class='sortable boxy'>";
        for($i=0,$count=count($blocks['l']);$i<$count;$i++) {
            echo "<li class='" . (($blocks['l'][$i]['active'] == 1) ? "active" : "inactive") . "' id='blocks_".$blocks['l'][$i]['bid']."' ondblclick='change_status(" . $blocks['l'][$i]['bid'] . ")'>";
            echo "<input type='hidden' id='status_block_" . $blocks['l'][$i]['bid'] . "' value='" . $blocks['l'][$i]['active'] . "' />\n";
            echo "<table width='100%'><tr>\n";
            echo "<td width='75%' align='center'>".$blocks['l'][$i]['title']."</td>\n";
            echo "<td width='25%' align='right' >";
            echo "<a href='".$admin_file.'.php?op=editBlock&amp;bid='.$blocks['l'][$i]['bid'] . "'><img src='".evo_image('edit.png', 'blocks')."' border='0' title='".$lang_admin[$adminpoint]['BLOCKS_EDITBLOCK']."' alt='".$lang_admin[$adminpoint]['BLOCKS_EDITBLOCK']."' /></a>&nbsp;";
            echo "<a href='javascript:deleteBlock(\"" . $blocks['l'][$i]['bid'] . "\", \"l\");'><img src='".evo_image('delete.png', 'blocks')."' border='0' title='".$lang_admin[$adminpoint]['BLOCKS_DELETEBLOCK']."' alt='".$lang_admin[$adminpoint]['BLOCKS_DELETEBLOCK']."' /></a>\n";
            echo "</td></tr></table></li>";
        }
        echo "</ul>";
        echo "</td></tr>\n";
        echo "</table>\n";
        echo "</td><td width='25%' align='center' valign='top'>\n";
        echo "<table border='0'>\n";
        echo "<tr><td align='center'><strong>" . $lang_admin[$adminpoint]['BLOCKS_CENTERUP'] . "</strong></td></tr>\n";
        echo "<tr><td align='center'>";
        echo "<ul id='c' class='sortable boxy'>";
        if (isset($blocks['c']) && is_array($blocks['c'])) {
            for($i=0,$count=count($blocks['c']);$i<$count;$i++) {
                echo "<li class='" . (($blocks['c'][$i]['active'] == 1) ? "active" : "inactive") . "' id='blocks_".$blocks['c'][$i]['bid']."' ondblclick='change_status(" . $blocks['c'][$i]['bid'] . ")'>";
                echo "<input type='hidden' id='status_block_" . $blocks['c'][$i]['bid'] . "' value='" . $blocks['c'][$i]['active'] . "' />";
                echo '<table width="100%"><tr>';
                echo '<td width="75%" align="center">'.$blocks['c'][$i]['title'].'</td>';
                echo '<td align="right" width="25%">';
                echo '<a href="'.$admin_file.'.php?op=editBlock&amp;bid=' . $blocks['c'][$i]['bid'] . '"><img src="'.evo_image('edit.png', 'blocks').'" border="0" title="'.$lang_admin[$adminpoint]['BLOCKS_EDITBLOCK'].'" alt="'.$lang_admin[$adminpoint]['BLOCKS_EDITBLOCK'].'" /></a>&nbsp;';
                echo '<a href="javascript:deleteBlock(\'' . $blocks['c'][$i]['bid'] . '\', \'c\');"><img src="'.evo_image('delete.png', 'blocks').'" border="0" title="'.$lang_admin[$adminpoint]['BLOCKS_DELETEBLOCK'].'" alt="'.$lang_admin[$adminpoint]['BLOCKS_DELETEBLOCK'].'" /></a>';
                echo '</td></tr></table></li>';
            }
        }
        echo "</ul><br />";
        echo "</td></tr>\n";
        echo "<tr><td align='center'><strong>" . $lang_admin[$adminpoint]['BLOCKS_CENTERDOWN'] . "</strong></td></tr>\n";
        echo "<tr><td align='center'>";
        echo "<ul id='d' class='sortable boxy'>";
        if (isset($blocks['d']) && is_array($blocks['d'])) {
            for($i=0,$count=count($blocks['d']);$i<$count;$i++) {
                echo '<li class="' . (($blocks['d'][$i]['active'] == 1) ? "active" : "inactive") . '" id="blocks_'.$blocks['d'][$i]['bid'].'" ondblclick="change_status(' . $blocks['d'][$i]['bid'] . ');">';
                echo '<input type="hidden" id="status_block_' . $blocks['d'][$i]['bid'] . '" value="' . $blocks['d'][$i]['active'] . '" />';
                echo '<table width="100%"><tr>';
                echo '<td width="75%" align="center">'.$blocks['d'][$i]['title'].'</td>';
                echo '<td align="right" width="25%">';
                echo '<a href="'.$admin_file.'.php?op=editBlock&amp;bid=' . $blocks['d'][$i]['bid'] . '"><img src="'.evo_image('edit.png', 'blocks').'" border="0" title="'.$lang_admin[$adminpoint]['BLOCKS_EDITBLOCK'].'" alt="'.$lang_admin[$adminpoint]['BLOCKS_EDITBLOCK'].'" /></a>&nbsp;';
                echo '<a href="javascript:deleteBlock(\'' . $blocks['d'][$i]['bid'] . '\', \'d\');"><img src="'.evo_image('delete.png', 'blocks').'" border="0" title="'.$lang_admin[$adminpoint]['BLOCKS_DELETEBLOCK'].'" alt="'.$lang_admin[$adminpoint]['BLOCKS_DELETEBLOCK'].'" /></a>';
                echo '</td></tr></table></li>';
            }
        }
        echo "</ul>\n";
        echo "</td></tr>\n";
        echo "</table>\n";
        echo "</td><td width='25%' align='center' valign='top'>\n";
        echo "<table border='0'>\n";
        echo "<tr><td align='center'><strong>" . $lang_admin[$adminpoint]['BLOCKS_RIGHTBLOCK'] . "</strong></td></tr>\n";
        echo "<tr><td align='center'>";
        echo "<ul id='r' class='sortable boxy'>";
        for($i=0,$count=count($blocks['r']);$i<$count;$i++) {
            echo '<li class="' . (($blocks['r'][$i]['active'] == 1) ? "active" : "inactive") . '" id="blocks_'.$blocks['r'][$i]['bid'].'" ondblclick="change_status(' . $blocks['r'][$i]['bid'] . ');">';
            echo '<input type="hidden" id="status_block_' . $blocks['r'][$i]['bid'] . '" value="' . $blocks['r'][$i]['active'] . '" />';
            echo '<table width="100%"><tr>';
            echo '<td width="75%" align="center">'.$blocks['r'][$i]['title'].'</td>';
            echo '<td align="right" width="25%"><a href="'.$admin_file.'.php?op=editBlock&amp;bid=' . $blocks['r'][$i]['bid'] . '"><img src="'.evo_image('edit.png', 'blocks').'" border="0" title="'.$lang_admin[$adminpoint]['BLOCKS_EDITBLOCK'].'" alt="'.$lang_admin[$adminpoint]['BLOCKS_EDITBLOCK'].'" /></a>&nbsp;';
            echo '<a href="javascript:deleteBlock(\'' . $blocks['r'][$i]['bid'] . '\', \'r\');"><img src="'.evo_image('delete.png', 'blocks').'" border="0" title="'.$lang_admin[$adminpoint]['BLOCKS_DELETEBLOCK'].'" alt="'.$lang_admin[$adminpoint]['BLOCKS_DELETEBLOCK'].'" /></a></td>';
            echo '</tr></table></li>';
        }
        echo "</ul>";
        echo "</td></tr>\n";
        echo "</table>\n";
        echo "</td></tr>";
        echo "</table>\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function block_show($bid) {
        global $db, $admin_file, $g2, $element_ids, $adminpoint, $lang_admin;

        $bid = intval($bid);
        $result = $db->sql_query("SELECT bid, bkey, title, content, url, bposition, blockfile, view, refresh, time, blanguage FROM "._BLOCKS_TABLE." WHERE bid='".$bid."'");
        $row = $db->sql_fetchrow($result);
        define('USE_DRAG_DROP',true);
        $g2 = 1;
        $element_ids[] = 'l';
        $element_ids[] = 'c';
        $element_ids[] = 'd';
        $element_ids[] = 'r';
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align='center' class='option'>".$lang_admin[$adminpoint]['BLOCKS_BLOCKSADMIN'].": ".$lang_admin[$adminpoint]['BLOCKS_FUNCTIONS']."</div><br /><br />"
            .'[ <a href="'.$admin_file.'.php?op=blocks&amp;change='.$bid.'">'.$lang_admin[$adminpoint]['BLOCKS_ACTIVATE'].'</a> | <a href="'.$admin_file.'.php?op=blocks&amp;edit='.$bid.'">'.$lang_admin[$adminpoint]['BLOCKS_EDITBLOCK'].'</a> | ';
        if(empty($row['bkey'])) {
            echo '<a href="'.$admin_file.'.php?op=blocks&amp;del='.$bid.'">'.$lang_admin[$adminpoint]['BLOCKS_DELETEBLOCK'].'</a> | ';
        }
        echo '<a href="'.$admin_file.'.php?op=blocks">'.$lang_admin[$adminpoint]['BLOCKS_BLOCKSADMIN'].'</a> ]';
        CloseTable();
        echo '<br /><center>';
        render_blocks($row['bposition'], $row);
        echo '</center>';
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function rssfail() {
        DisplayError('<center><strong>'.$lang_admin[$adminpoint]['BLOCKS_RSSFAIL'].'</strong><br /><br />'.$lang_admin[$adminpoint]['BLOCKS_RSSTRYAGAIN'].'<br /><br /><a href="javascript:history.back(-1)">'.$lang_admin['KERNEL']['GOBACK'].'</a></center>');
    }

    function NewBlock($bid='') {
        global $db, $admin_file, $evoconfig, $currentlang, $adminpoint, $lang_admin;

        if (!empty($bid)) {
            $bid = intval($bid);
            $edit = $db->sql_fetchrow($db->sql_query("SELECT * FROM "._BLOCKS_TABLE." WHERE `bid`=".$bid));
        } else {
            list($bid) = $db->sql_fetchrow($db->sql_query("SELECT bid FROM "._BLOCKS_TABLE." ORDER BY bid DESC LIMIT 1"));
            $bid++;
        }
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align='center'>\n<a href='".$admin_file.".php?op=blocks'>" . $lang_admin[$adminpoint]['BLOCKS_BLOCKSADMIN'] . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align='center'>\n[ <a href='".$admin_file.".php'>" . $lang_admin['KERNEL']['MAIN_BACK'] . "</a> ]</div>\n";
        CloseTable();
        OpenTable();
        echo '<form name="addblock" method="post" action="'.$admin_file.'.php">';
        echo "<input type='hidden' name='op' value='newBlock' />\n";
        $value = (isset($edit)) ? $edit['bid'] : $bid;
        echo "<input type='hidden' name='bid' value='" . $value . "' />\n";
        echo "<table border='0' width='100%'>\n";
        if (!isset($edit)) {
            echo "<tr><th colspan='2' align='center'>".$lang_admin[$adminpoint]['BLOCKS_ADDNEWBLOCK']."</th></tr>\n";
        } else {
            echo "<tr><th colspan='2' align='center'>".$lang_admin[$adminpoint]['BLOCKS_EDITBLOCK']."&nbsp;:&nbsp;".$edit['title']."</th></tr>\n";
        }

        echo "<tr><td>".$lang_admin[$adminpoint]['BLOCKS_TITLE'].":</td><td>\n";
        $value = (isset($edit)) ? "value='".$edit['title']."'" : '';
        echo '<input type="text" name="title" size="30" maxlength="60" onkeyup="document.title=\'New Block:\' + this.value" '.$value.' /></td></tr>';

        echo "<tr><td>".$lang_admin[$adminpoint]['BLOCKS_RSSFILE'].":</td><td>\n";
        $value = (isset($edit)) ? "value='".$edit['url']."'" : '';
        echo "<input type='text' name='url' size='30' maxlength='200' $value />&nbsp;&nbsp;\n";
        $headlines[0] = $lang_admin[$adminpoint]['BLOCKS_CUSTOM'];
        $res = $db->sql_query("select hid, sitename from "._HEADLINES_TABLE." ORDER BY sitename");
        while (list($hid, $htitle) = $db->sql_fetchrow($res)) {
            $headlines[$hid] = $htitle;
        }
        echo select_box('headline', $value, $headlines)."&nbsp;[ <a href='".$admin_file.".php?op=headlines&amp;comeblock=1' target='_blank'>Setup</a> ]<br /><span class='tiny'>".$lang_admin[$adminpoint]['BLOCKS_SETUPHEADLINES']."</span></td></tr>\n";
        echo "<tr><td>".$lang_admin[$adminpoint]['BLOCKS_FILENAME'].":</td>\n<td>";
        echo "<select name='blockfile'>\n";
        echo "<option value='' selected='selected'>".$lang_admin[$adminpoint]['BLOCKS_NONE']."</option>\n";
        $result = $db->sql_query('SELECT blockfile FROM '._BLOCKS_TABLE);
        while($row = $db->sql_fetchrow($result)) {
            $allblocks[$row[0]] = 1;
        }
        $value = (isset($edit)) ? $edit['blockfile'] : '';
        $blocksdir = dir('blocks');
        while($func=$blocksdir->read()) {
            if(preg_match('/block-(.*).php$/i', $func, $matches)) {
                if(!isset($allblocks[$func]) || $func == $value) {
                    $blockslist[] = $func;
                }
            }
        }
        closedir($blocksdir->handle);
        sort($blockslist);
        for ($i=0, $maxi=count($blockslist); $i < $maxi; $i++) {
            if(!empty($blockslist[$i]) && !isset($visblocks[$blockslist[$i]])) {
                $bl = preg_replace('/(block-)|(.php)/','',$blockslist[$i]);
                $bl = str_replace('_',' ',$bl);
                $checked = '';
                if (!empty($value)) {
                    $checked = ($value == $blockslist[$i]) ? 'selected="selected"' : '';
                }
                echo '<option value="'.$blockslist[$i].'" '.$checked.'>'.$bl."</option>\n";
            }
        }
        echo "</select>\n";
        echo "</td></tr>\n";
        echo "<tr><td></td><td><span class='tiny'>".$lang_admin[$adminpoint]['BLOCKS_FILEINCLUDE']."</span></td></tr>\n";
        echo "<tr><td></td><td><span class='tiny'>".$lang_admin[$adminpoint]['BLOCKS_IFRSSWARNING']."</span></td></tr>\n";
        $value = (isset($edit)) ? $edit['content'] : '';
        echo "<tr><td>".$lang_admin[$adminpoint]['BLOCKS_CONTENT'].":</td><td>\n";
        echo Make_TextArea('content',$value,'addblock');
        echo "</td></tr>\n";
        $value = (isset($edit)) ? $edit['bposition'] : 'l';
        echo '<tr><td>'.$lang_admin[$adminpoint]['BLOCKS_POSITION'].':</td><td>'.select_box('bposition', $value, array('l'=>$lang_admin[$adminpoint]['BLOCKS_LEFT'],'c'=>$lang_admin[$adminpoint]['BLOCKS_CENTERUP'],'d'=>$lang_admin[$adminpoint]['BLOCKS_CENTERDOWN'],'r'=>$lang_admin[$adminpoint]['BLOCKS_RIGHT'])).'</td></tr>';
        if($evoconfig['multilingual']) {
            echo '<tr><td>'.$lang_admin[$adminpoint]['BLOCKS_LANGUAGE'].':</td><td colspan="3">';
            $languages = lang_list();
            echo '<select name="blanguage">';
            if (!isset($edit)) {
                echo '<option value=""'.(($currentlang == '') ? ' selected="selected"' : '').'>'.$lang_admin[$adminpoint]['BLOCKS_ALL']."</option>\n";
                for ($i=0, $j = count($languages); $i < $j; $i++) {
                    if($languages[$i] != '') {
                        echo '<option value="'.$languages[$i].'"'.(($currentlang == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($languages[$i])."</option>\n";
                    }
                }
            } else {
                echo '<option value=""'.(($edit['blanguage'] == '') ? ' selected="selected"' : '').'>'.$lang_admin[$adminpoint]['BLOCKS_ALL']."</option>\n";
                for ($i=0, $j = count($languages); $i < $j; $i++) {
                    if($languages[$i] != '') {
                        echo '<option value="'.$languages[$i].'"'.(($edit['blanguage'] == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($languages[$i])."</option>\n";
                    }
                }
            }
            echo '</select></td></tr>';
        } else {
            echo '<input type="hidden" name="blanguage" value="" />';
        }
        $value = (isset($edit)) ? $edit['active'] : 1;
        echo '<tr><td>'.$lang_admin[$adminpoint]['BLOCKS_ACTIVATE2'].'</td><td>'.yesno_option('active', $value)."</td></tr>\n";
        $value = (isset($edit)) ? $edit['refresh'] : 3600;
        echo '<tr><td>'.$lang_admin[$adminpoint]['BLOCKS_REFRESHTIME'].':</td><td>'.select_box('refresh', $value, array('1800'=>'1/2 '.$lang_admin[$adminpoint]['BLOCKS_HOUR'],'3600'=>'1 '.$lang_admin[$adminpoint]['BLOCKS_HOUR'],'18000'=>'5 '.$lang_admin[$adminpoint]['BLOCKS_HOURS'],'36000'=>'10 '.$lang_admin[$adminpoint]['BLOCKS_HOURS'],'86400'=>'24 '.$lang_admin[$adminpoint]['BLOCKS_HOURS'])).'&nbsp;<span class="tiny">'.$lang_admin[$adminpoint]['BLOCKS_ONLYHEADLINES']."</span></td></tr>\n";
        $value = (isset($edit)) ? $edit['view'] : 0;
        echo '<tr><td>'.$lang_admin[$adminpoint]['BLOCKS_VIEWPRIV'].'</td><td>';
        $o1 = $o2 = $o3 = $o4 = $o6 = '';
        switch ($value) {
            case '0':
            case '1':
                $o1 = 'selected="selected"';  //All
                break;
            case '2':
                $o2 = 'selected="selected"'; //Anon
                break;
            case '3':
                $o3 = 'selected="selected"'; //Users
                break;
            case '4':
                $o4 = 'selected="selected"';  //Admin
                break;
            default:
                $o6 = 'selected="selected"';  //Groups
                $ingroups = explode('-', $value);
                break;
        }
        echo "<select name='view'>"
            ."<option value='1' $o1>" . $lang_admin[$adminpoint]['BLOCKS_MVALL'] . "</option>"
            ."<option value='2' $o2>" . $lang_admin[$adminpoint]['BLOCKS_MVANON'] . "</option>"
            ."<option value='3' $o3>" . $lang_admin[$adminpoint]['BLOCKS_MVUSERS'] . "</option>"
            ."<option value='4' $o4>" . $lang_admin[$adminpoint]['BLOCKS_MVADMIN'] . "</option>"
            ."<option value='6' $o6>".$lang_admin[$adminpoint]['BLOCKS_MVGROUPS']."</option>"
            ."</select><br />";
        echo "</td></tr><tr><td></td><td>\n";
        echo "<span class='tiny'>".$lang_admin[$adminpoint]['BLOCKS_WHATGRDESC']."</span><br /></td></tr><tr><td><strong>".$lang_admin[$adminpoint]['BLOCKS_WHATGROUPS']."</strong>&nbsp;</td><td><select name='add_groups[]' multiple='multiple' size='5'>\n";
        $groupsResult = $db->sql_query("select group_id, group_name from ".GROUPS_TABLE." where group_description <> 'Personal User'");
        while(list($gid, $gname) = $db->sql_fetchrow($groupsResult)) {
            if(@in_array($gid,$ingroups) AND $o6 == 'selected="selected"') {
                $sel = "selected='selected'";
            } else {
                $sel = '';
            }
            echo "<option value='$gid' $sel>$gname</option>\n";
        }
        echo "</select>\n";
        echo "</td></tr>\n";
        echo "</table><br /><br />\n";
        if (isset($edit)) {
            echo "<input type='hidden' name='oldposition' value='" . $edit['bposition'] . "' />\n";
        }
        echo "<input type='hidden' name='update' value='1' />\n";
        if (!isset($edit)) {
            echo "<div align='center'><input type='submit' value='".$lang_admin[$adminpoint]['BLOCKS_CREATEBLOCK']."' /></div>\n";
        } else {
            echo "<div align='center'><input type='submit' value='".$lang_admin[$adminpoint]['BLOCKS_SAVEBLOCK']."' /></div>\n";
        }
        echo "</form>\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function BlocksAddScripts() {
        global $Sajax;

        $script = "function change_status(bid) {
            hidden = document.getElementById(\"status_block_\" + bid);
            elem = document.getElementById(\"blocks_\" + bid);
            var status = hidden.value;
            hidden.value = ((status == 1) ? 0 : 1);
            elem.className = ((status == 1) ? \"inactive\" : \"active\");
            var sendData = bid+\":\"+status;
            x_status_update(sendData, confirm);
            }\n";
        $script .= "function deleteBlock(bid, position) {
            var p = document.getElementById(position);
            var b = document.getElementById(\"blocks_\" + bid);
            p.removeChild(b);
            x_deleteBlock(bid, confirm);
            }\n";
        $script .= "function onDrop() {
            var data = DragDrop.serData('g2');
            x_blocks_update(data, confirm);}\n";
        $script .= "function getSort()
            {
                order = document.getElementById(\"weight\");
                order.value = DragDrop.serData('g1', null);
            }\n";
        $script .= "function showValue()
            {
                order = document.getElementById(\"weigth\");
            }\n";
        $Sajax->sajax_add_script($script);
    }

    global $Sajax;
    $Sajax = new Sajax();
    BlocksAddScripts();
    global $g2;
    $g2 = 1;
    $Sajax->sajax_export('blocks_update', 'status_update', 'AddBlock', 'deleteBlock');
    $Sajax->sajax_handle_client_request();
    $bid = $_GETVAR->get('bid', '_REQUEST', 'int');
    
    switch($op) {
        case 'blocks':
            BlocksAdmin();
            break;
        case 'editBlock':
        case 'newBlock':
            if (isset($_POST['update'])) {
                AddBlock($_POST);
            }
            NewBlock($bid);
            break;
    }
} else {
    DisplayError('<strong>' . $lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['NO_ADMIN_RIGHTS'] . '<strong>' . $op . '</strong>');
}

?>