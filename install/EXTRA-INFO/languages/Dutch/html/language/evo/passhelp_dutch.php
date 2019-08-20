<?php
/*=======================================================================
 Nuke-Evolution		: 	Enhanced Web Portal System
 ========================================================================
 
 Nuke-Evo Base          :		#$#BASE
 Nuke-Evo Version       :		#$#VER
 Nuke-Evo Build         :		#$#BUILD
 Nuke-Evo Patch         :		#$#PATCH
 Nuke-Evo Filename      :		#$#FILENAME
 Nuke-Evo Date          :		#$#DATE

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
    <title>Hulp voor een goed wachtwoord</title>
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
                    Hulp voor een goed wachtwoord
                </h1>
            </td></tr>
        </table>';

echo '    <table border="0" width="100%">
            <tr><td>
                <h1 class="myclass2">
                Hoe gecompliceerder het wachtwoord hoe moeilijker het te hacken is.
				Hier zijn 5 Methodes weergegeven, waarna wij de veiligheids criteria defineren.
				Als u met alle 5 punten rekening houd bereikt u het hoogste niveau:
                </h1>
            </td></tr>';
echo '    </table>';

echo '    <table border="0" width="100%">';

echo '      <tr><td>
                <h1 class="myclass2">
                1. - Wachtwoord met kleine letters (a-z)
                </h1>
            </td></tr>';

echo '      <tr><td>
                <h1 class="myclass2">
                2. - Wachtwoord met hoofdletters (A-Z)
                </h1>
            </td></tr>';

echo '      <tr><td>
                <h1 class="myclass2">
                3.  - Wachtwoord met cijfers (0-9)
                </h1>
            </td></tr>';

echo '      <tr><td>
                <h1 class="myclass2">
                4. - Wachtwoord met speciale tekens (!@#$%^&amp;*)
                </h1>
            </td></tr>';

echo '      <tr><td>
                <h1 class="myclass2">
                5. - Wachtwoord is tenminste 10 tekens lang
                </h1>
            </td></tr>';

echo '        </table>
    </body>
</html>';

?>