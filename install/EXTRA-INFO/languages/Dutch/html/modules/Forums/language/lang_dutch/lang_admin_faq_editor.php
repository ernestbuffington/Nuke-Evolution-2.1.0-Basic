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

$lang['faq_editor'] = 'Edit Taal';
$lang['faq_editor_explain'] = 'Deze module staat je toe om veranderen, aanpassen van je Bijlagen FAQ, BBCode, Board FAQ . Je <u>moet niet</u> de sectie genaamd <b>phpBB 2 Issues</b> verwijderen of veranderen.';

$lang['faq_select_language'] = 'Kies de taal van de file die je wilt aanpassen';
$lang['faq_retrieve'] = 'Haal File Op';

$lang['faq_block_delete'] = 'Weet je zeker dat je dit blok wilt verwijderen?';
$lang['faq_quest_delete'] = 'Weet je zeker dat je deze vraag (en zijn antwoord) wilt verwijderen?';

$lang['faq_quest_edit'] = 'Edit Vragen & Antwoord';
$lang['faq_quest_create'] = 'Maak Nieuwe Vraag & Antwoord';

$lang['faq_quest_edit_explain'] = 'Edit de vraag en antwoord. Verander het blok als je wilt.';
$lang['faq_quest_create_explain'] = 'Type de nieuwe vraag en antwoord en klik Verstuur.';

$lang['faq_block'] = 'Blok';
$lang['faq_quest'] = 'Vraag';
$lang['faq_answer'] = 'Antwoord';

$lang['faq_block_name'] = 'Blok Naam';
$lang['faq_block_rename'] = 'Geef blok andere naam';
$lang['faq_block_rename_explain'] = 'Verander de naam van een blok in de file';

$lang['faq_block_add'] = 'Blok Toevoegen';
$lang['faq_quest_add'] = 'Vraag Toevoegen';

$lang['faq_no_quests'] = 'Geen vragen in dit blok. Dit voorkomt elk blok(ken) na deze worden getoond. Verwijder het blok of voeg meer vragen toe.';
$lang['faq_no_blocks'] = 'Geen blokken gedefineerd. Voeg en nieuw blok toe door hieronder een naam te typen.';

$lang['faq_write_file'] = 'Kon niet schrijven naar de taal file!';
$lang['faq_write_file_explain'] = 'Je moet de taal file in language/lang_english/ of gelijkwaardig <i>schrijfbaar</i> maken om dit controle paneel te gebruiken. Op UNIX, betekent het dat je de <code>chmod 666 filename</code> moet draaien. Meeste FTP clients kunnen dat doen via properties sheet voor een file, anders kan je telnet of SSH gebruiken.';

?>