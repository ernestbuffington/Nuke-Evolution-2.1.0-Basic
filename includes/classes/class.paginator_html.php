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

      class Paginator_html extends Paginator {

        //outputs a link set like this 1 of 4 of 25 First | Prev | Next | Last |
        function firstLast()
        {
           if($this->getCurrent()==1)
             {
             $first = "First | ";
             } else { $first="<a href=\"" .  $this->getPageName() . "?op=ws_submemb&amp;page=" . $this->getFirst() . "\">First</a> |"; }
           if($this->getPrevious())
             {
             $prev = "<a href=\"" .  $this->getPageName() . "?op=ws_submemb&amp;page=" . $this->getPrevious() . "\">Prev</a> | ";
             } else { $prev="Prev | "; }

           if($this->getNext())
             {
             $next = "<a href=\"" . $this->getPageName() . "?op=ws_submemb&amp;page=" . $this->getNext() . "\">Next</a> | ";
             } else { $next="Next | "; }


           if($this->getLast())
             {
             $last = "<a href=\"" . $this->getPageName() . "?op=ws_submemb&amp;page=" . $this->getLast() . "\">Last</a> | ";
             } else { $last="Last | "; }
             echo $this->getFirstOf() . " of " .$this->getSecondOf() . " of " . $this->getTotalItems() . " ";
             echo $first . " " . $prev . " " . $next . " " . $last;
        }
        //outputs a link set like this Previous 1 2 3 4 5 6 Next
        function previousNext()
        {
          if($this->getPrevious())
            {
            echo "<a href=\"" . $this->getPageName() . "?op=ws_submemb&amp;page=" . $this->getPrevious() . "\">Previous</a> ";
            }
            $links = $this->getLinkArr();
          foreach($links as $link)
            {
            if($link == $this->getCurrent())
              {
               echo " $link ";
              } else { echo "<a href=\"" . $this->getPageName() . "?op=ws_submemb&amp;page=$link\">" . $link . "</a> ";
              }
              }
            if($this->getNext())
              {
              echo "<a href=\"" . $this->getPageName() . "?op=ws_submemb&amp;page=" . $this->getNext() . "\">Next</a> ";
              }
            }
  }//ends class

?>