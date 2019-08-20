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

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
echo '<html>
    <head>
    <title>Password Strength Help</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <style type="text/css">
        h1.myclass {font-size: 20pt; font-weight: bold; color: blue; text-align: center}
        h1.myclass2 {font-size: 11pt; font-style: normal; text-align: left}
    </style>
    </head>';

echo'<body>
        <table border="0" width="100%">
            <tr><td>
                <h1 class="myclass">
                    Fortaleza de la Contrase&ntilde;a Ayuda
                </h1>
            </td></tr>
        </table>';

echo '    <table border="0" width="100%">
            <tr><td>
                <h1 class="myclass2">
                El proposito de este es ayudar a crear una Contrase&ntilde;a que sera mas fuerte y, por tanto, 
                 mas dificil para los hackers a romper. Por supuesto, puedes optar por hacer caso omiso de esto ya que es solo una 
                 herramienta util y no un requisito.
                </h1>
            </td></tr>';
echo '    </table>';

echo '    <table border="0" width="100%">';

echo '      <tr><td>
                <h1 class="myclass2">
                    El contador mide la fuerza de la Contrase&ntilde;a su Contrase&ntilde;a fuerza en los siguientes 5 maneras.
            </h1>
            </td></tr>';

echo '      <tr><td>
                <h1 class="myclass2">
                Contrase&ntilde;a contiene una letra minuscula (a-z)
                </h1>
            </td></tr>';

echo '      <tr><td>
                <h1 class="myclass2">
                Contrase&ntilde;a contiene una letra mayuscula (A-Z)
                </h1>
            </td></tr>';

echo '      <tr><td>
                <h1 class="myclass2">
                Contrase&ntilde;a contiene un digito (0-9)
                </h1>
            </td></tr>';

echo '      <tr><td>
                <h1 class="myclass2">
                Contrase&ntilde;a contiene un caracter que no es una letra o digito (!@#$%^&amp;*)
                </h1>
            </td></tr>';

echo '      <tr><td>
                <h1 class="myclass2">
                Contrase&ntilde;a longitud es de al menos 10 caracteres de longitud
                </h1>
            </td></tr>';

echo '        </table>
    </body>
</html>';

?>