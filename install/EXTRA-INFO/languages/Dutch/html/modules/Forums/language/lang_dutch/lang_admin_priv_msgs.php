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
/* Added in 1.6.0 */
$lang['PM_View_Type'] = 'PM Bekijk Type';
$lang['Show_IP'] = 'Laat IP Adres Zien';
$lang['Rows_Per_Page'] = 'Rijen Per Pagina';
$lang['Archive_Feature'] = 'Archief Eigenschap';
$lang['Inline'] = 'Inline';
$lang['Pop_up'] = 'Pop-up';
$lang['Current'] = 'Huidige';
$lang['Rows_Plus_5'] = '5 Rijen Toevoegen';
$lang['Rows_Minus_5'] = '5 Rijen Verwijderen';
$lang['Enable'] = 'Aanzetten';
$lang['Disable'] = 'Uitzetten';
$lang['Inserted_Default_Value'] = '%s Configuratie Item bestond niet, standaard waarde ingevoerd<br />'; // %s = config name
$lang['Updated_Config'] = 'Updated Configuratie Item %s<br />'; // %s = config item
$lang['Archive_Table_Inserted'] = 'Archief Tabel bestond niet, is gemaakt<br />';
$lang['Switch_Normal'] = 'Schakel Om Naar Normale Mode';
$lang['Switch_Archive'] = 'Schakel Om naar Archief Mode';

/* General */
$lang['Deleted_Message'] = 'Verwijderde privé berichten - %s <br />'; // %s = PM titel
$lang['Archived_Message'] = 'Opgeslagen privé berichten - %s <br />'; // %s = PM titel
$lang['Archived_Message_No_Delete'] = 'Kan niet verwijderd worden %s, Het was ook gemarkeerd om op te slaan <br />'; // %s = PM titel
$lang['Private_Messages'] = 'Privé berichten';
$lang['Private_Messages_Archive'] = 'Privé berichten opslag';
$lang['Archive'] = 'Opslaan';
$lang['To'] = 'Naar';
$lang['Subject'] = 'Onderwerp';
$lang['Sent_Date'] = 'Verstuur datum';
$lang['Delete'] = 'Verwijder';
$lang['From'] = 'Vanaf';
$lang['Sort'] = 'Sorteren';
$lang['Filter_By'] = 'Filteren door';
$lang['PM_Type'] = 'PM type';
$lang['Status'] = 'Status';
$lang['No_PMS'] = 'Geen privé berichten gevonden die gelijk zijn aan uw zoek criteria';
$lang['Archive_Desc'] = 'Lijst van uw gekozen privé berichten voor opslag.  Gebruikers kunnen deze niet langer bereiken (verstuurder en ontvanger), maar je kan ze ten alle tijden bekijken of wissen.';
$lang['Normal_Desc'] = 'Al de privé berichten op het board kunnen hier beheerd worden. Je kan iedere PM lezen en kiezen om deze te verwijderen of op te slaan (behouden, maar gebruikers kunnen het niet zien) het bericht ook.';
$lang['Version'] = 'Versie';
$lang['Remove_Old'] = 'Wees PMs:</a> <span class="gensmall">Gebruikers die niet langer bestaan kunnen PMs nagelaten hebben, dit zal ze verwijderen.</span>';
$lang['Remove_Sent'] = 'Stuur Box PMs:</a> <span class="gensmall">PMs in de stuur box zijn exacte copiën van de verstuurde berichten, indien de afzender dit toelaat, nadat de andere gebruiker de PM heeft gelezen. Deze zijn niet echt nodig.</span>';
$lang['Affected_Rows'] = '%d bekende invoeren verwijderd<br />';
$lang['Removed_Old'] = 'Alle Wees PMs Verwijder<br />';
$lang['Removed_Sent'] = 'Alle gezonden PMs Verwijder<br />';
$lang['Utilities'] = 'Totale verwijder utilities';
$lang['Nivisec_Com'] = 'Nivisec.com';

/* PM Types */
$lang['PM_-1'] = 'Alle types'; //PRIVMSGS_ALL_MAIL = -1
$lang['PM_0'] = 'Lees PMs'; //PRIVMSGS_READ_MAIL = 0
$lang['PM_1'] = 'Nieuwe PMs'; //PRIVMSGS_NEW_MAIL = 1
$lang['PM_2'] = 'Verstuur PMs'; //PRIVMSGS_SENT_MAIL = 2
$lang['PM_3'] = 'Opgeslagen PMs (In)'; //PRIVMSGS_SAVED_IN_MAIL = 3
$lang['PM_4'] = 'Opgeslagen PMs (Out)'; //PRIVMSGS_SAVED_OUT_MAIL = 4
$lang['PM_5'] = 'Ongelezen PMs'; //PRIVMSGS_UNREAD_MAIL = 5

/* Errors */
$lang['Error_Other_Table'] = 'Fout in zoeken van een gevraagde tabel.';
$lang['Error_Posts_Text_Table'] = 'Fout in zoeken privé bericht text tabel.';
$lang['Error_Posts_Table'] = 'Fout in zoeken privé berichten tabel.';
$lang['Error_Posts_Archive_Table'] = 'Fout in zoeken privé berichten opslag tabel.';
$lang['No_Message_ID'] = 'Geen bericht ID was opgegeven.';


/*Special Cases, Do not bother to change for another language */
$lang['ASC'] = $lang['Sort_Ascending'];
$lang['DESC'] = $lang['Sort_Descending'];
$lang['privmsgs_date'] = $lang['Sent_Date'];
$lang['privmsgs_subject'] = $lang['Subject'];
$lang['privmsgs_from_userid'] = $lang['From'];
$lang['privmsgs_to_userid'] = $lang['To'];
$lang['privmsgs_type'] = $lang['PM_Type'];

?>