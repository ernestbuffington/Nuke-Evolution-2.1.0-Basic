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

if (!defined('NUKE_EVO')) {
    die("You can't access this file directly...");
}

if(!defined("SQL_LAYER")) {
  require_once(NUKE_DB_DIR."db.php");
}

function sql_logout($id)
{
  global $db, $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return $db->sql_close($id);
}

function sql_query($query, $id="")
{
  global $db, $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return $db->sql_query($query);
}

function sql_num_rows($res)
{
  global $db, $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return $db->sql_numrows($res);
}

function sql_fetch_row(&$res, $nr=0)
{
  global $db, $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return $db->sql_fetchrow($res);
}

function sql_fetch_array(&$res, $nr=0)
{
  global $db, $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return $db->sql_fetchrow($res);
}

function sql_fetch_object(&$res, $nr=0) {
  global $db, $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return;
}

function sql_free_result($res) {
  global $db, $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return $db->sql_freeresult($res);
}

?>