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
 
$faq[] = array("--","Connexion et Enregistrement");  
$faq[] = array("Pourquoi ne puis-je pas me connecter ?", "Vous &ecirc;tes-vous enregistr&eacute; ? Plus s&eacute;rieusement, vous devez vous enregistrer afin de vous connecter. Avez-vous &eacute;t&eacute; banni du forum (un message est affich&eacute; si vous l'&ecirc;tes) ? Si oui, vous devriez contacter le webmestre ou l'administrateur du forum pour en d&eacute;couvrir la raison. Si vous vous &ecirc;tes enregistr&eacute; et que vous n'&ecirc;tes pas banni et que vous ne pouvez toujours pas vous connecter, v&eacute;rifiez et rev&eacute;rifiez vos nom d'utilisateur et mot de passe. C'est g&eacute;n&eacute;ralement de l&agrave; que vient le probl&egrave;me, si cela ne fonctionne toujours pas, contactez l'administrateur du forum, il se peut que le forum ait &eacute;t&eacute; mal configur&eacute;.");
$faq[] = array("Pourquoi n'ai-je pas besoin de m'enregistrer ?", "Vous pouvez ne pas en avoir besoin, c'est &agrave; l'administrateur de d&eacute;cider si vous avez besoin ou non de vous enregistrer pour poster des messages sur certains forums. Toutefois, l'enregistrement vous donnera acc&egrave;s &agrave; des fonctions additionnelles non-disponibles pour les invit&eacute;s tels que le choix d'une image avatar, une messagerie priv&eacute;e, l'envoi d'e-mail &agrave; des amis, l'inscription &agrave; un groupe d'utilisateurs, etc. L'enregistrement prend seulement quelques instants, il est donc recommand&eacute; de le faire.");
$faq[] = array("Pourquoi suis-je d&eacute;connect&eacute; automatiquement ?", "Si vous ne cochez pas la case <i>Se connecter automatiquement &agrave; chaque visite</i> lorsque vous vous connectez, le forum vous gardera seulement connect&eacute; pour une p&eacute;riode pr&eacute;&eacute;tablie. Ceci permet d'&eacute;viter une utilisation abusive de votre compte par quelqu'un d'autre. Pour rester connect&eacute;, cochez la case en vous connectant, ceci n'est pas recommand&eacute; si vous acc&eacute;dez au forum en utilisant un ordinateur partag&eacute;, ex : biblioth&egrave;que, cybercaf&eacute;, universit&eacute;, etc.");
$faq[] = array("Comment puis-je &eacute;viter que mon nom d'utilisateur apparaisse dans la liste des utilisateurs en ligne ?", "Dans votre profil, vous trouverez une option <i>Cacher sa pr&eacute;sence en ligne</i>, si vous choisissez <i>Oui</i>, vous n'appara&icirc;trez qu'uniquement aux yeux des administrateurs ou vous-m&ecirc;me. Vous serez compt&eacute; comme un utilisateur invisible.");
$faq[] = array("J'ai perdu mon mot de passe !", "Ne paniquez pas ! Si votre mot de passe ne peut &ecirc;tre retrouv&eacute;, il peut par contre &ecirc;tre r&eacute;initialis&eacute;. Pour ce faire, aller sur la page de connexion et cliquez sur <u>J'ai oubli&eacute; mon mot de passe</u>, puis suivez les instructions et vous devriez pouvoir vous reconnecter en un rien de temps.");
$faq[] = array("Je me suis inscrit mais ne peux pas me connecter !", "Premi&egrave;rement, v&eacute;rifiez que vous avez entr&eacute; correctement vos nom d'utilisateur et mot de passe. S'ils ont correctement &eacute;t&eacute; entr&eacute;s, alors il y a deux possibilit&eacute;s. Si le support COPPA est activ&eacute; et que vous avez cliqu&eacute; sur le lien <u>J'ai moins de 13 ans</u> au moment de l'enregistrement, alors vous devrez suivre les instructions que vous avez re�ues. Si ce n'est pas le cas, alors peut-&ecirc;tre que votre compte a besoin d'&ecirc;tre activ&eacute; ? Certains forums requi&egrave;rent que tous les nouveaux enregistrements soient activ&eacute;s, soit par vous-m&ecirc;me, soit par l'administrateur avant de pouvoir vous connecter. Lorsque vous vous &ecirc;tes enregistr&eacute;, un message aurait d&ucirc; vous apprendre si l'activation est requise ou non. Si vous avez re�u un e-mail, suivez alors les instructions qui s'y trouvent, si vous ne l'avez pas re�u, alors &ecirc;tes-vous bien s&ucirc;r que l'adresse e-mail que vous avez fournie lors de l'enregistrement est valide ? L'une des raisons pour lesquelles l'activation est utilis&eacute;e, c'est de r&eacute;duire les chances de voir des utilisateurs malintentionn&eacute;s abuser du forum anonymement. Si vous &ecirc;tes s&ucirc;r que l'adresse e-mail que vous avez fournie est valide, essayez alors de contacter l'administrateur du forum.");
$faq[] = array("Je me suis enregistr&eacute; dans le pass&eacute;, mais ne peux plus me connecter ?!", "Les raisons les plus probables pour ce probl&egrave;me sont : vous avez entr&eacute; un nom d'utilisateur ou mot de passe incorrect (v&eacute;rifiez l'e-mail qui vous a &eacute;t&eacute; envoy&eacute; lorsque vous vous &ecirc;tes enregistr&eacute;) ou l'administrateur a supprim&eacute; votre compte pour quelque raison. Si vous vous trouvez dans le dernier cas, peut-&ecirc;tre alors que vous n'avez rien post&eacute; ? Il est habituel pour les forums de supprimer p&eacute;riodiquement les comptes des utilisateurs n'ayant rien post&eacute; afin de r&eacute;duire la taille de la base de donn&eacute;es. Essayez de vous enregistrer encore et impliquez-vous dans les discussions.");
$faq[] = array("--","Pr&eacute;f&eacute;rences et param&egrave;tres des Utilisateurs");
$faq[] = array("Comment puis-je changer mes pr&eacute;f&eacute;rences ?", "Toutes vos pr&eacute;f&eacute;rences (si vous &ecirc;tes enregistr&eacute;s) sont stock&eacute;es dans la base de donn&eacute;es. Pour les modifier, cliquez sur le lien <u>Profil</u> (g&eacute;n&eacute;ralement en haut des pages, mais cela peut ne pas &ecirc;tre le cas). Ceci vous permettra de changer toutes vos pr&eacute;f&eacute;rences.");
$faq[] = array("Les heures ne sont pas correctes !", "Les heures sont certainement correctes, toutefois, ce que vous pouvez voir sont les heures affich&eacute;es dans un fuseau horaire diff&eacute;rent du votre. Si c'est le cas, vous devriez changer vos pr&eacute;f&eacute;rences dans votre profil en choisissant le fuseau horaire qui vous convient, ex : Londres, Paris, New York, Sydney, etc. Veuillez noter que changer le fuseau horaire, comme la plupart des autres options peut uniquement &ecirc;tre effectu&eacute; par les utilisateurs enregistr&eacute;s. Donc, si vous n'&ecirc;tes pas enregistr&eacute;, c'est la bonne heure pour le faire, si vous pardonnez le jeu de mots !");
$faq[] = array("J'ai chang&eacute; le fuseau horaire et l'heure est toujours incorrecte !", "Si vous &ecirc;tes s&ucirc;r d'avoir choisi le bon fuseau horaire et que l'heure est toujours diff&eacute;rente, la r&eacute;ponse la plus probable est le passage &agrave; l'heure d'&eacute;t&eacute;. le forum n'a pas &eacute;t&eacute; con�u pour g&eacute;rer le changement entre l'heure d'hiver et l'heure d'&eacute;t&eacute;, donc durant l'&eacute;t&eacute;, l'heure sera d&eacute;cal&eacute;e d'une heure par rapport &agrave; l'heure locale r&eacute;elle.");
$faq[] = array("Ma langue n'est pas dans la liste !", "Les raisons les plus probables pour ceci sont que soit l'administrateur n'a pas install&eacute; votre langage sur le forum, ou que soit quelqu'un n'a pas encore traduit ce forum dans votre langue. Essayez de demander &agrave; l'administrateur du forum s'il peut installer le pack de langue dont vous avez besoin, s'il n'existe pas sentez-vous alors libre de cr&eacute;er une nouvelle traduction. Plus d'informations peuvent &ecirc;tre trouv&eacute;es sur le site web du groupe phpBB (allez voir le lien en bas des pages).");
$faq[] = array("Comment puis-je montrer une image en-dessous de mon nom d'utilisateur ?", "Il peut y avoir deux images sous votre nom d'utilisateur lorsque vous lisez des messages. La premi&egrave;re est l'image associ&eacute;e avec votre rang, g&eacute;n&eacute;rallement elles prennent la forme d'&eacute;toiles ou de blocs indiquant combien de messages vous avez fait ou votre statut sur le forum. En-dessous de celle-ci peut se trouver une image plus grande nomm&eacute;e avatar, qui est g&eacute;n&eacute;ralement unique ou personnelle &agrave; chaque utilisateur. C'est &agrave; l'administrateur du forum d'activer les avatars et de choisir la mani&egrave;re dont les avatars seront disponibles. Si vous ne pouvez pas utilisez un avatar, cela voudra alors dire que l'administrateur en a d&eacute;cid&eacute; ainsi, vous pouvez le contacter pour lui en demander les raisons (nous sommes s&ucirc;r qu'elles seront bonnes !).");
$faq[] = array("Comment puis-je changer mon rang ?", "En g&eacute;n&eacute;ral, vous ne pouvez pas directement changer le titre d'un rang (le titre d'un rang appara&icirc;t sous votre nom d'utilisateur dans les sujets de discussions et dans votre profil selon le th&egrave;me utilis&eacute;). La plupart des forums utilisent les rangs pour indiquer le nombre de messages que vous avez post&eacute;s, mais aussi pour identifier certains utilisateurs, ex: les mod&eacute;rateurs et administrateurs peuvent avoir un rang sp&eacute;cifique qui leur est propre. Veuillez ne pas poster inutilement sur le forum dans le but d'&eacute;lever son rang, vous trouverez probablement un mod&eacute;rateur ou administrateur qui vous abaissera simplement le compte de votre nombre total de messages.");
$faq[] = array("Lorsque je clique sur le lien e-mail d'un utilisateur, on me demande de me connecter !", "D&eacute;sol&eacute;, mais seuls les utilisateurs enregistr&eacute;s peuvent envoyer des e-mails &agrave; des gens via le formulaire d'e-mail int&eacute;gr&eacute; au forum (dans le cas o&ugrave; l'administrateur aurait activ&eacute; cette fonctionnalit&eacute;). Ceci, pour &eacute;viter l'utilisation malveillante du syst&egrave;me d'e-mail par des utilisateurs anonymes.");
$faq[] = array("--","Publication");
$faq[] = array("Comment puis-je poster un sujet dans un forum ?", "Facile, cliquez sur le bouton appropri&eacute; soit sur la page du forum, soit sur la page du sujet. Vous pourriez avoir besoin de vous enregistrer avant de pouvoir poster un message, les droits qui vous sont disponibles sont list&eacute;s sur le bas de la page du forum ou du sujet (la liste <i>Vous pouvez poster de nouveaux sujets, vous pouvez voter, etc.</i>)");
$faq[] = array("Comment puis-je &eacute;diter ou supprimer un message ?", "A moins que vous soyez l'administrateur ou mod&eacute;rateur du forum, vous pouvez seulement &eacute;diter ou supprimer vos propres messages. Vous pouvez &eacute;diter un message (parfois seulement apr&egrave;s un certain temps apr&egrave;s qu'il soit post&eacute;) en cliquant sur le bouton <i>Editer</i> du message concern&eacute;. Si quelqu'un a d&eacute;j&agrave; r&eacute;pondu &agrave; votre message, vous trouverez un petit morceau de texte en dessous de votre message en retournant le lire, indiquant le nombre de fois que vous l'avez &eacute;dit&eacute;. Ce petit texte n'appara&icirc;tra pas si personne n'a r&eacute;pondu, il n'appara&icirc;tra pas non plus si un mod&eacute;rateur ou un administrateur &eacute;dite le message (ils devraient laisser un message expliquant ce qu'ils ont modifi&eacute; et pourquoi). Veuillez noter qu'un utilisateur ne peut pas supprimer un message une fois que quelqu'un y a r&eacute;pondu.");
$faq[] = array("Comment puis-je ajouter une signature &agrave; mon message ?", "Pour ajouter une signature &agrave; un message, vous devez d'abord en cr&eacute;er une, en allant dans votre profil. Une fois cr&eacute;&eacute;e, vous pouvez cocher la case <i>Attacher sa signature</i> lors de la composition d'un message pour ajouter votre signature. Vous pouvez aussi ajouter votre signature &agrave; tous vos messages en cochant la case appropri&eacute;e dans votre profil (vous pourrez toujours emp&ecirc;cher d'attacher votre signature &agrave; un message en particulier en d&eacute;cochant la case Attacher sa signature lors de sa composition).");
$faq[] = array("Comment puis-je cr&eacute;er un sondage ?", "Cr&eacute;er un sondage est facile, lorsque vous postez un nouveau sujet (ou &eacute;ditez le premier message d'un sujet, si vous en avez le droit) vous devriez apercevoir une partie <i>Ajouter un sondage</i> dans le formulaire en dessous de la partie <i>Poster un nouveau sujet</i> (si vous ne le voyez pas, c'est que vous n'avez probablement pas le droit de cr&eacute;er des sondages). Vous devez entrer un titre pour le sondage et au moins deux options (pour d&eacute;finir une option, entrez son nom dans le champs appropri&eacute;e puis cliquez sur le bouton <i>Ajouter l'option</i>. Vous pouvez &eacute;galement d&eacute;finir une date limite pour le sondage, 0 est un sondage infini. Il y a une limite pour le nombre d'options que vous pourrez &eacute;tablir, cette limite est fix&eacute;e par l'administrateur du forum).");
$faq[] = array("Comment puis-je &eacute;diter ou supprimer un sondage ?", "Comme pour les messages, les sondages peuvent uniquement &ecirc;tre &eacute;dit&eacute;s par le posteur d'origine, un mod&eacute;rateur ou un administrateur. Pour &eacute;diter un sondage, cliquez sur le bouton 'Editer' du premier message du sujet (il a toujours le sondage associ&eacute; avec lui). Si personne n'a encore vot&eacute;, vous pouvez alors supprimer le sondage ou &eacute;diter n'importe quelle option du sondage, par contre, si une personne a d&eacute;j&agrave; vot&eacute;, seuls les mod&eacute;rateurs et administrateurs pourront l'&eacute;diter ou le supprimer. Ceci pour &eacute;viter aux gens de truquer les sondages en modifiant les options au milieu de la dur&eacute;e du sondage.");
$faq[] = array("Pourquoi ne puis-je pas acc&eacute;der &agrave; un forum ?", "Certains forums peuvent limiter l'acc&egrave;s &agrave; certains utilisateurs ou groupes. Pour voir, lire, poster, etc. vous devez avoir une autorisation sp&eacute;ciale, seul le mod&eacute;rateur et l'administrateur du forum peuvent accorder cet acc&egrave;s, vous pouvez les contacter si vous le voulez.");
$faq[] = array("Pourquoi ne puis-je pas voter dans un sondage ?", "Seuls les utilisateurs enregistr&eacute;s peuvent voter dans un sondage (afin d'&eacute;viter le trucage des r&eacute;sultats). Si vous vous &ecirc;tes enregistr&eacute;s et que vous ne pouvez toujours pas voter, alors vous n'avez probablement pas les droits d'acc&egrave;s appropri&eacute;s.");
$faq[] = array("--","Mise en forme et Types de Sujets");
$faq[] = array("Qu'est-ce que le BBCode ?", "Le BBCode est une impl&eacute;mentation sp&eacute;ciale du HTML, l'activation de l'utilisation du BBCode est d&eacute;termin&eacute;e par l'administrateur (vous pouvez aussi le d&eacute;sactiver sur un message en particulier lors de sa composition). Le BBCode en lui-m&ecirc;me est similaire au styile du HTML, les balises sont contenues dans des crochets [ et ] &agrave; la place de &lt; et &gt;, et offrent un meilleur contr&ocirc;le sur la mani&egrave;re dont quelque chose doit &ecirc;tre affich&eacute;e. Pour plus d'informations sur le BBCode, allez voir le guide, accessible depuis le formulaire de publication.");
$faq[] = array("Puis-je utiliser le HTML?", "Ceci d&eacute;pend de l'administrateur qui le permet ou non, il a un contr&ocirc;le complet dessus. Si vous &ecirc;tes autoris&eacute;s &agrave; l'utiliser, vous vous rendrez certainement comptes que seulement certaines balises fonctionnent. C'est une mesure de <i>s&eacute;curit&eacute;</i> pour &eacute;viter aux gens d'abuser du forum en utilisant certaines balises qui pourraient d&eacute;truire la mise en page ou causer d'autres probl&egrave;mes. Si le HTML est activ&eacute;, vous pouvez le d&eacute;sactiver dans un message en particulier lors de sa composition.");
$faq[] = array("Que sont les Smilies ?", "Les Smileys, ou Emoticons sont de petites images qui sont utilis&eacute;es pour exprimer certains sentiments en utilisant un petit code, ex: :) signifie joyeux, :( signifie triste. Vous pouvez voir la liste compl&egrave;te des emoticons lors de la composition d'un message. Essayez de ne pas utiliser abusivement ces smileys, car ils peuvent vite rendre un message illisible et un mod&eacute;rateur pourrait d&eacute;cider de l'&eacute;diter voire m&ecirc;me de le supprimer enti&egrave;rement.");
$faq[] = array("Puis-je poster des Images?", "Vous pouvez montrer des images &agrave; l'int&eacute;rieur de vos messages. Toutefois, il n'y a actuellement pas de moyen pour envoyer directement vos images sur ce forum. Vous devez donc cr&eacute;er un lien vers votre image stock&eacute;e sur un serveur web public, ex: http://www.quelque-part.net/mon-image.gif. Vous ne pouvez pas cr&eacute;er un lien vers une image stock&eacute;e sur votre ordinateur (&agrave; moins que celui-ci soit un serveur web public), ni une image stock&eacute;e sur un serveur n&eacute;cessitant une authentification, ex: les bo&icirc;tes e-mail Hotmail ou Yahoo, les sites prot&eacute;g&eacute;s par mot de passe, etc. Pour afficher une image, vous pouvez soit utiliser la balise BBCode [img] ou soit la balise HTML appropri&eacute;e (si vous y &ecirc;tes autoris&eacute;s).");
$faq[] = array("Que sont les Annonces ?", "Les Annonces contiennent le plus souvent d'importantes informations, vous devriez donc les lire d&egrave;s que possible. Les Annonces appara&icirc;ssent en haut de chaque page du forum dans lequel elle ont &eacute;t&eacute; post&eacute;es. Pouvoir poster une annonce d&eacute;pend des permissions requises, ces permissions sont d&eacute;finies par l'administrateur.");
$faq[] = array("Que sont les Post-it ?", "Les Post-it appara&icirc;ssent en-dessous des annonces et seulement sur la premi&egrave;re page du forum. Ils sont souvent assez importants, vous devriez donc les lire d&egrave;s que vous pouvez. Comme pour les annonces, c'est l'administrateur qui d&eacute;termine les permissions requises pour poster des Post-it dans chaque forum.");
$faq[] = array("Que sont les Sujets de discussions verrouill&eacute;s ?", "Les Sujets verrouill&eacute;s sont verrouill&eacute;s, soit par le mod&eacute;rateur du forum ou soit par l'administrateur. Vous ne pouvez pas r&eacute;pondre aux sujets de discussions verrouill&eacute;s et les sondages qui y sont contenus sont cessent automatiquement. Les sujets de discussions peuvent &ecirc;tre verrouill&eacute;s pour de maintes raisons.");
$faq[] = array("--","Niveaux des Utilisateurs et Groupes");
$faq[] = array("Qui sont les Administrateurs ?", "Les Administrateurs sont des personnes qui poss&egrave;dent le plus haut niveau de contr&ocirc;le sur tout le forum. Ces personnes peuvent contr&ocirc;ler toutes les facettes du forum, ceci inclut le r&eacute;glage des permissions, le bannissement d'utilisateurs, la cr&eacute;ation de groupes d'utilisateurs ou de mod&eacute;rateurs, etc. Ils ont &eacute;galement tous les pouvoirs de mod&eacute;rations sur tous les forums.");
$faq[] = array("Qui sont les Mod&eacute;rateurs?", "Les Mod&eacute;rateurs sont des personnes (ou groupes de personnes) dont le but est de veiller au respect du r&egrave;glement et au bon fonctionnement du forum tous les jours. Ils ont le pouvoir d'&eacute;diter ou de supprimer les messages et de verrouiller, d&eacute;verrouiller, supprimer et diviser les sujets de discussions dans le forum o&ugrave; ils mod&egrave;rent. G&eacute;n&eacute;rallement, les mod&eacute;rateurs sont l&agrave; pour &eacute;viter aux gens de faire du <i>hors-sujet</i> ou de poster des messages ne respectant pas le r&egrave;glement.");
$faq[] = array("Que sont les groupes d'utilisateurs ?", "Les groupes d'utilisateurs est une mani&egrave;re pour l'administrateur de regrouper des utilisateurs. Chaque utilisateur peut appartenir &agrave; plusieurs groupes (ceci diff&egrave;re de la plupart des autres forums) et chaque groupe peut se voir assign&eacute;s des droits d'acc&egrave;s. Ceci permet &agrave; l'administrateur de g&eacute;rer ais&eacute;ment diff&eacute;rents mod&eacute;rateurs d'un forum, ou de donner leur donner acc&egrave;s &agrave; un forum priv&eacute;, etc.");
$faq[] = array("Comment puis-je joindre un groupe d'utilisateurs ?", "Pour joindre un groupe d'utilisateurs, cliquez sur le lien <i>Groupes d'utilisateurs</i> en haut de la page (peut changer suivant le mod&egrave;le de document), vous pourrez alors voir tous les groupes d'utilisateurs. Tous les groupes ne sont pas <i>ouverts</i>, certains sont <i>ferm&eacute;s</i> et d'autres peuvent avoir leurs effectifs invisibles. Si le groupe est ouvert, vous pouvez demander &agrave; le rejoindre en cliquant sur le bouton appropri&eacute;. Le mod&eacute;rateur du groupe d'utilisateurs devra approuver votre demande, il pourrait vous demander les raisons qui vous poussent &agrave; joindre le groupe. Veuillez ne pas harceler un mod&eacute;rateur de groupe s'il d&eacute;sapprouvre votre demande, il a ses raisons.");
$faq[] = array("Comment puis-je devenir le mod&eacute;rateur d'un groupe d'utilisateurs ?", "Les groupes d'utilisateurs sont initiallement cr&eacute;&eacute;s par l'administrateur, il y assigne &eacute;galement un mod&eacute;rateur. Si vous &ecirc;tes int&eacute;ress&eacute; par la cr&eacute;ation d'un groupe d'utilisateurs, la premi&egrave;re chose &agrave; faire sera de contacter l'administrateur, essayez de lui laisser un message priv&eacute;.");

$faq[] = array("--","Imprimer-Voir un sujet sympathique");
$faq[] = array("What is the :| |: bouton pour? - Annulation de la pagination du tableau", "By clicking on this button you can locally remove the board's fixed pagination for the current topic to help your web browser do the proper pagination for printing based on actual line spacing, rather than the forum-wide limit for number of messages per page.");
$faq[] = array("What are the boxes on top of the printable output? - Range selection", "There are two boxes on top of the page and a tape-recorder-like button Show. They allow to select a range of messages. Note that every message in the printable view has a number. Use those numbers to fill out the boxes on top to set up the first and the last message you want to be printed, and press the Show button to rearrange the messages. Another way to set a range is to put a negative number in the second box, which will mean that you want -n of messages to be printed. For example, 4 7 will output messages 4, 5, 6, 7. However if you enter values 4 -7 in first and second box respectively, messages 4, 5, 6, 7, 8, 9, 10 will be shown after you press the rewind button.");
$faq[] = array("How to print only one message? - Advanced range selection", "First, go to the printable view of the topic by pressing the Printer button in the topic view. Find your message and note the number in the left of it. Type that number into the first box in the top left of the printable view. In the second box put value -1 and press the Show button. This will tell the database to output only one message starting from the given one. Another way of getting this result is by putting the same number in both boxes. Let's say you want to print only the message number 16. Fill out the boxes in the top as such: 16 -1 and press the go button Show. Instead of 16 and -1 you could as well enter 16 and 16. The result will be the same. This example will work only if there are at least sixteen messages in the current topic, of course.");
$faq[] = array("More questions?", "Detailed documentation and support forums are <a href=\"http://wiking.sourceforge.net/phpBB2/wakka.php?wakka=PrinterFriendlyTopicView\">here</a>");

$faq[] = array("--","Messagerie Priv&eacute;e");
$faq[] = array("Je ne peux pas envoyer de messages priv&eacute;s !", "Il y trois raisons pour cela : vous n'&ecirc;tes pas enregistr&eacute;s et/ou n'&ecirc;tes pas connect&eacute;, l'administrateur a d&eacute;sactiv&eacute; la messagerie priv&eacute;e pour la totalit&eacute; du forum ou l'administrateur vous emp&ecirc;che d'envoyer des messages priv&eacute;s. Si vous &ecirc;tes dans le dernier cas, vous devriez vous adresser &agrave; l'administrateur pour en conna&icirc;tre la raison.");
$faq[] = array("Je continue de recevoir des messages priv&eacute;s non-d&eacute;sir&eacute;s !", "Dans le futur nous ajouterons une liste noire au syst&egrave;me de messagerie priv&eacute;e. Pour le moment, si malgr&eacute; tout, vous continuez &agrave; recevoir des messages non-d&eacute;sir&eacute;s, informez-en l'administrateur, il a le pouvoir d'emp&ecirc;cher compl&egrave;tement un utilisateur d'envoyer des messages priv&eacute;s.");
$faq[] = array("J'ai re�u un e-mail abusif ou de spamming de quelqu'un sur ce forum !", "Nous sommes pein&eacute;s d'apprendre cela. La fonction d'e-mail int&eacute;gr&eacute; au forum inclut des sauvegardes pour essayer de traquer les utilisateurs qui envoient des messages de ce type. Vous devriez envoyer un e-mail &agrave; l'administrateur avec une copie compl&egrave;te de l'e-mail que vous avez re�u, il est important &agrave; ce que cette copie contienne les en-t&ecirc;tes (ceux-ci fournissent une liste de d&eacute;tails concernant l'exp&eacute;diteur). Ensuite alors, l'administrateur pourra prendre les mesures r&eacute;pr&eacute;ssives qui s'imposeront.");

//
// These entries should remain in all languages and for all modifications
//
$faq[] = array("--","phpBB 2");
$faq[] = array("Qui a &eacute;crit ce forum ?", "Ce logiciel (sous sa forme non-modifi&eacute;e) est produit, distribu&eacute; et est sous droits d'auteurs par le <a href=\"http://www.phpbb.com/\" target=\"_blank\">Groupe phpBB</a>. Il est disponible sous la license g&eacute;n&eacute;rale publique GNU et peut &ecirc;tre distribu&eacute; librement, cliquez sur le lien pour plus de d&eacute;tails.");
$faq[] = array("Pourquoi la fonction X n'est pas disponible ?", "Ce programme a &eacute;t&eacute; &eacute;crit et est sous license du Groupe phpBB. Si vous croyez qu'une fonction doit &ecirc;tre ajout&eacute;e, veuillez visiter le site web phpbb.com et voir ce que le groupe phpBB en pense. Veuillez ne pas poster de demande de fonctions sur le forum de phpbb.com, le Groupe utilise sourceforge pour s'occuper des nouvelles fonctionnalit&eacute;s.");
$faq[] = array("Qui dois-je contacter &agrave; propos des questions d'abus ou de l&eacute;galit&eacute; relatif &agrave; ce forum ?", "Vous devriez contacter l'administrateur de ce forum. Si vous n'arrivez pas &agrave; le contacter, vous devriez d'abord contacter l'un des mod&eacute;rateurs du forum et leur demander avec qui vous devriez prendre contact. Si vous ne recevez toujours pas de r&eacute;ponses, vous devriez contacter le propri&eacute;taire du domaine (faite une recherche avec whois) ou, si ce forum fonctionne sur un h&eacute;bergeur gratuit (ex : yahoo, free.fr, f2s.com, etc.), la direction ou le service des abus de l'h&eacute;bergeur. Veuillez noter que le Groupe phpBB n'a absolument aucun contr&ocirc;le et ne peut pas en aucun cas &ecirc;tre li&eacute; &agrave; la mani&egrave;re, au lieu ou &agrave; la personne qui utilise ce forum. Cela ne sert asbolument &agrave; rien de contacter le Groupe phpBB pour une question de l&eacute;galit&eacute; (diffamation, etc.) n'ayant pas un rapport direct avec le site web phpbb.com ou le discret programme qu'est phpBB lui-m&ecirc;me. Si vous faites un e-mail &agrave; l'intention du Groupe phpBB &agrave; propos de tiers personne de l'usage de ce programme, alors vous devriez vous attendre &agrave; une tiers-r&eacute;ponse ou pas de r&eacute;ponse du tout.");

//
// This ends the FAQ entries
//

?>