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

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }


include_once(NUKE_INCLUDE_DIR.'nbbcode.php');

global $bgcolor1, $bgcolor2, $textcolor2, $evoconfig, $currentlang, $db, $admin_file, $userinfo;
$query = ($evoconfig['multilingual']) ? "AND (mlanguage='$currentlang' OR mlanguage='')" : '';
if (!is_admin()) {
  if (is_user()) {
      $query .= ' AND (view=1 OR view=3 OR view=6)';
  } else {
      $query .= ' AND (view=1 OR view=2 OR view=6)';
  }
} else {
    $query .= ' AND view<>2';
}

$result = $db->sql_query("SELECT mid, title, content, date, expire, view, groups FROM "._MESSAGE_TABLE." WHERE active='1' $query ORDER BY date DESC", true);
$query = '';
while (list($mid, $title, $content, $date, $expire, $view, $groups) = $db->sql_fetchrow($result)) {
  $content = decode_bb_all($content, 1, true);
  if (!empty($title) && !empty($content)) {
    $output = '';
    switch($view) {
      case 1:
        $output = _MVIEWALL;
      break;
      case 3:
        $output = _MVIEWUSERS;
      break;
      case 4:
        $output = _MVIEWADMIN;
      break;
      case 2:
        $output = _MVIEWANON;
      break;
      default:
          if (is_admin()) {
              $output = _MVIEWGROUP;
              break;
          }
          $groups = explode('-', $groups);
          $ingroup = false;
          foreach ($groups as $group) {
               if (isset($userinfo['groups'][$group])) {
                   $ingroup = true;
               }
          }
          if ($ingroup) $output = _MVIEWGROUP;
      break;
    }
    if ($output != '') {
      $remain = '';
      if (is_admin()) {
        if ($expire == 0) {
          $remain = _UNLIMITED;
        } else {
          $etime = (($date+$expire)-time())/3600;
          $etime = intval($etime);
          $remain = ($etime < 1) ? _EXPIRELESSHOUR : _EXPIREIN." $etime "._HOURS;
        }
      }
      $content = evo_img_tag_to_resize($content);
      OpenTable();
      if ($title != '-' && $title != '=') {
          echo '<div class="option" align="center"><strong>'.$title.'</strong></div><br />
              <div class="content" >'.$content.'</div><br /><div align="center">';
      } else {
          echo '<div class="content" >'.$content.'</div><br /><div align="center">';
      }
      if(is_admin()) {
        echo '[ '.$output.' - '.$remain.' - <a href="'.$admin_file.'.php?op=editmsg&amp;mid='.$mid.'">'._EDIT.'</a> ]';
      }
      echo '</div>';
      CloseTable();
      echo '<br />';
    }
    if ($expire != 0) {
      if ($date+$expire < time()) {
         $db->sql_query('UPDATE '._MESSAGE_TABLE.' SET active="0" WHERE mid="'.$mid.'"');
      }
    }
  }
}
$db->sql_freeresult($result);

?>