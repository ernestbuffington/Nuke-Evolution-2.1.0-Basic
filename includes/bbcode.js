var bbcode = new Array();
var theSelection = false;

function helpline(form, field, help) {
    document.forms[form].elements["help"+field].value = help;
    document.forms[form].elements["help"+field].readOnly = "true";
}

function BBChr(form, field) { BBCwrite(form, field, '', "[hr]", true); }
function BBCdir(form, field, dirc) { document.forms[form].elements[field].dir=(dirc); }
function BBCft(form, field, box) { BBCfont(form, field, "font", box); }
function BBCfs(form, field, box) { BBCfont(form, field, "size", box); }
function BBCfc(form, field, box) { BBCfont(form, field, "color", box); }
function BBCfont(form, field, code, box) { BBCwrite(form, field, "["+code+"="+box.value+"]", "[/"+code+"]", true); }

function BBCwmi(form, field, type) {
    if (type == 'img') { var URL = prompt(bbcode_img_url,"http://"); }
    else { var URL = prompt(bbcode_email,""); }
    if (URL == null) { return; }
    if (!URL) { return alert(bbcode_error+bbcode_no_url); }
    BBCwrite(form, field, '', "["+type+"]"+URL+"[/"+type+"]", true);
}

function BBCode(form, field, code, img) {
    var type = img.name;
    if (BBCwrite(form, field, "["+code+"="+type+"]", "[/"+code+"]")) { return; }
    if (bbcode[code+type+form+field] == null) {
        ToAdd = "["+code+"="+type+"]";
        re = new RegExp(type+".(\\w+)$");
        img.src = img.src.replace(re, type+"1.$1");
        bbcode[code+type+form+field] = 1;
    } else {
        ToAdd = "[/"+code+"]";
        re = new RegExp(type+"1.(\\w+)$");
        img.src = img.src.replace(re, type+".$1");
        bbcode[code+type+form+field] = null;
    }
    BBCwrite(form, field, '', ToAdd, true);
}

function BBCcode(form, field, img) {
    var code = img.name;
    if (BBCwrite(form, field, "["+code+"]", "[/"+code+"]")) { return; }
    if (bbcode[form+field+code] == null) {
        ToAdd = "["+code+"]";
        re = new RegExp(code+".(\\w+)$");
        img.src = img.src.replace(re, code+"1.$1");
        bbcode[form+field+code] = 1;
    } else {
        ToAdd = "[/"+code+"]";
        re = new RegExp(code+"1.(\\w+)$");
        img.src = img.src.replace(re, code+".$1");
        bbcode[form+field+code] = null;
    }
    BBCwrite(form, field, '', ToAdd, true);
}

function BBCmm(form, field, type) {
    var URL = prompt(bbcode_url, "http://");
    if (URL == null) { return; }
    if (!URL) { return alert(bbcode_error+" "+bbcode_no_url); }
    var WS = prompt(bbcode_height, "250");
    if (WS == null) { return; }
    if (!WS) { WS = 250; }
    var HS = prompt(bbcode_width, "200");
    if (HS == null) { return; }
    if (!HS) { HS = 200; }
    BBCwrite(form, field, '', "["+type+" width="+WS+" height="+HS+"]"+URL+"[/"+type+"]", true);
}

function BBCurl(form, field) {
    var URL = prompt(bbcode_url, "http://");
    if (URL == null) { return; }
    if (!URL) { return alert(bbcode_error+bbcode_no_url); }
    if (BBCwrite(form, field, "[url="+URL+"]", "[/url]")) { return; }
    var TITLE = prompt(bbcode_pagename, bbcode_web_pagename);
    if (TITLE == null) { return; }
    var Add = "]"+URL;
    if (TITLE) { Add = "="+URL+"]"+TITLE; }
    BBCwrite(form, field, '', "[url"+Add+"[/url]", true);
}

function BBCwrite(form, field, start, end, force) {
    var textarea = document.forms[form].elements[field];
    if (textarea.caretPos) {
      textarea.focus();
        // Attempt to create a text range (IE).
        theSelection = document.selection.createRange().text;
        if (force || theSelection != '') {
            document.selection.createRange().text = start + theSelection + end;
            textarea.focus();
            return true;
        }
    } else if (typeof(textarea.selectionStart) != "undefined") {
        // Mozilla text range replace.
        var text = new Array();
        text[0] = textarea.value.substr(0, textarea.selectionStart);
        text[1] = textarea.value.substr(textarea.selectionStart, textarea.selectionEnd-textarea.selectionStart);
        text[2] = textarea.value.substr(textarea.selectionEnd);
        caretPos = textarea.selectionEnd+start.length+end.length;
        if (force || text[1] != '') {
            textarea.value = text[0]+start+text[1]+end+text[2];
            if (textarea.setSelectionRange) {
                textarea.focus();
                textarea.setSelectionRange(caretPos, caretPos);
            }
            return true;
        }
    } else if (force) {
        // Just put it on the end.
        textarea.value += start+end;
        textarea.focus(textarea.value.length-1);
        return true;
    }
    return false;
}

function storeCaret(text) {
    if (text.createTextRange) text.caretPos = document.selection.createRange().duplicate();
}

function bbstyle(bbnumber) {
    return true;
}