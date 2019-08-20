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

if (!defined('ADMIN_FILE') && !defined('IN_SETTINGS')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

$lang_admin[$settingspoint]['MENU_TITLE'] = 'Grafische Einstellung';
$lang_admin[$settingspoint]['SETTING_HEADER'] = 'Generelle Einstellung des Administrationsmen&uuml;s';
$lang_admin[$settingspoint]['SETTING_FIELDSET'] = 'Grafische Einstellungen';

$lang_admin[$settingspoint]['FIELD_ADMINGRAPHIC'] = 'Grafiksymbole im Administrationsmen&uuml; anzeigen';
$lang_admin[$settingspoint]['FIELD_ADMINGRAPHIC_HELP'] = 'Grafiksymbole im Administrationsmen&uuml; k&ouml;nnen hier ein- und ausgeschaltet werden.';
$lang_admin[$settingspoint]['FIELD_ADMIN_POS'] = 'Position der Grafiken';
$lang_admin[$settingspoint]['FIELD_ADMIN_POS_HELP'] = 'Wenn Grafiksymbole im Administrationsmen&uuml; eingeschaltet sind, so kann hier eingestellt werden, ob die Symbole oberhalb oder unterhalb der Textbeschreibung angezeigt werden sollen.';
$lang_admin[$settingspoint]['FIELD_ADMIN_POS_UP'] = 'Oberhalb des Textes';
$lang_admin[$settingspoint]['FIELD_ADMIN_POS_DOWN'] = 'Unterhalb des Textes';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_ACTIVATE'] = 'Bildgr&ouml;sse anpassen aktivieren';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_ACTIVATE_HELP'] = 'Hier kann eingestellt werden, ob die automatische Gr&ouml;&szlig;enanpassung f&uuml;r Bilder in Neuigkeiten ein- oder ausgeschaltet ist. Die Gr&ouml;&szlig;enanpassung ist abh&auml;ngig von den Einstellungen der Bildh&ouml;he und Bildbreite.';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_WIDTH'] = 'auf diese Bildbreite anpassen';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_WIDTH_HELP'] = 'Wenn die automatische Gr&ouml;&szlig;enanpassung aktiviert ist, so kann hier die Bildbreite in Pixel angegeben werden, in der die Bilder angezeigt werden sollen.';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_HEIGHT'] = 'auf diese Bildh&ouml;he anpassen';
$lang_admin[$settingspoint]['FIELD_IMAGE_RESIZE_HEIGHT_HELP'] = 'Wenn die automatische Gr&ouml;&szlig;enanpassung aktiviert ist, so kann hier die Bildh&ouml;he in Pixel angegeben werden, in der die Bilder angezeigt werden sollen.';

$lang_admin[$settingspoint]['FIELD_NONE'] = 'Keine Eingabefelder f&uuml;r '.$settingspoint.' verf&uuml;gbar';
$lang_admin[$settingspoint]['BUTTON_SAVE'] = 'Speichern';
$lang_admin[$settingspoint]['BUTTON_BACK'] = 'Zur&uuml;ck';

?>