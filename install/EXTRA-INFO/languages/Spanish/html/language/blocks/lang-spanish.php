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

/*****[BEGIN]******************************************
 [ Lang:     Universal Block                   v1.0.0 ]
 ******************************************************/
define("_UNIFORUM","Foro/Tema");
define("_UNIAUTHOR","Autor");
define("_UNIREPLIES","Responder");
define("_UNIVIEWS","Ver");
define("_UNILASTPOST","Ultimo mensaje");
define("_UNIRECENT","Ver Temas Recientes");
define("_UNINEWTOPIC","Nuevo Tema");
define("_UNINEWPOST","Nuevo Mensaje");
/*****[END]********************************************
 [ Lang:     Universal Block                   v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Scrolling Forum Block             v1.0.0 ]
 ******************************************************/
define("_BBFORUM_TOTMEMBERS","Miembros");
define("_BBFORUM_FORUM","Foros");
define("_BBFORUM_SEARCH","Buscar");
define("_BBFORUM_STAFF","Personal");
define("_BBFORUM_RANKS","Filas");
define("_BBFORUM_RULES","Reglas");
define("_BBFORUM_STATS","Estadisticas");
define("_BBFORUM_LAST","Ultimo");
define("_BBFORUM_MESSAGES","Mensajes");
define("_BBFORUM_LAST_POST","Ultimo anuncio de");
define("_BBFORUM_ON","on");
/*****[END]********************************************
 [ Lang:     Scrolling Forum Block             v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     NukeSentinel Blocks               v1.0.0 ]
 ******************************************************/
define("_AB_WARNED","Usted ha sido advertido!");
define("_AB_CAUGHT","Hemos capturado");
define("_AB_SHAME","Vergonzoso hackers.");
define("_AB_LIST","Esta es la lista de NukeSentinel(tm) prohibidas las direcciones IP.");
/*****[END]********************************************
 [ Lang:     NukeSentinel Blocks               v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Newsletter Block                  v1.0.0 ]
 ******************************************************/
define("_NEWSLOGGED","Usted debe estar conectado a nuestro boletin de suscripcion!");
define("_NEWSERROR","Error al recuperar boletin configuracion");
define("_NEWSCLICK","Click");
define("_NEWSRECIEVE","para recibir nuestros boletines");
define("_NEWSSTOP","para dejar de recibir nuestros boletines");
define("_NEWSHERE","Aqui");
/*****[END]********************************************
 [ Lang:     Newsletter Block                  v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Donations Block                   v1.0.0 ]
 ******************************************************/
define("_DONATE","Donaciones");
define("_DONATE_ANON","Anonimos");
define("_DONATE_TOTAL","Total:");
define("_DONATE_GOAL","Objetivo:");
define("_DONATE_DIF","Diferencia:");
/*****[END]********************************************
 [ Lang:     Donations Block                   v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Modules Block                     v1.0.0 ]
 ******************************************************/
define("_MORE","More");
define("_INACTIVE_LINKS","Enlaces inactivos");
define("_MB_MVIEWANON","Solo usuarios anonimos");
define("_MB_MODULEUSERS","Solo Usuarios Registrados");
define("_MB_MODULESADMINS","Solo administradores");
define("_MB_MODULESGROUP","Solo grupo de usuarios");
/*****[END]********************************************
 [ Lang:     Modules Block                     v1.0.0 ]
 ******************************************************/

define("_NEWSLETTER","Newsletter");
define("_LANG_NO_MULTILINGUAL", "Multilingue no esta activado");
define("_NO_REFERERS","Enlaces para no mostrar");

/*****[BEGIN]******************************************
 [ Lang:     Forums Block                      v1.0.0 ]
 ******************************************************/
define("_BF_NEW_TOPIC","Nuevo Tema");
define("_BF_NEW_POST","Nuevo Mensaje");
define("_BF_TOPIC","Tema");
define("_BF_FORUM"," Foro ");
define("_BF_AUTHOR"," Autor ");
define("_BF_REPLIES"," Respuestas ");
define("_BF_VIEWS"," Ver ");
define("_BF_LAST_POST"," Ultimo mensaje ");
define("_BF_ANNOUNC","Anuncios");
define("_BF_NO_ANNOUNC","No hay anuncios.");
define("_BF_TOPICS","Temas");
define("_BF_NO_TOPICS","No hay temas.");
define("_BF_RECENT_TOPICS","Temas recientes");
/*****[END]********************************************
 [ Lang:     Forums Block                      v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Evo-Topics Block                  v1.0.0 ]
 ******************************************************/
define("_EVO_TOPIC_FORUM","Foro");
define("_EVO_TOPIC_FORUMS","Foros");
define("_EVO_TOPIC_TOPIC","Tema");
define("_EVO_TOPIC_TOPICS","Temas");
define("_EVO_TOPIC_POST","Mensaje");
define("_EVO_TOPIC_POSTS","Mensajes");
define("_EVO_TOPIC_ANNOUNCE","Anuncios");
define("_EVO_TOPIC_ANNOUNCENO","No hay Anuncios");
define("_EVO_TOPIC_CREATEDBY","creado por");
define("_EVO_TOPIC_CREATEDON","en");
define("_EVO_TOPIC_WEHAVE","Tenemos");
define("_EVO_TOPIC_COUNTVIEWS","Ver");
define("_EVO_TOPIC_COUNTREPLIES","Respuestas");
define("_EVO_TOPIC_NOTOPIC","Ningun Temas para mostrar");
define("_EVO_TOPIC_RECENT","Temas recientes");
/*****[END]********************************************
 [ Lang:     Evo-Topics Block                  v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Web Links Block                   v1.0.0 ]
 ******************************************************/
$lang_block['BLOCK_WEBLINKS_FULL_VIEW'] = 'Visite este enlace';
$lang_block['BLOCK_WEBLINKS_VISIT'] = 'Visita';
/*****[END]********************************************
 [ Lang:     Web Links Block                   v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Reviews Block                     v1.0.0 ]
 ******************************************************/
$lang_block['BLOCK_REVIEWS_FULL_VIEW'] = 'Ver esta revisión';
$lang_block['BLOCK_REVIEWS_VISIT'] = 'Visita';
/*****[END]********************************************
 [ Lang:     Reviews Block                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Link_Us Block                     v1.0.0 ]
 ******************************************************/
define("_LINKUS_VIEW_ALL_BUTTONS","Ver todos los botones");
define("_LINKUS_CLICKS","Haga clic en");
/*****[END]********************************************
 [ Lang:     Link_Us Block                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     News Centerblock                  v1.0.0 ]
 ******************************************************/
define("_NE_ALLTOPICS","Ver todos los temas");
/*****[END]********************************************
 [ Lang:     News Centerblock                  v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Groups Block                      v1.0.0 ]
 ******************************************************/
$lang_block['Current_memberships'] = 'Afiliaciones actuales';
$lang_block['Memberships_pending'] = 'En espera de Membresias';
$lang_block['Group_member_join'] = 'Unete a grupos';
/*****[END]********************************************
 [ Lang:     Groups Block                      v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Downloads-Access                  v1.0.0 ]
 ******************************************************/
$lang_block['Download_Top_Downloads'] = 'Top Descargas';
$lang_block['Download_Top_Uploader'] = 'Top Subidas';
$lang_block['Download_Statistic'] = 'Descargar estadistica';
$lang_block['Download_Total_Files'] = 'Descargar archivos';
$lang_block['Download_Total_Hits'] = 'Descargas aciertos';
/*****[END]********************************************
[ Lang:     Downloads-Access                  v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Lang:     Multilingual Block Titles         v1.0.0 ]
 ******************************************************/
$lang_block['block-Administration'] = 'Administracion';
$lang_block['block-Advertising'] = 'Publicidad';
$lang_block['block-Big_Story_of_Today'] = 'Gran historia de hoy';
$lang_block['block-Categories'] = 'Categorias';
$lang_block['block-Content'] = 'Contenido';
$lang_block['block-Donations'] = 'Donaciones';
$lang_block['block-Downloads-Access'] = 'Descargas estadisticas<br />Access';
$lang_block['block-Downloads-Hot'] = 'Descargas estadisticas<br />Hot';
$lang_block['block-Downloads-New'] = 'Descargas nuevas';
$lang_block['block-Evo_User_Info'] = 'Info Usuarios';
$lang_block['block-EvoForums'] = 'Foros';
$lang_block['block-EvoTopics'] = 'Foro temas';
$lang_block['block-Forums'] = 'Foros';
$lang_block['block-Forums_Scroll'] = 'Foros';
$lang_block['block-Groups'] = 'Grupos';
$lang_block['block-Hacker_Beware'] = 'Hackers';
$lang_block['block-Hacker_Beware2'] = 'Hackers';
$lang_block['block-Hacker_Beware3'] = 'Hackers';
$lang_block['block-Languages'] = 'Lenguajes';
$lang_block['block-Last_5_Articles'] = 'Ultimos 5 articulos';
$lang_block['block-Last_5_Reviews'] = 'Ultimos 5 Comentarios';
$lang_block['block-Last_Referers'] = 'Ultimos Referentes';
$lang_block['block-Link-us'] = 'Enlacenos';
$lang_block['block-Modules'] = 'Menu Principal';
$lang_block['block-Newsletter'] = 'Noticias carta';
$lang_block['block-Nuke-Evolution'] = 'Nuke-Evolution Red';
$lang_block['block-Old_Articles'] = 'Articulos antiguos';
$lang_block['block-Random_Headlines'] = 'Titulares aleatorio';
$lang_block['block-Random_Links'] = 'Enlaces Aleatorio';
$lang_block['block-Reviews'] = 'Comentarios';
$lang_block['block-ScrollingSentinel'] = 'Hackers ';
$lang_block['block-Search'] = 'Buscar';
$lang_block['block-Sentinel'] = 'Hackers';
$lang_block['block-Sentinel_Center'] = 'Hackers';
$lang_block['block-Sentinel_Scrolling'] = 'Hackers';
$lang_block['block-Sentinel_Side'] = 'Hackers';
$lang_block['block-Sommaire'] = 'Menu Principal';
$lang_block['block-Submissions'] = 'Peticiones';
$lang_block['block-Supporters_Dn'] = 'Aficionados';
$lang_block['block-Supporters_Lt'] = 'Aficionados';
$lang_block['block-Supporters_Rn'] = 'Aficionados';
$lang_block['block-Supporters_Rt'] = 'Aficionados';
$lang_block['block-Supporters_Up'] = 'Aficionados';
$lang_block['block-Survey'] = 'Encuestas';
$lang_block['block-Themes'] = 'Temas';
$lang_block['block-Top10_Links'] = 'Top 10 Enlaces';
$lang_block['block-Total_Hits'] = 'Visitas';
$lang_block['block-Universal-Forums-Center'] = 'Foros';
$lang_block['block-User_Info'] = 'Informacion del usuario';
$lang_block['block-User_Login'] = 'Conectarse';
$lang_block['block-Who_is_Online'] = 'Quien esta en linea';
/*****[END]********************************************
 [ Lang:     Multilingual Block Titles         v1.0.0 ]
 ******************************************************/

?>