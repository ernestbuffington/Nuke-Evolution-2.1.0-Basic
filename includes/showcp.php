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

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

function show_copyright($author_name = "", $author_user_email = "", $author_homepage = "", $based_on = "", $license = "", $download_location = "", $module_version = "", $module_description = "") {
    $image_dir = '/images/';
    if (empty($author_name)) { $author_name = "N/A"; }
    if (empty($author_user_email)) { $author_user_email = "N/A"; }
    if (!empty($author_homepage)) { $homepage = "<a href='$author_homepage' target='_blank'>Author's Homepage</a>"; } else { $homepage = "No Website Available"; }
    if (empty($based_on)) {$based_on = "N/A";}
    if (empty($license)) { $license = "N/A"; }
    if (!empty($download_location)) { $download = "<a href='$download_location' target='_blank'>Module's Download</a>"; } else { $download = "No Download Available"; }
    if (empty($module_version)) { $module_version = "N/A"; }
    if (empty($module_description)) { $module_description = "N/A"; }
    $module_name = basename(dirname($_SERVER['PHP_SELF']));
    $module_name = str_replace("_", " ", $module_name);
    echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n"
        ."<html>\n"
        ."<head>\n"
        ."<title>$module_name: Copyright Information</title>\n"
        ."<meta http-equiv='Content-Type' content='text/html; charset=UTF8' />\n"
        ."<style type='text/css'>\n"
        ."<!--";
    echo '
body {
    font-size: 10px;
    font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
    color: black;
    background: #D3D3D3;
}
a {
    font-size: 10px;
    font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
    color: black;
}
';
    echo "//-->\n"
        ."</style>\n"
        ."</head>\n"
        ."<body>\n"
        ."<center><strong>Module Copyright &copy; Information</strong><br />"
        ."$module_name module for <a href='http://www.evo-german.com' target='_blank'>EVO-CMS</a><br /><br /></center>\n"
        ."<img src='" . $image_dir ."arrow.png' border='0' alt='' />&nbsp;<strong>Module's Name:</strong> $module_name<br />\n"
        ."<img src='" . $image_dir ."arrow.png' border='0' alt='' />&nbsp;<strong>Module's Version:</strong> $module_version<br />\n"
        ."<img src='" . $image_dir ."arrow.png' border='0' alt='' />&nbsp;<strong>Module's Description:</strong> $module_description<br />\n"
        ."<img src='" . $image_dir ."arrow.png' border='0' alt='' />&nbsp;<strong>Module based on:</strong> $based_on<br />\n"
        ."<img src='" . $image_dir ."arrow.png' border='0' alt='' />&nbsp;<strong>License:</strong> $license<br />\n"
        ."<img src='" . $image_dir ."arrow.png' border='0' alt='' />&nbsp;<strong>Author's Name:</strong> $author_name<br />\n"
        ."<img src='" . $image_dir ."arrow.png' border='0' alt='' />&nbsp;<strong>Author's Email:</strong> $author_user_email<br /><br />\n"
        ."<center>[ $homepage | $download | <a href='#' onclick='javascript:self.close()'>Close</a> ]</center>\n"
        ."</body>\n"
        ."</html>";
}

?>