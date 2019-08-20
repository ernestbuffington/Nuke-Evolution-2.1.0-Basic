<?php
/*=======================================================================
 Nuke-Evolution		: 	Enhanced Web Portal System
 ========================================================================
 
 Nuke-Evo Base          :		BASIC
 Nuke-Evo Version       :		2.1.0RC2
 Nuke-Evo Build         :		2352
 Nuke-Evo Patch         :		---
 Nuke-Evo Filename      :		#$#FILENAME
 Nuke-Evo Date          :		03-Feb-2009

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

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('ERROR: SERVERPATH AND FILELOCATION ARE DIFFERENT');
}

$bbcode_lang['Emoticons'] = 'Emoticonos';
$bbcode_lang['More_emoticons'] = 'Ver mas Emoticonos';
$bbcode_lang['smilies_close'] = 'Cerrar Ventaba';

$lang['bbcode_b_help'] = 'Texto en negrita: [b]texto[/b]  (alt+b)';
$lang['bbcode_i_help'] = 'Texto en cursiva: [i]texto[/i]  (alt+i)';
$lang['bbcode_u_help'] = 'Subrayar texto: [u]texto[/u]  (alt+u)';
$lang['bbcode_q_help'] = 'Citar texto: [citar]texto[/citar]  (alt+q)';
$lang['bbcode_c_help'] = 'Pantalla de codigos: [codigo]codigo[/codigo]  (alt+c)';
$lang['bbcode_l_help'] = 'Lista: [lista]texto[/lista] (alt+l)';
$lang['bbcode_o_help'] = 'Lista ordenada: [lista=]texto[/lista]  (alt+o)';
$lang['bbcode_p_help'] = 'Insertar imagen: [img]http://image_url[/img]  (alt+p)';
$lang['bbcode_w_help'] = 'Insertar URL: [url]http://url[/url] o [url=http://url]URL texto[/url]  (alt+w)';
$lang['bbcode_a_help'] = 'Cierre todas las etiquetas bbCode libre';
$lang['bbcode_size_help'] = 'Fuente tama&ntilde;o: [tama&ntilde;o=x-peque&ntilde;o]texto[/tama&ntilde;o]';
$lang['bbcode_color_help'] = 'Fuente color: [color=rojo]texto[/color]  Sugerencia: también puede usar color=#FF0000';
$lang['bbcode_font_help'] = 'Tipo de fuente: [fuente=Arial]texto[/fuente]';
$lang['GVideo_link'] = 'Link';
$lang['youtube_link'] = 'Link';

$lang['bbcode_quote_help'] = 'Citar: [citar]texto[/citar]';
$lang['bbcode_code_help'] = 'Codigo: [codigo]codigo[/codigo]';
$lang['bbcode_php_help'] = 'PHP: [php]codigo[/php]';
$lang['bbcode_spoil_help'] = 'Aleron: [malograr]texto[/malograr]';
$lang['bbcode_img_help'] = 'Insertar Imagen: [img]http://ruta de la imagen[/img]';
$lang['bbcode_url_help'] = 'Insertar URL: [url]http://hvmdesign.com[/url] o [url=http://hvmdesign.com]Medios alta velocidad[/url]';
$lang['bbcode_ft_help'] = 'Tipo de Fuente: [font=Tahoma]texto[/fuente]';
$lang['bbcode_rtl_help'] = 'Hacer el cuadro de mensaje Alinear desde la derecha a izquierda';
$lang['bbcode_ltr_help'] = 'Hacer el cuadro de mensaje Alinear desde la izquierda a derecha';
$lang['bbcode_mail_help'] = 'Insertar Email: [email]forum@hvmdesign.com[/email]';
$lang['bbcode_grad_help'] ='Insertar texto de degradado (Internet Explorer Solo)';
$lang['bbcode_right_help'] = 'texto conjunto Alinear a la derecha: [alinear=derecha]texto[/align]';
$lang['bbcode_left_help'] = 'texto conjunto Alinear a la izquierda: [alinear=izquierda]texto[/align]';
$lang['bbcode_center_help'] = 'Alinear texto conjunto al Centro: [alinear=centro]texto[/align]';
$lang['bbcode_justify_help'] = 'justificar texto: [alinear=justificar]texto[/alinear]';
$lang['bbcode_marqr_help'] = 'Marque texto a la derecha: [marq=derecha]texto[/marq]';
$lang['bbcode_marql_help'] = 'Marque texto a la izquierda: [marq=izquierda]texto[/marq]';
$lang['bbcode_marqu_help'] = 'Marque texto arriba: [marq=arriba]texto[/marq]';
$lang['bbcode_marqd_help'] = 'Marque texto abajo: [marq=abajo]texto[/marq]';
$lang['bbcode_stream_help'] = 'Insertar el archivo de secuencia: [secuencia]Archivo URL[/secuencia]';
$lang['bbcode_ram_help'] = 'Insertar archivo real media: [ram]Archivo URL[/ram]';
$lang['bbcode_plain_help'] = 'Quitar BBCodes el texto seleccionado';
$lang['bbcode_hr_help'] = 'Insertar salto de linea [hr]';
$lang['bbcode_video_help'] = 'Insertar el archivo de video: [video ancho=# alto=#]archivo URL[/video]';
$lang['bbcode_flash_help'] = 'Insertar archivo flash: [flash ancho=# alto=#]flash URL[/flash]';
$lang['bbcode_fade_help'] = 'Fundido de texto: [fundido]texto[/fundido] (Internet Explorer Solo)';
$lang['bbcode_list_help'] = 'Lista ordenada: [lista|=1|a]texto[/lista] Sugerencia: puede utilizar [*] para insertar bala';
$lang['bbcode_strike_help'] = 'Tachar texto: [s]texto[/s]';
$lang['bbcode_sup_help'] = 'Superscript: [sup]texto[/sup]';
$lang['bbcode_sub_help'] = 'Subscript: [sub]texto[/sub]';
$lang['bbcode_symbol_help'] = 'Insertar simbolo en Anuncio';
$lang['bbcode_youtube_help'] = 'YouTube: [youtube]YouTube URL[/youtube]';
$lang['bbcode_googlevid_help'] = 'Google: [GVideo]Google Video URL[/GVideo]';

$lang['bbcode_text_first'] = 'Por favor, seleccione el texto en primer lugar';
$lang['bbcode_less_letters'] = 'Esto solo funciona para las letras menos 120';
$lang['bbcode_rm_url'] = 'Escriba la direccion URL de archivo de medios de comunicacion real';
$lang['bbcode_no_file_url'] = ' Usted no ha escrito la URL del archivo.';
$lang['bbcode_rm_width'] = 'Introduzca el ancho de archivo real medios de comunicacion';
$lang['bbcode_no_rm_width'] = ' No ha especificado el ancho de archivo de medios de comunicacion real.';
$lang['bbcode_rm_height'] = 'Introduzca la altura de archivo de medios de comunicacion real';
$lang['bbcode_no_rm_height'] = ' No ha especificado la altura de archivo de medios de comunicacion real.';
$lang['bbcode_error'] = 'Error:';
$lang['bbcode_stream_url'] = 'Escriba la direccion URL del archivo de secuencia';
$lang['bbcode_video_url'] = 'Por favor, escriba la direccion URL de archivo de video';
$lang['bbcode_video_width'] = 'Introduzca el ancho del archivo de video';
$lang['bbcode_no_video_width'] = ' No ha introducido el ancho del archivo de video.';
$lang['bbcode_video_height'] = 'Introduzca la altura del archivo de video';
$lang['bbcode_no_video_height'] = ' No ha introducido la altura del archivo de video.';
$lang['bbcode_google_url'] = 'Dar la direccion URL de la pagina que contiene la pelicula Google';
$lang['bbcode_youtube'] = 'Dar la direccion URL de la pagina que contiene la pelicula a YouTube';
$lang['bbcode_email'] = ' Introduzca la direccion de correo electronico.';
$lang['bbcode_no_email'] = ' Usted no escribe la direccion de correo electronico.';
$lang['bbcode_flash_url'] = 'Introduzca la URL de archivo flash';
$lang['bbcode_no_flash_url'] = ' Usted no escribir la URL de archivo flash.';
$lang['bbcode_flash_width'] = 'Introduzca el ancho de flash';
$lang['bbcode_no_flash_width'] = ' Usted no escribir el ancho del flasho.';
$lang['bbcode_flash_height'] = 'Introduzca la altura de flash';
$lang['bbcode_no_flash_height'] = ' Usted no escribir la altura del flash.';
$lang['bbcode_no_message'] = 'Debe introducir un mensaje al publicar';
$lang['bbcode_url'] = 'Introduzca la URL';
$lang['bbcode_no_url'] = ' Usted no escribir la URL';
$lang['bbcode_height'] = 'Introduzca la altura para mostrar';
$lang['bbcode_width'] = 'Introduzca el ancho para mostrar';
$lang['bbcode_pagename'] = 'Introduzca el nombre de la pagina';
$lang['bbcode_web_pagename'] = 'Nombre Pagina Web';
$lang['bbcode_no_pagename'] = ' Usted no escribir el nombre de la pagina.';
$lang['bbcode_img_url'] = 'Introduzca la URL de la imagen';
$lang['bbcode_no_img_url'] = ' Usted no escribir la URL de la imagen';
$lang['bbcode_quote'] = 'Seleccione un texto en una pagina e intentalo de nuevo';

$lang['bbcode_font_type'] = 'Tipo de fuente';
$lang['bbcode_font_default'] = 'Fuente por defecto';
$lang['bbcode_font_size'] = 'Tama&ntilde;o de fuente';
$lang['bbcode_font_color'] = 'Color de fuente';
$lang['bbcode_alt_justify'] = 'Justifique';
$lang['bbcode_alt_right'] = 'derecha';
$lang['bbcode_alt_center'] = 'centro';
$lang['bbcode_alt_left'] = 'izquierda';
$lang['bbcode_alt_sup'] = 'superscript';
$lang['bbcode_alt_sub'] = 'subscript';
$lang['bbcode_alt_b'] = 'negrita';
$lang['bbcode_alt_i'] = 'italica';
$lang['bbcode_alt_u'] = 'Debajo de linea';
$lang['bbcode_alt_s'] = 'Tachar';
$lang['bbcode_alt_fade'] = 'fundido';
$lang['bbcode_alt_grad'] = 'degradado';
$lang['bbcode_alt_rtl'] = 'Derecha a izquierda';
$lang['bbcode_alt_ltr'] = 'Izquierda a derecha';
$lang['bbcode_alt_marqd'] = 'Marque para abajo';
$lang['bbcode_alt_marqu'] = 'Marque para arriba';
$lang['bbcode_alt_marql'] = 'Marque a izquierda';
$lang['bbcode_alt_marqr'] = 'Marque a derecha';
$lang['bbcode_alt_quote'] = 'Citar';
$lang['bbcode_alt_spoil'] = 'Aleron';
$lang['bbcode_alt_img'] = 'Imagen';
$lang['bbcode_alt_list'] = 'Lista';
$lang['bbcode_alt_hr'] = 'H-Linea';
$lang['bbcode_alt_plain'] = 'Remover BBcode';
$lang['bbcode_alt_php'] = 'PHP';
$lang['bbcode_alt_code'] = 'Codigo';
$lang['bbcode_alt_url'] = 'URL';
$lang['bbcode_alt_email'] = 'Email';
$lang['bbcode_alt_flash'] = 'Flash';
$lang['bbcode_alt_video'] = 'Video';
$lang['bbcode_alt_stream'] = 'Secuencia';
$lang['bbcode_alt_realmedia'] = 'Real Media';
$lang['bbcode_alt_googlevid'] = 'Google Video';
$lang['bbcode_alt_youtube'] = 'You Tube Video';

$lang['Emoticons'] = 'Emoticonos';
$lang['More_emoticons'] = 'Ver mas emoticonos';
$lang['smilies_close'] = 'Cerrar Ventana';

$lang['Font_color'] = 'Color de fuente';
$lang['color_default'] = 'Por defecto';
$lang['color_dark_red'] = 'Rojo oscuro';
$lang['color_red'] = 'Rojo';
$lang['color_orange'] = 'Naranja';
$lang['color_brown'] = 'Cafe';
$lang['color_yellow'] = 'Amarillo';
$lang['color_green'] = 'Verde';
$lang['color_olive'] = 'Aceituna';
$lang['color_cyan'] = 'Celeste';
$lang['color_blue'] = 'Azul';
$lang['color_dark_blue'] = 'Azul Oscuro';
$lang['color_indigo'] = 'Azul turqui';
$lang['color_violet'] = 'Violeta';
$lang['color_white'] = 'Blanco';
$lang['color_black'] = 'Negro';

$lang['Font_size'] = 'Tama&ntilde;o de Fuente';
$lang['font_tiny'] = 'Muy peque&ntilde;o';
$lang['font_small'] = 'Peque&ntilde;o';
$lang['font_normal'] = 'Normal';
$lang['font_large'] = 'Grande';
$lang['font_huge'] = 'Enorme';

$lang['Close_Tags'] = 'Cerrar Etiquetas';
$lang['Styles_tip'] = 'Aviso: Los estilos pueden ser aplicados rapidamente para texto seleccionado.';

?>