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


// Here go the deprecated functions

$mainfile = true;
$nukeuser = (isset($_COOKIE['user'])) ? explode(':', addslashes(base64_decode($_COOKIE['user']))) : '';

require_once(NUKE_INCLUDE_DIR.'sql_layer.php');

function is_group($user, $name) {
  global $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
}

function update_points($id){
  global $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
}

function public_message(){
  global $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
}

function stripos_clone($haystack, $needle, $offset=0) {
  global $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return stristr($haystack, $needle);
}

function formatAidHeader($aid) {
  global $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  echo get_author($aid);
}

function FixQuotes($what = '') {
  global $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  $what = Fix_Quotes($what);
  return $what;
}

function selectlanguage() {
  global $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return;
}

function userblock() {
  global $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return;
}

function loginbox() {
  global $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return;
}

function adminblock() {
  global $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return;
}

function delQuotes($string) {
  global $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return $string;
}

function getusrinfo($trash=0, $force=false) {
  global $userinfo, $debugger;
  return $userinfo;
}

?>