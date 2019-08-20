<?php
include_once(dirname(dirname(dirname((__FILE__)))).'/mainfile.php');
//global $downloadsconfig, $lang_new, $module_name;

$gfx_ajax_check = $_GETVAR->get('gfx_check', 'get', 'string');

if (!security_code_check($gfx_ajax_check, 'force')) { //&& $downloadsconfig['securitycheck'] == 1)
    echo 0;
//    DisplayError('<strong>'._ERROR.'</strong><br /><br />' .$lang_new[$module_name]['ERROR_SECURITYCODE']);
} else {
    echo 1;
}
?>
