var xmlHttpGet = createXmlHttpRequestObject();
var gURL;
var gTried = false;

/**
 * Get's the new page from the site
 **/
function requestNewPage(url) {
    gURL = url;
    //Random number for IE
    var random_number = Math.random() * 2;
    var urlGet = "loader.php?"+url+"&trash="+random_number;

    if(xmlHttpGet) {
        try {
            // don't start another server operation if such an operation
            //   is already in progress
            if (xmlHttpGet.readyState == 4 || xmlHttpGet.readyState == 0) {
                // call the server page to execute the server-side operation
                xmlHttpGet.open("GET", urlGet, true);
                xmlHttpGet.onreadystatechange = handleReceiving;
                xmlHttpGet.send(null);
            }
        } catch(e) {
            retry();
        }
    }
    return false;
}

/**
 * Will retry the page once
 **/
function retry() {
    //If we retried once already then forward to the URL
    if (gTried) {
        forward(gURL);
        return;
    }
    //Remake the object just incase
    xmlHttpGet = createXmlHttpRequestObject();
    //Try again
    requestNewPage(gURL);
    gTried = true;
}

/**
 * Handles the get XMLHTTP object
 **/
function handleReceiving() {
    // continue if the process is completed
    if (xmlHttpGet.readyState == 4) {
        // continue only if HTTP status is "OK"
        if (xmlHttpGet.status == 200) {
            try {
                gTried = false;
                // process the server's response
                readInfo();
            } catch(e) {
                retry();
            }
        } else {
            retry();
        }
    }
}

/**
 * Reads the XML data sent back
 **/
function readInfo() {
    // retrieve the server's response
    var response = xmlHttpGet.responseText;
    var response_xml = xmlHttpGet.responseXML;

    //If there is an error
    if (response.indexOf("ERRNO") >= 0 || response.indexOf("error:") >= 0 ) {
        forward(gURL);
        return ;
    }
    //If there is data
    if (response.length > 2) {
        //Try to parse it
        try {
            var page = response_xml.getElementsByTagName("page");
            var content = page[0].getElementsByTagName("content")[0].childNodes[0].nodeValue;
            var title = page[0].getElementsByTagName("title")[0].childNodes[0].nodeValue;
            document.title = title.replace(/&raquo;/, '\xbb') ;
            replace(content);
        } catch(e) {
            forward(gURL);
            return ;
        }
    }
}

/**
 * Try to get the object id
 **/
function getObjById(id) {
    if (document.getElementById) {
        var returnVar = document.getElementById(id);
    } else if (document.all) {
        var returnVar = document.all[id];
    } else if (document.layers) {
        var returnVar = document.layers[id];
    }
    return returnVar;
}

/**
 * Replace the content div
 **/
function replace(content) {
    var div;
    div = getObjById("evo_content");
    div.innerHTML = content;
}

/**
 * Forwards to a URL just incase
 **/
function forward(url) {
    //If there is no url
    if (!url || url.length < 1) {
        alert("Page Error");
        return ;
    }
    window.location = "modules.php?"+url;
}