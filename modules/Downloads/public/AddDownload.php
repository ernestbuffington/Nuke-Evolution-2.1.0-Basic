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

global $module_name, $ThemeInfo, $downloads_config, $lang_new;

DownloadsHeading();

$eresult    = $db->sql_query("SELECT `ext`, `mimetype`, `description` FROM `". _DOWNLOADS_EXTENSIONS_TABLE ."` WHERE `active`='1' ORDER BY `ext` ASC");
$result1    = $db->sql_query("SELECT `cid`, `title`, `parentid`, `restricted_group_add` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `catactive`=1 AND `canupload`=1 ORDER BY `title`");
$lresult    = $db->sql_query("SELECT `license_id`, `license_title` FROM `"._DOWNLOADS_LICENSES_TABLE."` ORDER BY `license_title`");
$sql        = $db->sql_ufetchrow("SELECT `cid` FROM `"._DOWNLOADS_CATEGORIES_TABLE."` WHERE `catactive`=1 AND `canupload`=1 ");
$sql        = (!is_array($sql) ? 0 : 1);

$extens_list            = '';
$categories_selectable  = 0;
$cat_select             = '';

while ($row = $db->sql_fetchrow($eresult)) {
    $extens_list  .= $row['ext'].', ';
}

$extension_color    = "<span style='color:red;'>".DownloadsAllowedExtensions(TRUE)."</span>";
$file_size_color    = "<span style='color:red;'>".DownloadsMaxAllowedFileSize(TRUE)."</span>";
$max_size           = DownloadsMaxAllowedFileSize(FALSE);

echo "<script type='text/javascript'>
      /*<![CDATA[*/\n

window.onload = check_cat;

function check_cat(){
    if(".$sql." == '0') {
        Sexy.alert('".$lang_new[$module_name]['ERROR_NO_CAT']."', {onComplete: function(returnvalue) {if (returnvalue) {window.location.href= 'modules.php?name=Downloads';}}});
        return false;
    }
}

function validate(){
    var trueFalse = new String;
    
    if (document.addnewdownload.title.value == ''){
        document.addnewdownload.title.style.backgroundColor = '#FF6A6A';
        document.addnewdownload.title.focus();
        Sexy.alert('".convert_slashes($lang_new[$module_name]['HELP_ADD_TITLE'])."',{
            onComplete: function(returnvalue){
                if (returnvalue){
                    document.addnewdownload.title.focus();
                    document.addnewdownload.title.value = '';
                }
            }
        });
        return false;
    }

    if (document.addnewdownload.cat.value == '' || document.addnewdownload.cat.value == 0){
        document.addnewdownload.cat.style.backgroundColor = '#FF6A6A';
        document.addnewdownload.cat.focus();
        Sexy.alert('".convert_slashes($lang_new[$module_name]['HELP_SELECT_CAT'])."',{
            onComplete: function(returnvalue){
                if (returnvalue){
                    document.addnewdownload.cat.focus();
                }
            }
        });
        return false;
    };
    

    if (document.addnewdownload.uploadimage.value != ''){
        var extension   = new Array();
        var fieldvalue  = document.addnewdownload.uploadimage.value;
        fieldvalue      = fieldvalue.toLowerCase();
        extension[0]    = '.png';
        extension[1]    = '.gif';
        extension[2]    = '.jpg';
        extension[3]    = '.jpeg';
        extension[4]    = '.bmp';
        var thisext = fieldvalue.substr(fieldvalue.lastIndexOf('.'));
        for(var i = 0; i < extension.length; i++) {
            if(thisext == extension[i]) {
                var fileIn = true;
            }
        }
        
        if (!fileIn){
            document.addnewdownload.uploadimage.style.backgroundColor = '#FF6A6A';
            document.addnewdownload.uploadimage.focus();
            Sexy.alert('".convert_slashes($lang_new[$module_name]['HELP_IMAGE_VALID'])."');
            return false;
        }         
    }

    if (document.addnewdownload.uploadfile.value == '' && document.addnewdownload.download_url.value == ''){
        document.addnewdownload.uploadfile.style.backgroundColor = '#FF6A6A';
        document.addnewdownload.uploadfile.focus();
        document.addnewdownload.download_url.style.backgroundColor = '#FF6A6A';
        Sexy.alert('".convert_slashes($lang_new[$module_name]['HELP_FILE_TO_UPLOAD'])."');
        return false;
    } else {
        var fieldvalue  = document.addnewdownload.uploadfile.value;
        fieldvalue      = fieldvalue.toLowerCase();
        var ext         = '".$extens_list."';
        var extens      = new Array();
        var extens      = ext.split(', ');
        var thisext     = fieldvalue.substr(fieldvalue.lastIndexOf('.'));
        for(var i = 0; i < extens.length; i++) {
            if(thisext == extens[i]) { var fileIn = true; }
/*
                var node  = document.getElementById('uploadfile');
                var check = node.files[0].fileSize;
                if (check > ".$max_size.") {
                    Sexy.alert('".convert_slashes($lang_new[$module_name]['ERROR_FILEUPLOAD_MAXSIZE'])."<br />".convert_slashes($lang_new[$module_name]['DOWNLOAD_FILESIZE'])."= '+node.files[0].fileSize+'<br />".convert_slashes($lang_new[$module_name]['DOWNLOAD_MAX_FILESIZE'])." = ".$max_size."!');
                    return false;
                } else {
                    Sexy.alert('".convert_slashes($lang_new[$module_name]['INFO_UPLOAD_IS_RUNNING'])."');
                    return true;
                }
            }
*/
                
        }
        if (!fileIn){
            document.addnewdownload.uploadfile.style.backgroundColor = '#FF6A6A';
            document.addnewdownload.uploadfile.focus();
            document.addnewdownload.download_url.style.backgroundColor = '';
            Sexy.alert('".convert_slashes($lang_new[$module_name]['HELP_FILE_VALID1'])."<b>(' + ext + ')</b>".convert_slashes($lang_new[$module_name]['HELP_FILE_VALID2'])."');
            return false;
        } 
    }

    if (document.addnewdownload.download_username.value == ''){
        document.addnewdownload.download_username.style.backgroundColor = '#FF6A6A';
        document.addnewdownload.download_username.focus();
        Sexy.alert('".convert_slashes($lang_new[$module_name]['HELP_DOWNLOAD_NO_USER'])."',{
            onComplete:
            function(returnvalue) {
                if (returnvalue){
                    document.addnewdownload.download_username.focus();
                    document.addnewdownload.download_username.value = '';
                }
            }
        });
        return false;
    }

    if (document.addnewdownload.download_email.value == ''){
        document.addnewdownload.download_email.style.backgroundColor = '#FF6A6A';
        document.addnewdownload.download_email.focus();
        Sexy.alert('".convert_slashes($lang_new[$module_name]['HELP_DOWNLOAD_NO_EMAIL'])."',{
            onComplete:
            function(returnvalue) {
                if (returnvalue){
                    document.addnewdownload.download_email.focus();
                    document.addnewdownload.download_email.value = '';
                }
            }
        });
        return false;
    } else {
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        var address = document.addnewdownload.download_email.value;
        if(reg.test(address) == false) {
            Sexy.alert('".convert_slashes($lang_new[$module_name]['ERROR_EMAIL_WRONG'])."');
            return false;
        }
        if (".$downloadsconfig['securitycheck']." == '1'){} else { return true;}
    }
    
    if (".$downloadsconfig['securitycheck']." == '1') {
        if (document.addnewdownload.gfx_check.value != ''){
            var url     = '".NUKE_INCLUDE_HREF_DIR."ajax/captcha.php?gfx_check=';
            var code    = document.addnewdownload.gfx_check.value;
            xmlhttp     = createXmlHttpRequestObject();
    
            xmlhttp.open('GET',url+code,false);
            xmlhttp.send();
            
            if (xmlhttp.responseText == '0'){
                document.addnewdownload.gfx_check.style.backgroundColor='#FF6A6A';
                document.addnewdownload.gfx_check.focus();
                Sexy.alert('".convert_slashes($lang_new[$module_name]['ERROR_SECURITYCODE'])."',{
                    onComplete: function(returnvalue){
                        if (returnvalue){
                            document.addnewdownload.gfx_check.focus();
                            document.addnewdownload.gfx_check.value = '';
                        }
                    }
                });
                return false;
            } else if (xmlhttp.responseText == '1'){
            return true;
            }
        } else {
            document.addnewdownload.gfx_check.style.backgroundColor = '#FF6A6A';
            document.addnewdownload.gfx_check.focus();
            Sexy.alert('".convert_slashes($lang_new[$module_name]['INFO_SECURITYCODE'])."',{
                onComplete:
                    function(returnvalue){
                        if (returnvalue){
                            document.addnewdownload.gfx_check.focus();
                            document.addnewdownload.gfx_check.value = '';
                        }
                    }
                });
            return false;
        }
    }
    return false;
}
\n/*]]>*/\n
</script>";

while($row = $db->sql_fetchrow($result1)) {
    $cid2 = intval($row['cid']);
    $ctitle2 = stripslashes($row['title']);
    $parentid2 = intval($row['parentid']);
    $canupload = intval($row['canupload']);
    
    if ($parentid2!=0) {
        $ctitle2=DownloadsGetParent($parentid2,$ctitle2);
    }

    switch ($row['restricted_group_add']) {
        case (0): $show = 1; break; // default value in table -> everyone
        case (1): $show = 1; break; // show to all visitors
        case (3): $show = (is_user() ? 1 : 0); break; // show only for registered users
        case (4): $show = (is_mod_admin($module_name) ? 1 : 0); break; // show only to Admins
        case (6):
        $groups = (!empty($mod_groups)) ? $groups = explode('-', $mod_groups) : '';
        $ingroup = false;
        if(is_array($groups)){
            foreach ($groups as $group) {
                if (isset($userinfo['groups'][$group])) {
                    $ingroup = true;
                }
            }
        }
        $show = ($ingroup ? 1 : 0); break;
    }
    if ($show == 1 || is_admin()) {
        $categories_selectable++;
        $cat_select .= "<option value='".$cid2."'>".$ctitle2."</option>";
    }
}

$db->sql_freeresult($result1);

OpenTable();

if ($downloadsconfig['anonadddownloadlock'] != 1){
    if (!is_user() && !is_admin()){
        echo "<br /><br /><center>".$lang_new[$module_name]['INFO_ONLYREGISTERED'] . "</center><br /><br />";
        echo "<center>".$lang_new[$module_name]['SUBMIT_GOBACK'] . "</center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        die();
    }
}

echo "<span class='option'><strong>".$lang_new[$module_name]['ADD_DOWNLOAD']."</strong></span>";
echo "<h3></h3>";
echo "<form method='post' action='modules.php?name=".$module_name."&amp;op=AddDownloadSave' name='addnewdownload' enctype='multipart/form-data'>";
echo "<table width='100%' border='0' cellspacing='1' cellpadding='0'>";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_PAGETITLE'])."&nbsp;<span style='color:".$ThemeInfo['textcolor1']."; font-weight:bold;'>".$lang_new[$module_name]['DOWNLOAD_PAGETITLE'].":</span></td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px;' align='center'>".evo_help_img($lang_new[$module_name]['HELP_MUSTFIELD'], '', 'false', '<span style="color:red;">*</span>')."</td><td id='td_title'><input placeholder='MyDownloadTitle...' onkeypress='javascript:document.addnewdownload.title.style.backgroundColor = \"\"' type='text' name='title' size='75%' maxlength='255' /></td></tr>";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_CATEGORY'])."&nbsp;<span style='color:".$ThemeInfo['textcolor1']."; font-weight:bold;'>".$lang_new[$module_name]['CATEGORY'].":</span></td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px;' align='center'>".evo_help_img($lang_new[$module_name]['HELP_MUSTFIELD'], '', 'false', '<span style="color:red;">*</span>')."</td><td id='td_cat'>";
echo "<select name='cat' onchange='javascript:document.addnewdownload.cat.style.backgroundColor=\"\"'>";
echo "<option value=''>".$lang_new[$module_name]['CATEGORY_SELECT']."</option>";
echo $cat_select;
echo "</select></td></tr>";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_IMAGE_URL'])."&nbsp;<span style='color:".$ThemeInfo['textcolor1']."; font-weight:bold;'>".$lang_new[$module_name]['HELP_DOWNLOAD_UPLOAD_IMAGE'].":</span></td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px;' id='td_image'></td><td><input onChange='javascript:document.addnewdownload.uploadimage.style.backgroundColor=\"\"' type='file' id='uploadimage' name='uploadimage' size='75%' maxlength='255' /></td></tr>";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_UPLOAD'])."&nbsp;<span style='color:".$ThemeInfo['textcolor1']."; font-weight:bold;'>". $lang_new[$module_name]['DOWNLOAD_UPLOAD'].":</span></td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px;' align='center'>".evo_help_img($lang_new[$module_name]['HELP_MUSTFIELD'], '', 'false', '<span style="color:red;">*</span>')."</td><td><input onchange='document.addnewdownload.uploadfile.style.backgroundColor=\"\"; document.addnewdownload.download_url.style.backgroundColor=\"\"' type='file' id='uploadfile' name='uploadfile' size='75%' maxlength='255' /></td></tr>";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_URL'],$lang_new[$module_name]['DOWNLOAD_UPLOAD'])."&nbsp;<span style='color:".$ThemeInfo['textcolor1']."; font-weight:bold;'>".$lang_new[$module_name]['DOWNLOAD_URL'].":</span></td><td bgcolor='".$ThemeInfo['bgcolor2']."' align='center' style='border:solid white 1px'>".evo_help_img($lang_new[$module_name]['HELP_MUSTFIELD'], '', 'false', '<span style="color:red;">*</span>')."</td><td><input placeholder=\"http://www.mywebsite.com/files/myfile.zip\" onkeypress(javascript:document.addnewdownload.download_url.style.backgroundColor=\"\"; document.addnewdownload.uploadfile.style.backgroundColor=\"\"' type='text' name='download_url' size='75%' maxlength='255' /></td></tr>\n";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_MAX_FILESIZE_PUBLIC'])."&nbsp;<span style='color:".$ThemeInfo['textcolor1']."; font-weight:bold;'>".$lang_new[$module_name]['DOWNLOAD_MAX_FILESIZE'].":</span></td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px;'></td><td bgcolor='".$ThemeInfo['bgcolor1']."'><strong>".DownloadsMaxAllowedFileSize(TRUE)."</strong></td></tr>";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_ALLOWED_EXTENSIONS_PUBLIC'])."&nbsp;<span style='color:".$ThemeInfo['textcolor1']."; font-weight:bold;'>".$lang_new[$module_name]['DOWNLOAD_ALLOWED_EXTENSIONS'].":</span></td><td  bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px;'></td><td bgcolor='".$ThemeInfo['bgcolor1']."'><strong>".DownloadsAllowedExtensions(TRUE)."</strong></td></tr>";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px;' align='left' colspan='3' >".evo_help_img($lang_new[$module_name]['HELP_DESCRIPTION'])."&nbsp;<span style='color:".$ThemeInfo['textcolor1']."; font-weight:bold;'>".$lang_new[$module_name]['DESCRIPTION'].":</span></td></tr>";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='center' colspan='3' style='border:solid white 1px' nowrap='nowrap' ><br />";
echo Make_TextArea('description','','addnewdownload','90%','150px', TRUE, 'bbcode');
echo "</td></tr>";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_AUTHOR'])."&nbsp;<span style='color:".$ThemeInfo['textcolor1']."; font-weight:bold;'>".$lang_new[$module_name]['DOWNLOAD_AUTHOR'].":</span></td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px;'></td><td><input placeholder=\"Copyright's owner\" type='text' name='download_author' size='75%' maxlength='255' /></td></tr>";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_AUTHOR_EMAIL'])."&nbsp;<span style='color:".$ThemeInfo['textcolor1']."; font-weight:bold;'>".$lang_new[$module_name]['DOWNLOAD_AUTHOR_EMAIL'].":</span></td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px;'></td><td><input placeholder=\"Copyright owner's E-mail\" type='text' name='download_author_email' size='75%' maxlength='255' /></td></tr>";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_AUTHOR_WEBSITE'])."&nbsp;<span style='color:".$ThemeInfo['textcolor1']."; font-weight:bold;'>".$lang_new[$module_name]['DOWNLOAD_AUTHOR_WEBSITE'].":</span></td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px;'></td><td><input placeholder=\"Copyright owner's website: http://...\" type='text' name='download_author_website' size='75%' maxlength='255' value='http://' /></td></tr>";
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_VERSION'])."&nbsp;<span style='color:".$ThemeInfo['textcolor1']."; font-weight:bold;'>".$lang_new[$module_name]['DOWNLOAD_VERSION'].":</span></td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px;'></td><td><input placeholder='V7.1' type='text' name='download_version' size='75%' maxlength='255' /></td></tr>";
if ($downloadsconfig['allow_torrent'] == 1){
    echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_DOWNLOAD_TORRENTS'])."&nbsp;<span style='color:".$ThemeInfo['textcolor1']."; font-weight:bold;'>".$lang_new[$module_name]['DOWNLOAD_TORRENT'].":</span></td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px;'></td><td><input placeholder=\"http://torrents.torrent.com/download/2329489/Evo_CMS_2.1.0.torrent\" type='text' name='download_torrent' size='75%' maxlength='255' /></td></tr>";
}
echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_LICENSE_TYPE'])."&nbsp;<span style='color:".$ThemeInfo['textcolor1']."; font-weight:bold;'>".$lang_new[$module_name]['LICENSE_TYPE'].":</span></td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px;'></td>";
echo "<td><select name='download_license'>";
echo "<option value='0' selected='selected'>".$lang_new[$module_name]['NONE']."</option>";
while($licinfo = $db->sql_fetchrow($lresult)) {
    $license_title = stripslashes($licinfo['license_title']);
    echo "<option value='".$licinfo['license_id']."'>".$license_title."</option>";
}
$db->sql_freeresult($lresult);
echo "</select></td></tr>";
echo "<tr><td colspan='3'><br /><h3></h3></td></tr>";
if (is_user()) {
    echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_NAME_REGISTERED'])."&nbsp;<span style='color:".$ThemeInfo['textcolor1']."; font-weight:bold;'>".$lang_new[$module_name]['NAME'].":</span></td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px;' align='center'>".evo_help_img($lang_new[$module_name]['HELP_MUSTFIELD'], '', 'false', '<span style="color:red;">*</span>')."</td><td>".UsernameColor($userinfo['username'])."</td></tr>";
    echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_EMAIL_REGISTERED'])."&nbsp;<span style='color:".$ThemeInfo['textcolor1']."; font-weight:bold;'>".$lang_new[$module_name]['EMAIL'].":</span></td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px;' align='center'>".evo_help_img($lang_new[$module_name]['HELP_MUSTFIELD'], '', 'false', '<span style="color:red;">*</span>')."</td><td>". $userinfo['user_email'];
    echo "<input type='hidden' name='download_username' value='".$userinfo['username']."' />";
    echo "<input type='hidden' name='download_email' value='".$userinfo['user_email']."' /></td></tr>";
} else {
    echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_NAME_GUEST'])."&nbsp;<span style='color:".$ThemeInfo['textcolor1']."; font-weight:bold;'>".$lang_new[$module_name]['NAME'].":</span></td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px;' align='center'>".evo_help_img($lang_new[$module_name]['HELP_MUSTFIELD'], '', 'false', '<span style="color:red;">*</span>')."</td><td><input placeholder=\"Kai, ReO, Spider, RTC4, Chiro\" onKeyPress='javascript:document.addnewdownload.download_username.style.backgroundColor=\"\"' type='text' id='download_username' name='download_username' size='75%' maxlength='255' /></td></tr>";
    echo "<tr><td class='dl_td' ".$over_out." bgcolor='".$ThemeInfo['bgcolor2']."' align='left' style='border:solid white 1px' nowrap='nowrap' >".evo_help_img($lang_new[$module_name]['HELP_EMAIL_GUEST'])."&nbsp;<span style='color:".$ThemeInfo['textcolor1']."; font-weight:bold;'>".$lang_new[$module_name]['EMAIL'].":</span></td><td bgcolor='".$ThemeInfo['bgcolor2']."' style='border:solid white 1px;' align='center'>".evo_help_img($lang_new[$module_name]['HELP_MUSTFIELD'], '', 'false', '<span style="color:red;">*</span>')."</td><td><input placeholder=\"youremail@provider.com\" onKeyPress='javascript:document.addnewdownload.download_email.style.backgroundColor=\"\"' type='text' id='download_email' name='download_email' size='75%' maxlength='255' /></td></tr>";
}
if ($downloadsconfig['securitycheck'] == 1) {
    echo "<tr><td align='center' colspan='3'>".security_code(1,'small', 1)."</td></tr>";
}
echo "</table><br />";
echo "<center><input name='add' id='add' type='submit' onclick='return validate()' value='".$lang_new[$module_name]['SUBMIT_ADD']."' /></center>";
echo "</form>";

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>