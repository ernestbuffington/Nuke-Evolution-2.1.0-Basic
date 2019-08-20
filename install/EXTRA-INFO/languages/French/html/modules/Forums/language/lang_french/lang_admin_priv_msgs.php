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

/* Added in 1.6.0 */
$lang['PM_View_Type'] = 'Type de vue des MP';
$lang['Show_IP'] = 'Montrer l\'adresse IP';
$lang['Rows_Per_Page'] = 'Lignes par page';
$lang['Archive_Feature'] = 'Caract&eacute;ristiques de l\'archive';
$lang['Inline'] = 'Inline';
$lang['Pop_up'] = 'Pop-up';
$lang['Current'] = 'Actuel';
$lang['Rows_Plus_5'] = 'Ajouter 5 lignes';
$lang['Rows_Minus_5'] = 'Enlever 5 lignes';
$lang['Enable'] = 'Activ&eacute;';
$lang['Disable'] = 'D&eacute;sactiv&eacute;';
$lang['Inserted_Default_Value'] = 'L\'item %s de la configuration n\'existe pas, une valeur par d&eacute;fault a &eacute;t&eacute; ins&eacute;rer<br />'; // %s = config name
$lang['Updated_Config'] = 'Item %s de la configuration actualis&eacute;<br />'; // %s = config item
$lang['Archive_Table_Inserted'] = 'La table des archives n\'existe pas, elle vient d\'&ecirc;tre cr&eacute;&eacute;e<br />';
$lang['Switch_Normal'] = 'Changer pour le mode normal';
$lang['Switch_Archive'] = 'Changer pour le mode archive';

/* General */
$lang['Deleted_Message'] = 'Messages Priv&eacute;s Supprim&eacute;s - %s <br />'; // %s = PM title
$lang['Archived_Message'] = 'Messages Priv&eacute;s Archiv&eacute;s - %s <br />'; // %s = PM title
$lang['Archived_Message_No_Delete'] = 'Ne peut pas supprimer %s, Il a aussi &eacute;t&eacute; marqu&eacute; pour les archives <br />'; // %s = PM title
$lang['Private_Messages'] = 'Message Priv&eacute;';
$lang['Private_Messages_Archive'] = 'Archive des Messages Priv&eacute;s';
$lang['Archive'] = 'Archive';
$lang['To'] = 'A';
$lang['Subject'] = 'Sujet';
$lang['Sent_Date'] = 'Envoyer la Date';
$lang['Delete'] = 'Supprimer';
$lang['From'] = 'De';
$lang['Sort'] = 'Sorte';
$lang['Filter_By'] = 'Filtr&eacute; Par';
$lang['PM_Type'] = 'PM Type';
$lang['Status'] = 'Statut';
$lang['No_PMS'] = 'Il n\'y a pas de messages priv&eacute;s correspondant aux crit&egrave;res que vous voulez afficher';
$lang['Archive_Desc'] = 'Les Messages Priv&eacute;s que vous avez choisis d\'archiv&eacute;s sont list&eacute;s ici.  Les utilisateurs n\'ont plus la possibilit&eacute; de les atteindre (envoyer et recevoir), mais vous pouvez les voir ou les d&eacute;truire n\'importe quand.';
$lang['Normal_Desc'] = 'Tout les Messages Priv&eacute; de votre compte peuvent &ecirc;tre g&eacute;r&eacute;s ici.  Vous pouvez lire celui qui vous plait, et choisir aussi bien de le d&eacute;truire ou de l\'archiver (concerver, mais que les utilisateurs ne peuvent pas voir)';
$lang['Version'] = 'Version';
$lang['Remove_Old'] = 'Messages Priv&eacute;s Orphelins:</a> <span class="gensmall"> Les utilisateurs qui n\'existent plus peuvent avoir laiss&eacute;s derri&egrave;re eux des messages priv&eacute;s, ceci va les enlever.</span>';
$lang['Remove_Sent'] = 'Boite des MP envoy&eacute;s:</a> <span class="gensmall">Les MP dans la boite sont juste des copies exact du message qui a &eacute;t&eacute; envoy&eacute; exc&eacute;pt&eacute; l\'assignation de l\'envoyeur apr&egrave;s que l\'utilisateur l\'ai lu. Ceci n\'etant pas vraiment utile.</span>';
$lang['Remove_All'] = 'Tous les MP:</a> <span class="gensmall">ATTENTION: Ceci d&eacute;truira tous les MP</span>';
$lang['Affected_Rows'] = '%d Connaitre les entr&eacute;es supprim&eacute;s<br>';
$lang['Removed_Old'] = 'Supprimer tous les MP Orphelins<br>';
$lang['Removed_Sent'] = 'Supprim&eacute; tous les MP envoy&eacute;s<br>';
$lang['Removed_All'] = 'Tous les messages priv&eacute;s sont enlev&eacute;s<br />';
$lang['Utilities'] = 'Outil de suppression de masse';
$lang['Nivisec_Com'] = 'Nivisec.com';

/* PM Types */
$lang['PM_-1'] = 'Tout Type'; //PRIVMSGS_ALL_MAIL = -1
$lang['PM_0'] = 'MP lus'; //PRIVMSGS_READ_MAIL = 0
$lang['PM_1'] = 'Nouveaux MP'; //PRIVMSGS_NEW_MAIL = 1
$lang['PM_2'] = 'MP envoy&eacute;s'; //PRIVMSGS_SENT_MAIL = 2
$lang['PM_3'] = 'MP sauvegard&eacute;s (dedans)'; //PRIVMSGS_SAVED_IN_MAIL = 3
$lang['PM_4'] = 'MP sauvegard&eacute; (dehors)'; //PRIVMSGS_SAVED_OUT_MAIL = 4
$lang['PM_5'] = 'Mp Non-Lus'; //PRIVMSGS_UNREAD_MAIL = 5

/* Errors */
$lang['Error_Other_Table'] = 'Erreur dans le questionnement de la table requise.';
$lang['Error_Posts_Text_Table'] = 'Erreur dans le questionnement de la table de texte des Messages Priv&eacute;s.';
$lang['Error_Posts_Table'] = 'Erreur dans le questionnemnt de la table des Messages Priv&eacute;s.';
$lang['Error_Posts_Archive_Table'] = 'Erreur dans le questionnement de la table des Archives des Messages Priv&eacute;s.';
$lang['No_Message_ID'] = 'l\'ID du message n\'a pas &eacute;t&eacute; sp&eacute;cifi&eacute;e.';
/*Special Cases, Do not bother to change for another language */
$lang['ASC'] = $lang['Sort_Ascending'];
$lang['DESC'] = $lang['Sort_Descending'];
$lang['privmsgs_date'] = $lang['Sent_Date'];
$lang['privmsgs_subject'] = $lang['Subject'];
$lang['privmsgs_from_userid'] = $lang['From'];
$lang['privmsgs_to_userid'] = $lang['To'];
$lang['privmsgs_type'] = $lang['PM_Type'];
$lang['Close_Window'] = 'Fermer cette fen&egrave;tre';

?>