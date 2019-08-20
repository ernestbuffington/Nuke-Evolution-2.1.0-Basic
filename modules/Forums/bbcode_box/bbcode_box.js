if ( !evo_img_path ) {  var evo_img_path = "/images/"; }
var theSelection = false;

var clientPC = navigator.userAgent.toLowerCase(); // Get client info
var clientVer = parseInt(navigator.appVersion); // Get browser version

var is_ie = ((clientPC.indexOf("msie") != -1) && (clientPC.indexOf("opera") == -1));
var is_nav = ((clientPC.indexOf('mozilla')!=-1) && (clientPC.indexOf('spoofer')==-1)
                && (clientPC.indexOf('compatible') == -1) && (clientPC.indexOf('opera')==-1)
                && (clientPC.indexOf('webtv')==-1) && (clientPC.indexOf('hotjava')==-1));
var is_moz = 0;

var is_win = ((clientPC.indexOf("win")!=-1) || (clientPC.indexOf("16bit") != -1));
var is_mac = (clientPC.indexOf("mac")!=-1);

var baseHeight = 0;
var Quote = 0;
var Bold  = 0;
var Italic = 0;
var Underline = 0;
var Code = 0;
var flash = 0;
var fc = 0;
var fs = 0;
var ft = 0;
var center = 0;
var right = 0;
var left = 0;
var justify = 0;
var fade = 0;
var marqd = 0;
var marqu = 0;
var marql = 0;
var marqr = 0;
var mail = 0;
var video = 0;
var stream = 0;
var ram = 0;
var hr = 0;
var grad = 0;
var plain = 0;
var List = 0;
var Strikeout = 0;
var Spoiler = 0;
var superscript = 0;
var subscript = 0;
var symbol = 0;
var PHP = 0;
var youtube = 0;
var GVideo = 0;

// Fix a bug involving the TextRange object in IE. From
// http://www.frostjedi.com/terra/scripts/demo/caretBug.html
// (script by TerraFrost modified by reddog)
function initInsertions() {
    document.post.message.focus();
    if (is_ie && typeof(baseHeight) != 'number') baseHeight = document.selection.createRange().duplicate().boundingHeight;
}

function BBCplain() {
    theSelection = document.selection.createRange().text;
    if (theSelection != '') {
        temp = theSelection;
        temp = temp.replace(/\[FLASH=([^\]]*)\]WIDTH=[0-9]{0,4} HEIGHT=[0-9]{0,4}\[\/FLASH\]/gi,"$1");
        temp = temp.replace(/\[VIDEO=([^\]]*)\]WIDTH=[0-9]{0,4} HEIGHT=[0-9]{0,4}\[\/VIDEO\]/gi,"$1");
        document.selection.createRange().text = temp.replace(/\[[^\]]*\]/gi,"");
    }
}

function BBCgrad() {
    var oSelect,oSelectRange;
    document.post.message.focus();
    oSelect = document.selection;
    oSelectRange = oSelect.createRange();
    if (oSelectRange.text.length < 1) { alert(bbcode_text_first);
return;
}
    if (oSelectRange.text.length > 120) {
      alert(bbcode_less_letters);
      return;
    }
    showModalDialog("modules/Forums/bbcode_box/grad.htm",oSelectRange,"help:no; center:yes; status:no; dialogHeight:50px; dialogWidth:50px");
}

function BBChr() {
    ToAdd = "[hr]";
    PostWrite(ToAdd);
}

function BBCram() {
        var FoundErrors = '';
        var enterURL   = prompt(bbcode_rm_url,"http://");
        if (!enterURL) {
                FoundErrors += bbcode_no_file_url;
        }
     var enterW   = prompt(bbcode_rm_width, "220");
    if (!enterW)    {
        FoundErrors += bbcode_no_rm_width;
    }
    var enterH   = prompt(bbcode_rm_height, "140");
    if (!enterH)    {
        FoundErrors += bbcode_no_rm_height;
    }
    if (FoundErrors)  {
        alert(bbcode_error+FoundErrors);
        return;
    }
    var ToAdd = "[ram width="+enterW+" height="+enterH+"]"+enterURL+"[/ram]";
    PostWrite(ToAdd);
}

function BBCstream() {
        var FoundErrors = '';
        var enterURL   = prompt(bbcode_stream_url,"http://");
        if (!enterURL) {
                FoundErrors += bbcode_no_file_url;
        }
        if (FoundErrors) {
                alert(bbcode_error+FoundErrors);
                return;
        }
        var ToAdd = "[stream]"+enterURL+"[/stream]";
        PostWrite(ToAdd);
}

function BBCvideo() {
    var FoundErrors = '';
    var enterURL   = prompt(bbcode_video_url, "http://");
    if (!enterURL)    {
        FoundErrors += bbcode_no_file_url;
    }
        var enterW   = prompt(bbcode_video_width, "400");
    if (!enterW)    {
        FoundErrors += bbcode_no_video_width;
    }
    var enterH   = prompt(bbcode_video_height, "350");
    if (!enterH)    {
        FoundErrors += bbcode_no_video_height;
    }
    if (FoundErrors)  {
        alert(bbcode_error+FoundErrors);
        return;
    }
    var ToAdd = "[video width="+enterW+" height="+enterH+"]"+enterURL+"[/video]";
    PostWrite(ToAdd);
}

function BBCGVideo() {
   var FoundErrors = '';
   var enterURL   = prompt(bbcode_google_url, "http://");
   if (!enterURL)    {
      FoundErrors += bbcode_no_file_url;
   }
   if (FoundErrors)  {
      alert(bbcode_error+FoundErrors);
      return;
   }
   var ToAdd = "[GVideo]"+enterURL+"[/GVideo]";
   PostWrite(ToAdd);
}

function BBCyoutube() {
   var FoundErrors = '';
   var enterURL   = prompt(bbcode_youtube, "http://");
   if (!enterURL)    {
      FoundErrors += bbcode_no_file_url;
   }
   if (FoundErrors)  {
      alert(bbcode_error+FoundErrors);
      return;
   }
   var ToAdd = "[youtube]"+enterURL+"[/youtube]";
   PostWrite(ToAdd);
}

function BBCmail() {
        var FoundErrors = '';
        var entermail   = prompt(bbcode_email,"");
        if (!entermail) {
                FoundErrors += bbcode_no_email;
        }
        if (FoundErrors) {
                alert(bbcode_error+FoundErrors);
                return;
        }
        var ToAdd = "[email]"+entermail+"[/email]";
        PostWrite(ToAdd);
}

function BBCstrike() {
    var txtarea = document.post.message;

    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[s]" + theSelection + "[/s]";
        document.post.message.focus();
        return;
        }
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, "[s]", "[/s]");
        return;
    }
    if (Strikeout == 0) {
        ToAdd = "[s]";
        document.strik.src = evo_img_path + "bbcode/strike1.gif";
        Strikeout = 1;
    } else {
        ToAdd = "[/s]";
        document.strik.src = evo_img_path + "bbcode/strike.gif";
        Strikeout = 0;
    }
    PostWrite(ToAdd);
}

function BBCspoil() {
    var txtarea = document.post.message;

    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[spoil]" + theSelection + "[/spoil]";
        document.post.message.focus();
        return;
        }
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, "[spoil]", "[/spoil]");
        return;
    }
    if (Spoiler == 0) {
        ToAdd = "[spoil]";
        document.spoil.src = evo_img_path + "bbcode/spoil1.gif";
        Spoiler = 1;
    } else {
        ToAdd = "[/spoil]";
        document.spoil.src = evo_img_path + "bbcode/spoil.gif";
        Spoiler = 0;
    }
    PostWrite(ToAdd);
}

function BBCmarqu() {
    var txtarea = document.post.message;

    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[marq=up]" + theSelection + "[/marq]";
        document.post.message.focus();
        return;
        }
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, "[marq=up]", "[/marq]");
        return;
    }
    if (marqu == 0) {
        ToAdd = "[marq=up]";
        document.post.marqu.src = evo_img_path + "bbcode/marqu1.gif";
        marqu = 1;
    } else {
        ToAdd = "[/marq]";
        document.post.marqu.src = evo_img_path + "bbcode/marqu.gif";
        marqu = 0;
    }
    PostWrite(ToAdd);
}

function BBCmarql() {
    var txtarea = document.post.message;

    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[marq=left]" + theSelection + "[/marq]";
        document.post.message.focus();
        return;
        }
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, "[marq=left]", "[/marq]");
        return;
    }
    if (marql == 0) {
        ToAdd = "[marq=left]";
        document.post.marql.src = evo_img_path + "bbcode/marql1.gif";
        marql = 1;
    } else {
        ToAdd = "[/marq]";
        document.post.marql.src = evo_img_path + "bbcode/marql.gif";
        marql = 0;
    }
    PostWrite(ToAdd);
}

function BBCmarqr() {
    var txtarea = document.post.message;

    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[marq=right]" + theSelection + "[/marq]";
        document.post.message.focus();
        return;
        }
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, "[marq=right]", "[/marq]");
        return;
    }
    if (marqr == 0) {
        ToAdd = "[marq=right]";
        document.post.marqr.src = evo_img_path + "bbcode/marqr1.gif";
        marqr = 1;
    } else {
        ToAdd = "[/marq]";
        document.post.marqr.src = evo_img_path + "bbcode/marqr.gif";
        marqr = 0;
    }
    PostWrite(ToAdd);
}

function BBCdir(dirc) {
       document.post.message.dir=(dirc);
}

function BBCfade() {
    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[fade]" + theSelection + "[/fade]";
        document.post.message.focus();
        return;
        }
    }
    if (fade == 0) {
        ToAdd = "[fade]";
        document.post.fade.src = evo_img_path + "bbcode/fade1.gif";
        fade = 1;
    } else {
        ToAdd = "[/fade]";
        document.post.fade.src = evo_img_path + "bbcode/fade.gif";
        fade = 0;
    }
    PostWrite(ToAdd);
}

function BBCjustify() {
    var txtarea = document.post.message;

    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[align=justify]" + theSelection + "[/align]";
        document.post.message.focus();
        return;
        }
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, "[align=justify]", "[/align]");
        return;
    }
    if (justify == 0) {
        ToAdd = "[align=justify]";
        document.post.justify.src = evo_img_path + "bbcode/justify1.gif";
        justify = 1;
    } else {
        ToAdd = "[/align]";
        document.post.justify.src = evo_img_path + "bbcode/justify.gif";
        justify = 0;
    }
    PostWrite(ToAdd);
}

function BBCleft() {
    var txtarea = document.post.message;

    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[align=left]" + theSelection + "[/align]";
        document.post.message.focus();
        return;
        }
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, "[align=left]", "[/align]");
        return;
    }
    if (left == 0) {
        ToAdd = "[align=left]";
        document.post.left.src = evo_img_path + "bbcode/left1.gif";
        left = 1;
    } else {
        ToAdd = "[/align]";
        document.post.left.src = evo_img_path + "bbcode/left.gif";
        left = 0;
    }
    PostWrite(ToAdd);
}

function BBCright() {
    var txtarea = document.post.message;

    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[align=right]" + theSelection + "[/align]";
        document.post.message.focus();
        return;
        }
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, "[align=right]", "[/align]");
        return;
    }
    if (right == 0) {
        ToAdd = "[align=right]";
        document.post.right.src = evo_img_path + "bbcode/right1.gif";
        right = 1;
    } else {
        ToAdd = "[/align]";
        document.post.right.src = evo_img_path + "bbcode/right.gif";
        right = 0;
    }
    PostWrite(ToAdd);
}

function BBCcenter() {
    var txtarea = document.post.message;

    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[align=center]" + theSelection + "[/align]";
        document.post.message.focus();
        return;
        }
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, "[align=center]", "[/align]");
        return;
    }
    if (center == 0) {
        ToAdd = "[align=center]";
        document.post.center.src = evo_img_path + "bbcode/center1.gif";
        center = 1;
    } else {
        ToAdd = "[/align]";
        document.post.center.src = evo_img_path + "bbcode/center.gif";
        center = 0;
    }
    PostWrite(ToAdd);
}

function BBCft() {
    var txtarea = document.post.message;

    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[font="+document.post.ft.value+"]" + theSelection + "[/font]";
        document.post.message.focus();
        return;
        }
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, "[font="+document.post.ft.value+"]", "[/font]");
        return;
    }
    ToAdd = "[font="+document.post.ft.value+"]"+" "+"[/font]";
    PostWrite(ToAdd);
}

function BBCfs() {
    var txtarea = document.post.message;

    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[size="+document.post.fs.value+"]" + theSelection + "[/size]";
        document.post.message.focus();
        return;
        }
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, "[size="+document.post.fs.value+"]", "[/size]");
        return;
    }
    ToAdd = "[size="+document.post.fs.value+"]"+" "+"[/size]";
    PostWrite(ToAdd);
}

function BBCfc() {
    var txtarea = document.post.message;

    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[color="+document.post.fc.value+"]" + theSelection + "[/color]";
        document.post.message.focus();
        return;
        }
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, "[color="+document.post.fc.value+"]", "[/color]");
        return;
    }
    ToAdd = "[color="+document.post.fc.value+"]"+" "+"[/color]";
    PostWrite(ToAdd);
}

function BBCmarqd() {
    var txtarea = document.post.message;

    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[marq=down]" + theSelection + "[/marq]";
        document.post.message.focus();
        return;
        }
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, "[marq=down]", "[/marq]");
        return;
    }
    if (marqd == 0) {
        ToAdd = "[marq=down]";
        document.post.marqd.src = evo_img_path + "bbcode/marqd1.gif";
        marqd = 1;
    } else {
        ToAdd = "[/marq]";
        document.post.marqd.src = evo_img_path + "bbcode/marqd.gif";
        marqd = 0;
    }
    PostWrite(ToAdd);
}

function BBCflash() {
    var FoundErrors = '';
    var enterURL   = prompt(bbcode_flash_url, "http://");
    if (!enterURL)    {
        FoundErrors += bbcode_no_flash_url;
    }
    var enterW   = prompt(bbcode_flash_width, "250");
    if (!enterW)    {
        FoundErrors += bbcode_no_flash_width;
    }
    var enterH   = prompt(bbcode_flash_height, "250");
    if (!enterH)    {
        FoundErrors += bbcode_no_flash_height;
    }
    if (FoundErrors)  {
        alert(bbcode_error+FoundErrors);
        return;
    }
    var ToAdd = "[flash width="+enterW+" height="+enterH+"]"+enterURL+"[/flash]";
    PostWrite(ToAdd);
}


function BBCsup() {
    var txtarea = document.post.message;

    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[sup]" + theSelection + "[/sup]";
        document.post.message.focus();
        return;
        }
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, "[sup]", "[/sup]");
        return;
    }
    if (superscript == 0) {
        ToAdd = "[sup]";
        document.supscript.src = evo_img_path + "bbcode/sup1.gif";
        superscript = 1;
    } else {
        ToAdd = "[/sup]";
        document.supscript.src = evo_img_path + "bbcode/sup.gif";
        superscript = 0;
    }
    PostWrite(ToAdd);
}

function BBCsub() {
    var txtarea = document.post.message;

    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[sub]" + theSelection + "[/sub]";
        document.post.message.focus();
        return;
        }
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, "[sub]", "[/sub]");
        return;
    }
    if (subscript == 0) {
        ToAdd = "[sub]";
        document.subs.src = evo_img_path + "bbcode/sub1.gif";
        subscript = 1;
    } else {
        ToAdd = "[/sub]";
        document.subs.src = evo_img_path + "bbcode/sub.gif";
        subscript = 0;
    }
    PostWrite(ToAdd);
}

function BBCcode() {
    var txtarea = document.post.message;

    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[code]" + theSelection + "[/code]";
        document.post.message.focus();
        return;
        }
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, "[code]", "[/code]");
        return;
    }
    if (Code == 0) {
        ToAdd = "[code]";
        document.post.code.src = evo_img_path + "bbcode/code1.gif";
        Code = 1;
    } else {
        ToAdd = "[/code]";
        document.post.code.src = evo_img_path + "bbcode/code.gif";
        Code = 0;
    }
    PostWrite(ToAdd);
}

function BBCphp() {
    var txtarea = document.post.message;
    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[php]" + theSelection + "[/php]";
        document.post.message.focus();
        return;
        }
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, "[php]", "[/php]");
        return;
    }
    if (PHP == 0) {
        ToAdd = "[php]";
        document.post.php.src = evo_img_path + "bbcode/php1.gif";
        PHP = 1;
    } else {
        ToAdd = "[/php]";
        document.post.php.src = evo_img_path + "bbcode/php.gif";
        PHP = 0;
    }
    PostWrite(ToAdd);
}

function BBCquote() {
    var txtarea = document.post.message;

    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[quote]" + theSelection + "[/quote]";
        document.post.message.focus();
        return;
        }
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, "[quote]", "[/quote]");
        return;
    }
    if (Quote == 0) {
        ToAdd = "[quote]";
        document.post.quote.src = evo_img_path + "bbcode/quote1.gif";
        Quote = 1;
    } else {
        ToAdd = "[/quote]";
        document.post.quote.src = evo_img_path + "bbcode/quote.gif";
        Quote = 0;
    }
    PostWrite(ToAdd);
}

function BBClist() {
    var txtarea = document.post.message;

    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[list]" + theSelection + "[/list]";
        document.post.message.focus();
        return;
        }
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, "[list]", "[/list]");
        return;
    }
    if (List == 0) {
        ToAdd = "[list]";
        document.listdf.src = evo_img_path + "bbcode/list1.gif";
        List = 1;
    } else {
        ToAdd = "[/list]";
        document.listdf.src = evo_img_path + "bbcode/list.gif";
        List = 0;
    }
    PostWrite(ToAdd);
}

function BBCbold() {
    var txtarea = document.post.message;

    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[b]" + theSelection + "[/b]";
        document.post.message.focus();
        return;
        }
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, "[b]", "[/b]");
        return;
    }
    if (Bold == 0) {
        ToAdd = "[b]";
        document.post.bold.src = evo_img_path + "bbcode/bold1.gif";
        Bold = 1;
    } else {
        ToAdd = "[/b]";
        document.post.bold.src = evo_img_path + "bbcode/bold.gif";
        Bold = 0;
    }
    PostWrite(ToAdd);
}

function BBCitalic() {
    var txtarea = document.post.message;

    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[i]" + theSelection + "[/i]";
        document.post.message.focus();
        return;
        }
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, "[i]", "[/i]");
        return;
    }
    if (Italic == 0) {
        ToAdd = "[i]";
        document.post.italic.src = evo_img_path + "bbcode/italic1.gif";
        Italic = 1;
    } else {
        ToAdd = "[/i]";
        document.post.italic.src = evo_img_path + "bbcode/italic.gif";
        Italic = 0;
    }
    PostWrite(ToAdd);
}

function BBCunder() {
    var txtarea = document.post.message;

    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (theSelection != '') {
        document.selection.createRange().text = "[u]" + theSelection + "[/u]";
        document.post.message.focus();
        return;
        }
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, "[u]", "[/u]");
        return;
    }
    if (Underline == 0) {
        ToAdd = "[u]";
        document.post.under.src = evo_img_path + "bbcode/under1.gif";
        Underline = 1;
    } else {
        ToAdd = "[/u]";
        document.post.under.src = evo_img_path + "bbcode/under.gif";
        Underline = 0;
    }
    PostWrite(ToAdd);
}

function BBCurl() {
    var FoundErrors = '';
    var enterURL   = prompt(bbcode_url, "http://");
    var enterTITLE = prompt(bbcode_pagename, bbcode_web_pagename);
    if (!enterURL)    {
        FoundErrors += bbcode_no_url;
    }
    if (!enterTITLE)  {
        FoundErrors += bbcode_no_pagename;
    }
    if (FoundErrors)  {
        alert(bbcode_error+FoundErrors);
        return;
    }
    var ToAdd = "[url="+enterURL+"]"+enterTITLE+"[/url]";
    PostWrite(ToAdd);
}

function BBCimg() {
    var FoundErrors = '';
    var enterURL   = prompt(bbcode_img_url,"http://");
    if (!enterURL) {
        FoundErrors += bbcode_no_img_url;
    }
    if (FoundErrors) {
        alert("Error :"+FoundErrors);
        return;
    }
    var ToAdd = "[img]"+enterURL+"[/img]";
    document.post.message.value+=ToAdd;
    document.post.message.focus();
}

function storeCaret(textEl) {
    if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate(); document.post.message.focus();
}


function mozWrap(txtarea, open, close)
{
    var selLength = txtarea.textLength;
    var selStart = txtarea.selectionStart;
    var selEnd = txtarea.selectionEnd;
    if (selEnd == 1 || selEnd == 2)
        selEnd = selLength;

    var s1 = (txtarea.value).substring(0,selStart);
    var s2 = (txtarea.value).substring(selStart, selEnd)
    var s3 = (txtarea.value).substring(selEnd, selLength);
    txtarea.value = s1 + open + s2 + close + s3;
    return;
}

function sqr_show_hide()
{
    var id = 'sqr';
    var item = null;

    if (document.getElementById)
    {
        item = document.getElementById(id);
    }
    else if (document.all)
    {
        item = document.all[id];
    }
    else if (document.layers)
    {
        item = document.layers[id];
    }

    if (item && item.style)
    {
        if (item.style.display == "none")
        {
            item.style.display = "";
        }
        else
        {
            item.style.display = "none";
        }
    }
    else if (item)
    {
        item.visibility = "show";
    }
}

function sqr_show()
{
    var id = 'sqr';
    var item = null;

    if (document.getElementById)
    {
        item = document.getElementById(id);
    }
    else if (document.all)
    {
        item = document.all[id];
    }
    else if (document.layers)
    {
        item = document.layers[id];
    }

    if (item && item.style)
    {
        if (item.style.display == "none")
        {
            item.style.display = "";
        }
    }
    else if (item)
    {
        item.visibility = "show";
    }
}

function openAllSmiles(){
    smiles = window.open('modules.php?name=Forums&amp;file=posting&amp;mode=smilies&amp;popup=1', '_phpbbsmilies', 'height=300,resizable=yes,scrollbars=yes,width=500');
    smiles.focus();
    return false;
}
function quoteSelection()
{
        if (document.getSelection) txt = document.getSelection();
    else if (document.selection) txt = document.selection.createRange().text;
    else return;

    theSelection = txt.replace(new RegExp('([\\f\\n\\r\\t\\v ])+', 'g')," ");
        if (theSelection) {
            // Add tags around selection
            emoticon( '[quote]\n' + theSelection + '\n[/quote]\n');
            document.post.message.focus();
            theSelection = '';
            return;
        }else{
            alert(bbcode_quote);
        }
}

function helpline(help) {
    document.post.helpbox.value = help;
    document.post.helpbox.readOnly = "true";
}

function checkForm() {
    formErrors = false;
    if (document.post.message.value.length < 2) {
        formErrors = bbcode_no_message;
    }
    if (formErrors) {
        alert(formErrors);
        return false;
    } else {
        //formObj.preview.disabled = true;
        //formObj.submit.disabled = true;
        return true;
    }
}

function emoticon(text) {
    var txtarea = document.post.message;
     if (is_ie && typeof(baseHeight) != 'number') baseHeight = document.selection.createRange().duplicate().boundingHeight;
    text = ' ' + text + ' ';
    if (txtarea.createTextRange && txtarea.caretPos) {
        if (baseHeight != txtarea.caretPos.boundingHeight) {
            txtarea.focus();
            storeCaret(txtarea);
        }
        var caretPos = txtarea.caretPos;
        caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? caretPos.text + text + '&nbsp;' : caretPos.text + text;
        txtarea.focus();
    } else
    if (txtarea.selectionEnd && (txtarea.selectionStart | txtarea.selectionStart == 0))
    {
        mozWrap(txtarea, text, "");
        return;
    } else {
        txtarea.value  += text;
        txtarea.focus();
    }
}

function bbfontstyle(bbopen, bbclose) {
    var txtarea = document.post.message;

    if ((clientVer >= 4) && is_ie && is_win) {
        theSelection = document.selection.createRange().text;
        if (!theSelection) {
            txtarea.value += bbopen + bbclose;
            txtarea.focus();
            return;
        }
        document.selection.createRange().text = bbopen + theSelection + bbclose;
        txtarea.focus();
        return;
    }
    else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
    {
        mozWrap(txtarea, bbopen, bbclose);
        return;
    }
    else
    {
        txtarea.value += bbopen + bbclose;
        txtarea.focus();
    }
    storeCaret(txtarea);
}

function PostWrite(text) {
    if (document.post.message.createTextRange && document.post.message.caretPos) {
        var caretPos = document.post.message.caretPos;
        caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ?    text + ' ' : text;
    }
    else document.post.message.value += text;
    document.post.message.focus(caretPos)
}