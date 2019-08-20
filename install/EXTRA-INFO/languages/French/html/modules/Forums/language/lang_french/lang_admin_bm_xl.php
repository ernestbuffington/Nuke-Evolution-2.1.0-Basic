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


//board msg MOD XL
$lang['Board_msg_xl'] = "Message de conseil XL";
$lang['Board_msg_xl_explain'] = "S&eacute;lectionnez le message de conseil que vous voulez changer.";

$lang['Bm_id'] = "id";
$lang['Bm_title'] = "Titre du message de conseil";
$lang['Bm_message'] = "Message de conseil";
$lang['Bm_showpage'] = "Sur quels pages le message doit &ecirc;tre affich&eacute;";
$lang['Bm_display'] = "L'affichage sur le message de conseil";
$lang['Bm_auth'] = 'Qui peut voir le message ?';
$lang['Bm_width'] = 'Largeur (%)';
$lang['Bm_width_explain'] = 'Entrer en % comment doit &ecirc;tre la largeur de la table';
$lang['Bm_startdate'] = 'Date de d&eacute;part';
$lang['Bm_enddate'] = 'Date de fin';
$lang['Bm_date_explain'] = '&Agrave; partir de quelle date et jusqu\'&agrave; cette date, le message doit &ecirc;tre affich&eacute; (conseil d\'administration date)';
$lang['Bm_images'] = 'Image';
$lang['Bm_images_explain'] = 'Entrez le nom du fichier image et le chemin (&agrave; partir du r&eacute;pertoire des images) de l\'image qui doit &ecirc;tre affich&eacute;. Laissez vide pour pas d`\'images.';
$lang['Bm_days'] = 'Jours';
$lang['Bm_days_explain'] = 'V&eacute;rifiez les jours o&ugrave; le message doit &ecirc;tre affich&eacute; (conseil d\'administration date)';
$lang['Bm_order'] = 'Ordre';
$lang['Bm_Add_New'] = "Ajouter un nouveau message"; 

$lang['Bm_off'] = 'Off';
$lang['Bm_all_pages'] = 'Toutes les pages';
$lang['Bm_index'] = 'Index';

$lang['Bm_mod'] = 'Mod&eacute;rateurs';
$lang['Bm_all_auth'] = 'Tout le monde';

$lang['Bm_updated'] = "Mise &agrave; jour du message de conseil.";
$lang['Click_return_bm'] ='Cliquez %sIci%s pour revenir au conseil d\'administration Message XL';
$lang['Bm_del_success'] = 'Message de conseil supprimer avec succ&egrave;s';

// Not in use right now, maybe later, maybe not
$lang['Bm_starttime'] = 'Heure pour';
$lang['Bm_endtime'] = 'Temps jusqu\'agrave; ce que';
$lang['Bm_time_explain'] = 'Entre le moment o&ugrave; le message doit &ecirc;tre affich&eacute; ?';
$lang['Bm_timezone'] = 'Fuseau horaire de l\'utilisateur';
$lang['Bm_timezone_explain'] = 'Quel fuseau horaire (utilisateurs ou du conseil d\'administration) doit &ecirc;tre utilis&eacute;e pour le calcul si le message est affich&eacute; ou non. Ne fait rien avec la date de d&eacute;part et la date de fin.';
$lang['Bm_back'] = 'Cliquez ici pour revenir en arri&egrave;re';

?>