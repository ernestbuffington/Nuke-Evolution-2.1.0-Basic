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


define('CACHE_OFF', 0);
define('FILE_CACHE', 1);
define('SQL_CACHE', 2);
//Must be in seconds (default = 1 week)
define('TTL', 604800);

class cache {

    var $changed = false;
    var $saved = array();
    var $valid = false;
    var $type = CACHE_OFF;
    var $ttl = 0;

    // constructor
    function cache($use_cache) {
        $this->type = $use_cache;
        $this->valid = ($this->type == FILE_CACHE && is_writable(NUKE_CACHE_DIR.'cache.php') || $this->type == SQL_CACHE ) ? true :  false;
        if($this->type == FILE_CACHE) {
            if(@file_exists(NUKE_CACHE_DIR . 'cache.php')) {
                include(NUKE_CACHE_DIR . 'cache.php');
                global $saved_cache, $ttl;
                //If ttl has expired
                if ($ttl < time()) {
                    $this->ttl = 0;
                    $this->clear();
                } else {
                    $this->ttl = $ttl;
                    $this->saved = $saved_cache;
                }
                unset($saved_cache);
            } else {
                if (!$file_mode) {
                    $file_mode = 0666; 
                }
                $contents = '<?php
if (realpath(__FILE__) == realpath($_SERVER[\'SCRIPT_FILENAME\'])) {
    exit(\'Access Denied\');
}

global $ttl;
$ttl = 1220476040;

global $saved_cache;

$saved_cache = array(
);

?>';
                $filename = NUKE_CACHE_DIR . 'cache.php';
                if ($handle = @fopen($filename, 'w')) {
                    if ( @fwrite($handle, $contents)) {
                        @fclose($handle);
                        @chmod($filename, $file_mode);
                        $this->valid = true;
                    } else {
                        $this->valid = false;
                    }
                } else {
                    $this->valid = false;
                }
            }
        } elseif($this->type == SQL_CACHE) {
            global $db;
            list($saved_cache) = $db->sql_ufetchrow("SELECT `cache_data` FROM " . _NUKE_CONFIG_TABLE." LIMIT 0,1");
            @eval($saved_cache);
            $this->saved = $saved_cache;
        }
    }

    function clear() {
        global $db;
        @unlink(NUKE_CACHE_DIR . 'cache.php');
        unset($this->saved);
        $db->sql_uquery("UPDATE " . _NUKE_CONFIG_TABLE . " SET `cache_data` = '\$saved_cache = array();'");
        $db->sql_uquery("UPDATE " . _EVOCONFIG_TABLE . " SET `evo_value` = '" . time() . "' WHERE `evo_field` = 'cache_last_cleared'");
        return true;
    }

    // This function counts the number of rows that are in the saved cache
    function count_rows($cat = '') {
        $count = 0;
        if(!empty($cat)) {
            $count = ($this->saved[$cat]) ? count($this->saved[$cat]) : 0;
        } else {
            if(is_array($this->saved)) {
                foreach($this->saved as $sub) {
                    $count += count($sub);
                }
            }
        }
        return $count;
    }

    // This function passes the variable $cache_changed, and then the function resync will handle it
    function save($name, $cat='config', $fileData) {
        if(!$this->valid) return false;
        if(!isset($fileData)) return false;
        if(empty($fileData)) return false;
        if($fileData == false) return false;
        $this->saved[$cat][$name] = $fileData;
        $this->changed = true;
        return true;
    }

    // This function loads a cache value
    function load($name, $cat='config') {
        if(!$this->valid) return false;
        return ((isset($this->saved[$cat][$name])) ? ((!empty($this->saved[$cat][$name])) ? $this->saved[$cat][$name] : false) : false);
    }

    // This function passes the variable $cache_changed, and then the function resync will handle it
    function delete($name, $cat='config') {
        $this->changed = true;
        if ($name && $cat) {
            if(isset($this->saved[$cat][$name])) unset($this->saved[$cat][$name]);
        } else {
            if(isset($this->saved[$cat])) unset($this->saved[$cat]);
        }
        return true;
    }

    //array_parse function taken from Dragonfly CMS
    function array_parse($array, $space='  ') {
        $return = '';
        if(is_array($array)) {
            foreach($array as $key => $value) {
                $key = !is_int($key) ? str_replace('\\', "\\\\", $key) : $key;
                $key = !is_int($key) ? str_replace("'", "\\'", $key) : $key;
                $key = is_int($key) ? $key : "'$key'";
                $return .= "$space$key => ";
                if (is_array($value)) {
                    $return .= "array(\n".$this->array_parse($value, "$space  ")."$space),\n";
                } else {
                    if (!is_int($value)) {
                        $value = str_replace('\\', "\\\\", trim($value));
                        $value = "'".str_replace("'", "\\'", $value)."'";
                    }
                    $return .= $value.",\n";
                }
            }
        }
        return $return;
    }

    //file_write function borrowed from Dragonfly CMS
    function file_write($filename, &$content, $mode='wb') {
        global $file_mode;
        if(!$this->valid) return false;
        if (file_exists($filename)) {
           if (!@is_writable($filename)) {
               if (!@chmod($filename, $file_mode)) {
                     die(sprintf(_CANNOTCHANGEMODE, $filename));
               }
               @touch($filename);
           }
        }
        if (!$fp = @fopen($filename, $mode)) {
            die(sprintf(_CANNOTOPENFILE, $filename));
        }
        @flock($fp, LOCK_EX);
        if (@fwrite($fp, $content) === false) {
            @flock($fp, LOCK_UN);
            die(sprintf(_CANNOTWRITETOFILE, $filename));
        }
        @flock($fp, LOCK_UN);
        if (!@fclose($fp)) {
            die(sprintf(_CANNOTCLOSEFILE, $filename));
        }
        $not_posix = (!function_exists('posix_getpwuid') || (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN'));
        $file_owner = (@getmyuid() != @fileowner($filename));
        if($file_owner || $not_posix) {
        @chmod($filename, $file_mode);
        }
        @touch($filename);
        return true;
    }

    // This function handles changes in the cache
    function resync() {
        if(!$this->valid) return false;
        if($this->changed) {
            if($this->type == FILE_CACHE) {
                $data = "<?php\nif(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }\n\n\n";
                $data .= "global \$ttl;\n";
                //Cache will only live for 1 week (Back ported from v3)
                if ($this->ttl == 0) {
                    $data .= '$ttl = '.(time() + TTL).";\n";
                } else {
                    $data .= '$ttl = '.$this->ttl.";\n";
                }
                $data .= "\nglobal \$saved_cache;\n\n\$saved_cache = array(\n".$this->array_parse($this->saved).");\n\n?>";
                $this->file_write(NUKE_CACHE_DIR . 'cache.php', $data);
            } elseif ($this->type == SQL_CACHE) {
                global $db;
                $data = addslashes("\$saved_cache = array(\n".$this->array_parse($this->saved).");");
                $db->sql_uquery("UPDATE " . _NUKE_CONFIG_TABLE . " SET `cache_data` = '" . $data . "'");
            }
        }
        $this->changed = false;
        return true;
    }
}

global $use_cache;
// Set up the cache class reference
$cache = new cache($use_cache);

?>