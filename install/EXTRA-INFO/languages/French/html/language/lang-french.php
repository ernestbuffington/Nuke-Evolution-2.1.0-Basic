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

define("_CHARSET","UTF-8");
define("_LANG_DIRECTION","ltr");
define("_SEARCH","Recherche");
define("_SUBMIT","Envoyer");
define("_REFRESH_SEC_CODE","Rafra&icirc;chir le Code Security");
define("_CONFIRM", "Confirme");
define("_PROFILE","Profil");
define("_LOGIN","Identification");
define("_VIEWING","Regard&eacute;");
define("_WRITES","a &eacute;crit");
define("_APPROVEDBY","Approv&eacute par");
define("_POSTEDON","Post&eacute; le");
define("_NICKNAME","Surnom/Pseudo");
define("_PASSWORD","Mot de Passe");
define("_WELCOMETO","Bienvenue sur");
define("_EDIT","Editer");
define("_DELETE","Supprimer");
define("_POSTEDBY","Transmis par");
define("_READS","lecture(s)");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Retour</a> ]");
define("_BACK","Retour");
define("_COMMENTS","commentaires");
define("_PASTARTICLES","Articles pr&eacute;c&eacute;dents");
define("_OLDERARTICLES","Archives");
define("_BY","par");
define("_ON","le");
define("_LOGOUT","Sortie");
define("_WAITINGCONT","Contenu en attente");
define("_SUBMISSIONS","Propositions");
define("_EPHEMERIDS","Eph&eacute;m&eacute;rides");
define("_ONEDAY","Un Jour comme Aujourd'hui...");
define("_ASREGISTERED","Vous n'avez pas encore de compte?<br><a href=\"modules.php?name=Your_Account&amp;op=new_user\">Enregistrez vous !</a><br>En tant que membre enregistr&eacute;, vous b&eacute;n&eacute;ficierez de privil&egrave;ges tels que: changer le th&egrave;me de l'interface, modifier la disposition des commentaires, signer vos interventions, ...");
define("_MENUFOR","Menu de");
define("_NOBIGSTORY","Il n'y a pas encore d'article-phare aujourd'hui.");
define("_BIGSTORY","Aujourd'hui, l'article le plus lu est:");
define("_SURVEY","Sondage");
define("_POLLS","Sondages");
define("_PCOMMENTS","Commentaires:");
define("_RESULTS","R&eacute;sultats");
define("_HREADMORE","suite...");
define("_CURRENTLY","Il y a pour le moment");
define("_GUESTS","invit&eacute;(s) et");
define("_MEMBERS","membre(s) en ligne.");
define("_YOUARELOGGED","Vous &ecirc;tes connect&eacute;s en tant que");
define("_YOUHAVE","Vous avez");
define("_PRIVATEMSG","message(s) priv&eacute;(s).");
define("_YOUAREANON","Vous &ecirc;tes un visiteur anonyme. Vous pouvez vous enregistrer gratuitement en cliquant <a href=\"modules.php?name=Your_Account&amp;op=new_user\">ici</a>.");
define("_NOTE","Note:");
define("_ADMIN","Admin:");
define("_WERECEIVED","Pages vues :");
define("_PAGESVIEWS","depuis");
define("_TOPIC","Sujet");
define("_UDOWNLOADS","T&eacute;l&eacute;chargements");
define("_VOTE","Vote");
define("_VOTES","Votes");
define("_MVIEWADMIN","Visualisation: Administrateurs seulement");
define("_MVIEWUSERS","Visualisation: Utilisateurs enregistr&eacute;s seulement");
define("_MVIEWANON","Visualisation: Utilisateurs anonymes seulement");
define("_MVIEWGROUP","Visualisation: Groupes seulement");
define("_MVIEWALL","Visualisation: Tous les visiteurs");
define("_EXPIRELESSHOUR","Expiration: Moins d'une heure");
define("_EXPIREIN","Expiration dans");
define("_HTTPREFERERS","R&eacute;f&eacute;rants HTTP");
define("_UNLIMITED","Illimit&eacute;es");
define("_HOURS","heures");
define("_RSSPROBLEM","La manchette de ce site n'est pas disponible pour le moment.");
define("_SELECTLANGUAGE","S&eacute;lectionnez la langue");
define("_SELECTGUILANG","S&eacute;lectionnez la langue de l'interface:");
define("_NONE","Aucun");
define("_BLOCKPROBLEM","<center>Il y a un probl&egrave;me avec ce bloc.</center>");
define("_BLOCKPROBLEM2","<center>Il n'y a rien dans ce bloc.</center>");
define("_MODULENOTACTIVE","D&eacute;sol&eacute;, ce module n'est pas activ&eacute;");
define("_MODULEDOESNOTEXIST","D&eacute;sol&eacute;... mais ce module est inexistant!");
define("_NOACTIVEMODULES","Modules inactifs");
define("_FORADMINTESTS","(Pour des tests administratifs)");
define("_BBFORUMS","Forums");
define("_ACCESSDENIED","Acc&egrave;s refus&eacute;");
define("_RESTRICTEDAREA","Vous essayez d'acc&eacute;der &agrave; un espace r&eacute;serv&eacute;.");
define("_MODULEUSERS","Nous sommes d&eacute;sol&eacute;s mais cette section de notre site est r&eacute;serv&eacute;e aux <i>utilisateurs enregistr&eacute;s seulement</i><br><br>Vous pouvez vous enregistrer gratuitement en cliquant <a href=\"modules.php?name=Your_Account&amp;op=new_user\">ici</a>, puis vous pouvez<br>acc&eacute;der &agrave; cette section sans r&eacute;striction. Merci.<br><br>");
define("_MODULESADMINS","Nous sommes d&eacute;sol&eacute;s mais cette section de notre site est r&eacute;serv&eacute;e aux <i>administrateurs seulement</i><br><br>");
define("_HOME","Accueil");
define("_HOMEPROBLEM","Nous avons un probl&egrave;me ici: nous n'avons pas de page principale!!!");
define("_ADDAHOME","Ajouter un module &agrave; votre page d'accueil");
define("_HOMEPROBLEMUSER","Un probl&egrave;me est apparu dans la page principale. Merci de revenir plus tard.");
define("_MORENEWS","Plus dans la section Nouvelles");
define("_ALLCATEGORIES","Toutes les Cat&eacute;gories");
//define("_DATESTRING","%A, %B %d, %Y @ %T %Z");
//define("_DATESTRING2","%A, %B %d");
define('_DATESTRING','%A, %B %d, %Y (%H:%M:%S)');
define('_DATESTRING2','%A, %B %d');
define('_DATESTRING3','%d-%b-%Y');
define('_DATESTRING4','%1$s, %2$s %3$s');
define("_DATE","Date");
define("_HOUR","Heure");
define("_UMONTH","Mois");
define("_YEAR","Ann&eacute;e");
define("_JANUARY","Janvier");
define("_FEBRUARY","F&eacute;vrier");
define("_MARCH","Mars");
define("_APRIL","Avril");
define("_MAY","Mai");
define("_JUNE","Juin");
define("_JULY","Juillet");
define("_AUGUST","Aout");
define("_SEPTEMBER","Septembre");
define("_OCTOBER","Octobre");
define("_NOVEMBER","Novembre");
define("_DECEMBER","D&eacute;cembre");
define("_BWEL","Bienvenue");
define("_BLOGOUT","D&eacute;connexion");
define("_BPM","Messages Priv&eacute;s");
define("_BUNREAD","Non Lu");
define("_BREAD","Lu");
define("_BSAVED","Sauvegard&eacute;");
define("_BTT","Total");
define("_BMEMP","Adh&eacute;sion");
define("_BLATEST","Dernier");
define("_BTD","Aujourd'hui");
define("_BYD","Hier");
define("_BOVER","Tous");
define("_BVISIT","Public En Ligne");
define("_BVIS","Visiteurs");
define("_BMEM","Membres");
define("_BON","En ligne");
define("_BOR","ou");
define("_BPLEASE","Veuillez");
define("_BREG","Devenez Membre");
define("_BROADCAST","Envoyer un Message Publique");
define("_BROADCASTFROM","Message publique Depuis");
define("_TURNOFFMSG","D&eacute;sactiver les Messages Publiques");
define("_JOURNAL","Journal");
define("_READMYJOURNAL","lire Mon Journal");
define("_ADD","Ajouter");
define("_YES","Oui");
define("_NO","Non");
define("_INVISIBLEMODULES","Modules Invisibles");
define("_ACTIVEBUTNOTSEE","(Lien Actif mais invisible)");
define("_THISISAUTOMATED","Ceci est un message automatique, pour vous indiquer que votre campagne publicitaire est termin&eacute;e.");
define("_THERESULTS","Les r&eacute;sultats de votre compagne sont les suivants:");
define("_TOTALIMPRESSIONS","Nombre Total d'Affichage:");
define("_CLICKSRECEIVED","Nombre de clics reçus:");
define("_IMAGEURL","URL Image");
define("_CLICKURL","URL Clic:");
define("_ALTERNATETEXT","Texte Altern&eacute;:");
define("_HOPEYOULIKED","Nous esp&eacute;rons que nos services vous ont satisfaits et vous prions d'agr&eacute;er, l'expression de notre parfaite collaboration.");
define("_THANKSUPPORT","Cordialement");
define("_TEAM","L'&eacute;quipe");
define("_BANNERSFINNISHED","Bandeau Publicitaire Termin&eacute;");
define("_PAGEGENERATION","G&eacute;n&eacute;ration page:");
define("_MEMORYUSAGE","Memoire Utilis&eacute;: ");
define("_DBQUERIES","Requ&ecirc;tes SQL: ");
//define('_PAGEFOOTER','Cette page a &eacute;t&eacute; g&eacute;n&eacute;r&eacute;e en %1$s secondes avec %2$s requ&ecirc;tes DB en %3$s secondes');
define("_SECONDS","Secondes");
define("_YOUHAVEONEMSG","Vous avez 1 nouveau message priv&eacute;");
define("_NEWPMSG","Nouveau message priv&eacute;");
define("_CONTRIBUTEDBY","Contribution de");
define("_CHAT","Chat");
define("_REGISTERED","Enregistr&eacute;");
define("_CHATGUESTS","Invit&eacute;s");
define("_USERSTALKINGNOW","Utilisateur(s) connect&eacute;(s)");
define("_ENTERTOCHAT","Se connecter au Chat");
define("_CHATROOMS","Salon(s) disponible(s)");
define("_SECURITYCODE","Code de s&eacute;curit&eacute;");
define("_TYPESECCODE","entrez votre code");
define("_ASSOTOPIC","Sujets associ&eacute;s");
define("_ADDITIONALYGRP","Additionnel ce module appartient au groupe utilisateurs");
define("_YOUHAVEPOINTS","Points que vous avez obtenus par votre participation sur ce site:");
define("_MVIEWSUBUSERS","Visualisation: Les utilisateurs abonn&eacute;s seulement");
define("_MODULESSUBSCRIBER","Nous sommes d&eacute;sol&eacute;s mais cette section de notre site est r&eacute;serv&eacute;e aux <i>Utilisateurs abonn&eacute;s seulement.</i>");
define("_MODULESGROUP","Nous sommes d&eacute;sol&eacute;s mais cette section de notre site est pour un <i>Groupe de Membres</i> du groupe suivant seulement.");
define("_SUBEXPIRED","Votre souscription est expir&eacute;e");
define("_HELLO","Bonjour");
define("_SUBSCRIPTIONAT","Ceci est un message automatique pour vous pr&eacute;venir que votre abonnement");
define("_HASEXPIRED","est expir&eacute; maintenant.");
define("_HOPESERVED","en esp&egrave;rant vous avoir donn&eacute; satisfaction...");
define("_SUBRENEW","Si vous voulez renouveler votre inscription rendez vous:");
define("_YOUARE","Vous &ecirc;tes");
define("_SUBSCRIBER","abonn&eacute;");
define("_OF","pour");
define("_SBYEARS","ann&eacute;es");
define("_SBYEAR","ann&eacute;e");
define("_SBMINUTES","minutes");
define("_SBHOURS","heures");
define("_SBSECONDS","secondes");
define("_SBDAYS","jours");
define("_SUBEXPIREIN","Votre abonnement expire dans:");
define("_NOTSUB","Vous n'&ecirc;tes pas abonn&eacute; &agrave;");
define("_NOTSUBUSR","Pas un abonn&eacute; de");
define("_SUBFROM","Vous pouvez souscrire");
define("_HERE","ici");
define("_NOW","maintenant!");
define("_ADMSUB","Utilisateur abonn&eacute;!");
define("_ADMNOTSUB","Utilisateur non abonn&eacute;");
define("_ADMSUBEXPIREIN","Votre abonnement expire dans:");
define("_LASTIP","Derni&egrave;re IP d'utilisateur:");
define("_LASTVISIT","Derni&egrave;re Visite:");
define("_LASTNA","N/A");
define("_BANTHIS","Bannir cette IP");
define("_ADMIN_BLOCK_DENIED", "Vous n'&ecirc;tes pas autoris&eacute; &agrave; voir ce bloc");
define("_NEWSLETTERBLOCKSUBSCRIBED", "Vous avez souscrit &agrave; la lettre d'infos");
define("_NEWSLETTERBLOCKREGISTER", "Vous devez vous enregistrer pour revoir la lettre d'infos");
define("_NEWSLETTERBLOCKREGISTERNOW", "Cliquez pour vous enregistrer");
define("_NEWSLETTERBLOCKNOTSUBSCRIBED", "Vous n'avez pas souscrit &agrave; la lettre d'infos");
define("_NEWSLETTERBLOCKSUBSCRIBE", "Cliquez pour Souscrire");
define("_NEWSLETTERBLOCKUNSUBSCRIBE", "Cliquez pour vous d&eacute;sinscrire");
define("_ANONYMOUS","Anonyme");
define("_MODULEERROR","Il y a une erreur de module");

define('_ILLEGAL_OP_OPERATION', 'Vous avez appel&eacute; une action ill&eacute;gale dans votre URL de ce site<br />Veuillez v&eacute;rifier ceci dans votre navigateur');
define('_PAGE_NOT_EXISTS', 'D&eacute;sol&eacute;, mais le page recherch&eacute; n\'est pas disponible');
define('_REFRESH_SCREEN', 'Rafra&icirc;chir l&#039&eacute;cran');

define('_AS_IS', 'Comme il est');
define('_OFFTOPIC', 'Topic ferm&eacute;');
define('_FLAMEBAIT', '?-Flame Bait-?');
define('_TROLL', '?-Troll-?');
define('_REDUNDANT', 'Redondant');
define('_INSIGHTFUL', 'Insightful');
define('_INTERESTING', 'Interesant');
define('_INFORMATIVE', 'Informatif');
define('_FUNNY', 'Sympa');
define('_OVERRATED', 'sur class&eacute;');
define('_UNDERRATED', 'Sous class&eacute;');
define('_EVO_HELPSYSTEM', 'Nuke Evolution Aide');
define('_OVERLIB_CLOSE', 'Fermer');

define('_GUESTS', 'Invit&eacute;s');
define('_GUEST', 'Invit&eacute;');
define('_BOTS', 'Recherche Robots');
define('_BOT', 'Recherche Robot');
define('_ABR_DAYS', 'D');
define('_ABR_MONTHS', 'M');
define('_ABR_YEARS', 'Y');
define('_ABR_MINUTES', 'Min');
define('_ABR_HOURS', 'H');
define('_ABR_SECONDS', 'Sec');

define("_ACTIVETOPICS","Sujet actif actuellement");

define('_MESSAGE', 'Message');
define('_EMAIL', 'E-mail');
define('_FROM', 'de');

// Modulenames to show in Who-is-Online
define('_MODULE_0',  'Index du forum');
define('_MODULE_-1', 'Connection au forum');
define('_MODULE_-2', 'Recherche');
define('_MODULE_-3', 'Register');
define('_MODULE_-4', 'Profil');
define('_MODULE_-6', 'Qui est en ligne du forum ?');
define('_MODULE_-7', 'Liste des membres');
define('_MODULE_-8', 'FAQ du forum');
define('_MODULE_-9', 'Forum Post&eacute;');
define('_MODULE_-10', 'Messages Priv&eacute;s');
define('_MODULE_-11', 'Groupes');
define('_MODULE_-1210', 'Attachments');
define('_MODULE_-1214', 'Board Rules');
define('_MODULE_-12', 'Staff');
define('_MODULE_-33', 'Sujet r&eacute;cent');
define('_MODULE_-34', 'Statistique du forum');
define('_MODULE_-35', 'Rang');
define('_MODULE_-50', 'Administration du forum');
define('_MODULE_-5000', 'Topics du forum');

?>