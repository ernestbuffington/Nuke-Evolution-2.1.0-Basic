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

if (!defined('ADMIN_FILE') && !defined('FORUM_ADMIN')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

if (!defined('BOARD_CONFIG')) {
    die('Access Denied');
}

$template->set_filenames(array(
    'topic_view' => 'admin/board_config/board_topic_view.tpl')
);
global $new;

$locked_view_close      = $new['locked_view_close'];
$locked_view_open       = $new['locked_view_open'];
$sticky_view_open       =  $new['sticky_view_open'];
$sticky_view_close      =  $new['sticky_view_close'];
$global_view_open       =  $new['global_view_open'];
$global_view_close      =  $new['global_view_close'];
$announce_view_close    =  $new['announce_view_close'];
$announce_view_open     =  $new['announce_view_open'];
$moved_view_open        =  $new['moved_view_open'];
$moved_view_close       =  $new['moved_view_close'];

//General Template variables
$template->assign_vars(array(
    'DHTML_ID' => 'c' . $dhtml_id)
);

//Language Template variables
$template->assign_vars(array(
    'L_TOPIC_VIEW_SETTINGS' => $lang['topic_view_settings'],
    'L_TOPIC_EXPLAIN'       => $lang['topic_explain'],
    'L_MOVED'               => $lang['moved'],
    'L_LOCKED'              => $lang['locked'],
    'L_STICKY'              => $lang['sticky'],
    'L_GLOBAL'              => $lang['global'],
    'L_ANNOUNCE'            => $lang['announce'],
    'L_CURRENT'             => $lang['current'],
    'L_CURRENT_EXPLAIN'     => $lang['current_explain'],
    'L_TAG'                 => $lang['tag'],
    'L_TOPIC_TITLE'         => $lang['topic_title'],
));

//Data Template Variables
$template->assign_vars(array(
    'LOCKED_VIEW_OPEN'      => $new['locked_view_open'],
    'LOCKED_VIEW_CLOSE'     => $new['locked_view_close'],
    'LOCKED_CURRENT'        => $new['locked_view_open']. '&nbsp;' . $lang['locked'] .$new['locked_view_close'],
    'STICKY_VIEW_CLOSE'     => $new['sticky_view_close'],
    'STICKY_VIEW_OPEN'      => $new['sticky_view_open'],
    'STICKY_CURRENT'        => $new['sticky_view_open']. '&nbsp;' . $lang['sticky'] .$new['sticky_view_close'],
    'ANNOUNCE_VIEW_OPEN'    => $new['announce_view_open'],
    'ANNOUNCE_VIEW_CLOSE'   => $new['announce_view_close'],
    'ANNOUNCE_CURRENT'      => $new['announce_view_open']. '&nbsp;' . $lang['announce'] .$new['announce_view_close'],
    'GLOBAL_VIEW_CLOSE'     => $new['global_view_close'],
    'GLOBAL_VIEW_OPEN'      => $new['global_view_open'],
    'GLOBAL_CURRENT'        => $new['global_view_open']. '&nbsp;' . $lang['global'] .$new['global_view_close'],
    'MOVED_VIEW_OPEN'       => $new['moved_view_open'],
    'MOVED_VIEW_CLOSE'      => $new['moved_view_close'],
    'MOVED_CURRENT'         => $new['moved_view_open']. '&nbsp;' . $lang['moved'] .$new['moved_view_close'],


 ));
$template->pparse('topic_view');

?>