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

class Wysiwyg {
    var $editor;
    var $type;
    var $form;
    var $field;
    var $width;
    var $height;
    var $value;
    var $smilies;
    var $pass;

    function Wysiwyg($form, $field, $width='100%', $height='300px', $value='', $smilies=true, $editor='') {
        global $evoconfig;
        if (!empty($editor)) {
            $wysiwyg = $editor;
        } else {
            $wysiwyg = $evoconfig['textarea'];
        }
        if (!empty($wysiwyg) && $wysiwyg != 'bbcode' && $wysiwyg != 'none') {
            $inputwidth  = str_replace('px', '', $width);
            $inputheight = str_replace('px', '', $height);
        } else {
            $inputwidth  = $width;
            $inputheight = $height;
        }
        if (!empty($wysiwyg) && $wysiwyg != 'bbcode' && $wysiwyg != 'none') {
            if (@file_exists(NUKE_INCLUDE_DIR."wysiwyg/$wysiwyg/$wysiwyg.php")) {
                include_once(NUKE_INCLUDE_DIR."wysiwyg/$wysiwyg/$wysiwyg.php");
                $func = $wysiwyg.'_getInstance';
                if (function_exists($func)) {
                    $this->pass = 1;
                    $this->editor = $func($field, $width, $height, $value);
                } else {
                    $this->pass = 0;
                    $this->editor = new $wysiwyg($field, $width, $height, $value);
                }
            } else {
                $wysiwyg = '';
        	DisplayError('Seçilen WYSIWYG editör "'.$wysiwyg.'" çalışabilir durumda değil', 1);
            }
        }
        $this->type   = $wysiwyg;
        $this->form   = $form;
        $this->field  = $field;
        $this->width  = $inputwidth;
        $this->height = $inputheight;
        $this->value  = $value;
        $this->smilies = $smilies;
    }

    function setHeader() {
        if (!empty($this->editor) && method_exists($this->editor, 'setHeader')) {
            $this->editor->setHeader();
        }
    }

    function getSelect($selected='') {
        global $evoconfig;
        if (empty($selected)) {
          $selected = $evoconfig['textarea'];
        }
        return select_box('xtextarea', $selected, $this->getEditors()). '</td></tr>';
    }

    function getEditors() {
        $editors = array('' => _NONE);
        $editors['bbcode'] = 'BBCode';
        $wysiwygs = @dir(NUKE_INCLUDE_DIR.'wysiwyg');
        while ($dir = $wysiwygs->read()) {
            if ($dir[0] != '.' && @file_exists(NUKE_INCLUDE_DIR."wysiwyg/$dir/$dir.php")) {
                $editors[$dir] = $dir;
            }
        }
        $wysiwygs->close();
        return $editors;
    }

    function getHTML() {
        if (!empty($this->editor)) {
            if ($this->pass) {
                $this->setHeader();
          return $this->editor->CreateHtml($this->field);
            }
        return $this->editor->CreateHtml();
        } elseif ($this->type == 'bbcode') {
            $Html = nbbcode_table($this->field, $this->form, 1, $this->value);
            $Html .= '<textarea id="'.$this->field.'" name="'.$this->field.'" cols="0" rows="0" style="width: '.$this->width.'; height: '.$this->height.'" onselect="storeCaret(this);">'.htmlspecialchars($this->value).'</textarea><br />';
            $smilies_table = ($this->smilies) ? '<br />'.smilies_table('onerow',$this->field, $this->form, $this->field).'<br /><br />' : '';
            return $Html . $smilies_table;
        } else {
            return '<textarea id="'.$this->field.'" name="'.$this->field.'" cols="0" rows="0" style="wrap:virtual;overflow:scroll;width:'.$this->width.';height:'.$this->height.' ">'.htmlspecialchars($this->value).'</textarea><br />';
        }
    }

    function Show() { echo $this->getHTML(); echo '<br />'; }
    function Ret() { return $this->getHTML(); }
}

?>