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


//Note due to all the windows.onload use womAdd('function_name()'); instead

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }

global $evoconfig;

function include_javascript($dirfile, $addition='') {
    echo "<script ".$addition." type='text/javascript'>\n";
    echo "/*<![CDATA[*/\n";
    include_once($dirfile);
    echo "\n/*]]>*/\n";
    echo "</script>\n\n";
    return;
}

include_javascript(NUKE_INCLUDE_DIR.'ajax/ajax.js');
include_javascript(NUKE_INCLUDE_DIR.'onload.js');

/***************************************************************************
 *   Include for some common javascripts functions
 ***************************************************************************/

include_javascript(NUKE_INCLUDE_DIR.'overlib.js');
include_javascript(NUKE_INCLUDE_DIR.'overlib_hideform.js');
include_javascript(NUKE_INCLUDE_DIR.'javascript/jquery.min.js');
include_javascript(NUKE_INCLUDE_DIR .'slimbox/slimbox.js');
include_javascript(NUKE_INCLUDE_DIR.'javascript/jquery.easing.1.3.js');
include_javascript(NUKE_INCLUDE_DIR.'javascript/sexyscript/sexyalertbox.v1.2.jquery.js');
include_javascript(NUKE_INCLUDE_DIR.'javascript/jscroller2.js');
include_javascript(NUKE_INCLUDE_DIR.'javascript/rotator/jquery-ui-personalized-1.5.3.packed.js');
echo "<script type=\"text/javascript\">
	$(document).ready(function(){
		$(\"#rotator > ul\").tabs({fx:{opacity: \"toggle\"}}).tabs(\"rotate\", 10000, true);
	});
</script>";
/*--FNA--*/

if (isset($userpage)) {
    echo "<script type=\"text/javascript\">\n";
    echo "/*<![CDATA[*/\n";
    echo "function showimage() {\n";
    echo "    if (!document.images)\n";
    echo "    return\n";
    echo "    document.images.avatar.src=\n";
    echo "    '".EVO_SERVER_URL."/images/avatars/gallery/' + document.Register.user_avatar.options[document.Register.user_avatar.selectedIndex].value\n";
    echo "}\n";
    echo "\n/*]]>*/\n";
    echo "</script>\n\n";
}

global $name;

if (defined('MODULE_FILE') && !defined('HOME_FILE') AND file_exists(NUKE_MODULES_DIR.$name.'/copyright.php')) {
    echo "<script type=\"text/javascript\">\n";
    echo "/*<![CDATA[*/\n";
    echo "function openwindow() {\n";
    echo "    window.open (\"modules/".$name."/copyright.php\",\"Copyright\",\"toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width=400,height=200\");\n";
    echo "}\n";
    echo "\n/*]]>*/\n";
    echo "</script>\n\n";
}


if (!defined('ADMIN_FILE')) {
    include_javascript(NUKE_INCLUDE_DIR.'anti-spam.js');
}

$arcade_on = (isset($_GET['file']) && $_GET['file'] == 'arcade_games') ? true : (isset($_POST['file']) && $_POST['file'] == 'arcade_games') ? true : false;
if (!$arcade_on) {
    $arcade_on = (isset($_GET['do']) && $_GET['do'] == 'newscore') ? true : (isset($_POST['do']) && $_POST['do'] == 'newscore') ? true : false;
}

 global $admin_file;
 if(isset($name) && ($name == 'Your Account' || $name == 'Your_Account' || $name == 'Profile') || defined('ADMIN_FILE') ) {
     echo '<script type="text/javascript">
    var pwd_strong = "'.PSM_STRONG.'";
    var pwd_stronger = "'.PSM_STRONGER.'";
    var pwd_strongest = "'.PSM_STRONGEST.'";
    var pwd_notrated = "'.PSM_NOTRATED.'";
    var pwd_med = "'.PSM_MED.'";
    var pwd_weak = "'.PSM_WEAK.'";
    var pwd_strength = "'.PSM_CURRENTSTRENGTH.'";
</script>';
    include_javascript(NUKE_INCLUDE_DIR .'password_strength.js');
 }

if (defined('ADMIN_FILE')) {
    echo "<script type=\"text/javascript\">\n";
    echo "/*<![CDATA[*/\n";
    echo "function themepreview(theme){\n";
    echo "    window.open (\"index.php?adminpreview=1&tpreview=admintpreview&admintpreview=\" + theme + \"\",\"ThemePreview\",\"toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width=1000,height=800\");\n";
    echo "}\n";
    echo "\n/*]]>*/\n";
    echo "</script>\n\n";
}

if (defined('ADMIN_FILE') && defined('USE_DRAG_DROP')) {
    global $element_ids, $Sajax;
    if(isset($Sajax) && is_object($Sajax)) {
        echo "<script type=\"text/javascript\">\n";
        echo "/*<![CDATA[*/\n";
        echo $Sajax->sajax_show_javascript();
        echo "\n/*]]>*/\n";
        echo "</script>\n\n";
    }
    $i = 0;
    $script_out = '';
    if(!is_array($element_ids)) $element_ids = array();
    foreach ($element_ids as $id) {
        if(!$i) {
            $script_out .= "var list = document.getElementById(\"".$id."\");\n";
            $i++;
        } else {
            $script_out .= "list = document.getElementById(\"".$id."\");\n";
        }
        global $g2;
        $script_out .= (!$g2) ? "DragDrop.makeListContainer( list, 'g1' );\n" : "DragDrop.makeListContainer( list, 'g2' );\n";
        $script_out .= "list.onDragOver = function() { this.style[\"background\"] = \"#EEF\"; };\n";
        $script_out .= "list.onDragOut = function() {this.style[\"background\"] = \"none\"; };\n\n\n";
        $script_out .= "list.onDragDrop = function() {onDrop(); };\n";
    }

    //echo "<link rel=\"stylesheet\" href=\"includes/ajax/lists.css\" type=\"text/css\" />";
    include_javascript(NUKE_INCLUDE_DIR .'ajax/coordinates.js');
    include_javascript(NUKE_INCLUDE_DIR .'ajax/drag.js');
    include_javascript(NUKE_INCLUDE_DIR .'ajax/dragdrop.js');
    echo "<script type=\"text/javascript\">";
    echo "/*<![CDATA[*/\n
function confirm(z)
{
    window.status = 'Sajax version updated';
}

function create_drag_drop() {";

    echo $script_out;

    echo "};

if (window.addEventListener)
    window.addEventListener(\"load\", create_drag_drop, false)
else if (window.attachEvent)
    window.attachEvent(\"onload\", create_drag_drop)
else if (document.getElementById)
    womAdd('create_drag_drop()');";
    echo "\n/*]]>*/\n";
    echo "</script>\n\n";
}

global $plus_minus_images;

echo "<script type=\"text/javascript\">
    var enablepersist=\"on\" //Enable saving state of content structure using session cookies? (on/off)
    var memoryduration=\"7\" //persistence in # of days
    var contractsymbol='".$plus_minus_images['minus']."' //Path to image to represent contract state.
    var expandsymbol='".$plus_minus_images['plus']."' //Path to image to represent expand state.
</script>\n";
include_javascript(NUKE_INCLUDE_DIR . 'collapse_blocks.js');

global $agent;
if (!$evoconfig['lazy_tap'] && $agent['engine'] != 'bot') {
    include_javascript(NUKE_INCLUDE_DIR . 'page_loader.js');
} else {
    echo "<script defer=\"defer\" type=\"text/javascript\">function requestNewPage(url) { return true; }</script>\n";
}

if (!empty($evoconfig['analytics'])) {
    echo "<script type=\"text/javascript\">
            var gaJsHost = ((\"https:\" == document.location.protocol) ? \"https://ssl.\" : \"http://www.\");
            document.write(unescape(\"%3Cscript src='\" + gaJsHost + \"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E\"));
          </script>
          <script type=\"text/javascript\">
            try {
                var pageTracker = _gat._getTracker(\"".$evoconfig['analytics']."\");
                pageTracker._trackPageview();
            } catch(err) {}
          </script>\n\n";
}

/*--Shout Box--*/

global $more_js;
if (isset($more_js) && !empty($more_js)) {
    if (is_array($more_js)) {
        foreach ($more_js as $key => $js_file) {
            if (@file_exists($js_file)) {
                include_javascript($js_file);
            }
        }
    } else {
        echo $more_js;
    }
}

//DO NOT PUT ANYTHING AFTER THIS LINE
echo "<!--[if IE]><script type=\"text/javascript\">womOn();</script><![endif]-->";
?>