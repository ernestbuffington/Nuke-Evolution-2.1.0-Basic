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

if(!defined('NUKE_EVO')) exit;

global $currentlang;

  $lang_code = array("arabic"=>"ar",
                     "bulgarian"=>"bg",
                     "chinese_simplified"=>"zh-CN",
                     "chinese_traditional"=>"zh-TW",
                     "croatian"=>"hr",
                     "czech"=>"cs",
                     "danish"=>"da",
                     "dutch"=>"nl",
                     "english"=>"en",
                     "finnish"=>"fi",
                     "french"=>"fr",
                     "german"=>"de",
                     "greek"=>"gr",
                     "hindi"=>"hi",
                     "italian"=>"it",
                     "japanese"=>"ja",
                     "norwegian"=>"no",
                     "polish"=>"pl",
                     "portuguese"=>"pt",
                     "romanian"=>"ro",
                     "russian"=>"ru",
                     "spanish"=>"es",
                     "turkish"=>"tr",
                     "swedish"=>"sv",
                     );
$site_langcode = $lang_code[$currentlang];
if ($site_langcode != '') {
    $content  = '<div align="center"><a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Car" rel="nofollow">';
    $content .= '<img src="images/language/flag-arabic.png" width="15" height="8" border="0" alt="العربية" title="ترجمة الى العربية" /></a>&nbsp;';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Cbg" rel="nofollow">';
    $content .= '<img src="images/language/flag-bulgarian.png" width="15" height="8" border="0" alt="Български" title="Превод на български" /></a>&nbsp;';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Czh-CN" rel="nofollow">';
    $content .= '<img src="images/language/flag-chinese_simplified.png" width="15" height="8" border="0" alt="简化字" title="翻译，以简体中文" /></a>&nbsp;';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Czh-TW" rel="nofollow">';
    $content .= '<img src="images/language/flag-chinese_traditional.png" width="15" height="8" border="0" alt="正體字" title="'.htmlspecialchars("翻譯，以中國傳統").'" /></a>&nbsp;';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Chr" rel="nofollow">';
    $content .= '<img src="images/language/flag-croatian.png" width="15" height="8" border="0" alt="Hrvatski" title="Prevedi na hrvatski" /></a>&nbsp;<br />';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Ccs" rel="nofollow">';
    $content .= '<img src="images/language/flag-czech.png" width="15" height="8" border="0" alt="ceština" title="Preložit do ceštiny" /></a>&nbsp;';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Cda" rel="nofollow">';
    $content .= '<img src="images/language/flag-danish.png" width="15" height="8" border="0" alt="Dansk" title="Oversæt til dansk" /></a>&nbsp;';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Cnl" rel="nofollow">';
    $content .= '<img src="images/language/flag-dutch.png" width="15" height="8" border="0" alt="Nederlands" title="Vertaal naar Nederlands" /></a>&nbsp;';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Cen" rel="nofollow">';
    $content .= '<img src="images/language/flag-english.png" width="15" height="8" border="0" alt="English" title="English translation" /></a>&nbsp;';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Cfi" rel="nofollow">';
    $content .= '<img src="images/language/flag-finnish.png" width="15" height="8" border="0" alt="Suomi" title="Muunna suomi" /></a>&nbsp;<br />';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Cfr" rel="nofollow">';
    $content .= '<img src="images/language/flag-french.png" width="15" height="8" border="0" alt="Français" title="Traduire en Français" /></a>&nbsp;';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Cde" rel="nofollow">';
    $content .= '<img src="images/language/flag-german.png" width="15" height="8" border="0" alt="Deutsch" title="Übersetze auf Deutsch" /></a>&nbsp;';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Cel" rel="nofollow">';
    $content .= '<img src="images/language/flag-greek.png" width="15" height="8" border="0" alt="ελληνικά" title="Μεταφράστε στα ελληνικά" /></a>&nbsp;';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Chi" rel="nofollow">';
    $content .= '<img src="images/language/flag-hindi.png" width="15" height="8" border="0" alt="हिन्दी" title="हिन्दी अनुवाद करने के लिए" /></a>&nbsp;';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Cit" rel="nofollow">';
    $content .= '<img src="images/language/flag-italian.png" width="15" height="8" border="0" alt="Italiano" title="Traduci in italiano" /></a>&nbsp;<br />';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Cja" rel="nofollow">';
    $content .= '<img src="images/language/flag-japanese.png" width="15" height="8" border="0" alt="日本語" title="を日本語に翻訳します" /></a>&nbsp;';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Cko" rel="nofollow">';
    $content .= '<img src="images/language/flag-korean.png" width="15" height="8" border="0" alt="한국말" title="한국의 번역합니다" /></a>&nbsp;';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Cno" rel="nofollow">';
    $content .= '<img src="images/language/flag-norwegian.png" width="15" height="8" border="0" alt="Norsk" title="Oversett til norsk" /></a>&nbsp;';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Cpl" rel="nofollow">';
    $content .= '<img src="images/language/flag-polish.png" width="15" height="8" border="0" alt="Polski" title="Tlumaczenie na Polski" /></a>&nbsp;';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Cpt" rel="nofollow">';
    $content .= '<img src="images/language/flag-portuguese.png" width="15" height="8" border="0" alt="Português" title="Traduzir para Português" /></a>&nbsp;<br />';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Cro" rel="nofollow">';
    $content .= '<img src="images/language/flag-romanian.png" width="15" height="8" border="0" alt="Români" title="Traduceti la români" /></a>&nbsp;';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Cru" rel="nofollow">';
    $content .= '<img src="images/language/flag-russian.png" width="15" height="8" border="0" alt="Русский" title="Перевести на русский язык" /></a>&nbsp;';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Ces" rel="nofollow">';
    $content .= '<img src="images/language/flag-spanish.png" width="15" height="8" border="0" alt="Español" title="Traducir al español" /></a>&nbsp;';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Ctr" rel="nofollow">';
    $content .= '<img src="images/language/flag-turkish.png" width="15" height="8" border="0" alt="Türkçe" title="Türkçeye çevir" /></a>&nbsp;';
    $content .= '<a href="http://translate.google.com/translate?u='.EVO_SERVER_URL.'&amp;langpair='.$site_langcode.'%7Csv" rel="nofollow">';
    $content .= '<img src="images/language/flag-swedish.png" width="15" height="8" border="0" alt="Svenska" title="Översätt till svenska" /></a></div>';
}else{
    $content = '<div align="center">'.$lang_block['BLOCK_TRANSLATIONS_LANG_NOT_SUPPORTED'].'</div>';
}

?>