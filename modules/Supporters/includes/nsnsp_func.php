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

function spsave_config($config_name, $config_value){
  global $db, $cache;
  $db->sql_query("UPDATE `"._NSNSP_CONFIG_TABLE."` SET `config_value`='$config_value' WHERE `config_name`='$config_name'");
  $cache->delete('supporters', 'config');
}

function spget_configs(){
  global $db, $cache;
  static $supporter_config;
  if(isset($supporter_config)) return $supporter_config;
  if(($supporter_config = $cache->load('supporters', 'config')) === false) {
      $configresult = $db->sql_query("SELECT `config_name`, `config_value` FROM `"._NSNSP_CONFIG_TABLE."`");
      while(list($config_name, $config_value) = $db->sql_fetchrow($configresult)) {
        $supporter_config[$config_name] = $config_value;
      }
      $db->sql_freeresult($configresult);
      $cache->save('supporters', 'config', $supporter_config);
  }
  return $supporter_config;
}

function spmenu() {
  global $admin_file, $lang_new, $module_name;
  OpenTable();
  echo "<center>\n<table cellpadding='3' width='70%'>\n";
  echo "<tr>\n";
  echo "<td align='center' valign='top' width='50%'>";
  echo "<a href='".$admin_file.".php?op=SPConfig'>".$lang_new[$module_name]['SP_CONFIGMAIN']."</a><br />";
  echo "<a href='".$admin_file.".php?op=SPAdd'>".$lang_new[$module_name]['SP_ADDSUPPORTER']."</a><br />";
  echo "</td>\n";
  echo "<td align='center' valign='top' width='50%'>";
  echo "<a href='".$admin_file.".php?op=SPActive'>".$lang_new[$module_name]['SP_ACTIVESITES']."</a><br />";
  echo "<a href='".$admin_file.".php?op=SPPending'>".$lang_new[$module_name]['SP_SUBMITTEDSITES']."</a><br />";
  echo "<a href='".$admin_file.".php?op=SPInactive'>".$lang_new[$module_name]['SP_INACTIVESITES']."</a><br />";
  echo "</td>\n";
  echo "</tr>\n";
  echo "</table>\n</center>\n";
  CloseTable();
}

?>