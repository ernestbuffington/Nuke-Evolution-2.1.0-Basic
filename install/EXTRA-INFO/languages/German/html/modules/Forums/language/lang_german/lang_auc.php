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

//
// Admin Panel - Common
//
$lang['error']                      = 'Fehler';
$lang['information']                = 'Information';
$lang['success']                    = 'Erfolgreich';
//
// Message Die's  - Config Panel
//
$lang['Return_to_config']           = 'zur&uuml;ck zu %sAUC Config%s';
$lang['Return_to_management']       = 'zur&uuml;ck zu %sAUC Management%s';
$lang['add_error']                  = 'Beide Felder sind erforderlich f&uuml;r eine neue Gruppenfarbe.';
$lang['add_error_2']                = 'Diese Farbgruppe existiert bereits.';
$lang['add_error_3']                = 'HTML Farben haben 6 Ziffern.';
$lang['add_success']                = 'Farbinformation gespeichert.';
$lang['delete_error']               = 'Bitte eine Farbe zum L&ouml;schen ausw&auml;hlen.';
$lang['delete_success']             = 'Die Farbgruppe wurde gel&ouml;scht. Mitglieder mit dieser Farbe wurden zur&uuml;ckgesetzt.';
$lang['edit_error']                 = 'Bitte zuerst einen Farbgruppennamen zur Bearbeitung w&auml;hlen.';
$lang['save_error']                 = 'Beide Felder sind erforderlich um eine Farbgruppe zu bearbeiten.';
$lang['save_error_1']               = 'Dieser Farbgruppenname wird bereits verwendet.';
//
// Management Panel
//
$lang['choose_user_id_error']       = 'Wenn du ein Mitglied manuell hinzuf&uuml;gen willst musst du seinen Benutzernamen angeben, <strong>nicht</strong> die Benutzerid.';
$lang['group_delete_user_2']        = 'Benutzerfarbe aktualisiert.';
//
// Config Panel
//
$lang['add_new_color']              = 'Neue Farbe hinzuf&uuml;gen';
$lang['add_new_color_1']            = 'Farbgruppenname<br /><span class="gensmall">Beispiel: Support Team</span>';
$lang['add_new_color_2']            = 'Farbgruppenfarbe<br /><span class="gensmall">Beispiel: FFFFFF, Benutze HTML Farbcodes.</span>';
$lang['add_new_color_3']            = ' Diese hinzuf&uuml;gen ';
$lang['admin_main_header_c']        = 'Advanced Username Color: Konfiguration';
$lang['admin_main_header_m']        = 'Advanced Username Color: Verwaltung';
$lang['delete_color']               = 'Eine Farbgruppe l&ouml;schen';
$lang['delete_color_1']             = 'W&auml;hle eine zu l&ouml;schende Farbgruppe<br /><span class="gensmall">Warnung: Dies entfernt auch alle Mitglieder aus dieser Farbgruppe.</span>';
$lang['delete_color_2']             = 'L&ouml;schoptionen';
$lang['delete_color_3']             = ' Farbgruppe l&ouml;schen ';
$lang['edit_color']                 = 'Vorhandene Farbgruppe bearbeiten';
$lang['edit_color_1']               = 'Alle Gruppen sind aufgelistet.';
$lang['edit_color_2']               = 'W&auml;hle eine';
$lang['edit_color_3']               = ' Diese bearbeiten ';
$lang['editing_color']              = '&Auml;nderbare Informationen unten';
$lang['editing_color_1']            = 'Farbgruppennamen &auml;ndern';
$lang['editing_color_2']            = 'Farbgruppenfarbe &auml;ndern<br /><span class="gensmall">Beispiel: FFFFFF, Benutze HTML Farbcodes.</span>';
$lang['editing_color_3']            = ' Diese speichern ';
$lang['move_down']                  = 'Nach unten';
$lang['move_up']                    = 'Nach oben';
$lang['view_group_colors']          = 'Farbgruppen HTML-Farbe';
$lang['view_group_colors_2']        = 'Beispiel';
$lang['view_group_colors_3']        = 'Benutzernamen-Farbe';
$lang['view_group_names']           = 'Farbgruppentitel';
//
// Management Panel
//
$lang['choose_group']               = 'W&auml;hle eine zu verwaltende Farbgruppe<br />Bitte beachte das die Farbgruppe nichts mit den Benutzerberechtigungen zu tun hat<br /> sondern ausschliesslich der farblichen Kennzeichnung verschiedener Benutzergruppen dient';
$lang['choose_group_2']             = 'Vorhandene Farbgruppen, zu denen Mitglieder hinzugef&uuml;gt oder entfernt werden k&ouml;nnen';
$lang['choose_group_3']             = 'W&auml;hle eine';
$lang['choose_group_4']             = ' Gruppe w&auml;hlen ';
$lang['group_already_assigned']     = 'Mitglieder, die bereits in dieser Farbgruppe sind';
$lang['group_assign']               = 'Ein Mitglied aus der Mitgliederliste in diese Farbgruppe aufnehmen';
$lang['group_assign_1']             = ' Zur Farbgruppe hinzuf&uuml;gen ';
$lang['group_assign_2']             = 'Mehrere Mitglieder in diese Farbgruppe aufnehmen. Dabei muss f&uuml;r jedes Mitglied eine separate Zeile verwendet werden.';
$lang['group_delete_user']          = 'Ein Mitglied aus dieser Farbgruppe entfernen';
$lang['group_delete_user_1']        = ' Mitglied entfernen ';
$lang['group_selected']             = 'Bearbeiten der Farbgruppe: <strong>%G%</strong>';
$lang['group_user_added']           = 'Benutzerdaten aktualisiert.';
//
// Listing Page
//
$lang['added_to_group']             = 'zur Farbgruppe hinzugef&uuml;gt';
$lang['changed_user_color']         = 'Farbe ge&auml;ndert';
$lang['deleted_from_group']         = 'aus der Farbgruppe gel&ouml;scht';
$lang['goup_group']                 = 'Eine Forengruppe zu dieser Farbgruppe hinzuf&uuml;gen';
$lang['listing_left']               = 'Mitglied';
$lang['listing_none']               = 'Es sind derzeit keine Mitglieder in der Farbgruppe %s.';
$lang['listing_right']              = 'Benutzerinfo';

?>