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

global $adminpoint, $adminmail;
$lang_admin[$adminpoint]['NEWSLETTER_BACKMAIN'] = 'Terug naar het hoofdmenu';

$lang_admin[$adminpoint]['NEWSLETTER_DISCARD'] = 'Deactiveren';

$lang_admin[$adminpoint]['NEWSLETTER_ERROR_NOT_SET'] = '%s is niet bekend';

$lang_admin[$adminpoint]['NEWSLETTER_FROM'] = 'van';

$lang_admin[$adminpoint]['NEWSLETTER_HELLO'] = 'Hallo';

$lang_admin[$adminpoint]['NEWSLETTER_MAILCONTENT'] = 'Email bericht';
$lang_admin[$adminpoint]['NEWSLETTER_MANYUSERSNOTE'] = 'Aangezien dat veel leden dit bericht krijgen kan het tot enkele minuten duren<br />Even geduld AUB !';
$lang_admin[$adminpoint]['NEWSLETTER_MUSERGROUPWILLRECEIVE'] = 'De volgende gebruikersgroepen zullen dit bericht krijgen: ';

$lang_admin[$adminpoint]['NEWSLETTER_NEWSLETTERSENT'] = 'Bericht verzonden.';
$lang_admin[$adminpoint]['NEWSLETTER_NL_ADMINS'] = 'Administrators';
$lang_admin[$adminpoint]['NEWSLETTER_NL_ALLUSERS'] = 'Alle Leden';
$lang_admin[$adminpoint]['NEWSLETTER_NL_NOUSERS'] = 'De gekozen groep heeft geen leden. <br />Ga terug en kies een andere groep';
$lang_admin[$adminpoint]['NEWSLETTER_NL_RECIPS'] = 'Ontvangers';
$lang_admin[$adminpoint]['NEWSLETTER_NL_REGARDS'] = 'Met vriendelijk groet';
$lang_admin[$adminpoint]['NEWSLETTER_NLUNSUBSCRIBE'] = '<u>Let op: </u><br />U heeft dit bericht gekregen omdat u in uw profiel aangegeven hebt deze mails te ontvangen, u kunt dit elk moment wijzigen door in uw profiel Nieuwsbrief ontvangen uit te schakelen. <br />Voor hulp kunt u een E-Mail sturen naar de <a href="mailto:'.$adminmail.'">Administrator</a>';
$lang_admin[$adminpoint]['NEWSLETTER_NUSERWILLRECEIVE'] = 'Leden zullen dit bericht ontvangen';

$lang_admin[$adminpoint]['NEWSLETTER_PREVIEW'] = 'voorbeeld';

$lang_admin[$adminpoint]['NEWSLETTER_REVIEWTEXT'] = 'Controleer AUB dit bericht op (schijf)fouten';

$lang_admin[$adminpoint]['NEWSLETTER_SEND'] = 'Bericht versturen';
$lang_admin[$adminpoint]['NEWSLETTER_STAFF'] = 'Team';
$lang_admin[$adminpoint]['NEWSLETTER_SUBSCRIBEDUSERS'] = 'Aangemelde leden';
$lang_admin[$adminpoint]['NEWSLETTER_SUBJECT'] = 'Betreft';

$lang_admin[$adminpoint]['NEWSLETTER_TITLE'] = 'Nieuwsbrief';

?>