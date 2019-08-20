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

if (!defined('MODULE_FILE') || !defined('DOWNLOADS_INDEX_FILE') ) {
   die('You can\'t access this file directly...');
}

global $_GETVAR;

$module_name = basename(dirname(__FILE__));
$license_id  = $_GETVAR->get('license_id', '_REQUEST', 'int', 0);

$licenseinfo = $db->sql_ufetchrow('SELECT `license_title`, `license_text`, `license_url` FROM `'._DOWNLOADS_LICENSES_TABLE.'`
                WHERE `license_id`="'.$license_id.'" LIMIT 1');

include_once(NUKE_INCLUDE_DIR.'page_header_review.php');
if ( !empty($licenseinfo['license_url']) ) {
    if (!evo_site_up($licenseinfo['license_url'])) {
        echo "Site not available";
    } else {
          if (false === $fh = @fopen($licenseinfo['license_url'], 'rb')) {
                echo "Page not available";
          }
          @clearstatcache();
          if ($fsize = @filesize($licenseinfo['license_url'])) {
              $data = @fread($fh, $fsize);
          } else {
              $data = '';
              while (!feof($fh)) {
                  $data .= fread($fh, 8192);
              }
          }
          fclose($fh);
          echo evo_img_tag_to_resize(check_words(set_smilies(decode_bbcode($data, 1, true))));
    }
} elseif ( !empty($licenseinfo['license_text']) ) {
    echo evo_img_tag_to_resize(check_words(set_smilies(decode_bbcode(stripslashes($licenseinfo['license_text']), 1, true))));
}

include_once(NUKE_INCLUDE_DIR.'page_tail_review.php');
?>