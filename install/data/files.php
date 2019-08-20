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
 Nuke-Evo Author        :   ReOrGaNiSaTiOn

 Copyright (c) 2010 by The Nuke-Evolution Development Team
 ========================================================================

 LICENSE INFORMATIONS COULD BE FOUND IN COPYRIGHTS.PHP WHICH MUST BE
 DISTRIBUTED WITHIN THIS MODULEPACKAGE OR WITHIN FILES WHICH ARE
 USED FROM WITHIN THIS PACKAGE.
 IT IS 'NOT' ALLOWED TO DISTRIBUTE THIS MODULE WITHOUT THE ORIGINAL
 COPYRIGHT-FILE.
 ALL INFORMATIONS ABOVE THIS SECTION ARE 'NOT' ALLOWED TO BE REMOVED.
 THEY HAVE TO STAY AS THEY ARE.
 IT IS ALLOWED AND SHOULD BE DONE TO ADD ADDITIONAL INFORMATIONS IN
 THE SECTIONS BELOW IF YOU CHANGE OR MODIFY THIS FILE.

/*****[CHANGES]**********************************************************
-=[Base]=-
-=[Mod]=-
 ************************************************************************/

$files = array (
    'adminlog' => array (
        'filename' => 'admin.log',
        'path' => 'includes/log/',
        'language' => '0',
        'textlang' => $lang_install['File_adminlog'],
        'help' => $lang_install['File_Help_adminlog'],
        'mode' => '0646',
        'must' => '1'
    ),
    'AvatarDir' => array (
        'filename' => '',
        'path' => 'images/avatars',
        'language' => '0',
        'textlang' => $lang_install['File_AvatarDir'],
        'help' => $lang_install['File_Help_AvatarDir'],
        'mode' => '0757',
        'must' => '1'
    ),
    'Config' => array (
        'filename' => 'includes/db/config.php',
        'path' => '',
        'language' => '0',
        'textlang' => $lang_install['File_Configdb'],
        'help' => $lang_install['File_Help_Configdb'],
        'mode' => '0646',
        'must' => '1'
    ),
    'DownloadsFilesDir' => array (
        'filename' => '',
        'path' => 'modules/Downloads/files',
        'language' => '0',
        'textlang' => $lang_install['Downloads_Files_Dir'],
        'help' => $lang_install['Downloads_Files_Dir_Help'],
        'mode' => '0757',
        'must' => '1'
    ),
    'errorlog' => array (
        'filename' => 'error.log',
        'path' => 'includes/log/',
        'language' => '0',
        'textlang' => $lang_install['File_errorlog'],
        'help' => $lang_install['File_Help_errorlog'],
        'mode' => '0646',
        'must' => '1'
    ),
    'Filesdir' => array (
        'filename' => '',
        'path' => 'modules/Forums/files/',
        'language' => '0',
        'textlang' => $lang_install['File_FilesDir'],
        'help' => $lang_install['File_Help_FilesDir'],
        'mode' => '0757',
        'must' => '1'
    ),
    'FilesThumbDir' => array (
        'filename' => '',
        'path' => 'modules/Forums/files/thumbs/',
        'language' => '0',
        'textlang' => $lang_install['File_FilesThumbDir'],
        'help' => $lang_install['File_Help_FilesThumbDir'],
        'mode' => '0757',
        'must' => '1'
    ),
    'ForumModules' => array (
        'filename' => '',
        'path' => 'modules/Forums/modules/',
        'language' => '0',
        'textlang' => $lang_install['File_ForumModules'],
        'help' => $lang_install['File_Help_ForumModules'],
        'mode' => '0757',
        'must' => '1'
    ),
    'ForumModulesCache' => array (
        'filename' => '',
        'path' => 'modules/Forums/modules/cache/',
        'language' => '0',
        'textlang' => $lang_install['File_ForumModulesCache'],
        'help' => $lang_install['File_Help_ForumModulesCache'],
        'mode' => '0757',
        'must' => '1'
    ),
    'ForumModulesCacheExplain' => array (
        'filename' => '',
        'path' => 'modules/Forums/modules/cache/explain/',
        'language' => '0',
        'textlang' => $lang_install['File_ForumModulesCacheExplain'],
        'help' => $lang_install['File_Help_ForumModulesCacheExplain'],
        'mode' => '0757',
        'must' => '1'
    ),
    'Forumscachedir' => array (
        'filename' => '',
        'path' => 'modules/Forums/cache/',
        'language' => '0',
        'textlang' => $lang_install['File_ForumsCacheDir'],
        'help' => $lang_install['File_Help_ForumsCacheDir'],
        'mode' => '0757',
        'must' => '1'
    ),
    'htaccess' => array (
        'filename' => '.htaccess',
        'path' => '',
        'language' => '0',
        'textlang' => $lang_install['File_htaccess'],
        'help' => $lang_install['File_Help_htaccess'],
        'mode' => '0646',
        'must' => '0'
    ),
    'HTMLPurifierDecorator' => array (
        'filename' => '',
        'path' => 'includes/HTMLPurifier/HTMLPurifier/DefinitionCache/Decorator/',
        'language' => '0',
        'textlang' => $lang_install['File_HTMLPurifierDecorator'],
        'help' => $lang_install['File_Help_HTMLPurifierDecorator'],
        'mode' => '0757',
        'must' => '1'
    ),
    'HTMLPurifierSerializer' => array (
        'filename' => '',
        'path' => 'includes/HTMLPurifier/HTMLPurifier/DefinitionCache/Serializer/',
        'language' => '0',
        'textlang' => $lang_install['File_HTMLPurifierSerializer'],
        'help' => $lang_install['File_Help_HTMLPurifierSerializer'],
        'mode' => '0757',
        'must' => '1'
    ),
    'HTMLPurifierSerializerHtml' => array (
        'filename' => '',
        'path' => 'includes/HTMLPurifier/HTMLPurifier/DefinitionCache/Serializer/HTML/',
        'language' => '0',
        'textlang' => $lang_install['File_HTMLPurifierSerializerHtml'],
        'help' => $lang_install['File_Help_HTMLPurifierSerializerHtml'],
        'mode' => '0757',
        'must' => '1'
    ),
    'IconModDefIcons' => array (
        'filename' => 'def_icons.php',
        'path' => 'modules/Forums/post_icon_mod/includes/',
        'language' => '0',
        'textlang' => $lang_install['File_IconModDefIcons'],
        'help' => $lang_install['File_Help_IconModDefIcons'],
        'mode' => '0646',
        'must' => '1'
    ),
    'IncludesCache' => array (
        'filename' => '',
        'path' => 'includes/cache/',
        'language' => '0',
        'textlang' => $lang_install['File_IncludesCache'],
        'help' => $lang_install['File_Help_IncludesCache'],
        'mode' => '0757',
        'must' => '1'
    ),
    'IncludesCacheFile' => array (
        'filename' => 'cache.php',
        'path' => 'includes/cache/',
        'language' => '0',
        'textlang' => $lang_install['File_IncludesCacheFile'],
        'help' => $lang_install['File_Help_IncludesCacheFile'],
        'mode' => '0646',
        'must' => '1'
    ),
    'LangBBCode' => array (
        'filename' => 'lang_bbcode.php',
        'path' => 'modules/Forums/language/',
        'language' => '1',
        'textlang' => $lang_install['File_LangBBCode'],
        'help' => $lang_install['File_Help_LangBBCode'],
        'mode' => '0646',
        'must' => '1'
    ),
    'LangFAQ' => array (
        'filename' => 'lang_faq.php',
        'path' => 'modules/Forums/language/',
        'language' => '1',
        'textlang' => $lang_install['File_LangFAQ'],
        'help' => $lang_install['File_Help_LangFAQ'],
        'mode' => '0646',
        'must' => '1'
    ),
    'LangFAQAttach' => array (
        'filename' => 'lang_faq_attach.php',
        'path' => 'modules/Forums/language/',
        'language' => '1',
        'textlang' => $lang_install['File_LangFAQAttach'],
        'help' => $lang_install['File_Help_LangFAQAttach'],
        'mode' => '0646',
        'must' => '1'
    ),
    'LangRules' => array (
        'filename' => 'lang_rules.php',
        'path' => 'modules/Forums/language/',
        'language' => '1',
        'textlang' => $lang_install['File_LangRules'],
        'help' => $lang_install['File_Help_LangRules'],
        'mode' => '0646',
        'must' => '1'
    ),
    'staccess' => array (
        'filename' => '.staccess',
        'path' => '',
        'language' => '0',
        'textlang' => $lang_install['File_staccess'],
        'help' => $lang_install['File_Help_staccess'],
        'mode' => '0646',
        'must' => '0'
    ),
    'SupportersImagesSupporters' => array (
        'filename' => '',
        'path' => 'modules/Supporters/images/supporters/',
        'language' => '0',
        'textlang' => $lang_install['File_SupportersImagesSupporters'],
        'help' => $lang_install['File_Help_SupportersImagesSupporters'],
        'mode' => '0757',
        'must' => '1'
    )
);

?>