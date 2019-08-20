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

$faq[] = array("--", "Einf&uuml;hrung");
$faq[] = array("Was ist BBCode?", "BBCode ist eine spezielle Eigenart von HTML. Ob du BBCode in deinen Beitr&auml;gen benutzen kannst, entscheidet allein der Systemadministrator. Zus&auml;tzlich kannst du den BBCode auch f&uuml;r einzelne Beitr&auml;ge abschalten. BBCode ist dem HTML-Stil sehr &auml;hnlich, Tags werden mit den Klammern [ und ] ge&ouml;ffnet und geschlossen. Es gibt dir die M&ouml;glichkeit, das Aussehen dessen, was du geschrieben hast, deutlich zu ver&auml;ndern. Je nachdem, welchen Style du benutzt, findest du vielleicht eine Men&uuml;liste mit Instand-BBCode bei der Beitragserstellung. Aber auch dann wirst du die folgende Liste interessant finden.");
$faq[] = array("--", "Textformatierung");
$faq[] = array("Wie erstelle ich fetten, unterstrichenen oder kursiven Text?", "BBCode verwendet Tags, die dir erlauben, das Aussehen deines Textes recht einfach zu ver&auml;ndern. Dies geschieht folgendermassen: <ul><li>Um einen Text fett darzustellen, umschliess ihn mit <strong>[b][/b]</strong>, z.B. <br /><br /><strong>[b]</strong>Hallo<strong>[/b]</strong><br /><br /> wird zu <strong>Hallo</strong></li><li>Zum Unterstreichen benutzt du <strong>[u][/u]</strong>, zum Beispiel:<br /><br /><strong>[u]</strong>Guten Morgen<strong>[/u]</strong><br /><br />wird zu <u>Guten Morgen</u></li><li>Um kursiv zu schreiben, benutzt du <strong>[i][/i]</strong>, z.B.<br /><br />Das ist <strong>[i]</strong>Toll!<strong>[/i]</strong><br /><br />w&uuml;rde so aussehen: Das ist <i>Toll!</i></li></ul>");
$faq[] = array("Wie ver&auml;ndere ich die Schriftfarbe oder Gr&ouml;sse?", "Um die Farbe oder Gr&ouml;sse deines Textes zu &auml;ndern, kannst du die folgenden Tags benutzen. Bedenke jedoch, dass das Resultat auf den Browser des jeweiligen Users ankommt: <ul><li>Um einen Text in einer bestimmten Farbe darzustellen, umschliesse ihn mit <strong>[color=][/color]</strong>. Du kannst entweder einen allgemeinen Farbnamen angeben (z.B. red, blue, yellow, usw.) oder den Heximalcode, z.B. #FFFFFF, #000000. Um beispielsweise einen roten Text zu schreiben, k&ouml;nntest du folgendes schreiben:<br /><br /><strong>[color=red]</strong>Hallo!<strong>[/color]</strong><br /><br />oder<br /><br /><strong>[color=#FF0000]</strong>Hallo!<strong>[/color]</strong>, <br /><br />beides ergibt <span style=\"color:red\">Hallo!</span></li><li>Das &Auml;ndern der Textgr&ouml;sse geschieht &auml;hnlich, benutze dazu den Tag <strong>[size=][/size]</strong>. Dieser Tag h&auml;ngt vom Style ab, das du benutzt. F&uuml;r gew&ouml;hnlich wird die Textgr&ouml;sse als Zahlenwert eingegeben, der die H&ouml;he in Pixel angibt, beginnend mit 1 (so klein, du wirst es kaum sehen) bis zu 29 (riesengross). Zum Beispiel:<br /><br /><strong>[size=9]</strong>KLEIN<strong>[/size]</strong><br /><br />wird grunds&auml;tzlich <span style=\"font-size:9px\">KLEIN</span><br /><br />wohingegen:<br /><br /><strong>[size=24]</strong>RIESIG!<strong>[/size]</strong><br /><br />zu <span style=\"font-size:24px\">RIESIG!</span> wird.</li></ul>");
$faq[] = array("Kann ich verschiedene Tags kombinieren?", "Nat&uuml;rlich geht das, ein Text, der gesehen werden soll, k&ouml;nnte beispielsweise so aussehen: <br /><br /><strong>[size=18][color=red][b]</strong>SCHAU MICH AN<strong>[/b][/color][/size]</strong><br /><br />ergibt <span style=\"color:red;font-size:18px\"><strong>SCHAU MICH AN!</strong></span><br /><br />Es ist nicht zu empfehlen, gr&ouml;ssere Mengen Text so aussehen zu lassen! Denk daran, es ist deine Aufgabe, daf&uuml;r zu sorgen, dass alle Tags auch wieder richtig geschlossen werden. Das hier zum Beispiel geht nicht: <br /><br /><strong>[b][u]</strong>Das ist falsch<strong>[/b][/u]</strong>");
$faq[] = array("Wie ver&auml;ndere ich die Schriftfarbe oder Gr&ouml;sse?", "Um die Farbe oder Gr&ouml;sse deines Textes zu &auml;ndern, kannst du die folgenden Tags benutzen. Bedenke jedoch, dass das Resultat auf den Browser des jeweiligen Users ankommt: <ul><li>Um einen Text in einer bestimmten Farbe darzustellen, umschliesse ihn mit <strong>[color=][/color]</strong>. Du kannst entweder einen allgemeinen Farbnamen angeben (z.B. red, blue, yellow, usw.) oder den Heximalcode, z.B. #FFFFFF, #000000. Um beispielsweise einen roten Text zu schreiben, k&ouml;nntest du folgendes schreiben:
<br />
<br /><strong>[color=red]</strong>Hallo!<strong>[/color]</strong>
<br />
<br />oder
<br />
<br /><strong>[color=#FF0000]</strong>Hallo!<strong>[/color]</strong>, 
<br />
<br />beides ergibt <span style=\"color:red\">Hallo!</span></li><li>Das &Auml;ndern der Textgr&ouml;sse geschieht &auml;hnlich, benutze dazu den Tag <strong>[size=][/size]</strong>. Dieser Tag h&auml;ngt vom Style ab, das du benutzt. F&uuml;r gew&ouml;hnlich wird die Textgr&ouml;sse als Zahlenwert eingegeben, der die H&ouml;he in Pixel angibt, beginnend mit 1 (so klein, du wirst es kaum sehen) bis zu 29 (riesengross). Zum Beispiel:
<br />
<br /><strong>[size=9]</strong>KLEIN<strong>[/size]</strong>
<br />
<br />wird grunds&auml;tzlich <span style=\"font-size:9px\">KLEIN</span>
<br />
<br />wohingegen:
<br />
<br /><strong>[size=24]</strong>RIESIG!<strong>[/size]</strong>
<br />
<br />zu <span style=\"font-size:24px\">RIESIG!</span> wird.</li></ul>
<br />Test Test");
$faq[] = array("--", "Zitate und Code-Angaben");
$faq[] = array("Zitate in Antworten verwenden", "Es gibt zwei M&ouml;glichkeiten, einen Text zu zitieren.<ul><li>Wenn du die Zitatfunktion zum Antworten auf einen Beitrag verwendest, wirst du merken, dass der zitierte Text in <strong>[quote=\"\"][/quote]</strong>-Tags steht. So ist es dir m&ouml;glich, den Text des Users, oder wo auch immer du ihn her hast, wortgetreu nachzugeben! Ein Beispiel: Um einen Teil des Textes zu zitieren, den Herr Meier geschrieben hat, w&uuml;rdest du schreiben:<br /><br /><strong>[quote=\"Herr Meier\"]</strong>Der Text von Herrn Meier w&uuml;rde hier erscheinen<strong>[/quote]</strong><br /><br />Der Text 'Herr Meier schrieb:' erscheint automatisch vor dem Zitat. Bedenke, dass du die Zeichen \"\" um den Autorennamen schreiben <strong>musst</strong>, sie sind nicht nur zur Versch&ouml;nerung.</li><li>Mit der zweiten M&ouml;glichkeit erstellst du ein blindes Zitat. Um dies durchzuf&uuml;hren, schliesse den Text in <strong>[quote][/quote]</strong>-Tags ein. Wenn du dir den Beitrag dann anschaust, wird einfach nur 'Zitat:' vor dem Beitrag angezeigt.</li></ul>");
$faq[] = array("Code-Angaben", "Wenn du den Teil eines Codes oder etwas, was einfach eine fixe L&auml;nge hat, ausgeben m&ouml;chtest, solltest du den Text in <strong>[code][/code]</strong>-Tags setzen, z.B <br /><br /><strong>[code]</strong>echo \"Dies ist ein Code\";<strong>[/code]</strong><br /><br />Alle Formatierungen, die in diesen <strong>[code][/code]</strong>-Tags verwendest, werden nachher nicht ausgef&uuml;hrt.");
$faq[] = array("test", "blabla");
$faq[] = array("--", "Listenerstellung");
$faq[] = array("Eine ungeordnete Liste einf&uuml;gen", "BBCode unterst&uuml;tzt zwei Typen von Listen, geordnete und ungeordnete. Sie sind im wesentlichen die gleichen Listen wie ihre Gegenst&uuml;cke in der HTML-Umgebung. Eine ungeordnete Liste zeigt jedes Objekt in der Liste an, alle mit einem Bullet-Symbol davor. Um eine ungeordnete Liste zu erstellen, benutze die <strong>[list][/list]</strong>-Tags und gib jeden Punkt innerhalb der Liste an, indem du einen <strong>[*]</strong> nutzt. Um zum Beispiel deine Lieblinsfarben aufzuz&auml;hlen, k&ouml;nntest du schreiben:<br /><br /><strong>[list]</strong><br /><strong>[*]</strong>Rot<br /><strong>[*]</strong>Blau<br /><strong>[*]</strong>Gelb<br /><strong>[/list]</strong><br /><br />Das w&uuml;rde folgende Liste ergeben: <ul><li>Rot</li><li>Blau</li><li>Gelb</li></ul>");
$faq[] = array("Eine geordnete Liste einf&uuml;gen", "Die zweite Listenart, die geordnete Liste, gibt dir die M&ouml;glichkeit, anzugeben, was vor jedem Punkt steht. Um eine geordnete Liste zu erstellen, benutzt du den <strong>[list=1][/list]</strong>-Tag, um eine nummierte Liste zu erstellen, oder alternativ <strong>[list=a][/list]</strong> f&uuml;r eine alphabetische Liste. Genau wie der bei ungeordneten Liste werden die Punkte mit dem <strong>[*]</strong> spezifiziert. Zum Beispiel:<br /><br /><strong>[list=1]</strong><br /><strong>[*]</strong>In den Laden gehen<br /><strong>[*]</strong>Einen neuen Computer kaufen<br /><strong>[*]</strong>Den Computer verfluchen, wenn er nicht mehr geht<br /><strong>[/list]</strong><br /><br />ergibt das folgende:<ol type=\"1\"><li>In den Laden gehen</li><li>Einen neuen Computer kaufen</li><li>Den Computer verfluchen, wenn er nicht mehr geht</li></ol>F&uuml;r eine alphabetische Liste widerum w&uuml;rdest du das folgende eingeben:<br /><br /><strong>[list=a]</strong><br /><strong>[*]</strong>Die erste M&ouml;glichkeit<br /><strong>[*]</strong>Die zweite M&ouml;glickeit<br /><strong>[*]</strong>Die dritte M&ouml;glichkeit<br /><strong>[/list]</strong><br /><br />was<ol type=\"a\"><li>Die erste M&ouml;glichkei</li><li>Die zweite M&ouml;glichkei</li><li>Die dritte M&ouml;glichkei</li>ergibt</ol>");
$faq[] = array("--", "Links erstellen");
$faq[] = array("Das Linken zu einer Site", "phpBB BBCode unterst&uuml;tzt eine Menge verschiedener M&ouml;glichkeiten, wie man Internet-Adressen (URLs) einf&uuml;gen kann.<ul><li>Die erste M&ouml;glichkeit ist die Verwendung des<strong>[url=][/url]</strong>-Tag. Was auch immer du hinter das = Zeichen schreibst, wird als Inhalt der URL gewertet. Ein Beispiel: einen Link zu phpBB.com ertellst du so:<br /><br /><strong>[url=http://www.phpbb.com/]</strong>Besucht phpBB!<strong>[/url]</strong><br /><br />Das w&uuml;rde den folgenden Link erstellen: <a href=\"http://www.phpbb.com/\" target=\"_blank\">Besucht phpBB!</a>. Du wirst bemerken, dass sich der Link in einem neuen Fenster &ouml;ffnet, so dass der User weiter im Forum surfen kann, sofern er dies w&uuml;nscht.</li><li>Falls du m&ouml;chtest, dass die URL automatisch als Link angezeigt wird, kannst du folgendermassen schreiben:<br /><br /><strong>[url]</strong>http://www.phpbb.com/<strong>[/url]</strong><br /><br />Dies wird den folgenden Link erzeugen: <a href=\"http://www.phpbb.com/\" target=\"_blank\">http://www.phpbb.com/</a></li><li>Zus&auml;tzlich verf&uuml;gt phpBB &uuml;ber die sogenannten <i>Magic Links</i>, was automatisch korrekt angegebene URLs in Links umwandelt, ohne dass du Tags schreiben musst. Wenn du zum Beispiel www.phpbb.com in einen Beitrag schreibst, wird daraus automatisch <a href=\"http://www.phpbb.com/\" target=\"_blank\">www.phpbb.com</a>, wenn jemand die Nachricht liest.</li><li>Dies funktioniert &uuml;brigens auch mit E Mail-Adressen, du kannst entweder eine Adresse gesondert eingeben, z.B.:<br /><br /><strong>[email]</strong>webmaster@phpbb.com<strong>[/email]</strong><br /><br />was das Folgende ergibt <a href=\"mailto:webmaster@phpbb.com\">webmaster@phpbb.com</a> oder du schreibst einfach webmaster@phpbb.com in deinen Beitrag und es wird automatisch in einen Link umgewandelt.</li></ul>Wie die meisten anderen BBCode-Tags, kannst du auch den URL-Tag mit anderen Tags kombinieren, z.B. <strong>[img][/img]</strong> (siehe n&auml;chsten Punkt), <strong>[b][/b]</strong>, usw. Es ist wie immer deine Aufgabe, dass alle ge&ouml;ffneten Tags auch wieder richtig geschlossen werden, z.B.<br /><br /><strong>[url=http://www.phpbb.com/][img]</strong>http://www.phpbb.com/images/phplogo.gif<strong>[/url][/img]</strong><br /><br />ist <u>nicht</u> richtig und wird einen Fehler in deinem Post ausl&ouml;sen.");
$faq[] = array("--", "Bilder in Beitr&auml;gen anzeigen");
$faq[] = array("Ein Bild einf&uuml;gen", "Der phpBB BBCode unterst&uuml;zt ebenfalls das Einf&uuml;gen von Bildern in Beitr&auml;gen. Es gibt zwei wichtige Regeln, was das Anzeigen von Bildern betrifft: die meisten User finden es einfach furchtbar, wenn endlos Bilder in den Beitr&auml;gen stehen (Stichwort Ladezeiten) und zum anderen muss das Bild bereits irgendwo im Internet hochgeladen sein (es bringt also nichts, wenn die Datei nur auf deiner Festplatte liegt, sofern du keinen Webserver hast!). Momentan gibt es noch keine M&ouml;glichkeit, Bilder mit Hilfe von phpBB lokal zu speichern (das k&ouml;nnte sich mit der n&auml;chsten Version von phpBB 2 nat&uuml;rlich &auml;ndern). Um ein Bild anzuzeigen, muss die URL des Bildes mit den <strong>[img][/img]</strong>-Tags umschlossen werden. Zum Beispiel:<br /><br /><strong>[img]</strong>http://www.phpbb.com/support/documentation/2.0/phpbb_logo.jpg<strong>[/img]</strong><br /><br />Wie bei der URL-Erkl&auml;rung bereits erw&auml;hnt, kannst du Bilder in <strong>[url][/url]</strong>-Tags einschliessen, wenn du m&ouml;chtest, z.B. <br /><br /><strong>[url=http://www.phpbb.com/][img]</strong>http://www.phpbb.com/support/documentation/2.0/phpbb_logo.jpg<strong>[/img][/url]</strong><br /><br />w&uuml;rde folgendes ergeben:<br /><br /><a href=\"http://www.phpbb.com/\" target=\"_blank\"><img src=\"http://www.phpbb.com/support/documentation/2.0/phpbb_logo.jpg\" border=\"0\" alt=\"\" /></a><br />");
$faq[] = array("--", "Andere Codes");
$faq[] = array("Kann ich meine eigenen Tags hinzuf&uuml;gen?", "Nein, nicht mit phpBB 2.0 direkt! Wir versuchen, eine M&ouml;glichkeit daf&uuml;r zu finden und diese mit dem n&auml;chsten Main-Release von phpBB anzubieten.");
$faq[] = array("Was ist all dieser PHP Unsinn!?", "Der PHP BBCode ist &auml;hnlich dem BBCode, ausser, dass er nur f&uuml;r PHP Code verwendet werden sollte.  Warum?  Weil es bestimmte Sektionen des PHP Code aufzeigt, der es einfacher macht zu lesen.");
//
// This ends the BBCode guide entries
//

?>