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

// Edit/Add words
$lang['Add_success'] = 'Feld erfolgreich hinzugef&uuml;gt';
$lang['Advanced_Options'] = 'Erweiterte Optionen';
$lang['Advanced_warning'] = 'Hier nichts &auml;ndern ausser Du weisst was du machst.';
$lang['Allow_BBCode'] = 'BBCode zulassen';
$lang['Allow_html'] = 'HTML zulassen';
$lang['Allow_smilies'] = 'Smilies zulassen';
$lang['Basic_Options'] = 'Basisoptionen';
$lang['Checkbox'] = 'Checkbox';
$lang['Click_return_fields'] = '%sHier klicken%s, um zur Feld-Administration zur&uuml;ck zu gehen';
$lang['Code_name'] = 'Name im Templates';
$lang['Code_name_explain'] = 'Wenn ein oben angef&uuml;hrter Typ auf "TPL Variable" gesetzt ist, ist das der Name der Variable deren Daten festgesetzt sind.';
$lang['Custom'] = 'Mitglied';
$lang['Date'] = 'Datum';
$lang['Default_auth'] = 'Standard Zulassung';
$lang['Default_auth_explain'] = 'Benutzer k&ouml;nnen dieses Feld in ihren Profilen nur bearbeiten, wenn diese Option oder ihre pers&ouml;nliche Zugangskontrolle auf "Zulassen" gestetzt ist.';
$lang['Delete_success'] = 'Feld erfolgreich gel&ouml;scht';
$lang['Display_none'] = 'Kein';
$lang['Display_normal'] = 'Normal';
$lang['Display_register_explain'] = 'Wenn Profile bearbeitet werden';
$lang['Display_root'] = 'TPL Variable';
$lang['Display_type'] = 'Typ zeigen';
$lang['Display_viewprofile_explain'] = 'Wenn Profile angeschaut werden';
$lang['Display_viewtopic_explain'] = 'Wenn Beitr&auml;ge angeschaut werden';
$lang['Edit_success'] = 'Feldinformationen erfolgreich aktualisiert';
$lang['Length'] = 'L&auml;nge';
$lang['Length_explain'] = 'Die maximale L&auml;nge f&uuml;r einen Text oder Textbereich.  Null ist unlimitiert.';
$lang['Name'] = 'Name';
$lang['Radio'] = 'Radio Felder';
$lang['Regexp'] = 'regul&auml;rer Ausdruck';
$lang['Regexp_error'] = 'Du hast einen Fehler in der regul&auml;ren Ausdruck Syntax:';
$lang['Regexp_explain'] = 'Es sind nur Werte erlaubt, die dem regul&auml;ren Ausdruck entsprechen. (PCRE-Style)';
$lang['Select'] = 'Auswahlbox';
$lang['Signup'] = 'Anzeigen w&auml;hrend der Anmeldung';
$lang['Text'] = 'Text';
$lang['Text_area'] = 'Text Bereich';
$lang['Values'] = 'Werte';
$lang['Values_explain'] = 'Die Optionen die f&uuml;r ein Auswahlfeld oder Radio Feld erscheinen.  Jede Option sollte mit einem einzigen Quote eingefasst sein [\'].';
$lang['Viewtopic'] = 'Anzeigen wenn Themen angeschaut werden';
$lang['add_xdata_field'] = 'Profilfeld hinzuf&uuml;gen';
$lang['custom'] = 'Benutzerdefiniert';
$lang['edit_xdata_field'] = 'Profilfeld bearbeiten';
$lang['handle_input'] = 'Handle Input';
$lang['handle_input_explain'] = 'W&auml;hle "Ja", es sei denn Du willst Deinen eigenen Input Handler f&uuml;r dieses Feld erstellen.';
$lang['letters'] = 'Nur Buchstaben';
$lang['manditory'] = 'Muss-Feld';
$lang['none'] = 'Keine';
$lang['numbers'] = 'Nur Zahlen';
$lang['type'] = 'Typ';
$lang['xd_description'] = 'Beschreibung';
// Delete words
$lang['Are_you_sure'] = 'Bist Du sicher, dass Du das Feld  "%s" l&ouml;schen willst?';
$lang['Confirm'] = 'Best&auml;tigen';
// Error
$lang['XD_duplicate_name'] = 'Ein Feld mit dem gew&auml;hlten Template Namen exisitiert bereits .';
// Main Menu words
$lang['Add_field'] = 'Neues Feld hinzuf&uuml;gen';
$lang['Delete_field'] = 'L&ouml;schen';
$lang['Edit_field'] = 'Bearbeiten';
$lang['No_fields'] = 'Keine Felder existieren';
$lang['Profile_admin'] = 'Profilfelder Administration';
$lang['Xdata_view_description'] = 'Hier kannst Du die extra Felder, verf&uuml;gbar in den Profilen der Benutzer, anschauen und bearbeiten.';
$lang['xd_move'] = 'Verschieben';
$lang['xd_move_down'] = 'Abw&auml;rts';
$lang['xd_move_up'] = 'Aufw&auml;rts';
$lang['xd_operations'] = 'Operationen';
// Permissions words
$lang['Allow'] = 'Zulassen';
$lang['Default'] = 'Standard';
$lang['Deny'] = 'Verweigern';
$lang['field_name'] = 'Feld Name';
$lang['xd_group_permissions'] = 'XDATA Gruppenberechtigungen';
$lang['xd_group_permissions_describe'] = 'Hier &auml;nderst Du die Berechtigungen f&uuml;r Gruppen, welche mitgliederspezifischen Felder ausgef&uuml;llt werden k&ouml;nnen.';
$lang['xd_permissions'] = 'XData Benutzerberechtigungen';
$lang['xd_permissions_describe'] = 'Hier &auml;nderst Du die Berechtigungen f&uuml;r Benutzer, welche mitgliederspezifischen Felder ausgef&uuml;llt werden k&ouml;nnen.';

?>