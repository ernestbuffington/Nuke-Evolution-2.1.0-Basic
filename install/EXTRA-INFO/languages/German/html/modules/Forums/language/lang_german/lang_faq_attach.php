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

$faq[] = array("--", "Anh&auml;nge");
$faq[] = array("Wie f&uuml;ge ich einen Anhang hinzu?", "Du kannst Anh&auml;nge zu neuen Beitr&auml;gen hinzuf&uuml;gen. Du solltest ein <i>Datei anh&auml;ngen</i>-Formular unterhalb der Beitragsbox sehen. Wenn du auf den <i>Durchsuchen...</i>-Knopf klickst &ouml;ffnet sich der Standard Dateiauswahl Dialog. Suche die Datei die du anh&auml;ngen willst, w&auml;hle sie aus und klicke auf OK. Wenn du einen Text im Feld \'Dateikommentar\' eingibts, wird dieser als Linktext f&uuml;r den Anhang verwendet. Wenn du keinen Dateikommentar eingibst, wird stattdessen der Dateiname als Linktext verwendet. Wenn der Administrator dies erlaubt hat, kannst du mehrere Dateien anh&auml;ngen bis das eingestellte Maximum f&uuml;r Anh&auml;nge pro Beitrag erreicht wurde.<br/><br/>Der Administrator definiert ein Limit f&uuml;r die Dateigr&ouml;sse, erlaubte Dateitypen und andere relevante Optionen f&uuml;r Anh&auml;nge auf diesem Board. Sei Dir dar&uuml;ber im Klaren, das du daf&uuml;r verantwortlich bist, das die Anh&auml;nge den Regeln des Boards entsprechen und das sie jederzeit ohne Warnung wieder gel&ouml;scht werden k&ouml;nnen.<br/><br/>Beachte das der Seitenbetreiber, Webmaster, Administrator oder die Moderatoren nicht f&uuml;r Datenverluste verantwortlich gemacht werden k&ouml;nnen.");
$faq[] = array("Wie h&auml;nge ich eine Datei an, nachdem der Beitrag bereits gepostet wurde?", "Um einen Anhang nach dem Posten anzuh&auml;ngen, bearbeite deinen Beitrag und folge den obigen Erl&auml;uterungen. Der neue Anhang wird hinzugef&uuml;gt, sobald du den bearbeiteten Beitrag absendest.");
$faq[] = array("Wie l&ouml;sche ich einen Anhang?", "Um einen Anhang zu l&ouml;schen, bearbeite deinen Beitrag und klicke auf \'Anhang l&ouml;schen\' neben dem Dateianhang in der \'Angeh&auml;ngte Dateien\' Box. Der Anhang wird gel&ouml;scht, sobald du den bearbeiteten Beitrag absendest.");
$faq[] = array("Wie &auml;ndere ich einen Dateikommentar?", "Um einen Dateikommentar zu &auml;ndern musst du deinen Beitrag bearbeiten, den Text im Feld \'Dateikommentar\' &auml;ndern und auf den \'Dateikommentar aktualisieren\'-Knopf neben dem zu &auml;ndernden Kommentar in der \'Angeh&auml;ngte Dateien\' Box. Der Kommentar wird aktualisiert, sobald du den bearbeiteten Beitrag absendest.");
$faq[] = array("Warum ist mein Anhang nicht im Beitrag sichtbar?", "H&ouml;chstwahrscheinlich ist die Datei oder deren Typ nicht l&auml;nger in diesem Forum erlaubt oder ein Administrator oder Moderator hat die Datei wegen eines Verstosses gegen die Boardregeln gel&ouml;scht.");
$faq[] = array("Warum kann ich keine Dateien anh&auml;ngen?", "In einigen Foren kann das Anh&auml;ngen von Dateien auf bestimmte User oder Gruppen beschr&auml;nkt sein. Um dann Dateianh&auml;nge posten zu k&ouml;nnen, ben&ouml;tigst du spezielle Berechtigungen. Nur Administratoren oder Moderatoren k&ouml;nnen Dir diese geben, also kontaktiere sie deswegen.");
$faq[] = array("Ich habe die erforderlichen Berechtigungen, warum kann ich keine Dateien anh&auml;ngen?", "Der Board-Administrator definiert Obergrenzen f&uuml;r die Dateigr&ouml;sse, die erlaubten Dateitypen und andere Optionen f&uuml;r die Anh&auml;nge. Ein Administrator oder Moderator k&ouml;nnte deine Berechtigungen ge&auml;ndert oder die Dateianh&auml;nge f&uuml;r das betreffende Forum deaktiviert haben. Du solltest eine Erkl&auml;rung in der Fehlermeldung erhalten, wenn du versuchst einen Anhang zu posten, wenn nicht k&ouml;nntest du den Moderator oder Administrator kontaktieren.");
$faq[] = array("Warum kann ich keine Anh&auml;nge l&ouml;schen?", "Auf einigen Foren k&ouml;nnte das L&ouml;schen von Anh&auml;ngen auf bestimmte User oder Gruppen beschr&auml;nkt sein. Nur Administratoren oder Moderatoren k&ouml;nnen diese Beschr&auml;nkungen &auml;ndern, also kontaktiere sie deswegen.");
$faq[] = array("Warum kann ich keine Anh&auml;nge ansehen/herunterladen?", "Auf einigen Foren k&ouml;nnte das Ansehen/Herunterladen von Anh&auml;ngen auf bestimmte User oder Gruppen beschr&auml;nkt sein. Nur Administratoren oder Moderatoren k&ouml;nnen diese Beschr&auml;nkungen &auml;ndern, also kontaktiere sie deswegen.");
$faq[] = array("Wen kontaktiere ich wegen illegaler oder m&ouml;glicherweise illegaler Anh&auml;nge?", "Du solltest den Administrator dieses Boards kontaktieren. Wenn du nicht ermitteln kannst, wer das ist, kontaktiere einen der Forenmoderatoren. Wenn du auch dann keine Antwort erh&auml;ltst, kontaktiere den Eigent&uuml;mer der Domain (&uuml;ber eine WHOIS-Abfrage) oder, falls es sich um eine kostenlose Domain handelt (z.B. yahoo, free.fr, f2s.com, etc.), das Management oder die Missbrauchs-Abteilung dieses Services. Bitte beachte das die phpBB Gruppe keinerlei Einfluss darauf hat und daher in keiner Weise daf&uuml;r verantwortlich gemacht werden kann wer, wie und wo diese Forensoftware einsetzt. Es ist absolut unsinnig, die phpBB Gruppe in irgendeiner Angelegenheit die nicht die phpBB Webseite oder die Software an sich betrifft, zu kontaktieren. Wenn du eine eMail an die phpBB Gruppe schickst, die mit der Nutzung durch Dritte in Verbindung steht, erwarte eine abschl&auml;gige oder gar keine Antwort.");

?>