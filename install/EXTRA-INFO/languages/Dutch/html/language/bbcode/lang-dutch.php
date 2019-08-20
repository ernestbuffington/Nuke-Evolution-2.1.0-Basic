<?php
/*=======================================================================
 Nuke-Evolution     :   Enhanced Web Portal System
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

$bbcode_lang['Emoticons'] = 'Smilies';
$bbcode_lang['More_emoticons'] = 'Meer Smilies bekijken';
$bbcode_lang['smilies_close'] = "Venster sluiten";

$lang['bbcode_b_help'] = 'Dikgedrukt: [b]Tekst[/b] (alt+b)';
$lang['bbcode_i_help'] = 'Cursief: [i]Tekst[/i] (alt+i)';
$lang['bbcode_u_help'] = 'Onderlijning Tekst: [u]Tekst[/u] (alt+u)';
$lang['bbcode_q_help'] = 'Citaat: [quote]Text[/quote] (alt+q)';
$lang['bbcode_c_help'] = 'Code weergeven: [code]Code[/code] (alt+c)';
$lang['bbcode_l_help'] = 'Lijst: [list]Text[/list] (alt+l)';
$lang['bbcode_o_help'] = 'Gesorteerde lijst: [list=]Tekst[/list] (alt+o)';
$lang['bbcode_p_help'] = 'Afbeelding toevoegen: [img]http://URL_afbeelding[/img] (alt+p)';
$lang['bbcode_w_help'] = 'URL invoegen: [url]http://URL[/url] oder [url=http://url]URL tekst[/url] (alt+w)';
$lang['bbcode_a_help'] = 'Alle geopende BBCodes sluiten';
$lang['bbcode_size_help'] = 'Tekengrootte: [size=x-small]Text[/size]';
$lang['bbcode_color_help'] = 'Tekstkleur: [color=red]Text[/color] Tip: U kunt ook color=#FF0000 gebruiken';
$lang['bbcode_font_help'] = 'Lettertype: [font=Arial]Text[/font]';
$lang['GVideo_link'] = 'Link';
$lang['youtube_link'] = 'Link';

$lang['bbcode_quote_help'] = 'Citaat: [quote]Text[/quote]';
$lang['bbcode_code_help'] = 'Code weergeven: [code]Code[/code]';
$lang['bbcode_php_help'] = 'PHP weergeven: [php]Code[/php]';
$lang['bbcode_spoil_help'] = 'Spoiler: [spoil]Text[/spoil]';
$lang['bbcode_img_help'] = 'Afbeelding toevoegen: [img]http://URL_des_Bildes[/img]';
$lang['bbcode_url_help'] = 'URL toevoegen: [url]http://URL[/url] oder [url=http://url]URL Text[/url]';
$lang['bbcode_ft_help'] = 'Lettertype: [font=Tahoma]Text[/font]';
$lang['bbcode_rtl_help'] = 'Berichtenbox rechts';
$lang['bbcode_ltr_help'] = 'Berichtenbox links';
$lang['bbcode_mail_help'] = 'E-mail invoegen: [email]xxx@mailadres.com[/email]';
$lang['bbcode_grad_help'] ='Kleurverloop toevoegen (alleen Internet Explorer)';
$lang['bbcode_right_help'] = 'Text rechts uitlijnen: [align=right]Text[/align]';
$lang['bbcode_left_help'] = 'Text links uitlijnen: [align=left]Text[/align]';
$lang['bbcode_center_help'] = 'Text centreren: [align=center]Text[/align]';
$lang['bbcode_justify_help'] = 'Blocktext: [align=justify]Text[/align]';
$lang['bbcode_marqr_help'] = 'scrolltekst naar rechts: [marq=right]Text[/marq]';
$lang['bbcode_marql_help'] = 'scrolltekst naar links: [marq=left]Text[/marq]';
$lang['bbcode_marqu_help'] = 'scrolltekst noor boven: [marq=up]Text[/marq]';
$lang['bbcode_marqd_help'] = 'scrolltekst naar beneden: [marq=down]Text[/marq]';
$lang['bbcode_stream_help'] = 'Stream bestand toevoegen: [stream]Datei URL[/stream]';
$lang['bbcode_ram_help'] = 'Real Media bestand toevoegen: [ram]Datei URL[/ram]';
$lang['bbcode_plain_help'] = 'BBCodes van geselecteerde tekst verwijderen';
$lang['bbcode_hr_help'] = 'Lijn toevoegen [hr]';
$lang['bbcode_video_help'] = 'Video bestand toevoegen: [video width=# height=#]Bestands URL[/video]';
$lang['bbcode_flash_help'] = 'Flash bestand toevoegen: [flash width=# height=#]Flash URL[/flash]';
$lang['bbcode_fade_help'] = 'Textverloop: [fade]Text[/fade] (alleen Internet Explorer)';
$lang['bbcode_list_help'] = 'Gesoteerde lijst: [list|=1|a]Text[/list] Tip: gebruik [*] fuer Gliederungspunkt';
$lang['bbcode_strike_help'] = 'Doorgestreepte tekst: [s]Text[/s]';
$lang['bbcode_sup_help'] = 'Hooggesplaatst: [sup]Text[/sup]';
$lang['bbcode_sub_help'] = 'Laaggeplaatst: [sub]Text[/sub]';
$lang['bbcode_symbol_help'] = 'Symbool in text toevoegen';
$lang['bbcode_youtube_help'] = 'YouTube: [youtube]YouTube URL[/youtube]';
$lang['bbcode_googlevid_help'] = 'Google: [GVideo]Google Video URL[/GVideo]';

$lang['bbcode_text_first'] = 'Eerst de tekst selecteren';
$lang['bbcode_less_letters'] = 'Werkt alleen met max 120 tekens';
$lang['bbcode_rm_url'] = 'Real Media bestands URL toevoegen';
$lang['bbcode_no_file_url'] = ' U hebt geen bestands URL toegevoegd.';
$lang['bbcode_rm_width'] = 'De breedte van het Real Media bestand opgeven';
$lang['bbcode_no_rm_width'] = ' U hebt geen breedte voor het Real Media bestand opgegeven.';
$lang['bbcode_rm_height'] = 'De hoogte van het Real Media bestand opgeven';
$lang['bbcode_no_rm_height'] = ' U hebt geen hoogte voor het Real Media bestand opgegeven.';
$lang['bbcode_error'] = 'Fout:';
$lang['bbcode_stream_url'] = 'Stream bestands URL opgeven';
$lang['bbcode_video_url'] = 'Video bestands URL opgeven';
$lang['bbcode_video_width'] = 'De breedte van het Video Datei opgeven';
$lang['bbcode_no_video_width'] = ' U heeft geen breedte voor het Video bestand opgevens.';
$lang['bbcode_video_height'] = 'De hoogte van het Video bestand opgeven';
$lang['bbcode_no_video_height'] = ' U heeft geen hoogte voor het Video bestand opgegeven.';
$lang['bbcode_google_url'] = 'De URL van de site opgeven, die de Google Film bevat';
$lang['bbcode_youtube'] = 'De URL van de site opgeven, die de YouTube Film bevat';
$lang['bbcode_email'] = 'E-mail adres opgeven';
$lang['bbcode_no_email'] = ' U heeft geen E-mailadres opgeegeven.';
$lang['bbcode_flash_url'] = 'De URL van het Flash bestand opgeven';
$lang['bbcode_no_flash_url'] = ' U heb geen URL van een Flash bestand opgegeven.';
$lang['bbcode_flash_width'] = 'De Breedte van het Flash bestand opgeven';
$lang['bbcode_no_flash_width'] = ' U heeft geen breedte voor het Flash bestand opgegeven.';
$lang['bbcode_flash_height'] = 'De hoogte van het Flash bestand opgeven';
$lang['bbcode_no_flash_height'] = ' U heeftt geen hoogte voor het Flash bestand opgegeven.';
$lang['bbcode_no_message'] = 'U hebt geen bericht om te versturen opgegeven';
$lang['bbcode_url'] = 'URL opgeven';
$lang['bbcode_no_url'] = ' U hebt geen URL opgegeven';
$lang['bbcode_height'] = 'Weergave hoogte opgeven';
$lang['bbcode_width'] = 'Weergave breedtte opgeven';
$lang['bbcode_pagename'] = 'Naam vd site opgeven';
$lang['bbcode_web_pagename'] = 'Naam vd site';
$lang['bbcode_no_pagename'] = ' U hebt geen naam opgegeven.';
$lang['bbcode_img_url'] = 'URL van de afbeelding opgeven';
$lang['bbcode_no_img_url'] = ' U hebt geen URL van de afbeelding opgegeven';
$lang['bbcode_quote'] = 'Selecteer ergens op deze site tekst en probeer het opnieuw';

$lang['bbcode_font_type'] = 'Lettertype';
$lang['bbcode_font_default'] = 'Standaard lettertype';
$lang['bbcode_font_size'] = 'tekengrootte';
$lang['bbcode_font_color'] = 'Kleur letters';
$lang['bbcode_alt_justify'] = 'Blocktext';
$lang['bbcode_alt_right'] = 'rechts uitgelijnd';
$lang['bbcode_alt_center'] = 'Gecentreerd';
$lang['bbcode_alt_left'] = 'link uitgelijnd';
$lang['bbcode_alt_sup'] = 'Hooggeplaatst';
$lang['bbcode_alt_sub'] = 'Laaggeplaatst';
$lang['bbcode_alt_b'] = 'Vet';
$lang['bbcode_alt_i'] = 'Cursief';
$lang['bbcode_alt_u'] = 'onderstreept';
$lang['bbcode_alt_s'] = 'doorgestreept';
$lang['bbcode_alt_fade'] = 'Textverloop';
$lang['bbcode_alt_grad'] = 'kleurverloop';
$lang['bbcode_alt_rtl'] = 'rechts uitgelijnd';
$lang['bbcode_alt_ltr'] = 'links uitgelijnd';
$lang['bbcode_alt_marqd'] = 'Scrolltekst naar onderen';
$lang['bbcode_alt_marqu'] = 'Scrolltekst naar boven';
$lang['bbcode_alt_marql'] = 'Scrolltekst naar links';
$lang['bbcode_alt_marqr'] = 'Scrolltekst naar rechts';
$lang['bbcode_alt_quote'] = 'Citaat';
$lang['bbcode_alt_spoil'] = 'Spoiler';
$lang['bbcode_alt_img'] = 'Afbeelding';
$lang['bbcode_alt_list'] = 'Lijst';
$lang['bbcode_alt_hr'] = 'Scheidingslijn';
$lang['bbcode_alt_plain'] = 'BBcode verwijderen';
$lang['bbcode_alt_php'] = 'PHP';
$lang['bbcode_alt_code'] = 'Code';
$lang['bbcode_alt_url'] = 'URL';
$lang['bbcode_alt_email'] = 'Email';
$lang['bbcode_alt_flash'] = 'Flash';
$lang['bbcode_alt_video'] = 'Video';
$lang['bbcode_alt_stream'] = 'Stream';
$lang['bbcode_alt_realmedia'] = 'Real Media';
$lang['bbcode_alt_googlevid'] = 'Google Video';
$lang['bbcode_alt_youtube'] = 'You Tube Video';

$lang['Emoticons'] = 'Smilies';
$lang['More_emoticons'] = 'Meer smilies bekijken';
$lang['smilies_close'] = "Venster sluiten";

$lang['Font_color'] = 'Letterkleur';
$lang['color_default'] = 'Standaard';
$lang['color_dark_red'] = 'Donkerrood';
$lang['color_red'] = 'Rood';
$lang['color_orange'] = 'Orange';
$lang['color_brown'] = 'Bruin';
$lang['color_yellow'] = 'Geel';
$lang['color_green'] = 'Groen';
$lang['color_olive'] = 'Olijf';
$lang['color_cyan'] = 'Cyaan';
$lang['color_blue'] = 'Blauw';
$lang['color_dark_blue'] = 'donkerblauw';
$lang['color_indigo'] = 'Indigo';
$lang['color_violet'] = 'Violet';
$lang['color_white'] = 'Wit';
$lang['color_black'] = 'Zwart';

$lang['Font_size'] = 'Lettergroote';
$lang['font_tiny'] = 'Zeer klein';
$lang['font_small'] = 'Klein';
$lang['font_normal'] = 'Normaal';
$lang['font_large'] = 'Groot';
$lang['font_huge'] = 'Zeer groot';

$lang['Close_Tags'] = 'Tags sluiten';
$lang['Styles_tip'] = 'Tip: Stylen kunnen snel om geselecteerde tekst toegevoegd worden.';

?>