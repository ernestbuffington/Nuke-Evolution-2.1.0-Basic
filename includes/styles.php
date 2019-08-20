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

function include_stylesheet($dirfile, $addition='') {
    static $cssfiles;
    
    if (!is_array($cssfiles)) {
        $cssfiles = array();
    }
    if (!isset($cssfile[$dirfile]) && !empty($dirfile)) {
        echo '<link rel="stylesheet" type="text/css" href="'.$dirfile.'" />';
    }
    return;
}

echo "<style type='text/css'>";
if (defined('ADMIN_FILE')) {

    echo "#l {
        width: 200px;
        float: left;
        margin-left: 5px;
    }";
    echo "#c {
        width: 200px;
        float: left;
        margin-left: 5px;
    }";
    echo "#d {
        width: 200px;
        float: left;
        margin-left: 5px;
    }";
    echo "#r {
        width: 200px;
        float: left;
        margin-left: 5px;
    }";
    echo "#new {
        width: 200px;
        margin-left: 5px;
    }";
    echo "div.menu {
        list-style-type: none;
        position: relative;
        padding: 4px 4px 0 4px;
        margin: 0px;
        width: 200px;
        font-size: 13px;
        font-family: Arial, sans-serif;
        border: 1px solid #ccc;
    }";
    echo "ul.sortable li {
        position: relative;
    }";
    echo "ul.boxy {
        list-style-type: none;
        padding: 4px 4px 0 4px;
        margin: 0px;
        width: 10em;
        font-size: 13px;
        font-family: Arial, sans-serif;
        border: 1px solid #ccc;
        }";
    echo "li.active {
        cursor:move;
        margin-bottom: 4px;
        padding: 2px 2px;
        border: 1px solid #ccc;
    }";
    echo "li.inactive {
        cursor:move;
        margin-bottom: 4px;
        padding: 2px;
        border: 1px solid #ccc;
        background-color: #FF6C6C;
    }";
    echo "ul.boxy li {
      cursor:move;
      margin-bottom: 4px;
      padding: 2px 2px;
      border: 1px solid #ccc;
    }";
    echo "#left_col {
        width: 180px;
        float: left;
        margin-left: 5px;
    }";
    echo "#center {
        width: 180px;
        float: left;
        margin-left: 5px;
    }";
    echo "#right_col {
        width: 180px;
        float: left;
        margin-left: 5px;
    }";
    echo "#sajax1 {
        width: 180px;
        float: left;
        margin-left: 5px;
    }";
    echo "#sajax2 {
        width: 180px;
        float: left;
        margin-left: 5px;
    }";
}
echo ".textbold {
    font-weight: bold;
}";
echo ".texterror {
    font-weight: bold;
    color: #FF0000;
    font-size: large;
}";
echo ".texterrorcenter {
    font-weight: bold;
    color: #FF0000;
    text-align: center;
    font-size: large;
}";
echo ".nuketitle {
    font-weight: bold;
    text-align: center;
    font-size: x-large;
}";
echo ".switchcontent{
    border-top-width: 0;
}";
echo ".switchclosecontent{
    border-top-width: 0;
    display: none;
}";
echo ".dl_td{
	height:24px;
}";

echo "</style>";

global $evoconfig;
$tooltips_css = $evoconfig['tooltips'];

include_stylesheet(NUKE_INCLUDE_HREF_DIR.'javascript/jscroller2.css');
include_stylesheet(NUKE_INCLUDE_HREF_DIR.'javascript/sexyscript/sexyalertbox.css');
include_stylesheet(NUKE_INCLUDE_HREF_DIR.'javascript/sexyscript/sexytooltips/'.$tooltips_css);
include_stylesheet(NUKE_INCLUDE_HREF_DIR.'javascript/rotator/rotator.css');

global $more_styles;
if (isset($more_styles) && !empty($more_styles)) {
    if (is_array($more_styles)) {
        foreach ($more_styles as $key => $js_file) {
            if (@file_exists($js_file)) {
                include_stylesheet($js_file);
            }
        }
    } else {
        echo $more_styles;
    }
}

?>