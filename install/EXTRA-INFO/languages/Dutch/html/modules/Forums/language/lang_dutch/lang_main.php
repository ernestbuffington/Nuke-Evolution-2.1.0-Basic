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

$lang['DATE_FORMAT'] =  'd M Y'; // This should be changed to the default date format for your language, php date() format
$lang['DIRECTION'] = 'ltr';
$lang['ENCODING'] = 'UTF-8';
$lang['LEFT'] = 'Links';
$lang['RIGHT'] = 'rechts';
//
// Auth related entries
//
// Note the %s will be replaced with one of the following 'user' arrays
$lang['Sorry_auth_announce'] = 'Sorry, alleen %s kunnen in dit forum mededelingen plaatsen.';
$lang['Sorry_auth_delete'] = 'Sorry, alleen %s kunnen in dit forum berichten verwijderen.';
$lang['Sorry_auth_edit'] = 'Sorry, alleen %s kunnen in dit forum berichten bewerken.';
$lang['Sorry_auth_post'] = 'Sorry, alleen %s kunnen in dit forum berichten plaatsen.';
$lang['Sorry_auth_read'] = 'Sorry, alleen %s kunnen in dit forum onderwerpen lezen.';
$lang['Sorry_auth_reply'] = 'Sorry, alleen %s kunnen in dit forum antwoorden.';
$lang['Sorry_auth_sticky'] = 'Sorry, alleen %s kunnen in dit forum sticky berichten plaatsen.';
$lang['Sorry_auth_vote'] = 'Sorry, alleen %s kunnen in dit forum stemmen.';
// These replace the %s in the above strings
$lang['Auth_Administrators'] = '<strong>administrators</strong>';
$lang['Auth_Anonymous_Users'] = '<strong>gast gebruikers/strong>';
$lang['Auth_Moderators'] = '<strong>moderators</strong>';
$lang['Auth_Registered_Users'] = '<strong>gerigistreerde gebruikers</strong>';
$lang['Auth_Users_granted_access'] = '<strong>gebruikers met speciale toegangsrechten</strong>';
$lang['Not_Authorised'] = 'Geen toegang';
$lang['Not_Moderator'] = 'U bent geen moderator in dit forum.';
$lang['You_been_banned'] = 'U bent geband van dit forum.<br />Neem contact op met de webmaster of administrator voor meer informatie.';
//
// Common, these terms are used extensively on several pages
//
$lang['1_Day'] = '1 Dag';
$lang['1_Month'] = '1 Maand';
$lang['1_Year'] = '1 Jaar';
$lang['2_Weeks'] = '2 Weken';
$lang['3_Months'] = '3 Maanden';
$lang['6_Months'] = '6 Maanden';
$lang['7_Days'] = '7 Dagen';
$lang['AIM'] = 'AIM Addres';
$lang['Admin_panel'] = 'Ga naar het Administratie Paneel';
$lang['Author'] = 'Auteur';
$lang['Board_disable'] = 'Sorry, dit forum is tijdelijk buiten gebruik.  Probeer het later nog eens.';
$lang['Cancel'] = 'Annuleren';
$lang['Category'] = 'Categorie';
$lang['Click_return_forum'] = 'Klik %shier%s om naar het forum terug te keren';
$lang['Click_return_group'] = 'Klik %shier%s om terug te gaan naar groeps informatie';
$lang['Click_return_login'] = 'Klik %shier%s om opnieuw te proberen';
$lang['Click_return_modcp'] = 'Klik %shier%s om terug te gaan naar het Moderator Controle Paneel';
$lang['Click_return_topic'] = 'Klik %shier%s om terug te gaan naar het bericht'; // %s's here are for uris, do not remove!
$lang['Click_view_message'] = 'Klik %shier%s om uw bericht te lezen';
$lang['Confirm'] = 'Bevestig';
$lang['Could_not_insert_for'] = 'Kon %d niet invoegen voor %d';
$lang['Could_not_optain_for'] = 'Kon %d niet verkrijgen voor %d';
$lang['Could_not_update'] = 'Kon niet updaten %d';
$lang['Disabled'] = 'Uitgeschakeld';
$lang['Email'] = 'E-Mail';
$lang['Enabled'] = 'Ingeschakeld';
$lang['Error'] = 'Fout';
$lang['Forum'] = 'Forum';
$lang['Forum_Index'] = '%s Forum Index';  // eg. sitename Forum Index, %s can be removed if you prefer
$lang['Go'] = 'Ga';
$lang['Goto_page'] = 'Ga naar pagina';
$lang['Hours'] = 'Uren';
$lang['ICQ'] = 'ICQ Nummer';
$lang['IP_Address'] = 'IP Addres';
$lang['Joined'] = 'Toegetreden';
$lang['Jump_to'] = 'Ga naar';
$lang['MSNM'] = 'MSN Messenger';
$lang['Message'] = 'Bericht';
$lang['Next'] = 'Volgende';
$lang['No'] = 'Nee';
$lang['Page_of'] = 'Pagina <strong>%d</strong> van <strong>%d</strong>'; // Replaces with: Page 1 of 2 for example
$lang['Password'] = 'Wachtwoord';
$lang['Post'] = 'Bericht';
$lang['Post_new_topic'] = 'Plaats nieuw onderwerp';
$lang['Posted'] = 'Geplaatst';
$lang['Poster'] = 'Inzender';
$lang['Posts'] = 'Berichten';
$lang['Preview'] = 'Voorbeeld';
$lang['Previous'] = 'Vorige';
$lang['Replies'] = 'Reacties';
$lang['Reply_to_topic'] = 'Reageer op onderwerp';
$lang['Reply_with_quote'] = 'Reageer met quote';
$lang['Reset'] = 'Reset';
$lang['Select_forum'] = 'Selecteer een forum';
$lang['Select_username'] = 'Selecteer een gebruikersnaam';
$lang['Spellcheck'] = 'Spellingscontrole';
$lang['Submit'] = 'Verder';
$lang['Time'] = 'Tijd';
$lang['Topic'] = 'Onderwerp';
$lang['Topics'] = 'Onderwerpen';
$lang['Username'] = 'Gebruikersnaam';
$lang['View_latest_post'] = 'Laatste bericht weergeven';
$lang['View_newest_post'] = 'Nieuwste bericht weergeven';
$lang['Views'] = 'Bekeken';
$lang['YIM'] = 'Yahoo Messenger';
$lang['Yes'] = 'Ja';
//
// Email-Extention
//
$lang['HELLO'] = 'Hallo';
$lang['NEW_ACCOUNT_ACTIVATE_LINK'] = 'Link: <a href="'. $activate_link . '>'. $activate_link .'</a>';
$lang['NEW_ACCOUNT_OBJECT'] = 'Het account van ' . $new_username . ' is gedeactiveerd of is nieuw aangemaakt, controleer de details van deze gebruiker (indien nodig) en activeer deze door de volgende link:';
$lang['REACTIVATE_ACCOUNT_ACTIVATE_LINK'] = 'Link: <a href="'. $activate_link . '>'. $activate_link .'</a>';
$lang['REACTIVATE_ACCOUNT_OBJECT'] = 'Uw account op '. $board_config['sitename'] .' is gedeactiveerd, meest aannemelijk door veranderingen via uw account. Om uw account te heractiveren klik op onderstaande link:';
//
// Errors (not related to a specific failure on a page)
//
$lang['A_critical_error'] = 'Kritieke fout opgetreden';
$lang['Action'] = 'Actie';
$lang['Admin'] = 'Administrator';
$lang['Admin_reauthenticate'] = 'Om het board te adminnistreren dient u zichzelf te herverifiren.';
$lang['All'] = 'Alle';
$lang['An_error_occured'] = 'Er is een fout opgetreden';
$lang['Announcements'] = 'Bekendmakingen';
$lang['BBCode_box_hidden'] = 'Verborgen';
$lang['BBcode_box_hide'] = 'Klik hier om inhoud te verbergen';
$lang['BBcode_box_view'] = 'Klik hier om de inhoud weer te geven';
$lang['Board_Currently_Disabled'] = 'Board is tijdelijk uitgeschakeld';
$lang['Click_return_reports'] = 'Klik %shier%s om terug te keren naar Report Posts control panel.';
$lang['Close'] = 'Sluiten';
$lang['Close_success'] = 'Raporten succesvol geopend/gesloten.';
$lang['Close_window'] = 'Venster sluiten';
$lang['Closed'] = 'Gesloten';
$lang['Closed_by_user_on_date'] = 'Gesloten door %s op %s';
$lang['Comments'] = 'Reacties';
$lang['Comments_explain'] = 'Schrijf AUB een opmerking over uw verslag omtrend dit specifieke bericht.';
$lang['Contract'] = 'Contract';
$lang['Critical_Error'] = 'Kritieke fout';
$lang['Critical_Information'] = 'Kritieke informatie';
$lang['Delete_Explication'] = 'Als een Moderator/Administrator een onderwerp sluit zal het niet langer in het forum weergegeven worden en niemand zal dit kunnen herstellen. <br /><strong>Wees voorzichtig met deze functieo</strong>';
$lang['Delete_success'] = 'Raporten succesvol verwijderd.';
$lang['Deleting_topic'] = 'Verwijder een onderwerp';
$lang['Display'] = 'Alleen weergeven';
$lang['Edit_Explication'] = 'Een Administrator en/of een Moderator kunnen een bericht van een gebruikers wijzigen.';
$lang['Editing_topic'] = 'Bewerk een bericht';
$lang['Emails_Allowed_For_Registered_Only'] = 'Log AUB in om deze E-Mail te bekijken';
$lang['Enter_Forum'] = '%senter%s de forums!';
$lang['Error_Check_Num'] = 'Check nummer is ongeldig<br /><br />U dient zich opnieuw te registreren<br /><br />Klik <a href=\'%s\>hier</a> om te registreren';
$lang['Expand'] = 'Uitbreiden';
$lang['Extra_Info'] = 'Extra Info';
$lang['Forum_advanced_search'] = '%s Geavanceerd zoeken';
$lang['Forums'] = 'Forums';
$lang['GVideo_link'] = 'Link';
$lang['General_Error'] = 'Algemene fout';
$lang['Get_Registered'] = '%sgeregistreerd of%s of ';
$lang['Global_Announcements'] = 'Algemene bekendmakingen';
$lang['Hidden'] = 'Verborgen';
$lang['Image_Blocked'] = 'U heeft er voor gekozen of afbeeldingen te blokkeren.<br />%sBewerk uw profiel%s';
$lang['Images_Allowed_For_Registered_Only'] = 'Log in om deze afbeelding te bekijken.';
$lang['Information'] = 'Informatie';
$lang['Junior'] = 'Junior Admin';
$lang['Last_action_checkbox'] = 'Deze actie is gedaan door de checkbox en de dropdownmenu.';
$lang['Last_action_comments'] = 'Commentaren door moderators';
$lang['Last_action_comments_explain'] = 'Schrijf AUB een opmerking omtrend uw actie over dit specifieke verslag';
$lang['Links_Allowed_For_Registered_Only'] = 'Log in om deze link te bekijken';
$lang['Lock_Explication'] = 'Als een moderator/administrator een onderwerp sluit is het voor een gewone gebruiker niet meer mogelijk om te antwoorden. Alleen moderators/administrators kunnen dit nu nog.';
$lang['Locking_topic'] = 'Onderwerp sluiten';
$lang['Login_Logout'] = 'Inloggen / uitloggen';
$lang['Look_up_User'] = 'Zoek een gebruiker';
$lang['Max_smilies_per_post'] = 'U kunt maar een beperkte aantal %s smiley\'s per bericht gebruikenpost.<br />U heeft %s smiley\'s te veel gebruikt.';
$lang['Messenger'] = 'Messenger';
$lang['Mini_Index'] = 'Forum Index';
$lang['Mod'] = 'Moderator';
$lang['Move_Explication'] = 'Als u er voor kies een onderwerp te verplaatsen kunt een bericht dat zich in forum A bevind, naar forum B verplaatsen. U kunt er voor kiezen om een schaduw onderwerp in forum A achter te laten.';
$lang['Move_edit_message'] = 'Bewerkt: <strong>%s</strong> door <strong>%s</strong>';
$lang['Move_lock_message'] = 'Gesloten: <strong>%s</strong> door <strong>%s</strong>';
$lang['Move_merge_message'] = 'Samengevoegd: <strong>%s</strong> door <strong>%s</strong><br />Van onderwerp <strong>%s</strong> (<strong>%s</strong>)';
$lang['Move_move_message'] = 'Verplaatst: <strong>%s</strong> door <strong>%s</strong><br />Van <strong>%s</strong> naar <strong>%s</strong>';
$lang['Move_split_message'] = 'Gesplitst: <strong>%s</strong> door <strong>%s</strong><br />Van onderwerp Topic <strong>%s</strong> (<strong>%s</strong>)';
$lang['Move_unlock_message'] = 'Heropend: <strong>%s</strong> door<strong>%s</strong>';
$lang['Moving_topic'] = 'Verplaats een onderwerp';
$lang['Newsletter'] = 'Nieuwsbrief per E-Mail ontvangen?';
$lang['No_action_specified'] = 'Er is geen actie gespecificeerd';
$lang['No_newer_posts'] = 'Er zijn geen nieuwere onderwerpen in dit forum';
$lang['No_older_posts'] = 'Er zijn geen oudere onderwerpen in dit forum';
$lang['Non_existent_posts'] = 'Gevonden en verwijderde %s overige raporten die naar non-existent (geschrapt) berichten verwijzen';
$lang['Offline'] = 'Offline';
$lang['Online'] = 'Online';
$lang['Online_status'] = 'Status';
$lang['Open'] = 'Open';
$lang['Open_quick_reply'] = 'Open Quick Reply Form automatisch';
$lang['Opened'] = 'Open';
$lang['Opened_by_user_on_date'] = 'Geopend door %s op %s';
$lang['Opt_in'] = 'E-Mails ontvangen wanneer een rapport is verstuurd';
$lang['Opt_out'] = 'E-Mails uit zodat je niet langer emails ontvangt wanneer een rapport is verstuurd';
$lang['Opt_success'] = 'E-Mail bevestiging succesvol geactiveerd/gedeactiveerd.';
$lang['Period'] = 'sinds <strong>%d</strong> dagen'; // %d = days
$lang['Post_already_reported'] = 'Deze inzending is reeds gemeld.';
$lang['Post_global_announcement'] = 'Algemen bekendmaking';
$lang['Post_reported'] = 'Berichten raporteren was succesvol gemeld.';
$lang['Post_reports_many_cp'] = 'Er zijn %s open meldingen';
$lang['Post_reports_none_cp'] = 'Er zijn geen geopende meldingen';
$lang['Post_reports_one_cp'] = 'Er is %s open meldingen';
$lang['Post_review'] = 'Testbericht schrijven';
$lang['Previous_comments'] = 'Vorige commentaar';
$lang['Quick_Reply'] = 'Snel antwoord';
$lang['Quick_reply_mode'] = 'Snel antwoord Mode';
$lang['Quick_reply_mode_advanced'] = 'Geavanceerd';
$lang['Quick_reply_mode_basic'] = 'Basic';
$lang['Quick_reply_panel'] = 'Super snel antwoord Mod';
$lang['Quick_search_at'] = 'op';
$lang['Quick_search_for'] = 'Zoeken naar';
$lang['Rank_title'] = 'Rank Titel';
$lang['Real_Name'] = 'Echte naam:';
$lang['Recent_click_return'] = 'Klik %shier%s om naar de recente site terug te gaan.';
$lang['Recent_days'] = 'Dagen';
$lang['Recent_first'] = 'gestart op %s';
$lang['Recent_first_poster'] = ' door %s';
$lang['Recent_last'] = 'laatste';
$lang['Recent_last24'] = 'Laatste 24 uur';
$lang['Recent_lastXdays'] = 'Laatste %s dagen';
$lang['Recent_lastweek'] = 'Laatste week';
$lang['Recent_no_topics'] = 'Geen onderwerpen gevonden.';
$lang['Recent_select_mode'] = 'Selecteer mode:';
$lang['Recent_showing_posts'] = 'Onderwerpen weergeven:';
$lang['Recent_title_last24'] = ' van de laatste 24 uur';
$lang['Recent_title_lastXdays'] = ' van de laatste %s dagen'; // %s = days
$lang['Recent_title_lastweek'] = ' van de laatste week';
$lang['Recent_title_more'] = '<font size="4">%s</font> onderwerpen %s'; // %s = topics; %s = sort method
$lang['Recent_title_one'] = '<font size="4">%s</font> onderwerpen %s'; // %s = topics; %s = sort method
$lang['Recent_title_today'] = ' van vandaag';
$lang['Recent_title_yesterday'] = ' van gisteren';
$lang['Recent_today'] = 'Vandaag';
$lang['Recent_topics'] = 'Recente onderwerpen';
$lang['Recent_wrong_mode'] = 'U heeft een verkeerde mode geselecteerd.';
$lang['Recent_yesterday'] = 'Gisteren';
$lang['Report_comment'] = 'Opmerkingen met betrekking tot uw actie';
$lang['Report_email'] = 'Stuur een E-Mail wanneer er ene bericht geplaatst is';
$lang['Report_not_selected'] = 'U heeft geen enkele raport geselecteerd.';
$lang['Report_post'] = 'Bericht melden';
$lang['Reporter'] = 'Verzonden door';
$lang['Rules'] = 'Board Regels';
$lang['Rules_title'] = 'Actie : %s';
$lang['Search_subject_only'] = 'Zoek alleen onderwerp van het bericht';
$lang['Select'] = 'Selecteer';
$lang['Select_one'] = 'Selecteer een';
$lang['Show_avatars'] = 'Avatars in onderwerpen weergeven';
$lang['Show_hide_quick_reply_form'] = 'Weergeven/verbergen van snelle antwoord form';
$lang['Show_quick_reply'] = 'Snelle antwoord form weergeven';
$lang['Show_signatures'] = 'Handtekeningen in onderwerpen weergeven';
$lang['Split_Explication'] = 'Splitsen van een onderwerp dat veel pagina\'s heeft geeft u de mogelijkheid om uw onderwerpen meer te organiseren.';
$lang['Spliting_topic'] = 'Spits een onderwerp';
$lang['Staff'] = 'Medewerkers';
$lang['Status'] = 'Status';
$lang['Status_locked']   = 'Gesloten';
$lang['Status_unlocked'] = 'Heropend';
$lang['Sticky_Topics'] = 'Sticky onderwerpen';
$lang['Super'] = 'Super Moderator';
$lang['Theme'] = 'Thema';
$lang['Topic_global_announcement']='<strong>Algemene mededeling:</strong>';
$lang['Unlock_Explication'] = 'Een moderator/administrator kan een gesloten onderwerp heropenen. Daardoor kunnen ale gebruikers weer op een onderwerp reageren.';
$lang['Unlocking_topic'] = 'Heropen een onderwerp';
$lang['Version_check'] = 'Controleer voor de nieuwste versie';
$lang['View_next_post'] = 'Volgende berichten weergeven';
$lang['View_post'] = 'Onderwerp weergeven';
$lang['View_post_reports'] = 'Lijst van de gerapporteerde berichten';
$lang['View_previous_post'] = 'Vorige berichten weergeven';
$lang['Welcome_PM'] = 'Instellen als een welkoms bericht';
$lang['Welcome_PM_Admin'] = 'Welkoms bericht';
$lang['Welcome_PM_Set'] = 'Uw welkomsbericht is ingesteld';
$lang['XData_error_obtaining_group_data'] = 'Fout bij het verkrijgen van groepsgegevens';
$lang['XData_error_obtaining_new_field_info'] = 'Kon geen field_order en field_id voor nieuw veld krijgen.';
$lang['XData_error_obtaining_user_xdata'] = 'Fout bij het verkrijgen van user\'s XData';
$lang['XData_error_obtaining_userdata'] = 'Fout bij het vinden van een user\'s XData veld om te bewerken';
$lang['XData_error_obtaining_usergroup'] = 'Fout bij het verkrijgen van gebruikersgroep';
$lang['XData_error_updating_auth'] = 'Fout bij het updaten van de tabel Auth';
$lang['XData_error_updating_fields'] = 'Fout bij het updaten van de tabel Veld';
$lang['XData_failure_inserting_data'] = 'Fout bij toevoegen van data';
$lang['XData_failure_obtaining_field_auth'] = 'Fout bij het verkrijgen van de tabel Auth';
$lang['XData_failure_obtaining_field_data'] = 'Fout bij het verkrijgen van de tabel Data';
$lang['XData_failure_obtaining_user_auth'] = 'Fout bij het verkrijgen Auth voor gebruiker';
$lang['XData_failure_removing_data'] = 'Fout bij het verwijderen van data';
$lang['XData_field_non_existant'] = 'Veld bestaat niet';
$lang['XData_invalid'] = 'De opgegeven waarde voor %s is ongeldig.';
$lang['XData_no_field_selected'] = 'U heeft geen veld geselecteerd';
$lang['XData_success_updating_permissions'] = 'Permissiess succesvolg geupdate <br /><br /> Klik %shier%s om naar het veld permissies ter te keren <br /><br />';
$lang['XData_too_long'] = 'Uw %s is te lang.';
$lang['XData_unable_to_switch_fields'] = 'wisselen van velden is niet mogelijk';
$lang['false'] = 'Fout';
$lang['glance_show'] = 'At a Glance weergeven(Recente onderwerpen)<br />';
$lang['is_hidden'] = '%s is verborgen';
$lang['is_offline'] = '%s is offline';
$lang['is_online'] = '%s is nu online';
$lang['show_glance_option']['0'] = 'Geen';
$lang['show_glance_option']['1'] = 'Allemaal';
$lang['show_glance_option']['10'] = 'Index, Categorie en Forum';
$lang['show_glance_option']['2'] = 'Alleen index';
$lang['show_glance_option']['3'] = 'Alleen forums';
$lang['show_glance_option']['4'] = 'Alleen onderwerpen';
$lang['show_glance_option']['5'] = 'Index en onderwerpen';
$lang['show_glance_option']['6'] = 'Index en forums';
$lang['show_glance_option']['7'] = 'Forums en onderwerpen';
$lang['show_glance_option']['8'] = 'Alleen categorie';
$lang['show_glance_option']['9'] = 'Index en categorie';
$lang['sig_current'] = 'Huidige handtekening';
$lang['sig_description'] = 'Handtekening bewerken (<strong>voorzien van een voorbeeld</strong>)';
$lang['sig_edit'] = 'Handtekening bewerken';
$lang['sig_none'] = 'Geen handtekening beschikbaar';
$lang['sig_save'] = 'Opslaan';
$lang['sig_save_message'] = 'Handtekening succesvol opgeslagen !';
$lang['sqr']['0'] = 'Nee';
$lang['sqr']['1'] = 'Ja';
$lang['sqr']['2'] = 'Alleen op de laatste pagina';
$lang['topic_glance_priority'] = 'Toon dit bericht bij Recente berichten';
$lang['true'] = 'Waar';
$lang['user_hide_images'] = 'Verborgen afbeeldingen in forums';
$lang['youtube_link'] = 'Link';
//
// FAQ & Rules
//
$lang['BBCode_attach'] = 'Bijlage handleiding';
$lang['BBCode_rules'] = 'Code Of Conduct';
$lang['Edit_Profile_Menu_title'] = 'Mijn profiel bewerken';
$lang['dhtml_faq_noscript'] = "Het lijkt erop dat uw browser geen Javascripts ondersteund of deze is uitgeschakeld in uw browserinstellingen.<br /><br />Klik %sHIER%s om een simpele HTML versie te bekijken.";
$lang['panel_feel']['0'] = 'Uit';
$lang['panel_feel']['1'] = 'Rechts';
$lang['panel_feel']['2'] = 'Links';
//
// Global Header strings
//
$lang['Admin_online_color'] = '%sAdministrator%s';
$lang['BBCode_guide'] = 'BBCode handleiding';
$lang['Browsing_forum'] = 'Gebruikers op dit forum:';
$lang['Current_time'] = 'DE tijd is nu %s'; // %s replaced by time
$lang['Edit_profile'] = 'Bewerk uw profiel';
$lang['FAQ'] = 'Forum FAQ';
$lang['Guest_user_total'] = '%d Gast';
$lang['Guest_users_total'] = '%d Gasten';
$lang['Guest_users_zero_total'] = '0 Gasten';
$lang['Hidden_user_total'] = '%d verborgen en ';
$lang['Hidden_users_total'] = '%d verborgen en ';
$lang['Hidden_users_zero_total'] = '0 verborgen en ';
$lang['Last_Post'] = 'Laatste bericht';
$lang['Memberlist'] = 'Leden';
$lang['Mod_online_color'] = '%sModerator%s';
$lang['Moderator'] = 'Moderator';
$lang['Moderators'] = 'Moderators';
$lang['Online_user_total'] = 'Er is in totaal <strong>%d</strong> gebruiker online :: ';
$lang['Online_users_total'] = 'Er zijn in totaal <strong>%d</strong> gebruikers online :: ';
$lang['Online_users_zero_total'] = 'Er zijn in totaal <strong>0</strong> gebruikers online :: ';
$lang['Profile'] = 'Profiel';
$lang['Record_online_users'] = 'Meeste gebruikers ooit online waren <strong>%s</strong> op %s'; // first %s = number of users, second %s is the date.
$lang['Reg_user_total'] = '%d geregistreerd, ';
$lang['Reg_users_total'] = '%d geregistreerd, ';
$lang['Reg_users_zero_total'] = '0 geregistreerd, ';
$lang['Register'] = 'Registreer';
$lang['Registered_users'] = 'Geregistreerde gebruikers:';
$lang['Search'] = 'Zoeken';
$lang['Search_new'] = 'Berichten weergeven na uw laatste bezoek';
$lang['Search_unanswered'] = 'Onbeantwoorde bericht weergeven';
$lang['Search_your_posts'] = 'Uw berichten weergeven';
$lang['Statistics'] = 'Statistieken';
$lang['Usergroups'] = 'Gebruikersgroepen';
$lang['Viewonline'] = 'Wie is er online';
$lang['You_last_visit'] = 'Uw laatste bezoek was op %s'; // %s replaced by date/time
$lang['rmw_image_title'] = 'Klik voor volledige weergave';
//
// Group control panel
//
$lang['Add_member'] = 'Lid toevoegen';
$lang['Already_member_group'] = 'U bent al lid van deze groep';
$lang['Approve_selected'] = 'Goedkeuren van geselecteerde';
$lang['Are_group_moderator'] = 'U bent de groeps moderator';
$lang['Confirm_unsub'] = 'Weet u het zeker om u af te melden van deze groep?';
$lang['Confirm_unsub_pending'] = 'Uw toegang tot deze groep is nog niet goedgekeurd; Weet u het zeker om u af te melden van deze groep?';
$lang['Could_not_add_user'] = 'De door u geselecteerde gebruiker bestaat niet.';
$lang['Could_not_anon_user'] = 'U kunt geen gast een groepslid maken.';
$lang['Current_memberships'] = 'Huidige lidmaatschappen';
$lang['Deny_selected'] = 'Geselecteerde negeren';
$lang['Group_Control_Panel'] = 'Groeps controle paneel';
$lang['Group_Information'] = 'Groeps informatie';
$lang['Group_Members'] = 'Groepsleden';
$lang['Group_Moderator'] = 'Groepsmoderator';
$lang['Group_added'] = 'U bent tot deze groep toegelaten.';
$lang['Group_approved'] = 'Uw verzoek is goedgekeurd.';
$lang['Group_closed'] = 'Gesloten groep';
$lang['Group_description'] = 'Groeps omschrijving';
$lang['Group_hidden'] = 'Verborgen groep';
$lang['Group_hidden_members'] = 'Deze groep is verborgen; u kunt het lidmaatschap niet bekijken';
$lang['Group_joined'] = 'U hebt succesvol aangemeld voor deze groep.<br />U krijgt bericht wanneer dit is goedgekeurd door de groep moderator.';
$lang['Group_member_details'] = 'Details groepslidmaatschap';
$lang['Group_member_join'] = 'Een groep toetreden';
$lang['Group_membership'] = 'Groepslidmaatschap';
$lang['Group_name'] = 'Groepsnaam';
$lang['Group_not_exist'] = 'Deze gebruikersgroep bestaat niet';
$lang['Group_open'] = 'Open groep';
$lang['Group_request'] = 'Een verzoek tot toetreding van een groep is verstuurd.';
$lang['Group_type'] = 'Type groep';
$lang['Group_type_updated'] = 'Type groep succesvol geupdate.';
$lang['Groups'] = 'Groepen';
$lang['Join_auto'] = 'U kan zich aansluiten bij deze groep, omdat uw berichten aantal voldoen aan de groepscriteria ';
$lang['Join_group'] = 'Toetreden tot een groep';
$lang['Login_to_join'] = 'Log in om tot de groep toe te treden of om de groepslidmaatschappen te bewerken';
$lang['Member_this_group'] = 'U bent lid van deze groep';
$lang['Memberships_pending'] = 'Afwachtende lidmaatschappen';
$lang['No_add_allowed'] = 'Automatische toetreden van gebruikers is niet toegestaan';
$lang['No_group_members'] = 'Deze groep heeft geen leden';
$lang['No_groups_exist'] = 'Er bestaan geen groepen';
$lang['No_more'] = 'Er worden geen gebruikers meer geaccepteerd';
$lang['No_pending_group_members'] = 'Deze groep heeft geen wachtende leden';
$lang['Non_member_groups'] = 'Geen groepsleden';
$lang['None'] = 'Geen';
$lang['Not_group_moderator'] = 'U bent niet de groepsmoderator, daarom kunt u deze actie niet uitvoeren.';
$lang['Not_logged_in'] = 'U moet eerst inloggen om een groep toe te treden.';
$lang['Pending_members'] = 'Wachtende leden';
$lang['Pending_this_group'] = 'U staat in de wacht voor toetreding tot een gebruikersgroep';
$lang['Remove_selected'] = 'Verwijder geselecteerde';
$lang['Subscribe'] = 'Aanmelden';
$lang['This_closed_group'] = 'Dit is een gesloten groep: %s';
$lang['This_hidden_group'] = 'Dit is een verborgen groep: %s';
$lang['This_open_group'] = 'Dit is een open groep: Klik om lid te worden';
$lang['Unsub_success'] = 'U bent van deze groep uitgeschreven.';
$lang['Unsubscribe'] = 'Uitschrijven';
$lang['User_is_member_group'] = 'Gebruikers is al lid van deze groep';
$lang['View_Information'] = 'Informatie weergeven';
//
// Index page
//
$lang['Forums_marked_read'] = 'Alle forums als gelezen gemarkeerd';
$lang['Index'] = 'Index';
$lang['Mark_all_forums'] = 'Markeer alle forums als gelezen';
$lang['No_Posts'] = 'Geen berichten';
$lang['No_forums'] = 'Dit board heeft geen forums';
$lang['Private_Message'] = 'Prive bericht';
$lang['Private_Messages'] = 'Prive berichten';
$lang['Who_is_Online'] = 'Wie is er online';
//
// Login
//
$lang['Enter_password'] = 'Geef uw gebruikersnaam en wachtwoord op om in te loggen.';
$lang['Error_login'] = 'U heeft een incorrecte of inactieve gebruikersnaam of een ongeldig wachtwoord opgegeven.';
$lang['Forgotten_password'] = 'Wachtwoord vergeten';
$lang['Log_me_in'] = 'Automatisch bij elk bezoek inloggen';
$lang['Login'] = 'Inloggen';
$lang['Logout'] = 'Uitloggen';
$lang['Wrong Security Code'] = 'De veveiligings code is incorrect';
//
// Memberslist
//
$lang['Order'] = 'Volgorde';
$lang['Select_sort_method'] = 'Selecteer sorteer volgorde';
$lang['Sort'] = 'Sorteer';
$lang['Sort_Ascending'] = 'Oplopend';
$lang['Sort_Descending'] = 'Aflopend';
$lang['Sort_Email'] = 'E-Mail';
$lang['Sort_Joined'] = 'Registratie datum';
$lang['Sort_Location'] = 'Herkomst';
$lang['Sort_Posts'] = 'Totale berichten';
$lang['Sort_Top_Ten'] = 'Top Tien auteurs';
$lang['Sort_Username'] = 'Gebruikersnaam';
$lang['Sort_Website'] = 'Website';
//
// Moderator Control Panel
//
$lang['Confirm_delete_topic'] = 'Weet u het zeker om de geselecteerde berichten te verwijderen?';
$lang['Confirm_lock_topic'] = 'Weet u het zeker om de geselecteerde berichten te sluiten?';
$lang['Confirm_move_topic'] = 'Weet u het zeker om de geselecteerde berichten te verplaatsen?';
$lang['Confirm_unlock_topic'] = 'Weet u het zeker om de geselecteerde berichten te heropenen?';
$lang['Delete'] = 'Verwijder';
$lang['IP_info'] = 'IP Informatie';
$lang['Leave_shadow_topic'] = 'Laat schaduw onderwerpen in het oude forum.';
$lang['Lock'] = 'Sluiten';
$lang['Lookup_IP'] = 'Kijk naar IP addres';
$lang['Mod_CP'] = 'Moderator Controle Paneel';
$lang['Mod_CP_explain'] = 'Met behulp van de onderstaande formulier kunt u in dit forum vele moderatie handelingen verrichten. U kunt sluiten, heropenen, verplaatsen, verwijder of berichten voorrang verlenen.';
$lang['Move'] = 'Verplaats';
$lang['Move_to_forum'] = 'Verplaats naar forum';
$lang['New_forum'] = 'Nieuw forum';
$lang['No_Topics_Moved'] = 'Geen berichten verplaatst.';
$lang['None_selected'] = 'U heeft geen berichten geselecteerd voor deze handeling. Ga terug en selecteer tenminste een.';
$lang['Other_IP_this_user'] = 'Andere IP adressen van deze gebruiker';
$lang['Prioritize'] = 'Prioriteiten stellen';
$lang['Priority'] = 'Prioriteit';
$lang['Select'] = 'Selecteer';
$lang['Split_Topic'] = 'Splits berichten Controle Paneel';
$lang['Split_Topic_explain'] = 'Met behulp van de onderstaande formulier kunt u een bericht in tweeÃ«n splitsen door of de berichten individueel te selecteren of door het splisen van een geselecteerde bericht';
$lang['Split_after'] = 'Splitsen van een selecteerde bericht';
$lang['Split_forum'] = 'Forum voor een nieuw onderwerp';
$lang['Split_posts'] = 'Splits geselecteerde bericht';
$lang['Split_title'] = 'Nieuwe titel voor bericht';
$lang['This_posts_IP'] = 'IP address van dit bericht';
$lang['Too_many_error'] = 'U heeft te veel berichten geselecteerd. U kunt slechts een bericht selecteren om te splisen na!';
$lang['Topic_split'] = 'Het geselecteerde onderwerp is succesvol gesplitst';
$lang['Topics_Locked'] = 'Het geselecteerde onderwerpen zijn gesloten.';
$lang['Topics_Moved'] = 'De geselecteerde onderwerpen zijn verplaatst.';
$lang['Topics_Prioritized'] = 'De geselecteerde onderwerpen hebben prioriteit gekregen.';
$lang['Topics_Removed'] = 'De geselecteerde onderwerpen zijn succesvol verwijderd uit de database.';
$lang['Topics_Unlocked'] = 'De geselecteerde onderwerpen zijn heropend.';
$lang['Unlock'] = 'Heropen';
$lang['Users_this_IP'] = 'Gebruikers IP van dit bericht';
//
// Posting/Replying (Not private messaging!)
//
$lang['Add_option'] = 'Optie toevoegen';
$lang['Add_poll'] = 'Poll toevoegen';
$lang['Add_poll_explain'] = 'Als u geen poll aan uw bericht wilt koppelen dient u de velden leeg te laten.';
$lang['Already_voted'] = 'U heeft al gestemt op deze poll.';
$lang['Attach_signature'] = 'Handtekening toevoegen (handtekeningen kunnen in uw profiel gwijzigd worden)';
$lang['BBCode_is_OFF'] = '%sBBCode%s is <u>UIT</u>';
$lang['BBCode_is_ON'] = '%sBBCode%s is <u>AAN</u>'; // %s are replaced with URI pointing to FAQ
$lang['Cannot_delete_poll'] = 'Sorry, u kunt geen actieve poll verwijderen.';
$lang['Cannot_delete_replied'] = 'Sorry, u kunt geen berichten verwijderen die beantwoord zijn.';
$lang['Confirm_delete'] = 'weet u het zeker om dit bericht te verwijderen?';
$lang['Confirm_delete_poll'] = 'Weet u het zeker om deze poll te verwijderen?';
$lang['Days'] = 'Dagen'; // This is used for the Run poll for ... Days + in admin_forums for pruning
$lang['Delete'] = 'Verwijder';
$lang['Delete_own_posts'] = 'Sorry, u kunt alleen eigen berichten verwijderen.';
$lang['Delete_poll'] = 'Verwijder poll';
$lang['Deleted'] = 'Uw bericht is succesvol verwijderd.';
$lang['Disable_BBCode_post'] = 'BBCode in dit bericht uitschakelen';
$lang['Disable_HTML_post'] = 'HTML in dit bericht uitschakelen';
$lang['Disable_Smilies_post'] = 'Smilies in dit bericht uitschakelen';
$lang['Edit_Post'] = 'Bericht bewerken';
$lang['Edit_own_posts'] = 'Sorry, u kunt alleen uw eigen berichten bewerken.';
$lang['Emoticons'] = 'Emoticons';
$lang['Empty_message'] = 'U dient een bericht in te type alvorens u het kunt versturen.';
$lang['Empty_poll_title'] = 'U dient voor de poll een titel op te geven.';
$lang['Empty_subject'] = 'U dient een onderwerp op te geven.';
$lang['Flood_Error'] = 'U kunt zo snel achter elkaar geen berichten plaatsen, wacht even en probeer het opnieuw.';
$lang['Forum_locked'] = 'Dit forum is gesloten, u kunt hierdoor geen berichten plaatsen of bewerken.';
$lang['HTML_is_OFF'] = 'HTML is <u>UIT</u>';
$lang['HTML_is_ON'] = 'HTML is <u>AAN</u>';
$lang['Message_body'] = 'Body berichten';
$lang['No_post_id'] = 'U dient een bericht selecteren om te bewerken';
$lang['No_post_mode'] = 'Geen wijze van verturen gekozen'; // If posting.php is called without a mode (newtopic/reply/delete/etc, shouldn't be shown normaly)
$lang['No_such_post'] = 'Er is geen dergelijke post. Probeer het later nog eens.';
$lang['No_topic_id'] = 'U dient een onderwerp te selecteren om op te reageren';
$lang['No_valid_mode'] = 'U kunt alleen berichten paatsen, beantwoorden, bewerken of quote gebruiken. Ga terug en probeer het opnieuw.';
$lang['No_vote_option'] = 'U dient voor het stemmen een optie te selecteren.';
$lang['Notify'] = 'Laat me weten wanneer er gereageerd is';
$lang['Options'] = 'Opties';
$lang['Poll_delete'] = 'Uw poll is succesvol verwijderd.';
$lang['Poll_for'] = 'Start een poll voor';
$lang['Poll_for_explain'] = '[ Type 0 of laat dit leeg voor een permanente poll ]';
$lang['Poll_option'] = 'Poll opties';
$lang['Poll_question'] = 'Vraag';
$lang['Poll_view_toggle'] = 'Bekijken toestaan';
$lang['Poll_view_toggle_explain'] = '[ Staat toe dat gebruikers de resultaten voor het stemmen kunnen bekijken. ]';
$lang['Post_Announcement'] = 'Bekendmaking';
$lang['Post_Normal'] = 'Normaal';
$lang['Post_Sticky'] = 'Sticky';
$lang['Post_a_new_topic'] = 'Plaats een nieuw bericht';
$lang['Post_a_reply'] = 'Beantwoorde';
$lang['Post_has_no_poll'] = 'Dit bericht heeft geen poll.';
$lang['Post_topic_as'] = 'Plaats bericht als';
$lang['Smilies_are_OFF'] = 'Smiley\'s zijn <u>UIT</u>';
$lang['Smilies_are_ON'] = 'Smiley\'s zijn <u>AAN</u>';
$lang['Stored'] = 'Uw bericht is met succes ingevoerd.';
$lang['To_few_poll_options'] = 'U dient tenminste twee poll opties op te geven.';
$lang['To_many_poll_options'] = 'U heeft te veel poll opties ingevoerd.';
$lang['Topic_locked'] = 'Dit onderwerp is gesloten.';
$lang['Topic_reply_notification'] = 'Berichtgeving van beantwoord bericht';
$lang['Topic_review'] = 'Voorbeeld onderwerp';
$lang['Update'] = 'Update';
$lang['Vote_cast'] = 'Uw stem is uitgebracht.';
$lang['glance_news_heading'] = 'Laatste nieuws van deze site';
$lang['glance_next'] = 'Volgende';
$lang['glance_none'] = 'Geen nieuws';
$lang['glance_previous'] = 'Vorige';
$lang['glance_recent_heading'] = 'Recente onderwerpen';
//
// Private Messaging
//
$lang['All_Messages'] = 'Alle berichten';
$lang['Cannot_send_privmsg'] = 'Sorry, maar de administrator heeft het versturen van prive berichten uitgeschakeld.';
$lang['Click_return_inbox'] = 'Klik %shier%s om terug te gaan naar uw Inbox';
$lang['Click_return_index'] = 'Klik %shere%s om terug te gaan naar de indexpagina';
$lang['Click_return_profile'] = 'Klik %shier%s om terug te gaan naar uw profiel';
$lang['Click_view_privmsg'] = 'Klik %shier%s om uw inbox te bezoeken';
$lang['Confirm_delete_pm'] = 'Weet u het zeker om dit bericht te verwijderen?';
$lang['Confirm_delete_pms'] = 'Weet u het zeker om deze berichten te verwijderen?';
$lang['Date'] = 'Datum';
$lang['Delete_all'] = 'Allemaal verwijderen';
$lang['Delete_marked'] = 'Verwijder geselecteerde';
$lang['Delete_message'] = 'Verwijder bericht';
$lang['Disable_BBCode_pm'] = 'BBCode in dit bericht uitschakelen';
$lang['Disable_HTML_pm'] = 'HTML in dit bericht uitschakelen';
$lang['Disable_Smilies_pm'] = 'Smiley\'s in dit bericht uitschakelen';
$lang['Display_messages'] = 'Display messages from previous'; // Followed by number of days/weeks/months
$lang['Edit_message'] = 'Prive bericht berwerken';
$lang['Edit_pm'] = 'Bewerk prive bericht';
$lang['Find'] = 'Zoek';
$lang['Find_username'] = 'Zoek een gebruikersnaam';
$lang['Flag'] = 'Vlag';
$lang['From'] = 'Van';
$lang['Inbox'] = 'Inbox';
$lang['Inbox_size'] = 'Uw Inbox is %d%% vol'; // eg. Your Inbox is 50% full
$lang['Login_check_pm'] = 'Log in om uw prive berichten te controleren';
$lang['Mark'] = 'Markeer';
$lang['Mark_all'] = 'Markeer allemaal';
$lang['Message_sent'] = 'Uw bericht is verzonden.';
$lang['New_pm'] = '%d nieuw bericht'; // You have 1 new message
$lang['New_pms'] = '%d nieuwe berichten'; // You have 2 new messages
$lang['No_folder'] = 'Geen map opgegeven';
$lang['No_match'] = 'Geen overeenkomsten gevonden.';
$lang['No_messages_folder'] = 'U heeft geen berichten in deze map';
$lang['No_new_pm'] = 'Geen nieuwe berichten';
$lang['No_post_id'] = 'Bericht ID was niet opgegeven';
$lang['No_such_folder'] = 'Opgegeven map bestaat niet';
$lang['No_such_user'] = 'Sorry, opgegeven gebruiker bestaat niet.';
$lang['No_to_user'] = 'U dient een geadresseerde op te geven.';
$lang['No_unread_pm'] = 'Geen ongelezen berichten';
$lang['Notification_subject'] = 'Nieuw prive bericht binnengekomen!';
$lang['Outbox'] = 'Outbox';
$lang['PM_disabled'] = 'Prive bericht zijn uitgeschakeld.';
$lang['Post_new_pm'] = 'Plaats bericht';
$lang['Post_quote_pm'] = 'Quote bericht';
$lang['Post_reply_pm'] = 'Bericht beantwoorden';
$lang['Private_Messaging'] = 'Prive berichten';
$lang['Read_message'] = 'Lees bericht';
$lang['Read_pm'] = 'Lees bericht';
$lang['Save_marked'] = 'Gemarkeerde opslaan';
$lang['Save_message'] = 'Bericht opslaan';
$lang['Savebox'] = 'Savebox';
$lang['Savebox_size'] = 'Uw Savebox is %d%% vol';
$lang['Saved'] = 'Opgeslagen';
$lang['Send_a_new_message'] = 'Nieuw prive bericht versturen';
$lang['Send_a_reply'] = 'Prive bericht beantwoorden';
$lang['Sent'] = 'Verzenden';
$lang['Sentbox'] = 'Verzonden items';
$lang['Sentbox_size'] = 'Uw verzonden itemsbox is %d%% vol';
$lang['Subject'] = 'Onderwerp';
$lang['To'] = 'Naar';
$lang['Unmark_all'] = 'Deselecteer allemaal';
$lang['Unread_message'] = 'Ongelezen bericht';
$lang['Unread_pm'] = '%d ongelezen bericht';
$lang['Unread_pms'] = '%d ongelezen berichten';
$lang['You_new_pm'] = '%d nieuw prive bericht';// You have 1 new message
$lang['You_new_pms'] = '%d nieuwe prive berichten';// You have 2 new messages
$lang['You_no_new_pm'] = 'Geen nieuwe prive berichten';
//
// Profiles/Registration
//
$lang['About_user'] = 'Alles over %s'; // %s is username
$lang['Account_activated_subject'] = 'Account geactiveerd';
$lang['Account_active'] = 'Uw account is nu geactiveerd. Bedankt voor uw registratie';
$lang['Account_active_admin'] = 'Het account is nu geactiveerd';
$lang['Account_added'] = 'Bedankt voor uw registratie. Uw account is aangemaakt. U kunt nu inloggen met uw gebruikersnaam en wachtwoord';
$lang['Account_inactive'] = 'Uw account is aangemaakt, maar dient alleen nog geactiveerd te worden. Er is via de E-Mail een activatiecode naar u verstuurd. Lees deze E-Mail voor verdere informatie';
$lang['Account_inactive_admin'] = 'U account is aangemaakt, maar een administrator dient deze nog te activeren. Wanneer hij uw account geactiveerd heeft word u per E-Mail hierover geinformeerd';
$lang['Agree_not'] = 'Ik ga niet accoord met de voorwaarden';
$lang['Agree_over_13'] = 'Ik ga accoord met de voorwaarden en ik ben <strong>ouder</strong> of <strong>op dit moment</strong> 13 jaar';
$lang['Agree_under_13'] = 'Ik ga accoord met de voorwaarden en ik ben <strong>jonger</strong> dan 13 jaar';
$lang['Already_activated'] = 'U heeft uw account al geactiveerd';
$lang['Always_add_sig'] = 'Altijd mijn handtekening toevoegen';
$lang['Always_bbcode'] = 'Altijd BBCode gebruiken';
$lang['Always_html'] = 'Altijd HTML gebruiken';
$lang['Always_notify'] = 'Altijd mij op de hoogte houden bij antwoorden';
$lang['Always_notify_explain'] = 'Stuurt een E-Mail als iemand reageert op een onderwerp waarin je gepost hebt in. Dit kan veranderd worden als je een bericht schrijft.';
$lang['Always_smile'] = 'Altijd Smiley\'s toestaan';
$lang['Avatar'] = 'Avatar';
$lang['Avatar_URL'] = 'URL van Avatar afbeelding';
$lang['Avatar_explain'] = 'Toont een kleine afbeelding onder uw gegevens in uw bericht. Dit kan maar een afbeelding per keer zijn. De afmetingen van de afbeeldingen zijn begrenst op een maximun van %d pixels breed en %d pixels hoog. Geuploade avatars hebben een limiet van %d KB, en moet minder dan of gelijk aan de maximale afmetingen. Externe avatars worden automatisch geschaald naar deze afmetingen.';
$lang['Avatar_filesize'] = 'De bestandsgrootte van de avatar moet kleiner zijn dan %d KB'; // The avatar image file size must be less than 6 KB
$lang['Avatar_filetype'] = 'De avatar bestandstype mag alleen .jpg, .gif of .png zijn';
$lang['Avatar_gallery'] = 'Avatar gallery';
$lang['Avatar_imagesize'] = 'De avatar moet minder dan %d pixels wbreed en %d pixels hoog zijn';
$lang['Avatar_panel'] = 'Avatar controle paneel';
$lang['Board_lang'] = 'Board taal';
$lang['Board_style'] = 'Board Style';
$lang['CC_email'] = 'Een copy van deze E-Mail naar mijzelf verdzenden';
$lang['COPPA'] = 'Uw account is aangemaakt maar moet worden goedgekeurd. Controleer uw E-Mail voor details.';
$lang['Confirm_password'] = 'Wachtwoord bevestigen';
$lang['Confirm_password_explain'] = 'U moet uw huidige wachtwoord bevestigen als u deze of uw E-Mailadres wilt wijzigen';
$lang['Contact'] = 'Contact';
$lang['Current_Image'] = 'Huidige afbeelding';
$lang['Current_password'] = 'Huidig wachtwoord';
$lang['Current_password_mismatch'] = 'Het huidige wachtwoord die u hebt opgegeven komt niet overeen met het opgeslagen wachtwoord in de database.';
$lang['Date_format'] = 'Datum formaat';
$lang['Date_format_explain'] = 'De gebruikte syntaxis is identiek aan de PHP <a href=\'http://www.php.net/date\' onclick=\'window.open(this.href,\"_blank\"); return false;\'>date()</a> functie.';
$lang['Delete_Image'] = 'Verwijder afbeelding';
$lang['Email_address'] = 'E-Mail addres';
$lang['Email_banned'] = 'Sorry, maar dit E-Mail adres is gebant.';
$lang['Email_invalid'] = 'Sorry, ongeldig E-Mailadres.';
$lang['Email_message_desc'] = 'Dit bericht zal worden verzonden als eenvoudige tekst, dus geen HTML of BBCode invoegen. Uw E-Mailadres zal als antwoordadres van dit bericht ingesteld worden.';
$lang['Email_sent'] = 'E-Mailbericht is verzonden.';
$lang['Email_taken'] = 'Sorry, maar dit E-Mailadres is al door een gebruiker geregistreerd.';
$lang['Empty_message_email'] = 'U dient een bericht op te geven.';
$lang['Empty_subject_email'] = 'U dient een onderwerp op te geven.';
$lang['Fields_empty'] = 'U dient alle verplichte velden in te vullen.';
$lang['File_no_data'] = 'Het bestand van de opgegeven URL bevat geen gegevens';
$lang['Flood_email_limit'] = 'U kunt op dit moment geen verdere E-Mails versturen, probeer het later nog eens.';
$lang['Hidden_email'] = '[ verborgen ]';
$lang['Hide_user'] = 'Verberg uw online status';
$lang['Incomplete_URL'] = 'De opgegeven URL is niet compleet';
$lang['Interests'] = 'Interesses';
$lang['Items_required'] = 'Items gemarkeerd met een * zijn verplicht tenzij anders vermeld.';
$lang['Link_remote_Avatar'] = 'Link naar off-site Avatar';
$lang['Link_remote_Avatar_explain'] = 'Geef de URL van de locatie van de Avatar afbeelding dat u wilt koppelen.';
$lang['Location'] = 'Locatie';
$lang['Login_attempts_exceeded'] = 'Het maximum aantal van %s inlog pogingen is overschreden. U kunt de komende %s minuten niet meer inloggen.';
$lang['New_account_subject'] = 'Nieuwe gebruikers account';
$lang['New_password'] = 'Nieuw wachtwoord';
$lang['New_password_activation'] = 'Activatie nieuw wachtwoord';
$lang['No_connection_URL'] = 'Er kon geen verbinding met de URL dat u opgegeven heeft gemaakt worden';
$lang['No_email_match'] = 'Het E-Mailadres dat u heeft opgegeven komt niet overeen met de gebruikersnaam.';
$lang['No_send_account_inactive'] = 'Sorry, maar uw wachtwoord kan niet worden opgehaald omdat uw account momenteel inactief is. Neem contact op met de forumbeheerder voor meer informatie.';
$lang['No_themes'] = 'Geen Themas In de database';
$lang['No_user_id_specified'] = 'Sorry, maar deze gebruiker bestaat niet.';
$lang['No_user_specified'] = 'Geen gebruiker geselecteerd';
$lang['Notify_on_privmsg'] = 'Berichtgeving bij nieuwe persoonlijk bericht';
$lang['Occupation'] = 'Beroep';
$lang['Only_one_avatar'] = 'Slechts een soort avatar kan worden gespecificeerd';
$lang['Password_activated'] = 'U account is geheractiveerd. Om in te loggen, gebruik dan het wachtwoord dat is geleverd in de e-mail die u ontvangen.';
$lang['Password_long'] = 'Uw wachtwoord mag niet langer zijn dan 32 tekens.';
$lang['Password_mismatch'] = 'De opgegeven wachtwoorden komen niet overeen.';
$lang['Password_updated'] = 'Nieuw wachtwoord is aangemaakt, controleer uw E-Mail voor details over het activeren van dit wachtwoord.';
$lang['Pick_local_Avatar'] = 'Selecteer een Avatar uit de  gallery';
$lang['Please_remove_install_contrib'] = 'Zorg ervoor dat zowel de install/ als de contrib/ mappen verwijderd zijn';
$lang['Popup_on_privmsg'] = 'Pop up venster bij nieuw prive bericht';
$lang['Popup_on_privmsg_explain'] = 'Sommige templates openen een nieuw venster om u te informeren als er nieuwe prive berichten zijn.';
$lang['Poster_rank'] = 'Poster rang';
$lang['Preferences'] = 'Voorkeuren';
$lang['Profile_info'] = 'Profiel informatie';
$lang['Profile_info_warn'] = 'Deze informatie zal publiekelijk weergegeven worden';
$lang['Profile_updated'] = 'Uw profiel is geupdate';
$lang['Profile_updated_inactive'] = 'Uw profiel is geupdate. Echter, u heeft essentiële details veranderd, dus uw account is nu inactief. Controleer uw E-Mail over hoe u uw account dient te heractiveren, Als een heractivatie door een admin noodzakelijk is dient u te wachten tot hij dit gedaan heeft.';
$lang['Public_view_email'] = 'Altijd mijn E-Mailadres weergeven';
$lang['Reactivate'] = 'Heractiveer uw account!';
$lang['Recipient'] = 'Ontvanger';
$lang['Reg_agreement'] = 'Hoewel de beheerders en moderators van dit forum verwerpelijk matriaal zo spoedig proberen te verwijderen is het onmogelijk elk bericht te controleren. Daarom erkent u dat alle berichten de meningen van de auteur betreffen en niet die van de beheerder, moderators of webmaster (met uitzondering van hun eigen berichten) en deze zullen daarom niet aansprakelijk gesteld worden.<br /><br />U stemt ermee in dat u geen kwetsende, obscene, vulgaire, lasterlijke, haatdragende, bedreigende, sexueel-georienteerde of enig ander materiaal dat wetten overtreedt plaatst. Dit kan ertoe leiden dat u meteen en permanent verbannen word (en uw service provider kan geïnformeerd worden). Het IP-adres van alle berichten wordt opgeslagen om te helpen bij de handhaving van deze voorwaarden. U gaat ermee akkoord dat de webmaster, beheerder en moderators van dit forum het recht hebben om berichten te verwijderen, bewerken, verplaatsen of sluiten op elk tijdstip dat zij dat nodig achten. Als gebruiker gaat u ermee akkoord dat de informatie die u hierboven heeft ingevoerd opgeslagen zal worden in onze database. Hoewel deze informatie niet aan derden openbaar gemaakt zal worden zonder uw toestemming aan de webmaster, beheerder of moderators kunnen zij niet verantwoordelijk worden gehouden voor een hack-poging die ertoe leidt dat de gegevens vrijkomen.<br /><br />This forum system uses cookies to store information on your local computer. These cookies do not contain any of the information you have entered above; they serve only to improve your viewing pleasure. The e-mail address is used only for confirming your registration details and password (and for sending new passwords should you forget your current one).<br /><br />By clicking Register below you agree to be bound by these conditions.';
$lang['Registration'] = 'Registratie voorwaarden';
$lang['Registration_info'] = 'Registratien informatie';
$lang['Return_profile'] = 'annuleer avatar';
$lang['Search_user_posts'] = 'Zoek alle berichten van %s'; // Find all posts by username
$lang['Select_avatar'] = 'Selecteer avatar';
$lang['Select_category'] = 'Selecteer categorie';
$lang['Select_from_gallery'] = 'Selecteer Avatar uit gallery';
$lang['Send_email'] = 'Verstuur E-Mail';
$lang['Send_email_msg'] = 'Verstuur een bericht per E-Mail';
$lang['Send_password'] = 'Stuur mij een nieuw wachtwoord';
$lang['Send_private_message'] = 'Prive bericht vertsuren';
$lang['Session_invalid'] = 'Ongeldige sessie. Probeer het opnieuw.';
$lang['Signature'] = 'Handtekening';
$lang['Signature_explain'] = 'Dit is een stukje tekst dat kan worden toegevoegd aan berichten die u plaatst. Er is een limiet van %d tekens';
$lang['Signature_too_long'] = 'Uw handtekening is te lang.';
$lang['Timezone'] = 'Tijdzone';
$lang['Total_posts'] = 'Totale berichten';
$lang['Upload_Avatar_URL'] = 'Upload Avatar van een URL';
$lang['Upload_Avatar_URL_explain'] = 'Geef de URL op van de locatie van de Avatar afbeelding, deze zal naar deze site worden gekopieerd .';
$lang['Upload_Avatar_file'] = 'Upload Avatar vanaf uw pc';
$lang['User_admin_for'] = 'Gebruikersadministratie van';
$lang['User_not_exist'] = 'Deze gebruiker bestaat niet';
$lang['User_post_day_stats'] = '%.2f berichten per dag'; // 1.5 posts per day
$lang['User_post_pct_stats'] = '%.2f%% van het totaal'; // 1.25% of total
$lang['User_prevent_email'] = 'Deze gebruiker wenst geen E-Mail te ontvangen. Probeer het met een prive bericht.';
$lang['Username_disallowed'] = 'Sorry, deze gebruikersnaam is niet toegestaan.';
$lang['Username_invalid'] = 'Sorry, deze gebruikersnaam bevat ongeldige tekens zoals \'.';
$lang['Username_taken'] = 'Sorry, deze gebruikersnaam is bezet.';
$lang['View_avatar_gallery'] = 'Gallery weergeven';
$lang['Viewing_user_profile'] = 'Profile weergeven :: %s'; // %s is username
$lang['Website'] = 'Website';
$lang['Welcome_subject'] = 'Welkom op %s Forums'; // Welcome to my.com forums
$lang['Word_Wrap'] = 'Scherm breedte';
$lang['Word_Wrap_Error'] = 'De breedte van het bericht in het leesvenster is buiten bereik.';
$lang['Word_Wrap_Explain'] = 'Maximale regels van een bericht';
$lang['Word_Wrap_Extra'] = 'Tekens (bereik: %min% - %max% tekens.)';
$lang['Wrong_Profile'] = 'U kunt geen profiel bewerken dat niet uw eigen is.';
$lang['Wrong_activation'] = 'De activatiecode komt niet overeen met die in de database.';
$lang['Wrong_remote_avatar_format'] = 'Ongeldige URL van de externe avatar';
$lang['password_confirm_if_changed'] = 'U dient het wachtwoord te bevestigen als deze hierboven gewijzigd is';
$lang['password_if_changed'] = 'U hoeft alleen een wachtwoord op te geven als u deze wilt wijzigen';
//
// Stats block text
//
$lang['Forum_is_locked'] = 'Forum is gesloten';
$lang['New_post'] = 'Nieuw bericht';
$lang['New_posts'] = 'Nieuwe berichten';
$lang['New_posts_hot'] = 'Nieuwe berichten [ Populair ]';
$lang['New_posts_locked'] = 'Nieuwe berichten [ Gesloten ]';
$lang['Newest_user'] = 'Nieuwste geregistreerde gebruiker is <strong>%s%s%s</strong>'; // a href, username, /a
$lang['No_new_posts'] = 'Geen nieuwe berichten';
$lang['No_new_posts_hot'] = 'Geen nieuwe berichten [ Populair ]';
$lang['No_new_posts_last_visit'] = 'Geen nieuwe berichten sinds uw laatste bezoek';
$lang['No_new_posts_locked'] = 'Geen nieuwe bericht [ Gesloten ]';
$lang['Posted_article_total'] = 'Onze gebruikers hebben in totaal <strong>%d</strong> berichten geplaatst'; // Number of posts
$lang['Posted_articles_total'] = 'Onze gebruikers hebben in totaal <strong>%d</strong> berichten geplaatst'; // Number of posts
$lang['Posted_articles_zero_total'] = 'Onze gebruikers hebben in totaal <strong>0</strong> berichten geplaatst'; // Number of posts
$lang['Registered_user_total'] = 'Wij hebben <strong>%d</strong> geregistreerde gebruiker'; // # registered users
$lang['Registered_users_total'] = 'Wij hebben <strong>%d</strong> geregistreerde gebruikers'; // # registered users
$lang['Registered_users_zero_total'] = 'Wij hebben <strong>0</strong> geregistreerde gebruikers'; // # registered users
//
// Viewforum
//
$lang['All_Topics'] = 'Alle onderwerpen';
$lang['Display_topics'] = 'Vorige onderwerpen weergeven';
$lang['Forum_not_exist'] = 'Geselecteerde forum bestaat niet.';
$lang['Mark_all_topics'] = 'Alle onderwerpen als gelezen markeren';
$lang['No_topics_post_one'] = 'Er zijn geen berichten in dit forum.<br />Klik op <strong>nieuw onderwerp plaatsen</strong> link op deze pagina om er een te plaatsen.';
$lang['Reached_on_error'] = 'Paginafout.';
$lang['Rules_delete_can'] = 'U <strong>kunt</strong> eigen berichten in dit forum verwijderen';
$lang['Rules_delete_cannot'] = 'U kunt <strong>geen</strong> eigen berichten in dit forum verwijderen';
$lang['Rules_edit_can'] = 'U <strong>kunt</strong> eigen berichten in dit forum bewerken';
$lang['Rules_edit_cannot'] = 'U kunt <strong>geen</strong> eigen berichten in dit forum bewerken';
$lang['Rules_moderate'] = 'U <strong>kunt</strong> %smoderate dit forum%s'; // %s replaced by a href links, do not remove!
$lang['Rules_post_can'] = 'U <strong>kunt</strong> nieuwe onderwerpen in dit forum plaatsen';
$lang['Rules_post_cannot'] = 'U kunt <strong>geen</strong> onderwerpen in dit forum plaatsen';
$lang['Rules_reply_can'] = 'U <strong>kunt</strong> onderwerpen beantwoorden in dit forum';
$lang['Rules_reply_cannot'] = 'U kunt <strong>geen</strong> onderwerpen beantwoorden in dit forum';
$lang['Rules_vote_can'] = 'U <strong>kunt</strong> stemmen op polls in dit forum';
$lang['Rules_vote_cannot'] = 'U kunt <strong>niet</strong> stemmen op polls in dit forum';
$lang['Topic_Announcement'] = '<strong>Bekendmaking:</strong>';
$lang['Topic_Moved'] = '<strong>Verplaatst:</strong>';
$lang['Topic_Poll'] = '<strong>[ Poll ]</strong>';
$lang['Topic_Sticky'] = '<strong>Sticky:</strong>';
$lang['Topics_marked_read'] = 'De onderwerpen voor dit forum zijn nu gemarkeerd als gelezen';
$lang['View_forum'] = 'Forum tonen';
//
// Viewonline
//
$lang['Forum_Location'] = 'Locatie forum';
$lang['Forum_index'] = 'Forum Index';
$lang['Guest_user_online'] = 'Er is %d gast online'; // There is 1 Guest user online
$lang['Guest_users_online'] = 'Er zijn %d gasten online'; // There are 10 Guest users online
$lang['Guest_users_zero_online'] = 'Er zijn 0 gasten online'; // There are 10 Guest users online
$lang['Hidden_user_online'] = '%d verbogen gebruikers online'; // 6 Hidden users online
$lang['Hidden_users_online'] = '%d verborgen gebruikers online'; // 6 Hidden users online
$lang['Hidden_users_zero_online'] = '0 verborgen gebruikers online'; // 6 Hidden users online
$lang['Last_updated'] = 'Laatst geupdate';
$lang['Logging_on'] = 'Inloggen';
$lang['No_users_browsing'] = 'Er zijn op dit moment geen gebruikers op het forum';
$lang['Online_explain'] = 'Deze gegeven is gebaseerd op gebruikers over de laatste ' . ( ($board_config['online_time']/60)%60 ) . ' minuten';
$lang['Online_time'] = 'Online sinds';
$lang['Posting_message'] = 'Plaats een bericht';
$lang['Reg_user_online'] = 'Er is %d geregistreerde gebruiker en '; // There is 1 Registered and
$lang['Reg_users_online'] = 'Er zijn %d geregistreerde gebruikers en '; // There are 5 Registered and
$lang['Reg_users_zero_online'] = 'Er zijn 0 geregistreerde gebruikers en '; // There are 5 Registered and
$lang['Searching_forums'] = 'Forum doorzoeken';
$lang['Statistic_last_updated'] = 'Statistiek update van';
$lang['Viewing_FAQ'] = 'FAQ weergeven';
$lang['Viewing_groupcp'] = 'Groep controle paneel weergeven';
$lang['Viewing_member_list'] = 'Ledenlijst weergeven';
$lang['Viewing_online'] = 'Wie is online weergeven';
$lang['Viewing_priv_msgs'] = 'Prive berichten weergeven';
$lang['Viewing_profile'] = 'Profiel weergeven';
$lang['Viewing_ranks'] = 'Rangen weergeven';
$lang['Viewing_rules'] = 'Board regels weergeven';
$lang['Viewing_stats'] = 'Statistieken weergeven';
//
// Viewtopic
//
$lang['All_Posts'] = 'Alle berichten';
$lang['Back_to_top'] = 'Terug naar boven';
$lang['Code'] = 'Code'; // comes before bbcode code output.
$lang['Delete_post'] = 'Dit bericht verwijderen';
$lang['Delete_topic'] = 'Dit onderwerp verwijderen';
$lang['Display_posts'] = 'Vorige berichten weergeven';
$lang['Edit_delete_post'] = 'Bewerk/Verwijder dit bericht';
$lang['Edited_time_total'] = 'Laatst bewerkt door %s op %s;  %d maal in totaal bewerkt '; // Last edited by me on 12 Oct 2001; edited 1 time in total
$lang['Edited_times_total'] = 'Laatst bewerkt door %s op %s; %d maal in totaal bewerkt'; // Last edited by me on 12 Oct 2001; edited 2 times in total
$lang['Guest'] = 'Gast';
$lang['ICQ_status'] = 'ICQ Status';
$lang['Lock_topic'] = 'Dit onderwerp sluiten';
$lang['Merge_topics'] = 'Dit onderwerp samenvoegen';
$lang['Move_topic'] = 'Dit onderwerp verplaatsen';
$lang['Newest_First'] = 'Nieuwste eerst';
$lang['No_longer_watching'] = 'U volgt dit onderwerp niet meer';
$lang['No_newer_topics'] = 'Er zijn geen nieuwere onderwerpen in dit forum';
$lang['No_older_topics'] = 'Er zijn geen oudere onderwerpen in dit forum';
$lang['No_posts_topic'] = 'Er zijn geen berichten voor dit onderwerp';
$lang['Oldest_First'] = 'Oudste eerst';
$lang['PHPCode'] = 'PHP'; // PHP MOD
$lang['Post_subject'] = 'Onderwerp bericht';
$lang['Quote'] = 'Quote'; // comes before bbcode quote output.
$lang['Read_profile'] = 'gebruikers profiel tonen';
$lang['Split_topic'] = 'Dit onderwerp splitsen';
$lang['Start_watching_topic'] = 'Kijk voor de antwoorden op dit onderwerp';
$lang['Stop_watching_topic'] = 'Stop met kijken naar dit onderwerp';
$lang['Submit_vote'] = 'Stem';
$lang['Topic_post_not_exist'] = 'Het onderwerp of bericht dat u opvroeg bestaat niet';
$lang['Total_votes'] = 'Totale stemmen';
$lang['Unlock_topic'] = 'Heropen dit onderwerp';
$lang['View_IP'] = 'IP addres van auteur weergeven';
$lang['View_next_topic'] = 'Volgende onderwerp weergeven';
$lang['View_previous_topic'] = 'Vorige onderwerp weergeven';
$lang['View_results'] = 'Resultaten weergeven';
$lang['View_topic'] = 'Onderwerp weergeven';
$lang['Visit_website'] = 'Bezoek website vd auteur';
$lang['You_are_watching'] = 'U bekijk nu dit onderwerp';
$lang['must_first_vote'] = 'U dient eerst te stemmen alvorens u de uitslag kunt bekijken';
$lang['wrote'] = 'Schreef'; // proceeds the username and is followed by the quoted text
//
// Visual confirmation system strings
//
$lang['Confirm_code'] = 'Beveiligningscode';
$lang['Confirm_code_explain'] = 'Voer de code precies zo in zoals u deze hier staat. Hij code is hoofdlettergevoelig en een nul heeft een diagonale streep erdoor.';
$lang['Confirm_code_impaired'] = 'Als je slechtziend bent of de code niet goed kunt lezen, dan kunt u met de %sAdministrator%s contact opnemen voor hulp.';
$lang['Confirm_code_wrong'] = 'De ingevoerde beveiligingscode was onjuist';
$lang['Too_many_registers'] = 'U heeft de maximale aantal pogingen bereikt, probeer het later nog eens.';
//
// Search
//
$lang['All_available'] = 'Alle beschikbare';
$lang['Close_window'] = 'Sluit venster';
$lang['Display_results'] = 'Resultaten weergeven als';
$lang['Found_search_match'] = 'Zoekopdracht heeft %d resultaat gevonden'; // eg. Search found 1 match
$lang['Found_search_matches'] = 'Zoekopdracht heeft %d resultaten gevonden'; // eg. Search found 24 matches
$lang['No_search_match'] = 'Geen onderwerpen of berichten gevonden die aan uw criteria voldoen';
$lang['No_searchable_forums'] = 'U heeft geen toestemming om de forums op deze site te doorzoeken.';
$lang['Return_first'] = 'Return first'; // followed by xxx characters in a select box
$lang['Search_Flood_Error'] = 'U kunt de zoekopdracht niet zo snel achter elkaar gebruiken, probeer het zo nog eens.';
$lang['Search_author'] = 'Auteur zoeken';
$lang['Search_author_explain'] = 'Gebruik * als een wildcard voor gedeeltelijke overeenkomsten';
$lang['Search_for_all'] = 'Op alle termen zoeken';
$lang['Search_for_any'] = 'Zoek voor een van de woorden';
$lang['Search_keywords'] = 'Zoek op sleutelwoorden';
$lang['Search_keywords_explain'] = 'U kunt <u>AND</u> gebruiken om woorden te defineren die voor moetenkomen, Gebruik <u>OR</u> om woorden te defineren die voor kunnen komen en <u>NOT</u> om woorden uit te sluiten van de zoekresultaten. Gebruik * als een wildcard voor gedeeltelijk overeenkomsten';
$lang['Search_msg_only'] = 'Alleen in tekst van berichten zoeken';
$lang['Search_options'] = 'Zoekopties';
$lang['Search_previous'] = 'Zoek vorige'; // followed by days, weeks, months, year, all in a select box
$lang['Search_query'] = 'Zoek Query';
$lang['Search_title_msg'] = 'Zoeken op titel onderwerp en tekst van berichten';
$lang['Sort_Author'] = 'Auteur';
$lang['Sort_Forum'] = 'Forum';
$lang['Sort_Post_Subject'] = 'Onderwerp berichten';
$lang['Sort_Time'] = 'Tijd van bericht';
$lang['Sort_Topic_Title'] = 'Titel onderwerp';
$lang['Sort_by'] = 'Gesorteerd op';
$lang['characters_posts'] = 'tekens van berichten';
//
// Timezones ... for display on each page
//
$lang['All_times'] = 'Alle tijden zijn %s'; // eg. All times are GMT - 12 Hours (times from next block)
$lang['-12'] = 'GMT - 12 uur';
$lang['-11'] = 'GMT - 11 uur';
$lang['-10'] = 'GMT - 10 uur';
$lang['-9'] = 'GMT - 9 uur';
$lang['-8'] = 'GMT - 8 uur';
$lang['-7'] = 'GMT - 7 uur';
$lang['-6'] = 'GMT - 6 uur';
$lang['-5'] = 'GMT - 5 uur';
$lang['-4'] = 'GMT - 4 uur';
$lang['-3.5'] = 'GMT - 3.5 uur';
$lang['-3'] = 'GMT - 3 uur';
$lang['-2'] = 'GMT - 2 uur';
$lang['-1'] = 'GMT - 1 uur';
$lang['0'] = 'GMT';
$lang['1'] = 'GMT + 1 uur';
$lang['2'] = 'GMT + 2 uur';
$lang['3'] = 'GMT + 3 uur';
$lang['3.5'] = 'GMT + 3.5 uur';
$lang['4'] = 'GMT + 4 uur';
$lang['4.5'] = 'GMT + 4.5 uur';
$lang['5'] = 'GMT + 5 uur';
$lang['5.5'] = 'GMT + 5.5 uur';
$lang['6'] = 'GMT + 6 uur';
$lang['6.5'] = 'GMT + 6.5 uur';
$lang['7'] = 'GMT + 7 uur';
$lang['8'] = 'GMT + 8 uur';
$lang['9'] = 'GMT + 9 uur';
$lang['9.5'] = 'GMT + 9.5 uur';
$lang['10'] = 'GMT + 10 uur';
$lang['11'] = 'GMT + 11 uur';
$lang['12'] = 'GMT + 12 uur';
$lang['13'] = 'GMT + 13 uur';
// These are displayed in the timezone select box
$lang['tz']['-12'] = 'GMT - 12 uur';
$lang['tz']['-11'] = 'GMT - 11 uur';
$lang['tz']['-10'] = 'GMT - 10 uur';
$lang['tz']['-9'] = 'GMT - 9 uur';
$lang['tz']['-8'] = 'GMT - 8 uur';
$lang['tz']['-7'] = 'GMT - 7 uur';
$lang['tz']['-6'] = 'GMT - 6 uur';
$lang['tz']['-5'] = 'GMT - 5 uur';
$lang['tz']['-4'] = 'GMT - 4 uur';
$lang['tz']['-3.5'] = 'GMT - 3.5 uur';
$lang['tz']['-3'] = 'GMT - 3 uur';
$lang['tz']['-2'] = 'GMT - 2 uur';
$lang['tz']['-1'] = 'GMT - 1 uur';
$lang['tz']['0'] = 'GMT';
$lang['tz']['1'] = 'GMT + 1 uur';
$lang['tz']['2'] = 'GMT + 2 uur';
$lang['tz']['3'] = 'GMT + 3 uur';
$lang['tz']['3.5'] = 'GMT + 3.5 uur';
$lang['tz']['4'] = 'GMT + 4 uur';
$lang['tz']['4.5'] = 'GMT + 4.5 uur';
$lang['tz']['5'] = 'GMT + 5 uur';
$lang['tz']['5.5'] = 'GMT + 5.5 uur';
$lang['tz']['6'] = 'GMT + 6 uur';
$lang['tz']['6.5'] = 'GMT + 6.5 uur';
$lang['tz']['7'] = 'GMT + 7 uur';
$lang['tz']['8'] = 'GMT + 8 uur';
$lang['tz']['9'] = 'GMT + 9 uur';
$lang['tz']['9.5'] = 'GMT + 9.5 uur';
$lang['tz']['10'] = 'GMT + 10 uur';
$lang['tz']['11'] = 'GMT + 11 uur';
$lang['tz']['12'] = 'GMT + 12 uur';
$lang['tz']['13'] = 'GMT + 13 uur';
$lang['datetime']['Sunday'] = 'Zondag';
$lang['datetime']['Monday'] = 'Maandag';
$lang['datetime']['Tuesday'] = 'Dinsdag';
$lang['datetime']['Wednesday'] = 'Woensdag';
$lang['datetime']['Thursday'] = 'Donderdag';
$lang['datetime']['Friday'] = 'Vrijdag';
$lang['datetime']['Saturday'] = 'Zaterdag';
$lang['datetime']['Sun'] = 'Zon';
$lang['datetime']['Mon'] = 'Maa';
$lang['datetime']['Tue'] = 'Din';
$lang['datetime']['Wed'] = 'Woe';
$lang['datetime']['Thu'] = 'Don';
$lang['datetime']['Fri'] = 'Vri';
$lang['datetime']['Sat'] = 'Zat';
$lang['datetime']['January'] = 'Januari';
$lang['datetime']['February'] = 'Februari';
$lang['datetime']['March'] = 'Maart';
$lang['datetime']['April'] = 'April';
$lang['datetime']['May'] = 'Mei';
$lang['datetime']['June'] = 'Juni';
$lang['datetime']['July'] = 'Juli';
$lang['datetime']['August'] = 'Augustus';
$lang['datetime']['September'] = 'September';
$lang['datetime']['October'] = 'October';
$lang['datetime']['November'] = 'November';
$lang['datetime']['December'] = 'December';
$lang['datetime']['Jan'] = 'Jan';
$lang['datetime']['Feb'] = 'Feb';
$lang['datetime']['Mar'] = 'Maa';
$lang['datetime']['Apr'] = 'Apr';
$lang['datetime']['May'] = 'Mei';
$lang['datetime']['Jun'] = 'Jun';
$lang['datetime']['Jul'] = 'Jul';
$lang['datetime']['Aug'] = 'Aug';
$lang['datetime']['Sep'] = 'Sep';
$lang['datetime']['Oct'] = 'Oct';
$lang['datetime']['Nov'] = 'Nov';
$lang['datetime']['Dec'] = 'Dec';

?>