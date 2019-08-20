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

if (!defined('ADMIN_FILE')) {
    die('You can\'t access this file directly...');
}

global $adminpoint, $evoconfig;
$lang_admin[$adminpoint]['NEWSLETTER_BACKMAIN'] = 'Zur&uuml;ck zur Hauptadministration';

$lang_admin[$adminpoint]['NEWSLETTER_DISCARD'] = 'Verwerfen';

$lang_admin[$adminpoint]['NEWSLETTER_ERROR_NOT_SET'] = '%s ist nicht belegt';

$lang_admin[$adminpoint]['NEWSLETTER_FROM'] = 'von';

$lang_admin[$adminpoint]['NEWSLETTER_HELLO'] = 'Hallo';

$lang_admin[$adminpoint]['NEWSLETTER_MAILCONTENT'] = 'Email Nachricht';
$lang_admin[$adminpoint]['NEWSLETTER_MANYUSERSNOTE'] = 'Weil sehr viele Mitglieder diese Nachricht erhalten werden, kann es mehrere Minuten dauern, bis der Prozess abgeschlossen ist<br />Wir bitten um Geduld !';
$lang_admin[$adminpoint]['NEWSLETTER_MUSERGROUPWILLRECEIVE'] = 'Folgende Benutzergruppen werden diese Nachricht erhalten: ';

$lang_admin[$adminpoint]['NEWSLETTER_NEWSLETTERSENT'] = 'Die Nachricht wurde verschickt.';
$lang_admin[$adminpoint]['NEWSLETTER_NL_ADMINS'] = 'Administratoren';
$lang_admin[$adminpoint]['NEWSLETTER_NL_ALLUSERS'] = 'Alle Mitglieder';
$lang_admin[$adminpoint]['NEWSLETTER_NL_NOUSERS'] = 'Die ausgew&auml;hlte Gruppe hat keine Mitglieder. <br />Bitte gehe zur&uuml;ck und w&auml;hle eine andere Gruppe';
$lang_admin[$adminpoint]['NEWSLETTER_NL_RECIPS'] = 'Empf&auml;nger';
$lang_admin[$adminpoint]['NEWSLETTER_NL_REGARDS'] = 'Mit den besten W&uuml;nschen';
$lang_admin[$adminpoint]['NEWSLETTER_NLUNSUBSCRIBE'] = '<u>Bitte beachte: </u><br />Diese Nachricht hast Du erhalten, weil Du in Deinem Profil angegeben hast, von uns Nachrichten erhalten zu wollen. <br />Du kannst diesen Service jederzeit abbestellen, in dem Du in Deinem Benutzerprofil unter Einstellungen den Punkt NEWSLETTER PER MAIL erhalten, auf NEIN setzt. <br />Wenn Du weitere Hilfe ben&ouml;tigst, sende bitte eine eMail an unseren <a href="mailto:'.$evoconfig['adminmail'].'">Administrator</a>';
$lang_admin[$adminpoint]['NEWSLETTER_NUSERWILLRECEIVE'] = 'Mitglieder werden diese Nachricht erhalten';

$lang_admin[$adminpoint]['NEWSLETTER_PREVIEW'] = 'Vorschau';

$lang_admin[$adminpoint]['NEWSLETTER_REVIEWTEXT'] = 'Bitte &uuml;berpr&uuml;fe die Nachricht - auch auf Schreibfehler';

$lang_admin[$adminpoint]['NEWSLETTER_SEND'] = 'Nachricht senden';
$lang_admin[$adminpoint]['NEWSLETTER_STAFF'] = 'Team';
$lang_admin[$adminpoint]['NEWSLETTER_SUBSCRIBEDUSERS'] = 'Eingetragene Mitglieder';
$lang_admin[$adminpoint]['NEWSLETTER_SUBJECT'] = 'Betreff';

$lang_admin[$adminpoint]['NEWSLETTER_TITLE'] = 'Newsletter';

?>