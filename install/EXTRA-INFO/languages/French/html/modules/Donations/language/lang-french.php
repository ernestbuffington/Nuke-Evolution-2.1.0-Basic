<?php
/*=======================================================================
 Nuke-Evolution     :   Enhanced Web Portal System
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

global $lang_donate;

//Common
$lang_donate['ADMIN_HEADER'] = 'Evo-Cms :: Panneau d\'administration des donnations';
$lang_donate['RETURNMAIN'] = 'Retourner &agrave; l\'administration principale';
$lang_donate['DONATIONS'] = 'Donations';
$lang_donate['CURRENT_DONATIONS'] = 'Donations actuelles';
$lang_donate['DONATION_VALUES'] = 'Valeurs des Donations';
$lang_donate['CONFIG_BLOCK'] = 'Configuration du Bloc';
$lang_donate['CONFIG_GENERAL'] = 'Configuration des Donations';
$lang_donate['CONFIG_PAGE'] = 'Configuration de la Page';
$lang_donate['ADD_DONATION'] = 'Ajouter une Donation';
$lang_donate['BREAK'] = ':';
$lang_donate['YES'] = 'Oui';
$lang_donate['NO'] = 'Non';
$lang_donate['DONATION_SUBMIT'] = 'Soumettre';

//Config Page & Config Block
$lang_donate['SHOW_AMOUNTS'] = 'Afficher les montants';
$lang_donate['SHOW_GOAL'] = 'Afficher l\'objectif';
$lang_donate['SHOW_ANON_AMNTS'] = 'Afficher les Anonymes';
$lang_donate['BUTTON_IMAGE'] = 'Image du Bouton';
$lang_donate['NUM_DONATIONS'] = 'Nombre de donations &agrave; afficher';
$lang_donate['SHOW_DATES'] = 'Afficher la date des donations';

//Config Page
$lang_donate['PAGE_HEADER_IMG'] = 'Image de l\'ent&ecirc;te de la page';

//Config Donation
$lang_donate['PP_EMAIL'] = 'E-mail adresse de PayPal';
$lang_donate['CURRENCY'] = 'Monnaie';
$lang_donate['DONATION_NAME'] = 'Nom de la Donation';
$lang_donate['DONATION_CODE'] = 'Code de la Donation';
$lang_donate['MONTHLY_GOAL'] = 'Objectif Mensuel';
$lang_donate['DATE_FORMAT'] = 'Format de la Date (<a href="http://us3.php.net/date">PHP Date</a>)';
$lang_donate['TYPE'] = 'Type de Donations';
$lang_donate['TYPE_PRIVATE'] = 'Priv&eacute;e';
$lang_donate['TYPE_ANON'] = 'Anonyme';
$lang_donate['TYPE_REGULAR'] = 'Reguli&egrave;re';
$lang_donate['THANK_YOU'] = 'Merci';
$lang_donate['IMAGE'] = 'Image';
$lang_donate['MESSAGE'] = 'Message';
$lang_donate['CANCEL'] = 'Annuler';
$lang_donate['MESSAGE'] = 'Autoriser les Message/Raison';
$lang_donate['SCROLL'] = 'Liste de donations d&eacute;filante';
$lang_donate['NUMBERS'] = 'Afficher le nombre';
$lang_donate['CODES'] = 'Codes des Donations';
$lang_donate['COOKIE_TRACK'] = 'Traquer les donations avec cookies';

//Add Donation
$lang_donate['ADD_DONATION'] = 'Ajouter une Donation';
$lang_donate['UNAME'] = 'Nom d\'utilisateur';
$lang_donate['FIRST_NAME'] = 'Nom';
$lang_donate['LAST_NAME'] = 'Pr&eacute;nom';
$lang_donate['EMAIL_ADD'] = 'Adresse Email';
$lang_donate['DONATION'] = 'Donation';
$lang_donate['ADDED'] = 'Donation ajout&eacute;e';
$lang_donate['ADD_TYPE'] = 'Type de Donation';
$lang_donate['DONATE_TO'] = 'Don &agrave;';

//Security
$lang_donate['ACCESS_DENIED'] = '<span style="color: #FF0000; font-weight: bold;">Acc&egrave;s Interdit</span>';

//Errors
$lang_donate['ERROR'] = '<span style="color: #FF0000; font-weight: bold;">ERREUR!</span><br />';
$lang_donate['VALUES_NF'] = 'Les valeurs ne peuvent &ecirc;tre trouv&eacute;es';
$lang_donate['VALUES_ND'] = 'Les valeurs ne peuvent &ecirc;tre affich&eacute;es';
$lang_donate['UNAMES_NF'] = 'Le nom d\'utilisateur ne peut &ecirc;tre trouv&eacute;';
$lang_donate['UINFO_NF'] = 'Les informations utilisateur ne peuvent &ecirc;tre obtenues';
$lang_donate['TYPES_NF'] = 'Les types de donation ne peuvent &ecirc;tre obtenues';
$lang_donate['MISSING_FNAME'] = 'Veuillez entrer votre nom';
$lang_donate['MISSING_LNAME'] = 'Veuillez entrer votre pr&eacute;nom';
$lang_donate['INVALID_DONATION'] = 'Veuillez entrer une donation valide';
$lang_donate['INVALID_EMAIL'] = 'Veuillez entrer une adresse E-mail valide';
$lang_donate['CODES_SHORT'] = 'Vous devez entrer un nom de code, et un code PayPal dans les codes Donations:';
$lang_donate['CODES_SPACES'] = 'Les espaces ne sont pas autoris&eacute;s dans le code';

//Current
$lang_donate['DATE'] = 'Date';
$lang_donate['USERNAME'] = 'Nom d\'Utilisateur';
$lang_donate['AMOUNT'] = 'Montant';
$lang_donate['TOTAL'] = 'Total';
$lang_donate['GOAL'] = 'Objectif';
$lang_donate['DIFF'] = 'Diff&eacute;rence';
$lang_donate['NEXT'] = 'Suivant';
$lang_donate['PREV'] = 'Pr&eacute;c&eacute;dent';
$lang_donate['NEXT_DIRECTION'] = '&gt;&gt;';
$lang_donate['PREV_DIRECTION'] = '&lt;&lt;';
$lang_donate['N/A'] = 'N/A';

//Help
$lang_donate['HELP_DONATION_ANON'] = 'Tout sauf la donation est cach&eacute; de l\'administration.<br /><br /><b>NOTE:</b> PayPal montrera toujours toute l\'information si ce n\'est pas 100% anonyme';
$lang_donate['HELP_DONATION_PRIVATE'] = 'Les donations sont invisible du public mais <b>pas</b> de l\'admin.';
$lang_donate['HELP_DONATION_NAME'] = 'Ceci est le premier type d\'information';
$lang_donate['HELP_DONATION_CODE'] = 'Ceci est le premier type de code donation dans Paypal';
$lang_donate['HELP_DONATION_CODES'] = 'Ceci est l\'endroit o&ugrave; vous pouvez mettre d\'autres types et codes de donation.  Ceci est <strong>optionnel</strong>.<br /><br />Par exemple si vous voulez faire un code pour les factures d\'un h&ocirc;pital.<hr>La premi&egrave;re ligne est le texte '
                                      .'celui qui s\'affichera dans la boite de texte.  Assurez vous de mettre quelque chose qui est un sens pour les visiteurs. Les espaces sont autoris&eacute;s.<br />Donc pour cet exemple: Factures H&ocirc;pital<br /><br />'
                                      .'La ligne suivante ets le code paypal que vous voulez utiliser.<br />Les espaces ne sont <strong>PAS</strong> autoris&eacute;s!<br />Donc pour notre exemple: hospital_bills<hr>Donc le r&eacute;sultat final sera:<br />'
                                      .'Factures H&ocirc;pital<br />hospital_bills';
$lang_donate['HELP_COOKIE_TRACK'] = 'Ceci tiendra des valeurs de donation dans les cookies utilisateur. Il ajoute une autre mani&egrave;re d\'aider la voie donations.<br /><strong>Ceci devrait seulement &ecirc;tre employ&eacute; si vous avez des probl&egrave;mes!</strong>';
?>