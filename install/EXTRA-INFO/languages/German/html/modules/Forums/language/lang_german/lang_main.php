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

global $new_username, $board_config, $activate_link;

$lang['DATE_FORMAT'] =  'd.m.Y'; // This should be changed to the default date format for your language, php date() format
$lang['DIRECTION'] = 'ltr';
$lang['ENCODING'] = 'UTF-8';
$lang['LEFT'] = 'links';
$lang['RIGHT'] = 'rechts';
//
// Auth related entries
//
// Note the %s will be replaced with one of the following 'user' arrays 
$lang['Sorry_auth_announce'] = 'Ank&uuml;ndigungen k&ouml;nnen in diesem Forum nur von %s erstellt werden.';
$lang['Sorry_auth_delete'] = 'Nur %s haben die Berechtigung, in diesem Forum Beitr&auml;ge zu l&ouml;schen.';
$lang['Sorry_auth_edit'] = 'Nur %s haben die Berechtigung, in diesem Forum Beitr&auml;ge zu bearbeiten.';
$lang['Sorry_auth_post'] = 'Nur %s haben die Berechtigung, in diesem Forum Beitr&auml;ge zu erstellen.';
$lang['Sorry_auth_read'] = 'Nur %s haben die Berechtigung, in diesem Forum Beitr&auml;ge zu lesen.';
$lang['Sorry_auth_reply'] = 'Nur %s haben die Berechtigung, in diesem Forum auf Beitr&auml;ge zu antworten.';
$lang['Sorry_auth_sticky'] = 'Wichtige Nachrichten k&ouml;nnen in diesem Forum nur von %s erstellt werden.';
$lang['Sorry_auth_vote'] = 'In diesem Forum k&ouml;nnen sich nur %s an Abstimmungen beteiligen.';
// These replace the %s in the above strings
$lang['Auth_Administrators'] = '<strong>Administratoren</strong>';
$lang['Auth_Anonymous_Users'] = '<strong>G&auml;ste</strong>';
$lang['Auth_Moderators'] = '<strong>Moderatoren</strong>';
$lang['Auth_Registered_Users'] = '<strong>Mitglieder</strong>';
$lang['Auth_Users_granted_access'] = '<strong>Benutzer mit speziellen Rechten</strong>';
$lang['Not_Authorised'] = 'Nicht berechtigt';
$lang['Not_Moderator'] = 'Du bist kein Moderator dieses Forums.';
$lang['You_been_banned'] = 'Du wurdest von diesem Forum verbannt.<br />Kontaktiere den Administrator, um mehr Informationen zu erhalten.';
//
// Common, these terms are used extensively on several pages
//
$lang['1_Day'] = '1 Tag';
$lang['1_Month'] = '1 Monat';
$lang['1_Year'] = '1 Jahr';
$lang['2_Weeks'] = '2 Wochen';
$lang['3_Months'] = '3 Monate';
$lang['6_Months'] = '6 Monate';
$lang['7_Days'] = '7 Tage';
$lang['AIM'] = 'AIM-Name';
$lang['Admin_panel'] = 'Administrations-Bereich';
$lang['Author'] = 'Autor';
$lang['Board_disable'] = 'Sorry, aber dieses Board ist im Moment nicht verf&uuml;gbar. Probier es bitte sp&auml;ter wieder.';
$lang['Cancel'] = 'Abbrechen';
$lang['Category'] = 'Kategorie';
$lang['Click_return_forum'] = '%sHier klicken%s, um zum Forum zur&uuml;ckzukehren';
$lang['Click_return_group'] = '%sHier klicken%s, um zur Gruppeninfo zur&uuml;ckzukehren';
$lang['Click_return_login'] = '%sHier klicken%s, um es noch einmal zu versuchen';
$lang['Click_return_modcp'] = '%sHier klicken%s, um zur Moderatorenkontrolle zur&uuml;ckzukehren';
$lang['Click_return_topic'] = '%sHier klicken%s, um zum Thema zur&uuml;ckzukehren'; // %s's here are for uris, do not remove!
$lang['Click_view_message'] = '%sHier klicken%s, um Deine Nachricht anzuzeigen';
$lang['Confirm'] = 'Best&auml;tigen';
$lang['Could_not_insert_for'] = 'Kann folgende Daten nicht einf&uuml;gen %d f&uuml;r %d';
$lang['Could_not_optain_for'] = 'Kann auf folgende Daten nicht zugreifen %d f&uuml;r %d';
$lang['Could_not_update'] = 'Kann die Tabelle %d nicht updaten';
$lang['Disabled'] = 'Deaktiviert';
$lang['Email'] = 'eMail';
$lang['Enabled'] = 'Aktiviert';
$lang['Error'] = 'Fehler';
$lang['Forum'] = 'Forum';
$lang['Forum_Index'] = '%s Foren-&Uuml;bersicht';  // eg. sitename Forum Index, %s can be removed if you prefer
$lang['Go'] = 'Los';
$lang['Goto_page'] = 'Gehe zu Seite';
$lang['Hours'] = 'Stunden';
$lang['ICQ'] = 'ICQ-Nummer';
$lang['IP_Address'] = 'IP-Adresse';
$lang['Joined'] = 'Dabei seit';
$lang['Jump_to'] = 'Gehe zu';
$lang['MSNM'] = 'MSN Messenger';
$lang['Message'] = 'Nachricht';
$lang['Next'] = 'Weiter';
$lang['No'] = 'Nein';
$lang['Page_of'] = 'Seite <strong>%d</strong> von <strong>%d</strong>'; // Replaces with: Page 1 of 2 for example
$lang['Password'] = 'Kennwort';
$lang['Post'] = 'Beitrag';
$lang['Post_new_topic'] = 'Neues Thema er&ouml;ffnen';
$lang['Posted'] = 'Verfasst am';
$lang['Poster'] = 'Poster';
$lang['Posts'] = 'Beitr&auml;ge';
$lang['Preview'] = 'Vorschau';
$lang['Previous'] = 'Zur&uuml;ck';
$lang['Replies'] = 'Antworten';
$lang['Reply_to_topic'] = 'Neue Antwort erstellen';
$lang['Reply_with_quote'] = 'Antworten mit Zitat';
$lang['Reset'] = 'Zur&uuml;cksetzen';
$lang['Select_forum'] = 'Forum ausw&auml;hlen';
$lang['Select_username'] = 'W&auml;hle einen Benutzernamen';
$lang['Spellcheck'] = 'Rechtschreibpr&uuml;fung';
$lang['Submit'] = 'Absenden';
$lang['Time'] = 'Zeit';
$lang['Topic'] = 'Thema';
$lang['Topics'] = 'Themen';
$lang['Username'] = 'Benutzername';
$lang['View_latest_post'] = 'Letzten Beitrag anzeigen';
$lang['View_newest_post'] = 'Neuesten Beitrag anzeigen';
$lang['Views'] = 'Aufrufe';
$lang['YIM'] = 'Yahoo Messenger';
$lang['Yes'] = 'Ja';
//
// Email-Extention
//
$lang['HELLO'] = 'Hallo';
$lang['NEW_ACCOUNT_OBJECT'] = "das Konto von $new_username wurde deaktiviert oder neu erstellt. Pr&auml;fe (falls n&ouml;tig) die Eigenschaften dieses Benutzers und aktiviere das Konto ggf. &uuml;ber folgenden Link:";
$lang['NEW_ACCOUNT_ACTIVATE_LINK'] = 'Link: <a href="'. $activate_link . '>'. $activate_link .'</a>';
$lang['REACTIVATE_ACCOUNT_OBJECT'] = 'Dein Konto auf '. $board_config['sitename'] .' wurde deaktiviert. Dies ist h&ouml;chstwahrscheinlich die Folge von &Auml;nderungen in Deinem Profil.<br />Zum Reaktivieren Deines Kontos folge bitte folgendem Link:';
$lang['REACTIVATE_ACCOUNT_ACTIVATE_LINK'] = 'Link: <a href="'. $activate_link . '>'. $activate_link .'</a>';
//
// Errors (not related to a specific failure on a page)
//
$lang['A_critical_error'] = 'Ein kritischer Fehler ist aufgetreten.';
$lang['Action'] = 'Aktion';
$lang['Admin'] = "Administrator";
$lang['Admin_reauthenticate'] = 'Um das Board zu administrieren, musst Du Dich re-authentifizieren.';
$lang['All'] = 'Alle';
$lang['An_error_occured'] = 'Ein Fehler ist aufgetreten.';
$lang['Announcements'] = 'Ank&uuml;ndigungen';
$lang['BBCode_box_hidden'] = 'Versteckt';
$lang['BBcode_box_hide'] = 'Klicke um den Inhalt zu verbergen';
$lang['BBcode_box_view'] = 'Klicke um den Inhalt zu zeigen';
$lang['Board_Currently_Disabled'] = 'Board ist derzeit deaktiviert';
$lang['Click_return_reports'] = '%sHier klicken%s, um zur &Uuml;bersicht der Beitragsmeldungen zur&uuml;ck zu gelangen.';
$lang['Close'] = 'Schliessen';
$lang['Close_success'] = 'Beitragsmeldungen wurden erfolgreich ge&ouml;ffnet/geschlossen.'; 
$lang['Close_window'] = 'Fenster schliessen';
$lang['Closed'] = 'Geschlossen';
$lang['Closed_by_user_on_date'] = 'Geschlossen von %s am %s';
$lang['Comments'] = 'Kommentare';
$lang['Comments_explain'] = 'Bitte schreibe einen kurzen Kommetar &uuml;ber Deine Meldung zu diesem speziellen Beitrag.';
$lang['Contract'] = "Zuklappen";
$lang['Critical_Error'] = 'Kritischer Fehler';
$lang['Critical_Information'] = 'Kritische Information';
$lang['Delete_Explication'] = 'Wenn ein Moderator/Administrator ein Thema l&ouml;scht, wird es nicht mehr l&auml;nger im Forum angezeigt und niemand kann es wieder herstellen. <br /><strong>Vorsicht mit dieser Funktion</strong>';
$lang['Delete_success'] = 'Beitragsmeldungen wurden erfolgreich gel&ouml;scht.'; 
$lang['Deleting_topic'] = 'L&ouml;sche ein Thema';
$lang['Display'] = 'Zeige nur';
$lang['Edit_Explication'] = 'Durch das Bearbeiten eines Beitrags kann ein Administrator und/oder ein Moderator ab&auml;ndern, was ein Benutzer im Beitrag geschrieben hat.';
$lang['Editing_topic'] = 'Bearbeite ein Thema';
$lang['Emails_Allowed_For_Registered_Only'] = 'Bitte anmelden um diese eMail zu sehen';
$lang['Enter_Forum'] = '%sbetritt%s das Forum!';
$lang['Error_Check_Num'] = "Ung&uuml;ltige Checknummer<br /><br />Du musst Dich erneut registrieren<br /><br /><a href=\"%s\">Klicke hier</a> zum Registrieren";
$lang['Expand'] = "Aufklappen";
$lang['Extra_Info'] = 'Extra Info';
$lang['Forum_advanced_search'] = '%s erweiterte Suche';
$lang['Forums'] = 'Foren';
$lang['GVideo_link'] = 'Link';
$lang['General_Error'] = 'Allgemeiner Fehler';
$lang['Get_Registered'] = 'Bitte %sregistrieren%s oder ';
$lang['Global_Announcements'] = 'Globale Ank&uuml;ndigungen';
$lang['Hidden'] = 'Versteckt';
$lang['Image_Blocked'] = 'Du hast gew&auml;hlt Bilder zu blockieren.<br />%sBearbeite Dein Profil%s';
$lang['Images_Allowed_For_Registered_Only'] = 'Bitte anmelden um das Bild zu sehen.';
$lang['Information'] = 'Information';
$lang['Junior'] = "Junior Admin";
$lang['Last_action_checkbox'] = 'Diese Aktion wurde durch die Checkbox und dem Drop Down Men&uuml; gemacht.';
$lang['Last_action_comments'] = 'Kommentare von Moderatoren';
$lang['Last_action_comments_explain'] = 'Bitte schreibe einen kurzen Kommentar warum Du diesen Beitrag meldest'; 
$lang['Links_Allowed_For_Registered_Only'] = 'Bitte anmelden um diesen Link zu sehen';
$lang['Lock_Explication'] = 'Wenn einModerator/Administrator ein Thema sperrt, kann ein normaler Benutzer nicht mehr antworten. Aber Moderatoren/Administratoren k&ouml;nnen weiterhin schreiben.';
$lang['Locking_topic'] = 'Sperre ein Thema';
$lang['Login_Logout'] = 'Anmelden / Abmelden';
$lang['Look_up_User'] = 'Mitglied suchen';
$lang['Max_smilies_per_post'] = 'Du kannst maximal %s Smilies pro Beitrag verwenden.<br />Du hast %s Smilies zu viel in Verwendung.';
$lang['Messenger'] = 'Messenger';
$lang['Mini_Index'] = 'Forenindex';
$lang['Mod'] = "Moderator";
$lang['Move_Explication'] = 'Wenn Du ein Thema verschieben willst, hast Du die M&ouml;glichkeit ein Thema, welches im Forum A ist, ins Forum B zu senden. Du hast auch die M&ouml;glichkeit ein Shadow Topic im Forum A zu behalten.';
$lang['Move_edit_message'] = 'ge&auml;ndert am: <strong>%s</strong> durch <strong>%s</strong>';
$lang['Move_lock_message'] = 'gesperrt: <strong>%s</strong> durch <strong>%s</strong>';
$lang['Move_merge_message'] = 'verbunden: <strong>%s</strong> durch <strong>%s</strong><br />vom Thema <strong>%s</strong> (<strong>%s</strong>)';
$lang['Move_move_message'] = 'verschoben: <strong>%s</strong> durch <strong>%s</strong><br />von <strong>%s</strong> nach <strong>%s</strong>';
$lang['Move_split_message'] = 'geteilt: <strong>%s</strong> durch <strong>%s</strong><br />vom Thema <strong>%s</strong> (<strong>%s</strong>)';
$lang['Move_unlock_message'] = 'entsperrt: <strong>%s</strong> durch <strong>%s</strong>';
$lang['Moving_topic'] = 'Verschiebe ein Thema';
$lang['Newsletter'] = 'Newsletter per eMail erhalten?';
$lang['No_action_specified'] = 'Es ist keine Aktion spezifiziert';
$lang['No_newer_posts'] = 'Es gibt keine neueren Beitr&auml;ge in diesem Forum';
$lang['No_older_posts'] = 'Es gibt keine &auml;lteren Beitr&auml;ge in diesem Forum';
$lang['Non_existent_posts'] = '%s gefundene(r) und gel&ouml;schte(r) Beitragsmeldung(en) die auf nicht existierende (gel&ouml;schte) Beitr&auml;ge zeigen';
$lang['Offline'] = 'Offline';
$lang['Online'] = 'Online';
$lang['Online_status'] = 'Status';
$lang['Open'] = '&Ouml;ffnen';
$lang['Open_quick_reply'] = 'automatisches &Ouml;ffnen des Schnellantwort Formulars';
$lang['Opened'] = 'Offen';
$lang['Opened_by_user_on_date'] = 'Ge&ouml;ffnet von %s am %s';
$lang['Opt_in'] = 'eMail Benachrichtigung f&uuml;r Beitragsmeldung aktivieren';
$lang['Opt_out'] = 'eMail Benachrichtigung f&uuml;r Beitragsmeldung deaktivieren';
$lang['Opt_success'] = ' eMail Benachrichtigung erfolgreich deaktiviert/aktiviert.'; 
$lang['Period'] = 'seit <strong>%d</strong> Tagen'; // %d = days
$lang['Post_already_reported'] = 'Dieser Beitrag wurde bereits gemeldet.';
$lang['Post_global_announcement'] = 'Globale Ank&uuml;ndigung';
$lang['Post_reported'] = 'Beitragsmeldung ist erfolgreich eingetragen.'; 
$lang['Post_reports_many_cp'] = 'Es gibt %s offene Beitragsmeldungen';
$lang['Post_reports_none_cp'] = 'Es gibt derzeit keine offenen Beitragsmeldungen';
$lang['Post_reports_one_cp'] = 'Es gibt %s offene Beitragsmeldung';
$lang['Post_review'] = 'Testbericht schreiben';
$lang['Previous_comments'] = 'vorhergehende Kommentare';
$lang['Quick_Reply'] = 'Schnellantwort';
$lang['Quick_reply_mode'] = 'Schnellantwort Modus';
$lang['Quick_reply_mode_advanced'] = 'Advanced';
$lang['Quick_reply_mode_basic'] = 'Basic';
$lang['Quick_reply_panel'] = 'Super Schnellantwort Mod';
$lang['Quick_search_at'] = 'von';
$lang['Quick_search_for'] = 'Suche nach';
$lang['Rank_title'] = 'Rangname';
$lang['Real_Name'] = 'Echter Name';
$lang['Recent_click_return'] = '%sHier klicken%s, um zur letzten Seite zur&uuml;ckzukehren.';
$lang['Recent_days'] = 'Tage';
$lang['Recent_first'] = 'begonnen am %s';
$lang['Recent_first_poster'] = ' von %s';
$lang['Recent_last'] = 'letzte';
$lang['Recent_last24'] = 'letzte 24 Stunden';
$lang['Recent_lastXdays'] = 'letzte %s Tage';
$lang['Recent_lastweek'] = 'letzte Woche';
$lang['Recent_no_topics'] = 'Keine Themen gefunden.';
$lang['Recent_select_mode'] = 'Auswahlmodus:';
$lang['Recent_showing_posts'] = 'Zeige Beitr&auml;ge:';
$lang['Recent_title_last24'] = ' von den letzten 24 Stunden';
$lang['Recent_title_lastXdays'] = ' von den letzten %s Tagen'; // %s = days
$lang['Recent_title_lastweek'] = ' von der letzten Woche';
$lang['Recent_title_more'] = '<font size="4">%s</font> Themen %s'; // %s = topics; %s = sort method
$lang['Recent_title_one'] = '<font size="4">%s</font> Thema %s'; // %s = topics; %s = sort method
$lang['Recent_title_today'] = ' von heute';
$lang['Recent_title_yesterday'] = ' von gestern';
$lang['Recent_today'] = 'heute';
$lang['Recent_topics'] = 'Letzte Themen';
$lang['Recent_wrong_mode'] = 'Du hast einen falschen Modus gew&auml;hlt.';
$lang['Recent_yesterday'] = 'gestern';
$lang['Report_comment'] = 'Kommentare bez&uuml;glich Deiner Aktion';
$lang['Report_email'] = 'Sende eine eMail wenn der Beitrag gemeldet wurde';
$lang['Report_not_selected'] = 'Du hast keine Beitragsmeldungen gew&auml;hlt.';
$lang['Report_post'] = 'Beitrag melden';
$lang['Reporter'] = 'Reporter';
$lang['Rules'] = 'Board-Regeln';
$lang['Rules_title'] = 'Aktion : %s';
$lang['Search_subject_only'] = 'Nur den Betreff der Nachricht suchen';
$lang['Select'] = "Markieren";
$lang['Select_one'] = 'Aktion w&auml;hlen';
$lang['Show_avatars'] = 'Zeige Avatars in Thema';
$lang['Show_hide_quick_reply_form'] = 'einblenden/ausblenden Schnellantwort Formular';
$lang['Show_quick_reply'] = 'Schnellantwort Formular anzeigen';
$lang['Show_signatures'] = 'Zeige Signaturen in Thema';
$lang['Split_Explication'] = 'Ein Thema zu teilen, dass sehr viele Seiten hat, gibt Dir die M&ouml;glichkeit Deine Themen besser organisiert zu halten.';
$lang['Spliting_topic'] = 'Teile ein Thema';
$lang['Staff'] = "Team-Seite";
$lang['Status'] = 'Status';
$lang['Status_locked']   = 'Locked';
$lang['Status_unlocked'] = 'Unlocked';
$lang['Sticky_Topics'] = 'Wichtige Themen';
$lang['Super'] = "Super Moderator";
$lang['Theme'] = 'Theme';
$lang['Topic_global_announcement']='<strong>Globale Ank&uuml;ndigung:</strong>'; 
$lang['Unlock_Explication'] = 'Ein Moderator/Administrator kann ein Thema entsperren, dass gesperrt wurde. Das wird allen Benutzern wieder erm&ouml;glichen in diesem Thread weiter zu schreiben.';
$lang['Unlocking_topic'] = 'Entsperre ein Thema';
$lang['Version_check'] = 'Neueste Version &uuml;berpr&uuml;fen';
$lang['View_next_post'] = 'N&auml;chsten Beitrag zeigen';
$lang['View_post'] = 'Beitrag zeigen';
$lang['View_post_reports'] = 'Liste der gemeldeten Beitr&auml;ge';
$lang['View_previous_post'] = 'Vorhergehender Beitrag zeigen';
$lang['Welcome_PM'] = 'Setze als die Willkommens PN';
$lang['Welcome_PM_Admin'] = 'Willkommens PN';
$lang['Welcome_PM_Set'] = 'Deine Willkommens PN wurde gesetzt';
$lang['XData_error_obtaining_group_data'] = 'Fehler beim suchen der angegebenen Gruppe';
$lang['XData_error_obtaining_new_field_info'] = 'F&uuml;r das neue Feld konnte die Sortierreihenfolge und die Feld-Id nicht gefunden werden.';
$lang['XData_error_obtaining_user_xdata'] = 'Fehler beim suchen der Benutzerdaten f&uuml;r dieses Feld';
$lang['XData_error_obtaining_userdata'] = 'Fehler beim suchen der Benutzerdaten f&uuml;r Xdata';
$lang['XData_error_obtaining_usergroup'] = 'Fehler beim suchen der Benutzergruppe';
$lang['XData_error_updating_auth'] = 'Fehler beim &auml;ndern der Berechtigungstabelle';
$lang['XData_error_updating_fields'] = 'Fehler beim &auml;ndern des Feldes';
$lang['XData_failure_inserting_data'] = 'Fehler beim speichern der Daten';
$lang['XData_failure_obtaining_field_auth'] = 'Fehler beim suchen der Feldberechtigungen';
$lang['XData_failure_obtaining_field_data'] = 'Fehler beim suchen der Felddaten';
$lang['XData_failure_obtaining_user_auth'] = 'Fehler beim suchen der Benutzerberechtigungen';
$lang['XData_failure_removing_data'] = 'Fehler beim l&ouml;schen der Daten';
$lang['XData_field_non_existant'] = 'Das Feld existiert nicht';
$lang['XData_invalid'] = 'Der Wert den Du f&uuml;r %s eingegeben hast, ist ung&uuml;ltig.';
$lang['XData_no_field_selected'] = 'Es wurde kein Feld ausgew&auml;hlt';
$lang['XData_success_updating_permissions'] = "Permissions updated successfully <br /><br /> Click %shere%s to return to Field Permissions <br /><br />";
$lang['XData_too_long'] = 'Deine %s ist zu lang.';
$lang['XData_unable_to_switch_fields'] = 'Die Felder k&ouml;nnen nicht getauscht werden.';
$lang['false'] = 'Falsch';
$lang['glance_show'] = 'Ansicht der letzten Themen<br />';
$lang['is_hidden'] = '%s ist versteckt';
$lang['is_offline'] = '%s ist offline';
$lang['is_online'] = '%s ist jetzt online';
$lang['show_glance_option']['0'] = 'Keine';
$lang['show_glance_option']['1'] = 'Alle';
$lang['show_glance_option']['10'] = 'Index, Kategorien und Foren';
$lang['show_glance_option']['2'] = 'nur Index';
$lang['show_glance_option']['3'] = 'nur Foren';
$lang['show_glance_option']['4'] = 'nur Themen';
$lang['show_glance_option']['5'] = 'Index und Themen';
$lang['show_glance_option']['6'] = 'Index und Foren';
$lang['show_glance_option']['7'] = 'Foren und Themen';
$lang['show_glance_option']['8'] = 'nur Kategorien';
$lang['show_glance_option']['9'] = 'Index und Kategorien';
$lang['sig_current'] = "Aktuelle Signatur";
$lang['sig_description'] = "Signatur bearbeiten (<strong>Vorschau m&ouml;glich</strong>)";
$lang['sig_edit'] = "Signatur bearbeiten";
$lang['sig_none'] = "Keine Signatur vorhanden";
$lang['sig_save'] = "Speichern";
$lang['sig_save_message'] = "Signatur erfolgreich gespeichert.";
$lang['sqr']['0'] = 'nein';
$lang['sqr']['1'] = 'ja';
$lang['sqr']['2'] = 'nur auf der letzten Seite';
$lang['topic_glance_priority'] = 'Zementiere dieses Thema in der Anzeige der Letzten Themen';
$lang['true'] = 'Wahr';
$lang['user_hide_images'] = 'Bilder im Forum verbergen';
$lang['youtube_link'] = 'Link';
//
// FAQ & Rules
//
$lang['dhtml_faq_noscript'] = "Es scheint als w&uuml;rde Dein Browser kein Javascript unterst&uuml;tzen, oder Javascript ist abgeschaltet in den Browsereinstellungen.<br /><br />%sHier klicken%s, um eine reine HTML Version anzuzeigen.";
$lang['BBCode_attach'] = 'FAQ Dateianh&auml;nge';
$lang['BBCode_rules'] = 'Allgemeine Verhaltensregeln';
$lang['panel_feel']['1'] = 'Rechts';
$lang['panel_feel']['2'] = 'Links';
$lang['panel_feel']['0'] = 'Aus';
$lang['Edit_Profile_Menu_title'] = 'Profil bearbeiten';
//
// Global Header strings
//
$lang['Registered_users'] = 'Mitglieder:';
$lang['Browsing_forum'] = 'Benutzer in diesem Forum:';
$lang['Online_users_zero_total'] = 'Insgesamt sind <strong>0</strong> Benutzer online: ';
$lang['Online_users_total'] = 'Insgesamt sind <strong>%d</strong> Benutzer online: ';
$lang['Online_user_total'] = 'Insgesamt ist <strong>ein</strong> Benutzer online: ';
$lang['Reg_users_zero_total'] = 'Kein registrierter, ';
$lang['Reg_users_total'] = '%d registrierte, ';
$lang['Reg_user_total'] = 'Ein registrierter, ';
$lang['Hidden_users_zero_total'] = 'kein versteckter und ';
$lang['Hidden_user_total'] = 'ein versteckter und ';
$lang['Hidden_users_total'] = '%d versteckte und ';
$lang['Guest_users_zero_total'] = 'kein Gast.';
$lang['Guest_users_total'] = '%d G&auml;ste.';
$lang['Guest_user_total'] = 'ein Gast.';
$lang['Record_online_users'] = 'Der Rekord liegt bei <strong>%s</strong> Benutzern am %s.'; // first %s = number of users, second %s is the date.
$lang['Admin_online_color'] = '%sAdministrator%s';
$lang['Mod_online_color'] = '%sModerator%s';
$lang['You_last_visit'] = 'Dein letzter Besuch war am: %s'; // %s replaced by date/time
$lang['Current_time'] = 'Aktuelles Datum und Uhrzeit: %s'; // %s replaced by time
$lang['Search_new'] = 'Beitr&auml;ge seit dem letzten Besuch anzeigen';
$lang['Search_your_posts'] = 'Eigene Beitr&auml;ge anzeigen';
$lang['Search_unanswered'] = 'Unbeantwortete Beitr&auml;ge anzeigen';
$lang['Register'] = 'Registrieren';
$lang['Profile'] = 'Profil';
$lang['Edit_profile'] = 'Profil bearbeiten';
$lang['Search'] = 'Suchen';
$lang['Memberlist'] = 'Mitgliederliste';
$lang['FAQ'] = 'FAQ';
$lang['Viewonline'] = 'Wer ist online';
$lang['Statistics'] = 'Statistiken';
$lang['BBCode_guide'] = 'BBCode-Hilfe';
$lang['Usergroups'] = 'Benutzergruppen';
$lang['Last_Post'] = 'Letzter Beitrag';
$lang['rmw_image_title'] = 'Klicken zur Vollansicht'; //Umlaute da ein Tag-Fenster
$lang['Moderator'] = 'Moderator';
$lang['Moderators'] = 'Moderatoren';
//
// Group control panel
//
$lang['Add_member'] = 'Mitglied hinzuf&uuml;gen';
$lang['Already_member_group'] = 'Du bist bereits Mitglied dieser Gruppe.';
$lang['Approve_selected'] = 'Gew&auml;hlte akzeptieren';
$lang['Are_group_moderator'] = 'Du bist der Moderator dieser Gruppe.';
$lang['Confirm_unsub'] = 'Bist Du sicher, dass Du die Mitgliedschaft in dieser Gruppe beenden m&ouml;chtest?';
$lang['Confirm_unsub_pending'] = 'Deine Anmeldung bei der Gruppe wurde noch nicht best&auml;tigt, m&ouml;chtest Du wirklich austreten?';
$lang['Could_not_add_user'] = 'Dieser Benutzer existiert nicht! - Eventuell liegt ein Schreibfehler vor.';
$lang['Could_not_anon_user'] = 'Ein Gast kann kein Gruppenmitglied werden.';
$lang['Current_memberships'] = 'Aktuelle Mitgliedschaften';
$lang['Deny_selected'] = 'Gew&auml;hlte l&ouml;schen';
$lang['Group_Control_Panel'] = 'Gruppen-Kontrolle';
$lang['Group_Information'] = 'Information';
$lang['Group_Members'] = 'Gruppen-Mitglieder';
$lang['Group_Moderator'] = 'Gruppen-Moderatoren';
$lang['Group_added'] = 'Du bist dieser Gruppe beigetreten.';
$lang['Group_approved'] = 'Deine Anfrage wurde akzeptiert.';
$lang['Group_closed'] = 'Geschlossene Gruppe';
$lang['Group_description'] = 'Beschreibung';
$lang['Group_hidden'] = 'Versteckte Gruppe';
$lang['Group_hidden_members'] = 'Diese Gruppe ist versteckt, Du kannst keine Mitgliedschaften anzeigen.';
$lang['Group_joined'] = 'Du wurdest erfolgreich bei dieser Gruppe angemeldet.<br />Du wirst benachrichtigt, wenn der Gruppenmoderator deine Mitgliedschaft akzeptiert hat.';
$lang['Group_member_details'] = 'Details zur Gruppen-Mitgliedschaft';
$lang['Group_member_join'] = 'Gruppe beitreten';
$lang['Group_membership'] = 'Gruppen-Mitgliedschaft';
$lang['Group_name'] = 'Name';
$lang['Group_not_exist'] = 'Diese Gruppe existiert nicht';
$lang['Group_open'] = 'Offene Gruppe';
$lang['Group_request'] = 'Eine Anfrage zum Beitritt in diese Gruppe wurde erstellt.';
$lang['Group_type'] = 'Gruppentyp';
$lang['Group_type_updated'] = 'Gruppentyp wurde erfolgreich aktualisiert.';
$lang['Groups'] = 'Gruppen';
$lang['Join_auto'] = 'Du kannst dieser Gruppe beitreten, da Du die erforderlichen Kriterien (Anzahl Beitr&auml;ge) erf&uuml;llst';
$lang['Join_group'] = 'Gruppe beitreten';
$lang['Login_to_join'] = 'Anmelden, um Gruppe zu managen';
$lang['Member_this_group'] = 'Du bist ein Mitglied dieser Gruppe.';
$lang['Memberships_pending'] = 'Warten auf Mitgliedschaft';
$lang['No_add_allowed'] = 'das automatische hinzuf&uuml;gen eines Benutzers ist nicht erlaubt';
$lang['No_group_members'] = 'Diese Gruppe hat keine Mitglieder.';
$lang['No_groups_exist'] = 'Es existieren keine Gruppen';
$lang['No_more'] = 'Es werden keine Benutzer mehr akzeptiert';
$lang['No_pending_group_members'] = 'Diese Gruppe hat keine wartenden Mitglieder.';
$lang['Non_member_groups'] = 'Gruppen ohne Deine Mitgliedschaft';
$lang['None'] = 'Keine';
$lang['Not_group_moderator'] = 'Du bist nicht der Gruppenmoderator, daher kannst Du diese Aktion nicht durchf&uuml;hren.';
$lang['Not_logged_in'] = 'Du musst angemeldet sein, um einer Gruppe beizutreten.';
$lang['Pending_members'] = 'Wartende Mitglieder';
$lang['Pending_this_group'] = 'Du wartest auf eine Mitgliedschaft in dieser Gruppe.';
$lang['Remove_selected'] = 'Ausgew&auml;hlte entfernen';
$lang['Subscribe'] = 'Anmelden';
$lang['This_closed_group'] = 'Dies ist eine geschlossene Gruppe: %s';
$lang['This_hidden_group'] = 'Dies ist eine versteckte Gruppe: %s';
$lang['This_open_group'] = 'Dies ist eine offene Gruppe. Klicke, um eine Mitgliedschaft zu beantragen.';
$lang['Unsub_success'] = 'Du wurdest aus dieser Gruppe abgemeldet.';
$lang['Unsubscribe'] = 'Abmelden';
$lang['User_is_member_group'] = 'Dieser Benutzer ist bereits ein Mitglied dieser Gruppe.';
$lang['View_Information'] = 'Information anzeigen';
//
// Index page
//
$lang['Forums_marked_read'] = 'Alle Foren wurden als gelesen markiert.';
$lang['Index'] = 'Index';
$lang['Mark_all_forums'] = 'Alle Foren als gelesen markieren';
$lang['No_Posts'] = 'Keine Beitr&auml;ge';
$lang['No_forums'] = 'Dieses Board hat keine Foren.';
$lang['Private_Message'] = 'Private Nachricht';
$lang['Private_Messages'] = 'Private Nachrichten';
$lang['Who_is_Online'] = 'Wer ist online?';
//
// Login
//
$lang['Enter_password'] = 'Gib bitte Deinen Benutzernamen und Dein Kennwort ein, um Dich anzumelden!';
$lang['Error_login'] = 'Du hast einen falschen oder inaktiven Benutzernamen oder ein falsches Kennwort eingegeben.';
$lang['Forgotten_password'] = 'Ich habe mein Kennwort vergessen!';
$lang['Log_me_in'] = 'Bei jedem Besuch automatisch anmelden';
$lang['Login'] = 'Anmelden';
$lang['Logout'] = 'Abmelden';
$lang['Wrong Security Code'] = 'Der eingegebene Sicherheitscode stimmt nicht &uuml;berein';
//
// Memberslist
//
$lang['Order'] = 'Reihenfolge';
$lang['Select_sort_method'] = 'Sortierungs-Methode ausw&auml;hlen';
$lang['Sort'] = 'Sortieren';
$lang['Sort_Ascending'] = 'Aufsteigend';
$lang['Sort_Descending'] = 'Absteigend';
$lang['Sort_Email'] = 'eMail';
$lang['Sort_Joined'] = 'Beitrittsdatum';
$lang['Sort_Location'] = 'Ort';
$lang['Sort_Posts'] = 'Beitr&auml;ge gesamt';
$lang['Sort_Top_Ten'] = 'Top-Ten-Autoren';
$lang['Sort_Username'] = 'Benutzername';
$lang['Sort_Website'] = 'Website';
//
// Moderator Control Panel
//
$lang['Confirm_delete_topic'] = 'Bist Du sicher, dass die gew&auml;hlten Themen entfernt werden sollen?';
$lang['Confirm_lock_topic'] = 'Bist Du sicher, dass die gew&auml;hlten Themen gesperrt werden sollen?';
$lang['Confirm_move_topic'] = 'Bist Du sicher, dass die gew&auml;hlten Themen verschoben werden sollen?';
$lang['Confirm_unlock_topic'] = 'Bist Du sicher, dass die gew&auml;hlten Themen entsperrt werden sollen?';
$lang['Delete'] = 'L&ouml;schen';
$lang['IP_info'] = 'IP-Information';
$lang['Leave_shadow_topic'] = 'Shadow Topic im alten Forum lassen';
$lang['Lock'] = 'Sperren';
$lang['Lookup_IP'] = 'IP nachschlagen';
$lang['Mod_CP'] = 'Moderator Control Panel';
$lang['Mod_CP_explain'] = 'Mit dem unteren Men&uuml; kannst Du mehrere Moderatoren-Operationen gleichzeitig ausf&uuml;hren. Du kannst Beitr&auml;ge &ouml;ffnen, schliessen, l&ouml;schen oder verschieben.';
$lang['Move'] = 'Verschieben';
$lang['Move_to_forum'] = 'Verschieben nach';
$lang['New_forum'] = 'Neues Forum';
$lang['No_Topics_Moved'] = 'Es wurden keine Themen verschoben.';
$lang['None_selected'] = 'Du hast keine Themen ausgew&auml;hlt, auf die diese Aktion ausgef&uuml;hrt werden soll. Bitte w&auml;hle mindestens ein Thema  aus.';
$lang['Other_IP_this_user'] = 'Andere IP-Adressen, von denen dieser Benutzer geschrieben hat';
$lang['Prioritize'] = 'priorisieren';
$lang['Priority'] = 'Priorit&auml;t';
$lang['Select'] = 'Ausw&auml;hlen';
$lang['Split_Topic'] = 'Split Topic Control Panel';
$lang['Split_Topic_explain'] = 'Mit den Eingabefeldern unten kannst Du ein Thema teilen, in dem Du entweder die Beitr&auml;ge manuell ausw&auml;hlst oder ab einem gew&auml;hlten Beitrag teilst';
$lang['Split_after'] = 'Von gew&auml;hltem Beitrag teilen';
$lang['Split_forum'] = 'Forum des neuen Themas';
$lang['Split_posts'] = 'Gew&auml;hlte Beitr&auml;ge teilen';
$lang['Split_title'] = 'Titel des neuen Themas';
$lang['This_posts_IP'] = 'IP-Adresse f&uuml;r diesen Beitrag';
$lang['Too_many_error'] = 'Du hast zu viele Beitr&auml;ge gew&auml;hlt. Du kannst nur einen Beitrag ausw&auml;hlen, nach dem geteilt werden soll!';
$lang['Topic_split'] = 'Das gew&auml;hlte Thema wurde erfolgreich geteilt';
$lang['Topics_Locked'] = 'Die gew&auml;hlten Themen wurden erfolgreich gesperrt.';
$lang['Topics_Moved'] = 'Die gew&auml;hlten Themen wurden verschoben.';
$lang['Topics_Prioritized'] = 'Die ausgew&auml;hlten Themen wurden priorisiert.';
$lang['Topics_Removed'] = 'Die gew&auml;hlten Themen wurden erfolgreich gel&ouml;scht.';
$lang['Topics_Unlocked'] = 'Die gew&auml;hlten Themen wurden entsperrt.';
$lang['Unlock'] = 'Entsperren';
$lang['Users_this_IP'] = 'Beitr&auml;ge von dieser IP-Adresse';
//
// Posting/Replying (Not private messaging!)
//
$lang['Add_option'] = 'Antwort hinzuf&uuml;gen';
$lang['Add_poll'] = 'Umfrage hinzuf&uuml;gen';
$lang['Add_poll_explain'] = 'Wenn Du keine Umfrage zum Thema hinzuf&uuml;gen willst, lass die Felder leer.';
$lang['Already_voted'] = 'Du hast an dieser Umfrage schon teilgenommen.';
$lang['Attach_signature'] = 'Signatur anh&auml;ngen (Signatur kann im Profil ge&auml;ndert werden)';
$lang['BBCode_is_OFF'] = '%sBBCode%s ist <u>aus</u>';
$lang['BBCode_is_ON'] = '%sBBCode%s ist <u>an</u>'; // %s are replaced with URI pointing to FAQ
$lang['Cannot_delete_poll'] = 'Du kannst keine aktiven Umfrage l&ouml;schen.';
$lang['Cannot_delete_replied'] = 'Du kannst keine Beitr&auml;ge l&ouml;schen, die schon beantwortet wurden.';
$lang['Confirm_delete'] = 'Sicher, dass dieser Beitrag gel&ouml;scht werden soll?';
$lang['Confirm_delete_poll'] = 'Sicher, dass diese Umfrage gel&ouml;scht werden soll?';
$lang['Days'] = 'Tage'; // This is used for the Run poll for ... Days + in admin_forums for pruning
$lang['Delete'] = 'L&ouml;schen';
$lang['Delete_own_posts'] = 'Du kannst nur Deine eigenen Beitr&auml;ge l&ouml;schen.';
$lang['Delete_poll'] = 'Umfrage l&ouml;schen';
$lang['Deleted'] = 'Deine Nachricht wurde erfolgreich gel&ouml;scht.';
$lang['Disable_BBCode_post'] = 'BBCode in diesem Beitrag deaktivieren';
$lang['Disable_HTML_post'] = 'HTML in diesem Beitrag deaktivieren';
$lang['Disable_Smilies_post'] = 'Smilies in diesem Beitrag deaktivieren';
$lang['Edit_Post'] = 'Beitrag editieren';
$lang['Edit_own_posts'] = 'Du kannst nur Deine eigenen Beitr&auml;ge bearbeiten.';
$lang['Emoticons'] = 'Emoticons';
$lang['Empty_message'] = 'Du musst zu Deinem Beitrag einen Text eingeben.';
$lang['Empty_poll_title'] = 'Du musst einen Titel f&uuml;r die Umfrage eingeben.';
$lang['Empty_subject'] = 'Bei einem neuen Thema musst Du einen Titel angeben.';
$lang['Flood_Error'] = 'Du kannst einen Beitrag nicht so schnell nacheinander absenden, bitte warte einen Augenblick.';
$lang['Forum_locked'] = 'Dieses Forum ist gesperrt, Du kannst keine Beitr&auml;ge editieren, schreiben oder beantworten.';
$lang['HTML_is_OFF'] = 'HTML ist <u>aus</u>';
$lang['HTML_is_ON'] = 'HTML ist <u>an</u>';
$lang['Message_body'] = 'Nachrichtentext';
$lang['No_post_id'] = 'Du musst einen Beitrag zum Editieren ausw&auml;hlen.';
$lang['No_post_mode'] = 'Kein Eintrags-Modus ausgew&auml;hlt'; // If posting.php is called without a mode (newtopic/reply/delete/etc, shouldn't be shown normaly)
$lang['No_such_post'] = 'Es existiert kein solcher Beitrag. Versuch es noch einmal.';
$lang['No_topic_id'] = 'Du musst ein Thema f&uuml;r Deine Antwort ausw&auml;hlen.';
$lang['No_valid_mode'] = 'Du kannst nur Beitr&auml;ge schreiben, bearbeiten, beantworten und zitieren. Versuch es noch einmal.';
$lang['No_vote_option'] = 'Du musst eine Auswahl treffen, um abzustimmen.';
$lang['Notify'] = 'Benachrichtigt mich, wenn eine Antwort geschrieben wurde';
$lang['Options'] = 'Optionen';
$lang['Poll_delete'] = 'Deine Umfrage wurde erfolgreich gel&ouml;scht.';
$lang['Poll_for'] = 'Dauer der Umfrage:';
$lang['Poll_for_explain'] = '[ Gib 0 ein oder lass dieses Feld leer, um die Umfrage auf unbeschr&auml;nkte Zeit durchzuf&uuml;hren ]';
$lang['Poll_option'] = 'Antwort';
$lang['Poll_question'] = 'Frage';
$lang['Poll_view_toggle'] = 'Ansicht erlauben';
$lang['Poll_view_toggle_explain'] = '[ Erlaubt Benutzern das Resultat vor dem Abstimmen zu sehen. ]';
$lang['Post_Announcement'] = 'Ank&uuml;ndigung';
$lang['Post_Normal'] = 'Normal';
$lang['Post_Sticky'] = 'Wichtig';
$lang['Post_a_new_topic'] = 'Neues Thema schreiben';
$lang['Post_a_reply'] = 'Antwort schreiben';
$lang['Post_has_no_poll'] = 'Dieser Beitrag hat keine Umfrage.';
$lang['Post_topic_as'] = 'Thema schreiben als';
$lang['Smilies_are_OFF'] = 'Smilies sind <u>aus</u>';
$lang['Smilies_are_ON'] = 'Smilies sind <u>an</u>';
$lang['Stored'] = 'Deine Nachricht wurde erfolgreich eingetragen.';
$lang['To_few_poll_options'] = 'Du musst mindestens zwei Antworten f&uuml;r die Umfrage angeben.';
$lang['To_many_poll_options'] = 'Du hast zu viele Antworten f&uuml;r die Umfrage angegeben';
$lang['Topic_locked'] = 'Dieses Thema ist gesperrt, Du kannst keine Beitr&auml;ge editieren oder beantworten.';
$lang['Topic_reply_notification'] = 'Benachrichtigen bei Antworten';
$lang['Topic_review'] = 'Thema-&Uuml;berblick';
$lang['Update'] = 'Aktualisieren';
$lang['Vote_cast'] = 'Deine Stimme wurde gez&auml;hlt.';
$lang['glance_news_heading'] = 'letzte Seiten News';
$lang['glance_next'] = 'N&auml;chste';
$lang['glance_none'] = 'Keine Neuigkeiten';
$lang['glance_previous'] = 'Letzte';
$lang['glance_recent_heading'] = 'letzte Themen';
//
// Private Messaging
//
$lang['All_Messages'] = 'Alle Nachrichten';
$lang['Cannot_send_privmsg'] = 'Der Administrator hat private Nachrichten f&uuml;r Dich gesperrt.';
$lang['Click_return_inbox'] = '%sHier klicken%s, um zum Posteingang zur&uuml;ckzukehren';
$lang['Click_return_index'] = '%sHier klicken%s, um zum Index zur&uuml;ckzukehren';
$lang['Click_return_profile'] = '%sHier klicken%s, um zum Profil zur&uuml;ckzukehren';
$lang['Click_view_privmsg'] = '%sHier klicken%s, um Deinen Posteingang aufzurufen';
$lang['Confirm_delete_pm'] = 'Diese Nachricht wirklich l&ouml;schen?';
$lang['Confirm_delete_pms'] = 'Diese Nachrichten wirklich l&ouml;schen?';
$lang['Date'] = 'Datum';
$lang['Delete_all'] = 'Alle l&ouml;schen';
$lang['Delete_marked'] = 'Markierte l&ouml;schen';
$lang['Delete_message'] = 'Nachricht l&ouml;schen';
$lang['Disable_BBCode_pm'] = 'BBCode in dieser Nachricht deaktivieren';
$lang['Disable_HTML_pm'] = 'HTML in dieser Nachricht deaktivieren';
$lang['Disable_Smilies_pm'] = 'Smilies in dieser Nachricht deaktivieren';
$lang['Display_messages'] = 'Nachrichten anzeigen der letzten'; // Followed by number of days/weeks/months
$lang['Edit_message'] = 'Private Nachricht bearbeiten';
$lang['Edit_pm'] = 'Nachricht bearbeiten';
$lang['Find'] = 'Finden';
$lang['Find_username'] = 'Benutzernamen finden';
$lang['Flag'] = 'Status';
$lang['From'] = 'Von';
$lang['Inbox'] = 'Posteingang';
$lang['Inbox_size'] = 'Dein Posteingang ist zu %d%% gef&uuml;llt'; // eg. Your Inbox is 50% full
$lang['Login_check_pm'] = 'Anmelden, um private Nachrichten zu lesen';
$lang['Mark'] = 'Markiert';
$lang['Mark_all'] = 'Alle markieren';
$lang['Message_sent'] = 'Deine Nachricht wurde gesendet.';
$lang['New_pm'] = 'Du hast 1 neue Nachricht'; // You have 1 new message
$lang['New_pms'] = 'Du hast %d neue Nachrichten'; // You have 2 new messages
$lang['No_folder'] = 'Kein Ordner ausgew&auml;hlt';
$lang['No_match'] = 'Keine Ergebnisse gefunden.';
$lang['No_messages_folder'] = 'Es sind keine weiteren Nachrichten in diesem Ordner.';
$lang['No_new_pm'] = 'Du hast keine neuen Nachrichten';
$lang['No_post_id'] = 'Es wurde keine Beitrags-ID angegeben.';
$lang['No_such_folder'] = 'Es existiert kein solcher Ordner.';
$lang['No_such_user'] = 'Es existiert kein Benutzer mit diesem Namen.';
$lang['No_to_user'] = 'Du musst einen Benutzernamen angeben, um diese Nachricht zu senden.';
$lang['No_unread_pm'] = 'Du hast keine ungelesenen Nachrichten';
$lang['Notification_subject'] = 'Eine neue private Nachricht ist eingetroffen!';
$lang['Outbox'] = 'Postausgang';
$lang['PM_disabled'] = 'Private Nachrichten wurden in diesem Board deaktiviert.';
$lang['Post_new_pm'] = 'Nachricht schreiben';
$lang['Post_quote_pm'] = 'Nachricht zitieren';
$lang['Post_reply_pm'] = 'Auf Nachricht antworten';
$lang['Private_Messaging'] = 'Private Nachrichten';
$lang['Read_message'] = 'Gelesene Nachricht';
$lang['Read_pm'] = 'Nachricht lesen';
$lang['Save_marked'] = 'Markierte speichern';
$lang['Save_message'] = 'Nachricht speichern';
$lang['Savebox'] = 'Archiv';
$lang['Savebox_size'] = 'Dein Archiv ist zu %d%% gef&uuml;llt';
$lang['Saved'] = 'Gespeichert';
$lang['Send_a_new_message'] = 'Neue Nachricht senden';
$lang['Send_a_reply'] = 'Auf private Nachricht antworten';
$lang['Sent'] = 'Gesendet';
$lang['Sentbox'] = 'Gesendete Nachrichten';
$lang['Sentbox_size'] = 'Deine gesendeten Nachrichten sind zu %d%% gef&uuml;llt';
$lang['Subject'] = 'Titel';
$lang['To'] = 'An';
$lang['Unmark_all'] = 'Markierungen aufheben';
$lang['Unread_message'] = 'Ungelesene Nachricht';
$lang['Unread_pm'] = 'Du hast 1 ungelesene Nachricht';
$lang['Unread_pms'] = 'Du hast %d ungelesene Nachrichten';
$lang['You_new_pm'] = 'Eine neue private Nachricht befindet sich in Deinem Posteingang';
$lang['You_new_pms'] = 'Es befinden sich neue private Nachrichten in Deinem Posteingang';
$lang['You_no_new_pm'] = 'Es sind keine neuen privaten Nachrichten vorhanden';
//
// Profiles/Registration
//
$lang['About_user'] = 'Alles &uuml;ber %s';
$lang['Account_activated_subject'] = 'Zugang aktiviert';
$lang['Account_active'] = 'Dein Konto wurde aktiviert. Danke f&uuml;r die Registrierung.';
$lang['Account_active_admin'] = 'Dein Konto wurde jetzt aktiviert.';
$lang['Account_added'] = '<strong>Danke f&uuml;r die Registrierung.</strong><br /> Dein Konto wurde erstellt. Du kannst Dich jetzt mit Deinem Benutzernamen und Deinem Kennwort anmelden.';
$lang['Account_inactive'] = 'Dein Konto wurde erstellt. Dieses Forum ben&ouml;tigt aber eine Aktivierung, daher wurde ein Aktivierungsschl&uuml;ssel an Deine eMail-Adresse gesendet. Bitte &uuml;berpr&uuml;fe deine Mailbox f&uuml;r weitere Informationen.';
$lang['Account_inactive_admin'] = 'Dein Konto wurde erstellt. Dieses muss noch durch den Administrator freigeschaltet werden. Du wirst benachrichtigt, wenn dies geschehen ist.';
$lang['Agree_not'] = 'Ich bin mit den Konditionen nicht einverstanden.';
$lang['Agree_over_13'] = 'Ich bin mit den Konditionen dieses Forums einverstanden und <strong>&uuml;ber</strong> oder <strong>exakt</strong> 14 Jahre alt.';
$lang['Agree_under_13'] = 'Ich bin mit den Konditionen dieses Forums einverstanden und <strong>unter</strong> 14 Jahre alt.';
$lang['Already_activated'] = 'Dein Konto ist bereits aktiv';
$lang['Always_add_sig'] = 'Signatur immer anh&auml;ngen';
$lang['Always_bbcode'] = 'BBCode immer aktivieren';
$lang['Always_html'] = 'HTML immer aktivieren';
$lang['Always_notify'] = 'Bei Antworten immer benachrichtigen';
$lang['Always_notify_explain'] = 'Sendet Dir eine eMail, wenn jemand auf einen Deiner Beitr&auml;ge antwortet. Kann f&uuml;r jeden Beitrag ge&auml;ndert werden.';
$lang['Always_smile'] = 'Smilies immer aktivieren';
$lang['Avatar'] = 'Avatar';
$lang['Avatar_URL'] = 'URL des Avatars';
$lang['Avatar_explain'] = 'Zeigt eine kleine Grafik neben Deinen Details zu jedem Deiner Beitr&auml;ge an. Es kann immer nur ein Avatar angezeigt werden, seine Breite darf nicht gr&ouml;sser als %d Pixel sein, die H&ouml;he nicht gr&ouml;sser als %d  Pixel, und die Dateigr&ouml;sse darf maximal %d KB betragen.';
$lang['Avatar_filesize'] = 'Die Dateigr&ouml;sse muss kleiner als %d kB sein.'; // followed by xx kB, xx being the size
$lang['Avatar_filetype'] = 'Der Avatar muss im GIF-, JPG- oder PNG-Format sein.';
$lang['Avatar_gallery'] = 'Avatar-Galerie';
$lang['Avatar_imagesize'] = 'Der Avatar muss weniger als %d Pixel breit und %d Pixel hoch sein.';
$lang['Avatar_panel'] = 'Avatar-Steuerung';
$lang['Board_lang'] = 'Board-Sprache';
$lang['Board_style'] = 'Board-Style';
$lang['CC_email'] = 'Eine Kopie dieser eMail an Dich senden';
$lang['COPPA'] = 'Dein Konto wurde erstellt, muss aber zuerst &uuml;berpr&uuml;ft werden. Mehr Details dazu wurden dir per eMail gesendet.';
$lang['Confirm_password'] = 'Kennwort best&auml;tigen';
$lang['Confirm_password_explain'] = 'Du musst Dein Kennwort angeben, wenn Du Dein Kennwort oder Deine Mailadresse &auml;ndern m&ouml;chtest.';
$lang['Contact'] = 'Kontakt';
$lang['Current_Image'] = 'Aktuelles Bild';
$lang['Current_password'] = 'Aktuelles Kennwort';
$lang['Current_password_mismatch'] = 'Das aktuelle Kennwort stimmt nicht mit dem in der Datenbank &uuml;berein.';
$lang['Date_format'] = 'Datums-Format';
$lang['Date_format_explain'] = 'Die Syntax ist identisch mit der PHP-Funktion <a href=\'http://www.php.net/date\' onclick=\'window.open(this.href,\"_blank\"); return false;\'>date()</a>';
$lang['Delete_Image'] = 'Bild l&ouml;schen';
$lang['Email_address'] = 'eMail-Adresse';
$lang['Email_banned'] = 'Die angegebene Mailadresse wurde vom Administrator gesperrt.';
$lang['Email_invalid'] = 'Die angegebene Mailadresse ist ung&uuml;ltig.';
$lang['Email_message_desc'] = 'Diese Nachricht wird als Text versendet, verwende bitte deshalb kein HTML oder BBCode. Als Antwort-Adresse der eMail wird Deine Adresse angegeben.';
$lang['Email_sent'] = 'eMail wurde gesendet';
$lang['Email_taken'] = 'Die angegebene Mailadresse wird bereits von einem anderen Benutzer verwendet.';
$lang['Empty_message_email'] = 'Du musst einen Text zur eMail angeben.';
$lang['Empty_subject_email'] = 'Du musst einen Titel f&uuml;r diese eMail angeben.';
$lang['Fields_empty'] = 'Du musst alle ben&ouml;tigten Felder ausf&uuml;llen.';
$lang['File_no_data'] = 'Die angegebene Datei enth&auml;lt keine Daten';
$lang['Flood_email_limit'] = 'Im Moment kannst Du keine weiteren eMails versenden. Versuch es sp&auml;ter noch einmal.';
$lang['Hidden_email'] = '[ Versteckt ]';
$lang['Hide_user'] = 'Online-Status verstecken';
$lang['Incomplete_URL'] = 'Die angegebene URL ist unvollst&auml;ndig';
$lang['Interests'] = 'Interessen';
$lang['Items_required'] = 'Mit * markierte Felder sind erforderlich';
$lang['Link_remote_Avatar'] = 'Zu einem externen Avatar linken';
$lang['Link_remote_Avatar_explain'] = 'Gib die URL des Avatars ein, der verlinkt werden soll';
$lang['Location'] = 'Wohnort';
$lang['Login_attempts_exceeded'] = 'Die maximale Anzahl an Loginversuchen wurde erreicht. Du bist f&uuml;r die n&auml;chsten %s Minuten gesperrt.';
$lang['New_account_subject'] = 'Neues Benutzerkonto';
$lang['New_password'] = 'Neues Kennwort';
$lang['New_password_activation'] = 'Aktivierung des neuen Kennwortes';
$lang['No_connection_URL'] = 'Es konnte keine Verbindung zur angegebenen Datei hergestellt werden';
$lang['No_email_match'] = 'Die angegebene eMail-Adresse stimmt nicht mit dem Benutzernamen &uuml;berein.';
$lang['No_send_account_inactive'] = 'Sorry, aber ein neues Kennwort kann im Moment nicht gesendet werden, da Dein Zugang derzeit noch inaktiv ist. Bitte kontaktiere den Administrator f&uuml;r weitere Informationen.';
$lang['No_themes'] = 'Keine Themes in der Datenbank';
$lang['No_user_id_specified'] = 'Dieser Benutzer existiert nicht.';
$lang['No_user_specified'] = 'Es wurde kein Benutzer ausgew&auml;hlt';
$lang['Notify_on_privmsg'] = 'Bei neuen privaten Nachrichten benachrichtigen';
$lang['Occupation'] = 'Beruf';
$lang['Only_one_avatar'] = 'Es kann nur ein Avatar ausgew&auml;hlt werden';
$lang['Password_activated'] = 'Dein Zugang wurde wieder aktiviert. Um Dich anzumelden, benutze das Kennwort, welches Du per eMail erhalten hast.';
$lang['Password_long'] = 'Dein Kennwort darf nicht l&auml;nger als 32 Zeichen sein.';
$lang['Password_mismatch'] = 'Du musst zweimal das gleiche Kennwort eingeben.';
$lang['Password_updated'] = 'Ein neues Kennwort wurde erstellt. Es wurde eine eMail mit weiteren Anweisungen verschickt.';
$lang['Pick_local_Avatar'] = 'Avatar aus der Galerie ausw&auml;hlen';
$lang['Please_remove_install_contrib'] = 'Bitte stelle sicher, das <strong>Beide</strong> Verzeichnisse: install/ und contrib/ gel&ouml;scht sind';
$lang['Popup_on_privmsg'] = 'PopUp-Fenster bei neuen privaten Nachrichten';
$lang['Popup_on_privmsg_explain'] = 'Einige Templates &ouml;ffnen neue Fenster, um Dich &uuml;ber neue private Nachrichten zu benachrichtigen.';
$lang['Poster_rank'] = 'Rang';
$lang['Preferences'] = 'Einstellungen';
$lang['Profile_info'] = 'Profil-Informationen';
$lang['Profile_info_warn'] = 'Diese Informationen sind &ouml;ffentlich abrufbar!';
$lang['Profile_updated'] = 'Dein Profil wurde aktualisiert';
$lang['Profile_updated_inactive'] = 'Dein Profil wurde aktualisiert. Du hast jedoch wesentliche Details ge&auml;ndert, weswegen Dein Zugang jetzt inaktiv ist. Du wurdest per Mail dar&uuml;ber informiert, wie Du Deinen Zugang reaktivieren kannst. Falls eine Aktivierung durch den Administrator erforderlich ist, warte bitte, bis die Reaktivierung stattgefunden hat.';
$lang['Public_view_email'] = 'Zeige meine eMail-Adresse immer an';
$lang['Reactivate'] = 'Zugang wieder aktivieren!';
$lang['Recipient'] = 'Empf&auml;nger';
$lang['Reg_agreement'] = 'Die Administratoren und Moderatoren dieses Forums bem&uuml;hen sich, Beitr&auml;ge mit fragw&uuml;rdigem Inhalt so schnell wie m&ouml;glich zu bearbeiten oder ganz zu l&ouml;schen, aber es ist nicht m&ouml;glich, jede einzelne Nachricht zu &uuml;berpr&uuml;fen. Du best&auml;tigst mit Absenden dieser Einverst&auml;ndniserkl&auml;rung, dass Du akzeptierst, dass jeder Beitrag in diesem Forum die Meinung des Urhebers wiedergibt und dass die Administratoren, Moderatoren und Betreiber dieses Forums nur f&uuml;r ihre eigenen Beitr&auml;ge verantwortlich sind.<br /><br />Du verpflichtest Dich, keine beleidigenden, obsz&ouml;nen, vulg&auml;ren, verleumdenden, gewaltverherrlichenden oder aus anderen Gr&uuml;nden strafbaren Inhalte in diesem Forum zu ver&ouml;ffentlichen. Verst&ouml;sse gegen diese Regel f&uuml;hren zu sofortiger und permanenter Sperrung, wir behalten uns vor Verbindungsdaten u.&auml;. an die strafverfolgenden Beh&ouml;rden weiterzugeben. Du r&auml;umst den Betreibern, Administratoren und Moderatoren dieses Forums das Recht ein, Beitr&auml;ge nach eigenem Ermessen zu entfernen, zu bearbeiten, zu verschieben oder zu sperren. Du stimmst zu, dass die im Rahmen der Registrierung erhobenen Daten in einer Datenbank gespeichert werden.<br /><br />Dieses System verwendet Cookies, um Informationen auf deinem Computer zu speichern. Diese Cookies enthalten keine der oben angegebenen Informationen, sondern dienen ausschliesslich deinem Komfort. Deine Mail-Adresse wird nur zur Best&auml;tigung der Registrierung und ggf. zum Versand eines neuen Passwortes verwandt.<br /><br />Durch das Abschliessen der Registrierung stimmst Du diesen Nutzungsbedingungen zu.';
$lang['Registration'] = 'Einverst&auml;ndniserkl&auml;rung';
$lang['Registration_info'] = 'Registrierungs-Informationen';
$lang['Return_profile'] = 'Avatar abbrechen';
$lang['Search_user_posts'] = 'Alle Beitr&auml;ge von %s anzeigen'; // Find all posts by username
$lang['Select_avatar'] = 'Avatar ausw&auml;hlen';
$lang['Select_category'] = 'Kategorie ausw&auml;hlen';
$lang['Select_from_gallery'] = 'Avatar aus der Galerie ausw&auml;hlen';
$lang['Send_email'] = 'eMail senden';
$lang['Send_email_msg'] = 'eMail senden';
$lang['Send_password'] = 'Schickt mir ein neues Kennwort.';
$lang['Send_private_message'] = 'Private Nachricht senden';
$lang['Session_invalid'] = 'Ung&uuml;ltige Sitzung. Bitte best&auml;tige das Formular noch einmal';
$lang['Signature'] = 'Signatur';
$lang['Signature_explain'] = 'Dies ist ein Text, der an jeden Beitrag von Dir angehangen werden kann. Es besteht eine Limitierung von %d Buchstaben.';
$lang['Signature_too_long'] = 'Deine Signatur ist zu lang.';
$lang['Timezone'] = 'Zeitzone';
$lang['Total_posts'] = 'Beitr&auml;ge insgesamt';
$lang['Upload_Avatar_URL'] = 'Avatar von URL hochladen';
$lang['Upload_Avatar_URL_explain'] = 'Gib die URL des gew&uuml;nschten Avatars an, dieser wird dann kopiert';
$lang['Upload_Avatar_file'] = 'Avatar von Deinem Computer hochladen';
$lang['User_admin_for'] = "Benutzer Administration f&uuml;r";
$lang['User_not_exist'] = 'Dieser Benutzer existiert nicht.';
$lang['User_post_day_stats'] = '%.2f Beitr&auml;ge pro Tag'; // 1.5 posts per day
$lang['User_post_pct_stats'] = '%.2f%% aller Beitr&auml;ge'; // 1.25% of total
$lang['User_prevent_email'] = 'Dieser Benutzer hat den eMail-Empfang deaktiviert. Bitte versuche es mit einer privaten Nachricht.';
$lang['Username_disallowed'] = 'Der gew&uuml;nschte Benutzername wurde vom Administrator gesperrt.';
$lang['Username_invalid'] = 'Der gew&uuml;nschte Benutzername enth&auml;lt ein ung&uuml;ltiges Sonderzeichen (z.B. \').';
$lang['Username_taken'] = 'Der gew&uuml;nschte Benutzername ist leider bereits belegt.';
$lang['View_avatar_gallery'] = 'Galerie anzeigen';
$lang['Viewing_user_profile'] = 'Profil anzeigen : %s'; // %s is username 
$lang['Website'] = 'Website';
$lang['Welcome_subject'] = 'Willkommen auf %s';
$lang['Word_Wrap'] = 'Bildschirmbreite';
$lang['Word_Wrap_Error'] = 'Die Beitrags-Anzeigebreite liegt ausserhalb des Bereichs.';
$lang['Word_Wrap_Explain'] = 'Dies ist die maximale Zeilenl&auml;nge in Beitr&auml;gen.';
$lang['Word_Wrap_Extra'] = 'Zeichen (Bereich: 50 - 99 Zeichen)';
$lang['Wrong_Profile'] = 'Du kannst nur Dein eigenes Profil bearbeiten.';
$lang['Wrong_activation'] = 'Der Aktivierungsschl&uuml;ssel aus dem Link stimmt nicht mit dem in der Datenbank &uuml;berein. Bitte &uuml;berpr&uuml;fe die URL und versuche es erneut.';
$lang['Wrong_remote_avatar_format'] = 'Das Format des Avatars ist nicht g&uuml;ltig';
$lang['password_confirm_if_changed'] = 'Du musst Dein neues Kennwort best&auml;tigen, wenn Du es &auml;ndern willst';
$lang['password_if_changed'] = 'Du musst nur dann ein neues Kennwort angeben, wenn Du es &auml;ndern willst';
//
// Search
//
$lang['All_available'] = 'Alle';
$lang['Close_window'] = 'Fenster schliessen';
$lang['Display_results'] = 'Ergebnis anzeigen als';
$lang['Found_search_match'] = 'Die Suche hat %d Ergebnis geliefert.'; // eg. Search found 1 match
$lang['Found_search_matches'] = 'Die Suche hat %d Ergebnisse geliefert.'; // eg. Search found 24 matches
$lang['No_search_match'] = 'Keine Beitr&auml;ge entsprechen deinen Kriterien.';
$lang['No_searchable_forums'] = 'Du hast nicht die Berechtigung, dieses Forum zu durchsuchen.';
$lang['Return_first'] = 'Die ersten '; // followed by xxx characters in a select box
$lang['Search_Flood_Error'] = 'Es ist nicht erlaubt, so kurz hintereinander Suchabfragen zu starten. Bitte gedulde Dich noch etwas und versuche es dann erneut.';
$lang['Search_author'] = 'Nach Autor suchen';
$lang['Search_author_explain'] = 'Benutze das *-Zeichen als Platzhalter';
$lang['Search_for_all'] = 'Nach allen W&ouml;rtern suchen';
$lang['Search_for_any'] = 'Nach irgendeinem Wort suchen';
$lang['Search_keywords'] = 'Nach Begriffen suchen';
$lang['Search_keywords_explain'] = 'Du kannst <u>AND</u> benutzen, um W&ouml;rter zu definieren, die vorkommen m&uuml;ssen, <u>OR</u> kannst Du benutzen f&uuml;r W&ouml;rter, die im Resultat sein k&ouml;nnen und <u>NOT</u> f&uuml;r W&ouml;rter, die im Ergebnis nicht vorkommen sollen. Das *-Zeichen kannst Du als Platzhalter benutzen.';
$lang['Search_msg_only'] = 'Nur Nachrichtentext durchsuchen';
$lang['Search_options'] = 'Suchoptionen';
$lang['Search_previous'] = 'Durchsuchen'; // followed by days, weeks, months, year, all in a select box
$lang['Search_query'] = 'Suchabfrage';
$lang['Search_title_msg'] = 'Titel und Text durchsuchen';
$lang['Sort_Author'] = 'Autor';
$lang['Sort_Forum'] = 'Forum';
$lang['Sort_Post_Subject'] = 'Titel des Beitrags';
$lang['Sort_Time'] = 'Zeit';
$lang['Sort_Topic_Title'] = 'Titel des Themas';
$lang['Sort_by'] = 'Sortieren nach';
$lang['characters_posts'] = 'Zeichen des Beitrags anzeigen';
//
// Stats block text
//
$lang['Forum_is_locked'] = 'Forum ist gesperrt';
$lang['New_post'] = 'Neuer Beitrag';
$lang['New_posts'] = 'Neue Beitr&auml;ge';
$lang['New_posts_hot'] = 'Neue Beitr&auml;ge [ Top-Thema ]';
$lang['New_posts_locked'] = 'Neue Beitr&auml;ge [ Gesperrt ]';
$lang['Newest_user'] = 'Das neueste Mitglied ist <strong>%s%s%s</strong>.'; // a href, username, /a 
$lang['No_new_posts'] = 'Keine neuen Beitr&auml;ge';
$lang['No_new_posts_hot'] = 'Keine neuen Beitr&auml;ge [ Top-Thema ]';
$lang['No_new_posts_last_visit'] = 'Keine neuen Beitr&auml;ge seit Deinem letzten Besuch';
$lang['No_new_posts_locked'] = 'Keine neuen Beitr&auml;ge [ Gesperrt ]';
$lang['Posted_article_total'] = 'Unsere Benutzer haben <strong>einen</strong> Beitrag geschrieben.'; // Number of posts
$lang['Posted_articles_total'] = 'Unsere Benutzer haben insgesamt <strong>%d</strong> Beitr&auml;ge geschrieben.'; // Number of posts
$lang['Posted_articles_zero_total'] = 'Unsere Benutzer haben <strong>noch keine</strong> Beitr&auml;ge geschrieben.'; // Number of posts
$lang['Registered_user_total'] = 'Wir haben <strong>einen</strong> registrierten Benutzer.'; // # registered users
$lang['Registered_users_total'] = 'Wir haben <strong>%d</strong> registrierte Benutzer.'; // # registered users
$lang['Registered_users_zero_total'] = 'Wir haben <strong>keine</strong> registrierten Benutzer.'; // # registered users
//
// Timezones ... for display on each page
//
$lang['All_times'] = 'Alle Zeiten sind %s'; // eg. All times are GMT - 12 Hours (times from next block)
$lang['-12'] = 'GMT - 12 Stunden';
$lang['-11'] = 'GMT - 11 Stunden';
$lang['-10'] = 'GMT - 10 Stunden';
$lang['-9'] = 'GMT - 9 Stunden';
$lang['-8'] = 'GMT - 8 Stunden';
$lang['-7'] = 'GMT - 7 Stunden';
$lang['-6'] = 'GMT - 6 Stunden';
$lang['-5'] = 'GMT - 5 Stunden';
$lang['-4'] = 'GMT - 4 Stunden';
$lang['-3.5'] = 'GMT - 3.5 Stunden';
$lang['-3'] = 'GMT - 3 Stunden';
$lang['-2'] = 'GMT - 2 Stunden';
$lang['-1'] = 'GMT - 1 Stunden';
$lang['0'] = 'GMT';
$lang['1'] = 'GMT + 1 Stunde';
$lang['2'] = 'GMT + 2 Stunden';
$lang['3'] = 'GMT + 3 Stunden';
$lang['3.5'] = 'GMT + 3.5 Stunden';
$lang['4'] = 'GMT + 4 Stunden';
$lang['4.5'] = 'GMT + 4.5 Stunden';
$lang['5'] = 'GMT + 5 Stunden';
$lang['5.5'] = 'GMT + 5.5 Stunden';
$lang['6'] = 'GMT + 6 Stunden';
$lang['6.5'] = 'GMT + 6.5 Stunden';
$lang['7'] = 'GMT + 7 Stunden';
$lang['8'] = 'GMT + 8 Stunden';
$lang['9'] = 'GMT + 9 Stunden';
$lang['9.5'] = 'GMT + 9.5 Stunden';
$lang['10'] = 'GMT + 10 Stunden';
$lang['11'] = 'GMT + 11 Stunden';
$lang['12'] = 'GMT + 12 Stunden';
$lang['13'] = 'GMT + 13 Stunden';
// These are displayed in the timezone select box 
$lang['tz']['-12'] = 'GMT - 12 Stunden';
$lang['tz']['-11'] = 'GMT - 11 Stunden';
$lang['tz']['-10'] = 'GMT - 10 Stunden';
$lang['tz']['-9'] = 'GMT - 9 Stunden';
$lang['tz']['-8'] = 'GMT - 8 Stunden';
$lang['tz']['-7'] = 'GMT - 7 Stunden';
$lang['tz']['-6'] = 'GMT - 6 Stunden';
$lang['tz']['-5'] = 'GMT - 5 Stunden';
$lang['tz']['-4'] = 'GMT - 4 Stunden';
$lang['tz']['-3.5'] = 'GMT - 3.5 Stunden';
$lang['tz']['-3'] = 'GMT - 3 Stunden';
$lang['tz']['-2'] = 'GMT - 2 Stunden';
$lang['tz']['-1'] = 'GMT - 1 Stunden';
$lang['tz']['0'] = 'GMT';
$lang['tz']['1'] = 'GMT + 1 Stunde';
$lang['tz']['2'] = 'GMT + 2 Stunden';
$lang['tz']['3'] = 'GMT + 3 Stunden';
$lang['tz']['3.5'] = 'GMT + 3.5 Stunden';
$lang['tz']['4'] = 'GMT + 4 Stunden';
$lang['tz']['4.5'] = 'GMT + 4.5 Stunden';
$lang['tz']['5'] = 'GMT + 5 Stunden';
$lang['tz']['5.5'] = 'GMT + 5.5 Stunden';
$lang['tz']['6'] = 'GMT + 6 Stunden';
$lang['tz']['6.5'] = 'GMT + 6.5 Stunden';
$lang['tz']['7'] = 'GMT + 7 Stunden';
$lang['tz']['8'] = 'GMT + 8 Stunden';
$lang['tz']['9'] = 'GMT + 9 Stunden';
$lang['tz']['9.5'] = 'GMT + 9.5 Stunden';
$lang['tz']['10'] = 'GMT + 10 Stunden';
$lang['tz']['11'] = 'GMT + 11 Stunden';
$lang['tz']['12'] = 'GMT + 12 Stunden';
$lang['tz']['13'] = 'GMT + 13 Stunden';
$lang['datetime']['Sunday'] = 'Sonntag';
$lang['datetime']['Monday'] = 'Montag';
$lang['datetime']['Tuesday'] = 'Dienstag';
$lang['datetime']['Wednesday'] = 'Mittwoch';
$lang['datetime']['Thursday'] = 'Donnerstag';
$lang['datetime']['Friday'] = 'Freitag';
$lang['datetime']['Saturday'] = 'Samstag';
$lang['datetime']['Sun'] = 'So';
$lang['datetime']['Mon'] = 'Mo';
$lang['datetime']['Tue'] = 'Di';
$lang['datetime']['Wed'] = 'Mi';
$lang['datetime']['Thu'] = 'Do';
$lang['datetime']['Fri'] = 'Fr';
$lang['datetime']['Sat'] = 'Sa';
$lang['datetime']['January'] = 'Januar';
$lang['datetime']['February'] = 'Februar';
$lang['datetime']['March'] = 'M&auml;rz';
$lang['datetime']['April'] = 'April';
$lang['datetime']['May'] = 'Mai';
$lang['datetime']['June'] = 'Juni';
$lang['datetime']['July'] = 'Juli';
$lang['datetime']['August'] = 'August';
$lang['datetime']['September'] = 'September';
$lang['datetime']['October'] = 'Oktober';
$lang['datetime']['November'] = 'November';
$lang['datetime']['December'] = 'Dezember';
$lang['datetime']['Jan'] = 'Jan';
$lang['datetime']['Feb'] = 'Feb';
$lang['datetime']['Mar'] = 'M&auml;rz';
$lang['datetime']['Apr'] = 'Apr';
$lang['datetime']['May'] = 'Mai';
$lang['datetime']['Jun'] = 'Jun';
$lang['datetime']['Jul'] = 'Jul';
$lang['datetime']['Aug'] = 'Aug';
$lang['datetime']['Sep'] = 'Sep';
$lang['datetime']['Oct'] = 'Okt';
$lang['datetime']['Nov'] = 'Nov';
$lang['datetime']['Dec'] = 'Dez';
//
// Viewforum
//
$lang['All_Topics'] = 'Alle Themen anzeigen';
$lang['Display_topics'] = 'Siehe Beitr&auml;ge der letzten';
$lang['Forum_not_exist'] = 'Das ausgew&auml;hlte Forum existiert nicht.';
$lang['Mark_all_topics'] = 'Alle Themen als gelesen markieren';
$lang['No_topics_post_one'] = 'In diesem Forum sind keine Beitr&auml;ge vorhanden.<br />Klicke auf <strong>Neues Thema</strong>, um den ersten Beitrag zu erstellen.';
$lang['Reached_on_error'] = 'Fehler auf dieser Seite!';
$lang['Rules_delete_can'] = 'Du <strong>kannst</strong> Deine Beitr&auml;ge in diesem Forum l&ouml;schen.';
$lang['Rules_delete_cannot'] = 'Du <strong>kannst</strong> Deine Beitr&auml;ge in diesem Forum <strong>nicht</strong> l&ouml;schen.';
$lang['Rules_edit_can'] = 'Du <strong>kannst</strong> Deine Beitr&auml;ge in diesem Forum bearbeiten.';
$lang['Rules_edit_cannot'] = 'Du <strong>kannst</strong> Deine Beitr&auml;ge in diesem Forum <strong>nicht</strong> bearbeiten.';
$lang['Rules_moderate'] = 'Du <strong>kannst</strong> %sdieses Forum moderieren%s.'; // %s replaced by a href links, do not remove! 
$lang['Rules_post_can'] = 'Du <strong>kannst</strong> Beitr&auml;ge in dieses Forum schreiben.';
$lang['Rules_post_cannot'] = 'Du <strong>kannst keine</strong> Beitr&auml;ge in dieses Forum schreiben.';
$lang['Rules_reply_can'] = 'Du <strong>kannst</strong> auf Beitr&auml;ge in diesem Forum antworten.';
$lang['Rules_reply_cannot'] = 'Du <strong>kannst nicht</strong> auf Beitr&auml;ge in diesem Forum antworten.';
$lang['Rules_vote_can'] = 'Du <strong>kannst</strong> an Umfragen in diesem Forum teilnehmen.';
$lang['Rules_vote_cannot'] = 'Du <strong>kannst</strong> an Umfragen in diesem Forum <strong>nicht</strong> teilnehmen.';
$lang['Topic_Announcement'] = '<strong>Ank&uuml;ndigungen:</strong>';
$lang['Topic_Moved'] = '<strong>Verschoben:</strong>';
$lang['Topic_Poll'] = '<strong>[Umfrage]</strong>';
$lang['Topic_Sticky'] = '<strong>Wichtig:</strong>';
$lang['Topics_marked_read'] = 'Alle Themen wurden als gelesen markiert.';
$lang['View_forum'] = 'Forum anzeigen';
//
// Viewonline
//
$lang['Forum_Location'] = 'Welche Seite';
$lang['Forum_index'] = 'Forum-Index';
$lang['Guest_user_online'] = 'Es ist ein Gast online.';
$lang['Guest_users_online'] = 'Es sind %d G&auml;ste online.';
$lang['Guest_users_zero_online'] = 'Es sind keine G&auml;ste online.'; // There are 10 Guest users online
$lang['Hidden_user_online'] = 'ein versteckter Benutzer online.'; // 6 Hidden users online
$lang['Hidden_users_online'] = '%d versteckte Benutzer online.'; // 6 Hidden users online
$lang['Hidden_users_zero_online'] = 'kein versteckter Benutzer online.'; // 6 Hidden users online
$lang['Last_updated'] = 'Zuletzt aktualisiert';
$lang['Logging_on'] = 'Einloggen';
$lang['No_users_browsing'] = 'Im Moment sind keine Benutzer im Forum.';
$lang['Online_explain'] = 'Diese Daten zeigen an, wer in den letzten ' . ( ($board_config['online_time']/60)%60 ) . ' Minuten online war';
$lang['Online_time'] = 'Online seit';
$lang['Posting_message'] = 'Nachricht schreiben';
$lang['Reg_user_online'] = 'Es ist ein registrierter und '; // There are 5 Registered and
$lang['Reg_users_online'] = 'Es sind %d registrierte und ';
$lang['Reg_users_zero_online'] = 'Es sind kein registrierter und '; // There are 5 Registered and
$lang['Searching_forums'] = 'Foren durchsuchen';
$lang['Statistic_last_updated'] = 'Letztes Update der Statistik am';
$lang['Viewing_FAQ'] = 'FAQ anzeigen';
$lang['Viewing_groupcp'] = 'Viewing Group Control Panel';
$lang['Viewing_member_list'] = 'Mitgliederliste anzeigen';
$lang['Viewing_online'] = 'Anzeigen, wer online ist';
$lang['Viewing_priv_msgs'] = 'Private Nachrichten anzeigen';
$lang['Viewing_profile'] = 'Profil anzeigen';
$lang['Viewing_ranks'] = 'Viewing Ranks';
$lang['Viewing_rules'] = 'Viewing Board Rules';
$lang['Viewing_stats'] = 'Viewing Statistics';
//
// Viewtopic
//
$lang['All_Posts'] = 'Alle Beitr&auml;ge';
$lang['Back_to_top'] = 'Nach oben';
$lang['Code'] = 'Code'; // comes before bbcode code output.
$lang['Delete_post'] = 'Beitrag l&ouml;schen';
$lang['Delete_topic'] = 'Thema l&ouml;schen';
$lang['Display_posts'] = 'Beitr&auml;ge der letzten Zeit anzeigen';
$lang['Edit_delete_post'] = 'Beitrag bearbeiten oder l&ouml;schen';
$lang['Edited_time_total'] = 'Zuletzt bearbeitet von %s am %s, insgesamt einmal bearbeitet'; // Last edited by me on 12 Oct 2001, edited 1 time in total
$lang['Edited_times_total'] = 'Zuletzt bearbeitet von %s am %s, insgesamt %d-mal bearbeitet'; // Last edited by me on 12 Oct 2001, edited 2 times in total
$lang['Guest'] = 'Gast';
$lang['ICQ_status'] = 'ICQ-Status';
$lang['Lock_topic'] = 'Thema sperren';
$lang['Merge_topics'] = 'Thema zusammen f&uuml;hren';
$lang['Move_topic'] = 'Thema verschieben';
$lang['Newest_First'] = 'Die neusten zuerst';
$lang['No_longer_watching'] = 'Das Thema wird nicht mehr von Dir beobachtet.';
$lang['No_newer_topics'] = 'Es gibt keine neueren Themen in diesem Forum.';
$lang['No_older_topics'] = 'Es gibt keine &auml;lteren Themen in diesem Forum.';
$lang['No_posts_topic'] = 'Es existieren keine Beitr&auml;ge zu diesem Thema.';
$lang['Oldest_First'] = 'Die &auml;ltesten zuerst';
$lang['PHPCode'] = 'PHP'; // PHP MOD
$lang['Post_subject'] = 'Titel';
$lang['Quote'] = 'Zitat'; // comes before bbcode quote output.
$lang['Read_profile'] = 'Benutzer-Profile anzeigen';
$lang['Split_topic'] = 'Thema teilen';
$lang['Start_watching_topic'] = 'Bei Antworten zu diesem Thema benachrichtigen';
$lang['Stop_watching_topic'] = 'Bei Antworten zu diesem Thema nicht mehr benachrichtigen';
$lang['Submit_vote'] = 'Stimme absenden';
$lang['Topic_post_not_exist'] = 'Das gew&auml;hlte Thema oder der Beitrag existiert nicht.';
$lang['Total_votes'] = 'Stimmen insgesamt';
$lang['Unlock_topic'] = 'Thema entsperren';
$lang['View_IP'] = 'IP-Adresse zeigen';
$lang['View_next_topic'] = 'N&auml;chstes Thema anzeigen';
$lang['View_previous_topic'] = 'Vorheriges Thema anzeigen';
$lang['View_results'] = 'Ergebnis anzeigen';
$lang['View_topic'] = 'Thema anzeigen';
$lang['Visit_website'] = 'Website dieses Mitglieds besuchen';
$lang['You_are_watching'] = 'Du beobachtest nun dieses Thema.';
$lang['must_first_vote'] = 'Du musst erst abstimmen bevor Du die Ergebnisse der Umfrage siehst';
$lang['wrote'] = 'schrieb'; // proceeds the username and is followed by the quoted text
// 
// Visual confirmation system strings 
// 
$lang['Confirm_code'] = 'Best&auml;tigungs-Code'; 
$lang['Confirm_code_explain'] = 'Gib den Code exakt so ein, wie Du ihn siehst. Der Code unterscheidet zwischen Gross- und Kleinschreibung, die Null hat im Inneren einen schr&auml;gen Strich.'; 
$lang['Confirm_code_impaired'] = 'Wenn Du visuell beeintr&auml;chtigt bist, oder aus einem anderen Grund den Code nicht lesen kannst, kontaktiere bitte den %sAdministrator%s f&uuml;r Hilfe.'; 
$lang['Confirm_code_wrong'] = 'Der eingegebene Best&auml;tigungs-Code war nicht richtig'; 
$lang['Too_many_registers'] = 'Du hast die zul&auml;ssige Zahl von Registrierungs-Versuchen f&uuml;r diese Sitzung &uuml;berschritten. Bitte versuche es sp&auml;ter erneut.'; 

?>