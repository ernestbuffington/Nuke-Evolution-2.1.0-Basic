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

global $module_name;
$lang_new[$module_name]['_ACTIVE'] = 'Actif';
$lang_new[$module_name]['_ACTIVEADSFOR'] = 'Banni&grave;re active actuellement pour';
$lang_new[$module_name]['_ACTIVEBANNERS2'] = 'Banni&egrave;res actives';
$lang_new[$module_name]['_ACTIVEBANNERS'] = 'Banni&egrave;res actives actuellement';
$lang_new[$module_name]['_ADCLASS'] = 'Type d\'annonce';
$lang_new[$module_name]['_ADCODE'] = 'Javascript/HTML Code';
$lang_new[$module_name]['_ADDADVERTISINGPLAN'] = 'Ajouter un Plan Publicitaire';
$lang_new[$module_name]['_ADDBANNER'] = 'Ajouter une banni&egrave;re';
$lang_new[$module_name]['_ADDCLIENT2'] = 'Ajouter un client';
$lang_new[$module_name]['_ADDCLIENT'] = 'Ajouter un nouveau client';
$lang_new[$module_name]['_ADDEDDATE'] = 'Ajouter Date';
$lang_new[$module_name]['_ADDIMPRESSIONS'] = 'Ajouter plus d\'impressions';
$lang_new[$module_name]['_ADDNEWBANNER'] = 'Ajouter une nouvelle banni&egrave;re';
$lang_new[$module_name]['_ADDNEWPLAN'] = 'Ajouter un nouveau plan';
$lang_new[$module_name]['_ADDNEWPOSITION'] = 'Ajouter une Position Publicitaire';
$lang_new[$module_name]['_ADDPLANERROR'] = '<strong>Erreur:</strong> Une ou plusieur champs sont vide. Merci de revnir en arri&egrave;re et de corriger le probl&egrave;me.';
$lang_new[$module_name]['_ADDPOSITION'] = 'Ajouter une Position';
$lang_new[$module_name]['_ADFLASH'] = 'Flash';
$lang_new[$module_name]['_ADSGFX_FAILURE'] = 'Merci de rentrer un code GFX correct';
$lang_new[$module_name]['_ADIMAGE'] = 'Image';
$lang_new[$module_name]['_ADINFOINCOMPLETE'] = '<strong>Erreur:</strong> L\'information de la banni&egrave; est incompl&grave;te!';
$lang_new[$module_name]['_ADISNTYOURS'] = '<strong>Erreur:</strong> La banni&egrave;re que vous essayez de voir n\'est pas attribu&eacute; &agrave; un compte.';
$lang_new[$module_name]['_ADPOSITIONS'] = 'Position Annonce';
$lang_new[$module_name]['_ADSMENU'] = 'Menu Publicit&eacute;';
$lang_new[$module_name]['_ADSMODULEINACTIVE'] = '[ Attention : le Module de Publicit&eacute; est inactif! ]';
$lang_new[$module_name]['_ADSNOCLIENT'] = '<strong>Erreur:</strong> Il n\'y a pas de client Publicitaire.<br />Merci de c&eacute;er un client avant d\'ajouter une banni&egrave;re.';
$lang_new[$module_name]['_ADSNOCONTENT'] = 'D&eacute;sole pour l\'instant vous n\'avez pas de plan publiciaire valide';
$lang_new[$module_name]['_ADSYSTEM'] = 'Syst&egrave;me de Publicit&eacute;';
$lang_new[$module_name]['_ADVERTISING'] = 'Publicit&eacute;';
$lang_new[$module_name]['_ADVERTISINGCLIENTS'] = 'Clients publicitaire';
$lang_new[$module_name]['_ADVERTISINGPLANEDIT'] = 'Modifier le plan Publicitaire';
$lang_new[$module_name]['_ADVERTISINGPLANS'] = 'Plans Publicitaire';
$lang_new[$module_name]['_ASSIGNEDADS'] = 'Assigner Annonce';
$lang_new[$module_name]['_BACK'] = 'Back';
$lang_new[$module_name]['_BANNERID'] = 'ID Banni&grave;re';
$lang_new[$module_name]['_BANNERIMAGE'] = 'Image Banni&grave;re';
$lang_new[$module_name]['_BANNERNAME'] = 'Nom Banni&grave;re';
$lang_new[$module_name]['_BANNERS'] = 'Banni&egrave;res';
$lang_new[$module_name]['_BANNERSADMIN'] = 'Panneau d\'administration des banni&egrave;res';
$lang_new[$module_name]['_BANNERS_ADMIN_HEADER'] = 'Evo-Cms banni&egrave;res :: Panneau d\'administration du module';
$lang_new[$module_name]['_BANNERS_RETURNMAIN'] = 'Retour au menu principale d\'administration';
$lang_new[$module_name]['_BANNERURL'] = 'URL Banni&grave;re';
$lang_new[$module_name]['_BUYLINKS'] = 'Lien d\'achat';
$lang_new[$module_name]['_CANTDELETEPOSITION'] = '<strong>Erreur:</strong> Vous ne pouvez pas effacer toutes les Positions. Il doit en rester une dans la base de donn&eacute;es.<br />Modifier la position si vous avez besoin de la changer ou d\'ajouter un nouveau.';
$lang_new[$module_name]['_CLASS'] = 'Type';
$lang_new[$module_name]['_CLASSNOTE'] = 'Si votre type d\'annonce est en Javascript/HTML le code des 4 prochains champs sera ignor&eacute; et seulement la zone de code si dessous sera pris en compte. Si votre type d\'annonce est en Flash vous pouvez mettre l\'URL compl&egrave;te de votre .SWF dans le prochain champ et r&eacute;gler les dimension de votre animation Flash (Cliquer sur URL et les autres champs seront ignor&eacute;s).';
$lang_new[$module_name]['_CLICKS'] = 'Cliques';
$lang_new[$module_name]['_CLICKSPERCENT'] = '% Cliques';
$lang_new[$module_name]['_CLICKURL'] = 'Clique URL';
$lang_new[$module_name]['_CLIENT'] = 'Client';
$lang_new[$module_name]['_CLIENTLOGIN'] = 'Login du client';
$lang_new[$module_name]['_CLIENTNAME'] = 'Nom du client';
$lang_new[$module_name]['_CLIENTPASSWD'] = 'Mot de passe du client';
$lang_new[$module_name]['_CLIENTWITHOUTBANNERS'] = 'Ce client n\'a pas de banni&egrave;re en cours d\'ex&eacute;cution actuellement.';
$lang_new[$module_name]['_CONTACTEMAIL'] = 'Email du contact';
$lang_new[$module_name]['_CONTACTNAME'] = 'Nom du contact';
$lang_new[$module_name]['_COUNTRYNAME'] = 'Votre nom de pays';
$lang_new[$module_name]['_CURREGUSERS'] = 'Utilisateur courant enregistr&eacute; :';
$lang_new[$module_name]['_CURRENTPOSITIONS'] = 'Positions actuelle de l\'annonce';
$lang_new[$module_name]['_CURRENTSTATUS'] = 'Status actuel:';
$lang_new[$module_name]['_DAYS'] = 'Jours';
$lang_new[$module_name]['_DEACTIVATE'] = 'Deactivate';
$lang_new[$module_name]['_DELCLIENTHASBANNERS'] = 'Ce client a les banni&egrave;res suivantes actives et en fonction actuellement';
$lang_new[$module_name]['_DELETE'] = 'Effacer';
$lang_new[$module_name]['_DELETEALLADS'] = 'Effacer toutes les banni&egrave;res';
$lang_new[$module_name]['_DELETEBANNER'] = 'Effacer la banni&egrave;re';
$lang_new[$module_name]['_DELETECLIENT'] = 'Effacer la publicit&eacute;e client';
$lang_new[$module_name]['_DELETEPLAN'] = 'Effacer les plans d\'annonces';
$lang_new[$module_name]['_DELETEPOSITION'] = 'Effacer la Position Annonce';
$lang_new[$module_name]['_DELIVERY'] = 'Mode de livraison';
$lang_new[$module_name]['_DELIVERYQUANTITY'] = 'Quantit&eacute;e de Livraison';
$lang_new[$module_name]['_DELIVERYTYPE'] = 'Mode de livraison';
$lang_new[$module_name]['_DESCRIPTION'] = 'Description';
$lang_new[$module_name]['_EDIT'] = 'Editer';
$lang_new[$module_name]['_EDITBANNER'] = 'Editer la banni&egrave;re';
$lang_new[$module_name]['_EDITCLIENT'] = 'Editer la publicit&eacute;e client';
$lang_new[$module_name]['_EDITPOSITION'] = 'Modifier Position des publicit&eacute;es';
$lang_new[$module_name]['_EDITTERMS'] = 'Editer les conditions d\'utilisation';
$lang_new[$module_name]['_EMAILSTATS'] = 'Email Stats';
$lang_new[$module_name]['_ENTER'] = 'Entrer';
$lang_new[$module_name]['_EXTRAINFO'] = 'Extra Information';
$lang_new[$module_name]['_FLASHFILEURL'] = 'URL fichier Flash';
$lang_new[$module_name]['_FLASHMOVIE'] = ' Animation Flash';
$lang_new[$module_name]['_FLASHSIZE'] = 'Taille de l\'animation Flash';
$lang_new[$module_name]['_FOLLOWINGSTATS'] = 'Voici les stats compl&egrave;tes pour votre investissement publicitaire au';
$lang_new[$module_name]['_FUNCTIONNOTALLOWED'] = '<strong>Erreur:</strong> La fonction s&eacute;lectionn&eacute;e n\'est pas autoris&eacute;.';
$lang_new[$module_name]['_FUNCTIONS'] = 'Fonctions';
$lang_new[$module_name]['_GENERALSTATS'] = 'Statistiques G&eacute;n&eacute;ral';
$lang_new[$module_name]['_GENERATEDON'] = 'Rapport g&eacute;n&eacute;r&eacute; dans';
$lang_new[$module_name]['_GOBACK'] = '[ <a href="javascript:history.go(-1)">Retour en arri&egrave;re</a> ]';
$lang_new[$module_name]['_GOOGLERANK'] = 'Ce site sur Google est rang :';
$lang_new[$module_name]['_HEIGHT'] = 'Hauteur';
$lang_new[$module_name]['_HEREARENUMBERS'] = 'Voici quelques chiffres sur notre site qui pourraient vous int&eacute;resser avant de proc&eacute;der &agrave; l\'achat de votre publicit&eacute;:';
$lang_new[$module_name]['_IMAGESIZE'] = 'Taille de l\'image';
$lang_new[$module_name]['_IMAGESWFURL'] = 'URL image';
$lang_new[$module_name]['_IMPLEFT'] = 'Imp. gauche';
$lang_new[$module_name]['_IMPMADE'] = 'Imp. fait';
$lang_new[$module_name]['_IMPPURCHASED'] = 'Impressions Achet&eacute;';
$lang_new[$module_name]['_IMPRELEFT'] = 'Impressions &agrave; gauche';
$lang_new[$module_name]['_IMPREMADE'] = 'Impressions Faite';
$lang_new[$module_name]['_IMPRESSIONS'] = 'Impressions';
$lang_new[$module_name]['_IMPTOTAL'] = 'Imp. Total';
$lang_new[$module_name]['_INACTIVE'] = 'Inactif';
$lang_new[$module_name]['_INACTIVEADS'] = 'Banni&egrave;re actuellement inactive';
$lang_new[$module_name]['_INACTIVEBANNERS'] = 'Banni&egrave;res actuellement inactive';
$lang_new[$module_name]['_INITIALSTATUS'] = 'Status Initial';
$lang_new[$module_name]['_INPIXELS'] = '(taille en pixel)';
$lang_new[$module_name]['_LISTPLANS'] = 'La liste suivante montre nos plans de publicit&eacute;, de prix et un lien direct pour acheter vos annonces :';
$lang_new[$module_name]['_LOGIN'] = 'Nom de login du client';
$lang_new[$module_name]['_LOGININCORRECT'] = 'Login Incorrect!!!';
$lang_new[$module_name]['_MADE'] = 'Made';
$lang_new[$module_name]['_MAINPAGE'] = 'Page Principale';
$lang_new[$module_name]['_MONTHS'] = 'Mois';
$lang_new[$module_name]['_MOVEADS'] = 'Pour d&eacute;placer des annonces';
$lang_new[$module_name]['_MOVEDADSSTATUS'] = 'Nouveau statut des annonces d&eacute;plac&eacute;';
$lang_new[$module_name]['_MYADS'] = 'Mon Annonces';
$lang_new[$module_name]['_NA'] = 'N/A';
$lang_new[$module_name]['_NAME'] = 'Nom';
$lang_new[$module_name]['_NO'] = 'Non';
$lang_new[$module_name]['_NOCHANGES'] = 'Pas de changement';
$lang_new[$module_name]['_NOCONTENT'] = 'Il n\'y a pas de contenu ici en ce moment ...';
$lang_new[$module_name]['_NONE'] = 'Aucune';
$lang_new[$module_name]['_NOTE'] = 'Note:';
$lang_new[$module_name]['_PASSWORD'] = 'Mot de passe';
$lang_new[$module_name]['_PDAYS'] = 'Jours';
$lang_new[$module_name]['_PLANBUYLINKS'] = 'Lien d\'achat';
$lang_new[$module_name]['_PLANDESCRIPTION'] = 'Description Plan';
$lang_new[$module_name]['_PLANNAME'] = 'Nom de plan';
$lang_new[$module_name]['_PLANSNOTE'] = 'Des plans sont &agrave; titre indicatif uniquement et sera publi&eacute; sur le module de publicit&eacute; afin que vos clients savent ce que vous avez &agrave; offrir, les conditions, les prix et un lien pour payer pour votre service.';
$lang_new[$module_name]['_PLANSPRICES'] = 'Plans et Prix';
$lang_new[$module_name]['_PMONTHS'] = 'Mois';
$lang_new[$module_name]['_POSEXAMPLE'] = 'Vous pouvez jeter un oeil au fichier <em>/blocks/block-Advertising.php</em> et fichier <em>/header.php</em> afin d\'avoir un exemple clair sur la fa&ccedil;on de mettre en œuvre dans votre site.';
$lang_new[$module_name]['_POSINFOINCOMPLETE'] = '<strong>Erreur:</strong> Le champ Nom de position publicitaire ne peut pas &ecirc;tre vide.';
$lang_new[$module_name]['_POSITION'] = 'Position';
$lang_new[$module_name]['_POSITIONHASADS'] = 'La position des annonces que vous avez choisi de supprimer, supprimera les banni&egrave;res qui lui sont assign&eacute;es.<br />Merci de s&eacute;l&eacute;ctionner une position pour d&eacute;placer toutes les annonces.';
$lang_new[$module_name]['_POSITIONNAME'] = 'Nom de position';
$lang_new[$module_name]['_POSITIONNOTE'] = 'Pour utiliser la position, vous devez inclure le code: <em> annonce(position);</em> dans votre fichier de th&ecirc;me, ou "position" est le nombre de la position dans votre espace d\'annonce.';
$lang_new[$module_name]['_POSITIONNUMBER'] = 'Nombre de position';
$lang_new[$module_name]['_PRICE'] = 'Prix';
$lang_new[$module_name]['_PURCHASED'] = 'Acheter';
$lang_new[$module_name]['_PURCHASEDIMPRESSIONS'] = 'Acheter des Impressions';
$lang_new[$module_name]['_PYEARS'] = 'Ann&eacute;es';
$lang_new[$module_name]['_QUANTITY'] = 'Quantit&eacute;e';
$lang_new[$module_name]['_RECEIVEDCLICKS'] = 'Clicks Re&ccedil;u';
$lang_new[$module_name]['_SAVECHANGES'] = 'Sauvegarder';
$lang_new[$module_name]['_SAVEPOSITION'] = 'Saauvegarder les changements';
$lang_new[$module_name]['_SITENAMEADS'] = '(Pour int&eacute;grer votre nom de site sur l\'utilisation du texte [sitename] et d\'utiliser le type de votre nom de pays [pays] dans le texte et il sera remplac&eacute; &agrave; partir du module de publicit&eacute;)';
$lang_new[$module_name]['_SITESTATS'] = 'Site Stats';
$lang_new[$module_name]['_STATSNOTSEND'] = 'Les statistiques de la banni&egrave;re s&eacute;l&eacute;ctionn&eacute;e ne peuvent &ecirc;tre envoy&eacute;es parcequ\'<br />il n\'y a pas de mail associ&eacute;.<br />Merci de contacter l\'administrateur';
$lang_new[$module_name]['_STATSSENT'] = 'Statistiques de votre banni&egrave;re publicitaire ont &eacute;t&eacute; envoy&eacute;es par mail &agrave;';
$lang_new[$module_name]['_STATUS'] = 'Status';
$lang_new[$module_name]['_SURETODELBANNER'] = 'Etes-vous s&ucirc;r de vouloir effacer cette banni&egrave;re?';
$lang_new[$module_name]['_SURETODELCLIENT'] = 'Vous &ecirc;tes sur le point de supprimer le client et l\'ensemble de ses banni&egrave;res!!!';
$lang_new[$module_name]['_SURETODELPLAN'] = 'Vous &ecirc;tes sur le point de supprimer un plan publicitaire. Etes-vous s&ucirc;r de vouloir continuer ??';
$lang_new[$module_name]['_SURETODELPOSITION'] = 'Vous &ecirc;tes sur le point de supprimer une position d\'annonces. Etes-vous s&ucirc;r de vouloir continuer ?';
$lang_new[$module_name]['_TERMS'] = 'Termes';
$lang_new[$module_name]['_TERMSCONDITIONS'] = 'Termes et Conditions';
$lang_new[$module_name]['_TERMSNOTE'] = 'Pr&eacute;cieusement revoir les conditions par d&eacute;faut. Changer ce que vous voulez changer en fonction de votre politique de publicit&eacute;. Il sera publi&eacute; dans le module de publicit&eacute;.';
$lang_new[$module_name]['_TERMSOFSERVICEBODY'] = 'Conditions d\'utilisation du corp';
$lang_new[$module_name]['_TOTALVIEWS'] = 'Total pages vues jusqu\'&agrave; pr&eacute;sent:';
$lang_new[$module_name]['_TYPE'] = 'Type';
$lang_new[$module_name]['_UNLIMITED'] = 'Non limit&eacute;';
$lang_new[$module_name]['_VIEWBANNER'] = 'Voir la Banni&egrave;re';
$lang_new[$module_name]['_VIEWSDAY'] = 'Pages vues en moyenne par jour :';
$lang_new[$module_name]['_VIEWSHOUR'] = 'Pages vues en moyenne par heure:';
$lang_new[$module_name]['_VIEWSMONTH'] = 'Pages vues en moyenne par mois :';
$lang_new[$module_name]['_VIEWSYEAR'] = 'Pages vues en moyenne par an :';
$lang_new[$module_name]['_WELCOMEADS'] = '<strong>Bienvenue dans notre section publicit&eacute;!</strong><br /><br />Si vous souhaitez que votre annonce banni&egrave;re soit affich&eacute; dans notre site Web, vous voudrez peut-&ecirc;tre conna&icirc;tre certains d&eacute;tails, parce que vous devez savoir quel type de cible et les annonces de plans nous pouvons offrir.<br /><br />Si vous &ecirc;tes d&eacute;j&agrave; client de la publicit&eacute;, s\'il vous pla&icirc;t connectez-vous<strong><a href="modules.php?name=Advertising&amp;op=client\">ICI</a></strong>.<br />';
$lang_new[$module_name]['_WIDTH'] = 'Largueur';
$lang_new[$module_name]['_XFORUNLIMITED'] = '&eacute;crire X pour illimit&eacute;';
$lang_new[$module_name]['_YEARS'] = 'Ann&eacute;es';
$lang_new[$module_name]['_YES'] = 'Oui';
$lang_new[$module_name]['_YOURBANNER'] = 'Votre Banni&egrave;re';
$lang_new[$module_name]['_YOURSTATS'] = 'Vos statistique de banni&egrave;re &agrave;';
?>