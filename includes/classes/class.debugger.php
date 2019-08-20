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


class error_handler {

    var $errors = array();
    var $debug = false;
    var $file;
    var $line;

    function error_handler($debug=false) {
        if (!is_bool($debug) && $debug == 'full') {
            if(is_admin()) {
                error_reporting(E_ALL); # report all errors
                ini_set("display_errors", "1");
            } else {
                error_reporting(E_ALL ^ E_NOTICE);
            }
            $this->debug = true;
        } else if ($debug) {
            $this->debug = $debug;
            error_reporting(E_ALL ^ E_NOTICE);
        } else {
            if(!is_admin()) {
                error_reporting(0);
            }
        }
    }

    function _backtrace()
    {
        $this->file = 'unknown';
        $this->line = 0;
        if (version_compare(PHPVERS, '4.3', '>=')) {
            $tmp = @debug_backtrace();
            $j = count($tmp);
            for ($i=0; $i<$j; ++$i) {
                if(basename($tmp[$i]['file']) != 'class.debugger.php') {
                    $this->file = $tmp[$i]['file'];
                    $this->line = $tmp[$i]['line'];
                    break;
                }
            }
        }
    }

    function handle_error($message, $type='Notice') {
        if ($this->debug) {
            $this->_backtrace();
            $error['message'] = $type.": ".$message." in ".$this->file." on line ".$this->line."<br />";
            $this->errors[] = $error;
        }
    }

    function return_errors() {
        $content = '';
        if($this->debug) {
            if(is_array($this->errors)) {
                foreach ($this->errors as $key => $value) {
                    $content .= "<tr><td align='center'>".$value['message']."</td></tr>";
                }
            }
        }
        return $content;
    }

}

$debugger = new error_handler($debug);

?>