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

if (!defined('MODULE_FILE') && (!defined('ADMIN_FILE') && !defined('FORUM_ADMIN'))) {
    die('You can\'t access this file directly...');
}

if ( !defined('IN_PHPBB') ) {
    die("Hacking attempt");
}

$icones = array(
  array(
      'ind' => 1,
      'img' => 'images/icons/icon1.png',
      'alt' => 'icon_note',
      'auth'  => AUTH_ALL,
  ),
  array(
      'ind' => 2,
      'img' => 'images/icons/icon2.png',
      'alt' => 'icon_important',
      'auth'  => AUTH_ALL,
  ),
  array(
      'ind' => 3,
      'img' => 'images/icons/icon3.png',
      'alt' => 'icon_idea',
      'auth'  => AUTH_ALL,
  ),
  array(
      'ind' => 4,
      'img' => 'images/icons/icon4.png',
      'alt' => 'icon_warning',
      'auth'  => AUTH_ALL,
  ),
  array(
      'ind' => 5,
      'img' => 'images/icons/icon5.png',
      'alt' => 'icon_question',
      'auth'  => AUTH_ALL,
  ),
  array(
      'ind' => 6,
      'img' => 'images/icons/icon6.png',
      'alt' => 'icon_cool',
      'auth'  => AUTH_ALL,
  ),
  array(
      'ind' => 7,
      'img' => 'images/icons/icon7.png',
      'alt' => 'icon_funny',
      'auth'  => AUTH_ALL,
  ),
  array(
      'ind' => 8,
      'img' => 'images/icons/icon8.png',
      'alt' => 'icon_angry',
      'auth'  => AUTH_ALL,
  ),
  array(
      'ind' => 9,
      'img' => 'images/icons/icon9.png',
      'alt' => 'icon_sad',
      'auth'  => AUTH_ALL,
  ),
  array(
      'ind' => 10,
      'img' => 'images/icons/icon10.png',
      'alt' => 'icon_mocker',
      'auth'  => AUTH_ALL,
  ),
  array(
      'ind' => 11,
      'img' => 'images/icons/icon11.png',
      'alt' => 'icon_shocked',
      'auth'  => AUTH_ALL,
  ),
  array(
      'ind' => 12,
      'img' => 'images/icons/icon12.png',
      'alt' => 'icon_complicity',
      'auth'  => AUTH_ALL,
  ),
  array(
      'ind' => 13,
      'img' => 'images/icons/icon13.png',
      'alt' => 'icon_bad',
      'auth'  => AUTH_ALL,
  ),
  array(
      'ind' => 14,
      'img' => 'images/icons/icon14.png',
      'alt' => 'icon_great',
      'auth'  => AUTH_ALL,
  ),
  array(
      'ind' => 15,
      'img' => 'images/icons/icon15.png',
      'alt' => 'icon_disgusting',
      'auth'  => AUTH_ALL,
  ),
  array(
      'ind' => 16,
      'img' => 'images/icons/icon16.png',
      'alt' => 'icon_winner',
      'auth'  => AUTH_ALL,
  ),
  array(
      'ind' => 17,
      'img' => 'images/icons/icon17.png',
      'alt' => 'icon_impressed',
      'auth'  => AUTH_ALL,
  ),
  array(
      'ind' => 18,
      'img' => 'images/icons/icon18.png',
      'alt' => 'icon_roleplay',
      'auth'  => AUTH_ALL,
  ),
  array(
      'ind' => 19,
      'img' => 'images/icons/icon19.png',
      'alt' => 'icon_fight',
      'auth'  => AUTH_ALL,
  ),
  array(
      'ind' => 20,
      'img' => 'images/icons/icon20.png',
      'alt' => 'icon_loot',
      'auth'  => AUTH_ALL,
  ),
  array(
      'ind' => 21,
      'img' => 'images/icons/icon21.png',
      'alt' => 'icon_picture',
      'auth'  => AUTH_MOD,
  ),
  array(
      'ind' => 22,
      'img' => 'images/icons/icon22.png',
      'alt' => 'icon_calendar',
      'auth'  => AUTH_MOD,
  ),
  array(
      'ind' => 0,
      'img' => 'images/icons/icon_none.png',
      'alt' => 'icon_none',
      'auth'  => AUTH_ALL,
  ),
);

// definition of special topic
$icon_defined_special = array(
  'POST_ATTACHMENT' => array(
    'lang_key'  => 'Sort_Attachments',
    'icon'    => 0,
  ),
  'POST_PICTURE' => array(
    'lang_key'  => 'Pic_album',
    'icon'    => 0,
  ),
  'POST_CALENDAR' => array(
    'lang_key'  => 'Calendar',
    'icon'    => 0,
  ),
  'POST_BIRTHDAY' => array(
    'lang_key'  => 'Birthday',
    'icon'    => 0,
  ),
  'POST_GLOBAL_ANNOUNCE' => array(
    'lang_key'  => 'Post_Global_Announcement',
    'icon'    => 0,
  ),
  'POST_ANNOUNCE' => array(
    'lang_key'  => 'Post_Announcement',
    'icon'    => 0,
  ),
  'POST_STICKY' => array(
    'lang_key'  => 'Post_Sticky',
    'icon'    => 0,
  ),
  'POST_NORMAL' => array(
    'lang_key'  => 'Post_Normal',
    'icon'    => 0,
  ),
);

?>