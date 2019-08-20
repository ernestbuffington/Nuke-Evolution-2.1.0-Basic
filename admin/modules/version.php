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

if (!defined('ADMIN_FILE')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

$adminpoint = @basename(__FILE__,'.php');
global $admin_file, $db, $adminpoint, $_GETVAR, $lang_admin;

if (is_god_admin() || is_admin('super')) {
    getmodule_lang($adminpoint);

    define('CUR_EVO', strtolower(EVO_EDITION));

    function evo_check_version() {
    $ver = evo_get_version();
    return (NUKE_EVO == $ver) ? 0 : 1;
}

    function curlfile($url) {
        $ch = curl_init($url);
        $fp = @fopen(NUKE_CACHE_DIR.'version-tmp.txt', 'w');
        @curl_setopt($ch, CURLOPT_FILE, $fp);
        @curl_setopt($ch, CURLOPT_HEADER, 0);
        @curl_exec($ch);
        curl_close($ch);
        fclose($fp);
        return NUKE_CACHE_DIR.'version-tmp.txt';
    }

    function evo_get_version() {
        $ret = evo_version_check(false);
        if ($ret == '=') return NUKE_EVO;
        if ($ret == '>') return EVO_UPGRADE;
        return false;
    }

    function evo_version_check($display=true) {
        global $admin_file, $evoconfig, $db, $cache, $lang_admin;

        $errno = 0;
        $errstr = $version_info = '';
        $url = 'http://www.evo-german.com/updatecheck/version_'.strtolower(EVO_EDITION).'.xml';
        $Version_Check = intval($evoconfig["ver_check"]);

        if(!$Version_Check || $Version_Check >= strtotime("+1 day", $Version_Check)) {
            //if($Version_Check || $Version_Check >= strtotime("+1 day", $Version_Check)) {
            $sql_ver = "UPDATE "._EVOCONFIG_TABLE." SET evo_value = '" . time()."' WHERE evo_field='ver_check'";
            $db->sql_uquery($sql_ver);
            $cache->delete('evoconfig');
            if (evo_site_up($url)) {
                if ($fsock = @fsockopen('www.evo-german.com', 80, $errno, $errstr, 10)) {
                    @fputs($fsock, "GET /updatecheck/version_".strtolower(EVO_EDITION).".xml HTTP/1.1\r\n");
                    @fputs($fsock, "HOST: www.evo-german.com\r\n");
                    @fputs($fsock, "Connection: close\r\n\r\n");

                    $get_info = false;
                    while (!feof($fsock)) {
                        if ($get_info) {
                            $version_info .= fread($fsock, 1024);
                        } else {
                            if (fgets($fsock, 1024) == "\r\n") {
                                $get_info = true;
                            }
                        }
                    }
                    @fclose($fsock);
                    if (!empty($version_info)) {
                        //Create XML parser
                        $xml_parser = xml_parser_create('UTF-8');
                        //Parse into array
                        xml_parse_into_struct($xml_parser, $version_info, $vals, $index);
                        //Clean up
                        xml_parser_free($xml_parser);
                        $version_info = XMLsplit($vals);
                        if (isset($version_info['BASIC']['MAJOR_VERSION'])) {
                            if (version_compare($version_info['BASIC']['MAJOR_VERSION'], NUKE_EVO, '=')) {
                                if ($display) {
                                    evo_version_display('=');
                                }
                                return '=';
                            } else {
                                if ($display) {
                                    evo_version_display('>', $version_info['BAISC']['MAJOR_VERSION']);
                                }
                                define('EVO_UPGRADE', $version_info['BASIC']['MAJOR_VERSION']);
                                return '>';
                            }
                        } else {
                            if ($display) {
                                evo_version_display('sock', '', $errstr);
                            }
                            return 'sock';
                        }
                    } else {
                        if ($display) {
                            evo_version_display('sock', '', $errstr);
                        }
                        return 'sock';
                    }
                } else {
                    if ($errstr) {
                        if ($display) {
                            evo_version_display('sock', '', $errstr);
                        }
                        return 'sock';
                    } else {
                        if ($display) {
                            evo_version_display('error');
                        }
                        return 'error';
                    }
                }
            } else {
                if ($errstr) {
                    if ($display) {
                        evo_version_display('sock', '', $errstr);
                    }
                    return 'sock';
                } else {
                    if ($display) {
                        evo_version_display('error');
                    }
                    return 'error';
                }
            }
        } else {
            if ($display) {
                evo_version_display('=');
            }
                if ($display) {
                    echo '<p style="color:blue; text-align:center">'.$lang_admin['KERNEL']['INFO_ADMIN_LOG_CHECKED'].' '.date('Y-m-d', $Version_Check).' @'.date('H:i', $Version_Check).'</p>';
                }
                return '=';
        }
    }

    function evo_version_display($check, $version='', $error='') {
        global $admin_file, $lang_admin, $adminpoint;
        echo '<p  style="color:black; text-align:center">'.NUKE_EVO.'&nbsp;'.EVO_EDITION.'&nbsp;Build:'.EVO_BUILD.'</p>';
        if (empty($check)) {
            echo '';
        } else if ($check == 'error') {
            echo '<p  style="color:red; text-align:center">' . $lang_admin[$adminpoint]['VERSIONCTL_VERSIONFUNCTIONSDISABLED'] . '</p>';
        } else if ($check == 'sock') {
            echo '<p  style="color:red; text-align:center">' . sprintf($lang_admin[$adminpoint]['VERSIONCTL_VERSIONSOCKETERROR'], $error) . '</p>';
        } else if ($check == '>') {
            echo '<p  style="color:red; text-align:center">' . $lang_admin[$adminpoint]['VERSIONCTL_VERSIONOUTOFDATE'];
            echo '<br />' . sprintf($lang_admin[$adminpoint]['VERSIONCTL_VERSIONLATESTINFO'], $version) . ' ' . sprintf($lang_admin[$adminpoint]['VERSIONCTL_VERSIONCURRENTINFO'], NUKE_EVO) . '</p><form action="'.$admin_file.'.php?op=version" method="post"><input type="submit" value="'.$lang_admin[$adminpoint]['ADMIN_VER_VIEW'].'" /></form>';
        } else if ($check == '=') {
            echo '<p  style="color:green; text-align:center">' . $lang_admin[$adminpoint]['VERSIONCTL_VERSIONUP2DATE'] . '</p><a href="'.$admin_file.'.php?op=version">'.$lang_admin[$adminpoint]['VERSIONCTL_CHECKVER'].'</a>';
        }
    }

    function evo_compare() {
        global $db, $cache, $adminpoint, $lang_admin;

        $check = evo_check_version();
        if($check == 0) {
            $sql_ver = "UPDATE "._EVOCONFIG_TABLE." SET evo_value = '0' WHERE evo_field='ver_previous'";
            $db->sql_query($sql_ver);
            $cache->delete('evoconfig');
            return "<strong><span style='color:green'>".$lang_admin[$adminpoint]['VERSIONCTL_VERSIONUP2DATE']."</span></strong>";
        }
        $current = NUKE_EVO;
        $s = strpos($log_raw,$current);
        if(!$s) {
            return -1;
        }
        return $log_evo;
    }

    function evo_changelog() {
        $data = @file(curlfile('http://www.evo-german.com/updatecheck/changelog_'.CUR_EVO.'.txt'));
        $log_evo = "<table width='100%'>";
        $names = array(
                "TECHNOCRAT" => "Technocrat",
                "JEFFB68CAM" => "JeFFb68CAM",
                "REVOLUTION" => "Revolution",
                "QUAKE" => "Quake",
                "KREAGON" => "Kreagon",
                "DANUK" => "DanUK",
                "LTABDIEL" => "Ltabdiel",
                "JELLE" => "Jelle",
                "RODMAR" => "Rodmar",
                "PLATINUMTHEMES" => "PlatinumThemes",
                "DIEDIEDIE" => "Diediedie",
                "TULISAN" => "Tulisan",
                "REORGANISATION" => "ReOrGaNiSaTiOn",
                "ROTTNKORPSE" => "RottNKorpse"
            );
        for($i=0, $maxi=count($data);$i<$maxi;$i++) {
            $line = $data[$i];
            if(stristr($line, " - [")) {
                $log_evo .= "<tr><td style='text-indent: 15pt;'>";
                $log_evo .= $line;
                $log_evo .= "</td></tr>";
            } else {
                $line = trim($line);
                $line = isset($names[strtoupper($line)]) ? "<span style='font-weight:bold;'><u>" . $names[strtoupper($line)] . "</u></span>" : $line;
                $log_evo .= "<tr><td>";
                $log_evo .= $line;
                $log_evo .= "</td></tr>";
            }
        }
        $log_evo .= "</table>";
        return $log_evo;
    }

    function evo_get_download() {
        global $evo;

        if (evo_site_up('http://www.evo-german.com')) {
            return false;
        }
        $contents = @file_get_contents(curlfile('http://www.evo-german.com/updatecheck/download_'.CUR_EVO.'.txt'));
        if(substr($contents,strlen($contents)-1) == "\n") {
            $contents = substr($contents,0,strlen($contents)-1);
        }
        return $contents;
    }

    function evo_version() {
        global $db, $admin_file, $adminpoint, $lang_admin;

        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div style='text-aling:center;'>";
        echo "<span class=\"title\" style='font-weight:bold;'>".$lang_admin[$adminpoint]['VERSIONCTL_TITLE']."</span><br /><br />";
        $ret_ver = evo_get_version();
        if(!empty($ret_ver)) {
            echo "<span style='color:red; font-weight:bold;'>".$lang_admin[$adminpoint]['VERSIONCTL_ERR_CON']."</span>";
        } else {
            echo "<span style='color:blue; font-weight:bold;'>".$lang_admin[$adminpoint]['VERSIONCTL_VER']."</span>&nbsp;".$ret_ver." ".EVO_EDITION."<br /><span style='color:blue; font-weight:bold;'>".$lang_admin[$adminpoint]['VERSIONCTL_YOURVER']."</span> ".EVO_VERSION."<br />";
            $log_evo = evo_changelog();
            if($download = evo_get_download()) {
                $log_evo = "<span style='font-weight:bold;'><a href='".$download."'>".$lang_admin[$adminpoint]['VERSIONCTL_Download']."&nbsp;v".$ret_ver."</a></span><br /><br />". $log_evo;
                $log_evo .= "<br /><br /><span style='font-weight:bold;'><a href='".$download."'>".$lang_admin[$adminpoint]['VERSIONCTL_Download']."&nbsp;v".$ret_ver."</a></span>";
            }
            echo $log_evo;
        }
        echo "<br /><br /><span style='font-weight:bold;'><a href='".$admin_file.".php'>".$lang_admin[$adminpoint]['VERSIONCTL_BACK']."</a></span>";
        echo "</div>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    switch ($op) {
        case 'version':
            evo_version();
            break;
    }
} else {
    DisplayError('<strong>' . $lang_admin['KERNEL']['ERROR'] . '</strong><br /><br />' . $lang_admin['KERNEL']['NO_ADMIN_RIGHTS'] . '<strong>' . $op . '</strong>');
}

?>