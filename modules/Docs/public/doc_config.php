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

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

global $db;
$result = $db->sql_query("SELECT * FROM  `"._EVO_CONFIG_TABLE."` WHERE `evo_field` LIKE 'legal_%'", SQL_ASSOC);
if ($result) {
    while(list($evo_field, $evo_value) = $db->sql_fetchrow($result)) {
        $legalconfig[$evo_field] = $evo_value;
    }
} else {
    $legalconfig['legal_aboutus'] = 1;
    $legalconfig['legal_disclaimer'] = 1;
    $legalconfig['legal_privacy'] = 1;
    $legalconfig['legal_terms'] = 1;
    $legalconfig['legal_questions'] = 1;
}

// Choose your settings below. If you don't to use a particular page,
// then set the number 1 to a number 0 for 'off'.
// Settings  are now stored in Configurationstable
################################################################
#                                                              #
#   DO NOT TOUCH CODE BELOW, UNLESS YOU KNOW WHAT YOUR DOING   #
#                                                              #
################################################################
function ns_doc_questions() {
    global $legalconfig, $module_name;
  if ((is_active('Feedback')) && $legalconfig['legal_questions'] == 2) {
        echo _NSFEEDBACK;
    } else if ((is_active('Contact')) && $legalconfig['legal_questions'] == 1) {
        echo ""._NSCONTACT."";
    } else if ($legalconfig['legal_questions'] == 0) {
        echo "<br /><br />";
    }
}

function ns_doc_links() {
    global $legalconfig, $module_name;
    echo "<center>";
    if ($legalconfig['legal_aboutus'] == 1) {
         echo "[ <a href=\"modules.php?name=$module_name&amp;op=about\">"._NSABOUTUS."</a> ]";
  }
    if ($legalconfig['legal_aboutus'] == 1 && $legalconfig['legal_disclaimer'] == 1) {
         echo " - ";
    }
    if ($legalconfig['legal_disclaimer'] == 1) {
         echo "[ <a href=\"modules.php?name=$module_name&amp;op=disclaimer\">"._NSDISCLAIMER."</a> ]";
    }
    if ($legalconfig['legal_disclaimer'] == 1 && $legalconfig['legal_privacy'] == 1) {
         echo " - ";
    }
    if ($legalconfig['legal_privacy'] == 1) {
         echo "[ <a href=\"modules.php?name=$module_name&amp;op=privacy\">"._NSPRIVACY."</a> ]";
    }
    if (($legalconfig['legal_privacy'] == 1 || $legalconfig['legal_aboutus'] == 1 || $legalconfig['legal_disclaimer'] ==1) AND ($legalconfig['legal_terms'] == 1)) {
         echo " - ";
    }
    if ($legalconfig['legal_terms'] == 1) {
         echo "[ <a href=\"modules.php?name=$module_name&amp;op=terms\">"._NSTERMS."</a> ]";
    }
         echo "</center>";
         echo "<br /><br />";
}

?>