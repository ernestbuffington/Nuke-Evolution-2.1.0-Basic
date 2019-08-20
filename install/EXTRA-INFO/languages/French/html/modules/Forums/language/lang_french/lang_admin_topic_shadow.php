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

/* General */
$lang['Del_Before_Date'] = 'Suppression de tous les sujets cach&eacute;s avant %s<br />'; // %s = insertion of date
$lang['Deleted_Topic'] = 'Suppression du sujet cach&eacute; %s<br />'; // %s = topic name
$lang['Affected_Rows'] = '%d entr&eacute;es connues ont &eacute;t&eacute; affect&eacute;es<br />'; // %d = affected rows (not avail with all databases!)
$lang['Delete_From_Date'] = 'Tous les sujets cach&eacute;s cr&eacute;&eacute;s avant la date sp&eacute;cifi&eacute;e seront supprim&eacute;s.';
$lang['Delete_Before_Date_Button'] = 'Effacer tout avant la Date';
$lang['No_Shadow_Topics'] = 'Aucun sujet nuanc&eacute; n\'est &eacute;tabli.';
$lang['Topic_Shadow'] = 'Sujet nuanc&eacute;';
$lang['TS_Desc'] = 'Permet l\'enl&egrave;vement de sujets nuanc&eacute;s sans supprimer le message actuel. Les sujets nuanc&eacute;s sont cr&eacute;&eacute;s quand vous transf&eacute;rez un post vers un autre forum et choisissez de laisser un lien dans le forum original vers le nouveau post.';
$lang['Month'] = 'Mois';
$lang['Day'] = 'Jour';
$lang['Year'] = 'Ann&eacute;e';
$lang['Clear'] = 'Effacer';
$lang['Resync_Ran_On'] = 'Resync Ran On %s<br />'; // %s = insertion of forum name
$lang['All_Forums'] = 'Tous les Forums';
$lang['Version'] = 'Version';

$lang['Title'] = 'Titre';
$lang['Moved_To'] = 'D&eacute;placer vers';
$lang['Moved_From'] = 'D&eacute;plac&eacute; &agrave; partir';
$lang['Delete'] = 'Effacer';

//Modes
$lang['topic_time'] = 'Heure du Sujet';
$lang['topic_title'] = 'Titre du Sujet';

//Errors
$lang['Error_Month'] = 'Votre mois d\'entr&eacute;e doit &ecirc;tre entre le 1 et 12';
$lang['Error_Day'] = 'Votre jour d\'entr&eacute;e doit &ecirc;tre entre le 1 et 31';
$lang['Error_Year'] = 'Votre avv&eacute;e d\'entr&eacute;e doit &ecirc;tre entre 1970 et 2038';
$lang['Error_Topics_Table'] = 'Erreur d\'acc&egrave;s &agrave; la table des sujets';

//Special Cases, Do not change for another language
$lang['ASC'] = $lang['Sort_Ascending'];
$lang['DESC'] = $lang['Sort_Descending'];
$lang['Nivisec_Com'] = 'Nivisec.com';

?>
