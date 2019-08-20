<?php
/*=======================================================================
 Nuke-Evolution   :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :   BASIC
 Nuke-Evo Version       :   2.1.0RC2
 Nuke-Evo Build         :   2352
 Nuke-Evo Patch         :   ---
 Nuke-Evo Filename      :   #$#FILENAME
 Nuke-Evo Date          :   03-Feb-2009
 Nuke-Evo Author        :   ReOrGaNiSaTiOn

 Copyright (c) 2008 by The Nuke-Evolution Development Team
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

// General entries were no UTF-8 are accepted
$lang_install['Next']  = 'SIGUIENTE PASO';
$lang_install['Back']  = 'ULTIMA ETAPA';
$lang_install['Restart']  = 'REINICIAR';
$lang_install['Help']  = 'AYUDA';
$lang_install['IMG_OK']  = 'Compruebe si esta bien';
$lang_install['IMG_BAD']  = 'Comprobar error';
$lang_install['IMG_WARN']  = 'Solo advertencia, no hay ningun error';
$lang_install['IMG_DONE']  = 'Hecho';

// General entries with UTF-8 support
$lang_install['Langcode'] = 'en-es';
$lang_install['Landdir']  = 'ltr';
$lang_install['No']  = 'No';
$lang_install['Yes']  = 'Si';

$lang_install['Head_Title'] = 'Instalacion';
$lang_install['Block_Title'] = 'Estado';
$lang_install['Block_Step_0'] = 'Bienvenido';
$lang_install['Block_Step_1'] = 'Informacion';
$lang_install['Block_Step_2'] = 'Ajustes Archivos';
$lang_install['Block_Step_3'] = 'DB-Configuracion';
$lang_install['Block_Step_4'] = 'DB-Instalacion';
$lang_install['Block_Step_5'] = 'Ajustes de base';
$lang_install['Block_Step_6'] = 'Administrar Cuenta';
$lang_install['Block_Step_7'] = 'DB-Ajustes base';
$lang_install['Block_Step_8'] = 'Terminado';
$lang_install['Block_Step_9'] = 'Registro';

// Help-System
if (!defined('_EVO_HELPSYSTEM')) {
    define('_EVO_HELPSYSTEM', 'Evo Ayuda');
}

// Step Welcome
$lang_install['Welcome'] = 'Felicidades<br/><br/>Va a instalar >> '.$var_install['version'].' <<<br/>Este procedimiento de instalacion le guiara a traves de algunos datos necesarios para la instalacion, realizar algunas pruebas y configurar los ajustes de la base de datos';
$lang_install['Language_Select'] = 'Si no tienes una opcion para otro idioma en el cuadro de seleccion, a continuacion, si no copie su idioma ha la carpeta de idioma de los archivos descargados de Evo en el servidor.';

// Step Infos
$lang_install['Infos_Title'] = 'Hemos verificado su sistema.<br />A continuacion encuentras la informacion que hemos encontrado y si hay cualquier advertencias o errores.<br />';
$lang_install['DB_Setup'] = 'En este paso, se inicializa la conexion de base de datos.<br />Toda la informacion necesaria debe estar disponible de su proveedor, o usted debe tener definido por usted en el momento que ha creado la base de datos<br />'; 

// Language entries for Installer
$lang_install['Date']    = 'Fecha';
$lang_install['Step']    = 'Paso';
$lang_install['Last_Step']    = 'ultimo Paso';
$lang_install['Log_Message']    = 'Mensaje';
$lang_install['Submit'] = 'Enviar valores';

$lang_install['Installation_started'] = 'Comenzo la instalacion';
$lang_install['Server_Configuration_Details'] = 'Detalles de configuracion del servidor';
$lang_install['Server_Configuration_Summary'] = 'Resumen de configuracion del servidor';
$lang_install['DB_Installation'] = 'Creacion de tablas de base de datos';
$lang_install['Installation_Start_failed'] = 'Se encontraron errores graves, que hace poco probable-Nuke Evolucion que pueda funcionar sin problemas en su servidor.<br />Click on "Help" to read our Wiki, there you will find, which Base settings we need to run a proper installation.<br />Tips, Tricks and recommended Hosts, that Nuke-Evolution runs on, can be found in our Forum.';
$lang_install['Errors_found'] = 'Los errores que encontramos';
$lang_install['Warnings_found'] = 'Advertencias encontramos';

$lang_install['File_Setup'] = 'Archivo de configuracion';
$lang_install['File_error'] = 'Error: El archivo no esta disponible.';
$lang_install['File_notchanged'] = 'Advertencia: nosotros no podemos cambiar los permisos';
$lang_install['File_done'] = 'Ok: Permisos se han cambiado';
$lang_install['File_htaccess'] = 'File: .htacess';
$lang_install['File_Help_htaccess'] = '';
$lang_install['File_staccess'] = 'File: .staccess';
$lang_install['File_Help_staccess'] = '';
$lang_install['File_ultramode'] = 'File: Ultramode';
$lang_install['File_Help_ultramode'] = '';
$lang_install['File_errorlog'] = 'File for error logging: errorlog.txt';
$lang_install['File_Help_errorlog'] = '';
$lang_install['File_adminlog'] = 'File for logging administration messages: adminlog.txt';
$lang_install['File_Help_adminlog'] = '';
$lang_install['File_ForumsCacheDir'] = 'Directory: Forum Cache';
$lang_install['File_Help_ForumsCacheDir'] = '';
$lang_install['File_FilesDir'] = 'Directory: Forum File Up-/Download';
$lang_install['File_Help_FilesDir'] = '';
$lang_install['File_FilesThumbDir'] = 'Directory: Forum Thumbnails';
$lang_install['File_Help_FilesThumbDir'] = '';
$lang_install['File_AvatarDir'] = 'Directory: Avatars';
$lang_install['File_Help_AvatarDir'] = '';
$lang_install['File_LangBBCode'] = 'File: Languagefile for BBCode';
$lang_install['File_Help_LangBBCode'] = '';
$lang_install['File_LangFAQ'] = 'File: Languagefile for FAQ';
$lang_install['File_Help_LangFAQ'] = '';
$lang_install['File_LangFAQAttach'] = 'File: Languagefile for FAQ Attachements';
$lang_install['File_Help_LangFAQAttach'] = '';
$lang_install['File_LangRules'] = 'File: Languagefile for Forumrules';
$lang_install['File_Help_LangRules'] = '';
$lang_install['File_ForumModules'] = 'Directory: Forummoduls';
$lang_install['File_Help_ForumModules'] = '';
$lang_install['File_ForumModulesCache'] = 'Directory: Forummodules Cache';
$lang_install['File_Help_ForumModulesCache'] = '';
$lang_install['File_ForumModulesCacheExplain'] = 'Directory: Forummodule Cache Explainations';
$lang_install['File_Help_ForumModulesCacheExplain'] = '';
$lang_install['File_SupportersImagesSupporters'] = 'Directory: Supporter Banner';
$lang_install['File_Help_SupportersImagesSupporters'] = '';
$lang_install['File_IncludesCache'] = 'Directory: Cachedirectory';
$lang_install['File_Help_IncludesCache'] = '';
$lang_install['File_IncludesCacheFile'] = 'File: Cachefile';
$lang_install['File_Help_IncludesCacheFile'] = '';
$lang_install['File_HTMLPurifierDecorator'] = 'Directory: HTML-Purifier Decorator';
$lang_install['File_Help_HTMLPurifierDecorator'] = '';
$lang_install['File_HTMLPurifierSerializer'] = 'Directory: HTML-Purifier Serializer';
$lang_install['File_Help_HTMLPurifierSerializer'] = '';
$lang_install['File_HTMLPurifierSerializerHtml'] = 'Directory: HTML-Purifier Serializer HTML';
$lang_install['File_Help_HTMLPurifierSerializerHtml'] = '';
$lang_install['File_IconModDefIcons'] = 'File: Icon Mod defined Icons';
$lang_install['File_Help_IconModDefIcons'] = '';
$lang_install['File_CantOpen'] = 'No se puede abrir el archivo';
$lang_install['File_CantWrite'] = 'No se puede escribir el archivo';

$lang_install['DB_Host'] = 'Nombre del Host';
$lang_install['DB_Help_Host'] = 'Nombre de la base de datos del servidor. Normalmente \'localhost\', que se utiliza por defecto de nosotros. Puede utilizar la direccion IP, lo que reducira las busquedas de DNS.'; 
$lang_install['DB_Name'] = 'Nombre de la base de datos';
$lang_install['DB_Help_Name'] = 'Nombre de la Base de Datos<br />Ya sea la base de datos fue creada a traves de su proveedor (en este caso se debe tener el nombre de su proveedor) o que haya creado la base de datos usted mismo (en este caso tenemos el nombre que le dieron su base de datos sobre su creacion).';
$lang_install['DB_Username'] = 'Conexion Nombre de usuario';
$lang_install['DB_Help_Username'] = 'Database Username<br />El nombre de usuario utilizado para conectarse a la base de datos.<br />Ya sea que tienes el nombre de su proveedor o que ha creado esta base de datos cuenta por ti mismo.';
$lang_install['DB_Password'] = 'Conexion Contrase&ntilde;a';
$lang_install['DB_Help_Password'] = 'Conexion Contrase&ntilde;a<br />La contrase&ntilde;a necesaria para conectarse a la base de datos.<br />O bien tienes la contrase&ntilde;a de su proveedor o la contrase&ntilde;a que ha definido por usted al crear la base de datos de usuario.';
$lang_install['DB_Type'] = 'Tipo de base de datos';
$lang_install['DB_Help_Type'] = 'Tipo de base de datos<br />El tipo de su base de datos. Hemos verificado el sistema. Base de datos de todos los tipos podria ser seleccionado.';
$lang_install['DB_Prefix'] = 'Tabla prefijo (Estandar: evo)';
$lang_install['DB_Help_Prefix'] = 'Tabla prefijo<br />Cada tabla debe tener un nombre unico dentro de la base de datos. Debido a que usted puede utilizar su base de datos de varios sistemas, cada sistema debe utilizar un prefijo propio. Significa una cadena unica que se agrega al nombre de tabla. Norma para nuestro sistema es \'evo_\'. Significa que todas las tablas que crear o utilizas comenzara con \'evo_\'.';
$lang_install['DB_Conf_wrong'] = 'No hemos podido establecer una conexion con el servidor de base de datos.<br />Por favor, compruebe sus entradas y volver a intentarlo';
$lang_install['DB_DB_wrong'] = 'Se podria establecer una conexion con el servidor de base de datos, pero no a su base de datos.<br />Por favor, compruebe sus entradas y volver a intentarlo';
$lang_install['DB_Conf_ok'] = 'Se pudo establecer una conexion a su base de datos.<br />Las entradas estan ok.';
$lang_install['DB_Prefix_exists'] = 'Existen cuadros con el mismo prefijo.';
$lang_install['DB_Delete_Existing'] = 'Hay que sobrescribir/eliminar las tablas existentes';
$lang_install['DB_Help_Delete_Existing'] = 'Borrar tablas/sobrescribir<br />Hemos encontrado tablas en su base de datos ya sea de una vieja instalacion que ha seleccionado o un prefijo que esta todo listo en el uso de otro sistema.<br />Con \'No\', no eliminar las tablas existentes. Comprobamos, si todos los aspectos necesarios y se dispone de indices. Si no se agrega o cambia.<br />Con \'Si\' borrar el viejo y crear tablas nuevas. Este es el metodo mas seguro para un correcto funcionamiento del sistema.';
$lang_install['DB_Help_Update_Existing'] = 'Encontrar la conexion ya existente<br/>Hemos detectado un archivo de configuracion. Con las informaciones incluidas, se podria establecer una conexion con la base de datos.<br />Parece que esta podria ser una actualizacion mas que una instalacion nueva.<br />Si selecciona \'actualizar\' solo marque las tablass existentes y el cambio a la nueva configuracion o agregar tablas existentes no.';
$lang_install['DB_Update_Existing'] = 'Se trata de una actualizacion de una instalacion existente o una nueva instalacion';
$lang_install['DB_Update_Question'] = 'Parece que esta es una actualizacion, en lugar de una instalacion nueva. Por favor, envie la forma, el instalador debe manejar esta instalacion.';
$lang_install['DB_Help_Update_Convert'] = 'Normalmente, todos los sistemas antiguos hicieron uso de Caracteres ISO-8859-1. Nuke-Evo> 2.1.0 usa UTF-8, una de Caracteres multibyte internacional. Si selecciona Si, todos se convertira en la base de datos a texto UTF-8.';
$lang_install['DB_Update_Convert'] = 'Convertimos de Caracteres ISO-8859-1 a UTF-8 ?';
$lang_install['DB_Update'] = 'Actualizar';
$lang_install['DB_No_Convertion'] = 'Ninguna conversion';
$lang_install['DB_Convert'] = 'Conversion';
$lang_install['DB_Installation'] = 'Nueva instalacion';
$lang_install['DB_Upgrade'] = 'Actualizar la base de datos';
$lang_install['DB_Help_DiffUserPrefix'] = 'Prefijo diferente para el usuario de tablas<br />Su configuracion actual muestra las tablas prefijos diferentes. Este instalador no es compatible con prefijos differente. Puede cambiar el nombre de su user_table y user_temp_table para encajar el prefijo para las otras tablas. A continuacion, reinicie el programa de instalacion y seleccione \'Si\' sobre la cuestion si el instalador debe modificar el user_prefix. Despues de la instalacion, puede cambiar el nombre de su nuevo user_table y user_temp_table a su antiguo prefijo. Tienes que cambiar tu config.php demasiado.';
$lang_install['DB_DiffUserPrefix'] = 'Quieres que el instalador de cambie el prefijo de las tablas de usuario';
$lang_install['DB_DiffUserPrefixMore'] = 'Su actual confguration muestra diferentes prefijos para sus tablas-PP.<br />Si selecciona \'Si\', en la instalacion trataremos de cambiar el nombre de las tablas para adaptarse a un prefijo para todos los cuadros. Si selecciona \'NO\', the installation can\'t be continued by the installer.<br />Klick our help image for more informations.';
$lang_install['DB_Table_Exists'] = 'Tabla existe';
$lang_install['DB_Table_NotExists'] = 'Tabla debe ser creada';
$lang_install['DB_Table_Done'] = 'Tabla creada con exito';
$lang_install['DB_Table_Warning_override'] = 'Que ha decidido anular las tablas existentes. Todos los datos dentro de ellos se perderan !!<br />Puede volver o reiniciar la instalacion si esto fue una decision equivocada.';
$lang_install['DB_Table_Create_in_process'] = 'Creacion de tabla en proceso .... no interrumpir !!';
$lang_install['DB_Table_Deleted'] = 'Tabla eliminado';
$lang_install['DB_Table_Created'] = 'Tabla creada';
$lang_install['DB_Table_Checked'] = 'Tabla comprobada';
$lang_install['DB_Table_Identical'] = 'Tabla es identica a la nueva configuracion de tabla de instalacion';
$lang_install['DB_Table_Changed'] = 'Tabla ha cambiado a ajustar la nueva configuracion de tabla de instalacion';
$lang_install['DB_Table_Created_not'] = 'No se pudo crearse la tabla. Error pesado.';
$lang_install['DB_Table_Changed_not'] = 'No se pudo cambiarse la tabla. Error pesado';
$lang_install['DB_Table_Created_ready'] = 'Ha terminado la instalacion de tabla<br />Existe,-por lo que sabemos-no hay errores que se produjeron.<br />En el siguiente paso es configurar su sistema para trabajar.';
$lang_install['DB_Table_Created_ready_error'] = 'Ha terminado la instalacion de tabla<br />Algunos de los errores ocurridos.<br />Por favor, compruebe el registro para ver que ha sucedido.';
$lang_install['DB_Entry_Update_missed'] = 'Hemos recibido un error en la insercion en la base de datos';
$lang_install['DB_RenameUserTableFail'] = 'No se pudo cambiar el nombre de las tablas de usuario';

// Language entries for Checks
$lang_install['Found_language'] = 'Hemos detectado que utiliza este lenguaje';
$lang_install['Found_language_change'] = 'Si desea cambiar este idioma (que sera la base para el idioma de su sitio web), puede elegir entre los idiomas que encontramos';

$lang_install['FreeDiskSpace']    = 'Espacio libre en el disco';
$lang_install['No_Free_Disk_Space'] = 'No tenemos informacion acerca de su Espacio en disco libre. Por favor, compruebe si es suficiente disponible (> 50 MB).';
$lang_install['Safe_Mod']    = 'Modo a prueba de errores';
$lang_install['SafeMod_On']    = 'Modo a prueba de errores esta activado.<br />Esto podria causar errores en las medidas que requiere la manipulacion de archivos (ae: Cache, la carga del archivo)';
$lang_install['PHP_Version']    = 'PHP_Version';
$lang_install['Wrong_PHP_Version'] = 'Su version de PHP es demasiado antigua. No apoyamos esta version mas.';
$lang_install['Unsafe_PHP_Version'] = 'Su version de PHP es demasiado antigua. Apoyamos esta version, pero se recomienda una actualizacion, porque su sitio web pueda ser facilmente hackeado.';
$lang_install['Register_Globals']    = 'Registros globales';
$lang_install['Register_Globals_On'] = 'Registro globales que estan habilitadas en su servidor.<br />OK, Comprobamos nuestras variables en Nuke-Evo, pero es una cuestion de seguridad para bloques, modulos y complementos que no esta ejecutando nuestras caracteristicas de seguridad.';
$lang_install['Captcha_enabled'] = 'Captcha disponible';
$lang_install['Open_Basedir'] = 'Abrir base directorio';
$lang_install['Open_Basedir_On'] = 'Basedir abierto esta activado.<br />Esta configuracion de PHP-podria causar errores en el archivo manipulacion como cache o archivo upploads.';
$lang_install['Session_Support'] = 'Soporte de periodo de sesiones';
$lang_install['No_Session_Support'] = 'No esta activado el apoyo del periodo de sesiones<br />Porque se trata de un PHP-MODUL basico necesario para las razones de seguridad, dejamos aqui la instalacion.';
$lang_install['CURL_Libary'] = 'Curl Biblioteca';
$lang_install['No_Curl_Modul'] = 'CURL Modulo no esta cargado.<br />No puede abrir archivos en servidores vinculados. Algunas funciones no funcionara en su instalacion (a.e. buscando actualizaciones).';
$lang_install['File_Upload'] = 'Carga de archivo';
$lang_install['No_FileUploads'] = 'Subir archivo no esta permitido en su servidor.';
$lang_install['Size_MB'] = 'MB';
$lang_install['Size_GB'] = 'GB';
$lang_install['File_Upload_Maxsize'] = 'Tama&ntilde;o maximo de subida';
$lang_install['Max_FileSize_ToSmall'] = 'El tama&ntilde;o de subida permitido para los archivos es peque&ntilde;o. Por lo tanto, detener su instalacion aqui.';
$lang_install['Max_FileSize_Small'] = 'El tama&ntilde;o de subida permitido para los archivos es muy peque&ntilde;a. Que limitara el tama&ntilde;o de las imagenes y para cargar los archivos en su servidor.';
$lang_install['SMTP_enabled'] = 'SMTP permitido';
$lang_install['SMTP_host'] = 'SMTP Host';
$lang_install['SMTP_sender'] = 'STMP Remitente';
$lang_install['SMTP_command'] = 'STMP comando';
$lang_install['FTP_enabled'] = 'FTP permitido';
$lang_install['Max_Post_Size'] = 'Tama&ntilde;o maximo de los anuncios';
$lang_install['Mod_Rewrite'] = 'Mod. Reescritura (Importante para Lazy Google Tab)';
$lang_install['Mod_Rewrite_no'] = 'No se puede utilizar Lazy Google Tab, porque "mod_rewrite" esta desactivado en su sistema';
$lang_install['Mod_Rewrite_no_check'] = 'No hemos podido comprobar si mod_rewrite esta habilitado. Por lo tanto, puede ser posible, que no pueda usar Lazy Google Tab.';
$lang_install['GD_Libary'] = 'GD Biblioteca';
$lang_install['GD_Libary_JPEG'] = 'GD Biblioteca - JPEG Apoyar (Importante para Captcha)';
$lang_install['Memory_Limit'] = 'Limite de memoria que se utilizara';
$lang_install['Memory_Limit_not'] = 'Your Memory Limit is not set. This means, that a program can use the whole memory of your system (limited to 128 MB). Mostly important for Downloads. They can slow down your system for other users.';

// Language entries Base Configuration
$lang_install['Base_Setup'] = 'Ajustes basicos<br />Aqui la importancia de definir la configuracion basica de su sistema.<br />Todos los ajustes se pueden cambiar en su Sistema de Administracion despues de que su sitio esta en marcha y funcionando';
$lang_install['Base_Sitename'] = 'Nombre del Sitio';
$lang_install['Base_Help_Sitename'] = 'El nombre de su sitio web.<br />Max. 200 caracteres.<br />Se mostrara en el titulo del navegador y en el interior del Foro. Incluso tambien se usa como meta-etiquetas en el encabezado de su pagina web (para motores de busqueda)';
$lang_install['Base_Sitename_no_entry'] = 'Este campo no se le permite estar vacio';
$lang_install['Base_Sitedescription'] = 'Sitio Descripcion (max. 200 caracteres)';
$lang_install['Base_Help_Sitedescription'] = 'Una breve descripcion de su sitio. Se mostrara a los usuarios';
$lang_install['Base_Descriptione_no_entry'] = 'Este campo no se le permite estar vacio';
$lang_install['Base_Url'] = 'URL de su Sitio Web (Sin http://)';
$lang_install['Base_Help_Url'] = 'El dominio de su sitio web. Ejemplo: www.mydomain.com';
$lang_install['Base_Url_no_entry'] = 'Este campo no se le permite estar vacio';
$lang_install['Base_Server_Port'] = 'Puerto de la web.';
$lang_install['Base_Help_Server_Port'] = 'Puerto de la web.<br />Numero: 5-digitos.<br />El puerto en el servidor web donde esta a la escucha. Normalmente: 80 o detras de un proxy: 8080.';
$lang_install['Base_Server_Port_wrong_entry'] = 'The Serverport must be greater or equal than 80 and smaller than 65535';
$lang_install['Base_Server_Port_no_entry'] = 'This field is not allowed to be empty';
$lang_install['Base_Cookie_Domain'] = 'Cookie Dominio';
$lang_install['Base_Help_Cookie_Domain'] = 'Cookie Domain is normally the same Domain as your website.';
$lang_install['Base_Cookie_Name_wrong_chars'] = 'You have uses unallowed characters for your Cookie Domain';
$lang_install['Base_Cookie_Name_no_entry'] = 'This field is not allowed to be empty';
$lang_install['Base_Cookie_Domain_no_entry'] = 'This field is not allowed to be empty';
$lang_install['Base_Cookie_Path'] = 'Cookie Ruta.';
$lang_install['Base_Help_Cookie_Path'] = 'If you have your Evo-Installation in a subdir of the domain, you have to insert here the piece of the URL behind the Domainname';
$lang_install['Base_Cookie_Path_no_entry'] = 'This field is not allowed to be empty';
$lang_install['Base_Cookie_Name'] = 'Cookie Nombre';
$lang_install['Base_Help_Cookie_Name'] = 'A unique Name for your Cookie.<br />Inside of your domain, this name must be unique for a cookie.<br />Allowed are numbers and characters only.';
$lang_install['Base_Cookie_Name_no_entry'] = 'This field is not allowed to be empty';
$lang_install['Base_Board_Email'] = 'Direccion de correo del Webmaster';
$lang_install['Base_Help_Board_Email'] = 'Email Address of the Webmaster.<br />Will be used for all system emails as Sender.<br />In some Systems the email address must be the same as used within the php-ini entries for smtp.';
$lang_install['Base_Board_Email_no_entry'] = 'This field is not allowed to be empty';
$lang_install['Base_Board_Email_Sig'] = 'Firma de correo';
$lang_install['Base_Help_Board_Email_Sig'] = 'Email Signature.<br />Max. 200 chars<br />Used in emails or messages as signature.';
$lang_install['Base_Board_Email_Sig_no_entry'] = 'This field is not allowed to be empty';
$lang_install['Base_Board_Default_Lang'] = 'Base Lenguaje';
$lang_install['Base_Help_Board_Default_Lang'] = 'Base Language.<br />Base Language for your Website. You can choose between the languages we found on your Nuke-Evo Installation.<br />Could be changed later by Administrator-';
$lang_install['Base_Board_Default_Lang_no_entry'] = 'This field is not allowed to be empty';
$lang_install['Base_Board_Startdate'] = 'Fecha de inicio del sitio web';
$lang_install['Base_Help_Board_Startdate'] = 'Start date of the website.<br />Will be used as <strong>official start date</strong> of your website. Normally the install date. If your site is running a longer time or will start in the future, you can change the date here.';
$lang_install['Base_Board_Startdate_no_entry'] = 'This field is not allowed to be empty';
$lang_install['Base_Board_Dateformat'] = 'Estandar formato de fecha';
$lang_install['Base_Help_Board_Dateformat'] = 'Standard date format.<br />The date format defined here is used for all base system settings.';
$lang_install['Base_Board_Dateformat_no_entry'] = 'This field is not allowed to be empty';
$lang_install['Base_Board_Timezone'] = 'Zona horaria de su sitio';
$lang_install['Base_Help_Board_Timezone'] = 'Time zone of your site.<br />Because your website is worldwide available - but your users are living in different timezones<br />all input have to be set in accordance to one defined time zone.<br />This is time zone for your server.<br />Normally not the timezone where you life in, but the timezone your server is running in.';
$lang_install['Base_Board_Timezone_no_entry'] = 'This field is not allowed to be empty';
$lang_install['Base_Conf_wrong'] = 'Se encontraron errores en su configuracion de base.<br />Compruebe su entrada.';
$lang_install['Base_Conf_ok'] = 'No hemos encontrado errores en su base de ajustes de configuracion.<br />En el siguiente paso puede crear el Administrador de su sitio web.';
$lang_install['Base_From_Update'] = 'Usted esta en el modo de actualizacion.<br />La informacion que se muestra a continuacion recoge de su sistema existente.';

// Language entries for creating Admin Account
$lang_install['Admin_Setup'] = 'Creacion de Administracion de Cuenta';
$lang_install['Admin_Configuration_Details'] = 'Administrador';
$lang_install['Admin_Name'] = 'Nombre de usuario del Administrador (se utilizara en todos los mensajes, escrito por este Administrador)';
$lang_install['Admin_Help_Name'] = 'El nombre de usuario del administrador hade ser utilizado en cada lugar, normalmente en el nombre de usuario aparece como poster o votante etc.';
$lang_install['Admin_Name_no_entry'] = 'Este campo no se le permite estar vacio';
$lang_install['Admin_Homepage'] = 'Sitio Web del Administrador';
$lang_install['Admin_Help_Homepage'] = 'Sitio Web del administrador<br />Incluso demasiado para el administrador no se permite votar a favor de su propio sitio. Los controles se realizaran en contra de la entrada en este campo';
$lang_install['Admin_Homepage_no_entry'] = 'Este campo no puede estar vacio';
$lang_install['Admin_Password'] = 'Contrase&ntilde;a';
$lang_install['Admin_Help_Password'] = 'Contrase&ntilde;a<br />La contrase&ntilde;a debe no ser menor de 6 caracteres y no mas de 25 caracteres.';
$lang_install['Admin_Password2'] = 'Repetir contrase&ntilde;a';
$lang_install['Admin_Password_no_entry'] = 'Este campo no puede estar vacio';
$lang_install['Admin_Password_not_match'] = 'Las contrase&ntilde;a no coinciden';
$lang_install['Admin_Password_not_match_existing'] = 'Las contrase&ntilde;a no coinciden con el uno ya existente de base de datos';
$lang_install['Admin_Help_Password2'] = 'Repetir contrase&ntilde;a<br />Porque no es facil cambiar la contrase&ntilde;a de administrador de este sitio, usted tiene que repetir la contrase&ntilde;a para estar seguro nigun error tipograficos\'s.';
$lang_install['Admin_Lang'] = 'Lenguaje del Administrador';
$lang_install['Admin_Help_Lang'] = 'Idioma de administrador.<br />La entrada en este campo se utilizara como lenguaje estandar para este administrador';
$lang_install['Admin_Lang_no_entry'] = 'Este campo no puede estar vacio';
$lang_install['Admin_Create_User'] = 'Desea crear una cuenta de usuario con el mismo nombre ?';
$lang_install['Admin_Help_Create_User'] = 'Crear cuenta de usuario<br />Por razones de seguridad no debe crear uno. Pero para fines de manejo y mantenimiento de sistema es mas facil que el usuario identico a la administracion';
$lang_install['Admin_Create_User_no_entry'] = 'Este campo no puede estar vacio';
$lang_install['Admin_Conf_wrong'] = 'Se encontraron errores en la configuracion de administrador.<br />Compruebe su entrada.';
$lang_install['Admin_Conf_ok'] = 'No encontramos errores en Configuracion del Administrador.<br />Con el siguiente paso, llenaremos su base de datos con informacion general de base y los valores que nos dio en los pasos anteriores.';

// Language entries for Database Step
$lang_install['Base_Information_Setup'] = 'Rellenar la base de datos con Ajustes basicos';
$lang_install['Base_Information_Details'] = 'Tablas en su base de datos';
$lang_install['Base_Informations_NoNeed'] = 'No hay informacion para aregar en la base de datos';
$lang_install['Base_Informations_ToDo'] = 'Informacion disponible para la insercion';
$lang_install['Base_Informations_Done'] = 'Informacion ya se ha insertado';
$lang_install['Base_Informations_ready'] = 'Configuracion de la Base se insertaron en su base de datos.<br />No hay-como podamos comprobar-si hay errores.<br />Que haya terminado con exito su instalacion.';
$lang_install['Base_Informations_in_process'] = 'Insercion de Configuracion Base... por favor, no interrumpir !!';
$lang_install['Base_Information_DB_Success'] = 'Configuracion de base insertada en la base de datos con exito';
$lang_install['Base_Informations_ready_error'] = 'Se encontraron errores durante la insercion en la base de datos.<br />Por favor, compruebe su instalacion.<br />Que haya terminado su instalacion con errores.';

// Language entries for Last Step
$lang_install['Information_Setup_Ready'] = 'Felicidades!<br />Que haya terminado su configuracion.';
$lang_install['Information_Setup_Ready_allok'] = 'Reconocemos que no hay errores durante el proceso de instalacion.<br/>Esto significa que su sitio web ya esta configurado y listo para su uso.';
$lang_install['Information_Setup_Ready_nostep'] = 'No todas las etapas de instalacion se han realizado.<br />Para hacer los pasos, no se encontraron errores.<br />Si su sitio web esta funcionando, es una cosa que no puede decir. Usted tiene que comprobar y ejecutar el instalador de nuevo, si hay errores.';
$lang_install['Information_Setup_Ready_error'] = 'Reconocimos errores pesados.<br />Le recomendamos que compruebe el registro y reiniciar la instalacion.';
$lang_install['Information_Setup_Ready_noinfo'] = 'No tenemos ninguna informacion sobre el proceso de instalacion.<br />Medios, no podemos decir nada: Si hay errores, si los cuadros fueron creados.<br />Recomendamos reiniciar el proceso de instalacion.';
$lang_install['Information_Setup_GoHome'] = 'Ir a la pagina principal de su nuevo Sitio Web';
$lang_install['Information_Setup_GoAdmin'] = 'Ir al panel de administracion de su nuevo Sitio Web';


// Language entries for Database fields

$lang_install['Page_Top']    = 'Pagina Arriba';
$lang_install['Left_Block']  = 'Bloque izquierdo';
$lang_install['Page_Bottom'] = 'Pagina abajo';
$lang_install['Group_Administrators'] = 'Administradores';
$lang_install['Group_Moderators'] = 'Moderadores';

$lang_install['bbboard_message_1'] = 'Este mensaje se muestra en todas las paginas y a todos los usuarios y se estira hasta el 80 % de la anchura disponible.';
$lang_install['bbboard_message_2'] = 'Este mensaje aparece solo en la pagina de indice y solo es visible para los usuarios registrados.';

$lang_install['bbcategories_cat_title'] = 'General';

$lang_install['bbconfig_board_disable_msg'] = 'El Consejo esta deshabilitado....';
$lang_install['bbconfig_default_dateformat'] = 'D M d, Y g:i a';
$lang_install['bbconfig_locked_view_open'] = 'Bloqueado: <strike>';
$lang_install['bbconfig_locked_view_close'] = '</strike>';
$lang_install['bbconfig_global_view_open'] = 'Global Anuncio:';
$lang_install['bbconfig_global_view_close'] = '';
$lang_install['bbconfig_announce_view_open'] = 'Anuncio:';
$lang_install['bbconfig_announce_view_close'] = '';
$lang_install['bbconfig_sticky_view_open'] = 'Adhesiva:';
$lang_install['bbconfig_sticky_view_close'] = '';
$lang_install['bbconfig_moved_view_open'] = 'Mover:';
$lang_install['bbconfig_moved_view_close'] = '';

$lang_install['bbextension_groups_Images'] = 'Images';
$lang_install['bbextension_groups_Archives'] = 'Archives';
$lang_install['bbextension_groups_Plain_Text'] = 'Plain Text';
$lang_install['bbextension_groups_Documents'] = 'Documents';
$lang_install['bbextension_groups_Real_Media'] = 'Real Media';
$lang_install['bbextension_groups_Streams'] = 'Streams';
$lang_install['bbextension_groups_Flash_Files'] = 'Flash Files';

$lang_install['bbforums_forum_name'] = 'Sitio';

$lang_install['bbgroups_group_name_Anonymous'] = 'Anonimo';
$lang_install['bbgroups_group_name_Moderators'] = 'Moderadores';
$lang_install['bbgroups_group_description_Moderators'] = 'Moderadores de este foro';
$lang_install['bbgroups_group_name_Administrators'] = 'Administradores';
$lang_install['bbgroups_group_description_Administrators'] = 'Administradores de este foro';
$lang_install['bbgroups_group_name_Users'] = 'Usuarios';
$lang_install['bbgroups_group_description_Users'] = 'Predeterminado grupo de usuario';

$lang_install['bbposts_text_post_subject'] = 'Bienvenido a Nuke-Evolution!';
$lang_install['bbposts_text_post_text'] = 'Gracias por instalar Nuke-Evolution.\r\n\r\nEl equipo de Evo ha puesto mucho trabajo en esta version para que sea el mas rapido, mas funcional y mas segura version de PHP-Nuke nunca. Le animamos a que lea en su totalidad de la documentacion incluye comprender plenamente lo que el poder dentro de Evo.\r\n\r\nDentro del archivo original que ha descargado usted encontrara varias carpetas que contienen informacion util.\r\n\r\nEl primero es el "Install" carpeta de la que esperamos que ya estan familiarizados. Esta carpeta contiene tres documentos que le ayudaran a instalar y configurar su nuevo Evo sitio. Si no han pasado por estos ya hagalo ahora!\r\n\r\ncarpeta de la que esperamos que ya se encuentran La segunda es la "Help" carpeta. Dentro de esta carpeta se encuentran algunas muy utiles los documentos que nuestro equipo ha elaborado para explicar algunas de las caracteristicas dentro de Evo. Usted tambien encontrara algunos documentos que ayudaran a resolver algunos errores que pueden ejecutar debido a que en la configuracion del navegador o software de instalacion impropia.\r\n\r\nEl tercero es el "Theme Edits" carpeta. Si desea convertir un PHP-Nuke tema para trabajar con Evo debe seguir las instrucciones dentro de esta carpeta.\r\n\r\nConfiamos en que Evo sera el mejor Nuke software que alguna vez correr. Disfrutar y no deje de www.nuke-evolution.com de apoyo, actualizaciones o simplemente para decir hola!\r\n\r\n[b:16f8943d60]- The Nuke-Evolution Equipo[/b:16f8943d60]';

$lang_install['bbquota_limits_Low'] = 'Bajo';
$lang_install['bbquota_limits_Medium'] = 'Medio';
$lang_install['bbquota_limits_High'] = 'Alto';

$lang_install['bbranks_rank_title_Site_Owner'] = 'Propietario';
$lang_install['bbranks_rank_title_Site_Admin'] = 'Administrador';

$lang_install['bbsmilies_Very_Happy'] = 'Very Happy';
$lang_install['bbsmilies_Smile'] = 'Smile';
$lang_install['bbsmilies_Sad'] = 'Sad';
$lang_install['bbsmilies_Surprised'] = 'Surprised';
$lang_install['bbsmilies_Shocked'] = 'Shocked';
$lang_install['bbsmilies_Confused'] = 'Confused';
$lang_install['bbsmilies_Cool'] = 'Cool';
$lang_install['bbsmilies_Laughing'] = 'Laughing';
$lang_install['bbsmilies_Mad'] = 'Mad';
$lang_install['bbsmilies_Razz'] = 'Razz';
$lang_install['bbsmilies_Embarassed'] = 'Embarassed';
$lang_install['bbsmilies_Crying_or_Very_sad'] = 'Crying or Very sad';
$lang_install['bbsmilies_Evil_or_Very_Mad'] = 'Evil or Very Mad';
$lang_install['bbsmilies_Twisted_Evil'] = 'Twisted Evil';
$lang_install['bbsmilies_Rolling_Eyes'] = 'Rolling Eyes';
$lang_install['bbsmilies_Wink'] = 'Wink';
$lang_install['bbsmilies_Exclamation'] = 'Exclamation';
$lang_install['bbsmilies_Question'] = 'Question';
$lang_install['bbsmilies_Idea'] = 'Idea';
$lang_install['bbsmilies_Arrow'] = 'Arrow';
$lang_install['bbsmilies_Neutral'] = 'Neutral';
$lang_install['bbsmilies_Mr_Green'] = 'Mr. Green';

$lang_install['bbstats_module_info_long_name_modul1'] = 'Statistics Overview Section';
$lang_install['bbstats_module_info_extra_info_modul1'] = 'This Module will print out a link Block with Links to the current Module at the Statistics Site.\nYou are able to define the number of columns displayed for this Module within the Administration Panel -&gt; Edit Module.';
$lang_install['bbstats_module_info_long_name_modul2'] = 'Top Posters';
$lang_install['bbstats_module_info_extra_info_modul2'] = 'This Module displays the Top Posters from your board.\nAnonymous Poster are not counted.';
$lang_install['bbstats_module_info_long_name_modul3'] = 'Administrative Statistics';
$lang_install['bbstats_module_info_extra_info_modul3'] = 'This Module displays some Admin Statistics about your Board.\nIt is nearly the same you are able to see within the first Administration Panel visit.';
$lang_install['bbstats_module_info_long_name_modul4'] = 'Most viewed topics';
$lang_install['bbstats_module_info_extra_info_modul4'] = 'This Module displays the most viewed topics at your board.';
$lang_install['bbstats_module_info_long_name_modul5'] = 'Top Posters this Month (Site History Mod)';
$lang_install['bbstats_module_info_extra_info_modul5'] = 'This Module does NOT require the Site History Mod,\nit will display the Top Posters on a Monthly basis.';
$lang_install['bbstats_module_info_long_name_modul6'] = 'New topics by month';
$lang_install['bbstats_module_info_extra_info_modul6'] = 'This Module will display the topics created at your Board in a monthly statistic.';
$lang_install['bbstats_module_info_long_name_modul7'] = 'Most Interesting Topics';
$lang_install['bbstats_module_info_extra_info_modul7'] = 'This module will show the most interesting topics.';
$lang_install['bbstats_module_info_long_name_modul8'] = 'Top Words';
$lang_install['bbstats_module_info_extra_info_modul8'] = 'This Module displays the most used words on your board.';
$lang_install['bbstats_module_info_long_name_modul9'] = 'Least Interesting Topics';
$lang_install['bbstats_module_info_extra_info_modul9'] = 'This module will show the least interesting topics.';
$lang_install['bbstats_module_info_long_name_modul10'] = 'Most Active Topicstarter';
$lang_install['bbstats_module_info_extra_info_modul10'] = 'This Module displays the most active topicstarter on your board.\nAnonymous Poster are not counted.';
$lang_install['bbstats_module_info_long_name_modul11'] = 'Top Smilies';
$lang_install['bbstats_module_info_extra_info_modul11'] = 'This Module displays the Top Smilies used at your board.\nThis Module uses an Smilie Index Table for caching the smilie data and to not\nrequire re-indexing of all posts.';
$lang_install['bbstats_module_info_long_name_modul12'] = 'New users by month';
$lang_install['bbstats_module_info_extra_info_modul12'] = 'This Module will display the users registered to your Board in a monthly statistic.';
$lang_install['bbstats_module_info_long_name_modul13'] = 'New posts by month';
$lang_install['bbstats_module_info_extra_info_modul13'] = 'This Module will display the posts created at your Board in a monthly statistic.';
$lang_install['bbstats_module_info_long_name_modul14'] = 'Top Posters this Week (Site History Mod)';
$lang_install['bbstats_module_info_extra_info_modul14'] = 'This Module does NOT require the Site History Mod,\nit will display the Top Posters on a Weekly basis.';
$lang_install['bbstats_module_info_long_name_modul15'] = 'Top Downloaded Attachments';
$lang_install['bbstats_module_info_extra_info_modul15'] = 'This Module will print out the most downloaded Files.\nThe Attachment Mod Version 2.3.x have to be installed in order to let this Module work.\nYou are able to exclude Images from the statistic too.';
$lang_install['bbstats_module_info_long_name_modul16'] = 'Most active Topics';
$lang_install['bbstats_module_info_extra_info_modul16'] = 'This Module displays the most active topics at your board.';

$lang_install['bbthemes_name_tr_color1_name'] = 'The lightest row color';
$lang_install['bbthemes_name_tr_color2_name'] = 'The medium row color';
$lang_install['bbthemes_name_tr_color3_name'] = 'The darkest row color';
$lang_install['bbthemes_name_tr_class1_name'] = '';
$lang_install['bbthemes_name_tr_class2_name'] = '';
$lang_install['bbthemes_name_tr_class3_name'] = '';
$lang_install['bbthemes_name_th_color1_name'] = 'Border round the whole page';
$lang_install['bbthemes_name_th_color2_name'] = 'Outer table border';
$lang_install['bbthemes_name_th_color3_name'] = 'Inner table border';
$lang_install['bbthemes_name_th_class1_name'] = 'Silver gradient picture';
$lang_install['bbthemes_name_th_class2_name'] = 'Blue gradient picture';
$lang_install['bbthemes_name_th_class3_name'] = 'Fade-out gradient on index';
$lang_install['bbthemes_name_td_color1_name'] = 'Background for quote boxes';
$lang_install['bbthemes_name_td_color2_name'] = 'All white areas';
$lang_install['bbthemes_name_td_color3_name'] = '';
$lang_install['bbthemes_name_td_class1_name'] = 'Background for topic posts';
$lang_install['bbthemes_name_td_class2_name'] = '2nd background for topic posts';
$lang_install['bbthemes_name_td_class3_name'] = '';
$lang_install['bbthemes_name_fontface1_name'] = 'Main fonts';
$lang_install['bbthemes_name_fontface2_name'] = 'Additional topic title font';
$lang_install['bbthemes_name_fontface3_name'] = 'Form fonts';
$lang_install['bbthemes_name_fontsize1_name'] = 'Smallest font size';
$lang_install['bbthemes_name_fontsize2_name'] = 'Medium font size';
$lang_install['bbthemes_name_fontsize3_name'] = 'Normal font size (post body etc)';
$lang_install['bbthemes_name_fontcolor1_name'] = 'Quote & copyright text';
$lang_install['bbthemes_name_fontcolor2_name'] = 'Code text color';
$lang_install['bbthemes_name_fontcolor3_name'] = 'Main table header text color';
$lang_install['bbthemes_name_span_class1_name'] = '';
$lang_install['bbthemes_name_span_class2_name'] = '';
$lang_install['bbthemes_name_span_class3_name'] = '';

$lang_install['bbtopics_topic_title'] = 'Bienvenido a Nuke-Evolution!';

$lang_install['bbxdata_fields_field_name_icq'] = 'ICQ Numero';
$lang_install['bbxdata_fields_field_name_aim'] = 'AIM Direccion';
$lang_install['bbxdata_fields_field_name_msn'] = 'MSN Messenger';
$lang_install['bbxdata_fields_field_name_yim'] = 'Yahoo Messenger';
$lang_install['bbxdata_fields_field_name_website'] = 'Sitio Web';
$lang_install['bbxdata_fields_field_name_location'] = 'Ubicacion';
$lang_install['bbxdata_fields_field_name_occupation'] = 'Ocupacion';
$lang_install['bbxdata_fields_field_name_interests'] = 'Intereses';
$lang_install['bbxdata_fields_field_name_signature'] = 'Firma';

$lang_install['blocks_bkey_Main_Menu'] = 'Menu Principal';
$lang_install['blocks_bkey_Administration'] = 'Administracion';
$lang_install['blocks_bkey_Search'] = 'Buscar';
$lang_install['blocks_bkey_Survey'] = 'Encuesta';
$lang_install['blocks_bkey_Information'] = 'Informacion';
$lang_install['blocks_bkey_User_Info'] = 'Info de Usuario';
$lang_install['blocks_bkey_Nuke_Evolution'] = 'Nuke-Evolution';
$lang_install['blocks_bkey_Hacker_Beware'] = 'Hacker Cuidado';
$lang_install['blocks_bkey_Top_10_Downloads'] = 'Top 10 Descargas';
$lang_install['blocks_bkey_Top_10_Links'] = 'Top 10 enlaces';
$lang_install['blocks_bkey_Forums'] = 'Foros';
$lang_install['blocks_bkey_Submissions'] = 'Envios';
$lang_install['blocks_bkey_Link_to_us'] = 'Enlace con nosotros';
$lang_install['blocks_bkey_Donations'] = 'Donaciones';

$lang_install['config_slogan'] = 'Su lema aqui';
$lang_install['config_foot1'] = '<a href="modules.php?name=Spambot_Killer" target="_blank">Spambot Killer</a><br /><a href="modules.php?name=Site_Map" target="_blank"><strong>Site Map</strong></a><br />';
$lang_install['config_foot2'] = '<a href="rss.php?feed=news" target="_blank"><img border="0" src="images/powered/feed_20_news.png" width="94" height="15" alt="[News Feed]" title="News Feed" /></a> <a href="rss.php?feed=forums" target="_blank"><img border="0" src="images/powered/feed_20_forums.png" width="94" height="15" alt="[Forums Feed]" title="Forums Feed" /></a> <a href="rss.php?feed=downloads" target="_blank" /><img border="0" src="images/powered/feed_20_down.png" width="94" height="15" alt="[Downloads Feed]" title="Downloads Feed" /></a> <a href="rss.php?feed=weblinks" target="_blank"><img border="0" src="images/powered/feed_20_links.png" width="94" height="15" alt="[Web Links Feed]" title="Web Links Feed" /></a>  <a href="http://htmlpurifier.org/"><img src="images/powered/html_purifier_powered.png" alt="Powered by HTML Purifier" border="0" /></a> <a href="http://tool.motoricerca.info/robots-checker.phtml?checkreferer=1" target="_blank"><img border="0" src="images/powered/valid-robots.png" width="80" height="15" alt="[Validate robots.txt]" title="Validate robots.txt" /></a><br />';
$lang_install['config_foot3'] = '';
$lang_install['config_anonymous'] = 'Anonimo';
$lang_install['config_backend_title'] = 'Nuke-Evolution Sitio habilitado';
$lang_install['config_notify_subject'] = 'NOTICIAS de mi sitio';
$lang_install['config_notify_message'] = 'Hey! Tienes una nueva presentacion de tu sitio.';

$lang_install['cnbya_config_tos_text'] = 'Este es su valor predeterminado. Esto puede editar a traves del su panel de administracion de cuentas.';

$lang_install['donators_config_block_message'] = 'Encontras nuestro sitio util? Hacer una peque&ntilde;a donacion a demostrar tu apoyo.';
$lang_install['donators_config_gen_donation_name'] = 'Sitio Donaciones';
$lang_install['donators_config_gen_currency'] = 'USD';
$lang_install['donators_config_gen_date_format'] = 'm/d/Y';
$lang_install['donators_config_gen_thank_message'] = 'Muchas gracias por su amable donacion!<br /><br />Por favor, vendre otra vez!';
$lang_install['donators_config_gen_cancel_message'] = 'Siento que no podia Donar!<br /><br />Por favor, vendre otra vez!';

$lang_install['downloads_categories_title'] = 'General';
$lang_install['downloads_categories_cdescription'] = 'Categoria General creo durante la instalacion';

$lang_install['evo_userinfo_good_afternoon'] = 'Buenas tardes';
$lang_install['evo_userinfo_username'] = 'Nombre de usuario';
$lang_install['evo_userinfo_show_ip'] = 'Mostrar IP';
$lang_install['evo_userinfo_avatar'] = 'Avatar';
$lang_install['evo_userinfo_personal_message'] = 'Mensaje personal';
$lang_install['evo_userinfo_rank'] = 'Rango';
$lang_install['evo_userinfo_mostever'] = 'Nunca mas';
$lang_install['evo_userinfo_language'] = 'Lenguaje';
$lang_install['evo_userinfo_Break'] = 'Roto';
$lang_install['evo_userinfo_pms'] = 'PMs';
$lang_install['evo_userinfo_themes'] = 'Temas';
$lang_install['evo_userinfo_login'] = 'conectarse/desconectarse/registrarse';
$lang_install['evo_userinfo_members'] = 'Mienbros';
$lang_install['evo_userinfo_online'] = 'En linea';
$lang_install['evo_userinfo_users'] = 'Usuarios';
$lang_install['evo_userinfo_posts'] = 'mensajes';

$lang_install['evo_userinfo_addons_good_afternoon_message'] = 'Buenos dias %name%:';
$lang_install['evo_userinfo_addons_personal_message_message'] = '<div align="center">Hola %name%, <br />bienvenido a %site%.</div>';

$lang_install['evolution_censor_words'] = 'ASS culo puta mierda mierda idiota c0ck clitoris polla cum co&ntilde;o carajo maldito marica de mierda fagot FUK fuking mierda hijo de puta co&ntilde;o tetas idiota';

$lang_install['links_categories_title'] = 'General';
$lang_install['links_categories_cdescription'] = 'Categoria General creo durante la instalacion';


$lang_install['modules_meta_keywords'] = 'Nuke-Evolution, evo, pne, evolution, nuke, php-nuke, software, descargas, comunidad, foros, boletin, juntas, cms, nuke-evo, phpnuke';

$lang_install['modules_title_Advertising'] = 'Publicidad';
$lang_install['modules_title_Content'] = ' Contenido ';
$lang_install['modules_title_Docs'] = 'Documentos';
$lang_install['modules_title_Donations'] = 'Donaciones';
$lang_install['modules_title_Downloads'] = 'Descargas';
$lang_install['modules_title_FAQ'] = 'FAQ';
$lang_install['modules_title_Feedback'] = 'Comentarios';
$lang_install['modules_title_Forums'] = 'Foros';
$lang_install['modules_title_Groups'] = 'Grupos';
$lang_install['modules_title_News'] = 'Noticias';
$lang_install['modules_title_NukeSentinel'] = 'NukeSentinel';
$lang_install['modules_title_Private_Messages'] = 'Mensajes Privados';
$lang_install['modules_title_Profile'] = 'Perfil';
$lang_install['modules_title_Recommend_Us'] = 'Recomendanos';
$lang_install['modules_title_Reviews'] = 'Revisiones';
$lang_install['modules_title_Search'] = 'Buscar';
$lang_install['modules_title_Site_Map'] = 'Mapa del sitio';
$lang_install['modules_title_Spambot_Killer'] = 'Spambot Killer';
$lang_install['modules_title_Statistics'] = 'Estadisticas';
$lang_install['modules_title_Stories_Archive'] = 'Archivo de Historias';
$lang_install['modules_title_Submit_News'] = 'Enviar Noticias';
$lang_install['modules_title_Supporters'] = 'Afiliados';
$lang_install['modules_title_Surveys'] = 'Encuestas';
$lang_install['modules_title_Top'] = 'Top';
$lang_install['modules_title_Topics'] = 'Temas';
$lang_install['modules_title_Web_Links'] = 'Enlaces Web';
$lang_install['modules_title_Your_Account'] = 'Tu cuenta';

$lang_install['modules_cat_Home'] = 'Inicio';
$lang_install['modules_cat_Members'] = 'Miembros';
$lang_install['modules_cat_Community'] = 'Comunidad';
$lang_install['modules_cat_Statistics'] = 'Estadisticas';
$lang_install['modules_cat_Files_Links'] = 'Descarga Links';
$lang_install['modules_cat_News'] = 'Noticias';
$lang_install['modules_cat_Other'] = 'Otros';


$lang_install['modules_links_title'] = 'Inicio';

$lang_install['poll_data_optionText_1'] = 'Ummmm, no esta mal';
$lang_install['poll_data_optionText_2'] = 'Frio';
$lang_install['poll_data_optionText_3'] = 'Excelente';
$lang_install['poll_data_optionText_4'] = 'El mejor!';
$lang_install['poll_data_optionText_5'] = 'Que diablos es esto?';
$lang_install['poll_data_optionText_6'] = '';
$lang_install['poll_data_optionText_7'] = '';
$lang_install['poll_data_optionText_8'] = '';
$lang_install['poll_data_optionText_9'] = '';
$lang_install['poll_data_optionText_10'] = '';
$lang_install['poll_data_optionText_11'] = '';
$lang_install['poll_data_optionText_12'] = '';

$lang_install['poll_data_pollTitle'] = 'Que piensa usted acerca de este sitio?';
$lang_install['poll_data_planguage'] = 'spanish';

$lang_install['quotes_quote'] = 'Nos morituri te salutamus - CBHS';

$lang_install['reviews_categories_title'] = 'General';
$lang_install['reviews_categories_cdescription'] = 'Categoria General creo durante la instalacion';

$lang_install['stories_title'] = 'Bienvenido a Nuke-Evolution';
$lang_install['stories_hometext'] = 'Bienvenido a Nuke-Evolution.<br /><br />Ahora debe configurar una cuenta de administrador.  Puede hacerlo por <a href="admin.php">clic aqui</a>.<br /><br /><br /><br /><strong>NOTA:</strong> Esto puede eliminar por entrar en la administracion de noticias o haciendo clic en el boton Eliminar.';

$lang_install['stories_cat_Articles'] = 'Articulos';

$lang_install['themes_custom_name'] = 'Chromo';

$lang_install['topics_text'] = 'Nuke-Evolution';
$lang_install['topics_name'] = 'evolution';

$lang_install['users_name_Anonymous'] = 'Anonimo';
$lang_install['users_timezone_Anonymous'] = '10.00';
$lang_install['users_lang_Anonymous'] = 'spanish';
$lang_install['users_dateformat_Anonymous'] = 'D M d, Y g:i a';


?>