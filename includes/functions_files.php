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

 Copyright (c) 2008 by The Nuke Evolution Development Team
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

# EvoKernel_FileInfo
# centralized function to get systeminformations about a file or directory
# Parameters:
# - file = file or directory
# Return:
# Array:
# - owner  = owner of the file
# - group  = group of the file
# - is_owner = TRUE/FALSE if process owner is file owner
# - is_group = TRUE/FALSE if process group is file group
# - writeable = TRUE/FALSE if file is within the actual process writeable
# - is_executable = TRUE/FALSE if file is within the actual process executable
# - is_readable   = TRUE/FALSE if file is within the actual process readable
# - is_dir        = TRUE/FALSE if parameter given is a directory or not
# - is_file       = TRUE/FALSE if parameter given is a file or not
# - exists        = TRUE/FALSE if file/directory exists
# Note: if a file/directory is neiter a directory nor a file it could be a symbolic link or a pipe

function EvoKernel_FileInfo($file) {
    if (function_exists('posix_getuid')) {
        $ben_uid   = @posix_getuid();
        $ben_gid   = @posix_getgid();
        $ben_uinfo = @posix_getpwuid(intval($ben_uid));
        $ben_ginfo = @posix_getgrgid(intval($ben_gid));
        $datei['run_user']  = $ben_uinfo['name'];
        $datei['run_group'] = $ben_ginfo['name'];
    } else {
        $ben_uid = @getmyuid();
        $ben_gid = @getmygid();
        $ben_uinfo = @get_current_user();
        $datei['run_user']  = $ben_uinfo['name'];
    }
    $datei['file']      = @realpath($file);
    if (file_exists($datei['file'])) {
        $datei['exists']= TRUE;
        $datei_owner = fileowner($datei['file']);
        $datei_group = filegroup($datei['file']);
        if (function_exists('posix_getuid')) {
            $datei_owner1= posix_getpwuid(intval($datei_owner));
            $datei_group1= posix_getgrgid(intval($datei_group));
            $datei['is_owner']   = (($ben_uid == $datei_owner) ? TRUE : FALSE);
            $datei['is_group']   = (($ben_gid == $datei_group) ? TRUE : FALSE);
        } else {
            $datei['is_owner']   = (($ben_uid == $datei_owner) ? TRUE : FALSE);
            $datei['is_group']   = (($ben_gid == $datei_group) ? TRUE : FALSE);
        }
        $datei['owner']      = $datei_owner;
        $datei['group']      = $datei_group;
        $datei['writeable']  = (is_writeable($datei['file']) ? TRUE : FALSE);
        $datei['executable'] = (is_executable($datei['file']) ? TRUE : FALSE);
        $datei['readable']   = (is_readable($datei['file']) ? TRUE : FALSE);
        $datei['is_dir']     = (is_dir($datei['file']) ? TRUE : FALSE);
        $datei['is_file']    = (is_file($datei['file']) ? TRUE : FALSE);
    } else {
        $datei['exists']= FALSE;
    }
    return $datei;
}


# EvoKernel_FileChmod
# centralized function for changing permissions of files or directories
# if "normal" chmod isn't possible, we fall back to ftp chmod (if allowed)
# Parameters:
# - file = file or directory
# - mode = permission to set (Unix-Mode octal)
function EvoKernel_Chmod($file='', $mode='') {
    global $evoconfig;

    if (empty($file)) {
        return FALSE;
    } else {
        $filedata = EvoKernel_Fileinfo($file);
    }
    if (!$filedata['exists']) {
        return FALSE;
    } else {
        if (empty($mode)) {
            if ($filedata['is_dir']) {
                $mode = $evoconfig['directory_mode'];
            } else {
                $mode = $evoconfig['file_mode'];
            }
        } else {
            if (strlen($mode) < 3 || strlen($mode) > 4) {
                $mode = ($filedata['is_dir'] ? $evoconfig['directory_mode'] : $evoconfig['file_mode']);
            }
        }
    }
    if ( @chmod($file, intval($filefields['mode'],8))) {
        return TRUE;
    } else {
        if (empty($evoconfig['ftppath'])) {
            $ftppath = '/';
        } elseif (substr($evoconfig['ftppath'], -1) != '/') {
            $ftppath = $evoconfig['ftppath'].'/';
        }
        if (substr($evoconfig['ftppath'], 0, 1) != '/') {
            $ftppath = '/'.$ftppath;
        }
        if (empty($evoconfig['ftpport'])) {
            $evoconfig['ftpport'] = 21;
        }
        $connect = @ftp_connect($evoconfig['ftphost'], $evoconfig['ftpport']);
        if ($connect) {
            if (@ftp_login($connect, $evoconfig['ftpuser'], $evoconfig['ftppwd'])) {
                if (@ftp_chmod($connect, intval($mode, 8), $ftppath.$file)) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        } else {
            return FALSE;
        }
    }
}


# EvoKernel_FtpCheck
# centralized function to check if FTP settings are ok
# Parameters:
# - ftphost = IP-Address or Domainname of the FTP Host
# - ftpport = Port where the ftp service on the Server is waiting for connections (normally 21)
# - ftppath = Path from connection entry on FTP Server to the root filedirectory of the website
# - ftpuser = FTP Username for connection
# - ftppwd  = FTP Password for the user
# - ftpdir  = dir where to change to (including path from ftppath on) where to test if connection could be established
function EvoKernel_FtpCheck ($ftphost='', $ftpport='', $ftppath='', $ftpuser='', $ftppwd='', $ftpdir='') {
    global $evoconfig;

    $ftphost = (empty($ftphost) ? $evoconfig['ftphost'] : $ftphost);
    $ftpport = (empty($ftpport) ? $evoconfig['ftpport'] : $ftpport);
    $ftppath = (empty($ftpath)  ? $evoconfig['ftppath'] : $ftppath);
    $ftpuser = (empty($ftpuser) ? $evoconfig['ftpuser'] : $ftpuser);
    $ftppwd  = (empty($ftppwd)  ? $evoconfig['ftppwd']  : $ftppwd);

    $connect = @ftp_connect($ftphost, $ftpport);
    if ($connect) {
        if (@ftp_login($connect, $ftpuser, $ftppwd)) {
            if (@ftp_chdir($connect, $ftppath)) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    } else {
        return FALSE;
    }
}

# EvoKernel_CreateDir
# centralized function for directory creation
# if "normal" mkdir isn't possible, we fall back to ftp mkdir (if allowed)
# Parameters:
# - dir  = directory to create; recursive building of directory structure is possible
# - mode = permission of the directory; if not set, we take default value
function EvoKernel_CreateDir ($dir='', $mode='') {
    global $evoconfig;

    if (empty($dir)) {
        return FALSE;
    }
    if (empty($mode)) {
        $mode = $evoconfig['directory_mode'];
    }

    # kind thanks for this codepiece to GelaMu(at)GMail(dot)com from php.net
    # enhanced to use ftp if mkdir isn't allowed
    if (!function_exists('rmkdir')) {
        function rmkdir($path, $mode) {
            $path = rtrim(preg_replace(array("/\\\\/", "/\/{2,}/"), "/", $path), "/");
            $e = explode("/", ltrim($path, "/"));
            if(substr($path, 0, 1) == "/") {
                $e[0] = "/".$e[0];
            }
            $c = count($e);
            $cp = $e[0];
            for($i = 1; $i < $c; $i++) {
                if(!is_dir($cp) && !rmkdircreate($cp, $mode)) {
                    return FALSE;
                }
                $cp .= "/".$e[$i];
            }
            return rmkdircreate($cp, $mode);
        }
    }

    if (!function_exists('rmkdircreate')) {
        function rmkdircreate($cp, $mode) {
            global $evoconfig;
        
            if (!is_dir($cp) && !@mkdir($cp, intval($mode, 8))) {
                if ($evoconfig['ftpchecked']) {
                    $connect = @ftp_connect($evoconfig['ftphost'], $evoconfig['ftpport']);
                    if ($connect) {
                        if (@ftp_login($connect, $evoconfig['ftpuser'], $evoconfig['ftppwd'])) {
                            if (@ftp_mkdir($connect, $cp)) {
                                @ftp_chmod($connect, intval($mode, 8), $cp);
                                return TRUE;
                            } else {
                                return FALSE;
                            }
                        } else {
                            return FALSE;
                        }
                    } else {
                        return FALSE;
                    }
                } else {
                    return FALSE;
                }
            } elseif (is_dir($cp)) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
    return rmkdir($dir, $mode);
}
?>