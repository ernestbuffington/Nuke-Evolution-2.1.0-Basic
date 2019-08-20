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

$faq[] = array("--", "Beitr&auml;ge");
$faq[] = array("Bitte lies die folgenden Richtlinien f&uuml;r Forenbeitr&auml;ge", "[b]1.[/b] Bevor du einen Beitrag verfasst, benutze die Suchfunktion. Gib deine Suchbegriffe m&ouml;glichst genau ein.
<br />
<br /> 
<br />
<br />[b]2.[/b] Beim Verfassen von Beitr&auml;gen, benutze [b]KEINE[/b] Titel wie:
<br />
<br />[list]
<br />
<br />[*] HELFT MIR BITTE! 
<br />
<br />[*] ICH BRAUCHE HILFE! 
<br />
<br />[*] Ich habe eine Frage. 
<br />
<br />[*] GROSSES Problem! 
<br />
<br />[*] Anf&auml;nger braucht Hilfe! 
<br />
<br />[*] Probleme 
<br />
<br />[*] DRINGEND! 
<br />
<br />[*] BITTE UM HILFE.[/list]
<br />
<br />[b]oder IRGENDETWAS dergleichen!!! 
<br />
<br />[/b]
<br />
<br />
<br />
<br />[b]SEI GENAU[/b] in der Auswahl des Titels f&uuml;r deinen Beitrag. Es hilft uns Dir besser zu helfen. 
<br />
<br />[b]Wenn du einen allgemeinen oder ungenauen Titel f&uuml;r deinen Beitrag verwendest, K&Ouml;NNTE er gel&ouml;scht werden.[/b] 
<br />
<br />
<br />
<br />[b]3.[/b] Hilf uns, Dir zu helfen. Wenn du einen Beitrag schreibst, liefere soviel Informationen wie m&ouml;glich. 
<br />
<br />[list]
<br />
<br />[*] Setup 
<br />
<br />[*] Softwareversionen 
<br />
<br />[*] Exaktes Problem 
<br />
<br />[*] Schildere dein Problem so detailliert wie m&ouml;glich 
<br />
<br />[/list]
<br />
<br />
<br />
<br />[b]4.[/b] Einen Beitrag 3, 4 oder 5 mal zu posten bringt Dir keine schnellere Antwort...viel wahrscheinlicher bekommst du gar keine.
<br />
<br /> 
<br />
<br />[b]5.[/b] Bitte starte nur neue Themen wenn n&ouml;tig. Wenn eine &auml;hnliches Thema existiert, schreibe bitte dort hinein. Dadurch wird das Thema an den Anfang der Liste gesetzt und dein Beitrag wird gelesen. Dies ist ausserdem ratsam, da sich einige User m&ouml;glicherweise bereits &uuml;ber neue Beitr&auml;ge in diesem Thema benachrichtigen lassen. 
<br />
<br />
<br />
<br />[b]6.[/b] Schreibe deinen Beitrag im richtigen Forum. 
<br />
<br />z.B. kommen Requests in's Requests-Forum und thematisch nicht einzuordnende Beitr&auml;ge in's Off Topic-Forum. 
<br />
<br />Missachtung f&uuml;hrt zur Verschiebung oder sogar L&ouml;schung deines Beitrages! 
<br />
<br />
<br />
<br />[b]7.[/b] [b]KONTAKTIERE NIEMALS[/b] den Administrator oder Moderatoren per eMail oder Private Message, es sei denn, du bist [b]AUSDR&Uuml;CKLICH[/b] dazu aufgefordert worden! Unaufgeforderte private Nachrichten und privat gestellte Fragen werden [b]IGNORIERT![/b] 
<br />
<br />
<br />
<br />Wir versuchen so gut es geht zu helfen. Zeit ist nicht kostenlos und wir unterst&uuml;tzen ausschliesslich auf freiwilliger Basis. ");
$faq[] = array("In welchen Sprachen kann ich Beitr&auml;ge schreiben?", "Die Hauptsprache dieses Boards ist Deutsch und so soll es auch nach M&ouml;glichkeit bleiben. Du kannst deine Anfragen ausserdem in englischer Sprache verfassen, die Antworten werden in englischer Sprache erfolgen. Anfragen in anderen Sprachen als Deutsch oder Englisch verringern deine Antwortchancen wegen der geringeren Zahl potentieller Helfer.");
$faq[] = array("Wie &auml;ussere ich einen Wunsch oder melde einen Bug? ", "[i]Requests:[/i] 
<br />Nenne den Namen der Modifikation. 
<br />Nenne ggf. einen Original-Downloadlink. 
<br />Beschreibe kurz den Nutzen/Zweck der Modifikation. 
<br />
<br />[i]Bugs:[/i] 
<br />Nenne die Zeile, die den Fehler verursacht. 
<br />Nutze Debug-Mechanismen, um maximale Informationen &uuml;ber auftretende Fehler zu erhalten.
<br />Poste einen Link zu deiner Seite (vorzugsweise zu der Seite mit dem Fehler). 
<br />Versichere Dich, das Helfer Zugriff auf die entsprechenden Module haben, du wirst evtl. nicht noch einmal danach gefragt.");
$faq[] = array("--", "Sonstige Regeln");
$faq[] = array("Spamming", "Bitte spamme unsere Foren nicht voll. Unsere Moderatoren sperren User die spammen!");
$faq[] = array("Username", "Bitte benutze einen \"anst&auml;ndigen\" Usernamen! Namen die in irgendeiner Weise anst&ouml;&szlig;ig sind werden gesperrt! ");
$faq[] = array("Kontakt zum Administrator oder zu Moderatoren", "Bitte kontaktiere den Administrator oder die Moderatoren nicht &uuml;ber:
<br />- [b]eMail[/b]
<br />- [b]MSN,AIM, Yahoo Messenger, ICQ[/b]
<br />- [b]Private Nachrichten[/b]
<br />
<br />Du kannst Administratoren oder Moderatoren [b]nur[/b] auf diese Weise kontaktieren, wenn du dazu aufgefordert wurdest. Bitte beachte dies, denn alle PMs/eMails/etc. werden in Zukunft ignoriert. ");
$faq[] = array("Was ist Bump?", "Wenn du vor einiger Zeit einen Beitrag geschrieben hast und noch keine Antwort erhalten hast, schreibe als Antwort \"Bump\", statt: 
<br />
<br />BITTE HELFT MIR! (Beispiel). 
<br />
<br />Mit \"einiger Zeit\" sind 2 oder 3 Tage gemeint, nicht Stunden! Du wirst [b]EINMAL[/b] verwarnt, wenn du diese M&ouml;glichkeit missbrauchst. Wenn du dann erneut \"Bump\" benutzt oder anderweitig spammst [b]WIRST DU GESPERRT![/b] 
<br />
<br />Bitte versuche zu verstehen, [b]WIR[/b] haben auch ein Privatleben und k&ouml;nnen daher nicht immer sofort reagieren! ");
$faq[] = array("Spamming &uuml;ber das Private Message System", "Das Senden von Werbung jeder Art &uuml;ber das Private Message System ist untersagt. Wir kontrollieren das System auf Auff&auml;lligkeiten. Wenn du dabei erwischt wirst, Werbung an unsere Mitglieder wirst du sofort und unwiderruflich gesperrt. [b]ES GIBT KEINE VERWARNUNG[/b] bevor du gesperrt wirst und ggf. dein Host unterrichtet wird! [b]DU BIST GEWARNT![/b]");

?>