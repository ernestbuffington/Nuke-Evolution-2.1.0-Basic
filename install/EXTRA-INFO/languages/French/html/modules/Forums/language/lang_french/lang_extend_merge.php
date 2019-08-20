<?php
/*=======================================================================
 Nuke-Evolution   :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :       #$#BASE
 Nuke-Evo Version       :       #$#VER
 Nuke-Evo Build         :       #$#BUILD
 Nuke-Evo Patch         :       #$#PATCH
 Nuke-Evo Filename      :       #$#FILENAME
 Nuke-Evo Date          :       #$#DATE

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

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_merge'] = 'Simple fusion des fils de discussion';
}

$lang['Refresh'] = 'Rafraichir';
$lang['Merge_topics'] = 'Fusionner les sujets';
$lang['Merge_title'] = 'Nouveau titre de sujet';
$lang['Merge_title_explain'] = 'Ceci sera le nouveaux titre du futur sujet. Laissez-le blanc si vous d&eacute;sirez que le syst&egrave;me utilise le titre du sujet de destination.';
$lang['Merge_topic_from'] = 'Sujet &agrave; fusionner';
$lang['Merge_topic_from_explain'] = 'Ce sujet va &ecirc;tre fusionner vers un autre sujet. Vous pouvez enter l\'id du sujet, ou l\'url d\'un post dans ce sujet';
$lang['Merge_topic_to'] = 'Sujet de destination';
$lang['Merge_topic_to_explain'] = 'Ce sujet va prendre tous les sujets pr&eacute;c&eacute;dents. Vous pouver entrer l\'id du sujet, l\'url du sujet ou l\'url d\'un post dans ce sujet.';
$lang['Merge_from_not_found'] = 'Le sujet &agrave; fusionner n\'a pas &eacute;t&eacute; trouv&eacute;.';
$lang['Merge_to_not_found'] = 'Le sujet de destination n\'a pas &eacute;t&eacute; trouv&eacute;';
$lang['Merge_topics_equals'] = 'Vous ne pouvez pas fusionner un sujet avec lui-m&ecirc;me';
$lang['Merge_from_not_authorized'] = 'Vous n\'&ecirc;tes pas autoris&eacute; &agrave; mod&eacute;rer les sujets venant du forum du sujet &agrave; fusionner';
$lang['Merge_to_not_authorized'] =  'Vous n\'&ecirc;tes pas autoris&eacute; &agrave; mod&eacute;rer les sujets venant du forum du sujet de destination';
$lang['Merge_poll_from'] = 'Il y a un sondage dans le sujet &agrave; fusionner. Il sera copi&eacute; dans le sujet de destination';
$lang['Merge_poll_from_and_to'] = 'Le sujet de destination a d&eacute;j&agrave; un sondage. Le sondage du sujet &agrave; fusionner sera supprim&eacute;';
$lang['Merge_confirm_process'] = 'Etes vous s&ucirc;r de vouloir fusionner<br />"<b>%s</b>"<br />vers<br />"<b>%s</b>"';
$lang['Merge_topic_done'] = 'Les sujets ont &eacute;t&eacute; fusionn&eacute;s avec succ&egrave;s';

?>