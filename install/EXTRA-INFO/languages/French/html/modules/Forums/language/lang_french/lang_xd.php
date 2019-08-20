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

// Mots de permission 
$lang['xd_permissions'] = 'Contr&ocirc;le des permissions XData'; 
$lang['xd_permissions_describe'] = 'Ici vous pouvez changer la capacit&eacute; des utilisateurs &agrave; remplir un champ personnel'; 
$lang['field_name'] = 'Nom du champs'; 
$lang['Allow'] = 'Autoriser'; 
$lang['Default'] = 'D&eacute;faut'; 
$lang['Deny'] = 'Refuser'; 

// Editer / Ajouter des mots 
$lang['Basic_Options'] = 'Options Basic'; 
$lang['Advanced_Options'] = 'Options avanc&eacute;es'; 
$lang['Advanced_warning'] = 'Ne changez rien ici si vous n\'&ecirc;tes pas s&ucirc;r de ce que vous faites.'; 
$lang['edit_xdata_field'] = 'Editer les champs du profil'; 
$lang['Name'] = 'Nom'; 
$lang['xd_description'] = 'Description'; 
$lang['type'] = 'Type'; 
$lang['Text'] = 'Texte'; 
$lang['Text_area'] = 'Zone de texte'; 
$lang['Select'] = 'Choisir la Bo&icirc;te'; 
$lang['Radio'] = 'Bouton radio'; 
$lang['Date'] = 'Date';
$lang['Custom'] = 'Personnel'; 
$lang['Length'] = 'Longueur'; 
$lang['Length_explain'] = 'La longueur maximum pour un texte ou une zone de texte. (0 = illimit&eacute;)'; 
$lang['Values'] = 'Valeurs'; 
$lang['Values_explain'] = 'L\'option qui appara&icirc;tra pour un champs de s&eacute;lection ou un bouton. Chaque option devrait &ecirc;tre entour&eacute;e par : [\'].'; 
$lang['Default_auth'] = 'Permissions par d&eacute;faut'; 
$lang['Default_auth_explain'] = 'Les utilisateurs pourront seulement &eacute;diter ce champs dans leur profil que si cette option ou que leur permission personnelle les y autorise.'; 
$lang['Display_viewtopic_explain'] = 'Quand on regarde les messages.'; 
$lang['Display_viewprofile_explain'] = 'Quand on regarde le profil'; 
$lang['Display_register_explain'] = 'Quand on &eacute;dite le profil'; 
$lang['Display_type'] = 'Type'; 
$lang['Display_normal'] = 'Normal'; 
$lang['Display_none'] = 'Aucune'; 
$lang['Display_root'] = 'Variable TPL'; 
$lang['Code_name'] = 'Nom dans les Th&egrave;mes'; 
$lang['Code_name_explain'] = 'If any of the above is set to "TPL Variable", this will be tha name of the variable the data is asigned to.'; 
$lang['Regexp'] = 'Expression reguli&egrave;re'; 
$lang['Regexp_explain'] = 'Seules les valeurs assorties &agrave; cette expression r&eacute;guli&egrave;re seront autoris&eacute;es. (PCRE-Style)'; 
$lang['add_xdata_field'] = 'Ajouter le champs du profil'; 
$lang['Add_success'] = 'Champs ajout&eacute; avec succ&egrave;s.'; 
$lang['Delete_success'] = 'Champs supprim&eacute; avec succ&egrave;s.'; 
$lang['Edit_success'] = 'Informations du champs mises &agrave; jour avec succ&egrave;s.'; 
$lang['Click_return_fields'] = 'Cliquez %sici%s pour retourner &agrave; l\'Administration des champs'; 
$lang['Regexp_error'] = 'Vous avez une erreur dans votre syntaxe :'; 
$lang['handle_input'] = 'Identfiant entr&eacute;'; 
$lang['handle_input_explain'] = 'S&eacute;lectionnez "Oui" &agrave; moins que vous ne vouliez faire votre propre entr&eacute;e pour ce champs.'; 
$lang['Allow_smilies'] = 'Autoriser les Smilies'; 
$lang['Allow_BBCode'] = 'Autoriser le BBCode'; 
$lang['Allow_html'] = 'Autoriser le HTML'; 
$lang['Viewtopic'] = 'Montrer pendant la visualisation des sujets';
$lang['Signup'] = 'Montrer pendant l\'enregistrement';

// Mots de suppression 
$lang['Confirm'] = 'Confirmer'; 
$lang['Are_you_sure'] = 'Etes-vous s&ucirc;r de vouloir supprimer le champs "%s"?'; 

// Mots du menu principal 
$lang['Profile_admin'] = 'Administration des champs du profil'; 
$lang['Xdata_view_description'] = 'Ici vous pouvez voir et &eacute;diter les champs suppl&eacute;mentaires disponibles dans le "profil utilisateur".'; 
$lang['xd_move'] = 'Bouger'; 
$lang['xd_move_up'] = 'Monter'; 
$lang['xd_move_down'] = 'Descendre'; 
$lang['xd_operations'] = 'Op&eacute;rations'; 
$lang['Edit_field'] = 'Editer'; 
$lang['Delete_field'] = 'Effacer'; 
$lang['No_fields'] = 'Pas de champs'; 
$lang['Add_field'] = 'Ajouter un nouveau champs'; 

// Erreur 
$lang['XD_duplicate_name'] = 'Un champs existe d&eacute;ja avec ce nom de Th&egrave;me.' 

?>