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

if (!defined('IN_PHPBB')) {
    die('Hacking attempt');
}

//
// Show the overall footer.
//
global $admin_file, $cache, $gen_simple_header, $gen_simple_footer;

// $gen_simple_footer means, that we do not need ANY Output of Variables ... only generate Footer
$gen_simple_footer = ((!empty($gen_simple_footer) && $gen_simple_footer == TRUE) ? TRUE : FALSE );

include_once(NUKE_INCLUDE_DIR . 'functions_report.php');


if ( is_admin() && !$gen_simple_footer) {
    $admin_link = '<a href="'.$admin_file.'.php?op=forums">' . $lang['Admin_panel'] . '</a><br /><br />';
    $open_reports = reports_count();
    if ( $open_reports == 0 ) {
        $open_reports = sprintf($lang['Post_reports_none_cp'],$open_reports);
    } else {
        $open_reports = sprintf(( ($open_reports == 1) ? $lang['Post_reports_one_cp'] : $lang['Post_reports_many_cp']), $open_reports);
        $open_reports = '<strong>' . $open_reports . '</strong>';
    }
    $report_link = '&nbsp; <a href="' . append_sid('viewpost_reports.php') . '">' . $open_reports . '</a> &nbsp;';
} else {
    $report_link = '';
    $admin_ling  = '';
}

$template->set_filenames(array(
    'overall_footer'    => ( $gen_simple_footer ? 'overall_footer.tpl' : 'simple_footer.tpl'))
);

if($gen_simple_footer) {
    $template->pparse('overall_footer');
    CloseTable();
} else {
    if ($gen_simple_header) {
        $template->pparse('overall_footer');
   } else {
        $template->assign_vars(array(
            'TRANSLATION_INFO'  => (isset($lang['TRANSLATION_INFO'])) ? $lang['TRANSLATION_INFO'] : ((isset($lang['TRANSLATION'])) ? $lang['TRANSLATION'] : ''),
            'REPORT_LINK'       => $report_link,
            'ADMIN_LINK'        => $admin_link)
        );    $template->pparse('overall_footer');
    }    
    CloseTable();
    include_once(NUKE_BASE_DIR . 'footer.php');
}

?>