<?php
/*=======================================================================
 Nuke-Evolution   :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :       #$#BASE
 Nuke-Evo Version       :       #$#VER
 Nuke-Evo Build         :       #$#BUILD
 Nuke-Evo Patch         :       #$#PATCH
 Nuke-Evo Filename      :       #$#FILENAME
 Nuke-Evo Date          :       #$#DATE

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

// admin part
$lang['Lang_extend_post_icons']   = 'Post Ic&ocirc;nes';

$lang['Icons_settings_explain']   = 'Ici vous pouvez rajouter, modifier ou &eacute;ffacer des ic&ocirc;nes de post';
$lang['Icons_auth']         = 'Niveau d\'authentification';
$lang['Icons_auth_explain']     = 'L\'ic&ocirc;ne ne sera disponible que pour les utilisateurs qui correspond &agrave; cette exigence';
$lang['Icons_defaults']       = 'Affectation par d&eacute;faut';
$lang['Icons_defaults_explain']   = "Ces affectations seront utilis&eacute; sur les sujets qui n\'ont pas d\'ic&ocirc;ne d&eacute;finie";
$lang['Icons_delete']       = "Supprimer l\'i&ocirc;ne";
$lang['Icons_delete_explain']   = 'Veuillez choisir une ic&ocirc; pour remplacer celui-ci:';
$lang['Icons_confirm_delete']   = 'Etes-vous s&ucirc; de vouloir le supprimer ?';

$lang['Icons_lang_key']       = 'Titre de l\'ic&ocirc;ne';
$lang['Icons_lang_key_explain']   = 'L\'ic&ocirc;ne titre sera affich&eacute; lorsque l\'utilisateur fixe sa souris sur l\'ico&circ;ne (du titre ou de d&eacute;claration HTML alt). Vous pouvez utiliser un texte ou un &acute;l&eacute;ment de la collection de langue. <br />(check language/lang_<i>your_language</i>/lang_main.php).';
$lang['Icons_icon_key']       = 'Ic&ocirc;ne';
$lang['Icons_icon_key_explain']   = "Url de l\'ic&ocirc;ne ou num&eacute;ro dans la collection d\'images. <br />(check templates/<i>your_template</i>/<i>your_template</i>.cfg)";
$lang['Icons_error_title']      = "Le titre de l\'ic&ocirc;ne est manquant";
$lang['Icons_error_del_0']      = "Vous ne pouvez pas supprimer l'ic&ocirc;ne manquant par d&eacute;faut";


$lang['Refresh']          = 'Rafra&icirc;chir';
$lang['Usage']            = 'Usage';

$lang['Image_key_pick_up']      = "R&eacute;cup&eacute;rer le num&eacute;ro d'une image";
$lang['Lang_key_pick_up']     = "R&eacute;cup&eacute;rer le num&eacute;ro d'une langue";


$lang['Icons_settings']     = 'Ic&ocirc;ne des posts';
$lang['Icons_per_row']      = 'Ic&ocirc;ne pour le rang';
$lang['Icons_per_row_explain']  = "R&eacute;gler ici le nombre d'ic&ocirc;nes affich&eacute;s par ligne dans l'&eacute;cran d'affichage";
$lang['post_icon_title']    = 'Message Ic&ocirc;ne';

// icons
$lang['icon_none']        = 'Pas ic&ocirc;ne';
$lang['icon_note']        = 'Note';
$lang['icon_important']     = 'Important';
$lang['icon_idea']        = 'Id&eacute;e';
$lang['icon_warning']     = 'Attention !';
$lang['icon_question']      = 'Question';
$lang['icon_cool']        = 'Cool';
$lang['icon_funny']       = 'Dr&ocirc;le';
$lang['icon_angry']       = 'Grrrr !';
$lang['icon_sad']       = 'Snif !';
$lang['icon_mocker']      = 'Hehehe !';
$lang['icon_shocked']     = 'Oooh !';
$lang['icon_complicity']    = 'Complicit&eacute;';
$lang['icon_bad']       = 'Mauvais !';
$lang['icon_great']       = 'Super !';
$lang['icon_disgusting']    = 'Beark !';
$lang['icon_winner']      = 'Gniark !';
$lang['icon_impressed']     = 'Oh yes !';
$lang['icon_roleplay']      = 'Roleplay';
$lang['icon_fight']       = 'Baguarre';
$lang['icon_loot']        = 'butin';
$lang['icon_picture']     = 'Image';
$lang['icon_calendar']      = 'Agenda';

?>