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


$faq[] = array("--","Fichiers joints");
$faq[] = array("Comment puis-je joindre un fichier ?", "Vous pouvez joindre des fichiers lorsque vous postez un nouveau message. Vous devriez apercevoir le formulaire <i>Joindre un fichier</i> en dessous du cadre principal de saisie du message. Lorsque vous cliquez sur le bouton <i>Parcourir...</i> la fen&ecirc;tre de dialogue standard de votre ordinateur s'ouvre. Recherchez le fichier que vous souhaitez joindre, s&eacute;lectionnez-le et cliquez sur OK, Ouvrir ou double-cliquez selon votre habitude et/ou la proc&eacute;dure correcte pour votre ordinateur. Si vous choisissez d'ajouter un commentaire dans le champ <i>Commentaire</i>, ce commentaire sera utilis&eacute; comme un lien pour le fichier joint. Si aucun commentaire n'est ajout&eacute;, le nom du fichier sera utilis&eacute; comme lien du fichier joint. Si le webmaster l'a autoris&eacute;, vous pourrez joindre plusieurs fichiers en suivant la m&ecirc;me proc&eacute;dure d&eacute;crite pr&eacute;c&eacute;demment jusqu'&agrave; ce que vous atteignez le nombre maximum de fichiers joints autoris&eacute; pour chaque message.<br/><br/>Le webmaster d&eacute;fini une limite sup&eacute;rieure pour la taille du fichier, d&eacute;fini les extensions et diverses choses pour les fichiers joints sur le forum. Vous &ecirc;tes pr&eacute;venu qu'il est de votre responsabilit&eacute; que vos fichiers joints respectent et soient en accord avec la politique du site, et qu'ils peuvent &ecirc;tre supprim&eacute;s sans aucun pr&eacute;avis.<br/><br/>Veuillez noter que le propri&eacute;taire, le webmaster ou les mod&eacute;rateurs ne peuvent et ne pourront &ecirc;tre tenu comme responsable pour toutes pertes de donn&eacute;es.");

$faq[] = array("Comment puis-je joindre un fichier apr&egrave;s avoir post&eacute; un premier message ?", "Pour joindre un fichier apr&egrave;s avoir poster un premier message, vous avez besoin d'&eacute;diter votre message et devez suivre la description pr&eacute;c&eacute;dente. Le nouveau fichier sera joint lorsque vous cliquerez sur <i>Envoyer</i> pour valider le message &eacute;dit&eacute;.");

$faq[] = array("Comment puis-je supprimer un fichier joint ?", "Pour supprimer des fichiers joints, vous avez besoin d'&eacute;diter votre message et devez cliquer sur <i>Supprimer le fichier joint</i>, &agrave; c&ocirc;t&eacute; du fichier joint que vous souhaitez supprimer dans la bo&icirc;te des <i>Fichiers envoy&eacute;s</i>. Le fichier joint sera supprim&eacute; lorsque vous cliquerez sur <i>Envoyer</i> pour valider le message &eacute;dit&eacute;.");

$faq[] = array("Comment puis-je mettre &agrave; jour le commentaire d'un fichier ?", "Pour mettre &agrave; jour le commentaire d'un fichier, vous avez besoin d'&eacute;diter votre message, &eacute;ditez le texte dans le champ <i>Commentaire</i> et cliquez sur le bouton <i>Mettre &agrave; jour le commentaire</i>, &agrave; c&ocirc;t&eacute; du commentaire du fichier que vous souhaitez mettre &agrave; jour dans la bo&icirc;te des <i>Fichiers envoy&eacute;s</i>. Le commentaire du fichier sera mis &agrave; jour lorsque vous cliquerez sur <i>Envoyer</i> pour valider le message &eacute;dit&eacute;.");

$faq[] = array("Pourquoi mon fichier joint n'est-il pas visible dans le message ?", "Le plus probable est que le fichier ou l'extension n'est plus autoris&eacute; sur le forum, ou qu'un mod&eacute;rateur ou le webmaster l'a supprim&eacute; car il &eacute;tait en conflit avec la politique du site.");

$faq[] = array("Pourquoi ne puis-je pas joindre des fichiers joints ?", "Sur certains forums, joindre des fichiers peut-&ecirc;tre limit&eacute; &agrave; certains utilisateurs ou groupes. Pour joindre des fichiers, vous pouvez avoir besoin d'une autorisation sp&eacute;ciale, seul le mod&eacute;rateur du forum et le webmaster peuvent accorder cet acc&egrave;s, vous devriez les contacter.");

$faq[] = array("Je poss&eacute;de les permissions n&eacute;cessaires, pourquoi ne puis-je pas joindre des fichiers ?", "Le webmaster d&eacute;fini une limite sup&eacute;rieure pour la taille du fichier, d&eacute;fini les extensions et diverses choses pour les fichiers joints sur le forum. Un mod&eacute;rateur ou le webmaster peut avoir modifi&eacute; vos permissions, ou d&eacute;sactiv&eacute; les fichiers joints dans un forum sp&eacute;cifique. Vous devriez obtenir une explication avec le message d'erreur en essayant de joindre un fichier, sinon vous pouvez toujours contacter le mod&eacute;rateur ou le webmaster.");

$faq[] = array("Pourquoi ne puis-je pas supprimer des fichiers joints ?", "Sur certains forums, la suppression des fichiers joints peut-&ecirc;tre limit&eacute;e &agrave; certains utilisateurs ou groupes. Pour supprimer des fichiers joints, vous pouvez avoir besoin d'une autorisation sp&eacute;ciale, seul le mod&eacute;rateur du forum et le webmaster peuvent accorder cet acc&egrave;s, vous devriez les contacter.");

$faq[] = array("Pourquoi ne puis-je pas voir/t&eacute;l&eacute;charger des fichiers joints ?", "Sur certains forums, voir/t&eacute;l&eacute;charger des fichiers peut-&ecirc;tre limit&eacute; &agrave; certains utilisateurs ou groupes. Pour voir/t&eacute;l&eacute;charger des fichiers joints, vous pouvez avoir besoin d'une autorisation sp&eacute;ciale, seul le mod&eacute;rateur du forum et le webmaster peuvent accorder cet acc&egrave;s, vous devriez les contacter.");

$faq[] = array("Qui dois-je contacter en cas de fichiers joints ill&eacute;gaux ou susceptibles d'&ecirc;tre ill&eacute;gaux ?", "Vous devriez contacter le webmaster. Si vous n'arrivez pas &agrave; le contacter, vous devriez d'abord contacter un des mod&eacute;rateurs du forum et leur demander avec qui vous devriez prendre contact. Si vous ne recevez toujours pas de r&eacute;ponses, vous devriez contacter le propri&eacute;taire du domaine (fa&icirc;tes une recherche avec un \"whois\") ou, si ce forum fonctionne sur un h&eacute;bergeur gratuit (par exemple: yahoo, free.fr, f2s.com, etc.), la direction ou le service des abus de l'h&eacute;bergeur. Veuillez noter que le Groupe phpBB n'a absolument aucun contr&ocirc;le et ne peut en aucun cas &ecirc;tre tenu pour responsable en ce qui concerne la mani&egrave;re, le lieu ou par qui ce site est utilis&eacute;. Il est totalement inutile de prendre contact avec le Groupe phpBB pour tout ce qui ne concerne pas l'aspect l&eacute;gal (cessation et d&eacute;sistement, responsabilit&eacute;, commentaire diffamatoire, etc.) en relation directe avec le site web phpbb.com ou s'apparentant au programme de phpBB lui-m&ecirc;me. Si vous envoyez un e-mail au Groupe phpBB concernant une utilisation non conforme de ce programme par une tiers personne, alors vous devriez vous attendre &agrave; une r&eacute;ponse laconique, voire m&ecirc;me &agrave; aucune r&eacute;ponse.");

?>