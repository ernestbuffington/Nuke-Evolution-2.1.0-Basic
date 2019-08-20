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

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

global $bgcolor2, $_GETVAR;

$module_name = basename(dirname(__FILE__));
include_once(NUKE_BASE_DIR.'header.php');
get_lang($module_name);
title(_SBK, $module_name, 'spambot-logo.png');

/*****[BEGIN]******************************************
 [ Configuration:                                     ]
 ******************************************************/
//Keywords
$keywords = "Accounting Business Cooperatives Customer Commerce Defence Education Training Employment Email Human Resources Investing Companies Management Marketing Advertising Opportunities Small Business Big Trade Technology Free Cheap Sale Automobiles Cars";

//Words
$spamwords = $keywords;
$words = explode(" ", strtolower($spamwords));

//300 useless emails!
$numemails = 300;

//Chars
$spamchars = "a b c d e f g h i j k l m n o p q r s t u v w x y z 1 2 3 4 5 6 7 8 9 0";
$chars = explode(" ", $spamchars);

//Domains
$domains = array(".com", ".net", ".org", ".co.uk", ".nl", ".de");
srand(microtime() * 1000000);

//Counter
$counter = $_GETVAR->get('count', '_REQUEST', 'int', 0);
/*****[END]********************************************
 [ Configuration:                                     ]
 ******************************************************/

//Functions
function gensalt($length) {
    global $chars;
    mt_srand(microtime() * 1000000);
    $salt = "";
    for($j=0; $j<$length; $j++) {
        $salt .= $chars[mt_rand(0, count($chars) - 1)];
    }
    return $salt;
}

OpenTable();
echo '<table width="100%"><tr><td>';
echo $keywords ; //Fool targeted spambots!
echo '</td></tr><tr><td>';
$emailsserved = 0;
for($i=0; $i<$numemails; $i++) {
    $emailaddr = "";
    for($j=0; $j<mt_rand(2,3); $j++) {
        $emailaddr .= $words[mt_rand(0, count($words) - 1)];
    }

    //Append some junk to make it less likely to hit
    $emailaddr .= gensalt(mt_rand(0,6));
    $emailaddr .= "@";
    for($j=0; $j<mt_rand(2,3); $j++) {
        $emailaddr .= $words[mt_rand(0, count($words) - 1)];
    }

    //Append some junk to make the domain more unlikely to hit
    $emailaddr .= gensalt(mt_rand(0,6));
    $emailaddr .= $domains[mt_rand(0, count($domains) - 1)];
    echo "<a href=\"mailto:".$emailaddr."\">".$emailaddr."</a><br />\n";
    $emailsserved++;

    //Some bonuses
    if (mt_rand(1, 5) == 1) {
        $emailaddr = gensalt(mt_rand(7, 14)) . "@" . gensalt(mt_rand(8, 12)) . $domains[mt_rand(0, count($domains)-1)];
        echo "<a href=\"mailto:".$emailaddr."\">".$emailaddr."</a><br />\n";
        $emailsserved++;
    }

    //For real dumb spambots who don't even recognise MD5 hashes ;)
    if (mt_rand(1, 15) == 1) {
        $emailaddr = md5(mt_rand(1, 1000000)) . "@" . md5(mt_rand(1, 1000000)) . $domains[mt_rand(0, count($domains)-1)];
        echo "<a href=\"mailto:".$emailaddr."\">".$emailaddr."</a><br />\n";
        $emailsserved++;
    }
}
echo "<p>".$emailsserved. _SBK_SERVED."</p>\n";

//Don't use up too much bandwidth: limit hits by spambots
if ($counter <= 3) {
    $counter++;
    for($i=0; $i<10; $i++) {
        //Random salt
        $salt = gensalt(30);
        echo "<a href=\"modules.php?name=Spambot_Killer&amp;count=$counter&amp;salt=$salt\">"._SBK_MORE."</a><br />\n";
    }

    //More death traps, so even though spambots can no longer eat your bandwidth there are other ways for them to get fake emails
    $death = explode(" ", "http://www.turnstep.com/cgi-bin/Infinospam.pl http://www.turnstep.com/cgi-bin/Spamthis.pl http://www.obliquity.com/computer/spambait/loopback.html http://fantomaster.com/xfodder/mailme1.html http://fantomaster.com/xfodder/mailme2.html http://fantomaster.com/xfodder/mailme3.html http://www.towerofbabel.com/antispam/ http://mcmillan.net.nz/tackle.html http://www.unicom.com/spambait/servebait.cgi/a http://www.unicom.com/spambait/servebait.cgi/b http://www.unicom.com/spambait/servebait.cgi/c http://www.unicom.com/spambait/servebait.cgi/d http://www.unicom.com/spambait/servebait.cgi/e http://www.unicom.com/spambait/servebait.cgi/f http://www.mts.net/~mbreault/maillist.html http://www.100megsfree3.com/bookmarks/bane/page1.htm http://www.100megsfree3.com/bookmarks/bane/page2.htm http://www.100megsfree3.com/bookmarks/bane/page3.htm http://www.100megsfree3.com/bookmarks/bane/page4.htm http://www.cling.gu.se/~cl3polof/spambait.html http://members.sitegadgets.com/stoplavelle/email.html http://www.fleiner.com/bots/mailtrap.shtml");

    //Link to them
    if ($counter >= 2) {
        foreach($death as $dying) {
            $salt = gensalt(30);
            echo "<a href=\"".$dying."?salt=".$salt."\">".$dying."</a><br />\n";
        }
    }
}

//Shovel some junk down the throat of the spambot - try to make it crash! ;)
$limit = 8000; //Crank it up for effectiveness!
echo '</td></tr></table><table width="100%"><tr><td>';
echo "<p>"._SBK_BOTS_ONLY."</p><hr />";
for($i=0; $i<$limit; $i++) {
    echo chr(mt_rand(0, 255));
    if (mt_rand(1, 25) == 1) echo "<a href=mailto:";
    if (mt_rand(1, 25) == 1) echo ">";
    if (mt_rand(1, 25) == 1) echo "</a>\n";
}

echo '</td></tr></table>';
CloseTable();

include_once(NUKE_BASE_DIR.'footer.php');

?>