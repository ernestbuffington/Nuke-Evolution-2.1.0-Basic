<?php
/*=======================================================================
 Nuke-Evolution   :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :   Basic
 Nuke-Evo Version       :   2.1.0
 Nuke-Evo Build         :   1740
 Nuke-Evo Patch         :   0
 Nuke-Evo Filename      :   #$#FILENAME
 Nuke-Evo Date          :   10-Aug-2010 23:10

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
$lang['error']						= "Fout";
$lang['information']				= "Informatie";
$lang['success']					= "Succes";

/* Message Die's */
/* Config Panel */
$lang['add_error']					= "Beide velden zijn nodig om een kleur groep toe te voegen.";
$lang['add_error_2']				= "Deze groep bestaat al.";
$lang['add_error_3']				= "HTML kleuren zijn 6 cijfers.";
$lang['add_success']				= "Kleur informatie opgeslagen.";
$lang['edit_error']					= "Selecteer eerst een groep naam om te bewerken.";
$lang['save_error']					= "Beide velden zijn nodig om de groep te updaten.";
$lang['save_error_1']				= "Deze groep naam is al in gebruik.";
$lang['delete_error']				= "Selecteer één om te verwijderen.";
$lang['delete_success']				= "Kleur gegevens verwijderd. Gebruikers met deze gegevens zijn gereset.";			

/* Management Panel */
$lang['group_delete_user_2']		= "Gebruiker kleuren data ge-updated.";
$lang['choose_user_id_error']		= "Je hebt geen gebruikers naam toegevoegd of er er een gekozen van het drop down menu";

/* Config Panel */
$lang['admin_main_header_c']		= "Gevorderde gebruiker naam kleur: Configuratie";
$lang['admin_main_header_m']		= "Gevorderde gebruiker naam kleur: Beheer";
$lang['add_new_color']				= "Voeg nieuwe kleur toe";
$lang['add_new_color_1']			= "Groep naam<br /><span class='gensmall'>Voorbeeld: Support Team</span>";
$lang['add_new_color_2']			= "Group Color<br /><span class='gensmall'>Voorbeeld: FFFFFF, gebruik HTML kleur codes.</span>";
$lang['add_new_color_3']			= " Voeg dit toe ";
$lang['edit_color']					= "Bewerk bestaande kleur groep";
$lang['edit_color_1']				= "Alle groepen zijn opgesomd.";
$lang['edit_color_2']				= "Kies één";
$lang['edit_color_3']				= " Bewerk deze ";
$lang['editing_color']				= "Wijzigbare informatie is hieronder";
$lang['editing_color_1']			= "Wijzig groep naam";
$lang['editing_color_2']			= "Wijzig groep kleur<br /><span class='gensmall'>Voorbeeld: FFFFFF, gebruik HTML kleur codes.</span>";
$lang['editing_color_3']			= " Sla dit op ";
$lang['delete_color']				= "Verwijder een kleur groep";
$lang['delete_color_1']				= "Kies een groep om te verwijderen<br /><span class='gensmall'>Waarschuwing: alle gebruikers van deze groep vervallen ook.</span>";
$lang['delete_color_2']				= "Verwijder opties";
$lang['delete_color_3']				= " Verwijder groep ";
$lang['view_group_names']			= "Groep titels";
$lang['view_group_colors']			= "Groep HTML kleur";
$lang['view_group_colors_2']		= "Voorbeeld";
$lang['view_group_colors_3']		= "Gebruiker naam kleur";

/* Management Panel */
$lang['choose_group']				= "Kies een groep om te beheren";
$lang['choose_group_2']				= "Bestaande groepen om leden toe te voegen";
$lang['choose_group_3']				= "Kies één";
$lang['choose_group_4']				= " Kies groep ";
$lang['group_selected']				= "Je voegt toe aan: <b>%G%</b>";
$lang['group_already_assigned']		= "Gebruikers reeds aanwezig in deze groep";
$lang['group_assign']				= "Voeg een gebruiker toe aan deze groep";
$lang['group_assign_1']				= " Toevoegen aan groep ";
$lang['group_assign_2']				= "Voeg meerdere Gebruikers toe aan deze groep, Laat een lijn vallen voor elke Gebruiker.";
$lang['group_user_added']			= "Gebruiker gegevens ge-updated.";
$lang['group_delete_user']			= "Verwijder een gebruiker uit deze groep";
$lang['group_delete_user_1']		= " Verwijder gebruiker ";

/* Listing Page */
$lang['listing_left']				= "Gebruiker";
$lang['listing_right']				= "Gebruiker info";
$lang['listing_none']				= 'Er zijn geen Leden momenteel om toe te voegen bij de %s Groep.';

/*****[BEGIN]******************************************
 [ Mod:    AUC Group                           v1.0.0 ]
 ******************************************************/
$lang['goup_group']				= 'Voeg een Forum Groep bij deze Groep';
/*****[END]********************************************
 [ Mod:    AUC Group                           v1.0.0 ]
 ******************************************************/


?>