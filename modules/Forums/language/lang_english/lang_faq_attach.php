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

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }

$faq[] = array("--", "Attachments");
$faq[] = array("How do I add an attachment?", "You can add attachments when you post a new post. You should see a <em>Add an Attachment</em> form below the main posting box. When you click the <em>Browse...</em> button the standard Open dialogue window for your computer will open. Browse to the file you want to attach, select it and click OK, Open or doubleclick according to your liking and/or the correct procedure for your computer. If you choose to add a comment in the <em>File Comment</em> field this comment will be used as a link to the attached file. If you haven't added a comment the filename itself will be used to link to the attachment. If the board administrator has allowed it you will be able to upload multiple attachements by following the same procedure as described above until you reach the max allowed number of attachments for each post.<br /><br />The board administrator sets an upper limit for filesize, defined file extensions and other things for attachments on the board. Be aware that it's your responsiblity that your attachments comply with the boards acceptance of use policy, and that they may be deleted without warning.<br /><br />Please note that the boards owner, webmaster, administrator or moderators can not and will not take responsibility for any loss of data.");
$faq[] = array("How do I add an attachment after the initial posting?", "To add an attachment after the initial posting you'll need to edit your post and follow the description above. The new attachment will be added when you click <em>Submit</em> to add the edited post.");
$faq[] = array("How do I delete an attachment?", "To delete attachments you'll need to edit your post and click on the <em>Delete Attachment</em> next to the attachment you want to delete in the <em>Posted Attachments</em> box. The attachment will be deleted when you click <em>Submit</em> to add the edited post.");
$faq[] = array("How do I update a file comment?", "To update a file comment you'll need to edit your post, edit the text in the <em>File Comment</em> field and click on the <em>Update Comment</em> button next to the file comment you want to update in the <em>Posted Attachments</em> box. The file comment will be updated when you click <em>Submit</em> to add the edited post.");
$faq[] = array("Why isn't my attachment visible in the post?", "Most probably the file or Extension is no longer allowed on the forum, or a moderator or administrator has deleted it for being in conflict with the boards acceptance of use policy.");
$faq[] = array("Why can't I add attachments?", "On some forums adding attachments may be limited to certain users or groups. To add attachments you may need special authorisation, only the forum moderator and board admin can grant this access, you should contact them.");
$faq[] = array("I've got the necessary permissions, why can't I add attachments?", "The board administrator sets an upper limit for filesize, file extensions and other things for attachments on the board. A moderator or administrator may have altered your permissions, or discontinued attachments in the specific forum. You should get an explanation in the error message when trying to add an attachment, if not you might consider contacting the moderator or administrator.");
$faq[] = array("Why can't I delete attachments?", "On some forums deleting attachments may be limited to certain users or groups. To delete attachments you may need special authorisation, only the forum moderator and board admin can grant this access, you should contact them.");
$faq[] = array("Why can't I view/download attachments?", "On some viewing/downloading forums attachments may be limited to certain users or groups. To view/download attachments you may need special authorisation, only the forum moderator and board admin can grant this access, you should contact them.");
$faq[] = array("Who do I contact about illegal or possibly illegal attachments?", "You should contact the administrator of this board. If you cannot find who this is you should first contact one of the forum moderators and ask them who you should in turn contact. If you still get no response you should contact the owner of the domain (do a whois lookup) or, if this is running on a free service (e.g. yahoo, free.fr, f2s.com, etc.), the management or abuse department of that service. Please note that phpBB Group has absolutely no control and cannot in any way be held liable over how, where or by whom this board is used. It is absolutely pointless contacting phpBB Group in relation to any legal (cease and desist, liable, defamatory comment, etc.) matter not directly related to the phpbb.com website or the discrete software of phpBB itself. If you do email phpBB Group about any third party use of this software then you should expect a terse response or no response at all.");

?>