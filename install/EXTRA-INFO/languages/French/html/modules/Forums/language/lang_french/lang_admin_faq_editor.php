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

$lang['faq_editor'] = 'FAQ Editeur';
$lang['faq_editor_explain'] = 'Ce module vous permet d\'&eacute;diter et de modifier vos FAQ. Vous <u>ne devez pas</u> enlever ou changer les sections existantes <b>Issues phpBB 2</b>.';

$lang['faq_select_language'] = 'Choisissez la langue dans laquelle vous voulez &eacute;diter vos FAQ';
$lang['faq_retrieve'] = 'Rechercher une FAQ';

$lang['faq_block_delete'] = 'Etes vous sur de vouloir effacer ce bloc?';
$lang['faq_quest_delete'] = 'Etes vous sur de vouloir effacer cette question (et ces r&eacute;ponses)?';

$lang['faq_quest_edit'] = 'Editer la Question & la r&eacute;ponse';
$lang['faq_quest_create'] = 'Cr&eacute;er une Nouvelle Question & R&eacute;ponse';

$lang['faq_quest_edit_explain'] = 'Editer la question et la r&eacute;ponse. Changer le bloc si vous le d&eacute;sirez.';
$lang['faq_quest_create_explain'] = 'R&eacute;digez la nouvelle question et la r&eacute;ponse et cliquez sur soumettre.';

$lang['faq_block'] = 'Bloc';
$lang['faq_quest'] = 'Question';
$lang['faq_answer'] = 'R&eacute;ponse';

$lang['faq_block_name'] = 'Nom du Bloc';
$lang['faq_block_rename'] = 'Renommer le Bloc';
$lang['faq_block_rename_explain'] = 'Changer le nom du bloc dans la FAQ';

$lang['faq_block_add'] = 'Ajouter un Bloc';
$lang['faq_quest_add'] = 'Ajouter une Question';

$lang['faq_no_quests'] = 'Pas de questions dans ce bloc. Ceci emp&ecirc;chera tous les blocs suivants de s\'afficher.  Supprimez ce bloc ou ajoutez une ou plusieurs questions &agrave; l\'int&eacute;rieur.';
$lang['faq_no_blocks'] = 'Pas de bloc d&eacute;fini. Ajoutez un nouveau bloc en &eacute;crivant son nom ci-dessous.';

$lang['faq_write_file'] = 'N\'a pu &ecirc;tre &eacute;crit dans le fichier langage!';
$lang['faq_write_file_explain'] = 'Vous devez faire le fichier langage dans language/lang_french/ ou &eacute;quivalent <i>en permission d\'&eacute;criture</i> en utilisant votre panel administration. Sur UNIX, mettre le <code>nom du fichier en chmod 666</code>. Vous pouvez le faire par l\'interm&eacute;diaire de votre client Ftp, ou autrement vous pouvez utiliser telnet ou SSH.';
?>